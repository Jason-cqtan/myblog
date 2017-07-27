<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 公共控制器
*/
class Common extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->helper('generateqr');
        $this->load->library('user_agent');
	}

    /**
     * 生成二维码
     * @return [type] [description]
     */
	public function generateQr()
	{
         generateqr();
	}
}