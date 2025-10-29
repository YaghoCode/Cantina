-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/10/2025 às 22:46
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

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
('Davi', '12345678940', 'davi@gmail.com', '3DS', '$2y$10$pzHdSevPdleLT3RB1Syu7e7M/C0W3QQBSzBvlMUKd8tOYEZ2mTlIq', 0),
('Lucas Nunes', '14356789741', 'lucasnunes23@gmail.com', '1DS', '$2y$10$Ah8phSo53QToDYmPVbx91ue//HDm6ai3dwv7AuhHSJUBjvGCJDkPK', 0),
('Yagho Chinaglia', '44444444442', 'yaghochinaglia@gmail.com', '2DS', '$2y$10$CSXOfcR/FgNDyNWe1zl2P.LVAl217eSe/XFHD338c1NTAtkEN9SkS', 0),
('Yagho 2', '44444444454', 'yaghochinaglia@gmail.com', '1DS', '$2y$10$LvYim08e/zSZAICmNunLieaC.96eozyusaKSiA1D8Clv1g1fA4JXi', 0);

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
  `id` int(11) UNSIGNED NOT NULL,
  `img` varchar(255) NOT NULL,
  `in_main` tinyint(1) NOT NULL DEFAULT 0,
  `mais_pedido` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`Nome`, `Descricao`, `preco`, `Quantidade`, `Categoria`, `id`, `img`, `in_main`, `mais_pedido`) VALUES
('Esfiha de Cliente', 'Massa leve e assada no forno, aberta em formato tradicional, com recheio de carne moída temperada com cebola e especiarias, dourada e suculenta.', 7.00, 15, 'Salgados', 53, 'Esfihas 1000px x 667px.png', 1, 0),
('Bauru', 'Pão macio recheado com presunto fatiado, queijo derretido, tomate fresco e orégano, servido quentinho.', 7.00, 15, 'Salgados', 54, 'Bauru Calabresa 1000px x 667px.png', 1, 0),
('Croissant de calabresa', 'Massa folhada leve e crocante, recheada com linguiça calabresa fatiada e queijo derretido, assada até ficar dourada.', 7.00, 12, 'Folhados', 58, '1000px x 667px - Croassaint.png', 1, 0),
('Croissant de frango', 'Massa folhada leve e dourada, recheada com frango desfiado temperado e queijo cremoso.', 7.00, 12, 'Folhados', 59, '1000px x 667px - Croassaint.png', 0, 0),
('Coxinha de frango', 'Massa macia e dourada, recheada com frango desfiado temperado e cremosa por dentro.', 7.00, 15, 'Salgados', 63, 'Coxinha 1000px  x 677px.png', 0, 0),
('Pão de queijo', 'Tradicional mineiro, crocante por fora e macio por dentro, feito com queijo e polvilho.', 6.00, 25, 'Salgados', 64, 'Pão de Queijo 1000px x 667px.png', 0, 0),
('Hamburguer Cheddar Bacon', 'Pão macio recheado com hambúrguer suculento, cheddar cremoso e pedaços saborosos de bacon.', 7.00, 22, 'Salgados', 65, 'Hamburguer Cheddar.bacon 1000px x 667px.png', 0, 0),
('Brigadeiro', 'Doce de chocolate cremoso, enrolado e coberto com granulado.', 3.00, 35, 'Doces', 71, 'Brigadeiro de rolo.png', 1, 0),
('Mousse de Limão', 'Sobremesa leve e cremosa com sabor refrescante de limão.', 3.00, 32, 'Doces', 72, 'Doce de limão.png', 1, 0),
('Doce de Morango', 'Sobremesa suave com pedaços de morango fresco e sabor delicado.', 5.00, 20, 'Doces', 73, 'Doce de Morango.png', 1, 0),
('Brigadeiro de pote', 'Doce de chocolate cremoso e indulgente, servido em potinho para saborear no pote.', 3.50, 25, 'Doces', 74, 'Brigadeiro de pote.png', 0, 0),
('Sorvete açaí 300g', 'Cremoso e energético, feito com polpa pura de açaí amazônico.', 7.00, 20, 'Doces', 76, 'Açai.png', 1, 0),
('Coca-Cola 350ml', 'Refrigerante gelado, refrescante e clássico.', 4.00, 35, 'Bebidas', 77, 'CocaCola.png', 1, 0),
('Frango Adollyzado', 'Pizza Frango Catupiry + Dolly 2 Litros', 40.00, 15, 'Outros', 80, 'Pizza FC & Dolly 1000px x 677px.png', 0, 0),
('Dolly Acalabresado', 'Pizza de Calabresa + Dolly 2 Litros', 22.00, 13, 'Outros', 81, 'Pizza C & Dolly 1000px x 677px.png', 0, 0),
('Mousse de Maracujá', 'Deliciosa mousse com o toque tropical e azedinho do maracujá.', 5.00, 25, 'Doces', 82, 'Mousse de Maracujá.png', 0, 0),
('Esfiha de Chocolate', 'Massa macia e levemente dourada, recheada com delicioso chocolate cremoso.', 7.00, 30, 'Doces', 83, 'Esfiha de Chocolate 1000px x 667px.png', 0, 0),
('X-Salada', 'Hambúrguer suculento com queijo, alface, tomate, milho, batata palha e maionese no pão macio.', 12.00, 15, 'Salgados', 84, 'X-Salada 1000px x 677px.png', 0, 0),
('X-Egg', 'Hambúrguer saboroso com queijo, ovo, alface, tomate, milho e maionese.', 12.00, 15, 'Salgados', 85, 'X-Egg 1000px x 677px.png', 0, 0),
(' Pizza de Calabresa', ' Tradicional pizza com rodelas de calabresa, cebola fatiada e um toque de orégano.', 35.00, 10, 'Salgados', 86, 'Pizza C 1000px x 677px.png', 0, 0),
('Pizza Frango Catupiry', 'Massa leve coberta com frango desfiado, Catupiry cremoso e temperos especiais.', 35.00, 10, 'Salgados', 87, 'Pizza FC 1000px x 677px.png', 0, 0),
('Halls Cereja', 'Bala refrescante com sabor marcante de cereja e sensação gelada prolongada.', 5.00, 30, 'Salgados', 88, 'Halls 1000px x 677px.png', 0, 0),
('Trident Menta', 'Chiclete com sabor intenso de menta, que garante hálito fresco por mais tempo.', 4.00, 30, 'Doces', 89, 'Trident 1000px x 677px.png', 0, 0),
('Água', 'Natural e refrescante, ideal para acompanhar qualquer refeição.', 4.00, 30, 'Bebidas', 90, 'Agua.png', 0, 0),
('Del Valle Maracujá 290ml', 'Suco tropical com o sabor marcante e azedinho do maracujá.', 6.00, 20, 'Bebidas', 91, 'DelvalleMaracuja.png', 0, 0),
('Del Valle Manga 290ml', 'Suco cremoso e doce, feito com polpa de manga.', 6.00, 20, 'Bebidas', 92, 'DelvalleManga.png', 0, 0),
('Del Valle Pêssego 290ml', 'Refrescante e suave, com o sabor natural do pêssego.', 6.00, 20, 'Bebidas', 93, 'DelVallePessego.png', 0, 0),
('Del Valle Uva 290ml', 'Sabor rico e frutado de uva madura.', 6.00, 20, 'Bebidas', 94, 'DelValleUva.png', 0, 0),
('Dolly Guaraná 600ml', 'Refrigerante brasileiro com sabor autêntico de guaraná.', 6.00, 20, 'Bebidas', 95, 'DoliGuarana.png', 0, 0),
('Itubaína 300ml', 'Refrigerante tradicional com sabor levemente adocicado e nostálgico.', 7.00, 20, 'Bebidas', 96, 'ItubainaOriginal.png', 0, 0),
('Sukita de Laranja', 'Clássico refrigerante de laranja, doce e muito refrescante.', 6.00, 20, 'Bebidas', 97, 'SukitaLaranja.png', 0, 0);

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
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
