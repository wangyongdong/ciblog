<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 权限控制 与 页面显示 类
 * @author WangYongDong
 */
class Access {
	//获取用户权限和角色
	static function getUserRole() {
		$uid = $_SESSION['uid'];
		$arr = array();
		
		$aInfo = getUser($uid);
		$info = getRole($aInfo['role_id']);
		$arr['role_name'] = $info['role_name'];
		$arr['function'] = json_decode($info['function']);
		return $arr;
	}
	
	static function checkAccess($action) {
		$arr = self::getUserRole();
		if(!empty($action)) {
			if($arr['role_name'] == 'ban') {
				show_error("黑名单用户禁止访问");
			}
			if($arr['role_name'] == 'admin' || $arr['role_name'] == 'normal') {
				if(!in_array($action,$arr['function'])) {
					show_error("您没有权限查看");
				}
			}
			if($arr['role_name'] == 'super') {
				return;
			}
		}
	}
	
	static function getAccessMenu() {
		$arr = self::getUserRole();
		
		$arrFun = array();
		if((@in_array("site", $arr['function'])) || $arr['role_name'] == 'super') {
			$arrFun['site'] = '{"accessPath":"site","checked":false,"delFlag":0,"parentID":1,"resourceCode":"","resourceDesc":"","resourceGrade":2,"resourceID":4,"resourceName":"网站信息","resourceOrder":0,"resourceType":""},';
			$arrFun['site_child'] = '
						{"accessPath":"'.site_url("site/web_site").'","checked":false,"delFlag":0,"parentID":4,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":14,"resourceName":"网站信息","resourceOrder":0,"resourceType":""},
						{"accessPath":"'.site_url("site/seo_site").'","checked":false,"delFlag":0,"parentID":4,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":15,"resourceName":"SEO设置","resourceOrder":0,"resourceType":""},
						{"accessPath":"'.site_url("site/menu_site").'","checked":false,"delFlag":0,"parentID":4,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":16,"resourceName":"导航管理","resourceOrder":0,"resourceType":""},
						{"accessPath":"'.site_url("site/templet_site").'","checked":false,"delFlag":0,"parentID":4,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":17,"resourceName":"模板设置","resourceOrder":0,"resourceType":""},';
		}
		if($arr['role_name'] == 'super') {
			$arrFun['member'] = '{"accessPath":"member","checked":false,"delFlag":0,"parentID":1,"resourceCode":"","resourceDesc":"","resourceGrade":2,"resourceID":3,"resourceName":"用户管理","resourceOrder":0,"resourceType":""},';
			$arrFun['member_child'] = '{"accessPath":"'.site_url("member/ulist").'","checked":false,"delFlag":0,"parentID":3,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":13,"resourceName":"会员管理","resourceOrder":0,"resourceType":""},';
		}
		
		if($arr['role_name'] == 'admin' || $arr['role_name'] == 'normal' || $arr['role_name'] == 'super') {
			$str = '
				if(resourceType == "YEWUMOKUAI") {
					data = [ //parentID是fid，resourceGrade是自己的等级，级别，resourceID是自己的id
						{"accessPath":"record","checked":false,"delFlag":0,"parentID":1,"resourceCode":"","resourceDesc":"","resourceGrade":2,"resourceID":2,"resourceName":"说说管理","resourceOrder":0,"resourceType":""},
			            {"accessPath":"article","checked":false,"delFlag":0,"parentID":1,"resourceCode":"","resourceDesc":"","resourceGrade":2,"resourceID":3,"resourceName":"文章管理","resourceOrder":0,"resourceType":""},
			            {"accessPath":"comment","checked":false,"delFlag":0,"parentID":1,"resourceCode":"","resourceDesc":"","resourceGrade":2,"resourceID":4,"resourceName":"留言评论","resourceOrder":0,"resourceType":""},
			            {"accessPath":"works","checked":false,"delFlag":0,"parentID":1,"resourceCode":"","resourceDesc":"","resourceGrade":2,"resourceID":5,"resourceName":"作品信息","resourceOrder":0,"resourceType":""},
			            {"accessPath":"links","checked":false,"delFlag":0,"parentID":1,"resourceCode":"","resourceDesc":"","resourceGrade":2,"resourceID":6,"resourceName":"友情链接","resourceOrder":0,"resourceType":""},
		
			            {"accessPath":"'.site_url("record/rnew").'","checked":false,"delFlag":0,"parentID":2,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":11,"resourceName":"我的说说","resourceOrder":0,"resourceType":""},
		
						{"accessPath":"'.site_url("article/anew").'","checked":false,"delFlag":0,"parentID":3,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":12,"resourceName":"发表文章","resourceOrder":0,"resourceType":""},
			            {"accessPath":"'.site_url("article/alist").'","checked":false,"delFlag":0,"parentID":3,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":13,"resourceName":"查看文章","resourceOrder":0,"resourceType":""},
						{"accessPath":"'.site_url("sort/slist").'","checked":false,"delFlag":0,"parentID":3,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":14,"resourceName":"文章分类","resourceOrder":0,"resourceType":""},
		
						{"accessPath":"'.site_url("comment/article").'","checked":false,"delFlag":0,"parentID":4,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":15,"resourceName":"评论管理","resourceOrder":0,"resourceType":""},
			            {"accessPath":"'.site_url("comment/contact").'","checked":false,"delFlag":0,"parentID":4,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":16,"resourceName":"留言管理","resourceOrder":0,"resourceType":""},
			     
						{"accessPath":"'.site_url("works/wlist").'","checked":false,"delFlag":0,"parentID":5,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":17,"resourceName":"作品信息","resourceOrder":0,"resourceType":""},
			            {"accessPath":"'.site_url("works/wnew").'","checked":false,"delFlag":0,"parentID":5,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":18,"resourceName":"添加作品","resourceOrder":0,"resourceType":""},
		
			            {"accessPath":"'.site_url("links/llist").'","checked":false,"delFlag":0,"parentID":6,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":19,"resourceName":"友情链接","resourceOrder":0,"resourceType":""},
			
					];
				} else if(resourceType == "XITONGMOKUAI") {
					data = [ //parentID是fid，resourceGrade是自己的等级，级别，resourceID是自己的id
						{"accessPath":"setting","checked":false,"delFlag":0,"parentID":1,"resourceCode":"","resourceDesc":"","resourceGrade":2,"resourceID":2,"resourceName":"个人信息","resourceOrder":0,"resourceType":""},
						'.@$arrFun['member'].'
			            '.@$arrFun['site'].'
			     
		
			            {"accessPath":"'.site_url("setting/personal").'","checked":false,"delFlag":0,"parentID":2,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":11,"resourceName":"个人资料","resourceOrder":0,"resourceType":""},
			            {"accessPath":"'.site_url("setting/about").'","checked":false,"delFlag":0,"parentID":2,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":12,"resourceName":"about me","resourceOrder":0,"resourceType":""},
		
			            '.@$arrFun['member_child'].'
			            '.@$arrFun['site_child'].'
			
		            ];
				} else if(resourceType == "QITAMOKUAI") {
					data = [ //parentID是fid，resourceGrade是自己的等级，级别，resourceID是自己的id
			            {"accessPath":"","checked":false,"delFlag":0,"parentID":1,"resourceCode":"","resourceDesc":"","resourceGrade":2,"resourceID":2,"resourceName":"站点统计","resourceOrder":0,"resourceType":""},
		
			            {"accessPath":"'.site_url("other/info").'","checked":false,"delFlag":0,"parentID":2,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":13,"resourceName":"信息统计","resourceOrder":0,"resourceType":""},
			            {"accessPath":"'.site_url("other/view").'","checked":false,"delFlag":0,"parentID":2,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":14,"resourceName":"访问量","resourceOrder":0,"resourceType":""},
			            {"accessPath":"'.site_url("other/cache").'","checked":false,"delFlag":0,"parentID":2,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":14,"resourceName":"更新缓存","resourceOrder":0,"resourceType":""},
			            {"accessPath":"'.site_url("other/notice").'","checked":false,"delFlag":0,"parentID":2,"resourceCode":"","resourceDesc":"","resourceGrade":3,"resourceID":15,"resourceName":"消息通知","resourceOrder":0,"resourceType":""},
		            ];
				}
			';
		}
		if($arr['role_name'] == 'ban') {
			$str = '';
		}
		return $str;
	}
}