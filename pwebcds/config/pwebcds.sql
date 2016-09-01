-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 01-Set-2016 às 15:58
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwebcds`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cd`
--

CREATE TABLE `cd` (
  `code` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `photo` text,
  `release_year` varchar(200) DEFAULT NULL,
  `singer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cd`
--

INSERT INTO `cd` (`code`, `title`, `photo`, `release_year`, `singer`) VALUES
(108, 'It Will Rain', '../assets/img/capas/c19ef2e10f923e65d92d2fc4b02b2d4a.jpg', '2016-08-31', 3),
(112, 'Ainda Bem', '../assets/img/capas/b8c52a79c522794e016a3dda65f3a0e4.jpg', '2013-08-31', 2),
(113, 'Just The Way', '../assets/img/capas/4740285cbfc313e9af90569d960cde9d.jpg', '2016-09-01', 3),
(114, 'Depois', '../assets/img/capas/60185c6df1c6210d1880ac04da8fe2ee.jpg', '2016-09-22', 2),
(115, 'Ela só quer paz', '../assets/img/capas/a9da4350b160a4a497259b4b0af85733.jpg', '2016-09-01', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `singer`
--

CREATE TABLE `singer` (
  `code` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `singer`
--

INSERT INTO `singer` (`code`, `name`) VALUES
(3, 'Bruno Mars'),
(24, 'Gilvan Tenorio'),
(2, 'Marisa Monte'),
(1, 'Projota'),
(23, 'Selena Gomez');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `code` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `login` varchar(300) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`code`, `name`, `login`, `password`) VALUES
(5, 'Joao da Silva', 'joaosilva', '12IbR.gJ8wcpc'),
(14, 'Filipe Farias', 'ff', '12IbR.gJ8wcpc'),
(19, 'Jhon Jones', 'jhon', '12IbR.gJ8wcpc'),
(20, 'Jorge Carlos', 'jc', '12Bz/9hNlPLZk'),
(21, 'Fernando', 'nando', '12IbR.gJ8wcpc'),
(22, 'Joao', 'Joao', '12IbR.gJ8wcpc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cd`
--
ALTER TABLE `cd`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `singer`
--
ALTER TABLE `singer`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cd`
--
ALTER TABLE `cd`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `singer`
--
ALTER TABLE `singer`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
