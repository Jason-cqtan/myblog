<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 导航模块
*/
class Module_model extends CI_Model
{
	/**
	 * 获取文章模块标签
	 * @return [type] [description]
	 */
    public function getNavModuleTags()
    {
    	$query = $this->db->where(array('is_tag' => 1, 'deleted' => 0,'pid !='=>0))->get('module');
    	return $query->result();        
    }

    /**
     * 获取前台导航模块
     * @return [type] [description]
     */
    public function getNavModules()
    {
        $query =  $this->db->where('is_tag !=', 0)->where('deleted',0)->or_where('is_nav !=', 0)->get('module');
        return $query->result();        
    }


    
    /**
     * 获取所有模块
     * @return [type] [description]
     */
    public function getAllModule()
    {
    	return $this->db->where('deleted','0')->get('module')->result();
    }
    
    /**
     * 获取网站所属模块列表
     * @return [type] [description]
     */
    public function getWebModules()
    {
        $this->db->where('deleted', 0);
        $this->db->where('is_nav', 0);
        $this->db->where('is_tag', 0);
        return $this->db->get('module')->result();
    }
    
    /**
     * 获取模块父级
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getModuleParent($id)
    {
        $this->db->where('id', $id);
        $module =  $this->db->get('module')->result()[0];
        if($module->pid == 0){
            return [];
        }else{
            $sql = 'select * from module where id = '.$module->pid;
            return $this->db->query($sql)->result();
        }
    }

    public function getCrumbsByModulename($modulename)
    {
        $modulename = trim(urldecode($modulename));
        $sql = 'select * from module where is_tag = 1 and name = "'.$modulename.'"';
        $module = $this->db->query($sql)->row();
        if($module->pid == 0){
            return [$modulename];
        }else{
            $sql = 'select * from module where id = '.$module->pid;
            $parent = $this->db->query($sql)->row();
            return [$parent->name,$modulename];
        }
    }
    

    /**
     * 获取单个模块
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getModule($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('module')->result()[0];
    }

    public function insertModule($data)
    {
    	$data = array(
		    'name' => $data['name'],
		    'is_nav' => $data['is_nav'],
		    'is_tag' => $data['is_tag'],
		    'pid' => (int)$data['pid']
		);
		if(!$this->db->insert('module', $data))
		{
			return $this->db->error();
		}else{
			return [];
		}
    }

    public function delModule($id)
    {
    	$data = array(
		    'deleted' => 1
		);
		$this->db->where('id', $id);
        if(!$this->db->update('module', $data)){
        	return $this->db->error();
        }else{
        	return [];
        }
    }

    public function editModule($data)
    {
    	$this->db->set('name', $data['name']);
		$this->db->where('id', $data['id']);
        if(!$this->db->update('module')){
        	return $this->db->error();
        }else{
        	return [];
        }
    }
}