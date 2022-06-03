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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `announcements` */

insert  into `announcements`(`id`,`title`,`content`,`thumbnail`,`created_at`,`updated_at`,`deleted_at`) values 
(38,'Ab sint accusamus id','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','202205220221031653222063628a2aaf62d71.png','2022-05-22 20:21:03',NULL,NULL),
(40,'What is Lorem Ipsum?','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','202205220224521653222292628a2b945e81a.jpg','2022-05-22 20:24:52',NULL,NULL),
(41,'123','123','2022053002303616539138366294b8ec6a520.png','2022-05-30 20:30:36',NULL,NULL);

/*Table structure for table `certificate_requests` */

DROP TABLE IF EXISTS `certificate_requests`;

CREATE TABLE `certificate_requests` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `resident_id` int unsigned NOT NULL,
  `payment_id` int unsigned DEFAULT NULL,
  `certificate_id` int unsigned NOT NULL,
  `status` enum('resolved','rejected','pending') NOT NULL DEFAULT 'pending',
  `memo` varchar(100) DEFAULT NULL,
  `data` json DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resident_id` (`resident_id`),
  KEY `payment_id` (`payment_id`),
  KEY `certificate_id` (`certificate_id`),
  CONSTRAINT `certificate_requests_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`),
  CONSTRAINT `certificate_requests_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  CONSTRAINT `certificate_requests_ibfk_3` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `certificate_requests` */

insert  into `certificate_requests`(`id`,`resident_id`,`payment_id`,`certificate_id`,`status`,`memo`,`data`,`url`,`created_at`,`updated_at`,`deleted_at`) values 
(5,9,17,5,'resolved','Quas minima vitae do','{\"name\": \"Addison Lawrence\", \"nature\": \"Eius temporibus dese\", \"owner_1\": \"Cumque quis reiciend\", \"owner_2\": \"Earum sit in volupta\"}','generate_business_permit.php?id=9&request_id=5','2022-06-03 22:34:05','2022-06-03 23:31:50',NULL),
(6,9,NULL,5,'pending','Quas minima vitae do','{\"name\": \"Addison Lawrence\", \"nature\": \"Eius temporibus dese\", \"owner_1\": \"Cumque quis reiciend\", \"owner_2\": \"Earum sit in volupta\"}','generate_business_permit.php?id=9&request_id=6','2022-06-03 22:34:09','2022-06-03 22:34:09',NULL),
(7,9,NULL,5,'pending','Quas minima vitae do','{\"name\": \"Addison Lawrence\", \"nature\": \"Eius temporibus dese\", \"owner_1\": \"Cumque quis reiciend\", \"owner_2\": \"Earum sit in volupta\"}','generate_business_permit.php?id=9&request_id=7','2022-06-03 22:34:12','2022-06-03 22:34:12',NULL),
(8,9,NULL,5,'pending','123','{\"name\": \"123\", \"nature\": \"123123\", \"owner_1\": \"12312\", \"owner_2\": \"3123\"}','generate_business_permit.php?id=9&request_id=8','2022-06-03 22:39:12','2022-06-03 22:39:12',NULL),
(11,9,NULL,6,'pending','123','{\"location\": \"buri\", \"material\": \"123\", \"quantity\": \"123\"}','generate_cuttingpermit.php?id=9&request_id=11','2022-06-03 23:29:54','2022-06-04 00:42:29',NULL),
(12,9,NULL,6,'pending','123','{\"location\": \"3asdf asdf asdf asdf\", \"material\": \"fdsfwre asdf\", \"quantity\": \"12312 asdf asdf \"}','generate_cuttingpermit.php?id=9&request_id=12','2022-06-04 00:48:22','2022-06-04 00:48:22',NULL);

/*Table structure for table `certificates` */

DROP TABLE IF EXISTS `certificates`;

CREATE TABLE `certificates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `certificates` */

insert  into `certificates`(`id`,`name`,`url`) values 
(1,'Barangay Certificate','generate_brgy_cert.php'),
(2,'Cutting Permit','generate_cuttingpermit.php'),
(3,'4ps Certification','generate_fpscert.php'),
(4,'Certificate of Indigency','generate_indi_cert.php'),
(5,'Business Clearance','generate_business_permit.php'),
(6,'Cutting Permit','generate_cuttingpermit.php');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `payments` */

insert  into `payments`(`id`,`user_id`,`resident_id`,`details`,`amount`,`mode`,`created_at`,`updated_at`,`deleted_at`) values 
(6,11,1,'Barangay Clearance Payment',200.00,'online','2022-05-22 17:35:30',NULL,NULL),
(7,11,1,'Certificate of Indigency Payment',200.00,'online','2022-05-22 17:52:50',NULL,NULL),
(8,11,1,'Certificate of Indigency Payment',2.00,'online','2022-05-22 17:53:39',NULL,NULL),
(9,11,6,'Business Permit Payment',2.00,'online','2022-05-22 18:23:47',NULL,NULL),
(10,11,2,'4PS Certification Payment',21.00,'online','2022-05-22 18:34:12',NULL,NULL),
(11,11,13,'Barangay Clearance Payment',12.00,'online','2022-05-22 20:56:10',NULL,NULL),
(12,11,13,'Barangay Clearance Payment',12.00,'online','2022-05-22 20:56:26',NULL,NULL),
(13,11,13,'Barangay Clearance Payment',12.00,'online','2022-05-22 20:56:36',NULL,NULL),
(14,11,1,'Cutting Permit Payment',123.00,'online','2022-05-22 21:04:13',NULL,NULL),
(15,11,9,'Barangay Clearance Payment',222.00,'online','2022-05-24 23:38:50',NULL,NULL),
(16,11,9,'Barangay Clearance Payment',12.00,'online','2022-05-24 23:40:10',NULL,NULL),
(17,11,9,'Business Permit Payment',12312.00,'online','2022-06-03 23:31:50',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

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
(12,'Ullam ea quae qui co',102,'Ut amet unde tempor',NULL,'Paki Frank','Cadman Shields','Knox Barton','Similique cumque ut ','Molestiae accusantiu','2001-05-06',17,'Married','Male',4,'Yes','Unidentified','878','lysiqofa@mailinator.com','Autem quis velit im','Corporis optio sit ',1,0,1,0,NULL,'2022-05-22 19:01:16','2022-05-29 19:07:26',NULL),
(13,'Sunt eum proident t',103,'Odio proident solut',NULL,'Chloe Moore','Lois Flynn','Alfreda Cantu','Qui necessitatibus m','Minim nesciunt minu','2012-08-23',89,'Single','Male',4,'Yes','Unidentified','345','bawobekiw@mailinator.com','Commodi illo eaque i','Reiciendis repudiand',1,0,0,1,NULL,'2022-05-22 20:05:58',NULL,NULL),
(14,'Aute occaecat sed ev',104,'Repellendus Ullamco',NULL,'Emerson Kinney','Ryan Harding','Rhoda Ramsey','Numquam esse offici','Labore dolore qui ex','1990-01-14',37,'Widow','Female',2,'No','Unidentified','746','miwelac@mailinator.com','Soluta commodi corpo',' Libero sit maiores ',1,1,1,0,NULL,'2022-05-29 18:48:11','2022-05-29 19:14:15',NULL),
(15,'Aspernatur repudiand',105,'Ipsa sequi officiis',NULL,'Zoe Merritt','Gail Obrien','Dean Conway','Voluptate eaque reru','Autem maxime laboris','1985-05-21',51,'Married','Male',6,'Yes','Negative','50','musaxota@mailinator.com','Optio commodo delec','Ex proident nemo ab',1,0,0,0,NULL,'2022-05-30 20:27:11',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tbl_support` */

insert  into `tbl_support`(`id`,`name`,`email`,`number`,`subject`,`message`,`date`) values 
(1,'Annie May C. Barrera','anniemaybarrera@gmail.com','09102016346','data','Hello sir can I have a COPY OF BRGY. CERTIFICATE?','2022-04-19 05:01:17'),
(2,'Annie May C. Barrera','anniemaybarrera@gmail.com','09102016346','Clearance','school','2022-04-21 07:53:27'),
(7,'amar','waylimthai@gmail.com','0987666666','technical','bb','2022-04-21 09:50:45'),
(8,'12','1231@asdasd.ad','12','12','12','2022-05-30 20:21:12'),
(9,'12','1231@asdasd.ad','12','12','12','2022-05-30 20:22:57');

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
(1,'LEYTE','BURAUEN','Barangay Buri','0919-1234569','Location of Buri, Burauen, Leyte, Philippines\r\nBuri is one of the Barangays of Burauen.\r\nBurauen is in the Province of Leyte\r\nThe province of Leyte is in Region 8 â€“ Eastern Visayas Region.\r\nHistory of Buri, Burauen, Leyte, Philippines\r\nContribute your knowledge about the history of Buri\r\n\r\nPeople of Buri, Burauen, Leyte, Philippines\r\nTotal Population of Buri\r\n\r\nElected Government Officials of Buri, Burauen, Leyte, Philippines\r\nRepublic Act No. 11462 Approved: 03 December 2019: That the barangay and sangguniang kabataan elections on the second Monday of May 2020 shall be postponed to December 5, 2022. The elected barangay officials as of May 14, 2018 will serve until December of 2022.','22052022140518280057777_309540994678537_4506971625188184492_n.png','22052022140518280057777_309540994678537_4506971625188184492_n.jpg','22052022140518280057777_309540994678537_4506971625188184492_n.png');

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
(3,'trytr','5454','2022-05-21');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tblpermit` */

insert  into `tblpermit`(`id`,`name`,`owner1`,`owner2`,`nature`,`applied`) values 
(4,'SH Food Group 1','SH Food Group 1','SH Food Group 2','SH Food Group 1','2021-04-30'),
(5,'Atrium Salon & Studio','SH Food Group 213','','Atrium Salon & Studio','2021-04-30'),
(6,'12','123','123','123','2022-05-22'),
(7,'123','123','123','123','2022-06-03'),
(8,'123','123','123','123','2022-06-03');

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
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(99,'test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','user','2022053002222716539133476294b70368309.png','2022-05-21 20:34:54'),
(100,'muwokaqy','c965e6cf75a9fdaa35c7e96ff69770613558fca9','user',NULL,'2022-05-22 18:58:57'),
(101,'vijal','794e60c3ec24b58c7d3aa9d086bd74a55e4e0d76','user',NULL,'2022-05-22 19:00:20'),
(102,'lalydoporu','3c90477190cc4dc6b46a57ac6c2cdbdca2833835','user',NULL,'2022-05-22 19:01:16'),
(103,'raculasovi','1b5ed5f6a7d5ddd978554ad98e0cd0636496caa6','user','data:image/jpeg;base64,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','2022-05-22 20:05:58'),
(104,'user','12dea96fec20593566ab75692c9949596833adc9','user','','2022-05-29 18:48:11'),
(105,'user1','b3daa77b4c04a9551b8781d03191fe098f325e67','user','2022053002271116539136316294b81f22f03.png','2022-05-30 20:27:11');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
