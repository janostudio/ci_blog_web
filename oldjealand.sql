/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `jealand_old` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `jealand_old`;

CREATE TABLE IF NOT EXISTS `contents` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章序号',
  `title` varchar(200) DEFAULT NULL COMMENT '标题',
  `slug` varchar(200) NOT NULL COMMENT '正文缩写',
  `createdtime` datetime DEFAULT NULL COMMENT '建立时间',
  `username` varchar(50) NOT NULL COMMENT '最后修改时间',
  `text` text NOT NULL COMMENT '正文',
  `authorid` int(10) NOT NULL COMMENT '用uid对应',
  `type` varchar(32) DEFAULT NULL COMMENT '文章类型',
  `moduleid` int(11) DEFAULT '1' COMMENT '板块',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='博客表';

CREATE TABLE IF NOT EXISTS `headimg` (
  `iid` int(10) unsigned NOT NULL COMMENT '与headimgid对应',
  `headimg` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='头像';

CREATE TABLE IF NOT EXISTS `log` (
  `wid` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `ip_addr` varchar(20) DEFAULT NULL COMMENT '符号型ip地址',
  `log_time` datetime DEFAULT NULL COMMENT '时间',
  `page_url` varchar(50) DEFAULT NULL COMMENT '访问地址',
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB AUTO_INCREMENT=7053 DEFAULT CHARSET=utf8mb4 COMMENT='浏览者登陆的时间及ip记录';

CREATE TABLE IF NOT EXISTS `module` (
  `mid` int(10) NOT NULL COMMENT '与moduleid对应',
  `mname` varchar(30) NOT NULL COMMENT '名字',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='板块';

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增非零',
  `mail` varchar(32) NOT NULL COMMENT '邮箱：用户名',
  `nickname` varchar(32) NOT NULL COMMENT '昵称',
  `headimgid` int(10) unsigned NOT NULL,
  `password` varchar(32) NOT NULL COMMENT '密码',
  `url` varchar(200) DEFAULT NULL COMMENT '主页地址',
  `rgtime` date DEFAULT NULL COMMENT '注册时间',
  `loggedtime` int(10) DEFAULT NULL COMMENT '最后登录时间',
  `authcode` varchar(40) NOT NULL COMMENT '验证码',
  `sessionID` varchar(30) DEFAULT NULL COMMENT 'sessionid',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='主表';

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
