<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 我的控制器
*/
class MY_Controller extends CI_Controller
{

    function __construct()
    {
       //检测权限，是否登陆，是否session过期
       parent::__construct();
       $this->_checkLogin();
    }


    private function _checkLogin()
    {
        if(!isset($_SESSION['user_id'])){//没登录不让进入主页面
            redirect('admin/login','location');
            exit;
       }
    }



    public function checkLevel()
    {
        $basic_level = array(0,1,2,3,4,5,6,7,8);
        //第一次进入未切换团队
        if(!isset($_SESSION['notfirst'])){
            $_SESSION['notfirst'] = 'no';
            //获取用户当前所在团队
            $result = $this->team->getCurrent();
            // debugres($result);
            //基本权限

            if((int)$result['status'] === 2){//没当前所在团队
                //有两种情况，1、有团队但未切换团队，默认帮他切换到自己的团队2、无团队
                $ownteam = $this->team->showAll()['resobj'];
                if(isset($ownteam[0])){
                    $data['company_id'] = $ownteam[0]->id;
                    $result = $this->team->changeTeam($data);
                    $_SESSION['current_companyid'] = $data['company_id'];//当前团队id
                    $_SESSION['current_companyname'] = $ownteam[0]->name;//当前团队名称
                    //获取团队成员的角色信息
                    $data['member_id'] = $_SESSION['person_id'];
                    $this->common->getuser_role_funlist($data);
                }else{
                    $_SESSION['rolename'] = array('游客');
                    $_SESSION['user_level'] = $basic_level;
                    $_SESSION['right_funlist'] = [];
                }
            }else{
                $_SESSION['current_companyname'] = $result['resobj']->company_name;
                $_SESSION['current_companyid'] = $result['resobj']->company_id;
                //获取团队成员的角色信息
                $data['member_id'] = $_SESSION['person_id'];
                $this->common->getuser_role_funlist($data);
            }
        }else{
            //判断后台当前所在团队是否与本地一致
            $result = $this->team->getCurrent();//获取账号在线上所在的团队id
            if((int)$result['status'] === 2){
                $_SESSION['rolename'] = array('游客');
                $_SESSION['user_level'] = $basic_level;
                $_SESSION['right_funlist'] = [];
            }else{
                $onlineCompany_id = $result['resobj']->company_id;
                if($onlineCompany_id != $_SESSION['current_companyid'])
                {
                    $data['company_id'] = $onlineCompany_id;
                    //切换到线上团队
                    $result = $this->team->changeTeam($data);
                    $_SESSION['notfirst'] = 'yes';
                    $_SESSION['current_companyid'] = $data['company_id'];//当前团队id
                    $_SESSION['current_companyname'] = urldecode($this->input->post('teamname'));//当前团队名称
                    //获取团队成员的角色信息
                    $data['member_id'] = $_SESSION['person_id'];
                    $this->common->getuser_role_funlist($data);
                    // echo "<script>alert('同一账号已在另一端切换团队了！');window.location.href='".site_url('basic/welcome/index')."'</script>";
                    // exit;
                }
            }
        }
    }

    public function checkConnet()
    {
        $params = array(
                'action' => '测试是否能连接接口服务器',
                'command' => SERIAL_NO
            );
        $this->load->library('requireapi',$params,'serial_no');
        $result = $this->serial_no->Require_Interface();
        if($result['status'] !== 'ok'){
            confirm('接口服务器不可用，请等待攻城师拯救。');
            redirect('basic/login/showLogin');
            exit;
        }
    }
}

