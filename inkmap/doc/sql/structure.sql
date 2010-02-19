--
-- 表的结构 `users`
--

DROP TABLE IF EXISTS  users;
CREATE TABLE   users (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '网站用户id',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email',
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `nick_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '昵称',  
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `salt` CHAR(20) NOT NULL COMMENT 'SALT',
  `role` varchar(20) DEFAULT NULL COMMENT '是否是管理员',
  `question` varchar(255) DEFAULT NULL COMMENT '密码保护问题',
  `answer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码保护问题答案',
  `gender` tinyint(1) unsigned DEFAULT NULL COMMENT '性别',
  `age` int(3) unsigned DEFAULT NULL COMMENT '年龄',
  `cell` varchar(13) DEFAULT NULL COMMENT '手机号',
  `city` varchar(13) DEFAULT NULL COMMENT '城市',
  `im_account` LONGTEXT DEFAULT NULL COMMENT 'im账户，存放xml或者json，解析后可以分别赋值',  
  `introduction` varchar(255) DEFAULT NULL COMMENT '个人简介', 
  `website` varchar(50) DEFAULT NULL COMMENT '个人主页',
  `subscribe` TINYINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否接收广告',  
  `avatar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像',
  `user_money` decimal(10,2) NOT NULL default '0.00' COMMENT '用户资产',
  `pay_points` int unsigned NOT NULL default '0' COMMENT '会员积分',
  `rank_points` int unsigned NOT NULL default '0' COMMENT '级别积分',  
  `user_rank` int unsigned NOT NULL default '0' COMMENT '用户级别',
  `last_login` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '上次登录时间',
  `last_ip` varchar(15) NOT NULL default '' COMMENT '上次登录ip',
  `visit_count` smallint(5) unsigned NOT NULL default '0' COMMENT '登录次数',
  `is_validated` TINYINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否验证',
  `validated_code` VARCHAR(30) DEFAULT NULL COMMENT '验证码',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- 表的结构 `user_addresses` 一个用户可以有多个地址
--
DROP TABLE IF EXISTS  user_addresses;
CREATE TABLE   user_addresses (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `full_name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '姓名',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '地址',
  `provice` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '省份',
  `city` varchar(15) DEFAULT NULL COMMENT '城市',
  `region` varchar(20) DEFAULT NULL COMMENT '区',
  `postal_code` varchar(10) DEFAULT NULL COMMENT '邮编',
  `cell` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号码',
  `email` varchar(30) DEFAULT NULL COMMENT 'email',
  `user_id` int NOT NULL COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的结构 `user_images` 一个用户可以有多个图片，这些图片素材用来让用户设计时不用上传图片，直接选择
--
DROP TABLE IF EXISTS  user_images;
CREATE TABLE   user_images (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `image_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT '图片名',
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '图片的url',
  `thumb1` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '小图',
  `thumb2` CHAR(255) NOT NULL COMMENT '中图',
  `size` varchar(20) DEFAULT NULL COMMENT '图片规格',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `user_id` int NOT NULL COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的结构 `user_shows` 用户show
--
DROP TABLE IF EXISTS  user_shows;
CREATE TABLE   user_shows (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `show_name` varchar(25) NOT NULL COMMENT '图片名',
  `file` varchar(255) NOT NULL COMMENT '图片的url',
  `thumb1` varchar(255) NOT NULL COMMENT '小图',
  `size` varchar(20) DEFAULT NULL COMMENT '图片规格',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `user_id` int NOT NULL COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的结构 `user_orders` 订单
--
DROP TABLE IF EXISTS  user_orders;
CREATE TABLE   user_orders (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `order_id` varchar(32) NOT NULL COMMENT '订单号',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `send_type` varchar(50) NULL COMMENT '配送方式',
  `name` varchar(20) NULL COMMENT '姓名',
  `address` varchar(255) NULL COMMENT '地址',
  `cell` varchar(20) NULL COMMENT '手机号',
  `pay_at` datetime DEFAULT NULL COMMENT '付款日期',
  `order_status` varchar(10) NOT NULL COMMENT '订单状态：未支付，已支付，过期',
  `buy` LONGTEXT DEFAULT NULL COMMENT '存放一个xml或者json，里面是一组数据，每个代表一个design+stuff+amount,一个订单有多个商品',
  `origin_price` decimal(10,2) NOT NULL default '0.00' COMMENT '应支付价格',
  `price` decimal(10,2) NOT NULL default '0.00' COMMENT '根据购买数量，用户等级，使用优惠券或者积分的实际价格',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `handle_status` varchar(10) NOT NULL DEFAULT '未处理' COMMENT '管理员是否已处理，未处理，正在处理，已处理,或者还可以再细分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的结构 `goods` 商品
--
DROP TABLE IF EXISTS  goods;
CREATE TABLE   goods (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `stuff_no` varchar(25) NOT NULL COMMENT '商品编号',
  `stuff_name` varchar(50) NOT NULL COMMENT '商品名称',
  `stuff_type` varchar(25) NOT NULL COMMENT '属于哪一类，tee，或者杯子等等',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的结构 `goods_details` 商品详细信息
--
DROP TABLE IF EXISTS  goods_details;
CREATE TABLE   goods_details (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `stuff_id` int(11) NOT NULL COMMENT '款式id，即goods的id',
  `color_style` varchar(50) NOT NULL COMMENT '颜色',
  `size` varchar(25) NOT NULL COMMENT 'XL等等规格',
  `color_thumb` varchar(255) NOT NULL COMMENT '颜色小图',
  `image` varchar(255) NOT NULL COMMENT '大图',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `price` decimal(10,2) NOT NULL default '0.00' COMMENT '价格',
  `amount` varchar(10) DEFAULT NULL COMMENT '充足，一般，缺货',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的结构 `designs` 设计
--
DROP TABLE IF EXISTS  designs;
CREATE TABLE   designs (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `design_name` varchar(50) NOT NULL COMMENT '设计名称',
  `stuff_type` varchar(25) NOT NULL COMMENT '款式类型',  
  `tags` varchar(25) NOT NULL COMMENT 'tag',
  `thumb` varchar(255) NOT NULL COMMENT '小图',
  `image_front` varchar(255) NOT NULL COMMENT '大图',
  `image_back` varchar(255) NOT NULL COMMENT '大图',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `price` decimal(10,2) NOT NULL default '0.00' COMMENT '价格',
  `rating` float DEFAULT NULL COMMENT '充足，一般，缺货',
  `design_detail` LONGTEXT DEFAULT NULL COMMENT '一个xml来存放各种信息',
  `authorize` varchar(10) NOT NULL DEFAULT 'private' COMMENT 'privat,public,official',
  `user_id` int DEFAULT NULL COMMENT '用户id',
  `create_at` datetime NOT NULL COMMENT '创建日期', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的结构 `stuff_type` 商品类型
--
DROP TABLE IF EXISTS  stuff_type;
CREATE TABLE stuff_type (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `stuff_type` varchar(25) NOT NULL COMMENT '款式类型',  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的结构 `comments` 商品评论
--
DROP TABLE IF EXISTS  comments;
CREATE TABLE   comments (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `design_id` int NOT NULL COMMENT '设计 id',  
  `user_id` int NOT NULL COMMENT '用户 id',  
  `parent_id` int NOT NULL COMMENT '父评论',    
  `comment` varchar(255) NOT NULL COMMENT '评论内容',  
  `create_at` datetime NOT NULL COMMENT '创建日期', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- 表的结构 `cart` 购物车
--
DROP TABLE IF EXISTS  cart;
CREATE TABLE   cart (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `design_id` int NOT NULL COMMENT '设计 id',  
  `stuff_id` int DEFAULT NULL COMMENT 'stuff id',
  `user_id` int NOT NULL COMMENT '用户 id',  
  `create_at` datetime NOT NULL COMMENT '创建日期',  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
