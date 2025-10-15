-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/10/2025 às 21:33
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
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `nome` varchar(255) NOT NULL,
  `cpf` char(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` int(20) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `adm` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administradores`
--

INSERT INTO `administradores` (`nome`, `cpf`, `email`, `telefone`, `senha`, `adm`) VALUES
('admin bosta', '77777777777', 'caiopica@gmail.com', 11, '$2y$10$f.SpVyR30gawIMTwS/Cm3.ZWnn5JlglAvJ82dvtBi5Qsi9TyuZlIK', 0),
('Admin', '99999999999', 'yaghochinaglia@gmail.com', 11, '$2y$10$f.SpVyR30gawIMTwS/Cm3.ZWnn5JlglAvJ82dvtBi5Qsi9TyuZlIK', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `nome` varchar(60) NOT NULL,
  `cpf` char(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `turma` enum('1DS','2DS','3DS','') NOT NULL,
  `senha` varchar(200) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`nome`, `cpf`, `email`, `turma`, `senha`, `admin`) VALUES
('Davi', '12345678940', 'davi@gmail.com', '3DS', '$2y$10$6t4Yk/hLY0a28XeREqHa4OUgd25NkFdHudRbff5ZUdQoUc1LDlFgy', 0),
('Lucas Nunes', '14356789741', 'lucasnunes23@gmail.com', '2DS', '$2y$10$Ah8phSo53QToDYmPVbx91ue//HDm6ai3dwv7AuhHSJUBjvGCJDkPK', 0),
('111111', '44444444442', 'yaghochinaglia@gmail.com', '1DS', '$2y$10$CSXOfcR/FgNDyNWe1zl2P.LVAl217eSe/XFHD338c1NTAtkEN9SkS', 0),
('111111', '44444444454', 'yaghochinaglia@gmail.com', '1DS', '$2y$10$LvYim08e/zSZAICmNunLieaC.96eozyusaKSiA1D8Clv1g1fA4JXi', 0),
('111111', '44445555555', 'yaghochinaglia@gmail.com', '2DS', '$2y$10$mXmF6kywScxam1vL75Bm..HCZFnZC2ejGpj2B9ymyUxSolIVhgupu', 0),
('111111', '44445555556', 'yaghochinaglia@gmail.com', '', '$2y$10$0din5MuSkPw8g8UjC9hQQuvDSjEfcA7LRB3BlxvAONKe63iLDNrlu', 0),
('yagho', '66666666666', 'yaghochinaglia@gmail.com', '1DS', '$2y$10$fxUyt46KKPA1KJ/u.ODQh.bemr9BKkasMiKZxRxILQlDbu3sSQBF.', 0);

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
  `img` varchar(255) NOT NULL,
  `in_main` tinyint(1) NOT NULL DEFAULT 0,
  `mais_pedido` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`Nome`, `Descricao`, `preco`, `Quantidade`, `Categoria`, `id`, `img`, `in_main`, `mais_pedido`) VALUES
('Esfiha de Carne', 'Massa leve e assada no forno, aberta em formato tradicional, com recheio de carne moída temperada com cebola e especiarias, dourada e suculenta.', 7.00, 15, 'Salgados', 53, 'esfiha5.png', 1, 0),
('Bauru', 'Pão macio recheado com presunto fatiado, queijo derretido, tomate fresco e orégano, servido quentinho.', 7.00, 15, 'Salgados', 54, 'bauru.png', 1, 0),
('Croissant de calabresa', 'Massa folhada leve e crocante, recheada com linguiça calabresa fatiada e queijo derretido, assada até ficar dourada.', 7.00, 12, 'Salgados', 58, 'croissantcalabresa.png', 1, 0),
('Croissant de frango', 'Massa folhada leve e dourada, recheada com frango desfiado temperado e queijo cremoso.', 7.00, 12, 'Salgados', 59, 'croissant-frango.png', 0, 0),
('Cup Noodles de carne', 'Macarrão instantâneo em caldo sabor carne, com tempero especial e pedaços de vegetais desidratados.', 5.00, 25, 'Salgados', 60, 'cup1.png', 0, 0),
('Coxinha de frango', 'Massa macia e dourada, recheada com frango desfiado temperado e cremosa por dentro.', 7.00, 15, 'Salgados', 63, 'coxinha.png', 0, 0),
('Kibe', 'Massa de trigo e carne temperada com especiarias, moldada e assada até ficar dourada e saborosa.', 7.00, 0, 'Salgados', 64, 'quibeassadound.png', 0, 0),
('Pão de batata', 'Massa macia e levemente adocicada, feita com batata, assada até ficar dourada e saborosa.', 6.50, 22, 'Salgados', 65, 'paodebatata.png', 0, 0),
('Folhado quatro queijos', 'Massa folhada crocante, recheada com uma mistura cremosa de quatro queijos, assada até dourar.', 7.00, 20, 'Folhados', 68, 'folhado4queijos.png', 1, 0),
('Folhado Palmito', 'Massa folhada crocante, recheada com palmito temperado e um toque de ervas, assada até dourar.', 7.00, 20, 'Folhados', 69, 'FolhadoPalmito.png', 1, 0),
('Folhado de carne', 'Massa folhada dourada, recheada com carne temperada e suculenta, assada até ficar crocante.', 7.00, 22, 'Folhados', 70, 'folhadoCarne.png', 1, 0),
('Brigadeiro', 'Doce de chocolate cremoso, enrolado e coberto com granulado.', 3.00, 35, 'Doces', 71, 'brigadeiro.png', 1, 0),
('Beijinho', 'Doce de chocolate cremoso, enrolado e coberto com granulado.', 3.00, 32, 'Doces', 72, 'beijinho.png', 1, 0),
('Pudim', 'Sobremesa cremosa de leite e ovos, coberta com calda de caramelo.', 5.00, 20, 'Doces', 73, 'pudim.png', 1, 0),
('Brigadeiro de colher', 'Doce de chocolate cremoso e indulgente, servido em potinho para saborear com colher.', 3.50, 25, 'Doces', 74, 'colher.png', 0, 0),
('Café 300ml', 'Bebida quente e aromática, perfeita para acompanhar qualquer lanche.', 3.00, 20, 'Bebidas', 76, 'cafe1.png', 1, 0),
('Coca-Cola 350ml', 'Refrigerante gelado, refrescante e clássico.', 4.00, 35, 'Bebidas', 77, 'coca.png', 1, 0),
('Suco de morango 600ml', 'Suco natural de morango, doce e refrescante.', 6.00, 15, 'Bebidas', 78, 'morango.png', 1, 0),
('Suco de manga 600ml', 'Suco natural e refrescante de manga, doce e saboroso.', 6.00, 22, 'Bebidas', 79, 'manga.png', 0, 0),
('Combo Hamburguer, batata frita e coca-cola', 'Hambúrguer suculento, acompanhado de batata frita crocante e Coca-Cola 350ml geladinha.', 15.00, 15, 'Outros', 80, 'combo.png', 0, 0),
('Combo mini coxinha, kibe e bolinho de queijo', 'Coxinha, kibe e bolinho de queijo, todos macios e recheados, servidos quentinhos.', 22.00, 13, 'Outros', 81, 'varios.png', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data_compra` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`cpf`);

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
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
