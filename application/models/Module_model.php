<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 导航模块
*/
class Module_model extends CI_Model
{
    public function getNavModules()
    {
    	$query = $this->db->where(array('is_tag' => 1, 'deleted' => 0,'id !='=>1,'pid !='=>0))->get('mudule');
    	return $query->result();        
    }
}