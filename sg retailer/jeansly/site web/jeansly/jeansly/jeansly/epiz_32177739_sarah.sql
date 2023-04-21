-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql108.epizy.com
-- Generation Time: Sep 10, 2022 at 01:30 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_32177739_sarah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(2, 'rafedtaieb44@gmail.c', '84d22aa2206113dc06088787e379e5efd9d66570'),
(3, 'Rafed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(4, 'sarah', '150afba2f606bf3e450d7dbfba16c6673580cb77');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL DEFAULT 1,
  `size` varchar(4) NOT NULL DEFAULT 'S',
  `image` varchar(100) NOT NULL,
  `image_02` varchar(100) CHARACTER SET utf8 NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `size`, `image`, `image_02`, `image_03`) VALUES
(109, 42, 87, 'ROBE brown', 150, 1, 'S', 'ga.jpg', '', ''),
(118, 43, 72, 'veste', 149, 1, 'S', 'ba.jpg', '', ''),
(120, 32, 72, 'veste', 149, 2, 'S', 'ba.jpg', '', ''),
(121, 44, 72, 'veste', 149, 1, 'S', 'ba.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(8, 32, 'RAFED TAIEB', 'rafedtaieb44@gmail.com', '20390579', 'FMA 5OBEZ ?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'en attendant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(27, 32, 'rafedtaieb', '20390645', 'kolastolas666@gmail.com', 'paiement Ã  la livraison', 'flat no. gzgzhhshs hzhzhzhhs gafsa elgutar Tunisia  - 2180', ', Robe Inspiration ( 2 )', 598, '10-Aug-2022', 'A_Ã©tÃ©_reÃ§u'),
(28, 32, 'rafed', '20390579', 'rafedtaieb44@gmail.com', 'paiement Ã  la livraison', 'flat no. ELGUTAR GAFSA ragzegd GAFSA ELGUTAR Tunisia - 2180', ', Chemise corps ( 1 )', 69, '11-Aug-2022', 'en attendant'),
(29, 32, 'rafed', '20390546', 'rafedtaieb44@gmail.com', 'paiement Ã  la livraison', 'flat no. gduhwvxvhs bshhwvxhsj gafsa elgutar tubsia - 2180', ', veste ( 2 ), ROBE brown ( 1 )', 448, '12-Aug-2022', 'A_Ã©tÃ©_reÃ§u'),
(30, 43, 'rqfed', '20390597', 'rafedtaieb44@gmail.com', 'paiement Ã  la livraison', 'flat no. hsghdhehd  gafsa elgutar tunsia - 2180', ', Chemise corps ( 1 )', 69, '12-Aug-2022', 'branch Mestir'),
(31, 32, 'RAFED TAIEB', '20395297', 'rafedtaieb44@gmail.com', 'paiement Ã  la livraison', 'flat no. ELGUTAR GAFSA kjrtjtj GAFSA ELGUTAR Tunisia - 2180', ', ROBE brown XL ( 2 )', 300, '12-Aug-2022', 'en attendant');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `hf` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(100) NOT NULL,
  `image_02` varchar(100) CHARACTER SET utf8 NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `stock` varchar(20) NOT NULL DEFAULT 'En stock'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `hf`, `details`, `price`, `image`, `image_02`, `image_03`, `stock`) VALUES
(72, 'veste', 'Blouson', 'homme', 'veste falmemmemefa', 149, 'ba.jpg', 'Capture.png', 'â€”Pngtreeâ€”real estate stats icon in_5289473.png', 'En stock'),
(76, 'Chemise corps', 'CHEMISES1', 'homme', 'Chemise en popeline compacte (100 % coton)\r\n\r\n- Coupe sportive\r\n- Col Emile\r\n- Boutons en pure nacre\r\n- Poignets simples avec boutons Clou de Selle en palladium, coutures renforcÃ©es, 7 points par cm\r\n- Poches poitrine boutonnÃ©e ombrÃ©e\r\n\r\nFabriquÃ© en France\r\n\r\nCe modÃ¨le taille normalement, nous vous conseillons de prendre votre taille habituelle.\r\n\r\nLongueur : 78 cm | Les dimensions indiquÃ©es correspondent Ã  une taille 39, elles peuvent varier de +/- 1 cm en fonction de la taille.', 69, 'af.jpg', 'ba.jpg', 'tga.jpg', 'En stock'),
(79, 'Pantalon Saint Germain', 'PANTALONS1', 'homme', 'Pantalon Saint Germain en drill de coton stretch (98 % coton et 2 % Ã©lasthanne)\r\n\r\n- Coupe ajustÃ©e\r\n- DÃ©tails dÃ©coupe\r\n\r\nFabriquÃ© en Italie\r\n\r\nCe modÃ¨le taille normalement, nous vous conseillons de prendre votre taille habituelle.\r\n\r\nBas : 19 cm | Montant : 23 cm | Les dimensions indiquÃ©es correspondent Ã  une taille 40, elles peuvent varier de +/- 1 cm en fonction de la taille.', 89, 'pen1.jpg', 'pan.jpg', 'pen2.jpg', 'En stock'),
(87, 'ROBE brown', 'ROBES', 'femme', 'Chemise en popeline compacte (100 % coton) - Coupe sportive - Col Emile - Boutons en pure nacre - Poignets simples avec boutons Clou de Selle en palladium, coutures renforcÃ©es, 7 points par cm - Poches poitrine boutonnÃ©e ombrÃ©e FabriquÃ© en France Ce modÃ¨le taille normalement, nous vous conseillons de prendre votre taille habituelle. Longueur : 78 cm | Les dimensions indiquÃ©es correspondent Ã  une taille 39, elles peuvent varier de +/- 1 cm en fonction de la taille.', 150, 'ga.jpg', 'ga.jpg', 'robe.jpg', 'En stock');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(32, 'rafed', 'rafedtaieb44@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', '1222.JPG'),
(33, 'ahmed', 'ahmedsoltan@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', 'home-bg.jpg'),
(34, 'samia', 'rafedtaiebgg44@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', 'pic-6.png'),
(35, 'gzgga', 'rafedtaiegzb44@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', 'pic-2.png'),
(36, 'RAFED faTAIEB', 'fafaiebfafa44@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', 'pic-3.png'),
(37, 'FAFGA', 'grggghh44@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', 'pic-5.png'),
(38, 'Quagantity', 'rafedtaigabg44@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', 'pic-4.png'),
(39, 'gaga', 'rafeddgdstai4@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', 'a.jpeg'),
(40, 'raga', 'hgdfhh44@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', 'imgonline-com-ua-resize-qN6zNjoK6A.jpg'),
(41, 'admingazg', 'rafedtaagzgieb44@gmail.com', '7bc24f4e885879a80ebeb8cb795209a0', 'user', 'ph.png'),
(42, 'Bou zeb', 'bouzeb1@gmail.com', '35e6c4aa7e20fe892dbb7feec87b57b6', 'user', 'inbound7335135641201324300.jpg'),
(43, 'PATA', 'rafedtaieb454@gmail.com', '07cc387db9c65358bee3fdf9b2785b98', 'user', 'Screenshot_2022-08-12-03-01-57-870_com.instagram.android.jpg'),
(44, 'ahmed', 'banoni.bro@gmail.com', 'e6c54be0791a1dd5635cea3b31092f4a', 'user', '2.jpg.png');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
