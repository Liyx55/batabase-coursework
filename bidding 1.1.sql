-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2022-11-03 14:12:19
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
-- 数据库： `bidding`
--

-- --------------------------------------------------------

--
-- 表的结构 `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(20) NOT NULL AUTO_INCREMENT,
  `address_name` int(10) NOT NULL,
  `address_detail` varchar(50) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `seller_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `give_price` double(10,2) NOT NULL,
  `buyer_id` int(20) NOT NULL,
  `item_state` tinyint(1) NOT NULL,
  `bid_id` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`bid_id`),
  KEY `buyer_id` (`buyer_id`),
  KEY `seller_id` (`seller_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `buyer`
--

DROP TABLE IF EXISTS `buyer`;
CREATE TABLE IF NOT EXISTS `buyer` (
  `buyer_id` int(20) NOT NULL AUTO_INCREMENT,
  `b_email` varchar(50) NOT NULL,
  `b_name` varchar(50) NOT NULL,
  `b_pwd` varchar(50) NOT NULL,
  `b_phone` int(20) NOT NULL,
  `address_id` int(20) NOT NULL,
  `car_id` int(10) NOT NULL,
  PRIMARY KEY (`buyer_id`),
  KEY `address_id` (`address_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `car_item`
--

DROP TABLE IF EXISTS `car_item`;
CREATE TABLE IF NOT EXISTS `car_item` (
  `car_id` int(10) NOT NULL AUTO_INCREMENT,
  `seller_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `item_num` varchar(50) NOT NULL,
  `give_price` double(10,2) NOT NULL,
  `buyer_id` int(20) NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `categorisation`
--

DROP TABLE IF EXISTS `categorisation`;
CREATE TABLE IF NOT EXISTS `categorisation` (
  `item_ctg_id` int(10) NOT NULL AUTO_INCREMENT,
  `ctg_name` varchar(50) NOT NULL,
  PRIMARY KEY (`item_ctg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `goodassess-`
--

DROP TABLE IF EXISTS `goodassess-`;
CREATE TABLE IF NOT EXISTS `goodassess-` (
  `item_id` int(20) NOT NULL AUTO_INCREMENT,
  `assess_level` int(10) NOT NULL,
  `assess_detail` int(10) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `goods_info`
--

DROP TABLE IF EXISTS `goods_info`;
CREATE TABLE IF NOT EXISTS `goods_info` (
  `item_id` int(20) NOT NULL AUTO_INCREMENT,
  `item_num` int(50) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `start_price` double(10,2) NOT NULL,
  `reserve_price` double(10,2) NOT NULL,
  `deal_price` double(10,2) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `seller_id` int(20) NOT NULL,
  `buyer_id` int(20) NOT NULL,
  `item_ctg_id` int(20) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `item_ctg_id` (`item_ctg_id`),
  KEY `seller_id` (`seller_id`),
  KEY `buyer_id` (`buyer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `manager_id` int(10) NOT NULL AUTO_INCREMENT,
  `manager_name` int(10) NOT NULL,
  `manager_pwd` varchar(50) NOT NULL,
  PRIMARY KEY (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `order_info`
--

DROP TABLE IF EXISTS `order_info`;
CREATE TABLE IF NOT EXISTS `order_info` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `seller_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `order_state` varchar(50) NOT NULL,
  `buyer_id` int(20) NOT NULL,
  `deal_price` double(10,2) NOT NULL,
  `item_num` int(20) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `buyer_id` (`buyer_id`),
  KEY `item_id` (`item_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `seller_id` int(20) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(50) NOT NULL,
  `s_email` varchar(50) NOT NULL,
  `s_pwd` varchar(50) NOT NULL,
  `s_phone` int(20) NOT NULL,
  `address_id` int(20) NOT NULL,
  PRIMARY KEY (`seller_id`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 限制导出的表
--

--
-- 限制表 `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `buyer` (`buyer_id`),
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`seller_id`),
  ADD CONSTRAINT `bid_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `goods_info` (`item_id`);

--
-- 限制表 `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `buyer_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car_item` (`car_id`);

--
-- 限制表 `goods_info`
--
ALTER TABLE `goods_info`
  ADD CONSTRAINT `goods_info_ibfk_1` FOREIGN KEY (`item_ctg_id`) REFERENCES `categorisation` (`item_ctg_id`),
  ADD CONSTRAINT `goods_info_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`seller_id`),
  ADD CONSTRAINT `goods_info_ibfk_3` FOREIGN KEY (`buyer_id`) REFERENCES `buyer` (`buyer_id`);

--
-- 限制表 `order_info`
--
ALTER TABLE `order_info`
  ADD CONSTRAINT `order_info_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `buyer` (`buyer_id`),
  ADD CONSTRAINT `order_info_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `goods_info` (`item_id`),
  ADD CONSTRAINT `order_info_ibfk_3` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`seller_id`);

--
-- 限制表 `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
