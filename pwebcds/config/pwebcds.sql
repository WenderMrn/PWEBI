-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 30-Ago-2016 às 04:38
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
(62, 'A Primeira Pedra', '', '2016-08-29', 2),
(63, 'Chuva no Mar', '', '2016-08-29', 2),
(64, 'Esqueça', '', '2016-08-29', 2),
(65, 'Volta Meu Amor', '', '2016-08-29', 2),
(66, 'Alta Noite', '', '2016-08-29', 2),
(67, 'It Will Rain', '', '2015-10-27', 3),
(68, 'The Lazy Song', '', '2016-08-29', 3),
(69, 'Count On Me', '', '2016-08-29', 3);

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
(20, 'Jorge Carlos', 'jc', '12Bz/9hNlPLZk');

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
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `singer`
--
ALTER TABLE `singer`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
