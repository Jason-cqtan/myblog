<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('getip'))
{
	/**
	 * 打印数组
	 * @param  array  $arr [description]
	 * @return [type]      [description]
	 */
	function getip()
	{
	    if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $realip = getenv( "HTTP_X_FORWARDED_FOR");
            } elseif (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
	}
}

if ( ! function_exists('getipaddress'))
{
	/**
	 * 打印数组
	 * @param  array  $arr [description]
	 * @return [type]      [description]
	 */
	function getipaddress($ip = '125.84.81.170')
	{
        $ip = $ip == '0.0.0.0'?getip():$ip;
	    $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip; 
	    $ch = curl_init($url); 
	    curl_setopt($ch,CURLOPT_ENCODING ,'utf8'); 
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回 
	    $location = curl_exec($ch); 
	    $location = json_decode($location); 
	    curl_close($ch);
	    if((int)$location->code !== 0 ){
	    	return ""; 
	    }else{
	    	return $location->data->region.$location->data->isp;
	    } 
	}
}