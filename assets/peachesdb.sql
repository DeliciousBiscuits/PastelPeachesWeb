CREATE DATABASE `peachesdb` ;	
CREATE TABLE `customer` (
 `customerId` int(6) NOT NULL AUTO_INCREMENT,
 `customerFirstName` varchar(60) DEFAULT NULL,
 `customerLastName` varchar(60) DEFAULT NULL,
 `customerUserName` varchar(30) NOT NULL,
 `customerPassword` char(100) NOT NULL,
 `customerEmail` varchar(80) NOT NULL,
 `customerPhone` int NOT NULL,
  PRIMARY KEY (`customerId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4

CREATE TABLE `products`(
  `productId` int(6) NOT NULL AUTO_INCREMENT,
  `productName` varchar(200) NOT NULL,
  `productCategory` varchar(200) NOT NULL,
  `productDescription` varchar(280) NOT NULL,
  `productPrice` double NOT NULL,
  `productStatus` varchar(100) NOT NULL, 
  PRIMARY KEY (`productId`)
);