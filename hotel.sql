/*
 Navicat Premium Data Transfer

 Source Server         : MariaDB
 Source Server Type    : MariaDB
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : hotel

 Target Server Type    : MariaDB
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 24/11/2020 11:49:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` tinyint(10) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', 'a7d7d4e9b23784d14fdafa00d9d9112d', '1.jpg');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cdesc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`cid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, '优选PRO', '每一套都是性价比优质房源');
INSERT INTO `category` VALUES (2, '不得不睡', '每一套都是精品特色房源');
INSERT INTO `category` VALUES (3, '不得不说', '每一段都是我与它的爱恨情仇');
INSERT INTO `category` VALUES (4, '不得不看', '每一套都是我们的精心推荐');
INSERT INTO `category` VALUES (5, '首页顶部轮播', '首页顶部轮播图');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `oid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL COMMENT '用户id',
  `sid` int(10) NOT NULL COMMENT '民宿id',
  `user_number` tinyint(10) NOT NULL,
  `enter_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `leave_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_info` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  `status` tinyint(10) NOT NULL COMMENT '未付款 1  已付款 2  完成 3  退款 4',
  PRIMARY KEY (`oid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 2, 1, 1, '2020/11/24', '2020/11/25', '', '', 599.00, 1606187544, 1606187547, 3);

-- ----------------------------
-- Table structure for stayhome
-- ----------------------------
DROP TABLE IF EXISTS `stayhome`;
CREATE TABLE `stayhome`  (
  `sid` tinyint(10) NOT NULL AUTO_INCREMENT,
  `sname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sdesc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sthumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sprice` decimal(10, 2) NOT NULL,
  `sprovince` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `scity` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sarea` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `saddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `stag` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sbanner` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `score` float NULL DEFAULT NULL,
  `sdetail` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '入住详情',
  `snotice` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '入住须知',
  `ctime` int(10) NULL DEFAULT NULL,
  `status` tinyint(10) NULL DEFAULT 1,
  `cid` int(10) NOT NULL,
  PRIMARY KEY (`sid`) USING BTREE,
  UNIQUE INDEX `sname`(`sname`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stayhome
-- ----------------------------
INSERT INTO `stayhome` VALUES (1, '奢野一宅', '建筑风格以当地石屋特色结合简约的设计，用一些质朴自然的细节与家的特色完美融合。美景入心之际的同时，我们也为您提供餐厅、茶室、儿童游乐园、酒吧、台球室、棋牌室、无边泳池等一系列便捷贴心的服务和设施。\r\n让您拥有舒适、静谧、松畅的慢时光假期。', '/OnePlusStayhome-php/public/uploads/20201004/2154c3b09be71d0b5e04231137c6a1c7.jpeg', 599.00, '北京市', '北京市', '东城区', '', '优选', '/OnePlusStayhome-php/public/uploads/20201011/6592429688cb28099b5b988a5a07b0fe.jpg,/OnePlusStayhome-php/public/uploads/20201011/f6e1990bcd71575dfe188905b6fda26b.jpeg,/OnePlusStayhome-php/public/uploads/20201011/0bf37f59c375405c5e3024b904512e86.jpeg', 4, '', '整套出租·一室一厨一卫·可住两人', 1601779250, 1, 1);
INSERT INTO `stayhome` VALUES (2, '终于见到你', '在海涛声中慢慢入眠，清晨海鸥啼鸣入耳，轻柔湿润的季风带来赤道的清晨问候，抬头是澈蓝的天，俯下身便可以触摸到清凉的海水。到过这里的人也一定不会忘记，傍晚之时天边那一抹瑰红。', '/OnePlusStayhome-php/public/uploads/20201004/c912f2cc2aec477e499b746e149a08ea.jpeg', 899.00, '北京市', '北京市', '朝阳区', '', '优选', '/OnePlusStayhome-php/public/uploads/20201011/7fe8c26b89040ad351deea1e72ae684e.jpg,/OnePlusStayhome-php/public/uploads/20201011/b5697834455ef042b5bde743fc486d0e.jpg,/OnePlusStayhome-php/public/uploads/20201011/d2b4f90852203132f25184fa72f23d5c.jpg', 5, '', '整套出租·一室一厨一卫·可住两人', 1601779520, 1, 1);
INSERT INTO `stayhome` VALUES (3, '清源·原舍', '旅馆全体由木材和石块建成，石块外表布满了青苔和蔓藤，和周围的森林融为一体，似乎霍比特人居住的小屋，置身其中能够满足每个人的神话与魔幻游览美梦', '/OnePlusStayhome-php/public/uploads/20201004/a47ba752a8d0509772ef238405909515.jpg', 1099.00, '北京市', '北京市', '大兴区', '', '优选', '/OnePlusStayhome-php/public/uploads/20201011/c7cd4ba00a614340b9c5b27757116431.jpg,/OnePlusStayhome-php/public/uploads/20201011/6f0cdf8523b1c22854566dc1e99fe368.jpg,/OnePlusStayhome-php/public/uploads/20201011/7a97285ce235514295525e445f48aca0.jpeg', 5, '', '整套出租·一室一厨一卫·可住两人', 1601779602, 1, 1);
INSERT INTO `stayhome` VALUES (4, '闭月落日', '就住这儿民宿将民宿与艺术展览体验完美融合', '/OnePlusStayhome-php/public/uploads/20201004/3f926173c2ebac582008abaa02080eae.jpg', 299.00, '北京市', '北京市', '东城区', '', '热门，特价', '/OnePlusStayhome-php/public/uploads/20201011/9530142fd69408b59c3a59e85ea11076.jpg,/OnePlusStayhome-php/public/uploads/20201011/9978655fe6946db58d131eaa869b4b9a.jpg', 5, '', '整套出租·一室一厨一卫·可住两人', 1601779875, 1, 2);
INSERT INTO `stayhome` VALUES (5, '塞上八百里', '就住这儿民宿将民宿与艺术展览体验完美融合', '/OnePlusStayhome-php/public/uploads/20201004/d130442bca334e5f318062cb45d532a0.jpg', 299.00, '北京市', '北京市', '西城区', '', '热门，特价', '/OnePlusStayhome-php/public/uploads/20201011/06f59c92b5bfb20f62abc5b7f474d51a.jpeg,/OnePlusStayhome-php/public/uploads/20201011/403da1b8e3e2ad7baf355b86c90dd3b4.jpeg', 5, '', '整套出租·一室一厨一卫·可住两人', 1601780051, 1, 2);
INSERT INTO `stayhome` VALUES (6, '就住这儿', '就住这儿民宿将民宿与艺术展览体验完美融合', '/OnePlusStayhome-php/public/uploads/20201004/07e7dac633c2e0dbb7994e06df75a975.jpg', 199.00, '北京市', '北京市', '石景山区', '', '热门，特价', '/OnePlusStayhome-php/public/uploads/20201011/e060332782d00a636c777ceceb07a9b3.jpg,/OnePlusStayhome-php/public/uploads/20201011/28eb7d69103ffe5b9d5e64d85cff8ea9.jpeg', 4, '', '整套出租·一室一厨一卫·可住两人', 1601780125, 1, 2);
INSERT INTO `stayhome` VALUES (7, '3W house', '当您入住酒店时，留意每一件艺术作品，不同的审美经验，可以恬淡娴静、可以迷蒙幽寂、可以沧溟飘渺，这些美妙的作品大多由酒店自己创作，用心去呈现。', '/OnePlusStayhome-php/public/uploads/20201004/aecd5390d2128137d804f27053fb833a.png', 199.00, '北京市', '北京市', '顺义区', '', '推荐', '/OnePlusStayhome-php/public/uploads/20201011/9daba76b521fa9fb0064781c711bc3e1.jpg,/OnePlusStayhome-php/public/uploads/20201011/9ce924e3924575df0b03efad8c142493.jpeg', 4, '', '整套出租·一室一厨一卫·可住两人', 1601780202, 1, 4);
INSERT INTO `stayhome` VALUES (8, '走进摩洛哥 ', '推开酒店餐厅那扇沉甸甸的大门，眼前展开的是一个风格奢华的阔大空间，天花板上华丽的水晶吊灯，每个角度都折射出如梦似幻斑斓彩光。', '/OnePlusStayhome-php/public/uploads/20201004/f6083fafa1b7585fe548bc55b8ddd697.png', 228.00, '北京市', '北京市', '朝阳区', '', '推荐', '/OnePlusStayhome-php/public/uploads/20201011/79f7ce01ef332afb89a8c04ddb4c8809.jpg,/OnePlusStayhome-php/public/uploads/20201011/bbed94e3296808a27c4361f254f4bcfa.jpg', 4, '', '整套出租·一室一厨一卫·可住两人', 1601780251, 1, 4);
INSERT INTO `stayhome` VALUES (9, 'Miami', '酒店设计以金黄色为主色调，弥漫着浓郁的地中海风情，更有来自世界各地的装饰：法国的青铜、意大利的音乐喷泉、法国的水晶灯、国际一流水准的寝室用品、加上富丽堂皇的回廊，金箔的装饰，由内及外无不彰显皇室气派。', '/OnePlusStayhome-php/public/uploads/20201004/a6228ef3c8c30873b1465107edc46431.png', 246.00, '北京市', '北京市', '顺义区', '', '推荐', '/OnePlusStayhome-php/public/uploads/20201011/7b993bc149ccf950d2ce4535c885cdfa.jpeg,/OnePlusStayhome-php/public/uploads/20201011/f92797c7ff56b8bff43bfa5a835ca944.jpeg', 4, '', '整套出租·一室一厨一卫·可住两人', 1601780286, 1, 4);
INSERT INTO `stayhome` VALUES (10, 'Jefferson Inn ', '想捕捉被大雪所困而包围在冬季仙境中的浪漫感觉吗？预订一间POD宾馆平方英尺(约平方米)的木结构、印度风格的小茅屋吧。', '/OnePlusStayhome-php/public/uploads/20201004/f2e91d06f2ee5870590b3025989b7848.png', 158.00, '北京市', '北京市', '朝阳区', '', '推荐', '/OnePlusStayhome-php/public/uploads/20201011/807579e3fd466c65c1e2491605ac3ac5.jpg,/OnePlusStayhome-php/public/uploads/20201011/f4ca3ddfb6c94b9f6f029be60a059cb3.jpeg', 4, '', '整套出租·一室一厨一卫·可住两人', 1601780313, 1, 4);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sex` tinyint(10) NOT NULL DEFAULT 0 COMMENT '0代表未设置，1代表男，2代表女',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '/hotel-admin/public/static/avatar.png',
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  `collection` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`uid`) USING BTREE,
  UNIQUE INDEX `phone`(`phone`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '用户1602061421', 0, '12345678910', 'a7d7d4e9b23784d14fdafa00d9d9112d', '/OnePlusStayhome-php/public/static/avatar.png', 1602061421, 1602061421, '1,2,3');
INSERT INTO `user` VALUES (2, '用户1602503676', 0, '13068015681', 'a7d7d4e9b23784d14fdafa00d9d9112d', '/OnePlusStayhome-php/public/static/avatar.png', 1602503676, 1602503676, '1,');

SET FOREIGN_KEY_CHECKS = 1;
