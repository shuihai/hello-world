-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-21 06:26:03
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
-- 表的结构 `xiaoming_remark`
--

CREATE TABLE IF NOT EXISTS `xiaoming_remark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gzh_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `content` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `duokong` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `xiaoming_remark`
--

INSERT INTO `xiaoming_remark` (`id`, `gzh_id`, `date`, `content`, `sort`, `duokong`) VALUES
(1, 1, '2018-03-20', ' ee', 0, 1),
(2, 2, '2018-03-20', ' sss', 0, 0),
(3, 2, '2018-03-20', ' ss', 0, 1),
(4, 1, '2018-03-21', ' d', 0, 1),
(5, 2, '2018-03-21', ' ss', 0, 1),
(6, 4, '2018-03-21', ' 33', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
