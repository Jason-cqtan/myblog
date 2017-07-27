<?php defined('BASEPATH') OR exit('No direct script access allowed');
//公共curl请求，包含get、post
if ( ! function_exists('curl_post'))
{

	function curl_post($url,$data,$timeout = 0)
	{
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url);
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=utf-8"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_TIMEOUT,9999999);//设置cURL允许执行的最长秒数
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,0);//连接超时，单位秒
        curl_setopt ($ch, CURLOPT_DNS_CACHE_TIMEOUT ,9999999);//设置在内存中保存DNS信息的时间，默认为120秒。
        $execres = curl_exec ( $ch );//执行结果
        if(curl_errno($ch))
        {
        	$errormsg = curl_error($ch);
			return array('status'=>'fail','msg'=>$errormsg);
        }
        else
        {
            $info = curl_getinfo($ch);
			return array('status'=>'ok','content'=>$execres,'msg'=>$info);
        }
        curl_close ( $ch );
	}
}






if ( ! function_exists('curl_get'))
{
	/**
	 * curlget方式请求api
	 * @param  [string] $url [请求地址]
	 * @return [json]      [json格式字符串]
	 */
	function curl_get($url)
	{
	    $ch = curl_init();//初始化
		curl_setopt($ch,CURLOPT_URL,$url);//设置参数
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=utf-8"));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//执行之后不直接打印出来
		$execres = curl_exec($ch);
		if(curl_errno($ch))
		{
			$errormsg = curl_error($ch);
			return json_encode(array('status'=>'fail','msg'=>$errormsg));
		}
		else
		{
			$info = curl_getinfo($ch);
			return json_encode(array('status'=>'ok','content'=>$execres,'msg'=>$info));
		}
		curl_close($ch);
	}
}


