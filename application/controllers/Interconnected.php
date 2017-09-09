<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 账号互联登录
*/
class Interconnected extends CI_Controller
{

    function __construct()
    {
        # code...
    }

    public function authLogin(){
        $type = $this->input->post('type');
    }
}
