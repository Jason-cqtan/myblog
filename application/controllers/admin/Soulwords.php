<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 心灵鸡汤
*/
class Soulwords extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','common');
        $this->load->model('Soul_model','soul');
        $this->load->helper('bootpagination');
	}

	public function index()
	{
		//默认显示10条列表
        $data['page_size'] = 10;//每页显示几条
        $data['page_index'] = (!empty($this->uri->segment(4)))?(int)$this->uri->segment(4):1;//当前第几页
        $res = $this->soul->getSouls($data);
        $data['total_page'] = $res['total_page'];//总页数
        $data['totalnum'] = $res['total_count'];//总条数
        $data['pagestr'] = bootpagination($data['page_index'],$data['total_page'],3);//分页
        $data['list'] = $res['data'];
		$this->load->view('admin/soulwords',$data);
	}
	 /**
     * ajax获取文章列表
     * @return [type] [description]
     */
	public function ajaxGetlist()
	{
		$data['page_index'] = (int)$this->input->post('page_index')<=0?1:(int)$this->input->post('page_index');
        $data['page_size'] = (int)$this->input->post('page_size');
        $res = $this->soul->getSouls($data);
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
                $str .= '<td class="content">'.$item->content.'</td>';
                $str .= '<td>'.date("Y-m-d h:i:s",$item->create_time).'</td>';
                $str .= '<td data-id="'.$item->id.'">';
                $str .= '<a href="#" class="edit">修改</a>
                      <a href="#" class="del">删除</a>';
                $str .= '</td>';
                $str .= '</tr>';
            }
         }else{
            $str .= '<tr style="width:100%;text-align:center;color:red;"><td colspan="5">暂无数据！</td></tr>';
         }
         return $str;
    }

    /**
     * 插入
     * @return [type] [description]
     */
	public function insertSoul()
	{
		$content = $this->input->post('content');
		$res = $this->soul->insertSoul($content);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}
    
    /**
     * 删除
     * @return [type] [description]
     */
	public function delSoul()
	{
		$id = $this->input->post('id');
		$res = $this->soul->delSoul($id);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}

	 /**
     * 批量删除
     * @return [type] [description]
     */
	public function delManySoul()
	{
		$error = '';
		$ids = $this->input->post('ids');
		foreach ($ids as $key => $id) {
			$res = $this->soul->delSoul($id);
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
     * 获取信息
     * @return [type] [description]
     */
	public function getSoul()
	{
		$id = $this->input->post('id');
		$res = $this->soul->getSoul($id);
		echo json_encode(array('data'=>$res));exit;
	}
	/**
	 * 修改网站
	 * @return [type] [description]
	 */
	public function editSoul()
	{
		$data['id'] = $this->input->post('id');
		$data['content'] = $this->input->post('content');
		$res = $this->soul->editSoul($data);
		if($res){
			echo json_encode(array('status'=>1,'msg'=>$res['message']));
			exit;
		}else{
			echo json_encode(array('status'=>0));
			exit;
		}
	}
}