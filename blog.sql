/*
Navicat MySQL Data Transfer

Source Server         : localhost__3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-08-17 19:24:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(10) unsigned NOT NULL,
  `module_name` char(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `monthy` char(7) NOT NULL COMMENT '文章发表于几年几月',
  `title` char(50) NOT NULL,
  `brief` char(255) DEFAULT NULL,
  `create_time` int(10) unsigned DEFAULT NULL,
  `update_time` int(10) unsigned DEFAULT NULL,
  `deleted` tinyint(1) unsigned DEFAULT '0' COMMENT '是否删除',
  `views` int(10) unsigned DEFAULT '1',
  `platform` char(255) DEFAULT NULL COMMENT '平台',
  `browserdesc` char(255) DEFAULT NULL,
  `is_sticktop` tinyint(1) unsigned DEFAULT '0',
  `ipaddress` char(255) DEFAULT NULL,
  `remark` char(255) DEFAULT NULL,
  `tag_ids` char(255) DEFAULT NULL,
  `tag_names` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for `article_has_modules`
-- ----------------------------
DROP TABLE IF EXISTS `article_has_modules`;
CREATE TABLE `article_has_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_has_modules
-- ----------------------------

-- ----------------------------
-- Table structure for `article_has_tags`
-- ----------------------------
DROP TABLE IF EXISTS `article_has_tags`;
CREATE TABLE `article_has_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_has_tags
-- ----------------------------

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(400) NOT NULL,
  `article_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `agreenum` int(10) unsigned DEFAULT NULL,
  `disagreenum` int(10) unsigned DEFAULT NULL,
  `reportnum` int(10) unsigned DEFAULT NULL,
  `address` char(255) DEFAULT NULL,
  `os` char(255) DEFAULT NULL,
  `osdesc` char(255) DEFAULT NULL,
  `brower` char(255) DEFAULT NULL,
  `browerdesc` char(255) DEFAULT NULL,
  `create_time` int(10) unsigned NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `floor` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------

-- ----------------------------
-- Table structure for `contact`
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weixin` char(255) DEFAULT NULL,
  `wexinimg` char(255) DEFAULT NULL,
  `weibo` char(255) DEFAULT NULL,
  `weiboimg` char(255) DEFAULT NULL,
  `qq` char(18) DEFAULT NULL,
  `facebook` char(255) DEFAULT NULL,
  `githup` char(255) DEFAULT NULL,
  `website` char(255) DEFAULT NULL,
  `steam` char(255) DEFAULT NULL,
  `twitter` char(255) DEFAULT NULL,
  `changba` char(255) DEFAULT NULL,
  `quanminkege` char(255) DEFAULT NULL,
  `linkedin` char(255) DEFAULT NULL,
  `email` char(255) DEFAULT NULL,
  `tel` char(11) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contact
-- ----------------------------

-- ----------------------------
-- Table structure for `content`
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `article_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------

-- ----------------------------
-- Table structure for `module`
-- ----------------------------
DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_tag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_nav` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用于区分是导航还是网站推荐',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('24', '子模块', '22', '0', '0', '0');
INSERT INTO `module` VALUES ('2', '前端', '0', '0', '0', '1');
INSERT INTO `module` VALUES ('3', 'html5', '2', '0', '1', '0');
INSERT INTO `module` VALUES ('4', 'css3', '2', '0', '1', '0');
INSERT INTO `module` VALUES ('5', 'js', '2', '0', '1', '0');
INSERT INTO `module` VALUES ('6', '后端', '0', '0', '0', '1');
INSERT INTO `module` VALUES ('7', 'php', '6', '0', '1', '0');
INSERT INTO `module` VALUES ('8', 'java', '6', '0', '1', '0');
INSERT INTO `module` VALUES ('9', '移动端', '0', '0', '0', '1');
INSERT INTO `module` VALUES ('10', 'android', '9', '0', '1', '0');
INSERT INTO `module` VALUES ('11', 'ios', '9', '0', '1', '0');
INSERT INTO `module` VALUES ('12', '服务器/os', '0', '0', '0', '1');
INSERT INTO `module` VALUES ('13', 'linux', '12', '0', '1', '0');
INSERT INTO `module` VALUES ('14', 'apache', '12', '0', '1', '0');
INSERT INTO `module` VALUES ('15', 'nginx', '12', '0', '1', '0');
INSERT INTO `module` VALUES ('16', 'windows', '12', '0', '1', '0');
INSERT INTO `module` VALUES ('17', 'mac', '12', '0', '1', '0');
INSERT INTO `module` VALUES ('22', '123878', '0', '0', '0', '0');
INSERT INTO `module` VALUES ('23', '45689', '22', '1', '0', '0');
INSERT INTO `module` VALUES ('25', '建站工具', '0', '0', '0', '0');
INSERT INTO `module` VALUES ('26', '在线学习', '0', '0', '0', '0');
INSERT INTO `module` VALUES ('27', '国内', '26', '0', '0', '0');
INSERT INTO `module` VALUES ('28', '国外', '26', '0', '0', '0');
INSERT INTO `module` VALUES ('29', '生活娱乐', '0', '0', '0', '1');
INSERT INTO `module` VALUES ('30', '音乐', '29', '0', '1', '0');
INSERT INTO `module` VALUES ('31', '游戏', '29', '0', '1', '0');
INSERT INTO `module` VALUES ('32', '健身', '29', '0', '1', '0');

-- ----------------------------
-- Table structure for `monthly`
-- ----------------------------
DROP TABLE IF EXISTS `monthly`;
CREATE TABLE `monthly` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `month` char(7) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of monthly
-- ----------------------------
INSERT INTO `monthly` VALUES ('1', '2017-08', '0');

-- ----------------------------
-- Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', 'ajax', '5', '0');
INSERT INTO `tags` VALUES ('2', 'curl', '7', '0');
INSERT INTO `tags` VALUES ('3', 'vue', '5', '0');
INSERT INTO `tags` VALUES ('4', 'vim', '13', '0');
INSERT INTO `tags` VALUES ('5', 'composer', '7', '0');
INSERT INTO `tags` VALUES ('6', '定位', '4', '0');
INSERT INTO `tags` VALUES ('20', 'were', '4', '0');
INSERT INTO `tags` VALUES ('19', 'websokit', '7', '0');
INSERT INTO `tags` VALUES ('18', '动画', '4', '0');
INSERT INTO `tags` VALUES ('17', 'gd2', '7', '0');
INSERT INTO `tags` VALUES ('21', 'tag', '23', '1');
INSERT INTO `tags` VALUES ('22', 'tag2', '23', '1');
INSERT INTO `tags` VALUES ('23', '新标签2', '24', '0');
INSERT INTO `tags` VALUES ('24', 'fsdfsdfsdf', '4', '0');
INSERT INTO `tags` VALUES ('25', '自标签', '3', '0');
INSERT INTO `tags` VALUES ('26', 'sdfsdfsdf', '4', '0');
INSERT INTO `tags` VALUES ('27', 'erbiaoqi', '3', '0');
INSERT INTO `tags` VALUES ('28', 'jq', '5', '0');
INSERT INTO `tags` VALUES ('29', 'sdf', '3', '0');
INSERT INTO `tags` VALUES ('30', '123', '4', '0');
INSERT INTO `tags` VALUES ('36', '新标签', '3', '0');
INSERT INTO `tags` VALUES ('37', '另一个新标签', '3', '0');

-- ----------------------------
-- Table structure for `usedname`
-- ----------------------------
DROP TABLE IF EXISTS `usedname`;
CREATE TABLE `usedname` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `used_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usedname
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1：githup  2：新浪微博 3：weixin 4：qq',
  `name` char(32) NOT NULL,
  `avatar` char(255) DEFAULT '' COMMENT '头像',
  `openid` char(255) NOT NULL,
  `access_token` char(255) NOT NULL DEFAULT '' COMMENT 'access_token token',
  `pwd` char(32) NOT NULL,
  `level` tinyint(255) unsigned DEFAULT '0',
  `position` char(255) DEFAULT '' COMMENT '职位',
  `reg_time` int(10) unsigned DEFAULT NULL,
  `last_login_ip` char(16) DEFAULT NULL,
  `last_login_time` int(10) unsigned DEFAULT NULL,
  `login_times` int(6) unsigned DEFAULT NULL,
  `email` char(255) DEFAULT '',
  `is_admin` tinyint(1) unsigned DEFAULT '0' COMMENT '是否是管理员',
  `address` char(255) DEFAULT '' COMMENT '联系地址',
  `signature` char(255) DEFAULT '' COMMENT '个性签名',
  `gender` tinyint(1) unsigned DEFAULT '0' COMMENT '性别1男0女',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '0', '1', 'tjc', null, '', '', '78354a342d40fc34f3ba825f26527f56', '1', null, null, null, null, null, null, '0', null, null, null);

-- ----------------------------
-- Table structure for `websites`
-- ----------------------------
DROP TABLE IF EXISTS `websites`;
CREATE TABLE `websites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `remark` char(255) DEFAULT NULL,
  `module_name` char(255) NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `create_time` int(10) unsigned NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of websites
-- ----------------------------
INSERT INTO `websites` VALUES ('1', '123', 'http', null, '', '22', '1501837864', '1');
INSERT INTO `websites` VALUES ('2', 'test2', 'http://www.93jc.pw4', null, '123878->子模块', '24', '1501838482', '1');
INSERT INTO `websites` VALUES ('3', 'reealy', 'http://www.93jc.pw', null, '123878->子模块', '24', '1501838551', '1');
INSERT INTO `websites` VALUES ('4', 'yes', '123', null, '123878->子模块', '24', '1501838672', '1');
INSERT INTO `websites` VALUES ('5', '百度', 'http://www.baidu.com', null, '123878->子模块', '24', '1501839008', '0');
INSERT INTO `websites` VALUES ('6', '摩客网', 'http://www.google.com', null, '123878->子模块', '24', '1501840168', '0');
INSERT INTO `websites` VALUES ('7', '网易云课堂', 'http://www.93jc.pw', null, '在线学习->国内', '27', '1501841833', '0');
INSERT INTO `websites` VALUES ('8', 'w3c', 'http://www.93jc.pw', null, '在线学习->国外', '28', '1501841849', '0');
INSERT INTO `websites` VALUES ('9', '122', '53153', 'sdfdsfsdf', '建站工具', '25', '1501848494', '1');
INSERT INTO `websites` VALUES ('10', '122', '53153', null, '建站工具', '25', '1501848689', '1');
INSERT INTO `websites` VALUES ('11', '121425', '62538', '+2+6', '建站工具', '25', '1501848717', '1');
INSERT INTO `websites` VALUES ('12', 'sdfsdf', 'sdfsdf', 'sdfsdf123', '在线学习->国内', '27', '1501938338', '1');

-- ----------------------------
-- Table structure for `words`
-- ----------------------------
DROP TABLE IF EXISTS `words`;
CREATE TABLE `words` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` char(255) NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of words
-- ----------------------------
INSERT INTO `words` VALUES ('1', 'dfdsf dsfds', '0', '1501938301');
INSERT INTO `words` VALUES ('2', 'sdfsdfsdfsdfsdfsdfsd', '0', '1501938304');
INSERT INTO `words` VALUES ('3', 'dsfsdfsdfsdfsdf1232', '0', '1501938309');
