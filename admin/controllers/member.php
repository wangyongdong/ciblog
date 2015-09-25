<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// +----------------------------------------------------------------------+
// | Action:  用户相关类							                      	  |
// | Authors: wangyongdong                                 		  		  |
// +----------------------------------------------------------------------+

class Member extends MY_Controller {
    var $tokentype = 'member';
    public function __construct() {
        parent::__construct();
        $this->load->model('member_model');
    }
    /**
     * 获取用户列表
     */
    public function index() {
        //分页执行
        $pageId = $this->input->get('page');
        $arr = $this->public_model->getPage('member', 'member?', $pageId);
        $data['list'] = $this->member_model->getMemberList($arr['start'], $arr['pagenum']);
        $data['nav'] = 'member';
        $this->load->view('public/header', $data);
        $this->load->view('member/member_list', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 获取修改页
     */
    public function update() {
        $iUser = $this->uri->segment(3);
        $data['list'] = getUser($iUser);
        $data['token'] = getToken($this->tokentype);
        $data['nav'] = 'member';
        $this->load->view('public/header', $data);
        $this->load->view('member/member_edit', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 获取添加页
     */
    public function create() {
        $data['token'] = getToken($this->tokentype);
        $data['nav'] = 'member';
        $this->load->view('public/header', $data);
        $this->load->view('member/member_create', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 用户信息修改/添加
     */
    public function doUser() {
        $data['username'] = sg($_POST['name']);
        $data['email'] = sg($_POST['email']);
        $data['role_id'] = sg($_POST['role_id'], '3');
        if (!empty($_POST['id'])) {
            $data['id'] = sg($_POST['id']);
            $data['qq'] = sg($_POST['qq']);
            $data['address'] = sg($_POST['address']);
            $data['job'] = sg($_POST['job']);
            $data['updatetime'] = date('Y-m-d H:i:s');
        } else {
            $data['datetime'] = date('Y-m-d H:i:s');
        }
        $arr = array( //数据验证
            $data['username'],
            $data['email']
        );
        checkEmpty($arr);
        checkToken($_POST['token'], $this->tokentype); //token验证
        if (empty($data['id'])) { //添加用户
            checkPass($_POST['password'], $_POST['repassword']); //密码验证
            $data['uniquely'] = rand(1, 100);
            $data['password'] = buildPass($_POST['password'], $data['uniquely']);
        } else { //修改用户
            if (!empty($_POST['password']) || !empty($_POST['repassword'])) {
                checkPass($_POST['password'], $_POST['repassword']); //密码验证
                $UserInfo = getUser($data['id']);
                $this->load->library('encrypt');
                $data['password'] = buildPass($_POST['password'], $UserInfo['uniquely']);
            }
        }
        $this->member_model->doUser($data);
        succes(site_url('member'));
    }
    /**
     * 删除会员
     */
    public function doDel() {
        $iUser = sg($_POST['id']);
        $affect = $this->member_model->doDel($iUser);
        echo $affect;
    }
    /**
     * 获取个人资料页
     */
    public function profile() {
        $data['list'] = getUser(UserId());
        $data['token'] = getToken($this->tokentype);
        $data['footer'] = 'upload';
        $data['nav'] = 'member';
        $this->load->view('public/header', $data);
        $this->load->view('member/member_profile', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 修改个人资料
     */
    public function doProfile() {
        switch ($_POST['type']) {
            case 'data':
                $data['id'] = sg($_POST['id']);
                $data['username'] = sg($_POST['name']);
                $data['email'] = sg($_POST['email']);
                $data['role_id'] = sg($_POST['role_id'], '3');
                $data['qq'] = sg($_POST['qq']);
                $data['address'] = sg($_POST['address']);
                $data['job'] = sg($_POST['job']);
                $data['updatetime'] = date('Y-m-d H:i:s');
                $arr = array(
                    $data['username'],
                    $data['email']
                ); //数据验证
                checkEmpty($arr);
                checkToken($_POST['token'], $this->tokentype); //token验证
                break;
            case 'about':
                checkToken($_POST['token'], $this->tokentype); //token验证
                $data['id'] = sg($_POST['id']);
                $data['about_me'] = sg($_POST['content']);
                break;
            case 'pass':
                $data['id'] = sg($_POST['id']);
                checkPass($_POST['password'], $_POST['repassword']); //密码验证
                checkToken($_POST['token'], $this->tokentype); //token验证
                $UserInfo = getUser($data['id']);
                $this->load->library('encrypt');
                $data['password'] = buildPass($_POST['password'], $UserInfo['uniquely']);
                break;
            case 'img':
                $data['id'] = sg($_POST['id']);
                $data['img'] = sg($_POST['img']);
                break;
        }
        $this->member_model->doUser($data);
        succes(site_url('member/profile'));
    }
    /**
     * 获取角色列表
     */
    public function role() {
        //分页执行
        $pageId = $this->input->get('page');
        $arr = $this->public_model->getPage('role', 'role?', $pageId);
        $data['list'] = $this->member_model->getRoleList($arr['start'], $arr['pagenum']);
        $data['token'] = getToken($this->tokentype);
        $data['nav'] = 'member';
        $this->load->view('public/header', $data);
        $this->load->view('member/member_role', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 获取角色编辑页
     */
    public function updrole() {
        $iRole = $this->uri->segment(3);
        $data['list'] = $this->member_model->getRoleInfo($iRole);
        $data['token'] = getToken($this->tokentype);
        $data['nav'] = 'member';
        $this->load->view('public/header', $data);
        $this->load->view('member/member_role_edit', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 编辑角色
     */
    public function doRole() {
        $data = array();
        if (!empty($_POST['id'])) {
            $data['id'] = sg($_POST['id']);
        }
        $data['role'] = sg($_POST['role']);
        $data['name'] = sg($_POST['name']);
        $data['function'] = sg($_POST['function']);
        $arr = array(
            $data['role'],
            $data['name']
        );
        checkEmpty($arr);
        checkToken($_POST['token'], $this->tokentype);
        $this->member_model->doRole($data);
        succes(site_url('member/role'));
    }
    /**
     * 编辑角色
     */
    public function doAcc() {
        $data = array();
        $data['id'] = sg($_POST['id']);
        $select = sg($_POST['select']);
        $update = sg($_POST['update']);
        $data['function'] = array(
            'select' => $select,
            'update' => $update,
        );
        $data['function'] = json_encode($data['function']);
        $this->member_model->doRole($data);
        succes(site_url('member/role'));
    }
    /**
     * 删除角色
     */
    public function roleDel() {
        $iRole = sg($_POST['id']);
        $affect = $this->member_model->roleDel($iRole);
        echo $affect;
    }
}

