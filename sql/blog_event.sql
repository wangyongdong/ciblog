/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:31:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_event`
-- ----------------------------
DROP TABLE IF EXISTS `blog_event`;
CREATE TABLE `blog_event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(64) DEFAULT NULL COMMENT '主题',
  `description` text COMMENT '描述',
  `time` varchar(128) DEFAULT NULL COMMENT '时间发生时间',
  `datetime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_event
-- ----------------------------
INSERT INTO `blog_event` VALUES ('63', '更改', '就嘎嘎嘎嘎', '2015-09-23', '2015-09-08 14:21:55');
INSERT INTO `blog_event` VALUES ('65', '哈哈哈', '撒地方菲菲贵和', '2015-09-08', '2015-09-08 14:24:09');
INSERT INTO `blog_event` VALUES ('66', '广告', '韩国韩华', '2015-05-12', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('67', '结构化', '嘎嘎嘎', '2015-07-02', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('68', '欧克', '苦几年呢', '2015-05-23', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('69', '关于', '瞒不过', '2015-01-04', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('70', '木头', '没办法发', '2014-02-02', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('71', '和人', '和鬼混呢呢', '2014-04-16', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('72', '美女', '瞒不过', '2014-05-19', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('73', 'v从v', 'v半年内黄', '2014-10-23', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('74', '地方', '二二恶', '2014-12-27', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('75', 'bdr', '漫画风格及风格和', '2014-09-12', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('76', '从v', '从vvvv更换', '2013-02-07', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('77', '多个', '年农发行', '2013-04-12', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('78', '放入', '吧v百度的', '2013-05-15', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('79', '模糊', '负固不宾', '2013-09-27', '2015-09-08 16:34:40');
INSERT INTO `blog_event` VALUES ('80', '韩国', '大发光火', '2013-12-18', '2015-09-08 16:34:40');
