<?php defined('BASEPATH') OR exit('No direct script access allowed');



if ( ! function_exists('filterarray'))
{
	/**
	 * 打印数组
	 * @param  array  $arr [description]
	 * @return [type]      [description]
	 */
	function filterarray($v)
	{
	    if((int)strlen(trim($v[0])) < 1 && (int)strlen(trim($v[1])) < 1 && (int)strlen(trim($v[2])) < 1 && (int)strlen(trim($v[3])) < 1 && (int)strlen(trim($v[4])) < 1){
	    	return false;
	    }else{
	    	return true;
	    }
	}
}