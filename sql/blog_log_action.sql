/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:31:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_log_action`
-- ----------------------------
DROP TABLE IF EXISTS `blog_log_action`;
CREATE TABLE `blog_log_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` varchar(255) DEFAULT NULL COMMENT '用户id',
  `action` varchar(255) DEFAULT NULL COMMENT '操作地址',
  `function` varchar(255) DEFAULT NULL COMMENT '操作方法',
  `ip` varchar(255) DEFAULT NULL COMMENT 'ip',
  `useragent` text COMMENT '浏览器信息',
  `datetime` datetime DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_log_action
-- ----------------------------
INSERT INTO `blog_log_action` VALUES ('1', '1', 'sort', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 11:33:16');
INSERT INTO `blog_log_action` VALUES ('2', '1', 'sort', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 11:33:43');
INSERT INTO `blog_log_action` VALUES ('3', '1', 'sort', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 11:34:40');
INSERT INTO `blog_log_action` VALUES ('4', '1', 'sort', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 11:39:33');
INSERT INTO `blog_log_action` VALUES ('5', '1', 'sort', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 11:39:59');
INSERT INTO `blog_log_action` VALUES ('6', '1', 'sort', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:13:36');
INSERT INTO `blog_log_action` VALUES ('7', '1', 'sort', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:13:53');
INSERT INTO `blog_log_action` VALUES ('8', '1', 'article', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:14:42');
INSERT INTO `blog_log_action` VALUES ('9', '1', 'article', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:14:42');
INSERT INTO `blog_log_action` VALUES ('10', '1', 'article', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:14:42');
INSERT INTO `blog_log_action` VALUES ('11', '1', 'article', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:14:42');
INSERT INTO `blog_log_action` VALUES ('12', '1', 'article', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:14:42');
INSERT INTO `blog_log_action` VALUES ('13', '1', 'article', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:15:02');
INSERT INTO `blog_log_action` VALUES ('14', '1', 'article', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:15:02');
INSERT INTO `blog_log_action` VALUES ('15', '1', 'article', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:15:02');
INSERT INTO `blog_log_action` VALUES ('16', '1', 'article', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:15:02');
INSERT INTO `blog_log_action` VALUES ('17', '1', 'article', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:15:13');
INSERT INTO `blog_log_action` VALUES ('18', '1', 'article', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:15:23');
INSERT INTO `blog_log_action` VALUES ('19', '1', 'article', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:20:20');
INSERT INTO `blog_log_action` VALUES ('20', '1', 'article', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 13:20:27');
INSERT INTO `blog_log_action` VALUES ('21', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('22', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('23', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('24', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('25', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('26', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('27', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('28', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('29', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('30', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('31', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:06:01');
INSERT INTO `blog_log_action` VALUES ('32', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:11:47');
INSERT INTO `blog_log_action` VALUES ('33', '1', 'notice', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:11:47');
INSERT INTO `blog_log_action` VALUES ('34', '1', 'comment', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 18:14:16');
INSERT INTO `blog_log_action` VALUES ('35', '1', 'comment', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-31 16:41:32');
INSERT INTO `blog_log_action` VALUES ('36', '1', 'comment', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 09:44:46');
INSERT INTO `blog_log_action` VALUES ('37', '1', 'event', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-08 14:21:55');
INSERT INTO `blog_log_action` VALUES ('38', '1', 'event', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-08 14:23:06');
INSERT INTO `blog_log_action` VALUES ('39', '1', 'event', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-08 14:23:18');
INSERT INTO `blog_log_action` VALUES ('40', '1', 'event', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-08 14:24:00');
INSERT INTO `blog_log_action` VALUES ('41', '1', 'event', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-08 14:24:09');
INSERT INTO `blog_log_action` VALUES ('42', '1', 'event', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-08 14:44:25');
INSERT INTO `blog_log_action` VALUES ('43', '1', 'comment', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-09 14:07:30');
INSERT INTO `blog_log_action` VALUES ('44', '1', 'contact', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-09 14:09:10');
INSERT INTO `blog_log_action` VALUES ('45', '1', 'contact', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-09 14:12:00');
INSERT INTO `blog_log_action` VALUES ('46', '1', 'sort', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-10 09:27:50');
INSERT INTO `blog_log_action` VALUES ('47', '1', 'sort', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-10 09:29:04');
INSERT INTO `blog_log_action` VALUES ('48', '1', 'article', 'update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-10 09:44:00');
INSERT INTO `blog_log_action` VALUES ('49', '1', 'comment', 'add', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-10 11:28:29');
INSERT INTO `blog_log_action` VALUES ('50', '1', 'comment', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-10 11:30:43');
INSERT INTO `blog_log_action` VALUES ('51', '1', 'comment', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-10 11:52:23');
INSERT INTO `blog_log_action` VALUES ('52', '1', 'comment', 'delete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-10 11:52:51');
