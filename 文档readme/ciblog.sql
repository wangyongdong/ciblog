/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50144
Source Host           : 127.0.0.1:3306
Source Database       : ciblog

Target Server Type    : MYSQL
Target Server Version : 50144
File Encoding         : 65001

Date: 2015-06-09 14:39:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blog_article`
-- ----------------------------
DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE `blog_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` longtext NOT NULL COMMENT '内容',
  `type` int(10) NOT NULL DEFAULT '0' COMMENT '分类',
  `views` int(10) NOT NULL DEFAULT '0' COMMENT '阅读量',
  `comnum` int(10) NOT NULL DEFAULT '0' COMMENT '评论数',
  `password` varchar(255) DEFAULT NULL COMMENT '若有密码则是加密，没有则不加密',
  `hometop` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '首页置顶：n为不置顶，y为置顶',
  `sorttop` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '分类置顶：n为不置顶，y为置顶',
  `allow_remark` enum('n','y') NOT NULL DEFAULT 'y' COMMENT '默认y, 允许评论；n 不允许评论',
  `datetime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_article
-- ----------------------------
INSERT INTO `blog_article` VALUES ('59', '1', '顶顶顶顶顶顶顶顶顶顶顶顶顶顶', '<p>顶顶顶顶<br/></p>', '1', '1', '0', '', 'n', 'n', 'y', '2015-05-21 14:18:54');
INSERT INTO `blog_article` VALUES ('3', '1', '输入文章标题', '<p>阿斯达撒打算的<br/></p><p>  </p>', '1', '2', '0', '', 'n', 'n', 'y', '2014-12-15 03:33:00');
INSERT INTO `blog_article` VALUES ('4', '2', '第三方水电费圣达菲', '<p>阿斯顿发斯蒂芬打算发大水发送的<br/></p>', '1', '11', '0', '123', 'n', 'y', 'y', '2014-12-15 03:53:00');
INSERT INTO `blog_article` VALUES ('5', '1', 'xxxxx', '<p>啊实打实大阿萨德<br/></p>', '3', '32', '0', '345', 'n', 'y', 'y', '2014-12-15 07:51:00');
INSERT INTO `blog_article` VALUES ('7', '1', '输入文章标题', '<p>&nbsp;德萨发第三方<br/></p>', '1', '0', '0', '234', 'y', 'y', 'y', '2014-12-15 08:53:00');
INSERT INTO `blog_article` VALUES ('17', '1', '什么啊这是', '<p>你猜猜看啊，哈哈哈哈低调点<br/></p><p>飞<br/></p><p>的<br/></p><p>广告<br/></p><p>  </p>', '2', '19', '0', '', 'y', 'n', 'y', '2014-12-23 09:02:05');
INSERT INTO `blog_article` VALUES ('48', '1', 'asdasd', '<p>adasdasd<br/></p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-21 11:50:42');
INSERT INTO `blog_article` VALUES ('49', '1', 'asdsad', '<p>asdasdasd<br/></p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-21 11:51:29');
INSERT INTO `blog_article` VALUES ('50', '1', 'asdasdasdasd', '<p>asdasdasdasd<br/></p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-21 11:57:16');
INSERT INTO `blog_article` VALUES ('51', '1', '阿大声道', '<p>阿大声道<br/></p>', '1', '3', '0', '', 'n', 'n', 'y', '2015-05-21 14:01:44');
INSERT INTO `blog_article` VALUES ('52', '1', '阿斯顿撒', '<p>阿斯顿<br/></p>', '2', '0', '0', '', 'n', 'n', 'y', '2015-05-21 14:02:06');
INSERT INTO `blog_article` VALUES ('53', '1', '阿斯顿撒旦', '<p>阿斯达是的<br/></p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-21 14:02:16');
INSERT INTO `blog_article` VALUES ('54', '1', '阿斯达是的', '<p>阿斯顿啊啊<br/></p>', '4', '0', '0', '', 'n', 'n', 'y', '2015-05-21 14:02:24');
INSERT INTO `blog_article` VALUES ('55', '1', '啊大大', '<p>发生顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶<br/></p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-21 14:04:42');
INSERT INTO `blog_article` VALUES ('56', '1', '阿斯顿撒旦', '<p>阿斯顿顶顶顶<br/></p>', '2', '0', '0', '', 'n', 'n', 'y', '2015-05-21 14:10:27');
INSERT INTO `blog_article` VALUES ('57', '1', '阿斯顿四大', '<p>阿斯顿四大阿斯顿四大阿斯顿四大阿斯顿四大</p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-21 14:16:58');
INSERT INTO `blog_article` VALUES ('58', '1', '啊飒飒的的', '<p>阿斯顿顶顶顶顶顶顶顶顶顶<br/></p>', '3', '0', '0', '', 'n', 'n', 'y', '2015-05-21 14:18:31');
INSERT INTO `blog_article` VALUES ('60', '1', 'asddddd', '<p>asdasdasd&lt;script&gt;alert&#40;[removed]&#41;&lt;/script&gt;</p><p>  </p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-25 16:43:30');
INSERT INTO `blog_article` VALUES ('64', '1', 'ddd', '<p>sss<br/></p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-25 16:47:55');
INSERT INTO `blog_article` VALUES ('65', '1', '死大声地', '<p>阿斯顿<img alt=\"622762d0f703918ffbf5d8cc523d269759eec494.jpg\" src=\"/public/php/uploads/image/20150525/1432548248112463.jpg\" title=\"1432548248112463.jpg\"/></p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-25 18:04:09');
INSERT INTO `blog_article` VALUES ('63', '1', 'sssssss', '<p>ssddddddddd<br/></p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-25 16:46:42');
INSERT INTO `blog_article` VALUES ('66', '1', '阿斯顿', '<p>上的<img alt=\"u=2298223339,2856122093&fm=21&gp=0.jpg\" src=\"/public/uploads/image/20150525/1432548320333926.jpg\" title=\"1432548320333926.jpg\"/></p>', '1', '0', '0', '', 'n', 'n', 'y', '2015-05-25 18:05:21');
INSERT INTO `blog_article` VALUES ('67', '1', '低调点', '<p>顶顶顶顶sss<br/></p><p><br/></p><p>  </p>', '4', '0', '0', '123', 'n', 'n', 'y', '2015-05-26 13:58:00');
INSERT INTO `blog_article` VALUES ('70', '1', '哈哈天天开心是傻瓜，哇哈哈', '<p>影子是一个会撒谎的精灵，它在虚空中流浪和等待被发现之间;在存在与不存在之间Aaaasdasdadasdas<br/></p><p>  </p>', '3', '0', '0', '', 'n', 'n', 'y', '2015-05-26 15:52:12');
INSERT INTO `blog_article` VALUES ('69', '1', '黑色Html5个人博客模板主题sss', '<p>014第二版黑色Html5个人博客模板主题《如影随形》，如精灵般的影子会给人一种神秘的感觉。一张剪影图黑白搭配，如果整个网站用黑白灰三色，会显得比较太过沉重，于是，在选择亮色方面，用以红为主色，蓝为辅色。这样就铺上了一些神秘甚至有些俏皮的元素。\r\n\r\n如果你更喜欢用蓝色或者绿色，这也不错，替换关键的颜色值就行了，推荐颜色值<br/></p>', '2', '0', '0', '', 'n', 'n', 'y', '2015-05-26 16:32:17');

-- ----------------------------
-- Table structure for `blog_links`
-- ----------------------------
DROP TABLE IF EXISTS `blog_links`;
CREATE TABLE `blog_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `sitename` varchar(64) NOT NULL COMMENT '网站名称',
  `siteurl` varchar(255) NOT NULL COMMENT 'url地址',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `status` enum('hide','show') NOT NULL DEFAULT 'show' COMMENT '是否显示',
  `datetime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_links
-- ----------------------------
INSERT INTO `blog_links` VALUES ('1', '百度', 'http://www.baidu.com', '全球最大的中文搜索引擎', 'show', '2015-05-05 13:59:26');
INSERT INTO `blog_links` VALUES ('2', '网易', 'http://www.163.com', '中国领先的互联网技术公司，也是中国主要门户网站', 'show', '2015-05-06 13:59:31');
INSERT INTO `blog_links` VALUES ('3', '新浪', 'http://www.sina.com.cn', '全球华人社区的全球最大中文门户网站', 'show', '2015-05-12 13:59:35');
INSERT INTO `blog_links` VALUES ('4', '腾讯', 'http://www.qq.com', '深圳市腾讯计算机系统有限公司', 'show', '2015-05-15 13:59:40');
INSERT INTO `blog_links` VALUES ('5', '搜狐', 'http://www.sohu.com', '搜狐公司是中国领先的新媒体、通信及移动增值服务公司，是中文世界强劲的互联网品牌', 'show', '2015-05-17 13:59:44');
INSERT INTO `blog_links` VALUES ('6', '淘宝', 'http://www.taobao.com', '淘宝网是亚太地区较大的网络零售商圈', 'hide', '2015-05-19 13:59:49');

-- ----------------------------
-- Table structure for `blog_log`
-- ----------------------------
DROP TABLE IF EXISTS `blog_log`;
CREATE TABLE `blog_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `url` varchar(255) DEFAULT NULL COMMENT '访问地址',
  `ip` varchar(255) DEFAULT NULL COMMENT 'ip',
  `user_agent` text COMMENT '浏览器信息',
  `datetime` datetime DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_log
-- ----------------------------

-- ----------------------------
-- Table structure for `blog_member`
-- ----------------------------
DROP TABLE IF EXISTS `blog_member`;
CREATE TABLE `blog_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `password` varchar(128) NOT NULL COMMENT '密码',
  `email` varchar(128) DEFAULT NULL COMMENT '邮箱',
  `qq` int(20) DEFAULT NULL COMMENT 'qq',
  `nickname` varchar(64) DEFAULT NULL COMMENT '昵称',
  `address` varchar(64) DEFAULT NULL COMMENT '地址',
  `picname` varchar(128) DEFAULT NULL COMMENT '头像',
  `job` varchar(64) DEFAULT NULL COMMENT '工作',
  `sign` text COMMENT '签名',
  `about_me` text COMMENT '关于我',
  `role_id` int(11) DEFAULT '3' COMMENT '用户权限id',
  `datetime` datetime DEFAULT NULL COMMENT '添加时间',
  `updatetime` datetime DEFAULT NULL COMMENT '修改时间',
  `uniquely` int(10) DEFAULT NULL COMMENT '唯一标示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_member
-- ----------------------------
INSERT INTO `blog_member` VALUES ('1', '王永东', '33749684e35842a24af05c44', '4359992@qq.com', '43599923', '老大的幸福', '北京市-朝阳区', '14325427313263.jpg', 'web开发、PHP开发', 'Hello World', '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 人生就是一个得与失的过程，而我却是一个幸运者，得到的永远比失去的多。生活的压力迫使我放弃了轻松的前台接待，放弃了体面的编辑，换来虽有些蓬头垢面的\r\n工作，但是我仍然很享受那些熬得只剩下黑眼圈的日子，因为我在学习使用Photoshop、Flash、Dreamweaver、ASP、PHP、\r\nJSP...中激发了兴趣，然后越走越远....</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在这条路上，我要感谢三个人，第一个是我从事编辑的老板，是他给了我充分学习研究div的时间，第二个人是我的老师，如果不是街上的一\r\n次偶遇，如果不是因为我正缺钱，我不会去强迫自己做不会的事情，但是金钱的诱惑实在是抵挡不了，于是我选择了“接招”，东拼西凑的把一个网站做好了，当时\r\n还堪称佳作的网站至今已尘归尘土归土了。第三个人，我总说他是我的伯乐，因为我当初应聘技术员的时候，我说我什么都不会，但是他却给了我机会，而我就牢牢\r\n的把握了那次机会，直到现在如果不是我主动把域名和空间转出来，我会一直霸占着公司资源，免费下去（可我就偏偏不是喜欢爱占便宜的人，总感觉欠了就得\r\n还）...</p><p><br/></p>', '1', '2014-12-23 09:02:05', '2015-05-26 17:57:06', '1992');
INSERT INTO `blog_member` VALUES ('2', 'wangyd', '7f43125151e8b1304723629c', 'wukong@163.com', null, '悟空狠性感', null, null, null, 'sdsd', null, '2', null, '2015-05-27 09:32:52', '25');
INSERT INTO `blog_member` VALUES ('3', 'admin', '1568f875391635b43027bbd07b826ab1', '1112222', null, '', null, null, null, '', null, '3', null, '2015-02-03 10:23:59', '37');
INSERT INTO `blog_member` VALUES ('4', '孙悟空', '62e1f6670f1d9c7b366e1cd9c8a104fc', '123456', null, '', null, null, null, '1', null, '3', null, null, '46');
INSERT INTO `blog_member` VALUES ('12', 'admin123', 'f49c66e78740f0c4386f90861d58e4c6', '撒打发斯蒂芬', null, '低调点', null, null, null, '爱上飒飒啊', null, '3', '2015-02-03 10:20:45', '2015-04-27 11:46:15', '11');
INSERT INTO `blog_member` VALUES ('14', 'asd', '2d29920654a1cc87b8e2aaca531f37a2', '', null, '啊啊啊啊', null, null, null, '', null, '3', '2015-05-20 11:05:22', '2015-05-20 15:06:13', '69');
INSERT INTO `blog_member` VALUES ('17', '低调点', '2d0f8f53a23821439f65c5139bc71170', '', null, '啊啊啊啊', null, null, null, '', null, '2', '2015-05-20 15:28:51', '2015-05-26 17:25:39', '4');
INSERT INTO `blog_member` VALUES ('19', 'ASDASD', 'd09aa2e423ed37adc3a095fd', '', null, 'ASDASDDASasdasd', null, null, null, '', null, '4', '2015-05-26 14:57:48', '2015-05-26 17:25:47', '24');
INSERT INTO `blog_member` VALUES ('20', '顶顶顶顶', '0f0bda97003b52952a1b87e2', null, null, null, null, null, null, null, null, '3', '2015-05-26 17:23:58', null, '90');
INSERT INTO `blog_member` VALUES ('21', '爱迪生', 'fe356f09d2ec99b10753c296', null, null, null, null, null, null, null, null, '3', '2015-05-26 17:24:53', null, '60');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_menu
-- ----------------------------
INSERT INTO `blog_menu` VALUES ('1', '首页', 'index', null, 'show');
INSERT INTO `blog_menu` VALUES ('2', '说说', 'record', null, 'show');
INSERT INTO `blog_menu` VALUES ('3', '文章', 'article', null, 'hide');
INSERT INTO `blog_menu` VALUES ('4', '留言', 'boards', null, 'hide');
INSERT INTO `blog_menu` VALUES ('5', '登录', 'login', '塞申斯ad', 'show');

-- ----------------------------
-- Table structure for `blog_options`
-- ----------------------------
DROP TABLE IF EXISTS `blog_options`;
CREATE TABLE `blog_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `option_value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_options
-- ----------------------------
INSERT INTO `blog_options` VALUES ('1', 'sitename', '如影随形Aaaaaaaaa');
INSERT INTO `blog_options` VALUES ('2', 'sitesign', '影子是一个会撒谎的精灵，它在虚空中流浪和等待被发现之间;在存在与不存在之间Aaa');
INSERT INTO `blog_options` VALUES ('3', 'article_nums', '10');
INSERT INTO `blog_options` VALUES ('4', 'login_code', 'y');
INSERT INTO `blog_options` VALUES ('5', 'is_record', 'y');
INSERT INTO `blog_options` VALUES ('6', 'record_nums', '10');
INSERT INTO `blog_options` VALUES ('7', 'is_treply', 'y');
INSERT INTO `blog_options` VALUES ('8', 'reply_code', 'y');
INSERT INTO `blog_options` VALUES ('9', 'is_chkreply', 'y');
INSERT INTO `blog_options` VALUES ('10', 'is_comment', 'y');
INSERT INTO `blog_options` VALUES ('11', 'comment_interval', '10');
INSERT INTO `blog_options` VALUES ('12', 'is_chkcomment', 'y');
INSERT INTO `blog_options` VALUES ('13', 'comment_code', 'y');
INSERT INTO `blog_options` VALUES ('14', 'is_gravatar', 'y');
INSERT INTO `blog_options` VALUES ('15', 'comment_paging', 'y');
INSERT INTO `blog_options` VALUES ('16', 'comment_pnum', '10');
INSERT INTO `blog_options` VALUES ('17', 'is_thumbnail', 'y');
INSERT INTO `blog_options` VALUES ('18', 'att_imgmaxw', '420');
INSERT INTO `blog_options` VALUES ('19', 'att_imgmaxh', '460');
INSERT INTO `blog_options` VALUES ('20', 'icp', 'asd');
INSERT INTO `blog_options` VALUES ('21', 'footer_info', '啊实打实大');
INSERT INTO `blog_options` VALUES ('22', 'site_title', 'AAA');
INSERT INTO `blog_options` VALUES ('23', 'site_key', 'BBC');
INSERT INTO `blog_options` VALUES ('24', 'site_description', 'DDD');
INSERT INTO `blog_options` VALUES ('25', 'templet', 'default');

-- ----------------------------
-- Table structure for `blog_record`
-- ----------------------------
DROP TABLE IF EXISTS `blog_record`;
CREATE TABLE `blog_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `content` text NOT NULL COMMENT '内容',
  `img` text NOT NULL COMMENT '图片',
  `agreenum` int(10) NOT NULL DEFAULT '0' COMMENT '赞的数量',
  `comnum` int(10) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `reply_id` int(11) DEFAULT '0' COMMENT '回复id',
  `datetime` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_record
-- ----------------------------
INSERT INTO `blog_record` VALUES ('2', '1', '<p>ddd<img src=\"http://img.baidu.com/hi/jx2/j_0057.gif\"/></p>', '', '0', '0', '0', '2015-05-13 15:40:24');
INSERT INTO `blog_record` VALUES ('8', '1', '<p>ggggggg<br/></p>', '', '0', '2', '0', '2015-05-14 12:01:12');
INSERT INTO `blog_record` VALUES ('34', '1', '@老大的幸福：嘎嘎嘎', '', '0', '0', '8', '2015-05-15 17:17:23');
INSERT INTO `blog_record` VALUES ('5', '1', '<p>顶顶顶顶顶顶顶顶顶顶<br/></p>', '', '0', '0', '0', '2015-05-14 11:50:36');
INSERT INTO `blog_record` VALUES ('10', '1', '回复你的啊', '', '0', '0', '8', '2015-05-15 15:00:02');
INSERT INTO `blog_record` VALUES ('31', '1', '很爱很爱哈哈很爱很爱哈哈很爱很爱哈哈很爱很爱哈', '', '0', '0', '0', '2015-05-15 17:09:45');
INSERT INTO `blog_record` VALUES ('26', '1', '阿斯达是的', '', '0', '0', '0', '2015-05-15 16:47:07');
INSERT INTO `blog_record` VALUES ('33', '1', '低调点', '', '0', '0', '0', '2015-05-15 17:15:46');

-- ----------------------------
-- Table structure for `blog_role`
-- ----------------------------
DROP TABLE IF EXISTS `blog_role`;
CREATE TABLE `blog_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `role_name` varchar(64) DEFAULT NULL COMMENT '角色名',
  `function` text COMMENT '角色权限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_role
-- ----------------------------
INSERT INTO `blog_role` VALUES ('1', 'super', null);
INSERT INTO `blog_role` VALUES ('2', 'admin', '[\"show\",\"article\",\"sort\",\"links\",\"record\",\"works\",\"setting\",\"site\"]');
INSERT INTO `blog_role` VALUES ('3', 'normal', '[\"show\",\"article\",\"sort\",\"links\",\"record\",\"works\",\"setting\"]');
INSERT INTO `blog_role` VALUES ('4', 'ban', null);

-- ----------------------------
-- Table structure for `blog_sort`
-- ----------------------------
DROP TABLE IF EXISTS `blog_sort`;
CREATE TABLE `blog_sort` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `sortname` varchar(64) NOT NULL COMMENT '分类名称',
  `description` text COMMENT '分类描述',
  `nums` int(10) NOT NULL DEFAULT '0' COMMENT '分类下文章数量',
  `alias` varchar(64) DEFAULT NULL COMMENT '别名',
  `datetime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_sort
-- ----------------------------
INSERT INTO `blog_sort` VALUES ('1', '1', '未分类', '默认分类', '23', 'default', '2015-05-19 14:34:16');
INSERT INTO `blog_sort` VALUES ('2', '1', '技术', '技术，知识，内容', '1', 'skill', '2015-05-19 17:34:19');
INSERT INTO `blog_sort` VALUES ('3', '1', '生活', '生活，感情，内容', '0', 'show', '2015-05-20 14:34:27');
INSERT INTO `blog_sort` VALUES ('4', '1', '感情', '人生的感悟啊啊', '1', 'good', '2015-05-20 20:34:30');

-- ----------------------------
-- Table structure for `blog_works`
-- ----------------------------
DROP TABLE IF EXISTS `blog_works`;
CREATE TABLE `blog_works` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `title` varchar(64) NOT NULL COMMENT '标题',
  `introduce` text NOT NULL COMMENT '作品介绍',
  `respon` text NOT NULL COMMENT '负责',
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
INSERT INTO `blog_works` VALUES ('1', '1', '1aaa', '挂号费股份', 'cccD', '', 'ddd', 'online', 'eee', 'fff', null);
INSERT INTO `blog_works` VALUES ('2', '1', '2AA', 'BB', 'FFF', null, 'CCC', 'learn', 'DDD', 'EEE', null);
INSERT INTO `blog_works` VALUES ('3', '1', '3qq', 'ww', 'ee', '', 'ff', 'online', 'dd', 'aa', '2015-05-20 13:49:07');
INSERT INTO `blog_works` VALUES ('5', '1', '4333', 'SSS', '4444', '', '555', 'learn', '666', '777', '2015-05-20 13:57:58');
INSERT INTO `blog_works` VALUES ('6', '1', '5AAA', 'BBBaaaa', 'CCC', '', 'DDD', 'online', 'EEE', 'FFF', '2015-05-20 13:59:14');
INSERT INTO `blog_works` VALUES ('7', '1', '6asdasd', 'asasdasd', 'asdasd', '', 'asdasd', 'online', 'asdasd', 'asdads', '2015-05-20 14:07:54');
INSERT INTO `blog_works` VALUES ('8', '1', '7阿斯达是的', '阿大声道', '死大声地', '', '阿盛大的', 'online', 'aaa', 'sss', '2015-05-22 16:48:53');
INSERT INTO `blog_works` VALUES ('9', '1', '8sss', 'ddd', 'fff', '', 'aaa', 'online', 'ffff', '', '2015-05-22 16:49:19');
INSERT INTO `blog_works` VALUES ('10', '1', '9ddd', 'fff', 'sss', '', 'aaa', 'online', '11', '22', '2015-05-22 16:50:07');
INSERT INTO `blog_works` VALUES ('11', '1', '10ddd', 'fff', 'ggg', '', 'aaa', 'online', 'sss', 'ddd', '2015-05-22 16:54:23');
INSERT INTO `blog_works` VALUES ('12', '1', '11sss', 'ddd', 'fff', '', 'aaa', 'online', 'ddd', 'sss', '2015-05-22 16:54:51');
INSERT INTO `blog_works` VALUES ('13', '1', '12sss', 'ddd', 'fff', '', 'ggg', 'online', 'aa', '11', '2015-05-22 16:55:29');
INSERT INTO `blog_works` VALUES ('14', '1', '13sdd', 'asdad', 'adad', '', 'asdasd', 'online', '111', '222', '2015-05-22 16:58:52');
INSERT INTO `blog_works` VALUES ('15', '1', '14asd', 'asd', 'asd', '', 'ads', 'online', 'ad', '', '2015-05-22 18:03:42');
INSERT INTO `blog_works` VALUES ('16', '1', '15adsasd', 'asdasdasdasd', 'asdasd', '', 'asdasd', 'online', 'adasd', 'asdasd', '2015-05-22 18:04:14');
INSERT INTO `blog_works` VALUES ('17', '1', '16阿斯达是的', '阿盛大的', '阿斯达是的', '', '阿斯顿', 'online', 'sss', 'ddd', '2015-05-22 18:08:04');
INSERT INTO `blog_works` VALUES ('18', '1', '17上的', 'sss', 'ddd', '', 'DDD', 'online', '1211', '222', '2015-05-22 18:10:51');
INSERT INTO `blog_works` VALUES ('19', '1', '18ddd', 'sss', 'ddd', '', 'ad', 'online', 'ad', 'asd', '2015-05-22 18:12:02');
INSERT INTO `blog_works` VALUES ('20', '1', '19adsasd', 'asdasd', 'sdfdsfdsa', '', 'sadfdsaf', 'online', '11', '222', '2015-05-22 18:14:33');
INSERT INTO `blog_works` VALUES ('22', '1', '20ddd', 'fff', 'ggg', '', 'asd', 'online', 'asd', 'asd', '2015-05-25 16:58:15');
INSERT INTO `blog_works` VALUES ('23', '1', '21dd', 'fff', 'ggg', '', 'aa', 'online', '11', '22', '2015-05-26 09:29:56');
INSERT INTO `blog_works` VALUES ('24', '1', '22ads', 'ad', 'ads', '', 'ads', 'online', 'asd', 'asd', '2015-05-26 14:27:38');
INSERT INTO `blog_works` VALUES ('25', '1', '23asd', 'asd', 'asd', '', 'asdasd', 'online', 'asd', 'asd', '2015-05-26 15:37:14');
INSERT INTO `blog_works` VALUES ('26', '1', '24asdddddd', 'ddd', 'ddd', '', 'ddddd', 'online', 'ddd', 'ddd', '2015-05-26 16:24:29');
INSERT INTO `blog_works` VALUES ('27', '1', '25asd', 'asd', 'asd', '', 'asd', 'online', 'asd', 'asd', '2015-05-26 16:49:00');
INSERT INTO `blog_works` VALUES ('28', '1', 'sa', 'sadf', 'sdf', null, 'dsf', 'learn', 'sdf', 'sdf', null);
INSERT INTO `blog_works` VALUES ('29', '1', 'dsf', 'dsf', 'dswf', null, null, 'learn', 'sdf', 'asd', null);
INSERT INTO `blog_works` VALUES ('30', '1', 'ds', 'sdfsd', 'sdf', null, null, 'learn', 'dsf', 'sdf', null);
INSERT INTO `blog_works` VALUES ('31', '1', 'sdf', 'sdf', 'dsf', null, null, 'learn', 'dsf', 'sdf', null);
INSERT INTO `blog_works` VALUES ('32', '1', 'dsf', 'jkj', 'jkj', null, null, 'learn', 'jkl', 'jk', null);
INSERT INTO `blog_works` VALUES ('33', '1', 'oiu', 'ui', 'kml', null, null, 'learn', 'ipi', 'pip', null);
