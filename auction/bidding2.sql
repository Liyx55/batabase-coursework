-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2022 at 10:41 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bidding2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidding`
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
  `description` varchar(30) NOT NULL,
  `userid` int(20) DEFAULT NULL,
  `buyer` int(20) DEFAULT NULL,
  `viewnum` int(200) NOT NULL DEFAULT 0,
  `state` int(1) NOT NULL DEFAULT 0,
  `isbid` int(1) DEFAULT NULL,
  `winner` int(11) DEFAULT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `bidding`
--

INSERT INTO `bidding` (`itemid`, `itemname`, `category`, `startingprice`, `reserveprice`, `currentprice`, `endtime`, `description`, `userid`, `buyer`, `viewnum`, `state`, `isbid`, `winner`) VALUES
(1, 'dsvb', '2', 34, 345, 34, '2022-12-20 17:49:00', 'dfsb', 0, 0, 0, 0, 0, NULL),
(2, 'asdfg', '3', 345, 2345, 345, '2022-12-24 17:59:00', 'dfab', NULL, NULL, 0, 0, 0, NULL),
(3, 'ds,amgn', '2', 324, 325, 324, '2022-12-16 18:01:00', 'dmsgnlk', NULL, NULL, 0, 0, 0, NULL),
(4, 'ds,mangl', '2', 324, 3425, 324, '2022-12-31 18:04:00', 'dsljfgn', NULL, NULL, 0, 0, 0, NULL),
(5, 'klfdgnkl', '2', 435, 435, 435, '2022-12-29 18:32:00', 'lnsglj', NULL, NULL, 0, 0, 0, NULL),
(6, 'cute cats', 'others', 21, 22, 21, '2022-12-20 20:00:00', 'sss', 39, NULL, 0, 0, NULL, 38),
(7, 'sss', 'home&kitchen', 23, 24, 23, '2022-12-20 21:00:00', 'sss', 39, NULL, 0, 0, NULL, 39),
(8, 'kitchen', 'home&kitchen', 56, 57, 81, '2022-12-19 12:00:00', 'jjj', 39, NULL, 0, 0, NULL, NULL),
(9, 'choujuanbao', 'others', 45, 65, 61, '2022-12-25 17:50:30', 'shijiniangniang', 39, NULL, 0, 0, NULL, NULL),
(10, 'basketball', 'appliances', 56, 56, 56, '2022-12-17 12:00:00', 'bsk', 39, NULL, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `biddinghistory`
--
DROP TABLE IF EXISTS `biddinghistory`;
CREATE TABLE IF NOT EXISTS `biddinghistory` (
  `bidid` int(8) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `itemid` int(8) NOT NULL,
  `biddingprice` int(20) NOT NULL,
  `biddingdate` datetime DEFAULT NULL,
  PRIMARY KEY (`bidid`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

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
(44, 40, 14, 61, '2022-11-25 16:44:52');
-- --------------------------------------------------------

--
-- Table structure for table `feedback`
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
(38, 12, 5, 'it is good', '2022-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `recommend`
--

DROP TABLE IF EXISTS `recommend`;
CREATE TABLE IF NOT EXISTS `recommend` (
  `username` varchar(11) NOT NULL,
  `a` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  `e` int(11) DEFAULT NULL,
  `f` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recommend`
--

INSERT INTO `recommend` (`username`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`) VALUES
('John', 4, 4, 5, 4, 3, 2, 1, NULL),
('Mary', 3, 4, 4, 2, 5, 4, 3, NULL),
('Lucy', 2, 3, NULL, 3, NULL, 3, 4, 5),
('Tom', 3, 4, 5, NULL, 1, 3, 5, 4),
('Bill', 3, 2, 1, 5, 3, 2, 1, 1),
('Leo', 3, 4, 5, 2, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `permissions` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `permissions`) VALUES
(1, 'buyer', 'buy'),
(2, 'seller', 'sell');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`userid`, `username`, `password`, `fullname`, `email`, `jointime`, `role`) VALUES
(1, 'lu', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'luanqi', 'luanqi@qq.com', '2022-11-13 23:45:46', 1),
(2, 'che', '481f6cc0511143ccdd7e2d1b1b94faf0a700a8b49cd13922a70b5ae28acaa8c5', 'chejiani', 'chejiani@qq.com', '2022-11-11 23:46:54', 1),
(3, 'zhao', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 'zhaohongyang', 'zhaohongyang@qq.com', '2022-11-11 23:48:46', 1),
(4, 'guo', '4cc8f4d609b717356701c57a03e737e5ac8fe885da8c7163d3de47e01849c635', 'guoweiting', 'guoweiting@qq.com', '2022-11-10 23:49:35', 1),
(28, 'host', '1c7e99700d516bf1706d1402d3308eb897aa037b5c8f59d3189e39847242b181', 'host', 'host@qq.com', '2022-11-09 23:58:08', 1),
(29, 'admin', '110903c2e40fd2e5548123771bca68f902b1ffce5a29a4e4d2fefae2fe7e15cb', 'admin', 'admin@qq.com', '2022-11-09 00:04:31', 1),
(30, 'li', 'e985dddb234ea1fb4e82a60f38113b15078a8b3a98b454c644d894f3286cebfd', 'liyanxin', 'liyanxin@qq.com', '2022-11-10 00:09:49', 1),
(31, 'su', '481f6cc0511143ccdd7e2d1b1b94faf0a700a8b49cd13922a70b5ae28acaa8c5', 'suyidan', 'suyidan@qq.com', '2022-11-12 00:43:47', 1),
(32, 'wang', '50407a624145ba785d28f2ca377b365a96a0c83f669776636bcd9b48678c5b78', 'wangwenxin', 'wangwenxin@qq.com', '2022-11-12 05:29:34', 2),
(33, 'test001', '975878c0b79b7c665f8efb37268b3f2e9090b89a19bf9d109feb87980f217550', 'yanxin li', '962417405@qq.com', '2022-11-13 17:52:34', 1),
(34, 'test002', '773ce9372af8db5de144d615bceca449a9cba4c94ff80f03fdd18027a7cec3d9', 'li', '123456@qq.com', '2022-11-15 15:26:29', 1),
(35, 'test003', '773ce9372af8db5de144d615bceca449a9cba4c94ff80f03fdd18027a7cec3d9', 'li', '7890@qq.com', '2022-11-15 16:18:19', 1),
(36, 'kk', '97304531204ef7431330c20427d95481', 'xiaoming', 'xiaoming@qq.com', '2022-11-14 17:24:33', 1),
(37, 'hong', '1167eac4687a0d8aae4d01efe9274cda', 'xiaohong', 'xiaohong@qq.com', '2022-11-15 17:24:56', 1),
(38, 'bao', '6e79120dfe969a7846a4b7a1fb63ab19', 'xiaobao', 'xiaobao@qq.com', '2022-11-15 17:29:16', 1),
(39, 'luanqi0524@gmail.com', '346020a1f63242ecdbb1f7016acd0c30', 'shua', 'luanqi0524@gmail.com', '2022-11-19 18:07:44', 1),
(40, 'legnahsurb', 'faa401313e2dea7b15f4a7850f7c2a5e', 'a', 'luanqi2000@126.com', '2022-11-22 16:32:22', 1),
(41, 'nji', '979aab91652e462413e7d2a42b00d70c', 'sed', 'luanqi20000524@qq.com', '2022-11-23 09:06:50', 1),
(42, 'db', '25f9e794323b453885f5181f1b624d0b', 'database', 'db@123.com', '2022-11-23 10:01:17', 1),
(43, 'db456@123.com', 'cbc3f649c0c1e814df3cb85c3f83380a', 'db456', 'db456@123.com', '2022-11-25 15:14:46', 1),
(44, 't1', '4297f44b13955235245b2497399d7a93', 't1', 't1@qq.cpm', '2022-12-10 17:41:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--
DROP TABLE IF EXISTS `watchlist`;
CREATE TABLE IF NOT EXISTS `watchlist` (
  `watchid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  PRIMARY KEY (`watchid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `watchlist`
--

INSERT INTO `watchlist` (`watchid`, `userid`, `itemid`) VALUES
(1, 44, 3),
(2, 44, 15),
(3, 1, 3),
(4, 38, 3);
COMMIT;


--
-- 转储表的索引
--

--
-- 表的索引 `bidding`
--
ALTER TABLE `bidding`
  ADD PRIMARY KEY (`itemid`);

--
-- 表的索引 `biddinghistory`
--
ALTER TABLE `biddinghistory`
  ADD PRIMARY KEY (`bidid`);

--
-- 表的索引 `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 表的索引 `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`watchid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bidding`
--
ALTER TABLE `bidding`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `biddinghistory`
--
ALTER TABLE `biddinghistory`
  MODIFY `bidid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用表AUTO_INCREMENT `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用表AUTO_INCREMENT `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `watchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
