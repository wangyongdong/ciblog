/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:32:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_sort`
-- ----------------------------
DROP TABLE IF EXISTS `blog_sort`;
CREATE TABLE `blog_sort` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(64) NOT NULL COMMENT '分类名称',
  `description` text COMMENT '分类描述',
  `level` int(11) DEFAULT NULL COMMENT '分类显示级别',
  `parent_id` int(11) DEFAULT NULL COMMENT '父id',
  `nums` int(10) NOT NULL DEFAULT '0' COMMENT '分类下文章数量',
  `alias` varchar(64) DEFAULT NULL COMMENT '别名',
  `datetime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_sort
-- ----------------------------
INSERT INTO `blog_sort` VALUES ('1', '1', '技术文章', '技术难题，知识积累', '1', '0', '0', 'article', '2015-08-28 11:16:10');
INSERT INTO `blog_sort` VALUES ('2', '1', '行业资讯', '业内新闻，周边信息', '1', '0', '6', 'cms', '2015-08-28 11:16:10');
INSERT INTO `blog_sort` VALUES ('3', '1', '编程魔法', '编程语言', '2', '1', '0', 'pl', '2015-08-28 11:17:01');
INSERT INTO `blog_sort` VALUES ('4', '1', '数据库', '数据库相关知识', '2', '1', '1', 'db', '2015-08-28 11:17:01');
INSERT INTO `blog_sort` VALUES ('5', '1', '操作系统', 'linux系统知识和使用', '2', '1', '3', 'os', '2015-08-28 11:17:01');
INSERT INTO `blog_sort` VALUES ('7', '1', 'web脚本', 'html，css，javascript等技术', '3', '3', '6', 'script', '2015-08-28 11:59:09');
INSERT INTO `blog_sort` VALUES ('6', '1', 'php语言', null, '3', '3', '13', 'php', '2015-08-28 11:22:43');
