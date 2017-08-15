<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 标签模型
*/
class Tags_model extends CI_Model
{
	/**
	 * 查根据模型id列表获取标签
	 * @param  array  $module_ids [description]
	 * @return [type]             [description]
	 */
    public function getTagsBymoduleids($module_ids = [])
    {
        $query = $this->db->where_in('module_id',$module_ids)->get('tags');
        return $query->result();        
    }
    
    /**
     * 根据模型id获取标签列表
     * @param  [type] $moduleid [description]
     * @return [type]           [description]
     */
    public function getTagsBymoduleid($moduleid){
        $query = $this->db->where('module_id',$moduleid)->where('deleted','0')->get('tags');
        return $query->result();
    }

    public function insertTag($data)
    {
    	$data = array(
		    'name' => $data['name'],
		    'module_id' => $data['module_id']
		);
        if(!$this->db->insert('tags', $data))
		{
			return $this->db->error();
		}else{
			return [];
		}
    }

    public function delTag($id)
    {
    	$data = array(
		    'deleted' => 1
		);
		$this->db->where('id', $id);
        if(!$this->db->update('tags', $data)){
        	return $this->db->error();
        }else{
        	return [];
        }
    }

    public function editTag($data)
    {
    	$this->db->set('name', $data['name']);
		$this->db->where('id', $data['id']);
        if(!$this->db->update('tags')){
        	return $this->db->error();
        }else{
        	return [];
        }
    }

    public function getTagidByName($name)
    {
        $sql = "select * from `tags` where `name` ='$name'";
        $res = $this->db->query($sql)->row();
        return $res;
    }

    public function getModuleidByTagid($tagid)
    {
        $sql = "select * from `tags` where `id` ='$tagid'";
        $res = $this->db->query($sql)->row();
        return $res->module_id;
    }
    
}