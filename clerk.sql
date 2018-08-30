/*
Navicat MySQL Data Transfer

Source Server         : 192.168.137.3
Source Server Version : 50553
Source Host           : 192.168.137.3:3306
Source Database       : clerk

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-30 17:16:24
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `oim_chat_record`
-- ----------------------------
DROP TABLE IF EXISTS `oim_chat_record`;
CREATE TABLE `oim_chat_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_key` varchar(255) DEFAULT NULL,
  `to_key` varchar(255) DEFAULT NULL,
  `content` text,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oim_chat_record
-- ----------------------------
INSERT INTO `oim_chat_record` VALUES ('5', '9:visitor', '6:clerk', '[{\"username\":\"visitor-9\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"9\",\"mine\":false,\"content\":\"sdfsdf\",\"fromid\":\"9\",\"key\":\"9:visitor\",\"timestamp\":1535538250000},{\"username\":\"\\u9a6c\\u5316\\u817e\",\"avatar\":\"\\/pic\\/a5.jpg\",\"id\":6,\"mine\":false,\"content\":\"sadfsdf\",\"type\":\"friend\",\"fromid\":6,\"key\":\"6:clerk\",\"timestamp\":1535538254000},{\"username\":\"\\u9a6c\\u5316\\u817e\",\"avatar\":\"\\/pic\\/a5.jpg\",\"id\":6,\"mine\":false,\"content\":\"asfsf\",\"type\":\"friend\",\"fromid\":6,\"key\":\"6:clerk\",\"timestamp\":1535538257000},{\"username\":\"\\u9a6c\\u5316\\u817e\",\"avatar\":\"\\/pic\\/a5.jpg\",\"id\":6,\"mine\":false,\"content\":\"sdfs\",\"type\":\"friend\",\"fromid\":6,\"key\":\"6:clerk\",\"timestamp\":1535538258000},{\"username\":\"visitor-9\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"9\",\"mine\":false,\"content\":\"asdfsdf\",\"fromid\":\"9\",\"key\":\"9:visitor\",\"timestamp\":1535538261000}]', '1535538265');
INSERT INTO `oim_chat_record` VALUES ('6', '9:visitor', '6:clerk', '[{\"username\":\"visitor-9\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"9\",\"mine\":false,\"content\":\"sfsdf\",\"fromid\":\"9\",\"key\":\"9:visitor\",\"timestamp\":1535539261000},{\"username\":\"\\u9a6c\\u5316\\u817e\",\"avatar\":\"\\/pic\\/a5.jpg\",\"id\":6,\"mine\":false,\"content\":\"sadfsdf\",\"type\":\"friend\",\"fromid\":6,\"key\":\"6:clerk\",\"timestamp\":1535539265000},{\"username\":\"visitor-9\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"9\",\"mine\":false,\"content\":\"asdfsdf\",\"fromid\":\"9\",\"key\":\"9:visitor\",\"timestamp\":1535539270000},{\"username\":\"\\u9a6c\\u5316\\u817e\",\"avatar\":\"\\/pic\\/a5.jpg\",\"id\":6,\"mine\":false,\"content\":\"sdfdsf\",\"type\":\"friend\",\"fromid\":6,\"key\":\"6:clerk\",\"timestamp\":1535539272000}]', '1535539281');
INSERT INTO `oim_chat_record` VALUES ('7', '9:visitor', '6:clerk', '[{\"username\":\"visitor-9\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"9\",\"mine\":false,\"content\":\"sdfsdffs\",\"fromid\":\"9\",\"key\":\"9:visitor\",\"timestamp\":1535553700000},{\"username\":\"visitor-9\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"9\",\"mine\":false,\"content\":\"dfgdfg\",\"fromid\":\"9\",\"key\":\"9:visitor\",\"timestamp\":1535553701000},{\"username\":\"\\u9a6c\\u5316\\u817e\",\"avatar\":\"\\/pic\\/a5.jpg\",\"id\":6,\"mine\":false,\"content\":\"sdfsdfd\",\"type\":\"friend\",\"fromid\":6,\"key\":\"6:clerk\",\"timestamp\":1535553708000}]', '1535553764');
INSERT INTO `oim_chat_record` VALUES ('8', '9:visitor', '6:clerk', '[{\"username\":\"\\u9a6c\\u5316\\u817e\",\"avatar\":\"\\/pic\\/a5.jpg\",\"id\":6,\"mine\":false,\"content\":\"sdfsdf\",\"type\":\"friend\",\"fromid\":6,\"key\":\"6:clerk\",\"timestamp\":1535556646000},{\"username\":\"visitor-9\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"9\",\"mine\":false,\"content\":\"dfgdfgsdfg\",\"fromid\":\"9\",\"key\":\"9:visitor\",\"timestamp\":1535556653000},{\"username\":\"\\u9a6c\\u5316\\u817e\",\"avatar\":\"\\/pic\\/a5.jpg\",\"id\":6,\"mine\":false,\"content\":\"face[\\u6c57] \",\"type\":\"friend\",\"fromid\":6,\"key\":\"6:clerk\",\"timestamp\":1535556658000},{\"username\":\"visitor-9\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"9\",\"mine\":false,\"content\":\"img[\\/uploads\\/image\\/20180829\\/880ab7e4521e01e6d8c431446f7fdba9.jpg]\",\"fromid\":\"9\",\"key\":\"9:visitor\",\"timestamp\":1535556664000}]', '1535556669');
INSERT INTO `oim_chat_record` VALUES ('9', '9:visitor', '6:clerk', '[{\"username\":\"visitor-9\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"9\",\"mine\":false,\"content\":\"sdfgdfg\",\"fromid\":\"9\",\"key\":\"9:visitor\",\"timestamp\":1535558059000},{\"username\":\"\\u9a6c\\u5316\\u817e\",\"avatar\":\"\\/pic\\/a5.jpg\",\"id\":6,\"mine\":false,\"content\":\"sdsfd\",\"type\":\"friend\",\"fromid\":6,\"key\":\"6:clerk\",\"timestamp\":1535558063000}]', '1535558206');
INSERT INTO `oim_chat_record` VALUES ('10', '10:visitor', '4:clerk', '[{\"username\":\"visitor-10\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"10\",\"mine\":false,\"content\":\"sdfsdf\",\"fromid\":\"10\",\"key\":\"10:visitor\",\"timestamp\":1535558751000},{\"username\":\"\\u9a6c\\u4e91\",\"avatar\":\"\\/pic\\/a4.jpg\",\"id\":4,\"mine\":false,\"content\":\"sdfsdfs\",\"type\":\"friend\",\"fromid\":4,\"key\":\"4:clerk\",\"timestamp\":1535558755000}]', '1535558973');
INSERT INTO `oim_chat_record` VALUES ('11', '4:clerk', '13:visitor', '[{\"username\":\"visitor-13\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"13\",\"mine\":false,\"content\":\"sfsdfsd\",\"fromid\":\"13\",\"key\":\"13:visitor\",\"timestamp\":1535561989000},{\"username\":\"visitor-13\",\"avatar\":\"\\/pic\\/00.jpg\",\"id\":\"13\",\"mine\":false,\"content\":\"safsdf\",\"fromid\":\"13\",\"key\":\"13:visitor\",\"timestamp\":1535561991000},{\"username\":\"\\u9a6c\\u4e91\",\"avatar\":\"\\/pic\\/a4.jpg\",\"id\":4,\"mine\":false,\"content\":\"sadfsdf\",\"type\":\"friend\",\"fromid\":4,\"key\":\"4:clerk\",\"timestamp\":1535561996000},{\"username\":\"\\u9a6c\\u4e91\",\"avatar\":\"\\/pic\\/a4.jpg\",\"id\":4,\"mine\":false,\"content\":\"sdafsdf\",\"type\":\"friend\",\"fromid\":4,\"key\":\"4:clerk\",\"timestamp\":1535561997000}]', '1535561999');

-- ----------------------------
-- Table structure for `oim_clerk`
-- ----------------------------
DROP TABLE IF EXISTS `oim_clerk`;
CREATE TABLE `oim_clerk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT '0' COMMENT '客服组',
  `username` varchar(100) DEFAULT NULL COMMENT '用户名',
  `password` varchar(100) DEFAULT '',
  `avatar` varchar(100) DEFAULT NULL COMMENT '头像',
  `sign` varchar(200) DEFAULT NULL COMMENT '签名',
  `status` varchar(255) DEFAULT 'offline',
  `usertype` varchar(255) DEFAULT 'clerk',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oim_clerk
-- ----------------------------
INSERT INTO `oim_clerk` VALUES ('1', '1', '李XX', '21232f297a57a5a743894a0e4a801fc3', '/pic/a1.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('2', '2', '林小小', '21232f297a57a5a743894a0e4a801fc3', '/pic/a2.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('3', '3', '李先生', '21232f297a57a5a743894a0e4a801fc3', '/pic/a3.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('4', '3', '马云', '21232f297a57a5a743894a0e4a801fc3', '/pic/a4.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('6', '2', '马化腾', '21232f297a57a5a743894a0e4a801fc3', '/pic/a5.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('7', '3', '李小龙', '21232f297a57a5a743894a0e4a801fc3', '/pic/a6.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('8', '4', '李云龙', '21232f297a57a5a743894a0e4a801fc3', '/pic/a7.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('9', '4', '华华', '21232f297a57a5a743894a0e4a801fc3', '/pic/a8.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('13', '1', '廖小姐', '21232f297a57a5a743894a0e4a801fc3', '/pic/a9.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('14', '4', '朱小姐', '21232f297a57a5a743894a0e4a801fc3', '/pic/a10.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('15', '3', '李小姐', '21232f297a57a5a743894a0e4a801fc3', '/pic/a11.jpg', null, 'offline', 'clerk');
INSERT INTO `oim_clerk` VALUES ('16', '2', '许妙妙', '21232f297a57a5a743894a0e4a801fc3', '/pic/a12.jpg', null, 'offline', 'clerk');

-- ----------------------------
-- Table structure for `oim_group`
-- ----------------------------
DROP TABLE IF EXISTS `oim_group`;
CREATE TABLE `oim_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oim_group
-- ----------------------------
INSERT INTO `oim_group` VALUES ('1', '售前客服组');
INSERT INTO `oim_group` VALUES ('2', '售后客服组');
INSERT INTO `oim_group` VALUES ('3', '技术支持');
INSERT INTO `oim_group` VALUES ('4', '销售经理');

-- ----------------------------
-- Table structure for `oim_visitor`
-- ----------------------------
DROP TABLE IF EXISTS `oim_visitor`;
CREATE TABLE `oim_visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_agent` varchar(100) DEFAULT NULL COMMENT '浏览器信息',
  `ip` bigint(20) DEFAULT NULL COMMENT 'IP地址',
  `referrer` varchar(255) DEFAULT NULL COMMENT '来源',
  `url` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oim_visitor
-- ----------------------------
