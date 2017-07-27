<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('resultrows'))
{
	/**
	 * 打印数组
	 * @param  array  $arr [description]
	 * @return [type]      [description]
	 */
	function resultrows($data)
	{
	    return (object)[
	       'opreate' => $data['opreate'],//操作
           'status' => $data['status'],//状态，非0表错误
           'msg' => $data['msg'],//返回信息
           'count' => $data['count'],//总条数
           'page_index' => $data['page_index'],//当前第几页
           'page_size' => $data['page_size'],//每页显示多少条
           'data' => $data['data']//结果
	    ];
	}
}


if ( ! function_exists('resultrow'))
{
	/**
	 * 打印数组
	 * @param  array  $arr [description]
	 * @return [type]      [description]
	 */
	function resultrow($data)
	{
	    return (object)[
	       'opreate' => $data['opreate'],//操作
           'status' => $data['status'],//状态，非0表错误
           'msg' => $data['msg'],//返回信息
           'data' => isset($data['data'])?$data['data']:(object)[]//结果
	    ];
	}
}