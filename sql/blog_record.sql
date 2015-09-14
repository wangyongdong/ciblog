/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:32:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_record`
-- ----------------------------
DROP TABLE IF EXISTS `blog_record`;
CREATE TABLE `blog_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `reply_id` int(11) DEFAULT '0' COMMENT '回复id',
  `content` text NOT NULL COMMENT '内容',
  `agreenum` int(10) NOT NULL DEFAULT '0' COMMENT '赞的数量',
  `comnum` int(10) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `datetime` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_record
-- ----------------------------
INSERT INTO `blog_record` VALUES ('2', '1', '0', '<p>ddd<img src=\"http://img.baidu.com/hi/jx2/j_0057.gif\"/></p>', '0', '0', '2015-05-13 15:40:24');
INSERT INTO `blog_record` VALUES ('8', '1', '0', '<p>ggggggg<br/></p>', '0', '0', '2015-05-14 12:01:12');
INSERT INTO `blog_record` VALUES ('5', '1', '0', '<p>顶顶顶顶顶顶顶顶顶顶<br/></p>', '0', '0', '2015-05-14 11:50:36');
INSERT INTO `blog_record` VALUES ('31', '1', '0', '很爱很爱哈哈很爱很爱哈哈很爱很爱哈哈很爱很爱哈', '0', '0', '2015-05-15 17:09:45');
INSERT INTO `blog_record` VALUES ('49', '1', '0', '<p>灌灌灌灌灌<br/></p>', '0', '3', '2015-06-29 11:18:31');
INSERT INTO `blog_record` VALUES ('50', '1', '0', '<p>风格和规范化<br/></p>', '0', '2', '2015-06-29 11:18:35');
INSERT INTO `blog_record` VALUES ('26', '1', '0', '阿斯达是的', '0', '0', '2015-05-15 16:47:07');
INSERT INTO `blog_record` VALUES ('73', '1', '0', '<p>dddd<br/></p>', '0', '0', '2015-08-12 14:20:28');
INSERT INTO `blog_record` VALUES ('51', '1', '0', '<p>的腹股沟<br/></p>', '0', '3', '2015-06-29 11:18:39');
INSERT INTO `blog_record` VALUES ('52', '1', '0', '<p>地负海涵<br/></p>', '0', '2', '2015-06-29 11:18:41');
INSERT INTO `blog_record` VALUES ('53', '1', '0', '<p>副高级<br/></p>', '0', '2', '2015-06-29 11:18:44');
INSERT INTO `blog_record` VALUES ('54', '1', '0', '<p>撒地方贵撒地方<br/></p>', '0', '3', '2015-06-29 11:18:46');
INSERT INTO `blog_record` VALUES ('55', '1', '0', '<p>看<br/></p>', '0', '2', '2015-06-29 11:18:49');
INSERT INTO `blog_record` VALUES ('56', '1', '0', '<p>手动改</p>', '0', '5', '2015-06-29 11:47:02');
INSERT INTO `blog_record` VALUES ('70', '1', '0', '<p><img src=\\\"http://img.baidu.com/hi/jx2/j_0061.gif\\\"/></p>', '0', '0', '2015-07-09 16:39:24');
INSERT INTO `blog_record` VALUES ('69', '1', '0', '<p><img alt=\\\"622762d0f703918ffbf5d8cc523d269759eec494.jpg\\\" src=\\\"/public/upload/image/20150709/1436431117342317.jpg\\\" title=\\\"1436431117342317.jpg\\\"/>asddd</p>', '0', '0', '2015-07-09 16:38:40');
INSERT INTO `blog_record` VALUES ('64', '1', '0', '<p>测试测试<br/></p>', '0', '9', '2015-06-29 16:35:06');
INSERT INTO `blog_record` VALUES ('71', '1', '0', '<p>回复广告<img src=\\\"http://img.baidu.com/hi/face/i_f01.gif\\\"/></p>', '0', '0', '2015-08-06 17:16:38');
INSERT INTO `blog_record` VALUES ('72', '1', '0', '<p><img src=\\\"/public/upload/image/20150807/1438912962117821.jpg\\\" title=\\\"1438912962117821.jpg\\\" alt=\\\"11986787346ec7b6ddo.jpg\\\"/></p>', '0', '0', '2015-08-07 10:02:57');
INSERT INTO `blog_record` VALUES ('74', '1', '0', '<p>顶顶顶顶<br/></p>', '0', '0', '2015-08-14 09:43:39');
INSERT INTO `blog_record` VALUES ('75', '1', '0', '<p>ddd<br/></p>', '0', '0', '2015-08-14 14:31:52');
INSERT INTO `blog_record` VALUES ('76', '1', '0', '<p>顶顶顶顶<br/></p>', '0', '0', '2015-08-14 17:43:35');
INSERT INTO `blog_record` VALUES ('77', '1', '0', '<p>顶顶顶顶<br/></p>', '0', '0', '2015-08-14 17:44:04');
INSERT INTO `blog_record` VALUES ('78', '1', '0', '<p>阿达撒大大<br/></p>', '0', '0', '2015-08-17 09:43:04');
