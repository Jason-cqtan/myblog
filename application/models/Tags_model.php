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
    
}