<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// +----------------------------------------------------------------------+
// | Action:  类别相关类							                      	  |
// | Authors: wangyongdong                                 		  		  |
// +----------------------------------------------------------------------+

class Sort extends MY_Controller {
    var $tokentype = 'sort';
    public function __construct() {
        parent::__construct();
        $this->load->model('sort_model');
    }
    /**
     * 文章类别页
     */
    public function index() {
        //分页执行
        $pageId = $this->input->get('page');
        $arr = $this->public_model->getPage('sort', 'sort?', $pageId);
        $data['aSort'] = $this->sort_model->getSortList($arr['start'], $arr['pagenum']);
        $data['token'] = getToken($this->tokentype);
        $data['sort_list'] = $this->sort_model->getSortList();
        $data['nav'] = 'sort';
        $this->load->view('public/header', $data);
        $this->load->view('sort/sort_list', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 修改类别页
     */
    public function update() {
        $iSort = $this->uri->segment(3);
        $data['list'] = $this->sort_model->getSortInfo($iSort);
        $data['token'] = getToken($this->tokentype);
        $data['sort_list'] = $this->sort_model->getSortList();
        $data['nav'] = 'sort';
        $this->load->view('public/header', $data);
        $this->load->view('sort/sort_edit', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 新增类别信息
     */
    public function doSort() {
        if (empty($_POST['id'])) {
            $data['uid'] = $_SESSION['uid'];
            $data['datetime'] = date('Y-m-d H:i:s', time());
        } else {
            $data['id'] = sg($_POST['id'], 0);
        }
        $data['parent_id'] = sg($_POST['parent_id'], 0);
        $data['level'] = sortLevel($_POST['parent_id']) + 1; //根据parent_id获取level
        $data['name'] = sg($_POST['name']);
        $data['alias'] = sg($_POST['alias']);
        $data['description'] = sg($_POST['description']);
        $arr = array( //数据验证
            $data['name'],
            $data['alias']
        );
        checkEmpty($arr);
        checkToken($_POST['token'], $this->tokentype); //token验证
        $this->sort_model->doSort($data);
        succes(site_url('sort'));
    }
    /**
     * 删除类别
     */
    public function doDel() {
        $iSort = sg($_POST['id']);
        $affect = $this->sort_model->doDel($iSort);
        echo $affect;
    }
}

