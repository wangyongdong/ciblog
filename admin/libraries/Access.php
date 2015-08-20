<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 权限控制 与 页面显示 类
 * @author WangYongDong
 */
class Access {
	
	//获取用户权限和角色
	static function getUserRole() {
		$info = getRole();
		
		$arr = array();
		$arr['role_name'] = $info['role'];
		$arr['function'] = json_decode($info['function'],true);
		return $arr;
	}
	//检查权限
	static function checkAccess($sAction,$sFunction) {
		$arr = self::getUserRole();
		if($arr['role_name'] == 'super') {
			return true;
		}
		if($arr['role_name'] == 'ban') {
			show_error("黑名单用户禁止访问");
			exit;
		}
		//查看页
		if(!empty($sAction) && empty($sFunction)) {
			if($arr['role_name'] !== 'super') {
				if(empty($arr['function']['select'])) {
					show_error("您没有操作权限");
				}
				if(!in_array($sAction,$arr['function']['select'])) {
					show_error("您没有查看权限");
				}
			}
		}
		//操作页
		if(!empty($sAction) && !empty($sFunction)) {
			if($arr['role_name'] !== 'super') {
				if(empty($arr['function']['update'])) {
					show_error("您没有操作权限");
				}
				if(!in_array($sAction,$arr['function']['update'])) {
					show_error("您没有操作权限");
				}
			}
		}
	}
	//获取权限Menu
	static function getAccessMenu($sAction,$sModel) {
		$arr = self::getUserRole();
		if($arr['role_name'] !== 'super') {
			if($sModel == 'select') {
				if(empty($arr['function']['select'])) {
					return false;
				}
				if(!in_array($sAction,$arr['function']['select'])) {
					return false;
				}
			}
			if($sModel == 'update') {
				if(empty($arr['function']['update'])) {
					return false;
				}
				if(!in_array($sAction,$arr['function']['update'])) {
					return false;
				}
			}
		}
		return true;
	}
}