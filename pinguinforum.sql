-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2014 at 11:29 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pinguinforum`
--

-- --------------------------------------------------------

--
-- Table structure for table `block_word`
--

CREATE TABLE IF NOT EXISTS `block_word` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `word` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE IF NOT EXISTS `blog_category` (
  `id_cat` int(100) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`id_cat`, `category`, `deskripsi`) VALUES
(1, 'Web Design', 'Tentang Web Design'),
(2, 'Web Devolepment', 'Devolempement website'),
(3, 'Linux', 'Seputar distro-distro linux'),
(4, 'Networking', 'Seputar masalah Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `comment_ID` bigint(20) NOT NULL,
  `comment_post_ID` bigint(20) NOT NULL,
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL,
  `comment_author_url` varchar(255) NOT NULL,
  `comment_author_IP` varchar(255) NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_content` text NOT NULL,
  `comment_approved` int(11) NOT NULL,
  KEY `comment_post_ID` (`comment_post_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_status` varchar(255) NOT NULL,
  `post_name` varchar(255) NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `post_modified` datetime NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `comment_count` bigint(20) NOT NULL,
  `post_view` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_cat` int(100) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_cat`, `category`, `deskripsi`) VALUES
(1, 'Web Design', 'Tentang Web Design'),
(2, 'Web Devolepment', 'Devolempement website'),
(3, 'Linux', 'Seputar distro-distro linux'),
(4, 'Networking', 'Seputar masalah Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(100) NOT NULL AUTO_INCREMENT,
  `id_thread` int(100) NOT NULL,
  `id` int(100) NOT NULL,
  `comment` varchar(10000) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id` (`id`),
  KEY `id_thread` (`id_thread`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_thread`, `id`, `comment`, `time`) VALUES
(1, 1, 7, 'joss', '2014-08-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `id_forum` int(11) NOT NULL AUTO_INCREMENT,
  `forum_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_forum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id_forum`, `forum_name`) VALUES
(1, 'Seputar Linux'),
(9, 'Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `forum_category`
--

CREATE TABLE IF NOT EXISTS `forum_category` (
  `id_category` int(100) NOT NULL AUTO_INCREMENT,
  `category_desc` varchar(200) NOT NULL,
  `forum_id` int(11) NOT NULL,
  PRIMARY KEY (`id_category`),
  KEY `forum_id` (`forum_id`),
  KEY `forum_id_2` (`forum_id`),
  KEY `id_category` (`id_category`),
  KEY `forum_id_3` (`forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forum_category`
--

INSERT INTO `forum_category` (`id_category`, `category_desc`, `forum_id`) VALUES
(1, 'Segala Tentang Linux', 1),
(2, 'Serba serbi', 9);

-- --------------------------------------------------------

--
-- Table structure for table `forum_post`
--

CREATE TABLE IF NOT EXISTS `forum_post` (
  `id_post` int(100) NOT NULL AUTO_INCREMENT,
  `post_desc` text NOT NULL,
  `forum_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `sub_id` (`sub_id`),
  KEY `thread` (`thread_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_sub`
--

CREATE TABLE IF NOT EXISTS `forum_sub` (
  `id_sub` int(100) NOT NULL AUTO_INCREMENT,
  `subforum` varchar(100) NOT NULL,
  `id_kate` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forum_sub`
--

INSERT INTO `forum_sub` (`id_sub`, `subforum`, `id_kate`, `thread_id`) VALUES
(1, 'Free BSD', 1, 4),
(2, 'Debian', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_thread`
--

CREATE TABLE IF NOT EXISTS `forum_thread` (
  `id_thread` int(100) NOT NULL AUTO_INCREMENT,
  `thread_title` varchar(100) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_date` varchar(30) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  PRIMARY KEY (`id_thread`),
  KEY `sub_id` (`sub_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `forum_thread`
--

INSERT INTO `forum_thread` (`id_thread`, `thread_title`, `thread_desc`, `thread_date`, `sub_id`, `forum_id`, `category_id`, `user_id`) VALUES
(4, 'Linux', 'linux adalah', '12-12-2012', 1, 1, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `id_thread` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `thread` text NOT NULL,
  `id_cat` int(100) NOT NULL,
  `time` datetime NOT NULL,
  `id_user` int(100) NOT NULL,
  PRIMARY KEY (`id_thread`),
  KEY `id_cat` (`id_cat`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`id_thread`, `title`, `thread`, `id_cat`, `time`, `id_user`) VALUES
(1, 'Code Igniter', '', 1, '2014-08-14 00:00:00', 7),
(3, 'Coding Dengan Codeigniter', 'Hola Codeigniter', 2, '2014-08-13 00:00:00', 7),
(10, '$judul', '$thread', 2, '0000-00-00 00:00:00', 7),
(13, 'afsdfasd', 'asdfadsfasdf', 2, '2014-08-15 00:00:00', 8),
(14, 'asdfasdf', '<p>asdfasdfasdfasdf</p>', 2, '2026-08-14 00:00:00', 7),
(15, 'jaringan', '<p>jaringan berhubungan&nbsp;</p>', 3, '2026-08-14 00:00:00', 7),
(16, 'berhubungan dengan css', '<p>css jaringan jaringan&nbsp;</p>', 1, '2026-08-14 00:00:00', 7),
(17, 'asdfasdfasdf', '<p>maka dari itualah semua terjadi&nbsp;</p>', 1, '2027-08-14 00:00:00', 9),
(18, 'helo', '', 2, '2014-11-19 00:00:00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `join` varchar(30) NOT NULL,
  `level` int(2) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`, `join`, `level`, `status`) VALUES
(7, 'user', '202cb962ac59075b964b07152d234b70', 'user', 'sukhaku@gmail.com', '12-12-12', 4, 1),
(8, 'admin', '202cb962ac59075b964b07152d234b70', 'pinguin', 'sukhaku@gmail.com', '12-12-12', 3, 1),
(9, 'ramaonrail', '48fc01ae9e3a6d0df92d4fe42eaa2b1d', 'ramaprakoso', 'rama.wiedprakoso@gmail.com', '12-12-12', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `id_level` int(2) NOT NULL AUTO_INCREMENT,
  `level` varchar(100) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_level`, `level`) VALUES
(3, 'admin'),
(4, 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_ibfk_1` FOREIGN KEY (`comment_post_ID`) REFERENCES `blog_posts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_comment`) REFERENCES `thread` (`id_thread`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum_category`
--
ALTER TABLE `forum_category`
  ADD CONSTRAINT `forum_category_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id_forum`);

--
-- Constraints for table `forum_post`
--
ALTER TABLE `forum_post`
  ADD CONSTRAINT `forum_post_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `forum_sub` (`id_sub`),
  ADD CONSTRAINT `forum_post_ibfk_3` FOREIGN KEY (`thread_id`) REFERENCES `forum_thread` (`id_thread`),
  ADD CONSTRAINT `forum_post_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `forum_post_ibfk_5` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id_forum`);

--
-- Constraints for table `forum_thread`
--
ALTER TABLE `forum_thread`
  ADD CONSTRAINT `forum_thread_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `forum_sub` (`id_sub`),
  ADD CONSTRAINT `forum_thread_ibfk_2` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id_forum`),
  ADD CONSTRAINT `forum_thread_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `forum_thread_ibfk_5` FOREIGN KEY (`category_id`) REFERENCES `forum_category` (`id_category`);

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `blog_category` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thread_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `user_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
