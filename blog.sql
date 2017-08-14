-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-08-14 09:30:27
-- 服务器版本： 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `module_name` char(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `monthy` char(7) NOT NULL COMMENT '文章发表于几年几月',
  `title` char(50) NOT NULL,
  `brief` char(255) DEFAULT NULL,
  `create_time` int(10) UNSIGNED DEFAULT NULL,
  `update_time` int(10) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否删除',
  `views` int(10) UNSIGNED DEFAULT '1',
  `platform` char(255) DEFAULT NULL COMMENT '平台',
  `browserdesc` char(255) DEFAULT NULL,
  `is_sticktop` tinyint(1) UNSIGNED DEFAULT '0',
  `ipaddress` char(255) DEFAULT NULL,
  `remark` char(255) DEFAULT NULL,
  `tag_ids` char(255) DEFAULT NULL,
  `tag_names` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `module_id`, `module_name`, `user_id`, `monthy`, `title`, `brief`, `create_time`, `update_time`, `deleted`, `views`, `platform`, `browserdesc`, `is_sticktop`, `ipaddress`, `remark`, `tag_ids`, `tag_names`) VALUES
(11, 3, 'html5', 1, '2017-08', '这是标题', '水电费说的发售的发售的水电费说的发售的发售的水电费说的发售的发售的水电费说的发售的发售的水电费说的发售的发售的水电费说的发售的发售的水电费说的发售的发售的水电费说的发售的发售的水电费说的发售的发售的水', 1502201449, 1502201449, 0, 1, 'Mac OS X', 'Chrome 60.0', 0, '重庆市电信', '水电费说的奋斗史', '25', '自标签'),
(12, 4, 'css3', 1, '2017-08', 'hey', 'sdfsd12142342sdfsd12142342sdfsd12142342sdfsd12142342sdfsd12142342sdfsd12142342sdfsd12142342sdfsd1214', 1502204378, 1502204378, 0, 1, 'Mac OS X', 'Chrome 60.0', 0, '重庆市电信', 'reamrk', '24,26', 'fsdfsdfsdf,sdfsdfsdf'),
(13, 3, 'html5', 1, '2017-08', 'sdfsdfdsf', 'sdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdf', 1502204402, 1502204402, 0, 1, 'Mac OS X', 'Chrome 60.0', 0, '重庆市电信', 'sdfsdf', '25,27', '自标签,erbiaoqi'),
(14, 5, 'js', 1, '2017-08', 'sdfsdfsdfs124235', 'sdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasf124345', 1502204424, 1502204424, 0, 1, 'Mac OS X', 'Chrome 60.0', 0, '重庆市电信', 'sdfsdfsdfxcvxcgvbcxbv', '1,28', 'ajax,jq'),
(15, 4, 'css3', 1, '2017-08', 'sdfsdfsdf', 'sdfsdfsdf', 1502204448, 1502204448, 0, 1, 'Mac OS X', 'Chrome 60.0', 0, '重庆市电信', 'sdfsdf', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `article_has_modules`
--

CREATE TABLE `article_has_modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `article_has_modules`
--

INSERT INTO `article_has_modules` (`id`, `article_id`, `module_id`) VALUES
(11, 11, 3),
(12, 12, 4),
(13, 13, 3),
(14, 14, 5),
(15, 15, 4),
(6, 6, 3),
(7, 7, 3),
(8, 8, 3),
(9, 9, 3);

-- --------------------------------------------------------

--
-- 表的结构 `article_has_tags`
--

CREATE TABLE `article_has_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `article_has_tags`
--

INSERT INTO `article_has_tags` (`id`, `article_id`, `tag_id`) VALUES
(13, 11, 25),
(15, 12, 26),
(14, 12, 24),
(17, 13, 27),
(16, 13, 25),
(19, 14, 28),
(18, 14, 1);

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` varchar(400) NOT NULL,
  `article_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `agreenum` int(10) UNSIGNED DEFAULT NULL,
  `disagreenum` int(10) UNSIGNED DEFAULT NULL,
  `reportnum` int(10) UNSIGNED DEFAULT NULL,
  `address` char(255) DEFAULT NULL,
  `os` char(255) DEFAULT NULL,
  `osdesc` char(255) DEFAULT NULL,
  `brower` char(255) DEFAULT NULL,
  `browerdesc` char(255) DEFAULT NULL,
  `create_time` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `floor` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `content`
--

CREATE TABLE `content` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` longtext NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `content`
--

INSERT INTO `content` (`id`, `content`, `article_id`) VALUES
(8, '<p>水电费说的发售的发售的水电费说的发售的发售的水电费说的发售的发售的</p><p>水电费说的发售的发售的</p><p>水电费说的发售的发售的</p><p>水电费说的发售的发售的</p><p>水电费说的发售的发售的</p><p>水电费说的发售的发售的</p><p>水电费说的发售的发售的</p><p>水电费说的发售的发售的</p>', 11),
(9, '<p>sdfsd12142342sdfsd12142342sdfsd12142342sdfsd12142342sdfsd12142342sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>v</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p>sdfsd12142342</p><p style=\"position: absolute; width: 1px; height: 1px; overflow: hidden; left: -1000px; white-space: nowrap; top: 143px;\"><span style=\"white-space: normal;\">sdfsd12142342</span></p><p style=\"position: absolute; width: 1px; height: 1px; overflow: hidden; left: -1000px; white-space: nowrap; top: 143px;\"><span style=\"white-space: normal;\"><br/></span></p><p style=\"position: absolute; width: 1px; height: 1px; overflow: hidden; left: -1000px; white-space: nowrap; top: 197px;\"><span style=\"white-space: normal;\">sdfsd12142342</span></p><p style=\"position: absolute; width: 1px; height: 1px; overflow: hidden; left: -1000px; white-space: nowrap; top: 197px;\"><span style=\"white-space: normal;\"><br/></span></p><p style=\"position: absolute; width: 1px; height: 1px; overflow: hidden; left: -1000px; white-space: nowrap; top: 197px;\"><span style=\"white-space: normal;\">sdfsd12142342</span></p><p style=\"position: absolute; width: 1px; height: 1px; overflow: hidden; left: -1000px; white-space: nowrap; top: 197px;\"><span style=\"white-space: normal;\"><br/></span></p>', 12),
(10, '<p>sdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdf</p>', 13),
(11, '<p>sdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasfsdfsdfsdfasf124345</p>', 14),
(12, '<p>sdfsdfsdf</p>', 15),
(3, '', 6),
(4, '', 7),
(5, '', 8),
(6, '', 9);

-- --------------------------------------------------------

--
-- 表的结构 `module`
--

CREATE TABLE `module` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(10) NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_tag` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_nav` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '用于区分是导航还是网站推荐'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `module`
--

INSERT INTO `module` (`id`, `name`, `pid`, `deleted`, `is_tag`, `is_nav`) VALUES
(24, '子模块', 22, 0, 0, 0),
(2, '前端', 0, 0, 0, 1),
(3, 'html5', 2, 0, 1, 0),
(4, 'css3', 2, 0, 1, 0),
(5, 'js', 2, 0, 1, 0),
(6, '后端', 0, 0, 0, 1),
(7, 'php', 6, 0, 1, 0),
(8, 'java', 6, 0, 1, 0),
(9, '移动端', 0, 0, 0, 1),
(10, 'android', 9, 0, 1, 0),
(11, 'ios', 9, 0, 1, 0),
(12, '服务器/os', 0, 0, 0, 1),
(13, 'linux', 12, 0, 1, 0),
(14, 'apache', 12, 0, 1, 0),
(15, 'nginx', 12, 0, 1, 0),
(16, 'windows', 12, 0, 1, 0),
(17, 'mac', 12, 0, 1, 0),
(22, '123878', 0, 0, 0, 0),
(23, '45689', 22, 1, 0, 0),
(25, '建站工具', 0, 0, 0, 0),
(26, '在线学习', 0, 0, 0, 0),
(27, '国内', 26, 0, 0, 0),
(28, '国外', 26, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `monthly`
--

CREATE TABLE `monthly` (
  `id` int(10) UNSIGNED NOT NULL,
  `month` char(7) NOT NULL,
  `num` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `monthly`
--

INSERT INTO `monthly` (`id`, `month`, `num`) VALUES
(1, '2017-08', 9);

-- --------------------------------------------------------

--
-- 表的结构 `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(10) NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tags`
--

INSERT INTO `tags` (`id`, `name`, `module_id`, `deleted`) VALUES
(1, 'ajax', 5, 0),
(2, 'curl', 7, 0),
(3, 'vue', 5, 0),
(4, 'vim', 13, 0),
(5, 'composer', 7, 0),
(6, '定位', 4, 0),
(20, 'were', 4, 0),
(19, 'websokit', 7, 0),
(18, '动画', 4, 0),
(17, 'gd2', 7, 0),
(21, 'tag', 23, 1),
(22, 'tag2', 23, 1),
(23, '新标签2', 24, 0),
(24, 'fsdfsdfsdf', 4, 0),
(25, '自标签', 3, 0),
(26, 'sdfsdfsdf', 4, 0),
(27, 'erbiaoqi', 3, 0),
(28, 'jq', 5, 0);

-- --------------------------------------------------------

--
-- 表的结构 `usedname`
--

CREATE TABLE `usedname` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `used_time` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(32) NOT NULL,
  `pwd` char(32) NOT NULL,
  `level` tinyint(255) UNSIGNED DEFAULT '0',
  `avatar` char(255) DEFAULT NULL,
  `reg_time` int(10) UNSIGNED DEFAULT NULL,
  `position` char(255) DEFAULT NULL,
  `last_online` int(10) UNSIGNED DEFAULT NULL,
  `address` char(255) DEFAULT NULL,
  `signature` char(255) DEFAULT NULL,
  `gender` char(255) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `pwd`, `level`, `avatar`, `reg_time`, `position`, `last_online`, `address`, `signature`, `gender`, `keywords`) VALUES
(1, 'tjc', '78354a342d40fc34f3ba825f26527f56', 1, NULL, NULL, NULL, 1502204343, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `websites`
--

CREATE TABLE `websites` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `remark` char(255) DEFAULT NULL,
  `module_name` char(255) NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `create_time` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `websites`
--

INSERT INTO `websites` (`id`, `name`, `url`, `remark`, `module_name`, `module_id`, `create_time`, `deleted`) VALUES
(1, '123', 'http', NULL, '', 22, 1501837864, 1),
(2, 'test2', 'http://www.93jc.pw4', NULL, '123878->子模块', 24, 1501838482, 1),
(3, 'reealy', 'http://www.93jc.pw', NULL, '123878->子模块', 24, 1501838551, 1),
(4, 'yes', '123', NULL, '123878->子模块', 24, 1501838672, 1),
(5, '百度', 'http://www.baidu.com', NULL, '123878->子模块', 24, 1501839008, 0),
(6, '摩客网', 'http://www.google.com', NULL, '123878->子模块', 24, 1501840168, 0),
(7, '网易云课堂', 'http://www.93jc.pw', NULL, '在线学习->国内', 27, 1501841833, 0),
(8, 'w3c', 'http://www.93jc.pw', NULL, '在线学习->国外', 28, 1501841849, 0),
(9, '122', '53153', 'sdfdsfsdf', '建站工具', 25, 1501848494, 1),
(10, '122', '53153', NULL, '建站工具', 25, 1501848689, 1),
(11, '121425', '62538', '+2+6', '建站工具', 25, 1501848717, 1),
(12, 'sdfsdf', 'sdfsdf', 'sdfsdf123', '在线学习->国内', 27, 1501938338, 1);

-- --------------------------------------------------------

--
-- 表的结构 `words`
--

CREATE TABLE `words` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` char(255) NOT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `create_time` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `words`
--

INSERT INTO `words` (`id`, `content`, `deleted`, `create_time`) VALUES
(1, 'dfdsf dsfds', 0, 1501938301),
(2, 'sdfsdfsdfsdfsdfsdfsd', 0, 1501938304),
(3, 'dsfsdfsdfsdfsdf1232', 0, 1501938309);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_has_modules`
--
ALTER TABLE `article_has_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_has_tags`
--
ALTER TABLE `article_has_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly`
--
ALTER TABLE `monthly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usedname`
--
ALTER TABLE `usedname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `article_has_modules`
--
ALTER TABLE `article_has_modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `article_has_tags`
--
ALTER TABLE `article_has_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `content`
--
ALTER TABLE `content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `module`
--
ALTER TABLE `module`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- 使用表AUTO_INCREMENT `monthly`
--
ALTER TABLE `monthly`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- 使用表AUTO_INCREMENT `usedname`
--
ALTER TABLE `usedname`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `websites`
--
ALTER TABLE `websites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `words`
--
ALTER TABLE `words`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
