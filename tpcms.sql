# Host: localhost  (Version: 5.7.17)
# Date: 2019-01-26 18:00:18
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='收货地址表';

#
# Data for table "address"
#

INSERT INTO `address` VALUES (1,2,'李零散','13564078415','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦',0,'2019-01-04 17:13:33'),(2,2,'王自动','18254745856','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦1202',1,'2019-01-04 17:16:10'),(3,2,'方村村','17333007330','北京市 . 市辖区 . 东城区','紫云路艺术团虽',0,'2019-01-04 17:18:06'),(5,5,'发生分','18654874153','北京市 . 市辖区 . 东城区','阿法违法违规发文稿',0,'2019-01-04 17:21:11'),(7,5,'爱上凤','13564521587','北京市 . 市辖区 . 东城区','啊啊发违法哇而非',0,'2019-01-04 17:27:36'),(8,5,'的身份','13568547896','北京市 . 市辖区 . 东城区','违法威风威风',1,'2019-01-04 17:28:32'),(9,2,'爽肤水的','15245874568','北京市 . 市辖区 . 东城区','阿法违法gear覆盖',0,'2019-01-04 18:12:37');

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

INSERT INTO `adminer` VALUES (1,'admin','96e79218965eb72c92a549dd5a330112','Amdin',1,1,1,'admin12sdf','127.0.0.1',1548464505,43,'2018-10-23 13:54:17'),(2,'guest','96e79218965eb72c92a549dd5a330112','guest',0,2,0,'guest','127.0.0.1',1542962077,7,'2018-10-23 15:16:25'),(3,'tests','96e79218965eb72c92a549dd5a330112','Test',0,2,0,'TEST',NULL,NULL,0,'2018-11-14 13:13:10'),(4,'test123','96e79218965eb72c92a549dd5a330112','TEST',0,1,0,'TEST',NULL,NULL,0,'2018-11-23 13:53:09');

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
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `classify_id` int(11) unsigned DEFAULT NULL COMMENT '分类ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态：1=》开启；0=》关闭',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='广告图';

#
# Data for table "banner"
#

INSERT INTO `banner` VALUES (1,'圣诞派对','/uploads/20181224/5c20e8f5c3a0f.jpg',2,'',5,NULL,1,'2018-12-24 22:11:03'),(2,'元旦派对','/uploads/20181224/5c20e90cda5c0.jpg',3,'',NULL,1,1,'2018-12-24 22:11:26'),(3,'春节派对','/uploads/20181224/5c20eadc5e4dd.jpg',4,'http://www.baidu.com',NULL,NULL,1,'2018-12-24 22:19:09'),(4,'元宵派对','/uploads/20181224/5c20eae9aee9a.jpg',1,'',NULL,NULL,1,'2018-12-24 22:19:23');

#
# Structure for table "car"
#

DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `goods_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '产品ID',
  `spec_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '产品规格ID',
  `num` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '购物产品数量',
  `isbuy` int(10) NOT NULL DEFAULT '0' COMMENT '是否购买，若购买则为下单时间戳',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `car` (`user_id`,`goods_id`,`spec_id`,`isbuy`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='购物车表';

#
# Data for table "car"
#

INSERT INTO `car` VALUES (1,2,1,1,4,0,1546774470,'2018-12-26 16:08:07'),(2,2,1,2,3,0,1546695807,'2018-12-26 16:08:12'),(4,2,2,9,50,0,1546700455,'2018-12-26 17:23:51'),(5,2,26,95,1,0,1547623848,'2019-01-06 19:32:55'),(6,2,22,83,2,0,1546774470,'2019-01-06 19:33:07'),(7,2,1,1,5,0,1547631188,'2019-01-06 19:52:24'),(8,2,9,35,1,0,1547631188,'2019-01-06 20:45:44'),(9,2,11,40,1,0,1546779795,'2019-01-06 20:49:03'),(10,2,21,79,1,0,1546779795,'2019-01-06 20:51:06'),(11,2,5,19,1,0,1547631358,'2019-01-16 17:35:29'),(12,2,6,20,2,0,1547631358,'2019-01-16 17:35:42'),(13,2,4,16,1,0,1547716557,'2019-01-17 09:41:48'),(14,2,3,10,1,0,1547889462,'2019-01-19 16:51:52'),(15,2,6,20,1,0,1547888221,'2019-01-19 16:52:13'),(16,2,1,1,1,0,1548064103,'2019-01-19 17:43:40'),(17,2,6,20,1,0,1548064103,'2019-01-21 17:48:18'),(18,2,8,25,1,0,1548321604,'2019-01-24 17:19:51'),(19,2,11,42,1,0,1548321604,'2019-01-24 17:20:00'),(20,2,22,80,1,0,1548379884,'2019-01-25 09:31:19'),(21,2,22,80,1,0,1548383728,'2019-01-25 10:35:23'),(22,2,4,14,1,0,1548395497,'2019-01-25 11:02:48'),(23,2,4,15,1,0,0,'2019-01-25 11:02:51'),(24,2,4,16,1,0,1548385377,'2019-01-25 11:02:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='产品分类';

#
# Data for table "classify"
#

INSERT INTO `classify` VALUES (1,'手机PHONE','/uploads/20181224/5c20d98cbb96c.png',0,'2018-12-24 21:05:17'),(2,'平板PAD','/uploads/20181224/5c20d9ae8dc3f.png',0,'2018-12-24 21:05:51'),(3,'电脑BOOK','/uploads/20181224/5c20d9c6ec188.png',0,'2018-12-24 21:06:15'),(4,'配件PARTS','/uploads/20181224/5c20d9e5a44db.png',0,'2018-12-24 21:06:49'),(5,'APPLE iPhone','/uploads/20181224/5c20da35a1467.png',1,'2018-12-24 21:08:06'),(6,'Honor','/uploads/20181224/5c20da4ac35d0.png',1,'2018-12-24 21:08:28'),(7,'小米 MI','/uploads/20181224/5c20da5e523cb.png',1,'2018-12-24 21:08:47'),(8,'Vivo','/uploads/20181224/5c20da834bb78.png',1,'2018-12-24 21:09:24'),(9,'APPLE iPAD','/uploads/20181224/5c20da9e098b9.png',2,'2018-12-24 21:09:51'),(10,'Surface Pro','/uploads/20181224/5c20db1f43e79.png',2,'2018-12-24 21:12:00'),(11,'ThinkPad','/uploads/20181224/5c20db7b13856.png',3,'2018-12-24 21:13:32'),(12,'MacBook','/uploads/20181224/5c20dbefca407.png',3,'2018-12-24 21:15:29'),(13,'BEATS','/uploads/20181224/5c20dcf683d52.png',4,'2018-12-24 21:19:51');

#
# Structure for table "collect"
#

DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `collect` (`user_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='我的收藏';

#
# Data for table "collect"
#

INSERT INTO `collect` VALUES (10,2,2,'2018-12-26 13:52:04'),(19,2,1,'2019-01-05 10:01:20'),(22,2,21,'2019-01-05 10:06:59'),(23,2,24,'2019-01-05 10:07:06'),(26,2,4,'2019-01-05 21:28:24'),(27,2,6,'2019-01-05 21:28:30');

#
# Structure for table "comments"
#

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `order_id` int(11) unsigned DEFAULT NULL COMMENT '订单ID',
  `content` text COMMENT '评论内容',
  `img` text COMMENT '评论图片（多图拼接）',
  `laud` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `star` tinyint(3) unsigned NOT NULL DEFAULT '5' COMMENT '产品星级：1-2-3-4-5',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，删除则为时间戳',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间（时间戳）',
  PRIMARY KEY (`id`),
  KEY `comments` (`goods_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='产品评论表';

#
# Data for table "comments"
#

INSERT INTO `comments` VALUES (1,4,1,NULL,'我住长江头，君住长江尾。日日思君不见君，共饮长江水。 此水几时休，此恨何时已。只愿君心似我心，定不负相思意。','/uploads/20181224/5c20dd44da2e0.png-/uploads/20181224/5c20dd45d12da.png-/uploads/20181224/5c20dd44d1826.png-/uploads/20181224/5c20dd44cd197.png',17,5,0,1545344614),(2,5,1,NULL,'春归何处。寂寞无行路。若有人知春去处。唤取归来同住。 春无踪迹谁知。除非问取黄鹂。百啭无人能解，因风飞过蔷薇。','/uploads/20181224/5c20dd44da2e0.png-/uploads/20181224/5c20dd45d12da.png-/uploads/20181224/5c20dd44d1826.png-/uploads/20181224/5c20dd44cd197.png',10,5,0,1545548047),(3,6,1,NULL,'当年万里觅封侯，匹马戍梁州。关河梦断何处？尘暗旧貂裘。胡未灭，鬓先秋，泪空流。此生谁料，心在天山，身老沧洲。','/uploads/20181224/5c20dd44da2e0.png-/uploads/20181224/5c20dd45d12da.png-/uploads/20181224/5c20dd44d1826.png-/uploads/20181224/5c20dd44cd197.png',9,5,0,1545656454),(4,2,1,NULL,'大江东去，浪淘尽，千古风流人物。故垒西边，人道是，三国周郎赤壁。乱石穿空，惊涛拍岸，卷起千堆雪。',NULL,4,5,1545824216,1545656454),(9,2,12,10,'不得不说这个产品还是很不错的',NULL,0,4,0,1547883626),(10,2,4,3,'不得不说这个产品还是错不错哦的！！！','/uploads/20190119/5c42d4ca518b0.jpg-/uploads/20190119/5c42d4ca36ee8.jpg-/uploads/20190119/5c42d4c949bb0.jpg',0,4,0,1547883749),(11,2,3,3,'民族产品中的骄傲，要好好支持的啊','/uploads/20190119/5c42d4e4ed4e0.jpg-/uploads/20190119/5c42d4e3e4c28.jpg-/uploads/20190119/5c42d4e3e3c88.jpg',0,5,0,1547883749),(12,2,5,4,'我很喜欢这个产品，......','/uploads/20190119/5c42d6c9825f0.jpg',0,5,0,1547884234);

#
# Structure for table "config"
#

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '参数标题',
  `param` varchar(255) DEFAULT NULL COMMENT '参数值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='参数配置表';

#
# Data for table "config"
#

INSERT INTO `config` VALUES (1,'平台标识','AOZOM后台管理系统'),(2,'应用名称','AOZOM 2.0'),(3,'积分折算比率(%)','10'),(4,'支付宝APP_ID','2017090508565516'),(5,'支付宝PID','2088521367543235'),(6,'支付宝收款帐户','xiaojikeji@aliyun.com'),(7,'订单超时时间(h)','72');

#
# Structure for table "coupon"
#

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '优惠券标题',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '优惠券类型：1=》全场通用；2=》指定产品；3=》指定分类',
  `relation_title` varchar(255) NOT NULL DEFAULT '全场通用' COMMENT '关联标题',
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '关联产品ID',
  `classify_id` int(11) unsigned DEFAULT NULL COMMENT '关联分类ID',
  `money_satisfy` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠券满足金额；为0则没有使用条件',
  `money_derate` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠券减免金额',
  `end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有效结束时间；为0则已过期结束',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态：0=》未发放；1=》已发放',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='优惠券';

#
# Data for table "coupon"
#

INSERT INTO `coupon` VALUES (1,'新春狂欢大礼包',1,'全场通用',NULL,NULL,100.00,10.00,1551283200,1,0,'2019-01-04 14:49:21'),(2,'春节拜年礼，年年意意浓！',2,'华为 HUAWEI nova 3全面屏高清四摄游戏手机 6GB+128GB 亮黑色 全网通移动联通电信4G手机',22,NULL,200.00,30.00,1551024000,1,0,'2019-01-04 14:50:39'),(3,'辞岁迎新年，好意连绵延!',3,'APPLE iPhone',NULL,5,500.00,100.00,1551196800,1,0,'2019-01-04 14:51:59'),(4,'元宵提前过，我们来发货！',1,'全场通用',NULL,NULL,30.00,5.00,1550851200,1,0,'2019-01-04 14:52:39'),(5,'新年年货大礼包',1,'全场通用',NULL,NULL,500.00,100.00,1553961600,0,0,'2019-01-25 09:38:36');

#
# Structure for table "coupon_user"
#

DROP TABLE IF EXISTS `coupon_user`;
CREATE TABLE `coupon_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `coupon_id` int(11) unsigned DEFAULT NULL COMMENT '优惠券ID',
  `order_id` int(11) unsigned DEFAULT NULL COMMENT '订单ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '优惠券使用状态：0/未记录=》未使用；1=》下单使用中；2=》完成使用；3=》已过期',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `coupon_user` (`user_id`,`coupon_id`,`order_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户优惠券表';

#
# Data for table "coupon_user"
#

INSERT INTO `coupon_user` VALUES (1,2,3,NULL,1,0,'2019-01-07 13:58:12','2019-01-09 10:50:16'),(2,2,2,NULL,0,0,'2019-01-07 14:00:17','2019-01-07 16:25:04'),(3,2,4,NULL,3,0,'2019-01-07 14:00:24','2019-01-08 16:51:33'),(4,5,2,NULL,0,0,'2019-01-09 10:25:10',NULL),(5,5,3,NULL,0,0,'2019-01-09 10:25:12',NULL),(6,2,1,20,2,0,'2019-01-25 09:38:54','2019-01-25 10:58:55');

#
# Structure for table "goods"
#

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '产品标题',
  `info` varchar(255) DEFAULT NULL COMMENT '副标题',
  `classify_id` int(11) unsigned DEFAULT NULL COMMENT '产品分类ID',
  `classify_top` int(11) unsigned DEFAULT NULL COMMENT '所属一级分类ID',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `banner` text COMMENT '轮播图；多图拼接，分割符 -',
  `origin_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '原价',
  `sell_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '售价',
  `cost_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '成本价',
  `franking` float(6,2) DEFAULT NULL COMMENT '邮费：为空则为免邮费',
  `volume` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '销量',
  `address` varchar(255) DEFAULT NULL COMMENT '发货地',
  `content` text COMMENT '图文详情',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '产品状态：1=》上架；0=》下架',
  `recom` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否推',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='产品表';

#
# Data for table "goods"
#

INSERT INTO `goods` VALUES (1,'Apple iPhone X (A1865) 64GB 银色','Apple产品年末狂欢特惠，限时限量抢购，券后价6299元',5,1,'/uploads/20181224/5c20dd1259cd1.jpg','/uploads/20181224/5c20dd1ecd4d2.jpg-/uploads/20181224/5c20dd1ec614c.jpg-/uploads/20181224/5c20dd1ec1cf9.jpg-/uploads/20181224/5c20dd1ebdb2a.jpg',6499.00,6299.00,5500.00,10.00,532,'合肥','&lt;p&gt;\n\t&lt;img src=&quot;/uploads/20181224/5c20dd2ec7ae1.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd2eda5ad.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd2eea4a6.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd2f0607c.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd2f19ad6.jpg&quot; alt=&quot;&quot; /&gt; \n&lt;/p&gt;',1,1,0,'2018-12-20 22:38:38','2018-12-26 19:48:19'),(2,'华为HUAWEI Mate20 X 幻影银(6G+128G)','发现美丽的眼睛  这是深藏智慧的目光',5,1,'/uploads/20181224/5c20dd3ceca76.png','/uploads/20181224/5c20dd44da2e0.png-/uploads/20181224/5c20dd45d12da.png-/uploads/20181224/5c20dd44d1826.png-/uploads/20181224/5c20dd44cd197.png',5100.00,4899.00,4500.00,0.00,899,'合肥','&lt;p&gt;\n\t&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n\t我们都是好孩子 的\n&lt;/p&gt;\n&lt;p&gt;\n\t&lt;img src=&quot;/uploads/20181224/5c20dd57d2763.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd57ea444.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd58105eb.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd5820c13.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd583115e.png&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;',1,1,0,'2018-12-20 23:57:32','2019-01-02 14:15:47'),(3,'小米Mix3 黑色  全网通4G 全面屏拍照游戏智能手机','磁动力滑盖全面屏，前后旗舰 AI 双摄，四曲面彩色陶瓷机身，高效10W无线充电',5,1,'/uploads/20181224/5c20dd74829c8.jpg','/uploads/20181224/5c20dd7abe2da.jpg-/uploads/20181224/5c20dd7ab9975.jpg-/uploads/20181224/5c20dd7ab54f3.jpg',3400.00,3299.00,2800.00,0.00,562,'合肥','&gt;&lt;img src=&quot;/uploads/20181224/5c20dd870377b.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd871f549.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd872e5c8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd873e7c6.jpg&quot; alt=&quot;&quot; /&gt; \n&lt;/p&gt;',1,1,0,'2018-12-21 15:30:23','2019-01-02 14:15:48'),(4,'vivo X23 8GB+128GB 幻夜蓝 水滴屏全面屏 游戏手机 移动联通电信全网通4G手机','128G大内存！AI非凡摄影，超大广角，发现更多美！',8,1,'/uploads/20181224/5c20dd988d25f.jpg','/uploads/20181224/5c20dd9e583db.jpg-/uploads/20181224/5c20dd9e52154.jpg-/uploads/20181224/5c20dd9e4c8d6.jpg-/uploads/20181224/5c20dd9e4759a.jpg',3400.00,3198.00,2780.00,5.00,563,'合肥','&lt;img src=&quot;/uploads/20181224/5c2056ab87be0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2056ab97db0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2056aba9ec0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2056abb8920.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2056abc7f38.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda74c14a.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda75fab4.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda770178.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda77f8c0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda790ce3.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 11:51:45','2019-01-08 12:15:37'),(5,'Apple iPad Pro 11英寸平板电脑 2018年新款256G 全面屏/A12X芯片','A12X芯片、Retina全面屏、面容解锁、强力续航',5,2,'/uploads/20181224/5c20ddd9c7d79.jpg','/uploads/20181224/5c20dddfe83b4.jpg-/uploads/20181224/5c20dddfdeda3.jpg-/uploads/20181224/5c20dddfd903d.jpg-/uploads/20181224/5c20dddfd4ff6.jpg',8000.00,7688.00,6500.00,10.00,320,'合肥','&lt;img src=&quot;/uploads/20181224/5c20de0d08160.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20de0d230f4.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20de0d33592.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20de0d4112a.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20de0d55b35.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:27:46','2019-01-02 14:15:53'),(6,'微软（Microsoft）Surface Pro 6 二合一平板电脑笔记本 12.3英寸','SurfacePro第五代i5/8G+128G/键盘套装 限时5988秒杀',5,2,'/uploads/20181224/5c20defd22445.jpg','/uploads/20181224/5c20df019f27b.jpg-/uploads/20181224/5c20df01990b9.jpg-/uploads/20181224/5c20df0190c02.jpg-/uploads/20181224/5c20df0188132.jpg',7900.00,7588.00,6900.00,0.00,365,'合肥','&lt;img src=&quot;/uploads/20181224/5c20df2b18beb.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20df2b2bef0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20df2b39d55.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20df2b4a1e7.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20df2b59dc1.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:31:36','2019-01-02 14:15:55'),(7,'联想ThinkPad 翼480（12CD）14英寸轻薄窄边框笔记本电脑 冰原银','全新一代翼490轻薄笔记本27日全面开售',11,3,'/uploads/20181224/5c20e13bd84d0.jpg','/uploads/20181224/5c20e14046ff7.jpg-/uploads/20181224/5c20e1413eb1c.jpg-/uploads/20181224/5c20e1403acbd.jpg-/uploads/20181224/5c20e1402f952.jpg',9000.00,8499.00,7200.00,5.00,1254,'合肥','&lt;img src=&quot;/uploads/20181224/5c20e16e2f5fe.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e16e481c4.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e16e58d7f.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e16e6859b.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e16e7eaee.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:43:48','2018-12-25 11:20:54'),(8,'Apple MacBook Pro 15.4英寸笔记本电脑 深空灰色 配备2018新款','六核八代i7 16G 256G固态硬盘 MR932CH/A',12,3,'/uploads/20181224/5c20e2c232d7f.jpg','/uploads/20181224/5c20e48551612.jpg-/uploads/20181224/5c20e48541b22.jpg-/uploads/20181224/5c20e4844a707.jpg',15000.00,11200.00,10000.00,25.00,256,'合肥','&lt;img src=&quot;/uploads/20181224/5c20e3221aa15.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e3222e91d.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e3223dded.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e3224d8e6.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:52:06','2018-12-25 11:20:45'),(9,'Beats Studio3 Wireless 录音师无线3代 头戴式 蓝牙无线游戏耳机 - 魅影灰','圣诞狂欢,表白选好礼',13,4,'/uploads/20181224/5c20e4b938669.jpg','/uploads/20181224/5c20e4bd75461.jpg-/uploads/20181224/5c20e4bd709ee.jpg-/uploads/20181224/5c20e4bd697f9.jpg-/uploads/20181224/5c20e4bd63502.jpg',3200.00,2580.00,1900.00,15.00,2356,'合肥','&lt;img src=&quot;/uploads/20181224/5c20e4db0f691.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e4db22f2f.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e4db32520.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e4db43296.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e4db52637.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:58:35','2018-12-26 09:52:04'),(10,'Apple iPhone 8 Plus (A1864) 64GB 金色 移动联通电信4G手机','双面全玻璃，无线充电，5.5英寸视网膜屏，仿生芯片',5,1,'/uploads/20181224/5c2431ccf2490.jpg','/uploads/20181224/5c2431d952210.jpg-/uploads/20181224/5c2431d944b38.jpg-/uploads/20181224/5c2431d9360d8.jpg-/uploads/20181224/5c2431d927a60.jpg',5999.00,5599.00,4800.00,0.00,2541,'合肥','&lt;img src=&quot;/uploads/20181224/5c243200df7c8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c243200f3048.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2432010ebf0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2432011f590.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2432012f760.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-27 10:03:07','2018-12-27 10:19:18'),(11,'Apple iPhone XS Max (A2104) 256GB 金色 移动联通电信4G手机','全新原封 国行正品 全国联保 京东物流 快捷安全 抢购苹果XS 送无线充+游戏辅助按键+壳+膜+指环扣',5,1,'/uploads/20181224/5c2434759aa38.png','/uploads/20181224/5c2434852d438.jpg-/uploads/20181224/5c2434851e9d8.jpg-/uploads/20181224/5c24348512688.jpg-/uploads/20181224/5c243485043f8.jpg',10999.00,12000.00,8599.00,20.00,365,'合肥','&lt;img src=&quot;/uploads/20181224/5c2434de10f18.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2434de243b0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2434de32e10.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2434de43b98.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2434de54538.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-27 10:14:50','2018-12-27 10:19:08'),(12,'Apple 苹果 iPhone XR 手机 全网通4G手机 黑色 128GB','此版本单卡使用与公开版网络相同，双卡使用移动4G网络优先',5,1,'/uploads/20181224/5c2463e3796f8.jpg','/uploads/20181224/5c2463e96ac98.jpg-/uploads/20181224/5c2463ea817e0.jpg-/uploads/20181224/5c2463ea5f118.jpg-/uploads/20181224/5c2463e95be50.jpg',6999.00,6499.00,5600.00,0.00,235,'合肥','&lt;img src=&quot;/uploads/20181224/5c246447894e0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c246447a9498.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c246447c9068.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c246447d5f70.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c246447e6140.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2018-12-27 13:43:29','2018-12-27 14:02:09'),(13,'Apple iPhone 7 (A1660) 128G  移动联通电信4G手机','获得AppleCare+全方位服务计划，原厂延保售后无忧。',5,1,'/uploads/20181224/5c24677627290.jpg','/uploads/20181224/5c2468746eb18.jpg-/uploads/20181224/5c24687572d80.jpg-/uploads/20181224/5c246875529e0.jpg-/uploads/20181224/5c2468745f500.jpg',4300.00,3399.00,2800.00,5.00,562,'合肥','&lt;img src=&quot;/uploads/20181224/5c24679fcf210.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c24679fdff98.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c24679ff0550.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2467a00a1b8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2467a01a388.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2018-12-27 13:51:53','2018-12-27 15:09:22'),(14,'Apple 苹果 iPhone 6s Plus 4G手机 玫瑰金 全网通 32GB','送全屏钢化膜+保护壳套装',5,1,'/uploads/20181224/5c246951a84f8.jpg','/uploads/20181224/5c24695569cf8.jpg-/uploads/20181224/5c2469555ba68.jpg-/uploads/20181224/5c2469555d9a8.jpg-/uploads/20181224/5c24695553980.jpg',2999.00,2658.00,1500.00,0.00,3654,'合肥','&lt;img src=&quot;/uploads/20181224/5c24697331e70.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2469733ddd8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2469734e390.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2469735d9a8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2469736eb18.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2018-12-27 13:59:12','2018-12-27 14:02:28'),(15,'Apple 苹果5s iPhone 5s (A1530) 4英寸 移动联通双4G手机 金色 官方标配 16G','【苹果爆品】原封国行正品 全国联保 爆款苹果6热销中',5,1,'/uploads/20181224/5c246bb948da0.jpg','/uploads/20181224/5c246bbd66a30.jpg-/uploads/20181224/5c246bbe777b8.jpg-/uploads/20181224/5c246bbe59f10.jpg-/uploads/20181224/5c246bbd56c48.jpg',1300.00,1169.50,700.00,0.00,1254,'合肥','&lt;img src=&quot;/uploads/20181224/5c246bd5a0028.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c246bd5afa28.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c246bd5bf040.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c246bd5cde88.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c246bd5dd888.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2018-12-27 14:08:42','2018-12-27 16:33:24'),(16,'华为 HUAWEI P20 AI智慧徕卡双摄全面屏游戏手机 6GB+64GB 极光色','麒麟970芯片/DxO评分过百！',6,1,'/uploads/20181224/5c2d7c0b1d0d8.jpg','/uploads/20181224/5c2d7c11beeb0.jpg-/uploads/20181224/5c2d7c11af4b0.jpg-/uploads/20181224/5c2d7c11a21c0.jpg-/uploads/20181224/5c2d7c1194318.jpg',3500.00,3388.00,2799.00,0.00,252,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d7c2ce7720.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7c2d16f30.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7c2d376b8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7c2d52080.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7c2d60310.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 11:09:39','2019-01-03 13:47:18'),(17,'华为 HUAWEI 畅享MAX 4GB+64GB 幻夜黑 全网通版 珍珠屏杜比全景声大电池','7.12英寸大屏，杜比全景声，5000mA超长续航',6,1,'/uploads/20181224/5c2d7d703fb88.jpg','/uploads/20181224/5c2d7d7571098.jpg-/uploads/20181224/5c2d7d75631f0.jpg-/uploads/20181224/5c2d7d7557288.jpg-/uploads/20181224/5c2d7d75497c8.jpg',1600.00,1499.00,998.00,0.00,365,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d7d8a72808.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7d8a900b0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7d8a9bc30.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7d8aabe00.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7d8abc7a0.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 11:14:33','2019-01-03 13:47:25'),(18,'荣耀10 GT游戏加速 AIS手持夜景 6GB+64GB 幻影蓝全网通  游戏手机','荣耀10GT，游戏加速！荣耀爆品特惠，选品质，购荣耀~ 选移动，享大流量，不换号购机！',6,1,'/uploads/20181224/5c2d7eb0df638.jpg','/uploads/20181224/5c2d7eb5f2eb8.jpg-/uploads/20181224/5c2d7eb5e5010.jpg-/uploads/20181224/5c2d7eb5d6d80.jpg-/uploads/20181224/5c2d7eb5c8ed8.jpg',2500.00,2199.00,1600.00,0.00,365,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d7ecc7eb58.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7ecc8f4f8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7ecc9fab0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7eccb0068.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7eccc1d90.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 11:19:56','2019-01-03 13:47:32'),(19,'荣耀9i 4GB+128GB 梦幻紫 移动联通电信4G全面屏手机 双卡双待','1600万前置感光增强镜头！荣耀爆品特惠，选品质，购荣耀~ 选移动，享大流量，不换号购机！',6,1,'/uploads/20181224/5c2d7fd590c68.jpg','/uploads/20181224/5c2d7fd9d61c8.jpg-/uploads/20181224/5c2d7fd9c8af0.jpg-/uploads/20181224/5c2d7fd9bb418.jpg-/uploads/20181224/5c2d7fd9ad958.jpg',1800.00,1599.00,1197.00,0.00,365,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d7fede2900.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7fee07918.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7fee30570.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7fee468e8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d7fee537f0.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 11:24:30','2019-01-03 13:47:41'),(20,'荣耀 V10 全网通高配版 6GB+64GB 幻夜黑 移动联通电信4G全面屏游戏手机','麒麟970！全面屏！全面屏游戏手机',6,1,'/uploads/20181224/5c2d81038e170.jpg','/uploads/20181224/5c2d8108cf850.jpg-/uploads/20181224/5c2d8108bf298.jpg-/uploads/20181224/5c2d8108b3330.jpg-/uploads/20181224/5c2d8108a6428.jpg',2300.00,1999.00,1400.00,0.00,365,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d811cb71b0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d811cd6998.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d811cf1748.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d811d09470.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d811d1a1f8.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 11:29:13','2019-01-03 13:47:48'),(21,'荣耀8X 千元屏霸 91%屏占比 2000万AI双摄 4GB+64GB 魅焰红 移动联通电信4G全面屏手机','麒麟710！2000万AI双摄',6,1,'/uploads/20181224/5c2d820c470b8.jpg','/uploads/20181224/5c2d82115d430.jpg-/uploads/20181224/5c2d821150140.jpg-/uploads/20181224/5c2d82113e800.jpg-/uploads/20181224/5c2d821131128.jpg',1666.00,1399.00,800.00,0.00,698,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d822579180.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d82258ba60.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d82259b460.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d8225ac5d0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d8225bc3b8.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 11:33:42','2019-01-03 13:47:57'),(22,'华为 HUAWEI nova 3全面屏高清四摄游戏手机 6GB+128GB 亮黑色 全网通移动联通电信4G手机','TFBOYS易烊千玺代言手机！麒麟旗舰970芯片!Nova4全新上市',6,1,'/uploads/20181224/5c2d83190dea8.jpg','/uploads/20181224/5c2d831d441d8.jpg-/uploads/20181224/5c2d831d372d0.jpg-/uploads/20181224/5c2d831d27100.jpg-/uploads/20181224/5c2d831d19258.jpg',3000.00,2799.00,2100.00,0.00,560,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d833256ea0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d833267840.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d833276688.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d833286c40.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d833296258.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 11:38:57','2019-01-03 13:48:05'),(23,'荣耀10青春版 幻彩渐变 2400万AI自拍 全网通版4GB+64GB 幻夜黑 移动联通电信4G全面屏手机 双卡双待','限时赠送小天鹅蓝牙音箱+自拍杆！荣耀新品，朱正廷同款手机',6,1,'/uploads/20181224/5c2d9c17d9490.jpg','/uploads/20181224/5c2d9c1d0a028.jpg-/uploads/20181224/5c2d9c1ceffd8.jpg-/uploads/20181224/5c2d9c1cdfa20.jpg-/uploads/20181224/5c2d9c1cd1790.jpg',1500.00,1399.00,1000.00,0.00,698,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d9c31639c0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9c3172420.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9c3181e20.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9c3191050.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9c31a21c0.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 13:25:18','2019-01-03 13:48:12'),(24,'华为 HUAWEI 畅享8e 青春版 2GB+32GB全面屏 金色 全网通版 移动联通电信4G手机 双卡双待','高清全面屏，32GB大内存三卡槽',6,1,'/uploads/20181224/5c2d9d5636330.jpg','/uploads/20181224/5c2d9d5b74748.jpg-/uploads/20181224/5c2d9d5b65130.jpg-/uploads/20181224/5c2d9d5b58610.jpg-/uploads/20181224/5c2d9d5b4c2c0.jpg',800.00,649.00,500.00,0.00,689,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d9d6fb2f48.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9d6fc11d8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9d6fcec98.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9d6fe30d0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9d6feffd8.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 13:29:46','2019-01-03 13:48:20'),(25,'荣耀Magic2 麒麟980AI智能芯片 超广角AI三摄 6GB+128GB 渐变蓝 移动联通电信4G手机','限时赠送小天鹅蓝牙音箱+移动电源，送完即止！荣耀Magic2，麒麟980，6.39英寸全视屏',6,1,'/uploads/20181224/5c2d9e6ac0a08.jpg','/uploads/20181224/5c2d9e6f2e630.jpg-/uploads/20181224/5c2d9e6f20b70.jpg-/uploads/20181224/5c2d9e6f11940.jpg-/uploads/20181224/5c2d9e6f04a38.jpg',4000.00,3799.00,3200.00,0.00,1205,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d9e8796258.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9e87a48d0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9e87b5e28.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9e87c4888.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9e87d4670.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 13:35:13','2019-01-03 13:48:27'),(26,'华为 HUAWEI P20 Pro 全面屏徕卡三摄游戏手机 6GB+128GB 亮黑色 全网通移动联通电信4G手机','4000万徕卡三摄/DxO评分过百',6,1,'/uploads/20181224/5c2d9fb21a1f8.jpg','/uploads/20181224/5c2d9fb7562e8.jpg-/uploads/20181224/5c2d9fb7493e0.jpg-/uploads/20181224/5c2d9fb739dc8.jpg-/uploads/20181224/5c2d9fb72c6f0.jpg',5100.00,4980.00,4200.00,0.00,1200,'合肥','&lt;img src=&quot;/uploads/20181224/5c2d9fcdc8708.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9fcddb3d0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9fcdeb1b8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9fce07148.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2d9fce16f30.jpg&quot; alt=&quot;&quot; /&gt;',1,0,0,'2019-01-03 13:41:32','2019-01-03 13:48:36');

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
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COMMENT='产品参数表';

#
# Data for table "goods_param"
#

INSERT INTO `goods_param` VALUES (9,2,'品牌','华为'),(10,2,'系列型号','Mate20 X'),(11,2,'颜色','银色'),(12,2,'CPU','Hisilicon'),(13,2,'操作系统','Android'),(14,2,'屏幕尺寸','7.2英寸'),(15,2,'摄像头','2400万像素'),(16,2,'上市年份','2018年'),(21,2,'产地','深圳'),(22,3,'品牌','小米（MI）'),(23,3,'系列型号','MIX3'),(24,3,'机身颜色','黑色'),(25,3,'操作系统','Android'),(26,3,'屏幕尺寸','6.39 英寸'),(27,3,'摄像头','200万像素'),(28,4,'品牌','VIVO'),(29,4,'系列型号','vivo X'),(30,4,'入网型号','V1809A'),(31,4,'操作系统','Android'),(32,4,'CPU品牌','骁龙（Snapdragon)'),(33,4,'ROM','128GB'),(34,4,'屏幕尺寸','6.41英寸'),(35,4,'摄像头','1200万像素'),(36,4,'上市年份','2018年'),(43,6,'品牌','Microsoft'),(44,6,'认证型号','Surface Pro 6'),(45,6,'操作系统','Windows 10'),(46,6,'处理器','i5-8250U'),(47,6,'屏幕描述','12.3 英寸'),(48,6,'摄像头','500W'),(49,7,'品牌','ThinkPad'),(50,7,'系列型号','ThinkPad E480'),(51,7,'操作系统','Windows 10 家庭版'),(52,7,'CPU型号','i7-8550U'),(53,7,'内存容量','16GB'),(54,7,'显示类型','AMD GDDR5 独立显存'),(55,7,'屏幕尺寸','14英寸'),(56,8,'品牌','Apple'),(57,8,'认证型号','MPXU2CH/A'),(58,8,'操作系统','Mac OS'),(59,8,'CPU类型','Intel 第7代 酷睿'),(60,8,'内存容量','8GB'),(61,8,'屏幕规格','13.3英寸'),(62,8,'硬盘容量','256GB SSD'),(63,9,'品牌','beats'),(64,9,'系列型号','studio 3'),(65,9,'商品毛重','1.13kg'),(66,9,'连接类型','无线'),(67,9,'佩戴方式','头戴式'),(68,10,'品牌','Apple'),(69,10,'系列型号','iPhone 8 Plus'),(70,10,'操作系统','ios'),(71,10,'ROM','256GB'),(72,10,'屏幕尺寸','5.5英寸'),(73,10,'摄像头','700万像素'),(74,10,'上市年份','2018年'),(75,11,'品牌','Apple'),(76,11,'系列型号','iPhone XS Max'),(77,11,'机身颜色','金色'),(78,11,'操作系统','ios'),(79,11,'屏幕尺寸','6.5英寸'),(80,11,'屏幕材质','OLED'),(81,11,'摄像头','双1200万像素'),(82,11,'上市年份','2018年'),(83,12,'品牌','Apple'),(84,12,'系列型号','iPhone XR'),(85,12,'操作系统','ios'),(86,12,'ROM','256G'),(87,12,'屏幕尺寸','6.1英寸'),(88,12,'屏幕材质','LCD'),(89,12,'摄像头','1200万像素'),(90,12,'上市年份','2018年'),(91,13,'品牌','Apple'),(92,13,'系列型号','iPhone 7'),(93,13,'操作系统','ios'),(94,13,'ROM','128GB'),(95,13,'屏幕尺寸','4.7英寸'),(96,13,'摄像头','1200万像素'),(97,13,'上市年份','2017年'),(98,14,'品牌','Apple'),(99,14,'系列型号','iPhone 6s Plus'),(100,14,'ROM','32G'),(101,14,'摄像头','1200万像素'),(102,14,'屏幕尺寸','5.5英寸'),(103,14,'上市年份','2015年'),(104,15,'品牌','Apple'),(105,15,'ROM','16G'),(106,15,'系列型号','iPhone 5s'),(107,15,'操作系统','ios'),(108,15,'屏幕尺寸','4.0英寸'),(109,15,'摄像头','800万像素'),(110,15,'上市年份','2013年'),(111,1,'品牌','Apple'),(112,1,'系列型号','iPhone X'),(113,1,'上市年份','2017年'),(114,1,'操作系统','ios'),(115,1,'ROM','64GB'),(116,1,'屏幕尺寸','5.8英寸'),(117,1,'摄像头','双1200万像素'),(118,5,'品牌','Apple'),(119,5,'系列型号','MTXQ2CH/A'),(120,5,'处理器','A12X 仿生'),(121,5,'显示屏','Liquid 视网膜显示屏'),(122,5,'摄像头','1200W'),(123,5,'电池类型','锂电池'),(124,5,'尺寸','11 英寸'),(125,16,'品牌','华为（HUAWEI）'),(126,16,'入网型号','P20'),(127,16,'上市年份','2018年'),(128,16,'操作系统','华为EMUI 8.1'),(129,16,'CPU品牌','海思（Hisilicon）'),(130,16,'屏幕尺寸','5.8'),(131,16,'摄像头','2400万像素'),(132,17,'品牌','华为畅享MAX'),(133,17,'入网型号','ARS-AL00'),(134,17,'上市年份','2018年'),(135,17,'操作系统','Android'),(136,17,'CPU品牌','骁龙（Snapdragon)'),(137,17,'屏幕尺寸','7.12英寸'),(138,17,'摄像头','800万像素'),(139,18,'品牌','华为（HUAWEI）'),(140,18,'入网型号','COL-AL10'),(141,18,'上市年份','2018年'),(142,18,'机身颜色','幻影蓝'),(143,18,'操作系统','Android 8.1'),(144,18,'屏幕尺寸','5.84英寸'),(145,18,'分辨率','2280x1080'),(146,19,'品牌','华为（HUAWEI）'),(147,19,'入网型号','LLD-AL30'),(148,19,'上市年份','2018年'),(149,19,'操作系统','华为EMUI 8.0+Android 8.0'),(150,19,'CPU品牌','海思（Hisilicon）'),(151,20,'品牌','华为（HUAWEI）'),(152,20,'入网型号','BKL-AL20'),(153,20,'上市年份','2018年'),(154,20,'操作系统','Android 8.0'),(155,20,'CPU品牌','海思（Hisilicon）'),(156,20,'屏幕尺寸','5.99英寸'),(157,21,'品牌','华为（HUAWEI）'),(158,21,'入网型号','荣耀8X'),(159,21,'上市年份','2018年'),(160,21,'机身颜色','魅焰红'),(161,21,'操作系统','Android 8.1'),(162,21,'CPU品牌','海思（Hisilicon）'),(163,22,'品牌','华为（HUAWEI）'),(164,22,'入网型号','PAR-AL00'),(165,22,'上市年份','2018年'),(166,22,'操作系统','Android'),(167,22,'CPU品牌','海思（Hisilicon）'),(168,23,'品牌','华为（HUAWEI）'),(169,23,'型号','荣耀10青春版'),(170,23,'上市年份','2018年'),(171,23,'操作系统','Android'),(172,23,'CPU品牌','海思（Hisilicon）'),(173,24,'品牌','华为（HUAWEI）'),(174,24,'入网型号','DRA-AL00'),(175,24,'上市年份','2018年'),(176,24,'操作系统','Android'),(177,24,'CPU品牌','联发科（MTK）'),(178,24,'屏幕尺寸','5.45英寸'),(179,25,'品牌','华为（HUAWEI）'),(180,25,'型号','荣耀Magic2'),(181,25,'上市年份','2018年'),(182,25,'操作系统','Android'),(183,25,'机身颜色','渐变蓝'),(184,25,'CPU品牌','海思（Hisilicon）'),(185,25,'屏幕尺寸','6.39 英寸'),(186,26,'品牌','华为（HUAWEI）'),(187,26,'型号','P20 Pro'),(188,26,'上市年份','2018年'),(189,26,'操作系统','Android'),(190,26,'CPU品牌','海思（Hisilicon）'),(191,26,'屏幕尺寸','6.1英寸'),(192,26,'分辨率','2240*1080');

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
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COMMENT='产品规格表';

#
# Data for table "goods_spec"
#

INSERT INTO `goods_spec` VALUES (1,1,'移动版',6399.00,499,0,'2018-12-27 14:58:26'),(2,1,'联通版',6499.00,260,0,'2018-12-27 14:58:26'),(3,1,'电信版',6599.30,320,0,'2018-12-27 14:58:26'),(4,2,'6+128G',4899.00,1200,0,'2018-12-25 11:22:01'),(5,2,'8+256G',5999.00,1100,0,'2018-12-25 11:22:01'),(9,2,'16+512G',7999.00,112,0,'2018-12-25 11:22:01'),(10,3,'6+128G',3299.00,254,0,'2018-12-25 11:21:38'),(11,3,'8+128G',3599.00,485,0,'2018-12-25 11:21:38'),(12,3,'8+256G',3999.00,958,0,'2018-12-21 15:30:23'),(13,3,'8+256G',4999.00,258,0,'2018-12-21 16:59:24'),(14,4,'魅影紫',3198.00,253,0,'2018-12-25 11:21:32'),(15,4,'幻夜蓝',3198.00,653,0,'2018-12-25 11:21:32'),(16,4,'幻影红',3198.00,355,0,'2018-12-25 11:21:32'),(17,4,'星芒',3198.00,452,0,'2018-12-25 11:21:32'),(18,5,'深空灰色',7680.00,1200,0,'2018-12-27 15:00:30'),(19,5,'银色',7699.00,1100,0,'2018-12-27 15:00:30'),(20,6,'8+128G',7588.00,2399,0,'2018-12-25 11:21:24'),(21,7,'i5+8g+独显',5499.00,2100,0,'2018-12-25 11:20:54'),(22,7,'i5+8g+集显',5099.00,1520,0,'2018-12-25 11:20:54'),(23,7,'i7+8g+独显',7499.00,3210,0,'2018-12-25 11:20:54'),(24,7,'i7+8g+集显',8499.00,560,0,'2018-12-25 11:20:54'),(25,8,'8+128G银',9699.00,244,0,'2018-12-25 11:20:45'),(26,8,'8+256G银',11299.00,245,0,'2018-12-25 11:20:45'),(27,8,'8+128G灰',9699.00,245,0,'2018-12-25 11:20:45'),(28,8,'8+256G灰',11299.00,245,0,'2018-12-25 11:20:45'),(29,9,'魅影灰-限量款',2580.00,254,0,'2018-12-25 11:20:27'),(30,9,'桀骜黑红',2580.00,254,0,'2018-12-25 11:20:27'),(31,9,'午夜黑',2858.00,254,0,'2018-12-25 11:20:27'),(32,9,'水晶蓝',2858.00,254,0,'2018-12-25 11:20:27'),(33,9,'荒漠沙',2858.00,254,0,'2018-12-25 11:20:27'),(34,9,'哑光黑',2388.00,254,0,'2018-12-25 11:20:27'),(35,9,'陶瓷粉',2858.00,254,0,'2018-12-25 11:20:27'),(36,10,'金色64G',5599.00,600,0,'2018-12-27 10:03:07'),(37,10,'深空灰64G',5599.00,600,0,'2018-12-27 10:03:07'),(38,10,'银色256G',6899.00,700,0,'2018-12-27 10:03:07'),(39,10,'红色256G',6899.00,300,0,'2018-12-27 10:03:07'),(40,11,'64G',9599.00,542,0,'2018-12-27 10:14:50'),(41,11,'256G',10999.00,524,0,'2018-12-27 10:14:50'),(42,11,'512G',12799.00,255,0,'2018-12-27 10:14:50'),(43,12,'黑色',6398.00,564,0,'2018-12-27 13:43:29'),(44,12,'白色',6398.00,564,0,'2018-12-27 13:43:29'),(45,12,'黄色',6398.00,564,0,'2018-12-27 13:43:29'),(46,12,'蓝色',6398.00,564,0,'2018-12-27 13:43:29'),(47,12,'珊瑚色',6438.00,564,0,'2018-12-27 13:43:29'),(48,12,'红色',6438.00,564,0,'2018-12-27 13:43:29'),(49,13,'金色',4499.00,365,0,'2018-12-27 15:09:22'),(50,13,'玫瑰金色',4499.00,365,0,'2018-12-27 15:09:22'),(51,13,'银色',4499.00,365,0,'2018-12-27 15:09:22'),(52,13,'黑色',4499.00,365,0,'2018-12-27 15:09:22'),(53,13,'红色',4799.00,365,0,'2018-12-27 15:09:22'),(54,14,'金色',2758.00,658,0,'2018-12-27 13:59:12'),(55,14,'深空灰',2798.00,658,0,'2018-12-27 13:59:12'),(56,14,'玫瑰金',2658.00,658,0,'2018-12-27 13:59:12'),(57,14,'银色',2668.00,658,0,'2018-12-27 13:59:12'),(58,15,'金色',1169.00,652,0,'2018-12-27 14:08:42'),(59,15,'银色',1399.00,458,0,'2018-12-27 14:08:42'),(60,16,'极光闪蝶色',3388.00,1250,0,'2019-01-03 11:09:39'),(61,16,'珠光贝母色',3388.00,1250,0,'2019-01-03 11:09:39'),(62,16,'香槟金',3388.00,1250,0,'2019-01-03 11:09:39'),(63,16,'樱粉色',3388.00,1250,0,'2019-01-03 11:09:39'),(64,17,'幻夜黑',1499.00,2563,0,'2019-01-03 11:14:33'),(65,17,'天际白',1499.00,2563,0,'2019-01-03 11:14:33'),(66,17,'琥珀粽',1499.00,2563,0,'2019-01-03 11:14:33'),(67,18,'6+64G',2199.00,235,0,'2019-01-03 11:19:56'),(68,18,'6+128G',2599.00,365,0,'2019-01-03 11:19:56'),(69,18,'8+128G',3099.00,145,0,'2019-01-03 11:19:56'),(70,19,'幻夜黑',1599.00,254,0,'2019-01-03 11:24:30'),(71,19,'魅海蓝',1599.00,254,0,'2019-01-03 11:24:30'),(72,19,'梦幻紫',1599.00,254,0,'2019-01-03 11:24:30'),(73,19,'碧玉青',1599.00,254,0,'2019-01-03 11:24:30'),(74,20,'6+64G',1999.00,987,0,'2019-01-03 11:29:13'),(75,20,'6+128G',2799.00,987,0,'2019-01-03 11:29:13'),(76,20,'8+128G',3099.00,987,0,'2019-01-03 11:29:13'),(77,21,'4+64G',1399.00,874,0,'2019-01-03 11:33:42'),(78,21,'6+64G',1599.00,874,0,'2019-01-03 11:33:42'),(79,21,'6+128G',1899.00,874,0,'2019-01-03 11:33:42'),(80,22,'浅艾蓝',2799.00,586,0,'2019-01-03 11:38:57'),(81,22,'亮黑色',2799.00,587,0,'2019-01-03 11:38:57'),(82,22,'蓝楹紫',2799.00,587,0,'2019-01-03 11:38:57'),(83,22,'樱草金',2799.00,587,0,'2019-01-03 11:38:57'),(84,23,'幻夜黑',1399.00,874,0,'2019-01-03 13:25:18'),(85,23,'渐变蓝',1399.00,874,0,'2019-01-03 13:25:18'),(86,23,'渐变红',1399.00,874,0,'2019-01-03 13:25:18'),(87,23,'玲兰白',1399.00,874,0,'2019-01-03 13:25:18'),(88,24,'金色',649.00,874,0,'2019-01-03 13:29:46'),(89,24,'蓝色',649.00,874,0,'2019-01-03 13:29:46'),(90,24,'黑色',649.00,874,0,'2019-01-03 13:29:46'),(91,25,'6+128G',3799.00,872,0,'2019-01-03 13:35:13'),(92,25,'8+128G',4299.00,872,0,'2019-01-03 13:35:13'),(93,25,'8+256G',4799.00,872,0,'2019-01-03 13:35:13'),(94,26,'6+64G',4488.00,547,0,'2019-01-03 13:41:32'),(95,26,'6+128G',4988.00,547,0,'2019-01-03 13:41:32'),(96,26,'8+128G',5288.00,547,0,'2019-01-03 13:41:32'),(97,26,'6+256G',5788.00,547,0,'2019-01-03 13:41:32'),(98,26,'8+256G',6288.00,547,0,'2019-01-03 13:41:32');

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
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `integral_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='积分记录';

#
# Data for table "log_integral"
#

INSERT INTO `log_integral` VALUES (1,2,'购物订单：201901189871547789799',2595.00,'+','2019-01-18 15:44:08'),(2,2,'累积：201901189871547789799',21.00,'+','2019-01-18 15:44:08'),(3,2,'累积：201901189871547789799',652.00,'-','2019-01-18 15:44:08'),(4,2,'累积：201901189871547789799',120.00,'+','2019-01-18 15:44:08'),(5,2,'累积：201901189871547789799',5.00,'+','2019-01-18 15:44:08'),(6,2,'累积：201901189871547789799',140.00,'+','2019-01-18 15:44:08'),(7,2,'累积：201901189871547789799',23.00,'+','2019-01-18 15:44:08'),(8,2,'累积：201901189871547789799',106.00,'-','2019-01-18 15:44:08'),(9,2,'累积：201901189871547789799',230.00,'+','2019-01-18 15:44:08'),(10,2,'累积：201901189871547789799',86.00,'-','2019-01-18 15:44:08'),(11,2,'累积：201901189871547789799',460.00,'+','2019-01-18 15:44:08'),(12,2,'累积：201901189871547789799',14.00,'-','2019-01-18 15:44:08'),(13,2,'累积：201901189871547789799',251.00,'+','2019-01-18 16:05:19'),(14,2,'累积：201901189871547789799',2125.00,'+','2019-01-18 16:05:54'),(15,2,'累积5108',511.00,'-','2019-01-18 16:18:02'),(16,2,'累积3316',33.00,'-','2019-01-18 16:18:02'),(17,2,'累积4718',844.00,'-','2019-01-18 16:18:02'),(18,2,'累积7079',680.00,'+','2019-01-18 16:18:02'),(19,2,'累积6564',255.00,'+','2019-01-18 16:18:02'),(20,2,'累积7523',656.00,'-','2019-01-18 16:18:02'),(21,2,'累积4219',662.00,'+','2019-01-18 16:18:02'),(22,2,'累积1953',226.00,'+','2019-01-18 16:18:02'),(23,2,'累积1549',404.00,'+','2019-01-18 16:18:03'),(24,2,'累积5666',590.00,'+','2019-01-18 16:18:03'),(25,2,'累积7469',708.00,'-','2019-01-18 16:18:03'),(26,2,'累积3200',600.00,'+','2019-01-18 16:18:03'),(27,2,'累积2691',106.00,'-','2019-01-18 16:18:03'),(28,2,'累积8253',890.00,'-','2019-01-18 16:18:03'),(29,2,'累积9177',856.00,'+','2019-01-18 16:18:03'),(30,2,'累积2644',142.00,'-','2019-01-18 16:18:03'),(31,2,'累积3214',623.00,'-','2019-01-18 16:18:03'),(32,2,'累积1547',520.00,'-','2019-01-18 16:18:03'),(33,2,'累积2056',221.00,'-','2019-01-18 16:18:03'),(34,2,'累积6327',812.00,'+','2019-01-18 16:18:03'),(35,2,'累积7391',44.00,'+','2019-01-18 16:21:42'),(36,2,'累积9959',974.00,'+','2019-01-18 16:21:42'),(37,2,'累积7633',708.00,'-','2019-01-18 16:21:42'),(38,2,'累积7179',519.00,'-','2019-01-18 16:21:42'),(39,2,'累积5309',242.00,'-','2019-01-18 16:21:42'),(40,2,'累积6007',376.00,'-','2019-01-18 16:21:42'),(41,2,'累积1263',634.00,'-','2019-01-18 16:21:42'),(42,2,'累积8047',973.00,'-','2019-01-18 16:21:42'),(43,2,'累积7032',488.00,'+','2019-01-18 16:21:42'),(44,2,'累积7961',370.00,'-','2019-01-18 16:21:42'),(45,2,'累积4182',434.00,'-','2019-01-18 16:21:42'),(46,2,'累积8792',770.00,'-','2019-01-18 16:21:42'),(47,2,'累积7360',996.00,'-','2019-01-18 16:21:42'),(48,2,'累积9708',531.00,'-','2019-01-18 16:21:42'),(49,2,'累积5113',511.00,'-','2019-01-18 16:21:42'),(50,2,'累积9095',439.00,'-','2019-01-18 16:21:42'),(51,2,'累积9007',183.00,'+','2019-01-18 16:21:42'),(52,2,'累积6220',449.00,'-','2019-01-18 16:21:42'),(53,2,'累积7959',134.00,'-','2019-01-18 16:21:42'),(54,2,'累积7365',897.00,'-','2019-01-18 16:21:42'),(55,2,'累积：201901165431547631358',22885.00,'+','2019-01-19 17:16:46'),(56,2,'累积：201901217031548064103',13997.00,'+','2019-01-21 17:48:46'),(57,2,'累积：201901069071546779851',6899.00,'+','2019-01-22 16:27:10'),(58,2,'累积：201901062951546778753',5731.00,'+','2019-01-24 10:52:17'),(59,2,'累积：201901245701548321604',22543.00,'+','2019-01-24 17:20:18'),(60,2,'累积：201901254991548383728',2789.00,'+','2019-01-25 10:58:55'),(61,2,'累积：201901255111548395497',3203.00,'+','2019-01-25 13:51:46');

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
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `money_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='资金记录';

#
# Data for table "log_money"
#

INSERT INTO `log_money` VALUES (1,2,'购物订单：201901189871547789799',2595.00,'-','2019-01-18 15:44:42'),(2,2,'累积8989',793.00,'-','2019-01-18 16:40:22'),(3,2,'累积9639',463.00,'+','2019-01-18 16:40:22'),(4,2,'累积1900',639.00,'+','2019-01-18 16:40:22'),(5,2,'累积3965',787.00,'+','2019-01-18 16:40:22'),(6,2,'累积4423',925.00,'+','2019-01-18 16:40:22'),(7,2,'累积4344',461.00,'-','2019-01-18 16:40:22'),(8,2,'累积6419',309.00,'-','2019-01-18 16:40:22'),(9,2,'累积7909',272.00,'-','2019-01-18 16:40:22'),(10,2,'累积6192',553.00,'-','2019-01-18 16:40:22'),(11,2,'累积2038',584.00,'+','2019-01-18 16:40:22'),(12,2,'累积8736',600.00,'+','2019-01-18 16:40:22'),(13,2,'累积3235',229.00,'+','2019-01-18 16:40:22'),(14,2,'累积6747',470.00,'-','2019-01-18 16:40:22'),(15,2,'累积8815',94.00,'+','2019-01-18 16:40:22'),(16,2,'累积2614',832.00,'+','2019-01-18 16:40:22'),(17,2,'累积3168',661.00,'-','2019-01-18 16:40:23'),(18,2,'累积7739',444.00,'-','2019-01-18 16:40:23'),(19,2,'累积2808',477.00,'-','2019-01-18 16:40:23'),(20,2,'累积9589',70.00,'-','2019-01-18 16:40:23'),(21,2,'累积4103',50.00,'+','2019-01-18 16:40:23'),(22,2,'201901165431547631358',22885.00,'-','2019-01-19 17:16:46'),(23,2,'201901217031548064103',13997.00,'-','2019-01-21 17:48:46'),(24,2,'201901069071546779851',6899.00,'-','2019-01-22 16:27:10'),(25,2,'201901062951546778753',5731.00,'-','2019-01-24 10:52:17'),(26,2,'201901245701548321604',22543.00,'-','2019-01-24 17:20:18'),(27,2,'201901254991548383728',2789.00,'-','2019-01-25 10:58:55'),(28,2,'201901255111548395497',3203.00,'-','2019-01-25 13:51:46');

#
# Structure for table "logistics"
#

DROP TABLE IF EXISTS `logistics`;
CREATE TABLE `logistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '物流公司名称',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单售后产品回寄物流公司';

#
# Data for table "logistics"
#

INSERT INTO `logistics` VALUES (1,'顺丰快递','2019-01-26 17:10:49'),(2,'EMS邮政','2019-01-26 17:11:06'),(3,'天天快递','2019-01-26 17:11:16'),(4,'圆通快递','2019-01-26 17:11:23'),(5,'中通快递','2019-01-26 17:11:31'),(6,'申通快递','2019-01-26 17:11:39');

#
# Structure for table "order"
#

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `serial` varchar(21) DEFAULT NULL COMMENT '交易流水号',
  `trade_no` varchar(255) DEFAULT NULL COMMENT '第三方支付交易号',
  `total_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '交易总金额',
  `goods_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '产品总金额',
  `discount_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `franking_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '运费金额',
  `pay_price` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `coupon_id` int(11) unsigned DEFAULT NULL COMMENT '优惠券ID',
  `integral` float(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单积分',
  `name` varchar(255) DEFAULT NULL COMMENT '收货人名称',
  `phone` varchar(255) DEFAULT NULL COMMENT '收货人电话',
  `city` varchar(255) DEFAULT NULL COMMENT '收货城市',
  `street` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `pay_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '支付方式：0=》未支付；1=》支付宝支付；2=》微信支付；3=》余额支付',
  `pay_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '支付状态：0=》未支付；1=》已支付',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '订单状态：1=》待支付；2=》待发货；3=》待收货；4=》待评价；5=》已完成；6=》退换货（售后申请）；7=售后完成；8=》已失效',
  `shipment` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否发货：0=》未发货；1=》已发货',
  `comment` text COMMENT '客户留言',
  `pay_time` int(10) unsigned DEFAULT NULL COMMENT '订单支付时间',
  `complete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为完整有效支付订单：0=》否；1=》是',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='订单表';

#
# Data for table "order"
#

INSERT INTO `order` VALUES (1,2,'201901056481546695807',NULL,19507.00,19497.00,0.00,10.00,19507.00,NULL,1949.70,'李零散','13564078415','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦',3,1,7,0,NULL,NULL,1,0,'2019-01-05 21:43:27','2019-01-25 13:42:10'),(2,2,'201901057881546700455',NULL,399950.00,399950.00,0.00,0.00,399950.00,NULL,39995.00,NULL,NULL,NULL,NULL,0,0,1,0,NULL,NULL,0,1547694527,'2019-01-05 23:00:55','2019-01-25 11:22:02'),(3,2,'201901066211546774687','2019011522001487721009227099',18406.00,18396.00,100.00,10.00,0.01,3,1830.60,'李零散','13564078415','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦',1,1,5,0,NULL,1547789825,1,0,'2019-01-06 19:34:30','2019-01-25 11:19:52'),(4,2,'201901062401546778320',NULL,6401.00,6396.00,0.00,5.00,0.01,NULL,639.60,'李零散','13564078415','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦',3,1,5,0,NULL,NULL,1,0,'2019-01-06 20:33:41','2019-01-25 11:19:53'),(5,2,'201901062951546778753',NULL,5731.00,5716.00,0.00,15.00,5731.00,NULL,571.60,'王自动','18254745856','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦1202',3,1,2,0,NULL,1548298338,1,0,'2019-01-06 20:45:53','2019-01-25 11:19:55'),(6,2,'201901065151546778950',NULL,25618.00,25598.00,0.00,20.00,25618.00,NULL,2559.80,NULL,NULL,NULL,NULL,0,0,1,0,NULL,NULL,0,1548382740,'2019-01-06 20:49:10','2019-01-25 11:21:50'),(8,2,'201901069071546779851',NULL,6899.00,6899.00,0.00,0.00,6899.00,NULL,689.90,'王自动','18254745856','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦1202',3,1,3,0,NULL,1548145630,1,0,'2019-01-06 21:04:11','2019-01-25 11:19:57'),(9,2,'201901064831546780459',NULL,79423.00,19398.00,0.00,25.00,79423.00,NULL,1939.80,NULL,NULL,NULL,NULL,0,0,1,0,NULL,NULL,0,1547690296,'2019-01-06 21:14:19','2019-01-25 11:21:46'),(10,2,'201901169261547623848',NULL,4988.00,4988.00,0.00,0.00,4988.00,NULL,498.80,'李零散','13564078415','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦',3,1,5,0,NULL,NULL,1,0,'2019-01-16 15:30:48','2019-01-25 11:20:03'),(11,2,'201901166611547631188',NULL,34878.00,34853.00,0.00,25.00,34878.00,NULL,3485.30,NULL,NULL,NULL,NULL,0,0,1,0,NULL,NULL,0,1547631205,'2019-01-16 17:33:08','2019-01-25 11:21:41'),(12,2,'201901165431547631358',NULL,22885.00,22875.00,0.00,10.00,22885.00,NULL,2287.50,'王自动','18254745856','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦1202',3,1,7,0,NULL,1547889406,1,0,'2019-01-16 17:35:58','2019-01-25 11:20:06'),(13,2,'201901172551547716557',NULL,3203.00,3198.00,0.00,5.00,3203.00,NULL,319.80,NULL,NULL,NULL,NULL,0,0,1,0,NULL,NULL,0,1547887633,'2019-01-17 17:15:57','2019-01-25 11:21:38'),(14,2,'201901189871547789799',NULL,2595.00,2580.00,0.00,15.00,2595.00,NULL,258.00,'李零散','13564078415','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦',3,1,4,0,NULL,1547789825,1,0,'2019-01-18 13:36:39','2019-01-25 11:20:07'),(15,2,'201901191581547888221',NULL,7588.00,7588.00,0.00,0.00,7588.00,NULL,758.80,NULL,NULL,NULL,NULL,1,0,1,0,NULL,NULL,0,1547888366,'2019-01-19 16:57:01','2019-01-19 16:59:26'),(16,2,'201901198971547889462',NULL,9897.00,9897.00,0.00,0.00,9897.00,NULL,989.70,'王自动','18254745856','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦1202',0,0,1,0,NULL,NULL,1,1548396676,'2019-01-19 17:17:42','2019-01-25 14:11:16'),(17,2,'201901217031548064103',NULL,13997.00,13987.00,0.00,10.00,13997.00,NULL,1398.70,'王自动','18254745856','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦1202',3,1,6,0,NULL,1548064126,1,0,'2019-01-21 17:48:23','2019-01-25 11:20:19'),(18,2,'201901245701548321604',NULL,22543.00,22498.00,0.00,45.00,22543.00,NULL,2249.80,'方村村','17333007330','北京市 . 市辖区 . 东城区','紫云路艺术团虽',3,1,7,1,NULL,1548321618,1,0,'2019-01-24 17:20:04','2019-01-25 13:44:27'),(19,2,'201901252531548379884',NULL,2799.00,2799.00,10.00,0.00,2789.00,1,278.90,'王自动','18254745856','北京市 . 市辖区 . 东城区','望江西路亚非汽车大厦1202',0,0,1,0,NULL,NULL,1,1548382702,'2019-01-25 09:31:24','2019-01-25 11:21:17'),(20,2,'201901254991548383728',NULL,2799.00,2799.00,10.00,0.00,2789.00,1,278.90,'方村村','17333007330','北京市 . 市辖区 . 东城区','紫云路艺术团虽',3,1,2,0,NULL,1548385135,1,0,'2019-01-25 10:35:28','2019-01-25 13:52:23'),(21,2,'201901255251548385377',NULL,3203.00,3198.00,0.00,5.00,3203.00,NULL,319.80,NULL,NULL,NULL,NULL,0,0,1,0,NULL,NULL,0,0,'2019-01-25 11:02:57',NULL),(22,2,'201901255111548395497',NULL,3203.00,3198.00,0.00,5.00,3203.00,NULL,319.80,'爽肤水的','15245874568','北京市 . 市辖区 . 东城区','阿法违法gear覆盖',3,1,2,0,NULL,1548395506,1,0,'2019-01-25 13:51:37','2019-01-25 13:51:46');

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
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_goods` (`order_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='订单产品';

#
# Data for table "order_goods"
#

INSERT INTO `order_goods` VALUES (1,1,1,2,5,'/uploads/20181224/5c20dd1259cd1.jpg','Apple iPhone X (A1865) 64GB 银色','联通版',6499.00,3,0,'2019-01-05 21:43:27'),(2,2,2,9,5,'/uploads/20181224/5c20dd3ceca76.png','华为HUAWEI Mate20 X 幻影银(6G+128G)','16+512G',7999.00,50,1547694528,'2019-01-05 23:00:55'),(3,3,22,83,6,'/uploads/20181224/5c2d83190dea8.jpg','华为 HUAWEI nova 3全面屏高清四摄游戏手机 6GB+128GB 亮黑色 全网通移动联通电信4G手机','樱草金',2799.00,2,0,'2019-01-06 19:34:30'),(4,3,1,1,5,'/uploads/20181224/5c20dd1259cd1.jpg','Apple iPhone X (A1865) 64GB 银色','移动版',6399.00,2,0,'2019-01-06 19:34:30'),(5,4,4,15,8,'/uploads/20181224/5c20dd988d25f.jpg','vivo X23 8GB+128GB 幻夜蓝 水滴屏全面屏 游戏手机 移动联通电信全网通4G手机','幻夜蓝',3198.00,2,0,'2019-01-06 20:33:41'),(6,5,9,33,13,'/uploads/20181224/5c20e4b938669.jpg','Beats Studio3 Wireless 录音师无线3代 头戴式 蓝牙无线游戏耳机 - 魅影灰','荒漠沙',2858.00,2,0,'2019-01-06 20:45:53'),(7,6,11,42,5,'/uploads/20181224/5c2434759aa38.png','Apple iPhone XS Max (A2104) 256GB 金色 移动联通电信4G手机','512G',12799.00,2,1548382740,'2019-01-06 20:49:10'),(10,8,10,38,5,'/uploads/20181224/5c2431ccf2490.jpg','Apple iPhone 8 Plus (A1864) 64GB 金色 移动联通电信4G手机','银色256G',6899.00,1,0,'2019-01-06 21:04:11'),(11,9,8,25,12,'/uploads/20181224/5c20e2c232d7f.jpg','Apple MacBook Pro 15.4英寸笔记本电脑 深空灰色 配备2018新款','8+128G银',9699.00,2,1547690296,'2019-01-06 21:14:19'),(12,10,26,95,6,'/uploads/20181224/5c2d9fb21a1f8.jpg','华为 HUAWEI P20 Pro 全面屏徕卡三摄游戏手机 6GB+128GB 亮黑色 全网通移动联通电信4G手机','6+128G',4988.00,1,0,'2019-01-16 15:30:48'),(13,11,9,35,13,'/uploads/20181224/5c20e4b938669.jpg','Beats Studio3 Wireless 录音师无线3代 头戴式 蓝牙无线游戏耳机 - 魅影灰','陶瓷粉',2858.00,1,1547631205,'2019-01-16 17:33:08'),(14,11,1,1,5,'/uploads/20181224/5c20dd1259cd1.jpg','Apple iPhone X (A1865) 64GB 银色','移动版',6399.00,5,1547631205,'2019-01-16 17:33:08'),(15,12,6,20,5,'/uploads/20181224/5c20defd22445.jpg','微软（Microsoft）Surface Pro 6 二合一平板电脑笔记本 12.3英寸','8+128G',7588.00,2,0,'2019-01-16 17:35:58'),(16,12,5,19,5,'/uploads/20181224/5c20ddd9c7d79.jpg','Apple iPad Pro 11英寸平板电脑 2018年新款256G 全面屏/A12X芯片','银色',7699.00,1,0,'2019-01-16 17:35:58'),(17,13,4,16,8,'/uploads/20181224/5c20dd988d25f.jpg','vivo X23 8GB+128GB 幻夜蓝 水滴屏全面屏 游戏手机 移动联通电信全网通4G手机','幻影红',3198.00,1,1547887633,'2019-01-17 17:15:57'),(18,14,9,29,13,'/uploads/20181224/5c20e4b938669.jpg','Beats Studio3 Wireless 录音师无线3代 头戴式 蓝牙无线游戏耳机 - 魅影灰','魅影灰-限量款',2580.00,1,0,'2019-01-18 13:36:39'),(19,15,6,20,5,'/uploads/20181224/5c20defd22445.jpg','微软（Microsoft）Surface Pro 6 二合一平板电脑笔记本 12.3英寸','8+128G',7588.00,1,1547888366,'2019-01-19 16:57:01'),(20,16,3,10,5,'/uploads/20181224/5c20dd74829c8.jpg','小米Mix3 黑色  全网通4G 全面屏拍照游戏智能手机','6+128G',3299.00,3,1548396676,'2019-01-19 17:17:42'),(21,17,6,20,5,'/uploads/20181224/5c20defd22445.jpg','微软（Microsoft）Surface Pro 6 二合一平板电脑笔记本 12.3英寸','8+128G',7588.00,1,0,'2019-01-21 17:48:23'),(22,17,1,1,5,'/uploads/20181224/5c20dd1259cd1.jpg','Apple iPhone X (A1865) 64GB 银色','移动版',6399.00,1,0,'2019-01-21 17:48:23'),(23,18,11,42,5,'/uploads/20181224/5c2434759aa38.png','Apple iPhone XS Max (A2104) 256GB 金色 移动联通电信4G手机','512G',12799.00,1,0,'2019-01-24 17:20:04'),(24,18,8,25,12,'/uploads/20181224/5c20e2c232d7f.jpg','Apple MacBook Pro 15.4英寸笔记本电脑 深空灰色 配备2018新款','8+128G银',9699.00,1,0,'2019-01-24 17:20:04'),(25,19,22,80,6,'/uploads/20181224/5c2d83190dea8.jpg','华为 HUAWEI nova 3全面屏高清四摄游戏手机 6GB+128GB 亮黑色 全网通移动联通电信4G手机','浅艾蓝',2799.00,1,1548382702,'2019-01-25 09:31:24'),(26,20,22,80,6,'/uploads/20181224/5c2d83190dea8.jpg','华为 HUAWEI nova 3全面屏高清四摄游戏手机 6GB+128GB 亮黑色 全网通移动联通电信4G手机','浅艾蓝',2799.00,1,0,'2019-01-25 10:35:28'),(27,21,4,16,8,'/uploads/20181224/5c20dd988d25f.jpg','vivo X23 8GB+128GB 幻夜蓝 水滴屏全面屏 游戏手机 移动联通电信全网通4G手机','幻影红',3198.00,1,0,'2019-01-25 11:02:57'),(28,22,4,14,8,'/uploads/20181224/5c20dd988d25f.jpg','vivo X23 8GB+128GB 幻夜蓝 水滴屏全面屏 游戏手机 移动联通电信全网通4G手机','魅影紫',3198.00,1,0,'2019-01-25 13:51:37');

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

INSERT INTO `permissions` VALUES (1,'超级管理员组','1-29-30-31-2-3-4-5-6-7-8-9-18-28-10-11-12-13-14-15-16-19-27-17-20-21-22-23-24-25-26-32-33-34-35-36-37-38-39-40-79-80-81-82-83-84-41-42-43-44-45-46-47-48-49-50-51-78-62-63-64-65-66-67-68-69-71-70-72-73-74-75-76-77-52-53-54-55-56-57-58-59-61-85-86-87-88-89-90-91-92-93-94-95-96-97-98-99-100-101-102',1,'2018-11-06 16:15:51'),(2,'GUEST','1-29-30-31-2-3-4-6-7-8-28-33-34-35-36',1,'2018-11-07 16:04:06');

#
# Structure for table "recom"
#

DROP TABLE IF EXISTS `recom`;
CREATE TABLE `recom` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '推荐标题',
  `goods_title` varchar(255) NOT NULL DEFAULT '' COMMENT '产品标题',
  `info` varchar(255) NOT NULL DEFAULT '' COMMENT '推荐信息',
  `thumbnail` varchar(255) NOT NULL DEFAULT '' COMMENT '推荐图',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态：0=》关闭；1=》开启',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='产品图文推荐表';

#
# Data for table "recom"
#

INSERT INTO `recom` VALUES (1,1,'极致中的体验','Apple iPhone X (A1865) 64GB 银色','手机不紧紧是我们的通信工具，它已经是我们生活的一部分了，而这里，我们为你呈现的是一部分不可思议的产品','/uploads/20181224/5c20f3f833008.jpg',1,'2018-12-24 16:00:02'),(2,3,'为发烧友而生','小米Mix3 黑色  全网通4G 全面屏拍照游戏智能手机','我们是手机中的极客，我们专为手机而生，我们只做最好的，手机','/uploads/20181224/5c20f3efa4b61.jpg',1,'2018-12-24 16:01:14'),(3,6,'我们只为自己而做','微软（Microsoft）Surface Pro 6 二合一平板电脑笔记本 12.3英寸','自己是自己最好的自己，相信我们永远不会辜负自己，我们可以的。。。','/uploads/20181224/5c20f44e2a9ae.jpg',1,'2018-12-24 22:59:27');

#
# Structure for table "replace"
#

DROP TABLE IF EXISTS `replace`;
CREATE TABLE `replace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `order_id` int(11) unsigned DEFAULT NULL COMMENT '订单ID',
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '售后类型：1=》换货；2=》退货退款',
  `reason` varchar(255) DEFAULT NULL COMMENT '售后原因',
  `img` text COMMENT '问题产品图（多图拼接）【最多4张】',
  `info` text COMMENT '备注说明',
  `tickling` text COMMENT '平台反馈信息',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '售后处理状态：0=》受理中；1=》接受申请；2=》驳回申请；3=》产品回寄中；4=》重新发货中；5=》完成售后处理',
  `company` varchar(255) DEFAULT NULL COMMENT '快递公司',
  `waybill` varchar(255) DEFAULT NULL COMMENT '回寄产品运单号',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_order_goods_id` (`user_id`,`order_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='退换货订单';

#
# Data for table "replace"
#

INSERT INTO `replace` VALUES (1,2,12,5,1,'收到产品有损坏','/uploads/20190121/5c4584a3092e0.jpg-/uploads/20190121/5c4584a2f2940.jpg-/uploads/20190121/5c4584a2e8d00.jpg','我感觉我不是很喜欢','经过我们专业的查看，这不是我们的原因造成的，所以无法受理退换货申请',2,NULL,NULL,0,'2019-01-21 16:55:19'),(2,2,1,1,2,'收到产品与下单产品不符合','/uploads/20190122/5c4690e97f008.jpg-/uploads/20190122/5c4690e9684c0.jpg-/uploads/20190122/5c4690e863a88.jpg','我感觉我不是很喜欢','请尽快回传您的信息',5,'顺丰快递','5214585632546',0,'2019-01-22 11:41:42'),(3,2,17,1,1,'收到产品有损坏','/uploads/20190122/5c46ae0249890.jpg-/uploads/20190122/5c46ae0141f78.jpg-/uploads/20190122/5c46ae023ecb0.jpg-/uploads/20190122/5c46ae012fe68.jpg','',NULL,3,'顺丰快递','5524514785623',0,'2019-01-22 13:46:42'),(4,2,17,6,2,'产品有质量问题','/uploads/20190122/5c46ae2f61b48.jpg-/uploads/20190122/5c46ae2e55410.jpg','东西都坏了啊，，，，',NULL,1,NULL,NULL,0,'2019-01-22 13:46:42'),(5,2,18,8,1,'收到产品有损坏','/uploads/20190124/5c4984586c728.jpg-/uploads/20190124/5c49845762ed0.jpg','看看到底是什么原因啊。。。。','请尽快回寄完整产品给我们',5,'顺丰快递','26548741569853',0,'2019-01-24 17:25:14'),(6,2,18,11,2,'收到产品与下单产品不符合','/uploads/20190124/5c49846f88478.jpg-/uploads/20190124/5c49847080778.jpg-/uploads/20190124/5c49846f7a5d0.jpg','你们给我发的是什么东西啊。。。。','您的要求不符合我们的退货规定',2,NULL,NULL,0,'2019-01-24 17:25:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COMMENT='路由规则表';

#
# Data for table "router"
#

INSERT INTO `router` VALUES (1,'/aoogi/main','/','','控制面板','#xe679;',0,0,1,1,1,'2018-10-26 14:44:54'),(2,'','','','系统设置','#xe66a;',0,0,1,1,1,'2018-10-26 16:57:59'),(3,'/aoogi/adminer','/aoogi/adminer','admin/admin/index','管理员设置','#xe653;',2,0,1,1,1,'2018-10-26 16:59:16'),(4,'/aoogi/adminer/data','/aoogi/adminer/data','admin/admin/getData','管理员列表','',3,0,0,1,0,'2018-10-26 17:02:06'),(5,'/aoogi/adminer/create','/aoogi/adminer/create','admin/admin/create','新增管理员','',3,0,0,1,1,'2018-10-26 17:03:30'),(6,'/aoogi/adminer','/aoogi/adminer/save','admin/admin/save','保存管理员','',3,0,0,1,0,'2018-10-26 17:04:09'),(7,'/aoogi/adminer/edit/:id','/aoogi/adminer/edit/*','admin/admin/edit','编辑管理员','',3,0,0,1,1,'2018-10-26 17:05:38'),(8,'/aoogi/adminer/:id','/aoogi/adminer/update/*','admin/admin/update','更新管理员','',3,0,0,1,0,'2018-10-26 17:06:30'),(9,'/aoogi/adminer/:id','/aoogi/adminer/del/*','admin/admin/delete','删除管理员','',3,0,0,1,1,'2018-10-26 17:07:14'),(10,'/aoogi/router','/aoogi/router','admin/router/index','路由设置','#xe653;',2,0,1,1,1,'2018-10-30 10:41:29'),(11,'/aoogi/router/data','/aoogi/router/data','admin/router/getData','路由列表','',10,0,0,1,0,'2018-10-30 10:44:59'),(12,'/aoogi/router/create','/aoogi/router/create','admin/router/create','新增路由','',10,0,0,1,1,'2018-10-30 10:47:36'),(13,'/aoogi/router','/aoogi/router/save','admin/router/save','保存路由','',10,0,0,1,0,'2018-11-05 11:00:01'),(14,'/aoogi/router/edit/:id','/aoogi/router/edit/*','admin/router/edit','编辑路由','',10,0,0,1,1,'2018-11-05 11:44:50'),(15,'/aoogi/router/:id','/aoogi/router/update/*','admin/router/update','更新路由','',10,0,0,1,0,'2018-11-05 11:47:04'),(16,'/aoogi/router/:id','/aoogi/router/del/*','admin/router/delete','删除路由','',10,0,0,1,0,'2018-11-05 11:47:34'),(17,'/aoogi/permission','/aoogi/permission','admin/permission/index','权限设置','#xe653;',2,0,1,1,1,'2018-11-05 15:03:03'),(18,'/aoogi/adminer/status','/aoogi/adminer/status','admin/admin/setStatus','管理员状态','',3,0,0,1,0,'2018-11-07 09:12:01'),(19,'/aoogi/router/status','/aoogi/router/status','admin/router/setStatus','路由状态','',10,0,0,1,0,'2018-11-07 09:12:35'),(20,'/aoogi/permission/data','/aoogi/permission/data','admin/permission/getData','权限组列表','',17,0,0,1,0,'2018-11-07 09:14:05'),(21,'/aoogi/permission/status','/aoogi/permission/status','admin/permission/setStatus','权限组状态','',17,0,0,1,0,'2018-11-07 09:15:14'),(22,'/aoogi/permission/create','/aoogi/permission/create','admin/permission/create','新增权限组','',17,0,0,1,1,'2018-11-07 09:15:50'),(23,'/aoogi/permission','/aoogi/permission/save','admin/permission/save','保存权限组','',17,0,0,1,0,'2018-11-07 09:16:24'),(24,'/aoogi/permission/edit/:id','/aoogi/permission/edit/*','admin/permission/edit','编辑权限组','',17,0,0,1,1,'2018-11-07 09:16:52'),(25,'/aoogi/permission/:id','/aoogi/permission/update*','admin/permission/update','更新权限组','',17,0,0,1,0,'2018-11-07 09:17:36'),(26,'/aoogi/permission/:id','/aoogi/permission/del/*','admin/permission/delete','删除权限组','',17,0,0,1,0,'2018-11-07 09:18:20'),(27,'/aoogi/router/:id','/aoogi/router/read/*','admin/router/read','查看路由','',10,0,0,1,1,'2018-11-08 10:48:00'),(28,'/aoogi/adminer/:id','/aoogi/adminer/read/*','admin/admin/read','查看管理员','',3,0,0,1,1,'2018-11-09 14:07:38'),(29,'/aoogi/logout','/aoogi/logout','admin/home/logout','退出登录','',1,0,0,1,1,'2018-11-12 14:00:40'),(30,'/aoogi/error','/aoogi/error','admin/error/index','403错误','',1,0,0,1,1,'2018-11-13 14:07:32'),(31,'/aoogi/main','/','admin/home/main','主页','',1,0,0,1,1,'2018-11-15 12:02:01'),(32,'/aoogi/permission/:id','/aoogi/permission/read/*','admin/permission/read','查看权限组','',17,0,0,1,1,'2018-11-15 15:19:31'),(33,'/aoogi/config','/aoogi/config','admin/config/index','参数设置','#xe653;',2,0,1,1,1,'2018-11-15 16:35:12'),(34,'/aoogi/config/create','/aoogi/config/create','admin/config/create','新增参数','',33,0,0,1,1,'2018-11-15 16:44:30'),(35,'/aoogi/config','/aoogi/config/save','admin/config/save','保存参数','',33,0,0,1,0,'2018-11-15 17:05:08'),(36,'/aoogi/config/edit/:id','/aoogi/config/edit/*','admin/config/edit','编辑参数','',33,0,0,1,1,'2018-11-15 17:09:08'),(37,'/aoogi/config/:id','/aoogi/config/update/*','admin/config/update','更新参数','',33,0,0,1,0,'2018-11-16 10:34:21'),(38,'/aoogi/admin/*','/aoogi/admin/del/*','admin/config/delete','删除参数','',33,0,0,1,0,'2018-11-23 11:51:30'),(39,'','','','用户管理','#xe66a;',0,0,1,1,1,'2018-12-18 13:15:40'),(40,'/aoogi/user','/aoogi/user','admin/user/index','用户列表','#xe653;',39,0,1,1,1,'2018-12-18 13:17:55'),(41,'','','','产品管理','#xe66a;',0,0,1,1,1,'2018-12-18 13:20:09'),(42,'/aoogi/goods','/aoogi/goods','admin/goods/index','产品列表','#xe653;',41,0,1,1,1,'2018-12-18 13:21:47'),(43,'/aoogi/goods/data','/aoogi/goods/data','admin/goods/getData','产品数据','',42,0,0,1,1,'2018-12-18 13:24:18'),(44,'/aoogi/goods/create','/aoogi/goods/create','admin/goods/create','新增产品','',42,0,0,1,1,'2018-12-18 13:25:31'),(45,'/aoogi/goods/edit/:id','/aoogi/goods/edit/*','admin/goods/edit','编辑产品','',42,0,0,1,1,'2018-12-18 13:27:01'),(46,'/aoogi/goods/:id','/aoogi/goods/update/*','admin/goods/update','更新产品','',42,0,0,1,0,'2018-12-18 13:29:30'),(47,'/aoogi/goods','/aoogi/goods/save','admin/goods/save','保存产品','',42,0,0,1,0,'2018-12-18 13:30:39'),(48,'/aoogi/goods/:id','/aoogi/goods/del/*','admin/goods/delete','删除产品','',42,0,0,1,0,'2018-12-18 13:32:56'),(49,'/aoogi/goods/:id','/aoogi/goods/read/*','admin/goods/read','查看产品','',42,0,0,1,1,'2018-12-18 13:34:19'),(50,'/aoogi/goods/status','/aoogi/goods/status','admin/goods/setStatus','产品状态','',42,0,0,1,0,'2018-12-21 17:42:33'),(51,'/aoogi/goods/delOld/:id/:mode','/aoogi/goods/delOld/*/*','admin/goods/delOld','删除产品参数','',42,0,0,1,0,'2018-12-21 17:43:51'),(52,'','','','图片管理','#xe66a;',0,0,1,1,1,'2018-12-21 17:45:02'),(53,'/aoogi/banner','/aoogi/banner','admin/banner/index','Banner列表','#xe653;',52,0,1,1,1,'2018-12-21 17:46:56'),(54,'/aoogi/banner/data','/aoogi/banner/data','admin/banner/getData','banner数据','',53,0,0,1,0,'2018-12-21 17:49:16'),(55,'/aoogi/banner/create','/aoogi/banner/create','admin/banner/create','新增Banner','',53,0,0,1,1,'2018-12-21 17:50:28'),(56,'/aoogi/banner/edit/:id','/aoogi/banner/edit/*','admin/banner/edit','编辑Banner','',53,0,0,1,1,'2018-12-21 17:51:28'),(57,'/aoogi/banner','/aoogi/banner/save','admin/banner/save','保存Banner','',53,0,0,1,0,'2018-12-21 17:52:32'),(58,'/aoogi/banner/:id','/aoogi/banner/update/*','admin/banner/update','更新Banner','',53,0,0,1,0,'2018-12-21 17:55:57'),(59,'/aoogi/banner/:id','/aoogi/banner/del/*','admin/banner/delete','删除Banner','',53,0,0,1,0,'2018-12-21 17:57:03'),(61,'/aoogi/banner/status','/aoogi/banner/status','admin/banner/setStatus','Banner状态','',53,0,0,1,0,'2018-12-21 18:04:15'),(62,'/aoogi/classify','/aoogi/classify','admin/classify/index','分类列表','#xe653;',41,0,1,1,1,'2018-12-23 01:00:23'),(63,'/aoogi/classify/data','/aoogi/classify/data','admin/classify/getData','分类数据','',62,0,0,1,0,'2018-12-23 01:03:19'),(64,'/aoogi/classify/status','/aoogi/classify/status','admin/classify/setStatus','分类状态','',62,0,0,1,0,'2018-12-23 01:04:27'),(65,'/aoogi/classify/create','/aoogi/classify/create','admin/classify/create','新增分类','',62,0,0,1,1,'2018-12-23 01:05:59'),(66,'/aoogi/classify','/aoogi/classify/save','admin/classify/save','保存分类','',62,0,0,1,0,'2018-12-23 01:06:53'),(67,'/aoogi/classify/edit/:id','/aoogi/classify/edit/*','admin/classify/edit','编辑分类','',62,0,0,1,1,'2018-12-23 01:08:09'),(68,'/aoogi/classify/:id','/aoogi/classify/update/*','admin/classify/update','更新分类','',62,0,0,1,0,'2018-12-23 01:09:18'),(69,'/aoogi/classify/:id','/aoogi/classify/del/*','admin/classify/delete','删除分类','',62,0,0,1,0,'2018-12-23 01:09:32'),(70,'/aoogi/recom','/aoogi/recom','admin/recom/index','推荐列表','#xe653;',41,0,1,1,1,'2018-12-24 14:07:37'),(71,'/aoogi/recom/data','/aoogi/recom/data','admin/recom/getData','推荐数据','',62,0,0,1,0,'2018-12-24 14:09:42'),(72,'/aoogi/recom/status','/aoogi/recom/status','admin/recom/setStatus','推荐状态','',70,0,0,1,0,'2018-12-24 14:10:37'),(73,'/aoogi/recom/create','/aoogi/recom/create','admin/recom/create','新增推荐','',70,0,0,1,1,'2018-12-24 14:11:47'),(74,'/aoogi/recom','/aoogi/recom/save','admin/recom/save','保存推荐','',70,0,0,1,0,'2018-12-24 14:12:41'),(75,'/aoogi/recom/edit/:id','/aoogi/recom/edit/*','admin/recom/edit','编辑推荐','',70,0,0,1,1,'2018-12-24 14:13:36'),(76,'/aoogi/recom/:id','/aoogi/recom/update/:id','admin/recom/update','更新推荐','',70,0,0,1,0,'2018-12-24 14:14:40'),(77,'/aoogi/recom/:id','/aoogi/recom/del/:id','admin/recom/delete','删除推荐','',70,0,0,1,0,'2018-12-24 14:14:43'),(78,'/aoogi/goods/recom','/aoogi/goods/recom','admin/goods/setRecom','推荐产品状态','',42,0,0,1,0,'2018-12-24 14:16:20'),(79,'/aoogi/user/data','/aoogi/user/data','admin/user/getData','用户数据','',40,0,0,1,1,'2019-01-03 17:39:53'),(80,'/aoogi/user/status','/aoogi/user/status','admin/user/setStatus','用户状态','',40,0,0,1,0,'2019-01-03 17:40:46'),(81,'/aoogi/user/edit/:id','/aoogi/user/edit/*','admin/user/edit','编辑用户','',40,0,0,1,1,'2019-01-03 17:42:08'),(82,'/aoogi/user/:id','/aoogi/user/update/*','admin/user/update','更新用户','',40,0,0,1,0,'2019-01-03 17:43:05'),(83,'/aoogi/user/:id','/aoogi/user/del/*','admin/user/delete','删除用户','',40,0,0,1,0,'2019-01-03 17:43:56'),(84,'/aoogi/user/:id','/aoogi/user/read/*','admin/user/read','查看用户','',40,0,0,1,1,'2019-01-03 17:44:58'),(85,'','','','优惠券管理','#xe66a;',0,0,1,1,1,'2019-01-03 20:29:24'),(86,'/aoogi/coupon','/aoogi/coupon','admin/coupon/index','优惠券列表','#xe653;',85,0,1,1,1,'2019-01-03 20:33:49'),(87,'/aoogi/coupon/data','/aoogi/coupon/data','admin/coupon/getData','优惠券数据','',86,0,0,1,1,'2019-01-03 20:35:00'),(88,'/aoogi/coupon/status','/aoogi/coupon/status','admin/coupon/setStatus','优惠券状态','',86,0,0,1,0,'2019-01-03 20:37:05'),(89,'/aoogi/coupon/create','/aoogi/coupon/create','admin/coupon/create','新增优惠券','',86,0,0,1,1,'2019-01-03 20:52:52'),(90,'/aoogi/coupon','/aoogi/coupon/save','admin/coupon/save','保存优惠券','',86,0,0,1,0,'2019-01-03 20:55:38'),(91,'/aoogi/coupon/edit/:id','/aoogi/coupon/edit/*','admin/coupon/edit','编辑优惠券','',86,0,0,1,1,'2019-01-03 21:20:16'),(92,'/aoogi/coupon/:id','/aoogi/coupon/update/*','admin/coupon/update','更新优惠券','',86,0,0,1,0,'2019-01-03 21:27:52'),(93,'/aoogi/coupon/:id','/aoogi/coupon/del/*','admin/coupon/delete','删除优惠券','',86,0,0,1,0,'2019-01-03 21:44:04'),(94,'/aoogi/coupon/:id','/aoogi/coupon/read/*','admin/coupon/read','查看优惠券','',86,0,0,1,1,'2019-01-04 15:48:36'),(95,'','','','订单管理','#xe66a;',0,0,1,1,1,'2019-01-22 15:37:02'),(96,'/aoogi/order','/aoogi/order','admin/order/index','订单列表','#xe653;',95,0,1,1,1,'2019-01-22 15:39:08'),(97,'/aoogi/order/data/:type','/aoogi/order/data/*','admin/order/getData','订单数据','',96,0,0,1,0,'2019-01-22 15:40:12'),(98,'/aoogi/order/:id','/aoogi/order/read/*','admin/order/read','查看订单','',96,0,0,1,1,'2019-01-23 10:25:54'),(99,'/aoogi/order/edit/:id','/aoogi/order/edit/*','admin/order/edit','编辑订单','',96,0,0,1,1,'2019-01-23 11:04:10'),(100,'/aoogi/order/:id','/aoogi/order/update/*','admin/order/update','更新订单','',96,0,0,1,0,'2019-01-23 11:05:10'),(101,'/aoogi/order/shipment/:id','/aoogi/order/shipment/*','admin/order/shipment','订单发货状态','',96,0,0,1,0,'2019-01-23 14:58:31'),(102,'/aoogi/replace/complete/:order_id/:id','/aoogi/replace/complete/*/*','admin/order/replaceComplete','完成售后服务','',96,0,0,1,0,'2019-01-25 11:44:24'),(103,'/aoogi/order/reserve','/aoogi/order/reserve','admin/order/reserve','预生成订单','#xe653;',95,0,1,1,1,'2019-01-26 10:31:58'),(104,'/aoogi/replace/update/:order_id','/aoogi/replace/update/*','admin/order/replaceUpdate','更新售后服务','',96,0,0,1,0,'2019-01-26 16:23:26'),(105,'/aoogi/order/:id','/aoogi/order/del/*','admin/order/delete','删除订单','',96,0,0,1,0,'2019-01-26 16:26:04'),(106,'/aoogi/order/replace','/aoogi/order/replace','admin/order/replace','申请售后订单','#xe653;',95,0,1,1,1,'2019-01-26 16:31:41'),(107,'/aoogi/logistics','/aoogi/logistics','admin/logistics/index','回寄物流设置','#xe653;',95,0,1,1,1,'2019-01-26 16:46:11'),(108,'/aoogi/logistics/data','/aoogi/logistics/data','admin/logistics/getData','物流数据','',107,0,0,1,0,'2019-01-26 16:47:10'),(109,'/aoogi/logistics/create','/aoogi/logistics/create','admin/logistics/create','新增物流','',107,0,0,1,1,'2019-01-26 16:47:51'),(110,'/aoogi/logistics','/aoogi/logistics/save','admin/logistics/save','保存物流','',107,0,0,1,0,'2019-01-26 16:48:36'),(111,'/aoogi/logistics/edit/:id','/aoogi/logistics/edit/*','admin/logistics/edit','编辑物流','',107,0,0,1,1,'2019-01-26 16:49:20'),(112,'/aoogi/logistics/:id','/aoogi/logistics/update/*','admin/logistics/update','更新物流','',107,0,0,1,0,'2019-01-26 16:49:50'),(113,'/aoogi/logistics/:id','/aoogi/logistics/del/*','admin/logistics/delete','删除物流','',107,0,0,1,0,'2019-01-26 16:50:21');

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
  `integral` float(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '用户积分',
  `sex` tinyint(1) unsigned DEFAULT '0' COMMENT '性别：1=》男；0=》女',
  `birthday` varchar(10) DEFAULT NULL COMMENT '生日',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '帐户状态：1=》正常；0=》禁用',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'Libai','96e79218965eb72c92a549dd5a330112','18297905432','/static/index/images/default-head-1.png',0.00,0.00,1,NULL,1,0,'2018-10-10 15:08:34','2019-01-03 18:23:09'),(2,'Wangwe','96e79218965eb72c92a549dd5a330112','13564078415','/static/index/images/default-head-1.png',652481.00,11334.90,1,'1990-12-08',1,0,'2018-10-10 15:08:55','2019-01-26 17:50:16'),(5,'用户7006','96e79218965eb72c92a549dd5a330112','18297905431','/static/index/images/default-head-0.png',0.00,0.00,0,NULL,1,0,'2018-12-17 14:00:49','2019-01-04 17:14:34'),(6,'用户70888','96e79218965eb72c92a549dd5a330112','13564078418','/static/index/images/default-head-1.png',0.00,0.00,1,'2019-01-09',1,0,'2018-12-17 14:02:38','2019-01-03 20:19:20');

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
