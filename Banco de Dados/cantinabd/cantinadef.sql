-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/08/2025 às 02:01
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
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

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `Nome` varchar(100) NOT NULL,
  `Descricao` varchar(1000) NOT NULL,
  `Preco` decimal(10,0) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Categoria` enum('Salgados','Doces','Folhados','Bebidas','Outros') NOT NULL,
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`Nome`, `Descricao`, `Preco`, `Quantidade`, `Categoria`, `id`, `img`) VALUES
('Coxinha de Frango', 'Coxinha de frango gostoso', 10, 2, 'Salgados', 20, ''),
('Esfiha de Frango', 'Esfiha de frango gostoso', 10, 3, 'Salgados', 21, ''),
('Salgado Folhado', 'Salgado Folhado gostoso', 10, 2, 'Folhados', 22, ''),
('Esfiha de Frango', 'Esfiha de Carne gostoso', 0, 5, 'Salgados', 23, ''),
('Esfiha de Queijo', 'Esfiha de Queijo Gostoso', 6, 6, 'Salgados', 24, ''),
('Esfiha de Queijo', 'Esfiha de Queijo Gostoso', 6, 6, 'Salgados', 25, ''),
('Esfiha de Queijo', 'Esfiha de Queijo Gostoso', 6, 6, 'Salgados', 26, ''),
('Coxinha de Frango', 'Esfiha de frango gostoso', 1, 1, 'Bebidas', 27, ''),
('Coxinha de Frango', 'Esfiha de frango gostoso', 1, 1, 'Bebidas', 28, ''),
('Coxinha de Frango', 'Esfiha de frango gostoso', 1, 1, 'Bebidas', 29, ''),
('Coxinha de Frango', 'Esfiha de frango gostoso', 1, 1, 'Bebidas', 30, ''),
('', '', 0, 0, '', 31, ''),
('', '', 0, 0, '', 32, ''),
('', '', 0, 0, '', 33, ''),
('', '', 0, 0, '', 34, ''),
('', '', 0, 0, '', 35, ''),
('', '', 0, 0, '', 36, ''),
('', '', 0, 0, '', 37, ''),
('', '', 0, 0, '', 38, ''),
('', '', 0, 0, '', 39, ''),
('Coxinha de Frango', 'Coxinha de frango gostoso', 1, 1, 'Doces', 40, ''),
('Coxinha de Frango', 'Coxinha de frango gostoso', 1, 1, 'Doces', 41, ''),
('Esfiha de Frango', 'Coxinha de frango gostoso', 1, 1, 'Salgados', 42, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
