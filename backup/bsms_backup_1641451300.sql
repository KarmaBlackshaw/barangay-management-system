# ABMS : MySQL database backup
#
# Generated: Thursday 6. January 2022
# Hostname: localhost
# Database: bsms
# --------------------------------------------------------


#
# Delete any existing table `tbl_support`
#

DROP TABLE IF EXISTS `tbl_support`;


#
# Table structure of table `tbl_support`
#



CREATE TABLE `tbl_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




#
# Delete any existing table `tbl_users`
#

DROP TABLE IF EXISTS `tbl_users`;


#
# Table structure of table `tbl_users`
#



CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `avatar` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_users VALUES("11","admin","d033e22ae348aeb5660fc2140aec35850c4da997","administrator","02012022040352anniemaybarreraID.jpg","2021-05-02 14:33:03");
INSERT INTO tbl_users VALUES("12","paulo","3352537346b8952df5cd1af145e0bc194c654b68","staff","02012022033117FB_IMG_16410174636644719.jpg","2022-01-01 14:31:17");
INSERT INTO tbl_users VALUES("13","jeremy","ee68891a4be740d745aa4edd6c1c3121abbf4ab4","staff","02012022033149FB_IMG_16410173556326371.jpg","2022-01-01 14:31:49");



#
# Delete any existing table `tblblotter`
#

DROP TABLE IF EXISTS `tblblotter`;


#
# Table structure of table `tblblotter`
#



CREATE TABLE `tblblotter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complainant` varchar(100) DEFAULT NULL,
  `respondent` varchar(100) DEFAULT NULL,
  `victim` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `details` varchar(10000) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

INSERT INTO tblblotter VALUES("10","Joe Rizal","Nora Selos","Joe Rizal","Amicable","Pob 1 Catbalogan, Samar","2020-11-02","00:30:00"," Sustento sa Anaak ","Scheduled");
INSERT INTO tblblotter VALUES("19","Girl Topak","Boy Topak","Girl Topak","Incident","Manila","2021-01-13","11:11:00","Mga Topakin na Pamilya","Active");
INSERT INTO tblblotter VALUES("26","baliw","luka","marites","Amicable","Looc","2021-04-30","13:09:00","Donec sollicitudin molestie malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.","Settled");



#
# Delete any existing table `tblbrgy_info`
#

DROP TABLE IF EXISTS `tblbrgy_info`;


#
# Table structure of table `tblbrgy_info`
#



CREATE TABLE `tblbrgy_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `text` text,
  `image` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblbrgy_info VALUES("1","LEYTE","BURAUEN","Buri","0919-1234569","  To uplift the quality of life of the populace through sustainable economic, social, infrastructure, institutional and environmental development.","02012022032735burauenlogo.jpg","02012022032735th.jfif","02012022032735burilogo.png");



#
# Delete any existing table `tblchairmanship`
#

DROP TABLE IF EXISTS `tblchairmanship`;


#
# Table structure of table `tblchairmanship`
#



CREATE TABLE `tblchairmanship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblchairmanship VALUES("2","Presiding Officer");
INSERT INTO tblchairmanship VALUES("3","Committee on Appropriation");
INSERT INTO tblchairmanship VALUES("4","Committee on Peace & Order");
INSERT INTO tblchairmanship VALUES("5","Committee on Health");
INSERT INTO tblchairmanship VALUES("6","Committee on Education");
INSERT INTO tblchairmanship VALUES("7","Committee on Rules");
INSERT INTO tblchairmanship VALUES("8","Committee on Infra");
INSERT INTO tblchairmanship VALUES("9","Committee on Solid Waste");
INSERT INTO tblchairmanship VALUES("10","Committee on Sports");
INSERT INTO tblchairmanship VALUES("11","No Chairmanship");



#
# Delete any existing table `tblofficials`
#

DROP TABLE IF EXISTS `tblofficials`;


#
# Table structure of table `tblofficials`
#



CREATE TABLE `tblofficials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `chairmanship` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblofficials VALUES("1","Gaudencio G. Berida","2","4","2021-04-29","2021-05-01","Active");
INSERT INTO tblofficials VALUES("4","RENATO R. ALMO","3","7","2021-04-03","2021-04-24","Active");
INSERT INTO tblofficials VALUES("5","Alberto C. Almo","4","8","2021-04-03","2022-03-24","Active");
INSERT INTO tblofficials VALUES("6","ALLAN T. ANTONIO","5","9","2021-10-13","2022-10-26","Active");
INSERT INTO tblofficials VALUES("7","merlo t. quiton","6","10","2020-05-21","2021-04-03","Active");
INSERT INTO tblofficials VALUES("8","relando s. tungasm","7","11","2020-03-17","2021-04-03","Active");
INSERT INTO tblofficials VALUES("9","Bienvinido P. BUHALOG","8","12","2020-04-22","2021-04-03","Active");
INSERT INTO tblofficials VALUES("10","NELSON Q. ELOGORICO","9","13","2020-06-18","2021-04-03","Active");
INSERT INTO tblofficials VALUES("11","DIONESIS C. ECHON","10","14","2020-07-08","2021-04-03","Active");
INSERT INTO tblofficials VALUES("12","ALMA CANDELA","11","15","2020-07-08","2021-04-03","Active");
INSERT INTO tblofficials VALUES("13","ROWENA P. RELLAMA","11","16","2020-10-07","2021-04-03","Active");



#
# Delete any existing table `tblpayments`
#

DROP TABLE IF EXISTS `tblpayments`;


#
# Table structure of table `tblpayments`
#



CREATE TABLE `tblpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `details` varchar(100) DEFAULT NULL,
  `amounts` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblpayments VALUES("5","Business Permit Payment","7000.00","2021-05-19","admin"," Atrium Salon & Studio");
INSERT INTO tblpayments VALUES("6","Certificate of Indigency Payment","3500.00","2021-05-19","admin"," Ronil Gonzales Cajan");
INSERT INTO tblpayments VALUES("7","Barangay Clearance Payment","2500.00","2021-05-19","admin"," Ronil Poe Cajan");
INSERT INTO tblpayments VALUES("8","Business Permit Payment","3500.00","2021-05-18","admin"," Atrium Salon & Studio");
INSERT INTO tblpayments VALUES("9","Business Permit Payment","7000.00","2021-05-18","admin"," Atrium Salon & Studio");
INSERT INTO tblpayments VALUES("10","Business Permit Payment","7500.00","2021-05-18","admin"," Atrium Salon & Studio");
INSERT INTO tblpayments VALUES("11","Certificate of Indigency Payment","55.00","2022-01-02","jeremy"," Annie May Calupas Barrera");
INSERT INTO tblpayments VALUES("12","Business Permit Payment","66.00","2022-01-02","admin"," Atrium Salon & Studio");
INSERT INTO tblpayments VALUES("13","Barangay Clearance Payment","50.00","2022-01-06","admin"," Annie May Calupas Barrera");
INSERT INTO tblpayments VALUES("14","Certificate of Indigency Payment","50.00","2022-01-06","admin"," JEREMY ECHON OLA");



#
# Delete any existing table `tblpermit`
#

DROP TABLE IF EXISTS `tblpermit`;


#
# Table structure of table `tblpermit`
#



CREATE TABLE `tblpermit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `owner1` varchar(200) DEFAULT NULL,
  `owner2` varchar(80) DEFAULT NULL,
  `nature` varchar(220) DEFAULT NULL,
  `applied` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblpermit VALUES("4","SH Food Group 1","SH Food Group 1","SH Food Group 2","SH Food Group 1","2021-04-30");
INSERT INTO tblpermit VALUES("5","Atrium Salon & Studio","SH Food Group 213","","Atrium Salon & Studio","2021-04-30");



#
# Delete any existing table `tblposition`
#

DROP TABLE IF EXISTS `tblposition`;


#
# Table structure of table `tblposition`
#



CREATE TABLE `tblposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblposition VALUES("4","Captain","1");
INSERT INTO tblposition VALUES("7","Councilor 1","2");
INSERT INTO tblposition VALUES("8","Councilor 2","3");
INSERT INTO tblposition VALUES("9","Councilor 3","4");
INSERT INTO tblposition VALUES("10","Councilor 4","5");
INSERT INTO tblposition VALUES("11","Councilor 5","6");
INSERT INTO tblposition VALUES("12","Councilor 6","7");
INSERT INTO tblposition VALUES("13","Councilor 7","8");
INSERT INTO tblposition VALUES("14","SK Chairman","9");
INSERT INTO tblposition VALUES("15","Secretary","10");
INSERT INTO tblposition VALUES("16","Treasurer","11");



#
# Delete any existing table `tblprecinct`
#

DROP TABLE IF EXISTS `tblprecinct`;


#
# Table structure of table `tblprecinct`
#



CREATE TABLE `tblprecinct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precinct` varchar(100) DEFAULT NULL,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblprecinct VALUES("1","(02) 526-7769","comelec");
INSERT INTO tblprecinct VALUES("2","02930944","4ps");



#
# Delete any existing table `tblpurok`
#

DROP TABLE IF EXISTS `tblpurok`;


#
# Table structure of table `tblpurok`
#



CREATE TABLE `tblpurok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblpurok VALUES("1","Purok 1","Tikang Kanda Babon ngadto liwat kanda Babon");
INSERT INTO tblpurok VALUES("2","Purok 2","Amon ngadto ira");
INSERT INTO tblpurok VALUES("3","Purok 3","afawewqeqweqweqw");
INSERT INTO tblpurok VALUES("4","Purok 4","dsfdsf");
INSERT INTO tblpurok VALUES("5","Purok 5","rewrew");
INSERT INTO tblpurok VALUES("6","Purok 6","rewrewr");
INSERT INTO tblpurok VALUES("7","Purok 7","rew");



#
# Delete any existing table `tblresident`
#

DROP TABLE IF EXISTS `tblresident`;


#
# Table structure of table `tblresident`
#



CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `national_id` varchar(100) DEFAULT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `picture` text CHARACTER SET utf8mb4,
  `firstname` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `alias` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `birthplace` varchar(80) CHARACTER SET utf8mb4 DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civilstatus` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `purok` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `voterstatus` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `identified_as` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4,
  `resident_type` int(11) DEFAULT '1',
  `remarks` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

INSERT INTO tblresident VALUES("169","2018-24738","Filipino","02012022031808FB_IMG_16410173556326371.jpg","JEREMY","ECHON","OLA","MY","Brgy. Buri Burauen Leyte","1998-06-30","23","Single","Male","Purok 2","Yes","Positive","09102037489","jeremyechon@gmail.com","Student","Barangay Buri Burauen Leyte","1","no remarks");
INSERT INTO tblresident VALUES("174","2018-34555","Filipino","02012022032131FB_IMG_16410174636644719.jpg","Jhon Paulo","Mahilog","Tismo","pau pau","Dist. 8 Burauen","2022-01-01","26","Single","Male","Purok 8","Yes","Positive","349358957","cajanr02@gmail.com","Student","San Diego Burauen Leyte","1","no remarks");
INSERT INTO tblresident VALUES("180","1212321321","Filipino","02012022030838anniemaybarreraID.jpg","Annie May","Calupas","Barrera","maytion","Brgy. Limburan Burauen Leyte","1999-10-22","22","Single","Female","Purok 6","Yes","Positive","19512659595","anniemaybarrera@gmail.com","Student","Barangay Tabang LaPaz Leyte","1","No remarks");

