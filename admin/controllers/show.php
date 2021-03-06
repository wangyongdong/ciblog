<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// +----------------------------------------------------------------------+
// | Action:  后台首页相关类							                      	  |
// | Authors: wangyongdong                                 		  		  |
// +----------------------------------------------------------------------+

class Show extends MY_Controller {
    /**
     * 加载首页
     */
    public function index() {
        $arrSys['sysos'] = $_SERVER['SERVER_SOFTWARE']; //获取web服务器标识的字串
        $arrSys['php'] = 'PHP ' . PHP_VERSION; //获取PHP服务器版本
        $arrSys['mysql'] = 'MySql ' . mysql_get_server_info(); //mysql版本信息
        if (function_exists('gd_info')) { //从服务器中获取GD库的信息
            $gd = gd_info();
            $arrSys['gdinfo'] = $gd['GD Version'];
        } else {
            $arrSys['gdinfo'] = '未知';
        }
        $arrSys['allowurl'] = ini_get('allow_url_fopen') ? '支持' : '不支持'; //是否可以远程文件获取
        $arrSys['max_upload'] = ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'Disabled'; //最大上传限制
        $arrSys['max_ex_time'] = ini_get('max_execution_time') . '秒'; //脚本的最大执行时间
        date_default_timezone_set('Etc/GMT-8'); //设置时区Etc/GMT-8
        $arrSys['systemtime'] = date('Y-m-d H:i:s', time()); //服务器时间
        $data['arr'] = $arrSys;
        $data['nav'] = 'index';
        $this->load->view('public/header', $data);
        $this->load->view('show', $data);
        $this->load->view('public/footer', $data);
    }
    /**
     * 错误页
     */
    public function error() {
        $sInfo = $this->uri->segment(3);
        $data['info'] = urldecode($sInfo);
        $data['nav'] = '';
        $data['refer'] = sg($_SERVER['HTTP_REFERER'], '/admin');
        $this->load->view('public/header', $data);
        $this->load->view('public/common', $data);
        $this->load->view('public/footer', $data);
    }
}

