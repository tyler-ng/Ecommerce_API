-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2021 at 03:46 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `8185_project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `CartItem`
--

CREATE TABLE `CartItem` (
  `id` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `text` text NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ImagePath`
--

CREATE TABLE `ImagePath` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `commentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `taxes` double NOT NULL,
  `total` double NOT NULL,
  `count` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `shipping_address_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`id`, `subtotal`, `taxes`, `total`, `count`, `userId`, `shipping_address_id`, `date`) VALUES
(2, 120, 15.6, 135.6, 5, 17, 1, '2021-03-09 16:30:23'),
(3, 100, 10, 110, 6, 18, 1, '2021-03-09 16:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `Order_Item`
--

CREATE TABLE `Order_Item` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Order_Item`
--

INSERT INTO `Order_Item` (`id`, `orderId`, `productId`, `quantity`) VALUES
(3, 2, 1, 2),
(4, 2, 2, 1),
(7, 3, 5, 2),
(8, 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `price` double NOT NULL,
  `shippingcost` double NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`id`, `description`, `image`, `price`, `shippingcost`, `name`) VALUES
(1, 'Beef is the culinary name for meat from cattle, particularly skeletal muscle. Humans have been eating beef since prehistoric times.[1] Beef is a source of high-quality protein and essential nutrients', 'https://www.themealdb.com/images/category/beef.png', 9.5, 0, 'Beef'),
(2, 'Chicken is a type of domesticated fowl, a subspecies of the red junglefowl. It is one of the most common and widespread domestic animals, with a total population of more than 19 billion as of 2011.[1] Humans commonly keep chickens as a source of food (consuming both their meat and eggs) and, more rarely, as pets.', 'https://www.themealdb.com/images/category/chicken.png', 5.5, 0, 'Chicken'),
(3, 'Dessert is a course that concludes a meal. The course usually consists of sweet foods, such as confections dishes or fruit, and possibly a beverage such as dessert wine or liqueur, however in the United States it may include coffee, cheeses, nuts, or other savory items regarded as a separate course elsewhere. In some parts of the world, such as much of central and western Africa', 'https://www.themealdb.com/images/category/dessert.png', 6.5, 0, 'Dessert'),
(4, 'Lamb, hogget, and mutton are the meat of domestic sheep (species Ovis aries) at different ages.\\r\\n\\r\\nA sheep in its first year is called a lamb, and its meat is also called lamb. The meat of a juvenile sheep older than one year is hogget; outside the USA this is also a term for the living animal. The meat of an adult sheep is mutton, a term only used for the meat, not the living animals. The term mutton is almost always used to refer to goat meat in the Indian subcontinent', 'https://www.themealdb.com/images/category/lamb.png', 8.5, 0, 'Lamb'),
(5, 'General foods that don\'t fit into another category', 'https://www.themealdb.com/images/category/miscellaneous.png', 8.5, 0, 'Miscellaneous');

-- --------------------------------------------------------

--
-- Table structure for table `Shipping_Address`
--

CREATE TABLE `Shipping_Address` (
  `id` int(11) NOT NULL,
  `addressline` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postalcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Shipping_Address`
--

INSERT INTO `Shipping_Address` (`id`, `addressline`, `city`, `province`, `country`, `postalcode`) VALUES
(1, '123 Ottawa St', 'Kitchener', 'ON', 'Canada', 'M4N B9L');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `firstname`, `lastname`, `created`, `modified`, `phone_number`) VALUES
(17, 'kelvin@gmail.com', '$2y$10$jVkoXU2DZuaftJnY50C6d.jVwabjE6cpFNV3tEPzG1ySzHneaYIwS', 'kelvin', 'do', '2021-02-27 10:35:45', '2021-02-27 15:35:45', '3364567512'),
(18, 'jane2@gmail.com', '$2y$10$cp3D7.ilCcsAeRFhSmf6YOn1DyvYxIatzG.4p5HXjeIdeV/eVFOHK', 'janenhung', 'do', '2021-03-09 13:47:34', '2021-03-09 18:47:34', '2255562350'),
(22, 'thanhnguyen@gmail.com', '$2y$10$r7ruUtIbGGfXkYbtpWKJruYxvqoeDDGmigkKMXu5BJk53A29oRt2i', 'thanh', 'tran', '2021-03-09 21:12:18', '2021-03-10 02:12:18', '31312312000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CartItem`
--
ALTER TABLE `CartItem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CartItem_Cart_FK` (`cartId`),
  ADD KEY `CartItem_Product_FK` (`productId`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Comment_Product_FK` (`productId`);

--
-- Indexes for table `ImagePath`
--
ALTER TABLE `ImagePath`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Comments_Images_FK` (`commentId`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Order_User_FK` (`userId`),
  ADD KEY `Order_ShippingAddress_FK` (`shipping_address_id`);

--
-- Indexes for table `Order_Item`
--
ALTER TABLE `Order_Item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `OrderItem_Order_FK` (`orderId`) USING BTREE,
  ADD KEY `OrderItem_Product_FK` (`productId`) USING BTREE;

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Shipping_Address`
--
ALTER TABLE `Shipping_Address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CartItem`
--
ALTER TABLE `CartItem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ImagePath`
--
ALTER TABLE `ImagePath`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Order_Item`
--
ALTER TABLE `Order_Item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Shipping_Address`
--
ALTER TABLE `Shipping_Address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CartItem`
--
ALTER TABLE `CartItem`
  ADD CONSTRAINT `CartItem_Cart_FK` FOREIGN KEY (`cartId`) REFERENCES `Cart` (`id`),
  ADD CONSTRAINT `CartItem_Product_FK` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`);

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comment_Product_FK` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`);

--
-- Constraints for table `ImagePath`
--
ALTER TABLE `ImagePath`
  ADD CONSTRAINT `Comments_Images_FK` FOREIGN KEY (`commentId`) REFERENCES `Comments` (`id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Order_ShippingAddress_FK` FOREIGN KEY (`shipping_address_id`) REFERENCES `shipping_address` (`id`),
  ADD CONSTRAINT `Order_User_FK` FOREIGN KEY (`userId`) REFERENCES `User` (`id`);

--
-- Constraints for table `Order_Item`
--
ALTER TABLE `Order_Item`
  ADD CONSTRAINT `OrderProduct_Order_FK` FOREIGN KEY (`orderId`) REFERENCES `Orders` (`id`),
  ADD CONSTRAINT `OrderProduct_Product_FK` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
