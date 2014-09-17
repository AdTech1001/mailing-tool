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
	email varchar(255) COLLATE utf8_general_ci NOT NULL,
	phone varchar(255) COLLATE utf8_general_ci NOT NULL,
    address varchar(255) COLLATE utf8_general_ci NOT NULL,
    city  varchar(255) COLLATE utf8_general_ci NOT NULL,
	profileid int(11) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,
	superuser tinyint(4) DEFAULT '0' NOT NULL,
	userlanguage int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



LOCK TABLES feusers WRITE;
INSERT INTO feusers VALUES (1,0,NOW(),NOW(),0,0,0,'denkfabrik','$2a$10$3d34c49b983bab20eeba8uqotZMs4qmE74REKms2xR8vL0d1/M7k.','','','schreiber@denkfabrik-group.com','','','',1,1,1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;


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
(45, NOW(), 1, 9, 'delete');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;


LOCK TABLES resources WRITE;
INSERT INTO resources (uid, crdate, title) VALUES
(1, NOW(),'resources'),
(2, NOW(),'profiles'),
(3, NOW(),'usergroups'),
(4, NOW(),'feusers'),
(5, NOW(),'languages'),
(6, NOW(),'permissions'),
(7, NOW(),'campaigns'),
(8, NOW(),'mailobjects'),
(9, NOW(),'templateobjects');
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


DROP TABLE IF EXISTS campaigns;
CREATE TABLE campaigns (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,	
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
	templateuid int(11) DEFAULT '0' NOT NULL,	
	contenttype int(11) DEFAULT '0' NOT NULL,	
	sourcecode mediumtext,
	contentposition int(11) DEFAULT '0' NOT NULL,	
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



DROP TABLE IF EXISTS sendoutobject;
CREATE TABLE sendoutobject (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	campaignuid tinyint(4) DEFAULT '0' NOT NULL,
	mailobjectuid tinyint(4) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY campaignuid (campaignuid),
	KEY mailobjectuid (mailobjectuid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;





DROP TABLE IF EXISTS automationobject;
CREATE TABLE automationobject (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	campaignid int(11) DEFAULT '0' NOT NULL,	
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	automationgraphstring varchar(255) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;