--
-- 表的结构 `users`
--

DROP TABLE IF EXISTS  users;
CREATE TABLE   users (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '网站用户id',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email',
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `role` varchar(20) DEFAULT NULL COMMENT '是否是管理员',
  `question` varchar(255) DEFAULT NULL COMMENT '密码保护问题',
  `answer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码保护问题答案',
  `gender` tinyint(1) unsigned DEFAULT NULL COMMENT '性别',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `cell` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `user_money` decimal(10,2) NOT NULL default '0.00' COMMENT '用户资产',
  `pay_points` int unsigned NOT NULL default '0' COMMENT '会员积分',
  `rank_points` int unsigned NOT NULL default '0' COMMENT '级别积分',  
  `user_rank` int unsigned NOT NULL default '0' COMMENT '用户级别',
  `last_login` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '上次登录时间',
  `last_ip` varchar(15) NOT NULL default '' COMMENT '上次登录ip',
  `visit_count` smallint(5) unsigned NOT NULL default '0' COMMENT '登录次数',
  `im_type` VARCHAR(20) DEFAULT NULL COMMENT 'im类型',
  `im_account` VARCHAR(30) DEFAULT NULL COMMENT 'im账户',  
  `is_validated` TINYINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否验证',
  `validated_code` VARCHAR(30) DEFAULT NULL COMMENT '验证码',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




