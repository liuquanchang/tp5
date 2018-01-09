<?
namespace app\index\controller;
use think\Request;
use app\index\model\Search;
class SearchController extends CommonController
{
	public function index(){
		//echo phpinfo();
		//die();
		$model    = model('Area');
		$province = $model->get_area('id,areaname');
		if($province===false){$this->error($model->getError());}
		$this->assign('province',$province);
		return view();
	}
	public function linkage(Request $request)
	{
		$pid	=	$request->param('pid');
		if($request->isAjax()===false || !is_numeric($pid)){return json(['code'=>0,'msg'=>'非法操作！']);}
		$data	=	model('Area')->get_area('id,areaname',$pid);
		if($data===false){$this->error($model->getError());}
		return json(['data'=>$data,'code'=>1,'msg'=>'ok']);
	}
	public function test()
	{
		return view();
	}
	public function searchd(Request $request)
	{
		$data  	=  	$request->param();
		$data	=	Search::search_index($data);
		exit;
		return $this->fetch();
	}
}
