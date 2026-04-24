CREATE DATABASE IF NOT EXISTS store_dev1;
USE store_dev1;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `points` int DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` VALUES (1,'Jānis','Bērziņš','janis.b@example.com','1990-05-15',100);
INSERT INTO `customers` VALUES (2,'Anna','Kalniņa','anna.k@example.com','1985-11-20',250);
INSERT INTO `customers` VALUES (3,'Pēteris','Ozols','peteris.o@example.com','1995-02-10',50);
INSERT INTO `customers` VALUES (4,'Maija','Liepa','maija.l@example.com','1988-08-30',0);

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_date` date DEFAULT NULL,
  `status` enum('new','paid','delivered') DEFAULT NULL,
  `comment` text,
  `image` varchar(255) DEFAULT NULL,
  `shipping_date` date DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` VALUES (1,'2019-10-01','delivered','Pirmā adrese',NULL,'2023-10-05',1);
INSERT INTO `orders` VALUES (2,'2020-10-02','paid','Steidzami',NULL,NULL,1);
INSERT INTO `orders` VALUES (3,'2021-10-03','delivered','Dāvana','images/plush.webp','2023-10-06',2);
INSERT INTO `orders` VALUES (4,'2022-10-04','paid','Klients atteicās',NULL,NULL,2);
INSERT INTO `orders` VALUES (5,'2023-10-05','delivered','',NULL,'2023-10-10',2);
INSERT INTO `orders` VALUES (6,'2024-10-06','delivered','Lauku adrese',NULL,'2023-10-12',3);
INSERT INTO `orders` VALUES (7,'2025-10-07','new','Zvanīt pirms',NULL,NULL,3);
INSERT INTO `orders` VALUES (8,'2026-04-24','new','моей маме',NULL,NULL,1);
INSERT INTO `orders` VALUES (9,'2026-04-08','paid','писечки попочки','images/1777013515_miku_order.jpg',NULL,2);
INSERT INTO `orders` VALUES (10,'2026-03-05','delivered','',NULL,NULL,3);

--
-- User setup
--

CREATE USER IF NOT EXISTS 'store_app1'@'192.168.10.79' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON store_dev1.* TO 'store_app1'@'192.168.10.79';
FLUSH PRIVILEGES;