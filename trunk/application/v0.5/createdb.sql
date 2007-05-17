
-- --------------------------------------------------------

-- 
-- Table structure for table `config`
-- 

CREATE TABLE `config` (
  `index` int(99) NOT NULL auto_increment,
  `name` varchar(99) NOT NULL,
  `value` varchar(99) NOT NULL,
  PRIMARY KEY  (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `domainconfig`
-- 

CREATE TABLE `domainconfig` (
  `index` int(99) NOT NULL auto_increment,
  `netbiosname` varchar(99) NOT NULL,
  `name` varchar(99) NOT NULL,
  `value` varchar(99) NOT NULL,
  PRIMARY KEY  (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `fields`
-- 

CREATE TABLE `fields` (
  `index` int(11) NOT NULL auto_increment,
  `freindlyname` varchar(99) NOT NULL,
  `id` varchar(99) NOT NULL,
  `editable` binary(1) NOT NULL,
  `enabled` binary(1) NOT NULL,
  `adatribute` varchar(99) NOT NULL,
  `formtype` set('text','dropdown') NOT NULL,
  PRIMARY KEY  (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `functions`
-- 

CREATE TABLE `functions` (
  `index` int(99) NOT NULL auto_increment,
  `freindlyname` varchar(99) NOT NULL,
  `id` varchar(99) NOT NULL,
  `enable` binary(1) NOT NULL,
  `icon` varchar(99) NOT NULL,
  PRIMARY KEY  (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `questions`
-- 

CREATE TABLE `questions` (
  `index` int(11) NOT NULL auto_increment,
  `uid` mediumint(99) NOT NULL,
  `question` longtext NOT NULL,
  `answer` longtext NOT NULL,
  PRIMARY KEY  (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `rag`
-- 

CREATE TABLE `rag` (
  `index` int(99) NOT NULL auto_increment,
  `Heading` varchar(99) NOT NULL,
  `name` varchar(99) NOT NULL,
  `state` varchar(99) NOT NULL,
  `note` varchar(999) NOT NULL,
  `site` varchar(99) NOT NULL,
  PRIMARY KEY  (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `index` int(11) NOT NULL auto_increment,
  `samaccountname` varchar(100) NOT NULL,
  PRIMARY KEY  (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
 