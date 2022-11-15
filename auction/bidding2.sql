-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2022-11-15 18:34:41
-- 服务器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- 表的结构 `biddinghistory`
--

CREATE TABLE `biddinghistory` (
  `username` varchar(30) NOT NULL,
  `itemid` int(8) NOT NULL,
  `biddingprice` int(20) NOT NULL,
  `biddingdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `biddinghistory`
--

INSERT INTO `biddinghistory` (`username`, `itemid`, `biddingprice`, `biddingdate`) VALUES
('3', 2, 60, '2018-03-15 22:09:13'),
('1', 17, 60, '2018-03-16 00:22:40'),
('1', 4, 100, '2018-03-16 00:23:05'),
('1', 6, 2100, '2018-03-16 00:23:23'),
('1', 12, 80, '2018-03-16 00:23:51'),
('3', 17, 70, '2018-03-16 00:24:13'),
('30', 17, 71, '2018-03-16 00:24:47'),
('1', 17, 72, '2018-03-16 00:25:11'),
('30', 17, 73, '2018-03-16 00:25:33'),
('2', 17, 74, '2018-03-16 00:25:59'),
('1', 17, 75, '2018-03-16 00:26:15'),
('3', 17, 80, '2018-03-16 00:26:42'),
('1', 5, 150, '2018-03-16 00:27:45'),
('1', 13, 498, '2018-03-16 00:48:37'),
('31', 17, 85, '2018-03-16 01:43:15'),
('30', 20, 600, '2018-03-16 02:18:08'),
('30', 21, 900, '2018-03-16 02:20:38'),
('30', 6, 2180, '2018-03-16 02:22:14'),
('31', 22, 1000, '2018-03-16 02:36:24'),
('31', 6, 2300, '2018-03-16 02:59:14'),
('33', 17, 90, '2022-11-13 18:09:57'),
('33', 5, 155, '2022-11-13 18:20:32'),
('33', 5, 160, '2022-11-13 18:25:21'),
('33', 4, 120, '2022-11-13 20:25:14'),
('33', 5, 170, '2022-11-15 15:21:36');

-- --------------------------------------------------------

--
-- 表的结构 `feedback`
--

CREATE TABLE `feedback` (
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
(30, 6, 5, 'Looks cool XD', '2018-03-16'),
(1, 6, 1, 'oh well', '2018-03-16'),
(31, 6, 3, 'this is not that good', '2018-03-16');

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE `role` (
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
-- 表的结构 `selling`
--

CREATE TABLE `selling` (
  `itemid` int(11) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `category` varchar(30) NOT NULL,
  `startingprice` int(11) NOT NULL,
  `reserveprice` int(11) NOT NULL,
  `currentprice` int(11) NOT NULL,
  `postdate` datetime NOT NULL,
  `biddingenddate` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `bidderid` int(30) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `viewing` int(20) NOT NULL,
  `confirm` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `selling`
--

INSERT INTO `selling` (`itemid`, `itemname`, `category`, `startingprice`, `reserveprice`, `currentprice`, `postdate`, `biddingenddate`, `userid`, `bidderid`, `description`, `viewing`, `confirm`) VALUES
(17, 'harry potter', 'Literature', 50, 70, 90, '2022-11-11 00:05:59', '2022-11-16 09:00:00', 4, 33, 'Goodbook', 42, 0),
(16, 'perfume', 'Beauty', 999, 999, 999, '2022-11-12 00:02:56', '2022-11-15 09:00:00', 4, 0, 'this is a perfume', 2, 0),
(4, 'cloth 1', 'Clothes', 99, 9999999, 120, '2022-11-13 21:32:51', '2022-11-14 09:00:00', 4, 33, 'Idc', 11, 0),
(5, 'clothes 2', 'Clothes', 99, 109, 170, '2022-11-10 21:33:19', '2022-11-16 09:00:00', 4, 33, 'a cloth', 10, 0),
(6, 'alienware m15', 'Electronic device', 2000, 3000, 2300, '2022-11-07 21:34:54', '2022-11-17 09:00:00', 4, 31, 'Dell Gaming laptops and PCs are engineered with sharper graphics and faster processors for superior visual gameplay thatÂ´s intense at every level.', 25, 0),
(7, 'chicken', 'Food', 20, 30, 20, '2022-11-08 21:36:33', '2022-11-15 09:00:00', 4, 0, 'super chicken meat', 0, 0),
(8, 'cake', 'Food', 6000, 9000, 6000, '2022-11-09 21:37:03', '2022-11-18 09:00:00', 4, 0, 'magic cake', 0, 0),
(9, 'fork', 'Kitchen', 5, 10, 5, '2022-11-08 21:37:29', '2022-11-19 09:00:00', 4, 0, 'nice fork', 0, 0),
(10, 'foil paper', 'Kitchen', 3, 4, 3, '2022-11-06 21:38:11', '2022-11-20 09:00:00', 4, 0, 'nice foil paper', 1, 0),
(11, 'sofa', 'Furniture', 5, 20, 5, '2022-11-05 21:38:36', '2022-11-21 09:00:00', 4, 0, 'I hate sofa', 0, 0),
(12, 'ed shreen music album (signed)', 'Music', 50, 60, 80, '2022-11-05 21:39:15', '2022-11-18 09:00:00', 4, 1, 'everyone loves him', 2, 0),
(13, 'pen', 'Stationery', 425, 999, 498, '2022-11-04 21:39:51', '2022-11-21 09:00:00', 4, 1, 'I have a pen. do you have a pineapple?', 2, 0),
(14, 'basketball', 'Sports', 50, 60, 50, '2022-11-01 21:41:39', '2022-11-17 09:00:00', 4, 0, 'ball', 0, 0),
(15, 'iphone 5', 'Electronic device', 500, 600, 500, '2022-11-03 21:58:36', '2022-11-19 09:00:00', 1, 0, 'we are old school', 0, 0),
(20, 'hololens', 'Electronic device', 300, 400, 600, '2022-11-02 02:13:03', '2022-11-22 11:00:00', 31, 30, 'dsssdsd', 2, 0),
(21, 'ps4', 'Electronic device', 599, 6000, 900, '2022-11-04 02:16:15', '2022-11-23 09:00:00', 31, 30, 'PlayStation 4 (PS4) is a line of eighth-generation home video game consoles developed by Sony Interactive Entertainment. Announced as the successor to the PlayStation 3 during a press conference on February 20, 2013, it was launched on November 15 in North America, November 29 in Europe, South ', 3, 0),
(19, 'macbook air', 'Electronic device', 8000, 79999, 8000, '2022-11-03 02:00:19', '2022-11-24 09:00:00', 31, 0, 'MacBook Air lasts up to an incredible 12 hours between charges. So from your morning coffee till your evening commute, you can work unplugged. When itâ€™s time to kick back and relax, you can get up to 12 hours of iTunes movie playback. And with up to 30 days of standby time, you can go away for weeks and pick up right where you left off.*', 8, 0),
(22, 'oculus rift', 'Electronic device', 560, 697, 1000, '2022-11-05 02:35:40', '2022-11-25 09:00:00', 1, 31, 'The Oculus Rift is a virtual reality system that completely immerses you inside virtual worlds. Oculus Rift is available now.', 5, 0),
(23, 'iphone14', 'Electronic device', 1000, 1300, 1000, '2022-11-13 17:15:42', '2022-11-20 09:00:00', 33, 0, 'newest iphone', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE `userinfo` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `fullname` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `jointime` datetime DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(38, 'bao', '6e79120dfe969a7846a4b7a1fb63ab19', 'xiaobao', 'xiaobao@qq.com', '2022-11-15 17:29:16', 1);

--
-- 转储表的索引
--

--
-- 表的索引 `biddinghistory`
--
ALTER TABLE `biddinghistory`
  ADD PRIMARY KEY (`biddingdate`);

--
-- 表的索引 `selling`
--
ALTER TABLE `selling`
  ADD PRIMARY KEY (`itemid`);

--
-- 表的索引 `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `selling`
--
ALTER TABLE `selling`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用表AUTO_INCREMENT `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
