/*
SQLyog Community Edition- MySQL GUI v7.15 
MySQL - 5.0.67-community-nt : Database - phenomcms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `t_album` */

DROP TABLE IF EXISTS `t_album`;

CREATE TABLE `t_album` (
  `album_id` int(11) NOT NULL auto_increment,
  `album_date` datetime default NULL,
  `album_title` varchar(255) default NULL,
  `album_desc` longtext,
  `album_posted_by` varchar(255) NOT NULL,
  `album_visible` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`album_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `t_album` */

insert  into `t_album`(`album_id`,`album_date`,`album_title`,`album_desc`,`album_posted_by`,`album_visible`) values (1,'2010-11-26 17:56:13','My Gallery','This is my gallery','','1');

/*Table structure for table `t_application` */

DROP TABLE IF EXISTS `t_application`;

CREATE TABLE `t_application` (
  `app_title` varchar(255) NOT NULL,
  `app_slogan` varchar(255) NOT NULL,
  `app_footer` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_theme` varchar(255) NOT NULL,
  `app_use_loginform` enum('0','1') NOT NULL default '1',
  `app_use_tagscloud` enum('0','1') NOT NULL default '1',
  `app_use_polling` enum('0','1') NOT NULL default '1',
  `app_use_cache` enum('0','1') NOT NULL default '0',
  `app_gb_approval` enum('0','1') NOT NULL default '0',
  `app_gb_image_width` int(11) NOT NULL,
  `app_gb_image_height` int(11) NOT NULL,
  `app_posting_image_width` int(11) NOT NULL,
  `app_posting_image_height` int(11) NOT NULL,
  `app_use_comment` enum('0','1') NOT NULL default '1',
  `app_comment_approval` enum('0','1') NOT NULL default '0',
  `app_email_ack` enum('0','1') NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `t_application` */

insert  into `t_application`(`app_title`,`app_slogan`,`app_footer`,`app_author`,`app_email`,`app_theme`,`app_use_loginform`,`app_use_tagscloud`,`app_use_polling`,`app_use_cache`,`app_gb_approval`,`app_gb_image_width`,`app_gb_image_height`,`app_posting_image_width`,`app_posting_image_height`,`app_use_comment`,`app_comment_approval`,`app_email_ack`) values ('Your Site Name','Your Site Slogan','Customize your footer here...','your-name','foo@yahoo.com','InternetBusiness','1','1','1','0','0',0,0,0,0,'1','0','0');

/*Table structure for table `t_category` */

DROP TABLE IF EXISTS `t_category`;

CREATE TABLE `t_category` (
  `category_id` int(11) NOT NULL auto_increment,
  `category_type` enum('menu','post') NOT NULL default 'menu',
  `category_display_item` enum('SPECIFIC','ALL') NOT NULL default 'SPECIFIC',
  `category_item_count` int(11) NOT NULL,
  `category_name` varchar(255) default NULL,
  `category_visible` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`category_id`),
  UNIQUE KEY `category_nama` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `t_category` */

insert  into `t_category`(`category_id`,`category_type`,`category_display_item`,`category_item_count`,`category_name`,`category_visible`) values (1,'post','SPECIFIC',4,'News','1'),(2,'post','SPECIFIC',4,'Articles','1'),(3,'menu','ALL',0,'Menu','1'),(4,'menu','ALL',0,'Links','1');

/*Table structure for table `t_comments` */

DROP TABLE IF EXISTS `t_comments`;

CREATE TABLE `t_comments` (
  `comment_id` bigint(20) unsigned NOT NULL auto_increment,
  `comment_posting_id` bigint(20) unsigned NOT NULL,
  `comment_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `comment_name` varchar(255) NOT NULL default 'unknown',
  `comment_email` varchar(255) default NULL,
  `comment_url` varchar(255) NOT NULL,
  `comment_content` longtext NOT NULL,
  `comment_ip` varchar(15) NOT NULL,
  `comment_approval` enum('0','1') NOT NULL,
  PRIMARY KEY  (`comment_id`),
  KEY `komentar_posting_id` (`comment_posting_id`),
  CONSTRAINT `t_comments_ibfk_1` FOREIGN KEY (`comment_posting_id`) REFERENCES `t_posting` (`posting_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_comments` */

/*Table structure for table `t_guestbook` */

DROP TABLE IF EXISTS `t_guestbook`;

CREATE TABLE `t_guestbook` (
  `gb_id` bigint(20) unsigned NOT NULL auto_increment,
  `gb_date` datetime NOT NULL,
  `gb_name` varchar(255) NOT NULL,
  `gb_email` varchar(255) NOT NULL,
  `gb_site` varchar(255) NOT NULL,
  `gb_message` longtext NOT NULL,
  `gb_approval` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`gb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `t_guestbook` */

/*Table structure for table `t_pages` */

DROP TABLE IF EXISTS `t_pages`;

CREATE TABLE `t_pages` (
  `page_id` int(11) NOT NULL auto_increment,
  `page_title` varchar(255) default NULL,
  `page_type` enum('page','module','uri','url') NOT NULL default 'page',
  `page_content` longtext,
  `page_module` varchar(255) NOT NULL,
  `page_uri` varchar(255) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_target` enum('_self','_blank') NOT NULL default '_self',
  `page_image` varchar(255) NOT NULL,
  `page_image_desc` varchar(255) NOT NULL,
  `page_visible` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `t_pages` */

insert  into `t_pages`(`page_id`,`page_title`,`page_type`,`page_content`,`page_module`,`page_uri`,`page_url`,`page_target`,`page_image`,`page_image_desc`,`page_visible`) values (1,'Gallery','module','','gallery','','','_self','','','1'),(2,'Guest Book','module','','guestbook','','','_self','','','1');

/*Table structure for table `t_panel` */

DROP TABLE IF EXISTS `t_panel`;

CREATE TABLE `t_panel` (
  `panel_id` int(11) NOT NULL auto_increment,
  `panel_name` varchar(20) NOT NULL,
  `panel_label` varchar(255) NOT NULL,
  `panel_content` text NOT NULL,
  `panel_visible` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`panel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `t_panel` */

insert  into `t_panel`(`panel_id`,`panel_name`,`panel_label`,`panel_content`,`panel_visible`) values (1,'widget1','Advertisement','<p>&nbsp;<img align=\"top\" style=\"width: 316px; height: 113px;\" src=\"/phenomcms/userfiles/image/album/Stream.jpg\" alt=\"\" /></p>\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing</p>\n<p>elit, sed diam nonummy nibh euismod tincidunt ut ha</p>\n<p>elit, sed diam nonummy nibh euismod tincidunt ut</p>','1'),(2,'widget2','Advertisement','<p><img src=\"/phenomcms/userfiles/image/album/Beach.jpg\" style=\"width: 354px; height: 128px;\" alt=\"\" /></p>\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing</p>\n<p>elit, sed diam nonummy nibh euismod tincidunt ut ha</p>\n<p>elit, sed diam nonummy nibh euismod tincidunt ut</p>','1');

/*Table structure for table `t_photo` */

DROP TABLE IF EXISTS `t_photo`;

CREATE TABLE `t_photo` (
  `photo_id` int(10) unsigned NOT NULL auto_increment,
  `photo_album_id` int(11) default NULL,
  `photo_date` datetime NOT NULL,
  `photo_image` varchar(255) NOT NULL,
  `photo_desc` longtext,
  `photo_thumbnail` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`photo_id`),
  KEY `photo_album_id` (`photo_album_id`),
  CONSTRAINT `t_photo_ibfk_1` FOREIGN KEY (`photo_album_id`) REFERENCES `t_album` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `t_photo` */

insert  into `t_photo`(`photo_id`,`photo_album_id`,`photo_date`,`photo_image`,`photo_desc`,`photo_thumbnail`) values (1,1,'2010-11-26 17:56:36','Beach.jpg','Photo 1','1'),(2,1,'2010-11-26 17:56:43','Daisy.jpg','Photo 2','0'),(3,1,'2010-11-26 17:56:55','Stream.jpg','Photo 3','0'),(4,1,'2010-11-26 17:57:06','Surf.jpg','Photo 4','0');

/*Table structure for table `t_polling` */

DROP TABLE IF EXISTS `t_polling`;

CREATE TABLE `t_polling` (
  `polling_id` bigint(20) NOT NULL auto_increment,
  `polling_topic` text NOT NULL,
  `polling_date` datetime NOT NULL,
  `polling_activate` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`polling_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `t_polling` */

insert  into `t_polling`(`polling_id`,`polling_topic`,`polling_date`,`polling_activate`) values (1,'Bagaimana menurut Anda tentang PhenomCMS?','2010-11-26 17:59:47','1');

/*Table structure for table `t_polling_pil` */

DROP TABLE IF EXISTS `t_polling_pil`;

CREATE TABLE `t_polling_pil` (
  `polling_pil_id` bigint(20) NOT NULL auto_increment,
  `polling_pil_polling_id` bigint(20) NOT NULL,
  `polling_pil_name` varchar(255) NOT NULL,
  `polling_pil_hits` bigint(20) NOT NULL,
  PRIMARY KEY  (`polling_pil_id`),
  KEY `polling_pil_polling_id` (`polling_pil_polling_id`),
  CONSTRAINT `t_polling_pil_ibfk_1` FOREIGN KEY (`polling_pil_polling_id`) REFERENCES `t_polling` (`polling_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `t_polling_pil` */

insert  into `t_polling_pil`(`polling_pil_id`,`polling_pil_polling_id`,`polling_pil_name`,`polling_pil_hits`) values (1,1,'Sangat Baik',40),(2,1,'Baik',30),(3,1,'Cukup Baik',20),(4,1,'Kurang Menarik',10);

/*Table structure for table `t_posting` */

DROP TABLE IF EXISTS `t_posting`;

CREATE TABLE `t_posting` (
  `posting_id` bigint(20) unsigned NOT NULL auto_increment,
  `posting_category_id` int(11) NOT NULL,
  `posting_day` varchar(20) NOT NULL,
  `posting_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `posting_title` varchar(255) NOT NULL,
  `posting_type` enum('menu','post','module','uri','url') NOT NULL default 'menu',
  `posting_content` longtext NOT NULL,
  `posting_module` varchar(255) NOT NULL,
  `posting_uri` varchar(255) NOT NULL,
  `posting_url` varchar(255) NOT NULL,
  `posting_target` enum('_self','_blank') NOT NULL default '_self',
  `posting_image` varchar(255) NOT NULL,
  `posting_image_desc` varchar(255) NOT NULL,
  `posting_by` varchar(255) NOT NULL,
  `posting_hits` bigint(20) unsigned NOT NULL,
  `posting_visible` enum('0','1') NOT NULL default '1',
  `posting_comment_status` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`posting_id`),
  KEY `posting_category_id` (`posting_category_id`),
  CONSTRAINT `t_posting_ibfk_1` FOREIGN KEY (`posting_category_id`) REFERENCES `t_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `t_posting` */

insert  into `t_posting`(`posting_id`,`posting_category_id`,`posting_day`,`posting_date`,`posting_title`,`posting_type`,`posting_content`,`posting_module`,`posting_uri`,`posting_url`,`posting_target`,`posting_image`,`posting_image_desc`,`posting_by`,`posting_hits`,`posting_visible`,`posting_comment_status`) values (1,3,'','2010-11-26 18:08:05','Sub Menu 1','menu','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>','','','','_self','','','',4,'1','0'),(2,3,'','2010-11-26 18:08:37','Sub Menu 2','menu','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>','','','','_self','','','',1,'1','0'),(3,4,'','2010-11-26 18:14:47','PhenomCMS','url','','','','http://www.phenomcms.com','_blank','','','',0,'1','0'),(4,1,'','2010-11-26 18:16:54','News 1','menu','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>','','','','_self','gal1.jpg','','',2,'1','1'),(5,1,'','2010-11-26 18:19:34','News 2','menu','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>','','','','_self','gal2.jpg','','',2,'1','1'),(6,2,'','2010-11-26 18:20:57','Article 1','menu','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>','','','','_self','gal3.jpg','','',1,'1','1'),(7,2,'','2010-11-26 18:21:44','Article 2','menu','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>','','','','_self','gal8.jpg','','',6,'1','1'),(8,3,'','2011-03-11 17:24:31','menu 3','menu','Vestibulum dui erat, consequat in posuere sit amet, bibendum eu tellus? Quisque nec dui in nisl dictum varius. Nulla id turpis ante. Phasellus at porttitor diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a urna ligula. Ut condimentum tempor risus pharetra tristique. Proin dictum sodales felis, in condimentum purus iaculis in. Cras eros augue, accumsan id accumsan eget; convallis in libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin vel nibh ut augue mollis blandit non non nulla. Integer sodales mattis justo, sit amet consectetur nunc rutrum a. Maecenas tristique mauris cursus orci aliquet iaculis. Proin dui nunc, euismod ut condimentum sed; lacinia non erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\n','','','','_self','','','',0,'1','0');

/*Table structure for table `t_posting_tag` */

DROP TABLE IF EXISTS `t_posting_tag`;

CREATE TABLE `t_posting_tag` (
  `tag_posting_id` bigint(20) unsigned default NULL,
  `posting_tag` varchar(255) NOT NULL,
  KEY `tag_posting_id` (`tag_posting_id`),
  KEY `tagged` (`posting_tag`),
  CONSTRAINT `t_posting_tag_ibfk_1` FOREIGN KEY (`tag_posting_id`) REFERENCES `t_posting` (`posting_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_posting_tag_ibfk_2` FOREIGN KEY (`posting_tag`) REFERENCES `t_tags` (`tag_name`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_posting_tag` */

insert  into `t_posting_tag`(`tag_posting_id`,`posting_tag`) values (4,'PhenomCMS'),(4,'CMS'),(4,'CodeIgniter'),(5,'PhenomCMS'),(6,'Articles'),(7,'Articles');

/*Table structure for table `t_tags` */

DROP TABLE IF EXISTS `t_tags`;

CREATE TABLE `t_tags` (
  `tag_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`tag_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_tags` */

insert  into `t_tags`(`tag_name`) values ('Articles'),('CMS'),('CodeIgniter'),('PhenomCMS');

/*Table structure for table `t_user` */

DROP TABLE IF EXISTS `t_user`;

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL auto_increment,
  `userCompleteName` varchar(40) NOT NULL default '',
  `userEmail` varchar(255) NOT NULL,
  `userType` enum('1','2') NOT NULL default '2',
  `userName` varchar(40) NOT NULL default '',
  `userPassword` varchar(100) NOT NULL default '',
  `userActivate` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `t_user` */

insert  into `t_user`(`user_id`,`userCompleteName`,`userEmail`,`userType`,`userName`,`userPassword`,`userActivate`) values (1,'Administrator','foo@yahoo.com','1','admin','21232f297a57a5a743894a0e4a801fc3','1');

/*Table structure for table `t_verifikasi` */

DROP TABLE IF EXISTS `t_verifikasi`;

CREATE TABLE `t_verifikasi` (
  `verifikasi_id` int(11) NOT NULL auto_increment,
  `verifikasi_image` varchar(40) NOT NULL default '',
  `verifikasi_text` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`verifikasi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `t_verifikasi` */

insert  into `t_verifikasi`(`verifikasi_id`,`verifikasi_image`,`verifikasi_text`) values (1,'cimg1.jpg','hogic'),(2,'cimg2.jpg','lings'),(3,'cimg3.jpg','poggesmsc'),(4,'cimg4.jpg','sesses'),(5,'cimg5.jpg','bedrowshes'),(6,'cimg6.jpg','elatofti'),(7,'cimg7.jpg','bilbedwar'),(8,'cimg8.jpg','droco'),(9,'cimg9.jpg','milina'),(10,'cimg10.jpg','swooflo'),(11,'cimg11.jpg','untsa'),(12,'cimg12.jpg','fugestoisa'),(13,'cimg13.jpg','spres'),(14,'cimg14.jpg','ovelypi'),(15,'cimg15.jpg','simpuderac'),(16,'cimg16.jpg','makeep'),(17,'cimg17.jpg','dosoa'),(18,'cimg18.jpg','imperilit'),(19,'cimg19.jpg','compha'),(20,'cimg20.jpg','wombinfa'),(21,'cimg21.jpg','peredskin'),(22,'cimg22.jpg','buteristo'),(23,'cimg23.jpg','assephapsi'),(24,'cimg24.jpg','terstints'),(25,'cimg25.jpg','mullymo'),(26,'cimg26.jpg','cryou'),(27,'cimg27.jpg','uncyarcor'),(28,'cimg28.jpg','blegohea'),(29,'cimg29.jpg','dotedee'),(30,'cimg30.jpg','pliterigma'),(31,'cimg31.jpg','comat'),(32,'cimg32.jpg','slytommi'),(33,'cimg33.jpg','cintes'),(34,'cimg34.jpg','gesesse'),(35,'cimg35.jpg','urnikesso'),(36,'cimg36.jpg','sphip'),(37,'cimg37.jpg','fught'),(38,'cimg38.jpg','dionesse'),(39,'cimg39.jpg','ancome'),(40,'cimg40.jpg','messlepi'),(41,'cimg41.jpg','fanarksma'),(42,'cimg42.jpg','foinesa'),(43,'cimg43.jpg','ovbca'),(44,'cimg44.jpg','herti'),(45,'cimg45.jpg','respol'),(46,'cimg46.jpg','bonsiting'),(47,'cimg47.jpg','excespite'),(48,'cimg48.jpg','glundis'),(49,'cimg49.jpg','sibin'),(50,'cimg50.jpg','berments'),(51,'cimg51.jpg','tvvinsh'),(52,'cimg52.jpg','hoont'),(53,'cimg53.jpg','regtya'),(54,'cimg54.jpg','ilead'),(55,'cimg55.jpg','rundle'),(56,'cimg56.jpg','symetro'),(57,'cimg57.jpg','materio'),(58,'cimg58.jpg','preduc'),(59,'cimg59.jpg','winglist'),(60,'cimg60.jpg','tater'),(61,'cimg61.jpg','sciallo'),(62,'cimg62.jpg','thyri'),(63,'cimg63.jpg','decker'),(64,'cimg64.jpg','bogar'),(65,'cimg65.jpg','asylantise'),(66,'cimg66.jpg','blessifi'),(67,'cimg67.jpg','bundesse'),(68,'cimg68.jpg','crecomela'),(69,'cimg69.jpg','calize'),(70,'cimg70.jpg','walpin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
