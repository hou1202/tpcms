# Host: localhost  (Version: 5.7.17)
# Date: 2018-11-06 17:59:37
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='管理员表';

#
# Data for table "adminer"
#

INSERT INTO `adminer` VALUES (1,'admin','96e79218965eb72c92a549dd5a330112','admin',1,1,1,'admin',NULL,NULL,0,'2018-10-23 13:54:17'),(2,'guest','96e79218965eb72c92a549dd5a330112','guest',0,1,0,'guest',NULL,NULL,0,'2018-10-23 15:16:25'),(3,'tests','96e79218965eb72c92a549dd5a330112','test',0,5,0,'',NULL,NULL,0,'2018-10-25 11:47:56'),(4,'test2','96e79218965eb72c92a549dd5a330112','test2',0,5,0,'000000',NULL,NULL,0,'2018-10-25 13:17:47'),(5,'test3','96e79218965eb72c92a549dd5a330112','test',0,5,0,'',NULL,NULL,0,'2018-10-25 17:31:36'),(6,'test4','96e79218965eb72c92a549dd5a330112','test',0,5,0,'',NULL,NULL,0,'2018-10-25 17:32:44'),(7,'test5','96e79218965eb72c92a549dd5a330112','test',0,5,0,'',NULL,NULL,0,'2018-10-25 17:33:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='权限组表';

#
# Data for table "permissions"
#

INSERT INTO `permissions` VALUES (1,'超级管理员','1-2-3-4-5-6-7-8-9-10-11-12-13-14-15-16-17',1,'2018-11-06 16:15:51');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='路由规则表';

#
# Data for table "router"
#

INSERT INTO `router` VALUES (1,'/','/','控制面板','#xe679;',0,0,1,1,'2018-10-26 14:44:54'),(2,'','','系统设置','#xe66a;',0,1,1,1,'2018-10-26 16:57:59'),(3,'/adminer','/adminer','管理员设置','#xe653;',2,0,1,1,'2018-10-26 16:59:16'),(4,'/adminer_data','/adminer_data','管理员列表','',3,0,0,1,'2018-10-26 17:02:06'),(5,'/adminer_create','/adminer_create','新增管理员','',3,0,0,1,'2018-10-26 17:03:30'),(6,'/adiner_store','/adiner_store','保存管理员','',3,0,0,1,'2018-10-26 17:04:09'),(7,'/adminer_edit','/adminer_edit','编辑管理员','',3,0,0,1,'2018-10-26 17:05:38'),(8,'/adminer_update','/adminer_update','更新管理员','',3,0,0,1,'2018-10-26 17:06:30'),(9,'/adminer_del','/adminer_del','删除管理员','',3,0,0,1,'2018-10-26 17:07:14'),(10,'/router','/router','路由设置','#xe653;',2,0,1,1,'2018-10-30 10:41:29'),(11,'/router_data','/router_data','路由列表','',10,0,0,1,'2018-10-30 10:44:59'),(12,'/router_create','/router_create','新增路由','',10,0,0,1,'2018-10-30 10:47:36'),(13,'/router_store','/router_store','保存路由','',10,0,0,1,'2018-11-05 11:00:01'),(14,'/router_edit/:id','/router_edit/*','编辑路由','',10,0,0,1,'2018-11-05 11:44:50'),(15,'/router_update/:id','/router_update/*','更新路由','',10,0,0,1,'2018-11-05 11:47:04'),(16,'/router_del/:id','/router_del/*','删除路由','',10,0,0,1,'2018-11-05 11:47:34'),(17,'/permission','/permission','权限设置','#xe653;',2,0,1,1,'2018-11-05 15:03:03');

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
