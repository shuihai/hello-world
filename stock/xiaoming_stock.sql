-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-07 10:45:09
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiaoming_stock`
--

DROP TABLE IF EXISTS `xiaoming_stock`;
CREATE TABLE IF NOT EXISTS `xiaoming_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(32) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(32) NOT NULL,
  `tclose` decimal(10,3) NOT NULL,
  `high` decimal(10,3) NOT NULL,
  `low` decimal(11,3) DEFAULT NULL,
  `topen` decimal(10,3) DEFAULT NULL,
  `lclose` decimal(10,3) DEFAULT NULL,
  `chg` decimal(10,3) DEFAULT NULL,
  `pchg` decimal(10,4) DEFAULT NULL,
  `voturnover` bigint(20) DEFAULT NULL,
  `vaturnover` decimal(20,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `xiaoming_stock`
--

TRUNCATE TABLE `xiaoming_stock`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
