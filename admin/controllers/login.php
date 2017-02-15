<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// +----------------------------------------------------------------------+
// | Action:  登录相关类							                      	  |
// | Authors: wangyongdong                                 		  		  |
// +----------------------------------------------------------------------+

class Auth::user()->email extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }
    /**
     * 获取登陆页
     */
    public function index() {
        $this->load->view('public/login');
    }
    /**
     * 执行用户登录
     */
    public function loginIn() {
        $name = sg($_POST['name']);
        $pass = sg($_POST['pass']);
        $arr = array(
            $name,
            $pass
        );
        checkEmpty($arr);
        $res = $this->login_model->checkUserLogin($name, $pass); //查询用户信息
        switch ($res) {
            case '-1':
                $data['status'] = - 1;
                $data['error'] = '用户不存在';
                break;
            case '-2':
                $data['status'] = - 2;
                $data['error'] = '密码不正确';
                break;
            case '-3':
                $data['status'] = - 3;
                $data['error'] = '用户已被锁定';
                break;
            default:
                //添加cookie
                $this->load->library('auth');
                $this->auth->userLoginSet($res['id'], $res['username']);
                //添加登录日志
                $this->addLoginLog();
                $data['success'] = 'success';
                break;
        }
        echo json_encode($data);
    }
    /**
     * 登出操作
     */
    public function loginOut() {
        $this->load->library('auth');
        $this->auth->useLoginOut();
        header('location:' . base_url());
    }
    /**
     * 添加登录日志
     */
    public function addLoginLog() {
        $data['userid'] = UserId();
        $data['ip'] = $this->input->ip_address();
        $data['useragent'] = $this->input->user_agent();
        $data['datetime'] = date('Y-m-d H:i:s', time());
        $this->login_model->addLoginLog($data);
    }
}
