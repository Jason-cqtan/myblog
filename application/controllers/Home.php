<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','common');
                $this->load->model("User_model",'user');
                $this->load->model('Article_model','article');
                $this->load->model('Module_model','module');
                $this->load->model("Soul_model",'soul');
                $this->load->helper('bootpagination');
	}

	public function index()
	{
		$data['modules'] = $this->module->getNavModules();
        //默认显示10条文章列表
        $data['page_size'] = 10;//每页显示几条
        $data['page_index'] = (!empty($this->uri->segment(4)))?(int)$this->uri->segment(4):1;//当前第几页
        $res = $this->article->getArticles($data);
        // print_r($res);exit;
        $data['total_page'] = $res['total_page'];//总页数
        $data['totalnum'] = $res['total_count'];//总条数
        $data['pagestr'] = bootpagination($data['page_index'],$data['total_page'],3);//分页
        $data['list'] = $res['data'];
        // print_R($data);exit;
		$this->load->view('home/index',$data);
	}

        public function getHots()
        {
            $res = $this->article->getHots();
            echo json_encode(array('list'=>$res));
            exit;
        }

        public function getRand()
        {
            $res = $this->article->getRandArticle();
            echo json_encode(array('list'=>$res));
            exit;    
        }

        public function getclicknum()
        {
            echo json_encode(array('num'=>$_SESSION['randsoulnum'],'msg'=>'鸡汤看这么多干嘛，撸代码去！'));
            exit;
        }

        public function getSoul()
        {
            $_SESSION['randsoulnum'] = isset($_SESSION['randsoulnum'])?$_SESSION['randsoulnum']+=1:1;
            $res = $this->soul->getRand();
            echo json_encode(array('status'=>0,'word'=>$res));
            exit;
        }


}
