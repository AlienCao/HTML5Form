-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 09 月 23 日 17:10
-- 服务器版本: 5.6.24
-- PHP 版本: 5.3.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jx09com`
--

-- --------------------------------------------------------

--
-- 表的结构 `dang_select`
--

CREATE TABLE IF NOT EXISTS `dang_select` (
  `id` int(3) NOT NULL,
  `select` varchar(500) NOT NULL,
  `code` int(1) NOT NULL,
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=154 ;

--
-- 转存表中的数据 `dang_select`
--

INSERT INTO `dang_select` (`id`, `select`, `code`, `order_id`) VALUES
(1, 'A.53', 5, 4),
(1, 'B.50', 0, 5),
(1, 'C.58', 0, 6),
(2, 'A.中国人民', 0, 7),
(2, 'B.中华民族', 0, 8),
(2, 'C.中国人民和中华民族', 5, 9),
(3, 'A.社会主义荣辱观', 0, 10),
(3, 'B.科学发展观', 5, 11),
(3, 'C.社会主义核心价值', 0, 12),
(4, 'A.共产党执政规律', 0, 13),
(4, 'B.社会主义建设规律', 0, 14),
(4, 'C.人类社会历史发展规律', 5, 15),
(5, 'A.党员只能向上级党组织提出请求、申诉和控告', 0, 16),
(5, 'B.党员可以向上级党组织直至中央提出请求、申诉和控告', 0, 17),
(5, 'C.党员可以向上级党组织直至中央提出请求、申诉和控告，并要求有关组织给以负责的答复', 5, 18),
(6, 'A.中国特色社会主义旗帜', 0, 19),
(6, 'B.中国特色社会主义制度', 5, 20),
(6, 'C.中国特色社会主义目标', 0, 21),
(7, 'A.社会主义中级阶段', 0, 22),
(7, 'B.社会主义高级阶段', 0, 23),
(7, 'C.社会主义初级阶段', 5, 24),
(8, 'A.阶级矛盾', 0, 25),
(8, 'B.人民内部矛盾', 0, 26),
(8, 'C.人民日益增长的物质文化需要同落后的社会生产之间的矛盾', 5, 27),
(9, 'A.发展', 5, 28),
(9, 'B.开放', 0, 29),
(9, 'C.改革', 0, 30),
(10, 'A.十几年', 0, 31),
(10, 'B.几十年', 0, 32),
(10, 'C.上百年', 5, 33),
(11, 'A.3个月', 0, 34),
(11, 'B.6个月', 5, 35),
(11, 'C.12个月', 0, 36),
(12, 'A.集体吸收', 0, 37),
(12, 'B.个别吸收', 5, 38),
(12, 'C.个别吸收和集体吸收相结合', 0, 39),
(13, 'A.社会主义国家的综合国力', 5, 40),
(13, 'B.社会主义国家的经济实力', 0, 41),
(13, 'C.社会主义国家的国家安全', 0, 42),
(14, 'A.制度建设', 0, 43),
(14, 'B.生态文明建设', 5, 44),
(14, 'C.作风建设', 0, 45),
(15, 'A.21世纪中叶', 0, 46),
(15, 'B.建党一百年', 5, 47),
(15, 'C.2010年', 0, 48),
(16, 'A.留党察看', 0, 49),
(16, 'B.延长预备期', 0, 50),
(16, 'C.取消预备党员资格', 5, 51),
(17, 'A.中国共产党的领导', 5, 52),
(17, 'B.改革开放', 0, 53),
(17, 'C.以经济建设为中心', 0, 54),
(18, 'A.以经济建设为中心', 0, 55),
(18, 'B.改革开放', 5, 56),
(18, 'C.科教兴国战略', 0, 57),
(19, 'A.计划经济', 0, 58),
(19, 'B.商品经济', 0, 59),
(19, 'C.市场经济', 5, 60),
(20, 'A.党的领导', 5, 61),
(20, 'B.物质生产', 0, 62),
(20, 'C.精神文明建设', 0, 63),
(21, 'A.民族区域自治', 5, 64),
(21, 'B.人民代表大会', 0, 65),
(21, 'C.共产党领导的多党合作', 0, 66),
(22, 'A.建设者', 5, 67),
(22, 'B.经营者', 0, 68),
(22, 'C.领导者', 0, 69),
(23, 'A.和平谈判', 0, 70),
(23, 'B.两岸三通', 0, 71),
(23, 'C.“一个国家、两种制度”', 5, 72),
(24, 'A.先进性', 0, 73),
(24, 'B.纯洁性', 0, 74),
(24, 'C.先进性和纯洁性', 5, 75),
(25, 'A.先进性建设', 0, 76),
(25, 'B.反腐倡廉建设', 5, 77),
(25, 'C.纯洁性建设', 0, 78),
(26, 'A.规范化', 0, 79),
(26, 'B.科学化', 5, 80),
(26, 'C.制度化', 0, 81),
(27, 'A.科学型', 0, 82),
(27, 'B.制度型', 0, 83),
(27, 'C.服务型', 5, 84),
(28, 'A.求真务实', 5, 85),
(28, 'B.艰苦奋斗', 0, 86),
(28, 'C.执政为民', 0, 87),
(29, 'A.党的思想路线', 0, 88),
(29, 'B.党的政治路线', 0, 89),
(29, 'C.党的群众路线', 5, 90),
(30, 'A.密切联系群众', 5, 91),
(30, 'B.理论联系实际', 0, 92),
(30, 'C.批评与自我批评', 0, 93),
(31, 'A.决策失误', 0, 94),
(31, 'B.脱离群众', 5, 95),
(31, 'C.思想僵化', 0, 96),
(32, 'A.政治', 0, 97),
(32, 'B.思想', 0, 98),
(32, 'C.政治、思想和组织', 5, 99),
(33, 'A.青年', 0, 100),
(33, 'B.青少年', 0, 101),
(33, 'C.先进青年', 5, 102),
(34, 'A.16岁', 0, 103),
(34, 'B.18岁', 5, 104),
(34, 'C.20岁', 0, 105),
(35, 'A.6项', 0, 106),
(35, 'B.8项', 5, 107),
(35, 'C.10项', 0, 108),
(36, 'A.8项', 5, 109),
(36, 'B.7项', 0, 110),
(36, 'C.6项', 0, 111),
(37, 'A.桥梁和纽带作用', 0, 112),
(37, 'B.先锋模范作用', 5, 113),
(37, 'C.战斗堡垒作用', 0, 114),
(38, 'A.开除', 0, 115),
(38, 'B.罢免', 5, 116),
(38, 'C.辞退', 0, 117),
(39, 'A.本人无权参加和进行申辩', 0, 118),
(39, 'B.其他党员不可以为他作证和辩护', 0, 119),
(39, 'C.本人有权参加和进行申辩，其他党员可以为他作证和辩护', 5, 120),
(40, 'A.可以不执行党的决议和政策', 0, 121),
(40, 'B.在坚决执行的前提下，可以声明保留，并且可以把自己的意见向党的上级组织直至中央提出', 5, 122),
(40, 'C.必须坚决执行，不可以声明保留，也不允许向上级组织提出', 0, 123),
(41, 'A.党员只能向上级党组织提出请求、申诉和控告', 0, 124),
(41, 'B.党员可以向上级党组织直至中央提出请求、申诉和控告', 0, 125),
(41, 'C.党员可以向上级党组织直至中央提出请求、申诉和控告，并要求有关组织给以负责的答复', 5, 126),
(42, 'A.党的路线方针政策', 0, 127),
(42, 'B.党的纲领和党的章程', 5, 128),
(42, 'C.党的历史', 0, 129),
(43, 'A.遵守党的章程', 5, 130),
(43, 'B.遵守国家的法律', 0, 131),
(43, 'C.遵守党的纪律', 0, 132),
(44, 'A.1年', 5, 133),
(44, 'B.2年', 0, 134),
(44, 'C.3年', 0, 135),
(45, 'A.递交入党申请书', 0, 136),
(45, 'B.递交入党志愿书', 0, 137),
(45, 'C.支部大会通过他为预备党员', 5, 138),
(46, 'A.半年', 0, 139),
(46, 'B.1年', 5, 140),
(46, 'C.2年', 0, 141),
(47, 'A.留党察看', 0, 142),
(47, 'B.延长预备期', 0, 143),
(47, 'C.取消预备党员资格', 5, 144),
(48, 'A.支部大会', 5, 145),
(48, 'B.支部委员会', 0, 146),
(48, 'C.党小组', 0, 147),
(49, 'A.党员领导干部', 0, 148),
(49, 'B.正式党员', 5, 149),
(49, 'C.预备党员', 0, 150),
(50, 'A.集体吸收', 0, 151),
(50, 'B.个别吸收', 5, 152),
(50, 'C.个别吸收和集体吸收相结合', 0, 153);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
