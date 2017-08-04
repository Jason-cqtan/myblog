<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

	function __construct()
	{
	    parent::__construct();
	    $this->load->model('Common_model','common');
            $this->load->model("User_model",'user');
            $this->load->model('Article_model','article');
            $this->load->model('Module_model','module');
            $this->load->model('Tags_model','tag');
            $this->load->model('Website_model','web');
            $this->load->helper('bootpagination');
	}

	public function index()
	{
	    $data['list'] = $this->web->homeGettWebsites();
            $this->load->view('home/website',$data);
	}
}
