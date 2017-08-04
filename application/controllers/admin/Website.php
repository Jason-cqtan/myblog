<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 优站推荐
*/
class Website extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','common');
        $this->load->model("User_model",'user');
        $this->load->model('Website_model','web');
        $this->load->model('Module_model','module');
        $this->load->model('Tags_model','tag');
        $this->load->helper('bootpagination');
	}

	public function index()
	{
		//获取优站推荐的模块列表
		$modules = $this->module->getWebModules();
		$data['tree'] = $this->common->getTree($modules,0);
        //默认显示10条列表
        $data['page_size'] = 10;//每页显示几条
        $data['page_index'] = (!empty($this->uri->segment(4)))?(int)$this->uri->segment(4):1;//当前第几页
        $res = $this->web->getWebsites($data);
        $data['total_page'] = $res['total_page'];//总页数
        $data['totalnum'] = $res['total_count'];//总条数
        $data['pagestr'] = bootpagination($data['page_index'],$data['total_page'],3);//分页
        $data['list'] = $res['data'];        
		$this->load->view('admin/website',$data);
	}

	 /**
     * ajax获取列表
     * @return [type] [description]
     */
	public function ajaxGetlist()
	{
		$data['page_index'] = (int)$this->input->post('page_index')<=0?1:(int)$this->input->post('page_index');
        $data['page_size'] = (int)$this->input->post('page_size');      
        $data['name'] = empty($this->input->post('name'))?"":$this->input->post('name');
        $data['module_ids'] = empty($this->input->post('module_ids'))?[]:$this->input->post('module_ids');
        $data['create_time'] = empty($this->input->post('create_time'))?"":$this->input->post('create_time');
        $res = $this->web->getWebsites($data);
        $totalnum = $res['total_count'];//(int)$res->count;//总条数
        $total_page = $res['total_page'];
        $pagestr = bootpagination($data['page_index'],$total_page,3);//分页
        $statistics = array('currentpage'=>$data['page_index'],'total_page'=>$total_page,'totalnum'=>$totalnum);
        $ajaxcontent = $this->AjaxHtmlFormat($res['data']);
        echo json_encode(array('status'=>'ok','list'=>$ajaxcontent,'pagestr'=>$pagestr,'statistics'=>$statistics));
        exit;
	}

	/**
     * 表体html列表
     * @param array $data [description]
     */
    private function AjaxHtmlFormat($data = array())
    {
         $str = '';
         if($data){
            foreach ($data as $key => $item) {
                $str .= '<tr>';
                $str .= '<td class="text-center"><input type="checkbox" name="ids[]" value="'.$item->id.'"></td>';
                $str .= '<td>'.$item->id.'</td>';                               
                $str .= '<td>'.$item->module_name.'</td>';
                $str .= '<td>'.$item->name.'</td>';
                $str .= '<td><a href="'.$item->url.'" target="_blank">'.$item->url.'</a></td>';
                $str .= '<td>'.$item->remark.'</td>';
                $str .= '<td>'.date("Y-m-d h:i:s",$item->create_time).'</td>';
                $str .= '<td data-urlid="'.$item->id.'">';
                $str .= '<a href="#" class="edit">修改</a>
                      <a href="#" class="del">删除</a>';
                $str .= '</td>';
                $str .= '</tr>';
            }
         }else{
            $str .= '<tr style="width:100%;text-align:center;color:red;"><td colspan="9">暂无数据！</td></tr>';
         }
         return $str;
    }
    
    /**
     * 插入优站
     * @return [type] [description]
     */
	public function insertWeb()
	{
		$data['module_id'] = $this->input->post('module_id');
		$data['name'] = $this->input->post('name');
		$data['url'] = $this->input->post('url');
		$data['remark'] = $this->input->post('remark');
		$res = $this->web->insertWeb($data);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}
    
    /**
     * 删除优站
     * @return [type] [description]
     */
	public function delWeb()
	{
		$id = $this->input->post('id');
		$res = $this->web->delWeb($id);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}
    
    /**
     * 获取优站信息
     * @return [type] [description]
     */
	public function getWeb()
	{
		$id = $this->input->post('id');
		$res = $this->web->getWeb($id);
		echo json_encode(array('data'=>$res));exit;
	}
	/**
	 * 修改网站
	 * @return [type] [description]
	 */
	public function editWeb()
	{
		$data['id'] = $this->input->post('id');
		$data['module_id'] = $this->input->post('module_id');
		$data['name'] = $this->input->post('name');
		$data['url'] = $this->input->post('url');
		$data['remark'] = $this->input->post('remark');
		$res = $this->web->editWeb($data);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}
}