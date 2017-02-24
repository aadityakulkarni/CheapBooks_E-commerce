/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : cheapbooks

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-12-05 23:16:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `author`
-- ----------------------------
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `ssn` varchar(9) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ssn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES ('023-65-54', 'Suzanne Collins', 'Dallas/Fort Worth Area', '6822487056');
INSERT INTO `author` VALUES ('1048', 'R R martin', '513 summit avenue', '682485485');
INSERT INTO `author` VALUES ('1049', 'R R martin', '513 summit avenue', '682485485');
INSERT INTO `author` VALUES ('1050', 'R R baby', '513 summit avenue', '682485485');
INSERT INTO `author` VALUES ('123-45-67', 'Paulo Coelho', 'New york , buffallo', '9632587410');
INSERT INTO `author` VALUES ('23-98-789', 'J.K. Rowling', 'New York Buffallo', '6822487783');
INSERT INTO `author` VALUES ('231-65-98', 'Stephen King', 'Los Angeles, California', '8523697410');
INSERT INTO `author` VALUES ('234-89-74', 'Khaled Hosseini', 'mobile, alabama', '8012345679');

-- ----------------------------
-- Table structure for `book`
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `ISBN` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `publisher` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES ('0061122416', 'The Alchemist', '1993', '5', 'Harper Collins');
INSERT INTO `book` VALUES ('0375831002', 'The Book Thief', '2006', '13', 'Knopf Books for Young Readers');
INSERT INTO `book` VALUES ('0385199570', 'The Stand', '1990', '15', 'Doubleday');
INSERT INTO `book` VALUES ('0439023483', 'The Hunger Games, Book 1', '2006', '17.05', 'Hunger publication');
INSERT INTO `book` VALUES ('0439358078', 'Harry Potter and the Order of the Phoenix', '2008', '7.86', 'Bantam Spectra ');
INSERT INTO `book` VALUES ('0812550706', 'Ender\'s Game', '1994', '12.5', 'Tor');
INSERT INTO `book` VALUES ('1001227244', 'game of thrones', '2002', '12', 'Bantam Spectra ');
INSERT INTO `book` VALUES ('1001227245', 'game of thrones 2', '2004', '12', 'Bantam Spectra ');
INSERT INTO `book` VALUES ('1001227246', 'dan brown', '2004', '12', 'Doubleday');
INSERT INTO `book` VALUES ('1594480001', 'The Kite Runner', '2004', '9', 'Riverhead Books');

-- ----------------------------
-- Table structure for `contains`
-- ----------------------------
DROP TABLE IF EXISTS `contains`;
CREATE TABLE `contains` (
  `ISBN` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `basketId` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  KEY `contains_ibfk_1` (`ISBN`),
  KEY `contains_ibfk_2` (`basketId`),
  CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`basketId`) REFERENCES `shoppingbasket` (`basketId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of contains
-- ----------------------------
INSERT INTO `contains` VALUES ('0812550706', '58446be3a7255', '5');

-- ----------------------------
-- Table structure for `customers`
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('aaditya', '79e117a2cc3cd7fd57bf793a26229ec0', '513 Summit Ave\r\nApt 374, Arlington, Texas, USA - 76013', '6822487010', 'aadikulkarni91@gmail.com');
INSERT INTO `customers` VALUES ('ab', '187ef4436122d1cc2f40dc2b92f0eba0', 'ab', '9012901921', 'aaditya.kulkarni@mavs.uta.edu');
INSERT INTO `customers` VALUES ('abab', '585adf88cdd3693831b0748f409ce846', '', '3481231231', 'df@sdf.sdf');
INSERT INTO `customers` VALUES ('abc', '900150983cd24fb0d6963f7d28e17f72', '', '6822487012', 'akaadi3@gmail.com');
INSERT INTO `customers` VALUES ('abcd', 'e2fc714c4727ee9395f324cd2e7f331f', '', '1098236457', 'pratik.palashikar@mavs.uta.edu');
INSERT INTO `customers` VALUES ('barbara', '47bce5c74f589f4867dbd57e9ca9f808', '#', '0000000000', 'abc@abc.com');
INSERT INTO `customers` VALUES ('george', '9b306ab04ef5e25f9fb89c998a6aedab', 'Austin, Texas', '9512367401', 'george@bash.com');
INSERT INTO `customers` VALUES ('jackson', '4ff9fc6e4e5d5f590c4f2134a8cc96d1', '7105, guadalupe street, Austin TX', '6822487213', 'akaadi3@gmail.com');
INSERT INTO `customers` VALUES ('jhonson', '37cdf91cb63badb018c3de5698104f56', 'New York ', '7894561203', 'jhonson@jhon.com');
INSERT INTO `customers` VALUES ('karthick', 'e2295eea4940a2066f36a58abf2f5995', 'karthick', '', 'karthick');

-- ----------------------------
-- Table structure for `shippingorder`
-- ----------------------------
DROP TABLE IF EXISTS `shippingorder`;
CREATE TABLE `shippingorder` (
  `ISBN` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `warehouseCode` int(11) DEFAULT NULL,
  `username` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  KEY `shippingorder_ibfk_1` (`ISBN`),
  KEY `shippingorder_ibfk_2` (`warehouseCode`),
  KEY `shippingorder_ibfk_3` (`username`),
  CONSTRAINT `shippingorder_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `shippingorder_ibfk_2` FOREIGN KEY (`warehouseCode`) REFERENCES `stocks` (`warehouseCode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `shippingorder_ibfk_3` FOREIGN KEY (`username`) REFERENCES `customers` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of shippingorder
-- ----------------------------
INSERT INTO `shippingorder` VALUES ('1594480001', '2', 'aaditya', '5000');

-- ----------------------------
-- Table structure for `shoppingbasket`
-- ----------------------------
DROP TABLE IF EXISTS `shoppingbasket`;
CREATE TABLE `shoppingbasket` (
  `basketId` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`basketId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of shoppingbasket
-- ----------------------------
INSERT INTO `shoppingbasket` VALUES ('583785e16be87', 'aaditya');
INSERT INTO `shoppingbasket` VALUES ('583a703e7adef', 'jackson');
INSERT INTO `shoppingbasket` VALUES ('583a8eae59c0b', 'barbara');
INSERT INTO `shoppingbasket` VALUES ('583a92196dd60', 'jhonson');
INSERT INTO `shoppingbasket` VALUES ('583a92dc8311f', 'george');
INSERT INTO `shoppingbasket` VALUES ('5843c9e42619e', 'karthick');
INSERT INTO `shoppingbasket` VALUES ('5843cad071def', 'abc');
INSERT INTO `shoppingbasket` VALUES ('58446be3a7255', 'abcd');
INSERT INTO `shoppingbasket` VALUES ('58446cf04394a', 'abab');
INSERT INTO `shoppingbasket` VALUES ('584470103bca3', 'ab');

-- ----------------------------
-- Table structure for `stocks`
-- ----------------------------
DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks` (
  `ISBN` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `warehouseCode` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  KEY `stocks_ibfk_1` (`ISBN`),
  KEY `stocks_ibfk_2` (`warehouseCode`),
  CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of stocks
-- ----------------------------
INSERT INTO `stocks` VALUES ('1001227246', '2', '340');
INSERT INTO `stocks` VALUES ('0439023483', '1', '0');
INSERT INTO `stocks` VALUES ('0439358078', '2', '700');
INSERT INTO `stocks` VALUES ('0061122416', '1', '1000');
INSERT INTO `stocks` VALUES ('0061122416', '2', '800');
INSERT INTO `stocks` VALUES ('0375831002', '1', '0');
INSERT INTO `stocks` VALUES ('0375831002', '2', '0');
INSERT INTO `stocks` VALUES ('0385199570', '1', '1240');
INSERT INTO `stocks` VALUES ('0812550706', '2', '3580');
INSERT INTO `stocks` VALUES ('1594480001', '1', '0');
INSERT INTO `stocks` VALUES ('1594480001', '2', '5000');
INSERT INTO `stocks` VALUES ('1001227244', '1', '1740');
INSERT INTO `stocks` VALUES ('1001227244', '2', '1510');
INSERT INTO `stocks` VALUES ('1001227245', '2', '1645');

-- ----------------------------
-- Table structure for `warehouse`
-- ----------------------------
DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE `warehouse` (
  `warehouseCode` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`warehouseCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of warehouse
-- ----------------------------
INSERT INTO `warehouse` VALUES ('1', 'ware 1', 'UTA blvd', '6822487783');
INSERT INTO `warehouse` VALUES ('2', 'Ware 2', 'cooper street', '6822487010');
INSERT INTO `warehouse` VALUES ('3', 'ArligntonWare', 'Arlington', '8978455612');
INSERT INTO `warehouse` VALUES ('4', 'DallasWare', 'Dallas', '9874102365');

-- ----------------------------
-- Table structure for `writtenby`
-- ----------------------------
DROP TABLE IF EXISTS `writtenby`;
CREATE TABLE `writtenby` (
  `ssn` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ISBN` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `writtenby_ibfk_1` (`ssn`),
  KEY `writtenby_ibfk_2` (`ISBN`),
  CONSTRAINT `writtenby_ibfk_1` FOREIGN KEY (`ssn`) REFERENCES `author` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `writtenby_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of writtenby
-- ----------------------------
INSERT INTO `writtenby` VALUES ('1048', '1001227244');
INSERT INTO `writtenby` VALUES ('1048', '1001227245');
INSERT INTO `writtenby` VALUES ('1050', '1001227246');
INSERT INTO `writtenby` VALUES ('023-65-54', '0439023483');
INSERT INTO `writtenby` VALUES ('23-98-789', '0439358078');
INSERT INTO `writtenby` VALUES ('123-45-67', '0061122416');
INSERT INTO `writtenby` VALUES ('231-65-98', '0375831002');
INSERT INTO `writtenby` VALUES ('234-89-74', '0385199570');
INSERT INTO `writtenby` VALUES ('023-65-54', '0812550706');
INSERT INTO `writtenby` VALUES ('023-65-54', '1594480001');
