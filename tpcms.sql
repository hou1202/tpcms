# Host: localhost  (Version: 5.7.17)
# Date: 2018-11-09 18:32:36
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "adminer"
#

DROP TABLE IF EXISTS `adminer`;
CREATE TABLE `adminer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL DEFAULT '' COMMENT '帐号',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `name` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态：1=》正常；0=》禁用',
  `permissions_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '权限组ID',
  `is_admin` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否是超级管理员：1=》是；0=》非',
  `remark` text COMMENT '备注说明',
  `last_ip` varchar(255) DEFAULT NULL COMMENT '最后登录IP地址',
  `last_at` int(10) unsigned DEFAULT NULL COMMENT '最后登录时间（时间戳）',
  `count` int(11) unsigned DEFAULT '0' COMMENT '登录总次数',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `adminer_key` (`id`,`account`,`permissions_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='管理员表';

#
# Data for table "adminer"
#

INSERT INTO `adminer` VALUES (1,'admin','96e79218965eb72c92a549dd5a330112','admin',1,1,1,'admin',NULL,NULL,0,'2018-10-23 13:54:17'),(2,'guest','96e79218965eb72c92a549dd5a330112','guest',0,1,0,'guest',NULL,NULL,0,'2018-10-23 15:16:25');

#
# Structure for table "permissions"
#

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '权限组名称',
  `router_id` text COMMENT '权限组权限集',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态，1=》正常；0=》禁用',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='权限组表';

#
# Data for table "permissions"
#

INSERT INTO `permissions` VALUES (1,'超级管理员','1-2-3-4-5-6-7-8-9-10-11-12-13-14-15-16-17',1,'2018-11-06 16:15:51'),(2,'GUEST','2-3-4-5-7-8-18',1,'2018-11-07 16:04:06');

#
# Structure for table "router"
#

DROP TABLE IF EXISTS `router`;
CREATE TABLE `router` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `router` varchar(255) DEFAULT NULL COMMENT '系统路由',
  `menu` varchar(255) DEFAULT NULL COMMENT '菜单路由',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(255) DEFAULT NULL COMMENT 'icon图标',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级路由ID（一根目录路由为0）',
  `open` tinyint(3) unsigned DEFAULT '0' COMMENT '是否展开；默认为1=>true【展开】，0=>false【不展开】',
  `main` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为主目录：0【非】，1【是】',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '路由状态;0=>禁用；1=>启用',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `router_key` (`id`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='路由规则表';

#
# Data for table "router"
#

INSERT INTO `router` VALUES (1,'/','/','控制面板','#xe679;',0,0,1,1,'2018-10-26 14:44:54'),(2,'','','系统设置','#xe66a;',0,1,1,1,'2018-10-26 16:57:59'),(3,'/adminer','/adminer','管理员设置','#xe653;',2,0,1,1,'2018-10-26 16:59:16'),(4,'/adminer/data','/adminer/data','管理员列表','',3,0,0,1,'2018-10-26 17:02:06'),(5,'/adminer/create','/adminer/create','新增管理员','',3,0,0,1,'2018-10-26 17:03:30'),(6,'/adminer','/adminer','保存管理员','',3,0,0,1,'2018-10-26 17:04:09'),(7,'/adminer/:id','/adminer/*','编辑管理员','',3,0,0,1,'2018-10-26 17:05:38'),(8,'/adminer/:id','/adminer/*','更新管理员','',3,0,0,1,'2018-10-26 17:06:30'),(9,'/adminer/:id','/adminer/*','删除管理员','',3,0,0,1,'2018-10-26 17:07:14'),(10,'/router','/router','路由设置','#xe653;',2,0,1,1,'2018-10-30 10:41:29'),(11,'/router/data','/router/data','路由列表','',10,0,0,1,'2018-10-30 10:44:59'),(12,'/router/create','/router/create','新增路由','',10,0,0,1,'2018-10-30 10:47:36'),(13,'/router','/router','保存路由','',10,0,0,1,'2018-11-05 11:00:01'),(14,'/router/edit/:id','/router/edit/*','编辑路由','',10,0,0,1,'2018-11-05 11:44:50'),(15,'/router/:id','/router/*','更新路由','',10,0,0,1,'2018-11-05 11:47:04'),(16,'/router/:id','/router/*','删除路由','',10,0,0,1,'2018-11-05 11:47:34'),(17,'/permission','/permission','权限设置','#xe653;',2,0,1,1,'2018-11-05 15:03:03'),(18,'/adminer/status','/adminer/status','管理员状态','',3,0,0,1,'2018-11-07 09:12:01'),(19,'/router/status','/router/status','路由状态','',10,0,0,1,'2018-11-07 09:12:35'),(20,'/permission_data','/permission_data','权限组列表','',17,0,0,1,'2018-11-07 09:14:05'),(21,'/permission_status','/permission_status','权限组状态','',17,0,0,1,'2018-11-07 09:15:14'),(22,'/permission/create','/permission/create','新增权限组','',17,0,0,1,'2018-11-07 09:15:50'),(23,'/permission','/permission','保存权限组','',17,0,0,1,'2018-11-07 09:16:24'),(24,'/permission/edit/:id','/permission/edit/*','编辑权限组','',17,0,0,1,'2018-11-07 09:16:52'),(25,'/permission/:id','/permission/*','更新权限组','',17,0,0,1,'2018-11-07 09:17:36'),(26,'/permission/:id','/permission/*','删除权限组','',17,0,0,1,'2018-11-07 09:18:20'),(27,'/router/:id','/router/*','查看路由','',10,0,0,1,'2018-11-08 10:48:00'),(28,'/adminer/:id','/adminer/*','查看管理员','',3,0,0,1,'2018-11-09 14:07:38');

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'Libai','96e79218965eb72c92a549dd5a330112','18297905432',NULL,'2018-10-10 15:08:34'),(2,'Wangwei','96e79218965eb72c92a549dd5a330112','13564078415',NULL,'2018-10-10 15:08:55'),(3,'Dufu','96e79218965eb72c92a549dd5a330112','17333007330',NULL,'2018-10-10 15:09:11');
