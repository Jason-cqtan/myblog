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
        $this->load->model('Article_model','article');
        $this->load->model('Module_model','module');
        $this->load->model('Tags_model','tag');
        $this->load->helper('bootpagination');
	}
    
    /**
     * 文章列表
     * @return [type] [description]
     */
	public function allarticle()
	{
		$data['modules'] = $this->module->getNavModuleTags();
        //默认显示10条文章列表
        $data['page_size'] = 10;//每页显示几条
        $data['page_index'] = (!empty($this->uri->segment(4)))?(int)$this->uri->segment(4):1;//当前第几页
        $res = $this->article->getArticles($data);
        // print_r($res);exit;
        $data['total_page'] = $res['total_page'];//总页数
        $data['totalnum'] = $res['total_count'];//总条数
        $data['pagestr'] = bootpagination($data['page_index'],$data['total_page'],3);//分页
        $data['list'] = $res['data'];
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

    /**
     * 根据模块id获取标签
     * @return [type] [description]
     */
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
		$data['page_index'] = (int)$this->input->post('page_index')<=0?1:(int)$this->input->post('page_index');
        $data['page_size'] = (int)$this->input->post('page_size');      
        $data['title'] = empty($this->input->post('title'))?"":$this->input->post('title');
        $data['module_ids'] = empty($this->input->post('module_ids'))?[]:$this->input->post('module_ids');
        $data['tag_ids'] = empty($this->input->post('tag_ids'))?[]:$this->input->post('tag_ids');
        $data['create_time'] = empty($this->input->post('create_time'))?"":$this->input->post('create_time');
        $res = $this->article->getArticles($data);
        $totalnum = $res['total_count'];//(int)$res->count;//总条数
        $total_page = $res['total_page'];
        $pagestr = bootpagination($data['page_index'],$total_page,3);//分页
        $statistics = array('currentpage'=>$data['page_index'],'total_page'=>$total_page,'totalnum'=>$totalnum);
        $ajaxcontent = $this->AjaxHtmlFormat($res['data']);
        echo json_encode(array('status'=>'ok','list'=>$ajaxcontent,'pagestr'=>$pagestr,'statistics'=>$statistics));
        exit;
	}

	/**
     * 表体html文章列表
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
                $str .= '<td>'.$item->tag_names.'</td>';
                $str .= '<td>'.$item->title.'</td>';
                $str .= '<td>'.$item->remark.'</td>';
                $str .= '<td>'.date("Y-m-d h:i:s",$item->create_time).'</td>';
                $str .= '<td>'.date("Y-m-d h:i:s",$item->update_time).'</td>';
                $str .= '<td data-id="'.$item->id.'">';
                $str .= '<a href="#">置顶</a>
                      <a href="#">修改</a>
                      <a href="#" class="del">移至回收站</a>';
                $str .= '</td>';
                $str .= '</tr>';
            }
         }else{
            $str .= '<tr style="width:100%;text-align:center;color:red;"><td colspan="9">暂无数据！</td></tr>';
         }
         return $str;
    }

    public function getRecycle()
    {
        $data['page_index'] = (int)$this->input->post('page_index')<=0?1:(int)$this->input->post('page_index');
        $data['page_size'] = (int)$this->input->post('page_size');      
        $data['title'] = empty($this->input->post('title'))?"":$this->input->post('title');
        $data['module_ids'] = empty($this->input->post('module_ids'))?[]:$this->input->post('module_ids');
        $data['tag_ids'] = empty($this->input->post('tag_ids'))?[]:$this->input->post('tag_ids');
        $data['create_time'] = empty($this->input->post('create_time'))?"":$this->input->post('create_time');
        $data['deleted'] = 1;
        $res = $this->article->getArticles($data);
        $totalnum = $res['total_count'];//(int)$res->count;//总条数
        $total_page = $res['total_page'];
        $pagestr = bootpagination($data['page_index'],$total_page,3);//分页
        $statistics = array('currentpage'=>$data['page_index'],'total_page'=>$total_page,'totalnum'=>$totalnum);
        $ajaxcontent = $this->AjaxHtmlFormat2($res['data']);
        echo json_encode(array('status'=>'ok','list'=>$ajaxcontent,'pagestr'=>$pagestr,'statistics'=>$statistics));
        exit;
    }

    /**
     * 表体html文章列表
     * @param array $data [description]
     */
    private function AjaxHtmlFormat2($data = array())
    {
         $str = '';
         if($data){
            foreach ($data as $key => $item) {
                $str .= '<tr>';
                $str .= '<td class="text-center"><input type="checkbox" name="ids[]" value="'.$item->id.'"></td>';
                $str .= '<td>'.$item->id.'</td>';                               
                $str .= '<td>'.$item->module_name.'</td>';
                $str .= '<td>'.$item->tag_names.'</td>';
                $str .= '<td>'.$item->title.'</td>';
                $str .= '<td>'.$item->remark.'</td>';
                $str .= '<td>'.date("Y-m-d h:i:s",$item->create_time).'</td>';
                $str .= '<td>'.date("Y-m-d h:i:s",$item->update_time).'</td>';
                $str .= '<td data-id="'.$item->id.'">';
                $str .= '
                      <a href="#" class="recycle">还原</a>
                      <a href="#" class="realdel">彻底删除</a>';
                $str .= '</td>';
                $str .= '</tr>';
            }
         }else{
            $str .= '<tr style="width:100%;text-align:center;color:red;"><td colspan="9">暂无数据！</td></tr>';
         }
         return $str;
    }
    
    /**
     * 新建文章视图显示
     * @return [type] [description]
     */
    public function createArticle()
    {
    	$data['modules'] = $this->module->getNavModuleTags();
    	$this->load->view('admin/newblog',$data);
    }
    
    /**
     * 插入文章
     * @return [type] [description]
     */
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
    	if(!is_array($res)){
            echo json_encode(array('status'=>0,'url'=>'allarticle'));
            exit;
        }else{
            $error = $res['message'];
            echo json_encode(array('status'=>1,'msg'=>$error));
            exit;
        }
    }
    
    /**
     * 预览
     * @return [type] [description]
     */
    public function review()
    {
        $module_id_name = explode('-',$this->input->post('module_id_name'));
        $data['module_id'] = $module_id_name[0];//已选的模型id
        $data['module_name'] = $module_id_name[1];//已选的模型名称
        $data['tag_ids'] = empty($this->input->post('tag_ids'))?[]:$this->input->post('tag_ids');//已选的标签id列表
        $data['tagnames'] = empty($this->input->post('tagnames'))?[]:$this->input->post('tagnames');//打算新增的标签名称列表
        $data['title'] = trim($this->input->post('title'));
        $data['remark'] = trim($this->input->post('remark'));
        $data['content'] = trim($this->input->post('content'));
        $this->load->view('admin/review',$data);

    }

    /**
     * 移至回收站
     * @return [type] [description]
     */
    public function recycleArticle()
    {
        $id = $this->input->post('id');
        $res = $this->article->recycleArticle($id);
        if($res){
            echo json_encode(array('status'=>1,'msg'=>$res['message']));
            exit;
        }else{
            echo json_encode(array('status'=>0));
            exit;
        }
    }

     /**
     * 批量移至回收站
     * @return [type] [description]
     */
    public function recycleManyArticle()
    {
        $error = '';
        $ids = $this->input->post('ids');
        foreach ($ids as $key => $id) {
            $res = $this->article->recycleArticle($id);
            if($res){
                $error .= $res['message'];
                break;
            }
        }
        if(strlen($error) > 1){
            echo json_encode(array('status'=>1,'msg'=>$error));
            exit;
        }else{
            echo json_encode(array('status'=>0));
            exit;
        }
    }

    /**
     * 彻底删除
     * @return [type] [description]
     */
    public function delArticle()
    {
        $id = $this->input->post('id');
        $res = $this->article->delArticle($id);
        if($res){
            echo json_encode(array('status'=>1,'msg'=>$res['message']));
            exit;
        }else{
            echo json_encode(array('status'=>0));
            exit;
        }
    }

     /**
     * 批量彻底删除
     * @return [type] [description]
     */
    public function delManyArticle()
    {
        $error = '';
        $ids = $this->input->post('ids');
        foreach ($ids as $key => $id) {
            $res = $this->article->delArticle($id);
            if($res){
                $error .= $res['message'];
                break;
            }
        }
        if(strlen($error) > 1){
            echo json_encode(array('status'=>1,'msg'=>$error));
            exit;
        }else{
            echo json_encode(array('status'=>0));
            exit;
        }
    }

    /**
     * 还原
     * @return [type] [description]
     */
    public function restoreArticle()
    {
        $id = $this->input->post('id');
        $res = $this->article->restoreArticle($id);
        if($res){
            echo json_encode(array('status'=>1,'msg'=>$res['message']));
            exit;
        }else{
            echo json_encode(array('status'=>0));
            exit;
        }
    }




}