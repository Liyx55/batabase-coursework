-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2022-12-14 19:43:30
-- 服务器版本： 5.7.36
-- PHP 版本： 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `bidding2`
--

-- --------------------------------------------------------

--
-- 表的结构 `bidding`
--

DROP TABLE IF EXISTS `bidding`;
CREATE TABLE IF NOT EXISTS `bidding` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `startingprice` int(30) NOT NULL,
  `reserveprice` int(30) NOT NULL,
  `currentprice` int(30) NOT NULL,
  `endtime` datetime NOT NULL,
  `description` varchar(300) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `buyer` int(11) DEFAULT NULL,
  `viewnum` int(200) NOT NULL DEFAULT '0',
  `state` int(1) NOT NULL DEFAULT '0',
  `isbid` int(1) DEFAULT NULL,
  `winner` int(11) DEFAULT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `bidding`
--

INSERT INTO `bidding` (`itemid`, `itemname`, `category`, `startingprice`, `reserveprice`, `currentprice`, `endtime`, `description`, `userid`, `buyer`, `viewnum`, `state`, `isbid`, `winner`) VALUES
(6, 'cute cats', 'others', 21, 22, 25, '2022-12-14 19:11:30', 'very very cute', 39, 46, 0, 0, NULL, 46),
(7, 'overcooked', 'home&kitchen', 23, 24, 24, '2022-12-20 21:00:00', 'Help couples broke up faster', 39, 50, 0, 0, NULL, NULL),
(8, 'kitchen', 'home&kitchen', 56, 57, 92, '2022-12-13 22:16:00', 'modern type', 39, 46, 0, 0, NULL, 46),
(9, 'choujuanbao', 'others', 45, 65, 61, '2022-12-25 17:50:30', 'A popular cat in bilibili', 39, NULL, 0, 0, NULL, NULL),
(10, 'basketball', 'appliances', 56, 56, 56, '2022-12-17 12:00:00', 'friendly to primary learner', 39, NULL, 0, 0, NULL, NULL),
(11, 'Fundation', 'beauty', 50, 50, 50, '2022-12-23 16:58:33', 'Estee Lauder', 40, NULL, 0, 0, NULL, NULL),
(12, 'Hollow Knight', 'others', 10, 12, 10, '2022-12-22 17:00:31', 'You will never regret having this', 40, NULL, 0, 0, NULL, NULL),
(13, 'lipstick', 'beauty', 20, 20, 20, '2022-12-30 17:02:27', 'Armani 406', 39, NULL, 0, 0, NULL, NULL),
(14, 'eyebrow', 'beauty', 13, 13, 13, '2022-12-23 17:03:18', 'for longer eyebrow', 39, NULL, 0, 0, NULL, NULL),
(15, 'Blusher', 'beauty', 20, 23, 20, '2022-12-29 17:06:12', 'M.A.C.', 40, NULL, 0, 0, NULL, NULL),
(16, 'Rob cat', 'others', 600, 600, 600, '2022-12-22 17:07:18', 'Which plastic bag do you like?', 40, NULL, 0, 0, NULL, NULL),
(17, 'cake', 'grocery&food', 12, 12, 12, '2022-12-31 17:09:17', 'homemade delicious sweets', 39, NULL, 0, 0, NULL, NULL),
(18, 'fork', 'home&kitchen', 34, 34, 34, '2022-12-25 22:00:00', 'Stainless steel', 40, NULL, 0, 0, NULL, NULL),
(19, 'Corn Chips', 'grocery&food', 1, 2, 1, '2022-12-30 12:00:00', 'Dorito. Sweet chili flavour', 40, NULL, 0, 0, NULL, NULL),
(20, 'white dress', 'colthing&accessories', 45, 45, 45, '2022-12-16 16:00:00', 'easy to wash', 40, NULL, 0, 0, NULL, NULL),
(21, 'black dress', 'colthing&accessories', 345, 345, 345, '2022-12-23 23:00:00', 'won\'t get dirty easily', 40, NULL, 0, 0, NULL, NULL),
(22, 'colorful dress', 'colthing&accessories', 52, 52, 52, '2023-02-03 02:00:00', 'make you the best girl in party', 40, NULL, 0, 0, NULL, NULL),
(23, 'microwave oven', 'appliances', 62, 62, 62, '2022-12-26 23:00:00', 'powerful heat will never let you down', 40, NULL, 0, 0, NULL, NULL),
(24, 'power strip', 'appliances', 20, 20, 20, '2022-12-26 21:00:00', 'good', 40, NULL, 0, 0, NULL, NULL),
(25, 'crisps', 'grocery&food', 12, 12, 12, '2023-02-18 18:39:00', 'good', 40, NULL, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `biddinghistory`
--

DROP TABLE IF EXISTS `biddinghistory`;
CREATE TABLE IF NOT EXISTS `biddinghistory` (
  `bidid` int(8) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `itemid` int(8) NOT NULL,
  `biddingprice` int(20) NOT NULL,
  `biddingdate` datetime DEFAULT NULL,
  PRIMARY KEY (`bidid`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `biddinghistory`
--

INSERT INTO `biddinghistory` (`bidid`, `userid`, `itemid`, `biddingprice`, `biddingdate`) VALUES
(1, 3, 2, 60, NULL),
(2, 1, 10, 60, NULL),
(3, 1, 4, 100, NULL),
(4, 1, 6, 2100, NULL),
(5, 1, 12, 80, NULL),
(6, 3, 17, 70, NULL),
(7, 30, 11, 71, NULL),
(8, 1, 12, 72, NULL),
(9, 30, 14, 73, NULL),
(10, 2, 15, 74, NULL),
(11, 1, 16, 75, NULL),
(12, 3, 17, 80, NULL),
(13, 1, 5, 150, NULL),
(14, 1, 13, 498, NULL),
(15, 31, 17, 85, NULL),
(16, 30, 8, 600, NULL),
(17, 30, 3, 900, NULL),
(18, 30, 6, 2180, NULL),
(19, 31, 9, 1000, NULL),
(20, 31, 6, 2300, NULL),
(21, 33, 17, 90, NULL),
(22, 33, 5, 155, NULL),
(23, 33, 18, 160, NULL),
(24, 33, 4, 120, NULL),
(25, 33, 19, 170, NULL),
(34, 39, 14, 51, '2022-11-21 20:40:52'),
(33, 39, 14, 50, '2022-11-21 20:39:55'),
(32, 39, 14, 46, '2022-11-21 20:39:40'),
(35, 39, 14, 53, '2022-11-21 20:42:46'),
(36, 39, 14, 54, '2022-11-21 20:43:09'),
(37, 39, 14, 55, '2022-11-21 20:46:50'),
(38, 39, 12, 80, '2022-11-22 14:49:30'),
(39, 39, 14, 56, '2022-11-22 15:26:19'),
(40, 40, 14, 57, '2022-11-22 16:33:59'),
(41, 40, 14, 58, '2022-11-22 16:50:26'),
(43, 39, 14, 60, '2022-11-25 16:44:28'),
(44, 40, 14, 61, '2022-11-25 16:44:52'),
(48, 40, 8, 85, '2022-12-12 19:42:16'),
(47, 40, 8, 84, '2022-12-12 19:38:15'),
(49, 40, 8, 86, '2022-12-12 19:44:10'),
(50, 40, 8, 87, '2022-12-12 21:00:58'),
(51, 40, 8, 88, '2022-12-12 21:02:26'),
(52, 46, 8, 89, '2022-12-13 12:33:57'),
(53, 40, 8, 90, '2022-12-13 12:39:35'),
(54, 46, 8, 91, '2022-12-13 13:34:41'),
(55, 46, 8, 92, '2022-12-13 13:40:03'),
(56, 46, 6, 23, '2022-12-14 18:48:36'),
(57, 50, 6, 24, '2022-12-14 18:54:10'),
(58, 46, 6, 25, '2022-12-14 18:57:07'),
(59, 50, 7, 24, '2022-12-14 19:14:02');

-- --------------------------------------------------------

--
-- 表的结构 `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `score` int(5) NOT NULL,
  `message` text NOT NULL,
  `reviewdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `feedback`
--

INSERT INTO `feedback` (`userid`, `itemid`, `score`, `message`, `reviewdate`) VALUES
(30, 6, 5, 'Looks cool XD', '2022-11-16'),
(1, 6, 1, 'oh well', '2022-11-16'),
(31, 6, 3, 'this is not that good', '2022-11-16'),
(38, 5, 3, 'it is good', '2022-12-10'),
(38, 14, 4, 'nice', '2022-12-10'),
(40, 10, 1, 'haha', '2022-12-10'),
(40, 5, 2, 'niu', '2022-12-10'),
(40, 15, 2, 'niu', '2022-12-10'),
(40, 14, 2, 'niu', '2022-12-10'),
(41, 5, 2, 'niu', '2022-12-10'),
(41, 15, 5, '666', '2022-12-10'),
(41, 14, 5, '666', '2022-12-10'),
(39, 3, 5, '666', '2022-12-10'),
(39, 10, 5, '666', '2022-12-10'),
(39, 14, 5, '666', '2022-12-10'),
(39, 15, 5, '666', '2022-12-10'),
(39, 4, 3, 'nice!!!', '2022-12-10'),
(30, 3, 3, 'nice!!!', '2022-12-10'),
(30, 6, 3, 'nice!!!', '2022-12-10'),
(30, 12, 3, 'nice!!!', '2022-12-10'),
(30, 3, 3, 'nice!!!', '2022-12-10'),
(37, 8, 3, 'nice!!!', '2022-12-10'),
(37, 6, 4, 'nice!!!', '2022-12-10'),
(37, 4, 3, 'not bad', '2022-12-10'),
(37, 12, 5, 'not bad', '2022-12-10'),
(38, 2, 1, 'bad!!!', '2022-12-10'),
(38, 4, 3, 'it is good', '2022-12-10'),
(38, 6, 4, 'hhhhhhhchengongl', '2022-12-10'),
(38, 8, 1, 'chengonglma ', '2022-12-10'),
(38, 3, 5, 'hasihimeiyou', '2022-12-10'),
(38, 12, 5, 'it is good', '2022-12-10'),
(40, 19, 4, 'good', '2022-12-14'),
(46, 7, 4, 'good', '2022-12-14');

-- --------------------------------------------------------

--
-- 表的结构 `recommend`
--
DROP TABLE IF EXISTS `recommend`;
CREATE TABLE IF NOT EXISTS `recommend` (
  `userid` int(11) NOT NULL,
  `item1` int(11) DEFAULT NULL,
  `item2` int(11) DEFAULT NULL,
  `item3` int(11) DEFAULT NULL,
  `item4` int(11) DEFAULT NULL,
  `item5` int(11) DEFAULT NULL,
  `item6` int(11) DEFAULT NULL,
  `item7` int(11) DEFAULT NULL,
  `item8` int(11) DEFAULT NULL,
  `item9` int(11) DEFAULT NULL,
  `item10` int(11) DEFAULT NULL,
  `item11` int(11) DEFAULT NULL,
  `item12` int(11) DEFAULT NULL,
  `item13` int(11) DEFAULT NULL,
  `item14` int(11) DEFAULT NULL,
  `item15` int(11) DEFAULT NULL,
  `item16` int(11) DEFAULT NULL,
  `item17` int(11) DEFAULT NULL,
  `item18` int(11) DEFAULT NULL,
  `item19` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recommend`
--

INSERT INTO `recommend` (`userid`, `item1`, `item2`, `item3`, `item4`, `item5`, `item6`, `item7`, `item8`, `item9`, `item10`, `item11`, `item12`, `item13`, `item14`, `item15`, `item16`, `item17`, `item18`, `item19`) VALUES
(30, NULL, NULL, 3, NULL, NULL,  5, NULL,  NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 3, 4, 4, 2, 5, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 2, 3, NULL, 3, NULL, 4, 4, 3, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 3, 4, 5, 3, 1, 3, 5, 4, NULL, 5, NULL, NULL, NULL, 5, 5, NULL, NULL, NULL, NULL),
(41, 3, 2, 1, 5, 2, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, 5, 5, NULL, NULL, NULL, NULL),
(31, 3, 4, 5, 2, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 2, 3, 4, NULL, 5, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, NULL, 3, 4, 5, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, 1, 5, 3, 3, 4, NULL, 1, NULL, NULL, NULL, 5, NULL, 4, NULL, NULL, NULL, NULL, NULL),
(40, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 2, NULL, NULL, NU
-- --------------------------------------------------------

--
-- 表的结构 `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `permissions` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `name`, `permissions`) VALUES
(1, 'buyer', 'buy'),
(2, 'seller', 'sell');

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE IF NOT EXISTS `userinfo` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `fullname` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `jointime` datetime DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`userid`, `username`, `password`, `fullname`, `email`, `jointime`, `role`) VALUES
(1, 'lu', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'luanqi', 'luanqi@qq.com', '2022-11-13 23:45:46', 1),
(3, 'zhao', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 'zhaohongyang', 'zhaohongyang@qq.com', '2022-11-11 23:48:46', 1),
(50, 'buyer', '4297f44b13955235245b2497399d7a93', 'buyer', '1504812541@qq.com', '2022-12-14 18:52:25', 1),
(30, 'li', 'e985dddb234ea1fb4e82a60f38113b15078a8b3a98b454c644d894f3286cebfd', 'liyanxin', 'liyanxin@qq.com', '2022-11-10 00:09:49', 1),
(31, 'su', '481f6cc0511143ccdd7e2d1b1b94faf0a700a8b49cd13922a70b5ae28acaa8c5', 'suyidan', 'suyidan@qq.com', '2022-11-12 00:43:47', 1),
(32, 'wang', '50407a624145ba785d28f2ca377b365a96a0c83f669776636bcd9b48678c5b78', 'wangwenxin', 'wangwenxin@qq.com', '2022-11-12 05:29:34', 2),
(33, 'test001', '975878c0b79b7c665f8efb37268b3f2e9090b89a19bf9d109feb87980f217550', 'yanxin li', '962417405@qq.com', '2022-11-13 17:52:34', 1),
(34, 'test002', '773ce9372af8db5de144d615bceca449a9cba4c94ff80f03fdd18027a7cec3d9', 'li', '123456@qq.com', '2022-11-15 15:26:29', 1),
(35, 'test003', '773ce9372af8db5de144d615bceca449a9cba4c94ff80f03fdd18027a7cec3d9', 'li', '7890@qq.com', '2022-11-15 16:18:19', 1),
(36, 'kk', '97304531204ef7431330c20427d95481', 'xiaoming', 'xiaoming@qq.com', '2022-11-14 17:24:33', 1),
(37, 'hong', '1167eac4687a0d8aae4d01efe9274cda', 'xiaohong', 'xiaohong@qq.com', '2022-11-15 17:24:56', 1),
(38, 'bao', '6e79120dfe969a7846a4b7a1fb63ab19', 'xiaobao', 'xiaobao@qq.com', '2022-11-15 17:29:16', 1),
(39, 'luanqi0524@gmail.com', '346020a1f63242ecdbb1f7016acd0c30', 'shua', 'luanqi0524@gmail.com', '2022-11-19 18:07:44', 2),
(40, 'legnahsurb', 'faa401313e2dea7b15f4a7850f7c2a5e', 'a', 'luanqi2000@126.com', '2022-11-22 16:32:22', 2),
(41, 'nji', '979aab91652e462413e7d2a42b00d70c', 'sed', 'luanqi20000524@qq.com', '2022-11-23 09:06:50', 1),
(42, 'db', '25f9e794323b453885f5181f1b624d0b', 'database', 'db@123.com', '2022-11-23 10:01:17', 1),
(43, 'db456@123.com', 'cbc3f649c0c1e814df3cb85c3f83380a', 'db456', 'db456@123.com', '2022-11-25 15:14:46', 1),
(44, 't1', '4297f44b13955235245b2497399d7a93', 't1', 't1@qq.cpm', '2022-12-10 17:41:11', 1),
(46, 'ucabalu@ucl.ac.uk', 'ebfc2302aa8eed5bfe90908d723b4c99', 'ucabalu@ucl.ac.uk', 'ucabalu@ucl.ac.uk', '2022-12-13 12:28:12', 1);

-- --------------------------------------------------------

--
-- 表的结构 `watchlist`
--

DROP TABLE IF EXISTS `watchlist`;
CREATE TABLE IF NOT EXISTS `watchlist` (
  `watchid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  PRIMARY KEY (`watchid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `watchlist`
--

INSERT INTO `watchlist` (`watchid`, `userid`, `itemid`) VALUES
(1, 44, 3),
(2, 44, 15),
(3, 1, 3),
(4, 38, 3),
(6, 46, 8);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
