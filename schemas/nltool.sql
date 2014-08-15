--
-- Host: 127.0.0.1    Database: baywa-nltool
-- ------------------------------------------------------
-- Server version	5.1.50

DROP TABLE IF EXISTS fe_users;
CREATE TABLE fe_users (
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
	userrole int(11) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,
	superuser tinyint(4) DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



LOCK TABLES fe_users WRITE;
INSERT INTO fe_users VALUES (1,0,NOW(),NOW(),0,0,0,'denkfabrik','$2y$12$8erToAD9.k14WZfBUYQrxu1rEu0cTRWZ6uQZpQf2XcZktTtZdhlH.','','','schreiber@denkfabrik-group.com','','','',0,0,1);
UNLOCK TABLES;


