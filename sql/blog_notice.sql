/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-09-14 10:31:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_notice`
-- ----------------------------
DROP TABLE IF EXISTS `blog_notice`;
CREATE TABLE `blog_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(64) DEFAULT NULL COMMENT '消息类型',
  `content` text COMMENT '消息内容',
  `status` enum('unread','read') DEFAULT 'unread' COMMENT '状态',
  `datetime` datetime DEFAULT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_notice
-- ----------------------------
INSERT INTO `blog_notice` VALUES ('38', 'contact', '用户  <font color=\"blue\">按时大大大</font> 给你留言了.', 'unread', '2015-08-24 14:57:15');
INSERT INTO `blog_notice` VALUES ('39', 'links', '有新的友情链接申请，请审核，<a href=\"http://ciblog.local/admin/links/update/34\" target=\"_blank\">去看看>></a>', 'read', '2015-08-24 14:59:55');
INSERT INTO `blog_notice` VALUES ('40', 'comment', '用户  <font color=\"blue\">吴京</font> 评论了您的文章.', 'unread', '2015-08-24 15:49:45');
INSERT INTO `blog_notice` VALUES ('41', 'comment', '用户  <font color=\"blue\">阿盛大的</font> 评论了您的文章.', 'unread', '2015-08-24 15:51:25');
INSERT INTO `blog_notice` VALUES ('42', 'comment', '用户  <font color=\"blue\">阿盛大的</font> 评论了您的文章.', 'read', '2015-08-24 15:53:02');
INSERT INTO `blog_notice` VALUES ('43', 'comment', '用户  <font color=\"blue\">时代复分</font> 评论了您的文章.', 'read', '2015-08-24 15:53:17');
INSERT INTO `blog_notice` VALUES ('44', 'comment', '用户  <font color=\"blue\">asddd</font> 评论了您的文章.', 'read', '2015-08-24 16:13:16');
INSERT INTO `blog_notice` VALUES ('45', 'comment', '用户  <font color=\"blue\">阿盛大的</font> 评论了您的文章.', 'read', '2015-08-24 16:13:27');
INSERT INTO `blog_notice` VALUES ('46', 'comment', '用户  <font color=\"blue\">刚放寒假</font> 评论了您的文章.', 'read', '2015-08-24 16:13:37');
INSERT INTO `blog_notice` VALUES ('47', 'comment', '用户  <font color=\"blue\">科教科</font> 评论了您的文章.', 'read', '2015-08-24 16:13:52');
INSERT INTO `blog_notice` VALUES ('48', 'comment', '用户  <font color=\"blue\">的方法</font> 评论了您的文章.', 'read', '2015-08-24 16:14:04');
INSERT INTO `blog_notice` VALUES ('49', 'comment', '用户  <font color=\"blue\">的非官方飞</font> 评论了您的文章.', 'read', '2015-08-24 16:14:18');
INSERT INTO `blog_notice` VALUES ('50', 'comment', '用户  <font color=\"blue\">dddd</font> 评论了您的文章.', 'read', '2015-08-24 16:17:24');
INSERT INTO `blog_notice` VALUES ('51', 'comment', '用户  <font color=\"blue\">低调点</font> 评论了您的文章.', 'read', '2015-08-28 13:34:24');
INSERT INTO `blog_notice` VALUES ('52', 'comment', '用户  <font color=\"blue\">导弹的</font> 评论了您的文章.', 'unread', '2015-08-31 14:03:19');
INSERT INTO `blog_notice` VALUES ('53', 'comment', '用户  <font color=\"blue\">巨野</font> 评论了您的文章.', 'unread', '2015-09-01 10:05:04');
INSERT INTO `blog_notice` VALUES ('54', 'comment', '用户  <font color=\"blue\">光环</font> 评论了您的文章.', 'unread', '2015-09-01 10:06:02');
INSERT INTO `blog_notice` VALUES ('55', 'comment', '用户  <font color=\"blue\">我看会</font> 评论了您的文章.', 'unread', '2015-09-01 15:06:41');
INSERT INTO `blog_notice` VALUES ('56', 'comment', '用户  <font color=\"blue\">欧克</font> 评论了您的文章.', 'unread', '2015-09-01 15:55:11');
INSERT INTO `blog_notice` VALUES ('57', 'comment', '用户  <font color=\"blue\">黑寡妇</font> 评论了您的文章.', 'unread', '2015-09-01 16:22:27');
INSERT INTO `blog_notice` VALUES ('58', 'comment', '用户  <font color=\"blue\">火狐</font> 评论了您的文章.', 'unread', '2015-09-01 16:22:47');
INSERT INTO `blog_notice` VALUES ('59', 'comment', '用户  <font color=\"blue\">的方法</font> 评论了您的文章.', 'unread', '2015-09-01 17:31:54');
INSERT INTO `blog_notice` VALUES ('60', 'comment', '用户  <font color=\"blue\">ddd</font> 评论了您的文章.', 'unread', '2015-09-01 18:02:02');
INSERT INTO `blog_notice` VALUES ('61', 'comment', '用户  <font color=\"blue\">捣蛋</font> 评论了您的文章.', 'unread', '2015-09-01 18:04:42');
INSERT INTO `blog_notice` VALUES ('62', 'comment', '用户  <font color=\"blue\">韩国</font> 评论了您的文章.', 'unread', '2015-09-02 10:23:17');
INSERT INTO `blog_notice` VALUES ('63', 'comment', '用户  <font color=\"blue\">欧克</font> 评论了您的文章.', 'unread', '2015-09-02 10:24:49');
INSERT INTO `blog_notice` VALUES ('64', 'comment', '用户  <font color=\"blue\">惮烦</font> 评论了您的文章.', 'unread', '2015-09-02 10:25:52');
INSERT INTO `blog_notice` VALUES ('65', 'comment', '用户  <font color=\"blue\">df</font> 评论了您的文章.', 'unread', '2015-09-02 10:26:37');
INSERT INTO `blog_notice` VALUES ('66', 'comment', '用户  <font color=\"blue\">asddd</font> 评论了您的文章.', 'unread', '2015-09-02 10:26:58');
INSERT INTO `blog_notice` VALUES ('67', 'comment', '用户  <font color=\"blue\">激光</font> 评论了您的文章.', 'unread', '2015-09-02 10:28:29');
INSERT INTO `blog_notice` VALUES ('68', 'comment', '用户  <font color=\"blue\">sd</font> 评论了您的文章.', 'unread', '2015-09-07 10:38:06');
INSERT INTO `blog_notice` VALUES ('69', 'comment', '用户  <font color=\"blue\">asdd</font> 评论了您的文章.', 'unread', '2015-09-07 10:55:33');
INSERT INTO `blog_notice` VALUES ('70', 'comment', '用户  <font color=\"blue\">dd</font> 评论了您的文章.', 'unread', '2015-09-07 15:07:20');
INSERT INTO `blog_notice` VALUES ('71', 'comment', '用户  <font color=\"blue\">sd</font> 评论了您的文章.', 'unread', '2015-09-07 15:08:45');
INSERT INTO `blog_notice` VALUES ('72', 'comment', '用户  <font color=\"blue\">sdgf</font> 评论了您的文章.', 'unread', '2015-09-07 15:27:23');
INSERT INTO `blog_notice` VALUES ('73', 'comment', '用户  <font color=\"blue\">sd</font> 评论了您的文章.', 'unread', '2015-09-07 15:29:38');
INSERT INTO `blog_notice` VALUES ('74', 'comment', '用户  <font color=\"blue\">sd</font> 评论了您的文章.', 'unread', '2015-09-07 15:37:23');
INSERT INTO `blog_notice` VALUES ('75', 'comment', '用户  <font color=\"blue\">打首胜</font> 评论了您的文章.', 'unread', '2015-09-07 16:05:12');
INSERT INTO `blog_notice` VALUES ('76', 'comment', '用户  <font color=\"blue\">火箭</font> 评论了您的文章.', 'unread', '2015-09-07 16:09:12');
INSERT INTO `blog_notice` VALUES ('77', 'comment', '用户  <font color=\"blue\">萨芬</font> 评论了您的文章.', 'unread', '2015-09-07 16:13:10');
INSERT INTO `blog_notice` VALUES ('78', 'comment', '用户  <font color=\"blue\">撒地方</font> 评论了您的文章.', 'unread', '2015-09-07 16:13:32');
INSERT INTO `blog_notice` VALUES ('79', 'comment', '用户  <font color=\"blue\">是的</font> 评论了您的文章.', 'unread', '2015-09-07 16:33:53');
INSERT INTO `blog_notice` VALUES ('80', 'comment', '用户  <font color=\"blue\">sdd</font> 评论了您的文章.', 'unread', '2015-09-09 09:28:39');
INSERT INTO `blog_notice` VALUES ('81', 'comment', '用户  <font color=\"blue\">fdgdfg</font> 评论了您的文章.', 'unread', '2015-09-09 09:28:48');
INSERT INTO `blog_notice` VALUES ('82', 'comment', '用户  <font color=\"blue\">嘎嘎嘎</font> 评论了您的文章.', 'unread', '2015-09-10 11:25:15');
INSERT INTO `blog_notice` VALUES ('83', 'comment', '用户  <font color=\"blue\">fdsg</font> 评论了您的文章.', 'unread', '2015-09-10 11:27:01');
