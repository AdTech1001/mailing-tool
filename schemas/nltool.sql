--
-- Host: 127.0.0.1    Database: baywa-nltool
-- ------------------------------------------------------
-- Server version	5.1.50

DROP TABLE IF EXISTS feusers;
CREATE TABLE feusers (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	username varchar(255) COLLATE utf8_general_ci NOT NULL,
	password varchar(255) COLLATE utf8_general_ci NOT NULL,
	first_name varchar(255) COLLATE utf8_general_ci NOT NULL,
	last_name varchar(255) COLLATE utf8_general_ci NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,
	email varchar(255) COLLATE utf8_general_ci NOT NULL,
	phone varchar(255) COLLATE utf8_general_ci NOT NULL,
    address varchar(255) COLLATE utf8_general_ci NOT NULL,
    city  varchar(255) COLLATE utf8_general_ci NOT NULL,
	zip int(11) DEFAULT '0' NOT NULL,
	company  varchar(255) COLLATE utf8_general_ci NOT NULL,
	profileid int(11) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,
	superuser tinyint(4) DEFAULT '0' NOT NULL,
	userlanguage int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



LOCK TABLES feusers WRITE;
INSERT INTO feusers VALUES (1,0,NOW(),NOW(),0,0,0,'denkfabrik','$2a$10$3d34c49b983bab20eeba8uqotZMs4qmE74REKms2xR8vL0d1/M7k.','','','','schreiber@denkfabrik-group.com','','','',0,'',1,1,1,0);
UNLOCK TABLES;


--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS permissions;
CREATE TABLE IF NOT EXISTS permissions (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	profileid int(10) unsigned NOT NULL,
	resourceid int(10) unsigned NOT NULL,
	resourceaction varchar(55) NOT NULL,
  PRIMARY KEY (uid),
  KEY profilesid (profileid)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;


LOCK TABLES permissions WRITE;
INSERT INTO permissions (uid, crdate, profileid, resourceid, resourceaction) VALUES
(1, NOW(), 1, 1, 'index'),
(2, NOW(), 1, 1, 'create'),
(3, NOW(), 1, 1, 'retrieve'),
(4, NOW(), 1, 1, 'update'),
(5, NOW(), 1, 1, 'delete'),
(6, NOW(), 1, 2, 'index'),
(7, NOW(), 1, 2, 'create'),
(8, NOW(), 1, 2, 'retrieve'),
(9, NOW(), 1, 2, 'update'),
(10, NOW(), 1, 2, 'delete'),
(11, NOW(), 1, 3, 'index'),
(12, NOW(), 1, 3, 'create'),
(13, NOW(), 1, 3, 'retrieve'),
(14, NOW(), 1, 3, 'update'),
(15, NOW(), 1, 3, 'delete'),
(16, NOW(), 1, 4, 'index'),
(17, NOW(), 1, 4, 'create'),
(18, NOW(), 1, 4, 'retrieve'),
(19, NOW(), 1, 4, 'update'),
(20, NOW(), 1, 4, 'delete'),
(21, NOW(), 1, 5, 'index'),
(22, NOW(), 1, 5, 'create'),
(23, NOW(), 1, 5, 'retrieve'),
(24, NOW(), 1, 5, 'update'),
(25, NOW(), 1, 5, 'delete'),
(26, NOW(), 1, 6, 'index'),
(27, NOW(), 1, 6, 'create'),
(28, NOW(), 1, 6, 'retrieve'),
(29, NOW(), 1, 6, 'update'),
(30, NOW(), 1, 6, 'delete'),
(31, NOW(), 1, 7, 'index'),
(32, NOW(), 1, 7, 'create'),
(33, NOW(), 1, 7, 'retrieve'),
(34, NOW(), 1, 7, 'update'),
(35, NOW(), 1, 7, 'delete'),
(36, NOW(), 1, 8, 'index'),
(37, NOW(), 1, 8, 'create'),
(38, NOW(), 1, 8, 'retrieve'),
(39, NOW(), 1, 8, 'update'),
(40, NOW(), 1, 8, 'delete'),
(41, NOW(), 1, 9, 'index'),
(42, NOW(), 1, 9, 'create'),
(43, NOW(), 1, 9, 'retrieve'),
(44, NOW(), 1, 9, 'update'),
(45, NOW(), 1, 9, 'delete'),
(46, NOW(), 1, 10, 'index'),
(47, NOW(), 1, 10, 'create'),
(48, NOW(), 1, 10, 'retrieve'),
(49, NOW(), 1, 10, 'update'),
(50, NOW(), 1, 10, 'delete'),
(51, NOW(), 1, 11, 'index'),
(52, NOW(), 1, 11, 'create'),
(53, NOW(), 1, 11, 'retrieve'),
(54, NOW(), 1, 11, 'update'),
(55, NOW(), 1, 11, 'delete'),
(56, NOW(), 1, 12, 'index'),
(57, NOW(), 1, 12, 'create'),
(58, NOW(), 1, 12, 'retrieve'),
(59, NOW(), 1, 12, 'update'),
(60, NOW(), 1, 12, 'delete'),
(61, NOW(), 1, 13, 'index'),
(62, NOW(), 1, 13, 'create'),
(63, NOW(), 1, 13, 'retrieve'),
(64, NOW(), 1, 13, 'update'),
(65, NOW(), 1, 14, 'delete'),
(66, NOW(), 1, 14, 'index'),
(67, NOW(), 1, 14, 'create'),
(68, NOW(), 1, 14, 'retrieve'),
(69, NOW(), 1, 14, 'update'),
(70, NOW(), 1, 14, 'delete'),
(71, NOW(), 1, 15, 'index'),
(72, NOW(), 1, 15, 'create'),
(73, NOW(), 1, 15, 'retrieve'),
(74, NOW(), 1, 15, 'update'),
(75, NOW(), 1, 15, 'delete'),
(76, NOW(), 1, 16, 'index'),
(77, NOW(), 1, 16, 'create'),
(78, NOW(), 1, 16, 'retrieve'),
(79, NOW(), 1, 16, 'update'),
(80, NOW(), 1, 16, 'delete'),
(81, NOW(), 1, 17, 'index'),
(82, NOW(), 1, 17, 'create'),
(83, NOW(), 1, 17, 'retrieve'),
(84, NOW(), 1, 17, 'update'),
(85, NOW(), 1, 17, 'delete');
UNLOCK TABLES;



--
-- Table structure for table `resources`
--
DROP TABLE IF EXISTS resources;
CREATE TABLE IF NOT EXISTS resources(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) NOT NULL,
	PRIMARY KEY (uid)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;


LOCK TABLES resources WRITE;
INSERT INTO resources (uid, crdate, title) VALUES
(1, NOW(),'resources'),
(2, NOW(),'profiles'),
(3, NOW(),'usergroups'),
(4, NOW(),'feusers'),
(5, NOW(),'languages'),
(6, NOW(),'permissions'),
(7, NOW(),'campaignobjects'),
(8, NOW(),'mailobjects'),
(9, NOW(),'templateobjects'),
(10, NOW(),'contentobjects'),
(11, NOW(),'configurationobjects'),
(12, NOW(),'sendoutobjects'),
(13, NOW(),'addresses'),
(14, NOW(),'addressfolders'),
(15, NOW(),'segmentobjects'),
(16, NOW(),'addressconditions'),
(17, NOW(),'review');
UNLOCK TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS profiles;
CREATE TABLE IF NOT EXISTS profiles (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) NOT NULL,	
  PRIMARY KEY (uid),
  KEY hidden (hidden)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

LOCK TABLES profiles WRITE;
INSERT INTO profiles (uid, crdate, title) VALUES
(1,NOW() ,'Superuser');
UNLOCK TABLES;
--
-- Table structure for table `usergroups`
--

DROP TABLE IF EXISTS usergroups;
CREATE TABLE IF NOT EXISTS usergroups (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) NOT NULL,	
	lang int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY hidden (hidden)
) ENGINE=InnoDB  AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


LOCK TABLES usergroups WRITE;
INSERT INTO usergroups (uid, crdate, title, lang) VALUES
(1,NOW(),'Global',2),
(2,NOW(),'Homebase',1);
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) NOT NULL,
	shorttitle varchar(4) NOT NULL,
  PRIMARY KEY (uid),
  KEY hidden (hidden)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

LOCK TABLES `languages` WRITE;
INSERT INTO `languages` (uid, crdate, title,shorttitle) VALUES
(1,NOW(),'Deutsch','de'),
(2,NOW(),'English','en');
UNLOCK TABLES;


--
-- Table structure for table `failed_logins`
--

DROP TABLE IF EXISTS `failed_logins`;
CREATE TABLE IF NOT EXISTS `failed_logins` (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	userid	 int(10) unsigned DEFAULT NULL,
	ipaddress char(15) NOT NULL,
	attempted int(10) unsigned DEFAULT NULL,
	useragent varchar(120) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


--
-- Table structure for table `success_logins`
--

DROP TABLE IF EXISTS `success_logins`;
CREATE TABLE IF NOT EXISTS `success_logins` (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	endsession int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	userid	 int(10) unsigned DEFAULT NULL,
	ipaddress char(15) NOT NULL,
	attempted int(10) unsigned DEFAULT NULL,
	useragent varchar(120) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS campaignobjects;
CREATE TABLE campaignobjects (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,	
	automationgraphstring mediumtext,
	connections mediumtext,
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS mailobjects;
CREATE TABLE mailobjects (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	campaign int(11) DEFAULT '0' NOT NULL,	
	origuid int(11) DEFAULT '0' NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,	
	templateuid int(11) DEFAULT '0' NOT NULL,	
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS templateobjects;
CREATE TABLE templateobjects (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,			
	usergroup int(11) DEFAULT '0' NOT NULL,	
	sourcecode mediumtext,
	templatefilepath varchar(255) COLLATE utf8_general_ci NOT NULL,
	templatetype tinyint(4) DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS contentobjects;
CREATE TABLE contentobjects (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	campaign int(11) DEFAULT '0' NOT NULL,	
	origuid int(11) DEFAULT '0' NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,	
	mailobjectuid int(11) DEFAULT '0' NOT NULL,	
	templateuid int(11) DEFAULT '0' NOT NULL,	
	contenttype int(11) DEFAULT '0' NOT NULL,	
	sourcecode mediumtext,
	templateposition int(11) DEFAULT '0' NOT NULL,	
	positionsorting int(11) DEFAULT '0' NOT NULL,	
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



DROP TABLE IF EXISTS sendoutobjects;
CREATE TABLE sendoutobjects (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	reviewed tinyint(4) DEFAULT '0' NOT NULL,
	cleared tinyint(4) DEFAULT '0' NOT NULL,
	inprogress tinyint(4) DEFAULT '0' NOT NULL,
	sent tinyint(4) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,
	campaignuid int(11) DEFAULT '0' NOT NULL,
	mailobjectuid int(11) DEFAULT '0' NOT NULL,
	configurationuid int(11) DEFAULT '0' NOT NULL,
	subject varchar(255) COLLATE utf8_general_ci NOT NULL,	
	abtest tinyint(4) DEFAULT '0' NOT NULL,
	segmentobjectuid int(11) DEFAULT '0' NOT NULL,
	domid varchar(255) COLLATE utf8_general_ci NOT NULL,	
	PRIMARY KEY (uid),
	KEY campaignuid (campaignuid),
	KEY mailobjectuid (mailobjectuid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS configurationobjects;
CREATE TABLE configurationobjects (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	sendermail varchar(255) COLLATE utf8_general_ci NOT NULL,	
	sendername varchar(255) COLLATE utf8_general_ci NOT NULL,	
	answermail varchar(255) COLLATE utf8_general_ci NOT NULL,	
	answername varchar(255) COLLATE utf8_general_ci NOT NULL,	
	returnpath varchar(255) COLLATE utf8_general_ci NOT NULL,	
	organisation varchar(255) COLLATE utf8_general_ci NOT NULL,	
	htmlplain tinyint(4) DEFAULT '0' NOT NULL,
	clicktracking tinyint(4) DEFAULT '1' NOT NULL,
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS automationobjects;
CREATE TABLE automationobjects (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,
	campaignid int(11) DEFAULT '0' NOT NULL,	
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	automationgraphstring varchar(255) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS segmentobjects;
CREATE TABLE segmentobjects (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,
	campaignid int(11) DEFAULT '0' NOT NULL,	
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	hashtags varchar(255) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS addressfolders;
CREATE TABLE addressfolders (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,	
	title varchar(255) COLLATE utf8_general_ci NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS addresses_segmentobjects_lookup;
CREATE TABLE addresses_segmentobjects_lookup (
	uid int(11) NOT NULL auto_increment,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,	
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS addresses;
CREATE TABLE addresses (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,	
	first_name varchar(255) COLLATE utf8_general_ci NOT NULL,
	last_name varchar(255) COLLATE utf8_general_ci NOT NULL,
	salutation varchar(255) COLLATE utf8_general_ci NOT NULL,
	email varchar(255) COLLATE utf8_general_ci NOT NULL,
	phone varchar(255) COLLATE utf8_general_ci NOT NULL,
    address varchar(255) COLLATE utf8_general_ci NOT NULL,
    city  varchar(255) COLLATE utf8_general_ci NOT NULL,	
	segmentobjects int(11) DEFAULT '0' NOT NULL,		
	userlanguage int(11) DEFAULT '0' NOT NULL,
	gender tinyint(4) DEFAULT '0' NOT NULL,
	formal tinyint(4) DEFAULT '1' NOT NULL,
	hashtags varchar(255) COLLATE utf8_general_ci NOT NULL,
	itemsource  varchar(255) COLLATE utf8_general_ci NOT NULL,	
	hasprofile tinyint(4) DEFAULT '1' NOT NULL,
  PRIMARY KEY (uid),
	KEY segmentobjects (segmentobjects)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS addressconditions;
CREATE TABLE addressconditions(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,	
	junctor int(11) DEFAULT '0' NOT NULL,	
	conditionaloperator int(11) DEFAULT '0' NOT NULL,	
	argument int(11) DEFAULT '0' NOT NULL,		
	operator int(11) DEFAULT '0' NOT NULL,	
	argumentcondition varchar(255) COLLATE utf8_general_ci NOT NULL,	
	PRIMARY KEY (uid)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS mailqueue;
CREATE TABLE mailqueue (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	sent tinyint(4) DEFAULT '0' NOT NULL,	
	addressuid int(11) DEFAULT '0' NOT NULL,
	campaignuid int(11) DEFAULT '0' NOT NULL,
	sendoutobjectuid int(11) DEFAULT '0' NOT NULL,
	mailobjectuid int(11) DEFAULT '0' NOT NULL,
	configurationuid int(11) DEFAULT '0' NOT NULL,
	email varchar(255) COLLATE utf8_general_ci NOT NULL,		
	subject varchar(255) COLLATE utf8_general_ci NOT NULL,
	sendermail varchar(255) COLLATE utf8_general_ci NOT NULL,	
	sendername varchar(255) COLLATE utf8_general_ci NOT NULL,	
	answermail varchar(255) COLLATE utf8_general_ci NOT NULL,	
	answername varchar(255) COLLATE utf8_general_ci NOT NULL,	
	returnpath varchar(255) COLLATE utf8_general_ci NOT NULL,	
	organisation varchar(255) COLLATE utf8_general_ci NOT NULL,	
	mailbody mediumtext,
	PRIMARY KEY (uid)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS linklookup;
CREATE TABLE linklookup(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	campaignuid int(11) DEFAULT '0' NOT NULL,
	mailobjectuid int(11) DEFAULT '0' NOT NULL,
	sendoutobjectuid int(11) DEFAULT '0' NOT NULL,
	url text,
	addressuid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS linkclicks;
CREATE TABLE linkclicks(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	linkuid int(11) DEFAULT '0' NOT NULL,
	addressuid int(11) DEFAULT '0' NOT NULL,	
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS openclicks;
CREATE TABLE openclicks(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	sendoutobjectuid int(11) DEFAULT '0' NOT NULL,
	addressuid int(11) DEFAULT '0' NOT NULL,	
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;