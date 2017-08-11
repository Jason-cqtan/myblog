<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 后台登录
 */
class Login extends CI_Controller {


	public function __construct()
    {
    	parent::__construct();
        $this->load->model("User_model",'user');
        $this->load->helper('generateqr');
    }

    /**
     * 登录界面
     * @return [type] [description]
     */
	public function index()
	{
		$_SESSION['usererror'] = 0;
		if(isset($_SESSION['admin_username'])){
			redirect('admin/Article/allarticle');
		}
        //检测是否有cookie，有、使用cookie登录
        $username = $this->input->cookie('93jc.pw_username');
        if($username != null){
            $data['name'] = $username;
            $data['pwd'] = $this->input->cookie('93jc.pw_password');
            $res = $this->loginHandle($data);
            if($res){
                $this->load->view('admin/login');
            }else{
                redirect('admin/Article/allarticle');
            }
        }else{
            $this->load->view('admin/login');
        }
	}

	/**
     * 登录接口
     * @return [type] [description]
     */
	public function login()
	{
        //表单验证
		$data['name'] = trim($this->input->post('username'));
		$data['pwd'] = md5(trim($this->input->post('password')));
        if(empty($data['name']) || empty($data['pwd'])){
            returnjson('error','用户名或密码不能为空！');
        }
        if($_SESSION['usererror'] > 1){
        	$vcode = strtolower($this->input->post('vcode'));
        	if($_SESSION['vcode'] != $vcode){
        		returnjson('error','图片验证码错误！');
        	}
        }
        $result = $this->loginHandle($data);
        if($result){
            returnjson('error',$result[1]);
        }else{
            $is_rememberme = empty($this->input->post('rememberme'))?false:true;
            if($is_rememberme){
                $this->input->set_cookie('93jc.pw_username', $data['name'], 7*24*3600);//有记住我保存cookie一周
                $this->input->set_cookie('93jc.pw_password', $data['pwd'], 7*24*3600);
            }
            returnjson('ok');
        }
	}


	/**
     * 处理登录
     * @param  [array] $data [用户名和密码]
     * @return [type]       [description]
     */
    private function loginHandle($data)
    {
        $result = $this->user->getOneUser($data);
        if(isset($result->id)){
            //保存session
            $sesdata = array(
                'user_id' => $result->id,
                'admin_username'  => $data['name'],
                'user_info' => $result
            );            
            $this->session->set_userdata($sesdata);
            //成功后更新登录时间
            $this->user->loginTime($result->id);
            //获取用户权限保存至session
            //$res = $this->getUserAuths($result->data[0]->id);
            // print_r($res);exit;
            return [];
        }else{
        	$_SESSION['usererror']++;
            return ['error','用户名或密码不正确！'];
        }
    }

     /**
     * 获取登录用户权限codes
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function getUserAuths($user_id)
    {
        $res = $this->user->getUserAuths($user_id);
        // print_r($res);exit;
        $code = [];
        foreach ($res->data as $key => $level) {
            $code[] = $level->code;
        }
        $_SESSION['user_level'] = $code;
    }
    
    /**
     * 退出登录
     * @return [type] [description]
     */
    public function loginout()
	{
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
           setcookie(session_name(), '', time()-42000, '/');
        }
        session_destroy();//销毁session
        delete_cookie('93jc.pw_username');
        delete_cookie('93jc.pw_password');
        redirect('home/index');//跳转至首页
	}
}
