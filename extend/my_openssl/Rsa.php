<?php
namespace my_openssl;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/12
 * Time: 13:59
 */
class Rsa
{
    private  $csr_pah        =  './rsa_private_key.pem';          //私钥文件目录
    private  $pfx_path       =  './rsa_public_key.pem';           //公钥文件目录
    private  static $object  =  '';                               //单利对象
    private  $k_private      =  '';
    private  $k_public       =  '';
    private  $path           =  './ssl_log';                    //日志目录
    private  $config         =  [
        'config'            =>'D:\wamp\bin\apache\apache2.4.9\conf\openssl.cnf',//指定openssl的配置文件的所在
        'digest_alg'        =>'sha512',              //对秘钥进行SHA512的加密算法
        'private_key_bits'  =>4096,                 //生成秘钥的长度
        'private_key_type'  =>OPENSSL_KEYTYPE_RSA   //对密钥进行RSA签名
    ];
    /**
     * @time                 |-开发时间: 2016年12月12日17:47:40
     * @author               |-开发者:   lqc
     * @modifier             |-修改者：  lqc
     * @modify_time          |-修改时间：2016年12月12日17:47:27
     * Rsa constructor.      |-构造方法
     * @param $csr_path      |-私钥目录
     * @param $pfx_path      |-公钥目录
     * @param $path          |-日志目录
     * @param array $config  |-用户自定义配置
     */
    private function __construct($csr_path,$pfx_path,$path,$config=[])
    {
        try{
            if(empty($csr_path) || empty($pfx_path) || !extension_loaded('openssl')){
                throw new Exception('密钥存储路径不能为空或者你没有安转openssl扩展！');}
            $config     =array_filter($config);
            if(!empty($config)){$this->config=array_merge($this->config,$config);}
            list($this->csr_pah,$this->pfx_path,$this->path)  =  [$csr_path,$pfx_path,$path];
            $this->create_key();$this->check_make_base($this->path);
        }catch (Exception $e){$this->writer_error_log($e->getMessage().":code({$e->getCode()})");}
    }

    /**
     * 禁止克隆对象
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * @time                 |-开发时间: 2016年12月12日17:47:40
     * @author               |-开发者:   lqc
     * @modifier             |-修改者：  lqc
     * @modify_time          |-修改时间：2016年12月12日17:47:27
     * @param $csr_path      |-私钥目录
     * @param $pfx_path      |-公钥目录
     * @param $path          |-日志目录
     * @param array $config  |-用户自定义配置
     * @return Rsa|string    |-返回Rsa对象
     */
    public  static  function instance($csr_path,$pfx_path,$path,$config=[])
    {
        try{
            if(!empty(self::$object) || self::$object instanceof self){
                return self::$object;
            }
            self::$object  = new self($csr_path,$pfx_path,$path,$config);
            if(self::$object==false){throw new Exception('对象实例化失败！');}
            return self::$object;
        }catch (Exception $e){self::writer_error_log($e->getMessage().":code({$e->getCode()})");}
    }
    /**
     * @time                        |-开发时间:2016年12月12日17:47:40
     * @author                      |-开发者:  lqc
     * @modifier                    |-修改者： lqc
     * @modify_time                 |-修改时间:2016年12月12日17:47:27
     * @use                         |-生成公钥和私钥密钥对
     */
    private function create_key()
    {
        try{
            $rsa         =  openssl_pkey_new($this->config);
            if($rsa===false){throw new Exception('抱歉私钥生成异常！');}
            //生成私钥
            if(!file_exists($this->csr_pah) || filesize($this->csr_pah)==0){
                openssl_pkey_export($rsa,$private,null,$this->config);
                if(empty($private)){throw new Exception('抱歉私钥生成为空！');}
                $this->generate($private,$this->csr_pah);
                $this->k_private=openssl_pkey_get_public($private);
            }
            //生成公钥
            if(!file_exists($this->pfx_path) || filesize($this->pfx_path)==0){
                $rsa_p   =  openssl_pkey_get_details($rsa);
                $public  =  $rsa_p['key'];
                if(empty($public)){throw new Exception('抱歉公钥生成为空！');}
                $this->generate($public,$this->pfx_path);
                $this->k_public =openssl_pkey_get_public($public);
            }
        }catch (Exception $e){$this->writer_error_log($e->getMessage().":code({$e->getCode()})");}
    }
    /**
     * @time                        |-开发时间: 2016年12月12日17:47:40
     * @author                      |-开发者:   lqc
     * @modifier                    |-修改者：  lqc
     * @modify_time                 |-修改时间：2016年12月12日17:47:27
     * @return bool                 |-私钥是否设置成功
     */
    private function set_private_key()
    {
        try{
            if(is_resource($this->k_private) || !empty($this->k_private)){return true;}
            $this->k_private=file_get_contents($this->csr_pah);
            $this->k_private=openssl_pkey_get_private($this->k_private);
            if($this->k_private===false){throw new Exception('抱歉私钥设置失败!');}
            return true;
        }catch (Exception $e){$this->writer_error_log($e->getMessage().":code({$e->getCode()})");}

    }
    /**
     * @time                        |-开发时间: 2016年12月12日17:47:40
     * @author                      |-开发者:   lqc
     * @modifier                    |-修改者：  lqc
     * @modify_time                 |-修改时间：2016年12月12日17:47:27
     * @return bool                 |-公钥是否设置成功
     */
    private  function set_public_key()
    {
        try{
            if(is_resource($this->k_public) || !empty(($this->k_public))){return true;}
            $this->k_public=file_get_contents($this->pfx_path);
            $this->k_public=openssl_pkey_get_public($this->k_public);
            if($this->k_public==false){throw new Exception('抱歉公钥设置失败!');}
            return true;
        }catch (Exception $e){$this->writer_error_log($e->getMessage().":code({$e->getCode()})");}
    }
    /**
     * @time                        |-开发时间: 2016年12月12日17:47:40
     * @author                      |-开发者:   lqc
     * @modifier                    |-修改者：  lqc
     * @modify_time                 |-修改时间：2016年12月12日17:47:27
     * @param $data                 |-加密数据
     * @return string               |-机密后得到的字符串
     */
    public function private_encrypt($data)
    {
        try{
            if(empty($data)){throw new Exception('抱歉加密数据不能为空!');}
            $this->set_private_key();
            openssl_private_encrypt($data,$encrypt,$this->k_private);
            if(empty($encrypt)){throw new Exception('抱歉私钥加密失败!');}
            $encrypt = base64_encode($encrypt);return $encrypt;
        }catch (Exception $e){$this->writer_error_log($e->getMessage().":code({$e->getCode()})");}
    }
    /**
     * @time                        |-开发时间: 2016年12月12日17:47:40
     * @author                      |-开发者:   lqc
     * @modifier                    |-修改者：  lqc
     * @modify_time                 |-修改时间：2016年12月12日17:47:27
     * @param $data                 |-加密数据
     * @return string               |-机密后得到的字符串
     */
    public function public_encrypt($data)
    {
        try{
            if(empty($data)){throw new Exception('抱歉加密数据不能为空!');}
            $this->set_public_key();
            openssl_public_encrypt($data,$encrypt,$this->k_public);
            if(empty($encrypt)){throw new Exception('抱歉公钥加密失败!');}
            $encrypt   =   base64_encode($encrypt);return $encrypt;
        }catch (Exception $e){$this->writer_error_log($e->getMessage().":code({$e->getCode()})");}
    }
    /**
     * @time                        |-开发时间: 2016年12月12日17:47:40
     * @author                      |-开发者:   lqc
     * @modifier                    |-修改者：  lqc
     * @modify_time                 |-修改时间：2016年12月12日17:47:27
     * @param $encrypted            |-解密字符串
     * @return mixed                |-解密后得到的数据
     */
    public function private_decrypt($encrypted)
    {
        try{
            if(empty($encrypted)){throw new Exception('抱歉解密数据不能为空!');}
            $this->set_private_key();
            $encrypted  =   base64_decode($encrypted);
            openssl_private_decrypt($encrypted,$result,$this->k_private);
            if(empty($result)){throw new Exception('抱歉私钥解密失败!');}
            return $result;
        }catch (Exception $e){$this->writer_error_log($e->getMessage().":code({$e->getCode()})");}
    }
    /**
     * @time                        |-开发时间: 2016年12月12日17:47:40
     * @author                      |-开发者:   lqc
     * @modifier                    |-修改者：  lqc
     * @modify_time                 |-修改时间：2016年12月12日17:47:27
     * @param $encrypted            |-解密字符串
     * @return mixed                |-解密后得到的数据
     */
    public function public_decrypt($encrypted)
    {
        try{
            if(empty($encrypted)){throw new Exception('抱歉解密数据不能为空!');}
            $this->set_public_key();
            $encrypted  =   base64_decode($encrypted);
            openssl_public_decrypt($encrypted,$result,$this->k_public);
            if(empty($result)){throw new Exception('抱歉公钥解密失败!');}
            return $result;
        }catch (Exception $e){$this->writer_error_log($e->getMessage().":code({$e->getCode()})");}
    }
    /**
     * @time                        |-开发时间: 2016年12月12日17:47:40
     * @author                      |-开发者:   lqc
     * @modifier                    |-修改者：  lqc
     * @modify_time                 |-修改时间：2016年12月12日17:47:27
     * @param        $source string |-密钥字符串
     * @param        $path   string |-保存密钥的文件路径
     */
    private  function generate($source,$path)
    {
        try{
            if(!is_string($source)){throw new Exception('抱歉资源错误');}
            $fp =   fopen($path,'w+');
            @flock($fp,LOCK_EX);
            @fwrite($fp,$source,strlen($source));
            @flock($fp,LOCK_UN);
            @fclose($fp);
        }catch (Exception $e){$this->writer_error_log($e->getMessage().":code({$e->getCode()})");}
    }
    /**
     * @author         |-lqc
     * @time           |-开发时间：2016年12月12日17:02:51
     * @access         |-共有方法
     * @modify_time    |-修改日期：2016年12月12日17:02:55
     * @modifier       |-修改人lqc
     * @param $content |-错误日志的类容
     * @return resource|-关闭资源
     */
    public function writer_error_log($content)
    {
        //写在根目录
        $filename="ssl_error_log.txt";
        //if(false===$this->check_make_base('./abc_error')) return false;
        $str   = date("Y-m-d H:i:s")."\n".$content."\n";
        $fp    = fopen($this->path.DIRECTORY_SEPARATOR.$filename,'ab+');
        @flock($fp,LOCK_EX);
        @fwrite($fp,$str,strlen($str));
        @flock($fp,LOCK_UN);
        $source=fclose($fp);
        if(!is_readable($filename) && !is_writeable($filename)){
            //改变文件的权限
            @chmod($filename,0777);
        }
        return $source;
    }

    /**
     * @author         |-开发者:   lqc
     * @time           |-开发时间: 2016年8月18日 14:16:45
     * @access         |-共有方法
     * @modify_time    |-修改日期: 2016年8月19日10:43:16
     * @modifier       |-修改人:   lqc
     * @param $path    |-创建文件夹的路径
     * @return bool    |-递归创建文件夹
     */
    private function check_make_base($path)
    {
        if(is_dir($path)){return true; }
        if(is_dir(dirname($path))){            //父目录已经存在，直接创建
            return mkdir($path,0777);
        }
        $this->check_make_base(dirname($path));//创建各级父目录
        return mkdir($path,0777);              //因为有父目录，所以可以创建路径
    }

    /**
     * @author         |-开发者:   lqc
     * @time           |-开发时间: 2016年8月18日 14:16:45
     * @access         |-共有方法
     * @modify_time    |-修改日期: 2016年8月19日10:43:16
     * @modifier       |-修改人:   lqc
     * 析构方法         |-销毁打开的资源
     */
    public function __destruct()
    {
        @fclose($this->k_public);
        @fclose($this->k_private);
    }
}
