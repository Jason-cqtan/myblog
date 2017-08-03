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
	//格式化友好显示时间
	public function formatTime($time){
	    $now=time();
	    $day=date('Y-m-d',$time);
	    $today=date('Y-m-d');
	    
	    $dayArr=explode('-',$day);
	    $todayArr=explode('-',$today);
	    
	    //距离的天数，这种方法超过30天则不一定准确，但是30天内是准确的，因为一个月可能是30天也可能是31天
	    $days=($todayArr[0]-$dayArr[0])*365+(($todayArr[1]-$dayArr[1])*30)+($todayArr[2]-$dayArr[2]);
	    //距离的秒数
	    $secs=$now-$time;
	    
	    if($todayArr[0]-$dayArr[0]>0 && $days>3){//跨年且超过3天
	        return date('Y-m-d',$time);
	    }else{
	    
	        if($days<1){//今天
	            if($secs<60)return $secs.'秒前';
	            elseif($secs<3600)return floor($secs/60)."分钟前";
	            else return floor($secs/3600)."小时前";
	        }else if($days<2){//昨天
	            $hour=date('h',$time);
	            return "昨天".$hour.'点';
	        }elseif($days<3){//前天
	            $hour=date('h',$time);
	            return "前天".$hour.'点';
	        }else{//三天前
	            return date('m月d号',$time);
	        }
	    }
	}
}