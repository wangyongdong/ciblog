<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// +----------------------------------------------------------------------+
// | Action:  设置相关类							                      	  |
// | Authors: wangyongdong                                 		  		  |
// +----------------------------------------------------------------------+

class Site extends MY_Controller {
    var $tokentype = 'site';
    public function __construct() {
        parent::__construct();
    }
    /**
     * 网站设置
     */
    public function web() {
        $data['list'] = $this->site_model->getSiteWeb();
        $data['token'] = getToken($this->tokentype);
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/site_web', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 执行网站信息修改
     */
    public function doSiteWeb() {
        $data = array();
        $sType = sg($_POST['type']);
        if ($sType == 'basic') {
            $data['sitename'] = sg($_POST['sitename']);
            $data['sitesign'] = sg($_POST['sitesign']);
            $data['siteauthor'] = sg($_POST['siteauthor']);
            $data['article_nums'] = sg($_POST['article_nums']);
            $data['copr_info'] = sg($_POST['copr_info']);
            $data['icp'] = sg($_POST['icp']);
            $data['footer_info'] = sg($_POST['footer_info']);
            $data['web_status'] = sg($_POST['web_status']);
            $data['close_info'] = sg($_POST['close_info']);
        }
        if ($sType == 'att') {
            $data['img_type'] = sg($_POST['img_type']);
            $data['img_size'] = sg($_POST['img_size']);
        }
        if ($sType == 'rc') {
            $data['is_record'] = sg($_POST['is_record']);
            $data['record_nums'] = sg($_POST['record_nums']);
            $data['record_comment'] = sg($_POST['record_comment']);
            $data['record_comment_nums'] = sg($_POST['record_comment_nums']);
            $data['record_check'] = sg($_POST['record_check']);
        }
        if ($sType == 'ac') {
            $data['is_comment'] = sg($_POST['is_comment']);
            $data['comment_interval'] = sg($_POST['comment_interval']);
            $data['comment_check'] = sg($_POST['comment_check']);
            $data['comment_nums'] = sg($_POST['comment_nums']);
        }
        $this->site_model->doSiteWeb($data);
        succes(site_url('site/web'));
    }
    /**
     * Menu设置
     */
    public function menu() {
        //分页执行
        $pageId = $this->input->get('page');
        $arr = $this->public_model->getPage('menu', 'site/menu?', $pageId);
        $data['list'] = $this->site_model->getSiteMenu('', $arr['start'], $arr['pagenum']);
        $data['token'] = getToken($this->tokentype);
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/site_menu', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 获取修改导航页面
     */
    public function updateMenu() {
        $id = $this->uri->segment(3);
        $data['list'] = $this->site_model->getSiteMenu($id);
        $data['token'] = getToken($this->tokentype);
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/site_menu_edit', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 执行menu添加/修改
     */
    public function doMenu() {
        $data = array();
        if (!empty($_POST['id'])) {
            $data['id'] = sg($_POST['id']);
        }
        $data['menu_name'] = sg($_POST['name']);
        $data['menu_alias'] = sg($_POST['alias']);
        $data['menu_desc'] = sg($_POST['desc']);
        $data['status'] = sg($_POST['status']);
        $arr = array( //数据验证
            $data['menu_name'],
            $data['menu_alias']
        );
        checkEmpty($arr);
        $this->site_model->doMenu($data);
        succes(site_url('site/menu'));
    }
    /**
     * 删除menu
     */
    public function delMenu() {
        $id = sg($_POST['id']);
        $affect = $this->site_model->delMenu($id);
        echo $affect;
    }
    /**
     * 博客事件页
     */
    public function event() {
        //分页执行
        $pageId = $this->input->get('page');
        $arr = $this->public_model->getPage('sort', 'site/event?', $pageId);
        $data['list'] = $this->site_model->getEventList($arr['start'], $arr['pagenum']);
        $data['token'] = getToken($this->tokentype);
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/event_list', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 事件修改页
     */
    public function updEvent() {
        $iEvent = $this->uri->segment(3);
        $data['list'] = $this->site_model->getEventInfo($iEvent);
        $data['token'] = getToken($this->tokentype);
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/event_edit', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 事件新增/修改
     */
    public function doEvent() {
        if (empty($_POST['id'])) {
            $data['datetime'] = date('Y-m-d H:i:s', time());
        } else {
            $data['id'] = sg($_POST['id'], 0);
        }
        $data['title'] = sg($_POST['title']);
        $data['description'] = sg($_POST['description']);
        $data['time'] = sg($_POST['time']);
        $arr = array( //数据验证
            $data['title'],
            $data['description'],
            $data['time']
        );
        checkEmpty($arr);
        checkToken($_POST['token'], $this->tokentype); //token验证
        $this->site_model->doEvent($data);
        succes(site_url('site/event'));
    }
    /**
     * 删除事件
     */
    public function delEvent() {
        $iEvent = sg($_POST['id']);
        $affect = $this->site_model->delEvent($iEvent);
        echo $affect;
    }
    /**
     * 信息统计
     */
    public function statistic() {
        //获取统计信息
        $data['record'] = getStatis('record');
        $data['comment'] = getStatis('comment');
        $data['contact'] = getStatis('contact', ' WHERE userid=0 ');
        $data['links'] = getStatis('links');
        $data['view'] = getStatis('log');
        $data['data'] = $this->site_model->getVisitStatistic();
        $data['arr'] = $this->site_model->getmoduleStatistic();
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/site_statistic', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 操作日志
     */
    public function action() {
        $data['aFilter']['start'] = sg($this->input->get('ds'));
        $data['aFilter']['end'] = sg($this->input->get('de'));
        $data['list'] = $this->site_model->getAction($data['aFilter']); //执行查询
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/site_log_action', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 删除操作日志
     */
    public function delActionLog() {
        $affect = $this->site_model->delActionLog();
        return $affect;
    }
    /**
     * notice
     */
    public function notice() {
        $data['data'] = 1;
        //分页执行
        $pageId = $this->input->get('page');
        $arr = $this->public_model->getPage('notice', 'site/notice?', $pageId);
        $data['notice'] = $this->site_model->getNotice($arr['start'], $arr['pagenum']);
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/site_notice', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 删除notice
     */
    public function delNotice() {
        $sId = sg($_POST['id']);
        $aId = explode(',', trim($sId, ','));
        $affects = 0;
        for ($i = 0; $i < count($aId); $i++) {
            $affect = $this->site_model->delNotice($aId[$i]);
            $affects+= $affect;
        }
        echo $affects;
    }
    /**
     * 修改notice
     */
    public function updNotice() {
        $sId = sg($_POST['id']);
        $aId = explode(',', trim($sId, ','));
        $affects = 0;
        for ($i = 0; $i < count($aId); $i++) {
            $affect = $this->site_model->updNotice($aId[$i]);
            $affects+= $affect;
        }
        echo $affects;
    }
    /**
     * 数据备份
     */
    public function backup() {
        $data['data'] = '';
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/site_backup', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 执行备份
     */
    public function doBackup() {
        $module = $this->uri->segment(3);
        if ($module == 'db') {
            $this->site_model->dbBackup();
        }
        if ($module == 're') {
            $this->site_model->reBackup();
        }
        if ($module == 'up') {
            $this->site_model->upBackup();
        }
    }
    /**
     * 缓存
     */
    public function cache() {
        $vc_path = $_SERVER['DOCUMENT_ROOT'] . '/home/cache';
        $dc_path = $_SERVER['DOCUMENT_ROOT'] . '/home/cache/DataCache';
        $data['view_num'] = FileCount($vc_path);
        $data['data_num'] = FileCount($dc_path);
        $data['data'] = $this->site_model->getCache();
        $data['nav'] = 'site';
        $this->load->view('public/header', $data);
        $this->load->view('site/site_cache', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 缓存修改
     */
    public function doCache() {
        $data = array();
        $data['option_name'] = sg($_POST['ck']);
        $data['option_value'] = sg($_POST['val']);
        $affect = $this->site_model->doCache($data);
        echo $affect;
    }
    /**
     * 缓存更新
     */
    public function upCache() {
        $module = sg($_POST['type']);
        $sId = sg($_POST['val']);
        $aId = explode(',', trim($sId, ','));
        $affect = $this->site_model->upCache($module, $aId);
        echo $affect;
    }
}

