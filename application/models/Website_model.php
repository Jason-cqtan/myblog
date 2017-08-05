<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 标签模型
*/
class Website_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model','common');
        $this->load->model('Module_model','module');
        $this->load->model('Website_model','web');
    }
    /**
     * 后台获取所有优站
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function getWebsites($data)
    {
        $data = [
            'page_index' => isset($data['page_index'])?(int)$data['page_index']:1,
            'page_size' => isset($data['page_size'])?(int)$data['page_size']:10,
            'name' => isset($data['name'])?$data['name']:'',
            'module_ids' => isset($data['module_ids'])?$data['module_ids']:[],
            'create_time' => (isset($data['create_time']) && strlen(trim($data['create_time'])) >= 1)?strtotime($data['create_time']):strtotime('2015-01-01'),
        ];
        $start_count = ($data['page_index']-1)*$data['page_size'];
        $this->db->start_cache();
        $this->db->from("websites as a");
        if(strlen(trim($data['name'])) >= 1){
            $this->db->like('name', $data['name']);
        }
        if(!empty($data['module_ids'])){
            $this->db->where_in('a.module_id', $data['module_ids']);
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
     * 前台获取所有优站
     * @return [type] [description]
     */
    public function homeGettWebsites()
    {
        //根据模块组装数据
        $modules = $this->module->getWebModules();
        $tree =  $this->common->getTree($modules,0);
        $needarr = [];
        foreach ($tree as $key => $first) {
            $temp = (object)[
               'cate' => $first->name
            ];
            if(isset($first->children)){
                foreach ($first->children as $key => $second) {
                    $temp2 = (object)[
                        'cate' => $second->name
                    ];
                    $this->db->from("websites as a");
                    $this->db->where('a.module_id', $second->id);
                    $sql = $this->db->where('a.deleted',0)->get_compiled_select();
                    $res = $this->db->query($sql)->result();
                    if($res){
                        $temp2->urls = $res;
                    }                    
                    $temp->childcate[] = $temp2;
                }                
            }else{
                $this->db->from("websites as a");
                $this->db->where('a.module_id', $first->id);
                $sql = $this->db->where('a.deleted',0)->get_compiled_select();
                $res = $this->db->query($sql)->result();
                if($res){
                    $temp->urls = $res;
                }                
            }
            $needarr[] = $temp;
        }
       return $needarr;
    }
    
    /**
     * 插入优站
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function insertWeb($data)
    {
        //查询module是否有父级
        $module_name = '';
        $parent = $this->module->getModuleParent((int)$data['module_id']);
        if($parent){
            $module_name .= $parent[0]->name.'->';
        }
        //获取选择的模块名称
        $module_name .= $this->module->getModule((int)$data['module_id'])->name;
        $data = array(
            'name' => $data['name'],
            'module_id' => (int)$data['module_id'],
            'module_name' => $module_name,
            'url' => $data['url'],
            'remark' => $data['remark'],
            'create_time' => time()
        );
        if(!$this->db->insert('websites', $data))
        {
            return $this->db->error();
        }else{
            return [];
        }
    }
    
    /**
     * 删除优站
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delWeb($id)
    {
        $data = array(
            'deleted' => 1
        );
        $this->db->where('id', $id);
        if(!$this->db->update('websites', $data)){
            return $this->db->error();
        }else{
            return [];
        }
    }

    /**
     * 获取单个优站
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getWeb($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('websites')->result()[0];
    }

    public function editWeb($data)
    {
        //查询module是否有父级
        $module_name = '';
        $parent = $this->module->getModuleParent((int)$data['module_id']);
        if($parent){
            $module_name .= $parent[0]->name.'->';
        }
        //获取选择的模块名称
        $module_name .= $this->module->getModule((int)$data['module_id'])->name;
        $this->db->set('name', $data['name']);
        $this->db->set('module_id', $data['module_id']);
        $this->db->set('module_name', $module_name);
        $this->db->set('url', $data['url']);
        $this->db->set('remark', $data['remark']);
        $this->db->where('id', $data['id']);
        if(!$this->db->update('websites')){
            return $this->db->error();
        }else{
            return [];
        }
    }
    
}