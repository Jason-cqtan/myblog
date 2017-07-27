<?php defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('returnjson'))
{
	/**
	 * 返回json格式给前端
	 * @param  [string] $status [状态、ok，error等等]
	 * @param  string $msg    [状态详情或附加信息]
	 * @param  array  $data   [返回数组]
	 * @return [json]         [json字符串]
	 */
	function returnjson($status,$msg = '',$data = [])
	{
	    echo json_encode(array('status'=>$status,'msg'=>$msg,'data'=>$data));
	    exit;
	}
}
