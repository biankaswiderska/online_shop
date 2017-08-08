-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 08 Sie 2017, 23:24
-- Wersja serwera: 5.7.18-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `online_shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Categories`
--

CREATE TABLE `Categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `creationDate` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `products` longtext NOT NULL,
  `totalValue` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Orders`
--

INSERT INTO `Orders` (`id`, `ownerId`, `creationDate`, `status`, `products`, `totalValue`) VALUES
(1, 1, '2017-08-08 23:24:10', 0, 'a:1:{i:-1;O:15:\"ProductInBasket\":4:{s:22:\"\0ProductInBasket\0value\";i:25;s:22:\"\0ProductInBasket\0price\";i:5;s:23:\"\0ProductInBasket\0amount\";i:5;s:24:\"\0ProductInBasket\0product\";O:7:\"Product\":6:{s:11:\"\0Product\0id\";i:-1;s:14:\"\0Product\0price\";i:5;s:13:\"\0Product\0name\";s:7:\"Movie 1\";s:20:\"\0Product\0description\";s:19:\"Description movie 1\";s:15:\"\0Product\0weight\";i:4;s:18:\"\0Product\0sizeClass\";i:1;}}}', 15),
(2, 1, '2017-08-08 23:24:19', 0, 'a:1:{i:-1;O:15:\"ProductInBasket\":4:{s:22:\"\0ProductInBasket\0value\";i:25;s:22:\"\0ProductInBasket\0price\";i:5;s:23:\"\0ProductInBasket\0amount\";i:5;s:24:\"\0ProductInBasket\0product\";O:7:\"Product\":6:{s:11:\"\0Product\0id\";i:-1;s:14:\"\0Product\0price\";i:5;s:13:\"\0Product\0name\";s:7:\"Movie 1\";s:20:\"\0Product\0description\";s:19:\"Description movie 1\";s:15:\"\0Product\0weight\";i:4;s:18:\"\0Product\0sizeClass\";i:1;}}}', 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Products`
--

CREATE TABLE `Products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(255) NOT NULL,
  `weight` double NOT NULL,
  `sizeClass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Products`
--

INSERT INTO `Products` (`id`, `name`, `price`, `description`, `weight`, `sizeClass`) VALUES
(1, 'Movie 1', 11, 'Description movie 1', 4, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Reviews`
--

CREATE TABLE `Reviews` (
  `id` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashPass` varchar(255) NOT NULL,
  `accessLevel` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `hashPass`, `accessLevel`) VALUES
(1, 'test1', 'test1@oshop.com', 'test1', 1),
(2, 'test2', 'test2@oshop.com', '$2y$10$rQbEX/i0o82B4FNpdabIA.FCFPfso58YgdExJQ.TSCABe3mUAiTUS', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `toUsers` (`ownerId`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sdag` (`authorId`),
  ADD KEY `gdg` (`productId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `Products`
--
ALTER TABLE `Products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `toUsers` FOREIGN KEY (`ownerId`) REFERENCES `Users` (`id`);

--
-- Ograniczenia dla tabeli `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `gdg` FOREIGN KEY (`productId`) REFERENCES `Products` (`id`),
  ADD CONSTRAINT `sdag` FOREIGN KEY (`authorId`) REFERENCES `Users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
