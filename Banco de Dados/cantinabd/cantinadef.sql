-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/08/2025 às 16:27
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
('Lucas Nunes', '14356789741', 'lucasnunes23@gmail.com', '2DS', '$2y$10$Ah8phSo53QToDYmPVbx91ue//HDm6ai3dwv7AuhHSJUBjvGCJDkPK'),
('111111', '44444444442', 'yaghochinaglia@gmail.com', '1DS', '$2y$10$CSXOfcR/FgNDyNWe1zl2P.LVAl217eSe/XFHD338c1NTAtkEN9SkS'),
('111111', '44444444454', 'yaghochinaglia@gmail.com', '1DS', '$2y$10$LvYim08e/zSZAICmNunLieaC.96eozyusaKSiA1D8Clv1g1fA4JXi'),
('111111', '44445555555', 'yaghochinaglia@gmail.com', '2DS', '$2y$10$mXmF6kywScxam1vL75Bm..HCZFnZC2ejGpj2B9ymyUxSolIVhgupu'),
('111111', '44445555556', 'yaghochinaglia@gmail.com', '', '$2y$10$0din5MuSkPw8g8UjC9hQQuvDSjEfcA7LRB3BlxvAONKe63iLDNrlu');

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
('FRANGO DE CAPUTOITY KAKIA JUISJS', 'brigadeiro de chocolate aaaaaaaa aaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaaaaaa', 7, 8, 'Salgados', 49, 'croissantcalabresa.png'),
('FRANGO DE CAPUTOITY KAKIA JUISJS', 'brigadeiro de chocolate aaaaaaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaaaaaa', 7, 8, 'Salgados', 50, 'cha.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
