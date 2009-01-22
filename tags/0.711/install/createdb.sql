SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr` varchar(255) NOT NULL,
  `displayattr` varchar(255) NOT NULL,
  `order` int(3) NOT NULL DEFAULT '999',
  `uservisable` varchar(10) NOT NULL DEFAULT 'FALSE',
  `required` varchar(20) NOT NULL DEFAULT 'FALSE',
  `useredit` varchar(255) NOT NULL DEFAULT 'FALSE',
  `manageredit` varchar(11) NOT NULL DEFAULT 'FALSE',
  `search` varchar(10) NOT NULL DEFAULT 'FALSE',
  `returninsearch` varchar(10) NOT NULL DEFAULT 'FALSE',
  `formtype` varchar(255) NOT NULL DEFAULT 'text',
  `options` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL,
  `validation` varchar(40) NOT NULL DEFAULT 'NONE',
  `requireexchange` varchar(10) NOT NULL DEFAULT 'FALSE',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;
INSERT INTO `attributes` (`id`, `attr`, `displayattr`, `order`, `uservisable`, `required`, `useredit`, `manageredit`, `search`, `returninsearch`, `formtype`, `options`, `desc`, `validation`, `requireexchange`) VALUES
(1, 'givenname', 'First Name', 2, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'TRUE', 'FALSE', 'text', '', 'Given name', 'validate-alpha', 'FALSE'),
(2, 'sn', 'Last Name', 2, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'TRUE', 'FALSE', 'text', '', 'Surname', 'validate-alpha', 'FALSE'),
(3, 'title', 'Job Title', 4, 'TRUE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', 'Your Job Title', 'NONE', 'FALSE'),
(4, 'description', 'Description', 3, 'FALSE', 'FALSE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'text', 'this is a text', 'beans', 'NONE', 'FALSE'),
(5, 'telephonenumber', 'Telephone Number', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', 'Your DDI number', 'validate-digits', 'FALSE'),
(6, 'mobile', 'Mobile Number', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', '', 'validate-digits', 'FALSE'),
(7, 'facsimiletelephonenumber', 'Fax Number', 999, 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'FALSE', 'FALSE', 'radio', '12356,232463', '', 'validate-digits', 'FALSE'),
(8, 'pager', 'Pager', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'FALSE'),
(9, 'company', 'Company Name', 999, 'TRUE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'dropdown', 'Random Company1,Other Company 2', '', 'NONE', 'FALSE'),
(10, 'physicaldeliveryofficename', 'Office', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'dropdown', 'BIG OFFICE,small office,beans,meanz,heinz', '', 'NONE', 'FALSE'),
(11, 'streetaddress', 'Address', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'textbox', 'rows="5" cols="50"', 'Your Postal Address', 'NONE', 'FALSE'),
(12, 'mail', 'Email Address', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'FALSE'),
(13, 'extensionattribute1', 'Has Blackberry', 999, 'TRUE', 'TRUE', 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'checkbox', '', '', 'NONE', 'TRUE'),
(14, 'extensionattribute2', 'Sex', 999, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'radio', 'Male,Female,Yes Please tee hee', '', 'NONE', 'TRUE'),
(15, 'extensionattribute3', 'Home Email', 999, 'TRUE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', 'Your home email address', 'validate-email', 'TRUE'),
(16, 'extensionattribute4', 'Employee number', 1, 'TRUE', 'TRUE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', 'Your Employee number (can be found in SAP, if you can find anything in SAP, good luck!)', 'validate-digits', 'TRUE'),
(17, 'extensionattribute5', 'Something Custom', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'TRUE'),
(18, 'extensionattribute6', 'Something Custom', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'TRUE'),
(19, 'extensionattribute7', 'Something Custom', 999, 'FALSE', 'FALSE', 'TRUE', 'FALSE', 'FALSE', 'FALSE', 'text', '', '', 'NONE', 'TRUE');
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `example` varchar(100) NOT NULL,
  `validation` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;


INSERT INTO `config` (`id`, `type`, `name`, `value`, `example`, `validation`) VALUES
(1, 'ldap', 'account_suffix', '@james-lloyd.com', '@mydomain.local', ''),
(2, 'ldap', 'base_dn', 'DC=james-lloyd,DC=com', 'DC=mydomain,DC=local', ''),
(3, 'ldap', 'domain_controllers', '192.168.101.1', 'dc01.mydomain.local,dc02.mydomain.local', ''),
(4, 'ldap', 'ad_username', 'Administrator', 'administrator', ''),
(5, 'ldap', 'ad_password', 'password', 'your password', ''),
(6, 'ldap', 'real_primarygroup', 'true', 'true', ''),
(7, 'ldap', 'use_ssl', 'FALSE', 'false', ''),
(8, 'ldap', 'recursive_groups', 'true', 'true', ''),
(9, 'selfservice', 'minpwlength', '5', '5 (minimum password length)', 'validate-digits'),
(10, 'selfservice', 'minquestionslength', '10', '10 minimum number of characters in user questions', 'validate-digits'),
(11, 'selfservice', 'minanswerlength', '3', '3 minimum number of characters in answer', 'validate-digits'),
(12, 'selfservice', 'noquestionstoask', '3', '3 Number of questions you have to answer to reset password', 'validate-digits'),
(13, 'selfservice', 'encryptionkey', 'cd2aee218c6e678f5ca4bfca8b064710', 'some random garbage to encrypt the user questions', ''),
(14, 'phpadadmin', 'admingroup', 'Domain Admins', 'Domain Admins ( the name of the group that has access to these page NULL for only you)', ''),
(15, 'phpadadmin', 'forcehttps', 'false', 'true (Force connections over https)', ''),
(16, 'ldap', 'exchangeinstalled', 'FALSE', 'TRUE (have you run the exchange schema update?, this will allow use of custom user attributes)', '');
CREATE TABLE IF NOT EXISTS `errors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(90) NOT NULL,
  `text` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;


INSERT INTO `errors` (`id`, `title`, `text`) VALUES
(2, 'Seamless Authtentication Error', 'phpADadmin cannot determine you username.<br>Have you turned <b>on</b> integrated authentication and turned <b>off</b> anonymous access within IIS manager?');



CREATE TABLE IF NOT EXISTS `formtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
INSERT INTO `formtype` (`id`, `value`, `name`) VALUES
(1, 'text', 'Text'),
(2, 'textbox', 'Text Box'),
(3, 'radio', 'Radio'),
(4, 'checkbox', 'Check Box'),
(5, 'dropdown', 'Drop Down List');