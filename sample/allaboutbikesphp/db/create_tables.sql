-- SQL schema for All About Bikes
-- Run this in MySQL (e.g., via phpMyAdmin or the provided PHP script)

CREATE DATABASE IF NOT EXISTS `allaboutbikes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `allaboutbikes`;

-- customers
CREATE TABLE IF NOT EXISTS `customer` (
  `Customer_ID` INT AUTO_INCREMENT PRIMARY KEY,
  `First_Name` VARCHAR(100) NOT NULL,
  `Last_Name` VARCHAR(100) NOT NULL,
  `Email` VARCHAR(255),
  `Phone` VARCHAR(50),
  `Address` TEXT,
  `Created_At` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- employees
CREATE TABLE IF NOT EXISTS `employee` (
  `Employee_ID` INT AUTO_INCREMENT PRIMARY KEY,
  `Username` VARCHAR(100) NOT NULL UNIQUE,
  `Password_Hash` VARCHAR(255) NOT NULL,
  `Full_Name` VARCHAR(200),
  `Role` VARCHAR(50),
  `Created_At` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- bikes
CREATE TABLE IF NOT EXISTS `bike` (
  `Bike_ID` INT AUTO_INCREMENT PRIMARY KEY,
  `Model` VARCHAR(200) NOT NULL,
  `Brand` VARCHAR(100),
  `Category` VARCHAR(100),
  `Price` DECIMAL(10,2) DEFAULT 0,
  `Available` TINYINT(1) DEFAULT 1,
  `Created_At` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- parts
CREATE TABLE IF NOT EXISTS `part` (
  `Part_ID` INT AUTO_INCREMENT PRIMARY KEY,
  `Name` VARCHAR(200) NOT NULL,
  `Part_Type` VARCHAR(100),
  `Brand` VARCHAR(100),
  `Price` DECIMAL(10,2) DEFAULT 0,
  `Stock_Quantity` INT DEFAULT 0,
  `Created_At` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- rentals
CREATE TABLE IF NOT EXISTS `rental` (
  `Rental_ID` INT AUTO_INCREMENT PRIMARY KEY,
  `Customer_ID` INT NOT NULL,
  `Bike_ID` INT NOT NULL,
  `Start_Date` DATETIME NOT NULL,
  `End_Date` DATETIME DEFAULT NULL,
  `Total` DECIMAL(10,2) DEFAULT 0,
  `Status` VARCHAR(50) DEFAULT 'reserved',
  `Created_At` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`Customer_ID`) REFERENCES `customer`(`Customer_ID`) ON DELETE CASCADE,
  FOREIGN KEY (`Bike_ID`) REFERENCES `bike`(`Bike_ID`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- repairs
CREATE TABLE IF NOT EXISTS `repair` (
  `Repair_ID` INT AUTO_INCREMENT PRIMARY KEY,
  `Customer_ID` INT,
  `Bike_ID` INT,
  `Service` VARCHAR(255),
  `Price` DECIMAL(10,2) DEFAULT 0,
  `Status` VARCHAR(50) DEFAULT 'pending',
  `Created_At` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`Customer_ID`) REFERENCES `customer`(`Customer_ID`) ON DELETE SET NULL,
  FOREIGN KEY (`Bike_ID`) REFERENCES `bike`(`Bike_ID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- sales (orders)
CREATE TABLE IF NOT EXISTS `sale` (
  `Sale_ID` INT AUTO_INCREMENT PRIMARY KEY,
  `Customer_ID` INT,
  `Total` DECIMAL(10,2) DEFAULT 0,
  `Created_At` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`Customer_ID`) REFERENCES `customer`(`Customer_ID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `sale_detail` (
  `Sale_Detail_ID` INT AUTO_INCREMENT PRIMARY KEY,
  `Sale_ID` INT NOT NULL,
  `Part_ID` INT NOT NULL,
  `Quantity` INT DEFAULT 1,
  `Unit_Price` DECIMAL(10,2) DEFAULT 0,
  FOREIGN KEY (`Sale_ID`) REFERENCES `sale`(`Sale_ID`) ON DELETE CASCADE,
  FOREIGN KEY (`Part_ID`) REFERENCES `part`(`Part_ID`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- indexes for performance
CREATE INDEX IF NOT EXISTS idx_part_name ON `part`(`Name`(50));
CREATE INDEX IF NOT EXISTS idx_bike_model ON `bike`(`Model`(50));

-- Sample data (optional)
INSERT INTO `part` (`Name`, `Part_Type`, `Brand`, `Price`, `Stock_Quantity`) VALUES
('Inner Tube', 'Tire', 'Generic', 99.00, 50),
('Brake Pad Set', 'Brake', 'Shimano', 299.00, 20);
