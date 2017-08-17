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
        $this->load->model('Tags_model','tag');
        $this->load->model("Soul_model",'soul');
        $this->load->helper('bootpagination');
	}
    
    /**
     * 首页展示
     * @return [type] [description]
     */
	public function index()
	{
        if(!isset($_SESSION['navs'])){
            $navmodules = $this->module->getNavModules();
            $data['navmodules'] = $this->common->getTree($navmodules,0);
            $_SESSION['navs'] = $data['navmodules'];//导航保存session
        }
        //默认显示10条文章列表
        $data['page_size'] = 10;//每页显示几条
        $data['page_index'] = (!empty($this->uri->segment(4)))?(int)$this->uri->segment(4):1;//当前第几页
        $res = $this->article->getArticles($data);
        $data['total_page'] = $res['total_page'];//总页数
        $data['totalnum'] = $res['total_count'];//总条数
        $data['pagestr'] = bootpagination($data['page_index'],$data['total_page'],3);//分页
        $data['list'] = $res['data'];
        //热门文章
        $data['hots'] = $this->article->getHots();
        //随机文章
        $data['rands'] = $this->article->getRandArticle();
        //心灵鸡汤
        $data['soul'] = $this->soul->getRand();
		$this->load->view('home/index',$data);
	}
    /**
     * 所有文章ajax获取列表
     * @return [type] [description]
     */
    public function ajaxGetArticles()
    {
        $data['page_index'] = (int)$this->input->post('page_index')==0?1:(int)$this->input->post('page_index');
        $data['page_size'] = (int)$this->input->post('page_size'); 
        $res = $this->article->getArticles($data);
        //var_dump($res);
        $totalnum = $res['total_count'];//(int)$res->count;//总条数
        $total_page = $res['total_page'];
        $pagestr = bootpagination($data['page_index'],$total_page,3);//分页
        $statistics = array('currentpage'=>$data['page_index'],'total_page'=>$total_page,'totalnum'=>$totalnum);
        $ajaxcontent = $this->AjaxHtmlFormat($res['data']);
        echo json_encode(array('list'=>$ajaxcontent,'pagestr'=>$pagestr,'statistics'=>$statistics));
        exit;
    }

    /**
     * 表体html文件格式化，公共
     * @param array $data [description]
     */
    private function AjaxHtmlFormat($data = array())
    {
         $str = '';
         if($data){
            foreach ($data as $key => $item) {    
                $str .= '<div class="box box-solid">';
                $str .= '<div class="box-header with-border">';
                $str .= '<h3 class="box-title"><a href="'.site_url('home/moduleArticle/'.$item->module_name).'">'.$item->module_name.'</a></h3>';
                $str .= '</div>';
                $str .= '<div class="box-body">';
                $str .= '<h3><a href="'.site_url('info/index/'.$item->id).'" class="title">'.$item->title.'</a></h3>';
                $str .= '<h4>';
                if(strlen($item->tag_ids) > 1){
                    $needarr = [];
                    $tag_name = explode(',',$item->tag_names);
                    $tag_id = explode(',',$item->tag_ids);
                    foreach ($tag_name as $key => $tag) {
                        $needarr[] = (object)array(
                            'id' =>  $tag_id[$key],
                            'name' => $tag
                        );
                    }
                    foreach ($needarr as $key => $tag) {
                        $str .= '  <a type="button" href="'.site_url('home/tagArticle/'.$tag->name).'" class="btn btn-xs bg-gray">'.$tag->name.'</a>';
                    }
                }
                $str .= '<span><small class="text-gray">  '.$item->remark.'</small></span>';
                $str .= '</h4>';
                $str .= $item->brief;
                $str .= '<a type="button" href="'.site_url('info/index/'.$item->id).'" class="btn btn-primary btn-sm">查看详情&gt;&gt;</a>';
                $str .= '</div>';
                $str .= '<div class="box-footer">';
                $str .= '<span data-toggle="tooltip" title="" data-original-title="'.date("Y-m-d H:i",$item->create_time).'"><i class="fa fa-calendar"></i> '.$this->common->formatTime($item->create_time).'</span>';
                $str .= '<span><i class="fa fa-eye"></i> ( '.$item->views.' )</span>';
                $str .= '<a href="#"><span><i class="fa fa-comment"></i> ( 0 )</span></a>';
                $str .= '</div>';
                $str .= '</div>';
            }
         }else{
            $str .= '<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> 提示!</h4>
                        该分类下暂无数据，查看其它的吧:>
                    </div>';
         }
         return $str;
    }
    
    
    /**
     * 获取随机文章
     * @return [type] [description]
     */
    public function getRand()
    {
        $res = $this->article->getRandArticle();
        echo json_encode(array('list'=>$res));
        exit;    
    }
    
    /**
     * 记录点击次数
     * @return [type] [description]
     */
    public function getclicknum()
    {
        echo json_encode(array('num'=>$_SESSION['randsoulnum'],'msg'=>'鸡汤看这么多干嘛，撸代码去！'));
        exit;
    }
    
    /**
     * 获取心灵鸡汤
     * @return [type] [description]
     */
    public function getSoul()
    {
        $_SESSION['randsoulnum'] = isset($_SESSION['randsoulnum'])?$_SESSION['randsoulnum']+=1:1;
        $res = $this->soul->getRand();
        echo json_encode(array('status'=>0,'word'=>$res));
        exit;
    }
    
    /**
     * 按月统计
     * @return [type] [description]
     */
    public function getStatisticsBymonth()
    {
         $res = $this->article->getMonthy();
         echo json_encode(array('list'=>$res));exit;
    }
    
    /**
     * 标签统计
     * @return [type] [description]
     */
    public function getStatisticsByTags()
    {
        $res = $this->article->getStatisticsTags();
        echo json_encode(array('list'=>$res));exit;
    }
    
    /**
     * 简单统计
     * @return [type] [description]
     */
    public function getSimpleStatistics()
    {
        $res = $this->article->getSimpleStatistics();
        echo json_encode($res);
        exit;
    }
    
    /**
     * 通过模块获取文章列表
     * @param  [type] $cate [description]
     * @return [type]       [description]
     */
    public function moduleArticle($cate)
    {
        $data['page_index'] = empty($this->uri->segment(4))?1:(int)$this->uri->segment(4);
        if($data['page_index'] < 1){
            $data['page_index'] = 1;
        }
        $data['module_name'] = $cate;
        $res = $this->article->getArticles($data);
        // print_r($res);exit;
        $data['total_page'] = $res['total_page'];//总页数
        $data['totalnum'] = $res['total_count'];//总条数
        $data['pagestr'] = bootpagination($data['page_index'],$data['total_page'],3);//分页
        $data['list'] = $res['data'];
        //面包屑
        $data['crumbs'] = $this->module->getCrumbsByModulename($cate);
        //热门文章
        $data['hots'] = $this->article->getHots();
        //随机文章
        $data['rands'] = $this->article->getRandArticle();
        //心灵鸡汤
        $data['soul'] = $this->soul->getRand();
        $this->load->view('home/modulelist',$data);
    }
    
    /**
     * 通过模块ajax获取文章
     * @return [type] [description]
     */
    public function ajaxGetModuleArticles()
    {
        $data['page_index'] = (int)$this->input->post('page_index')==0?1:(int)$this->input->post('page_index');
        $data['page_size'] = (int)$this->input->post('page_size'); 
        $data['module_name'] = $this->input->post('module_name');
        $res = $this->article->getArticles($data);
        //var_dump($res);
        $totalnum = $res['total_count'];//(int)$res->count;//总条数
        $total_page = $res['total_page'];
        $pagestr = bootpagination($data['page_index'],$total_page,3);//分页
        $statistics = array('currentpage'=>$data['page_index'],'total_page'=>$total_page,'totalnum'=>$totalnum);
        $ajaxcontent = $this->AjaxHtmlFormat($res['data']);
        echo json_encode(array('list'=>$ajaxcontent,'pagestr'=>$pagestr,'statistics'=>$statistics));
        exit;
    }


    /**
     * 通过标签获取文章列表
     * @param  [type] $cate [description]
     * @return [type]       [description]
     */
    public function tagArticle($tag)
    {
        $tag = urldecode(trim($tag));
        $data['page_index'] = empty($this->uri->segment(4))?1:(int)$this->uri->segment(4);
        if($data['page_index'] < 1){
            $data['page_index'] = 1;
        }
        //获取tag_ids
        $tagid = (int)$this->tag->getTagidByName($tag)->id;
        $data['tag_ids'] = [$tagid];
        $res = $this->article->getArticles($data);
        $data['total_page'] = $res['total_page'];//总页数
        $data['totalnum'] = $res['total_count'];//总条数
        $data['pagestr'] = bootpagination($data['page_index'],$data['total_page'],3);//分页
        $data['list'] = $res['data'];
        //热门文章
        $data['hots'] = $this->article->getHots();
        //推荐文章
        $params['page_size'] = 5;
        $params['module_ids'] = [$this->tag->getModuleidByTagid($tagid)];
        $data['recommend'] = $this->article->getArticles($params)['data'];
        //心灵鸡汤
        $data['soul'] = $this->soul->getRand();
        $data['tag_name'] = $tag;
        // print_r($data);exit;
        $this->load->view('home/taglist',$data);
    }
    
    /**
     * 通过标签ajax获取文章
     * @return [type] [description]
     */
    public function ajaxGetTagArticles()
    {
        $data['page_index'] = (int)$this->input->post('page_index')==0?1:(int)$this->input->post('page_index');
        $data['page_size'] = (int)$this->input->post('page_size'); 
        $data['tag_ids'] = $this->input->post('tag_ids');
        $res = $this->article->getArticles($data);
        //var_dump($res);
        $totalnum = $res['total_count'];//(int)$res->count;//总条数
        $total_page = $res['total_page'];
        $pagestr = bootpagination($data['page_index'],$total_page,3);//分页
        $statistics = array('currentpage'=>$data['page_index'],'total_page'=>$total_page,'totalnum'=>$totalnum);
        $ajaxcontent = $this->AjaxHtmlFormat($res['data']);
        echo json_encode(array('list'=>$ajaxcontent,'pagestr'=>$pagestr,'statistics'=>$statistics));
        exit;
    }
    
    /**
     * 通过标签id获取获取推荐列表
     * @return [type] [description]
     */
    public function ajaxGetRecommendByTagid()
    {
        $tagid = (int)$this->input->post('tag_ids')[0];
        $data['page_index'] = (int)$this->input->post('page_index')==0?1:(int)$this->input->post('page_index');
        $data['page_size'] = 5;
        $data['module_ids'] = [$this->tag->getModuleidByTagid($tagid)];
        $res = $this->article->getArticles($data);
        echo json_encode(array('list'=>$res['data']));
        exit;
    }
    
    /**
     * 通过月份获取文章列表
     * @param  [type] $monthly [description]
     * @return [type]          [description]
     */
    public function getMonththArticles($monthly)
    {        
        $monthly = urldecode(trim($monthly));
        $data['page_index'] = empty($this->uri->segment(4))?1:(int)$this->uri->segment(4);
        if($data['page_index'] < 1){
            $data['page_index'] = 1;
        }
        $data['monthly'] = $monthly;
        $res = $this->article->getArticles($data);
        // print_r($res);exit;
        $data['total_page'] = $res['total_page'];//总页数
        $data['totalnum'] = $res['total_count'];//总条数
        $data['pagestr'] = bootpagination($data['page_index'],$data['total_page'],3);//分页
        $data['list'] = $res['data'];
        //热门文章
        $data['hots'] = $this->article->getHots();
        //随机文章
        $data['rands'] = $this->article->getRandArticle();
        //心灵鸡汤
        $data['soul'] = $this->soul->getRand();
        // print_r($data);exit;
        $this->load->view('home/monthlist',$data);
    }
    
    /**
     * 通过月份ajax获取文章列表
     * @return [type] [description]
     */
    public function ajaxGetMonthArticles()
    {
        $data['page_index'] = (int)$this->input->post('page_index')==0?1:(int)$this->input->post('page_index');
        $data['page_size'] = (int)$this->input->post('page_size'); 
        $data['monthly'] = $this->input->post('monthly');
        $res = $this->article->getArticles($data);
        //var_dump($res);
        $totalnum = $res['total_count'];//(int)$res->count;//总条数
        $total_page = $res['total_page'];
        $pagestr = bootpagination($data['page_index'],$total_page,3);//分页
        $statistics = array('currentpage'=>$data['page_index'],'total_page'=>$total_page,'totalnum'=>$totalnum);
        $ajaxcontent = $this->AjaxHtmlFormat($res['data']);
        echo json_encode(array('list'=>$ajaxcontent,'pagestr'=>$pagestr,'statistics'=>$statistics));
        exit;
    }

    
    /**
     * 关于我
     * @return [type] [description]
     */
    public function aboutme()
    {
        $this->load->view('home/aboutme');
    }

    public function search()
    {
        $this->load->view('home/search');
    }


}
