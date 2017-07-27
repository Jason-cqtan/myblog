<?php defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('getAccessInfo'))
{
	/**
	 * 返回访问者的信息
	 * @return [type] [description]
	 */
	function getAccessInfo()
	{
	    $result['platform'] = $this->agent->platform();
		$result['browser'] = $this->agent->browser();
		$result['browserdesc'] = $this->agent->version();
		return $result;
	}
}