-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2014 at 05:39 AM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `connectify`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE IF NOT EXISTS `friendship` (
  `user1id` int(11) NOT NULL,
  `user2id` int(11) NOT NULL,
  `user1circle` int(11) NOT NULL,
  `user2circle` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `user1id` (`user1id`),
  KEY `user2id` (`user2id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_memebers`
--

CREATE TABLE IF NOT EXISTS `group_memebers` (
  `groupID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `groupID` (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_posts`
--

CREATE TABLE IF NOT EXISTS `group_posts` (
  `storyid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  KEY `storyid` (`storyid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorid` int(11) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `authorid` (`authorid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `story_comments`
--

CREATE TABLE IF NOT EXISTS `story_comments` (
  `storyid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `storyid` (`storyid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `story_likes`
--

CREATE TABLE IF NOT EXISTS `story_likes` (
  `storyid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `storyid` (`storyid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '1',
  `email` varchar(25) NOT NULL,
  `circle1id` int(11) NOT NULL AUTO_INCREMENT,
  `circle2id` int(11) NOT NULL AUTO_INCREMENT,
  `circle3id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friendship`
--
ALTER TABLE `friendship`
  ADD CONSTRAINT `friendship_ibfk_1` FOREIGN KEY (`user1id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friendship_ibfk_2` FOREIGN KEY (`user2id`) REFERENCES `users` (`id`);

--
-- Constraints for table `group_memebers`
--
ALTER TABLE `group_memebers`
  ADD CONSTRAINT `group_memebers_ibfk_1` FOREIGN KEY (`groupID`) REFERENCES `groups` (`id`);

--
-- Constraints for table `group_posts`
--
ALTER TABLE `group_posts`
  ADD CONSTRAINT `group_posts_ibfk_1` FOREIGN KEY (`storyid`) REFERENCES `stories` (`id`),
  ADD CONSTRAINT `group_posts_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `groups` (`id`);

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`);

--
-- Constraints for table `story_comments`
--
ALTER TABLE `story_comments`
  ADD CONSTRAINT `story_comments_ibfk_1` FOREIGN KEY (`storyid`) REFERENCES `stories` (`id`),
  ADD CONSTRAINT `story_comments_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `story_likes`
--
ALTER TABLE `story_likes`
  ADD CONSTRAINT `story_likes_ibfk_1` FOREIGN KEY (`storyid`) REFERENCES `stories` (`id`),
  ADD CONSTRAINT `story_likes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
