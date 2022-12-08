-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Dez-2022 às 07:02
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gbclicker`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `multiplier`
--

CREATE TABLE `multiplier` (
  `FK_user_email` varchar(256) NOT NULL,
  `multiplier` varchar(10) NOT NULL,
  `multiplierPrice` varchar(100) NOT NULL,
  `10multiplierPrice` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `multiplier`
--

INSERT INTO `multiplier` (`FK_user_email`, `multiplier`, `multiplierPrice`, `10multiplierPrice`) VALUES
('gb@gb', '105', '252', '40351');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `user_email` varchar(256) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_username` varchar(256) NOT NULL,
  `user_money` varchar(100) NOT NULL,
  `user_gbminions` varchar(10) NOT NULL,
  `user_gbminionprice` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`user_email`, `user_password`, `user_username`, `user_money`, `user_gbminions`, `user_gbminionprice`) VALUES
('gb@gb', 'gb', 'Gb', '850', '8', '25600');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `multiplier`
--
ALTER TABLE `multiplier`
  ADD PRIMARY KEY (`FK_user_email`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
