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
-- user1/2accept is 1 if that user has agreed to the friendship. 0 otherwise.
--

CREATE TABLE IF NOT EXISTS `friendship` (
  `user1id` int(11) NOT NULL,
  `user2id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user1accept` int(11) NOT NULL DEFAULT 0,
  `user2accept` int(11) NOT NULL DEFAULT 0,
  CHECK (user1id < user2id),
  PRIMARY KEY (`user1id`,`user2id`),
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
-- Table structure for table `group_members`
--
-- role can be member(0), moderator(1) or admin(2)
--

CREATE TABLE IF NOT EXISTS `group_members` (
  `groupID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`groupID`,`memberID`),
  KEY `groupID` (`groupID`),
  KEY `memberID` (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_posts`
--

CREATE TABLE IF NOT EXISTS `group_posts` (
  `storyid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`storyid`,`groupid`),
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
  `time` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `authorid` (`authorid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------




--
-- Table structure for table `story_likes`
--

CREATE TABLE IF NOT EXISTS `story_likes` (
  `storyid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storyid`,`userid`),
  KEY `storyid` (`storyid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Remeber to encrypt passwords
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '1',
  `email` varchar(25) NOT NULL,
  `passwd` varchar(25) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(30) NOT NULL DEFAULT "//placehold.it/200",
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` TEXT NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `authorid` int(11) NOT NULL,  
  `storyid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `authorid` (`authorid`),
  KEY `storyid` (`storyid`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



-- Constraints for dumped tables
--

--
-- Constraints for table `friendship`
--

ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`storyid`) REFERENCES `stories` (`id`)
  ON DELETE CASCADE  ;



ALTER TABLE `friendship`
  ADD CONSTRAINT `friendship_ibfk_1` FOREIGN KEY (`user1id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friendship_ibfk_2` FOREIGN KEY (`user2id`) REFERENCES `users` (`id`);

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`groupID`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`memberID`) REFERENCES `users` (`id`);
--
-- Constraints for table `group_posts`
--
ALTER TABLE `group_posts`
  ADD CONSTRAINT `group_posts_ibfk_1` FOREIGN KEY (`storyid`) REFERENCES `stories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_posts_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `groups` (`id`);

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`);


--
-- Constraints for table `story_likes`
--
ALTER TABLE `story_likes`
  ADD CONSTRAINT `story_likes_ibfk_1` FOREIGN KEY (`storyid`) REFERENCES `stories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `story_likes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);


CREATE TRIGGER remove_member
AFTER DELETE ON group_members
FOR EACH ROW 
DELETE FROM stories WHERE `id` IN 
 (
SELECT stories_.id AS id FROM  
(SELECT * FROM group_posts WHERE groupid = OLD.groupID) AS group_posts_ 
JOIN
(SELECT id FROM stories WHERE stories.authorid =  OLD.memberID ) AS stories_  
ON (group_posts_.storyid = stories_.id));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
