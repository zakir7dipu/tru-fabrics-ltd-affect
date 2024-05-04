/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.33 : Database - bizzsol_tru_fabric_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `activity_log` */

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activity_log` */

/*Table structure for table `attribute_options` */

DROP TABLE IF EXISTS `attribute_options`;

CREATE TABLE `attribute_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_options_attribute_id_foreign` (`attribute_id`),
  KEY `attribute_options_created_by_foreign` (`created_by`),
  KEY `attribute_options_updated_by_foreign` (`updated_by`),
  CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  CONSTRAINT `attribute_options_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `attribute_options_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `attribute_options` */

insert  into `attribute_options`(`id`,`attribute_id`,`name`,`description`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,3,'10X10/44X38',NULL,1,NULL,NULL,'2024-03-22 09:38:22','2024-03-22 09:38:22'),
(2,3,'10x16/64x62',NULL,1,NULL,NULL,'2024-03-22 09:38:33','2024-03-22 09:38:33'),
(3,3,'10x16/67x60',NULL,1,NULL,NULL,'2024-03-22 09:38:40','2024-03-22 09:38:40'),
(4,3,'16x16+70D/94x40',NULL,1,NULL,NULL,'2024-03-22 09:38:46','2024-03-22 09:38:46'),
(5,3,'16x20+70D/90x65',NULL,1,NULL,NULL,'2024-03-22 09:38:57','2024-03-22 09:38:57'),
(6,4,'61\"',NULL,1,NULL,NULL,'2024-03-22 09:42:26','2024-03-22 09:42:26'),
(7,4,'69\"',NULL,1,NULL,NULL,'2024-03-22 09:42:32','2024-03-22 09:42:32'),
(8,4,'68\'\'',NULL,1,NULL,NULL,'2024-03-22 09:42:40','2024-03-22 09:42:40'),
(9,4,'71\'\'',NULL,1,NULL,NULL,'2024-03-22 09:42:45','2024-03-22 09:42:45'),
(10,4,'72\"',NULL,1,NULL,NULL,'2024-03-22 09:42:51','2024-03-22 09:42:51'),
(11,4,'70\'\'',NULL,1,NULL,NULL,'2024-03-22 09:43:00','2024-03-22 09:43:00'),
(12,5,'Linen',NULL,1,NULL,NULL,'2024-03-22 09:43:24','2024-03-22 09:43:24'),
(13,5,'3/1 Z Twill',NULL,1,NULL,NULL,'2024-03-22 09:43:53','2024-03-22 09:43:53'),
(14,5,'3/1 Twill',NULL,1,NULL,NULL,'2024-03-22 09:44:07','2024-03-22 09:44:07'),
(15,5,'S. Canvas',NULL,1,NULL,NULL,'2024-03-22 09:44:16','2024-03-22 09:44:16'),
(16,5,'Sheeting',NULL,1,NULL,NULL,'2024-03-22 09:44:23','2024-03-22 09:44:23'),
(17,5,'2/1 Twill',NULL,1,NULL,NULL,'2024-03-22 09:44:33','2024-03-22 09:44:33'),
(18,5,'Dobby',NULL,1,NULL,NULL,'2024-03-22 09:44:43','2024-03-22 09:44:43'),
(19,2,'(10-100) White Light Aop CW-B',NULL,1,NULL,NULL,'2024-03-22 09:45:13','2024-03-22 09:45:13'),
(20,2,'(72-302) Blue Bright Aop CW-A',NULL,1,NULL,NULL,'2024-03-22 09:45:21','2024-03-22 09:45:21'),
(21,2,'(74-209) Blue Light CW-03',NULL,1,NULL,NULL,'2024-03-22 09:45:28','2024-03-22 09:45:28'),
(22,2,'01 (Pearl White)',NULL,1,NULL,NULL,'2024-03-22 09:45:36','2024-03-22 09:45:36'),
(23,2,'01 BLACK',NULL,1,NULL,NULL,'2024-03-22 09:45:45','2024-03-22 09:45:45'),
(24,2,'01 Pearl White',NULL,1,NULL,NULL,'2024-03-22 09:45:53','2024-03-22 09:45:53'),
(25,2,'03 Beige',NULL,1,NULL,NULL,'2024-03-22 09:46:01','2024-03-22 09:46:01'),
(26,1,'S',NULL,1,NULL,NULL,'2024-03-22 09:46:35','2024-03-22 09:46:35'),
(27,1,'M',NULL,1,NULL,NULL,'2024-03-22 09:46:39','2024-03-22 09:46:39'),
(28,1,'L',NULL,1,NULL,NULL,'2024-03-22 09:46:44','2024-03-22 09:46:44'),
(29,1,'XL',NULL,1,NULL,NULL,'2024-03-22 09:46:48','2024-03-22 09:46:48'),
(30,1,'0.05 mm',NULL,1,NULL,NULL,'2024-03-22 09:46:56','2024-03-22 09:46:56'),
(31,6,'100','10 GSM',1,1,NULL,'2024-04-27 10:56:10','2024-04-29 09:15:32');

/*Table structure for table `attributes` */

DROP TABLE IF EXISTS `attributes`;

CREATE TABLE `attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `searchable` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attributes_created_by_foreign` (`created_by`),
  KEY `attributes_updated_by_foreign` (`updated_by`),
  CONSTRAINT `attributes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `attributes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `attributes` */

insert  into `attributes`(`id`,`name`,`code`,`description`,`searchable`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Size','Size','N/A','yes',1,1,NULL,'2024-03-22 09:30:27','2024-03-22 09:31:34'),
(2,'Color','Color','N/A','yes',1,NULL,NULL,'2024-03-22 09:30:51','2024-03-22 09:30:51'),
(3,'Construction','Construction','Construction','yes',1,NULL,NULL,'2024-03-22 09:36:00','2024-03-22 09:36:00'),
(4,'Width','Width',NULL,'yes',1,NULL,NULL,'2024-03-22 09:36:17','2024-03-22 09:36:17'),
(5,'Weave','Weave',NULL,'yes',1,NULL,NULL,'2024-03-22 09:36:44','2024-03-22 09:36:44'),
(6,'GSM','GSM-01',NULL,'yes',1,NULL,NULL,'2024-04-27 05:55:25','2024-04-27 05:55:25');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_created_by_foreign` (`created_by`),
  KEY `categories_updated_by_foreign` (`updated_by`),
  CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`code`,`name`,`parent_id`,`description`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'CT-0001','Greige',NULL,'For Greige',1,1,NULL,'2024-03-22 10:16:03','2024-03-22 10:40:22'),
(2,'CT-0002','Dyes & Chemicals',NULL,NULL,1,NULL,NULL,'2024-03-22 10:56:33','2024-03-22 10:56:33'),
(3,'CT-0003','Gray Fabric',NULL,'Test',1,NULL,NULL,'2024-04-24 09:24:24','2024-04-24 09:24:24');

/*Table structure for table `categories_attributes` */

DROP TABLE IF EXISTS `categories_attributes`;

CREATE TABLE `categories_attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `attribute_id` bigint(20) unsigned NOT NULL,
  `serial` int(11) NOT NULL DEFAULT '0',
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_attributes_category_id_foreign` (`category_id`),
  KEY `categories_attributes_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `categories_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  CONSTRAINT `categories_attributes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories_attributes` */

insert  into `categories_attributes`(`id`,`category_id`,`attribute_id`,`serial`,`options`,`created_at`,`updated_at`) values
(1,1,3,1,'[\"1\",\"2\",\"3\",\"4\",\"5\"]','2024-03-22 10:54:48','2024-03-22 10:54:48'),
(2,1,4,1,'[\"6\",\"7\",\"8\",\"9\",\"10\",\"11\"]','2024-03-22 10:54:48','2024-03-22 10:54:48'),
(3,1,5,1,'[\"12\",\"13\",\"14\",\"15\",\"16\",\"18\"]','2024-03-22 10:54:48','2024-03-22 10:54:48'),
(9,2,1,1,'[\"26\",\"27\",\"28\",\"29\",\"30\"]','2024-04-27 10:51:56','2024-04-27 10:51:56'),
(10,2,2,1,'[\"19\",\"20\",\"21\",\"22\",\"23\",\"24\"]','2024-04-27 10:51:56','2024-04-27 10:51:56'),
(11,2,3,1,'[\"1\",\"2\",\"3\",\"4\",\"5\"]','2024-04-27 10:51:56','2024-04-27 10:51:56'),
(12,2,4,1,'[\"6\",\"7\",\"8\",\"9\",\"10\",\"11\"]','2024-04-27 10:51:59','2024-04-27 10:51:59'),
(13,2,5,1,'[\"12\",\"13\",\"14\",\"15\",\"16\",\"17\"]','2024-04-27 10:51:59','2024-04-27 10:51:59'),
(14,3,1,1,'[\"26\",\"27\",\"28\",\"29\",\"30\"]','2024-04-27 10:52:48','2024-04-27 10:52:48'),
(15,3,2,1,'[\"19\",\"20\",\"21\",\"22\",\"23\",\"24\"]','2024-04-27 10:52:48','2024-04-27 10:52:48'),
(16,3,3,1,'[\"1\",\"2\",\"3\",\"4\",\"5\"]','2024-04-27 10:52:48','2024-04-27 10:52:48'),
(17,3,4,1,'[\"6\",\"7\",\"8\",\"9\",\"10\",\"11\"]','2024-04-27 10:52:48','2024-04-27 10:52:48'),
(18,3,5,1,'[\"12\",\"13\",\"14\",\"15\",\"16\",\"17\"]','2024-04-27 10:52:48','2024-04-27 10:52:48'),
(19,1,6,1,'[\"31\"]','2024-04-27 10:56:31','2024-04-27 10:56:31');

/*Table structure for table `categories_departments` */

DROP TABLE IF EXISTS `categories_departments`;

CREATE TABLE `categories_departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `department_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_departments_category_id_foreign` (`category_id`),
  KEY `categories_departments_department_id_foreign` (`department_id`),
  CONSTRAINT `categories_departments_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `categories_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories_departments` */

insert  into `categories_departments`(`id`,`category_id`,`department_id`,`created_at`,`updated_at`) values
(4,1,1,NULL,NULL),
(5,1,2,NULL,NULL),
(6,1,3,NULL,NULL),
(7,2,1,NULL,NULL),
(8,2,2,NULL,NULL),
(9,2,3,NULL,NULL),
(10,3,1,NULL,NULL);

/*Table structure for table `charges` */

DROP TABLE IF EXISTS `charges`;

CREATE TABLE `charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `charge_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('bank','others') COLLATE utf8mb4_unicode_ci DEFAULT 'bank',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charges_created_by_foreign` (`created_by`),
  KEY `charges_updated_by_foreign` (`updated_by`),
  CONSTRAINT `charges_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `charges_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `charges` */

insert  into `charges`(`id`,`charge_name`,`charge_code`,`type`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Bank Charges','CHG-01','bank','active',1,NULL,NULL,'2024-03-27 04:33:27','2024-03-27 04:33:27'),
(2,'LC Open','CHG-02','bank','active',1,NULL,NULL,'2024-03-27 04:33:36','2024-03-27 04:33:36'),
(3,'LC Amendment','CHG-03','bank','active',1,NULL,NULL,'2024-03-27 04:33:56','2024-03-27 04:33:56'),
(4,'Acceptance','CHG-04','bank','active',1,NULL,NULL,'2024-03-27 04:34:06','2024-03-27 04:34:06'),
(5,'Discrepancies','CHG-05','bank','active',1,NULL,NULL,'2024-03-27 04:34:16','2024-03-27 04:34:16'),
(6,'Other Bank Charges','CHG-06','bank','active',1,NULL,NULL,'2024-03-27 04:34:30','2024-03-27 04:34:30'),
(7,'Insurance Charges','CHG-07','others','active',1,NULL,NULL,'2024-03-27 04:34:40','2024-03-27 04:34:40'),
(8,'Labor Cost','CHG-08','bank','active',1,NULL,NULL,'2024-04-18 09:39:22','2024-04-18 09:39:22');

/*Table structure for table `costing_charts` */

DROP TABLE IF EXISTS `costing_charts`;

CREATE TABLE `costing_charts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `process_id` bigint(20) unsigned DEFAULT NULL,
  `gsm_range_id` bigint(20) unsigned DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `costing_charts_process_id_foreign` (`process_id`),
  KEY `costing_charts_gsm_range_id_foreign` (`gsm_range_id`),
  KEY `costing_charts_created_by_foreign` (`created_by`),
  KEY `costing_charts_updated_by_foreign` (`updated_by`),
  CONSTRAINT `costing_charts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `costing_charts_gsm_range_id_foreign` FOREIGN KEY (`gsm_range_id`) REFERENCES `gsm_ranges` (`id`),
  CONSTRAINT `costing_charts_process_id_foreign` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`),
  CONSTRAINT `costing_charts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `costing_charts` */

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agreement` text COLLATE utf8mb4_unicode_ci,
  `term_conditions` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_created_by_foreign` (`created_by`),
  KEY `customers_updated_by_foreign` (`updated_by`),
  CONSTRAINT `customers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `customers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`name`,`code`,`phone`,`email`,`mobile_no`,`tin`,`trade`,`bin`,`vat`,`website`,`agreement`,`term_conditions`,`address`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Sterling Denims LTD','CUS-01',NULL,NULL,NULL,NULL,'123',NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-04-17 05:05:07','2024-04-17 05:05:07'),
(2,'Denim Expert Ltd.','CUS-02',NULL,NULL,NULL,NULL,'123',NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-04-17 05:05:36','2024-04-17 05:05:36'),
(3,'Shin Shin Apparels','CUS-03',NULL,NULL,NULL,NULL,'123',NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-04-17 05:06:00','2024-04-17 05:06:00'),
(4,'Laila Styles LTD','CUS-04',NULL,NULL,NULL,NULL,'123',NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-04-17 05:06:12','2024-04-17 05:06:12'),
(5,'SF Jeans Ltd.','CUS-05',NULL,NULL,NULL,NULL,'123',NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-04-17 05:06:22','2024-04-17 05:06:22'),
(6,'AKM Knit Wear LTD','CUS-06',NULL,NULL,NULL,NULL,'123',NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-04-17 05:06:35','2024-04-17 05:06:35');

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_created_by_foreign` (`created_by`),
  KEY `departments_updated_by_foreign` (`updated_by`),
  CONSTRAINT `departments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `departments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `departments` */

insert  into `departments`(`id`,`name`,`code`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Productions','D-0001','active',1,NULL,NULL,'2024-03-22 05:38:19','2024-03-22 05:51:10'),
(2,'Commercial','D-0002','active',1,NULL,NULL,'2024-03-22 05:51:43','2024-03-22 05:51:43'),
(3,'Factory','D-0003','active',1,NULL,NULL,'2024-03-22 05:51:52','2024-03-22 05:51:52'),
(4,'Head Office','D-0004','active',1,NULL,NULL,'2024-03-22 05:52:04','2024-03-22 05:52:04');

/*Table structure for table `designations` */

DROP TABLE IF EXISTS `designations`;

CREATE TABLE `designations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `designations_created_by_foreign` (`created_by`),
  KEY `designations_updated_by_foreign` (`updated_by`),
  CONSTRAINT `designations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `designations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `designations` */

insert  into `designations`(`id`,`name`,`code`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Chairman','D-0001','active',1,NULL,NULL,'2024-03-22 17:03:40','2024-03-22 17:03:40'),
(2,'MD','D-0002','active',1,NULL,NULL,'2024-03-22 17:03:46','2024-03-22 17:03:46'),
(3,'Executive','D-0003','active',1,NULL,NULL,'2024-03-22 17:04:02','2024-03-22 17:04:02'),
(4,'Factory Manager','D-0004','active',1,NULL,NULL,'2024-03-22 17:04:12','2024-03-22 17:04:12');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `finished_good_item_quality_controls` */

DROP TABLE IF EXISTS `finished_good_item_quality_controls`;

CREATE TABLE `finished_good_item_quality_controls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finished_good_item_id` bigint(20) unsigned NOT NULL,
  `inspection` enum('fresh','reject','wip') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fresh',
  `fg_qc_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `delivery_qty` double NOT NULL DEFAULT '0',
  `is_wip` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fgi_forgin_id` (`finished_good_item_id`),
  CONSTRAINT `fgi_forgin_id` FOREIGN KEY (`finished_good_item_id`) REFERENCES `finished_good_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_good_item_quality_controls` */

insert  into `finished_good_item_quality_controls`(`id`,`finished_good_item_id`,`inspection`,`fg_qc_reference`,`qty`,`delivery_qty`,`is_wip`,`created_at`,`updated_at`) values
(1,1,'fresh','FRESH-24-00000000001',17,17,'no','2024-04-24 04:42:05','2024-04-25 11:22:20'),
(2,2,'fresh','FRESH-24-00000000002',20,20,'no','2024-04-24 04:42:07','2024-04-25 11:22:21'),
(3,3,'fresh','FRESH-24-00000000003',20,20,'no','2024-04-24 04:42:07','2024-04-25 11:22:21'),
(4,2,'reject','REJECT-24-0000000004',2,0,'no','2024-04-24 04:42:07','2024-04-24 04:42:07'),
(5,1,'wip','WIP-24-0000000000005',5,0,'yes','2024-04-24 04:42:07','2024-04-25 08:21:30'),
(6,2,'wip','WIP-24-0000000000006',11,0,'yes','2024-04-24 04:42:07','2024-04-25 08:21:27'),
(7,3,'wip','WIP-24-0000000000007',6,0,'yes','2024-04-24 04:42:07','2024-04-25 08:21:24'),
(8,1,'fresh','FRESH-24-00000000008',2,2,'no','2024-04-24 04:49:11','2024-04-25 11:22:20'),
(9,3,'fresh','FRESH-24-00000000009',5,5,'no','2024-04-24 04:49:11','2024-04-25 11:22:21'),
(10,4,'fresh','FRESH-24-00000000010',6,6,'no','2024-04-24 04:50:26','2024-04-25 11:22:20'),
(11,5,'fresh','FRESH-24-00000000011',7,7,'no','2024-04-24 04:50:26','2024-04-25 11:22:21'),
(12,6,'fresh','FRESH-24-00000000012',15,15,'no','2024-04-24 04:50:26','2024-04-25 11:22:21'),
(13,6,'wip','WIP-24-0000000000013',2,0,'yes','2024-04-24 04:50:26','2024-04-24 07:12:02'),
(14,6,'fresh','FRESH-24-00000000014',1,1,'no','2024-04-24 04:51:29','2024-04-25 11:22:21'),
(15,6,'wip','WIP-24-0000000000015',1,0,'yes','2024-04-24 04:51:29','2024-04-24 07:11:41'),
(16,6,'fresh','FRESH-24-000016',2,2,'no','2024-04-24 07:18:57','2024-04-25 11:22:21'),
(17,6,'wip','WIP-24-00000017',1,0,'yes','2024-04-24 07:18:57','2024-04-24 07:19:12'),
(18,6,'fresh','FRESH-24-000018',1,1,'no','2024-04-24 07:19:35','2024-04-25 11:22:21'),
(19,17,'fresh','FRESH-24-000019',500,0,'no','2024-04-25 07:35:13','2024-04-25 07:35:13'),
(20,18,'fresh','FRESH-24-000020',500,0,'no','2024-04-25 07:35:13','2024-04-25 07:35:13'),
(21,19,'fresh','FRESH-24-000021',200,200,'no','2024-04-27 06:15:36','2024-04-27 06:20:19'),
(22,19,'wip','WIP-24-00000022',40,0,'yes','2024-04-27 06:15:36','2024-04-27 06:16:08'),
(23,20,'fresh','FRESH-24-000023',10,10,'no','2024-04-27 06:15:53','2024-04-27 06:21:24'),
(24,19,'fresh','FRESH-24-000024',40,40,'no','2024-04-27 06:16:33','2024-04-27 06:21:24'),
(25,1,'fresh','FRESH-24-000025',3,0,'no','2024-04-28 08:35:30','2024-04-28 08:35:30'),
(26,2,'fresh','FRESH-24-000026',8,0,'no','2024-04-28 08:35:31','2024-04-28 08:35:31'),
(27,3,'fresh','FRESH-24-000027',4,0,'no','2024-04-28 08:35:31','2024-04-28 08:35:31'),
(28,1,'wip','WIP-24-00000028',2,0,'yes','2024-04-28 08:35:31','2024-04-28 08:35:54'),
(29,2,'wip','WIP-24-00000029',3,0,'yes','2024-04-28 08:35:31','2024-04-28 08:35:51'),
(30,3,'wip','WIP-24-00000030',2,0,'yes','2024-04-28 08:35:31','2024-04-28 08:35:48'),
(31,1,'fresh','FRESH-24-000031',2,0,'no','2024-04-28 08:36:09','2024-04-28 08:36:09'),
(32,2,'fresh','FRESH-24-000032',3,0,'no','2024-04-28 08:36:09','2024-04-28 08:36:09'),
(33,3,'fresh','FRESH-24-000033',2,0,'no','2024-04-28 08:36:09','2024-04-28 08:36:09'),
(41,21,'fresh','FRESH-24-000034',200,200,'no','2024-04-30 06:14:15','2024-04-30 06:17:44');

/*Table structure for table `finished_good_items` */

DROP TABLE IF EXISTS `finished_good_items`;

CREATE TABLE `finished_good_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finished_good_id` bigint(20) unsigned NOT NULL,
  `work_order_item_id` bigint(20) unsigned NOT NULL,
  `warehouse_id` bigint(20) unsigned NOT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finished_good_items_finished_good_id_foreign` (`finished_good_id`),
  KEY `finished_good_items_work_order_item_id_foreign` (`work_order_item_id`),
  KEY `finished_good_items_warehouse_id_foreign` (`warehouse_id`),
  CONSTRAINT `finished_good_items_finished_good_id_foreign` FOREIGN KEY (`finished_good_id`) REFERENCES `finished_goods` (`id`),
  CONSTRAINT `finished_good_items_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`),
  CONSTRAINT `finished_good_items_work_order_item_id_foreign` FOREIGN KEY (`work_order_item_id`) REFERENCES `work_order_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_good_items` */

insert  into `finished_good_items`(`id`,`finished_good_id`,`work_order_item_id`,`warehouse_id`,`qty`,`created_at`,`updated_at`) values
(1,4,6,2,24,NULL,NULL),
(2,4,7,1,33,NULL,NULL),
(3,4,8,3,31,NULL,NULL),
(4,5,6,3,6,NULL,NULL),
(5,5,7,3,7,NULL,NULL),
(6,5,8,3,19,NULL,NULL),
(17,11,9,1,500,NULL,NULL),
(18,11,10,1,500,NULL,NULL),
(19,12,11,2,240,NULL,NULL),
(20,13,11,3,10,NULL,NULL),
(21,14,12,1,200,NULL,NULL);

/*Table structure for table `finished_goods` */

DROP TABLE IF EXISTS `finished_goods`;

CREATE TABLE `finished_goods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` bigint(20) unsigned NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `finished_goods_file` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finished_goods_created_by_foreign` (`created_by`),
  KEY `finished_goods_updated_by_foreign` (`updated_by`),
  KEY `work_order_id` (`work_order_id`),
  CONSTRAINT `finished_goods_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `finished_goods_ibfk_1` FOREIGN KEY (`work_order_id`) REFERENCES `work_orders` (`id`),
  CONSTRAINT `finished_goods_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_goods` */

insert  into `finished_goods`(`id`,`work_order_id`,`reference_no`,`received_date`,`remarks`,`finished_goods_file`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(4,1,'FG-GATE-IN-24-0001','2024-04-23','test',NULL,1,NULL,NULL,'2024-04-23 08:53:14','2024-04-23 08:53:14'),
(5,1,'FG-GATE-IN-24-0002','2024-04-23','Test 2','uploads/fg-files/583230424085457.png',1,1,NULL,'2024-04-23 08:54:57','2024-04-23 08:54:57'),
(11,2,'FG-GATE-IN-24-0003','2024-04-25',NULL,NULL,1,NULL,NULL,'2024-04-25 07:34:28','2024-04-25 07:34:28'),
(12,3,'FG-GATE-IN-24-0004','2024-04-27','remarks',NULL,1,NULL,NULL,'2024-04-27 06:11:53','2024-04-27 06:11:53'),
(13,3,'FG-GATE-IN-24-0005','2024-04-27',NULL,NULL,1,NULL,NULL,'2024-04-27 06:12:16','2024-04-27 06:12:16'),
(14,4,'FG-GATE-IN-24-0006','2024-04-30',NULL,NULL,1,NULL,NULL,'2024-04-30 06:03:31','2024-04-30 06:03:31');

/*Table structure for table `finished_goods_delivery` */

DROP TABLE IF EXISTS `finished_goods_delivery`;

CREATE TABLE `finished_goods_delivery` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` bigint(20) unsigned NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivered_date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finished_goods_delivery_work_order_id_foreign` (`work_order_id`),
  KEY `finished_goods_delivery_created_by_foreign` (`created_by`),
  KEY `finished_goods_delivery_updated_by_foreign` (`updated_by`),
  CONSTRAINT `finished_goods_delivery_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `finished_goods_delivery_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `finished_goods_delivery_work_order_id_foreign` FOREIGN KEY (`work_order_id`) REFERENCES `work_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_goods_delivery` */

insert  into `finished_goods_delivery`(`id`,`work_order_id`,`reference_no`,`delivered_date`,`remarks`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,1,'FGD-24-TRU-001','2024-04-25',NULL,1,NULL,NULL,'2024-04-25 11:22:20','2024-04-25 11:22:20'),
(2,3,'FGD-24-TRU-002','2024-04-27','Test',1,NULL,NULL,'2024-04-27 06:20:18','2024-04-27 06:20:18'),
(3,3,'FGD-24-TRU-003','2024-04-27','Test',1,NULL,NULL,'2024-04-27 06:21:24','2024-04-27 06:21:24'),
(4,4,'FGD-24-TRU-004','2024-04-30',NULL,1,NULL,NULL,'2024-04-30 06:17:44','2024-04-30 06:17:44');

/*Table structure for table `finished_goods_delivery_item_details` */

DROP TABLE IF EXISTS `finished_goods_delivery_item_details`;

CREATE TABLE `finished_goods_delivery_item_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finished_goods_delivery_item_id` bigint(20) unsigned NOT NULL,
  `finished_good_item_id` bigint(20) unsigned NOT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fgdi_id` (`finished_goods_delivery_item_id`),
  KEY `fgi_id` (`finished_good_item_id`),
  CONSTRAINT `fgdi_id` FOREIGN KEY (`finished_goods_delivery_item_id`) REFERENCES `finished_goods_delivery_items` (`id`),
  CONSTRAINT `fgi_id` FOREIGN KEY (`finished_good_item_id`) REFERENCES `finished_good_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_goods_delivery_item_details` */

insert  into `finished_goods_delivery_item_details`(`id`,`finished_goods_delivery_item_id`,`finished_good_item_id`,`qty`,`created_at`,`updated_at`) values
(1,1,1,19,'2024-04-25 11:22:20','2024-04-25 11:22:20'),
(2,1,4,6,'2024-04-25 11:22:20','2024-04-25 11:22:20'),
(3,2,2,20,'2024-04-25 11:22:21','2024-04-25 11:22:21'),
(4,2,5,7,'2024-04-25 11:22:21','2024-04-25 11:22:21'),
(5,3,3,25,'2024-04-25 11:22:21','2024-04-25 11:22:21'),
(6,3,6,19,'2024-04-25 11:22:21','2024-04-25 11:22:21'),
(7,4,19,200,'2024-04-27 06:20:19','2024-04-27 06:20:19'),
(8,4,20,0,'2024-04-27 06:20:19','2024-04-27 06:20:19'),
(9,5,19,40,'2024-04-27 06:21:24','2024-04-27 06:21:24'),
(10,5,20,10,'2024-04-27 06:21:24','2024-04-27 06:21:24'),
(11,6,21,200,'2024-04-30 06:17:44','2024-04-30 06:17:44');

/*Table structure for table `finished_goods_delivery_items` */

DROP TABLE IF EXISTS `finished_goods_delivery_items`;

CREATE TABLE `finished_goods_delivery_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finished_goods_delivery_id` bigint(20) unsigned NOT NULL,
  `work_order_item_id` bigint(20) unsigned NOT NULL,
  `delivery_qty` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fgd_id` (`finished_goods_delivery_id`),
  KEY `woi_id` (`work_order_item_id`),
  CONSTRAINT `fgd_id` FOREIGN KEY (`finished_goods_delivery_id`) REFERENCES `finished_goods_delivery` (`id`),
  CONSTRAINT `woi_id` FOREIGN KEY (`work_order_item_id`) REFERENCES `work_order_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_goods_delivery_items` */

insert  into `finished_goods_delivery_items`(`id`,`finished_goods_delivery_id`,`work_order_item_id`,`delivery_qty`,`created_at`,`updated_at`) values
(1,1,6,25,'2024-04-25 11:22:20','2024-04-25 11:22:20'),
(2,1,7,27,'2024-04-25 11:22:20','2024-04-25 11:22:20'),
(3,1,8,44,'2024-04-25 11:22:21','2024-04-25 11:22:21'),
(4,2,11,200,'2024-04-27 06:20:18','2024-04-27 06:20:18'),
(5,3,11,50,'2024-04-27 06:21:24','2024-04-27 06:21:24'),
(6,4,12,200,'2024-04-30 06:17:44','2024-04-30 06:17:44');

/*Table structure for table `finished_goods_docs` */

DROP TABLE IF EXISTS `finished_goods_docs`;

CREATE TABLE `finished_goods_docs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` bigint(20) unsigned NOT NULL,
  `bill_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  `accept_date` date DEFAULT NULL,
  `discrepancies_charge` double NOT NULL DEFAULT '0',
  `realized_value` double NOT NULL DEFAULT '0',
  `fg_files` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` enum('pending','processing','accepted','paid','halt') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `fgwoid` (`work_order_id`),
  KEY `finished_goods_docs_created_by_foreign` (`created_by`),
  KEY `finished_goods_docs_updated_by_foreign` (`updated_by`),
  CONSTRAINT `fgwoid` FOREIGN KEY (`work_order_id`) REFERENCES `work_orders` (`id`),
  CONSTRAINT `finished_goods_docs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `finished_goods_docs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_goods_docs` */

insert  into `finished_goods_docs`(`id`,`work_order_id`,`bill_no`,`submit_date`,`accept_date`,`discrepancies_charge`,`realized_value`,`fg_files`,`created_at`,`updated_at`,`created_by`,`updated_by`,`status`,`remarks`) values
(3,1,'BIll-001','2024-04-29',NULL,0,0,'uploads/billing-files/732280424111927.png','2024-04-28 11:19:27','2024-04-29 04:44:22',1,1,'processing','Test'),
(4,3,'BIll-002','2024-04-29',NULL,0,0,NULL,'2024-04-28 11:19:40','2024-04-29 04:44:08',1,1,'processing',NULL),
(5,3,'BIll-003','2024-04-29',NULL,0,0,NULL,'2024-04-28 11:19:49','2024-04-29 04:43:52',1,1,'processing','Test'),
(6,4,'BIll-001323','2024-04-30','2024-05-10',0,0,NULL,'2024-04-30 06:29:42','2024-04-30 06:30:30',1,1,'paid','Test');

/*Table structure for table `finished_goods_docs_delivery` */

DROP TABLE IF EXISTS `finished_goods_docs_delivery`;

CREATE TABLE `finished_goods_docs_delivery` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finished_goods_doc_id` bigint(20) unsigned NOT NULL,
  `finished_goods_delivery_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fgdocid` (`finished_goods_doc_id`),
  KEY `fgdId` (`finished_goods_delivery_id`),
  CONSTRAINT `fgdId` FOREIGN KEY (`finished_goods_delivery_id`) REFERENCES `finished_goods_delivery` (`id`),
  CONSTRAINT `fgdocid` FOREIGN KEY (`finished_goods_doc_id`) REFERENCES `finished_goods_docs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `finished_goods_docs_delivery` */

insert  into `finished_goods_docs_delivery`(`id`,`finished_goods_doc_id`,`finished_goods_delivery_id`,`created_at`,`updated_at`) values
(8,5,3,'2024-04-29 04:43:52','2024-04-29 04:43:52'),
(9,4,2,'2024-04-29 04:44:08','2024-04-29 04:44:08'),
(10,3,1,'2024-04-29 04:44:22','2024-04-29 04:44:22'),
(13,6,4,'2024-04-30 06:30:30','2024-04-30 06:30:30');

/*Table structure for table `grn_charges` */

DROP TABLE IF EXISTS `grn_charges`;

CREATE TABLE `grn_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grn_id` bigint(20) unsigned NOT NULL,
  `charge_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grn_charges_grn_id_foreign` (`grn_id`),
  KEY `grn_charges_charge_id_foreign` (`charge_id`),
  CONSTRAINT `grn_charges_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`),
  CONSTRAINT `grn_charges_grn_id_foreign` FOREIGN KEY (`grn_id`) REFERENCES `grns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grn_charges` */

insert  into `grn_charges`(`id`,`grn_id`,`charge_id`,`amount`,`created_at`,`updated_at`) values
(1,5,1,100,'2024-04-07 08:59:00',NULL),
(2,5,5,50,'2024-04-07 08:59:00','2024-04-07 09:03:46'),
(3,7,8,100,'2024-04-18 09:39:00',NULL),
(4,10,8,100,'2024-04-27 05:42:00',NULL),
(5,13,8,98,'2024-04-29 08:59:00',NULL);

/*Table structure for table `grn_items` */

DROP TABLE IF EXISTS `grn_items`;

CREATE TABLE `grn_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grn_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `qty` double NOT NULL DEFAULT '0',
  `sub_total_price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `discount_amount` double NOT NULL DEFAULT '0',
  `vat_type` enum('inclusive','exclusive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'exclusive',
  `vat` double NOT NULL DEFAULT '0',
  `vat_amount` double NOT NULL DEFAULT '0',
  `total_price` double NOT NULL DEFAULT '0',
  `quality_ensure` enum('pending','approved','return','replace') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `qc_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_qty` double NOT NULL DEFAULT '0',
  `expire_date` date DEFAULT NULL,
  `is_getout_complete` enum('no','yes') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grn_items_grn_id_foreign` (`grn_id`),
  KEY `grn_items_product_id_foreign` (`product_id`),
  CONSTRAINT `grn_items_grn_id_foreign` FOREIGN KEY (`grn_id`) REFERENCES `grns` (`id`),
  CONSTRAINT `grn_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grn_items` */

insert  into `grn_items`(`id`,`grn_id`,`product_id`,`unit_price`,`qty`,`sub_total_price`,`discount`,`discount_amount`,`vat_type`,`vat`,`vat_amount`,`total_price`,`quality_ensure`,`qc_reference`,`received_qty`,`expire_date`,`is_getout_complete`,`created_at`,`updated_at`) values
(1,1,6,120,5,600,0,0,'inclusive',0,0,120,'approved','QE-AP-24-1',5,'2024-04-04','no',NULL,'2024-04-04 08:25:55'),
(2,1,8,23,20,460,0,0,'inclusive',0,0,23,'approved','QE-AP-24-2',20,'2024-05-30','no',NULL,'2024-04-04 08:25:55'),
(3,3,6,120,3,360,0,0,'inclusive',0,0,120,'return','QE-RT-24-3',0,'2024-04-04','yes',NULL,'2024-04-04 09:29:16'),
(4,3,8,23,10,230,0,0,'inclusive',0,0,23,'replace','QE-RP-24-4',3,'2024-04-17','yes',NULL,'2024-04-04 09:29:09'),
(5,4,6,200,93,18600,0,0,'inclusive',0,0,200,'approved','QE-AP-24-5',93,'2024-04-04','no',NULL,'2024-04-04 08:28:38'),
(6,4,8,10,20,200,0,0,'inclusive',0,0,10,'approved','QE-AP-24-6',20,'2024-04-27','no',NULL,'2024-04-04 08:28:38'),
(7,5,6,200,7,1400,0,0,'inclusive',0,0,200,'replace','QE-RP-24-7',7,'2024-07-18','yes',NULL,'2024-04-18 09:41:57'),
(8,5,8,10,10,100,0,0,'inclusive',0,0,10,'return','QE-RT-24-8',6,'2024-04-30','yes',NULL,'2024-04-04 09:27:50'),
(10,7,6,200,4,800,0,0,'inclusive',0,0,800,'approved','QE-AP-24-10',4,'2024-04-18','no',NULL,'2024-04-18 09:40:09'),
(11,8,6,200,3,600,0,0,'inclusive',0,0,600,'approved','QE-AP-24-11',3,'2024-04-21','no',NULL,'2024-04-21 08:29:56'),
(12,9,9,12,10000,120000,0,0,'inclusive',0,0,12,'approved','QE-AP-24-12',10000,'2024-04-21','no',NULL,'2024-04-21 08:29:43'),
(13,9,7,15,9999,149985,0,0,'inclusive',0,0,15,'approved','QE-AP-24-13',9999,'2024-04-21','no',NULL,'2024-04-21 08:29:43'),
(14,9,8,120,1500,180000,0,0,'inclusive',0,0,120,'approved','QE-AP-24-14',1500,'2024-04-21','no',NULL,'2024-04-21 08:29:43'),
(15,9,6,12,9999,119988,0,0,'inclusive',0,0,12,'approved','QE-AP-24-15',9999,'2024-04-21','no',NULL,'2024-04-21 08:29:43'),
(16,10,6,23,1000,23000,0,0,'inclusive',0,0,23,'approved','QE-AP-24-16',1000,'2024-06-30','no',NULL,'2024-04-27 05:41:58'),
(17,11,6,23,400,9200,0,0,'inclusive',0,0,23,'replace','QE-RP-24-17',400,'2024-05-31','yes',NULL,'2024-04-27 05:45:44'),
(18,12,6,23,200,4600,0,0,'inclusive',0,0,4600,'approved','QE-AP-24-18',200,'2024-04-27','no',NULL,'2024-04-27 05:46:11'),
(19,13,8,0,15000,0,0,0,'inclusive',0,0,0,'approved','QE-AP-24-19',15000,'2024-06-30','no',NULL,'2024-04-27 06:06:54'),
(20,14,6,500,1000,500000,0,0,'inclusive',0,0,500,'approved','QE-AP-24-20',1000,'2024-06-30','no',NULL,'2024-04-30 05:06:32'),
(21,14,7,955,1200,1146000,0,0,'inclusive',0,0,955,'approved','QE-AP-24-21',1200,'2024-08-29','no',NULL,'2024-04-30 05:06:32');

/*Table structure for table `grns` */

DROP TABLE IF EXISTS `grns`;

CREATE TABLE `grns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proforma_invoice_id` bigint(20) unsigned NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `total_price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `vat` double NOT NULL DEFAULT '0',
  `gross_price` double NOT NULL DEFAULT '0',
  `status` enum('full','partial') COLLATE utf8mb4_unicode_ci DEFAULT 'full',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grns_proforma_invoice_id_foreign` (`proforma_invoice_id`),
  KEY `grns_created_by_foreign` (`created_by`),
  KEY `grns_updated_by_foreign` (`updated_by`),
  CONSTRAINT `grns_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `grns_proforma_invoice_id_foreign` FOREIGN KEY (`proforma_invoice_id`) REFERENCES `proforma_invoices` (`id`),
  CONSTRAINT `grns_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grns` */

insert  into `grns`(`id`,`proforma_invoice_id`,`reference_no`,`invoice_no`,`invoice_file`,`received_date`,`note`,`total_price`,`discount`,`vat`,`gross_price`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,2,'GATE-IN-24-00001','CH-00001',NULL,'2024-04-02','Test',1060,0,0,1060,'partial',1,1,NULL,'2024-04-02 06:44:14','2024-04-02 06:44:14'),
(3,2,'GATE-IN-24-00002','CH-00002','uploads/grn-invoice/360030424035448.png','2024-04-03','Test',590,0,0,590,'full',1,1,NULL,'2024-04-03 03:54:48','2024-04-03 03:54:49'),
(4,3,'GATE-IN-24-00003','CH-00003',NULL,'2024-04-03',NULL,18800,0,0,18800,'partial',1,1,NULL,'2024-04-03 05:39:49','2024-04-03 05:39:49'),
(5,3,'GATE-IN-24-00004','CH-00004',NULL,'2024-04-03',NULL,1500,0,0,1500,'full',1,1,NULL,'2024-04-03 05:40:16','2024-04-03 05:40:16'),
(7,3,'GATE-IN-24-00005','CH-00006','uploads/grn-invoice/35180424093826.png','2024-04-18','Replace item',1400,0,0,1400,'full',1,1,NULL,'2024-04-18 09:38:26','2024-04-18 09:38:26'),
(8,3,'GATE-IN-24-00006','CH-00007',NULL,'2024-04-18','tEST',600,0,0,600,'full',1,NULL,NULL,'2024-04-18 09:41:57','2024-04-18 09:41:57'),
(9,4,'GATE-IN-24-00007','CH-00008',NULL,'2024-04-21',NULL,569973,0,0,569973,'full',1,1,NULL,'2024-04-21 08:29:09','2024-04-21 08:29:09'),
(10,5,'GATE-IN-24-00008','CH-00003434',NULL,'2024-04-27','test',23000,0,0,23000,'partial',1,1,NULL,'2024-04-27 05:41:28','2024-04-27 05:41:28'),
(11,5,'GATE-IN-24-00009','CH-000014234',NULL,'2024-04-27',NULL,9200,0,0,9200,'full',1,1,NULL,'2024-04-27 05:43:33','2024-04-27 05:43:33'),
(12,5,'GATE-IN-24-00010','CH-0000153',NULL,'2024-04-27',NULL,4600,0,0,4600,'full',1,NULL,NULL,'2024-04-27 05:45:44','2024-04-27 05:45:44'),
(13,6,'GATE-IN-24-00011','erwer',NULL,'2024-04-27','test',0,0,0,0,'full',1,1,NULL,'2024-04-27 06:05:54','2024-04-27 06:05:54'),
(14,7,'GATE-IN-24-00012','2342232',NULL,'2024-04-30',NULL,1646000,0,0,1646000,'full',1,1,NULL,'2024-04-30 04:57:47','2024-04-30 04:57:47');

/*Table structure for table `gsm_ranges` */

DROP TABLE IF EXISTS `gsm_ranges`;

CREATE TABLE `gsm_ranges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `min_value` double NOT NULL DEFAULT '0',
  `max_value` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `gsm_ranges` */

insert  into `gsm_ranges`(`id`,`min_value`,`max_value`,`created_at`,`updated_at`) values
(1,50,100,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(2,101,120,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(3,121,140,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(4,141,160,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(5,161,180,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(6,181,200,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(7,201,220,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(8,221,240,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(9,241,260,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(10,261,280,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(11,281,300,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(12,301,320,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(13,321,340,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(14,341,360,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(15,361,380,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(16,381,400,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(17,401,420,'2024-04-30 00:00:00','2024-04-30 09:46:20'),
(18,421,440,'2024-04-30 00:00:00','2024-04-30 09:46:21'),
(19,441,460,'2024-04-30 00:00:00','2024-04-30 09:46:21'),
(20,461,380,'2024-04-30 00:00:00','2024-04-30 09:46:21'),
(21,481,500,'2024-04-30 00:00:00','2024-04-30 09:46:21');

/*Table structure for table `language_libraries` */

DROP TABLE IF EXISTS `language_libraries`;

CREATE TABLE `language_libraries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` bigint(20) unsigned NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_libraries_language_id_foreign` (`language_id`),
  KEY `language_libraries_created_by_foreign` (`created_by`),
  KEY `language_libraries_updated_by_foreign` (`updated_by`),
  CONSTRAINT `language_libraries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `language_libraries_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `language_libraries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `language_libraries` */

insert  into `language_libraries`(`id`,`language_id`,`slug`,`translation`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,1,'en','EN',1,NULL,NULL,'2024-03-20 09:41:31',NULL);

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'US',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `languages_created_by_foreign` (`created_by`),
  KEY `languages_updated_by_foreign` (`updated_by`),
  CONSTRAINT `languages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `languages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `languages` */

insert  into `languages`(`id`,`code`,`name`,`flag`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'en','English','US',1,1,NULL,'2024-01-23 04:54:39','2024-01-26 21:09:35'),
(2,'bn','Bangla','BD',1,1,NULL,'2024-03-20 04:07:08','2024-03-20 04:07:28');

/*Table structure for table `lc_charges` */

DROP TABLE IF EXISTS `lc_charges`;

CREATE TABLE `lc_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proforma_invoice_id` bigint(20) unsigned NOT NULL,
  `charge_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lc_charges_proforma_invoice_id_foreign` (`proforma_invoice_id`),
  KEY `lc_charges_charge_id_foreign` (`charge_id`),
  CONSTRAINT `lc_charges_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`),
  CONSTRAINT `lc_charges_proforma_invoice_id_foreign` FOREIGN KEY (`proforma_invoice_id`) REFERENCES `proforma_invoices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `lc_charges` */

insert  into `lc_charges`(`id`,`proforma_invoice_id`,`charge_id`,`amount`,`created_at`,`updated_at`) values
(3,3,7,30,'2024-04-07 06:58:00','2024-04-07 07:52:59'),
(4,3,2,100,'2024-04-07 07:55:00',NULL),
(5,3,1,30,'2024-04-07 07:55:00',NULL),
(6,2,1,100,'2024-04-07 07:58:00',NULL),
(7,2,2,30,'2024-04-07 07:58:00',NULL),
(8,4,8,1200,'2024-04-21 08:28:00',NULL),
(9,5,1,100,'2024-04-27 05:39:00',NULL),
(10,5,2,120,'2024-04-27 05:39:00',NULL),
(11,5,4,200,'2024-04-27 05:39:00',NULL),
(12,6,1,23.33,'2024-04-29 08:59:00',NULL),
(13,6,1,33.33,'2024-04-29 08:59:00',NULL);

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `notification_event_id` bigint(20) unsigned DEFAULT NULL,
  `log` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_receipt` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `read_by` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_notification_event_id_foreign` (`notification_event_id`),
  CONSTRAINT `logs_notification_event_id_foreign` FOREIGN KEY (`notification_event_id`) REFERENCES `notification_events` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `logs` */

insert  into `logs`(`id`,`notification_event_id`,`log`,`read_receipt`,`read_by`,`created_at`,`updated_at`) values
(1,57,'A new LC has been open. LC no: (LC-00565) Reference No: (LC-24-TRU-0006)','yes','[1]','2024-04-30 04:27:29','2024-04-30 07:17:26'),
(2,58,'Goods has been received. LC Reference No: () Chalan No: (2342232)','no','[1]','2024-04-30 04:57:47','2024-04-30 07:17:28'),
(3,59,'GRN Reference No (GATE-IN-24-00012) Product : Greige-Imported(Construction:10X10/44X38, Width:61\", Weave:Linen) Quality Ensure has been done successfully.','no',NULL,'2024-04-30 05:06:32','2024-04-30 06:59:16'),
(4,59,'GRN Reference No (GATE-IN-24-00012) Product : 10x16/64x62(Construction:10x16/64x62, Width:69\", Weave:3/1 Z Twill, GSM-01:100) Quality Ensure has been done successfully.','no',NULL,'2024-04-30 05:06:32',NULL),
(5,62,'Work Order No: (WO-24-TRU-0004) Export LC No : DEL-09983322. from :Laila Styles LTD has been received','no',NULL,'2024-04-30 05:21:05','2024-04-30 06:59:41'),
(6,63,'A new requisition (RQ-24-TRU-0007) has been submitted to store department for the export LC no : DEL-09983322 and product is (10-100) White Light Aop CW-B(GSM-01:100, Size:M, Color:(10-100) White Light Aop CW-B, Construction:10X10/44X38, Width:61\", Weave:Linen)','no','[3]','2024-04-30 05:33:07','2024-04-30 08:06:41'),
(7,71,'Products has been send to productions floor based on this requisitions (RQ-24-TRU-0007)','no','[1]','2024-04-30 05:44:26','2024-04-30 08:07:05'),
(8,64,'Products has been send to productions floor based on this requisitions (RQ-24-TRU-0007) and the delivery reference no is (CD-24-TRU-0013)','no',NULL,'2024-04-30 05:55:28',NULL),
(9,65,'Finished goods has been delivered to FG warehouse based on this work order no (WO-24-TRU-0004) and the Finished Goods reference no is (FG-GATE-IN-24-0006)','no',NULL,'2024-04-30 06:03:32',NULL),
(10,66,'Finished Goods inspection has been completed for the reference no of (FG-GATE-IN-24-0006)','no','[1,1]','2024-04-30 06:14:15','2024-04-30 08:34:24'),
(11,67,'Finished goods has been delivered successfully to the buyer. Reference no is (FGD-24-TRU-004)','no',NULL,'2024-04-30 06:17:44',NULL),
(12,68,'A Bill has been submitted based on the work order of (WO-24-TRU-0004) and the bill no is (BIll-001323)','no','[1,3]','2024-04-30 06:29:42','2024-04-30 07:57:02'),
(13,69,'A Bill has been accepted by buyer based on the work order of (WO-24-TRU-0004) and the bill no is (BIll-001323)','no','[1,3]','2024-04-30 06:30:12','2024-04-30 07:56:23'),
(14,70,'A Bill payment has been received from buyer based on the work order of (WO-24-TRU-0004) and the bill no is (BIll-001323)','no','[1,3,3]','2024-04-30 06:30:30','2024-04-30 07:56:53');

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` tinyint(3) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menu for admin',
  `open_new_tab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Open New Tab',
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_created_by_foreign` (`created_by`),
  KEY `menus_updated_by_foreign` (`updated_by`),
  CONSTRAINT `menus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`name_bn`,`url`,`icon_class`,`icon`,`big_icon`,`serial_num`,`status`,`slug`,`menu_for`,`open_new_tab`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Dashboard',NULL,'dashboard','uil-home-alt',NULL,NULL,1,'Active','[\"Dashboard\"]','Menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 00:27:14','2023-02-02 03:06:05'),
(2,'ACL',NULL,'#','mdi mdi-account-settings',NULL,NULL,2,'Active','[\"submenu-list\",\"menu-list\",\"user-list\",\"role-list\",\"permission-list\"]','Menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 00:48:23','2023-02-16 00:40:50'),
(11,'Settings',NULL,'#','ri-settings-3-fill',NULL,NULL,8,'Active','[\"settings-list\"]','Menu for admin','No Open New Tab',1,1,NULL,'2023-03-25 08:50:28','2023-03-25 08:51:49'),
(12,'IMS',NULL,'#','uil-globe',NULL,NULL,9,'Active','[\"customers\",\"suppliers\",\"charges\",\"warehouses\",\"units\",\"designations\",\"departments\"]','Menu for admin','No Open New Tab',1,1,NULL,'2024-01-21 05:56:35','2024-03-21 04:43:46'),
(13,'Language',NULL,'#','uil-globe',NULL,NULL,25,'Inactive','[\"language-library\",\"languages\"]','Menu for admin','No Open New Tab',1,1,NULL,'2024-01-23 04:10:16','2024-04-01 06:25:40'),
(14,'Plans',NULL,'admin/plans','ri-task-fill',NULL,NULL,11,'Active','[\"plan-delete\",\"plan-edit\",\"plan-create\",\"plans\"]','Menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:19','2024-01-23 04:30:37','2024-03-19 10:36:19'),
(15,'Subscribers',NULL,'admin/subscribers','uil-user-circle',NULL,NULL,12,'Active','[\"subscriber-approver\",\"subscriber-delete\",\"subscriber-edit\",\"subscriber-create\",\"subscribers\"]','Menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:15','2024-01-24 03:54:32','2024-03-19 10:36:15'),
(16,'Plan Payments',NULL,'admin/payments','uil-usd-square',NULL,NULL,13,'Active','[\"payment-delete\",\"payment-show\",\"payments\"]','Menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:10','2024-01-24 03:55:39','2024-03-19 10:36:10'),
(17,'Reports',NULL,'#','uil-file-bookmark-alt',NULL,NULL,14,'Active','[\"documents\",\"reports-generate\",\"reports\"]','Menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:05','2024-01-24 03:56:15','2024-03-19 10:36:05'),
(18,'Notifications',NULL,'admin/notifications','ri-notification-3-line noti-icon',NULL,NULL,24,'Active','[\"read-logs\",\"logs\"]','Menu for admin','No Open New Tab',1,1,NULL,'2024-01-31 15:27:30','2024-04-01 06:25:50'),
(19,'Products',NULL,'#','uil-package',NULL,NULL,10,'Active','[\"products\",\"groups\",\"categories\",\"attribute-options\",\"attributes\"]','Menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-22 06:08:30','2024-03-22 06:08:30'),
(20,'Commercial',NULL,'#','mdi mdi-import',NULL,NULL,11,'Active','[\"proforma-invoices\"]','Menu for admin','No Open New Tab',1,1,NULL,'2024-03-28 04:13:52','2024-03-28 04:15:14'),
(21,'Factory',NULL,'#','mdi mdi-factory',NULL,NULL,12,'Active','[\"grn-charges\",\"grn-quality-ensure\",\"good-received-note-gate-out\",\"good-received-note-gate-in\",\"good-received-note\"]','Menu for admin','No Open New Tab',1,1,NULL,'2024-04-01 05:53:08','2024-04-01 05:55:10'),
(22,'Stock Inventory',NULL,'#','mdi mdi-store',NULL,NULL,13,'Active','[\"inventory-expire-list\",\"inventory-delivery\",\"inventory\"]','Menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-01 06:09:39','2024-04-01 06:09:39'),
(23,'Productions',NULL,'#','mdi mdi-washing-machine',NULL,NULL,14,'Active','[\"material-requisitions\",\"work-orders\"]','Menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-01 06:28:54','2024-04-01 06:28:54'),
(24,'Finished Goods',NULL,'#','mdi mdi-format-list-checks',NULL,NULL,15,'Active','[\"finished-good-delivery\",\"finised-good-wip-list\",\"finished-good-reject-list\",\"finished-good-fresh-list\",\"finished-good-inspection\",\"finished-good-received\",\"finished-good-inventory-list\",\"finished-goods\"]','Menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-01 06:36:52','2024-04-01 06:36:52'),
(25,'Billing & Finance',NULL,'#','mdi mdi-file-pdf-box',NULL,NULL,16,'Active','[\"wo-bill-approved-list\",\"wo-bill-submit\",\"billings\"]','Menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-01 06:38:09','2024-04-01 06:38:09');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2020_11_24_022623_create_menus_table',1),
(6,'2020_11_24_031938_create_sub_menus_table',1),
(7,'2020_11_24_032345_create_sub_sub_menus_table',1),
(8,'2022_12_18_153538_user_column_visibilities',1),
(9,'2022_12_18_153539_create_permission_tables',2),
(10,'2022_12_25_132445_add_module_to_permissions',2),
(11,'2023_02_02_034707_add_soft_delete_to_table',2),
(12,'2023_03_23_192825_add_type_column_in_users',2),
(13,'2023_06_05_085004_create_settings_website_table',2),
(14,'2023_06_05_085031_create_settings_social_media_table',2),
(15,'2023_06_05_085047_create_settings_wallet_table',2),
(16,'2023_06_05_085145_create_settings_mail_table',2),
(17,'2023_06_05_155801_add_two_column_in_settings_website',2),
(18,'2024_01_18_093516_create_activity_log_table',2),
(19,'2024_01_18_093517_add_event_column_to_activity_log_table',2),
(20,'2024_01_18_093518_add_batch_uuid_column_to_activity_log_table',2),
(21,'2024_01_18_103116_add_column_roles_table',2),
(22,'2024_01_20_180108_create_services_table',3),
(23,'2024_01_20_180122_create_document_types_table',4),
(24,'2024_01_21_033756_languages',5),
(25,'2024_01_21_033805_language_libraries',5),
(26,'2024_01_21_033903_plans',6),
(27,'2024_01_21_033908_plan_services',6),
(28,'2024_01_21_034023_business_information',7),
(29,'2024_01_21_034148_subscriptions',7),
(30,'2024_01_21_042528_subscription_plan_services',7),
(31,'2024_01_21_042538_subscription_additional_services',7),
(32,'2024_01_21_042549_subscription_payments',7),
(37,'2024_01_21_034452_report_requests',8),
(38,'2024_01_21_034459_report_request_documents',8),
(39,'2024_01_21_034509_reports',8),
(40,'2024_01_21_034517_report_documents',8),
(41,'2024_01_23_160921_add_column_settings_website_table',9),
(42,'2024_01_26_055524_wesite_multiple_language',10),
(43,'2024_01_26_055557_cms_multiple_language',11),
(44,'2024_01_26_055630_plan_multiple_language',12),
(45,'2024_01_26_091208_add_flag_to_language',13),
(46,'2024_01_27_084952_add_plan_features_in_website_settings',14),
(47,'2024_01_27_100058_add_service_agreement_in_website_settings',15),
(48,'2024_01_28_102014_add_timeline',16),
(49,'2024_01_28_171327_remove_doc_type_form_report_doc',17),
(50,'2024_01_30_152054_logs',18),
(51,'2024_01_30_154125_update_wallet',19),
(52,'2024_01_31_031850_add_read_in_log_table',20),
(53,'2024_02_05_154803_add_year_month_to_report',21),
(54,'2024_02_05_161925_add_options_to_website',22),
(55,'2024_02_05_162450_update_business_info',23),
(56,'2024_02_06_174556_plan_document_types',24),
(57,'2024_02_07_140114_add_type_to_services',25),
(59,'2024_02_11_140633_update_report',26),
(60,'2024_02_11_180543_add_membership_email',27),
(61,'2024_02_14_105953_salespersons',28),
(62,'2024_02_14_110019_add_salesperson_to_business_info',29),
(63,'2024_02_14_153438_agreement_email',30),
(64,'2024_02_15_154410_update_additional_services',31),
(65,'2024_03_06_061425_add_note_at_business_information_table',32),
(66,'2024_03_20_041526_create_departments_table',33),
(67,'2024_03_20_041543_create_designations_table',33),
(68,'2024_03_20_041715_create_units_table',33),
(69,'2024_03_20_041728_create_charges_table',33),
(70,'2024_03_20_041756_create_warehouses_table',33),
(71,'2024_03_20_041853_create_suppliers_table',33),
(72,'2024_03_20_041902_create_customers_table',33),
(73,'2024_03_20_043648_create_attributes_table',34),
(74,'2024_03_20_043657_create_attribute_options_table',34),
(75,'2024_03_20_043909_create_categories_table',34),
(76,'2024_03_20_043945_create_categories_departments_table',34),
(77,'2024_03_20_043954_create_categories_attributes_table',34),
(78,'2024_03_20_044242_create_products_table',35),
(79,'2024_03_20_044252_create_product_attributes_table',35),
(80,'2024_03_20_050815_create_product_groups_table',36),
(81,'2024_03_20_050846_add_columns_in_products_table',36),
(82,'2024_03_22_052322_create_product_suppliers_table',37),
(83,'2024_03_27_064259_create_proforma_invoices_table',38),
(84,'2024_03_27_064312_create_proforma_invoice_items_table',38),
(85,'2024_03_27_064342_create_grns_table',38),
(86,'2024_03_27_064350_create_grn_items_table',38),
(87,'2024_03_27_075524_create_stock_inventory_table',39),
(88,'2024_03_27_082907_create_work_orders_table',40),
(89,'2024_03_27_082914_create_work_order_items_table',40),
(90,'2024_03_27_083010_create_requisitions_table',40),
(91,'2024_03_27_083017_create_requisition_items_table',40),
(92,'2024_03_27_083424_create_requisition_delivery_table',41),
(93,'2024_03_27_084514_create_grn_charges_table',41),
(94,'2024_03_28_110156_create_work_order_item_charges_table',41),
(98,'2024_04_04_063420_add_column_in_grn_items_table',42),
(99,'2024_04_06_081211_create_lc_charges_table',43),
(100,'2024_04_17_095458_add_status_at_work_orders_table',44),
(101,'2024_04_18_042229_add_status_at_requisition_table',45),
(102,'2024_04_21_053441_create_requisition_delivery_items_table',46),
(103,'2024_04_21_090629_add_delivery_status_table',47),
(104,'2024_03_28_110748_create_finished_goods_table',48),
(105,'2024_03_28_111455_create_finished_goods_docs_table',49),
(106,'2024_04_23_043439_create_finished_good_items_table',50),
(108,'2024_04_24_111018_create_finished_goods_delivery_table',51),
(109,'2024_04_25_040250_create_finished_goods_delivery_items_table',52),
(110,'2024_04_27_043827_add_finished_good_delivery_id',53),
(111,'2024_04_27_103538_add_is_finished_goods_table',54),
(112,'2024_04_28_043546_create_pre_costings_table',55),
(113,'2024_04_28_091602_create_finished_good_docs_delivery',56),
(114,'2024_04_29_034858_add_column_in_finishedgooddocs',57),
(115,'2024_04_29_053459_add_column_users_table',58),
(116,'2024_04_29_053524_create_notitfication_events_table',58),
(117,'2024_04_29_053538_create_user_departments_table',58),
(118,'2024_04_29_053550_create_user_notification_events_table',58),
(119,'2024_04_29_053656_add_column_in_logs_table',58),
(120,'2024_04_30_083904_create_process_table',59),
(121,'2024_04_30_083919_create_gsm_ranges_table',59),
(122,'2024_04_30_101021_create_costing_charts_table',60);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

insert  into `model_has_permissions`(`permission_id`,`model_type`,`model_id`) values
(2,'App\\Models\\User',1),
(3,'App\\Models\\User',1),
(4,'App\\Models\\User',1),
(5,'App\\Models\\User',1),
(6,'App\\Models\\User',1),
(7,'App\\Models\\User',1),
(8,'App\\Models\\User',1),
(9,'App\\Models\\User',1),
(10,'App\\Models\\User',1),
(11,'App\\Models\\User',1),
(12,'App\\Models\\User',1),
(13,'App\\Models\\User',1),
(14,'App\\Models\\User',1),
(15,'App\\Models\\User',1),
(16,'App\\Models\\User',1),
(17,'App\\Models\\User',1),
(18,'App\\Models\\User',1),
(19,'App\\Models\\User',1),
(20,'App\\Models\\User',1),
(21,'App\\Models\\User',1),
(22,'App\\Models\\User',1),
(23,'App\\Models\\User',1),
(24,'App\\Models\\User',1),
(25,'App\\Models\\User',1),
(26,'App\\Models\\User',1),
(27,'App\\Models\\User',1),
(28,'App\\Models\\User',1),
(29,'App\\Models\\User',1),
(30,'App\\Models\\User',1),
(35,'App\\Models\\User',1),
(36,'App\\Models\\User',1),
(37,'App\\Models\\User',1),
(38,'App\\Models\\User',1),
(39,'App\\Models\\User',1),
(40,'App\\Models\\User',1),
(41,'App\\Models\\User',1),
(42,'App\\Models\\User',1),
(57,'App\\Models\\User',1),
(58,'App\\Models\\User',1),
(59,'App\\Models\\User',1),
(60,'App\\Models\\User',1),
(61,'App\\Models\\User',1),
(62,'App\\Models\\User',1),
(63,'App\\Models\\User',1),
(64,'App\\Models\\User',1),
(65,'App\\Models\\User',1),
(66,'App\\Models\\User',1),
(67,'App\\Models\\User',1),
(68,'App\\Models\\User',1),
(69,'App\\Models\\User',1),
(70,'App\\Models\\User',1),
(71,'App\\Models\\User',1),
(72,'App\\Models\\User',1),
(73,'App\\Models\\User',1),
(74,'App\\Models\\User',1),
(75,'App\\Models\\User',1),
(76,'App\\Models\\User',1),
(77,'App\\Models\\User',1),
(78,'App\\Models\\User',1),
(79,'App\\Models\\User',1),
(80,'App\\Models\\User',1),
(81,'App\\Models\\User',1),
(82,'App\\Models\\User',1),
(83,'App\\Models\\User',1),
(84,'App\\Models\\User',1),
(85,'App\\Models\\User',1),
(86,'App\\Models\\User',1),
(87,'App\\Models\\User',1),
(88,'App\\Models\\User',1),
(89,'App\\Models\\User',1),
(90,'App\\Models\\User',1),
(91,'App\\Models\\User',1),
(92,'App\\Models\\User',1),
(93,'App\\Models\\User',1),
(94,'App\\Models\\User',1),
(95,'App\\Models\\User',1),
(96,'App\\Models\\User',1),
(97,'App\\Models\\User',1),
(98,'App\\Models\\User',1),
(99,'App\\Models\\User',1),
(100,'App\\Models\\User',1),
(101,'App\\Models\\User',1),
(102,'App\\Models\\User',1),
(103,'App\\Models\\User',1),
(104,'App\\Models\\User',1),
(105,'App\\Models\\User',1),
(106,'App\\Models\\User',1),
(107,'App\\Models\\User',1),
(108,'App\\Models\\User',1),
(109,'App\\Models\\User',1),
(110,'App\\Models\\User',1),
(111,'App\\Models\\User',1),
(112,'App\\Models\\User',1),
(113,'App\\Models\\User',1),
(114,'App\\Models\\User',1),
(115,'App\\Models\\User',1),
(116,'App\\Models\\User',1),
(117,'App\\Models\\User',1),
(118,'App\\Models\\User',1),
(119,'App\\Models\\User',1),
(120,'App\\Models\\User',1),
(121,'App\\Models\\User',1),
(122,'App\\Models\\User',1),
(123,'App\\Models\\User',1),
(124,'App\\Models\\User',1),
(125,'App\\Models\\User',1),
(126,'App\\Models\\User',1),
(127,'App\\Models\\User',1),
(128,'App\\Models\\User',1),
(129,'App\\Models\\User',1),
(130,'App\\Models\\User',1),
(131,'App\\Models\\User',1),
(132,'App\\Models\\User',1),
(133,'App\\Models\\User',1),
(134,'App\\Models\\User',1),
(135,'App\\Models\\User',1),
(136,'App\\Models\\User',1),
(137,'App\\Models\\User',1),
(138,'App\\Models\\User',1),
(139,'App\\Models\\User',1),
(140,'App\\Models\\User',1),
(141,'App\\Models\\User',1),
(142,'App\\Models\\User',1),
(143,'App\\Models\\User',1),
(144,'App\\Models\\User',1),
(145,'App\\Models\\User',1),
(146,'App\\Models\\User',1),
(147,'App\\Models\\User',1),
(148,'App\\Models\\User',1),
(149,'App\\Models\\User',1),
(150,'App\\Models\\User',1),
(151,'App\\Models\\User',1),
(152,'App\\Models\\User',1),
(153,'App\\Models\\User',1),
(154,'App\\Models\\User',1),
(155,'App\\Models\\User',1),
(156,'App\\Models\\User',1),
(157,'App\\Models\\User',1),
(158,'App\\Models\\User',1),
(159,'App\\Models\\User',1),
(160,'App\\Models\\User',1),
(161,'App\\Models\\User',1),
(162,'App\\Models\\User',1),
(163,'App\\Models\\User',1),
(164,'App\\Models\\User',1),
(165,'App\\Models\\User',1),
(22,'App\\Models\\User',2),
(35,'App\\Models\\User',2),
(36,'App\\Models\\User',2),
(37,'App\\Models\\User',2),
(38,'App\\Models\\User',2),
(39,'App\\Models\\User',2),
(40,'App\\Models\\User',2),
(41,'App\\Models\\User',2),
(42,'App\\Models\\User',2),
(57,'App\\Models\\User',2),
(58,'App\\Models\\User',2),
(59,'App\\Models\\User',2),
(60,'App\\Models\\User',2),
(61,'App\\Models\\User',2),
(62,'App\\Models\\User',2),
(63,'App\\Models\\User',2),
(64,'App\\Models\\User',2),
(65,'App\\Models\\User',2),
(66,'App\\Models\\User',2),
(67,'App\\Models\\User',2),
(68,'App\\Models\\User',2),
(69,'App\\Models\\User',2),
(70,'App\\Models\\User',2),
(71,'App\\Models\\User',2),
(72,'App\\Models\\User',2),
(73,'App\\Models\\User',2),
(74,'App\\Models\\User',2),
(75,'App\\Models\\User',2),
(76,'App\\Models\\User',2),
(77,'App\\Models\\User',2),
(78,'App\\Models\\User',2),
(79,'App\\Models\\User',2),
(80,'App\\Models\\User',2),
(81,'App\\Models\\User',2),
(82,'App\\Models\\User',2),
(83,'App\\Models\\User',2),
(84,'App\\Models\\User',2),
(85,'App\\Models\\User',2),
(86,'App\\Models\\User',2),
(22,'App\\Models\\User',3),
(35,'App\\Models\\User',3),
(36,'App\\Models\\User',3),
(37,'App\\Models\\User',3),
(38,'App\\Models\\User',3),
(39,'App\\Models\\User',3),
(40,'App\\Models\\User',3),
(41,'App\\Models\\User',3),
(42,'App\\Models\\User',3),
(57,'App\\Models\\User',3),
(58,'App\\Models\\User',3),
(59,'App\\Models\\User',3),
(60,'App\\Models\\User',3),
(61,'App\\Models\\User',3),
(62,'App\\Models\\User',3),
(63,'App\\Models\\User',3),
(64,'App\\Models\\User',3),
(65,'App\\Models\\User',3),
(66,'App\\Models\\User',3),
(67,'App\\Models\\User',3),
(68,'App\\Models\\User',3),
(69,'App\\Models\\User',3),
(70,'App\\Models\\User',3),
(71,'App\\Models\\User',3),
(72,'App\\Models\\User',3),
(73,'App\\Models\\User',3),
(74,'App\\Models\\User',3),
(75,'App\\Models\\User',3),
(76,'App\\Models\\User',3),
(77,'App\\Models\\User',3),
(78,'App\\Models\\User',3),
(79,'App\\Models\\User',3),
(80,'App\\Models\\User',3),
(81,'App\\Models\\User',3),
(82,'App\\Models\\User',3),
(83,'App\\Models\\User',3),
(84,'App\\Models\\User',3),
(85,'App\\Models\\User',3),
(86,'App\\Models\\User',3),
(87,'App\\Models\\User',3),
(88,'App\\Models\\User',3),
(89,'App\\Models\\User',3),
(90,'App\\Models\\User',3),
(91,'App\\Models\\User',3),
(92,'App\\Models\\User',3),
(93,'App\\Models\\User',3),
(94,'App\\Models\\User',3),
(95,'App\\Models\\User',3),
(96,'App\\Models\\User',3),
(97,'App\\Models\\User',3),
(98,'App\\Models\\User',3),
(99,'App\\Models\\User',3),
(100,'App\\Models\\User',3),
(101,'App\\Models\\User',3),
(102,'App\\Models\\User',3),
(103,'App\\Models\\User',3),
(104,'App\\Models\\User',3),
(105,'App\\Models\\User',3),
(106,'App\\Models\\User',3),
(107,'App\\Models\\User',3),
(108,'App\\Models\\User',3),
(109,'App\\Models\\User',3),
(110,'App\\Models\\User',3);

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values
(1,'App\\Models\\User',1),
(4,'App\\Models\\User',2),
(4,'App\\Models\\User',3),
(4,'App\\Models\\User',4);

/*Table structure for table `notification_events` */

DROP TABLE IF EXISTS `notification_events`;

CREATE TABLE `notification_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_events_created_by_foreign` (`created_by`),
  KEY `notification_events_updated_by_foreign` (`updated_by`),
  CONSTRAINT `notification_events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `notification_events_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `notification_events` */

insert  into `notification_events`(`id`,`name`,`slug`,`description`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(57,'Lc Open','lc-open','',NULL,NULL,NULL,'2024-04-29 06:43:22','2024-04-29 06:43:22'),
(58,'LC Goods Received','lc-goods-received','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(59,'LC Goods Quality Control','lc-goods-quality-control','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(60,'LC QC Goods Gate Out','lc-qc-goods-gate-out','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(61,'Stock In','stock-in','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(62,'Work Order Received','work-order-received','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(63,'Requisition Generated','requisition-generated','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(64,'Goods Delivery to Production','goods-delivery-to-production','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(65,'Goods Delivered Productions to FG','goods-delivered-productions-to-fg','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(66,'FG Inspections','fg-inspections','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(67,'Finished Goods Delivery','finished-goods-delivery','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(68,'Bill Submit','bill-submit','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(69,'Bill Accept','bill-accept','',NULL,NULL,NULL,'2024-04-29 06:43:23','2024-04-29 06:43:23'),
(70,'Bill Received','bill-received','',NULL,NULL,NULL,'2024-04-29 06:43:24','2024-04-29 06:43:24'),
(71,'Requisition Send to store','requisition-send-to-store','Test',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`module`,`created_at`,`updated_at`) values
(2,'permission-create','web','ACL','2023-01-31 09:37:24','2023-01-31 09:37:24'),
(3,'permission-edit','web','ACL','2023-01-31 09:37:24','2023-01-31 09:37:24'),
(4,'permission-delete','web','ACL','2023-01-31 09:37:24','2023-01-31 09:37:24'),
(5,'permission-list','web','ACL','2023-01-31 10:04:40','2023-01-31 10:04:40'),
(6,'role-list','web','ACL','2023-01-31 10:06:18','2023-01-31 10:06:18'),
(7,'role-create','web','ACL','2023-01-31 10:06:18','2023-01-31 10:06:18'),
(8,'role-edit','web','ACL','2023-01-31 10:06:18','2023-01-31 10:06:18'),
(9,'role-delete','web','ACL','2023-01-31 10:06:18','2023-01-31 10:06:18'),
(10,'user-list','web','Users','2023-01-31 10:06:41','2023-01-31 10:06:41'),
(11,'user-create','web','Users','2023-01-31 10:06:41','2023-01-31 10:06:41'),
(12,'user-edit','web','Users','2023-01-31 10:06:41','2023-01-31 10:06:41'),
(13,'user-delete','web','Users','2023-01-31 10:06:41','2023-01-31 10:06:41'),
(14,'menu-list','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(15,'menu-edit','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(16,'menu-create','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(17,'menu-delete','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(18,'submenu-list','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(19,'submenu-create','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(20,'submenu-edit','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(21,'submenu-delete','web','Menu','2023-01-31 10:07:56','2023-01-31 10:07:56'),
(22,'Dashboard','web','Dashboard','2023-02-02 00:35:11','2023-02-02 00:35:11'),
(23,'settings-list','web','Settings','2024-01-19 06:31:40','2024-01-19 06:31:40'),
(24,'settings-create','web','Settings','2024-01-19 06:31:40','2024-01-19 06:31:40'),
(25,'settings-edit','web','Settings','2024-01-19 06:31:40','2024-01-19 06:31:40'),
(26,'settings-delete','web','Settings','2024-01-19 06:31:40','2024-01-19 06:31:40'),
(27,'services','web','CMS','2024-01-21 05:52:03','2024-01-21 05:52:03'),
(28,'service-create','web','CMS','2024-01-21 05:52:03','2024-01-21 05:52:03'),
(29,'service-edit','web','CMS','2024-01-21 05:52:03','2024-01-21 05:52:03'),
(30,'service-delete','web','CMS','2024-01-21 05:52:03','2024-01-21 05:52:03'),
(35,'languages','web','Language','2024-01-23 04:15:22','2024-01-23 04:15:22'),
(36,'language-create','web','Language','2024-01-23 04:15:24','2024-01-23 04:15:24'),
(37,'language-edit','web','Language','2024-01-23 04:15:24','2024-01-23 04:15:24'),
(38,'language-delete','web','Language','2024-01-23 04:15:24','2024-01-23 04:15:24'),
(39,'language-library','web','Language','2024-01-23 04:16:19','2024-01-23 04:16:19'),
(40,'language-library-create','web','Language','2024-01-23 04:16:21','2024-01-23 04:16:21'),
(41,'language-library-edit','web','Language','2024-01-23 04:16:21','2024-01-23 04:16:21'),
(42,'language-library-delete','web','Language','2024-01-23 04:16:21','2024-01-23 04:16:21'),
(57,'logs','web','Logs','2024-01-31 15:22:59','2024-01-31 15:22:59'),
(58,'read-logs','web','Logs','2024-01-31 15:22:59','2024-01-31 15:22:59'),
(59,'departments','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(60,'department-create','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(61,'department-edit','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(62,'department-delete','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(63,'designations','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(64,'designation-create','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(65,'designation-edit','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(66,'designation-delete','web','IMS','2024-03-21 04:01:09','2024-03-21 04:01:09'),
(67,'units','web','IMS','2024-03-21 04:01:53','2024-03-21 04:01:53'),
(68,'unit-create','web','IMS','2024-03-21 04:01:53','2024-03-21 04:01:53'),
(69,'unit-edit','web','IMS','2024-03-21 04:01:53','2024-03-21 04:01:53'),
(70,'unit-delete','web','IMS','2024-03-21 04:01:53','2024-03-21 04:01:53'),
(71,'warehouses','web','IMS','2024-03-21 04:01:54','2024-03-21 04:01:54'),
(72,'warehouse-create','web','IMS','2024-03-21 04:01:54','2024-03-21 04:01:54'),
(73,'warehouse-edit','web','IMS','2024-03-21 04:01:54','2024-03-21 04:01:54'),
(74,'warehouse-delete','web','IMS','2024-03-21 04:01:54','2024-03-21 04:01:54'),
(75,'charges','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(76,'charge-create','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(77,'charge-edit','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(78,'charge-delete','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(79,'suppliers','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(80,'supplier-create','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(81,'supplier-edit','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(82,'supplier-delete','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(83,'customers','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(84,'customer-create','web','IMS','2024-03-21 04:03:13','2024-03-21 04:03:13'),
(85,'customer-edit','web','IMS','2024-03-21 04:03:14','2024-03-21 04:03:14'),
(86,'customer-delete','web','IMS','2024-03-21 04:03:14','2024-03-21 04:03:14'),
(87,'attributes','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(88,'attribute-create','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(89,'attribute-edit','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(90,'attribute-delete','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(91,'attribute-options','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(92,'attribute-option-create','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(93,'attribute-option-edit','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(94,'attribute-option-delete','web','Products','2024-03-22 06:04:40','2024-03-22 06:04:40'),
(95,'categories','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(96,'category-create','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(97,'category-edit','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(98,'category-delete','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(99,'groups','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(100,'group-create','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(101,'group-edit','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(102,'group-delete','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(103,'products','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(104,'product-create','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(105,'product-edit','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(106,'product-delete','web','Products','2024-03-22 06:06:03','2024-03-22 06:06:03'),
(107,'proforma-invoices','web','Import Goods','2024-03-28 04:09:17','2024-03-28 04:09:17'),
(108,'proforma-invoice-create','web','Import Goods','2024-03-28 04:09:17','2024-03-28 04:09:17'),
(109,'proforma-invoice-edit','web','Import Goods','2024-03-28 04:09:17','2024-03-28 04:09:17'),
(110,'proforma-invoice-delete','web','Import Goods','2024-03-28 04:09:17','2024-03-28 04:09:17'),
(111,'good-received-note','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(112,'good-received-note-gate-in','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(113,'good-received-note-gate-out','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(114,'good-received-note-create','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(115,'gate-received-note-edit','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(116,'gate-received-note-delete','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(117,'grn-quality-ensure','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(118,'grn-charges','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(119,'grn-charge-create','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(120,'grn-charge-delete','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(121,'grn-charge-edit','web','Factory','2024-04-01 05:37:15','2024-04-01 05:37:15'),
(122,'inventory','web','Factory','2024-04-01 05:39:15','2024-04-01 05:39:15'),
(123,'inventory-show','web','Factory','2024-04-01 05:39:15','2024-04-01 05:39:15'),
(124,'inventory-delivery','web','Factory','2024-04-01 05:39:17','2024-04-01 05:39:17'),
(125,'inventory-expire-list','web','Factory','2024-04-01 05:39:17','2024-04-01 05:39:25'),
(126,'work-orders','web','Productions','2024-04-01 06:14:33','2024-04-01 06:14:33'),
(127,'work-order-create','web','Productions','2024-04-01 06:14:33','2024-04-01 06:14:33'),
(128,'work-order-edit','web','Productions','2024-04-01 06:14:33','2024-04-01 06:14:33'),
(129,'work-order-delete','web','Productions','2024-04-01 06:14:33','2024-04-01 06:14:33'),
(130,'material-requisitions','web','Productions','2024-04-01 06:14:33','2024-04-01 06:14:33'),
(131,'material-requisition-create','web','Productions','2024-04-01 06:14:33','2024-04-01 06:14:33'),
(132,'material-requisition-edit','web','Productions','2024-04-01 06:14:33','2024-04-01 06:14:33'),
(133,'material-requisition-delete','web','Productions','2024-04-01 06:14:33','2024-04-01 06:14:33'),
(134,'finished-goods','web','Finished Goods','2024-04-01 06:16:59','2024-04-01 06:16:59'),
(135,'finished-good-inventory-list','web','Finished Goods','2024-04-01 06:16:59','2024-04-01 06:16:59'),
(136,'finished-good-received','web','Finished Goods','2024-04-01 06:16:59','2024-04-01 06:16:59'),
(137,'finished-good-inspection','web','Finished Goods','2024-04-01 06:16:59','2024-04-01 06:16:59'),
(138,'finished-good-fresh-list','web','Finished Goods','2024-04-01 06:16:59','2024-04-01 06:16:59'),
(139,'finished-good-reject-list','web','Finished Goods','2024-04-01 06:16:59','2024-04-01 06:16:59'),
(140,'finised-good-wip-list','web','Finished Goods','2024-04-01 06:16:59','2024-04-01 06:16:59'),
(141,'finished-good-delivery','web','Finished Goods','2024-04-01 06:16:59','2024-04-01 06:16:59'),
(142,'billings','web','Billing & Finance','2024-04-01 06:20:34','2024-04-01 06:20:34'),
(143,'wo-bill-submit','web','Billing & Finance','2024-04-01 06:20:34','2024-04-01 06:20:34'),
(144,'wo-bill-approved-list','web','Billing & Finance','2024-04-01 06:20:34','2024-04-01 06:20:34'),
(145,'bank-realization','web','Billing & Finance','2024-04-01 06:20:34','2024-04-01 06:20:34'),
(146,'raw-material-stock-inventory-report','web','Reports','2024-04-01 06:24:12','2024-04-01 06:24:12'),
(147,'aging-report','web','Reports','2024-04-01 06:24:12','2024-04-01 06:24:12'),
(148,'wip-goods-report','web','Reports','2024-04-01 06:24:12','2024-04-01 06:24:12'),
(149,'profit-and-loss-report','web','Reports','2024-04-01 06:24:12','2024-04-01 06:24:12'),
(150,'expire-inventory-report','web','Reports','2024-04-01 06:24:12','2024-04-01 06:24:12'),
(151,'bank-realization-report','web','Reports','2024-04-01 06:24:12','2024-04-01 06:24:12'),
(152,'lc-charges','web','Factory','2024-04-07 05:57:06','2024-04-07 05:57:06'),
(153,'lc-charge-create','web','Factory','2024-04-07 05:57:06','2024-04-07 05:57:06'),
(154,'lc-charge-edit','web','Factory','2024-04-07 05:57:06','2024-04-07 05:57:06'),
(155,'lc-charge-delete','web','Factory','2024-04-07 05:57:06','2024-04-07 05:57:06'),
(156,'request-requisition-lists','web','Store Inventory','2024-04-21 04:00:42','2024-04-21 04:00:49'),
(157,'requisition-delivery','web','Store Inventory','2024-04-21 04:00:42','2024-04-21 04:00:42'),
(158,'delivered-requisition-lists','web','Store Inventory','2024-04-21 04:00:42','2024-04-21 04:00:42'),
(159,'productions','web','Productions','2024-04-22 05:34:27','2024-04-22 05:34:27'),
(160,'production-charges','web','Productions','2024-04-22 05:34:27','2024-04-22 05:34:27'),
(161,'production-charge-create','web','Productions','2024-04-22 05:34:27','2024-04-22 05:34:27'),
(162,'production-charge-edit','web','Productions','2024-04-22 05:34:27','2024-04-22 05:34:27'),
(163,'production-delete','web','Productions','2024-04-22 05:34:28','2024-04-22 05:34:28'),
(164,'production-qc','web','Productions','2024-04-22 05:34:28','2024-04-22 05:34:28'),
(165,'production-qc-list','web','Productions','2024-04-22 05:34:28','2024-04-22 05:34:28');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `pre_costings` */

DROP TABLE IF EXISTS `pre_costings`;

CREATE TABLE `pre_costings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` bigint(20) unsigned NOT NULL,
  `yarn_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `weaving_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grey_cost_fabric` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dyes_chemical` decimal(10,2) NOT NULL DEFAULT '0.00',
  `special_finish_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `excess_less_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `overhead_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `allowance_percentage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `allowance_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `commercial_percentage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `commercial_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `net_sales_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `profit_loss_on_sales` decimal(10,2) NOT NULL DEFAULT '0.00',
  `yarn_con_wrap` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yarn_con_weft` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_costings_work_order_id_foreign` (`work_order_id`),
  CONSTRAINT `pre_costings_work_order_id_foreign` FOREIGN KEY (`work_order_id`) REFERENCES `work_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pre_costings` */

insert  into `pre_costings`(`id`,`work_order_id`,`yarn_cost`,`weaving_cost`,`grey_cost_fabric`,`dyes_chemical`,`special_finish_cost`,`excess_less_cost`,`overhead_cost`,`allowance_percentage`,`allowance_cost`,`commercial_percentage`,`commercial_cost`,`net_sales_price`,`profit_loss_on_sales`,`yarn_con_wrap`,`yarn_con_weft`,`created_at`,`updated_at`) values
(1,3,1.00,0.00,0.00,0.00,0.00,0.25,2.05,0.00,0.00,0.00,0.00,0.00,2.07,NULL,NULL,'2024-04-28 06:02:19','2024-04-28 06:02:19'),
(2,2,2.41,2.41,2.41,2.41,0.21,4.23,3.41,33.43,0.43,4.53,56.34,45.34,4.35,NULL,NULL,'2024-04-28 06:07:58','2024-04-28 06:07:58'),
(3,1,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,'2024-04-29 06:56:40','2024-04-29 06:56:40');

/*Table structure for table `process` */

DROP TABLE IF EXISTS `process`;

CREATE TABLE `process` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `process_created_by_foreign` (`created_by`),
  KEY `process_updated_by_foreign` (`updated_by`),
  CONSTRAINT `process_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `process_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `process` */

insert  into `process`(`id`,`name`,`slug`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Reactive Solid Dyed','reactive-solid-dyed',NULL,NULL,NULL,'2024-04-30 09:35:39','2024-04-30 09:35:39'),
(2,'Pigment Dyed','pigment-dyed',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(3,'Pigment Print on Pigment Dyed','pigment-print-on-pigment-dyed',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(4,'Double Bath Solid Dyed(Reactive+Disperse)','double-bath-solid-dyedreactivedisperse',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(5,'One Bath Solid Dyed(Reactive+Disperse)','one-bath-solid-dyedreactivedisperse',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(6,'Reactive Print on Reactive Solid Dyed','reactive-print-on-reactive-solid-dyed',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(7,'Reactive Print on One Bath Solid Dyed','reactive-print-on-one-bath-solid-dyed',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(8,'Reactive Print on Double Bath Solid Dyed','reactive-print-on-double-bath-solid-dyed',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(9,'Pigment Print on Reactive Solid Dyed','pigment-print-on-reactive-solid-dyed',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(10,'Pigment Print on One Bath Solid Dyed','pigment-print-on-one-bath-solid-dyed',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(11,'Pigment Print on Double Bath Solid Dyed','pigment-print-on-double-bath-solid-dyed',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(12,'Pigment Print on PFD','pigment-print-on-pfd',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(13,'Reactive Print on PFD','reactive-print-on-pfd',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(14,'Reactive+Disperse Print on PFD','reactivedisperse-print-on-pfd',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(15,'White/PFD','whitepfd',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40'),
(16,'Y/D','yd',NULL,NULL,NULL,'2024-04-30 09:35:40','2024-04-30 09:35:40');

/*Table structure for table `product_attributes` */

DROP TABLE IF EXISTS `product_attributes`;

CREATE TABLE `product_attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `attribute_option_id` bigint(20) unsigned NOT NULL,
  `serial` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attributes_product_id_foreign` (`product_id`),
  KEY `product_attributes_attribute_option_id_foreign` (`attribute_option_id`),
  CONSTRAINT `product_attributes_attribute_option_id_foreign` FOREIGN KEY (`attribute_option_id`) REFERENCES `attribute_options` (`id`),
  CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_attributes` */

insert  into `product_attributes`(`id`,`product_id`,`attribute_option_id`,`serial`,`created_at`,`updated_at`) values
(39,6,1,1,'2024-04-17 05:08:56','2024-04-17 05:08:56'),
(40,6,6,1,'2024-04-17 05:08:56','2024-04-17 05:08:56'),
(41,6,12,1,'2024-04-17 05:08:56','2024-04-17 05:08:56'),
(48,8,26,1,'2024-04-27 10:53:57','2024-04-27 10:53:57'),
(49,8,19,1,'2024-04-27 10:53:57','2024-04-27 10:53:57'),
(50,8,2,1,'2024-04-27 10:53:57','2024-04-27 10:53:57'),
(51,8,9,1,'2024-04-27 10:53:57','2024-04-27 10:53:57'),
(52,8,15,1,'2024-04-27 10:53:58','2024-04-27 10:53:58'),
(53,9,27,1,'2024-04-30 04:08:02','2024-04-30 04:08:02'),
(54,9,19,1,'2024-04-30 04:08:02','2024-04-30 04:08:02'),
(55,9,1,1,'2024-04-30 04:08:02','2024-04-30 04:08:02'),
(56,9,6,1,'2024-04-30 04:08:02','2024-04-30 04:08:02'),
(57,9,12,1,'2024-04-30 04:08:02','2024-04-30 04:08:02'),
(58,9,31,0,'2024-04-30 04:08:02','2024-04-30 04:08:02'),
(59,7,2,1,'2024-04-30 04:08:20','2024-04-30 04:08:20'),
(60,7,7,1,'2024-04-30 04:08:20','2024-04-30 04:08:20'),
(61,7,13,1,'2024-04-30 04:08:20','2024-04-30 04:08:20'),
(62,7,31,1,'2024-04-30 04:08:20','2024-04-30 04:08:20');

/*Table structure for table `product_groups` */

DROP TABLE IF EXISTS `product_groups`;

CREATE TABLE `product_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_groups_created_by_foreign` (`created_by`),
  KEY `product_groups_updated_by_foreign` (`updated_by`),
  CONSTRAINT `product_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `product_groups_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_groups` */

insert  into `product_groups`(`id`,`name`,`code`,`description`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Chemical','PG-001',NULL,1,NULL,NULL,'2024-03-22 17:38:31','2024-03-22 17:38:31'),
(2,'Printing Chemical','PG-002',NULL,1,NULL,NULL,'2024-03-22 17:38:48','2024-03-22 17:38:48'),
(3,'Dyes','PG-003',NULL,1,NULL,NULL,'2024-03-22 17:39:00','2024-03-22 17:39:00'),
(4,'Greige','PG-004',NULL,1,NULL,NULL,'2024-03-27 04:36:21','2024-03-27 04:36:21'),
(5,'Finished Goods','PG-005',NULL,1,NULL,NULL,'2024-04-24 09:18:38','2024-04-24 09:18:38');

/*Table structure for table `product_suppliers` */

DROP TABLE IF EXISTS `product_suppliers`;

CREATE TABLE `product_suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_suppliers_product_id_foreign` (`product_id`),
  KEY `product_suppliers_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `product_suppliers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_suppliers_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_suppliers` */

insert  into `product_suppliers`(`id`,`product_id`,`supplier_id`,`created_at`,`updated_at`) values
(11,6,1,NULL,NULL),
(12,6,4,NULL,NULL),
(13,7,2,NULL,NULL);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `product_group_id` bigint(20) unsigned NOT NULL,
  `unit_id` bigint(20) unsigned NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `vat` double NOT NULL DEFAULT '0',
  `sales_price` double NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `is_finished_goods` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `mode_of_purchase` enum('import','native') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_unit_id_foreign` (`unit_id`),
  KEY `products_created_by_foreign` (`created_by`),
  KEY `products_updated_by_foreign` (`updated_by`),
  KEY `products_product_group_id_foreign` (`product_group_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `products_product_group_id_foreign` FOREIGN KEY (`product_group_id`) REFERENCES `product_groups` (`id`),
  CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  CONSTRAINT `products_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`sku`,`name`,`parent_id`,`category_id`,`product_group_id`,`unit_id`,`unit_price`,`tax`,`vat`,`sales_price`,`description`,`status`,`is_finished_goods`,`mode_of_purchase`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(6,'P-24-TRU-00001','Greige-Imported',NULL,1,4,1,500,0,0,0,'N/A','approved','no','import',NULL,NULL,NULL,'2024-03-27 05:12:29','2024-04-17 05:08:56'),
(7,'P-24-TRU-00002','10x16/64x62',NULL,1,4,1,9.55,0,0,0,NULL,'approved','no','import',NULL,NULL,NULL,'2024-03-31 06:57:53','2024-03-31 06:57:53'),
(8,'P-24-TRU-00003','Dyes',NULL,2,1,2,100,0,0,0,'Test','approved','no','import',NULL,NULL,NULL,'2024-04-01 03:46:36','2024-04-27 10:53:57'),
(9,'P-24-TRU-00004','(10-100) White Light Aop CW-B',NULL,3,5,1,120,0,0,0,NULL,'approved','yes','import',NULL,NULL,NULL,'2024-04-17 05:08:41','2024-04-27 10:43:22');

/*Table structure for table `proforma_invoice_items` */

DROP TABLE IF EXISTS `proforma_invoice_items`;

CREATE TABLE `proforma_invoice_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proforma_invoice_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `qty` double NOT NULL DEFAULT '0',
  `sub_total_price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `discount_amount` double NOT NULL DEFAULT '0',
  `vat_type` enum('inclusive','exclusive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'exclusive',
  `vat` double NOT NULL DEFAULT '0',
  `vat_amount` double NOT NULL DEFAULT '0',
  `total_price` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proforma_invoice_items_proforma_invoice_id_foreign` (`proforma_invoice_id`),
  KEY `proforma_invoice_items_product_id_foreign` (`product_id`),
  CONSTRAINT `proforma_invoice_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `proforma_invoice_items_proforma_invoice_id_foreign` FOREIGN KEY (`proforma_invoice_id`) REFERENCES `proforma_invoices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `proforma_invoice_items` */

insert  into `proforma_invoice_items`(`id`,`proforma_invoice_id`,`product_id`,`unit_price`,`qty`,`sub_total_price`,`discount`,`discount_amount`,`vat_type`,`vat`,`vat_amount`,`total_price`,`created_at`,`updated_at`) values
(6,3,6,200,100,20000,0,0,'exclusive',0,0,20000,'2024-04-01 04:41:00',NULL),
(7,3,8,10,30,300,0,0,'exclusive',0,0,300,'2024-04-01 04:41:00',NULL),
(11,2,6,120,8,960,0,0,'exclusive',0,0,960,'2024-04-01 04:47:00',NULL),
(12,2,8,23,30,690,0,0,'exclusive',0,0,690,'2024-04-01 04:47:00',NULL),
(13,4,9,12,10000,120000,0,0,'exclusive',0,0,120000,'2024-04-21 08:28:00',NULL),
(14,4,7,15,9999,149985,0,0,'exclusive',0,0,149985,'2024-04-21 08:28:00',NULL),
(15,4,8,120,1500,180000,0,0,'exclusive',0,0,180000,'2024-04-21 08:28:00',NULL),
(16,4,6,12,9999,119988,0,0,'exclusive',0,0,119988,'2024-04-21 08:28:00',NULL),
(17,5,6,23,1400,32200,0,0,'exclusive',0,0,32200,'2024-04-27 05:38:00',NULL),
(18,6,8,0,15000,0,0,0,'exclusive',0,0,0,'2024-04-27 06:04:00',NULL),
(19,7,6,500,1000,500000,0,0,'exclusive',0,0,500000,'2024-04-30 04:27:00',NULL),
(20,7,7,955,1200,1146000,0,0,'exclusive',0,0,1146000,'2024-04-30 04:27:00',NULL);

/*Table structure for table `proforma_invoices` */

DROP TABLE IF EXISTS `proforma_invoices`;

CREATE TABLE `proforma_invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `pi_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pi_date` date DEFAULT NULL,
  `lc_no` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lc_date` date DEFAULT NULL,
  `total_price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `vat` double NOT NULL DEFAULT '0',
  `gross_price` double NOT NULL DEFAULT '0',
  `status` enum('pending','approved','halt') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `pi_file` text COLLATE utf8mb4_unicode_ci,
  `instructions_file` text COLLATE utf8mb4_unicode_ci,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proforma_invoices_supplier_id_foreign` (`supplier_id`),
  KEY `proforma_invoices_created_by_foreign` (`created_by`),
  KEY `proforma_invoices_updated_by_foreign` (`updated_by`),
  CONSTRAINT `proforma_invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `proforma_invoices_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  CONSTRAINT `proforma_invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `proforma_invoices` */

insert  into `proforma_invoices`(`id`,`supplier_id`,`pi_no`,`pi_date`,`lc_no`,`lc_date`,`total_price`,`discount`,`vat`,`gross_price`,`status`,`pi_file`,`instructions_file`,`remarks`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(2,1,'PI-24-TRU-0001','2024-03-30','LC-001','2024-03-31',0,0,0,0,'approved','uploads/proforma-invoice/157010424044705.png','uploads/proforma-invoice/969010424044705.png','N/A',1,1,NULL,'2024-03-31 08:06:45','2024-04-01 04:47:05'),
(3,3,'PI-24-TRU-0002','2024-04-01','LC-002','2024-04-09',0,0,0,0,'approved',NULL,NULL,'Test',1,NULL,NULL,'2024-04-01 04:41:06','2024-04-01 04:41:06'),
(4,5,'PI-24-TRU-0003','2024-04-21','LC-003','2024-04-21',0,0,0,0,'approved',NULL,NULL,'Test',1,NULL,NULL,'2024-04-21 08:28:27','2024-04-21 08:28:27'),
(5,4,'PI-24-TRU-0004','2024-04-27','Lc-89879','2024-04-27',0,0,0,0,'approved',NULL,NULL,'Remarks',1,NULL,NULL,'2024-04-27 05:38:20','2024-04-27 05:38:20'),
(6,1,'PI-24-TRU-0005','2024-04-27','3234','2024-04-27',0,0,0,0,'approved',NULL,NULL,'resdfrs',1,NULL,NULL,'2024-04-27 06:04:41','2024-04-27 06:04:41'),
(7,3,'LC-24-TRU-0006','2024-04-30','LC-00565','2024-04-30',0,0,0,0,'approved',NULL,NULL,'Test',1,NULL,NULL,'2024-04-30 04:27:29','2024-04-30 04:27:29');

/*Table structure for table `requisition_delivery` */

DROP TABLE IF EXISTS `requisition_delivery`;

CREATE TABLE `requisition_delivery` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `requisition_id` bigint(20) unsigned NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `delivered_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requisition_id` (`requisition_id`),
  KEY `requisition_delivery_created_by_foreign` (`created_by`),
  KEY `requisition_delivery_updated_by_foreign` (`updated_by`),
  CONSTRAINT `requisition_delivery_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `requisition_delivery_ibfk_1` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requisition_delivery_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `requisition_delivery` */

insert  into `requisition_delivery`(`id`,`requisition_id`,`reference_no`,`delivery_date`,`remarks`,`delivered_by`,`created_at`,`updated_at`,`created_by`,`updated_by`,`deleted_at`) values
(1,4,'CD-24-TRU-0001','2024-04-21','Test',1,'2024-04-21 09:46:59','2024-04-21 09:46:59',1,NULL,NULL),
(2,4,'CD-24-TRU-0002','2024-04-21','2nd dalivery',1,'2024-04-21 10:02:47','2024-04-21 10:02:47',1,NULL,NULL),
(3,4,'CD-24-TRU-0003','2024-04-21',NULL,1,'2024-04-21 10:03:09','2024-04-21 10:03:09',1,NULL,NULL),
(4,5,'CD-24-TRU-0004','2024-04-21',NULL,1,'2024-04-21 10:19:34','2024-04-21 10:19:34',1,NULL,NULL),
(5,5,'CD-24-TRU-0005','2024-04-21','test',1,'2024-04-21 10:29:13','2024-04-21 10:29:13',1,NULL,NULL),
(6,5,'CD-24-TRU-0006','2024-04-21',NULL,1,'2024-04-21 10:29:37','2024-04-21 10:29:37',1,NULL,NULL),
(9,5,'CD-24-TRU-0007','2024-04-21',NULL,1,'2024-04-21 10:32:10','2024-04-21 10:32:10',1,NULL,NULL),
(11,5,'CD-24-TRU-0008','2024-04-21',NULL,1,'2024-04-21 10:33:55','2024-04-21 10:33:55',1,NULL,NULL),
(12,8,'CD-24-TRU-0009','2024-04-25',NULL,1,'2024-04-25 07:28:18','2024-04-25 07:28:18',1,NULL,NULL),
(13,7,'CD-24-TRU-0010','2024-04-25',NULL,1,'2024-04-25 07:28:27','2024-04-25 07:28:27',1,NULL,NULL),
(14,6,'CD-24-TRU-0011','2024-04-25',NULL,1,'2024-04-25 07:28:33','2024-04-25 07:28:33',1,NULL,NULL),
(15,9,'CD-24-TRU-0012','2024-04-27','test',1,'2024-04-27 06:10:22','2024-04-27 06:10:22',1,NULL,NULL),
(16,10,'CD-24-TRU-0013','2024-04-30',NULL,1,'2024-04-30 05:55:28','2024-04-30 05:55:28',1,NULL,NULL);

/*Table structure for table `requisition_delivery_items` */

DROP TABLE IF EXISTS `requisition_delivery_items`;

CREATE TABLE `requisition_delivery_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `requisition_delivery_id` bigint(20) unsigned NOT NULL,
  `requisition_item_id` bigint(20) unsigned NOT NULL,
  `stock_inventory_id` bigint(20) unsigned NOT NULL,
  `issued_qty` double NOT NULL DEFAULT '0',
  `status` enum('acknowledge','pending','delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'delivered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requisition_delivery_items_requisition_delivery_id_foreign` (`requisition_delivery_id`),
  KEY `requisition_delivery_items_requisition_item_id_foreign` (`requisition_item_id`),
  KEY `requisition_delivery_items_stock_inventory_id_foreign` (`stock_inventory_id`),
  CONSTRAINT `requisition_delivery_items_requisition_delivery_id_foreign` FOREIGN KEY (`requisition_delivery_id`) REFERENCES `requisition_delivery` (`id`),
  CONSTRAINT `requisition_delivery_items_requisition_item_id_foreign` FOREIGN KEY (`requisition_item_id`) REFERENCES `requisition_items` (`id`),
  CONSTRAINT `requisition_delivery_items_stock_inventory_id_foreign` FOREIGN KEY (`stock_inventory_id`) REFERENCES `stock_inventory` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `requisition_delivery_items` */

insert  into `requisition_delivery_items`(`id`,`requisition_delivery_id`,`requisition_item_id`,`stock_inventory_id`,`issued_qty`,`status`,`created_at`,`updated_at`) values
(1,1,8,2,20,'delivered','2024-04-21 09:46:59','2024-04-21 09:46:59'),
(2,1,9,8,30,'delivered','2024-04-21 09:46:59','2024-04-21 09:46:59'),
(3,2,8,5,20,'delivered','2024-04-21 10:02:47','2024-04-21 10:02:47'),
(4,3,8,10,60,'delivered','2024-04-21 10:03:09','2024-04-21 10:03:09'),
(5,4,4,9,20,'delivered','2024-04-21 10:19:34','2024-04-21 10:19:34'),
(6,4,5,3,3,'delivered','2024-04-21 10:19:34','2024-04-21 10:19:34'),
(7,5,5,6,6,'delivered','2024-04-21 10:29:13','2024-04-21 10:29:13'),
(8,6,5,10,20,'delivered','2024-04-21 10:29:37','2024-04-21 10:29:37'),
(11,9,5,10,5,'delivered','2024-04-21 10:32:10','2024-04-21 10:32:10'),
(13,11,5,10,6,'delivered','2024-04-21 10:33:55','2024-04-21 10:33:55'),
(14,12,12,10,200,'delivered','2024-04-25 07:28:19','2024-04-25 07:28:19'),
(15,13,11,10,100,'delivered','2024-04-25 07:28:27','2024-04-25 07:28:27'),
(16,14,10,10,100,'delivered','2024-04-25 07:28:33','2024-04-25 07:28:33'),
(17,15,13,16,200,'delivered','2024-04-27 06:10:22','2024-04-27 06:10:22'),
(18,15,14,14,100,'delivered','2024-04-27 06:10:22','2024-04-27 06:10:22'),
(19,16,15,16,200,'delivered','2024-04-30 05:55:28','2024-04-30 05:55:28');

/*Table structure for table `requisition_items` */

DROP TABLE IF EXISTS `requisition_items`;

CREATE TABLE `requisition_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `requisition_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requisition_items_requisition_id_foreign` (`requisition_id`),
  KEY `requisition_items_product_id_foreign` (`product_id`),
  CONSTRAINT `requisition_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `requisition_items_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `requisition_items` */

insert  into `requisition_items`(`id`,`requisition_id`,`product_id`,`qty`,`created_at`,`updated_at`) values
(4,5,7,20,'2024-04-18 03:44:00',NULL),
(5,5,8,40,'2024-04-18 03:44:00',NULL),
(8,4,8,100,'2024-04-18 05:19:00',NULL),
(9,4,9,30,'2024-04-18 05:19:00',NULL),
(10,6,8,100,'2024-04-24 09:06:00',NULL),
(11,7,8,100,'2024-04-25 07:27:00',NULL),
(12,8,8,200,'2024-04-25 07:27:00',NULL),
(13,9,8,200,'2024-04-27 06:02:00',NULL),
(14,9,6,100,'2024-04-27 06:02:00',NULL),
(15,10,8,200,'2024-04-30 05:33:00',NULL);

/*Table structure for table `requisitions` */

DROP TABLE IF EXISTS `requisitions`;

CREATE TABLE `requisitions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_item_id` bigint(20) unsigned NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisition_date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `requisition_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','completed','halt') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `delivery_status` enum('partial-delivered','delivered') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_send` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requisitions_work_order_item_id_foreign` (`work_order_item_id`),
  KEY `requisitions_created_by_foreign` (`created_by`),
  KEY `requisitions_updated_by_foreign` (`updated_by`),
  CONSTRAINT `requisitions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `requisitions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `requisitions_work_order_item_id_foreign` FOREIGN KEY (`work_order_item_id`) REFERENCES `work_order_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `requisitions` */

insert  into `requisitions`(`id`,`work_order_item_id`,`reference_no`,`requisition_date`,`remarks`,`requisition_file`,`status`,`delivery_status`,`is_send`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(4,6,'RQ-24-TRU-0001','2024-04-18','Test edit test','uploads/requisitions/169180424051934.pdf','approved','delivered','yes',1,1,NULL,'2024-04-17 10:51:21','2024-04-21 09:46:59'),
(5,7,'RQ-24-TRU-0002','2024-04-18','Test',NULL,'approved','delivered','yes',1,1,NULL,'2024-04-18 03:44:12','2024-04-21 10:29:37'),
(6,8,'RQ-24-TRU-0003','2024-04-24','Test',NULL,'approved','delivered','yes',1,1,NULL,'2024-04-24 09:06:12','2024-04-25 07:28:33'),
(7,9,'RQ-24-TRU-0004','2024-04-25','Test',NULL,'approved','delivered','yes',1,1,NULL,'2024-04-25 07:27:30','2024-04-25 07:28:27'),
(8,10,'RQ-24-TRU-0005','2024-04-25',NULL,NULL,'approved','delivered','yes',1,1,NULL,'2024-04-25 07:27:51','2024-04-25 07:28:19'),
(9,11,'RQ-24-TRU-0006','2024-04-27','remarks',NULL,'approved','delivered','yes',1,1,NULL,'2024-04-27 06:02:09','2024-04-27 06:10:22'),
(10,12,'RQ-24-TRU-0007','2024-04-30','Test',NULL,'approved','delivered','yes',1,1,NULL,'2024-04-30 05:33:07','2024-04-30 05:55:28');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(7,1),
(8,1),
(9,1),
(10,1),
(11,1),
(12,1),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,1),
(20,1),
(21,1),
(22,1),
(23,1),
(24,1),
(25,1),
(26,1),
(27,1),
(28,1),
(29,1),
(30,1),
(35,1),
(36,1),
(37,1),
(38,1),
(39,1),
(40,1),
(41,1),
(42,1),
(57,1),
(58,1),
(59,1),
(60,1),
(61,1),
(62,1),
(63,1),
(64,1),
(65,1),
(66,1),
(67,1),
(68,1),
(69,1),
(70,1),
(71,1),
(72,1),
(73,1),
(74,1),
(75,1),
(76,1),
(77,1),
(78,1),
(79,1),
(80,1),
(81,1),
(82,1),
(83,1),
(84,1),
(85,1),
(86,1),
(87,1),
(88,1),
(89,1),
(90,1),
(91,1),
(92,1),
(93,1),
(94,1),
(95,1),
(96,1),
(97,1),
(98,1),
(99,1),
(100,1),
(101,1),
(102,1),
(103,1),
(104,1),
(105,1),
(106,1),
(107,1),
(108,1),
(109,1),
(110,1),
(111,1),
(112,1),
(113,1),
(114,1),
(115,1),
(116,1),
(117,1),
(118,1),
(119,1),
(120,1),
(121,1),
(122,1),
(123,1),
(124,1),
(125,1),
(126,1),
(127,1),
(128,1),
(129,1),
(130,1),
(131,1),
(132,1),
(133,1),
(134,1),
(135,1),
(136,1),
(137,1),
(138,1),
(139,1),
(140,1),
(141,1),
(142,1),
(143,1),
(144,1),
(145,1),
(146,1),
(147,1),
(148,1),
(149,1),
(150,1),
(151,1),
(152,1),
(153,1),
(154,1),
(155,1),
(156,1),
(157,1),
(158,1),
(159,1),
(160,1),
(161,1),
(162,1),
(163,1),
(164,1),
(165,1),
(22,4),
(35,4),
(36,4),
(37,4),
(38,4),
(39,4),
(40,4),
(41,4),
(42,4),
(57,4),
(58,4),
(59,4),
(60,4),
(61,4),
(62,4),
(63,4),
(64,4),
(65,4),
(66,4),
(67,4),
(68,4),
(69,4),
(70,4),
(71,4),
(72,4),
(73,4),
(74,4),
(75,4),
(76,4),
(77,4),
(78,4),
(79,4),
(80,4),
(81,4),
(82,4),
(83,4),
(84,4),
(85,4),
(86,4),
(87,4),
(88,4),
(89,4),
(90,4),
(91,4),
(92,4),
(93,4),
(94,4),
(95,4),
(96,4),
(97,4),
(98,4),
(99,4),
(100,4),
(101,4),
(102,4),
(103,4),
(104,4),
(105,4),
(106,4),
(107,4),
(108,4),
(109,4),
(110,4);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `word_restrictions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`word_restrictions`,`guard_name`,`created_at`,`updated_at`,`deleted_at`) values
(1,'Super-Admin','[\"\"]','web','2023-01-31 10:54:55','2023-02-16 00:37:53',NULL),
(3,'Customer','[\"\"]','web',NULL,NULL,NULL),
(4,'Admin','[\"\"]','web','2024-03-21 04:40:59','2024-03-21 04:40:59',NULL);

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `type` enum('sellable','other-services-monthly-charge','other-services-onetime-charge','other-affiliate-services') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sellable',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_created_by_foreign` (`created_by`),
  KEY `services_updated_by_foreign` (`updated_by`),
  CONSTRAINT `services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `services_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `services` */

/*Table structure for table `settings_mail` */

DROP TABLE IF EXISTS `settings_mail`;

CREATE TABLE `settings_mail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mail_mailer` text COLLATE utf8mb4_unicode_ci,
  `mail_host` text COLLATE utf8mb4_unicode_ci,
  `mail_port` text COLLATE utf8mb4_unicode_ci,
  `mail_user_name` text COLLATE utf8mb4_unicode_ci,
  `mail_user_password` text COLLATE utf8mb4_unicode_ci,
  `mail_encryption` text COLLATE utf8mb4_unicode_ci,
  `mail_from_address` text COLLATE utf8mb4_unicode_ci,
  `mail_name` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings_mail` */

insert  into `settings_mail`(`id`,`mail_mailer`,`mail_host`,`mail_port`,`mail_user_name`,`mail_user_password`,`mail_encryption`,`mail_from_address`,`mail_name`,`created_at`,`updated_at`) values
(1,'smtp','mail.trugroup.com.bd','465','test@trugroup.com.bd','#11nrd~@$4he','ssl','test@trugroup.com.bd','TRU Group','2024-01-31 04:37:44','2024-03-20 03:58:31');

/*Table structure for table `settings_social_media` */

DROP TABLE IF EXISTS `settings_social_media`;

CREATE TABLE `settings_social_media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `twitter` text COLLATE utf8mb4_unicode_ci,
  `facebook` text COLLATE utf8mb4_unicode_ci,
  `telegram` text COLLATE utf8mb4_unicode_ci,
  `discord` text COLLATE utf8mb4_unicode_ci,
  `youtube` text COLLATE utf8mb4_unicode_ci,
  `vimeo` text COLLATE utf8mb4_unicode_ci,
  `tiktok` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings_social_media` */

insert  into `settings_social_media`(`id`,`twitter`,`facebook`,`telegram`,`discord`,`youtube`,`vimeo`,`tiktok`,`created_at`,`updated_at`) values
(1,'#','https://www.facebook.com/','https://www.linkedin.com/company/','https://www.instagram.com/','https://youtube.com','#','https://www.tiktok.com/','2024-01-25 20:40:47','2024-03-20 03:57:01');

/*Table structure for table `settings_wallet` */

DROP TABLE IF EXISTS `settings_wallet`;

CREATE TABLE `settings_wallet` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `environment` text COLLATE utf8mb4_unicode_ci,
  `access_token` text COLLATE utf8mb4_unicode_ci,
  `application_id` text COLLATE utf8mb4_unicode_ci,
  `location_id` text COLLATE utf8mb4_unicode_ci,
  `redirect_url` text COLLATE utf8mb4_unicode_ci,
  `merchant_support_email` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings_wallet` */

insert  into `settings_wallet`(`id`,`environment`,`access_token`,`application_id`,`location_id`,`redirect_url`,`merchant_support_email`,`created_at`,`updated_at`) values
(1,'sandbox','EAAAl9vQAdez0WbH2r75gBLhpLTdfwUWBt8LcCbQqx1PEMoLZuvs8fwgGS4J5t4g','sandbox-sq0idb-LOSO1E8bZRG4GxYFo2sRUg','LEY0GQQHR60WC','http://127.0.0.1:8000/guest/callback','gmfaruk2021@gmail.com','2024-01-31 03:52:30','2024-01-31 03:52:30');

/*Table structure for table `settings_website` */

DROP TABLE IF EXISTS `settings_website`;

CREATE TABLE `settings_website` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8mb4_unicode_ci,
  `slogan` longtext COLLATE utf8mb4_unicode_ci,
  `logo` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_user_logo` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_email` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membership_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agreement_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_phone` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_address` longtext COLLATE utf8mb4_unicode_ci,
  `default_user_cover` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_like_qty` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '10',
  `monthly_plan_features` longtext COLLATE utf8mb4_unicode_ci,
  `service_agreements` longtext COLLATE utf8mb4_unicode_ci,
  `business_structures` longtext COLLATE utf8mb4_unicode_ci,
  `tax_filing_statuses` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings_website` */

insert  into `settings_website`(`id`,`name`,`slogan`,`logo`,`default_user_logo`,`favicon`,`official_email`,`membership_email`,`agreement_email`,`official_phone`,`official_address`,`default_user_cover`,`fee_like_qty`,`monthly_plan_features`,`service_agreements`,`business_structures`,`tax_filing_statuses`,`created_at`,`updated_at`) values
(1,'{\"en\":\"TRU Group.\"}','{\"en\":\"TRU Group.\"}','uploads/website/logo/897200324040206.webp','uploads/website/defaultUser/298200324035031.png','uploads/website/favicon/918200324040206.png','info@bizzsol.com.bd','info@bizzsol.com.bd','info@bizzsol.com.bd','.','{\"en\":\".\"}','uploads/website/defaultCover/213200324040206.webp','5','.','<h4 style=\"margin-bottom: 35px\">.</h4><ol>\r\n</ol>','[\"sole-proprietor\",\"partnership\",\"LLC\",\"c-corp\",\"s-corp\",\"non-profit\"]','[\"individual\",\"partnership\",\"corporation\"]','2023-06-06 01:51:13','2024-03-20 04:02:06');

/*Table structure for table `stock_inventory` */

DROP TABLE IF EXISTS `stock_inventory`;

CREATE TABLE `stock_inventory` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grn_item_id` bigint(20) unsigned NOT NULL,
  `mrr_no` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `status` enum('fresh','expire') COLLATE utf8mb4_unicode_ci DEFAULT 'fresh',
  `type` enum('in','out') COLLATE utf8mb4_unicode_ci DEFAULT 'in',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_inventory_grn_item_id_foreign` (`grn_item_id`),
  KEY `stock_inventory_warehouse_id_foreign` (`warehouse_id`),
  KEY `stock_inventory_product_id_foreign` (`product_id`),
  CONSTRAINT `stock_inventory_grn_item_id_foreign` FOREIGN KEY (`grn_item_id`) REFERENCES `grn_items` (`id`),
  CONSTRAINT `stock_inventory_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `stock_inventory_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `stock_inventory` */

insert  into `stock_inventory`(`id`,`grn_item_id`,`mrr_no`,`warehouse_id`,`product_id`,`qty`,`status`,`type`,`created_at`,`updated_at`) values
(1,1,'MRR-0001',1,6,5,'fresh','in',NULL,NULL),
(2,2,'MRR-0002',1,8,20,'fresh','in',NULL,NULL),
(3,4,'MRR-0003',2,8,3,'fresh','in',NULL,NULL),
(4,5,'MRR-0004',1,6,93,'fresh','in',NULL,NULL),
(5,6,'MRR-0005',1,8,20,'fresh','in',NULL,NULL),
(6,8,'MRR-0006',1,8,6,'fresh','in',NULL,NULL),
(7,10,'MRR-0007',1,6,4,'fresh','in',NULL,NULL),
(8,12,'MRR-0009',1,9,10000,'fresh','in',NULL,NULL),
(9,13,'MRR-00010',1,7,9999,'fresh','in',NULL,NULL),
(10,14,'MRR-00011',1,8,1500,'fresh','in',NULL,NULL),
(11,15,'MRR-00012',1,6,9999,'fresh','in',NULL,NULL),
(12,11,'MRR-00014',1,6,3,'fresh','in',NULL,NULL),
(13,16,'Mrr-9829',1,6,1000,'fresh','in',NULL,NULL),
(14,17,'Mrr-434',1,6,200,'fresh','in',NULL,NULL),
(15,18,'MRR0-333',1,6,200,'fresh','in',NULL,NULL),
(16,19,'MRR-200',1,8,15000,'fresh','in',NULL,NULL),
(17,20,'2223',1,6,1000,'fresh','in',NULL,NULL),
(18,21,'24223',1,7,1200,'fresh','in',NULL,NULL);

/*Table structure for table `sub_menus` */

DROP TABLE IF EXISTS `sub_menus`;

CREATE TABLE `sub_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` tinyint(3) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sub menu for admin',
  `open_new_tab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Open New Tab',
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_menus_menu_id_foreign` (`menu_id`),
  KEY `sub_menus_created_by_foreign` (`created_by`),
  KEY `sub_menus_updated_by_foreign` (`updated_by`),
  CONSTRAINT `sub_menus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `sub_menus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_menus` */

insert  into `sub_menus`(`id`,`menu_id`,`name`,`name_bn`,`url`,`icon_class`,`icon`,`big_icon`,`serial_num`,`status`,`slug`,`menu_for`,`open_new_tab`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,2,'Permission',NULL,'admin/acl/permission','uil uil-lock-access',NULL,NULL,1,'Active','[\"permission-list\",\"permission-delete\",\"permission-edit\",\"permission-create\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 02:18:50','2023-02-28 23:58:35'),
(2,2,'Roles',NULL,'admin/acl/roles','uil uil-shield-check',NULL,NULL,2,'Active','[\"role-delete\",\"role-edit\",\"role-create\",\"role-list\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 02:32:37','2023-02-28 23:59:11'),
(3,2,'Menu',NULL,'admin/acl/menu','uil  uil-align',NULL,NULL,3,'Active','[\"submenu-delete\",\"submenu-edit\",\"submenu-create\",\"submenu-list\",\"menu-delete\",\"menu-create\",\"menu-edit\",\"menu-list\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 02:33:11','2023-02-28 23:59:45'),
(4,2,'Users',NULL,'admin/acl/users','uil uil-user-circle',NULL,NULL,4,'Active','[\"user-delete\",\"user-edit\",\"user-create\",\"user-list\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-02-02 03:13:29','2023-03-01 00:00:30'),
(23,11,'Website',NULL,'admin/website-settings','mdi mdi-web-check',NULL,NULL,1,'Active','[\"settings-delete\",\"settings-edit\",\"settings-create\",\"settings-list\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2023-03-25 09:17:19','2023-03-25 09:17:19'),
(24,11,'Social Media',NULL,'admin/social-media-settings','mdi mdi-facebook',NULL,NULL,2,'Inactive','[\"settings-list\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-03-25 09:19:48','2024-04-17 06:38:49'),
(25,11,'Wallet Connect',NULL,'admin/wallet-connect','mdi mdi-wallet-plus',NULL,NULL,3,'Inactive','[\"settings-list\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2023-03-25 09:22:03','2024-04-17 06:38:35'),
(26,11,'Payment Getway',NULL,'admin/payment-getway','mdi mdi-contactless-payment',NULL,NULL,4,'Active','[\"settings-list\"]','Sub menu for admin','No Open New Tab',1,NULL,'2023-06-06 12:44:42','2023-03-25 09:34:16','2023-06-06 12:44:42'),
(27,11,'Mail Credential',NULL,'admin/mail-credential','mdi mdi-email-lock',NULL,NULL,5,'Active','[\"settings-list\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2023-03-25 09:35:20','2023-03-25 09:35:20'),
(28,12,'Departments',NULL,'admin/departments','uil-align',NULL,NULL,1,'Active','[\"department-delete\",\"department-edit\",\"department-create\",\"departments\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-01-21 05:57:18','2024-03-21 04:04:43'),
(29,12,'Document Types',NULL,'admin/document-types','uil-file',NULL,NULL,2,'Active','[\"document-type-delete\",\"document-type-edit\",\"document-type-create\",\"document-types\"]','Sub menu for admin','No Open New Tab',1,NULL,'2024-03-19 10:36:46','2024-01-21 05:58:40','2024-03-19 10:36:46'),
(30,13,'Language',NULL,'admin/languages','uil-globe',NULL,NULL,1,'Active','[\"language-delete\",\"language-edit\",\"language-create\",\"languages\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-01-23 04:14:05','2024-01-24 03:46:13'),
(31,13,'Language Library',NULL,'admin/language-library','uil-notebooks',NULL,NULL,2,'Active','[\"language-library-delete\",\"language-library-edit\",\"language-library-create\",\"language-library\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-01-23 04:14:30','2024-01-24 03:46:03'),
(32,17,'Upload Reports',NULL,'admin/upload-reports','uil-list-ui-alt',NULL,NULL,1,'Active','[\"reports-generate\",\"reports\"]','Sub menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:05','2024-01-24 03:59:16','2024-03-19 10:36:05'),
(33,17,'Documents',NULL,'admin/documents','uil-list-ui-alt',NULL,NULL,2,'Active','[\"documents\"]','Sub menu for admin','No Open New Tab',1,1,'2024-03-19 10:36:05','2024-02-12 02:50:09','2024-03-19 10:36:05'),
(34,12,'Salesperson',NULL,'admin/salespersons','mdi mdi-account-settings',NULL,NULL,3,'Active','[\"salesperson-delete\",\"salesperson-edit\",\"salesperson-create\",\"salespersons\"]','Sub menu for admin','No Open New Tab',1,NULL,'2024-03-19 10:36:41','2024-02-14 10:58:05','2024-03-19 10:36:41'),
(35,12,'Designations',NULL,'admin/designations','mdi mdi-text',NULL,NULL,2,'Active','[\"designation-delete\",\"designation-edit\",\"designation-create\",\"designations\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-21 04:05:24','2024-03-21 04:06:11'),
(36,12,'Units',NULL,'admin/units','mdi mdi-text',NULL,NULL,3,'Active','[\"unit-delete\",\"unit-edit\",\"unit-create\",\"units\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-21 04:06:48','2024-03-21 04:06:48'),
(37,12,'Charges',NULL,'admin/charges','mdi mdi-text',NULL,NULL,4,'Active','[\"charge-delete\",\"charge-edit\",\"charge-create\",\"charges\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-21 04:07:12','2024-03-21 04:07:12'),
(38,12,'Warehouses',NULL,'admin/warehouses','mdi mdi-home',NULL,NULL,5,'Active','[\"warehouse-delete\",\"warehouse-edit\",\"warehouse-create\",\"warehouses\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-21 04:07:40','2024-03-21 04:07:53'),
(39,12,'Suppliers',NULL,'admin/suppliers','mdi mdi-account-settings',NULL,NULL,6,'Active','[\"supplier-delete\",\"supplier-edit\",\"supplier-create\",\"suppliers\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-21 04:08:26','2024-03-21 04:08:52'),
(40,12,'Customers',NULL,'admin/customers','mdi mdi-account-settings',NULL,NULL,7,'Active','[\"customer-delete\",\"customer-edit\",\"customer-create\",\"customers\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-21 04:09:35','2024-03-21 04:09:35'),
(41,19,'Attributes',NULL,'admin/attribute-options','uil-list-ui-alt',NULL,NULL,1,'Active','[\"attribute-option-delete\",\"attribute-option-edit\",\"attribute-option-create\",\"attribute-options\",\"attribute-delete\",\"attribute-edit\",\"attribute-create\",\"attributes\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-22 06:11:35','2024-03-22 06:14:15'),
(42,19,'Categories',NULL,'admin/categories','uil-list-ui-alt',NULL,NULL,2,'Active','[\"category-delete\",\"category-edit\",\"category-create\",\"categories\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-22 06:14:00','2024-03-22 06:14:00'),
(43,19,'Groups',NULL,'admin/product-groups','uil-list-ui-alt',NULL,NULL,3,'Active','[\"group-delete\",\"group-edit\",\"group-create\",\"groups\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-03-22 06:15:03','2024-03-22 06:15:03'),
(44,19,'Products',NULL,'admin/products','mdi mdi-format-align-justify',NULL,NULL,4,'Active','[\"product-delete\",\"product-edit\",\"product-create\",\"products\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-22 06:15:36','2024-03-22 06:17:17'),
(45,20,'LC Open',NULL,'admin/commercial/proforma-invoices','mdi mdi-paperclip',NULL,NULL,1,'Active','[\"proforma-invoice-delete\",\"proforma-invoice-edit\",\"proforma-invoice-create\",\"proforma-invoices\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-03-28 04:17:09','2024-04-27 05:36:05'),
(46,21,'Goods Received',NULL,'admin/factory/grns','mdi mdi-calendar-text',NULL,NULL,1,'Active','[\"good-received-note\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-01 06:42:23','2024-04-01 06:42:23'),
(47,21,'Gate In List',NULL,'admin/factory/gate-in-lists','mdi mdi-format-list-bulleted',NULL,NULL,2,'Active','[\"good-received-note-gate-in\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-01 06:43:30','2024-04-01 06:43:30'),
(48,21,'Gate Out List',NULL,'admin/factory/gate-out-lists','mdi mdi-backup-restore',NULL,NULL,3,'Active','[\"good-received-note-gate-out\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-01 06:44:37','2024-04-01 06:44:37'),
(49,21,'Quality Control',NULL,'admin/factory/quality-control','mdi mdi-checkbox-marked',NULL,NULL,4,'Active','[\"grn-quality-ensure\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-01 06:47:41','2024-04-01 06:47:41'),
(50,20,'Requisitions',NULL,'admin/commercial/requisitions','mdi mdi-currency-usd',NULL,NULL,3,'Active','[\"material-requisition-delete\",\"material-requisition-edit\",\"material-requisition-create\",\"material-requisitions\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-04-01 06:50:11','2024-04-17 06:40:30'),
(51,22,'Inventory List',NULL,'admin/store/inventory','mdi mdi-clipboard-flow',NULL,NULL,1,'Active','[\"inventory\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-04-01 06:53:54','2024-04-01 06:57:32'),
(52,22,'Expire Inventory',NULL,'admin/store/expire-inventory','mdi mdi-timer-sand-full',NULL,NULL,2,'Active','[\"inventory-expire-list\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-01 06:55:51','2024-04-01 06:55:51'),
(53,22,'Requisition List',NULL,'admin/store/requisition-list','mdi mdi-application',NULL,NULL,3,'Active','[\"inventory-delivery\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-04-01 07:00:38','2024-04-01 07:01:12'),
(54,20,'Work Orders',NULL,'admin/commercial/work-orders','mdi mdi-text',NULL,NULL,2,'Active','[\"work-order-delete\",\"work-order-edit\",\"work-order-create\",\"work-orders\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-04-07 08:30:50','2024-04-17 06:39:30'),
(55,23,'Production List',NULL,'admin/productions','mdi mdi-text',NULL,NULL,1,'Active','[\"productions\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-22 05:36:27','2024-04-22 05:36:27'),
(56,24,'Finished Goods',NULL,'admin/finished-goods','mdi mdi-text',NULL,NULL,1,'Active','[\"finished-goods\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-23 09:06:08','2024-04-23 09:06:08'),
(57,24,'FG Inspections',NULL,'admin/finished-goods-inspections','mdi mdi-text',NULL,NULL,2,'Active','[\"finished-good-inspection\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-04-23 09:07:22','2024-04-24 05:54:51'),
(58,24,'FG Inventories',NULL,'admin/finished-goods-inventories','mdi mdi-factory',NULL,NULL,3,'Active','[\"finished-good-inventory-list\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-04-23 09:08:31','2024-04-24 08:12:36'),
(59,24,'FG Delivery',NULL,'admin/finished-goods-deliveries','mdi mdi-text',NULL,NULL,5,'Active','[\"finished-good-delivery\"]','Sub menu for admin','No Open New Tab',1,1,NULL,'2024-04-23 09:11:16','2024-04-25 05:39:27'),
(60,24,'FG Reject List',NULL,'admin/finished-goods-rejects','mdi mdi-factory',NULL,NULL,4,'Active','[\"finished-good-reject-list\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-24 08:13:59','2024-04-24 08:13:59'),
(61,25,'BIllings',NULL,'admin/billings','mdi mdi-text',NULL,NULL,1,'Active','[\"billings\"]','Sub menu for admin','No Open New Tab',1,NULL,NULL,'2024-04-28 09:46:21','2024-04-28 09:46:21');

/*Table structure for table `sub_sub_menus` */

DROP TABLE IF EXISTS `sub_sub_menus`;

CREATE TABLE `sub_sub_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `sub_menu_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` tinyint(3) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sub Sub Menu for admin',
  `open_new_tab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Open New Tab',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_sub_menus_menu_id_foreign` (`menu_id`),
  KEY `sub_sub_menus_sub_menu_id_foreign` (`sub_menu_id`),
  KEY `sub_sub_menus_created_by_foreign` (`created_by`),
  KEY `sub_sub_menus_updated_by_foreign` (`updated_by`),
  CONSTRAINT `sub_sub_menus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_sub_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `sub_sub_menus_sub_menu_id_foreign` FOREIGN KEY (`sub_menu_id`) REFERENCES `sub_menus` (`id`),
  CONSTRAINT `sub_sub_menus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_sub_menus` */

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agreement` text COLLATE utf8mb4_unicode_ci,
  `term_conditions` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suppliers_created_by_foreign` (`created_by`),
  KEY `suppliers_updated_by_foreign` (`updated_by`),
  CONSTRAINT `suppliers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `suppliers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suppliers` */

insert  into `suppliers`(`id`,`name`,`code`,`segments`,`phone`,`email`,`mobile_no`,`tin`,`trade`,`bin`,`vat`,`website`,`agreement`,`term_conditions`,`address`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Pee Vee Tex., India','SPL-01','greige',NULL,NULL,NULL,NULL,'123',NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:31:29','2024-03-27 04:31:29'),
(2,'UTML','SPL-02','greige',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:32:27','2024-03-27 04:32:27'),
(3,'Zhejiang Dream, China','SPL-03','greige',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:32:39','2024-03-27 04:32:39'),
(4,'Active Tex Solution','SPL-04','d&c',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:32:55','2024-03-27 04:32:55'),
(5,'Alfya Traders','SPL-05','d&c',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,'2024-03-27 04:33:11','2024-03-27 04:33:11');

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `units_created_by_foreign` (`created_by`),
  KEY `units_updated_by_foreign` (`updated_by`),
  CONSTRAINT `units_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `units_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `units` */

insert  into `units`(`id`,`unit_name`,`unit_code`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Yds','U-0001','active',1,NULL,NULL,'2024-03-22 17:09:50','2024-03-22 17:13:09'),
(2,'KG','U-0002','active',1,NULL,NULL,'2024-03-22 17:09:57','2024-03-22 17:09:57'),
(3,'Gram','U-0003','active',1,1,NULL,'2024-03-22 17:10:22','2024-03-22 17:11:08'),
(4,'Pound','U-0004','active',1,NULL,NULL,'2024-03-22 17:11:14','2024-03-22 17:11:14'),
(5,'Box','U-0005','active',1,NULL,NULL,'2024-03-22 17:11:21','2024-03-22 17:11:21'),
(6,'Dozen','U-0006','active',1,NULL,NULL,'2024-03-22 17:11:29','2024-03-22 17:11:29'),
(7,'Piece','U-0007','active',1,NULL,NULL,'2024-03-22 17:11:46','2024-03-22 17:11:46');

/*Table structure for table `user_column_visibilities` */

DROP TABLE IF EXISTS `user_column_visibilities`;

CREATE TABLE `user_column_visibilities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `columns` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_column_visibilities_user_id_foreign` (`user_id`),
  CONSTRAINT `user_column_visibilities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_column_visibilities` */

insert  into `user_column_visibilities`(`id`,`user_id`,`url`,`columns`,`created_at`,`updated_at`) values
(1,1,'http://yb-customer-areas.test/admin/subscribers','[\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"false\",\"false\",\"false\",\"false\",\"false\",\"true\",\"false\",\"true\",\"false\"]','2024-02-22 07:01:22','2024-02-22 07:02:22'),
(2,1,'http://tru-fabrics-ltd.test/admin/acl/users','[\"true\",\"true\",\"true\",\"false\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\"]','2024-03-21 04:42:06','2024-03-21 04:42:06'),
(3,2,'http://tru-fabrics-ltd.test/admin/acl/users','[\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"false\",\"true\",\"true\",\"true\",\"true\"]','2024-03-21 04:46:11','2024-03-21 04:46:11'),
(4,1,'http://tru-fabrics-ltd.test/admin/units','[\"true\",\"true\",\"true\",\"true\",\"true\"]','2024-03-23 06:13:26','2024-03-23 06:13:28');

/*Table structure for table `user_departments` */

DROP TABLE IF EXISTS `user_departments`;

CREATE TABLE `user_departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_departments_user_id_foreign` (`user_id`),
  KEY `userDepId` (`department_id`),
  CONSTRAINT `userDepId` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `user_departments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_departments` */

insert  into `user_departments`(`id`,`user_id`,`department_id`,`created_at`,`updated_at`) values
(1,4,1,NULL,NULL),
(2,4,2,NULL,NULL),
(3,3,1,NULL,NULL),
(4,3,2,NULL,NULL),
(5,3,4,NULL,NULL),
(6,1,4,NULL,NULL);

/*Table structure for table `user_notification_events` */

DROP TABLE IF EXISTS `user_notification_events`;

CREATE TABLE `user_notification_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `notification_event_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_notification_events_user_id_foreign` (`user_id`),
  KEY `nEId` (`notification_event_id`),
  CONSTRAINT `nEId` FOREIGN KEY (`notification_event_id`) REFERENCES `notification_events` (`id`),
  CONSTRAINT `user_notification_events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_notification_events` */

insert  into `user_notification_events`(`id`,`user_id`,`notification_event_id`,`created_at`,`updated_at`) values
(1,4,57,NULL,NULL),
(2,4,58,NULL,NULL),
(3,4,59,NULL,NULL),
(4,4,60,NULL,NULL),
(5,4,61,NULL,NULL),
(6,4,62,NULL,NULL),
(7,3,57,NULL,NULL),
(8,3,58,NULL,NULL),
(9,3,60,NULL,NULL),
(10,3,61,NULL,NULL),
(12,1,58,NULL,NULL),
(13,1,59,NULL,NULL),
(14,1,60,NULL,NULL),
(15,1,61,NULL,NULL),
(16,1,62,NULL,NULL),
(17,1,63,NULL,NULL),
(18,1,64,NULL,NULL),
(19,1,65,NULL,NULL),
(20,1,66,NULL,NULL),
(21,1,67,NULL,NULL),
(22,1,68,NULL,NULL),
(23,1,69,NULL,NULL),
(24,1,70,NULL,NULL),
(25,1,57,NULL,NULL),
(26,1,71,NULL,NULL),
(27,3,59,NULL,NULL),
(28,3,62,NULL,NULL),
(29,3,63,NULL,NULL),
(30,3,64,NULL,NULL),
(31,3,65,NULL,NULL),
(32,3,66,NULL,NULL),
(33,3,67,NULL,NULL),
(34,3,68,NULL,NULL),
(35,3,69,NULL,NULL),
(36,3,70,NULL,NULL),
(37,3,71,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `designation_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('admin','seller','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_department_id_foreign` (`department_id`),
  KEY `users_designation_id_foreign` (`designation_id`),
  CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `users_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`department_id`,`designation_id`,`name`,`email`,`username`,`phone`,`avatar`,`bio`,`company_name`,`website`,`location`,`email_verified_at`,`password`,`type`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values
(1,4,3,'Super Admin','admin@bizzsol.com.bd','admin@bizzsol.com.bd','01754148869','uploads/users/997180124065328.png','Bizz Solutions PLC','Bizz Solutions PLC','https://bizzsol.com.bd','Dhaka',NULL,'$2y$12$FnXSzY.0KPnl66kfgIgenu5usGKDbYIcs44idtBIaTkFfe1MCkK/S','admin','HYLMIhxT8qyxU8MfBR69rls76qYU2FPteA8d96zKiYAStbzpgQ2le1L3cWC1','2024-01-18 22:40:25','2024-04-29 10:58:52',NULL),
(2,NULL,NULL,'Nahid','nahid@bizzsol.com.bd','nahid@bizzsol.com.bd','01689984966','uploads/users/572210324044658.png',NULL,NULL,NULL,'City centre 90/1, Level-25 Type-D2, Motijheel C/A, Dhaka-1000, Bangladesh.',NULL,'$2y$12$YIia3V7WvJYqZ2r4SVg9gum18xUZ3GrBi5yeALc.6fmiy8x69W5bu','admin','vcWowPDpUYRMc8IdoK5UdwY0v5WiJjPH07uwnthMticb41M6EtAcJNleVamA','2024-03-21 04:41:40','2024-03-21 04:46:58',NULL),
(3,4,3,'Masudur Rana','masudur.rana@bizzsol.com.bd',NULL,'18222521982',NULL,NULL,NULL,NULL,'City centre 90/1, Level-25 Type-D2, Motijheel C/A, Dhaka-1000, Bangladesh.',NULL,'$2y$12$wD8RxYjInMJuOlx.zv6gluNDExlbw2QVHKGqMVR9ykaCfb8K7wHi2','admin','ngBHFfqhnn7rhk8rj2P9iIbVGfSkIWLZ4HCsyYeEDd6q4jwaU5QzBPh63r6R','2024-04-29 07:18:27','2024-04-29 07:18:27',NULL),
(4,1,1,'Hridoy Khan','khan@bizzsol.com.bd',NULL,'98734208090',NULL,NULL,NULL,NULL,'City centre 90/1, Level-25 Type-D2, Motijheel C/A, Dhaka-1000, Bangladesh.',NULL,'$2y$12$PZOLbc7qdIjegmFp5RpVCeJZHvKG2c0Ah/IGoOVq4eXNlbBh7uxZG','admin','742789c93595bfc5315268e12d641bc3','2024-04-29 07:23:41','2024-04-29 07:23:41',NULL);

/*Table structure for table `warehouses` */

DROP TABLE IF EXISTS `warehouses`;

CREATE TABLE `warehouses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehouses_created_by_foreign` (`created_by`),
  KEY `warehouses_updated_by_foreign` (`updated_by`),
  CONSTRAINT `warehouses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `warehouses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `warehouses` */

insert  into `warehouses`(`id`,`name`,`code`,`phone`,`email`,`location`,`address`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'Greige Store','WH-001','01822252198','info@bizzsol.com.bd','Narayanganj','Noapara, Tarabo, Rupgonj, Narayanganj','active',1,NULL,NULL,'2024-03-22 17:17:44','2024-03-22 17:17:44'),
(2,'Dyes & Chemical Store','WH-002',NULL,NULL,NULL,'Noapara, Tarabo, Rupgonj, Narayanganj','active',1,NULL,NULL,'2024-03-22 17:22:05','2024-03-22 17:22:05'),
(3,'FG & Delivery Store','WH-003',NULL,NULL,'Narayanganj','Noapara, Tarabo, Rupgonj, Narayanganj','active',1,NULL,NULL,'2024-03-22 17:22:33','2024-03-22 17:22:33');

/*Table structure for table `work_order_charges` */

DROP TABLE IF EXISTS `work_order_charges`;

CREATE TABLE `work_order_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` bigint(20) unsigned NOT NULL,
  `charge_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_order_charges_work_order_id_foreign` (`work_order_id`),
  KEY `work_order_charges_charge_id_foreign` (`charge_id`),
  CONSTRAINT `work_order_charges_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`),
  CONSTRAINT `work_order_charges_work_order_id_foreign` FOREIGN KEY (`work_order_id`) REFERENCES `work_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `work_order_charges` */

insert  into `work_order_charges`(`id`,`work_order_id`,`charge_id`,`amount`,`created_at`,`updated_at`) values
(1,1,8,1200,'2024-04-22 08:57:00',NULL),
(2,1,7,800,'2024-04-22 08:57:00',NULL);

/*Table structure for table `work_order_items` */

DROP TABLE IF EXISTS `work_order_items`;

CREATE TABLE `work_order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `qty` double NOT NULL DEFAULT '0',
  `sub_total` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_order_items_work_order_id_foreign` (`work_order_id`),
  KEY `work_order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `work_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `work_order_items_work_order_id_foreign` FOREIGN KEY (`work_order_id`) REFERENCES `work_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `work_order_items` */

insert  into `work_order_items`(`id`,`work_order_id`,`product_id`,`price`,`qty`,`sub_total`,`created_at`,`updated_at`) values
(6,1,6,20,30,600,'2024-04-17 06:20:00','2024-04-17 06:20:00'),
(7,1,9,25,40,1000,'2024-04-17 06:20:00','2024-04-17 06:20:00'),
(8,1,7,35,50,1750,'2024-04-17 06:20:00','2024-04-17 06:20:00'),
(9,2,9,12,500,6000,'2024-04-22 04:53:00',NULL),
(10,2,8,300,500,150000,'2024-04-22 04:53:00',NULL),
(11,3,9,25,250,6250,'2024-04-27 06:00:00',NULL),
(12,4,9,120,200,24000,'2024-04-30 05:21:00',NULL);

/*Table structure for table `work_orders` */

DROP TABLE IF EXISTS `work_orders`;

CREATE TABLE `work_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garments_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `lab_dep_approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shrinkage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `terms_condition` text COLLATE utf8mb4_unicode_ci,
  `wo_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_orders_customer_id_foreign` (`customer_id`),
  KEY `work_orders_created_by_foreign` (`created_by`),
  KEY `work_orders_updated_by_foreign` (`updated_by`),
  CONSTRAINT `work_orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `work_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `work_orders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `work_orders` */

insert  into `work_orders`(`id`,`reference_no`,`work_order_no`,`garments_name`,`customer_id`,`lab_dep_approval`,`shrinkage`,`delivery_date`,`terms_condition`,`wo_file`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values
(1,'WO-24-TRU-0001','DEL-099833','Denim Expert Ltd',2,'Yes','5.6\"','2024-05-31','Finished Goods test','uploads/work-orders/352170424051852.pdf','approved',1,1,NULL,'2024-04-17 05:18:52','2024-04-17 06:19:21'),
(2,'WO-24-TRU-0002','DEL-09983332','Shin Shin Apparels',3,'Yes','343','2024-04-22','Test',NULL,'approved',1,NULL,NULL,'2024-04-22 04:53:16','2024-04-22 04:53:16'),
(3,'WO-24-TRU-0003','DEL-0998332323','SF jenas',5,'Yes','33%','2024-08-31','Tessefe','uploads/work-orders/428270424060008.png','approved',1,1,NULL,'2024-04-27 06:00:08','2024-04-27 06:00:08'),
(4,'WO-24-TRU-0004','DEL-09983322','Laila Styles Ltd',4,'Yes','23\"','2024-04-30','Test the work orders',NULL,'approved',1,NULL,NULL,'2024-04-30 05:21:05','2024-04-30 05:21:05');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
