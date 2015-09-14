/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:31:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_member`
-- ----------------------------
DROP TABLE IF EXISTS `blog_member`;
CREATE TABLE `blog_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `password` varchar(128) NOT NULL COMMENT '密码',
  `email` varchar(128) DEFAULT NULL COMMENT '邮箱',
  `qq` varchar(64) DEFAULT NULL COMMENT 'qq',
  `address` varchar(64) DEFAULT NULL COMMENT '地址',
  `img` varchar(128) DEFAULT NULL COMMENT '头像',
  `job` varchar(64) DEFAULT NULL COMMENT '工作',
  `about_me` text COMMENT '关于我',
  `role_id` int(11) DEFAULT '3' COMMENT '用户权限id',
  `uniquely` int(10) DEFAULT NULL COMMENT '唯一标示',
  `updatetime` datetime DEFAULT NULL COMMENT '修改时间',
  `datetime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_member
-- ----------------------------
INSERT INTO `blog_member` VALUES ('1', '王永东', '33749684e35842a24af05c44', '4359992@qq.com', '4359992', '北京市-朝阳区', 'u=2298223339,2856122093&fm=21&gp=0.jpg', 'web开发、PHP开发', '人生就是一个得与失的过程，而我却是一个幸运者。', '1', '1992', '2015-08-14 09:18:47', '2014-12-23 09:02:05');
INSERT INTO `blog_member` VALUES ('2', 'wangyd', '7f43125151e8b1304723629c', 'wukong@163.com', '', '', null, '', null, '2', '25', '2015-08-14 09:16:36', null);
INSERT INTO `blog_member` VALUES ('3', 'admin', '1568f875391635b43027bbd07b826ab1', '1112222@163.com', '', '', null, '', null, '3', '37', '2015-08-17 10:01:44', null);
INSERT INTO `blog_member` VALUES ('4', '孙悟空', '62e1f6670f1d9c7b366e1cd9c8a104fc', '123456', null, null, null, null, null, '3', '46', null, null);
INSERT INTO `blog_member` VALUES ('25', '哇哈哈', '6c79288beaa2e206bd41c567', 'wahaha@163.com', '', '', null, '', null, '3', '95', '2015-07-24 11:27:09', '2015-07-24 11:13:42');
INSERT INTO `blog_member` VALUES ('26', '崔大笨', '10c0d18966b2e38cd51d3622', 'ddff@163.com', '113443', 'sdfff', null, 'sdfsdf', null, '3', '27', '2015-08-12 16:15:53', '2015-08-12 10:00:48');
