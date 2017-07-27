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


    public function getArticles($data)
    {
    	$moduleids = $data['moduleids'];
    	$tagids = $data['tagids'];
    	$title = $data['title'];
    	$create_time = $data['create_time'];
        $sql = "SELECT $fields FROM $tablel  LEFT JOIN $tabler ON $where ORDER BY $orderby LIMIT $limit ";
    }

    public function insertArticle($data)
    {
    	//有新的标签，需要新增标签并使用新增的标签id绑定
    	//截取内容一部分(开始到第10个</p>)作为简介
    	////返回字符串中的前255字符串长度的字符作为简介
    	$content_01 = $data["content"];//从数据库获取富文本content
		$content_02 = htmlspecialchars_decode($content_01);//把一些预定义的 HTML 实体转换为字符
		$content_03 = str_replace("&nbsp;","",$content_02);//将空格替换成空
		$contents = strip_tags($content_03);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
		$brief = mb_substr($contents, 0, 255,"utf-8");
    	//获取ip所在的地址、平台信息、浏览器信息
    	$accessinfo = $this->common->getAccessInfo();
    	$data = array(
		    'module_id' => $data['module_id'],
		    'module_name' => $data['module_name'],
		    'user_id' => $_SESSION['user_id'],
		    'monthy' => date('Y-m'),
		    'title' => $data['title'],
		    'brief' => $brief,
		    'create_time' => time(),
		    'platform' =>  $accessinfo['platform'],
		    'browserdesc' => $accessinfo['browser'].' '.$accessinfo ['version'],
		    'ipaddress' => getipaddress()
		);
		$this->db->trans_start();//开始事务
		$sql = $this->db->set($data)->get_compiled_insert('article');
		echo $sql;exit;
		$this->db->insert('article', $data);//插入基本表
		$res = $this->db->call_function('insert_id');
		print_r($res);exit;
		$this->db->trans_complete();//结束事务
		//article_has_modules、article_has_tags表插入数据
    	$data0 = array(
		    'module_id' => $data['mudule_id'],
		    'article_id' => 'My Name',
		);
		$this->db->insert('article_has_modules', $data0);
		$data1 = array(
		    'tag_id' => '',
		    'article_id' => 'My Name',
		);
		$this->db->insert('article_has_tags', $data0);
		
    }
}