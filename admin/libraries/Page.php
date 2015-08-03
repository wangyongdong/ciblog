<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 分页类 初始化与控制
 * @author WangYongDong
 */
class Page {
	static function loadPage($iCount,$iPageSize,$sUrl) {
		//加载分页类
		$CI = & get_instance();
		$CI->load->library('pagination');
		
		$config['base_url'] = base_url().$sUrl;
		$config['total_rows'] = $iCount;		//总条数
		$config['per_page'] = $iPageSize;		//每页条数
		
		$config['num_links'] = 2;				//定义当前页的前后各有几个数字链接
		$config['use_page_numbers'] = TRUE;		//显示当前页码
		$config['first_link'] = '首页';
		$config['last_link'] = '末页';
		$config['next_link'] = '下一页'; 			// 下一页显示
		$config['prev_link'] = '上一页'; 			// 上一页显示
		
		$config['full_tag_open'] = '<p class="page-bor">';	//把打开的标签放在所有结果的左侧。
		$config['full_tag_close'] = '</p>';					//把关闭的标签放在所有结果的右侧。
		
		$config['first_tag_open'] = '';		//“第一页”链接的打开标签。
		$config['first_tag_close'] = '';	//“第一页”链接的关闭标签。
		
		$config['last_tag_open'] = '';		//“最后一页”链接的打开标签。
		$config['last_tag_close'] = '';		//“最后一页”链接的关闭标签。
		
		$config['next_tag_open'] = '';		//“下一页”链接的打开标签。
		$config['next_tag_close'] = '';		//“下一页”链接的关闭标签。
		
		$config['prev_tag_open'] = '';		//“上一页”链接的打开标签。
		$config['prev_tag_close'] = '';		//“上一页”链接的关闭标签。
		
		$config['cur_tag_open'] = '<a class="page-othor current">';	//“当前页”链接的打开标签。
		$config['cur_tag_close'] = '</a>';							//“当前页”链接的关闭标签。
		
		$config['num_tag_open'] = '';		//“数字”链接的打开标签。
		$config['num_tag_close'] = '';		//“数字”链接的关闭标签。
		
		$config['anchor_class'] = "class='page-othor'";		//给链接添加 CSS 类
		$config['page_query_string'] = TRUE;				//以?id=3&name=4
		$config['query_string_segment'] = 'page';			//设置分页参数
				
		$CI->pagination->initialize($config);				//执行分页方法
	}
	
	static function getParam($iPageSize,$pageId) {
		$pagenum = $iPageSize;
		$pageId = $pageId ? $pageId : 1;
		$start = ($pageId - 1) * $pagenum;
		$arr['start'] = $start;
		$arr['pagenum'] = $pagenum;
		return $arr;
	}
	
}