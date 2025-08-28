-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/08/2025 às 01:03
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
('Davi', '12345678940', 'davi@gmail.com', '3DS', '$2y$10$6t4Yk/hLY0a28XeREqHa4OUgd25NkFdHudRbff5ZUdQoUc1LDlFgy'),
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
  `preco` decimal(5,2) DEFAULT NULL,
  `Quantidade` int(11) NOT NULL,
  `Categoria` enum('Salgados','Doces','Folhados','Bebidas','Outros') NOT NULL,
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`Nome`, `Descricao`, `preco`, `Quantidade`, `Categoria`, `id`, `img`) VALUES
('Esfiha de Carne', 'Massa leve e assada no forno, aberta em formato tradicional, com recheio de carne moída temperada com cebola e especiarias, dourada e suculenta.', 7.00, 15, 'Salgados', 53, 'esfiha5.png'),
('Bauru', 'Pão macio recheado com presunto fatiado, queijo derretido, tomate fresco e orégano, servido quentinho.', 7.00, 15, 'Salgados', 54, 'bauru.png'),
('Croissant de calabresa', 'Massa folhada leve e crocante, recheada com linguiça calabresa fatiada e queijo derretido, assada até ficar dourada.', 7.00, 12, 'Salgados', 58, 'croissantcalabresa.png'),
('Croissant de frango', 'Massa folhada leve e dourada, recheada com frango desfiado temperado e queijo cremoso.', 7.00, 12, 'Salgados', 59, 'croissant-frango.png'),
('Cup Noodles de carne', 'Macarrão instantâneo em caldo sabor carne, com tempero especial e pedaços de vegetais desidratados.', 5.00, 25, 'Salgados', 60, 'cup1.png'),
('Coxinha de frango', 'Massa macia e dourada, recheada com frango desfiado temperado e cremosa por dentro.', 7.00, 15, 'Salgados', 63, 'coxinha.png'),
('Kibe', 'Massa de trigo e carne temperada com especiarias, moldada e assada até ficar dourada e saborosa.', 7.00, 12, 'Salgados', 64, 'quibeassadound.png'),
('Pão de batata', 'Massa macia e levemente adocicada, feita com batata, assada até ficar dourada e saborosa.', 6.50, 22, 'Salgados', 65, 'paodebatata.png'),
('Folhado quatro queijos', 'Massa folhada crocante, recheada com uma mistura cremosa de quatro queijos, assada até dourar.', 7.00, 20, 'Folhados', 68, 'folhado4queijos.png'),
('Folhado Palmito', 'Massa folhada crocante, recheada com palmito temperado e um toque de ervas, assada até dourar.', 7.00, 20, 'Folhados', 69, 'FolhadoPalmito.png'),
('Folhado de carne', 'Massa folhada dourada, recheada com carne temperada e suculenta, assada até ficar crocante.', 7.00, 22, 'Folhados', 70, 'folhadoCarne.png'),
('Brigadeiro', 'Doce de chocolate cremoso, enrolado e coberto com granulado.', 3.00, 35, 'Doces', 71, 'brigadeiro.png'),
('Beijinho', 'Doce de chocolate cremoso, enrolado e coberto com granulado.', 3.00, 32, 'Doces', 72, 'beijinho.png'),
('Pudim', 'Sobremesa cremosa de leite e ovos, coberta com calda de caramelo.', 5.00, 20, 'Doces', 73, 'pudim.png'),
('Brigadeiro de colher', 'Doce de chocolate cremoso e indulgente, servido em potinho para saborear com colher.', 3.50, 25, 'Doces', 74, 'colher.png'),
('Café 300ml', 'Bebida quente e aromática, perfeita para acompanhar qualquer lanche.', 3.00, 20, 'Bebidas', 76, 'cafe1.png'),
('Coca-Cola 350ml', 'Refrigerante gelado, refrescante e clássico.', 4.00, 35, 'Bebidas', 77, 'coca.png'),
('Suco de morango 600ml', 'Suco natural de morango, doce e refrescante.', 6.00, 15, 'Bebidas', 78, 'morango.png'),
('Suco de manga 600ml', 'Suco natural e refrescante de manga, doce e saboroso.', 6.00, 22, 'Bebidas', 79, 'manga.png'),
('Combo Hamburguer, batata frita e coca-cola', 'Hambúrguer suculento, acompanhado de batata frita crocante e Coca-Cola 350ml geladinha.', 15.00, 15, 'Outros', 80, 'combo.png'),
('Combo mini coxinha, kibe e bolinho de queijo', 'Coxinha, kibe e bolinho de queijo, todos macios e recheados, servidos quentinhos.', 22.00, 13, 'Outros', 81, 'varios.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
