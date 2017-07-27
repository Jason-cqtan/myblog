<?php defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('debugres'))
{
	/**
	 * 打印数组
	 * @param  array  $arr [description]
	 * @return [type]      [description]
	 */
	function debugres($arr = [],$type = "desc")
	{
	    if($type == 'desc'){
	    	var_dump($arr);
	    	exit;
	    }else{
	    	print_r($arr);
	    	exit;
	    }
	}
}
