-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/08/2025 às 03:11
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cantinadef`
--



CREATE TABLE `cliente` (
  `nome` varchar(60) NOT NULL,
  `cpf` char(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `turma` enum('1DS','2DS','3DS','') NOT NULL,
  `senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`nome`, `cpf`, `email`, `turma`, `senha`) VALUES
('davi', '01424537437', 'gbidinoti@gmail.com', '2DS', '$2y$10$h181VJ/9evJZH9XzJXtgbeAn5hEV5ryK7EaTwLw5Dp74.uNtHau1G'),
('yagho', '12345678910', 'yaghochinaglia@gmail.com', '1DS', '$2y$10$h/f2/zbIfQVINIbcX2nShOmq6hi0jNpAW46jM0djhpi9coBpDY5G2');

-- --------------------------------------------------------
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cpf`);


-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
