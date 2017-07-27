<?php defined('BASEPATH') OR exit('No direct script access allowed');

//记录日志辅助函数
if ( ! function_exists('record_log'))
{
	
	function record_log($data,$savepath='logs/')
	{
		$requesttime = date("Y-m-d H:i:s");
		$clientip = $_SERVER['REMOTE_ADDR'];
		$serverip = REQUEST_URL;
		$action = $data['action'];
		$errormsg = $data['msg'];
        $record = "------------------------------------------------------------------------------\r\n";
	    $record .= "[{$requesttime}] {$data['action']} 请求ip：{$clientip} 服务器ip:{$serverip} \r\n";
        if(!empty($data['msg'][1])){
            $record .= "接口返回数据为：\r\n{$data['msg'][1]}\r\n";
            // $record .= "curl请求返回数据为：\r\n";
            // foreach ($data['msg'][0] as $field => $value) {
            //     if(!is_array($value)){
            //         $record .= "{$field} => {$value}\r\n";
            //     }
            // }
        }
        else
        {
            $record .= "{$data['msg'][0]} \r\n";
        }
        
        $record .= "-----------------------------------------------------------------------------\r\n\r\n";
        $y = date('Y',time());
        $m = date('m',time());
        $d = date('d',time());
        $savepath = $savepath.'/'.$y.'/'.$m.'/'.$d;
        //根据年月日创建文件夹存放
        if(!file_exists($savepath)){
            mkdir($savepath,0777,true);//0777权限，7=4(读)+2(写)+1(执行)，四位数表从第二位算起，拥有者，所属组，个人，true是否递归创建文件夹
            chmod($savepath,0777);
        }
        
        $savepath = $savepath.'/'.$y.'-'.$m.'-'.$d.'request.php';
        error_log($record,3,$savepath);
	}
}