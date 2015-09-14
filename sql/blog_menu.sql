/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:31:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_menu`
-- ----------------------------
DROP TABLE IF EXISTS `blog_menu`;
CREATE TABLE `blog_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(64) DEFAULT NULL,
  `menu_alias` varchar(64) DEFAULT NULL,
  `menu_desc` varchar(255) DEFAULT NULL,
  `status` enum('show','hide') DEFAULT 'show',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_menu
-- ----------------------------
INSERT INTO `blog_menu` VALUES ('1', 'Home', 'home', null, 'show');
INSERT INTO `blog_menu` VALUES ('2', '闲言碎语', 'record', '删删写写，回回忆忆，虽无法行云流水，却也可碎言碎语。', 'show');
INSERT INTO `blog_menu` VALUES ('3', '学无止境', 'article', '我们长路漫漫，只因学无止境。', 'show');
INSERT INTO `blog_menu` VALUES ('4', '生活点滴', 'album', '点点滴滴去记录，记录的不是影像，而是生活。', 'show');
INSERT INTO `blog_menu` VALUES ('5', '我的作品', 'works', '在学习中不断前进，在创作中不断累积。', 'show');
INSERT INTO `blog_menu` VALUES ('6', 'Contact', 'contact', '你，生命中最重要的过客，之所以是过客，因为你未曾为我停留。', 'show');
INSERT INTO `blog_menu` VALUES ('7', '关于我', 'about', '像“草根”一样，紧贴着地面，低调的存在，冬去春来，枯荣无恙。', 'show');
INSERT INTO `blog_menu` VALUES ('8', '登录', 'login', '塞申斯ad', 'hide');
INSERT INTO `blog_menu` VALUES ('11', '导弹放到', 'sdds', '啥地方萨芬的', 'show');
INSERT INTO `blog_menu` VALUES ('12', '导弹放到sdf', 'sdds', '啥地方萨芬的', 'show');
INSERT INTO `blog_menu` VALUES ('13', 'AAAAAAAA', 'sd', '啥地方萨芬的sad', 'show');
INSERT INTO `blog_menu` VALUES ('14', '是否', 'sd', 'dsf', 'show');
INSERT INTO `blog_menu` VALUES ('15', 'asdd', 'fdsgdgf', 'gfddfgdfg', 'show');
