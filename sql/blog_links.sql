/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:31:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_links`
-- ----------------------------
DROP TABLE IF EXISTS `blog_links`;
CREATE TABLE `blog_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `sitename` varchar(64) NOT NULL COMMENT '网站名称',
  `siteurl` varchar(255) NOT NULL COMMENT 'url地址',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `status` enum('hide','show') NOT NULL DEFAULT 'show' COMMENT '是否显示',
  `datetime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_links
-- ----------------------------
INSERT INTO `blog_links` VALUES ('1', null, '百度', 'http://www.baidu.com', '全球最大的中文搜索引擎s', 'show', '2015-05-05 13:59:26');
INSERT INTO `blog_links` VALUES ('2', null, '网易', 'http://www.163.com', '中国领先的互联网技术公司，也是中国主要门户网站', 'show', '2015-05-06 13:59:31');
INSERT INTO `blog_links` VALUES ('3', null, '新浪', 'http://www.sina.com.cn', '全球华人社区的全球最大中文门户网站', 'show', '2015-05-12 13:59:35');
INSERT INTO `blog_links` VALUES ('4', null, '腾讯', 'http://www.qq.com', '深圳市腾讯计算机系统有限公司', 'show', '2015-05-15 13:59:40');
INSERT INTO `blog_links` VALUES ('5', null, '搜狐', 'http://www.sohu.com', '搜狐公司是中国领先的新媒体、通信及移动增值服务公司，是中文世界强劲的互联网品牌', 'show', '2015-05-17 13:59:44');
INSERT INTO `blog_links` VALUES ('6', null, '淘宝', 'http://www.taobao.com', '淘宝网是亚太地区较大的网络零售商圈', 'hide', '2015-05-19 13:59:49');
INSERT INTO `blog_links` VALUES ('21', null, '阿盛大的', 'http://www.medlive.test/', '撒地方水电费水电费费', 'hide', '2015-07-06 09:27:12');
INSERT INTO `blog_links` VALUES ('22', 'sddds@163.com', '阿盛大的', 'http://www.medlive.cn/', '辐射度方法', 'hide', '2015-07-06 09:31:58');
INSERT INTO `blog_links` VALUES ('23', 'sddds@163.com', 'aaabbb', 'http://emlog.local/a/', '阿顶顶顶顶顶', 'hide', '2015-07-06 09:44:39');
INSERT INTO `blog_links` VALUES ('29', null, '低调点', 'http://sd', 'fdf', 'show', '2015-08-12 09:30:26');
INSERT INTO `blog_links` VALUES ('26', null, 'dfgfdsg', 'http://sdgf', 'dfghdfsgh', 'show', '2015-07-20 16:31:35');
INSERT INTO `blog_links` VALUES ('34', '1112222@163.com', '洒大地', 'http://sdfdfsg.com', 'dfgsdffffffffffg', 'hide', '2015-08-24 14:59:55');
INSERT INTO `blog_links` VALUES ('33', null, '洒大地', 'http://sdd', 'sdfgsdf', 'show', '2015-08-14 09:45:28');
