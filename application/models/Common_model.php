<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 公共模型
*/
class Common_model extends CI_Model
{

	/**
     * 创建树形结构
     * @param  [type] $data      [description]
     * @param  [type] $parentid [description]
     * @return [type]            [description]
     */
    public function getTree($data,$parentid=0){
        $result= array();//结果数组
        $len = 0;
        for($i=0;$i<count($data);$i++){ 
        	if($data[$i]->pid == $parentid){
    			$result[$len] = $data[$i];
	            $children = $this->getTree($data,$data[$i]->id);
	            if(count($children)>0){
	                $result[$len]->children = $children;
	            }
            }
            $len++;            
        }
        return $result;
    }

    /**
     * 返回访问者操作信息，浏览器、 浏览器版本信息
     * @return [type] [description]
     */
	public function getAccessInfo()
	{
		$result['platform'] = $this->agent->platform();
        if ($this->agent->is_browser())
		{
			$result['browser'] = $this->agent->browser();
			$result['version'] = $this->agent->version();
		}
		elseif ($this->agent->is_mobile())
		{
			$result['browser'] = $this->agent->mobile();
			$result['version'] = '';
		}
		else
		{
			$result['browser'] = $result['version'] = '';
		}
		return $result;
	}
}