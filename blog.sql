/*
Navicat MySQL Data Transfer

Source Server         : localhost__3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-07-27 19:07:52
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '5', 'js', '1', '2017-07', '士大夫收到飞', '有25幅作品拿去投票，一次投票需要选16幅，单个作品一次投票只能选择一次。前面有个程序员捅了漏子，忘了把投票入库，有200个用户产生的投票序列为空。那么你会如何填补这个漏子？当然向上级反映情况。但是我们这里讨论的是技术，就是需要生成1-25之间的16个不重复的随机数，去填补。具体怎么设计函数呢？将随机数存入数组，再在数组中去除重复的值，即可生成一定数量的不重复随机数。', '1501150879', null, '0', '1', 'Windows 7', 'Chrome 59.0.3071.115', '0', '重庆市电信');
INSERT INTO `article` VALUES ('2', '5', 'js', '1', '2017-07', '士大夫收到飞', '有25幅作品拿去投票，一次投票需要选16幅，单个作品一次投票只能选择一次。前面有个程序员捅了漏子，忘了把投票入库，有200个用户产生的投票序列为空。那么你会如何填补这个漏子？当然向上级反映情况。但是我们这里讨论的是技术，就是需要生成1-25之间的16个不重复的随机数，去填补。具体怎么设计函数呢？将随机数存入数组，再在数组中去除重复的值，即可生成一定数量的不重复随机数。', '1501151217', null, '0', '1', 'Windows 7', 'Chrome 59.0.3071.115', '0', '重庆市电信');
INSERT INTO `article` VALUES ('3', '5', 'js', '1', '2017-07', '士大夫收到飞', '有25幅作品拿去投票，一次投票需要选16幅，单个作品一次投票只能选择一次。前面有个程序员捅了漏子，忘了把投票入库，有200个用户产生的投票序列为空。那么你会如何填补这个漏子？当然向上级反映情况。但是我们这里讨论的是技术，就是需要生成1-25之间的16个不重复的随机数，去填补。具体怎么设计函数呢？将随机数存入数组，再在数组中去除重复的值，即可生成一定数量的不重复随机数。', '1501151613', null, '0', '1', 'Windows 7', 'Chrome 59.0.3071.115', '0', '重庆市电信');
INSERT INTO `article` VALUES ('4', '5', 'js', '1', '2017-07', '士大夫收到飞', '有25幅作品拿去投票，一次投票需要选16幅，单个作品一次投票只能选择一次。前面有个程序员捅了漏子，忘了把投票入库，有200个用户产生的投票序列为空。那么你会如何填补这个漏子？当然向上级反映情况。但是我们这里讨论的是技术，就是需要生成1-25之间的16个不重复的随机数，去填补。具体怎么设计函数呢？将随机数存入数组，再在数组中去除重复的值，即可生成一定数量的不重复随机数。', '1501151683', null, '0', '1', 'Windows 7', 'Chrome 59.0.3071.115', '0', '重庆市电信');
INSERT INTO `article` VALUES ('5', '5', 'js', '1', '2017-07', '士大夫收到飞', '有25幅作品拿去投票，一次投票需要选16幅，单个作品一次投票只能选择一次。前面有个程序员捅了漏子，忘了把投票入库，有200个用户产生的投票序列为空。那么你会如何填补这个漏子？当然向上级反映情况。但是我们这里讨论的是技术，就是需要生成1-25之间的16个不重复的随机数，去填补。具体怎么设计函数呢？将随机数存入数组，再在数组中去除重复的值，即可生成一定数量的不重复随机数。', '1501152150', null, '0', '1', 'Windows 7', 'Chrome 59.0.3071.115', '0', '重庆市电信');

-- ----------------------------
-- Table structure for `article_has_modules`
-- ----------------------------
DROP TABLE IF EXISTS `article_has_modules`;
CREATE TABLE `article_has_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(10) unsigned NOT NULL,
  `article_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `content` longblob NOT NULL,
  `article_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------

-- ----------------------------
-- Table structure for `monthly`
-- ----------------------------
DROP TABLE IF EXISTS `monthly`;
CREATE TABLE `monthly` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `month` char(7) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of monthly
-- ----------------------------

-- ----------------------------
-- Table structure for `mudule`
-- ----------------------------
DROP TABLE IF EXISTS `mudule`;
CREATE TABLE `mudule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_nav` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `couldclick` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mudule
-- ----------------------------
INSERT INTO `mudule` VALUES ('1', '首页', '0', '0', '1', '1');
INSERT INTO `mudule` VALUES ('2', '前端', '0', '0', '1', '1');
INSERT INTO `mudule` VALUES ('3', 'html5', '2', '0', '1', '1');
INSERT INTO `mudule` VALUES ('4', 'css3', '2', '0', '1', '1');
INSERT INTO `mudule` VALUES ('5', 'js', '2', '0', '1', '1');
INSERT INTO `mudule` VALUES ('6', '后端', '0', '0', '1', '1');
INSERT INTO `mudule` VALUES ('7', 'php', '6', '0', '1', '1');
INSERT INTO `mudule` VALUES ('8', 'java', '6', '0', '1', '1');
INSERT INTO `mudule` VALUES ('9', '移动端', '0', '0', '1', '1');
INSERT INTO `mudule` VALUES ('10', 'android', '9', '0', '1', '1');
INSERT INTO `mudule` VALUES ('11', 'ios', '9', '0', '1', '1');
INSERT INTO `mudule` VALUES ('12', '服务器/os', '0', '0', '1', '1');
INSERT INTO `mudule` VALUES ('13', 'linux', '12', '0', '1', '1');
INSERT INTO `mudule` VALUES ('14', 'apache', '12', '0', '1', '1');
INSERT INTO `mudule` VALUES ('15', 'nginx', '12', '0', '1', '1');
INSERT INTO `mudule` VALUES ('16', 'windows', '12', '0', '1', '1');
INSERT INTO `mudule` VALUES ('17', 'mac', '12', '0', '1', '1');

-- ----------------------------
-- Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `for_article` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否是文章的标签',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', 'ajax', '5', '0', '1');
INSERT INTO `tags` VALUES ('2', 'curl', '7', '0', '1');
INSERT INTO `tags` VALUES ('3', 'vue', '5', '0', '1');
INSERT INTO `tags` VALUES ('4', 'vim', '13', '0', '1');
INSERT INTO `tags` VALUES ('5', 'composer', '7', '0', '1');
INSERT INTO `tags` VALUES ('6', '定位', '4', '0', '1');

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
  `name` char(32) NOT NULL,
  `pwd` char(32) NOT NULL,
  `level` tinyint(255) unsigned DEFAULT '0',
  `avatar` char(255) DEFAULT NULL,
  `reg_time` int(10) unsigned DEFAULT NULL,
  `position` char(255) DEFAULT NULL,
  `last_online` int(10) unsigned DEFAULT NULL,
  `address` char(255) DEFAULT NULL,
  `signature` char(255) DEFAULT NULL,
  `gender` char(255) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'tjc', '78354a342d40fc34f3ba825f26527f56', '1', null, null, null, '1501129344', null, null, null, null);

-- ----------------------------
-- Table structure for `websites`
-- ----------------------------
DROP TABLE IF EXISTS `websites`;
CREATE TABLE `websites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `remark` char(255) DEFAULT NULL,
  `module_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of websites
-- ----------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of words
-- ----------------------------
