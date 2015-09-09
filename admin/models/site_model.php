<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model  {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。
    }
    
    /**
     * 获取网站设置信息
     */
    function getSiteWeb() {
    	$sql = "SELECT
    				*
    			FROM
    				blog_options";
    	$res = $this->db->query($sql);
    	$result = $res->result_array();
    	foreach ($result as $row) {
    		$name = $row['option_name'];
    		$arr[$name] = $row['option_value'];
    		$list = $arr;
    	}
    	return $list;
    }
    
    /**
     * 执行网站信息配置修改
     */
    function doSiteWeb($aSite) {
    	foreach ($aSite as $key=>$value) {
    		$data = array('option_value'=>$value);
    		$this->db->update('options',$data,array('option_name'=>$key));
    		$affect = $this->db->affected_rows();
    	}
    	//添加操作log
    	$this->site_model->addActionLog('site_web','update');
    	return $affect;
    }
    /**
     * 获取menu信息
     */
    function getSiteMenu($id='',$iStart=0,$iPageNum=10) {
    	$sLimit = ' LIMIT '.$iStart.','.$iPageNum;
    	$sWhere = ' 1=1 ';
    	if(!empty($id)) {
    		$sWhere = ' id= '.$id;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_menu
    			WHERE '.$sWhere . $sLimit;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	if(!empty($id)) {
    		return $list[0];
    	}
    	return $list;
    }
    
    /**
     * 添加,修改menu
     */
    function doMenu($data) {
    	if(!empty($data['id'])) {
    		$this->db->update('menu',$data,array('id'=>$data['id']));
    		//添加操作log
    		$this->site_model->addActionLog('site_menu','update');
    	} else {
    		$this->db->insert('menu',$data);
    		//添加操作log
    		$this->site_model->addActionLog('site_menu','add');
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行menu删除
     */
    function delMenu($id) {
    	$affect = $this->db->delete('menu',array('id'=>$id));
    	//添加操作log
    	$this->site_model->addActionLog('site_menu','delete');
    	return $affect;
    }
    
    /**
     * 获取事件列表
     */
    function getEventList($iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_event
    			ORDER BY
    				id
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aList = $res->result_array();
    	return $aList;
    }
    /**
     * 获取事件信息
     */
    function getEventInfo($iEvent='') {
    	if(empty($iEvent)) {
    		return false;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_event
				WHERE
					id='.$iEvent;
    	$res = $this->db->query($sql);
    	$aList = $res->row_array();
    	return $aList;
    }
    /**
     * 事件添加/修改
     */
    function doEvent($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('event', $data);
    		//添加操作log
    		$this->site_model->addActionLog('event','add');
    	} else {
    		$this->db->update('event',$data,array('id'=>$data['id']));
    		//添加操作log
    		$this->site_model->addActionLog('event','update');
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行事件删除
     */
    function delEvent($iEvent) {
    	$affect = $this->db->delete('event',array('id'=>$iEvent));
    	//添加操作log
    	$this->site_model->addActionLog('event','delete');
    	return $affect;
    }
    
    
    /**
     * 获取notice列表
     */
    function getNotice($iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_notice
    			WHERE 
    				type != "contact" 
					AND type != "comment"
    			ORDER BY
    				datetime DESC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aList = $res->result_array();
    	return $aList;
    }
    /**
     * 执行删除notice
     */
    function delNotice($iNotice) {
    	return $this->db->delete('notice',array('id'=>$iNotice));
    	//添加操作log
    	$this->site_model->addActionLog('notice','delete');
    }
    /**
     * 修改notice状态
     */
    function updNotice($iNotice) {
    	$data = array();
    	$data['status'] = 'read';
    	$this->db->update('notice',$data,array('id'=>$iNotice));
    	$affect = $this->db->affected_rows();
    	//添加操作log
    	$this->site_model->addActionLog('notice','update');
    	return $affect;
    }
    /**
     * 获取操作日志
     */
    function getAction($aFilter='') {
    	$sql = 'SELECT
    				*
    			FROM
    				blog_log_action
    			WHERE
    				1=1 ';
    	if(!empty($aFilter['start'])) {
    		$sql .= ' AND datetime > "'.$aFilter['start'].'"';
    	}
    	if(!empty($aFilter['end'])) {
    		$sql .= ' AND datetime < "'.$aFilter['end'].'"';
    	}
    	$sql .= ' ORDER BY
    				id DESC ';
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	return $list;
    }
    
    /**
     * 添加操作log
     */
    public function addActionLog($sAction,$sFunction) {
    	$data = array();
    	$data['userid'] = UserId();
    	$data['action'] = $sAction;
    	$data['function'] = $sFunction;
    	$data['ip'] = $this->input->ip_address();
    	$data['useragent'] = $this->input->user_agent();
    	$data['datetime'] = date("Y-m-d H:i:s",time());
    
    	$this->db->insert('log_action',$data);
    	$iInsert = $this->db->insert_id();
    	return $iInsert;
    }
    
    /**
     * 执行删除操作日志
     */
    function delActionLog() {
    	$sql = 'DELETE FROM blog_log_action';
    	$affect = $this->db->query($sql);
    	return 1;
    }
    
    /**
     * 获取访问统计
     */
    public function getVisitStatistic() {
    	$today = date("Y-m-d");
    	$month = date("Y-m");
    	//Pageviews 今天所有页面访问数量
    	$sql = 'SELECT count(*) as num FROM blog_log WHERE datetime>"'.$today.'"';
    	$res = $this->db->query($sql);
    	$Pageviews = $res->row_array();
    	//visitors 当天访问独立人数
    	$sql = 'SELECT count(*) as num FROM (SELECT * FROM blog_log WHERE datetime>"'.$today.'" GROUP BY ip) as a';
    	$res = $this->db->query($sql);
    	$VisitorsDay = $res->row_array();
    	//visitors 当月访问独立人数
    	$sql = 'SELECT count(*) as num FROM (SELECT * FROM blog_log WHERE datetime>"'.$month.'" GROUP BY ip) as a';
    	$res = $this->db->query($sql);
    	$VisitorsMonth = $res->row_array();
    	//New Visits 新增独立访问人数
    	$sql = 'SELECT
    				count(*) as num
    			FROM
    				blog_log
    			WHERE
    				ip not in (SELECT ip FROM blog_log WHERE datetime<"'.$month.'")
    				AND datetime>"'.$month.'"';
    	$res = $this->db->query($sql);
    	$NewVisits = $res->row_array();
    	//visitors till date
    	$sql = 'SELECT count(*) as num FROM (SELECT * FROM blog_log GROUP BY ip) as a';
    	$res = $this->db->query($sql);
    	$total = $res->row_array();
    	 
    	$arr['Pageviews'] = sg($Pageviews['num'],0);
    	$arr['VisitorsDay'] = sg($VisitorsDay['num'],0);
    	$arr['VisitorsMonth'] = sg($VisitorsMonth['num'],0);
    	$arr['NewVisits'] = sg($NewVisits['num'],0);
    	$arr['total'] = sg($total['num'],0);
    	
    	return $arr;
    }
    /**
     * 获取模块统计
     */
    public function getmoduleStatistic() {
    	$today = date("Y-m-d");
    	//Pageviews 今天首页访问数量
    	$sql = 'SELECT count(*) as num FROM blog_log WHERE url like "%home%" AND datetime>"'.$today.'"';
    	$res = $this->db->query($sql);
    	$homeViews = $res->row_array();
    	
    	//Pageviews 今天article访问数量
    	$sql = 'SELECT count(*) as num FROM blog_log WHERE url like "%article%" AND datetime>"'.$today.'"';
    	$res = $this->db->query($sql);
    	$articleViews = $res->row_array();
    	
    	//Pageviews 今天cms访问数量
    	$sql = 'SELECT count(*) as num FROM blog_log WHERE url like "%cms%" AND datetime>"'.$today.'"';
    	$res = $this->db->query($sql);
    	$cmsViews = $res->row_array();
    	
    	//Pageviews 今天record访问数量
    	$sql = 'SELECT count(*) as num FROM blog_log WHERE url like "%record%" AND datetime>"'.$today.'"';
    	$res = $this->db->query($sql);
    	$recordViews = $res->row_array();
    	
    	//Pageviews 今天contact访问数量
    	$sql = 'SELECT count(*) as num FROM blog_log WHERE url like "%contact%" AND datetime>"'.$today.'"';
    	$res = $this->db->query($sql);
    	$contactViews = $res->row_array();
    	
    	//Pageviews 今天about访问数量
    	$sql = 'SELECT count(*) as num FROM blog_log WHERE url like "%about%" AND datetime>"'.$today.'"';
    	$res = $this->db->query($sql);
    	$aboutViews = $res->row_array();
    	
    	$arr['homeViews'] = sg($homeViews['num'],0);
    	$arr['articleViews'] = sg($articleViews['num'],0);
    	$arr['cmsViews'] = sg($cmsViews['num'],0);
    	$arr['recordViews'] = sg($recordViews['num'],0);
    	$arr['contactViews'] = sg($contactViews['num'],0);
    	$arr['aboutViews'] = sg($aboutViews['num'],0);
    	
    	return $arr;
    }
    
    /**
     * 数据库备份
     */
    public function dbBackup() {
    	// Load the DB utility class
    	$this->load->dbutil();
    	
    	$filename = 'ciblog_'. date('Ymd_His', time()).'.sql';
    	
    	$prefs = array(
    		'tables'        => array(),   	// Array of tables to backup.
    		'ignore'        => array(),		// List of tables to omit from the backup
    		'format'        => 'sql',       // gzip, zip, txt
    		'filename'      => $filename,   // File name - NEEDED ONLY WITH ZIP FILES
    		'add_drop'      => TRUE,        // Whether to add DROP TABLE statements to backup file
    		'add_insert'    => TRUE,        // Whether to add INSERT data to backup file
    		'newline'       => "\n"         // Newline character used in backup file
    	);
    	
    	// Backup your entire database and assign it to a variable
    	$backup = $this->dbutil->backup($prefs);
    	
    	// Load the download helper and send the file to your desktop
    	$this->load->helper('download');
    	force_download('ciblog_backup.sql', $backup);
    }
    
    /**
     * 上传图片资源备份
     */
    public function upBackup() {
    	$this->load->library('zip');
    	$path = trim($_SERVER['DOCUMENT_ROOT'],'/').'/upload/';
    	 
    	$this->zip->read_dir($path,FALSE);
    	 
    	// Download the file to your desktop. Name it "my_backup.zip"
    	$this->zip->download('upload_backup.zip');
    }
    
    /**
     * 全站资源备份
     */
    public function reBackup() {
    	$this->load->library('zip');
    	$path = trim($_SERVER['DOCUMENT_ROOT'],'/').'/';
    	
    	$this->zip->read_dir($path);
    	
    	// Download the file to your desktop. Name it "my_backup.zip"
    	$this->zip->download('ciblog_backup.zip');
    }
    
    /**
     * 数据库备份
     */
    public function dbBackups($sPath='') {
    	header("Content-type:text/html;charset=utf-8");
    	//配置信息
    	$cfg_dbhost = 'localhost';
    	$cfg_dbname = 'ciblog';
    	$cfg_dbuser = 'root';
    	$cfg_dbpwd = '123456';
    	$cfg_db_language = 'utf8';
    	$to_file_name = $sPath."ciblog_backup.sql";
    	//END 配置
    	
    	//链接数据库
    	$link = mysql_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd);
    	mysql_select_db($cfg_dbname);
    	//选择编码
    	mysql_query("set names ".$cfg_db_language);
    	
    	//数据库中有哪些表
    	$tables = mysql_query("SHOW TABLES FROM $cfg_dbname");
    	//将这些表记录到一个数组
    	$tabList = array();
    	while($row = mysql_fetch_row($tables)) {
    		$tabList[] = $row[0];
    	}
		$sqldump = '';
    	//echo "运行中，请耐心等待...<br/>";
    	$info = "-- ----------------------------\r\n";
    	$info .= "-- 日期：".date("Y-m-d H:i:s",time())."\r\n";
    	$info .= "-- Power by 王永东博客(http://www.wangyongdong.com)\r\n";
    	$info .= "-- 仅用于测试和学习,本程序不适合处理超大量数据\r\n";
    	$info .= "-- ----------------------------\r\n\r\n";
    	//file_put_contents($to_file_name,$info,FILE_APPEND);
    	$sqldump .= $info;
    	
    	//将每个表的表结构导出到文件
    	foreach($tabList as $val){
    		$sql = "show create table ".$val;
    		$res = mysql_query($sql,$link);
    		$row = mysql_fetch_array($res);
    		$info = "-- ----------------------------\r\n";
    		$info .= "-- Table structure for `".$val."`\r\n";
    		$info .= "-- ----------------------------\r\n";
    		$info .= "DROP TABLE IF EXISTS `".$val."`;\r\n";
    		$sqlStr = $info.$row[1].";\r\n\r\n";
    		//追加到文件
    		//file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
    		$sqldump .= $sqlStr;
    		//释放资源
    		mysql_free_result($res);
    	}
    	
    	//将每个表的数据导出到文件
    	foreach($tabList as $val){
    		$sql = "select * from ".$val;
    		$res = mysql_query($sql,$link);
    		//如果表中没有数据，则继续下一张表
    		if(mysql_num_rows($res)<1) continue;
    		//
    		$info = "-- ----------------------------\r\n";
    		$info .= "-- Records for `".$val."`\r\n";
    		$info .= "-- ----------------------------\r\n";
    		$sqldump .= $info;
    		//file_put_contents($to_file_name,$info,FILE_APPEND);
    		//读取数据
    		while($row = mysql_fetch_row($res)){
    			$sqlStr = "INSERT INTO `".$val."` VALUES (";
    			foreach($row as $zd){
    				$sqlStr .= "'".$zd."', ";
    			}
    			//去掉最后一个逗号和空格
    			$sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
    			$sqlStr .= ");\r\n";
    			$sqldump .= $sqlStr;
    			//file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
    		}
    		//释放资源
    		mysql_free_result($res);
    		$sqldump .= '\r\n';
    		//file_put_contents($to_file_name,"\r\n",FILE_APPEND);
    	}
    	
    	$filename = 'ciblog_'. date('Ymd_His', time()).'.sql';
    	header('Content-Type: text/x-sql');
    	header("Content-Disposition:attachment;filename=".$filename);
    	
    	echo $sqldump;
    }
    
}