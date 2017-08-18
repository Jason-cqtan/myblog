<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 关于我
*/
class Aboutme extends CI_Controller
{
	
    public function index()
    {
    	$this->load->view('home/aboutme');
    }
}