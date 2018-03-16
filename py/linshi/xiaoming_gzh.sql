-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-16 09:15:55
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
-- 表的结构 `xiaoming_gzh`
--

CREATE TABLE IF NOT EXISTS `xiaoming_gzh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gzh_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gzh_name` (`gzh_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `xiaoming_gzh`
--

INSERT INTO `xiaoming_gzh` (`id`, `gzh_name`, `status`) VALUES
(1, '招财大牛猫', 1),
(2, '范德依彪', 1),
(3, '投资明道', 1),
(4, '钱眼', 1),
(5, '趋势交易的奶爸', 1),
(6, '叶檀财经', 1),
(7, '凤凰财经', 1),
(8, '数字货币趋势狂人', 1),
(9, '沙黾农', 1),
(10, '股蜂乐', 1),
(11, '林奇', 1),
(12, '跑赢大盘的王者', 1),
(13, '21金融圈', 1),
(14, '好运哥2008', 1),
(15, '财经要参', 1),
(16, '投资导报', 1),
(17, '伟伟到财', 1),
(18, '徐文明', 1),
(19, '股票操盘手老猫', 1),
(20, '品牌新观察', 1),
(21, '第一财讯播报', 1),
(22, '看懂龙头股', 1),
(23, '德林社', 1),
(24, '理财中国', 1),
(25, '新财迷', 1),
(26, '功夫财经', 1),
(27, '华尔街见闻', 1),
(28, '瑞刷', 1),
(29, '今日财经头条', 1),
(30, '老铁股道', 1),
(31, '光波股市笔记', 1),
(32, '姚尧', 1),
(33, '王国强', 1),
(34, '财经早餐', 1),
(35, 'A股铁娘子', 1),
(36, '周仁宇', 1),
(37, '孤独牛背2016', 1),
(38, '券商中国', 1),
(39, '牛魔王炒牛股', 1),
(40, '博闻财经', 1),
(41, '雷恩镇杰哥', 1),
(42, '李志林', 1),
(43, '今日股市头条', 1),
(44, '房产头条', 1),
(45, '风雷打板', 1),
(46, '智谷趋势', 1),
(47, '中国基金报', 1),
(48, '地产情报站', 1),
(49, '格上财富', 1),
(50, '老白说股', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
