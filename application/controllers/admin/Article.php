<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 文章管理
*/
class Article extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','common');
        $this->load->model("User_model",'user');
        $this->load->model('Article_model','article');
        $this->load->model('Module_model','module');
        $this->load->model('Tags_model','tag');
	}
    
    /**
     * 文章列表
     * @return [type] [description]
     */
	public function index()
	{
		$data['modules'] = $this->module->getNavModules();
		//获取所有文章列表
		$data['moduleids'] = [];
		$data['tagids'] = [];
		$data['title'] = '';
		$data['create_time'] = '';
		// $res = $this->article->getArticles($data);
		$this->load->view('admin/articlelist',$data);
	}
    
    /**
     * 根据模块id列表获取标签列表
     * @return [type] [description]
     */
	public function getTags()
	{
		$modules = $this->input->post('moduleids');
		$res = $this->tag->getTagsBymoduleids($modules);
		returnjson('ok',$res);
	}


	public function getTagsBymoduleid()
	{
		$modules[] = $this->input->post('moduleid');
		$res = $this->tag->getTagsBymoduleids($modules);
		returnjson('ok',$res);
	}
    
    /**
     * ajax获取文章列表
     * @return [type] [description]
     */
	public function ajaxGetlist()
	{
		$data['page_index'] = (int)$this->input->post('page_index')==0?1:(int)$this->input->post('page_index');
        $data['page_size'] = (int)$this->input->post('page_size');      
        $data['title'] = empty($this->input->post('title'))?"":$this->input->post('title');
        $data['moduleids'] = empty($this->input->post('moduleids'))?"":$this->input->post('moduleids');
        $data['tagids'] = empty($this->input->post('tagids'))?"":$this->input->post('tagids');
        $data['create_time'] = empty($this->input->post('create_time'))?"":$this->input->post('create_time');
        $res = $this->article->getCustomers($data);
        $totalnum = $res['row_count'];//(int)$res->count;//总条数
        $total_page = $res['page_count'];
        $pagestr = bootpagination($data['page_index'],$total_page,3);//分页
        $statistics = array('currentpage'=>$data['page_index'],'total_page'=>$total_page,'totalnum'=>$totalnum);
        $ajaxcontent = $this->AjaxHtmlFormat($res['resobj']);
        echo json_encode(array('status'=>'ok','list'=>$ajaxcontent,'pagestr'=>$pagestr,'statistics'=>$statistics));
	}

	/**
     * 表体html文章列表
     * @param array $data [description]
     */
    private function AjaxHtmlFormat($data = array())
    {
         $str = '';
         if($data){
            foreach ($data as $key => $customer) {
                if($key%2 == 0){
                    $str .= '<tr class="odd">';
                }else{
                    $str .= '<tr class="even">';
                } 
                $str .= '<td><input type="checkbox" name="customerid[]" value="'.$customer->id.'"></td>';
                $str .= '<td>'.$customer->id.'</td>';                               
                $str .= '<td class="name">'.$customer->name.'</td>';
                $str .= '<td class="tenantry">'.$customer->tenantry.'</td>';
                $str .= '<td>'.$customer->idcard.'</td>';
                if(strlen($customer->mobile_phone) != 6){
                    $str .= '<td>'.$customer->mobile_phone.'</td>';
                }else{
                    $str .= '<td></td>';
                }                
                $str .= '<td>'.$customer->address.'</td>';
                $str .= '<td>'.$customer->critical_phone.'</td>';
                $str .= '<td>'.$customer->telephone.'</td>';
                $str .= '<td>'.$customer->postcode.'</td>';
                $str .= '<td>'.$customer->remark.'</td>';
                $str .= '<td customerid="'.$customer->id.'">';
                if(in_array('1106',$_SESSION['user_level'])){
                $str .= '<a href="#" class="history" data-toggle="tooltip" data-original-title="租赁历史"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                }
                if(in_array('1105',$_SESSION['user_level'])){
                $str .= '<a href="#" class="edit" data-toggle="tooltip" data-original-title="修改"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                }
                if(in_array('1104',$_SESSION['user_level'])){
                $str .= '<a href="#" class="del" data-toggle="tooltip" data-original-title="删除"><i class="fa fa-trash"></i></a>  &nbsp;&nbsp;';
                }
                $str .= '</td>';
                $str .= '</tr>';
            }
         }else{
            $str .= '<tr style="width:100%;text-align:center;color:red;"><td colspan="12">暂无数据！</td></tr>';
         }
         return $str;
    }

    public function createArticle()
    {
    	$data['modules'] = $this->module->getNavModules();
    	$this->load->view('admin/newblog',$data);
    }

    public function insertArticle()
    {
    	//表单验证
    	$module_id_name = explode('-',$this->input->post('module_id_name'));
    	$data['module_id'] = $module_id_name[0];//已选的模型id
    	$data['module_name'] = $module_id_name[1];//已选的模型名称
    	$data['tag_ids'] = empty($this->input->post('tag_ids'))?[]:$this->input->post('tag_ids');//已选的标签id列表
    	$data['tagnames'] = empty($this->input->post('tagnames'))?[]:$this->input->post('tagnames');//打算新增的标签名称列表
    	$data['title'] = trim($this->input->post('title'));
    	$data['remark'] = trim($this->input->post('remark'));
    	$data['content'] = trim($this->input->post('content'));
    	$res = $this->article->insertArticle($data);
    	print_r($data);exit;
    }
}