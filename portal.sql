-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2022 at 03:19 PM
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
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `main_nav`
--

DROP TABLE IF EXISTS `main_nav`;
CREATE TABLE IF NOT EXISTS `main_nav` (
  `nav_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `link` varchar(400) COLLATE utf8_bin NOT NULL,
  `visible` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'true',
  `added_by` varchar(60) COLLATE utf8_bin NOT NULL,
  `edited_time` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`nav_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `main_nav`
--

INSERT INTO `main_nav` (`nav_id`, `name`, `link`, `visible`, `added_by`, `edited_time`) VALUES
(1, 'News', '?news', 'true', '1', ''),
(2, 'Admin', '?acp', 'true', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(5) NOT NULL AUTO_INCREMENT,
  `author` varchar(40) COLLATE utf8_bin NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `photo` varchar(400) COLLATE utf8_bin NOT NULL,
  `added_time` int(50) NOT NULL,
  `edited_time` int(5) DEFAULT NULL,
  `edited_by` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `author`, `title`, `text`, `photo`, `added_time`, `edited_time`, `edited_by`) VALUES
(1, '1', 'First news', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus fermentum augue. Maecenas iaculis metus eget erat pulvinar sodales. Aliquam ligula enim, vestibulum sed mattis vitae, tristique vel odio. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In cursus tristique vulputate. Ut convallis odio nec dui suscipit, nec dignissim augue mollis. In a nunc sit amet odio pulvinar condimentum. Mauris quis quam eu mi laoreet egestas. Ut pretium metus metus, at tristique nibh sollicitudin mollis. Nunc molestie elit id lectus consequat vehicula. Aenean sed libero sed mauris viverra efficitur fringilla quis est.\r\n\r\nEtiam dignissim erat in dictum pulvinar. Sed in maximus quam, in faucibus sapien. Donec semper dolor ut sem congue lacinia. Sed quis metus nibh. Nunc nisl enim, condimentum id euismod vitae, sollicitudin non justo. Morbi eu ullamcorper tellus, nec semper lacus. Praesent placerat turpis id dignissim tempus. Cras consectetur hendrerit vehicula.', 'http://localhost/hosts/project/portal_v2/images/news/download.jpg', , 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

DROP TABLE IF EXISTS `todolist`;
CREATE TABLE IF NOT EXISTS `todolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `photo` varchar(400) COLLATE utf8_bin NOT NULL,
  `added_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_user` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `edited_time` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`id`, `author`, `title`, `text`, `photo`, `added_time`, `edited_user`, `edited_time`) VALUES
(1, '', 'To do list off the page', '<b>Lietas kas vel jaizdara/jau izdaritas </b><br />\r\n            <i style=\"padding-left:10px;\">Login sistema</i><br />\r\n            <i style=\"padding-left:10px;\">Registracija</i><br />\r\n            <i style=\"padding-left:10px;\">Profila bilde</i><br />\r\n            <i style=\"padding-left:10px;\">Mans profils</i><br /> \r\n            <i style=\"padding-left:10px;\">Vestules (nosutit, izlasit, izdzest)</i><br />\r\n            <i style=\"padding-left:10px;\">apskatities citus lielotajus</i><br />\r\n            <i style=\"padding-left:10px;\">Galerijas (bildes )</i>&nbsp;<br />\r\n            <i style=\"padding-left:10px;\">Galerijas (video)</i>&nbsp;<br />\r\n            <i style=\"padding-left:10px;\">Galerijas (muzika)</i>&nbsp;<br />\r\n            <i style=\"padding-left:10px;\">Statistika (kas mani skatijies )</i>&nbsp;<br />\r\n            <i style=\"padding-left:10px;\">Draugi (pievienot, bloket )</i><br>\r\n            <i style=\"padding-left:10px;\">Admin panels</i><br>\r\n            &nbsp;<br />\r\n            <br />', 'themes/default/images/maintenance/Under-Construction-Clipart-PNG.png', '2022-05-09 20:37:30', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `bday` int(5) NOT NULL,
  `bmonth` int(5) NOT NULL,
  `byear` int(5) NOT NULL,
  `gender` varchar(30) COLLATE utf8_bin NOT NULL,
  `location` varchar(30) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `lastname` varchar(40) CHARACTER SET utf8 NOT NULL,
  `picture` varchar(250) COLLATE utf8_bin DEFAULT 'http://localhost/hosts/project/portal_v2/themes/default/images/no_profile_picture.jpeg',
  `access` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `bday`, `bmonth`, `byear`, `gender`, `location`, `firstname`, `lastname`, `picture`, `access`) VALUES
(1, '', '', '', 0, 0, 0, '0', '0', '', '', 'http://localhost/hosts/project/portal_v2/themes/default/images/no_profile_picture.jpeg', '5');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
