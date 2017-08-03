<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 文章列表
*/
class Article_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','common');
	}

    /**
     * 获取文章
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function getArticles($data)
    {
    	$data = [
            'page_index' => isset($data['page_index'])?(int)$data['page_index']:1,
            'page_size' => isset($data['page_size'])?(int)$data['page_size']:10,
            'title' => isset($data['title'])?$data['title']:'',
            'monthly' => isset($data['monthly'])?$data['monthly']:'',
            'module_ids' => isset($data['module_ids'])?$data['module_ids']:[],
            'tag_ids' => isset($data['tag_ids'])?$data['tag_ids']:[],
            'create_time' => (isset($data['create_time']) && strlen(trim($data['create_time'])) >= 1)?strtotime($data['create_time']):strtotime('2015-01-01'),
    	];
    	$start_count = ($data['page_index']-1)*$data['page_size'];
    	$this->db->start_cache();
    	$this->db->from("article as a");//文章主表
    	if(strlen(trim($data['title'])) >= 1){
    		$this->db->like('title', $data['title']);
    	}
    	if(strlen(trim($data['monthly']))){
    		$this->db->where('monthly', $data['monthly']);
    	}
    	if(!empty($data['module_ids'])){
            $this->db->where_in('a.module_id', $data['module_ids']);
    	}
    	if(!empty($data['tag_ids'])){//再去查tags 
    		$ids = join(',',$data['tag_ids']);
            $sql = "SELECT DISTINCT article_id FROM `article_has_tags` WHERE `tag_id` IN('{$ids}')";
    		$this->db->where_in('id', $sql,false);
    	}
    	$this->db->stop_cache();
    	$pagingsql = $this->db->where('a.deleted',0)
		    	         ->where('a.create_time >= ', $data['create_time'])
		    	         ->order_by('a.id', 'DESC')
		                 ->limit($data['page_size'],$start_count)
		                 ->get_compiled_select();
		$totalsql = $this->db->where('a.deleted',0)
		    	         ->where('a.create_time >= ', $data['create_time'])
		    	         ->order_by('a.id', 'DESC')
		    	         ->get_compiled_select();
		$res = $this->db->query($pagingsql)->result();
		$total_count = $this->db->query($totalsql)->num_rows();
        return [
            'total_count'=>$total_count,
            'total_page' => ceil($total_count/$data['page_size']),
            'data' => $res
        ];    
    }

    
    /**
     * 插入文章
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function insertArticle($data)
    {
    	//有新的标签，需要新增标签并使用新增的标签id绑定
    	//截取内容一部分(开始到第10个</p>)作为简介
    	////返回字符串中的前100字符串长度的字符作为简介
    	$content_01 = $data["content"];//从数据库获取富文本content
		$content_02 = htmlspecialchars_decode($content_01);//把一些预定义的 HTML 实体转换为字符
		$content_03 = str_replace("&nbsp;","",$content_02);//将空格替换成空
		$contents = strip_tags($content_03);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
		$brief = mb_substr($contents, 0, 100,"utf-8");
    	//获取ip所在的地址、平台信息、浏览器信息
    	$accessinfo = $this->common->getAccessInfo();
    	$month = date('Y-m');
    	$base = array(
		    'module_id' => $data['module_id'],
		    'module_name' => $data['module_name'],
		    'user_id' => $_SESSION['user_id'],
		    'monthy' => $month,
		    'title' => $data['title'],
		    'brief' => $brief,
		    'remark' => $data['remark'],
		    'create_time' => time(),
		    'update_time' => time(),
		    'platform' =>  $accessinfo['platform'],
		    'browserdesc' => $accessinfo['browser'].' '.substr($accessinfo ['version'],0,stripos($accessinfo ['version'],'.')+2),
		    'ipaddress' => getipaddress()
		);
		if(!$this->db->insert('article', $base)){//插入基本表
            return $this->db->error();
		}
		$articleid = $this->db->insert_id();
		//插入主要内容
		$articlecontent = array(
		    'content' => $data["content"],
		    'article_id' => $articleid
		);
		$this->db->insert('content', $articlecontent);
		$tag_ids = $tag_names = '';
		//article_has_modules表插入数据
		if(!$this->db->insert('article_has_modules', ['module_id'=>$data['module_id'],'article_id'=>$articleid])){
			return $this->db->error();
		}
		//article_has_tags表插入数据
		if(!empty($data['tag_ids'])){//选了tag,组装成1,2,名称tag1,tag2，然后插入中间表
			$tag_ids .= join(',',$data['tag_ids']);
			$num = count($data['tag_ids']);
			foreach ($data['tag_ids'] as $key => $tagid) {
				//通过id查询tag名称
				$name = $this->db->where('id', $tagid)->get('tags')->result()[0]->name;
				$tag_names .= ($key+1 <$num)?$name.',':$name;				
				if(!$this->db->insert('article_has_tags', ['tag_id'=>$tagid,'article_id'=>$articleid])){
					return $this->db->error();
				}
				
			}
		}
		if(!empty($data['tagnames'])){//新增标签，使用新增后的id再绑定
			$tag_names .= (strlen($tag_names) >= 1)?','.join(',',$data['tagnames']):join(',',$data['tagnames']);
			$num = count($data['tagnames']);
			foreach ($data['tagnames'] as $key => $tag) {
				//先查询有没有，有使用已经存在id
				$tag = trim($tag);
				$exsit = $this->db->where(['name'=>$tag,'module_id'=>$data['module_id']])->limit(1)->get('tags')->result();
				if($exsit){
					$tagid = $exsit[0]->id;
					if($key+1 < $num){
						$tag_ids .= (strlen($tag_ids) >= 1)?','.$tagid.',':$tagid.',';
					}else{
						$tag_ids .= (strlen($tag_ids) >= 1)?','.$tagid:$tagid;
					}
					if(!$this->db->insert('article_has_tags', ['tag_id'=>$tagid,'article_id'=>$articleid])){
						return $this->db->error();
					}
				}else{
					if(!$this->db->insert('tags', ['name'=>$tag,'module_id'=>$data['module_id']])){
						return $this->db->error();
					}
					$tagid = $this->db->insert_id();
					if($key+1 < $num){
						$tag_ids .= (strlen($tag_ids) >= 1)?','.$tagid.',':$tagid.',';
					}else{
						$tag_ids .= (strlen($tag_ids) >= 1)?','.$tagid:$tagid;
					}
					if(!$this->db->insert('article_has_tags', ['tag_id'=>$tagid,'article_id'=>$articleid])){
						return $this->db->error();
					}
				}
				
			}
		}
		if(strlen($tag_ids) >= 1){//有标签，更新
            $data = array(
			    'tag_ids' => $tag_ids,
			    'tag_names' => $tag_names
			);
			$this->db->where('id', $articleid);
			$this->db->update('article', $data);
		}
		//插入月统计，先查询是否已经存在，有加1，否新增并加1
		$exsitmon = $this->db->where(['month'=>$month])->limit(1)->get('monthly')->result();
		if($exsitmon){
			$this->db->set('num', 'num+1', FALSE);
			$this->db->where('id', $exsitmon[0]->id);
			$this->db->update('monthly');
		}else{
            if(!$this->db->insert('monthly', ['month'=>$month,'num'=>1])){
            	return $this->db->error();
            }
		}
		return true;
		
    }


}