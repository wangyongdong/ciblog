/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:32:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_role`
-- ----------------------------
DROP TABLE IF EXISTS `blog_role`;
CREATE TABLE `blog_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `role` varchar(64) DEFAULT NULL COMMENT '角色',
  `name` varchar(64) DEFAULT NULL COMMENT '角色名',
  `function` text COMMENT '角色权限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_role
-- ----------------------------
INSERT INTO `blog_role` VALUES ('1', 'super', '超级管理员', null);
INSERT INTO `blog_role` VALUES ('2', 'admin', '管理员', '{\"select\":[\"article\",\"sort\",\"record\",\"comment\",\"contant\",\"links\"],\"update\":[\"article\",\"sort\",\"record\",\"comment\",\"contant\",\"links\"]}');
INSERT INTO `blog_role` VALUES ('3', 'normal', '普通用户', '{\"select\":[\"article\",\"sort\",\"record\",\"comment\",\"contant\",\"links\"],\"update\":[\"article\"]}');
INSERT INTO `blog_role` VALUES ('4', 'visitor', '游客', '{\"select\":[\"article\",\"sort\",\"record\",\"member\"],\"update\":\"\"}');
INSERT INTO `blog_role` VALUES ('5', 'ban', '黑名单', null);
