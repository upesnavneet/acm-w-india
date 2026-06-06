-- MySQL dump 10.13  Distrib 8.4.0, for Win64 (x86_64)
--
-- Host: ::1    Database: local
-- ------------------------------------------------------
-- Server version	8.4.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wp_actionscheduler_actions`
--

DROP TABLE IF EXISTS `wp_actionscheduler_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_actionscheduler_actions` (
  `action_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hook` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `scheduled_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `scheduled_date_local` datetime DEFAULT '0000-00-00 00:00:00',
  `priority` tinyint unsigned NOT NULL DEFAULT '10',
  `args` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `schedule` longtext COLLATE utf8mb4_unicode_520_ci,
  `group_id` bigint unsigned NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '0',
  `last_attempt_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `last_attempt_local` datetime DEFAULT '0000-00-00 00:00:00',
  `claim_id` bigint unsigned NOT NULL DEFAULT '0',
  `extended_args` varchar(8000) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`action_id`),
  KEY `hook_status_scheduled_date_gmt` (`hook`(163),`status`,`scheduled_date_gmt`),
  KEY `status_scheduled_date_gmt` (`status`,`scheduled_date_gmt`),
  KEY `scheduled_date_gmt` (`scheduled_date_gmt`),
  KEY `args` (`args`),
  KEY `group_id` (`group_id`),
  KEY `last_attempt_gmt` (`last_attempt_gmt`),
  KEY `claim_id_status_priority_scheduled_date_gmt` (`claim_id`,`status`,`priority`,`scheduled_date_gmt`),
  KEY `status_last_attempt_gmt` (`status`,`last_attempt_gmt`),
  KEY `status_claim_id` (`status`,`claim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_actions`
--

LOCK TABLES `wp_actionscheduler_actions` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_actions` DISABLE KEYS */;
INSERT INTO `wp_actionscheduler_actions` VALUES (7,'action_scheduler_run_recurring_actions_schedule_hook','complete','2026-05-28 12:06:34','2026-05-28 12:06:34',20,'[]','O:32:\"ActionScheduler_IntervalSchedule\":5:{s:22:\"\0*\0scheduled_timestamp\";i:1779969994;s:18:\"\0*\0first_timestamp\";i:1779969994;s:13:\"\0*\0recurrence\";i:86400;s:49:\"\0ActionScheduler_IntervalSchedule\0start_timestamp\";i:1779969994;s:53:\"\0ActionScheduler_IntervalSchedule\0interval_in_seconds\";i:86400;}',1,1,'2026-05-28 12:07:24','2026-05-28 12:07:24',1,NULL);
INSERT INTO `wp_actionscheduler_actions` VALUES (8,'tec_clear_expired_key_value_cache','complete','2026-05-29 00:07:15','2026-05-29 00:07:15',10,'[]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1780013235;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1780013235;}',2,1,'2026-05-29 04:10:41','2026-05-29 04:10:41',53,NULL);
INSERT INTO `wp_actionscheduler_actions` VALUES (9,'action_scheduler/migration_hook','complete','2026-05-28 12:08:15','2026-05-28 12:08:15',10,'[]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1779970095;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1779970095;}',3,1,'2026-05-28 12:08:38','2026-05-28 12:08:38',4,NULL);
INSERT INTO `wp_actionscheduler_actions` VALUES (10,'action_scheduler_run_recurring_actions_schedule_hook','complete','2026-05-29 12:07:24','2026-05-29 12:07:24',20,'[]','O:32:\"ActionScheduler_IntervalSchedule\":5:{s:22:\"\0*\0scheduled_timestamp\";i:1780056444;s:18:\"\0*\0first_timestamp\";i:1779969994;s:13:\"\0*\0recurrence\";i:86400;s:49:\"\0ActionScheduler_IntervalSchedule\0start_timestamp\";i:1780056444;s:53:\"\0ActionScheduler_IntervalSchedule\0interval_in_seconds\";i:86400;}',1,1,'2026-05-30 10:08:59','2026-05-30 10:08:59',137,NULL);
INSERT INTO `wp_actionscheduler_actions` VALUES (11,'tec_clear_expired_key_value_cache','complete','2026-05-29 16:10:43','2026-05-29 16:10:43',10,'[]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1780071043;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1780071043;}',2,1,'2026-05-30 10:08:59','2026-05-30 10:08:59',137,NULL);
INSERT INTO `wp_actionscheduler_actions` VALUES (12,'action_scheduler_run_recurring_actions_schedule_hook','complete','2026-05-31 10:08:59','2026-05-31 10:08:59',20,'[]','O:32:\"ActionScheduler_IntervalSchedule\":5:{s:22:\"\0*\0scheduled_timestamp\";i:1780222139;s:18:\"\0*\0first_timestamp\";i:1779969994;s:13:\"\0*\0recurrence\";i:86400;s:49:\"\0ActionScheduler_IntervalSchedule\0start_timestamp\";i:1780222139;s:53:\"\0ActionScheduler_IntervalSchedule\0interval_in_seconds\";i:86400;}',1,1,'2026-06-01 08:06:29','2026-06-01 08:06:29',139,NULL);
INSERT INTO `wp_actionscheduler_actions` VALUES (13,'tec_clear_expired_key_value_cache','pending','2026-06-01 20:06:28','2026-06-01 20:06:28',10,'[]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1780344388;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1780344388;}',2,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,NULL);
INSERT INTO `wp_actionscheduler_actions` VALUES (14,'action_scheduler_run_recurring_actions_schedule_hook','pending','2026-06-02 08:06:29','2026-06-02 08:06:29',20,'[]','O:32:\"ActionScheduler_IntervalSchedule\":5:{s:22:\"\0*\0scheduled_timestamp\";i:1780387589;s:18:\"\0*\0first_timestamp\";i:1779969994;s:13:\"\0*\0recurrence\";i:86400;s:49:\"\0ActionScheduler_IntervalSchedule\0start_timestamp\";i:1780387589;s:53:\"\0ActionScheduler_IntervalSchedule\0interval_in_seconds\";i:86400;}',1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,NULL);
/*!40000 ALTER TABLE `wp_actionscheduler_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_actionscheduler_claims`
--

DROP TABLE IF EXISTS `wp_actionscheduler_claims`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_actionscheduler_claims` (
  `claim_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date_created_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`claim_id`),
  KEY `date_created_gmt` (`date_created_gmt`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_claims`
--

LOCK TABLES `wp_actionscheduler_claims` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_claims` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_actionscheduler_claims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_actionscheduler_groups`
--

DROP TABLE IF EXISTS `wp_actionscheduler_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_actionscheduler_groups` (
  `group_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `slug` (`slug`(191))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_groups`
--

LOCK TABLES `wp_actionscheduler_groups` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_groups` DISABLE KEYS */;
INSERT INTO `wp_actionscheduler_groups` VALUES (1,'ActionScheduler');
INSERT INTO `wp_actionscheduler_groups` VALUES (2,'');
INSERT INTO `wp_actionscheduler_groups` VALUES (3,'action-scheduler-migration');
/*!40000 ALTER TABLE `wp_actionscheduler_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_actionscheduler_logs`
--

DROP TABLE IF EXISTS `wp_actionscheduler_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_actionscheduler_logs` (
  `log_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `action_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `log_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `log_date_local` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`log_id`),
  KEY `action_id` (`action_id`),
  KEY `log_date_gmt` (`log_date_gmt`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_logs`
--

LOCK TABLES `wp_actionscheduler_logs` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_logs` DISABLE KEYS */;
INSERT INTO `wp_actionscheduler_logs` VALUES (1,7,'action created','2026-05-28 12:06:34','2026-05-28 12:06:34');
INSERT INTO `wp_actionscheduler_logs` VALUES (2,8,'action created','2026-05-28 12:07:15','2026-05-28 12:07:15');
INSERT INTO `wp_actionscheduler_logs` VALUES (3,9,'action created','2026-05-28 12:07:15','2026-05-28 12:07:15');
INSERT INTO `wp_actionscheduler_logs` VALUES (4,7,'action started via WP Cron','2026-05-28 12:07:24','2026-05-28 12:07:24');
INSERT INTO `wp_actionscheduler_logs` VALUES (5,7,'action complete via WP Cron','2026-05-28 12:07:24','2026-05-28 12:07:24');
INSERT INTO `wp_actionscheduler_logs` VALUES (6,10,'action created','2026-05-28 12:07:24','2026-05-28 12:07:24');
INSERT INTO `wp_actionscheduler_logs` VALUES (7,9,'action started via WP Cron','2026-05-28 12:08:38','2026-05-28 12:08:38');
INSERT INTO `wp_actionscheduler_logs` VALUES (8,9,'action complete via WP Cron','2026-05-28 12:08:38','2026-05-28 12:08:38');
INSERT INTO `wp_actionscheduler_logs` VALUES (9,8,'action started via Async Request','2026-05-29 04:10:41','2026-05-29 04:10:41');
INSERT INTO `wp_actionscheduler_logs` VALUES (10,8,'action complete via Async Request','2026-05-29 04:10:41','2026-05-29 04:10:41');
INSERT INTO `wp_actionscheduler_logs` VALUES (11,11,'action created','2026-05-29 04:10:43','2026-05-29 04:10:43');
INSERT INTO `wp_actionscheduler_logs` VALUES (12,11,'action started via WP Cron','2026-05-30 10:08:58','2026-05-30 10:08:58');
INSERT INTO `wp_actionscheduler_logs` VALUES (13,11,'action complete via WP Cron','2026-05-30 10:08:59','2026-05-30 10:08:59');
INSERT INTO `wp_actionscheduler_logs` VALUES (14,10,'action started via WP Cron','2026-05-30 10:08:59','2026-05-30 10:08:59');
INSERT INTO `wp_actionscheduler_logs` VALUES (15,10,'action complete via WP Cron','2026-05-30 10:08:59','2026-05-30 10:08:59');
INSERT INTO `wp_actionscheduler_logs` VALUES (16,12,'action created','2026-05-30 10:08:59','2026-05-30 10:08:59');
INSERT INTO `wp_actionscheduler_logs` VALUES (17,13,'action created','2026-06-01 08:06:28','2026-06-01 08:06:28');
INSERT INTO `wp_actionscheduler_logs` VALUES (18,12,'action started via WP Cron','2026-06-01 08:06:29','2026-06-01 08:06:29');
INSERT INTO `wp_actionscheduler_logs` VALUES (19,12,'action complete via WP Cron','2026-06-01 08:06:29','2026-06-01 08:06:29');
INSERT INTO `wp_actionscheduler_logs` VALUES (20,14,'action created','2026-06-01 08:06:29','2026-06-01 08:06:29');
/*!40000 ALTER TABLE `wp_actionscheduler_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_commentmeta`
--

LOCK TABLES `wp_commentmeta` WRITE;
/*!40000 ALTER TABLE `wp_commentmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_commentmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_comments` (
  `comment_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'comment',
  `comment_parent` bigint unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_comments`
--

LOCK TABLES `wp_comments` WRITE;
/*!40000 ALTER TABLE `wp_comments` DISABLE KEYS */;
INSERT INTO `wp_comments` VALUES (1,1,'A WordPress Commenter','wapuu@wordpress.example','https://wordpress.org/','','2026-05-28 11:58:04','2026-05-28 11:58:04','Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com/\">Gravatar</a>.',0,'1','','comment',0,0);
/*!40000 ALTER TABLE `wp_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_duplicator_packages`
--

DROP TABLE IF EXISTS `wp_duplicator_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_duplicator_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `hash` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `owner` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `package` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_duplicator_packages`
--

LOCK TABLES `wp_duplicator_packages` WRITE;
/*!40000 ALTER TABLE `wp_duplicator_packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_duplicator_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_links` (
  `link_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint unsigned NOT NULL DEFAULT '1',
  `link_rating` int NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_links`
--

LOCK TABLES `wp_links` WRITE;
/*!40000 ALTER TABLE `wp_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_options` (
  `option_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=InnoDB AUTO_INCREMENT=1033 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_options`
--

LOCK TABLES `wp_options` WRITE;
/*!40000 ALTER TABLE `wp_options` DISABLE KEYS */;
INSERT INTO `wp_options` VALUES (1,'cron','a:22:{i:1780306894;a:1:{s:26:\"action_scheduler_run_queue\";a:1:{s:32:\"0d04ed39571b55704c122d726248bbac\";a:3:{s:8:\"schedule\";s:12:\"every_minute\";s:4:\"args\";a:1:{i:0;s:7:\"WP Cron\";}s:8:\"interval\";i:60;}}}i:1780306900;a:1:{s:19:\"wpfts_indexer_event\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:17:\"wpfts_each_minute\";s:4:\"args\";a:0:{}s:8:\"interval\";i:60;}}}i:1780307886;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1780308400;a:1:{s:15:\"wpfts_log_clean\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:15:\"wpfts_each_hour\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1780315086;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1780315232;a:3:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:21:\"wp_update_user_counts\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1780315236;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1780315361;a:1:{s:27:\"acf_update_site_health_data\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1780315594;a:2:{s:16:\"tribe_daily_cron\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:30:\"tribe_schedule_transient_purge\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1780315595;a:1:{s:24:\"tribe_common_log_cleanup\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1780315626;a:2:{s:13:\"wpseo-reindex\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:31:\"wpseo_permalink_structure_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1780315635;a:1:{s:29:\"wpseo_detect_default_seo_data\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1780318684;a:1:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1780320484;a:1:{s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1780322284;a:1:{s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1780322400;a:1:{s:29:\"duplicator_email_summary_cron\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:22:\"duplicator_weekly_cron\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}i:1780330148;a:1:{s:30:\"duplicator_usage_tracking_cron\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:22:\"duplicator_weekly_cron\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}i:1780341498;a:1:{s:39:\"puc_cron_check_updates_theme-acm-update\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1780574553;a:1:{s:30:\"wp_delete_temp_updater_backups\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}i:1780574835;a:1:{s:28:\"wpseo_expiring_store_cleanup\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}i:1780660686;a:1:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}','on');
INSERT INTO `wp_options` VALUES (2,'siteurl','http://acm-local.local','on');
INSERT INTO `wp_options` VALUES (3,'home','http://acm-local.local','on');
INSERT INTO `wp_options` VALUES (4,'blogname','acm-local','on');
INSERT INTO `wp_options` VALUES (5,'blogdescription','','on');
INSERT INTO `wp_options` VALUES (6,'users_can_register','0','on');
INSERT INTO `wp_options` VALUES (7,'admin_email','kumarnavneet7765@gmail.com','on');
INSERT INTO `wp_options` VALUES (8,'start_of_week','1','on');
INSERT INTO `wp_options` VALUES (9,'use_balanceTags','0','on');
INSERT INTO `wp_options` VALUES (10,'use_smilies','1','on');
INSERT INTO `wp_options` VALUES (11,'require_name_email','1','on');
INSERT INTO `wp_options` VALUES (12,'comments_notify','1','on');
INSERT INTO `wp_options` VALUES (13,'posts_per_rss','10','on');
INSERT INTO `wp_options` VALUES (14,'rss_use_excerpt','0','on');
INSERT INTO `wp_options` VALUES (15,'mailserver_url','mail.example.com','on');
INSERT INTO `wp_options` VALUES (16,'mailserver_login','login@example.com','on');
INSERT INTO `wp_options` VALUES (17,'mailserver_pass','','on');
INSERT INTO `wp_options` VALUES (18,'mailserver_port','110','on');
INSERT INTO `wp_options` VALUES (19,'default_category','1','on');
INSERT INTO `wp_options` VALUES (20,'default_comment_status','open','on');
INSERT INTO `wp_options` VALUES (21,'default_ping_status','open','on');
INSERT INTO `wp_options` VALUES (22,'default_pingback_flag','1','on');
INSERT INTO `wp_options` VALUES (23,'posts_per_page','10','on');
INSERT INTO `wp_options` VALUES (24,'date_format','F j, Y','on');
INSERT INTO `wp_options` VALUES (25,'time_format','g:i a','on');
INSERT INTO `wp_options` VALUES (26,'links_updated_date_format','F j, Y g:i a','on');
INSERT INTO `wp_options` VALUES (27,'comment_moderation','0','on');
INSERT INTO `wp_options` VALUES (28,'moderation_notify','1','on');
INSERT INTO `wp_options` VALUES (29,'permalink_structure','/%postname%/','on');
INSERT INTO `wp_options` VALUES (30,'rewrite_rules','a:267:{s:28:\"tribe/events/kitchen-sink/?$\";s:69:\"index.php?post_type=tribe_events&tribe_events_views_kitchen_sink=page\";s:93:\"tribe/events/kitchen-sink/(page|grid|typographical|elements|events-bar|navigation|manager)/?$\";s:76:\"index.php?post_type=tribe_events&tribe_events_views_kitchen_sink=$matches[1]\";s:20:\"events/qr/([^/]+)/?$\";s:33:\"index.php?tec_qr_hash=$matches[1]\";s:28:\"event-aggregator/(insert)/?$\";s:53:\"index.php?tribe-aggregator=1&tribe-action=$matches[1]\";s:25:\"(?:event)/([^/]+)/ical/?$\";s:56:\"index.php?ical=1&name=$matches[1]&post_type=tribe_events\";s:28:\"(?:events)/(?:page)/(\\d+)/?$\";s:71:\"index.php?post_type=tribe_events&eventDisplay=default&paged=$matches[1]\";s:41:\"(?:events)/(?:featured)/(?:page)/(\\d+)/?$\";s:79:\"index.php?post_type=tribe_events&featured=1&eventDisplay=list&paged=$matches[1]\";s:38:\"(?:events)/(feed|rdf|rss|rss2|atom)/?$\";s:67:\"index.php?post_type=tribe_events&eventDisplay=list&feed=$matches[1]\";s:51:\"(?:events)/(?:featured)/(feed|rdf|rss|rss2|atom)/?$\";s:78:\"index.php?post_type=tribe_events&featured=1&eventDisplay=list&feed=$matches[1]\";s:23:\"(?:events)/(?:month)/?$\";s:51:\"index.php?post_type=tribe_events&eventDisplay=month\";s:36:\"(?:events)/(?:month)/(?:featured)/?$\";s:62:\"index.php?post_type=tribe_events&eventDisplay=month&featured=1\";s:37:\"(?:events)/(?:month)/(\\d{4}-\\d{2})/?$\";s:73:\"index.php?post_type=tribe_events&eventDisplay=month&eventDate=$matches[1]\";s:37:\"(?:events)/(?:list)/(?:page)/(\\d+)/?$\";s:68:\"index.php?post_type=tribe_events&eventDisplay=list&paged=$matches[1]\";s:50:\"(?:events)/(?:list)/(?:featured)/(?:page)/(\\d+)/?$\";s:79:\"index.php?post_type=tribe_events&eventDisplay=list&featured=1&paged=$matches[1]\";s:22:\"(?:events)/(?:list)/?$\";s:50:\"index.php?post_type=tribe_events&eventDisplay=list\";s:35:\"(?:events)/(?:list)/(?:featured)/?$\";s:61:\"index.php?post_type=tribe_events&eventDisplay=list&featured=1\";s:23:\"(?:events)/(?:today)/?$\";s:49:\"index.php?post_type=tribe_events&eventDisplay=day\";s:36:\"(?:events)/(?:today)/(?:featured)/?$\";s:60:\"index.php?post_type=tribe_events&eventDisplay=day&featured=1\";s:27:\"(?:events)/(\\d{4}-\\d{2})/?$\";s:73:\"index.php?post_type=tribe_events&eventDisplay=month&eventDate=$matches[1]\";s:40:\"(?:events)/(\\d{4}-\\d{2})/(?:featured)/?$\";s:84:\"index.php?post_type=tribe_events&eventDisplay=month&eventDate=$matches[1]&featured=1\";s:33:\"(?:events)/(\\d{4}-\\d{2}-\\d{2})/?$\";s:71:\"index.php?post_type=tribe_events&eventDisplay=day&eventDate=$matches[1]\";s:46:\"(?:events)/(\\d{4}-\\d{2}-\\d{2})/(?:featured)/?$\";s:82:\"index.php?post_type=tribe_events&eventDisplay=day&eventDate=$matches[1]&featured=1\";s:26:\"(?:events)/(?:featured)/?$\";s:43:\"index.php?post_type=tribe_events&featured=1\";s:13:\"(?:events)/?$\";s:53:\"index.php?post_type=tribe_events&eventDisplay=default\";s:18:\"(?:events)/ical/?$\";s:39:\"index.php?post_type=tribe_events&ical=1\";s:31:\"(?:events)/(?:featured)/ical/?$\";s:50:\"index.php?post_type=tribe_events&ical=1&featured=1\";s:38:\"(?:events)/(\\d{4}-\\d{2}-\\d{2})/ical/?$\";s:78:\"index.php?post_type=tribe_events&ical=1&eventDisplay=day&eventDate=$matches[1]\";s:51:\"(?:events)/(\\d{4}-\\d{2}-\\d{2})/ical/(?:featured)/?$\";s:89:\"index.php?post_type=tribe_events&ical=1&eventDisplay=day&eventDate=$matches[1]&featured=1\";s:60:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:page)/(\\d+)/?$\";s:97:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=list&paged=$matches[2]\";s:73:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:featured)/(?:page)/(\\d+)/?$\";s:108:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&featured=1&eventDisplay=list&paged=$matches[2]\";s:55:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:month)/?$\";s:80:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=month\";s:68:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:month)/(?:featured)/?$\";s:91:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=month&featured=1\";s:69:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:list)/(?:page)/(\\d+)/?$\";s:97:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=list&paged=$matches[2]\";s:82:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:list)/(?:featured)/(?:page)/(\\d+)/?$\";s:108:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=list&featured=1&paged=$matches[2]\";s:54:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:list)/?$\";s:79:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=list\";s:67:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:list)/(?:featured)/?$\";s:90:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=list&featured=1\";s:55:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:today)/?$\";s:78:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=day\";s:68:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:today)/(?:featured)/?$\";s:89:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=day&featured=1\";s:73:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:day)/(\\d{4}-\\d{2}-\\d{2})/?$\";s:100:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=day&eventDate=$matches[2]\";s:86:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:day)/(\\d{4}-\\d{2}-\\d{2})/(?:featured)/?$\";s:111:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=day&eventDate=$matches[2]&featured=1\";s:59:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(\\d{4}-\\d{2})/?$\";s:102:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=month&eventDate=$matches[2]\";s:72:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(\\d{4}-\\d{2})/(?:featured)/?$\";s:113:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=month&eventDate=$matches[2]&featured=1\";s:65:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(\\d{4}-\\d{2}-\\d{2})/?$\";s:100:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=day&eventDate=$matches[2]\";s:78:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(\\d{4}-\\d{2}-\\d{2})/(?:featured)/?$\";s:111:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=day&eventDate=$matches[2]&featured=1\";s:50:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/feed/?$\";s:89:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=list&feed=rss2\";s:63:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:featured)/feed/?$\";s:100:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&featured=1&eventDisplay=list&feed=rss2\";s:50:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/ical/?$\";s:68:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&ical=1\";s:63:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:featured)/ical/?$\";s:79:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&featured=1&ical=1\";s:75:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:78:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&feed=$matches[2]\";s:88:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:featured)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:89:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&featured=1&feed=$matches[2]\";s:58:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/(?:featured)/?$\";s:93:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&featured=1&eventDisplay=default\";s:45:\"(?:events)/(?:category)/(?:[^/]+/)*([^/]+)/?$\";s:82:\"index.php?post_type=tribe_events&tribe_events_cat=$matches[1]&eventDisplay=default\";s:44:\"(?:events)/(?:tag)/([^/]+)/(?:page)/(\\d+)/?$\";s:84:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=list&paged=$matches[2]\";s:57:\"(?:events)/(?:tag)/([^/]+)/(?:featured)/(?:page)/(\\d+)/?$\";s:95:\"index.php?post_type=tribe_events&tag=$matches[1]&featured=1&eventDisplay=list&paged=$matches[2]\";s:39:\"(?:events)/(?:tag)/([^/]+)/(?:month)/?$\";s:67:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=month\";s:52:\"(?:events)/(?:tag)/([^/]+)/(?:month)/(?:featured)/?$\";s:78:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=month&featured=1\";s:53:\"(?:events)/(?:tag)/([^/]+)/(?:list)/(?:page)/(\\d+)/?$\";s:84:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=list&paged=$matches[2]\";s:66:\"(?:events)/(?:tag)/([^/]+)/(?:list)/(?:featured)/(?:page)/(\\d+)/?$\";s:95:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=list&featured=1&paged=$matches[2]\";s:38:\"(?:events)/(?:tag)/([^/]+)/(?:list)/?$\";s:66:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=list\";s:51:\"(?:events)/(?:tag)/([^/]+)/(?:list)/(?:featured)/?$\";s:77:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=list&featured=1\";s:39:\"(?:events)/(?:tag)/([^/]+)/(?:today)/?$\";s:65:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=day\";s:52:\"(?:events)/(?:tag)/([^/]+)/(?:today)/(?:featured)/?$\";s:76:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=day&featured=1\";s:57:\"(?:events)/(?:tag)/([^/]+)/(?:day)/(\\d{4}-\\d{2}-\\d{2})/?$\";s:87:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=day&eventDate=$matches[2]\";s:70:\"(?:events)/(?:tag)/([^/]+)/(?:day)/(\\d{4}-\\d{2}-\\d{2})/(?:featured)/?$\";s:98:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=day&eventDate=$matches[2]&featured=1\";s:43:\"(?:events)/(?:tag)/([^/]+)/(\\d{4}-\\d{2})/?$\";s:89:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=month&eventDate=$matches[2]\";s:56:\"(?:events)/(?:tag)/([^/]+)/(\\d{4}-\\d{2})/(?:featured)/?$\";s:100:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=month&eventDate=$matches[2]&featured=1\";s:49:\"(?:events)/(?:tag)/([^/]+)/(\\d{4}-\\d{2}-\\d{2})/?$\";s:87:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=day&eventDate=$matches[2]\";s:62:\"(?:events)/(?:tag)/([^/]+)/(\\d{4}-\\d{2}-\\d{2})/(?:featured)/?$\";s:98:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=day&eventDate=$matches[2]&featured=1\";s:34:\"(?:events)/(?:tag)/([^/]+)/feed/?$\";s:76:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=list&feed=rss2\";s:47:\"(?:events)/(?:tag)/([^/]+)/(?:featured)/feed/?$\";s:87:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=list&feed=rss2&featured=1\";s:34:\"(?:events)/(?:tag)/([^/]+)/ical/?$\";s:55:\"index.php?post_type=tribe_events&tag=$matches[1]&ical=1\";s:47:\"(?:events)/(?:tag)/([^/]+)/(?:featured)/ical/?$\";s:66:\"index.php?post_type=tribe_events&tag=$matches[1]&featured=1&ical=1\";s:59:\"(?:events)/(?:tag)/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:65:\"index.php?post_type=tribe_events&tag=$matches[1]&feed=$matches[2]\";s:72:\"(?:events)/(?:tag)/([^/]+)/(?:featured)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:76:\"index.php?post_type=tribe_events&tag=$matches[1]&featured=1&feed=$matches[2]\";s:42:\"(?:events)/(?:tag)/([^/]+)/(?:featured)/?$\";s:59:\"index.php?post_type=tribe_events&tag=$matches[1]&featured=1\";s:29:\"(?:events)/(?:tag)/([^/]+)/?$\";s:69:\"index.php?post_type=tribe_events&tag=$matches[1]&eventDisplay=default\";s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:22:\"tribe-promoter-auth/?$\";s:37:\"index.php?tribe-promoter-auth-check=1\";s:8:\"event/?$\";s:32:\"index.php?post_type=tribe_events\";s:38:\"event/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?post_type=tribe_events&feed=$matches[1]\";s:33:\"event/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?post_type=tribe_events&feed=$matches[1]\";s:25:\"event/page/([0-9]{1,})/?$\";s:50:\"index.php?post_type=tribe_events&paged=$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:33:\"venue/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:43:\"venue/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:63:\"venue/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"venue/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"venue/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:39:\"venue/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:22:\"venue/([^/]+)/embed/?$\";s:44:\"index.php?tribe_venue=$matches[1]&embed=true\";s:26:\"venue/([^/]+)/trackback/?$\";s:38:\"index.php?tribe_venue=$matches[1]&tb=1\";s:34:\"venue/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?tribe_venue=$matches[1]&paged=$matches[2]\";s:41:\"venue/([^/]+)/comment-page-([0-9]{1,})/?$\";s:51:\"index.php?tribe_venue=$matches[1]&cpage=$matches[2]\";s:30:\"venue/([^/]+)(?:/([0-9]+))?/?$\";s:50:\"index.php?tribe_venue=$matches[1]&page=$matches[2]\";s:22:\"venue/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:32:\"venue/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:52:\"venue/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:47:\"venue/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:47:\"venue/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:28:\"venue/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:37:\"organizer/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:47:\"organizer/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:67:\"organizer/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"organizer/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"organizer/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:43:\"organizer/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:26:\"organizer/([^/]+)/embed/?$\";s:48:\"index.php?tribe_organizer=$matches[1]&embed=true\";s:30:\"organizer/([^/]+)/trackback/?$\";s:42:\"index.php?tribe_organizer=$matches[1]&tb=1\";s:38:\"organizer/([^/]+)/page/?([0-9]{1,})/?$\";s:55:\"index.php?tribe_organizer=$matches[1]&paged=$matches[2]\";s:45:\"organizer/([^/]+)/comment-page-([0-9]{1,})/?$\";s:55:\"index.php?tribe_organizer=$matches[1]&cpage=$matches[2]\";s:34:\"organizer/([^/]+)(?:/([0-9]+))?/?$\";s:54:\"index.php?tribe_organizer=$matches[1]&page=$matches[2]\";s:26:\"organizer/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:36:\"organizer/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:56:\"organizer/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:51:\"organizer/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:51:\"organizer/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:32:\"organizer/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:33:\"event/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:43:\"event/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:63:\"event/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"event/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"event/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:39:\"event/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:22:\"event/([^/]+)/embed/?$\";s:45:\"index.php?tribe_events=$matches[1]&embed=true\";s:26:\"event/([^/]+)/trackback/?$\";s:39:\"index.php?tribe_events=$matches[1]&tb=1\";s:46:\"event/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?tribe_events=$matches[1]&feed=$matches[2]\";s:41:\"event/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?tribe_events=$matches[1]&feed=$matches[2]\";s:34:\"event/([^/]+)/page/?([0-9]{1,})/?$\";s:52:\"index.php?tribe_events=$matches[1]&paged=$matches[2]\";s:41:\"event/([^/]+)/comment-page-([0-9]{1,})/?$\";s:52:\"index.php?tribe_events=$matches[1]&cpage=$matches[2]\";s:30:\"event/([^/]+)(?:/([0-9]+))?/?$\";s:51:\"index.php?tribe_events=$matches[1]&page=$matches[2]\";s:22:\"event/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:32:\"event/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:52:\"event/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:47:\"event/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:47:\"event/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:28:\"event/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:54:\"events/category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:55:\"index.php?tribe_events_cat=$matches[1]&feed=$matches[2]\";s:49:\"events/category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:55:\"index.php?tribe_events_cat=$matches[1]&feed=$matches[2]\";s:30:\"events/category/(.+?)/embed/?$\";s:49:\"index.php?tribe_events_cat=$matches[1]&embed=true\";s:42:\"events/category/(.+?)/page/?([0-9]{1,})/?$\";s:56:\"index.php?tribe_events_cat=$matches[1]&paged=$matches[2]\";s:24:\"events/category/(.+?)/?$\";s:38:\"index.php?tribe_events_cat=$matches[1]\";s:41:\"deleted_event/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:51:\"deleted_event/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:71:\"deleted_event/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:66:\"deleted_event/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:66:\"deleted_event/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:47:\"deleted_event/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:30:\"deleted_event/([^/]+)/embed/?$\";s:46:\"index.php?deleted_event=$matches[1]&embed=true\";s:34:\"deleted_event/([^/]+)/trackback/?$\";s:40:\"index.php?deleted_event=$matches[1]&tb=1\";s:42:\"deleted_event/([^/]+)/page/?([0-9]{1,})/?$\";s:53:\"index.php?deleted_event=$matches[1]&paged=$matches[2]\";s:49:\"deleted_event/([^/]+)/comment-page-([0-9]{1,})/?$\";s:53:\"index.php?deleted_event=$matches[1]&cpage=$matches[2]\";s:38:\"deleted_event/([^/]+)(?:/([0-9]+))?/?$\";s:52:\"index.php?deleted_event=$matches[1]&page=$matches[2]\";s:30:\"deleted_event/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:40:\"deleted_event/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:60:\"deleted_event/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:55:\"deleted_event/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:55:\"deleted_event/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:36:\"deleted_event/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:42:\"calendar-embed/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:52:\"calendar-embed/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:72:\"calendar-embed/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:67:\"calendar-embed/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:67:\"calendar-embed/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:48:\"calendar-embed/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:31:\"calendar-embed/([^/]+)/embed/?$\";s:51:\"index.php?tec_calendar_embed=$matches[1]&embed=true\";s:35:\"calendar-embed/([^/]+)/trackback/?$\";s:45:\"index.php?tec_calendar_embed=$matches[1]&tb=1\";s:43:\"calendar-embed/([^/]+)/page/?([0-9]{1,})/?$\";s:58:\"index.php?tec_calendar_embed=$matches[1]&paged=$matches[2]\";s:50:\"calendar-embed/([^/]+)/comment-page-([0-9]{1,})/?$\";s:58:\"index.php?tec_calendar_embed=$matches[1]&cpage=$matches[2]\";s:39:\"calendar-embed/([^/]+)(?:/([0-9]+))?/?$\";s:57:\"index.php?tec_calendar_embed=$matches[1]&page=$matches[2]\";s:31:\"calendar-embed/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:41:\"calendar-embed/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:61:\"calendar-embed/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"calendar-embed/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"calendar-embed/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:37:\"calendar-embed/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:13:\"favicon\\.ico$\";s:19:\"index.php?favicon=1\";s:12:\"sitemap\\.xml\";s:23:\"index.php?sitemap=index\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}','on');
INSERT INTO `wp_options` VALUES (31,'hack_file','0','on');
INSERT INTO `wp_options` VALUES (32,'blog_charset','UTF-8','on');
INSERT INTO `wp_options` VALUES (33,'moderation_keys','','off');
INSERT INTO `wp_options` VALUES (34,'active_plugins','a:7:{i:0;s:30:\"advanced-custom-fields/acf.php\";i:1;s:25:\"duplicator/duplicator.php\";i:2;s:35:\"fulltext-search/fulltext-search.php\";i:3;s:46:\"meeting-scheduler-by-vcita/vcita-scheduler.php\";i:4;s:43:\"the-events-calendar/the-events-calendar.php\";i:5;s:24:\"wordpress-seo/wp-seo.php\";i:6;s:31:\"wp-migrate-db/wp-migrate-db.php\";}','on');
INSERT INTO `wp_options` VALUES (35,'category_base','','on');
INSERT INTO `wp_options` VALUES (36,'ping_sites','https://rpc.pingomatic.com/','on');
INSERT INTO `wp_options` VALUES (37,'comment_max_links','2','on');
INSERT INTO `wp_options` VALUES (38,'gmt_offset','0','on');
INSERT INTO `wp_options` VALUES (39,'default_email_category','1','on');
INSERT INTO `wp_options` VALUES (40,'recently_edited','','off');
INSERT INTO `wp_options` VALUES (41,'template','acm','on');
INSERT INTO `wp_options` VALUES (42,'stylesheet','acm','on');
INSERT INTO `wp_options` VALUES (43,'comment_registration','0','on');
INSERT INTO `wp_options` VALUES (44,'html_type','text/html','on');
INSERT INTO `wp_options` VALUES (45,'use_trackback','0','on');
INSERT INTO `wp_options` VALUES (46,'default_role','subscriber','on');
INSERT INTO `wp_options` VALUES (47,'db_version','61833','on');
INSERT INTO `wp_options` VALUES (48,'uploads_use_yearmonth_folders','1','on');
INSERT INTO `wp_options` VALUES (49,'upload_path','','on');
INSERT INTO `wp_options` VALUES (50,'blog_public','1','on');
INSERT INTO `wp_options` VALUES (51,'default_link_category','2','on');
INSERT INTO `wp_options` VALUES (52,'show_on_front','posts','on');
INSERT INTO `wp_options` VALUES (53,'tag_base','','on');
INSERT INTO `wp_options` VALUES (54,'show_avatars','1','on');
INSERT INTO `wp_options` VALUES (55,'avatar_rating','G','on');
INSERT INTO `wp_options` VALUES (56,'upload_url_path','','on');
INSERT INTO `wp_options` VALUES (57,'thumbnail_size_w','150','on');
INSERT INTO `wp_options` VALUES (58,'thumbnail_size_h','150','on');
INSERT INTO `wp_options` VALUES (59,'thumbnail_crop','1','on');
INSERT INTO `wp_options` VALUES (60,'medium_size_w','300','on');
INSERT INTO `wp_options` VALUES (61,'medium_size_h','300','on');
INSERT INTO `wp_options` VALUES (62,'avatar_default','mystery','on');
INSERT INTO `wp_options` VALUES (63,'large_size_w','1024','on');
INSERT INTO `wp_options` VALUES (64,'large_size_h','1024','on');
INSERT INTO `wp_options` VALUES (65,'image_default_link_type','none','on');
INSERT INTO `wp_options` VALUES (66,'image_default_size','','on');
INSERT INTO `wp_options` VALUES (67,'image_default_align','','on');
INSERT INTO `wp_options` VALUES (68,'close_comments_for_old_posts','0','on');
INSERT INTO `wp_options` VALUES (69,'close_comments_days_old','14','on');
INSERT INTO `wp_options` VALUES (70,'thread_comments','1','on');
INSERT INTO `wp_options` VALUES (71,'thread_comments_depth','5','on');
INSERT INTO `wp_options` VALUES (72,'page_comments','0','on');
INSERT INTO `wp_options` VALUES (73,'comments_per_page','50','on');
INSERT INTO `wp_options` VALUES (74,'default_comments_page','newest','on');
INSERT INTO `wp_options` VALUES (75,'comment_order','asc','on');
INSERT INTO `wp_options` VALUES (76,'sticky_posts','a:0:{}','on');
INSERT INTO `wp_options` VALUES (77,'widget_categories','a:0:{}','on');
INSERT INTO `wp_options` VALUES (78,'widget_text','a:0:{}','on');
INSERT INTO `wp_options` VALUES (79,'widget_rss','a:0:{}','on');
INSERT INTO `wp_options` VALUES (80,'uninstall_plugins','a:1:{s:24:\"wordpress-seo/wp-seo.php\";s:14:\"__return_false\";}','off');
INSERT INTO `wp_options` VALUES (81,'timezone_string','','on');
INSERT INTO `wp_options` VALUES (82,'page_for_posts','0','on');
INSERT INTO `wp_options` VALUES (83,'page_on_front','0','on');
INSERT INTO `wp_options` VALUES (84,'default_post_format','0','on');
INSERT INTO `wp_options` VALUES (85,'link_manager_enabled','0','on');
INSERT INTO `wp_options` VALUES (86,'finished_splitting_shared_terms','1','on');
INSERT INTO `wp_options` VALUES (87,'site_icon','0','on');
INSERT INTO `wp_options` VALUES (88,'medium_large_size_w','768','on');
INSERT INTO `wp_options` VALUES (89,'medium_large_size_h','0','on');
INSERT INTO `wp_options` VALUES (90,'wp_page_for_privacy_policy','3','on');
INSERT INTO `wp_options` VALUES (91,'show_comments_cookies_opt_in','1','on');
INSERT INTO `wp_options` VALUES (92,'admin_email_lifespan','1795521484','on');
INSERT INTO `wp_options` VALUES (93,'disallowed_keys','','off');
INSERT INTO `wp_options` VALUES (94,'comment_previously_approved','1','on');
INSERT INTO `wp_options` VALUES (95,'auto_plugin_theme_update_emails','a:0:{}','off');
INSERT INTO `wp_options` VALUES (96,'auto_update_core_dev','enabled','on');
INSERT INTO `wp_options` VALUES (97,'auto_update_core_minor','enabled','on');
INSERT INTO `wp_options` VALUES (98,'auto_update_core_major','enabled','on');
INSERT INTO `wp_options` VALUES (99,'wp_force_deactivated_plugins','a:0:{}','on');
INSERT INTO `wp_options` VALUES (100,'wp_attachment_pages_enabled','0','on');
INSERT INTO `wp_options` VALUES (101,'wp_notes_notify','1','on');
INSERT INTO `wp_options` VALUES (102,'initial_db_version','61833','on');
INSERT INTO `wp_options` VALUES (103,'wp_user_roles','a:7:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:102:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;s:20:\"wpseo_manage_options\";b:1;s:25:\"read_private_tribe_events\";b:1;s:17:\"edit_tribe_events\";b:1;s:24:\"edit_others_tribe_events\";b:1;s:25:\"edit_private_tribe_events\";b:1;s:27:\"edit_published_tribe_events\";b:1;s:19:\"delete_tribe_events\";b:1;s:26:\"delete_others_tribe_events\";b:1;s:27:\"delete_private_tribe_events\";b:1;s:29:\"delete_published_tribe_events\";b:1;s:20:\"publish_tribe_events\";b:1;s:25:\"read_private_tribe_venues\";b:1;s:17:\"edit_tribe_venues\";b:1;s:24:\"edit_others_tribe_venues\";b:1;s:25:\"edit_private_tribe_venues\";b:1;s:27:\"edit_published_tribe_venues\";b:1;s:19:\"delete_tribe_venues\";b:1;s:26:\"delete_others_tribe_venues\";b:1;s:27:\"delete_private_tribe_venues\";b:1;s:29:\"delete_published_tribe_venues\";b:1;s:20:\"publish_tribe_venues\";b:1;s:29:\"read_private_tribe_organizers\";b:1;s:21:\"edit_tribe_organizers\";b:1;s:28:\"edit_others_tribe_organizers\";b:1;s:29:\"edit_private_tribe_organizers\";b:1;s:31:\"edit_published_tribe_organizers\";b:1;s:23:\"delete_tribe_organizers\";b:1;s:30:\"delete_others_tribe_organizers\";b:1;s:31:\"delete_private_tribe_organizers\";b:1;s:33:\"delete_published_tribe_organizers\";b:1;s:24:\"publish_tribe_organizers\";b:1;s:31:\"read_private_aggregator-records\";b:1;s:23:\"edit_aggregator-records\";b:1;s:30:\"edit_others_aggregator-records\";b:1;s:31:\"edit_private_aggregator-records\";b:1;s:33:\"edit_published_aggregator-records\";b:1;s:25:\"delete_aggregator-records\";b:1;s:32:\"delete_others_aggregator-records\";b:1;s:33:\"delete_private_aggregator-records\";b:1;s:35:\"delete_published_aggregator-records\";b:1;s:26:\"publish_aggregator-records\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:76:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:15:\"wpseo_bulk_edit\";b:1;s:28:\"wpseo_edit_advanced_metadata\";b:1;s:25:\"read_private_tribe_events\";b:1;s:17:\"edit_tribe_events\";b:1;s:24:\"edit_others_tribe_events\";b:1;s:25:\"edit_private_tribe_events\";b:1;s:27:\"edit_published_tribe_events\";b:1;s:19:\"delete_tribe_events\";b:1;s:26:\"delete_others_tribe_events\";b:1;s:27:\"delete_private_tribe_events\";b:1;s:29:\"delete_published_tribe_events\";b:1;s:20:\"publish_tribe_events\";b:1;s:25:\"read_private_tribe_venues\";b:1;s:17:\"edit_tribe_venues\";b:1;s:24:\"edit_others_tribe_venues\";b:1;s:25:\"edit_private_tribe_venues\";b:1;s:27:\"edit_published_tribe_venues\";b:1;s:19:\"delete_tribe_venues\";b:1;s:26:\"delete_others_tribe_venues\";b:1;s:27:\"delete_private_tribe_venues\";b:1;s:29:\"delete_published_tribe_venues\";b:1;s:20:\"publish_tribe_venues\";b:1;s:29:\"read_private_tribe_organizers\";b:1;s:21:\"edit_tribe_organizers\";b:1;s:28:\"edit_others_tribe_organizers\";b:1;s:29:\"edit_private_tribe_organizers\";b:1;s:31:\"edit_published_tribe_organizers\";b:1;s:23:\"delete_tribe_organizers\";b:1;s:30:\"delete_others_tribe_organizers\";b:1;s:31:\"delete_private_tribe_organizers\";b:1;s:33:\"delete_published_tribe_organizers\";b:1;s:24:\"publish_tribe_organizers\";b:1;s:31:\"read_private_aggregator-records\";b:1;s:23:\"edit_aggregator-records\";b:1;s:30:\"edit_others_aggregator-records\";b:1;s:31:\"edit_private_aggregator-records\";b:1;s:33:\"edit_published_aggregator-records\";b:1;s:25:\"delete_aggregator-records\";b:1;s:32:\"delete_others_aggregator-records\";b:1;s:33:\"delete_private_aggregator-records\";b:1;s:35:\"delete_published_aggregator-records\";b:1;s:26:\"publish_aggregator-records\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:30:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:17:\"edit_tribe_events\";b:1;s:27:\"edit_published_tribe_events\";b:1;s:19:\"delete_tribe_events\";b:1;s:29:\"delete_published_tribe_events\";b:1;s:20:\"publish_tribe_events\";b:1;s:17:\"edit_tribe_venues\";b:1;s:27:\"edit_published_tribe_venues\";b:1;s:19:\"delete_tribe_venues\";b:1;s:29:\"delete_published_tribe_venues\";b:1;s:20:\"publish_tribe_venues\";b:1;s:21:\"edit_tribe_organizers\";b:1;s:31:\"edit_published_tribe_organizers\";b:1;s:23:\"delete_tribe_organizers\";b:1;s:33:\"delete_published_tribe_organizers\";b:1;s:24:\"publish_tribe_organizers\";b:1;s:23:\"edit_aggregator-records\";b:1;s:33:\"edit_published_aggregator-records\";b:1;s:25:\"delete_aggregator-records\";b:1;s:35:\"delete_published_aggregator-records\";b:1;s:26:\"publish_aggregator-records\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:13:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:17:\"edit_tribe_events\";b:1;s:19:\"delete_tribe_events\";b:1;s:17:\"edit_tribe_venues\";b:1;s:19:\"delete_tribe_venues\";b:1;s:21:\"edit_tribe_organizers\";b:1;s:23:\"delete_tribe_organizers\";b:1;s:23:\"edit_aggregator-records\";b:1;s:25:\"delete_aggregator-records\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}s:13:\"wpseo_manager\";a:2:{s:4:\"name\";s:11:\"SEO Manager\";s:12:\"capabilities\";a:38:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:15:\"wpseo_bulk_edit\";b:1;s:28:\"wpseo_edit_advanced_metadata\";b:1;s:20:\"wpseo_manage_options\";b:1;s:23:\"view_site_health_checks\";b:1;}}s:12:\"wpseo_editor\";a:2:{s:4:\"name\";s:10:\"SEO Editor\";s:12:\"capabilities\";a:36:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:15:\"wpseo_bulk_edit\";b:1;s:28:\"wpseo_edit_advanced_metadata\";b:1;}}}','on');
INSERT INTO `wp_options` VALUES (104,'fresh_site','1','off');
INSERT INTO `wp_options` VALUES (105,'user_count','1','off');
INSERT INTO `wp_options` VALUES (106,'widget_block','a:6:{i:2;a:1:{s:7:\"content\";s:19:\"<!-- wp:search /-->\";}i:3;a:1:{s:7:\"content\";s:154:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Posts</h2><!-- /wp:heading --><!-- wp:latest-posts /--></div><!-- /wp:group -->\";}i:4;a:1:{s:7:\"content\";s:227:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Comments</h2><!-- /wp:heading --><!-- wp:latest-comments {\"displayAvatar\":false,\"displayDate\":false,\"displayExcerpt\":false} /--></div><!-- /wp:group -->\";}i:5;a:1:{s:7:\"content\";s:146:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Archives</h2><!-- /wp:heading --><!-- wp:archives /--></div><!-- /wp:group -->\";}i:6;a:1:{s:7:\"content\";s:150:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Categories</h2><!-- /wp:heading --><!-- wp:categories /--></div><!-- /wp:group -->\";}s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (107,'sidebars_widgets','a:4:{s:19:\"wp_inactive_widgets\";a:1:{i:0;s:15:\"vcita_widget_id\";}s:13:\"content_right\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:14:\"content_footer\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}s:13:\"array_version\";i:3;}','auto');
INSERT INTO `wp_options` VALUES (108,'widget_pages','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (109,'widget_calendar','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (110,'widget_archives','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (111,'widget_media_audio','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (112,'widget_media_image','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (113,'widget_media_gallery','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (114,'widget_media_video','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (115,'widget_meta','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (116,'widget_search','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (117,'widget_recent-posts','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (118,'widget_recent-comments','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (119,'widget_tag_cloud','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (120,'widget_nav_menu','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (121,'widget_custom_html','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (122,'_transient_wp_core_block_css_files','a:2:{s:7:\"version\";s:3:\"7.0\";s:5:\"files\";a:596:{i:0;s:31:\"accordion-heading/style-rtl.css\";i:1;s:35:\"accordion-heading/style-rtl.min.css\";i:2;s:27:\"accordion-heading/style.css\";i:3;s:31:\"accordion-heading/style.min.css\";i:4;s:28:\"accordion-item/style-rtl.css\";i:5;s:32:\"accordion-item/style-rtl.min.css\";i:6;s:24:\"accordion-item/style.css\";i:7;s:28:\"accordion-item/style.min.css\";i:8;s:29:\"accordion-panel/style-rtl.css\";i:9;s:33:\"accordion-panel/style-rtl.min.css\";i:10;s:25:\"accordion-panel/style.css\";i:11;s:29:\"accordion-panel/style.min.css\";i:12;s:23:\"accordion/style-rtl.css\";i:13;s:27:\"accordion/style-rtl.min.css\";i:14;s:19:\"accordion/style.css\";i:15;s:23:\"accordion/style.min.css\";i:16;s:22:\"archives/style-rtl.css\";i:17;s:26:\"archives/style-rtl.min.css\";i:18;s:18:\"archives/style.css\";i:19;s:22:\"archives/style.min.css\";i:20;s:20:\"audio/editor-rtl.css\";i:21;s:24:\"audio/editor-rtl.min.css\";i:22;s:16:\"audio/editor.css\";i:23;s:20:\"audio/editor.min.css\";i:24;s:19:\"audio/style-rtl.css\";i:25;s:23:\"audio/style-rtl.min.css\";i:26;s:15:\"audio/style.css\";i:27;s:19:\"audio/style.min.css\";i:28;s:19:\"audio/theme-rtl.css\";i:29;s:23:\"audio/theme-rtl.min.css\";i:30;s:15:\"audio/theme.css\";i:31;s:19:\"audio/theme.min.css\";i:32;s:21:\"avatar/editor-rtl.css\";i:33;s:25:\"avatar/editor-rtl.min.css\";i:34;s:17:\"avatar/editor.css\";i:35;s:21:\"avatar/editor.min.css\";i:36;s:20:\"avatar/style-rtl.css\";i:37;s:24:\"avatar/style-rtl.min.css\";i:38;s:16:\"avatar/style.css\";i:39;s:20:\"avatar/style.min.css\";i:40;s:25:\"breadcrumbs/style-rtl.css\";i:41;s:29:\"breadcrumbs/style-rtl.min.css\";i:42;s:21:\"breadcrumbs/style.css\";i:43;s:25:\"breadcrumbs/style.min.css\";i:44;s:21:\"button/editor-rtl.css\";i:45;s:25:\"button/editor-rtl.min.css\";i:46;s:17:\"button/editor.css\";i:47;s:21:\"button/editor.min.css\";i:48;s:20:\"button/style-rtl.css\";i:49;s:24:\"button/style-rtl.min.css\";i:50;s:16:\"button/style.css\";i:51;s:20:\"button/style.min.css\";i:52;s:22:\"buttons/editor-rtl.css\";i:53;s:26:\"buttons/editor-rtl.min.css\";i:54;s:18:\"buttons/editor.css\";i:55;s:22:\"buttons/editor.min.css\";i:56;s:21:\"buttons/style-rtl.css\";i:57;s:25:\"buttons/style-rtl.min.css\";i:58;s:17:\"buttons/style.css\";i:59;s:21:\"buttons/style.min.css\";i:60;s:22:\"calendar/style-rtl.css\";i:61;s:26:\"calendar/style-rtl.min.css\";i:62;s:18:\"calendar/style.css\";i:63;s:22:\"calendar/style.min.css\";i:64;s:25:\"categories/editor-rtl.css\";i:65;s:29:\"categories/editor-rtl.min.css\";i:66;s:21:\"categories/editor.css\";i:67;s:25:\"categories/editor.min.css\";i:68;s:24:\"categories/style-rtl.css\";i:69;s:28:\"categories/style-rtl.min.css\";i:70;s:20:\"categories/style.css\";i:71;s:24:\"categories/style.min.css\";i:72;s:19:\"code/editor-rtl.css\";i:73;s:23:\"code/editor-rtl.min.css\";i:74;s:15:\"code/editor.css\";i:75;s:19:\"code/editor.min.css\";i:76;s:18:\"code/style-rtl.css\";i:77;s:22:\"code/style-rtl.min.css\";i:78;s:14:\"code/style.css\";i:79;s:18:\"code/style.min.css\";i:80;s:18:\"code/theme-rtl.css\";i:81;s:22:\"code/theme-rtl.min.css\";i:82;s:14:\"code/theme.css\";i:83;s:18:\"code/theme.min.css\";i:84;s:22:\"columns/editor-rtl.css\";i:85;s:26:\"columns/editor-rtl.min.css\";i:86;s:18:\"columns/editor.css\";i:87;s:22:\"columns/editor.min.css\";i:88;s:21:\"columns/style-rtl.css\";i:89;s:25:\"columns/style-rtl.min.css\";i:90;s:17:\"columns/style.css\";i:91;s:21:\"columns/style.min.css\";i:92;s:33:\"comment-author-name/style-rtl.css\";i:93;s:37:\"comment-author-name/style-rtl.min.css\";i:94;s:29:\"comment-author-name/style.css\";i:95;s:33:\"comment-author-name/style.min.css\";i:96;s:29:\"comment-content/style-rtl.css\";i:97;s:33:\"comment-content/style-rtl.min.css\";i:98;s:25:\"comment-content/style.css\";i:99;s:29:\"comment-content/style.min.css\";i:100;s:26:\"comment-date/style-rtl.css\";i:101;s:30:\"comment-date/style-rtl.min.css\";i:102;s:22:\"comment-date/style.css\";i:103;s:26:\"comment-date/style.min.css\";i:104;s:31:\"comment-edit-link/style-rtl.css\";i:105;s:35:\"comment-edit-link/style-rtl.min.css\";i:106;s:27:\"comment-edit-link/style.css\";i:107;s:31:\"comment-edit-link/style.min.css\";i:108;s:32:\"comment-reply-link/style-rtl.css\";i:109;s:36:\"comment-reply-link/style-rtl.min.css\";i:110;s:28:\"comment-reply-link/style.css\";i:111;s:32:\"comment-reply-link/style.min.css\";i:112;s:30:\"comment-template/style-rtl.css\";i:113;s:34:\"comment-template/style-rtl.min.css\";i:114;s:26:\"comment-template/style.css\";i:115;s:30:\"comment-template/style.min.css\";i:116;s:42:\"comments-pagination-numbers/editor-rtl.css\";i:117;s:46:\"comments-pagination-numbers/editor-rtl.min.css\";i:118;s:38:\"comments-pagination-numbers/editor.css\";i:119;s:42:\"comments-pagination-numbers/editor.min.css\";i:120;s:34:\"comments-pagination/editor-rtl.css\";i:121;s:38:\"comments-pagination/editor-rtl.min.css\";i:122;s:30:\"comments-pagination/editor.css\";i:123;s:34:\"comments-pagination/editor.min.css\";i:124;s:33:\"comments-pagination/style-rtl.css\";i:125;s:37:\"comments-pagination/style-rtl.min.css\";i:126;s:29:\"comments-pagination/style.css\";i:127;s:33:\"comments-pagination/style.min.css\";i:128;s:29:\"comments-title/editor-rtl.css\";i:129;s:33:\"comments-title/editor-rtl.min.css\";i:130;s:25:\"comments-title/editor.css\";i:131;s:29:\"comments-title/editor.min.css\";i:132;s:23:\"comments/editor-rtl.css\";i:133;s:27:\"comments/editor-rtl.min.css\";i:134;s:19:\"comments/editor.css\";i:135;s:23:\"comments/editor.min.css\";i:136;s:22:\"comments/style-rtl.css\";i:137;s:26:\"comments/style-rtl.min.css\";i:138;s:18:\"comments/style.css\";i:139;s:22:\"comments/style.min.css\";i:140;s:20:\"cover/editor-rtl.css\";i:141;s:24:\"cover/editor-rtl.min.css\";i:142;s:16:\"cover/editor.css\";i:143;s:20:\"cover/editor.min.css\";i:144;s:19:\"cover/style-rtl.css\";i:145;s:23:\"cover/style-rtl.min.css\";i:146;s:15:\"cover/style.css\";i:147;s:19:\"cover/style.min.css\";i:148;s:22:\"details/editor-rtl.css\";i:149;s:26:\"details/editor-rtl.min.css\";i:150;s:18:\"details/editor.css\";i:151;s:22:\"details/editor.min.css\";i:152;s:21:\"details/style-rtl.css\";i:153;s:25:\"details/style-rtl.min.css\";i:154;s:17:\"details/style.css\";i:155;s:21:\"details/style.min.css\";i:156;s:20:\"embed/editor-rtl.css\";i:157;s:24:\"embed/editor-rtl.min.css\";i:158;s:16:\"embed/editor.css\";i:159;s:20:\"embed/editor.min.css\";i:160;s:19:\"embed/style-rtl.css\";i:161;s:23:\"embed/style-rtl.min.css\";i:162;s:15:\"embed/style.css\";i:163;s:19:\"embed/style.min.css\";i:164;s:19:\"embed/theme-rtl.css\";i:165;s:23:\"embed/theme-rtl.min.css\";i:166;s:15:\"embed/theme.css\";i:167;s:19:\"embed/theme.min.css\";i:168;s:19:\"file/editor-rtl.css\";i:169;s:23:\"file/editor-rtl.min.css\";i:170;s:15:\"file/editor.css\";i:171;s:19:\"file/editor.min.css\";i:172;s:18:\"file/style-rtl.css\";i:173;s:22:\"file/style-rtl.min.css\";i:174;s:14:\"file/style.css\";i:175;s:18:\"file/style.min.css\";i:176;s:23:\"footnotes/style-rtl.css\";i:177;s:27:\"footnotes/style-rtl.min.css\";i:178;s:19:\"footnotes/style.css\";i:179;s:23:\"footnotes/style.min.css\";i:180;s:23:\"freeform/editor-rtl.css\";i:181;s:27:\"freeform/editor-rtl.min.css\";i:182;s:19:\"freeform/editor.css\";i:183;s:23:\"freeform/editor.min.css\";i:184;s:22:\"gallery/editor-rtl.css\";i:185;s:26:\"gallery/editor-rtl.min.css\";i:186;s:18:\"gallery/editor.css\";i:187;s:22:\"gallery/editor.min.css\";i:188;s:21:\"gallery/style-rtl.css\";i:189;s:25:\"gallery/style-rtl.min.css\";i:190;s:17:\"gallery/style.css\";i:191;s:21:\"gallery/style.min.css\";i:192;s:21:\"gallery/theme-rtl.css\";i:193;s:25:\"gallery/theme-rtl.min.css\";i:194;s:17:\"gallery/theme.css\";i:195;s:21:\"gallery/theme.min.css\";i:196;s:20:\"group/editor-rtl.css\";i:197;s:24:\"group/editor-rtl.min.css\";i:198;s:16:\"group/editor.css\";i:199;s:20:\"group/editor.min.css\";i:200;s:19:\"group/style-rtl.css\";i:201;s:23:\"group/style-rtl.min.css\";i:202;s:15:\"group/style.css\";i:203;s:19:\"group/style.min.css\";i:204;s:19:\"group/theme-rtl.css\";i:205;s:23:\"group/theme-rtl.min.css\";i:206;s:15:\"group/theme.css\";i:207;s:19:\"group/theme.min.css\";i:208;s:21:\"heading/style-rtl.css\";i:209;s:25:\"heading/style-rtl.min.css\";i:210;s:17:\"heading/style.css\";i:211;s:21:\"heading/style.min.css\";i:212;s:19:\"html/editor-rtl.css\";i:213;s:23:\"html/editor-rtl.min.css\";i:214;s:15:\"html/editor.css\";i:215;s:19:\"html/editor.min.css\";i:216;s:19:\"icon/editor-rtl.css\";i:217;s:23:\"icon/editor-rtl.min.css\";i:218;s:15:\"icon/editor.css\";i:219;s:19:\"icon/editor.min.css\";i:220;s:18:\"icon/style-rtl.css\";i:221;s:22:\"icon/style-rtl.min.css\";i:222;s:14:\"icon/style.css\";i:223;s:18:\"icon/style.min.css\";i:224;s:20:\"image/editor-rtl.css\";i:225;s:24:\"image/editor-rtl.min.css\";i:226;s:16:\"image/editor.css\";i:227;s:20:\"image/editor.min.css\";i:228;s:19:\"image/style-rtl.css\";i:229;s:23:\"image/style-rtl.min.css\";i:230;s:15:\"image/style.css\";i:231;s:19:\"image/style.min.css\";i:232;s:19:\"image/theme-rtl.css\";i:233;s:23:\"image/theme-rtl.min.css\";i:234;s:15:\"image/theme.css\";i:235;s:19:\"image/theme.min.css\";i:236;s:29:\"latest-comments/style-rtl.css\";i:237;s:33:\"latest-comments/style-rtl.min.css\";i:238;s:25:\"latest-comments/style.css\";i:239;s:29:\"latest-comments/style.min.css\";i:240;s:27:\"latest-posts/editor-rtl.css\";i:241;s:31:\"latest-posts/editor-rtl.min.css\";i:242;s:23:\"latest-posts/editor.css\";i:243;s:27:\"latest-posts/editor.min.css\";i:244;s:26:\"latest-posts/style-rtl.css\";i:245;s:30:\"latest-posts/style-rtl.min.css\";i:246;s:22:\"latest-posts/style.css\";i:247;s:26:\"latest-posts/style.min.css\";i:248;s:18:\"list/style-rtl.css\";i:249;s:22:\"list/style-rtl.min.css\";i:250;s:14:\"list/style.css\";i:251;s:18:\"list/style.min.css\";i:252;s:22:\"loginout/style-rtl.css\";i:253;s:26:\"loginout/style-rtl.min.css\";i:254;s:18:\"loginout/style.css\";i:255;s:22:\"loginout/style.min.css\";i:256;s:19:\"math/editor-rtl.css\";i:257;s:23:\"math/editor-rtl.min.css\";i:258;s:15:\"math/editor.css\";i:259;s:19:\"math/editor.min.css\";i:260;s:18:\"math/style-rtl.css\";i:261;s:22:\"math/style-rtl.min.css\";i:262;s:14:\"math/style.css\";i:263;s:18:\"math/style.min.css\";i:264;s:25:\"media-text/editor-rtl.css\";i:265;s:29:\"media-text/editor-rtl.min.css\";i:266;s:21:\"media-text/editor.css\";i:267;s:25:\"media-text/editor.min.css\";i:268;s:24:\"media-text/style-rtl.css\";i:269;s:28:\"media-text/style-rtl.min.css\";i:270;s:20:\"media-text/style.css\";i:271;s:24:\"media-text/style.min.css\";i:272;s:19:\"more/editor-rtl.css\";i:273;s:23:\"more/editor-rtl.min.css\";i:274;s:15:\"more/editor.css\";i:275;s:19:\"more/editor.min.css\";i:276;s:30:\"navigation-link/editor-rtl.css\";i:277;s:34:\"navigation-link/editor-rtl.min.css\";i:278;s:26:\"navigation-link/editor.css\";i:279;s:30:\"navigation-link/editor.min.css\";i:280;s:29:\"navigation-link/style-rtl.css\";i:281;s:33:\"navigation-link/style-rtl.min.css\";i:282;s:25:\"navigation-link/style.css\";i:283;s:29:\"navigation-link/style.min.css\";i:284;s:38:\"navigation-overlay-close/style-rtl.css\";i:285;s:42:\"navigation-overlay-close/style-rtl.min.css\";i:286;s:34:\"navigation-overlay-close/style.css\";i:287;s:38:\"navigation-overlay-close/style.min.css\";i:288;s:33:\"navigation-submenu/editor-rtl.css\";i:289;s:37:\"navigation-submenu/editor-rtl.min.css\";i:290;s:29:\"navigation-submenu/editor.css\";i:291;s:33:\"navigation-submenu/editor.min.css\";i:292;s:25:\"navigation/editor-rtl.css\";i:293;s:29:\"navigation/editor-rtl.min.css\";i:294;s:21:\"navigation/editor.css\";i:295;s:25:\"navigation/editor.min.css\";i:296;s:24:\"navigation/style-rtl.css\";i:297;s:28:\"navigation/style-rtl.min.css\";i:298;s:20:\"navigation/style.css\";i:299;s:24:\"navigation/style.min.css\";i:300;s:23:\"nextpage/editor-rtl.css\";i:301;s:27:\"nextpage/editor-rtl.min.css\";i:302;s:19:\"nextpage/editor.css\";i:303;s:23:\"nextpage/editor.min.css\";i:304;s:24:\"page-list/editor-rtl.css\";i:305;s:28:\"page-list/editor-rtl.min.css\";i:306;s:20:\"page-list/editor.css\";i:307;s:24:\"page-list/editor.min.css\";i:308;s:23:\"page-list/style-rtl.css\";i:309;s:27:\"page-list/style-rtl.min.css\";i:310;s:19:\"page-list/style.css\";i:311;s:23:\"page-list/style.min.css\";i:312;s:24:\"paragraph/editor-rtl.css\";i:313;s:28:\"paragraph/editor-rtl.min.css\";i:314;s:20:\"paragraph/editor.css\";i:315;s:24:\"paragraph/editor.min.css\";i:316;s:23:\"paragraph/style-rtl.css\";i:317;s:27:\"paragraph/style-rtl.min.css\";i:318;s:19:\"paragraph/style.css\";i:319;s:23:\"paragraph/style.min.css\";i:320;s:35:\"post-author-biography/style-rtl.css\";i:321;s:39:\"post-author-biography/style-rtl.min.css\";i:322;s:31:\"post-author-biography/style.css\";i:323;s:35:\"post-author-biography/style.min.css\";i:324;s:30:\"post-author-name/style-rtl.css\";i:325;s:34:\"post-author-name/style-rtl.min.css\";i:326;s:26:\"post-author-name/style.css\";i:327;s:30:\"post-author-name/style.min.css\";i:328;s:26:\"post-author/editor-rtl.css\";i:329;s:30:\"post-author/editor-rtl.min.css\";i:330;s:22:\"post-author/editor.css\";i:331;s:26:\"post-author/editor.min.css\";i:332;s:25:\"post-author/style-rtl.css\";i:333;s:29:\"post-author/style-rtl.min.css\";i:334;s:21:\"post-author/style.css\";i:335;s:25:\"post-author/style.min.css\";i:336;s:33:\"post-comments-count/style-rtl.css\";i:337;s:37:\"post-comments-count/style-rtl.min.css\";i:338;s:29:\"post-comments-count/style.css\";i:339;s:33:\"post-comments-count/style.min.css\";i:340;s:33:\"post-comments-form/editor-rtl.css\";i:341;s:37:\"post-comments-form/editor-rtl.min.css\";i:342;s:29:\"post-comments-form/editor.css\";i:343;s:33:\"post-comments-form/editor.min.css\";i:344;s:32:\"post-comments-form/style-rtl.css\";i:345;s:36:\"post-comments-form/style-rtl.min.css\";i:346;s:28:\"post-comments-form/style.css\";i:347;s:32:\"post-comments-form/style.min.css\";i:348;s:32:\"post-comments-link/style-rtl.css\";i:349;s:36:\"post-comments-link/style-rtl.min.css\";i:350;s:28:\"post-comments-link/style.css\";i:351;s:32:\"post-comments-link/style.min.css\";i:352;s:26:\"post-content/style-rtl.css\";i:353;s:30:\"post-content/style-rtl.min.css\";i:354;s:22:\"post-content/style.css\";i:355;s:26:\"post-content/style.min.css\";i:356;s:23:\"post-date/style-rtl.css\";i:357;s:27:\"post-date/style-rtl.min.css\";i:358;s:19:\"post-date/style.css\";i:359;s:23:\"post-date/style.min.css\";i:360;s:27:\"post-excerpt/editor-rtl.css\";i:361;s:31:\"post-excerpt/editor-rtl.min.css\";i:362;s:23:\"post-excerpt/editor.css\";i:363;s:27:\"post-excerpt/editor.min.css\";i:364;s:26:\"post-excerpt/style-rtl.css\";i:365;s:30:\"post-excerpt/style-rtl.min.css\";i:366;s:22:\"post-excerpt/style.css\";i:367;s:26:\"post-excerpt/style.min.css\";i:368;s:34:\"post-featured-image/editor-rtl.css\";i:369;s:38:\"post-featured-image/editor-rtl.min.css\";i:370;s:30:\"post-featured-image/editor.css\";i:371;s:34:\"post-featured-image/editor.min.css\";i:372;s:33:\"post-featured-image/style-rtl.css\";i:373;s:37:\"post-featured-image/style-rtl.min.css\";i:374;s:29:\"post-featured-image/style.css\";i:375;s:33:\"post-featured-image/style.min.css\";i:376;s:34:\"post-navigation-link/style-rtl.css\";i:377;s:38:\"post-navigation-link/style-rtl.min.css\";i:378;s:30:\"post-navigation-link/style.css\";i:379;s:34:\"post-navigation-link/style.min.css\";i:380;s:27:\"post-template/style-rtl.css\";i:381;s:31:\"post-template/style-rtl.min.css\";i:382;s:23:\"post-template/style.css\";i:383;s:27:\"post-template/style.min.css\";i:384;s:24:\"post-terms/style-rtl.css\";i:385;s:28:\"post-terms/style-rtl.min.css\";i:386;s:20:\"post-terms/style.css\";i:387;s:24:\"post-terms/style.min.css\";i:388;s:31:\"post-time-to-read/style-rtl.css\";i:389;s:35:\"post-time-to-read/style-rtl.min.css\";i:390;s:27:\"post-time-to-read/style.css\";i:391;s:31:\"post-time-to-read/style.min.css\";i:392;s:24:\"post-title/style-rtl.css\";i:393;s:28:\"post-title/style-rtl.min.css\";i:394;s:20:\"post-title/style.css\";i:395;s:24:\"post-title/style.min.css\";i:396;s:26:\"preformatted/style-rtl.css\";i:397;s:30:\"preformatted/style-rtl.min.css\";i:398;s:22:\"preformatted/style.css\";i:399;s:26:\"preformatted/style.min.css\";i:400;s:24:\"pullquote/editor-rtl.css\";i:401;s:28:\"pullquote/editor-rtl.min.css\";i:402;s:20:\"pullquote/editor.css\";i:403;s:24:\"pullquote/editor.min.css\";i:404;s:23:\"pullquote/style-rtl.css\";i:405;s:27:\"pullquote/style-rtl.min.css\";i:406;s:19:\"pullquote/style.css\";i:407;s:23:\"pullquote/style.min.css\";i:408;s:23:\"pullquote/theme-rtl.css\";i:409;s:27:\"pullquote/theme-rtl.min.css\";i:410;s:19:\"pullquote/theme.css\";i:411;s:23:\"pullquote/theme.min.css\";i:412;s:39:\"query-pagination-numbers/editor-rtl.css\";i:413;s:43:\"query-pagination-numbers/editor-rtl.min.css\";i:414;s:35:\"query-pagination-numbers/editor.css\";i:415;s:39:\"query-pagination-numbers/editor.min.css\";i:416;s:31:\"query-pagination/editor-rtl.css\";i:417;s:35:\"query-pagination/editor-rtl.min.css\";i:418;s:27:\"query-pagination/editor.css\";i:419;s:31:\"query-pagination/editor.min.css\";i:420;s:30:\"query-pagination/style-rtl.css\";i:421;s:34:\"query-pagination/style-rtl.min.css\";i:422;s:26:\"query-pagination/style.css\";i:423;s:30:\"query-pagination/style.min.css\";i:424;s:25:\"query-title/style-rtl.css\";i:425;s:29:\"query-title/style-rtl.min.css\";i:426;s:21:\"query-title/style.css\";i:427;s:25:\"query-title/style.min.css\";i:428;s:25:\"query-total/style-rtl.css\";i:429;s:29:\"query-total/style-rtl.min.css\";i:430;s:21:\"query-total/style.css\";i:431;s:25:\"query-total/style.min.css\";i:432;s:20:\"query/editor-rtl.css\";i:433;s:24:\"query/editor-rtl.min.css\";i:434;s:16:\"query/editor.css\";i:435;s:20:\"query/editor.min.css\";i:436;s:19:\"quote/style-rtl.css\";i:437;s:23:\"quote/style-rtl.min.css\";i:438;s:15:\"quote/style.css\";i:439;s:19:\"quote/style.min.css\";i:440;s:19:\"quote/theme-rtl.css\";i:441;s:23:\"quote/theme-rtl.min.css\";i:442;s:15:\"quote/theme.css\";i:443;s:19:\"quote/theme.min.css\";i:444;s:23:\"read-more/style-rtl.css\";i:445;s:27:\"read-more/style-rtl.min.css\";i:446;s:19:\"read-more/style.css\";i:447;s:23:\"read-more/style.min.css\";i:448;s:18:\"rss/editor-rtl.css\";i:449;s:22:\"rss/editor-rtl.min.css\";i:450;s:14:\"rss/editor.css\";i:451;s:18:\"rss/editor.min.css\";i:452;s:17:\"rss/style-rtl.css\";i:453;s:21:\"rss/style-rtl.min.css\";i:454;s:13:\"rss/style.css\";i:455;s:17:\"rss/style.min.css\";i:456;s:21:\"search/editor-rtl.css\";i:457;s:25:\"search/editor-rtl.min.css\";i:458;s:17:\"search/editor.css\";i:459;s:21:\"search/editor.min.css\";i:460;s:20:\"search/style-rtl.css\";i:461;s:24:\"search/style-rtl.min.css\";i:462;s:16:\"search/style.css\";i:463;s:20:\"search/style.min.css\";i:464;s:20:\"search/theme-rtl.css\";i:465;s:24:\"search/theme-rtl.min.css\";i:466;s:16:\"search/theme.css\";i:467;s:20:\"search/theme.min.css\";i:468;s:24:\"separator/editor-rtl.css\";i:469;s:28:\"separator/editor-rtl.min.css\";i:470;s:20:\"separator/editor.css\";i:471;s:24:\"separator/editor.min.css\";i:472;s:23:\"separator/style-rtl.css\";i:473;s:27:\"separator/style-rtl.min.css\";i:474;s:19:\"separator/style.css\";i:475;s:23:\"separator/style.min.css\";i:476;s:23:\"separator/theme-rtl.css\";i:477;s:27:\"separator/theme-rtl.min.css\";i:478;s:19:\"separator/theme.css\";i:479;s:23:\"separator/theme.min.css\";i:480;s:24:\"shortcode/editor-rtl.css\";i:481;s:28:\"shortcode/editor-rtl.min.css\";i:482;s:20:\"shortcode/editor.css\";i:483;s:24:\"shortcode/editor.min.css\";i:484;s:24:\"site-logo/editor-rtl.css\";i:485;s:28:\"site-logo/editor-rtl.min.css\";i:486;s:20:\"site-logo/editor.css\";i:487;s:24:\"site-logo/editor.min.css\";i:488;s:23:\"site-logo/style-rtl.css\";i:489;s:27:\"site-logo/style-rtl.min.css\";i:490;s:19:\"site-logo/style.css\";i:491;s:23:\"site-logo/style.min.css\";i:492;s:27:\"site-tagline/editor-rtl.css\";i:493;s:31:\"site-tagline/editor-rtl.min.css\";i:494;s:23:\"site-tagline/editor.css\";i:495;s:27:\"site-tagline/editor.min.css\";i:496;s:26:\"site-tagline/style-rtl.css\";i:497;s:30:\"site-tagline/style-rtl.min.css\";i:498;s:22:\"site-tagline/style.css\";i:499;s:26:\"site-tagline/style.min.css\";i:500;s:25:\"site-title/editor-rtl.css\";i:501;s:29:\"site-title/editor-rtl.min.css\";i:502;s:21:\"site-title/editor.css\";i:503;s:25:\"site-title/editor.min.css\";i:504;s:24:\"site-title/style-rtl.css\";i:505;s:28:\"site-title/style-rtl.min.css\";i:506;s:20:\"site-title/style.css\";i:507;s:24:\"site-title/style.min.css\";i:508;s:26:\"social-link/editor-rtl.css\";i:509;s:30:\"social-link/editor-rtl.min.css\";i:510;s:22:\"social-link/editor.css\";i:511;s:26:\"social-link/editor.min.css\";i:512;s:27:\"social-links/editor-rtl.css\";i:513;s:31:\"social-links/editor-rtl.min.css\";i:514;s:23:\"social-links/editor.css\";i:515;s:27:\"social-links/editor.min.css\";i:516;s:26:\"social-links/style-rtl.css\";i:517;s:30:\"social-links/style-rtl.min.css\";i:518;s:22:\"social-links/style.css\";i:519;s:26:\"social-links/style.min.css\";i:520;s:21:\"spacer/editor-rtl.css\";i:521;s:25:\"spacer/editor-rtl.min.css\";i:522;s:17:\"spacer/editor.css\";i:523;s:21:\"spacer/editor.min.css\";i:524;s:20:\"spacer/style-rtl.css\";i:525;s:24:\"spacer/style-rtl.min.css\";i:526;s:16:\"spacer/style.css\";i:527;s:20:\"spacer/style.min.css\";i:528;s:20:\"table/editor-rtl.css\";i:529;s:24:\"table/editor-rtl.min.css\";i:530;s:16:\"table/editor.css\";i:531;s:20:\"table/editor.min.css\";i:532;s:19:\"table/style-rtl.css\";i:533;s:23:\"table/style-rtl.min.css\";i:534;s:15:\"table/style.css\";i:535;s:19:\"table/style.min.css\";i:536;s:19:\"table/theme-rtl.css\";i:537;s:23:\"table/theme-rtl.min.css\";i:538;s:15:\"table/theme.css\";i:539;s:19:\"table/theme.min.css\";i:540;s:23:\"tag-cloud/style-rtl.css\";i:541;s:27:\"tag-cloud/style-rtl.min.css\";i:542;s:19:\"tag-cloud/style.css\";i:543;s:23:\"tag-cloud/style.min.css\";i:544;s:28:\"template-part/editor-rtl.css\";i:545;s:32:\"template-part/editor-rtl.min.css\";i:546;s:24:\"template-part/editor.css\";i:547;s:28:\"template-part/editor.min.css\";i:548;s:27:\"template-part/theme-rtl.css\";i:549;s:31:\"template-part/theme-rtl.min.css\";i:550;s:23:\"template-part/theme.css\";i:551;s:27:\"template-part/theme.min.css\";i:552;s:24:\"term-count/style-rtl.css\";i:553;s:28:\"term-count/style-rtl.min.css\";i:554;s:20:\"term-count/style.css\";i:555;s:24:\"term-count/style.min.css\";i:556;s:30:\"term-description/style-rtl.css\";i:557;s:34:\"term-description/style-rtl.min.css\";i:558;s:26:\"term-description/style.css\";i:559;s:30:\"term-description/style.min.css\";i:560;s:23:\"term-name/style-rtl.css\";i:561;s:27:\"term-name/style-rtl.min.css\";i:562;s:19:\"term-name/style.css\";i:563;s:23:\"term-name/style.min.css\";i:564;s:28:\"term-template/editor-rtl.css\";i:565;s:32:\"term-template/editor-rtl.min.css\";i:566;s:24:\"term-template/editor.css\";i:567;s:28:\"term-template/editor.min.css\";i:568;s:27:\"term-template/style-rtl.css\";i:569;s:31:\"term-template/style-rtl.min.css\";i:570;s:23:\"term-template/style.css\";i:571;s:27:\"term-template/style.min.css\";i:572;s:27:\"text-columns/editor-rtl.css\";i:573;s:31:\"text-columns/editor-rtl.min.css\";i:574;s:23:\"text-columns/editor.css\";i:575;s:27:\"text-columns/editor.min.css\";i:576;s:26:\"text-columns/style-rtl.css\";i:577;s:30:\"text-columns/style-rtl.min.css\";i:578;s:22:\"text-columns/style.css\";i:579;s:26:\"text-columns/style.min.css\";i:580;s:19:\"verse/style-rtl.css\";i:581;s:23:\"verse/style-rtl.min.css\";i:582;s:15:\"verse/style.css\";i:583;s:19:\"verse/style.min.css\";i:584;s:20:\"video/editor-rtl.css\";i:585;s:24:\"video/editor-rtl.min.css\";i:586;s:16:\"video/editor.css\";i:587;s:20:\"video/editor.min.css\";i:588;s:19:\"video/style-rtl.css\";i:589;s:23:\"video/style-rtl.min.css\";i:590;s:15:\"video/style.css\";i:591;s:19:\"video/style.min.css\";i:592;s:19:\"video/theme-rtl.css\";i:593;s:23:\"video/theme-rtl.min.css\";i:594;s:15:\"video/theme.css\";i:595;s:19:\"video/theme.min.css\";}}','on');
INSERT INTO `wp_options` VALUES (126,'recovery_keys','a:0:{}','off');
INSERT INTO `wp_options` VALUES (127,'WPLANG','','auto');
INSERT INTO `wp_options` VALUES (128,'_site_transient_update_core','O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:57:\"https://downloads.wordpress.org/release/wordpress-7.0.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:57:\"https://downloads.wordpress.org/release/wordpress-7.0.zip\";s:10:\"no_content\";s:68:\"https://downloads.wordpress.org/release/wordpress-7.0-no-content.zip\";s:11:\"new_bundled\";s:69:\"https://downloads.wordpress.org/release/wordpress-7.0-new-bundled.zip\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:3:\"7.0\";s:7:\"version\";s:3:\"7.0\";s:11:\"php_version\";s:3:\"7.4\";s:13:\"mysql_version\";s:5:\"5.5.5\";s:11:\"new_bundled\";s:3:\"6.7\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1780301163;s:15:\"version_checked\";s:3:\"7.0\";s:12:\"translations\";a:0:{}}','off');
INSERT INTO `wp_options` VALUES (132,'_site_transient_update_themes','O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1780301192;s:7:\"checked\";a:5:{s:11:\"_acm_backup\";s:3:\"2.0\";s:3:\"acm\";s:3:\"2.0\";s:16:\"twentytwentyfive\";s:3:\"1.5\";s:16:\"twentytwentyfour\";s:3:\"1.5\";s:17:\"twentytwentythree\";s:3:\"1.6\";}s:8:\"response\";a:0:{}s:9:\"no_update\";a:3:{s:16:\"twentytwentyfive\";a:6:{s:5:\"theme\";s:16:\"twentytwentyfive\";s:11:\"new_version\";s:3:\"1.5\";s:3:\"url\";s:46:\"https://wordpress.org/themes/twentytwentyfive/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/theme/twentytwentyfive.1.5.zip\";s:8:\"requires\";s:3:\"6.7\";s:12:\"requires_php\";s:3:\"7.2\";}s:16:\"twentytwentyfour\";a:6:{s:5:\"theme\";s:16:\"twentytwentyfour\";s:11:\"new_version\";s:3:\"1.5\";s:3:\"url\";s:46:\"https://wordpress.org/themes/twentytwentyfour/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/theme/twentytwentyfour.1.5.zip\";s:8:\"requires\";s:3:\"6.4\";s:12:\"requires_php\";s:3:\"7.0\";}s:17:\"twentytwentythree\";a:6:{s:5:\"theme\";s:17:\"twentytwentythree\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:47:\"https://wordpress.org/themes/twentytwentythree/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/theme/twentytwentythree.1.6.zip\";s:8:\"requires\";s:3:\"6.1\";s:12:\"requires_php\";s:3:\"5.6\";}}s:12:\"translations\";a:0:{}}','off');
INSERT INTO `wp_options` VALUES (133,'_site_transient_timeout_browser_90daa551604269dbcdcf237b5cc700f3','1780574435','off');
INSERT INTO `wp_options` VALUES (134,'_site_transient_browser_90daa551604269dbcdcf237b5cc700f3','a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:9:\"148.0.0.0\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}','off');
INSERT INTO `wp_options` VALUES (135,'_site_transient_timeout_php_check_986ab27a5c44eb5941b7e3b238532f66','1780574436','off');
INSERT INTO `wp_options` VALUES (136,'_site_transient_php_check_986ab27a5c44eb5941b7e3b238532f66','a:5:{s:19:\"recommended_version\";s:3:\"8.3\";s:15:\"minimum_version\";s:3:\"7.4\";s:12:\"is_supported\";b:0;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}','off');
INSERT INTO `wp_options` VALUES (140,'can_compress_scripts','0','on');
INSERT INTO `wp_options` VALUES (151,'theme_mods_twentytwentyfive','a:4:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1779972461;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:1:{i:0;s:15:\"vcita_widget_id\";}s:9:\"sidebar-1\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:9:\"sidebar-2\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}}}s:19:\"wp_classic_sidebars\";a:0:{}s:18:\"nav_menu_locations\";a:0:{}}','off');
INSERT INTO `wp_options` VALUES (152,'_transient_wp_styles_for_blocks','a:2:{s:4:\"hash\";s:32:\"d4c194055311dd6a9e111c5556cddc2a\";s:6:\"blocks\";a:7:{s:32:\"0368537a03d4b05ed11f802c802c5153\";s:0:\"\";s:32:\"500888137eafa12a508de2c588d9ffdd\";s:46:\":root :where(.wp-block-icon svg){width: 24px;}\";s:32:\"a6036e6eb2ad2df7ed8860b807868647\";s:0:\"\";s:32:\"3b46efc0a10c1dae38f584ad199c3544\";s:120:\":where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}\";s:32:\"ab4df16c9e454bfed8a404309545590d\";s:120:\":where(.wp-block-term-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-term-template.is-layout-grid){gap: 1.25em;}\";s:32:\"68ec5cad52d993402775a7503ba9efb7\";s:102:\":where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}\";s:32:\"b8b4aa19e69b9b2de0f5c27097467bd6\";s:69:\":root :where(.wp-block-pullquote){font-size: 1.5em;line-height: 1.6;}\";}}','on');
INSERT INTO `wp_options` VALUES (155,'finished_updating_comment_type','1','auto');
INSERT INTO `wp_options` VALUES (156,'current_theme','ACM','auto');
INSERT INTO `wp_options` VALUES (157,'theme_mods_css/..','a:5:{i:0;b:0;s:19:\"wp_classic_sidebars\";a:0:{}s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1779971376;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:13:\"content_right\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:14:\"content_footer\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}}}}','off');
INSERT INTO `wp_options` VALUES (158,'theme_switched','','auto');
INSERT INTO `wp_options` VALUES (161,'puc_external_updates_theme-acm-update','O:8:\"stdClass\":2:{s:9:\"lastCheck\";i:1780301192;s:14:\"checkedVersion\";s:3:\"2.0\";}','off');
INSERT INTO `wp_options` VALUES (163,'acf_first_activated_version','6.8.2','on');
INSERT INTO `wp_options` VALUES (164,'acf_site_health','{\"version\":\"6.8.2\",\"plugin_type\":\"Free\",\"update_source\":\"wordpress.org\",\"wp_version\":\"7.0\",\"mysql_version\":\"8.4.0\",\"is_multisite\":false,\"active_theme\":{\"name\":\"ACM\",\"version\":\"2.0\",\"theme_uri\":\"\",\"stylesheet\":false},\"active_plugins\":{\"advanced-custom-fields\\/acf.php\":{\"name\":\"Advanced Custom Fields\",\"version\":\"6.8.2\",\"plugin_uri\":\"https:\\/\\/www.advancedcustomfields.com\"},\"meeting-scheduler-by-vcita\\/vcita-scheduler.php\":{\"name\":\"Appointment Booking and Online Scheduling\",\"version\":\"4.6.0\",\"plugin_uri\":\"https:\\/\\/www.vcita.com\"},\"duplicator\\/duplicator.php\":{\"name\":\"Duplicator\",\"version\":\"1.5.16.1\",\"plugin_uri\":\"https:\\/\\/duplicator.com\\/\"},\"the-events-calendar\\/the-events-calendar.php\":{\"name\":\"The Events Calendar\",\"version\":\"6.16.2\",\"plugin_uri\":\"\"},\"fulltext-search\\/fulltext-search.php\":{\"name\":\"WP Fast Total Search - The Power of Indexed Search\",\"version\":\"1.80.280\",\"plugin_uri\":\"\"},\"wp-migrate-db\\/wp-migrate-db.php\":{\"name\":\"WP Migrate Lite\",\"version\":\"2.7.7\",\"plugin_uri\":\"https:\\/\\/deliciousbrains.com\\/\"},\"wordpress-seo\\/wp-seo.php\":{\"name\":\"Yoast SEO\",\"version\":\"27.7\",\"plugin_uri\":\"https:\\/\\/yoa.st\\/1uj\"}},\"ui_field_groups\":\"0\",\"php_field_groups\":\"0\",\"json_field_groups\":\"0\",\"rest_field_groups\":\"0\",\"all_location_rules\":[\"post_type==page\",\"post_type==post\"],\"number_of_fields_by_type\":{\"text\":2,\"textarea\":1,\"image\":1,\"true_false\":1},\"number_of_third_party_fields_by_type\":{\"none\":1},\"post_types_enabled\":true,\"ui_post_types\":\"0\",\"json_post_types\":\"0\",\"ui_taxonomies\":\"0\",\"json_taxonomies\":\"0\",\"rest_api_format\":\"light\",\"admin_ui_enabled\":true,\"field_type-modal_enabled\":true,\"field_settings_tabs_enabled\":false,\"shortcode_enabled\":false,\"registered_acf_forms\":\"0\",\"json_save_paths\":1,\"json_load_paths\":1,\"ai_enabled\":false,\"schema_support\":false,\"schema_ready_objects\":{\"blocks\":0,\"post_types\":0},\"event_first_activated\":1779969761,\"last_updated\":1780301190}','off');
INSERT INTO `wp_options` VALUES (165,'acf_version','6.8.2','auto');
INSERT INTO `wp_options` VALUES (167,'vcita_scheduler','a:6:{i:0;b:0;s:14:\"just_activated\";b:1;s:5:\"wp_id\";s:0:\"\";s:5:\"email\";s:0:\"\";s:12:\"dismiss_time\";d:1779969797.9268639;s:19:\"dismiss_switch_time\";d:1779969797.932147;}','auto');
INSERT INTO `wp_options` VALUES (171,'duplicator_version_plugin','1.5.16.1','auto');
INSERT INTO `wp_options` VALUES (173,'duplicator_install_info','a:3:{s:7:\"version\";s:8:\"1.5.16.1\";s:4:\"time\";i:1779969972;s:10:\"updateTime\";i:1779969972;}','off');
INSERT INTO `wp_options` VALUES (174,'duplicator_uninstall_package','1','auto');
INSERT INTO `wp_options` VALUES (175,'duplicator_uninstall_settings','1','auto');
INSERT INTO `wp_options` VALUES (176,'duplicator_settings','a:20:{s:7:\"version\";s:8:\"1.5.16.1\";s:18:\"uninstall_settings\";b:1;s:15:\"uninstall_files\";b:1;s:13:\"package_debug\";b:0;s:23:\"email_summary_frequency\";s:6:\"weekly\";s:9:\"amNotices\";b:1;s:17:\"package_mysqldump\";b:1;s:22:\"package_mysqldump_path\";s:0:\"\";s:24:\"package_phpdump_qrylimit\";s:3:\"100\";s:17:\"package_zip_flush\";b:0;s:19:\"installer_name_mode\";s:6:\"simple\";s:16:\"storage_position\";s:6:\"wpcont\";s:20:\"storage_htaccess_off\";b:0;s:18:\"archive_build_mode\";i:2;s:17:\"skip_archive_scan\";b:0;s:21:\"unhook_third_party_js\";b:0;s:22:\"unhook_third_party_css\";b:0;s:17:\"active_package_id\";i:-1;s:14:\"usage_tracking\";b:0;i:0;b:0;}','auto');
INSERT INTO `wp_options` VALUES (177,'duplicator_plugin_data_stats','{\n    \"lastSendTime\": 0,\n    \"identifier\": \"-ik2;iF5h&Itx0bk742hlB0i6Pkn_1a5xVtUth0Ic;Ov\",\n    \"plugin\": \"dup-lite\",\n    \"pluginStatus\": \"active\",\n    \"buildCount\": 0,\n    \"buildLastDate\": 0,\n    \"buildFailedCount\": 0,\n    \"buildFailedLastDate\": 0,\n    \"siteSizeMB\": 0,\n    \"siteNumFiles\": 0,\n    \"siteDbSizeMB\": 0,\n    \"siteDbNumTables\": 0\n}','auto');
INSERT INTO `wp_options` VALUES (178,'tribe_last_updated_option','1780028021.5012','auto');
INSERT INTO `wp_options` VALUES (179,'action_scheduler_hybrid_store_demarkation','6','auto');
INSERT INTO `wp_options` VALUES (180,'schema-ActionScheduler_StoreSchema','8.0.1779969994','auto');
INSERT INTO `wp_options` VALUES (181,'schema-ActionScheduler_LoggerSchema','3.0.1779969994','auto');
INSERT INTO `wp_options` VALUES (182,'stellar_schema_version_stellarwp-shepherd-tec-tasks','0.0.3','auto');
INSERT INTO `wp_options` VALUES (183,'stellar_schema_version_tec-kv-cache','1.0.0','auto');
INSERT INTO `wp_options` VALUES (184,'tribe_events_calendar_options','a:11:{s:18:\"tec-schema-version\";s:6:\"6.11.2\";s:8:\"did_init\";b:1;s:19:\"tribeEventsTemplate\";s:0:\"\";s:16:\"tribeEnableViews\";a:3:{i:0;s:4:\"list\";i:1;s:5:\"month\";i:2;s:3:\"day\";}s:10:\"viewOption\";s:4:\"list\";s:14:\"schema-version\";s:6:\"6.16.2\";s:21:\"previous_ecp_versions\";a:1:{i:0;s:1:\"0\";}s:18:\"latest_ecp_version\";s:6:\"6.16.2\";s:18:\"dateWithYearFormat\";s:6:\"F j, Y\";s:24:\"recurrenceMaxMonthsAfter\";i:60;s:22:\"google_maps_js_api_key\";s:39:\"AIzaSyDNsicAsP6-VuGtAb1O9riI3oc_NOb7IOU\";}','auto');
INSERT INTO `wp_options` VALUES (188,'wpfts_flare_mid','7c11461f7b1af19b70b8bfd5c9d7cccd|http://acm-local.local|127.0.0.1','off');
INSERT INTO `wp_options` VALUES (189,'wpfts_theme_options','s:162:\"a:6:{s:4:\"name\";s:3:\"ACM\";s:7:\"version\";s:3:\"2.0\";s:14:\"is_child_theme\";i:0;s:9:\"base_name\";s:3:\"ACM\";s:12:\"base_version\";s:3:\"2.0\";s:17:\"is_hook_available\";i:0;}\";','off');
INSERT INTO `wp_options` VALUES (190,'wpfts_index_ready','1','off');
INSERT INTO `wp_options` VALUES (191,'wpfts_is_welcome_message','[\"\\u003Cb style=\\u0022color: red;\\u0022\\u003ECongratulations!\\u003C\\/b\\u003E \\u003Cb\\u003EWP Fast Total Search plugin\\u003C\\/b\\u003E has just been installed and successfully activated!\\u003Cbr\\u003E\\u003Cbr\\u003ETo complete the installation, we need to create the Search Index of your existing WP posts data. To start this process, simply go to the \\u003Ca href=\\u0022admin.php?page=wpfts-options\\u0022\\u003EWPFTS Settings Page\\u003C\\/a\\u003E\"]','off');
INSERT INTO `wp_options` VALUES (192,'wpfts_current_db_version','1.80.280','off');
INSERT INTO `wp_options` VALUES (193,'wpfts_updatedb_error_message','','off');
INSERT INTO `wp_options` VALUES (194,'wpfts_detector_message_expdt','2026-06-04 12:21:41','off');
INSERT INTO `wp_options` VALUES (195,'wpfts_ps1_message_expdt','1970-01-15 00:00:00','off');
INSERT INTO `wp_options` VALUES (196,'wpfts_ps1_start_dt','1970-01-01 00:00:00','off');
INSERT INTO `wp_options` VALUES (197,'wpfts_detector2_message','','off');
INSERT INTO `wp_options` VALUES (198,'wpfts_detector2_message_expdt','2026-06-02 09:41:22','off');
INSERT INTO `wp_options` VALUES (199,'wpfts_detector3_message_expdt','2026-06-01 09:46:22','off');
INSERT INTO `wp_options` VALUES (200,'yoast_migrations_free','a:1:{s:7:\"version\";s:4:\"27.7\";}','auto');
INSERT INTO `wp_options` VALUES (201,'wpseo','a:124:{s:8:\"tracking\";b:0;s:16:\"toggled_tracking\";b:0;s:22:\"license_server_version\";b:0;s:15:\"ms_defaults_set\";b:0;s:40:\"ignore_search_engines_discouraged_notice\";b:0;s:19:\"indexing_first_time\";b:1;s:16:\"indexing_started\";b:0;s:15:\"indexing_reason\";s:26:\"permalink_settings_changed\";s:29:\"indexables_indexing_completed\";b:0;s:13:\"index_now_key\";s:0:\"\";s:7:\"version\";s:4:\"27.7\";s:16:\"previous_version\";s:0:\"\";s:20:\"disableadvanced_meta\";b:1;s:30:\"enable_headless_rest_endpoints\";b:1;s:17:\"ryte_indexability\";b:0;s:11:\"baiduverify\";s:0:\"\";s:12:\"googleverify\";s:0:\"\";s:8:\"msverify\";s:0:\"\";s:12:\"yandexverify\";s:0:\"\";s:12:\"ahrefsverify\";s:0:\"\";s:9:\"site_type\";s:0:\"\";s:20:\"has_multiple_authors\";s:0:\"\";s:16:\"environment_type\";s:0:\"\";s:23:\"content_analysis_active\";b:1;s:23:\"keyword_analysis_active\";b:1;s:34:\"inclusive_language_analysis_active\";b:0;s:21:\"enable_admin_bar_menu\";b:1;s:26:\"enable_cornerstone_content\";b:1;s:18:\"enable_xml_sitemap\";b:1;s:24:\"enable_text_link_counter\";b:1;s:16:\"enable_index_now\";b:1;s:19:\"enable_ai_generator\";b:1;s:22:\"ai_enabled_pre_default\";b:0;s:22:\"show_onboarding_notice\";b:1;s:18:\"first_activated_on\";i:1779970026;s:13:\"myyoast-oauth\";b:0;s:26:\"semrush_integration_active\";b:1;s:14:\"semrush_tokens\";a:0:{}s:20:\"semrush_country_code\";s:2:\"us\";s:19:\"permalink_structure\";s:12:\"/%postname%/\";s:8:\"home_url\";s:22:\"http://acm-local.local\";s:18:\"dynamic_permalinks\";b:0;s:17:\"category_base_url\";s:0:\"\";s:12:\"tag_base_url\";s:0:\"\";s:21:\"custom_taxonomy_slugs\";a:1:{s:16:\"tribe_events_cat\";s:15:\"events/category\";}s:29:\"enable_enhanced_slack_sharing\";b:1;s:23:\"enable_metabox_insights\";b:1;s:23:\"enable_link_suggestions\";b:1;s:26:\"algolia_integration_active\";b:0;s:14:\"import_cursors\";a:0:{}s:13:\"workouts_data\";a:1:{s:13:\"configuration\";a:1:{s:13:\"finishedSteps\";a:0:{}}}s:28:\"configuration_finished_steps\";a:0:{}s:36:\"dismiss_configuration_workout_notice\";b:0;s:34:\"dismiss_premium_deactivated_notice\";b:0;s:19:\"importing_completed\";a:0:{}s:26:\"wincher_integration_active\";b:1;s:14:\"wincher_tokens\";a:0:{}s:36:\"wincher_automatically_add_keyphrases\";b:0;s:18:\"wincher_website_id\";s:0:\"\";s:18:\"first_time_install\";b:1;s:34:\"should_redirect_after_install_free\";b:0;s:34:\"activation_redirect_timestamp_free\";i:1779970055;s:18:\"remove_feed_global\";b:0;s:27:\"remove_feed_global_comments\";b:0;s:25:\"remove_feed_post_comments\";b:0;s:19:\"remove_feed_authors\";b:0;s:22:\"remove_feed_categories\";b:0;s:16:\"remove_feed_tags\";b:0;s:29:\"remove_feed_custom_taxonomies\";b:0;s:22:\"remove_feed_post_types\";b:0;s:18:\"remove_feed_search\";b:0;s:21:\"remove_atom_rdf_feeds\";b:0;s:17:\"remove_shortlinks\";b:0;s:21:\"remove_rest_api_links\";b:0;s:20:\"remove_rsd_wlw_links\";b:0;s:19:\"remove_oembed_links\";b:0;s:16:\"remove_generator\";b:0;s:20:\"remove_emoji_scripts\";b:0;s:24:\"remove_powered_by_header\";b:0;s:22:\"remove_pingback_header\";b:0;s:28:\"clean_campaign_tracking_urls\";b:0;s:16:\"clean_permalinks\";b:0;s:32:\"clean_permalinks_extra_variables\";s:0:\"\";s:14:\"search_cleanup\";b:0;s:20:\"search_cleanup_emoji\";b:0;s:23:\"search_cleanup_patterns\";b:0;s:22:\"search_character_limit\";i:50;s:20:\"deny_search_crawling\";b:0;s:21:\"deny_wp_json_crawling\";b:0;s:20:\"deny_adsbot_crawling\";b:0;s:19:\"deny_ccbot_crawling\";b:0;s:29:\"deny_google_extended_crawling\";b:0;s:20:\"deny_gptbot_crawling\";b:0;s:27:\"redirect_search_pretty_urls\";b:0;s:29:\"least_readability_ignore_list\";a:0:{}s:27:\"least_seo_score_ignore_list\";a:0:{}s:23:\"most_linked_ignore_list\";a:0:{}s:24:\"least_linked_ignore_list\";a:0:{}s:28:\"indexables_page_reading_list\";a:5:{i:0;b:0;i:1;b:0;i:2;b:0;i:3;b:0;i:4;b:0;}s:25:\"indexables_overview_state\";s:21:\"dashboard-not-visited\";s:28:\"last_known_public_post_types\";a:3:{i:0;s:4:\"post\";i:1;s:4:\"page\";i:2;s:12:\"tribe_events\";}s:28:\"last_known_public_taxonomies\";a:4:{i:0;s:8:\"category\";i:1;s:8:\"post_tag\";i:2;s:11:\"post_format\";i:3;s:16:\"tribe_events_cat\";}s:23:\"last_known_no_unindexed\";a:0:{}s:14:\"new_post_types\";a:0:{}s:14:\"new_taxonomies\";a:0:{}s:34:\"show_new_content_type_notification\";b:0;s:44:\"site_kit_configuration_permanently_dismissed\";b:0;s:18:\"site_kit_connected\";b:0;s:37:\"site_kit_tracking_setup_widget_loaded\";s:2:\"no\";s:41:\"site_kit_tracking_first_interaction_stage\";s:0:\"\";s:40:\"site_kit_tracking_last_interaction_stage\";s:0:\"\";s:52:\"site_kit_tracking_setup_widget_temporarily_dismissed\";s:2:\"no\";s:52:\"site_kit_tracking_setup_widget_permanently_dismissed\";s:2:\"no\";s:31:\"google_site_kit_feature_enabled\";b:0;s:25:\"ai_free_sparks_started_on\";N;s:15:\"enable_llms_txt\";b:0;s:15:\"last_updated_on\";b:0;s:17:\"default_seo_title\";a:0:{}s:21:\"default_seo_meta_desc\";a:0:{}s:18:\"first_activated_by\";i:1;s:34:\"enable_schema_aggregation_endpoint\";b:0;s:38:\"schema_aggregation_endpoint_enabled_on\";N;s:16:\"enable_task_list\";b:1;s:13:\"enable_schema\";b:1;}','auto');
INSERT INTO `wp_options` VALUES (202,'wpseo_titles','a:129:{s:17:\"forcerewritetitle\";b:0;s:9:\"separator\";s:7:\"sc-dash\";s:16:\"title-home-wpseo\";s:42:\"%%sitename%% %%page%% %%sep%% %%sitedesc%%\";s:18:\"title-author-wpseo\";s:41:\"%%name%%, Author at %%sitename%% %%page%%\";s:19:\"title-archive-wpseo\";s:38:\"%%date%% %%page%% %%sep%% %%sitename%%\";s:18:\"title-search-wpseo\";s:63:\"You searched for %%searchphrase%% %%page%% %%sep%% %%sitename%%\";s:15:\"title-404-wpseo\";s:35:\"Page not found %%sep%% %%sitename%%\";s:25:\"social-title-author-wpseo\";s:8:\"%%name%%\";s:26:\"social-title-archive-wpseo\";s:8:\"%%date%%\";s:31:\"social-description-author-wpseo\";s:0:\"\";s:32:\"social-description-archive-wpseo\";s:0:\"\";s:29:\"social-image-url-author-wpseo\";s:0:\"\";s:30:\"social-image-url-archive-wpseo\";s:0:\"\";s:28:\"social-image-id-author-wpseo\";i:0;s:29:\"social-image-id-archive-wpseo\";i:0;s:19:\"metadesc-home-wpseo\";s:0:\"\";s:21:\"metadesc-author-wpseo\";s:0:\"\";s:22:\"metadesc-archive-wpseo\";s:0:\"\";s:9:\"rssbefore\";s:0:\"\";s:8:\"rssafter\";s:53:\"The post %%POSTLINK%% appeared first on %%BLOGLINK%%.\";s:20:\"noindex-author-wpseo\";b:0;s:28:\"noindex-author-noposts-wpseo\";b:1;s:21:\"noindex-archive-wpseo\";b:1;s:14:\"disable-author\";b:0;s:12:\"disable-date\";b:0;s:19:\"disable-post_format\";b:0;s:18:\"disable-attachment\";b:1;s:20:\"breadcrumbs-404crumb\";s:25:\"Error 404: Page not found\";s:29:\"breadcrumbs-display-blog-page\";b:1;s:20:\"breadcrumbs-boldlast\";b:0;s:25:\"breadcrumbs-archiveprefix\";s:12:\"Archives for\";s:18:\"breadcrumbs-enable\";b:1;s:16:\"breadcrumbs-home\";s:4:\"Home\";s:18:\"breadcrumbs-prefix\";s:0:\"\";s:24:\"breadcrumbs-searchprefix\";s:16:\"You searched for\";s:15:\"breadcrumbs-sep\";s:2:\"»\";s:12:\"website_name\";s:0:\"\";s:11:\"person_name\";s:0:\"\";s:11:\"person_logo\";s:0:\"\";s:22:\"alternate_website_name\";s:0:\"\";s:12:\"company_logo\";s:0:\"\";s:12:\"company_name\";s:0:\"\";s:22:\"company_alternate_name\";s:0:\"\";s:17:\"company_or_person\";s:7:\"company\";s:25:\"company_or_person_user_id\";b:0;s:17:\"stripcategorybase\";b:0;s:26:\"open_graph_frontpage_title\";s:12:\"%%sitename%%\";s:25:\"open_graph_frontpage_desc\";s:0:\"\";s:26:\"open_graph_frontpage_image\";s:0:\"\";s:24:\"publishing_principles_id\";i:0;s:25:\"ownership_funding_info_id\";i:0;s:29:\"actionable_feedback_policy_id\";i:0;s:21:\"corrections_policy_id\";i:0;s:16:\"ethics_policy_id\";i:0;s:19:\"diversity_policy_id\";i:0;s:28:\"diversity_staffing_report_id\";i:0;s:15:\"org-description\";s:0:\"\";s:9:\"org-email\";s:0:\"\";s:9:\"org-phone\";s:0:\"\";s:14:\"org-legal-name\";s:0:\"\";s:17:\"org-founding-date\";s:0:\"\";s:20:\"org-number-employees\";s:0:\"\";s:10:\"org-vat-id\";s:0:\"\";s:10:\"org-tax-id\";s:0:\"\";s:7:\"org-iso\";s:0:\"\";s:8:\"org-duns\";s:0:\"\";s:11:\"org-leicode\";s:0:\"\";s:9:\"org-naics\";s:0:\"\";s:10:\"title-post\";s:39:\"%%title%% %%page%% %%sep%% %%sitename%%\";s:13:\"metadesc-post\";s:0:\"\";s:12:\"noindex-post\";b:0;s:23:\"display-metabox-pt-post\";b:1;s:23:\"post_types-post-maintax\";i:0;s:21:\"schema-page-type-post\";s:7:\"WebPage\";s:24:\"schema-article-type-post\";s:7:\"Article\";s:17:\"social-title-post\";s:9:\"%%title%%\";s:23:\"social-description-post\";s:0:\"\";s:21:\"social-image-url-post\";s:0:\"\";s:20:\"social-image-id-post\";i:0;s:10:\"title-page\";s:39:\"%%title%% %%page%% %%sep%% %%sitename%%\";s:13:\"metadesc-page\";s:0:\"\";s:12:\"noindex-page\";b:0;s:23:\"display-metabox-pt-page\";b:1;s:23:\"post_types-page-maintax\";i:0;s:21:\"schema-page-type-page\";s:7:\"WebPage\";s:24:\"schema-article-type-page\";s:4:\"None\";s:17:\"social-title-page\";s:9:\"%%title%%\";s:23:\"social-description-page\";s:0:\"\";s:21:\"social-image-url-page\";s:0:\"\";s:20:\"social-image-id-page\";i:0;s:16:\"title-attachment\";s:39:\"%%title%% %%page%% %%sep%% %%sitename%%\";s:19:\"metadesc-attachment\";s:0:\"\";s:18:\"noindex-attachment\";b:0;s:29:\"display-metabox-pt-attachment\";b:1;s:29:\"post_types-attachment-maintax\";i:0;s:27:\"schema-page-type-attachment\";s:7:\"WebPage\";s:30:\"schema-article-type-attachment\";s:4:\"None\";s:18:\"title-tax-category\";s:53:\"%%term_title%% Archives %%page%% %%sep%% %%sitename%%\";s:21:\"metadesc-tax-category\";s:0:\"\";s:28:\"display-metabox-tax-category\";b:1;s:20:\"noindex-tax-category\";b:0;s:25:\"social-title-tax-category\";s:23:\"%%term_title%% Archives\";s:31:\"social-description-tax-category\";s:0:\"\";s:29:\"social-image-url-tax-category\";s:0:\"\";s:28:\"social-image-id-tax-category\";i:0;s:26:\"taxonomy-category-ptparent\";i:0;s:18:\"title-tax-post_tag\";s:53:\"%%term_title%% Archives %%page%% %%sep%% %%sitename%%\";s:21:\"metadesc-tax-post_tag\";s:0:\"\";s:28:\"display-metabox-tax-post_tag\";b:1;s:20:\"noindex-tax-post_tag\";b:0;s:25:\"social-title-tax-post_tag\";s:23:\"%%term_title%% Archives\";s:31:\"social-description-tax-post_tag\";s:0:\"\";s:29:\"social-image-url-tax-post_tag\";s:0:\"\";s:28:\"social-image-id-tax-post_tag\";i:0;s:26:\"taxonomy-post_tag-ptparent\";i:0;s:21:\"title-tax-post_format\";s:53:\"%%term_title%% Archives %%page%% %%sep%% %%sitename%%\";s:24:\"metadesc-tax-post_format\";s:0:\"\";s:31:\"display-metabox-tax-post_format\";b:1;s:23:\"noindex-tax-post_format\";b:1;s:28:\"social-title-tax-post_format\";s:23:\"%%term_title%% Archives\";s:34:\"social-description-tax-post_format\";s:0:\"\";s:32:\"social-image-url-tax-post_format\";s:0:\"\";s:31:\"social-image-id-tax-post_format\";i:0;s:29:\"taxonomy-post_format-ptparent\";i:0;s:14:\"person_logo_id\";i:0;s:15:\"company_logo_id\";i:0;s:17:\"company_logo_meta\";b:0;s:16:\"person_logo_meta\";b:0;s:29:\"open_graph_frontpage_image_id\";i:0;}','auto');
INSERT INTO `wp_options` VALUES (203,'wpseo_social','a:20:{s:13:\"facebook_site\";s:0:\"\";s:13:\"instagram_url\";s:0:\"\";s:12:\"linkedin_url\";s:0:\"\";s:11:\"myspace_url\";s:0:\"\";s:16:\"og_default_image\";s:0:\"\";s:19:\"og_default_image_id\";s:0:\"\";s:18:\"og_frontpage_title\";s:0:\"\";s:17:\"og_frontpage_desc\";s:0:\"\";s:18:\"og_frontpage_image\";s:0:\"\";s:21:\"og_frontpage_image_id\";s:0:\"\";s:9:\"opengraph\";b:1;s:13:\"pinterest_url\";s:0:\"\";s:15:\"pinterestverify\";s:0:\"\";s:7:\"twitter\";b:1;s:12:\"twitter_site\";s:0:\"\";s:17:\"twitter_card_type\";s:19:\"summary_large_image\";s:11:\"youtube_url\";s:0:\"\";s:13:\"wikipedia_url\";s:0:\"\";s:17:\"other_social_urls\";a:0:{}s:12:\"mastodon_url\";s:0:\"\";}','auto');
INSERT INTO `wp_options` VALUES (204,'wpseo_llmstxt','a:7:{s:23:\"llms_txt_selection_mode\";s:4:\"auto\";s:13:\"about_us_page\";i:0;s:12:\"contact_page\";i:0;s:10:\"terms_page\";i:0;s:19:\"privacy_policy_page\";i:0;s:9:\"shop_page\";i:0;s:20:\"other_included_pages\";a:0:{}}','auto');
INSERT INTO `wp_options` VALUES (205,'wpseo_tracking_only','a:3:{s:25:\"task_list_first_opened_on\";s:0:\"\";s:22:\"task_first_actioned_on\";s:0:\"\";s:36:\"frontend_inspector_first_actioned_on\";s:0:\"\";}','auto');
INSERT INTO `wp_options` VALUES (207,'wpfts_is_db_outdated','0','off');
INSERT INTO `wp_options` VALUES (208,'wpfts_change_notices','{\"1.65.225\":\"\\u003Cp\\u003EWe have improved a lot and need to rebuild the index!\\u003C\\/p\\u003E\\r\\n\\t\\t\\t\\t\\t\\u003Cp\\u003EIn our new update \\u003Cb\\u003E1.65.225\\u003C\\/b\\u003E, we have introduced support for indexing rules, and now all records must comply with this new algorithm. This feature will allow other plugins to add their own rules without having to rebuild the index every time.\\u003C\\/p\\u003E\\r\\n\\t\\t\\t\\t\\t\\u003Cp\\u003EBut today we need to bring all the entries in the index into compliance with the rules.\\u003C\\/p\\u003E\\r\\n\\t\\t\\t\\t\\t\\u003Cp\\u003EThank you for your understanding and support!\\u003C\\/p\\u003E\"}','off');
INSERT INTO `wp_options` VALUES (209,'wpfts_current_cb_version','1.80.280','off');
INSERT INTO `wp_options` VALUES (210,'tec_timed_tribe_supports_async_process','a:3:{s:3:\"key\";s:28:\"tribe_supports_async_process\";s:5:\"value\";i:1;s:10:\"expiration\";i:1780574861;}','on');
INSERT INTO `wp_options` VALUES (212,'action_scheduler_lock_async-request-runner','6a1d5221616475.85367225|1780306525','no');
INSERT INTO `wp_options` VALUES (213,'wpmdb_settings','a:14:{s:3:\"key\";s:40:\"9jKbKnZL7XXSpkytpR8VpVpAXY+JoQGZaEDRjhni\";s:10:\"allow_pull\";b:0;s:10:\"allow_push\";b:0;s:8:\"profiles\";a:0:{}s:7:\"licence\";s:0:\"\";s:10:\"verify_ssl\";b:0;s:17:\"whitelist_plugins\";a:0:{}s:11:\"max_request\";i:1048576;s:22:\"delay_between_requests\";i:0;s:18:\"prog_tables_hidden\";b:1;s:21:\"pause_before_finalize\";b:0;s:14:\"allow_tracking\";N;s:26:\"high_performance_transfers\";b:0;s:18:\"compatibility_mode\";b:0;}','off');
INSERT INTO `wp_options` VALUES (214,'_site_transient_wpmdb_disabled_legacy_addons','1','off');
INSERT INTO `wp_options` VALUES (217,'tribe_last_save_post','1779970044.6055','auto');
INSERT INTO `wp_options` VALUES (218,'widget_wpfts_custom_widget','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (219,'widget_tribe-widget-events-list','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (220,'widget_tribe-widget-events-qr-code','a:1:{s:12:\"_multiwidget\";i:1;}','auto');
INSERT INTO `wp_options` VALUES (221,'duplicator_notifications','a:4:{s:6:\"update\";i:1780306370;s:4:\"feed\";a:0:{}s:6:\"events\";a:0:{}s:9:\"dismissed\";a:0:{}}','auto');
INSERT INTO `wp_options` VALUES (222,'tec_timed_tec_custom_tables_v1_initialized','a:3:{s:3:\"key\";s:32:\"tec_custom_tables_v1_initialized\";s:5:\"value\";i:1;s:10:\"expiration\";i:1780387588;}','on');
INSERT INTO `wp_options` VALUES (223,'tec_ct1_migration_state','a:3:{s:18:\"complete_timestamp\";N;s:5:\"phase\";s:22:\"migration-not-required\";s:19:\"preview_unsupported\";b:0;}','auto');
INSERT INTO `wp_options` VALUES (224,'tec_ct1_events_table_schema_version','1.0.1','auto');
INSERT INTO `wp_options` VALUES (225,'tec_ct1_occurrences_table_schema_version','1.0.3','auto');
INSERT INTO `wp_options` VALUES (228,'stellarwp_telemetry_last_send','','auto');
INSERT INTO `wp_options` VALUES (229,'stellarwp_telemetry','a:1:{s:7:\"plugins\";a:1:{s:19:\"the-events-calendar\";a:2:{s:7:\"wp_slug\";s:43:\"the-events-calendar/the-events-calendar.php\";s:5:\"optin\";b:0;}}}','auto');
INSERT INTO `wp_options` VALUES (230,'stellarwp_telemetry_the-events-calendar_show_optin','1','auto');
INSERT INTO `wp_options` VALUES (231,'wpfts_reqreset_message_expdt','2026-06-01 09:35:25','off');
INSERT INTO `wp_options` VALUES (232,'wpfts_irules_hash','5ca9825c6a3d870878cc881321240893c8286ddf','off');
INSERT INTO `wp_options` VALUES (233,'tribe_last_generate_rewrite_rules','1780028036.9386','auto');
INSERT INTO `wp_options` VALUES (238,'wpfts_last_indexerstart_ts','1780306882','off');
INSERT INTO `wp_options` VALUES (240,'wpfts_is_break_loop','0','off');
INSERT INTO `wp_options` VALUES (241,'wpfts_last_sync_ts','1780306974','off');
INSERT INTO `wp_options` VALUES (243,'wpfts_irules_status_next_ts','1780307182','off');
INSERT INTO `wp_options` VALUES (244,'wpfts_irules_status_cache','{\"groups\":[{\"n_total\":2,\"n_valid\":2,\"n_indexed\":2,\"n_req_reset\":0},{\"n_total\":12,\"n_valid\":12,\"n_indexed\":12,\"n_req_reset\":0}],\"singles\":{\"1\":{\"n_total\":12,\"n_valid\":12,\"n_indexed\":12,\"n_req_reset\":0}},\"no_rules\":{\"n_total\":2,\"n_valid\":2,\"n_indexed\":2,\"n_req_reset\":0},\"n_inindex\":14,\"n_actual\":14,\"n_pending\":0,\"n_req_reset\":0,\"tsd\":1780306882}','off');
INSERT INTO `wp_options` VALUES (245,'wpfts_status_next_ts','1780307182','off');
INSERT INTO `wp_options` VALUES (246,'wpfts_status_cache','{\"groups\":[{\"n_total\":2,\"n_valid\":2,\"n_indexed\":2,\"n_req_reset\":0},{\"n_total\":12,\"n_valid\":12,\"n_indexed\":12,\"n_req_reset\":0}],\"singles\":{\"1\":{\"n_total\":12,\"n_valid\":12,\"n_indexed\":12,\"n_req_reset\":0}},\"no_rules\":{\"n_total\":2,\"n_valid\":2,\"n_indexed\":2,\"n_req_reset\":0},\"n_inindex\":14,\"n_actual\":14,\"n_pending\":0,\"n_req_reset\":0,\"tsd\":1780306882,\"is_cached\":false,\"nw_act\":130,\"nw_total\":130,\"n_tw\":0}','off');
INSERT INTO `wp_options` VALUES (251,'wpmdb_saved_profiles','','off');
INSERT INTO `wp_options` VALUES (252,'wpmdb_recent_migrations','','off');
INSERT INTO `wp_options` VALUES (253,'wpmdb_migration_options','','off');
INSERT INTO `wp_options` VALUES (254,'wpmdb_migration_state','','off');
INSERT INTO `wp_options` VALUES (255,'wpmdb_remote_response','','off');
INSERT INTO `wp_options` VALUES (256,'wpmdb_remote_migration_state','','off');
INSERT INTO `wp_options` VALUES (257,'wpmdb_schema_version','3.6','off');
INSERT INTO `wp_options` VALUES (263,'dashboard_widget_options','a:1:{s:16:\"acm_type_of_site\";a:1:{s:12:\"type_of_site\";N;}}','auto');
INSERT INTO `wp_options` VALUES (275,'wpfts_reqreset_message','','off');
INSERT INTO `wp_options` VALUES (281,'action_scheduler_migration_status','complete','auto');
INSERT INTO `wp_options` VALUES (282,'as_has_wp_comment_logs','no','on');
INSERT INTO `wp_options` VALUES (299,'wpfts_ts_series','[1779985163.402524,1779985163.4025249,1]','off');
INSERT INTO `wp_options` VALUES (302,'wpfts_detector3_message','<p><b style=\"color: #dba617;text-decoration:underline;\">LOW MEMORY LIMIT</b>: The WPFTS plugin for its work uses the RAM of your website, allocated for PHP scripts. Currently, the server settings allow the use of only <b>256M</b>, which is enough for the plugin, but still may generate slow downs or errors on big post/page indexing.</p><p>We strongly recommend increasing the <code>memory_limit</code> value to <b>512M</b> or more. Find out how to do this on <a href=\"https://fulltextsearch.org/how-to-set-up-memory_limit-value-for-wordpress/\" target=\"_blank\"> this page </a>.</p>','off');
INSERT INTO `wp_options` VALUES (303,'wpfts_detector3_lastresult','2','off');
INSERT INTO `wp_options` VALUES (398,'theme_mods_src/..','a:5:{i:0;b:0;s:19:\"wp_classic_sidebars\";a:2:{s:13:\"content_right\";a:11:{s:4:\"name\";s:15:\"Content sidebar\";s:2:\"id\";s:13:\"content_right\";s:11:\"description\";s:0:\"\";s:5:\"class\";s:0:\"\";s:13:\"before_widget\";s:5:\"<div>\";s:12:\"after_widget\";s:6:\"</div>\";s:12:\"before_title\";s:4:\"<h2>\";s:11:\"after_title\";s:5:\"</h2>\";s:14:\"before_sidebar\";s:0:\"\";s:13:\"after_sidebar\";s:0:\"\";s:12:\"show_in_rest\";b:0;}s:14:\"content_footer\";a:11:{s:4:\"name\";s:14:\"Content footer\";s:2:\"id\";s:14:\"content_footer\";s:11:\"description\";s:0:\"\";s:5:\"class\";s:0:\"\";s:13:\"before_widget\";s:5:\"<div>\";s:12:\"after_widget\";s:6:\"</div>\";s:12:\"before_title\";s:4:\"<h2>\";s:11:\"after_title\";s:5:\"</h2>\";s:14:\"before_sidebar\";s:0:\"\";s:13:\"after_sidebar\";s:0:\"\";s:12:\"show_in_rest\";b:0;}}s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1779972175;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:1:{i:0;s:15:\"vcita_widget_id\";}s:13:\"content_right\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:14:\"content_footer\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}}}}','off');
INSERT INTO `wp_options` VALUES (402,'_site_transient_update_plugins','O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1780301191;s:8:\"response\";a:2:{s:43:\"the-events-calendar/the-events-calendar.php\";O:8:\"stdClass\":13:{s:2:\"id\";s:33:\"w.org/plugins/the-events-calendar\";s:4:\"slug\";s:19:\"the-events-calendar\";s:6:\"plugin\";s:43:\"the-events-calendar/the-events-calendar.php\";s:11:\"new_version\";s:6:\"6.16.3\";s:3:\"url\";s:50:\"https://wordpress.org/plugins/the-events-calendar/\";s:7:\"package\";s:69:\"https://downloads.wordpress.org/plugin/the-events-calendar.6.16.3.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:72:\"https://ps.w.org/the-events-calendar/assets/icon-256x256.gif?rev=2516440\";s:2:\"1x\";s:72:\"https://ps.w.org/the-events-calendar/assets/icon-128x128.gif?rev=2516440\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:75:\"https://ps.w.org/the-events-calendar/assets/banner-1544x500.png?rev=2257622\";s:2:\"1x\";s:74:\"https://ps.w.org/the-events-calendar/assets/banner-772x250.png?rev=2257622\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"6.7\";s:6:\"tested\";s:5:\"6.9.4\";s:12:\"requires_php\";s:3:\"7.4\";s:16:\"requires_plugins\";a:0:{}}s:31:\"wp-migrate-db/wp-migrate-db.php\";O:8:\"stdClass\":13:{s:2:\"id\";s:27:\"w.org/plugins/wp-migrate-db\";s:4:\"slug\";s:13:\"wp-migrate-db\";s:6:\"plugin\";s:31:\"wp-migrate-db/wp-migrate-db.php\";s:11:\"new_version\";s:5:\"2.7.8\";s:3:\"url\";s:44:\"https://wordpress.org/plugins/wp-migrate-db/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/plugin/wp-migrate-db.2.7.8.zip\";s:5:\"icons\";a:2:{s:2:\"1x\";s:58:\"https://ps.w.org/wp-migrate-db/assets/icon.svg?rev=2851356\";s:3:\"svg\";s:58:\"https://ps.w.org/wp-migrate-db/assets/icon.svg?rev=2851356\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:69:\"https://ps.w.org/wp-migrate-db/assets/banner-1544x500.jpg?rev=1809889\";s:2:\"1x\";s:68:\"https://ps.w.org/wp-migrate-db/assets/banner-772x250.jpg?rev=1809889\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"5.2\";s:6:\"tested\";s:3:\"7.0\";s:12:\"requires_php\";s:3:\"5.6\";s:16:\"requires_plugins\";a:0:{}}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:5:{s:30:\"advanced-custom-fields/acf.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:36:\"w.org/plugins/advanced-custom-fields\";s:4:\"slug\";s:22:\"advanced-custom-fields\";s:6:\"plugin\";s:30:\"advanced-custom-fields/acf.php\";s:11:\"new_version\";s:5:\"6.8.2\";s:3:\"url\";s:53:\"https://wordpress.org/plugins/advanced-custom-fields/\";s:7:\"package\";s:71:\"https://downloads.wordpress.org/plugin/advanced-custom-fields.6.8.2.zip\";s:5:\"icons\";a:2:{s:2:\"1x\";s:67:\"https://ps.w.org/advanced-custom-fields/assets/icon.svg?rev=3207824\";s:3:\"svg\";s:67:\"https://ps.w.org/advanced-custom-fields/assets/icon.svg?rev=3207824\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:78:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg?rev=3374528\";s:2:\"1x\";s:77:\"https://ps.w.org/advanced-custom-fields/assets/banner-772x250.jpg?rev=3374528\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"6.2\";}s:46:\"meeting-scheduler-by-vcita/vcita-scheduler.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:40:\"w.org/plugins/meeting-scheduler-by-vcita\";s:4:\"slug\";s:26:\"meeting-scheduler-by-vcita\";s:6:\"plugin\";s:46:\"meeting-scheduler-by-vcita/vcita-scheduler.php\";s:11:\"new_version\";s:5:\"4.6.0\";s:3:\"url\";s:57:\"https://wordpress.org/plugins/meeting-scheduler-by-vcita/\";s:7:\"package\";s:75:\"https://downloads.wordpress.org/plugin/meeting-scheduler-by-vcita.4.6.0.zip\";s:5:\"icons\";a:1:{s:7:\"default\";s:70:\"https://s.w.org/plugins/geopattern-icon/meeting-scheduler-by-vcita.svg\";}s:7:\"banners\";a:0:{}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"4.6\";}s:25:\"duplicator/duplicator.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:24:\"w.org/plugins/duplicator\";s:4:\"slug\";s:10:\"duplicator\";s:6:\"plugin\";s:25:\"duplicator/duplicator.php\";s:11:\"new_version\";s:8:\"1.5.16.1\";s:3:\"url\";s:41:\"https://wordpress.org/plugins/duplicator/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/plugin/duplicator.1.5.16.1.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:63:\"https://ps.w.org/duplicator/assets/icon-256x256.png?rev=2906985\";s:2:\"1x\";s:63:\"https://ps.w.org/duplicator/assets/icon-128x128.png?rev=2906985\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:66:\"https://ps.w.org/duplicator/assets/banner-1544x500.png?rev=2906985\";s:2:\"1x\";s:65:\"https://ps.w.org/duplicator/assets/banner-772x250.png?rev=2906985\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"5.3\";}s:35:\"fulltext-search/fulltext-search.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:29:\"w.org/plugins/fulltext-search\";s:4:\"slug\";s:15:\"fulltext-search\";s:6:\"plugin\";s:35:\"fulltext-search/fulltext-search.php\";s:11:\"new_version\";s:8:\"1.80.280\";s:3:\"url\";s:46:\"https://wordpress.org/plugins/fulltext-search/\";s:7:\"package\";s:67:\"https://downloads.wordpress.org/plugin/fulltext-search.1.80.280.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:68:\"https://ps.w.org/fulltext-search/assets/icon-256x256.png?rev=3084761\";s:2:\"1x\";s:68:\"https://ps.w.org/fulltext-search/assets/icon-256x256.png?rev=3084761\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:71:\"https://ps.w.org/fulltext-search/assets/banner-1544x500.png?rev=3084761\";s:2:\"1x\";s:70:\"https://ps.w.org/fulltext-search/assets/banner-772x250.png?rev=3084762\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"5.0\";}s:24:\"wordpress-seo/wp-seo.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:27:\"w.org/plugins/wordpress-seo\";s:4:\"slug\";s:13:\"wordpress-seo\";s:6:\"plugin\";s:24:\"wordpress-seo/wp-seo.php\";s:11:\"new_version\";s:4:\"27.7\";s:3:\"url\";s:44:\"https://wordpress.org/plugins/wordpress-seo/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/plugin/wordpress-seo.27.7.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:66:\"https://ps.w.org/wordpress-seo/assets/icon-256x256.gif?rev=3419908\";s:2:\"1x\";s:66:\"https://ps.w.org/wordpress-seo/assets/icon-128x128.gif?rev=3419908\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:69:\"https://ps.w.org/wordpress-seo/assets/banner-1544x500.png?rev=3257862\";s:2:\"1x\";s:68:\"https://ps.w.org/wordpress-seo/assets/banner-772x250.png?rev=3257862\";}s:11:\"banners_rtl\";a:2:{s:2:\"2x\";s:73:\"https://ps.w.org/wordpress-seo/assets/banner-1544x500-rtl.png?rev=3257862\";s:2:\"1x\";s:72:\"https://ps.w.org/wordpress-seo/assets/banner-772x250-rtl.png?rev=3257862\";}s:8:\"requires\";s:3:\"6.8\";}}s:7:\"checked\";a:7:{s:30:\"advanced-custom-fields/acf.php\";s:5:\"6.8.2\";s:46:\"meeting-scheduler-by-vcita/vcita-scheduler.php\";s:5:\"4.6.0\";s:25:\"duplicator/duplicator.php\";s:8:\"1.5.16.1\";s:43:\"the-events-calendar/the-events-calendar.php\";s:6:\"6.16.2\";s:35:\"fulltext-search/fulltext-search.php\";s:8:\"1.80.280\";s:31:\"wp-migrate-db/wp-migrate-db.php\";s:5:\"2.7.7\";s:24:\"wordpress-seo/wp-seo.php\";s:4:\"27.7\";}}','off');
INSERT INTO `wp_options` VALUES (484,'theme_mods__acm_backup','a:5:{i:0;b:0;s:19:\"wp_classic_sidebars\";a:0:{}s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1780028021;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:1:{i:0;s:15:\"vcita_widget_id\";}s:13:\"content_right\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:14:\"content_footer\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}}}}','off');
INSERT INTO `wp_options` VALUES (575,'theme_mods_acm','a:2:{s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;}','auto');
INSERT INTO `wp_options` VALUES (955,'_transient_health-check-site-status-result','{\"good\":16,\"recommended\":4,\"critical\":2}','on');
INSERT INTO `wp_options` VALUES (962,'_site_transient_timeout_theme_roots','1780302991','off');
INSERT INTO `wp_options` VALUES (963,'_site_transient_theme_roots','a:5:{s:11:\"_acm_backup\";s:7:\"/themes\";s:3:\"acm\";s:7:\"/themes\";s:16:\"twentytwentyfive\";s:7:\"/themes\";s:16:\"twentytwentyfour\";s:7:\"/themes\";s:17:\"twentytwentythree\";s:7:\"/themes\";}','off');
INSERT INTO `wp_options` VALUES (1015,'_site_transient_timeout_wp_theme_files_patterns-17dd76b314c3ce47414e34db2cf1ca5d','1780308170','off');
INSERT INTO `wp_options` VALUES (1016,'_site_transient_wp_theme_files_patterns-17dd76b314c3ce47414e34db2cf1ca5d','a:2:{s:7:\"version\";s:3:\"2.0\";s:8:\"patterns\";a:0:{}}','off');
INSERT INTO `wp_options` VALUES (1021,'_transient_timeout_wpfts_se_css_transient','1780306975','off');
INSERT INTO `wp_options` VALUES (1022,'_transient_wpfts_se_css_transient','.wpfts-result-item .wpfts-smart-excerpt {}.wpfts-result-item .wpfts-smart-excerpt b {font-weight:bold !important;}.wpfts-result-item .wpfts-not-found {color:#808080;font-size:0.9em;}.wpfts-result-item .wpfts-score {color:#006621;font-size:0.9em;}.wpfts-shift {margin-left:40px;}.wpfts-result-item .wpfts-download-link {color:#006621;font-size:0.9em;}.wpfts-result-item .wpfts-file-size {color:#006621;font-size:0.9em;}.wpfts-result-item .wpfts-sentence-link {text-decoration:none;cursor:pointer;color:unset;}.wpfts-result-item .wpfts-sentence-link:hover {text-decoration:underline;color:inherit;}.wpfts-result-item .wpfts-word-link {text-decoration:none;cursor:pointer;}.wpfts-result-item .wpfts-word-link:hover {text-decoration:underline;}wpfts-highlight.wpfts-highlight-sentence {background-color:rgba(255, 255, 128, 0.5) !important;display:inline-block;}wpfts-highlight.wpfts-highlight-word {background-color:rgba(255, 128, 128, 0.5) !important;display:inline-block;}','off');
/*!40000 ALTER TABLE `wp_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_postmeta`
--

LOCK TABLES `wp_postmeta` WRITE;
/*!40000 ALTER TABLE `wp_postmeta` DISABLE KEYS */;
INSERT INTO `wp_postmeta` VALUES (1,2,'_wp_page_template','default');
INSERT INTO `wp_postmeta` VALUES (2,3,'_wp_page_template','default');
/*!40000 ALTER TABLE `wp_postmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_posts` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`),
  KEY `type_status_author` (`post_type`,`post_status`,`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_posts`
--

LOCK TABLES `wp_posts` WRITE;
/*!40000 ALTER TABLE `wp_posts` DISABLE KEYS */;
INSERT INTO `wp_posts` VALUES (1,1,'2026-05-28 11:58:04','2026-05-28 11:58:04','<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->','Hello world!','','publish','open','open','','hello-world','','','2026-05-28 11:58:04','2026-05-28 11:58:04','',0,'http://acm-local.local/?p=1',0,'post','',1);
INSERT INTO `wp_posts` VALUES (2,1,'2026-05-28 11:58:04','2026-05-28 11:58:04','<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\">\n<!-- wp:paragraph -->\n<p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</p>\n<!-- /wp:paragraph -->\n</blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\">\n<!-- wp:paragraph -->\n<p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p>\n<!-- /wp:paragraph -->\n</blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href=\"http://acm-local.local/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->','Sample Page','','publish','closed','open','','sample-page','','','2026-05-28 11:58:04','2026-05-28 11:58:04','',0,'http://acm-local.local/?page_id=2',0,'page','',0);
INSERT INTO `wp_posts` VALUES (3,1,'2026-05-28 11:58:04','2026-05-28 11:58:04','<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Who we are</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Our website address is: http://acm-local.local.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Comments</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Media</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Cookies</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Embedded content from other websites</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Who we share your data with</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you request a password reset, your IP address will be included in the reset email.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">How long we retain your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">What rights you have over your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Where your data is sent</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Visitor comments may be checked through an automated spam detection service.</p>\n<!-- /wp:paragraph -->\n','Privacy Policy','','draft','closed','open','','privacy-policy','','','2026-05-28 11:58:04','2026-05-28 11:58:04','',0,'http://acm-local.local/?page_id=3',0,'page','',0);
INSERT INTO `wp_posts` VALUES (4,1,'2026-05-28 12:00:36','0000-00-00 00:00:00','','Auto Draft','','auto-draft','open','open','','','','','2026-05-28 12:00:36','0000-00-00 00:00:00','',0,'http://acm-local.local/?p=4',0,'post','',0);
INSERT INTO `wp_posts` VALUES (5,1,'2026-05-28 12:01:05','2026-05-28 12:01:05','<!-- wp:page-list /-->','Navigation','','publish','closed','closed','','navigation','','','2026-05-28 12:01:05','2026-05-28 12:01:05','',0,'http://acm-local.local/navigation/',0,'wp_navigation','',0);
INSERT INTO `wp_posts` VALUES (6,1,'2026-05-28 12:08:06','2026-05-28 12:08:06','{\"version\": 3, \"isGlobalStylesUserThemeJSON\": true }','Custom Styles','','publish','closed','closed','','wp-global-styles-css%2f','','','2026-05-28 12:08:06','2026-05-28 12:08:06','',0,'http://acm-local.local/wp-global-styles-css%2f/',0,'wp_global_styles','',0);
INSERT INTO `wp_posts` VALUES (7,1,'2026-05-28 12:08:08','2026-05-28 12:08:08','<!-- wp:template-part {\"slug\":\"header\",\"tagName\":\"header\",\"theme\":\"css/..\"} /-->\n<!-- wp:tec/archive-events /-->\n<!-- wp:template-part {\"slug\":\"footer\",\"tagName\":\"footer\",\"theme\":\"css/..\"} /-->\n','Calendar Views (Event Archive)','Displays the calendar views.','publish','closed','closed','','archive-events','','','2026-05-28 12:08:08','2026-05-28 12:08:08','',0,'http://acm-local.local/archive-events/',0,'wp_template','',0);
INSERT INTO `wp_posts` VALUES (8,1,'2026-05-28 12:08:09','2026-05-28 12:08:09','<!-- wp:template-part {\"slug\":\"header\",\"tagName\":\"header\",\"theme\":\"css/..\"} /-->\n<!-- wp:tec/single-event /-->\n<!-- wp:template-part {\"slug\":\"footer\",\"tagName\":\"footer\",\"theme\":\"css/..\"} /-->\n','Single Event','Displays a single event.','publish','closed','closed','','single-event','','','2026-05-28 12:08:09','2026-05-28 12:08:09','',0,'http://acm-local.local/single-event/',0,'wp_template','',0);
INSERT INTO `wp_posts` VALUES (9,1,'2026-05-28 12:23:32','2026-05-28 12:23:32','{\"version\": 3, \"isGlobalStylesUserThemeJSON\": true }','Custom Styles','','publish','closed','closed','','wp-global-styles-gutenberg-blocks%2f','','','2026-05-28 12:23:32','2026-05-28 12:23:32','',0,'http://acm-local.local/wp-global-styles-gutenberg-blocks%2f/',0,'wp_global_styles','',0);
INSERT INTO `wp_posts` VALUES (10,1,'2026-05-28 12:23:54','2026-05-28 12:23:54','{\"version\": 3, \"isGlobalStylesUserThemeJSON\": true }','Custom Styles','','publish','closed','closed','','wp-global-styles-img%2f','','','2026-05-28 12:23:54','2026-05-28 12:23:54','',0,'http://acm-local.local/wp-global-styles-img%2f/',0,'wp_global_styles','',0);
INSERT INTO `wp_posts` VALUES (11,1,'2026-05-28 12:24:12','2026-05-28 12:24:12','{\"version\": 3, \"isGlobalStylesUserThemeJSON\": true }','Custom Styles','','publish','closed','closed','','wp-global-styles-tests%2f','','','2026-05-28 12:24:12','2026-05-28 12:24:12','',0,'http://acm-local.local/wp-global-styles-tests%2f/',0,'wp_global_styles','',0);
INSERT INTO `wp_posts` VALUES (12,1,'2026-05-28 12:24:33','2026-05-28 12:24:33','{\"version\": 3, \"isGlobalStylesUserThemeJSON\": true }','Custom Styles','','publish','closed','closed','','wp-global-styles-src%2f','','','2026-05-28 12:24:33','2026-05-28 12:24:33','',0,'http://acm-local.local/wp-global-styles-src%2f/',0,'wp_global_styles','',0);
INSERT INTO `wp_posts` VALUES (13,1,'2026-05-28 12:43:07','2026-05-28 12:43:07','{\"version\": 3, \"isGlobalStylesUserThemeJSON\": true }','Custom Styles','','publish','closed','closed','','wp-global-styles-_acm_backup','','','2026-05-28 12:43:07','2026-05-28 12:43:07','',0,'http://acm-local.local/wp-global-styles-_acm_backup/',0,'wp_global_styles','',0);
INSERT INTO `wp_posts` VALUES (14,1,'2026-05-28 12:43:48','2026-05-28 12:43:48','{\"version\": 3, \"isGlobalStylesUserThemeJSON\": true }','Custom Styles','','publish','closed','closed','','wp-global-styles-twentytwentyfive','','','2026-05-28 12:43:48','2026-05-28 12:43:48','',0,'http://acm-local.local/wp-global-styles-twentytwentyfive/',0,'wp_global_styles','',0);
/*!40000 ALTER TABLE `wp_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_shepherd_tec_tasks`
--

DROP TABLE IF EXISTS `wp_shepherd_tec_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_shepherd_tec_tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `action_id` bigint unsigned NOT NULL,
  `class_hash` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `args_hash` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_520_ci,
  `current_try` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `action_id` (`action_id`),
  KEY `class_hash` (`class_hash`),
  KEY `args_hash` (`args_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_shepherd_tec_tasks`
--

LOCK TABLES `wp_shepherd_tec_tasks` WRITE;
/*!40000 ALTER TABLE `wp_shepherd_tec_tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_shepherd_tec_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_tec_events`
--

DROP TABLE IF EXISTS `wp_tec_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_tec_events` (
  `event_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint unsigned NOT NULL,
  `start_date` varchar(19) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `end_date` varchar(19) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `timezone` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'UTC',
  `start_date_utc` varchar(19) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `end_date_utc` varchar(19) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `duration` mediumint DEFAULT '7200',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hash` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`event_id`),
  UNIQUE KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_tec_events`
--

LOCK TABLES `wp_tec_events` WRITE;
/*!40000 ALTER TABLE `wp_tec_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_tec_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_tec_kv_cache`
--

DROP TABLE IF EXISTS `wp_tec_kv_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_tec_kv_cache` (
  `cache_key` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_520_ci,
  `expiration` bigint unsigned DEFAULT '0',
  PRIMARY KEY (`cache_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_tec_kv_cache`
--

LOCK TABLES `wp_tec_kv_cache` WRITE;
/*!40000 ALTER TABLE `wp_tec_kv_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_tec_kv_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_tec_occurrences`
--

DROP TABLE IF EXISTS `wp_tec_occurrences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_tec_occurrences` (
  `occurrence_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  `start_date` datetime NOT NULL,
  `start_date_utc` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `end_date_utc` datetime NOT NULL,
  `duration` mediumint DEFAULT '7200',
  `hash` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`occurrence_id`),
  UNIQUE KEY `hash` (`hash`),
  KEY `event_id` (`event_id`),
  KEY `idx_wp_tec_occurrences_post_id_dates` (`post_id`,`end_date`,`start_date`),
  KEY `idx_wp_tec_occurrences_post_id_dates_utc` (`post_id`,`end_date_utc`,`start_date_utc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_tec_occurrences`
--

LOCK TABLES `wp_tec_occurrences` WRITE;
/*!40000 ALTER TABLE `wp_tec_occurrences` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_tec_occurrences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint unsigned NOT NULL DEFAULT '0',
  `term_order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_relationships`
--

LOCK TABLES `wp_term_relationships` WRITE;
/*!40000 ALTER TABLE `wp_term_relationships` DISABLE KEYS */;
INSERT INTO `wp_term_relationships` VALUES (1,1,0);
INSERT INTO `wp_term_relationships` VALUES (6,2,0);
INSERT INTO `wp_term_relationships` VALUES (7,3,0);
INSERT INTO `wp_term_relationships` VALUES (8,3,0);
INSERT INTO `wp_term_relationships` VALUES (9,4,0);
INSERT INTO `wp_term_relationships` VALUES (10,5,0);
INSERT INTO `wp_term_relationships` VALUES (11,6,0);
INSERT INTO `wp_term_relationships` VALUES (12,7,0);
INSERT INTO `wp_term_relationships` VALUES (13,8,0);
INSERT INTO `wp_term_relationships` VALUES (14,9,0);
/*!40000 ALTER TABLE `wp_term_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint unsigned NOT NULL DEFAULT '0',
  `count` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_taxonomy`
--

LOCK TABLES `wp_term_taxonomy` WRITE;
/*!40000 ALTER TABLE `wp_term_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_term_taxonomy` VALUES (1,1,'category','',0,1);
INSERT INTO `wp_term_taxonomy` VALUES (2,2,'wp_theme','',0,1);
INSERT INTO `wp_term_taxonomy` VALUES (3,3,'wp_theme','',0,2);
INSERT INTO `wp_term_taxonomy` VALUES (4,4,'wp_theme','',0,1);
INSERT INTO `wp_term_taxonomy` VALUES (5,5,'wp_theme','',0,1);
INSERT INTO `wp_term_taxonomy` VALUES (6,6,'wp_theme','',0,1);
INSERT INTO `wp_term_taxonomy` VALUES (7,7,'wp_theme','',0,1);
INSERT INTO `wp_term_taxonomy` VALUES (8,8,'wp_theme','',0,1);
INSERT INTO `wp_term_taxonomy` VALUES (9,9,'wp_theme','',0,1);
/*!40000 ALTER TABLE `wp_term_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_termmeta`
--

DROP TABLE IF EXISTS `wp_termmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_termmeta` (
  `meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_termmeta`
--

LOCK TABLES `wp_termmeta` WRITE;
/*!40000 ALTER TABLE `wp_termmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_termmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_terms` (
  `term_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_terms`
--

LOCK TABLES `wp_terms` WRITE;
/*!40000 ALTER TABLE `wp_terms` DISABLE KEYS */;
INSERT INTO `wp_terms` VALUES (1,'Uncategorized','uncategorized',0);
INSERT INTO `wp_terms` VALUES (2,'css/..','css',0);
INSERT INTO `wp_terms` VALUES (3,'tec','tec',0);
INSERT INTO `wp_terms` VALUES (4,'gutenberg-blocks/..','gutenberg-blocks',0);
INSERT INTO `wp_terms` VALUES (5,'img/..','img',0);
INSERT INTO `wp_terms` VALUES (6,'tests/..','tests',0);
INSERT INTO `wp_terms` VALUES (7,'src/..','src',0);
INSERT INTO `wp_terms` VALUES (8,'_acm_backup','_acm_backup',0);
INSERT INTO `wp_terms` VALUES (9,'twentytwentyfive','twentytwentyfive',0);
/*!40000 ALTER TABLE `wp_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_usermeta`
--

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES (1,1,'nickname','Navneet');
INSERT INTO `wp_usermeta` VALUES (2,1,'first_name','');
INSERT INTO `wp_usermeta` VALUES (3,1,'last_name','');
INSERT INTO `wp_usermeta` VALUES (4,1,'description','');
INSERT INTO `wp_usermeta` VALUES (5,1,'rich_editing','true');
INSERT INTO `wp_usermeta` VALUES (6,1,'syntax_highlighting','true');
INSERT INTO `wp_usermeta` VALUES (7,1,'comment_shortcuts','false');
INSERT INTO `wp_usermeta` VALUES (8,1,'admin_color','modern');
INSERT INTO `wp_usermeta` VALUES (9,1,'use_ssl','0');
INSERT INTO `wp_usermeta` VALUES (10,1,'show_admin_bar_front','true');
INSERT INTO `wp_usermeta` VALUES (11,1,'locale','');
INSERT INTO `wp_usermeta` VALUES (12,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}');
INSERT INTO `wp_usermeta` VALUES (13,1,'wp_user_level','10');
INSERT INTO `wp_usermeta` VALUES (14,1,'dismissed_wp_pointers','');
INSERT INTO `wp_usermeta` VALUES (15,1,'show_welcome_panel','0');
INSERT INTO `wp_usermeta` VALUES (16,1,'session_tokens','a:1:{s:64:\"7c65597177c5bdc5f97bbc3923260154a07da98a0a18ac4c72dce7814f45659e\";a:4:{s:10:\"expiration\";i:1780142432;s:2:\"ip\";s:9:\"127.0.0.1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36\";s:5:\"login\";i:1779969632;}}');
INSERT INTO `wp_usermeta` VALUES (17,1,'wp_dashboard_quick_press_last_post_id','4');
INSERT INTO `wp_usermeta` VALUES (18,1,'wp_yoast_notifications','a:1:{i:0;a:2:{s:7:\"message\";s:394:\"Yoast indexables are disabled because your site is in a non-production environment or custom code is blocking them. This may affect your SEO features. <a href=\"https://yoa.st/indexables-disabled?php_version=8.2&#038;platform=wordpress&#038;platform_version=7.0&#038;software=free&#038;software_version=27.7&#038;days_active=1&#038;user_language=en_US\" target=\"_blank\">Learn more about this</a>.\";s:7:\"options\";a:11:{s:4:\"type\";s:7:\"warning\";s:2:\"id\";s:25:\"wpseo-indexables-disabled\";s:7:\"user_id\";i:1;s:5:\"nonce\";N;s:8:\"priority\";d:0.5;s:9:\"data_json\";a:0:{}s:13:\"dismissal_key\";N;s:12:\"capabilities\";a:1:{i:0;s:20:\"wpseo_manage_options\";}s:16:\"capability_check\";s:3:\"all\";s:14:\"yoast_branding\";b:0;s:13:\"resolve_nonce\";s:0:\"\";}}}');
INSERT INTO `wp_usermeta` VALUES (19,1,'_yoast_wpseo_introductions','a:0:{}');
INSERT INTO `wp_usermeta` VALUES (20,1,'wp_persisted_preferences','a:2:{s:4:\"core\";a:1:{s:26:\"isComplementaryAreaVisible\";b:1;}s:9:\"_modified\";s:24:\"2026-05-28T12:08:12.885Z\";}');
INSERT INTO `wp_usermeta` VALUES (21,1,'_yoast_wpseo_profile_updated','1779972463');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_users` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_users`
--

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` VALUES (1,'Navneet','$wp$2y$10$b6lyRjPaVQ9y8aXYWuQEmu7HIx0FuO8R.ODmPRwA088tmidEqmxey','navneet','kumarnavneet7765@gmail.com','http://acm-local.local','2026-05-28 11:58:04','',0,'Navneet');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_expiring_store`
--

DROP TABLE IF EXISTS `wp_yoast_expiring_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_yoast_expiring_store` (
  `key_name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `exp` datetime NOT NULL,
  PRIMARY KEY (`key_name`),
  KEY `exp_index` (`exp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_expiring_store`
--

LOCK TABLES `wp_yoast_expiring_store` WRITE;
/*!40000 ALTER TABLE `wp_yoast_expiring_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_yoast_expiring_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_indexable`
--

DROP TABLE IF EXISTS `wp_yoast_indexable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_yoast_indexable` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `permalink` longtext COLLATE utf8mb4_unicode_520_ci,
  `permalink_hash` varchar(40) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `object_id` bigint DEFAULT NULL,
  `object_type` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `object_sub_type` varchar(32) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `author_id` bigint DEFAULT NULL,
  `post_parent` bigint DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_520_ci,
  `description` mediumtext COLLATE utf8mb4_unicode_520_ci,
  `breadcrumb_title` text COLLATE utf8mb4_unicode_520_ci,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `is_protected` tinyint(1) DEFAULT '0',
  `has_public_posts` tinyint(1) DEFAULT NULL,
  `number_of_pages` int unsigned DEFAULT NULL,
  `canonical` longtext COLLATE utf8mb4_unicode_520_ci,
  `primary_focus_keyword` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `primary_focus_keyword_score` int DEFAULT NULL,
  `readability_score` int DEFAULT NULL,
  `is_cornerstone` tinyint(1) DEFAULT '0',
  `is_robots_noindex` tinyint(1) DEFAULT '0',
  `is_robots_nofollow` tinyint(1) DEFAULT '0',
  `is_robots_noarchive` tinyint(1) DEFAULT '0',
  `is_robots_noimageindex` tinyint(1) DEFAULT '0',
  `is_robots_nosnippet` tinyint(1) DEFAULT '0',
  `twitter_title` text COLLATE utf8mb4_unicode_520_ci,
  `twitter_image` longtext COLLATE utf8mb4_unicode_520_ci,
  `twitter_description` longtext COLLATE utf8mb4_unicode_520_ci,
  `twitter_image_id` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `twitter_image_source` text COLLATE utf8mb4_unicode_520_ci,
  `open_graph_title` text COLLATE utf8mb4_unicode_520_ci,
  `open_graph_description` longtext COLLATE utf8mb4_unicode_520_ci,
  `open_graph_image` longtext COLLATE utf8mb4_unicode_520_ci,
  `open_graph_image_id` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `open_graph_image_source` text COLLATE utf8mb4_unicode_520_ci,
  `open_graph_image_meta` mediumtext COLLATE utf8mb4_unicode_520_ci,
  `link_count` int DEFAULT NULL,
  `incoming_link_count` int DEFAULT NULL,
  `prominent_words_version` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blog_id` bigint NOT NULL DEFAULT '1',
  `language` varchar(32) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `region` varchar(32) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `schema_page_type` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `schema_article_type` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `has_ancestors` tinyint(1) DEFAULT '0',
  `estimated_reading_time_minutes` int DEFAULT NULL,
  `version` int DEFAULT '1',
  `object_last_modified` datetime DEFAULT NULL,
  `object_published_at` datetime DEFAULT NULL,
  `inclusive_language_score` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `object_type_and_sub_type` (`object_type`,`object_sub_type`),
  KEY `object_id_and_type` (`object_id`,`object_type`),
  KEY `permalink_hash_and_object_type` (`permalink_hash`,`object_type`),
  KEY `subpages` (`post_parent`,`object_type`,`post_status`,`object_id`),
  KEY `prominent_words` (`prominent_words_version`,`object_type`,`object_sub_type`,`post_status`),
  KEY `published_sitemap_index` (`object_published_at`,`is_robots_noindex`,`object_type`,`object_sub_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_indexable`
--

LOCK TABLES `wp_yoast_indexable` WRITE;
/*!40000 ALTER TABLE `wp_yoast_indexable` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_yoast_indexable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_indexable_hierarchy`
--

DROP TABLE IF EXISTS `wp_yoast_indexable_hierarchy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_yoast_indexable_hierarchy` (
  `indexable_id` int unsigned NOT NULL,
  `ancestor_id` int unsigned NOT NULL,
  `depth` int unsigned DEFAULT NULL,
  `blog_id` bigint NOT NULL DEFAULT '1',
  PRIMARY KEY (`indexable_id`,`ancestor_id`),
  KEY `indexable_id` (`indexable_id`),
  KEY `ancestor_id` (`ancestor_id`),
  KEY `depth` (`depth`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_indexable_hierarchy`
--

LOCK TABLES `wp_yoast_indexable_hierarchy` WRITE;
/*!40000 ALTER TABLE `wp_yoast_indexable_hierarchy` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_yoast_indexable_hierarchy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_migrations`
--

DROP TABLE IF EXISTS `wp_yoast_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_yoast_migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wp_yoast_migrations_version` (`version`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_migrations`
--

LOCK TABLES `wp_yoast_migrations` WRITE;
/*!40000 ALTER TABLE `wp_yoast_migrations` DISABLE KEYS */;
INSERT INTO `wp_yoast_migrations` VALUES (1,'20171228151840');
INSERT INTO `wp_yoast_migrations` VALUES (2,'20171228151841');
INSERT INTO `wp_yoast_migrations` VALUES (3,'20190529075038');
INSERT INTO `wp_yoast_migrations` VALUES (4,'20191011111109');
INSERT INTO `wp_yoast_migrations` VALUES (5,'20200408101900');
INSERT INTO `wp_yoast_migrations` VALUES (6,'20200420073606');
INSERT INTO `wp_yoast_migrations` VALUES (7,'20200428123747');
INSERT INTO `wp_yoast_migrations` VALUES (8,'20200428194858');
INSERT INTO `wp_yoast_migrations` VALUES (9,'20200429105310');
INSERT INTO `wp_yoast_migrations` VALUES (10,'20200430075614');
INSERT INTO `wp_yoast_migrations` VALUES (11,'20200430150130');
INSERT INTO `wp_yoast_migrations` VALUES (12,'20200507054848');
INSERT INTO `wp_yoast_migrations` VALUES (13,'20200513133401');
INSERT INTO `wp_yoast_migrations` VALUES (14,'20200609154515');
INSERT INTO `wp_yoast_migrations` VALUES (15,'20200616130143');
INSERT INTO `wp_yoast_migrations` VALUES (16,'20200617122511');
INSERT INTO `wp_yoast_migrations` VALUES (17,'20200702141921');
INSERT INTO `wp_yoast_migrations` VALUES (18,'20200728095334');
INSERT INTO `wp_yoast_migrations` VALUES (19,'20201202144329');
INSERT INTO `wp_yoast_migrations` VALUES (20,'20201216124002');
INSERT INTO `wp_yoast_migrations` VALUES (21,'20201216141134');
INSERT INTO `wp_yoast_migrations` VALUES (22,'20210817092415');
INSERT INTO `wp_yoast_migrations` VALUES (23,'20211020091404');
INSERT INTO `wp_yoast_migrations` VALUES (24,'20230417083836');
INSERT INTO `wp_yoast_migrations` VALUES (25,'20260105111111');
INSERT INTO `wp_yoast_migrations` VALUES (26,'20260325155530');
/*!40000 ALTER TABLE `wp_yoast_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_primary_term`
--

DROP TABLE IF EXISTS `wp_yoast_primary_term`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_yoast_primary_term` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint DEFAULT NULL,
  `term_id` bigint DEFAULT NULL,
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blog_id` bigint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `post_taxonomy` (`post_id`,`taxonomy`),
  KEY `post_term` (`post_id`,`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_primary_term`
--

LOCK TABLES `wp_yoast_primary_term` WRITE;
/*!40000 ALTER TABLE `wp_yoast_primary_term` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_yoast_primary_term` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_yoast_seo_links`
--

DROP TABLE IF EXISTS `wp_yoast_seo_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_yoast_seo_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `post_id` bigint unsigned DEFAULT NULL,
  `target_post_id` bigint unsigned DEFAULT NULL,
  `type` varchar(8) DEFAULT NULL,
  `indexable_id` int unsigned DEFAULT NULL,
  `target_indexable_id` int unsigned DEFAULT NULL,
  `height` int unsigned DEFAULT NULL,
  `width` int unsigned DEFAULT NULL,
  `size` int unsigned DEFAULT NULL,
  `language` varchar(32) DEFAULT NULL,
  `region` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `link_direction` (`post_id`,`type`),
  KEY `indexable_link_direction` (`indexable_id`,`type`),
  KEY `url_index` (`url`),
  KEY `target_indexable_id_index` (`target_indexable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_yoast_seo_links`
--

LOCK TABLES `wp_yoast_seo_links` WRITE;
/*!40000 ALTER TABLE `wp_yoast_seo_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_yoast_seo_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_docs`
--

DROP TABLE IF EXISTS `wpftsi_docs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_docs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `index_id` int NOT NULL DEFAULT '0',
  `token` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `n` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`(190)),
  KEY `index_id` (`index_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_docs`
--

LOCK TABLES `wpftsi_docs` WRITE;
/*!40000 ALTER TABLE `wpftsi_docs` DISABLE KEYS */;
INSERT INTO `wpftsi_docs` VALUES (1,5,'post_title',1);
INSERT INTO `wpftsi_docs` VALUES (2,5,'post_content',0);
INSERT INTO `wpftsi_docs` VALUES (3,5,'post_excerpt',0);
INSERT INTO `wpftsi_docs` VALUES (4,2,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (5,2,'post_content',156);
INSERT INTO `wpftsi_docs` VALUES (6,2,'post_excerpt',0);
INSERT INTO `wpftsi_docs` VALUES (7,1,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (8,1,'post_content',15);
INSERT INTO `wpftsi_docs` VALUES (9,1,'post_excerpt',0);
INSERT INTO `wpftsi_docs` VALUES (10,6,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (11,6,'post_content',4);
INSERT INTO `wpftsi_docs` VALUES (12,6,'post_excerpt',0);
INSERT INTO `wpftsi_docs` VALUES (13,7,'post_title',4);
INSERT INTO `wpftsi_docs` VALUES (14,7,'post_content',0);
INSERT INTO `wpftsi_docs` VALUES (15,7,'post_excerpt',4);
INSERT INTO `wpftsi_docs` VALUES (16,8,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (17,8,'post_content',0);
INSERT INTO `wpftsi_docs` VALUES (18,8,'post_excerpt',4);
INSERT INTO `wpftsi_docs` VALUES (19,9,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (20,9,'post_content',4);
INSERT INTO `wpftsi_docs` VALUES (21,9,'post_excerpt',0);
INSERT INTO `wpftsi_docs` VALUES (22,10,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (23,10,'post_content',4);
INSERT INTO `wpftsi_docs` VALUES (24,10,'post_excerpt',0);
INSERT INTO `wpftsi_docs` VALUES (25,11,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (26,11,'post_content',4);
INSERT INTO `wpftsi_docs` VALUES (27,11,'post_excerpt',0);
INSERT INTO `wpftsi_docs` VALUES (28,12,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (29,12,'post_content',4);
INSERT INTO `wpftsi_docs` VALUES (30,12,'post_excerpt',0);
INSERT INTO `wpftsi_docs` VALUES (31,13,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (32,13,'post_content',4);
INSERT INTO `wpftsi_docs` VALUES (33,13,'post_excerpt',0);
INSERT INTO `wpftsi_docs` VALUES (34,14,'post_title',2);
INSERT INTO `wpftsi_docs` VALUES (35,14,'post_content',4);
INSERT INTO `wpftsi_docs` VALUES (36,14,'post_excerpt',0);
/*!40000 ALTER TABLE `wpftsi_docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_doctree`
--

DROP TABLE IF EXISTS `wpftsi_doctree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_doctree` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `p_tid` bigint unsigned NOT NULL DEFAULT '0',
  `p_tsrc` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `p_token` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `c_tid` bigint unsigned NOT NULL DEFAULT '0',
  `c_tsrc` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `c_token` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `p_token` (`p_token`(190)),
  KEY `c_token` (`c_token`(190)),
  KEY `p_tid` (`p_tid`,`p_tsrc`(100)),
  KEY `c_tid` (`c_tid`,`c_tsrc`(100)),
  KEY `p_tid_2` (`p_tid`),
  KEY `p_tsrc` (`p_tsrc`(100)),
  KEY `c_tid_2` (`c_tid`),
  KEY `c_tsrc` (`c_tsrc`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_doctree`
--

LOCK TABLES `wpftsi_doctree` WRITE;
/*!40000 ALTER TABLE `wpftsi_doctree` DISABLE KEYS */;
/*!40000 ALTER TABLE `wpftsi_doctree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_ilog`
--

DROP TABLE IF EXISTS `wpftsi_ilog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_ilog` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `index_id` int unsigned NOT NULL DEFAULT '0',
  `start_ts` double(18,6) NOT NULL DEFAULT '0.000000',
  `getpost_ts` double(18,6) NOT NULL DEFAULT '0.000000',
  `clusters_ts` double(18,6) NOT NULL DEFAULT '0.000000',
  `cluster_stats` longtext COLLATE utf8mb4_unicode_520_ci,
  `reindex_ts` double(18,6) NOT NULL DEFAULT '0.000000',
  `status` int NOT NULL DEFAULT '0',
  `error` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_id` (`index_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_ilog`
--

LOCK TABLES `wpftsi_ilog` WRITE;
/*!40000 ALTER TABLE `wpftsi_ilog` DISABLE KEYS */;
INSERT INTO `wpftsi_ilog` VALUES (1,5,1779970046.409100,0.010567,0.014681,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":10,\"post_content\":0,\"post_excerpt\":0}',0.040237,3,'');
INSERT INTO `wpftsi_ilog` VALUES (2,4,1779970046.454500,0.004508,0.006993,'{\"__used_rules\":\"[\\u00220\\u0022]\",\"__debug\":\"[]\"}',0.009883,3,'');
INSERT INTO `wpftsi_ilog` VALUES (3,3,1779970046.469700,0.005182,0.007907,'{\"__used_rules\":\"[\\u00220\\u0022]\",\"__debug\":\"[]\"}',0.010465,3,'');
INSERT INTO `wpftsi_ilog` VALUES (4,2,1779970046.485200,0.004707,0.007565,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":11,\"post_content\":875,\"post_excerpt\":0}',0.031559,3,'');
INSERT INTO `wpftsi_ilog` VALUES (5,1,1779970046.521900,0.006612,0.009872,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":12,\"post_content\":87,\"post_excerpt\":0}',0.033965,3,'');
INSERT INTO `wpftsi_ilog` VALUES (6,6,1779970088.019300,0.005654,0.009251,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":13,\"post_content\":52,\"post_excerpt\":0}',0.036523,3,'');
INSERT INTO `wpftsi_ilog` VALUES (7,7,1779970088.061100,0.005721,0.008304,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":30,\"post_content\":3,\"post_excerpt\":28}',0.028230,3,'');
INSERT INTO `wpftsi_ilog` VALUES (8,8,1779970123.110100,0.012552,0.019078,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":12,\"post_content\":3,\"post_excerpt\":24}',0.055207,3,'');
INSERT INTO `wpftsi_ilog` VALUES (9,9,1779971014.140100,0.013552,0.025210,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":13,\"post_content\":52,\"post_excerpt\":0}',0.063458,3,'');
INSERT INTO `wpftsi_ilog` VALUES (10,10,1779971035.458300,0.006984,0.010763,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":13,\"post_content\":52,\"post_excerpt\":0}',0.037796,3,'');
INSERT INTO `wpftsi_ilog` VALUES (11,11,1779971053.671900,0.007561,0.011509,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":13,\"post_content\":52,\"post_excerpt\":0}',0.035196,3,'');
INSERT INTO `wpftsi_ilog` VALUES (12,12,1779971074.848800,0.007470,0.010110,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":13,\"post_content\":52,\"post_excerpt\":0}',0.035608,3,'');
INSERT INTO `wpftsi_ilog` VALUES (13,13,1779972188.890400,0.007242,0.010869,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":13,\"post_content\":52,\"post_excerpt\":0}',0.037263,3,'');
INSERT INTO `wpftsi_ilog` VALUES (14,14,1779972230.012000,0.009380,0.014219,'{\"__used_rules\":\"[\\u00221\\u0022]\",\"__debug\":\"[]\",\"post_title\":13,\"post_content\":52,\"post_excerpt\":0}',0.035261,3,'');
/*!40000 ALTER TABLE `wpftsi_ilog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_index`
--

DROP TABLE IF EXISTS `wpftsi_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_index` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tid` bigint unsigned NOT NULL,
  `tsrc` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `tdt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `build_time` int NOT NULL DEFAULT '0',
  `update_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `force_rebuild` tinyint NOT NULL DEFAULT '0',
  `locked_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `rules_idset` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tid_tsrc_unique` (`tid`,`tsrc`(100)),
  KEY `tid` (`tid`),
  KEY `build_time` (`build_time`),
  KEY `force_rebuild` (`force_rebuild`),
  KEY `locked_dt` (`locked_dt`),
  KEY `tsrc` (`tsrc`(100)),
  KEY `rules_idset` (`rules_idset`(190))
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_index`
--

LOCK TABLES `wpftsi_index` WRITE;
/*!40000 ALTER TABLE `wpftsi_index` DISABLE KEYS */;
INSERT INTO `wpftsi_index` VALUES (1,1,'wp_posts','2026-05-28 11:58:04',1779970046,'2026-05-28 12:07:26',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (2,2,'wp_posts','2026-05-28 11:58:04',1779970046,'2026-05-28 12:07:26',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (3,3,'wp_posts','2026-05-28 11:58:04',1779970046,'2026-05-28 12:07:26',0,'1970-01-01 00:00:00','0');
INSERT INTO `wpftsi_index` VALUES (4,4,'wp_posts','2026-05-28 12:00:36',1779970046,'2026-05-28 12:07:26',0,'1970-01-01 00:00:00','0');
INSERT INTO `wpftsi_index` VALUES (5,5,'wp_posts','2026-05-28 12:01:05',1779970046,'2026-05-28 12:07:26',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (6,6,'wp_posts','2026-05-28 12:08:06',1779970088,'2026-05-28 12:08:08',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (7,7,'wp_posts','2026-05-28 12:08:08',1779970088,'2026-05-28 12:08:08',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (8,8,'wp_posts','2026-05-28 12:08:09',1779970123,'2026-05-28 12:08:43',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (9,9,'wp_posts','2026-05-28 12:23:32',1779971014,'2026-05-28 12:23:34',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (10,10,'wp_posts','2026-05-28 12:23:54',1779971035,'2026-05-28 12:23:55',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (11,11,'wp_posts','2026-05-28 12:24:12',1779971053,'2026-05-28 12:24:13',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (12,12,'wp_posts','2026-05-28 12:24:33',1779971074,'2026-05-28 12:24:34',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (13,13,'wp_posts','2026-05-28 12:43:07',1779972188,'2026-05-28 12:43:08',0,'1970-01-01 00:00:00','1');
INSERT INTO `wpftsi_index` VALUES (14,14,'wp_posts','2026-05-28 12:43:48',1779972230,'2026-05-28 12:43:50',0,'1970-01-01 00:00:00','1');
/*!40000 ALTER TABLE `wpftsi_index` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_irules`
--

DROP TABLE IF EXISTS `wpftsi_irules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_irules` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ident` varchar(130) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `filter_hash` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `act_hash` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `rule_snap` longtext COLLATE utf8mb4_unicode_520_ci,
  `clone_id` int NOT NULL DEFAULT '0',
  `filter_sql` longtext COLLATE utf8mb4_unicode_520_ci,
  `is_valid` int NOT NULL DEFAULT '0',
  `error_msg` longtext COLLATE utf8mb4_unicode_520_ci,
  `ord` int NOT NULL DEFAULT '0',
  `type` int NOT NULL DEFAULT '0',
  `insert_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ident_acthash` (`ident`,`act_hash`),
  KEY `ident` (`ident`),
  KEY `filter_hash` (`filter_hash`),
  KEY `act_hash` (`act_hash`),
  KEY `clone_id` (`clone_id`),
  KEY `is_valid` (`is_valid`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_irules`
--

LOCK TABLES `wpftsi_irules` WRITE;
/*!40000 ALTER TABLE `wpftsi_irules` DISABLE KEYS */;
INSERT INTO `wpftsi_irules` VALUES (1,'wpfts_core/settings','02940ef634fbb3559ab6ba5002f94270ea5cff1c','d584af62c7152d90905393915b2a87a327d0a9e3','{\"filter\":{\"0\":\"AND\",\"post_type__not_in\":[\"revision\",\"inherit\"],\"post_status__not_in\":[\"auto-draft\",\"draft\",\"trash\"]},\"actions\":[{\"src\":\"post_title\",\"filters\":[],\"dest\":\"post_title\"},{\"src\":\"post_content\",\"filters\":[{\"ident\":\"content_open_shortcodes\",\"opts\":[]},{\"ident\":\"content_is_remove_nodes\",\"opts\":{\"node\":[\"script\",\"style\"]}},{\"ident\":\"content_strip_tags\",\"opts\":[]}],\"dest\":\"post_content\"},{\"src\":\"post_excerpt\",\"dest\":\"post_excerpt\"}],\"short\":{\"post_title\":[\"post_title\"],\"post_content\":[\"post_excerpt\",\"post_content\"]},\"ident\":\"wpfts_core\\/settings\",\"name\":\"Native Search Simulation\",\"description\":\"This is the default WPFTS rule to mimic WordPress\' native search behavior. You can change it using the Default \\u0022Indexing Defaults\\u0022 tab.\",\"ver\":\"1.0\",\"defined_by\":\"WPFTS Core\",\"ord\":-10000}',0,'(p.`post_type` not in (\"revision\",\"inherit\")) and (p.`post_status` not in (\"auto-draft\",\"draft\",\"trash\"))',1,'',100,0,'2026-05-28 12:07:15');
/*!40000 ALTER TABLE `wpftsi_irules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_map`
--

DROP TABLE IF EXISTS `wpftsi_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_map` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint unsigned NOT NULL DEFAULT '0',
  `obj_id` bigint unsigned NOT NULL DEFAULT '0',
  `obj_type` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id` (`post_id`),
  UNIQUE KEY `obj_id` (`obj_id`,`obj_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_map`
--

LOCK TABLES `wpftsi_map` WRITE;
/*!40000 ALTER TABLE `wpftsi_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `wpftsi_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_qlog`
--

DROP TABLE IF EXISTS `wpftsi_qlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_qlog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `query` longtext COLLATE utf8mb4_unicode_520_ci,
  `query_type` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `preset` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `widget_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `n_results` int NOT NULL DEFAULT '0',
  `q_time` float(10,6) NOT NULL DEFAULT '0.000000',
  `max_ram` bigint NOT NULL DEFAULT '0',
  `user_id` bigint NOT NULL DEFAULT '0',
  `req_ip` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `ref_url` text COLLATE utf8mb4_unicode_520_ci,
  `insert_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `wpq_params` longtext COLLATE utf8mb4_unicode_520_ci,
  `ext` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`id`),
  KEY `query_type` (`query_type`),
  KEY `preset` (`preset`),
  KEY `widget_name` (`widget_name`),
  KEY `req_ip` (`req_ip`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_qlog`
--

LOCK TABLES `wpftsi_qlog` WRITE;
/*!40000 ALTER TABLE `wpftsi_qlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `wpftsi_qlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_queue`
--

DROP TABLE IF EXISTS `wpftsi_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_queue` (
  `id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `insert_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_queue`
--

LOCK TABLES `wpftsi_queue` WRITE;
/*!40000 ALTER TABLE `wpftsi_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `wpftsi_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_rawcache`
--

DROP TABLE IF EXISTS `wpftsi_rawcache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_rawcache` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `object_id` bigint NOT NULL DEFAULT '0',
  `object_type` varchar(150) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `cached_dt` datetime DEFAULT NULL,
  `insert_dt` datetime DEFAULT NULL,
  `method_id` varchar(150) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `data` longtext COLLATE utf8mb4_unicode_520_ci,
  `error` text COLLATE utf8mb4_unicode_520_ci,
  `filename` text COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `object_id_and_type` (`object_id`,`object_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_rawcache`
--

LOCK TABLES `wpftsi_rawcache` WRITE;
/*!40000 ALTER TABLE `wpftsi_rawcache` DISABLE KEYS */;
/*!40000 ALTER TABLE `wpftsi_rawcache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_stops`
--

DROP TABLE IF EXISTS `wpftsi_stops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_stops` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`(190))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_stops`
--

LOCK TABLES `wpftsi_stops` WRITE;
/*!40000 ALTER TABLE `wpftsi_stops` DISABLE KEYS */;
/*!40000 ALTER TABLE `wpftsi_stops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_tp`
--

DROP TABLE IF EXISTS `wpftsi_tp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_tp` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `q_id` int NOT NULL DEFAULT '0',
  `did` int NOT NULL DEFAULT '0',
  `pow` int NOT NULL DEFAULT '0',
  `res` float(10,6) NOT NULL DEFAULT '0.000000',
  `ts` timestamp NOT NULL DEFAULT '1970-01-01 18:30:00',
  PRIMARY KEY (`id`),
  KEY `did` (`did`),
  KEY `q_id` (`q_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_tp`
--

LOCK TABLES `wpftsi_tp` WRITE;
/*!40000 ALTER TABLE `wpftsi_tp` DISABLE KEYS */;
/*!40000 ALTER TABLE `wpftsi_tp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_tw`
--

DROP TABLE IF EXISTS `wpftsi_tw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_tw` (
  `id` int NOT NULL AUTO_INCREMENT,
  `w` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `did` int NOT NULL DEFAULT '0',
  `wn` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `w` (`w`(190))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_tw`
--

LOCK TABLES `wpftsi_tw` WRITE;
/*!40000 ALTER TABLE `wpftsi_tw` DISABLE KEYS */;
/*!40000 ALTER TABLE `wpftsi_tw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_vc`
--

DROP TABLE IF EXISTS `wpftsi_vc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_vc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `wid` int NOT NULL DEFAULT '0',
  `upd_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `vc` longblob,
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_vc`
--

LOCK TABLES `wpftsi_vc` WRITE;
/*!40000 ALTER TABLE `wpftsi_vc` DISABLE KEYS */;
/*!40000 ALTER TABLE `wpftsi_vc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_vectors`
--

DROP TABLE IF EXISTS `wpftsi_vectors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_vectors` (
  `wid` int NOT NULL,
  `did` int NOT NULL,
  `wn` int NOT NULL DEFAULT '0',
  UNIQUE KEY `did_wn` (`did`,`wn`),
  KEY `wid` (`wid`),
  KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_vectors`
--

LOCK TABLES `wpftsi_vectors` WRITE;
/*!40000 ALTER TABLE `wpftsi_vectors` DISABLE KEYS */;
INSERT INTO `wpftsi_vectors` VALUES (1,1,1);
INSERT INTO `wpftsi_vectors` VALUES (1,5,26);
INSERT INTO `wpftsi_vectors` VALUES (2,4,1);
INSERT INTO `wpftsi_vectors` VALUES (3,4,2);
INSERT INTO `wpftsi_vectors` VALUES (3,5,5);
INSERT INTO `wpftsi_vectors` VALUES (3,5,36);
INSERT INTO `wpftsi_vectors` VALUES (3,5,147);
INSERT INTO `wpftsi_vectors` VALUES (4,5,1);
INSERT INTO `wpftsi_vectors` VALUES (4,5,49);
INSERT INTO `wpftsi_vectors` VALUES (4,5,63);
INSERT INTO `wpftsi_vectors` VALUES (4,5,92);
INSERT INTO `wpftsi_vectors` VALUES (4,5,146);
INSERT INTO `wpftsi_vectors` VALUES (4,8,4);
INSERT INTO `wpftsi_vectors` VALUES (5,5,2);
INSERT INTO `wpftsi_vectors` VALUES (5,5,64);
INSERT INTO `wpftsi_vectors` VALUES (5,8,5);
INSERT INTO `wpftsi_vectors` VALUES (6,5,3);
INSERT INTO `wpftsi_vectors` VALUES (6,5,34);
INSERT INTO `wpftsi_vectors` VALUES (7,5,4);
INSERT INTO `wpftsi_vectors` VALUES (8,5,6);
INSERT INTO `wpftsi_vectors` VALUES (9,5,7);
INSERT INTO `wpftsi_vectors` VALUES (10,5,8);
INSERT INTO `wpftsi_vectors` VALUES (11,5,9);
INSERT INTO `wpftsi_vectors` VALUES (11,5,53);
INSERT INTO `wpftsi_vectors` VALUES (11,5,73);
INSERT INTO `wpftsi_vectors` VALUES (11,5,134);
INSERT INTO `wpftsi_vectors` VALUES (11,18,2);
INSERT INTO `wpftsi_vectors` VALUES (12,5,10);
INSERT INTO `wpftsi_vectors` VALUES (13,5,11);
INSERT INTO `wpftsi_vectors` VALUES (13,8,8);
INSERT INTO `wpftsi_vectors` VALUES (14,5,12);
INSERT INTO `wpftsi_vectors` VALUES (15,5,13);
INSERT INTO `wpftsi_vectors` VALUES (15,5,44);
INSERT INTO `wpftsi_vectors` VALUES (15,8,12);
INSERT INTO `wpftsi_vectors` VALUES (16,5,14);
INSERT INTO `wpftsi_vectors` VALUES (16,5,20);
INSERT INTO `wpftsi_vectors` VALUES (17,5,15);
INSERT INTO `wpftsi_vectors` VALUES (18,5,16);
INSERT INTO `wpftsi_vectors` VALUES (18,5,23);
INSERT INTO `wpftsi_vectors` VALUES (18,5,27);
INSERT INTO `wpftsi_vectors` VALUES (18,5,69);
INSERT INTO `wpftsi_vectors` VALUES (18,5,86);
INSERT INTO `wpftsi_vectors` VALUES (18,5,99);
INSERT INTO `wpftsi_vectors` VALUES (18,5,113);
INSERT INTO `wpftsi_vectors` VALUES (19,5,17);
INSERT INTO `wpftsi_vectors` VALUES (20,5,18);
INSERT INTO `wpftsi_vectors` VALUES (21,5,19);
INSERT INTO `wpftsi_vectors` VALUES (21,5,62);
INSERT INTO `wpftsi_vectors` VALUES (21,5,78);
INSERT INTO `wpftsi_vectors` VALUES (21,5,83);
INSERT INTO `wpftsi_vectors` VALUES (21,5,101);
INSERT INTO `wpftsi_vectors` VALUES (21,5,122);
INSERT INTO `wpftsi_vectors` VALUES (21,5,148);
INSERT INTO `wpftsi_vectors` VALUES (22,5,21);
INSERT INTO `wpftsi_vectors` VALUES (23,5,22);
INSERT INTO `wpftsi_vectors` VALUES (24,5,24);
INSERT INTO `wpftsi_vectors` VALUES (24,5,142);
INSERT INTO `wpftsi_vectors` VALUES (24,5,153);
INSERT INTO `wpftsi_vectors` VALUES (24,8,6);
INSERT INTO `wpftsi_vectors` VALUES (25,5,25);
INSERT INTO `wpftsi_vectors` VALUES (25,5,42);
INSERT INTO `wpftsi_vectors` VALUES (26,5,28);
INSERT INTO `wpftsi_vectors` VALUES (26,5,30);
INSERT INTO `wpftsi_vectors` VALUES (27,5,29);
INSERT INTO `wpftsi_vectors` VALUES (28,5,31);
INSERT INTO `wpftsi_vectors` VALUES (28,5,121);
INSERT INTO `wpftsi_vectors` VALUES (29,5,32);
INSERT INTO `wpftsi_vectors` VALUES (29,8,14);
INSERT INTO `wpftsi_vectors` VALUES (30,5,33);
INSERT INTO `wpftsi_vectors` VALUES (31,5,35);
INSERT INTO `wpftsi_vectors` VALUES (32,5,37);
INSERT INTO `wpftsi_vectors` VALUES (33,5,38);
INSERT INTO `wpftsi_vectors` VALUES (34,5,39);
INSERT INTO `wpftsi_vectors` VALUES (35,5,40);
INSERT INTO `wpftsi_vectors` VALUES (35,5,107);
INSERT INTO `wpftsi_vectors` VALUES (35,5,141);
INSERT INTO `wpftsi_vectors` VALUES (35,5,144);
INSERT INTO `wpftsi_vectors` VALUES (35,8,2);
INSERT INTO `wpftsi_vectors` VALUES (36,5,41);
INSERT INTO `wpftsi_vectors` VALUES (37,5,43);
INSERT INTO `wpftsi_vectors` VALUES (38,5,45);
INSERT INTO `wpftsi_vectors` VALUES (39,5,46);
INSERT INTO `wpftsi_vectors` VALUES (40,5,47);
INSERT INTO `wpftsi_vectors` VALUES (40,5,90);
INSERT INTO `wpftsi_vectors` VALUES (41,5,48);
INSERT INTO `wpftsi_vectors` VALUES (41,5,80);
INSERT INTO `wpftsi_vectors` VALUES (41,5,91);
INSERT INTO `wpftsi_vectors` VALUES (42,5,50);
INSERT INTO `wpftsi_vectors` VALUES (43,5,51);
INSERT INTO `wpftsi_vectors` VALUES (44,5,52);
INSERT INTO `wpftsi_vectors` VALUES (45,5,54);
INSERT INTO `wpftsi_vectors` VALUES (46,5,55);
INSERT INTO `wpftsi_vectors` VALUES (47,5,56);
INSERT INTO `wpftsi_vectors` VALUES (47,5,60);
INSERT INTO `wpftsi_vectors` VALUES (48,5,57);
INSERT INTO `wpftsi_vectors` VALUES (49,5,58);
INSERT INTO `wpftsi_vectors` VALUES (50,5,59);
INSERT INTO `wpftsi_vectors` VALUES (51,5,61);
INSERT INTO `wpftsi_vectors` VALUES (52,5,65);
INSERT INTO `wpftsi_vectors` VALUES (53,5,66);
INSERT INTO `wpftsi_vectors` VALUES (54,5,67);
INSERT INTO `wpftsi_vectors` VALUES (54,5,79);
INSERT INTO `wpftsi_vectors` VALUES (55,5,68);
INSERT INTO `wpftsi_vectors` VALUES (56,5,70);
INSERT INTO `wpftsi_vectors` VALUES (57,5,71);
INSERT INTO `wpftsi_vectors` VALUES (58,5,72);
INSERT INTO `wpftsi_vectors` VALUES (58,5,155);
INSERT INTO `wpftsi_vectors` VALUES (59,5,74);
INSERT INTO `wpftsi_vectors` VALUES (60,5,75);
INSERT INTO `wpftsi_vectors` VALUES (61,5,76);
INSERT INTO `wpftsi_vectors` VALUES (62,5,77);
INSERT INTO `wpftsi_vectors` VALUES (63,5,81);
INSERT INTO `wpftsi_vectors` VALUES (64,5,82);
INSERT INTO `wpftsi_vectors` VALUES (65,5,84);
INSERT INTO `wpftsi_vectors` VALUES (66,5,85);
INSERT INTO `wpftsi_vectors` VALUES (67,5,87);
INSERT INTO `wpftsi_vectors` VALUES (67,5,93);
INSERT INTO `wpftsi_vectors` VALUES (67,5,108);
INSERT INTO `wpftsi_vectors` VALUES (67,5,130);
INSERT INTO `wpftsi_vectors` VALUES (67,15,2);
INSERT INTO `wpftsi_vectors` VALUES (68,5,88);
INSERT INTO `wpftsi_vectors` VALUES (69,5,89);
INSERT INTO `wpftsi_vectors` VALUES (69,8,10);
INSERT INTO `wpftsi_vectors` VALUES (70,5,94);
INSERT INTO `wpftsi_vectors` VALUES (70,5,116);
INSERT INTO `wpftsi_vectors` VALUES (71,5,95);
INSERT INTO `wpftsi_vectors` VALUES (72,5,96);
INSERT INTO `wpftsi_vectors` VALUES (73,5,97);
INSERT INTO `wpftsi_vectors` VALUES (74,5,98);
INSERT INTO `wpftsi_vectors` VALUES (75,5,100);
INSERT INTO `wpftsi_vectors` VALUES (76,5,102);
INSERT INTO `wpftsi_vectors` VALUES (77,5,103);
INSERT INTO `wpftsi_vectors` VALUES (78,5,104);
INSERT INTO `wpftsi_vectors` VALUES (79,5,105);
INSERT INTO `wpftsi_vectors` VALUES (80,5,106);
INSERT INTO `wpftsi_vectors` VALUES (81,5,109);
INSERT INTO `wpftsi_vectors` VALUES (82,5,110);
INSERT INTO `wpftsi_vectors` VALUES (83,5,111);
INSERT INTO `wpftsi_vectors` VALUES (84,5,112);
INSERT INTO `wpftsi_vectors` VALUES (85,5,114);
INSERT INTO `wpftsi_vectors` VALUES (85,5,131);
INSERT INTO `wpftsi_vectors` VALUES (86,5,115);
INSERT INTO `wpftsi_vectors` VALUES (87,5,117);
INSERT INTO `wpftsi_vectors` VALUES (88,5,118);
INSERT INTO `wpftsi_vectors` VALUES (89,5,119);
INSERT INTO `wpftsi_vectors` VALUES (90,5,120);
INSERT INTO `wpftsi_vectors` VALUES (91,5,123);
INSERT INTO `wpftsi_vectors` VALUES (92,5,124);
INSERT INTO `wpftsi_vectors` VALUES (93,5,125);
INSERT INTO `wpftsi_vectors` VALUES (94,5,126);
INSERT INTO `wpftsi_vectors` VALUES (95,5,127);
INSERT INTO `wpftsi_vectors` VALUES (96,5,128);
INSERT INTO `wpftsi_vectors` VALUES (97,5,129);
INSERT INTO `wpftsi_vectors` VALUES (97,5,152);
INSERT INTO `wpftsi_vectors` VALUES (98,5,132);
INSERT INTO `wpftsi_vectors` VALUES (99,5,133);
INSERT INTO `wpftsi_vectors` VALUES (100,5,135);
INSERT INTO `wpftsi_vectors` VALUES (100,5,150);
INSERT INTO `wpftsi_vectors` VALUES (101,5,136);
INSERT INTO `wpftsi_vectors` VALUES (101,8,3);
INSERT INTO `wpftsi_vectors` VALUES (102,5,137);
INSERT INTO `wpftsi_vectors` VALUES (103,5,138);
INSERT INTO `wpftsi_vectors` VALUES (104,5,139);
INSERT INTO `wpftsi_vectors` VALUES (105,5,140);
INSERT INTO `wpftsi_vectors` VALUES (106,5,143);
INSERT INTO `wpftsi_vectors` VALUES (107,5,145);
INSERT INTO `wpftsi_vectors` VALUES (107,8,11);
INSERT INTO `wpftsi_vectors` VALUES (108,5,149);
INSERT INTO `wpftsi_vectors` VALUES (109,5,151);
INSERT INTO `wpftsi_vectors` VALUES (110,5,154);
INSERT INTO `wpftsi_vectors` VALUES (111,5,156);
INSERT INTO `wpftsi_vectors` VALUES (112,7,1);
INSERT INTO `wpftsi_vectors` VALUES (113,7,2);
INSERT INTO `wpftsi_vectors` VALUES (114,8,1);
INSERT INTO `wpftsi_vectors` VALUES (115,8,7);
INSERT INTO `wpftsi_vectors` VALUES (116,8,9);
INSERT INTO `wpftsi_vectors` VALUES (117,8,13);
INSERT INTO `wpftsi_vectors` VALUES (118,8,15);
INSERT INTO `wpftsi_vectors` VALUES (128,10,1);
INSERT INTO `wpftsi_vectors` VALUES (128,19,1);
INSERT INTO `wpftsi_vectors` VALUES (128,22,1);
INSERT INTO `wpftsi_vectors` VALUES (128,25,1);
INSERT INTO `wpftsi_vectors` VALUES (128,28,1);
INSERT INTO `wpftsi_vectors` VALUES (128,31,1);
INSERT INTO `wpftsi_vectors` VALUES (128,34,1);
INSERT INTO `wpftsi_vectors` VALUES (129,10,2);
INSERT INTO `wpftsi_vectors` VALUES (129,19,2);
INSERT INTO `wpftsi_vectors` VALUES (129,22,2);
INSERT INTO `wpftsi_vectors` VALUES (129,25,2);
INSERT INTO `wpftsi_vectors` VALUES (129,28,2);
INSERT INTO `wpftsi_vectors` VALUES (129,31,2);
INSERT INTO `wpftsi_vectors` VALUES (129,34,2);
INSERT INTO `wpftsi_vectors` VALUES (130,11,1);
INSERT INTO `wpftsi_vectors` VALUES (130,20,1);
INSERT INTO `wpftsi_vectors` VALUES (130,23,1);
INSERT INTO `wpftsi_vectors` VALUES (130,26,1);
INSERT INTO `wpftsi_vectors` VALUES (130,29,1);
INSERT INTO `wpftsi_vectors` VALUES (130,32,1);
INSERT INTO `wpftsi_vectors` VALUES (130,35,1);
INSERT INTO `wpftsi_vectors` VALUES (131,11,2);
INSERT INTO `wpftsi_vectors` VALUES (131,20,2);
INSERT INTO `wpftsi_vectors` VALUES (131,23,2);
INSERT INTO `wpftsi_vectors` VALUES (131,26,2);
INSERT INTO `wpftsi_vectors` VALUES (131,29,2);
INSERT INTO `wpftsi_vectors` VALUES (131,32,2);
INSERT INTO `wpftsi_vectors` VALUES (131,35,2);
INSERT INTO `wpftsi_vectors` VALUES (132,11,3);
INSERT INTO `wpftsi_vectors` VALUES (132,20,3);
INSERT INTO `wpftsi_vectors` VALUES (132,23,3);
INSERT INTO `wpftsi_vectors` VALUES (132,26,3);
INSERT INTO `wpftsi_vectors` VALUES (132,29,3);
INSERT INTO `wpftsi_vectors` VALUES (132,32,3);
INSERT INTO `wpftsi_vectors` VALUES (132,35,3);
INSERT INTO `wpftsi_vectors` VALUES (133,11,4);
INSERT INTO `wpftsi_vectors` VALUES (133,20,4);
INSERT INTO `wpftsi_vectors` VALUES (133,23,4);
INSERT INTO `wpftsi_vectors` VALUES (133,26,4);
INSERT INTO `wpftsi_vectors` VALUES (133,29,4);
INSERT INTO `wpftsi_vectors` VALUES (133,32,4);
INSERT INTO `wpftsi_vectors` VALUES (133,35,4);
INSERT INTO `wpftsi_vectors` VALUES (134,13,1);
INSERT INTO `wpftsi_vectors` VALUES (134,15,3);
INSERT INTO `wpftsi_vectors` VALUES (135,13,2);
INSERT INTO `wpftsi_vectors` VALUES (135,15,4);
INSERT INTO `wpftsi_vectors` VALUES (136,13,3);
INSERT INTO `wpftsi_vectors` VALUES (136,16,2);
INSERT INTO `wpftsi_vectors` VALUES (136,18,4);
INSERT INTO `wpftsi_vectors` VALUES (137,13,4);
INSERT INTO `wpftsi_vectors` VALUES (138,15,1);
INSERT INTO `wpftsi_vectors` VALUES (138,18,1);
INSERT INTO `wpftsi_vectors` VALUES (143,16,1);
INSERT INTO `wpftsi_vectors` VALUES (143,18,3);
/*!40000 ALTER TABLE `wpftsi_vectors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wpftsi_words`
--

DROP TABLE IF EXISTS `wpftsi_words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wpftsi_words` (
  `id` int NOT NULL AUTO_INCREMENT,
  `word` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `act` int NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`(190)),
  KEY `act` (`act`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wpftsi_words`
--

LOCK TABLES `wpftsi_words` WRITE;
/*!40000 ALTER TABLE `wpftsi_words` DISABLE KEYS */;
INSERT INTO `wpftsi_words` VALUES (1,'navigation',-1);
INSERT INTO `wpftsi_words` VALUES (2,'sample',-1);
INSERT INTO `wpftsi_words` VALUES (3,'page',-1);
INSERT INTO `wpftsi_words` VALUES (4,'this',-1);
INSERT INTO `wpftsi_words` VALUES (5,'is',-1);
INSERT INTO `wpftsi_words` VALUES (6,'an',-1);
INSERT INTO `wpftsi_words` VALUES (7,'example',-1);
INSERT INTO `wpftsi_words` VALUES (8,'it\'s',-1);
INSERT INTO `wpftsi_words` VALUES (9,'different',-1);
INSERT INTO `wpftsi_words` VALUES (10,'from',-1);
INSERT INTO `wpftsi_words` VALUES (11,'a',-1);
INSERT INTO `wpftsi_words` VALUES (12,'blog',-1);
INSERT INTO `wpftsi_words` VALUES (13,'post',-1);
INSERT INTO `wpftsi_words` VALUES (14,'because',-1);
INSERT INTO `wpftsi_words` VALUES (15,'it',-1);
INSERT INTO `wpftsi_words` VALUES (16,'will',-1);
INSERT INTO `wpftsi_words` VALUES (17,'stay',-1);
INSERT INTO `wpftsi_words` VALUES (18,'in',-1);
INSERT INTO `wpftsi_words` VALUES (19,'one',-1);
INSERT INTO `wpftsi_words` VALUES (20,'place',-1);
INSERT INTO `wpftsi_words` VALUES (21,'and',-1);
INSERT INTO `wpftsi_words` VALUES (22,'show',-1);
INSERT INTO `wpftsi_words` VALUES (23,'up',-1);
INSERT INTO `wpftsi_words` VALUES (24,'your',-1);
INSERT INTO `wpftsi_words` VALUES (25,'site',-1);
INSERT INTO `wpftsi_words` VALUES (26,'most',-1);
INSERT INTO `wpftsi_words` VALUES (27,'themes',-1);
INSERT INTO `wpftsi_words` VALUES (28,'people',-1);
INSERT INTO `wpftsi_words` VALUES (29,'start',-1);
INSERT INTO `wpftsi_words` VALUES (30,'with',-1);
INSERT INTO `wpftsi_words` VALUES (31,'about',-1);
INSERT INTO `wpftsi_words` VALUES (32,'that',-1);
INSERT INTO `wpftsi_words` VALUES (33,'introduces',-1);
INSERT INTO `wpftsi_words` VALUES (34,'them',-1);
INSERT INTO `wpftsi_words` VALUES (35,'to',-1);
INSERT INTO `wpftsi_words` VALUES (36,'potential',-1);
INSERT INTO `wpftsi_words` VALUES (37,'visitors',-1);
INSERT INTO `wpftsi_words` VALUES (38,'might',-1);
INSERT INTO `wpftsi_words` VALUES (39,'say',-1);
INSERT INTO `wpftsi_words` VALUES (40,'something',-1);
INSERT INTO `wpftsi_words` VALUES (41,'like',-1);
INSERT INTO `wpftsi_words` VALUES (42,'hi',-1);
INSERT INTO `wpftsi_words` VALUES (43,'there',-1);
INSERT INTO `wpftsi_words` VALUES (44,'i\'m',-1);
INSERT INTO `wpftsi_words` VALUES (45,'bike',-1);
INSERT INTO `wpftsi_words` VALUES (46,'messenger',-1);
INSERT INTO `wpftsi_words` VALUES (47,'by',-1);
INSERT INTO `wpftsi_words` VALUES (48,'day',-1);
INSERT INTO `wpftsi_words` VALUES (49,'aspiring',-1);
INSERT INTO `wpftsi_words` VALUES (50,'actor',-1);
INSERT INTO `wpftsi_words` VALUES (51,'night',-1);
INSERT INTO `wpftsi_words` VALUES (52,'my',-1);
INSERT INTO `wpftsi_words` VALUES (53,'website',-1);
INSERT INTO `wpftsi_words` VALUES (54,'i',-1);
INSERT INTO `wpftsi_words` VALUES (55,'live',-1);
INSERT INTO `wpftsi_words` VALUES (56,'los',-1);
INSERT INTO `wpftsi_words` VALUES (57,'angeles',-1);
INSERT INTO `wpftsi_words` VALUES (58,'have',-1);
INSERT INTO `wpftsi_words` VALUES (59,'great',-1);
INSERT INTO `wpftsi_words` VALUES (60,'dog',-1);
INSERT INTO `wpftsi_words` VALUES (61,'named',-1);
INSERT INTO `wpftsi_words` VALUES (62,'jack',-1);
INSERT INTO `wpftsi_words` VALUES (63,'piña',-1);
INSERT INTO `wpftsi_words` VALUES (64,'coladas',-1);
INSERT INTO `wpftsi_words` VALUES (65,'gettin',-1);
INSERT INTO `wpftsi_words` VALUES (66,'caught',-1);
INSERT INTO `wpftsi_words` VALUES (67,'the',-1);
INSERT INTO `wpftsi_words` VALUES (68,'rain',-1);
INSERT INTO `wpftsi_words` VALUES (69,'or',-1);
INSERT INTO `wpftsi_words` VALUES (70,'xyz',-1);
INSERT INTO `wpftsi_words` VALUES (71,'doohickey',-1);
INSERT INTO `wpftsi_words` VALUES (72,'company',-1);
INSERT INTO `wpftsi_words` VALUES (73,'was',-1);
INSERT INTO `wpftsi_words` VALUES (74,'founded',-1);
INSERT INTO `wpftsi_words` VALUES (75,'1971',-1);
INSERT INTO `wpftsi_words` VALUES (76,'has',-1);
INSERT INTO `wpftsi_words` VALUES (77,'been',-1);
INSERT INTO `wpftsi_words` VALUES (78,'providing',-1);
INSERT INTO `wpftsi_words` VALUES (79,'quality',-1);
INSERT INTO `wpftsi_words` VALUES (80,'doohickeys',-1);
INSERT INTO `wpftsi_words` VALUES (81,'public',-1);
INSERT INTO `wpftsi_words` VALUES (82,'ever',-1);
INSERT INTO `wpftsi_words` VALUES (83,'since',-1);
INSERT INTO `wpftsi_words` VALUES (84,'located',-1);
INSERT INTO `wpftsi_words` VALUES (85,'gotham',-1);
INSERT INTO `wpftsi_words` VALUES (86,'city',-1);
INSERT INTO `wpftsi_words` VALUES (87,'employs',-1);
INSERT INTO `wpftsi_words` VALUES (88,'over',-1);
INSERT INTO `wpftsi_words` VALUES (89,'2',-1);
INSERT INTO `wpftsi_words` VALUES (90,'000',-1);
INSERT INTO `wpftsi_words` VALUES (91,'does',-1);
INSERT INTO `wpftsi_words` VALUES (92,'all',-1);
INSERT INTO `wpftsi_words` VALUES (93,'kinds',-1);
INSERT INTO `wpftsi_words` VALUES (94,'of',-1);
INSERT INTO `wpftsi_words` VALUES (95,'awesome',-1);
INSERT INTO `wpftsi_words` VALUES (96,'things',-1);
INSERT INTO `wpftsi_words` VALUES (97,'for',-1);
INSERT INTO `wpftsi_words` VALUES (98,'community',-1);
INSERT INTO `wpftsi_words` VALUES (99,'as',-1);
INSERT INTO `wpftsi_words` VALUES (100,'new',-1);
INSERT INTO `wpftsi_words` VALUES (101,'wordpress',-1);
INSERT INTO `wpftsi_words` VALUES (102,'user',-1);
INSERT INTO `wpftsi_words` VALUES (103,'you',-1);
INSERT INTO `wpftsi_words` VALUES (104,'should',-1);
INSERT INTO `wpftsi_words` VALUES (105,'go',-1);
INSERT INTO `wpftsi_words` VALUES (106,'dashboard',-1);
INSERT INTO `wpftsi_words` VALUES (107,'delete',-1);
INSERT INTO `wpftsi_words` VALUES (108,'create',-1);
INSERT INTO `wpftsi_words` VALUES (109,'pages',-1);
INSERT INTO `wpftsi_words` VALUES (110,'content',-1);
INSERT INTO `wpftsi_words` VALUES (111,'fun',-1);
INSERT INTO `wpftsi_words` VALUES (112,'hello',-1);
INSERT INTO `wpftsi_words` VALUES (113,'world',-1);
INSERT INTO `wpftsi_words` VALUES (114,'welcome',-1);
INSERT INTO `wpftsi_words` VALUES (115,'first',-1);
INSERT INTO `wpftsi_words` VALUES (116,'edit',-1);
INSERT INTO `wpftsi_words` VALUES (117,'then',-1);
INSERT INTO `wpftsi_words` VALUES (118,'writing',-1);
INSERT INTO `wpftsi_words` VALUES (128,'custom',-1);
INSERT INTO `wpftsi_words` VALUES (129,'styles',-1);
INSERT INTO `wpftsi_words` VALUES (130,'version',-1);
INSERT INTO `wpftsi_words` VALUES (131,'3',-1);
INSERT INTO `wpftsi_words` VALUES (132,'isglobalstylesuserthemejson',-1);
INSERT INTO `wpftsi_words` VALUES (133,'true',-1);
INSERT INTO `wpftsi_words` VALUES (134,'calendar',-1);
INSERT INTO `wpftsi_words` VALUES (135,'views',-1);
INSERT INTO `wpftsi_words` VALUES (136,'event',-1);
INSERT INTO `wpftsi_words` VALUES (137,'archive',-1);
INSERT INTO `wpftsi_words` VALUES (138,'displays',-1);
INSERT INTO `wpftsi_words` VALUES (143,'single',-1);
/*!40000 ALTER TABLE `wpftsi_words` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-01 15:11:56
