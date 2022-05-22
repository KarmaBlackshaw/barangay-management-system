/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.29 : Database - bsms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bsms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `bsms`;

/*Table structure for table `announcements` */

DROP TABLE IF EXISTS `announcements`;

CREATE TABLE `announcements` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `announcements` */

insert  into `announcements`(`id`,`title`,`content`,`thumbnail`,`created_at`,`updated_at`,`deleted_at`) values 
(37,'test3','test3','20220518045130165284229062845f32acb2c.','2022-05-18 10:49:25','2022-05-18 10:51:30',NULL);

/*Table structure for table `certificate_requests` */

DROP TABLE IF EXISTS `certificate_requests`;

CREATE TABLE `certificate_requests` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `resident_id` int unsigned NOT NULL,
  `payment_id` int unsigned NOT NULL,
  `certificate_id` int unsigned NOT NULL,
  `status` enum('resolved','rejected','pending') NOT NULL DEFAULT 'pending',
  `memo` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resident_id` (`resident_id`),
  KEY `payment_id` (`payment_id`),
  KEY `certificate_id` (`certificate_id`),
  CONSTRAINT `certificate_requests_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`),
  CONSTRAINT `certificate_requests_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  CONSTRAINT `certificate_requests_ibfk_3` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `certificate_requests` */

/*Table structure for table `certificates` */

DROP TABLE IF EXISTS `certificates`;

CREATE TABLE `certificates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `certificates` */

insert  into `certificates`(`id`,`name`) values 
(1,'Barangay Certificate'),
(2,'Cutting Permit'),
(3,'4ps Certification'),
(4,'Certificate of Indigency');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `resident_id` int unsigned DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `mode` enum('online','cash') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `resident_id` (`resident_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `payments` */

insert  into `payments`(`id`,`user_id`,`resident_id`,`details`,`amount`,`mode`,`created_at`,`updated_at`,`deleted_at`) values 
(6,11,1,'Barangay Clearance Payment',200.00,'online','2022-05-22 17:35:30',NULL,NULL),
(7,11,1,'Certificate of Indigency Payment',200.00,'online','2022-05-22 17:52:50',NULL,NULL),
(8,11,1,'Certificate of Indigency Payment',2.00,'online','2022-05-22 17:53:39',NULL,NULL),
(9,11,6,'Business Permit Payment',2.00,'online','2022-05-22 18:23:47',NULL,NULL),
(10,11,2,'4PS Certification Payment',21.00,'online','2022-05-22 18:34:12',NULL,NULL);

/*Table structure for table `purok` */

DROP TABLE IF EXISTS `purok`;

CREATE TABLE `purok` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `purok` */

insert  into `purok`(`id`,`name`,`details`) values 
(1,'Purok 1','Tikang Kanda Babon ngadto liwat kanda Babon'),
(2,'Purok 2','Amon ngadto ira'),
(3,'Purok 3','afawewqeqweqweqw'),
(4,'Purok 4','dsfdsf'),
(5,'Purok 5','rewrew'),
(6,'Purok 6','rewrewr'),
(7,'Purok 7','rew'),
(8,'Purok 8','rew');

/*Table structure for table `residents` */

DROP TABLE IF EXISTS `residents`;

CREATE TABLE `residents` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `national_id` varchar(100) DEFAULT NULL,
  `account_id` int unsigned NOT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `picture` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alias` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `birthplace` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `civilstatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `purok_id` int unsigned NOT NULL,
  `voterstatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `identified_as` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `resident_type` int DEFAULT '1',
  `is_4ps` tinyint(1) DEFAULT '0',
  `is_pwd` tinyint(1) DEFAULT '0',
  `is_senior` tinyint(1) DEFAULT '0',
  `remarks` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `purok_id` (`purok_id`),
  CONSTRAINT `residents_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `users` (`id`),
  CONSTRAINT `residents_ibfk_2` FOREIGN KEY (`purok_id`) REFERENCES `purok` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `residents` */

insert  into `residents`(`id`,`national_id`,`account_id`,`citizenship`,`picture`,`firstname`,`middlename`,`lastname`,`alias`,`birthplace`,`birthdate`,`age`,`civilstatus`,`gender`,`purok_id`,`voterstatus`,`identified_as`,`phone`,`email`,`occupation`,`address`,`resident_type`,`is_4ps`,`is_pwd`,`is_senior`,`remarks`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Et lorem at officia ',91,'Fugiat porro similiq',NULL,'Alfonso Reilly','Cecilia Schultz','Brielle Goodman','Sapiente ut excepteu',NULL,NULL,13,'Married','Male',2,'No',NULL,'301','medoq@mailinator.com','Id ad architecto qui','Enim nostrum qui tot',1,0,0,0,NULL,'2022-05-18 16:36:50',NULL,NULL),
(2,'Et lorem at officia ',92,'Fugiat porro similiq',NULL,'Alfonso Reilly','Cecilia Schultz','Brielle Goodman','Sapiente ut excepteu',NULL,NULL,13,'Married','Male',2,'No',NULL,'301','medoq@mailinator.com','Id ad architecto qui','Enim nostrum qui tot',1,0,0,0,NULL,'2022-05-18 16:37:05',NULL,NULL),
(3,'Deleniti veritatis a',93,'Et voluptas et irure',NULL,'Kimberley Norman','Alan Diaz','Talon Day','Et quam cupidatat pa',NULL,NULL,70,'Single','Male',6,'Yes','Unidentified','92','nuva@mailinator.com','Debitis alias et inc','Aliquid irure iste d',1,0,0,0,NULL,'2022-05-18 16:37:37',NULL,NULL),
(4,'Deleniti veritatis a',94,'Et voluptas et irure',NULL,'Kimberley Norman','Alan Diaz','Talon Day','Et quam cupidatat pa','Possimus dicta dele','2019-04-04',70,'Single','Male',6,'Yes','Unidentified','92','nuva@mailinator.com','Debitis alias et inc','Aliquid irure iste d',1,0,0,0,NULL,'2022-05-18 16:37:56',NULL,NULL),
(5,'Veritatis anim lorem',95,'Sed aut ea aliquam a','2022051810380916528630896284b0715bc5c.jpg','Inez Cline','Lee Howell','Cameran Blankenship','Quia aliquip vitae i','Ullamco labore esse ','1994-07-06',80,'Single','Male',6,'No',NULL,'685','pujutiju@mailinator.com','Et in dolore vel ame','Nesciunt sint moles',1,0,0,0,NULL,'2022-05-18 16:38:09',NULL,NULL),
(6,'Veritatis anim lorem',96,'Sed aut ea aliquam a','2022051810384616528631266284b0965e413.jpg','Inez Cline','Lee Howell','Cameran Blankenship','Quia aliquip vitae i','Ullamco labore esse ','1994-07-06',80,'Single','Male',6,'No',NULL,'685','pujutiju@mailinator.com','Et in dolore vel ame','Nesciunt sint moles',1,0,0,0,NULL,'2022-05-18 16:38:46',NULL,NULL),
(7,'Veritatis anim lorem',97,'Sed aut ea aliquam a','2022051810384616528631266284b09690494.jpg','Inez Cline','Lee Howell','Cameran Blankenship','Quia aliquip vitae i','Ullamco labore esse ','1994-07-06',80,'Single','Male',6,'No',NULL,'685','pujutiju@mailinator.com','Et in dolore vel ame','Nesciunt sint moles',1,0,0,0,NULL,'2022-05-18 16:38:46',NULL,NULL),
(8,'Ex totam voluptatem ',98,'Ut reprehenderit of',NULL,'Ciara Santana','Wayne Stephens','Porter Rutledge','Dolores ipsum eiusm','Nesciunt et hic lab','2011-05-07',94,'Single','Female',3,'Yes','Negative','121','gojylul@mailinator.com','Velit ut suscipit q','Sed sit similique ac',1,0,0,0,NULL,'2022-05-18 16:39:16',NULL,NULL),
(9,'Nesciunt rem rerum ',99,'Ut eius voluptatem u',NULL,'Charissa Mcgee','Nelle Reeves','Teagan Stuart','Aliquam accusamus se','Minima ut necessitat','2020-07-15',43,'Widow','Male',3,'Yes','Unidentified','982','nonipylik@mailinator.com','Autem cupidatat in i','Qui optio deleniti ',1,0,0,0,NULL,'2022-05-21 20:34:54',NULL,NULL),
(10,'Minim dolores dolore',100,'Officia aute vero do',NULL,'Roary Shelton','Xyla Carroll','Mallory Hurst','Culpa at possimus e','Dignissimos ratione ','2017-04-18',1,'Widow','Female',6,'Yes','Unidentified','694','cyvibyv@mailinator.com','Aliquip voluptatem ','Dolorem do soluta co',1,0,0,0,NULL,'2022-05-22 18:58:57',NULL,NULL),
(11,'Suscipit quis fugiat',101,'Deserunt aliquip duc',NULL,'Germaine Newman','Nell Ramirez','Matthew Mcmillan','Perspiciatis deleni','Non reprehenderit m','1999-06-22',8,'Widow','Female',8,'Yes','Unidentified','471','pegefozuj@mailinator.com','Incididunt ex tempor','At hic magna nesciun',1,0,0,0,NULL,'2022-05-22 19:00:20',NULL,NULL),
(12,'Ullam ea quae qui co',102,'Ut amet unde tempor',NULL,'Paki Frank','Cadman Shields','Knox Barton','Similique cumque ut ','Molestiae accusantiu','2001-05-06',17,'Married','Male',4,'Yes','Unidentified','878','lysiqofa@mailinator.com','Autem quis velit im','Corporis optio sit ',1,1,1,0,NULL,'2022-05-22 19:01:16',NULL,NULL);

/*Table structure for table `tbl_support` */

DROP TABLE IF EXISTS `tbl_support`;

CREATE TABLE `tbl_support` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tbl_support` */

insert  into `tbl_support`(`id`,`name`,`email`,`number`,`subject`,`message`,`date`) values 
(1,'Annie May C. Barrera','anniemaybarrera@gmail.com','09102016346','data','Hello sir can I have a COPY OF BRGY. CERTIFICATE?','2022-04-19 05:01:17'),
(2,'Annie May C. Barrera','anniemaybarrera@gmail.com','09102016346','Clearance','school','2022-04-21 07:53:27'),
(7,'amar','waylimthai@gmail.com','0987666666','technical','bb','2022-04-21 09:50:45');

/*Table structure for table `tblblotter` */

DROP TABLE IF EXISTS `tblblotter`;

CREATE TABLE `tblblotter` (
  `id` int NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `tblblotter` */

insert  into `tblblotter`(`id`,`complainant`,`respondent`,`victim`,`type`,`location`,`date`,`time`,`details`,`status`) values 
(10,'Joe Rizal','Nora Selos','Joe Rizal','Amicable','Pob 1 Catbalogan, Samar','2020-11-02','00:30:00',' Sustento sa Anaak ','Scheduled'),
(19,'Girl Topak','Boy Topak','Girl Topak','Incident','Manila','2021-01-13','11:11:00','Mga Topakin na Pamilya','Active'),
(26,'baliw','luka','marites','Amicable','Looc','2021-04-30','13:09:00','Donec sollicitudin molestie malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.','Settled'),
(27,'Ian','annie may','Riza','Amicable','Arado City','2022-04-18','15:59:00','Gin Suntok','Scheduled');

/*Table structure for table `tblbrgy_info` */

DROP TABLE IF EXISTS `tblbrgy_info`;

CREATE TABLE `tblbrgy_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `text` text,
  `image` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tblbrgy_info` */

insert  into `tblbrgy_info`(`id`,`province`,`town`,`brgy_name`,`number`,`text`,`image`,`city_logo`,`brgy_logo`) values 
(1,'LEYTE','BURAUEN','Barangay Buri','0919-1234569','Location of Buri, Burauen, Leyte, Philippines\r\nBuri is one of the Barangays of Burauen.\r\nBurauen is in the Province of Leyte\r\nThe province of Leyte is in Region 8 â€“ Eastern Visayas Region.\r\nHistory of Buri, Burauen, Leyte, Philippines\r\nContribute your knowledge about the history of Buri\r\n\r\nPeople of Buri, Burauen, Leyte, Philippines\r\nTotal Population of Buri\r\n\r\nElected Government Officials of Buri, Burauen, Leyte, Philippines\r\nRepublic Act No. 11462 Approved: 03 December 2019: That the barangay and sangguniang kabataan elections on the second Monday of May 2020 shall be postponed to December 5, 2022. The elected barangay officials as of May 14, 2018 will serve until December of 2022.','02012022032735burauenlogo.jpg','02012022032735th.jfif','02012022032735burilogo.png');

/*Table structure for table `tblchairmanship` */

DROP TABLE IF EXISTS `tblchairmanship`;

CREATE TABLE `tblchairmanship` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tblchairmanship` */

insert  into `tblchairmanship`(`id`,`title`) values 
(2,'Presiding Officer'),
(3,'Committee on Appropriation'),
(4,'Committee on Peace & Order'),
(5,'Committee on Health'),
(6,'Committee on Education'),
(7,'Committee on Rules'),
(8,'Committee on Infrastructure '),
(9,'Committee on Solid Waste'),
(10,'Committee on Sports'),
(11,'No Chairmanship');

/*Table structure for table `tbldocuments` */

DROP TABLE IF EXISTS `tbldocuments`;

CREATE TABLE `tbldocuments` (
  `no` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `number` int DEFAULT NULL,
  `requested_documents` varchar(50) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbldocuments` */

insert  into `tbldocuments`(`no`,`name`,`email`,`number`,`requested_documents`,`purpose`,`date`) values 
(1,'amar','amar@gmail.com',910201645,'certificate','school','2022-04-20 06:00:00');

/*Table structure for table `tblfpscert` */

DROP TABLE IF EXISTS `tblfpscert`;

CREATE TABLE `tblfpscert` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `current_location` varchar(100) DEFAULT NULL,
  `applied` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tblfpscert` */

insert  into `tblfpscert`(`id`,`name`,`current_location`,`applied`) values 
(1,'RENATO R. ALMO','Metro Manila','2022-04-15'),
(2,'Annie May Barrera','Manila','2022-04-18'),
(3,'trytr','5454','2022-05-21'),
(4,'trytr','5454','2022-05-22');

/*Table structure for table `tblofficials` */

DROP TABLE IF EXISTS `tblofficials`;

CREATE TABLE `tblofficials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `chairmanship` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tblofficials` */

insert  into `tblofficials`(`id`,`name`,`chairmanship`,`position`,`termstart`,`termend`,`status`) values 
(1,'Gaudencio G. Berida','2','4','2021-04-29','2021-05-01','Active'),
(4,'RENATO R. ALMO','3','7','2021-04-03','2021-04-24','Active'),
(5,'Alberto C. Almo','4','8','2021-04-03','2022-03-24','Active'),
(6,'ALLAN T. ANTONIO','5','9','2021-10-13','2022-10-26','Active'),
(7,'merlo t. quiton','6','10','2020-05-21','2021-04-03','Active'),
(8,'relando s. tungasm','7','11','2020-03-17','2021-04-03','Active'),
(9,'Bienvinido P. BUHALOG','8','12','2020-04-22','2021-04-03','Active'),
(10,'NELSON Q. ELOGORICO','9','13','2020-06-18','2021-04-03','Active'),
(11,'DIONESIS C. ECHON','10','14','2020-07-08','2021-04-03','Active'),
(12,'ALMA CANDELA','11','15','2020-07-08','2021-04-03','Active'),
(13,'ROWENA P. RELLAMA','11','16','2020-10-07','2021-04-03','Active'),
(14,'Ernie Jeash Villahermosa','5',NULL,'2022-05-18','2022-05-20','Active'),
(15,'Ernie Jeash Villahermosa','5',NULL,'2022-05-18','2022-05-20','Active'),
(16,'Ernie Jeash Villahermosa','5',NULL,'2022-05-18','2022-05-20','Active'),
(17,'Ernie Jeash Villahermosa','5','10','2022-05-18','2022-05-20','Active'),
(18,'Ernie Jeash Villahermosa','5','10','2022-05-18','2022-05-20','Active'),
(19,'Ernie Jeash Villahermosa','5','10','2022-05-18','2022-05-20','Active');

/*Table structure for table `tblpermit` */

DROP TABLE IF EXISTS `tblpermit`;

CREATE TABLE `tblpermit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `owner1` varchar(200) DEFAULT NULL,
  `owner2` varchar(80) DEFAULT NULL,
  `nature` varchar(220) DEFAULT NULL,
  `applied` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tblpermit` */

insert  into `tblpermit`(`id`,`name`,`owner1`,`owner2`,`nature`,`applied`) values 
(4,'SH Food Group 1','SH Food Group 1','SH Food Group 2','SH Food Group 1','2021-04-30'),
(5,'Atrium Salon & Studio','SH Food Group 213','','Atrium Salon & Studio','2021-04-30'),
(6,'12','123','123','123','2022-05-22');

/*Table structure for table `tblposition` */

DROP TABLE IF EXISTS `tblposition`;

CREATE TABLE `tblposition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(50) DEFAULT NULL,
  `order` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tblposition` */

insert  into `tblposition`(`id`,`position`,`order`) values 
(4,'Barangay Captain',1),
(7,'Barangay Kagawad',2),
(8,'Barangay Kagawad',3),
(9,'Barangay Kagawad',4),
(10,'Barangay Kagawad',5),
(11,'Barangay Kagawad',6),
(12,'Barangay Kagawad',7),
(13,'Barangay Kagawad',8),
(14,'SK Chairman',9),
(15,'Secretary',10),
(16,'Treasurer',11);

/*Table structure for table `tblprecinct` */

DROP TABLE IF EXISTS `tblprecinct`;

CREATE TABLE `tblprecinct` (
  `id` int NOT NULL AUTO_INCREMENT,
  `precinct` varchar(100) DEFAULT NULL,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tblprecinct` */

insert  into `tblprecinct`(`id`,`precinct`,`details`) values 
(1,'0987666666','DSWD Contact');

/*Table structure for table `tblrequest` */

DROP TABLE IF EXISTS `tblrequest`;

CREATE TABLE `tblrequest` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `pcs` int DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `applied` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tblrequest` */

insert  into `tblrequest`(`id`,`name`,`pcs`,`type`,`location`,`applied`) values 
(1,'Annie May Barrera',6,'coconut','buri','2022-04-15'),
(2,'RENATO R. ALMO',6,'nara','Dist. 8','2022-04-15'),
(3,'Ian Figuracion',100,'Flywood','Arado City','2022-04-18'),
(4,'trytr',12,'12','122','2022-05-22');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_type` enum('administrator','staff','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `avatar` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`user_type`,`avatar`,`created_at`) values 
(11,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','administrator','21052022134501280057777_309540994678537_4506971625188184492_n.jpg','2021-05-03 10:33:03'),
(12,'paulo','3352537346b8952df5cd1af145e0bc194c654b68','staff','02012022033117FB_IMG_16410174636644719.jpg','2022-01-02 10:31:17'),
(13,'jeremy','ee68891a4be740d745aa4edd6c1c3121abbf4ab4','staff','02012022033149FB_IMG_16410173556326371.jpg','2022-01-02 10:31:49'),
(14,'staff','6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611','staff','data:image/jpeg;base64,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','2022-04-18 12:11:54'),
(91,'6284b022c3809','b1aaaa56a74a056fc04787016fdcbec0c62a261b','user',NULL,'2022-05-18 16:36:50'),
(92,'6284b031abc24','f2d2722620fc0dcd8bda2f17a348dbd3353ce10a','user',NULL,'2022-05-18 16:37:05'),
(93,'6284b0518b96b','1de992014e954272d9a2e458611aef73f31f1df1','user',NULL,'2022-05-18 16:37:37'),
(94,'6284b0641f7e6','e20f31a9f241c5d03d08f8644f200a213d3af678','user',NULL,'2022-05-18 16:37:56'),
(95,'6284b0715c08d','ce66a81a21ebe7b10e95ce49d5bba7a16042ca9b','user','2022051810380916528630896284b0715bc5c.jpg','2022-05-18 16:38:09'),
(96,'6284b0965e77e','6bd5e285731e33826c68c63632c54e75b0352003','user','2022051810384616528631266284b0965e413.jpg','2022-05-18 16:38:46'),
(97,'6284b09690878','227c9c05efec85a88f18722a5e0e0eab65ee6c3f','user','2022051810384616528631266284b09690494.jpg','2022-05-18 16:38:46'),
(98,'6284b0b443756','e9fd688dc5c094444c85b540415b34e3041aaebc','user',NULL,'2022-05-18 16:39:16'),
(99,'test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','user','2022052102345416531364946288dc6e93d75.png','2022-05-21 20:34:54'),
(100,'muwokaqy','c965e6cf75a9fdaa35c7e96ff69770613558fca9','user',NULL,'2022-05-22 18:58:57'),
(101,'vijal','794e60c3ec24b58c7d3aa9d086bd74a55e4e0d76','user',NULL,'2022-05-22 19:00:20'),
(102,'lalydoporu','3c90477190cc4dc6b46a57ac6c2cdbdca2833835','user',NULL,'2022-05-22 19:01:16');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
