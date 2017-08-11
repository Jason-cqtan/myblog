<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 心灵鸡汤模型
*/
class Soul_model extends CI_Model
{
    public function getSouls($data)
    {
        $data = [
            'page_index' => isset($data['page_index'])?(int)$data['page_index']:1,
            'page_size' => isset($data['page_size'])?(int)$data['page_size']:10
        ];
        $start_count = ($data['page_index']-1)*$data['page_size'];
        $this->db->start_cache();
        $this->db->from("words as a");
        $this->db->stop_cache();
        $pagingsql = $this->db->where('a.deleted',0)
                         ->order_by('a.id', 'DESC')
                         ->limit($data['page_size'],$start_count)
                         ->get_compiled_select();
        $totalsql = $this->db->where('a.deleted',0)
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
     * 插入
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function insertSoul($content)
    {
        $data = array(
            'content' => $content,
            'create_time' => time()
        );
        if(!$this->db->insert('words', $data))
        {
            return $this->db->error();
        }else{
            return [];
        }
    }
    
    /**
     * 删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delSoul($id)
    {
        $data = array(
            'deleted' => 1
        );
        $this->db->where('id', $id);
        if(!$this->db->update('words', $data)){
            return $this->db->error();
        }else{
            return [];
        }
    }

    /**
     * 获取单个
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSoul($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('words')->result()[0];
    }

    public function editSoul($data)
    {
        $this->db->set('content', $data['content']);
        $this->db->where('id', $data['id']);
        if(!$this->db->update('words')){
            return $this->db->error();
        }else{
            return [];
        }
    }
    
    /**
     * 获取随机心灵鸡汤
     * @return [type] [description]
     */
    public function getRand()
    {
        $count = $this->db->count_all('words');
        $randarr = [];
        for ($i=0; $i <= 3; $i++) { 
            $randarr[] = rand(1,$count);
        }
        for ($i=0; $i <= 3; $i++) { 
            $res = $this->db->get_where('words', array('id' => $randarr[$i]))->result();
            if($res[0]->deleted == 0){
                return $res[0];
            }
        }
    }
}