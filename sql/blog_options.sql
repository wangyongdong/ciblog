/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:32:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_options`
-- ----------------------------
DROP TABLE IF EXISTS `blog_options`;
CREATE TABLE `blog_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `option_value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_options
-- ----------------------------
INSERT INTO `blog_options` VALUES ('1', 'sitename', '如影随形');
INSERT INTO `blog_options` VALUES ('2', 'sitesign', '影子是一个会撒谎的精灵，它在虚空中流浪和等待被发现之间;在存在与不存在之间。');
INSERT INTO `blog_options` VALUES ('4', 'article_nums', '10');
INSERT INTO `blog_options` VALUES ('12', 'is_record', 'y');
INSERT INTO `blog_options` VALUES ('13', 'record_nums', '10');
INSERT INTO `blog_options` VALUES ('14', 'record_comment', 'y');
INSERT INTO `blog_options` VALUES ('5', 'copr_info', '');
INSERT INTO `blog_options` VALUES ('16', 'record_check', 'y');
INSERT INTO `blog_options` VALUES ('17', 'is_comment', 'y');
INSERT INTO `blog_options` VALUES ('18', 'comment_interval', '10');
INSERT INTO `blog_options` VALUES ('19', 'comment_check', 'y');
INSERT INTO `blog_options` VALUES ('3', 'siteauthor', '');
INSERT INTO `blog_options` VALUES ('15', 'record_comment_nums', '10');
INSERT INTO `blog_options` VALUES ('20', 'comment_nums', '10');
INSERT INTO `blog_options` VALUES ('10', 'img_type', 'jpg,ipeg,png,gif');
INSERT INTO `blog_options` VALUES ('11', 'img_size', '2M');
INSERT INTO `blog_options` VALUES ('7', 'footer_info', '啊实打实大');
INSERT INTO `blog_options` VALUES ('21', 'templet', 'default');
INSERT INTO `blog_options` VALUES ('6', 'icp', '');
INSERT INTO `blog_options` VALUES ('8', 'web_status', 'n');
INSERT INTO `blog_options` VALUES ('9', 'close_info', '');
