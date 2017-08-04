<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 模块分类管理
*/
class Cate extends MY_Controller
{
	
	function __construct()
	{
	    parent::__construct();
	    $this->load->model('Common_model','common');
        $this->load->model("User_model",'user');
        $this->load->model('Article_model','article');
        $this->load->model('Module_model','module');
        $this->load->model('Tags_model','tag');
        $this->load->helper('bootpagination');
	}

	public function index()
	{
		//查询所有的模块、标签列表
		$res = $this->module->getAllModule();
		$tree = $this->common->getTree($res,0);
		$data['tree'] = [];
		foreach ($tree as $key => $first) {			
			if(isset($first->children)){
				foreach ($first->children as $key => $second) {
					$tags = $this->tag->getTagsBymoduleid($second->id);
					if($tags){
						$second->tags = $tags;
					}					
				}
			}
			$data['tree'][] = $first;
		}
		// print_r($needarr);exit;
		$this->load->view('admin/cate',$data);
	}

	public function insertCate()
	{
		$data['name'] = trim($this->input->post('name'));
		$data['is_nav'] = $this->input->post('is_nav');
		$data['is_tag'] = $this->input->post('is_tag');
		$data['pid'] = empty($this->input->post('pid'))?0:(int)$this->input->post('pid');
		$res = $this->module->insertModule($data);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}

	public function delCate()
	{
		$id = $this->input->post('id');
		$res = $this->module->delModule($id);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}

	public function editCate()
	{
		$data['id'] = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$res = $this->module->editModule($data);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}

	public function insertTag()
	{
		$data['module_id'] = $this->input->post('module_id');
		$data['name'] = $this->input->post('name');
		$res = $this->tag->insertTag($data);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}

	public function delTag()
	{
		$id = $this->input->post('id');
		$res = $this->tag->delTag($id);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}

     public function editTag()
	{
		$data['id'] = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$res = $this->tag->editTag($data);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}
}