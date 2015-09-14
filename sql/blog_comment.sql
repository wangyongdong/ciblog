/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:31:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_comment`
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reply_id` int(11) DEFAULT '0' COMMENT '回复id',
  `comment_id` int(11) DEFAULT '0' COMMENT '评论id',
  `userid` int(11) DEFAULT '0' COMMENT 'userid',
  `author` varchar(255) DEFAULT NULL COMMENT '作者名',
  `email` varchar(255) DEFAULT NULL COMMENT 'email',
  `url` varchar(255) DEFAULT NULL COMMENT '用户连接',
  `content` text COMMENT '评论内容',
  `status` enum('hide','show') DEFAULT 'show',
  `is_read` enum('Y','N') DEFAULT 'N',
  `ip` varchar(64) DEFAULT NULL,
  `useragent` text,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_comment
-- ----------------------------
INSERT INTO `blog_comment` VALUES ('1', '0', '64', '1', '王永东', '', '', '顶顶顶顶', 'show', 'Y', '0', '0', '2015-06-30 10:09:10');
INSERT INTO `blog_comment` VALUES ('6', '0', '64', '1', '王永东', '', '', '@王永东：低调点', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-06-30 10:19:42');
INSERT INTO `blog_comment` VALUES ('29', '0', '33', '0', '低调点', 'sddds@163.com', 'www.baidu.com', '时代复分', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-01 09:31:49');
INSERT INTO `blog_comment` VALUES ('31', '0', '33', '0', '时代复分', 'sddds@163.com', 'http://www.baidu.com', '韩国哈哈哈', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-01 09:33:29');
INSERT INTO `blog_comment` VALUES ('32', '0', '33', '0', '是多大的', 'sddds@163.com', 'http://www.sina.com.cn', '规范和经费贵航股份', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-01 09:37:00');
INSERT INTO `blog_comment` VALUES ('60', '0', '70', '0', '火狐', 'sddds@163.com', '', '的腹股沟', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 11:40:56');
INSERT INTO `blog_comment` VALUES ('61', '0', '70', '0', '官方', 'sddds@163.com', 'http://www.baidu.com', '侠盗飞车', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 11:41:20');
INSERT INTO `blog_comment` VALUES ('62', '0', '70', '0', '的股份', 'sddds@163.com', 'http://emlog.local', 'sdsdf', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 11:41:38');
INSERT INTO `blog_comment` VALUES ('67', '0', '64', '0', '释放到', 'sddds@163.com', '', '撒打发地方', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 13:50:55');
INSERT INTO `blog_comment` VALUES ('68', '49', '5', '0', '王永东', null, null, '@孙涛 啥顶顶顶顶', 'show', 'Y', null, null, '2015-07-02 15:38:38');
INSERT INTO `blog_comment` VALUES ('69', '0', '56', '1', '王永东', '', '', '@我啊 大声地', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 15:12:06');
INSERT INTO `blog_comment` VALUES ('70', '49', '5', '0', '王永东', null, null, '@孙涛 地方很多黄', 'show', 'Y', null, null, '2015-07-07 15:38:42');
INSERT INTO `blog_comment` VALUES ('71', '67', '64', '1', '王永东', null, null, '@释放到 按时大大大', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 15:34:14');
INSERT INTO `blog_comment` VALUES ('72', '61', '70', '1', '王永东', null, null, '@官方 ', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 15:34:21');
INSERT INTO `blog_comment` VALUES ('73', '0', '49', '0', '阿盛大的', 'sddds@163.com', '', '撒旦法斯蒂芬', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 16:34:12');
INSERT INTO `blog_comment` VALUES ('74', '0', '49', '0', '时代复分', 'sddds@163.com', 'http://www.sina.com.cn', '洒大地', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 16:35:44');
INSERT INTO `blog_comment` VALUES ('75', '0', '51', '0', '啥飞洒地方', 'sddds@163.com', 'http://www.sina.com.cn', '阿斯达是的', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-02 16:37:49');
INSERT INTO `blog_comment` VALUES ('89', '0', '69', '0', '阿哥跟', 'sddds@163.com', '', '第三方刚撒地方', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 15:48:18');
INSERT INTO `blog_comment` VALUES ('90', '0', '69', '0', '刚的嘎嘎嘎', 'sddds@163.com', '', '第三方菲菲进和规划局，电饭锅。', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 15:49:03');
INSERT INTO `blog_comment` VALUES ('91', '0', '69', '0', '小明明', 'sddds@163.com', '', '时代复分，飞得高蝴蝶飞过。', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 15:50:39');
INSERT INTO `blog_comment` VALUES ('92', '0', '69', '0', '韩梅梅', 'sdsdf@sd.com', '', '阿斯顿，的腹股沟。撒地方公司的。', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 15:51:27');
INSERT INTO `blog_comment` VALUES ('93', '0', '69', '0', '李刚', 'sddds@163.com', '', '是否爱过我，我也真的不知道。', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 15:52:17');
INSERT INTO `blog_comment` VALUES ('94', '0', '69', '0', '张数', 'sdsdf@sd.com', '', '第三方，的腹股沟，第三方刚。', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 15:54:15');
INSERT INTO `blog_comment` VALUES ('95', '0', '69', '0', '陈强', 'sddds@163.com', '', 'sdfdf时代复分。', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 15:55:19');
INSERT INTO `blog_comment` VALUES ('96', '0', '69', '0', '刘峰', 'sddds@163.com', '', '时代复分，撒地方撒旦<img src=\\\"/public/plugin/qqface/face/8.gif\\\" border=\\\"0\\\" />阿盛大的，电饭锅。', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 15:57:14');
INSERT INTO `blog_comment` VALUES ('97', '0', '69', '0', '楚星', 'sddds@163.com', '', '施工方四方达<img src=\\\"/public/plugin/qqface/face/5.gif\\\" border=\\\"0\\\" />阿大声道。', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 15:58:48');
INSERT INTO `blog_comment` VALUES ('98', '0', '69', '0', '孙立', 'sddds@163.com', '', '撒旦<img src=\\\"/public/plugin/qqface/face/8.gif\\\" border=\\\"0\\\" />阿盛sdddd声地工大的', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 16:00:36');
INSERT INTO `blog_comment` VALUES ('99', '0', '69', '0', '地方死光光', 'sddds@163.com', '', 'sdff', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 16:02:54');
INSERT INTO `blog_comment` VALUES ('100', '0', '69', '0', 'add', 'sddds@163.com', '', '<img src=\\\'/public/plugin/qqface/face/35.gif\\\' border=\\\'0\\\' />', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 16:03:07');
INSERT INTO `blog_comment` VALUES ('101', '0', '5', '0', '时代复分', 'sddds@163.com', '', '撒地方菲菲', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 17:50:14');
INSERT INTO `blog_comment` VALUES ('102', '0', '67', '0', '辅导费', 'sddds@163.com', '', '好。不错的<img src=\\\"/public/plugin/qqface/face/13.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 17:56:35');
INSERT INTO `blog_comment` VALUES ('105', '0', '67', '0', '时代复分', 'sddds@163.com', '', '时代复分<img src=\\\"/public/plugin/qqface/face/4.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 18:03:19');
INSERT INTO `blog_comment` VALUES ('106', '0', '67', '0', '阿盛大的', 'sdsdf@sd.com', '', '的方法<img src=\\\"/public/plugin/qqface/face/25.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-06 18:07:53');
INSERT INTO `blog_comment` VALUES ('107', '0', '69', '0', '沙度飞斧', 'sddds@163.com', '', '洒大地<img src=\\\"/public/plugin/qqface/face/5.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-07 10:23:38');
INSERT INTO `blog_comment` VALUES ('108', '0', '50', '0', '撒旦', 'sddds@163.com', '', '沙度飞斧，阿斯顿<img src=\\\"/public/plugin/qqface/face/5.gif\\\" border=\\\"0\\\" />。', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '2015-07-07 10:56:15');
INSERT INTO `blog_comment` VALUES ('111', '0', '64', '0', '阿盛大的的撒发生', 'sddds@163.com', '', '<img src=\\\"/public/plugin/qqface/face/19.gif\\\" border=\\\"0\\\" />阿盛大的', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-09 17:08:58');
INSERT INTO `blog_comment` VALUES ('113', '114', '51', '0', '上传的打三分', 'sdsdf@sd.com', '', '谁和你闹啊，切<img src=\\\"/public/plugin/qqface/face/18.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', '2015-07-22 17:29:29');
INSERT INTO `blog_comment` VALUES ('114', '0', '54', '0', '破哦', 'wydman@163.com', '', '你可别闹了，哈哈。。。<img src=\\\"/public/plugin/qqface/face/18.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'undefined', '2015-07-09 17:11:12');
INSERT INTO `blog_comment` VALUES ('115', '111', '64', '1', '王永东', null, null, '嘎嘎', 'hide', 'Y', '127.0.0.1', 'undefined', '2015-07-23 14:05:51');
INSERT INTO `blog_comment` VALUES ('119', '115', '64', '1', '王永东', '', '', '傻不傻', 'hide', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', '2015-08-10 15:01:39');
INSERT INTO `blog_comment` VALUES ('124', '123', '64', '1', '王永东', null, null, '顶顶顶顶', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-17 10:00:28');
INSERT INTO `blog_comment` VALUES ('125', '124', '64', '1', '王永东', null, null, 'ggg', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-18 10:42:03');
INSERT INTO `blog_comment` VALUES ('130', '125', '64', '1', '王永东', null, null, 'asdd<img src=\\\"http://ciblog.local/public/plugin/qqface/face/2.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-18 11:00:24');
INSERT INTO `blog_comment` VALUES ('131', '0', '64', '0', '宋小宝', 'wydman@163.com', null, '哈哈<img src=\\\"http://ciblog.local/public/plugin/qqface/face/9.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-18 11:01:27');
INSERT INTO `blog_comment` VALUES ('148', '131', '64', '1', '王永东', null, null, '凑，我怎么知道啊，你问问其他人，或者上网。<img src=\\\"http://ciblog.local/public/plugin/qqface/face/9.gif\\\" border=\\\"0\\\" /><img src=\\\"http://ciblog.local/public/plugin/qqface/face/9.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:41:37');
INSERT INTO `blog_comment` VALUES ('149', '131', '64', '1', '王永东', null, null, '啊撒旦谁', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:43:53');
INSERT INTO `blog_comment` VALUES ('150', '131', '64', '1', '王永东', null, null, '我也不太清楚啊', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-19 17:58:14');
INSERT INTO `blog_comment` VALUES ('151', '0', '69', '1', '王永东', '1112222@163.com', '', '顶顶顶顶顶顶顶顶顶梵蒂冈<img src=\\\"/public/plugin/qqface/face/2.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 15:49:45');
INSERT INTO `blog_comment` VALUES ('152', '0', '69', '0', '阿盛大的', '1112222@163.com', '', '发生的股份分<img src=\\\"/public/plugin/qqface/face/5.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 15:51:25');
INSERT INTO `blog_comment` VALUES ('153', '0', '69', '0', '阿盛大的', '1112222@163.com', '', '萨顶顶的', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 15:53:02');
INSERT INTO `blog_comment` VALUES ('154', '0', '69', '0', '时代复分', '1112222@163.com', 'http://www.baidu.com', '阿斯顿飞凤飞飞反复<img src=\\\"http://ciblog.local/public/plugin/qqface/face/4.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 15:53:17');
INSERT INTO `blog_comment` VALUES ('155', '0', '88', '0', 'asddd', '1112222@163.com', '', '撒地方股份', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 16:13:16');
INSERT INTO `blog_comment` VALUES ('156', '0', '88', '0', '阿盛大的', '1112222@163.com', '', '梵蒂冈的腹股沟<img src=\\\"http://ciblog.local/public/plugin/qqface/face/21.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 16:13:27');
INSERT INTO `blog_comment` VALUES ('157', '0', '88', '0', '刚放寒假', '1112222@163.com', '', '风光好黄飞鸿', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 16:13:37');
INSERT INTO `blog_comment` VALUES ('158', '0', '88', '0', '科教科', '1112222@163.com', '', '股份等哈哈哈<img src=\\\"http://ciblog.local/public/plugin/qqface/face/1.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 16:13:52');
INSERT INTO `blog_comment` VALUES ('159', '0', '88', '0', '的方法', '1112222@163.com', '', '地方官喝红酒哈哈哈哈哈哈哈哈哈', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 16:14:04');
INSERT INTO `blog_comment` VALUES ('160', '0', '88', '0', '的非官方飞', '1112222@163.com', '', '电饭锅<img src=\\\"http://ciblog.local/public/plugin/qqface/face/50.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 16:14:18');
INSERT INTO `blog_comment` VALUES ('161', '0', '88', '0', 'dddd', '1112222@163.com', '', '阿盛大的<img src=\\\"/public/plugin/qqface/face/56.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 16:17:24');
INSERT INTO `blog_comment` VALUES ('164', '0', '60', '0', '导弹的', 'sd@163.com', '', 'ssss', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-31 14:03:19');
INSERT INTO `blog_comment` VALUES ('165', '154', '69', '0', '张蔷', '1112222@163.com', 'http://www.baidu.com', '同求，我也不知道。<img src=\\\"http://ciblog.local/public/plugin/qqface/face/4.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-24 15:53:17');
INSERT INTO `blog_comment` VALUES ('166', '165', '69', '1', '王永东', null, null, 'ddddddd', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-08-31 16:41:32');
INSERT INTO `blog_comment` VALUES ('167', '165', '69', '1', '王永东', null, null, '啊水水水水', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 09:44:46');
INSERT INTO `blog_comment` VALUES ('168', '154', '69', '0', '巨野', 'sd@163.com', '', '哈哈哈的股份', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 10:05:04');
INSERT INTO `blog_comment` VALUES ('169', '168', '69', '0', '光环', 'sd@163.com', '', '和梵蒂冈', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 10:06:02');
INSERT INTO `blog_comment` VALUES ('170', '153', '69', '0', '我看会', 'sd@163.com', '', 'kjjjjjjjjjjjjjjjjj', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 15:06:41');
INSERT INTO `blog_comment` VALUES ('171', '100', '69', '0', '欧克', 'sd@163.com', '', '红果果', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 15:55:11');
INSERT INTO `blog_comment` VALUES ('172', '100', '69', '0', '黑寡妇', 'sd@163.com', '', '哈哈哈地方', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 16:22:27');
INSERT INTO `blog_comment` VALUES ('173', '172', '69', '1', '王永东', 'sd@163.com', '', '官匪勾结', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 16:22:47');
INSERT INTO `blog_comment` VALUES ('174', '0', '69', '0', '的方法', 'df@163.com', '', '等更丰富', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 17:31:54');
INSERT INTO `blog_comment` VALUES ('175', '174', '69', '0', 'ddd', 'sd@163.com', '', '的方法', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 18:02:02');
INSERT INTO `blog_comment` VALUES ('176', '175', '69', '0', '捣蛋', 'sd@163.com', '', '孙菲菲', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-01 18:04:42');
INSERT INTO `blog_comment` VALUES ('179', '151', '69', '0', '惮烦', 'sd@163.com', '', '@吴京阿斯顿', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-02 10:25:52');
INSERT INTO `blog_comment` VALUES ('182', '151', '69', '0', '激光', 'sd@163.com', '', '@吴京：嘎嘎嘎嘎<img src=\\\"/public/plugin/qqface/face/20.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-02 10:28:29');
INSERT INTO `blog_comment` VALUES ('183', '0', '69', '0', 'sd', 'gh@163.com', '', '低调点', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-07 10:38:06');
INSERT INTO `blog_comment` VALUES ('184', '0', '69', '1', '王永东', 'asdsd@16.com', '', '真的吗<img src=\\\"/public/plugin/qqface/face/9.gif\\\" border=\\\"0\\\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-07 10:55:33');
INSERT INTO `blog_comment` VALUES ('189', '0', '69', '0', 'sd', 'asdsd@16.com', '', '是多大的', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-07 15:37:23');
INSERT INTO `blog_comment` VALUES ('190', '0', '69', '0', '打首胜', 'dffff@163.com', '', '跟谁俩呢，<img src=\"/public/plugin/qqface/face/36.gif\" border=\"0\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-07 16:05:12');
INSERT INTO `blog_comment` VALUES ('191', '0', '69', '0', '火箭', 'asdsd@16.com', '', '撒地方<img src=\"/public/plugin/qqface/face/70.gif\" border=\"0\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-07 16:09:12');
INSERT INTO `blog_comment` VALUES ('192', '0', '69', '0', '萨芬', 'asdsd@16.com', '', '国服<img src=\"/public/plugin/qqface/face/38.gif\" border=\"0\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-07 16:13:10');
INSERT INTO `blog_comment` VALUES ('193', '192', '69', '0', '撒地方', 'asdsd@16.com', 'http://www.baidu.com', '的凤飞飞飞<img src=\"/public/plugin/qqface/face/55.gif\" border=\"0\" />', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-07 16:13:32');
INSERT INTO `blog_comment` VALUES ('194', '0', '53', '0', '是的', 'asdsd@16.com', '', 'ssss', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-07 16:33:53');
INSERT INTO `blog_comment` VALUES ('195', '0', '55', '0', 'sdd', 'asdsd@16.com', '', 'sddd', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-09 09:28:39');
INSERT INTO `blog_comment` VALUES ('196', '195', '55', '0', '你猜猜', 'wydman@163.com', '', 'sddd', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-09 09:28:48');
INSERT INTO `blog_comment` VALUES ('197', '196', '55', '1', '王永东', null, null, '嗯，对啊，我知道的就是这样子了', 'show', 'Y', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '2015-09-09 14:07:30');
