-- allaboutbikes database schema
-- Generated: 2025-10-16

CREATE DATABASE IF NOT EXISTS `allaboutbikes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `allaboutbikes`;

-- Employee table
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `Employee_ID` INT NOT NULL AUTO_INCREMENT,
  `Employee_name` VARCHAR(255) NOT NULL,
  `employeeUsername` VARCHAR(100) DEFAULT NULL,
  `passwordHash` VARCHAR(255) DEFAULT NULL,
  `Position` VARCHAR(100) DEFAULT NULL,
  `Payment` DECIMAL(10,2) DEFAULT 0.00,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Employee_ID`),
  UNIQUE KEY `uq_employee_username` (`employeeUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Customer table
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `Customer_ID` INT NOT NULL AUTO_INCREMENT,
  `FullName` VARCHAR(255) NOT NULL,
  `Email` VARCHAR(255) DEFAULT NULL,
  `Phone` VARCHAR(50) DEFAULT NULL,
  `Address` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Customer_ID`),
  KEY `idx_customer_email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bike table
DROP TABLE IF EXISTS `bike`;
CREATE TABLE `bike` (
  `Bike_ID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(255) NOT NULL,
  `Brand` VARCHAR(100) DEFAULT NULL,
  `Model` VARCHAR(100) DEFAULT NULL,
  `Year` INT DEFAULT NULL,
  `Price` DECIMAL(10,2) DEFAULT 0.00,
  `Status` ENUM('available','rented','maintenance','sold') NOT NULL DEFAULT 'available',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Bike_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Part / stock table
DROP TABLE IF EXISTS `part`;
CREATE TABLE `part` (
  `Part_ID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(255) NOT NULL,
  `Part_Type` VARCHAR(100) DEFAULT NULL,
  `Brand` VARCHAR(100) DEFAULT NULL,
  `Price` DECIMAL(10,2) DEFAULT 0.00,
  `Stock_Quantity` INT DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Part_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sale header
DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale` (
  `Sale_ID` INT NOT NULL AUTO_INCREMENT,
  `Customer_ID` INT DEFAULT NULL,
  `Employee_ID` INT DEFAULT NULL,
  `Sale_Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Total` DECIMAL(10,2) DEFAULT 0.00,
  PRIMARY KEY (`Sale_ID`),
  KEY `fk_sale_customer` (`Customer_ID`),
  KEY `fk_sale_employee` (`Employee_ID`),
  CONSTRAINT `sale_ibfk_customer` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `sale_ibfk_employee` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sale details
DROP TABLE IF EXISTS `sale_detail`;
CREATE TABLE `sale_detail` (
  `Sale_Detail_ID` INT NOT NULL AUTO_INCREMENT,
  `Sale_ID` INT NOT NULL,
  `Part_ID` INT NOT NULL,
  `Quantity` INT NOT NULL DEFAULT 1,
  `Unit_Price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `Subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`Sale_Detail_ID`),
  KEY `fk_sale_detail_sale` (`Sale_ID`),
  KEY `fk_sale_detail_part` (`Part_ID`),
  CONSTRAINT `sale_detail_ibfk_sale` FOREIGN KEY (`Sale_ID`) REFERENCES `sale` (`Sale_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sale_detail_ibfk_part` FOREIGN KEY (`Part_ID`) REFERENCES `part` (`Part_ID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Rental table
DROP TABLE IF EXISTS `rental`;
CREATE TABLE `rental` (
  `Rental_ID` INT NOT NULL AUTO_INCREMENT,
  `Bike_ID` INT DEFAULT NULL,
  `Customer_ID` INT DEFAULT NULL,
  `Employee_ID` INT DEFAULT NULL,
  `Start_Date` DATETIME NOT NULL,
  `End_Date` DATETIME DEFAULT NULL,
  `Total_Price` DECIMAL(10,2) DEFAULT 0.00,
  `Status` ENUM('active','completed','cancelled') DEFAULT 'active',
  PRIMARY KEY (`Rental_ID`),
  KEY `fk_rental_bike` (`Bike_ID`),
  KEY `fk_rental_customer` (`Customer_ID`),
  KEY `fk_rental_employee` (`Employee_ID`),
  CONSTRAINT `rental_ibfk_bike` FOREIGN KEY (`Bike_ID`) REFERENCES `bike` (`Bike_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `rental_ibfk_customer` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `rental_ibfk_employee` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Repair table
DROP TABLE IF EXISTS `repair`;
CREATE TABLE `repair` (
  `Repair_ID` INT NOT NULL AUTO_INCREMENT,
  `Bike_ID` INT DEFAULT NULL,
  `Customer_ID` INT DEFAULT NULL,
  `Employee_ID` INT DEFAULT NULL,
  `Service_Description` TEXT DEFAULT NULL,
  `Price` DECIMAL(10,2) DEFAULT 0.00,
  `Status` ENUM('pending','in_progress','done') DEFAULT 'pending',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`Repair_ID`),
  KEY `fk_repair_bike` (`Bike_ID`),
  KEY `fk_repair_customer` (`Customer_ID`),
  KEY `fk_repair_employee` (`Employee_ID`),
  CONSTRAINT `repair_ibfk_bike` FOREIGN KEY (`Bike_ID`) REFERENCES `bike` (`Bike_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `repair_ibfk_customer` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `repair_ibfk_employee` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: small initial data for 'part' and 'employee' (no passwords)
INSERT INTO `part` (`Name`,`Part_Type`,`Brand`,`Price`,`Stock_Quantity`) VALUES
('Inner Tube','Tube','Generic',59.00,50),
('Brake Pad','Brake','Shimano',199.00,25),
('Helmet','Accessory','Giro',1299.00,10);

INSERT INTO `employee` (`Employee_name`,`employeeUsername`,`Position`,`Payment`) VALUES
('Default Admin','admin', 'Manager', 0.00);

-- End of schema
