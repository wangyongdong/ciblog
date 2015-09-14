/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:32:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_works`
-- ----------------------------
DROP TABLE IF EXISTS `blog_works`;
CREATE TABLE `blog_works` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `title` varchar(64) NOT NULL COMMENT '标题',
  `description` text NOT NULL COMMENT '作品介绍',
  `respon` text NOT NULL COMMENT '负责',
  `summary` text COMMENT '总结',
  `img` varchar(255) DEFAULT NULL COMMENT '图片',
  `link` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `status` enum('learn','online') NOT NULL DEFAULT 'learn' COMMENT '作品是否上线',
  `date_start` varchar(64) NOT NULL COMMENT '开始时间',
  `date_end` varchar(64) NOT NULL COMMENT '结束时间',
  `datetime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_works
-- ----------------------------
INSERT INTO `blog_works` VALUES ('1', '1', '1aaa', '挂号费股份', 'cccD', null, '', 'ddd', 'online', 'eee', 'fff', null);
INSERT INTO `blog_works` VALUES ('2', '1', '2AA', 'BB', 'FFF', null, null, 'CCC', 'learn', 'DDD', 'EEE', null);
INSERT INTO `blog_works` VALUES ('3', '1', '3qq', 'ww', 'ee', null, '', 'ff', 'online', 'dd', 'aa', '2015-05-20 13:49:07');
INSERT INTO `blog_works` VALUES ('5', '1', '4333', 'SSS', '4444', null, '', '555', 'learn', '666', '777', '2015-05-20 13:57:58');
INSERT INTO `blog_works` VALUES ('6', '1', '5AAA', 'BBBaaaa', 'CCC', null, '', 'DDD', 'online', 'EEE', 'FFF', '2015-05-20 13:59:14');
INSERT INTO `blog_works` VALUES ('7', '1', '6asdasd', 'asasdasd', 'asdasd', null, '', 'asdasd', 'online', 'asdasd', 'asdads', '2015-05-20 14:07:54');
INSERT INTO `blog_works` VALUES ('8', '1', '7阿斯达是的', '阿大声道', '死大声地', null, '', '阿盛大的', 'online', 'aaa', 'sss', '2015-05-22 16:48:53');
INSERT INTO `blog_works` VALUES ('9', '1', '8sss', 'ddd', 'fff', null, '', 'aaa', 'online', 'ffff', '', '2015-05-22 16:49:19');
INSERT INTO `blog_works` VALUES ('10', '1', '9ddd', 'fff', 'sss', null, '', 'aaa', 'online', '11', '22', '2015-05-22 16:50:07');
INSERT INTO `blog_works` VALUES ('11', '1', '10ddd', 'fff', 'ggg', null, '', 'aaa', 'online', 'sss', 'ddd', '2015-05-22 16:54:23');
INSERT INTO `blog_works` VALUES ('12', '1', '11sss', 'ddd', 'fff', null, '', 'aaa', 'online', 'ddd', 'sss', '2015-05-22 16:54:51');
INSERT INTO `blog_works` VALUES ('13', '1', '12sss', 'ddd', 'fff', null, '', 'ggg', 'online', 'aa', '11', '2015-05-22 16:55:29');
INSERT INTO `blog_works` VALUES ('14', '1', '13sdd', 'asdad', 'adad', null, '', 'asdasd', 'online', '111', '222', '2015-05-22 16:58:52');
INSERT INTO `blog_works` VALUES ('15', '1', '14asd', 'asd', 'asd', null, '', 'ads', 'online', 'ad', '', '2015-05-22 18:03:42');
INSERT INTO `blog_works` VALUES ('16', '1', '15adsasd', 'asdasdasdasd', 'asdasd', null, '', 'asdasd', 'online', 'adasd', 'asdasd', '2015-05-22 18:04:14');
INSERT INTO `blog_works` VALUES ('17', '1', '16阿斯达是的', '阿盛大的', '阿斯达是的', null, '', '阿斯顿', 'online', 'sss', 'ddd', '2015-05-22 18:08:04');
INSERT INTO `blog_works` VALUES ('18', '1', '17上的', 'sss', 'ddd', null, '', 'DDD', 'online', '1211', '222', '2015-05-22 18:10:51');
INSERT INTO `blog_works` VALUES ('19', '1', '18ddd', 'sss', 'ddd', null, '', 'ad', 'online', 'ad', 'asd', '2015-05-22 18:12:02');
INSERT INTO `blog_works` VALUES ('20', '1', '19adsasd', 'asdasd', 'sdfdsfdsa', null, '', 'sadfdsaf', 'online', '11', '222', '2015-05-22 18:14:33');
INSERT INTO `blog_works` VALUES ('22', '1', '20ddd', 'fff', 'ggg', null, '', 'asd', 'online', 'asd', 'asd', '2015-05-25 16:58:15');
INSERT INTO `blog_works` VALUES ('23', '1', '21dd', 'fff', 'ggg', null, '', 'aa', 'online', '11', '22', '2015-05-26 09:29:56');
INSERT INTO `blog_works` VALUES ('24', '1', '22ads', 'ad', 'ads', null, '', 'ads', 'online', 'asd', 'asd', '2015-05-26 14:27:38');
INSERT INTO `blog_works` VALUES ('25', '1', '23asd', 'asd', 'asd', null, '', 'asdasd', 'online', 'asd', 'asd', '2015-05-26 15:37:14');
INSERT INTO `blog_works` VALUES ('26', '1', '24asdddddd', 'ddd', 'ddd', null, '', 'ddddd', 'online', 'ddd', 'ddd', '2015-05-26 16:24:29');
INSERT INTO `blog_works` VALUES ('27', '1', '25asd', 'asd', 'asd', null, '', 'asd', 'online', 'asd', 'asd', '2015-05-26 16:49:00');
INSERT INTO `blog_works` VALUES ('28', '1', 'sa', 'sadf', 'sdf', null, null, 'dsf', 'learn', 'sdf', 'sdf', null);
INSERT INTO `blog_works` VALUES ('29', '1', 'dsf', 'dsf', 'dswf', null, null, null, 'learn', 'sdf', 'asd', null);
INSERT INTO `blog_works` VALUES ('30', '1', 'ds', 'sdfsd', 'sdf', null, null, null, 'learn', 'dsf', 'sdf', null);
INSERT INTO `blog_works` VALUES ('31', '1', 'sdf', 'sdf', 'dsf', null, null, null, 'learn', 'dsf', 'sdf', null);
INSERT INTO `blog_works` VALUES ('32', '1', 'dsf', 'jkj', 'jkj', null, null, null, 'learn', 'jkl', 'jk', null);
INSERT INTO `blog_works` VALUES ('33', '1', '手机版烟悦网', '2014年是互联网教育高速发展的一年，网络教育的发展为普通网民降低了学习知识技能的门槛。酷汇网实现会员申请成为教师发布课程、试题；普通会员在酷汇网上直接购买收费课程参加相关课程的考试，免费课程可以直接观看，在观看课程时对课程进行评论或下载与课程相关联的附件资源。会员除了可以购买课程外，可以在酷汇笔记写笔记分享给好友，在酷汇文库中阅读、下载以及分享文档，也可以在酷汇部落中与其他会员相互交流学习。', '1、项目的规划、数据库表的分析与设计等\r\n2、SVN版本控制器管理\r\n3、首页、列表、详情页编写、布局及相关美化效果\r\n4、文库模块开发（包含评论）\r\n5、笔记模块开发（包含评论）\r\n6、视频播放权限与视频播放开发\r\n7、支付宝充值模块的开发', '本次项目使用OOP面对对象的编程思想，MVC的开发模式，使用ThinkPHP开发框架、Smarty模板引擎进行项目开发。在开发的过程中，使用SVN版本控制器提高了开发效率。前台使用ThinkPHP开发框架，后台使用J-UI框架，提高了开发效率。\r\n    ThinkPHP容易上手、分层架构清晰、系统兼容性强、高效的缓存机制、扩展性能强大；J-UI的界面友好、简单实用、扩展方便，唯一不足的就是文档太少。\r\n    在开发过程中，为提高用户体验度使用Ajax技术实现页面的局部刷新效果，使用pdf2swf与FlexPaper实现文档的在线阅读，使用CKplayer实现视频播放。后台基于J-UI框架，界面简洁清爽，在处理视频播放的时候对课程是否收费、用户是否登录做出了相应的判断限制。', '', 'http://www.baidu.com', 'learn', '2015-05-26', '2015-08-10', null);
