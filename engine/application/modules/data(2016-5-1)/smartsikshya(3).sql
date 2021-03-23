-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2016 at 05:52 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smartsikshya`
--

-- --------------------------------------------------------

--
-- Table structure for table `hya_data_answer`
--

CREATE TABLE IF NOT EXISTS `hya_data_answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `subquestion_id` int(11) NOT NULL,
  `answer_name` varchar(255) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hya_data_description`
--

CREATE TABLE IF NOT EXISTS `hya_data_description` (
  `description_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `subquestion_id` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`description_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hya_data_hint`
--

CREATE TABLE IF NOT EXISTS `hya_data_hint` (
  `hint_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `subquestion_id` int(11) NOT NULL,
  `hint` varchar(255) NOT NULL,
  PRIMARY KEY (`hint_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hya_data_hint`
--

INSERT INTO `hya_data_hint` (`hint_id`, `question_id`, `subquestion_id`, `hint`) VALUES
(2, 1, 0, '<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;"><h4>A PHP Error was encountered</h4><p>Severity: Notice</p><p>Message:  Undefined property: stdClass::$hint_name</p><p>Filename: slc/edit_question.php</p><p>Line Number: 974</p></d');

-- --------------------------------------------------------

--
-- Table structure for table `hya_data_option`
--

CREATE TABLE IF NOT EXISTS `hya_data_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `subquestion_id` int(11) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `hya_data_option`
--

INSERT INTO `hya_data_option` (`option_id`, `question_id`, `subquestion_id`, `option_name`) VALUES
(1, 2, 0, 'option1'),
(2, 2, 0, 'option2'),
(5, 1, 0, 'option1'),
(6, 1, 0, 'option2');

-- --------------------------------------------------------

--
-- Table structure for table `hya_data_question`
--

CREATE TABLE IF NOT EXISTS `hya_data_question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_type` varchar(255) NOT NULL,
  `question_set` varchar(255) NOT NULL,
  `question_tag` varchar(255) NOT NULL,
  `appeared_year` varchar(255) NOT NULL,
  `mark` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `board_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `stream_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `subunit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_date` timestamp NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hya_data_question`
--

INSERT INTO `hya_data_question` (`question_id`, `question_type`, `question_set`, `question_tag`, `appeared_year`, `mark`, `question`, `board_id`, `level_id`, `stream_id`, `course_id`, `year`, `semester`, `department_id`, `subject_id`, `chapter_id`, `unit_id`, `subunit_id`, `user_id`, `status`, `created_date`) VALUES
(1, 'Text Entry', 'A', 'very_short', '2016', '', '<p>\r\n	test</p>\r\n', 3, 2, 5, 0, 0, 0, 0, 0, 0, 0, 0, 48, 1, '2016-02-15 11:53:21'),
(2, 'Image', 'A', 'very_short', '2016', '55', '<p>\r\n	jh j kjk</p>\r\n', 12, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 48, 1, '2016-02-08 10:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `hya_data_reason`
--

CREATE TABLE IF NOT EXISTS `hya_data_reason` (
  `reason_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `subquestion_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hya_data_subquestion`
--

CREATE TABLE IF NOT EXISTS `hya_data_subquestion` (
  `subquestion_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `subquestion_name` varchar(255) NOT NULL,
  PRIMARY KEY (`subquestion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
