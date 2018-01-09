<?
namespace app\index\controller;
use think\Request;
use my_openssl\Rsa;
class UploadeController extends CommonController
{
	public function index()
	{
		echo phpinfo();
		exit;	
		dump(request()->module());
		dump(request()->controller());
		dump(request()->action());
		dump(request()->server());
		dump(request()->method());
		dump(request()->ip());
		dump(request()->type());
		dump(request()->server('PATH_INFO'));
		dump(request()->header());
		/*dump(ROOT_PATH);
		exit;
		header('Access-Control-Allow-Origin:*');
		file_put_contents('../runtime/input.txt',var_export(input('param.'),true));
		file_put_contents('../runtime/server.txt',var_export($_SERVER,true));
		return json(['data'=>input('param.')]);		
		exit;*/
		return  $this->fetch();
	}
	public function up(Request $request)
	{
		header('Access-Control-Allow-Origin:*');
		$file	=	$request->file('file');
		file_put_contents('../runtime/file.txt',var_export($_FILES,true));	
		file_put_contents('../runtime/input.txt',var_export(input('param.'),true));
		file_put_contents('../runtime/server.txt',var_export($_SERVER,true));
		$public_key	=	file_get_contents('./rsa_public_key.pem');
		file_put_contents('../runtime/public_ket.txt',$public_key);
		$source		=openssl_pkey_get_public($public_key);
		$input_token	=base64_decode(input('param.token'));
		
		openssl_public_decrypt($input_token,$result,$public_key);
		file_put_contents('../runtime/secret_un.txt',$result);
		return json(['data'=>$result]);
		exit;
		$result	=	$file->validate(['file'=>$file],['file'=>'require.image'],['file.image'=>'请上传图片文件！']);
		if($result===false){$this->error('非法上传');}
		$info	=	$file->rule('sha1')->move(".".DS.'uploades'.DS);
		$item[] = $info->getRealPath();
		return  json($item);
		echo "<img src='{$info->getPath()}/{$info->getFilename()}'>";
		exit;
	}
	public function test()
	{
		if(empty(session('linux_key')))
		{
			$config	=['config'=>'/etc/pki/tls/openssl.cnf'];
			$rsa	=Rsa::instance('../runtime/rsa_private_key.pem','../runtime/rsa_public_key.pem','./ssl_log',$config);
			$secret	=$rsa->private_encrypt('linux_key');
			session('linux_key',$secret);

		}else{
			$secret	= session('linux_key');
		}
		$this->assign('secret',$secret);
		return $this->fetch();
	}
	public function   try_up(){
		header('Access-Control-Allow-Origin:http://c.jihui365.cn');
		file_put_contents('..//runtime/ty_up.txt',var_export(input('param.'),true));
	}
}
