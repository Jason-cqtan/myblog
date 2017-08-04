/*
Navicat MySQL Data Transfer

Source Server         : localhost__3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-08-04 20:32:11
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
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '文章状态0草稿，1发布了',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '7', 'php', '1', '2017-08', '士大夫收到', '士大夫收到发送到', '1501761300', '1501761300', '0', '1', 'Windows 7', 'Chrome 60.0', '0', '重庆市电信', '士大夫收到', '17', 'gd2', '1');
INSERT INTO `article` VALUES ('2', '4', 'css3', '1', '2017-08', '这是标题', '发送到发送到发送到', '1501761359', '1501761359', '0', '1', 'Windows 7', 'Chrome 60.0', '0', '重庆市电信', '士大夫收到发送到', '6,18', '定位,动画', '1');
INSERT INTO `article` VALUES ('3', '7', 'php', '1', '2017-08', '这是标题', '是打发斯蒂芬士大夫收到是打发斯蒂芬士大夫收到是打发斯蒂芬士大夫收到是打发斯蒂芬士大夫收到', '1501761432', '1501761432', '0', '1', 'Windows 7', 'Chrome 60.0', '0', '重庆市电信', '这是备注', '2,19', 'curl,websokit', '1');
INSERT INTO `article` VALUES ('4', '4', 'css3', '1', '2017-08', 'zheshi basdfgsdf', 'sdfsdf ssdfsdfsdfsdf', '1501761816', '1501761816', '0', '1', 'Windows 7', 'Chrome 60.0', '0', '重庆市电信', 'sdfsdf sd', '18,20', '动画,were', '1');
INSERT INTO `article` VALUES ('5', '5', 'js', '1', '2017-08', 'sdfsdfsdfsdfsdf', '曾经看到过一篇文章，讲到的内容就是个人是如何通过创建一个博客，然后通过日积月累的更新文章，最后在百度中获得了不少的排名，并最终通过百度带的巨大流量中获得联盟广告的收益。现在国内流行恐怕就是：用Word', '1501762150', '1501762150', '0', '1', 'Windows 7', 'Chrome 60.0', '0', '重庆市电信', 'sdfsdfsdf', '1,3', 'ajax,vue', '1');

-- ----------------------------
-- Table structure for `article_has_modules`
-- ----------------------------
DROP TABLE IF EXISTS `article_has_modules`;
CREATE TABLE `article_has_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_has_modules
-- ----------------------------
INSERT INTO `article_has_modules` VALUES ('1', '1', '7');
INSERT INTO `article_has_modules` VALUES ('2', '2', '4');
INSERT INTO `article_has_modules` VALUES ('3', '3', '7');
INSERT INTO `article_has_modules` VALUES ('4', '4', '4');
INSERT INTO `article_has_modules` VALUES ('5', '5', '5');
INSERT INTO `article_has_modules` VALUES ('6', '6', '3');
INSERT INTO `article_has_modules` VALUES ('7', '7', '3');
INSERT INTO `article_has_modules` VALUES ('8', '8', '3');
INSERT INTO `article_has_modules` VALUES ('9', '9', '3');

-- ----------------------------
-- Table structure for `article_has_tags`
-- ----------------------------
DROP TABLE IF EXISTS `article_has_tags`;
CREATE TABLE `article_has_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_has_tags
-- ----------------------------
INSERT INTO `article_has_tags` VALUES ('1', '1', '17');
INSERT INTO `article_has_tags` VALUES ('2', '2', '6');
INSERT INTO `article_has_tags` VALUES ('3', '2', '18');
INSERT INTO `article_has_tags` VALUES ('4', '3', '2');
INSERT INTO `article_has_tags` VALUES ('5', '3', '19');
INSERT INTO `article_has_tags` VALUES ('6', '4', '18');
INSERT INTO `article_has_tags` VALUES ('7', '4', '20');
INSERT INTO `article_has_tags` VALUES ('8', '5', '1');
INSERT INTO `article_has_tags` VALUES ('9', '5', '3');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO `content` VALUES ('1', '<p>sdfsdf ssdfsdfsdfsdf</p>', '4');
INSERT INTO `content` VALUES ('2', '<p>曾经看到过一篇文章，讲到的内容就是个人是如何通过创建一个博客，然后通过日积月累的更新文章，最后在百度中获得了不少的排名，并最终通过百度带的巨大流量中获得联盟广告的收益。</p><p>现在国内流行恐怕就是：用Wordpress搭建一个个人博客，然后天天熬夜地更新文章，每天早上查看百度收录是不是又增加了，每个月百度的总有“那么一次”排名更新，并期望百度能够带来更多的流量。最后从流量中获取些广告收入。</p><p>更新博客，期待更好排名，得到更多的流量，这也许是做博客赚钱最简单的方法，但是对部落来说的这也许是一条不归路，流量赚钱对原创个人博客来说更是一个死胡同。很多时候我们还没有走出这个“胡同”，就已经“筋疲力尽”地消失了。</p><p style=\"margin: 1.5em 0px 0.5em; text-indent: 24px; font-size: 14px; line-height: 21px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, &quot;Bitstream Charter&quot;, Times, serif; white-space: normal; background-color: rgb(255, 255, 255);\">一、个人博客—个人的孤独自白</p><p>1、流量赚钱的前提是需要足够的流量，而流量主要来自搜索引擎，在国内的话就不要提Google了，流量基本上被百度给垄断了。搜索引擎对个人博客收录越多，权重越高，则有可能带来更多的流量。</p><p>2、但是个人博客由于个人精力有限，一天能够更新10篇以上的文章就已经相当不容易了。而相对于那些以团队或者公司化的运作方式去经营的网站或者博客，个人博客显然不容易得到搜索引擎的青睐。</p><p>3、根据博客的回访和观察，身边很多的博主都无法保持每天一篇文章更新规律（部落最近也是更新不频繁），即使执行力非常强的博主，也很难在保证文章质量的前提下又保证文章的数量。</p><p>4、个人博客由于个人的原因，注定是博主一个人的自白，且还是孤独的。也许，新博客一年之内也就是自己在文章中“呐喊”。</p><p>个人博客无法在量上获得高权重，那么只能从质上入手。高质量的博文，需要耗费博主更多的时间与精力，也会遇到一个很麻烦的问题 —— 抄袭。</p><p style=\"margin: 1.5em 0px 0.5em; text-indent: 24px; font-size: 14px; line-height: 21px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, &quot;Bitstream Charter&quot;, Times, serif; white-space: normal; background-color: rgb(255, 255, 255);\">二、抄袭让原创成为别人流量的劳动力</p><p>1、很多人说搜索引擎喜欢原创的文章。这句话如果对谷歌讲的话，我还可以信几分，但是如对百度来讲的话，我会BS一眼。原创的文章想要在百度获得流量，除了要“拼爹”外，还要拼运气。</p><p>2、所谓“拼爹”是指网站权重是否足够拼得过那些门户网站或者已经采集了很多年的老网站。很多的新博客在最开始是没有什么权重的，这时候也是那些采集网站眼中的“羔羊”，往往发表出来的文章搜索出来的排名几乎在第10页都找不到。</p><p>3、很多的博主对于这种“赤裸裸”的抄袭都会非常地气愤，有的还会专门跑过去和他们理论起来。但是结果又如何呢？除了会碰一鼻子外，没有任何好处。在国内，抄袭往往成了王道，原创成了“歪门邪道”。</p><p>4、原创的人成为了抄袭最廉价的劳动力，这就是草根个人博客的《悲惨世界》。</p><p>抄袭是无可避免的，如果可以的话，在博文的字里行间必须要有博主自己的特色，和带一些软文的性质，否则就会被抄死。</p><p style=\"margin: 1.5em 0px 0.5em; text-indent: 24px; font-size: 14px; line-height: 21px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, &quot;Bitstream Charter&quot;, Times, serif; white-space: normal; background-color: rgb(255, 255, 255);\">三、百度“利”字自己既要吃肉也喝汤</p><p>1、在百度中搜索“主机”这一个关键词，从上到下，从左到右，没有一项是和“主机”这个词是相关联的，整个电脑屏幕已经被百度的推广广告所“霸占”着。</p><p>2、百度把“肉”吃光了，于是很多草根站长就想是不是可以从百度那里获得长尾关键词排名呢？这样也许可以分得一杯羹。</p><p>3、但是事实证明，百度除了要吃掉所有的“肉”还要喝掉所有的“汤”，贴吧、百科、经验等就是用来喝汤的。</p><p>百度不可靠，哪怕你昨天还是上万的流量，今天就可能把你K得只剩下首页。网站到处讨好百度可不是好受的。</p><p style=\"margin: 1.5em 0px 0.5em; text-indent: 24px; font-size: 14px; line-height: 21px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, &quot;Bitstream Charter&quot;, Times, serif; white-space: normal; background-color: rgb(255, 255, 255);\">四、时间成本让站长放下屠刀立地成佛</p><p>1、做站域名和主机是金钱成本，就现在的情况来讲，一年的几百块钱的域名和主机费用已经绰绰有余了，但是最可怕是时间成本。</p><p>2、也许在学生时代做网站最有激情，没日没夜地不计报酬地更新原创文章，但是一旦兴趣转移、就业招聘、工作家族等多种因素走入生活之中，这种激情就会马上消失了。</p><p>3、即便是想继续坚持个人博客的梦想，却也因为巨额的时间成本无法于微薄的收益划等号，于是绝大多数个人博主便“放下屠刀”，立地去做更能赚钱的事情了。</p><p>有精力经营一个网站去赚钱，对大部分人来说，还不如用其它途径来得快。如果没有激情、坚持等，或者目标不纯，那么还是及早收手，不要到了30岁才发现，花了那么多时间做的网站，还是没什么起色。</p><p style=\"margin: 1.5em 0px 0.5em; text-indent: 24px; font-size: 14px; line-height: 21px; color: rgb(51, 51, 51); font-family: Georgia, &quot;Times New Roman&quot;, &quot;Bitstream Charter&quot;, Times, serif; white-space: normal; background-color: rgb(255, 255, 255);\">五、个人+原创+博客+流量+百度+赚钱=死路！希望？</p><p>1、个人+原创+博客+流量+百度+赚钱=死路，能够用个人博客走出流量赚钱的博主真得是凤毛麟角，绝大多数是在为他人作“嫁衣”。</p><p>2、个人原创博客希望在哪里？也许个人博客像被多数人“诅咒”了一样注定要消亡。但也许个人博客像“四两拨千斤”一样，摆脱流量赢利模式，走专业营销的道路。</p><p>个人博客只是打造个人品牌的一个阵地，如果想要靠个人博客赚钱，趁早转型。特别是技术类博客，用户群很偏，流量不可能会很高，基本是不可能有多大盈利空间的。</p><p>个人博客到最后不是消失就是被商业化，或者在消失的路上，这就是个人博客的宿命。</p><p><br/></p>', '5');
INSERT INTO `content` VALUES ('3', '', '6');
INSERT INTO `content` VALUES ('4', '', '7');
INSERT INTO `content` VALUES ('5', '', '8');
INSERT INTO `content` VALUES ('6', '', '9');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

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
INSERT INTO `monthly` VALUES ('1', '2017-08', '9');

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

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
INSERT INTO `user` VALUES ('1', 'tjc', '78354a342d40fc34f3ba825f26527f56', '1', null, null, null, '1501812948', null, null, null, null);

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

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
INSERT INTO `websites` VALUES ('9', '122', '53153', 'sdfdsfsdf', '建站工具', '25', '1501848494', '0');
INSERT INTO `websites` VALUES ('10', '122', '53153', null, '建站工具', '25', '1501848689', '0');
INSERT INTO `websites` VALUES ('11', '121425', '62538', '+2+6', '建站工具', '25', '1501848717', '0');

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
