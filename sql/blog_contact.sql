/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:31:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_contact`
-- ----------------------------
DROP TABLE IF EXISTS `blog_contact`;
CREATE TABLE `blog_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reply_id` int(11) DEFAULT '0' COMMENT '回复id',
  `userid` int(11) DEFAULT '0' COMMENT 'userid',
  `author` varchar(255) DEFAULT NULL COMMENT '作者名',
  `email` varchar(255) DEFAULT NULL COMMENT 'email',
  `url` varchar(255) DEFAULT NULL COMMENT '用户连接',
  `content` text COMMENT '评论内容',
  `status` enum('Y','N') DEFAULT 'N' COMMENT '是否回复',
  `is_read` enum('Y','N') DEFAULT 'N',
  `ip` varchar(64) DEFAULT NULL COMMENT '用户IP',
  `useragent` text COMMENT '浏览器信息',
  `datetime` datetime DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_contact
-- ----------------------------
INSERT INTO `blog_contact` VALUES ('1', '0', '0', '张三', 'wydman@163.com', 'http://www.baidu.com', '您好啊，博主，', 'N', 'Y', null, null, '2015-07-20 13:53:47');
INSERT INTO `blog_contact` VALUES ('2', '0', '0', '李四', 'wydman@163.com', 'http://www.baidu.com', '我想对你说，您好啊，博主。', 'N', 'Y', null, null, '2015-07-20 13:54:34');
INSERT INTO `blog_contact` VALUES ('3', '0', '0', '王五a', 'wydman@163.com', 'http://www.baidu.com', '请问一下，我想对你说，您好啊，博主。', 'N', 'Y', null, null, '2015-08-10 22:55:50');
INSERT INTO `blog_contact` VALUES ('4', '0', '0', '赵六', 'wydman@163.com', 'http://www.baidu.com', '图画之内容。-- 蔡元培ss', 'N', 'Y', null, null, '2015-08-11 08:56:44');
INSERT INTO `blog_contact` VALUES ('5', '0', '0', '王永东', 'wydman@163.com', 'http://www.baidu.com', '怎么了？有问题你可以问我的，联系我，我会尽量帮助你', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', '2015-07-20 15:23:09');
INSERT INTO `blog_contact` VALUES ('128', '5', '1', '王永东', null, null, '你是谁啊，帽筒', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 16:58:36');
INSERT INTO `blog_contact` VALUES ('129', '2', '1', '王永东', null, null, '有什么问题可以帮助你么，小伙子。', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:01:54');
INSERT INTO `blog_contact` VALUES ('130', '1', '1', '王永东', null, null, '你好，有什么可以帮助你的吗？', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:26:40');
INSERT INTO `blog_contact` VALUES ('131', '3', '1', '王永东', null, null, '有什么事情吗？可以提问的哦', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:27:24');
INSERT INTO `blog_contact` VALUES ('132', '5', '1', '王永东', null, null, '哈哈哈', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:28:07');
INSERT INTO `blog_contact` VALUES ('133', '4', '1', '王永东', null, null, '啊发顺丰打底衫', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:28:31');
INSERT INTO `blog_contact` VALUES ('134', '3', '1', '王永东', null, null, '嘎嘎嘎嘎嘎嘎个', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:30:42');
INSERT INTO `blog_contact` VALUES ('135', '4', '1', '王永东', null, null, '哈撒地方', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:31:17');
INSERT INTO `blog_contact` VALUES ('136', '5', '1', '王永东', null, null, '撒地方啥地方萨芬', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:35:48');
INSERT INTO `blog_contact` VALUES ('137', '3', '1', '王永东', null, null, '撒旦广东省发生的', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:38:55');
INSERT INTO `blog_contact` VALUES ('138', '2', '1', '王永东', null, null, '撒打发第三方', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:41:01');
INSERT INTO `blog_contact` VALUES ('139', '0', '0', '按时大大大', 'wydman@163.com', '', '斯蒂芬斯蒂芬斯蒂芬', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 14:57:15');
INSERT INTO `blog_contact` VALUES ('140', '139', '1', '王永东', null, null, '你厉害，我也得多多像你请教哦。', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-09 14:09:08');
INSERT INTO `blog_contact` VALUES ('141', '139', '1', '王永东', null, null, '对啊对啊。', 'N', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-09 14:11:59');
