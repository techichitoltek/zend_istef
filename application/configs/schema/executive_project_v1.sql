-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2016 at 04:48 PM
-- Server version: 5.5.23
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `executive_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `backoffice_users`
--

CREATE TABLE IF NOT EXISTS `backoffice_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `password_valid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `email` varchar(340) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `nb_login` int(11) NOT NULL DEFAULT '0',
  `last_password_update` timestamp NULL DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_username` (`username`),
  KEY `idx_email` (`email`(255))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `backoffice_users`
--

INSERT INTO `backoffice_users` (`id`, `firstname`, `lastname`, `username`, `password`, `password_valid`, `email`, `phone_number`, `last_login`, `nb_login`, `last_password_update`, `deleted`) VALUES
(1, 'Céline', 'Admin', 'admin', '0516f0ee51f3a2b80382904d165fff64cf3a8175', 0, 'tech@rcweb.io', '123456789', '2016-02-21 14:18:50', 2, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `backoffice_users_groups`
--

CREATE TABLE IF NOT EXISTS `backoffice_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_group_id` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `backoffice_users_groups`
--

INSERT INTO `backoffice_users_groups` (`id`, `group_id`, `user_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `frontend_users`
--

CREATE TABLE IF NOT EXISTS `frontend_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `password_valid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL,
  `nb_login` int(11) NOT NULL DEFAULT '0',
  `last_password_update` timestamp NULL DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `user_dateAdded` datetime DEFAULT NULL,
  `user_dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `frontend_users`
--

INSERT INTO `frontend_users` (`id`, `username`, `password`, `password_valid`, `last_login`, `nb_login`, `last_password_update`, `deleted`, `user_dateAdded`, `user_dateUpdated`) VALUES
(1, 'celine', 'c0ab5820b7bcf572eaecdb9c2d5b33d9b877c0bf', 1, NULL, 0, NULL, 0, '2015-06-30 00:00:00', '2015-12-26 17:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `frontend_users_groups`
--

CREATE TABLE IF NOT EXISTS `frontend_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_group_id` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `frontend_users_groups`
--

INSERT INTO `frontend_users_groups` (`id`, `group_id`, `user_id`) VALUES
(1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `frontend_users_infos`
--

CREATE TABLE IF NOT EXISTS `frontend_users_infos` (
  `userinfos_id` int(11) NOT NULL AUTO_INCREMENT,
  `userinfos_userId` int(11) DEFAULT NULL,
  `userinfos_nom` varchar(255) DEFAULT NULL,
  `userinfos_prenom` varchar(255) DEFAULT NULL,
  `userinfos_telephone` varchar(20) DEFAULT NULL,
  `userinfos_mail` varchar(100) DEFAULT NULL,
  `userinfos_active` int(11) DEFAULT '1',
  `userinfos_isDel` int(4) DEFAULT NULL,
  `userinfos_dateCgu` datetime DEFAULT NULL,
  `userinfos_dateAdded` datetime DEFAULT NULL,
  `userinfos_dateUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userinfos_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001 ;

--
-- Dumping data for table `frontend_users_infos`
--

INSERT INTO `frontend_users_infos` (`userinfos_id`, `userinfos_userId`, `userinfos_nom`, `userinfos_prenom`, `userinfos_telephone`, `userinfos_mail`, `userinfos_active`, `userinfos_isDel`, `userinfos_dateCgu`, `userinfos_dateAdded`, `userinfos_dateUpdated`) VALUES
(999, 1, 'ROUX', 'celine', NULL, 'tech@rcweb.io', 1, NULL, NULL, '2015-06-30 00:00:00', '2015-12-26 17:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_backup`
--

CREATE TABLE IF NOT EXISTS `ztdf_backup` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_type` varchar(255) NOT NULL,
  `backup_path` varchar(255) NOT NULL,
  `backup_size` int(11) NOT NULL DEFAULT '0',
  `backup_state` varchar(255) DEFAULT NULL,
  `backup_error` int(11) NOT NULL DEFAULT '0',
  `backup_dateAdded` datetime DEFAULT NULL,
  `backup_dateUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`backup_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Table des backups' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_db_schema`
--

CREATE TABLE IF NOT EXISTS `ztdf_db_schema` (
  `rev_schema` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ztdf_db_schema`
--

INSERT INTO `ztdf_db_schema` (`rev_schema`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_emails`
--

CREATE TABLE IF NOT EXISTS `ztdf_emails` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_module` varchar(255) NOT NULL,
  `email_name` varchar(255) NOT NULL,
  `email_layout` varchar(255) DEFAULT NULL,
  `email_template` varchar(255) NOT NULL,
  `email_vars` text NOT NULL,
  `email_fromName` varchar(255) DEFAULT NULL,
  `email_fromMail` varchar(255) DEFAULT NULL,
  `email_replyToName` varchar(255) DEFAULT NULL,
  `email_replyToMail` varchar(255) DEFAULT NULL,
  `email_ccMail` varchar(255) DEFAULT NULL,
  `email_bccMail` varchar(255) DEFAULT NULL,
  `email_dateAdded` datetime DEFAULT NULL,
  `email_dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `email_name` (`email_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Table des templates d''emails' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ztdf_emails`
--

INSERT INTO `ztdf_emails` (`email_id`, `email_module`, `email_name`, `email_layout`, `email_template`, `email_vars`, `email_fromName`, `email_fromMail`, `email_replyToName`, `email_replyToMail`, `email_ccMail`, `email_bccMail`, `email_dateAdded`, `email_dateUpdated`) VALUES
(1, 'backoffice', 'BACKOFFICE.TEST', 'test', 'test', 'array("name"=>"John doe","email_adresse"=>"john.doe@td-system.com")', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-19 00:00:00', '2013-08-24 18:54:17'),
(2, 'app', 'FRAMEWORK.NOTIFICATION', NULL, 'notification', 'array()', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-19 00:00:00', '2013-08-23 08:54:08'),
(3, 'app', 'FRAMEWORK.QUICK_NOTIFICATION', NULL, 'quick-notification', 'array()', NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-19 00:00:00', '2014-09-20 17:31:05'),
(5, 'frontend', 'FRONTEND.ALERTE.COMMON', NULL, 'alerte-mail-common', 'array()', NULL, NULL, NULL, NULL, NULL, NULL, '2015-12-26 00:00:00', '2015-12-26 16:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_emails_log`
--

CREATE TABLE IF NOT EXISTS `ztdf_emails_log` (
  `emailLog_id` int(11) NOT NULL AUTO_INCREMENT,
  `emailLog_name` varchar(255) NOT NULL,
  `emailLog_templateName` varchar(255) NOT NULL,
  `emailLog_to` text NOT NULL,
  `emailLog_cc` text NOT NULL,
  `emailLog_bcc` text NOT NULL,
  `emailLog_subject` varchar(255) NOT NULL,
  `emailLog_bodyHtml` text NOT NULL,
  `emailLog_from` varchar(255) NOT NULL,
  `emailLog_replyTo` varchar(255) NOT NULL,
  `emailLog_sent` int(1) NOT NULL DEFAULT '0',
  `emailLog_log` text,
  `emailLog_dateAdded` datetime NOT NULL,
  `emailLog_dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`emailLog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Table des logs des mails' AUTO_INCREMENT=191 ;

--
-- Dumping data for table `ztdf_emails_log`
--

INSERT INTO `ztdf_emails_log` (`emailLog_id`, `emailLog_name`, `emailLog_templateName`, `emailLog_to`, `emailLog_cc`, `emailLog_bcc`, `emailLog_subject`, `emailLog_bodyHtml`, `emailLog_from`, `emailLog_replyTo`, `emailLog_sent`, `emailLog_log`, `emailLog_dateAdded`, `emailLog_dateUpdated`) VALUES
(190, 'FRAMEWORK.NOTIFICATION', 'notification', 'tech@rcweb.io;', '', '', '[development] => Erreur sur http://executiveproject', '<html>\n<head>\n<style>\nbody {\n  font-family: Verdana, sans-serif;\n  font-size: 0.8em;\n  color:#484848;\n}\nh1, h2, h3 { font-family: "Trebuchet MS", Verdana, sans-serif; margin: 0px; }\nh1 { font-size: 1.2em; }\nh2, h3 { font-size: 1.1em; }\na, a:link, a:visited { color: #2A5685;}\na:hover, a:active { color: #c61a1a; }\na.wiki-anchor { display: none; }\nhr {\n  width: 100%;\n  height: 1px;\n  background: #ccc;\n  border: 0;\n}\n.footer {\n  font-size: 0.8em;\n  font-style: italic;\n}\n</style>\n</head>\n<body>\n<span class="header"></span>\n\nErreur sur : http://executiveproject<br/>\n<br/>\nServer IP: 127.0.0.1<br><br>Identity : <pre>object(stdClass)#149 (2) {\n  [&quot;username&quot;] =&gt; string(10) &quot;Not Authed&quot;\n  [&quot;group&quot;] =&gt; object(stdClass)#180 (1) {\n    [&quot;name&quot;] =&gt; string(6) &quot;guests&quot;\n  }\n}\n</pre><br><br>User agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36<br><br>User IP: 127.0.0.1<br>Bot ?: Non<br>Referer: http://executiveproject/user-accueil<br><br>Server time: 2016-02-21 15:12:43<br><br>RequestURI: /images/favicon.png<br><br>Referer: http://executiveproject/user-accueil<br><br>Message: Invalid controller specified (images)<br><br>Trace:\n<pre>string(530) &quot;#0 D:\\htdocs\\executiveproject\\branches\\mexico\\library\\Zend\\Controller\\Front.php(954): Zend_Controller_Dispatcher_Standard-&gt;dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))\n#1 D:\\htdocs\\executiveproject\\branches\\mexico\\application\\Bootstrap.php(544): Zend_Controller_Front-&gt;dispatch()\n#2 D:\\htdocs\\executiveproject\\branches\\mexico\\public\\index.base.php(35): Bootstrap-&gt;runApp()\n#3 D:\\htdocs\\executiveproject\\branches\\mexico\\public\\frontend\\index.php(14): require(&#039;D:\\htdocs\\execu...&#039;)\n#4 {main}&quot;\n</pre><br><br>Request data: array (\n  ''controller'' => ''images'',\n  ''action'' => ''favicon.png'',\n  ''module'' => ''frontend'',\n)<br><br>Session data:<br><br><br><br>Last database query: SELECT `ztdf_db_schema`.* FROM `ztdf_db_schema`<br>Last database query params: array (\n)<br><br>Last database query: DESCRIBE `ztdf_emails`<br>Last database query params: array (\n)<br><br>Last database query: SELECT `ztdf_emails`.* FROM `ztdf_emails` WHERE (email_name = ''FRAMEWORK.NOTIFICATION'') LIMIT 1<br>Last database query params: array (\n)<br><br>\n<span class="footer"></span>\n</body>\n</html>', 'tech@rcweb.io', '', 0, 'SMTP connect() failed.', '2016-02-21 15:12:44', '2016-02-21 14:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_flags`
--

CREATE TABLE IF NOT EXISTS `ztdf_flags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active_on_dev` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `active_on_prod` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `ztdf_flags`
--

INSERT INTO `ztdf_flags` (`id`, `name`, `description`, `active_on_dev`, `active_on_prod`) VALUES
(1, 'backoffice-backup', 'System de backup', 1, 1),
(2, 'backoffice-benchmark', 'System de benchmark', 1, 1),
(3, 'backoffice-dashboard', 'Default entry point in the dashboard', 1, 1),
(4, 'backoffice-flags', 'Allows user to manage the flags', 1, 1),
(5, 'backoffice-generate', 'Outils de génération de models', 1, 1),
(6, 'backoffice-groups', 'Allows user to manage the user groups', 1, 1),
(7, 'backoffice-index', 'Default entry point in the application', 1, 1),
(8, 'backoffice-mails', 'Gestion du paramétrage des mails', 1, 1),
(9, 'backoffice-params', 'Gestion du paramétrage', 1, 1),
(10, 'backoffice-portails', 'Gestion des portails', 1, 1),
(11, 'backoffice-portailurl', 'Gestion des url portails', 1, 1),
(12, 'backoffice-privileges', 'Allows the users to perform CRUD operations on privileges', 1, 1),
(13, 'backoffice-profile', 'Allows user to manage their profile data', 1, 1),
(14, 'backoffice-system', 'Allow the admins to manage critical info, users, groups, permissions, etc.', 1, 1),
(15, 'backoffice-tools', 'Outils divers', 1, 1),
(16, 'backoffice-users', 'Allows the users to perform CRUD operations on other users', 1, 1),
(17, 'frontend-index', 'Default entry point in the application', 1, 1),
(18, 'frontend-profile', 'Default entry point in the application', 1, 1),
(19, 'frontend-user', 'Default entry point in the application', 1, 1),
(20, 'frontend-test', 'Default entry point in the application', 1, 1),
(21, 'frontend-memo', 'Default entry point in the application', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_flippers`
--

CREATE TABLE IF NOT EXISTS `ztdf_flippers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,
  `flag_id` int(11) unsigned NOT NULL,
  `privilege_id` int(11) unsigned NOT NULL,
  `allow` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=392 ;

--
-- Dumping data for table `ztdf_flippers`
--

INSERT INTO `ztdf_flippers` (`id`, `group_id`, `flag_id`, `privilege_id`, `allow`) VALUES
(3, 4, 1, 1, 1),
(4, 4, 1, 2, 1),
(5, 4, 1, 3, 1),
(6, 4, 2, 4, 1),
(7, 4, 2, 5, 1),
(8, 4, 2, 6, 1),
(9, 4, 2, 7, 1),
(10, 4, 3, 8, 1),
(11, 4, 4, 9, 1),
(12, 4, 4, 10, 1),
(13, 4, 4, 11, 1),
(14, 4, 4, 12, 1),
(15, 4, 5, 13, 1),
(16, 4, 5, 14, 1),
(17, 4, 6, 15, 1),
(18, 4, 6, 16, 1),
(19, 4, 6, 17, 1),
(20, 4, 6, 18, 1),
(21, 4, 6, 19, 1),
(22, 4, 7, 20, 1),
(23, 4, 8, 21, 1),
(24, 4, 8, 22, 1),
(25, 4, 9, 23, 1),
(26, 4, 9, 24, 1),
(27, 4, 9, 25, 1),
(28, 4, 9, 26, 1),
(29, 4, 10, 27, 1),
(30, 4, 11, 28, 1),
(31, 4, 12, 29, 1),
(32, 4, 12, 30, 1),
(33, 4, 12, 31, 1),
(34, 4, 12, 32, 1),
(35, 4, 13, 33, 1),
(36, 4, 13, 34, 1),
(37, 4, 13, 35, 1),
(38, 4, 13, 37, 1),
(39, 4, 14, 38, 1),
(40, 4, 14, 39, 1),
(41, 4, 14, 40, 1),
(42, 4, 14, 41, 1),
(43, 4, 15, 42, 1),
(44, 4, 15, 43, 1),
(45, 4, 15, 44, 1),
(46, 4, 16, 45, 1),
(47, 4, 16, 46, 1),
(48, 4, 16, 47, 1),
(49, 4, 16, 48, 1),
(50, 4, 16, 49, 1),
(391, 2, 19, 93, 1),
(390, 2, 19, 57, 1),
(389, 2, 20, 90, 1),
(388, 2, 20, 68, 1),
(387, 2, 20, 66, 1),
(66, 3, 18, 54, 1),
(67, 5, 17, 50, 1),
(68, 5, 17, 51, 1),
(69, 5, 18, 52, 1),
(386, 2, 20, 62, 1),
(385, 2, 20, 61, 1),
(384, 2, 20, 60, 1),
(383, 2, 20, 59, 1),
(382, 2, 18, 53, 1),
(381, 2, 21, 91, 1),
(380, 2, 21, 89, 1),
(379, 2, 21, 88, 1),
(378, 2, 21, 67, 1),
(377, 2, 21, 65, 1),
(376, 2, 21, 64, 1),
(375, 2, 17, 51, 1),
(374, 2, 17, 50, 1),
(373, 2, 15, 43, 1),
(372, 2, 13, 36, 1),
(371, 2, 9, 25, 1),
(370, 2, 1, 3, 1),
(369, 2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_groups`
--

CREATE TABLE IF NOT EXISTS `ztdf_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `idx_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ztdf_groups`
--

INSERT INTO `ztdf_groups` (`id`, `name`, `parent_id`) VALUES
(1, 'god', 0),
(2, 'guests', 0),
(3, 'members', 0),
(4, 'backoffice_admin', 3),
(5, 'frontend_members', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_logperf`
--

CREATE TABLE IF NOT EXISTS `ztdf_logperf` (
  `logperf_id` int(11) NOT NULL AUTO_INCREMENT,
  `logperf_ip` varchar(25) NOT NULL,
  `logperf_user_agent` varchar(255) NOT NULL,
  `logperf_url` varchar(255) NOT NULL,
  `logperf_module` varchar(50) NOT NULL,
  `logperf_controller` varchar(50) NOT NULL,
  `logperf_action` varchar(50) NOT NULL,
  `logperf_get` text NOT NULL,
  `logperf_post` text NOT NULL,
  `logperf_temps` decimal(11,7) DEFAULT NULL,
  `logperf_decalage` decimal(11,7) DEFAULT NULL,
  `logperf_tempsTotal` decimal(11,7) DEFAULT NULL,
  `logperf_profiler` text NOT NULL,
  `logperf_isbot` int(1) NOT NULL,
  `logperf_httpReferrer` varchar(255) NOT NULL,
  `logperf_dateAdded` datetime DEFAULT NULL,
  `logperf_dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`logperf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_online`
--

CREATE TABLE IF NOT EXISTS `ztdf_online` (
  `online_id` int(11) NOT NULL AUTO_INCREMENT,
  `online_session` varchar(255) DEFAULT NULL,
  `online_ip` varchar(15) NOT NULL,
  `online_timeGeneration` decimal(11,7) DEFAULT NULL,
  `online_timeGenerationTotal` decimal(11,7) DEFAULT NULL,
  `online_userAgent` varchar(255) NOT NULL,
  `online_isBot` int(1) NOT NULL DEFAULT '0',
  `online_time` int(11) NOT NULL,
  `online_portailUrl` varchar(255) DEFAULT NULL,
  `online_url` varchar(255) NOT NULL,
  `online_referrer` varchar(255) DEFAULT NULL,
  `online_dateAdded` datetime DEFAULT NULL,
  `online_dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`online_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=138 ;

--
-- Dumping data for table `ztdf_online`
--

INSERT INTO `ztdf_online` (`online_id`, `online_session`, `online_ip`, `online_timeGeneration`, `online_timeGenerationTotal`, `online_userAgent`, `online_isBot`, `online_time`, `online_portailUrl`, `online_url`, `online_referrer`, `online_dateAdded`, `online_dateUpdated`) VALUES
(135, 'tjt83cs6f5c00hoqv6adodd3u2', '127.0.0.1', '146.9409466', '910.8190536', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', 0, 1456065309, 'executiveproject', '/user-addaccount', 'http://executiveproject/user-accueil', '2016-02-21 15:12:42', '2016-02-21 14:35:09'),
(136, '9iga4n9ogthq7ovijs8gao4nh3', '127.0.0.1', '201.6179562', '728.0321121', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', 0, 1456064277, 'executiveproject-back', '/profile/login/', 'http://executiveproject-back/profile/login/', '2016-02-21 15:15:30', '2016-02-21 14:17:57'),
(137, 'aalsqbnqtoe9ss4vsntaigagg5', '127.0.0.1', '192.5392151', '778.0530453', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', 0, 1456065293, 'executiveproject-back', '/groups/', 'http://executiveproject-back/groups/flippers?id=2', '2016-02-21 15:18:51', '2016-02-21 14:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_paramcustom`
--

CREATE TABLE IF NOT EXISTS `ztdf_paramcustom` (
  `paramcustom_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `paramcustom_SiteId` bigint(20) NOT NULL,
  `paramcustom_Name` varchar(35) NOT NULL,
  `paramcustom_Scope` varchar(255) NOT NULL,
  `paramcustom_Value` text NOT NULL,
  `paramcustom_LevelAccess` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`paramcustom_Id`),
  UNIQUE KEY `Secondaire` (`paramcustom_SiteId`,`paramcustom_Name`,`paramcustom_Scope`),
  KEY `tertiaire` (`paramcustom_SiteId`),
  KEY `paramcustom_LevelAccess` (`paramcustom_LevelAccess`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Table des paramétrages' AUTO_INCREMENT=224 ;

--
-- Dumping data for table `ztdf_paramcustom`
--

INSERT INTO `ztdf_paramcustom` (`paramcustom_Id`, `paramcustom_SiteId`, `paramcustom_Name`, `paramcustom_Scope`, `paramcustom_Value`, `paramcustom_LevelAccess`) VALUES
(1, 1, 'NOM.APPLI', 'FRAMEWORK', 'RCWEB', 1),
(2, 1, 'FRAMEWORK.ERROR_SHOW_DETAILS', 'FRAMEWORK', '0', 1),
(3, 1, 'MAIL.SEND_METHOD', 'FRAMEWORK', 'smtp', 1),
(4, 1, 'MAIL.SMTP_HOST', 'FRAMEWORK', 'smtp-host', 1),
(5, 1, 'MAIL.SMTP_AUTH', 'FRAMEWORK', '1', 1),
(6, 1, 'MAIL.SMTP_SECURE', 'FRAMEWORK', 'tls', 1),
(7, 1, 'MAIL.SMTP_PORT', 'FRAMEWORK', '587', 1),
(8, 1, 'MAIL.SMTP_USERNAME', 'FRAMEWORK', 'tech@rcweb.io', 1),
(9, 1, 'MAIL.SMTP_PASSWORD', 'FRAMEWORK', 'smtp-password', 1),
(10, 1, 'MAIL.ROBOT.USERNAME', 'FRAMEWORK', '', 1),
(11, 1, 'MAIL.ROBOT.FROM_USERNAME', 'FRAMEWORK', 'Robot zendskeleton112 rcweb localhost', 1),
(12, 1, 'MAIL.ROBOT.PASSWORD', 'FRAMEWORK', '', 1),
(13, 1, 'MAIL.ROBOT.FROM_EMAIL', 'FRAMEWORK', 'tech@rcweb.io', 1),
(14, 1, 'MAIL.ROBOT.DESTINATAIRE_EMAIL', 'FRAMEWORK', '', 1),
(15, 1, 'MAIL.ROBOT.DESTINATAIRE_USERNAME', 'FRAMEWORK', '', 1),
(16, 1, 'MAIL.INCIDENT_ADDRESS', 'FRAMEWORK', 'tech@rcweb.io', 1),
(17, 1, 'FRAMEWORK.LOG_PERFS', 'FRAMEWORK', '0', 1),
(18, 1, 'FRAMEWORK.DEBUG', 'FRAMEWORK', '1', 1),
(19, 1, 'FRAMEWORK.FORCE_IP_DEBUG', 'FRAMEWORK', '127.0.0.;127.0.0', 1),
(20, 1, 'FRAMEWORK.USE_CDN', 'FRAMEWORK', '0', 1),
(21, 1, 'BACKUP.PATH_DB', 'FRAMEWORK', 'D:\\htdocs\\mede_backup\\bd', 1),
(22, 1, 'BACKUP.PATH_SITE', 'FRAMEWORK', 'D:\\htdocs\\mede_backup\\files', 1),
(67, 1, 'PATH.MYSQLDUMP', 'FRAMEWORK', 'D:\\htdocs\\labo\\ressources\\win32\\mysqldump.exe', 1),
(68, 1, 'PATH.TAR', 'FRAMEWORK', 'D:\\htdocs\\labo\\ressources\\win32\\bsdtar.exe', 1),
(74, 1, 'BACKUP.EXPIRE_FILES', 'FRAMEWORK', '48', 1),
(79, 1, 'BACKUP.EXPIRE_DB', 'FRAMEWORK', '48', 1),
(82, 1, 'DB.PROFILER', 'FRAMEWORK', '0', 1),
(85, 1, 'MAIL.ROBOT.REPLY_TO_NAME', 'FRAMEWORK', '', 1),
(86, 1, 'MAIL.ROBOT.REPLY_TO_MAIL', 'FRAMEWORK', 'no-reply.tech@rcweb.io', 1),
(212, 3, 'MAIL.INCIDENT_ADDRESS', 'FRAMEWORK', 'tech@rcweb.io', 1),
(213, 3, 'FRAMEWORK.LOG_PERFS', 'FRAMEWORK', '0', 1),
(209, 3, 'MAIL.ROBOT.REPLY_TO_MAIL', 'FRAMEWORK', '', 1),
(210, 3, 'MAIL.ROBOT.DESTINATAIRE_EMAIL', 'FRAMEWORK', '', 1),
(211, 3, 'MAIL.ROBOT.DESTINATAIRE_USERNAME', 'FRAMEWORK', '', 1),
(208, 3, 'MAIL.ROBOT.REPLY_TO_NAME', 'FRAMEWORK', '', 1),
(207, 3, 'MAIL.ROBOT.FROM_EMAIL', 'FRAMEWORK', '', 1),
(196, 2, 'DB.PROFILER', 'FRAMEWORK', '0', 1),
(197, 3, 'NOM.APPLI', 'FRAMEWORK', 'RCWEB', 1),
(198, 3, 'FRAMEWORK.ERROR_SHOW_DETAILS', 'FRAMEWORK', '1', 1),
(199, 3, 'MAIL.SEND_METHOD', 'FRAMEWORK', 'sendmail', 1),
(200, 3, 'MAIL.SMTP_HOST', 'FRAMEWORK', 'smtp-host', 1),
(201, 3, 'MAIL.SMTP_AUTH', 'FRAMEWORK', '', 1),
(202, 3, 'MAIL.SMTP_SECURE', 'FRAMEWORK', 'tls', 1),
(203, 3, 'MAIL.SMTP_PORT', 'FRAMEWORK', '587', 1),
(204, 3, 'MAIL.SMTP_USERNAME', 'FRAMEWORK', 'tech@rcweb.io', 1),
(205, 3, 'MAIL.SMTP_PASSWORD', 'FRAMEWORK', 'smtp-password', 1),
(206, 3, 'MAIL.ROBOT.FROM_USERNAME', 'FRAMEWORK', 'Robot zendskeleton112 rcweb recette', 1),
(190, 2, 'BACKUP.PATH_DB', 'FRAMEWORK', '/home/backup/db', 1),
(191, 2, 'BACKUP.PATH_SITE', 'FRAMEWORK', '/home/backup/sites', 1),
(192, 2, 'BACKUP.EXPIRE_DB', 'FRAMEWORK', '168', 1),
(193, 2, 'BACKUP.EXPIRE_FILES', 'FRAMEWORK', '168', 1),
(194, 2, 'PATH.MYSQLDUMP', 'FRAMEWORK', 'mysqldump', 1),
(195, 2, 'PATH.TAR', 'FRAMEWORK', 'tar', 1),
(223, 3, 'DB.PROFILER', 'FRAMEWORK', '0', 1),
(222, 3, 'PATH.TAR', 'FRAMEWORK', 'tar', 1),
(221, 3, 'PATH.MYSQLDUMP', 'FRAMEWORK', 'mysqldump', 1),
(220, 3, 'BACKUP.EXPIRE_FILES', 'FRAMEWORK', '168', 1),
(219, 3, 'BACKUP.EXPIRE_DB', 'FRAMEWORK', '168', 1),
(218, 3, 'BACKUP.PATH_SITE', 'FRAMEWORK', '/home/backup/sites', 1),
(217, 3, 'BACKUP.PATH_DB', 'FRAMEWORK', '/home/backup/db', 1),
(216, 3, 'FRAMEWORK.USE_CDN', 'FRAMEWORK', '0', 1),
(185, 2, 'MAIL.INCIDENT_ADDRESS', 'FRAMEWORK', 'tech@rcweb.io', 1),
(186, 2, 'FRAMEWORK.LOG_PERFS', 'FRAMEWORK', '0', 1),
(187, 2, 'FRAMEWORK.DEBUG', 'FRAMEWORK', '0', 1),
(188, 2, 'FRAMEWORK.FORCE_IP_DEBUG', 'FRAMEWORK', '127.0.0.', 1),
(189, 2, 'FRAMEWORK.USE_CDN', 'FRAMEWORK', '0', 1),
(182, 2, 'MAIL.ROBOT.REPLY_TO_MAIL', 'FRAMEWORK', '', 1),
(183, 2, 'MAIL.ROBOT.DESTINATAIRE_EMAIL', 'FRAMEWORK', '', 1),
(184, 2, 'MAIL.ROBOT.DESTINATAIRE_USERNAME', 'FRAMEWORK', '', 1),
(215, 3, 'FRAMEWORK.FORCE_IP_DEBUG', 'FRAMEWORK', '127.0.0.', 1),
(214, 3, 'FRAMEWORK.DEBUG', 'FRAMEWORK', '0', 1),
(181, 2, 'MAIL.ROBOT.REPLY_TO_NAME', 'FRAMEWORK', '', 1),
(175, 2, 'MAIL.SMTP_SECURE', 'FRAMEWORK', 'tls', 1),
(176, 2, 'MAIL.SMTP_PORT', 'FRAMEWORK', '587', 1),
(177, 2, 'MAIL.SMTP_USERNAME', 'FRAMEWORK', 'tech@rcweb.io', 1),
(178, 2, 'MAIL.SMTP_PASSWORD', 'FRAMEWORK', 'smtp-password', 1),
(179, 2, 'MAIL.ROBOT.FROM_USERNAME', 'FRAMEWORK', 'Robot zendskeleton112 rcweb prod', 1),
(180, 2, 'MAIL.ROBOT.FROM_EMAIL', 'FRAMEWORK', '', 1),
(170, 2, 'NOM.APPLI', 'FRAMEWORK', 'RCWEB', 1),
(171, 2, 'FRAMEWORK.ERROR_SHOW_DETAILS', 'FRAMEWORK', '1', 1),
(172, 2, 'MAIL.SEND_METHOD', 'FRAMEWORK', 'sendmail', 1),
(173, 2, 'MAIL.SMTP_HOST', 'FRAMEWORK', 'smtp-host', 1),
(174, 2, 'MAIL.SMTP_AUTH', 'FRAMEWORK', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_paramdefault`
--

CREATE TABLE IF NOT EXISTS `ztdf_paramdefault` (
  `paramdefault_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `paramdefault_Name` varchar(50) NOT NULL,
  `paramdefault_Scope` varchar(20) NOT NULL DEFAULT 'ALL',
  `paramdefault_Value` text NOT NULL,
  `paramdefault_Commentaire` varchar(255) NOT NULL,
  `paramdefault_Type` int(2) NOT NULL,
  `paramdefault_LevelAccess` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`paramdefault_Id`),
  UNIQUE KEY `paramdefault_NameScope` (`paramdefault_Name`,`paramdefault_Scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Table des valeurs par défaut de paramétrage' AUTO_INCREMENT=28 ;

--
-- Dumping data for table `ztdf_paramdefault`
--

INSERT INTO `ztdf_paramdefault` (`paramdefault_Id`, `paramdefault_Name`, `paramdefault_Scope`, `paramdefault_Value`, `paramdefault_Commentaire`, `paramdefault_Type`, `paramdefault_LevelAccess`) VALUES
(1, 'NOM.APPLI', 'FRAMEWORK', 'RCWEB', 'Nom de l''application', 1, 1),
(2, 'FRAMEWORK.ERROR_SHOW_DETAILS', 'FRAMEWORK', '1', 'Affiche (1) ou non (0) le détails des erreurs / exception', 1, 1),
(3, 'MAIL.SEND_METHOD', 'FRAMEWORK', 'sendmail', 'smtp,mail,qmail,sendmail', 1, 1),
(4, 'MAIL.SMTP_HOST', 'FRAMEWORK', 'smtp-host', 'Host smtp pour le framework', 1, 1),
(5, 'MAIL.SMTP_AUTH', 'FRAMEWORK', '', 'Enable SMTP authentication', 1, 1),
(6, 'MAIL.SMTP_SECURE', 'FRAMEWORK', 'tls', 'tls,ssl,...', 1, 1),
(7, 'MAIL.SMTP_PORT', 'FRAMEWORK', '587', 'Port SMTP', 1, 1),
(8, 'MAIL.SMTP_USERNAME', 'FRAMEWORK', 'tech@rcweb.io', 'Username SMTP', 1, 1),
(9, 'MAIL.SMTP_PASSWORD', 'FRAMEWORK', 'smtp-password', 'Password SMTP', 1, 1),
(10, 'MAIL.ROBOT.FROM_USERNAME', 'FRAMEWORK', 'Robot', 'Nom expéditeur contact', 1, 1),
(11, 'MAIL.ROBOT.FROM_EMAIL', 'FRAMEWORK', '', 'Email expéditeur contact', 1, 1),
(12, 'MAIL.ROBOT.REPLY_TO_NAME', 'FRAMEWORK', '', 'Nom par défaut pour le Reply-to', 1, 1),
(13, 'MAIL.ROBOT.REPLY_TO_MAIL', 'FRAMEWORK', '', 'Mail par défaut pour le Reply-to', 1, 1),
(14, 'MAIL.ROBOT.DESTINATAIRE_EMAIL', 'FRAMEWORK', '', 'Adresse mail de destination pour le framework', 1, 1),
(15, 'MAIL.ROBOT.DESTINATAIRE_USERNAME', 'FRAMEWORK', '', 'Username de destination pour le framework', 1, 1),
(16, 'MAIL.INCIDENT_ADDRESS', 'FRAMEWORK', 'tech@rcweb.io', 'Email pour l''envoi des rapports d''erreur', 1, 1),
(17, 'FRAMEWORK.LOG_PERFS', 'FRAMEWORK', '0', 'Log des temps de génération des pages', 1, 1),
(18, 'FRAMEWORK.DEBUG', 'FRAMEWORK', '0', 'Active ou non le DEBUG', 1, 1),
(19, 'FRAMEWORK.FORCE_IP_DEBUG', 'FRAMEWORK', '127.0.0.', 'Force l''affichage du debug pour l''ip', 1, 1),
(20, 'FRAMEWORK.USE_CDN', 'FRAMEWORK', '0', 'Active ou non les CDN pour les javascripts et css', 1, 1),
(21, 'BACKUP.PATH_DB', 'FRAMEWORK', '/home/backup/db', 'Chemin du répertoire où sauvegarder les dump SQL', 1, 1),
(22, 'BACKUP.PATH_SITE', 'FRAMEWORK', '/home/backup/sites', 'Chemin du répertoire où sauvegarder le site', 1, 1),
(23, 'BACKUP.EXPIRE_DB', 'FRAMEWORK', '168', 'Temps en heures avant expiration des backup de la Bdd', 1, 1),
(24, 'BACKUP.EXPIRE_FILES', 'FRAMEWORK', '168', 'Temps en heures avant expiration des backup des fichiers', 1, 1),
(25, 'PATH.MYSQLDUMP', 'FRAMEWORK', 'mysqldump', 'Chemin vers la commande mysqldump', 1, 1),
(26, 'PATH.TAR', 'FRAMEWORK', 'tar', 'Chemin vers le binaire tar', 1, 1),
(27, 'DB.PROFILER', 'FRAMEWORK', '0', 'Active ou non le profiler pour la base de données', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_portails`
--

CREATE TABLE IF NOT EXISTS `ztdf_portails` (
  `portail_id` int(11) NOT NULL AUTO_INCREMENT,
  `portail_code` varchar(255) NOT NULL,
  `portail_libelle` varchar(255) NOT NULL,
  `portail_commentaire` varchar(255) NOT NULL,
  `portail_environnement` enum('development','staging','production') NOT NULL DEFAULT 'development',
  `portail_theme` varchar(255) NOT NULL DEFAULT 'default',
  `portail_dateAdded` datetime DEFAULT NULL,
  `portail_dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`portail_id`),
  UNIQUE KEY `portail_code` (`portail_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Table des portails' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ztdf_portails`
--

INSERT INTO `ztdf_portails` (`portail_id`, `portail_code`, `portail_libelle`, `portail_commentaire`, `portail_environnement`, `portail_theme`, `portail_dateAdded`, `portail_dateUpdated`) VALUES
(1, 'localhost', 'Dev', 'Portail local de dev', 'development', 'default', NULL, '2014-11-09 10:33:51'),
(2, 'recette', 'Recette', 'Portail de recette', 'staging', 'default', NULL, '2013-08-07 20:30:01'),
(3, 'prod', 'Prod', 'Portail de prod', 'production', 'default', NULL, '2013-08-07 20:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_portailurl`
--

CREATE TABLE IF NOT EXISTS `ztdf_portailurl` (
  `portailurl_id` int(11) NOT NULL AUTO_INCREMENT,
  `portailurl_portail_id` int(11) NOT NULL,
  `portailurl_url` varchar(255) NOT NULL,
  `portailurl_dateAdded` datetime DEFAULT NULL,
  `portailurl_dateUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`portailurl_id`),
  KEY `portailurl_portail_id` (`portailurl_portail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Table des url des portails' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ztdf_portailurl`
--

INSERT INTO `ztdf_portailurl` (`portailurl_id`, `portailurl_portail_id`, `portailurl_url`, `portailurl_dateAdded`, `portailurl_dateUpdated`) VALUES
(1, 1, 'executiveproject', NULL, '2016-02-21 14:11:19'),
(2, 1, 'executiveproject-back', '2013-08-07 09:00:00', '2016-02-21 14:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `ztdf_privileges`
--

CREATE TABLE IF NOT EXISTS `ztdf_privileges` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `flag_id` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`flag_id`),
  KEY `idx_resource_id` (`flag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `ztdf_privileges`
--

INSERT INTO `ztdf_privileges` (`id`, `name`, `flag_id`, `description`) VALUES
(1, 'index', '1', 'Index des backups'),
(2, 'bdd', '1', 'Backup de la bdd'),
(3, 'files', '1', 'Backup des fichiers'),
(4, 'index', '2', 'Index des benchmark'),
(5, 'benchmark1', '2', 'Benchmark 1'),
(6, 'benchmark2', '2', 'Benchmark 2'),
(7, 'benchmark-bdd', '2', 'Benchmark BDD'),
(8, 'index', '3', 'Controller''s entry point'),
(9, 'index', '4', 'Allows the user to view all the flags registered in the application'),
(10, 'toggleprod', '4', 'Change the active status of a flag on production'),
(11, 'toggledev', '4', 'Change the active status of a flag on development'),
(12, 'generatesql', '4', 'Generate SQL flags and privileges'),
(13, 'index', '5', 'Index des models'),
(14, 'generate', '5', 'Génération des models'),
(15, 'index', '6', 'Allows the user to view all the user groups registered\nin the application'),
(16, 'add', '6', 'Allows the user to add another user group in the\napplication'),
(17, 'edit', '6', 'Edits an existing user group'),
(18, 'delete', '6', 'Allows the user to delete an existing user group. All the users attached to\nthis group *WILL NOT* be deleted, they will just lose all'),
(19, 'flippers', '6', 'Allows the user to manage individual permissions for each\nuser group'),
(20, 'index', '7', 'Controller''s entry point'),
(21, 'index', '8', 'Index du paramétrage des mails'),
(22, 'test', '8', 'Test envoi de mail'),
(23, 'index', '9', 'Index du paramétrage'),
(24, 'synthese', '9', 'Synthese du paramétrage'),
(25, 'checkintegrite', '9', 'Check Integrite du paramétrage'),
(26, 'exportparam', '9', 'Export du paramétrage'),
(27, 'index', '10', 'Index des portails'),
(28, 'index', '11', 'Index des urls'),
(29, 'index', '12', 'Allows the user to view all the permissions registered\nin the application'),
(30, 'add', '12', 'Allows the user to add another privilege in the application'),
(31, 'edit', '12', 'Edits an existing privilege'),
(32, 'delete', '12', 'Allows the user to delete an existing privilege. All the flippers related to\nthis privilege will be removed'),
(33, 'index', '13', 'Allows users to see their dashboards'),
(34, 'edit', '13', 'Allows the users to update their profiles'),
(35, 'change-password', '13', 'Allows users to change their passwords'),
(36, 'login', '13', 'Allows users to log into the application'),
(37, 'logout', '13', 'Allows users to log out of the application'),
(38, 'index', '14', 'Controller''s entry point'),
(39, 'example', '14', 'Theme example page'),
(40, 'example-errors', '14', 'Errors example page'),
(41, 'phpinfo', '14', 'Phpinfo point'),
(42, 'index', '15', 'Index des outils'),
(43, 'cleancache', '15', 'Vide le cache de l''application'),
(44, 'adminer', '15', 'Adminer'),
(45, 'index', '16', 'Allows users to see all other users that are registered in\nthe application'),
(46, 'add', '16', 'Allows users to add new users in the application\n(should be reserved for administrators)'),
(47, 'edit', '16', 'Allows users to edit another users'' data\n(should be reserved for administrators)'),
(48, 'view', '16', 'Allows users to see other users'' profiles'),
(49, 'delete', '16', 'Allows users to logically delete other users\n(should be reserved for administrators)'),
(50, 'index', '17', 'Controller''s entry point'),
(51, 'static', '17', 'Static Pages'),
(52, 'index', '18', 'Controller''s entry point'),
(53, 'login', '18', 'Login entry point'),
(54, 'logout', '18', 'Allows users to log out of the application'),
(55, 'mon-compte', '18', 'Index mon compte'),
(56, 'index', '19', 'Controller''s entry point'),
(57, 'accueil', '19', 'Accueil entry point'),
(58, 'index', '20', 'Controller''s entry point'),
(59, 'accueil', '20', 'Accueil entry point'),
(60, 'datelib', '20', 'DateLib test entry point'),
(61, 'uploadsinglefile', '20', 'Upload single file test entry point'),
(62, 'parsefile', '20', 'Parse file test entry point'),
(63, 'index', '21', 'Controller''s entry point'),
(64, 'javascript', '21', 'Javascript entry point'),
(65, 'zendcommon', '21', 'Zend common entry point'),
(66, 'datatable', '20', 'Datatable entry point'),
(67, 'datatable', '21', 'Datatable entry point'),
(68, 'trycatch', '20', 'Parse file test entry point'),
(69, 'index', '22', 'Controller''s entry point'),
(70, 'static', '22', 'Static Pages'),
(71, 'home', '22', 'Home Pages'),
(72, 'index', '23', 'Controller''s entry point'),
(73, 'login', '23', 'Login entry point'),
(74, 'logout', '23', 'Allows users to log out of the application'),
(75, 'mon-compte', '23', 'Index mon compte'),
(76, 'index', '24', 'Controller''s entry point'),
(77, 'accueil', '24', 'Accueil entry point'),
(78, 'vecteurplus', '22', 'Vecteur Plus'),
(79, 'captcha', '22', 'Captcha'),
(80, 'mentions-legales', '22', 'Mentions légales'),
(81, 'cgu-accepter', '22', 'Accepter CGU'),
(82, 'cgu-accepter-essai', '22', 'Accepter CGU'),
(83, 'tarifs', '22', 'Tarifs'),
(84, 'video', '22', 'Video'),
(85, 'edit', '23', 'Allows the users to update their profiles'),
(86, 'change-password', '23', 'Allows users to change their passwords'),
(87, 'cpasbien', '25', 'cpasbien''s entry point'),
(88, 'php', '21', 'Php entry point'),
(89, 'css', '21', 'Css entry point'),
(90, 'testdivers', '20', 'Test divers entry point'),
(91, 'putty', '21', 'Putty entry point'),
(92, 'testajax', '20', 'Test ajax entry page'),
(93, 'addaccount', '19', 'Ajouter un compte utilisateur');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
