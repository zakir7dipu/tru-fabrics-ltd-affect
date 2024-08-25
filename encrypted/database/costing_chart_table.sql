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
/*Table structure for table `costing_chart_items` */

CREATE TABLE `costing_chart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `costing_chart_id` bigint(20) unsigned DEFAULT NULL,
  `process_id` bigint(20) unsigned DEFAULT NULL,
  `gsm_range_id` bigint(20) unsigned DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `costing_chart_items_costing_chart_id_foreign` (`costing_chart_id`),
  KEY `costing_chart_items_process_id_foreign` (`process_id`),
  KEY `costing_chart_items_gsm_range_id_foreign` (`gsm_range_id`),
  CONSTRAINT `costing_chart_items_costing_chart_id_foreign` FOREIGN KEY (`costing_chart_id`) REFERENCES `costing_charts` (`id`),
  CONSTRAINT `costing_chart_items_gsm_range_id_foreign` FOREIGN KEY (`gsm_range_id`) REFERENCES `gsm_ranges` (`id`),
  CONSTRAINT `costing_chart_items_process_id_foreign` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `costing_chart_items` */

/*Table structure for table `costing_charts` */

CREATE TABLE `costing_charts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `currency_id` bigint(20) unsigned NOT NULL,
  `currency_convert_rate` double NOT NULL DEFAULT '0',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `costing_charts_created_by_foreign` (`created_by`),
  KEY `costing_charts_updated_by_foreign` (`updated_by`),
  KEY `costing_charts_currency_id_foreign` (`currency_id`),
  CONSTRAINT `costing_charts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `costing_charts_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `costing_charts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `costing_charts` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
