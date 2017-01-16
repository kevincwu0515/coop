/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : coop

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-01-16 15:33:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `acctype` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES ('1', 'admin', 'admin', '1');
INSERT INTO `accounts` VALUES ('2', 'admin2', 'admin2', '2');
INSERT INTO `accounts` VALUES ('3', 'admin3', 'admin3', '3');
INSERT INTO `accounts` VALUES ('4', 'admin4', 'admin4', '4');
INSERT INTO `accounts` VALUES ('5', 'admin5', 'admin5', '5');
INSERT INTO `accounts` VALUES ('6', 'uwindsor', 'uwindsor', '2');
INSERT INTO `accounts` VALUES ('7', 'ibm', 'ibm', '2');
INSERT INTO `accounts` VALUES ('10', 'facebook', 'facebook', '2');
INSERT INTO `accounts` VALUES ('11', 'amazon', 'amazon', '2');
INSERT INTO `accounts` VALUES ('12', 'google', 'google', '2');
INSERT INTO `accounts` VALUES ('13', 'kevinwu', 'kevinwu', '1');
INSERT INTO `accounts` VALUES ('14', 'kevinw300', 'Ab661466', '1');
INSERT INTO `accounts` VALUES ('15', 'gsfgas', 'gfafdsfd', '1');
INSERT INTO `accounts` VALUES ('18', 'kevinw400', 'Ab661466', '4');

-- ----------------------------
-- Table structure for applications
-- ----------------------------
DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `status` tinyint(5) DEFAULT '0',
  `applytime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `application_onref_postid` (`postid`),
  CONSTRAINT `application_onref_postid` FOREIGN KEY (`postid`) REFERENCES `postings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of applications
-- ----------------------------

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `year` int(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `coursename` varchar(255) DEFAULT NULL,
  `instructor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', '1', '0360-198', 'Co-op Work Term I', '3');
INSERT INTO `course` VALUES ('2', '2', '0360-298', 'Co-op Work Term II', '3');
INSERT INTO `course` VALUES ('3', '3', '0360-398', 'Co-op Work Term III', '3');
INSERT INTO `course` VALUES ('4', '4', '0360-498', 'Co-op Work Term IV', '3');
INSERT INTO `course` VALUES ('5', '5', '0360-498', 'Co-op Work Term V', '3');

-- ----------------------------
-- Table structure for internship
-- ----------------------------
DROP TABLE IF EXISTS `internship`;
CREATE TABLE `internship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employerid` int(11) DEFAULT NULL,
  `studentid` int(11) DEFAULT NULL,
  `jobtitle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `internship_onref_employerid` (`employerid`),
  CONSTRAINT `internship_onref_employerid` FOREIGN KEY (`employerid`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of internship
-- ----------------------------

-- ----------------------------
-- Table structure for interviewtime
-- ----------------------------
DROP TABLE IF EXISTS `interviewtime`;
CREATE TABLE `interviewtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interviewnumber` tinyint(5) NOT NULL,
  `postid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `time` timestamp NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `interviewtime_onref_postid` (`postid`),
  CONSTRAINT `interviewtime_onref_postid` FOREIGN KEY (`postid`) REFERENCES `postings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of interviewtime
-- ----------------------------
INSERT INTO `interviewtime` VALUES ('23', '1', '1', '13', '2017-01-31 02:30:00', '0');
INSERT INTO `interviewtime` VALUES ('24', '2', '1', '13', '2017-01-31 02:00:00', '0');
INSERT INTO `interviewtime` VALUES ('25', '3', '1', '13', '2017-01-24 02:00:00', '1');
INSERT INTO `interviewtime` VALUES ('26', '4', '1', '13', '2017-01-24 02:00:00', '0');

-- ----------------------------
-- Table structure for postings
-- ----------------------------
DROP TABLE IF EXISTS `postings`;
CREATE TABLE `postings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` tinytext,
  `address` varchar(255) NOT NULL DEFAULT 'Address',
  `city` varchar(255) NOT NULL DEFAULT 'City',
  `province` varchar(255) NOT NULL DEFAULT 'Province',
  `postalcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `salary` decimal(10,2) NOT NULL DEFAULT '0.00',
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enddate` timestamp NOT NULL,
  `department` tinyint(8) DEFAULT '0',
  `schoolyear` tinyint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `postingss_onref_accid` (`accid`),
  CONSTRAINT `postingss_onref_accid` FOREIGN KEY (`accid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of postings
-- ----------------------------
INSERT INTO `postings` VALUES ('1', '6', 'Java Developer', 'This position has the responsibility to enhance and develop secure, high performance and high quality software in a web environment, and to provide support. This is a permanent Full-Time Role', '401 Sunset', 'Windsor', 'Ontario', 'N9B 3P4', 'Canada', '0.00', '2017-01-02 21:01:18', '2019-01-13 00:00:00', '3', '4');

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accid` int(11) NOT NULL,
  `companyname` varchar(50) NOT NULL DEFAULT 'Company Name',
  `firstname` varchar(255) NOT NULL DEFAULT 'First Name',
  `lastname` varchar(255) NOT NULL DEFAULT 'Last Name',
  `occupation` varchar(255) NOT NULL DEFAULT 'Student',
  `address` varchar(255) NOT NULL DEFAULT 'Address',
  `city` varchar(255) NOT NULL DEFAULT 'City',
  `province` varchar(255) NOT NULL DEFAULT 'Province',
  `postalcode` varchar(255) NOT NULL DEFAULT 'Postal Code',
  `country` varchar(255) NOT NULL DEFAULT 'Country',
  `phonenumber` varchar(255) NOT NULL DEFAULT 'Phone Number',
  `faxnumber` varchar(255) NOT NULL DEFAULT 'Fax Number',
  `email` varchar(255) NOT NULL DEFAULT 'email@email.com',
  `website` varchar(255) NOT NULL DEFAULT 'www.website.com',
  `twitter` varchar(255) NOT NULL DEFAULT 'twitter',
  `profile_p1` varchar(8000) NOT NULL DEFAULT '',
  `profile_p2` varchar(8000) NOT NULL DEFAULT '',
  `linkedin` varchar(255) NOT NULL DEFAULT 'https://www.linkedin.com/',
  `github` varchar(255) NOT NULL DEFAULT 'https://github.com/',
  `facebook` varchar(255) NOT NULL DEFAULT 'https://www.facebook.com/',
  `googleplus` varchar(255) NOT NULL DEFAULT 'https://plus.google.com/',
  `instagram` varchar(255) NOT NULL DEFAULT 'https://www.instagram.com/',
  `department` tinyint(5) DEFAULT '0',
  `schoolyear` tinyint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `profiles_onref_accid` (`accid`),
  CONSTRAINT `profiles_onref_accid` FOREIGN KEY (`accid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of profiles
-- ----------------------------
INSERT INTO `profiles` VALUES ('1', '13', 'Company Name', 'Kevin', 'Wu', 'Student', '72 Hanna Street East', 'Windsor', 'Ontario', 'N8X2M9', 'Canada', '(226)260-9968', 'Fax Number', 'wu12o@uwindsor.ca', 'www.kevinjwu.com', 'twitter', 'A simple objective', 'A simple person', 'https://www.linkedin.com/', 'https://github.com/', 'https://www.facebook.com/', 'https://plus.google.com/', 'https://www.instagram.com/', '3', '4');
INSERT INTO `profiles` VALUES ('2', '6', 'Univeristy of Windsor', 'FName', 'LName', 'Student', '401 Sunset Ave', 'Windsor', 'Ontario', 'N9B 3P4', 'Canada', '519-971-3650', 'Fax Number', 'registrar@uwindsor.ca', 'www.uwindsor.ca', 'uwindsor', 'The University of Windsor (U of W or UWindsor) is a public comprehensive and research university in Windsor, Ontario, Canada.[3] It is Canada\'s southernmost university.[4] It has a student population of approximately 15,000 full-time and part-time undergraduate students and over 1000 graduate students.[5] The University of Windsor has graduated more than 100,000 alumni since its founding.[6]', 'Credibility â€“ Your reputation is important! The second C is credibility. This is made up of your reputation and your character. Your credibility is the most important single quality about you in terms of getting recommendations and referrals from your contacts. Make sure that everything you do is consistent with the highest ethical standards. Make sure that you never say or do anything that could be misconstrued by anyone as anything other than excellent conduct and behavior. Remember, people will only recommend you for a job opening if they are completely confident that they will not end up looking foolish as a result of something you do or say.', 'https://www.linkedin.com/', 'https://github.com/', 'https://www.facebook.com/', 'https://plus.google.com/', 'https://www.instagram.com/', '0', '0');
INSERT INTO `profiles` VALUES ('3', '2', 'Company Name', 'First Name', 'Last Name', 'Student', 'Address', 'City', 'Province', 'Postal Code', 'Country', 'Phone Number', 'Fax Number', 'email@email.com', 'www.website.com', 'twitter', '', '', 'https://www.linkedin.com/', 'https://github.com/', 'https://www.facebook.com/', 'https://plus.google.com/', 'https://www.instagram.com/', '0', '0');
INSERT INTO `profiles` VALUES ('4', '3', 'Company Name', 'kevin ', 'Wu', 'Student', 'Address', 'City', 'Province', 'Postal Code', 'Country', 'Phone Number', 'Fax Number', 'email@email.com', 'www.website.com', 'twitter', '', '', 'https://www.linkedin.com/', 'https://github.com/', 'https://www.facebook.com/', 'https://plus.google.com/', 'https://www.instagram.com/', '0', '0');

-- ----------------------------
-- Table structure for registration
-- ----------------------------
DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `acctype` tinyint(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of registration
-- ----------------------------

-- ----------------------------
-- Table structure for schoolterm
-- ----------------------------
DROP TABLE IF EXISTS `schoolterm`;
CREATE TABLE `schoolterm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startday` date NOT NULL,
  `endday` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of schoolterm
-- ----------------------------
INSERT INTO `schoolterm` VALUES ('1', '2016-05-01', '2016-08-31');
INSERT INTO `schoolterm` VALUES ('2', '2016-09-01', '2016-12-31');
INSERT INTO `schoolterm` VALUES ('3', '2017-01-01', '2017-05-31');

-- ----------------------------
-- Table structure for studenttermtracking
-- ----------------------------
DROP TABLE IF EXISTS `studenttermtracking`;
CREATE TABLE `studenttermtracking` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `summer` int(255) NOT NULL DEFAULT '0',
  `fall` int(255) NOT NULL DEFAULT '0',
  `winter` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of studenttermtracking
-- ----------------------------
