-- phpMyAdmin SQL Dump
-- version 3.0.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2009 at 01:26 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `phpadadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr` varchar(255) NOT NULL,
  `displayattr` varchar(255) NOT NULL,
  `order` int(3) NOT NULL DEFAULT '999',
  `uservisable` varchar(10) NOT NULL DEFAULT 'FALSE',
  `useredit` varchar(255) NOT NULL DEFAULT 'FALSE',
  `manageredit` varchar(11) NOT NULL DEFAULT 'FALSE',
  `search` varchar(10) NOT NULL DEFAULT 'FALSE',
  `formtype` varchar(255) NOT NULL DEFAULT 'text',
  `options` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL,
  `validation` varchar(10) NOT NULL DEFAULT 'NONE',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `attr`, `displayattr`, `order`, `uservisable`, `useredit`, `manageredit`, `search`, `formtype`, `options`, `desc`, `validation`) VALUES
(1, 'givenname', 'First Name', 1, 'TRUE', 'FALSE', 'FALSE', 'TRUE', 'text', 'beans', 'hello', 'NONE'),
(2, 'sn', 'Surname', 2, 'TRUE', 'TRUE', 'FALSE', 'TRUE', 'text', '', '', 'NONE'),
(3, 'title', 'Job Title', 4, 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(4, 'description', 'Description', 3, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'text', 'this is a text', 'beans', 'NONE'),
(5, 'telephonenumber', 'Telephone Number', 999, 'TRUE', 'TRUE', 'FALSE', 'TRUE', 'text', '', '', 'NONE'),
(6, 'mobile', 'Mobile Number', 999, 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(7, 'facsimiletelephonenumber', 'Fax Number', 999, 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(8, 'pager', 'Pager', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(9, 'company', 'Company Name', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'dropdown', '', '', 'NONE'),
(10, 'physicaldeliveryofficename', 'Office', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(11, 'streetaddress', 'Address', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(12, 'mail', 'Email Address', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(13, 'extensionattribute1', 'Somthing Custom', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(14, 'extensionattribute2', 'Somthing Custom', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(15, 'extensionattribute3', 'Somthing Custom', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(16, 'extensionattribute4', 'Somthing Custom', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(17, 'extensionattribute5', 'Somthing Custom', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(18, 'extensionattribute6', 'Somthing Custom', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE'),
(19, 'extensionattribute7', 'Somthing Custom', 999, 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE');

-- --------------------------------------------------------

--
-- Table structure for table `formtype`
--

CREATE TABLE `formtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `formtype`
--

INSERT INTO `formtype` (`id`, `value`, `name`) VALUES
(1, 'text', 'Text'),
(2, 'textbox', 'Text Box'),
(3, 'radio', 'Radio'),
(4, 'checkbox', 'Check Box'),
(5, 'dropdown', 'Drop Down List');

-- --------------------------------------------------------

--
-- Table structure for table `validationtype`
--

CREATE TABLE `validationtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `validationtype`
--

INSERT INTO `validationtype` (`id`, `value`, `name`) VALUES
(1, 'NONE', 'No Validation'),
(2, 'textonly', 'Text Only'),
(3, 'numbers', 'Numbers Only'),
(4, 'email', 'Email Address');
