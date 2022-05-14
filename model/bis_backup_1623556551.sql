# ABMS : MySQL database backup
#
# Generated: Sunday 13. June 2021
# Hostname: localhost
# Database: bis
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
  `message` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;




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
  `avatar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_users VALUES("10","staff","6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611","staff","03052021043218icon.png","2021-05-03 10:32:18");
INSERT INTO tbl_users VALUES("11","admin","d033e22ae348aeb5660fc2140aec35850c4da997","administrator","09052021074950person.png","2021-05-03 10:33:03");



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
INSERT INTO tblblotter VALUES("16","Tiboy Tibo","Maria Advitos","Tiboy","Incident","Brgy1","2020-11-06","23:35:00","  Di alam ano pinag awayan  ","Scheduled");
INSERT INTO tblblotter VALUES("19","Girl Topak","Boy Topak","Girl Topak","Incident","Manila","2021-01-13","11:11:00","Mga Topakin na Pamilya","Settled");
INSERT INTO tblblotter VALUES("20","Kayzel","Mario","Kayzel","Incident","Quezon City","2021-01-07","00:12:00","Iwan Ko","Settled");
INSERT INTO tblblotter VALUES("22","Juan dela Cruz","Peter","Juan","Amicable","Manila","2021-01-01","22:16:00","   ayaw magbayad ng utang.. hehhheee   ","Active");
INSERT INTO tblblotter VALUES("26","Ron","Cajan","ROn Cajan","Amicable","Looc","2021-04-30","13:09:00","Donec sollicitudin molestie malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.","Settled");



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
  `text` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblbrgy_info VALUES("1","Mis Occ6","Plaridel","Proper","0919-1234567","Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Sed porttitor lectus nibh. Curabitur aliquet quam id dui posuere blandit.","09052021075440182970012_615550183178722_2776607156578360582_n.jpg","03052021033434brgy-logo.png","0905202107542630042021035316lgu-logo.png");



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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblofficials VALUES("1","Juan Dela Cruz","2","4","2021-04-29","2021-05-01","Active");
INSERT INTO tblofficials VALUES("4","Juan Dela Cruz","3","7","2021-04-03","2021-04-24","Active");
INSERT INTO tblofficials VALUES("5","Juan Dela Cruz","4","8","2021-04-03","2021-04-03","Active");
INSERT INTO tblofficials VALUES("6","Juan Dela Cruz","5","9","2021-04-03","2021-04-03","Active");
INSERT INTO tblofficials VALUES("7","Juan Dela Cruz","6","10","2021-04-03","2021-04-03","Active");
INSERT INTO tblofficials VALUES("8","Juan Dela Cruz","7","11","2021-04-03","2021-04-03","Active");
INSERT INTO tblofficials VALUES("9","Juan Dela Cruz","8","12","2021-04-03","2021-04-03","Active");
INSERT INTO tblofficials VALUES("10","Juan Dela Cruz","9","13","2021-04-03","2021-04-03","Active");
INSERT INTO tblofficials VALUES("11","JOSEPH P. PARDOS	","10","14","2021-04-03","2021-04-03","Active");
INSERT INTO tblofficials VALUES("12","Juan Dela Cruz","11","15","2021-04-03","2021-04-03","Active");
INSERT INTO tblofficials VALUES("13","Juan Dela Cruz","11","16","2021-04-03","2021-04-03","Active");



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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblpayments VALUES("5","Business Permit Payment","7000.00","2021-05-19","admin"," Atrium Salon & Studio");
INSERT INTO tblpayments VALUES("6","Certificate of Indigency Payment","3500.00","2021-05-19","admin"," Ronil Gonzales Cajan");
INSERT INTO tblpayments VALUES("7","Barangay Clearance Payment","2500.00","2021-05-19","admin"," Ronil Poe Cajan");
INSERT INTO tblpayments VALUES("8","Business Permit Payment","3500.00","2021-05-18","admin"," Atrium Salon & Studio");
INSERT INTO tblpayments VALUES("9","Business Permit Payment","7000.00","2021-05-18","admin"," Atrium Salon & Studio");
INSERT INTO tblpayments VALUES("10","Business Permit Payment","7500.00","2021-05-18","admin"," Atrium Salon & Studio");
INSERT INTO tblpayments VALUES("11","Barangay Clearance Payment","7000.00","2021-06-13","admin"," Ronil 213213 Cajan");
INSERT INTO tblpayments VALUES("12","Certificate of Indigency Payment","7500.00","2021-06-13","admin"," Ronil Gonzales Cajan");
INSERT INTO tblpayments VALUES("13","Business Permit Payment","2500.00","2021-06-13","admin"," Atrium Salon & Studio");



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
  `details` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




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
  `details` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblpurok VALUES("1","Purok 1","Tikang Kanda Babon ngadto liwat kanda Babon");
INSERT INTO tblpurok VALUES("2","Purok 2","Amon ngadto ira");
INSERT INTO tblpurok VALUES("3","Purok 3","afawewqeqweqweqw");
INSERT INTO tblpurok VALUES("4","Purok 4","dsfdsf");
INSERT INTO tblpurok VALUES("5","Purok 5","rewrew");
INSERT INTO tblpurok VALUES("6","Purok 6","rewrewr");
INSERT INTO tblpurok VALUES("7","Purok 7","rew");
INSERT INTO tblpurok VALUES("8","Purok 7","rew");



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
  `picture` text CHARACTER SET utf8mb4 DEFAULT NULL,
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
  `address` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `resident_type` int(11) DEFAULT 1,
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

INSERT INTO tblresident VALUES("171","321321321","Filipino","18052021113447Screenshot2021-05-06183815.png","Ronil","Poe","Cajan","FPJ","Metro  Manila","2021-04-05","1","Single","Male","Purok 2","Yes","Unidentified","19512659595","cajanr02rtrt22@gmail.com","IT","310 W Las Colinas Blvd","1","dasds");
INSERT INTO tblresident VALUES("169","","Filipino","data:image/jpeg;base64,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","Ronil","Gonzales","Cajan","Royal Blood","aklan","1980-12-23","40","Single","Male","Purok 1","No","","19512659595","cajanr02rtrt22@gmail.com","","310 W Las Colinas Blvd","0","");
INSERT INTO tblresident VALUES("180","1212321321","American","18052021113745sl9JaS.jpg","Ronil","213213","Cajan","","321321","2021-04-28","33","Widow","Male","Purok 3","No","","19512659595","cajanr0222@gmail.com","IT","310 W Las Colinas Blvd","1","re");

