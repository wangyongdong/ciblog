/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:31:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_log_login`
-- ----------------------------
DROP TABLE IF EXISTS `blog_log_login`;
CREATE TABLE `blog_log_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` varchar(255) DEFAULT NULL COMMENT '用户id',
  `ip` varchar(255) DEFAULT NULL COMMENT 'ip',
  `useragent` text COMMENT '浏览器信息',
  `datetime` datetime DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_log_login
-- ----------------------------
INSERT INTO `blog_log_login` VALUES ('1', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-14 14:48:38');
INSERT INTO `blog_log_login` VALUES ('2', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-17 09:21:48');
INSERT INTO `blog_log_login` VALUES ('3', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-18 09:47:34');
INSERT INTO `blog_log_login` VALUES ('4', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 09:22:01');
INSERT INTO `blog_log_login` VALUES ('5', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-20 09:55:31');
INSERT INTO `blog_log_login` VALUES ('6', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-21 18:08:05');
INSERT INTO `blog_log_login` VALUES ('7', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 10:57:02');
INSERT INTO `blog_log_login` VALUES ('8', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-25 16:42:49');
INSERT INTO `blog_log_login` VALUES ('9', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-26 09:28:28');
INSERT INTO `blog_log_login` VALUES ('10', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-28 11:12:55');
INSERT INTO `blog_log_login` VALUES ('11', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-31 14:02:57');
INSERT INTO `blog_log_login` VALUES ('12', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-31 15:54:17');
INSERT INTO `blog_log_login` VALUES ('13', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 09:43:17');
INSERT INTO `blog_log_login` VALUES ('14', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-02 09:33:58');
INSERT INTO `blog_log_login` VALUES ('15', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-02 09:33:59');
INSERT INTO `blog_log_login` VALUES ('16', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-07 14:59:52');
INSERT INTO `blog_log_login` VALUES ('17', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-08 11:03:54');
INSERT INTO `blog_log_login` VALUES ('18', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-09 14:06:44');
INSERT INTO `blog_log_login` VALUES ('19', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-10 09:25:37');
INSERT INTO `blog_log_login` VALUES ('20', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-11 09:22:03');
