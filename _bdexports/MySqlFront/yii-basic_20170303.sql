# Host: yiiadvanced.dev  (Version 5.5.47-0+deb7u1)
# Date: 2017-03-03 14:09:33
# Generator: MySQL-Front 6.0  (Build 1.44)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "auth_item"
#

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "auth_item"
#

INSERT INTO `auth_item` VALUES ('/*',2,NULL,NULL,NULL,1487929467,1487929467),('/admin/*',2,NULL,NULL,NULL,1487929467,1487929467),('/admon',2,'backend',NULL,NULL,1488382758,1488382758),('/admon/*',2,NULL,NULL,NULL,1487929467,1487929467),('/admon/user/registration/*',2,NULL,NULL,NULL,NULL,NULL),('/admon/user/registration/connect',2,NULL,NULL,NULL,NULL,NULL),('/post/*',2,'post',NULL,NULL,1488469853,1488469853),('/post/index',2,NULL,NULL,NULL,NULL,NULL),('/site/*',2,NULL,NULL,NULL,1487937905,1487937905),('/site/about',2,'about',NULL,NULL,1488475701,1488475701),('/site/contact',2,'Contact',NULL,NULL,1488475738,1488475738),('/site/index',2,NULL,NULL,NULL,1487929467,1487929467),('/user/*',2,NULL,NULL,NULL,1487939105,1487939105),('/user/register/',2,NULL,NULL,NULL,NULL,NULL),('/user/registration/*',2,NULL,NULL,NULL,NULL,NULL),('/user/registration/connect',2,NULL,NULL,NULL,NULL,NULL),('admin',1,'Administrador',NULL,NULL,1487929081,1487929081),('createPost',2,'Create a post',NULL,NULL,1488470317,1488470317),('invitado',1,'invitado',NULL,NULL,1487937874,1487937874),('permisos_admin',2,'permisos_admin',NULL,NULL,1487934160,1487934526),('permisos_invitado',2,'permisos_invitado',NULL,NULL,1487937939,1487937939),('permisos_usuario',2,'permisos_usuario',NULL,NULL,1487934555,1487934555),('updateOwnPost',2,'Update own post','isAuthor',NULL,1488470338,1488470338),('updatePost',2,'Update post',NULL,NULL,1488470317,1488470317),('usuario',1,'Usuario normal',NULL,NULL,1487929467,1487930802);

#
# Structure for table "auth_assignment"
#

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "auth_assignment"
#

INSERT INTO `auth_assignment` VALUES ('admin','1',NULL),('admin','8',1488217879),('usuario','1',1488207422),('usuario','2',1488191008),('usuario','3',1487936897),('usuario','5',1487943672),('usuario','7',1488217490),('usuario','8',1488217834),('usuario','9',1488382485);

#
# Structure for table "auth_item_child"
#

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "auth_item_child"
#

INSERT INTO `auth_item_child` VALUES ('admin','/*'),('admin','/admin/*'),('admin','/admon/*'),('admin','/admon/user/registration/*'),('admin','/admon/user/registration/connect'),('admin','/post/index'),('admin','/site/*'),('admin','/site/index'),('admin','/user/*'),('admin','/user/register/'),('admin','/user/registration/*'),('admin','/user/registration/connect'),('admin','permisos_admin'),('admin','updatePost'),('admin','usuario'),('invitado','permisos_invitado'),('permisos_admin','/*'),('permisos_admin','/admin/*'),('permisos_admin','/admon'),('permisos_admin','/admon/*'),('permisos_admin','/admon/user/registration/*'),('permisos_admin','/admon/user/registration/connect'),('permisos_admin','/post/*'),('permisos_admin','/post/index'),('permisos_admin','/site/*'),('permisos_admin','/site/about'),('permisos_admin','/site/contact'),('permisos_admin','/site/index'),('permisos_admin','/user/*'),('permisos_admin','/user/register/'),('permisos_admin','/user/registration/*'),('permisos_admin','/user/registration/connect'),('permisos_admin','createPost'),('permisos_admin','updatePost'),('permisos_invitado','/site/*'),('permisos_invitado','/user/*'),('permisos_usuario','/admon/user/registration/*'),('permisos_usuario','/admon/user/registration/connect'),('permisos_usuario','/post/*'),('permisos_usuario','/post/index'),('permisos_usuario','/site/*'),('permisos_usuario','/site/about'),('permisos_usuario','/site/contact'),('permisos_usuario','/site/index'),('permisos_usuario','/user/*'),('permisos_usuario','/user/register/'),('permisos_usuario','/user/registration/*'),('permisos_usuario','/user/registration/connect'),('permisos_usuario','createPost'),('permisos_usuario','updatePost'),('updateOwnPost','updatePost'),('usuario','createPost'),('usuario','permisos_usuario'),('usuario','updateOwnPost');

#
# Structure for table "auth_rule"
#

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "auth_rule"
#

INSERT INTO `auth_rule` VALUES ('isAuthor',X'4F3A31393A226170705C726261635C417574686F7252756C65223A333A7B733A343A226E616D65223B733A383A226973417574686F72223B733A393A22637265617465644174223B693A313438383437303333373B733A393A22757064617465644174223B693A313438383437303333373B7D',1488470337,1488470337);

#
# Structure for table "fichero"
#

DROP TABLE IF EXISTS `fichero`;
CREATE TABLE `fichero` (
  `fichero_id` int(11) NOT NULL AUTO_INCREMENT,
  `tabla_padre` varchar(60) DEFAULT NULL,
  `tabla_padre_id` int(11) DEFAULT NULL,
  `ruta` varchar(120) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `nombre_original` varchar(255) DEFAULT NULL,
  `extension` varchar(5) DEFAULT NULL,
  `ruta_completa` varchar(180) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '10',
  PRIMARY KEY (`fichero_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "fichero"
#

INSERT INTO `fichero` VALUES (6,'post',7,'/uploads/user/8/post/7/','971a2d54942a9b2e21d778a743e55f44.jpg','gato _ copia.jpg','jpg','/uploads/user/8/post/7/971a2d54942a9b2e21d778a743e55f44.jpg',5324,8,NULL,NULL,10),(7,'post',7,'/uploads/user/8/post/7/','752f9e593c102b8b9e910cebccefec81.jpg','gatito _ copia.jpg','jpg','/uploads/user/8/post/7/752f9e593c102b8b9e910cebccefec81.jpg',7858,8,NULL,NULL,10),(8,'post',7,'/uploads/user/8/post/7/','b1bd05dd5d04748f38e82d1685a0a685.jpg','gatito.jpg','jpg','/uploads/user/8/post/7/b1bd05dd5d04748f38e82d1685a0a685.jpg',7858,8,NULL,NULL,10),(9,'post',7,'/uploads/user/8/post/7/','f024838661a689cf2a373d4f84a1e3a8.png','user.png','png','/uploads/user/8/post/7/f024838661a689cf2a373d4f84a1e3a8.png',50486,8,1488545628,1488545628,10),(10,'post',7,'/uploads/user/8/post/7/','0a669b62d914040ae9de20967b7a9754.jpg','user2.jpg','jpg','/uploads/user/8/post/7/0a669b62d914040ae9de20967b7a9754.jpg',2086,8,1488545628,1488545628,10);

#
# Structure for table "menu"
#

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "menu"
#

INSERT INTO `menu` VALUES (2,'Admon :: Backend',NULL,'/admon',1,NULL),(3,'Posts',NULL,'/post/index',2,NULL),(4,'Main Menu',NULL,NULL,1,NULL),(5,'Home',4,'/site/index',1,NULL),(6,'About',4,'/site/about',2,NULL),(7,'Contact',4,'/site/contact',3,NULL);

#
# Structure for table "migration"
#

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "migration"
#

INSERT INTO `migration` VALUES ('m000000_000000_base',1487786170),('m140209_132017_init',1487786173),('m140403_174025_create_account_table',1487786173),('m140504_113157_update_tables',1487786173),('m140504_130429_create_token_table',1487786173),('m140506_102106_rbac_init',1487859442),('m140602_111327_create_menu_table',1487859097),('m140830_171933_fix_ip_field',1487786173),('m140830_172703_change_account_table_name',1487786173),('m141222_110026_update_ip_field',1487786173),('m141222_135246_alter_username_length',1487786173),('m150614_103145_update_social_account_table',1487786173),('m150623_212711_fix_username_notnull',1487786173),('m151218_234654_add_timezone_to_profile',1487786173),('m160312_050000_create_user',1487859097),('m160929_103127_add_last_login_at_to_user_table',1487786173);

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '10',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'jesus','jesusrey85@gmail.com','$2y$10$OIEviplAQJXk/wX1hyEr1ObetaG1/KI9mXUsSGTa6NNjdY4vFEMmO','kR_JkXN9ruYZbBZF8L-FfSsroT3W2p3G',NULL,1487786453,NULL,NULL,'192.168.10.1',1487786418,1487786418,0,1488386346,10),(2,'user','jesus@gmail.com','$2y$10$94MR62lNDxw6bPohoTsNlu2KGN67s02ykWitNydUqJrNW.6KL.IVS','vij0Psktegvni_JPYJYRtLz08f6hwIWo',NULL,1487787034,NULL,NULL,'192.168.10.1',1487786965,1487786965,0,1488191063,10),(3,'test','j@j.com','$2y$10$ZcUtq09zDxAY7Cs.8/N4Len94vdoeTiOpO/XbZuvlhzAAf0sZD.ge','DaFGi-6ABMO7ID0dUm4o6RD8VRG0u7XN',NULL,1487871943,NULL,NULL,'192.168.10.1',1487871943,1487871943,0,1488479695,10),(4,'nuevo','nuevo@nuevo.com','$2y$10$c50W6T0m5y.6/TYT/HeIheTNxW9rzAc0KpIM4hJDHsTZZ/77BM2Rm','iMKJPPV5WylAiS3P6HpgAJNrPZEkoRgH',NULL,1487939397,NULL,NULL,'192.168.10.1',1487939334,1487939334,0,NULL,10),(5,'prueba','sdfasfasd@aksjdksa.com','$2y$10$bhdWHy.BeQRL6eoSZ.8/meLyIL1ChOSFv0xel8vy1O3tS8e2smdk2','Kz7AL8b_f7qHveIWj__7P3YbHWCYZ5Fp',NULL,1488188276,NULL,NULL,'192.168.10.1',1487943672,1487943672,0,NULL,10),(7,'facebook','chusote@hotmail.com','$2y$10$MHyK5T9ngJAJ8caQouqNaudKBSdv4Rb/eQxIvkSqt38wplpSM7Aw2','DzIOkyRmXLXVfaqlyFTPnTVJA88kUCnF',NULL,1488208578,NULL,NULL,'192.168.10.1',1488208578,1488208578,0,NULL,10),(8,'rey_mad','twitter@twitter.com','$2y$10$4J1x6EDpRkha4buoZ4rszOsVKD09HqhR1g/uo4Z2LWQvLxgsyjCGG','ABixosd-hedroNMsTGpoXxkKafxTuILc',NULL,1488217834,NULL,NULL,'192.168.10.1',1488217834,1488217834,0,NULL,10),(9,'proximitymadbot','pxy@pxy.com','$2y$10$Ru0uAlzgOVH2EH81U42XZeHZMO2ZnJRVdIm8UnOzJKLpiq769MnoC','9MkjpaVuvqZRmA7iPg9Boj8R_eb01XD5',NULL,1488382485,NULL,NULL,'192.168.10.1',1488382485,1488382485,0,NULL,10);

#
# Structure for table "token"
#

DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "token"
#

INSERT INTO `token` VALUES (5,'0r-OUglbgXAZXAPgXlfAZIfC5-wwgU3u',1487943672,0);

#
# Structure for table "social_account"
#

DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "social_account"
#

INSERT INTO `social_account` VALUES (2,7,'facebook','10155110840484511','{\"name\":\"Jesús Rey\",\"email\":\"chusote@hotmail.com\",\"id\":\"10155110840484511\"}',NULL,NULL,NULL,NULL),(4,8,'twitter','2491312848','{\"id\":2491312848,\"id_str\":\"2491312848\",\"name\":\"jesus rey\",\"screen_name\":\"rey_mad\",\"location\":\"\",\"description\":\"\",\"url\":null,\"entities\":{\"description\":{\"urls\":[]}},\"protected\":false,\"followers_count\":11,\"friends_count\":31,\"listed_count\":0,\"created_at\":\"Mon May 12 11:40:51 +0000 2014\",\"favourites_count\":1,\"utc_offset\":null,\"time_zone\":null,\"geo_enabled\":false,\"verified\":false,\"statuses_count\":27,\"lang\":\"en\",\"status\":{\"created_at\":\"Thu May 19 16:35:37 +0000 2016\",\"id\":733335309946085376,\"id_str\":\"733335309946085376\",\"text\":\"https://t.co/AZkhNlwBr7 #summerland\",\"truncated\":false,\"entities\":{\"hashtags\":[{\"text\":\"summerland\",\"indices\":[24,35]}],\"symbols\":[],\"user_mentions\":[],\"urls\":[{\"url\":\"https://t.co/AZkhNlwBr7\",\"expanded_url\":\"http://www.summerlandbyiberostar.com/\",\"display_url\":\"summerlandbyiberostar.com\",\"indices\":[0,23]}]},\"source\":\"<a href=\\\"http://twitter.com\\\" rel=\\\"nofollow\\\">Twitter Web Client</a>\",\"in_reply_to_status_id\":null,\"in_reply_to_status_id_str\":null,\"in_reply_to_user_id\":null,\"in_reply_to_user_id_str\":null,\"in_reply_to_screen_name\":null,\"geo\":null,\"coordinates\":null,\"place\":null,\"contributors\":null,\"is_quote_status\":false,\"retweet_count\":0,\"favorite_count\":1,\"favorited\":false,\"retweeted\":false,\"possibly_sensitive\":false,\"lang\":\"und\"},\"contributors_enabled\":false,\"is_translator\":false,\"is_translation_enabled\":false,\"profile_background_color\":\"C0DEED\",\"profile_background_image_url\":\"http://abs.twimg.com/images/themes/theme1/bg.png\",\"profile_background_image_url_https\":\"https://abs.twimg.com/images/themes/theme1/bg.png\",\"profile_background_tile\":false,\"profile_image_url\":\"http://abs.twimg.com/sticky/default_profile_images/default_profile_3_normal.png\",\"profile_image_url_https\":\"https://abs.twimg.com/sticky/default_profile_images/default_profile_3_normal.png\",\"profile_link_color\":\"1DA1F2\",\"profile_sidebar_border_color\":\"C0DEED\",\"profile_sidebar_fill_color\":\"DDEEF6\",\"profile_text_color\":\"333333\",\"profile_use_background_image\":true,\"has_extended_profile\":false,\"default_profile\":true,\"default_profile_image\":true,\"following\":false,\"follow_request_sent\":false,\"notifications\":false,\"translator_type\":\"none\"}','1bd75c918472bd660afe96c1c0fb60fc',NULL,NULL,NULL),(5,9,'twitter','1320386886','{\"id\":1320386886,\"id_str\":\"1320386886\",\"name\":\"proximitymadbot\",\"screen_name\":\"proximitymadbot\",\"location\":\"\",\"description\":\"\",\"url\":null,\"entities\":{\"description\":{\"urls\":[]}},\"protected\":false,\"followers_count\":5,\"friends_count\":1,\"listed_count\":0,\"created_at\":\"Mon Apr 01 13:59:29 +0000 2013\",\"favourites_count\":0,\"utc_offset\":3600,\"time_zone\":\"Madrid\",\"geo_enabled\":false,\"verified\":false,\"statuses_count\":3,\"lang\":\"es\",\"status\":{\"created_at\":\"Tue Dec 16 17:02:10 +0000 2014\",\"id\":544900301095202817,\"id_str\":\"544900301095202817\",\"text\":\"RT @mahou_es: Cada uno tiene su propia Navidad, llena de momentos en los que decir #soymuydeMahou. ¿Cuáles son los tuyos?\\nhttps://t.co/d6Qo…\",\"truncated\":false,\"entities\":{\"hashtags\":[{\"text\":\"soymuydeMahou\",\"indices\":[83,97]}],\"symbols\":[],\"user_mentions\":[{\"screen_name\":\"mahou_es\",\"name\":\"Mahou\",\"id\":271521675,\"id_str\":\"271521675\",\"indices\":[3,12]}],\"urls\":[]},\"source\":\"<a href=\\\"http://twitter.com\\\" rel=\\\"nofollow\\\">Twitter Web Client</a>\",\"in_reply_to_status_id\":null,\"in_reply_to_status_id_str\":null,\"in_reply_to_user_id\":null,\"in_reply_to_user_id_str\":null,\"in_reply_to_screen_name\":null,\"geo\":null,\"coordinates\":null,\"place\":null,\"contributors\":null,\"retweeted_status\":{\"created_at\":\"Wed Dec 10 14:06:00 +0000 2014\",\"id\":542681642892935170,\"id_str\":\"542681642892935170\",\"text\":\"Cada uno tiene su propia Navidad, llena de momentos en los que decir #soymuydeMahou. ¿Cuáles son los tuyos?\\nhttps://t.co/d6QoH0L16m\",\"truncated\":false,\"entities\":{\"hashtags\":[{\"text\":\"soymuydeMahou\",\"indices\":[69,83]}],\"symbols\":[],\"user_mentions\":[],\"urls\":[{\"url\":\"https://t.co/d6QoH0L16m\",\"expanded_url\":\"https://amp.twimg.com/v/429a025b-6ade-422f-ad58-e9e20ebe7fd1\",\"display_url\":\"amp.twimg.com/v/429a025b-6ad…\",\"indices\":[108,131]}]},\"source\":\"<a href=\\\"http://twitter.com\\\" rel=\\\"nofollow\\\">Twitter Web Client</a>\",\"in_reply_to_status_id\":null,\"in_reply_to_status_id_str\":null,\"in_reply_to_user_id\":null,\"in_reply_to_user_id_str\":null,\"in_reply_to_screen_name\":null,\"geo\":null,\"coordinates\":null,\"place\":null,\"contributors\":null,\"is_quote_status\":false,\"retweet_count\":952,\"favorite_count\":1211,\"favorited\":false,\"retweeted\":true,\"possibly_sensitive\":false,\"lang\":\"es\"},\"is_quote_status\":false,\"retweet_count\":952,\"favorite_count\":0,\"favorited\":false,\"retweeted\":true,\"lang\":\"es\"},\"contributors_enabled\":false,\"is_translator\":false,\"is_translation_enabled\":false,\"profile_background_color\":\"C0DEED\",\"profile_background_image_url\":\"http://abs.twimg.com/images/themes/theme1/bg.png\",\"profile_background_image_url_https\":\"https://abs.twimg.com/images/themes/theme1/bg.png\",\"profile_background_tile\":false,\"profile_image_url\":\"http://abs.twimg.com/sticky/default_profile_images/default_profile_0_normal.png\",\"profile_image_url_https\":\"https://abs.twimg.com/sticky/default_profile_images/default_profile_0_normal.png\",\"profile_link_color\":\"B30000\",\"profile_sidebar_border_color\":\"C0DEED\",\"profile_sidebar_fill_color\":\"DDEEF6\",\"profile_text_color\":\"333333\",\"profile_use_background_image\":true,\"has_extended_profile\":false,\"default_profile\":false,\"default_profile_image\":true,\"following\":false,\"follow_request_sent\":false,\"notifications\":false,\"translator_type\":\"none\"}',NULL,NULL,NULL,NULL);

#
# Structure for table "profile"
#

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "profile"
#

INSERT INTO `profile` VALUES (1,'','','','d41d8cd98f00b204e9800998ecf8427e','','','',NULL),(2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'Jesús Rey',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

#
# Structure for table "post"
#

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '10',
  PRIMARY KEY (`post_id`),
  KEY `fk_author_idx` (`created_by`),
  CONSTRAINT `fk_author` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='post table';

#
# Data for table "post"
#

INSERT INTO `post` VALUES (2,'another post','kajdlkajsdlkasjdaslkdjasd','es-ES',8,1488478386,1488535178,10),(3,'adsfasfasdf','afdsfasdfasdfasdf','es-ES',8,1488469733,1488469733,10),(4,'post fb user','post fb user','es-ES',7,1488473812,1488473812,10),(5,'Another fb user post','Another fb user post','es-ES',7,1488475166,1488534739,10),(6,'kjadhsfjashfkahds','jhkjhsakjhdjksahdsakjd','es-ES',8,1488535282,1488535419,0),(7,'post with photos','post with photos','es-ES',8,1488541215,1488541215,10);
