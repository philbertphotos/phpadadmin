-- phpMyAdmin SQL Dump
-- version 3.0.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2009 at 02:42 PM
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
  `required` varchar(20) NOT NULL DEFAULT 'FALSE',
  `useredit` varchar(255) NOT NULL DEFAULT 'FALSE',
  `manageredit` varchar(11) NOT NULL DEFAULT 'FALSE',
  `search` varchar(10) NOT NULL DEFAULT 'FALSE',
  `formtype` varchar(255) NOT NULL DEFAULT 'text',
  `options` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL,
  `validation` varchar(40) NOT NULL DEFAULT 'NONE',
  `requireexchange` varchar(10) NOT NULL DEFAULT 'FALSE',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `attr`, `displayattr`, `order`, `uservisable`, `required`, `useredit`, `manageredit`, `search`, `formtype`, `options`, `desc`, `validation`, `requireexchange`) VALUES
(1, 'givenname', 'First Name', 2, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'TRUE', 'text', '', 'Given name', 'validate-alpha', 'FALSE'),
(2, 'sn', 'Last Name', 2, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'TRUE', 'text', '', 'Surname', 'validate-alpha', 'FALSE'),
(3, 'title', 'Job Title', 4, 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'FALSE', 'text', '', '', 'validate-email', 'FALSE'),
(4, 'description', 'Description', 3, 'FALSE', 'FALSE', 'TRUE', 'TRUE', 'FALSE', 'text', 'this is a text', 'beans', 'NONE', 'FALSE'),
(5, 'telephonenumber', 'Telephone Number', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'TRUE', 'text', '', '', 'validate-digits', 'FALSE'),
(6, 'mobile', 'Mobile Number', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'validate-digits', 'FALSE'),
(7, 'facsimiletelephonenumber', 'Fax Number', 999, 'TRUE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'validate-digits', 'FALSE'),
(8, 'pager', 'Pager', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'FALSE'),
(9, 'company', 'Company Name', 999, 'TRUE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'dropdown', 'HP,EDS', '', 'NONE', 'FALSE'),
(10, 'physicaldeliveryofficename', 'Office', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'TRUE', 'dropdown', 'BIG OFFICE,small office,beans,meanz,heinz', '', 'NONE', 'FALSE'),
(11, 'streetaddress', 'Address', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'textbox', 'rows="5" cols="50"', '', 'NONE', 'FALSE'),
(12, 'mail', 'Email Address', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'FALSE'),
(13, 'extensionattribute1', 'Has Blackberry', 999, 'TRUE', 'TRUE', 'TRUE', 'TRUE', 'TRUE', 'checkbox', '', '', 'NONE', 'TRUE'),
(14, 'extensionattribute2', 'Sex', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'radio', 'Male,Female,Yes Please tee hee', '', 'NONE', 'TRUE'),
(15, 'extensionattribute3', 'Home Email', 999, 'TRUE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', 'Your home email address', 'validate-email', 'TRUE'),
(16, 'extensionattribute4', 'Employee number', 1, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'text', '', 'Your Employee number (can be found in SAP, if you can find anything in SAP, good luck!)', 'validate-digits', 'TRUE'),
(17, 'extensionattribute5', 'Something Custom', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'TRUE'),
(18, 'extensionattribute6', 'Something Custom', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'TRUE'),
(19, 'extensionattribute7', 'Something Custom', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `example` varchar(100) NOT NULL,
  `validation` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `type`, `name`, `value`, `example`, `validation`) VALUES
(1, 'ldap', 'account_suffix', '@james-lloyd.com', '@mydomain.local', ''),
(2, 'ldap', 'base_dn', 'DC=james-lloyd,DC=com', 'DC=mydomain,DC=local', ''),
(3, 'ldap', 'domain_controllers', 'server1.james-lloyd.com', 'dc01.mydomain.local,dc02.mydomain.local', ''),
(4, 'ldap', 'ad_username', 'administrator', 'administrator', ''),
(5, 'ldap', 'ad_password', 'criterion', '**********', ''),
(6, 'ldap', 'real_primarygroup', 'true', 'true', ''),
(7, 'ldap', 'use_ssl', 'true', 'true', ''),
(8, 'ldap', 'recursive_groups', 'true', 'true', ''),
(9, 'selfservice', 'minpwlength', '5', '5 (minimum password length)', 'validate-digits'),
(10, 'selfservice', 'minquestionslength', '10', '10 minimum number of characters in user questions', 'validate-digits'),
(11, 'selfservice', 'minanswerlength', '3', '3 minimum number of characters in answer', 'validate-digits'),
(12, 'selfservice', 'noquestionstoask', '3', '3 Number of questions you have to answer to reset password', 'validate-digits'),
(13, 'selfservice', 'encryptionkey', 'cd2aee218c6e678f5ca4bfca8b064710', 'some random garbage to encrypt the user questions', ''),
(14, 'phpadadmin', 'admingroup', 'NULL', 'Domain Admins ( the name of the group that has access to these page NULL for only you)', ''),
(15, 'phpadadmin', 'forcehttps', 'FALSE', 'true (Force connections over https)', ''),
(16, 'phpadadmin', 'exchangeinstalled', 'FALSE', 'TRUE (have you run the exchange schema update?, this will allow use of custom user attributes)', '');

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
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `validationtype`
--

INSERT INTO `validationtype` (`id`, `value`, `name`) VALUES
(1, 'NONE', 'No Validation'),
(2, 'validate-alpha', 'Text Only'),
(3, 'validate-digits', 'Numbers Only'),
(4, 'validate-email', 'Email Address'),
(6, 'validate-alphanum', 'Only Letters and numbers'),
(7, 'validate-date', 'a valid date value'),
(8, 'validate-url', 'A valid url');
