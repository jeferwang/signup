/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : signup

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2016-11-01 21:50:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for reg_admin
-- ----------------------------
DROP TABLE IF EXISTS `reg_admin`;
CREATE TABLE `reg_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) CHARACTER SET utf8 NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 NOT NULL,
  `logindate` datetime NOT NULL,
  `loginip` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of reg_admin
-- ----------------------------
INSERT INTO `reg_admin` VALUES ('1', 'admin', '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '2016-10-29 23:39:43', '127.0.0.1');

-- ----------------------------
-- Table structure for reg_college
-- ----------------------------
DROP TABLE IF EXISTS `reg_college`;
CREATE TABLE `reg_college` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `college` varchar(50) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reg_college
-- ----------------------------
INSERT INTO `reg_college` VALUES ('1', '计算机科学与技术学院', 'jsj');
INSERT INTO `reg_college` VALUES ('2', '测绘与国土信息工程学院', 'cehui');

-- ----------------------------
-- Table structure for reg_match
-- ----------------------------
DROP TABLE IF EXISTS `reg_match`;
CREATE TABLE `reg_match` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `info` text NOT NULL,
  `limit` int(11) NOT NULL,
  `document` varchar(200) NOT NULL,
  `starttime` date NOT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reg_match
-- ----------------------------
INSERT INTO `reg_match` VALUES ('1', '1测试大挑战杯初赛', '测试大挑战杯', '7', '/Uploads/Match/InfoDoc/14763517073658.pdf', '2016-10-13', '[\"zip\",\"rar\",\"7z\",\"tar\",\"doc\",\"docx\",\"ppt\",\"pptx\",\"xls\",\"xlsx\",\"wps\",\"jpg\",\"jpeg\",\"png\",\"bmp\"]', '1');
INSERT INTO `reg_match` VALUES ('3', '测试添加', '123456', '3', '/Uploads/Match/InfoDoc/14776587751702.docx', '2016-10-28', null, '1');

-- ----------------------------
-- Table structure for reg_reginfo
-- ----------------------------
DROP TABLE IF EXISTS `reg_reginfo`;
CREATE TABLE `reg_reginfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL COMMENT '编号',
  `stuid` varchar(20) NOT NULL COMMENT '学生表对应的id',
  `team` varchar(255) NOT NULL COMMENT '团队名称',
  `title` varchar(255) NOT NULL,
  `type` varchar(15) NOT NULL,
  `info` text NOT NULL COMMENT '作品简介',
  `teaminfo` text,
  `guide` varchar(255) NOT NULL,
  `collegeid` int(11) DEFAULT NULL,
  `matchid` int(11) NOT NULL,
  `fileroute` text NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `reason` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reg_reginfo
-- ----------------------------
INSERT INTO `reg_reginfo` VALUES ('6', 'jsj11', '1', '计算机测试1', '测试测试', '科技发明制作类', '测试测试', '[\"wxj-3115090604**-jsj-rj1504-18800000001\",\"aaa-3115090604**-jsj-rj1504-18800000002\",\"ddd-3115090604**-jsj-rj1504-18800000003\",\"ttt-3115090604**-jsj-rj1504-18800000004\"]', '[\"rjj-\\u8ba1\\u7b97\\u673a\",\"rjj-\\u8ba1\\u7b97\\u673a\"]', '1', '1', '{\"shenbaoshu\":{\"name\":\"2.WPS\",\"type\":\"application\\/octet-stream\",\"size\":0,\"key\":\"shenbaoshu\",\"ext\":\"WPS\",\"md5\":\"d41d8cd98f00b204e9800998ecf8427e\",\"sha1\":\"da39a3ee5e6b4b0d3255bfef95601890afd80709\",\"savename\":\"580108f77486d.WPS\",\"savepath\":\"\\/Match\\/Stu\\/jsj11\\/\"},\"zuopin\":{\"name\":\"1.zip\",\"type\":\"application\\/x-zip-compressed\",\"size\":0,\"key\":\"zuopin\",\"ext\":\"zip\",\"md5\":\"d41d8cd98f00b204e9800998ecf8427e\",\"sha1\":\"da39a3ee5e6b4b0d3255bfef95601890afd80709\",\"savename\":\"580108f775a17.zip\",\"savepath\":\"\\/Match\\/Stu\\/jsj11\\/\"}}', '1476464608', '2', '');
INSERT INTO `reg_reginfo` VALUES ('7', 'jsj12', '3', '1', '2', '科技发明制作类', '3', '[\"1-2-3-4-5\",\"2-2-3-4-5\",\"3-2-3-4-5\",\"4-2-3-4-5\",\"5-2-3-4-5\",\"6-2-3-4-5\",\"7-2-3-4-5\"]', '[\"wxj-\\u8ba1\\u7b97\\u673a\\u5b66\\u9662\"]', '1', '1', '{\"shenbaoshu\":{\"name\":\"2.WPS\",\"type\":\"application\\/octet-stream\",\"size\":0,\"key\":\"shenbaoshu\",\"ext\":\"WPS\",\"md5\":\"d41d8cd98f00b204e9800998ecf8427e\",\"sha1\":\"da39a3ee5e6b4b0d3255bfef95601890afd80709\",\"savename\":\"5805ac20e5854.WPS\",\"savepath\":\"\\/Match\\/Stu\\/jsj12\\/\"}}', '1476766752', '2', '');

-- ----------------------------
-- Table structure for reg_student
-- ----------------------------
DROP TABLE IF EXISTS `reg_student`;
CREATE TABLE `reg_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL COMMENT '学生登录账户',
  `num` int(11) DEFAULT NULL COMMENT '数字编号',
  `matchid` int(11) DEFAULT NULL COMMENT '比赛id',
  `collegeid` int(11) NOT NULL COMMENT '所属学院',
  `password` varchar(50) NOT NULL COMMENT '登录密码',
  `status` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reg_student
-- ----------------------------
INSERT INTO `reg_student` VALUES ('1', 'jsj11', '1', '1', '1', '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '1');
INSERT INTO `reg_student` VALUES ('2', 'cehui11', '1', '1', '2', '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '1');
INSERT INTO `reg_student` VALUES ('3', 'jsj12', '2', '1', '1', '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '1');
INSERT INTO `reg_student` VALUES ('4', 'cehui12', '2', '1', '2', '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '1');
INSERT INTO `reg_student` VALUES ('5', 'jsj31', '1', '3', '1', '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '1');

-- ----------------------------
-- Table structure for reg_task
-- ----------------------------
DROP TABLE IF EXISTS `reg_task`;
CREATE TABLE `reg_task` (
  `projectid` int(11) NOT NULL,
  `pwid` int(11) NOT NULL,
  `score` double(3,1) DEFAULT NULL,
  `suggest` text
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reg_task
-- ----------------------------
INSERT INTO `reg_task` VALUES ('6', '5', null, null);
INSERT INTO `reg_task` VALUES ('6', '3', null, null);
INSERT INTO `reg_task` VALUES ('7', '3', null, null);

-- ----------------------------
-- Table structure for reg_teacher
-- ----------------------------
DROP TABLE IF EXISTS `reg_teacher`;
CREATE TABLE `reg_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `num` int(11) NOT NULL,
  `matchid` int(11) NOT NULL,
  `collegeid` int(5) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(5) NOT NULL COMMENT '学院1，学校2，评委3',
  `type` varchar(20) NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reg_teacher
-- ----------------------------
INSERT INTO `reg_teacher` VALUES ('1', 'jsj11t', '1', '1', '1', '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '1', 'jsj', '2');
INSERT INTO `reg_teacher` VALUES ('2', 'cehui11t', '1', '1', '2', '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '1', 'cehui', '1');
INSERT INTO `reg_teacher` VALUES ('3', 'pw11t', '1', '1', null, '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '3', 'pw', '1');
INSERT INTO `reg_teacher` VALUES ('4', 'hpu11t', '1', '1', null, '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '2', 'hpu', '1');
INSERT INTO `reg_teacher` VALUES ('5', 'pw12t', '2', '1', null, '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '3', 'pw', '1');
INSERT INTO `reg_teacher` VALUES ('6', 'jsj12t', '2', '1', '1', '501e0bbac99eb3673e5df715eacd9d0efb5601f5', '1', 'jsj', '1');

-- ----------------------------
-- Table structure for reg_teashow
-- ----------------------------
DROP TABLE IF EXISTS `reg_teashow`;
CREATE TABLE `reg_teashow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teaname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `imgroute` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(10) CHARACTER SET utf8 DEFAULT NULL COMMENT '指导老师或者评委老师',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of reg_teashow
-- ----------------------------
INSERT INTO `reg_teashow` VALUES ('1', '测试', '/Uploads/teaimg/14763514933277.jpg', '<p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>', '2016-10-13 17:38:13', '1');
INSERT INTO `reg_teashow` VALUES ('2', '测试', '/Uploads/teaimg/14763515101110.jpg', '<p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>', '2016-10-13 17:38:30', '2');

-- ----------------------------
-- Table structure for reg_type
-- ----------------------------
DROP TABLE IF EXISTS `reg_type`;
CREATE TABLE `reg_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reg_type
-- ----------------------------
INSERT INTO `reg_type` VALUES ('1', '科技类');
INSERT INTO `reg_type` VALUES ('3', '社会调查类');

-- ----------------------------
-- Table structure for reg_typelink
-- ----------------------------
DROP TABLE IF EXISTS `reg_typelink`;
CREATE TABLE `reg_typelink` (
  `match_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reg_typelink
-- ----------------------------
INSERT INTO `reg_typelink` VALUES ('3', '1');
