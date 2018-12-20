# Host: localhost  (Version: 5.7.17)
# Date: 2018-12-20 18:23:47
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "address"
#

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '收货人电话',
  `city` varchar(255) NOT NULL DEFAULT '' COMMENT '城市',
  `street` varchar(255) NOT NULL DEFAULT '' COMMENT '街道地址',
  `choice` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为默认地址：1=》是；0=》否',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收货地址表';

#
# Data for table "address"
#


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员表';

#
# Data for table "adminer"
#

INSERT INTO `adminer` VALUES (1,'admin','96e79218965eb72c92a549dd5a330112','Amdin',1,1,1,'admin12sdf','127.0.0.1',1545297396,26,'2018-10-23 13:54:17'),(2,'guest','96e79218965eb72c92a549dd5a330112','guest',1,2,0,'guest','127.0.0.1',1542962077,7,'2018-10-23 15:16:25'),(3,'tests','96e79218965eb72c92a549dd5a330112','Test',1,2,0,'TEST',NULL,NULL,0,'2018-11-14 13:13:10'),(4,'test123','96e79218965eb72c92a549dd5a330112','TEST',1,1,0,'TEST',NULL,NULL,0,'2018-11-23 13:53:09');

#
# Structure for table "banner"
#

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT '广告图',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型：1=》无链接；2=》产品链接；3=》分类链接；4=》外部链接',
  `url` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告图';

#
# Data for table "banner"
#


#
# Structure for table "car"
#

DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '产品ID',
  `spec_id` int(11) NOT NULL DEFAULT '0' COMMENT '产品规格ID',
  `num` int(11) NOT NULL DEFAULT '1' COMMENT '购物产品数量',
  `isbuy` int(10) DEFAULT NULL COMMENT '是否购买，若购买则为下单时间戳',
  `isdelete` int(10) DEFAULT NULL COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车表';

#
# Data for table "car"
#


#
# Structure for table "classify"
#

DROP TABLE IF EXISTS `classify`;
CREATE TABLE `classify` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '分类标题',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT '分类缩略图',
  `p_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID（一级分类父级ID为0）',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品分类';

#
# Data for table "classify"
#


#
# Structure for table "collect"
#

DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '收藏状态：0=》正常；1=》删除',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `collect` (`user_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='我的收藏';

#
# Data for table "collect"
#


#
# Structure for table "comment"
#

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `content` text COMMENT '评论内容',
  `img` text COMMENT '评论图片（多图拼接）',
  `laud` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间（时间戳）',
  PRIMARY KEY (`id`),
  KEY `comment` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品评论表';

#
# Data for table "comment"
#


#
# Structure for table "config"
#

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '参数标题',
  `param` varchar(255) DEFAULT NULL COMMENT '参数值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='参数配置表';

#
# Data for table "config"
#

INSERT INTO `config` VALUES (1,'平台标识','AOZOM后台管理系统'),(2,'应用名称','AOZOM 2.0');

#
# Structure for table "coupon"
#

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '优惠券类型：1=》全场通用；2=》指定产品；3=》指定分类',
  `relation_title` varchar(255) NOT NULL DEFAULT '全场通用' COMMENT '关联标题',
  `relation_id` int(11) unsigned DEFAULT NULL COMMENT '关联ID',
  `money_satisfy` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '优惠券满足金额；为0则没有使用条件',
  `money_derate` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '优惠券减免金额',
  `end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有效结束时间；为0则无结束限制',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态：0=》未发放；1=》已发放',
  `isdelete` int(10) unsigned DEFAULT NULL COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠券';

#
# Data for table "coupon"
#


#
# Structure for table "coupon_user"
#

DROP TABLE IF EXISTS `coupon_user`;
CREATE TABLE `coupon_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `coupon_id` int(11) unsigned DEFAULT NULL COMMENT '优惠券ID',
  `order_id` int(11) unsigned DEFAULT NULL COMMENT '订单ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '优惠券使用状态：0/未记录=》未使用；1=》下单使用中；2=》完成使用',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `coupon_user` (`user_id`,`coupon_id`,`order_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户优惠券表';

#
# Data for table "coupon_user"
#


#
# Structure for table "goods"
#

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '产品标题',
  `info` varchar(255) DEFAULT NULL COMMENT '副标题',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `banner` text COMMENT '轮播图；多图拼接，分割符 -',
  `origin_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '原价',
  `sell_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '售价',
  `cost_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '成本价',
  `franking` float(6,2) DEFAULT NULL COMMENT '邮费：为空则为免邮费',
  `volume` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '销量',
  `address` varchar(255) DEFAULT NULL COMMENT '发货地',
  `content` text COMMENT '图文详情',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '产品状态：1=》上架；0=》下架',
  `isdelete` int(10) DEFAULT NULL COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品表';

#
# Data for table "goods"
#


#
# Structure for table "goods_param"
#

DROP TABLE IF EXISTS `goods_param`;
CREATE TABLE `goods_param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `p_key` varchar(255) DEFAULT NULL COMMENT '参数标题',
  `p_value` varchar(255) DEFAULT NULL COMMENT '参数值',
  PRIMARY KEY (`id`),
  KEY `goods_param` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品参数表';

#
# Data for table "goods_param"
#


#
# Structure for table "goods_spec"
#

DROP TABLE IF EXISTS `goods_spec`;
CREATE TABLE `goods_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `name` varchar(255) DEFAULT NULL COMMENT '规格名称',
  `price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '产品价格',
  `stock` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '产品库存',
  `isdelete` int(10) unsigned DEFAULT NULL COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品规格表';

#
# Data for table "goods_spec"
#


#
# Structure for table "laud"
#

DROP TABLE IF EXISTS `laud`;
CREATE TABLE `laud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '点赞用户ID',
  `comment_id` int(11) unsigned DEFAULT NULL COMMENT '评论ID',
  PRIMARY KEY (`id`),
  KEY `laud` (`user_id`,`comment_id`),
  KEY `laud_user` (`user_id`,`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论点赞用户表';

#
# Data for table "laud"
#


#
# Structure for table "log_integral"
#

DROP TABLE IF EXISTS `log_integral`;
CREATE TABLE `log_integral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `title` varchar(255) DEFAULT NULL COMMENT '记录标题',
  `integral` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '记录积分数量',
  `type` char(1) DEFAULT NULL COMMENT '记录类型：+=》增加；-=》减少',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间（时间戳）',
  PRIMARY KEY (`id`),
  KEY `integral_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分记录';

#
# Data for table "log_integral"
#


#
# Structure for table "log_money"
#

DROP TABLE IF EXISTS `log_money`;
CREATE TABLE `log_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `title` varchar(255) DEFAULT NULL COMMENT '记录标题',
  `money` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '记录金额',
  `type` char(1) NOT NULL DEFAULT '+' COMMENT '记录类型：+=》增加；-=》减少',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间（时间戳）',
  PRIMARY KEY (`id`),
  KEY `money_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资金记录';

#
# Data for table "log_money"
#


#
# Structure for table "order"
#

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

#
# Data for table "order"
#


#
# Structure for table "order_goods"
#

DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned DEFAULT NULL COMMENT '订单ID',
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `goods_spec_id` int(11) unsigned DEFAULT NULL COMMENT '产品规格ID',
  `classify_id` int(11) unsigned DEFAULT NULL COMMENT '产品分类ID',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT '产品缩略图',
  `title` varchar(255) DEFAULT NULL COMMENT '产品标题',
  `name` varchar(255) DEFAULT NULL COMMENT '产品规格名称',
  `price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '产品价格',
  `num` mediumint(8) unsigned NOT NULL DEFAULT '1' COMMENT '购买产品数量',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_goods` (`order_id`,`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单产品';

#
# Data for table "order_goods"
#


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
  PRIMARY KEY (`id`),
  KEY `permission-index` (`id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='权限组表';

#
# Data for table "permissions"
#

INSERT INTO `permissions` VALUES (1,'超级管理员组','1-29-30-31-2-3-4-5-6-7-8-9-18-28-10-11-12-13-14-15-16-19-27-17-20-21-22-23-24-25-26-32',1,'2018-11-06 16:15:51'),(2,'GUEST','1-29-30-31-2-3-4-6-7-8-28-33-34-35-36',1,'2018-11-07 16:04:06');

#
# Structure for table "recom"
#

DROP TABLE IF EXISTS `recom`;
CREATE TABLE `recom` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '推荐标题',
  `info` varchar(255) NOT NULL DEFAULT '' COMMENT '推荐信息',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '推荐图',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态：0=》关闭；1=》开启',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品推荐表';

#
# Data for table "recom"
#


#
# Structure for table "router"
#

DROP TABLE IF EXISTS `router`;
CREATE TABLE `router` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `router` varchar(255) DEFAULT NULL COMMENT '系统路由',
  `menu` varchar(255) DEFAULT NULL COMMENT '菜单路由',
  `path` varchar(255) DEFAULT NULL COMMENT '系统控制器/方法 路径',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(255) DEFAULT NULL COMMENT 'icon图标',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级路由ID（一根目录路由为0）',
  `open` tinyint(3) unsigned DEFAULT '0' COMMENT '是否展开；默认为1=>true【展开】，0=>false【不展开】',
  `main` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为主目录：0【非】，1【是】',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '路由状态;0=>禁用；1=>启用',
  `opts` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为配置项路由：1=>是；0=>否',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `router_key` (`id`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='路由规则表';

#
# Data for table "router"
#

INSERT INTO `router` VALUES (1,'/aoogi/main','/','','控制面板','#xe679;',0,0,1,1,1,'2018-10-26 14:44:54'),(2,'','','','系统设置','#xe66a;',0,0,1,1,1,'2018-10-26 16:57:59'),(3,'/aoogi/adminer','/aoogi/adminer','admin/admin/index','管理员设置','#xe653;',2,0,1,1,1,'2018-10-26 16:59:16'),(4,'/aoogi/adminer/data','/aoogi/adminer/data','admin/admin/getData','管理员列表','',3,0,0,1,0,'2018-10-26 17:02:06'),(5,'/aoogi/adminer/create','/aoogi/adminer/create','admin/admin/create','新增管理员','',3,0,0,1,1,'2018-10-26 17:03:30'),(6,'/aoogi/adminer','/aoogi/adminer/save','admin/admin/save','保存管理员','',3,0,0,1,0,'2018-10-26 17:04:09'),(7,'/aoogi/adminer/edit/:id','/aoogi/adminer/edit/*','admin/admin/edit','编辑管理员','',3,0,0,1,1,'2018-10-26 17:05:38'),(8,'/aoogi/adminer/:id','/aoogi/adminer/update/*','admin/admin/update','更新管理员','',3,0,0,1,0,'2018-10-26 17:06:30'),(9,'/aoogi/adminer/:id','/aoogi/adminer/del/*','admin/admin/delete','删除管理员','',3,0,0,1,1,'2018-10-26 17:07:14'),(10,'/aoogi/router','/aoogi/router','admin/router/index','路由设置','#xe653;',2,0,1,1,1,'2018-10-30 10:41:29'),(11,'/aoogi/router/data','/aoogi/router/data','admin/router/getData','路由列表','',10,0,0,1,0,'2018-10-30 10:44:59'),(12,'/aoogi/router/create','/aoogi/router/create','admin/router/create','新增路由','',10,0,0,1,1,'2018-10-30 10:47:36'),(13,'/aoogi/router','/aoogi/router/save','admin/router/save','保存路由','',10,0,0,1,0,'2018-11-05 11:00:01'),(14,'/aoogi/router/edit/:id','/aoogi/router/edit/*','admin/router/edit','编辑路由','',10,0,0,1,1,'2018-11-05 11:44:50'),(15,'/aoogi/router/:id','/aoogi/router/update/*','admin/router/update','更新路由','',10,0,0,1,0,'2018-11-05 11:47:04'),(16,'/aoogi/router/:id','/aoogi/router/del/*','admin/router/delete','删除路由','',10,0,0,1,0,'2018-11-05 11:47:34'),(17,'/aoogi/permission','/aoogi/permission','admin/permission/index','权限设置','#xe653;',2,0,1,1,1,'2018-11-05 15:03:03'),(18,'/aoogi/adminer/status','/aoogi/adminer/status','admin/admin/setStatus','管理员状态','',3,0,0,1,0,'2018-11-07 09:12:01'),(19,'/aoogi/router/status','/aoogi/router/status','admin/router/setStatus','路由状态','',10,0,0,1,0,'2018-11-07 09:12:35'),(20,'/aoogi/permission/data','/aoogi/permission/data','admin/permission/getData','权限组列表','',17,0,0,1,0,'2018-11-07 09:14:05'),(21,'/aoogi/permission/status','/aoogi/permission/status','admin/permission/setStatus','权限组状态','',17,0,0,1,0,'2018-11-07 09:15:14'),(22,'/aoogi/permission/create','/aoogi/permission/create','admin/permission/create','新增权限组','',17,0,0,1,1,'2018-11-07 09:15:50'),(23,'/aoogi/permission','/aoogi/permission/save','admin/permission/save','保存权限组','',17,0,0,1,0,'2018-11-07 09:16:24'),(24,'/aoogi/permission/edit/:id','/aoogi/permission/edit/*','admin/permission/edit','编辑权限组','',17,0,0,1,1,'2018-11-07 09:16:52'),(25,'/aoogi/permission/:id','/aoogi/permission/update*','admin/permission/update','更新权限组','',17,0,0,1,0,'2018-11-07 09:17:36'),(26,'/aoogi/permission/:id','/aoogi/permission/del/*','admin/permission/delete','删除权限组','',17,0,0,1,0,'2018-11-07 09:18:20'),(27,'/aoogi/router/:id','/aoogi/router/read/*','admin/router/read','查看路由','',10,0,0,1,1,'2018-11-08 10:48:00'),(28,'/aoogi/adminer/:id','/aoogi/adminer/read/*','admin/admin/read','查看管理员','',3,0,0,1,1,'2018-11-09 14:07:38'),(29,'/aoogi/logout','/aoogi/logout','admin/home/logout','退出登录','',1,0,0,1,1,'2018-11-12 14:00:40'),(30,'/aoogi/error','/aoogi/error','admin/error/index','403错误','',1,0,0,1,1,'2018-11-13 14:07:32'),(31,'/aoogi/main','/','admin/home/main','主页','',1,0,0,1,1,'2018-11-15 12:02:01'),(32,'/aoogi/permission/:id','/aoogi/permission/read/*','admin/permission/read','查看权限组','',17,0,0,1,1,'2018-11-15 15:19:31'),(33,'/aoogi/config','/aoogi/config','admin/config/index','参数设置','#xe653;',2,0,1,1,1,'2018-11-15 16:35:12'),(34,'/aoogi/config/create','/aoogi/config/create','admin/config/create','新增参数','',33,0,0,1,1,'2018-11-15 16:44:30'),(35,'/aoogi/config','/aoogi/config/save','admin/config/save','保存参数','',33,0,0,1,0,'2018-11-15 17:05:08'),(36,'/aoogi/config/edit/:id','/aoogi/config/edit/*','admin/config/edit','编辑参数','',33,0,0,1,1,'2018-11-15 17:09:08'),(37,'/aoogi/config/:id','/aoogi/config/update/*','admin/config/update','更新参数','',33,0,0,1,0,'2018-11-16 10:34:21'),(38,'/aoogi/admin/*','/aoogi/admin/del/*','admin/config/delete','删除参数','',33,0,0,1,0,'2018-11-23 11:51:30'),(39,'','','','用户管理','#xe66a;',0,0,1,1,1,'2018-12-18 13:15:40'),(40,'/aoogi/user','/aoogi/user','admin/user/index','用户列表','#xe653;',39,0,1,1,1,'2018-12-18 13:17:55'),(41,'','','','产品管理','#xe66a;',0,0,1,1,1,'2018-12-18 13:20:09'),(42,'/aoogi/goods','/aoogi/goods','admin/goods/index','产品列表','#xe653;',41,0,1,1,1,'2018-12-18 13:21:47'),(43,'/aoogi/goods/data','/aoogi/goods/data','admin/goods/getData','产品数据','',42,0,0,1,1,'2018-12-18 13:24:18'),(44,'/aoogi/goods/create','/aoogi/goods/create','admin/goods/create','新增产品','',42,0,0,1,1,'2018-12-18 13:25:31'),(45,'/aoogi/goods/edit/:id','/aoogi/goods/edit/*','admin/goods/edit','编辑产品','',42,0,0,1,1,'2018-12-18 13:27:01'),(46,'/aoogi/goods/:id','/aoogi/goods/update/*','admin/goods/update','更新产品','',42,0,0,1,0,'2018-12-18 13:29:30'),(47,'/aoogi/goods','/aoogi/goods/save','admin/goods/save','保存产品','',42,0,0,1,0,'2018-12-18 13:30:39'),(48,'/aoogi/goods/:id','/aoogi/goods/del/*','admin/goods/delete','删除产品','',42,0,0,1,0,'2018-12-18 13:32:56'),(49,'/aoogi/goods/:id','/aoogi/goods/read/*','admin/goods/read','查看产品','',42,0,0,1,1,'2018-12-18 13:34:19');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '昵称',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '帐户密码',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号码',
  `portrait` varchar(255) DEFAULT NULL COMMENT '头像',
  `balance` float(8,2) unsigned DEFAULT '0.00' COMMENT '帐户余额',
  `sex` tinyint(1) unsigned DEFAULT '0' COMMENT '性别：1=》男；0=》女',
  `birthday` varchar(10) DEFAULT NULL COMMENT '生日',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '帐户状态：1=》正常；0=》禁用',
  `isdelete` int(10) DEFAULT NULL COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'Libai','96e79218965eb72c92a549dd5a330112','18297905432',NULL,0.00,1,NULL,1,NULL,'2018-10-10 15:08:34','2018-12-18 10:21:59'),(2,'Wangwei','96e79218965eb72c92a549dd5a330112','13564078415',NULL,0.00,1,NULL,1,NULL,'2018-10-10 15:08:55','2018-12-17 18:05:49'),(3,'Dufu','96e79218965eb72c92a549dd5a330112','17333007330',NULL,0.00,0,NULL,0,NULL,'2018-10-10 15:09:11',NULL),(4,'用户1733','25f9e794323b453885f5181f1b624d0b','13564078419','/static/index/images/default-head-1.png',0.00,1,NULL,1,NULL,'2018-12-16 18:29:53',NULL),(5,'用户7006','96e79218965eb72c92a549dd5a330112','13564078416','/static/index/images/default-head-0.png',0.00,0,NULL,0,NULL,'2018-12-17 14:00:49','2018-12-17 15:52:18'),(6,'用户7088','96e79218965eb72c92a549dd5a330112','13564078418','/static/index/images/default-head-1.png',0.00,1,NULL,1,NULL,'2018-12-17 14:02:38',NULL);

#
# Structure for table "verify"
#

DROP TABLE IF EXISTS `verify`;
CREATE TABLE `verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '发送手机号码',
  `code` varchar(11) NOT NULL DEFAULT '' COMMENT '验证码',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型：1=》注册；2=》修改密码',
  `ip` varchar(15) DEFAULT NULL COMMENT '获取验证码用户IP',
  `use_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '使用时间',
  `over_time` int(11) unsigned NOT NULL DEFAULT '300' COMMENT '过期时间，单 秒 ；默认时间 300秒',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='验证短信表';

#
# Data for table "verify"
#

INSERT INTO `verify` VALUES (1,'18297315431','230351',1,'127.0.0.1',NULL,4000,'2018-12-17 13:09:20'),(2,'18297315431','653572',1,'127.0.0.1',NULL,4000,'2018-12-17 13:46:05'),(3,'18297315431','745018',1,'127.0.0.1',NULL,3000,'2018-12-17 13:57:20'),(4,'13564078415','245074',1,'127.0.0.1',NULL,3000,'2018-12-17 18:04:37'),(5,'13564078415','137861',2,'127.0.0.1','2018-12-17 18:05:49',3000,'2018-12-17 18:05:33');
