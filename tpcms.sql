# Host: localhost  (Version: 5.7.17)
# Date: 2018-12-25 18:49:14
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

INSERT INTO `adminer` VALUES (1,'admin','96e79218965eb72c92a549dd5a330112','Amdin',1,1,1,'admin12sdf','127.0.0.1',1545539492,29,'2018-10-23 13:54:17'),(2,'guest','96e79218965eb72c92a549dd5a330112','guest',1,2,0,'guest','127.0.0.1',1542962077,7,'2018-10-23 15:16:25'),(3,'tests','96e79218965eb72c92a549dd5a330112','Test',1,2,0,'TEST',NULL,NULL,0,'2018-11-14 13:13:10'),(4,'test123','96e79218965eb72c92a549dd5a330112','TEST',0,1,0,'TEST',NULL,NULL,0,'2018-11-23 13:53:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='产品分类';

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
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '收藏状态：0=》正常；1=》删除',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `collect` (`user_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='我的收藏';

#
# Data for table "collect"
#


#
# Structure for table "comments"
#

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `goods_id` int(11) unsigned DEFAULT NULL COMMENT '产品ID',
  `content` text COMMENT '评论内容',
  `img` text COMMENT '评论图片（多图拼接）',
  `laud` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，删除则为时间戳',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间（时间戳）',
  PRIMARY KEY (`id`),
  KEY `comments` (`goods_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='产品评论表';

#
# Data for table "comments"
#

INSERT INTO `comments` VALUES (1,4,1,'我住长江头，君住长江尾。日日思君不见君，共饮长江水。 此水几时休，此恨何时已。只愿君心似我心，定不负相思意。','/uploads/20181224/5c20dd44da2e0.png-/uploads/20181224/5c20dd45d12da.png-/uploads/20181224/5c20dd44d1826.png-/uploads/20181224/5c20dd44cd197.png',5,0,1545344614),(2,5,1,'春归何处。寂寞无行路。若有人知春去处。唤取归来同住。 春无踪迹谁知。除非问取黄鹂。百啭无人能解，因风飞过蔷薇。','/uploads/20181224/5c20dd44da2e0.png-/uploads/20181224/5c20dd45d12da.png-/uploads/20181224/5c20dd44d1826.png-/uploads/20181224/5c20dd44cd197.png',3,0,1545548047),(3,6,1,'当年万里觅封侯，匹马戍梁州。关河梦断何处？尘暗旧貂裘。胡未灭，鬓先秋，泪空流。此生谁料，心在天山，身老沧洲。','/uploads/20181224/5c20dd44da2e0.png-/uploads/20181224/5c20dd45d12da.png-/uploads/20181224/5c20dd44d1826.png-/uploads/20181224/5c20dd44cd197.png',9,0,1545656454),(4,2,1,'大江东去，浪淘尽，千古风流人物。故垒西边，人道是，三国周郎赤壁。乱石穿空，惊涛拍岸，卷起千堆雪。',NULL,4,0,1545656454);

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
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '优惠券使用状态：0/未记录=》未使用；1=》下单使用中；2=》完成使用',
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='产品表';

#
# Data for table "goods"
#

INSERT INTO `goods` VALUES (1,'Apple iPhone X (A1865) 64GB 银色','Apple产品年末狂欢特惠，限时限量抢购，券后价6299元',5,1,'/uploads/20181224/5c20dd1259cd1.jpg','/uploads/20181224/5c20dd1ecd4d2.jpg-/uploads/20181224/5c20dd1ec614c.jpg-/uploads/20181224/5c20dd1ec1cf9.jpg-/uploads/20181224/5c20dd1ebdb2a.jpg',6499.00,6299.00,5500.00,10.00,532,'合肥','&lt;p&gt;\n\t&lt;img src=&quot;/uploads/20181224/5c20dd2ec7ae1.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd2eda5ad.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd2eea4a6.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd2f0607c.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd2f19ad6.jpg&quot; alt=&quot;&quot; /&gt; \n&lt;/p&gt;',1,1,0,'2018-12-20 22:38:38','2018-12-25 13:38:07'),(2,'华为HUAWEI Mate20 X 幻影银(6G+128G)','发现美丽的眼睛  这是深藏智慧的目光',6,1,'/uploads/20181224/5c20dd3ceca76.png','/uploads/20181224/5c20dd44da2e0.png-/uploads/20181224/5c20dd45d12da.png-/uploads/20181224/5c20dd44d1826.png-/uploads/20181224/5c20dd44cd197.png',5100.00,4899.00,4500.00,0.00,899,'合肥','&lt;p&gt;\n\t&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n\t我们都是好孩子 的\n&lt;/p&gt;\n&lt;p&gt;\n\t&lt;img src=&quot;/uploads/20181224/5c20dd57d2763.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd57ea444.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd58105eb.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd5820c13.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd583115e.png&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;',1,1,0,'2018-12-20 23:57:32','2018-12-25 11:22:01'),(3,'小米Mix3 黑色  全网通4G 全面屏拍照游戏智能手机','磁动力滑盖全面屏，前后旗舰 AI 双摄，四曲面彩色陶瓷机身，高效10W无线充电',7,1,'/uploads/20181224/5c20dd74829c8.jpg','/uploads/20181224/5c20dd7abe2da.jpg-/uploads/20181224/5c20dd7ab9975.jpg-/uploads/20181224/5c20dd7ab54f3.jpg',3400.00,3299.00,2800.00,0.00,562,'合肥','&gt;&lt;img src=&quot;/uploads/20181224/5c20dd870377b.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd871f549.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd872e5c8.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dd873e7c6.jpg&quot; alt=&quot;&quot; /&gt; \n&lt;/p&gt;',1,1,0,'2018-12-21 15:30:23','2018-12-25 13:38:06'),(4,'vivo X23 8GB+128GB 幻夜蓝 水滴屏全面屏 游戏手机 移动联通电信全网通4G手机','128G大内存！AI非凡摄影，超大广角，发现更多美！',8,1,'/uploads/20181224/5c20dd988d25f.jpg','/uploads/20181224/5c20dd9e583db.jpg-/uploads/20181224/5c20dd9e52154.jpg-/uploads/20181224/5c20dd9e4c8d6.jpg-/uploads/20181224/5c20dd9e4759a.jpg',3400.00,3198.00,2780.00,5.00,563,'合肥','&lt;img src=&quot;/uploads/20181224/5c2056ab87be0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2056ab97db0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2056aba9ec0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2056abb8920.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c2056abc7f38.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda74c14a.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda75fab4.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda770178.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda77f8c0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20dda790ce3.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 11:51:45','2018-12-25 13:24:47'),(5,'Apple iPad Pro 11英寸平板电脑 2018年新款256G 全面屏/A12X芯片','A12X芯片、Retina全面屏、面容解锁、强力续航',9,2,'/uploads/20181224/5c20ddd9c7d79.jpg','/uploads/20181224/5c20dddfe83b4.jpg-/uploads/20181224/5c20dddfdeda3.jpg-/uploads/20181224/5c20dddfd903d.jpg-/uploads/20181224/5c20dddfd4ff6.jpg',8000.00,7688.00,6500.00,10.00,320,'合肥','&lt;img src=&quot;/uploads/20181224/5c20de0d08160.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20de0d230f4.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20de0d33592.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20de0d4112a.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20de0d55b35.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:27:46','2018-12-25 11:21:48'),(6,'微软（Microsoft）Surface Pro 6 二合一平板电脑笔记本 12.3英寸','SurfacePro第五代i5/8G+128G/键盘套装 限时5988秒杀',10,2,'/uploads/20181224/5c20defd22445.jpg','/uploads/20181224/5c20df019f27b.jpg-/uploads/20181224/5c20df01990b9.jpg-/uploads/20181224/5c20df0190c02.jpg-/uploads/20181224/5c20df0188132.jpg',7900.00,7588.00,6900.00,0.00,365,'合肥','&lt;img src=&quot;/uploads/20181224/5c20df2b18beb.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20df2b2bef0.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20df2b39d55.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20df2b4a1e7.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20df2b59dc1.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:31:36','2018-12-25 11:21:05'),(7,'联想ThinkPad 翼480（12CD）14英寸轻薄窄边框笔记本电脑 冰原银','全新一代翼490轻薄笔记本27日全面开售',11,3,'/uploads/20181224/5c20e13bd84d0.jpg','/uploads/20181224/5c20e14046ff7.jpg-/uploads/20181224/5c20e1413eb1c.jpg-/uploads/20181224/5c20e1403acbd.jpg-/uploads/20181224/5c20e1402f952.jpg',9000.00,8499.00,7200.00,5.00,1254,'合肥','&lt;img src=&quot;/uploads/20181224/5c20e16e2f5fe.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e16e481c4.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e16e58d7f.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e16e6859b.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e16e7eaee.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:43:48','2018-12-25 11:20:54'),(8,'Apple MacBook Pro 15.4英寸笔记本电脑 深空灰色 配备2018新款','六核八代i7 16G 256G固态硬盘 MR932CH/A',12,3,'/uploads/20181224/5c20e2c232d7f.jpg','/uploads/20181224/5c20e48551612.jpg-/uploads/20181224/5c20e48541b22.jpg-/uploads/20181224/5c20e4844a707.jpg',15000.00,11200.00,10000.00,25.00,256,'合肥','&lt;img src=&quot;/uploads/20181224/5c20e3221aa15.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e3222e91d.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e3223dded.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e3224d8e6.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:52:06','2018-12-25 11:20:45'),(9,'Beats Studio3 Wireless 录音师无线3代 头戴式 蓝牙无线游戏耳机 - 魅影灰','圣诞狂欢,表白选好礼',13,4,'/uploads/20181224/5c20e4b938669.jpg','/uploads/20181224/5c20e4bd75461.jpg-/uploads/20181224/5c20e4bd709ee.jpg-/uploads/20181224/5c20e4bd697f9.jpg-/uploads/20181224/5c20e4bd63502.jpg',3200.00,2580.00,1900.00,15.00,2356,'合肥','&lt;img src=&quot;/uploads/20181224/5c20e4db0f691.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e4db22f2f.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e4db32520.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e4db43296.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/uploads/20181224/5c20e4db52637.jpg&quot; alt=&quot;&quot; /&gt;',1,1,0,'2018-12-24 21:58:35','2018-12-25 13:38:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='产品参数表';

#
# Data for table "goods_param"
#

INSERT INTO `goods_param` VALUES (1,1,'品牌','Apple'),(2,1,'系列型号','iPhone X'),(3,1,'入网型号','A1865'),(4,1,'上市年份','2017年'),(5,1,'操作系统','IOS'),(6,1,'ROM','6G'),(7,1,'屏幕尺寸','5.8英寸'),(8,1,'摄像头','700万像素'),(9,2,'品牌','华为'),(10,2,'系列型号','Mate20 X'),(11,2,'颜色','银色'),(12,2,'CPU','Hisilicon'),(13,2,'操作系统','Android'),(14,2,'屏幕尺寸','7.2英寸'),(15,2,'摄像头','2400万像素'),(16,2,'上市年份','2018年'),(21,2,'产地','深圳'),(22,3,'品牌','小米（MI）'),(23,3,'系列型号','MIX3'),(24,3,'机身颜色','黑色'),(25,3,'操作系统','Android'),(26,3,'屏幕尺寸','6.39 英寸'),(27,3,'摄像头','200万像素'),(28,4,'品牌','VIVO'),(29,4,'系列型号','vivo X'),(30,4,'入网型号','V1809A'),(31,4,'操作系统','Android'),(32,4,'CPU品牌','骁龙（Snapdragon)'),(33,4,'ROM','128GB'),(34,4,'屏幕尺寸','6.41英寸'),(35,4,'摄像头','1200万像素'),(36,4,'上市年份','2018年'),(37,5,'品牌','APPLE'),(38,5,'认证型号','MTXR2CH/A'),(39,5,'处理器','A12X 仿生'),(40,5,'摄像头','1200W'),(41,5,'电池容量','29.37瓦时'),(42,5,'屏幕尺寸','11 英寸'),(43,6,'品牌','Microsoft'),(44,6,'认证型号','Surface Pro 6'),(45,6,'操作系统','Windows 10'),(46,6,'处理器','i5-8250U'),(47,6,'屏幕描述','12.3 英寸'),(48,6,'摄像头','500W'),(49,7,'品牌','ThinkPad'),(50,7,'系列型号','ThinkPad E480'),(51,7,'操作系统','Windows 10 家庭版'),(52,7,'CPU型号','i7-8550U'),(53,7,'内存容量','16GB'),(54,7,'显示类型','AMD GDDR5 独立显存'),(55,7,'屏幕尺寸','14英寸'),(56,8,'品牌','Apple'),(57,8,'认证型号','MPXU2CH/A'),(58,8,'操作系统','Mac OS'),(59,8,'CPU类型','Intel 第7代 酷睿'),(60,8,'内存容量','8GB'),(61,8,'屏幕规格','13.3英寸'),(62,8,'硬盘容量','256GB SSD'),(63,9,'品牌','beats'),(64,9,'系列型号','studio 3'),(65,9,'商品毛重','1.13kg'),(66,9,'连接类型','无线'),(67,9,'佩戴方式','头戴式');

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='产品规格表';

#
# Data for table "goods_spec"
#

INSERT INTO `goods_spec` VALUES (1,1,'移动版',6399.00,500,0,'2018-12-25 11:21:56'),(2,1,'联通版',6499.00,260,0,'2018-12-25 11:21:56'),(3,1,'电信版',6599.00,320,0,'2018-12-25 11:21:56'),(4,2,'6+128G',4899.00,1200,0,'2018-12-25 11:22:01'),(5,2,'8+256G',5999.00,1100,0,'2018-12-25 11:22:01'),(9,2,'16+512G',7999.00,860,0,'2018-12-25 11:22:01'),(10,3,'6+128G',3299.00,254,0,'2018-12-25 11:21:38'),(11,3,'8+128G',3599.00,485,0,'2018-12-25 11:21:38'),(12,3,'8+256G',3999.00,958,1545381542,'2018-12-21 15:30:23'),(13,3,'8+256G',4999.00,258,1545383114,'2018-12-21 16:59:24'),(14,4,'魅影紫',3198.00,254,0,'2018-12-25 11:21:32'),(15,4,'幻夜蓝',3198.00,653,0,'2018-12-25 11:21:32'),(16,4,'幻影红',3198.00,354,0,'2018-12-25 11:21:32'),(17,4,'星芒',3198.00,452,0,'2018-12-25 11:21:32'),(18,5,'深空灰色',7680.00,1200,0,'2018-12-25 11:21:48'),(19,5,'银色',7699.00,1100,0,'2018-12-25 11:21:48'),(20,6,'8+128G',7588.00,2400,0,'2018-12-25 11:21:24'),(21,7,'i5+8g+独显',5499.00,2100,0,'2018-12-25 11:20:54'),(22,7,'i5+8g+集显',5099.00,1520,0,'2018-12-25 11:20:54'),(23,7,'i7+8g+独显',7499.00,3210,0,'2018-12-25 11:20:54'),(24,7,'i7+8g+集显',8499.00,560,0,'2018-12-25 11:20:54'),(25,8,'8+128G银',9699.00,245,0,'2018-12-25 11:20:45'),(26,8,'8+256G银',11299.00,245,0,'2018-12-25 11:20:45'),(27,8,'8+128G灰',9699.00,245,0,'2018-12-25 11:20:45'),(28,8,'8+256G灰',11299.00,245,0,'2018-12-25 11:20:45'),(29,9,'魅影灰-限量款',2580.00,254,0,'2018-12-25 11:20:27'),(30,9,'桀骜黑红',2580.00,254,0,'2018-12-25 11:20:27'),(31,9,'午夜黑',2858.00,254,0,'2018-12-25 11:20:27'),(32,9,'水晶蓝',2858.00,254,0,'2018-12-25 11:20:27'),(33,9,'荒漠沙',2858.00,254,0,'2018-12-25 11:20:27'),(34,9,'哑光黑',2388.00,254,0,'2018-12-25 11:20:27'),(35,9,'陶瓷粉',2858.00,254,0,'2018-12-25 11:20:27');

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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COMMENT='路由规则表';

#
# Data for table "router"
#

INSERT INTO `router` VALUES (1,'/aoogi/main','/','','控制面板','#xe679;',0,0,1,1,1,'2018-10-26 14:44:54'),(2,'','','','系统设置','#xe66a;',0,0,1,1,1,'2018-10-26 16:57:59'),(3,'/aoogi/adminer','/aoogi/adminer','admin/admin/index','管理员设置','#xe653;',2,0,1,1,1,'2018-10-26 16:59:16'),(4,'/aoogi/adminer/data','/aoogi/adminer/data','admin/admin/getData','管理员列表','',3,0,0,1,0,'2018-10-26 17:02:06'),(5,'/aoogi/adminer/create','/aoogi/adminer/create','admin/admin/create','新增管理员','',3,0,0,1,1,'2018-10-26 17:03:30'),(6,'/aoogi/adminer','/aoogi/adminer/save','admin/admin/save','保存管理员','',3,0,0,1,0,'2018-10-26 17:04:09'),(7,'/aoogi/adminer/edit/:id','/aoogi/adminer/edit/*','admin/admin/edit','编辑管理员','',3,0,0,1,1,'2018-10-26 17:05:38'),(8,'/aoogi/adminer/:id','/aoogi/adminer/update/*','admin/admin/update','更新管理员','',3,0,0,1,0,'2018-10-26 17:06:30'),(9,'/aoogi/adminer/:id','/aoogi/adminer/del/*','admin/admin/delete','删除管理员','',3,0,0,1,1,'2018-10-26 17:07:14'),(10,'/aoogi/router','/aoogi/router','admin/router/index','路由设置','#xe653;',2,0,1,1,1,'2018-10-30 10:41:29'),(11,'/aoogi/router/data','/aoogi/router/data','admin/router/getData','路由列表','',10,0,0,1,0,'2018-10-30 10:44:59'),(12,'/aoogi/router/create','/aoogi/router/create','admin/router/create','新增路由','',10,0,0,1,1,'2018-10-30 10:47:36'),(13,'/aoogi/router','/aoogi/router/save','admin/router/save','保存路由','',10,0,0,1,0,'2018-11-05 11:00:01'),(14,'/aoogi/router/edit/:id','/aoogi/router/edit/*','admin/router/edit','编辑路由','',10,0,0,1,1,'2018-11-05 11:44:50'),(15,'/aoogi/router/:id','/aoogi/router/update/*','admin/router/update','更新路由','',10,0,0,1,0,'2018-11-05 11:47:04'),(16,'/aoogi/router/:id','/aoogi/router/del/*','admin/router/delete','删除路由','',10,0,0,1,0,'2018-11-05 11:47:34'),(17,'/aoogi/permission','/aoogi/permission','admin/permission/index','权限设置','#xe653;',2,0,1,1,1,'2018-11-05 15:03:03'),(18,'/aoogi/adminer/status','/aoogi/adminer/status','admin/admin/setStatus','管理员状态','',3,0,0,1,0,'2018-11-07 09:12:01'),(19,'/aoogi/router/status','/aoogi/router/status','admin/router/setStatus','路由状态','',10,0,0,1,0,'2018-11-07 09:12:35'),(20,'/aoogi/permission/data','/aoogi/permission/data','admin/permission/getData','权限组列表','',17,0,0,1,0,'2018-11-07 09:14:05'),(21,'/aoogi/permission/status','/aoogi/permission/status','admin/permission/setStatus','权限组状态','',17,0,0,1,0,'2018-11-07 09:15:14'),(22,'/aoogi/permission/create','/aoogi/permission/create','admin/permission/create','新增权限组','',17,0,0,1,1,'2018-11-07 09:15:50'),(23,'/aoogi/permission','/aoogi/permission/save','admin/permission/save','保存权限组','',17,0,0,1,0,'2018-11-07 09:16:24'),(24,'/aoogi/permission/edit/:id','/aoogi/permission/edit/*','admin/permission/edit','编辑权限组','',17,0,0,1,1,'2018-11-07 09:16:52'),(25,'/aoogi/permission/:id','/aoogi/permission/update*','admin/permission/update','更新权限组','',17,0,0,1,0,'2018-11-07 09:17:36'),(26,'/aoogi/permission/:id','/aoogi/permission/del/*','admin/permission/delete','删除权限组','',17,0,0,1,0,'2018-11-07 09:18:20'),(27,'/aoogi/router/:id','/aoogi/router/read/*','admin/router/read','查看路由','',10,0,0,1,1,'2018-11-08 10:48:00'),(28,'/aoogi/adminer/:id','/aoogi/adminer/read/*','admin/admin/read','查看管理员','',3,0,0,1,1,'2018-11-09 14:07:38'),(29,'/aoogi/logout','/aoogi/logout','admin/home/logout','退出登录','',1,0,0,1,1,'2018-11-12 14:00:40'),(30,'/aoogi/error','/aoogi/error','admin/error/index','403错误','',1,0,0,1,1,'2018-11-13 14:07:32'),(31,'/aoogi/main','/','admin/home/main','主页','',1,0,0,1,1,'2018-11-15 12:02:01'),(32,'/aoogi/permission/:id','/aoogi/permission/read/*','admin/permission/read','查看权限组','',17,0,0,1,1,'2018-11-15 15:19:31'),(33,'/aoogi/config','/aoogi/config','admin/config/index','参数设置','#xe653;',2,0,1,1,1,'2018-11-15 16:35:12'),(34,'/aoogi/config/create','/aoogi/config/create','admin/config/create','新增参数','',33,0,0,1,1,'2018-11-15 16:44:30'),(35,'/aoogi/config','/aoogi/config/save','admin/config/save','保存参数','',33,0,0,1,0,'2018-11-15 17:05:08'),(36,'/aoogi/config/edit/:id','/aoogi/config/edit/*','admin/config/edit','编辑参数','',33,0,0,1,1,'2018-11-15 17:09:08'),(37,'/aoogi/config/:id','/aoogi/config/update/*','admin/config/update','更新参数','',33,0,0,1,0,'2018-11-16 10:34:21'),(38,'/aoogi/admin/*','/aoogi/admin/del/*','admin/config/delete','删除参数','',33,0,0,1,0,'2018-11-23 11:51:30'),(39,'','','','用户管理','#xe66a;',0,0,1,1,1,'2018-12-18 13:15:40'),(40,'/aoogi/user','/aoogi/user','admin/user/index','用户列表','#xe653;',39,0,1,1,1,'2018-12-18 13:17:55'),(41,'','','','产品管理','#xe66a;',0,0,1,1,1,'2018-12-18 13:20:09'),(42,'/aoogi/goods','/aoogi/goods','admin/goods/index','产品列表','#xe653;',41,0,1,1,1,'2018-12-18 13:21:47'),(43,'/aoogi/goods/data','/aoogi/goods/data','admin/goods/getData','产品数据','',42,0,0,1,1,'2018-12-18 13:24:18'),(44,'/aoogi/goods/create','/aoogi/goods/create','admin/goods/create','新增产品','',42,0,0,1,1,'2018-12-18 13:25:31'),(45,'/aoogi/goods/edit/:id','/aoogi/goods/edit/*','admin/goods/edit','编辑产品','',42,0,0,1,1,'2018-12-18 13:27:01'),(46,'/aoogi/goods/:id','/aoogi/goods/update/*','admin/goods/update','更新产品','',42,0,0,1,0,'2018-12-18 13:29:30'),(47,'/aoogi/goods','/aoogi/goods/save','admin/goods/save','保存产品','',42,0,0,1,0,'2018-12-18 13:30:39'),(48,'/aoogi/goods/:id','/aoogi/goods/del/*','admin/goods/delete','删除产品','',42,0,0,1,0,'2018-12-18 13:32:56'),(49,'/aoogi/goods/:id','/aoogi/goods/read/*','admin/goods/read','查看产品','',42,0,0,1,1,'2018-12-18 13:34:19'),(50,'/aoogi/goods/status','/aoogi/goods/status','admin/goods/setStatus','产品状态','',42,0,0,1,0,'2018-12-21 17:42:33'),(51,'/aoogi/goods/delOld/:id/:mode','/aoogi/goods/delOld/*/*','admin/goods/delOld','删除产品参数','',42,0,0,1,0,'2018-12-21 17:43:51'),(52,'','','','图片管理','#xe66a;',0,0,1,1,1,'2018-12-21 17:45:02'),(53,'/aoogi/banner','/aoogi/banner','admin/banner/index','Banner列表','#xe653;',52,0,1,1,1,'2018-12-21 17:46:56'),(54,'/aoogi/banner/data','/aoogi/banner/data','admin/banner/getData','banner数据','',53,0,0,1,0,'2018-12-21 17:49:16'),(55,'/aoogi/banner/create','/aoogi/banner/create','admin/banner/create','新增Banner','',53,0,0,1,1,'2018-12-21 17:50:28'),(56,'/aoogi/banner/edit/:id','/aoogi/banner/edit/*','admin/banner/edit','编辑Banner','',53,0,0,1,1,'2018-12-21 17:51:28'),(57,'/aoogi/banner','/aoogi/banner/save','admin/banner/save','保存Banner','',53,0,0,1,0,'2018-12-21 17:52:32'),(58,'/aoogi/banner/:id','/aoogi/banner/update/*','admin/banner/update','更新Banner','',53,0,0,1,0,'2018-12-21 17:55:57'),(59,'/aoogi/banner/:id','/aoogi/banner/del/*','admin/banner/delete','删除Banner','',53,0,0,1,0,'2018-12-21 17:57:03'),(61,'/aoogi/banner/status','/aoogi/banner/status','admin/banner/setStatus','Banner状态','',53,0,0,1,0,'2018-12-21 18:04:15'),(62,'/aoogi/classify','/aoogi/classify','admin/classify/index','分类列表','#xe653;',41,0,1,1,1,'2018-12-23 01:00:23'),(63,'/aoogi/classify/data','/aoogi/classify/data','admin/classify/getData','分类数据','',62,0,0,1,0,'2018-12-23 01:03:19'),(64,'/aoogi/classify/status','/aoogi/classify/status','admin/classify/setStatus','分类状态','',62,0,0,1,0,'2018-12-23 01:04:27'),(65,'/aoogi/classify/create','/aoogi/classify/create','admin/classify/create','新增分类','',62,0,0,1,1,'2018-12-23 01:05:59'),(66,'/aoogi/classify','/aoogi/classify/save','admin/classify/save','保存分类','',62,0,0,1,0,'2018-12-23 01:06:53'),(67,'/aoogi/classify/edit/:id','/aoogi/classify/edit/*','admin/classify/edit','编辑分类','',62,0,0,1,1,'2018-12-23 01:08:09'),(68,'/aoogi/classify/:id','/aoogi/classify/update/*','admin/classify/update','更新分类','',62,0,0,1,0,'2018-12-23 01:09:18'),(69,'/aoogi/classify/:id','/aoogi/classify/del/*','admin/classify/delete','删除分类','',62,0,0,1,0,'2018-12-23 01:09:32'),(70,'/aoogi/recom','/aoogi/recom','admin/recom/index','推荐列表','#xe653;',41,0,1,1,1,'2018-12-24 14:07:37'),(71,'/aoogi/recom/data','/aoogi/recom/data','admin/recom/getData','推荐数据','',62,0,0,1,0,'2018-12-24 14:09:42'),(72,'/aoogi/recom/status','/aoogi/recom/status','admin/recom/setStatus','推荐状态','',70,0,0,1,0,'2018-12-24 14:10:37'),(73,'/aoogi/recom/create','/aoogi/recom/create','admin/recom/create','新增推荐','',70,0,0,1,1,'2018-12-24 14:11:47'),(74,'/aoogi/recom','/aoogi/recom/save','admin/recom/save','保存推荐','',70,0,0,1,0,'2018-12-24 14:12:41'),(75,'/aoogi/recom/edit/:id','/aoogi/recom/edit/*','admin/recom/edit','编辑推荐','',70,0,0,1,1,'2018-12-24 14:13:36'),(76,'/aoogi/recom/:id','/aoogi/recom/update/:id','admin/recom/update','更新推荐','',70,0,0,1,0,'2018-12-24 14:14:40'),(77,'/aoogi/recom/:id','/aoogi/recom/del/:id','admin/recom/delete','删除推荐','',70,0,0,1,0,'2018-12-24 14:14:43'),(78,'/aoogi/goods/recom','/aoogi/goods/recom','admin/goods/setRecom','推荐产品状态','',42,0,0,1,0,'2018-12-24 14:16:20');

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
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '帐户状态：1=》正常；0=》禁用',
  `isdelete` int(10) DEFAULT NULL COMMENT '是否删除，若删除则为删除时间戳',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'Libai','96e79218965eb72c92a549dd5a330112','18297905432','/static/index/images/default-head-1.png',0.00,1,NULL,1,NULL,'2018-10-10 15:08:34','2018-12-25 14:37:25'),(2,'Wangwei','96e79218965eb72c92a549dd5a330112','13564078415','/static/index/images/default-head-1.png',0.00,1,NULL,1,NULL,'2018-10-10 15:08:55','2018-12-25 14:37:24'),(3,'Dufu','96e79218965eb72c92a549dd5a330112','17333007330','/static/index/images/default-head-1.png',0.00,0,NULL,0,NULL,'2018-10-10 15:09:11','2018-12-25 14:37:23'),(4,'用户1733','25f9e794323b453885f5181f1b624d0b','13564078419','/static/index/images/default-head-1.png',0.00,1,NULL,1,NULL,'2018-12-16 18:29:53',NULL),(5,'用户7006','96e79218965eb72c92a549dd5a330112','13564078416','/static/index/images/default-head-0.png',0.00,0,NULL,0,NULL,'2018-12-17 14:00:49','2018-12-17 15:52:18'),(6,'用户7088','96e79218965eb72c92a549dd5a330112','13564078418','/static/index/images/default-head-1.png',0.00,1,NULL,1,NULL,'2018-12-17 14:02:38',NULL);

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
