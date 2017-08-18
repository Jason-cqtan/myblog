<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
*/
class User_model extends CI_Model
{

    /**
     * 查询某个人
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function getOneUser($data)
    {
        $username = $data['name'];
        $pwd = $data['pwd'];
        $sql = "SELECT * FROM user where name ='{$username}' and pwd='{$pwd}' LIMIT  1";
        $query = $this->db->query($sql);
        if($query->result()){
            return $query->row();
        }else{
            return (object)[];
        }
    }
    
    /**
     * 更新最近登录时间
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function loginTime($user_id)
    {
        $now = time();
        $sql = "UPDATE user SET last_login_time = '{$now}' WHERE id = {$user_id}";
        $query = $this->db->query($sql);
    }

    /**
     * 获取用户权限列表
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function getUserAuths($user_id)
    {
        $params = array(
                'action' => '获取用户权限列表',
                'command' => 'getPowerListByUserId',
                'data' => array(
                   'user_id' => $user_id
                )
        );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;
    }

    public function getMembers($data = [])
    {
        $params = array(
                'action' => '获取所有工作人员',
                'command' => 'getAllUser',
                'data' => array(
                    'page_index' => isset($data['page_index'])?$data['page_index']:'1',
                    'page_size' => isset($data['page_size'])?$data['page_size']:'100',
                    'name' => isset($data['name'])?$data['name']:'',
                    'telphone' => isset($data['telphone'])?$data['telphone']:'',
                    'birthday' => isset($data['birthday'])?$data['birthday']:'',
                    'address' => isset($data['address'])?$data['address']:''
                )
        );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;
    }

    public function addMember($data)
    {
        $params = array(
                'action' => '添加工作人员',
                'command' => 'CreateUser',
                'data' => array(
                    'user_login_code' => $data['user_login_code'],
                    'user_login_pwd' => $data['user_login_pwd'],
                    'name' => $data['username'],
                    'sex' => $data['sex'],
                    'birthday' => $data['birthday'],
                    'headpic' => $data['headpic'],
                    'idcard' => $data['idcard'],
                    'address' => $data['address'],
                    'telphone' => $data['telphone'],
                    'postcode' => $data['postcode'],
                    'remark' => $data['remark'],
                    'place_id' => isset($data['place_id'])?$data['place_id']:'',
                    'place_name' => isset($data['place_name'])?$data['place_name']:'',
                    'rolelist' => $data['rolelist'],//权限数组
                    'dept_id' => $data['dept_id'],//部门id
                    'operate_userid' => $_SESSION['user_id']
                )
        );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;
    }

    public function updateMember($data)
    {
        $params = array(
            'action' => '更新工作人员信息',
            'command' => 'UpdateUser', 
            'data' => array(
                'id' => $data['id'],
                'user_login_code' => $data['user_login_code'],
                'name' => $data['name'],
                'sex' => isset($data['sex'])?$data['sex']:'男',
                'birthday' => $data['birthday'],
                'headpic' => isset($data['headpic'])?$data['headpic']:'public/adminLTE/dist/img/avatar6.jpg',
                'idcard' => isset($data['idcard'])?$data['idcard']:'',
                'address' => isset($data['address'])?$data['address']:'',
                'telphone' => isset($data['telphone'])?$data['telphone']:'',
                'postcode' => isset($data['postcode'])?$data['postcode']:'',
                'remark' => isset($data['remark'])?$data['remark']:'',
                'place_id' => isset($data['place_id'])?$data['place_id']:'',
                'place_name' => isset($data['place_name'])?$data['place_name']:'',
                'rolelist' => isset($data['rolelist'])?$data['rolelist']:'',
                'operate_userid' => $_SESSION['user_id'],
                'dept_id' => isset($data['dept_id'])?$data['dept_id']:''
                )           
            );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;
    }

    public function userInfo($userid)
    {
        $params = array(
                'action' => '获取工作人员详细信息',
                'command' => 'getUserInfoByUserId',
                'data' => array(
                   'id' => $userid
                )
        );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;
    }

    public function delUser($userid)
    {
       $params = array(
                'action' => '删除工作人员',
                'command' => 'DeleteUser',
                'data' => array(
                   'id' => $userid,
                   'operate_userid' => $_SESSION['user_id']
                )
        );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result; 
    }

    public function updatePhone($data)
    {
        $params = array(
                'action' => '修改手机号码',
                'command' => 'UpdateUserTelphone',
                'data' => array(
                    'id' => $data['id'],
                    'telphone' => $data['telphone'],
                    'check_code' => $data['checkcode'],
                    'operate_userid' => $_SESSION['user_id']
                    )
            );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;
    }

    public function updatePassword($data)
    {
        $params = array(
                'action' => '修改用户密码',
                'command' => 'UpdateUserPWD',
                'data' => array(
                    'id' => $data['id'],
                    'user_login_pwd' => $data['password'],
                    'check_code' => $data['checkcode'],
                    'operate_userid' => isset($_SESSION['user_id'])?$_SESSION['user_id']:$data['user_id']
                    )
            );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;

    }

    public function checkCode($data)
    {
        $params = array(
                'action' => '创建校验码',
                'command' => 'CreateCheckCode',
                'data' => array(
                    'user_id' => $data['user_id'],
                    'telphone' => $data['telphone'],
                    'belong_operation' => $data['belong_operation']
                    )
            );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;
    }

    public function SendSMSMessage($data)
    {
        $params = array(
                'action' => '发送短信',
                'command' => 'SendSMSMessage',
                'url' => 'http://120.76.26.51:9009',
                'data' => array(
                    'account' => isset($data['account'])?$data['account']:'test',
                    'passwordmd5' => isset($data['passwordmd5'])?$data['passwordmd5']:'202cb962ac59075b964b07152d234b70',
                    'mobile' => $data['mobile'],
                    'content' => $data['content']
                    )
            );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;
    }

    public function UserInfoByTelephone($data)
    {
        $params = array(
            'action' => '根据用户电话号码获取用户信息',
            'command' => 'getUserInfoByTelephone',
            'data' => array(
                'telephone' => $data['telephone']
                )
            );
        $randname = random_string('alnum',6);
        $this->load->library('webapi',$params,$randname);
        $result = $this->$randname->request_interface();
        return $result;
    }


}