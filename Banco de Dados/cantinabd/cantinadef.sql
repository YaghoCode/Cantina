-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2025 às 02:30
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
('MIguel Admin', '35678941110', 'MiguelAltoe@gmail.com', 0, '$2y$10$505oU7iBbUwkqvyV4lOt2em3W/W1Gt/LOOzbn8TDAUs3rCFgoAZ0y', 1),
('Davi Admin', '45245267810', 'davi@gmail.com', 0, '$2y$10$foVPwTp2Pxjva6RMf.nN1.9Z9zhUJGqh0DI.myKmTJdTVj5hXa4c2', 1),
('Nicolas', '45878545845', 'Nicolas@gmail.com', 0, '$2y$10$YVnGmak2rs4zoBlL/kzsuu.f1k53CFUyZ55snnWDVfVzdZ7miZ3Ha', 0),
('Caio Admin', '77777777777', 'caiopica@gmail.com', 11, '$2y$10$f.SpVyR30gawIMTwS/Cm3.ZWnn5JlglAvJ82dvtBi5Qsi9TyuZlIK', 1),
('Yagho Admin', '99999999999', 'yaghochinaglia@gmail.com', 11, '$2y$10$f.SpVyR30gawIMTwS/Cm3.ZWnn5JlglAvJ82dvtBi5Qsi9TyuZlIK', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `nome` varchar(60) NOT NULL,
  `cpf` char(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `turma` enum('1DS','2DS','3DS','1ADM','2ADM','3ADM','1JD','2JD','3JD','1RH','2RH','3RH','') NOT NULL,
  `senha` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`nome`, `cpf`, `email`, `turma`, `senha`, `status`) VALUES
('Val', '05978214433', 'ValacVal@gmail.com', '3DS', '$2y$10$rAhBl59./FJ.2O/k59PGp.3bMirSis9I7ZFMiplCNvO7ufrTHwbJW', 0),
('Davi Virgilino Freitas', '12345678940', 'davifreitas@gmail.com', '3DS', '$2y$10$pzHdSevPdleLT3RB1Syu7e7M/C0W3QQBSzBvlMUKd8tOYEZ2mTlIq', 1),
('Renato Estevam Garcia', '15894372019', 'RenatoEstevam@gmail.com', '3DS', '$2y$10$JfByZ11IoHGfFhsv3USCGePLylm36tU9Lj38zMEaQoPE3iOIn8Bp.', 0),
('Gustavo Samuel Bidinoti', '19654087342', 'GustavoSamuel@gmail.com', '3DS', '$2y$10$FUE.eFzox474jLts0BBpfO6riy4x5pK2gDXgpxHorpmJY0LCtx5GO', 0),
('Miguel Rodrigues Altoe', '31045896274', 'MiguelAltoe@gmail.com', '3DS', '$2y$10$p6/MxLCOs4rJx3rZEYyoOu5cXHnofgPeblAKKDDOAYBfc1RRVssS2', 0),
('Caio Picciarelli Silva', '40287159360', 'CaioPicciarelli@gmail.com', '3DS', '$2y$10$YAt0cqFwnFa46MhjV/0e/O7e5RN6bS4MftLNiFL3rg/ZU4.3MyE/G', 0),
('Nilson Cardoso Neto', '42891530627', 'NilsonCardoso@gmail.com', '3DS', '$2y$10$p7vMgvDJx2XvRgifDAVpX.sG4KDDk70qf2zfog/DcaQOieHExkxTy', 0),
('Yagho Chinaglia', '44444444442', 'yaghochinaglia@gmail.com', '2DS', '$2y$10$CSXOfcR/FgNDyNWe1zl2P.LVAl217eSe/XFHD338c1NTAtkEN9SkS', 0),
('João Pedro Arruda Paixão', '58021964705', 'JoaoPaixao@gmail.com', '3DS', '$2y$10$vWPmIru9so.0Cb8Kge3Abu5hxe5ZEieumSol2PYw1WNKiUDOSFE0W', 0),
('Pedro Henrique Cerqueira PH', '67350182946', 'PH@gmail.com', '3DS', '$2y$10$0Svbub77/2aYGBpFlVBSJe1.GJW02qV1solByoF2AC9lsWrhcRX7u', 0),
('Daniel Nóbrega Branco', '73198420591', 'DanielNobrega@gmail.com', '3DS', '$2y$10$NB2ub8ZgTgRzHnZ40dhEt.Wcdh3pv4ojcMhXVsQ96qB99tuKysDlO', 0),
('Juan Dias de Lima Delgado', '84731659028', 'JuanDias@gmail.com', '3DS', '$2y$10$yJ.THrDE5oWxSrhx3On6sOCNSbHcC9Q313IWpHBkMTJ9Gfe91OLnK', 0),
('Nicolas Silva Oliveira', '92476031850', 'NicolasSilva@gmail.com', '3DS', '$2y$10$zM95IGNWP95HMp84ZkMRcOLrgOrlozQq3BBRL7ozyt8yG0aRKAS8K', 0);

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
('Esfiha de Carne', 'A clássica que sempre entrega: massa macia envolvendo um recheio de carne suculento, temperado na medida certa e com aquele aroma que lembra comida caseira de verdade. Uma mordida e já bate o conforto.\r\n\r\nIngredientes: massa de farinha de trigo, carne moída, cebola, tomate, alho, sal, pimenta-do-reino, cominho, páprica doce.', 7.00, 15, 'Salgados', 53, 'Esfihas 1000px x 667px.png', 1, 1),
('Bauru', 'O sanduba tradicional que sempre salva: presunto fresquinho, queijo derretendo lindamente, tomate que dá o toque de leveza e um pão fofinho que segura tudo sem perder a classe. Um clássico que vive no coração do povo.\r\n\r\nIngredientes: Baguete, presunto, queijo, tomate.', 7.00, 15, 'Salgados', 54, 'Bauru Calabresa 1000px x 667px.png', 1, 0),
('Croissant de calabresa', 'Massa folhada crocante se encontrando com a intensidade da calabresa bem refogada. É sabor marcante, cheiro bom e personalidade em cada mordida.\r\n\r\nIngredientes: massa folhada, calabresa moída ou picada, cebola, alho, páprica defumada, pimenta-do-reino.', 7.00, 12, 'Folhados', 58, '1000px x 667px - Croassaint.png', 1, 0),
('Croissant de frango', 'Folhado douradinho por fora e macio por dentro, recheado com frango cremoso e bem temperado, criando aquele contraste gostoso de textura e sabor. Um salgado que chega suave, mas conquista.\r\n\r\nIngredientes: massa folhada, frango desfiado, cebola, alho, sal, páprica doce, pimenta-do-reino, creme de leite.', 7.00, 12, 'Folhados', 59, '1000px x 667px - Croassaint.png', 1, 0),
('Coxinha de frango', 'A rainha dos salgados: massa douradinha com aquela casquinha crocante perfeita, recheada com frango desfiado cremoso que derrete no paladar. Uma mordida e você entende por que ela é unanimidade.\r\n\r\nIngredientes: massa de farinha de trigo, frango desfiado, cebola, alho, sal, pimenta-do-reino, requeijão cremoso, farinha de rosca, óleo para fritura.', 7.00, 15, 'Salgados', 63, 'Coxinha 1000px  x 677px.png', 1, 0),
('Pão de queijo', 'Macio por dentro, leve por fora e com o sabor marcante do queijo que perfuma tudo antes mesmo da primeira mordida. É aquele clássico mineiro que não falha nunca.\r\n\r\nIngredientes: polvilho azedo, queijo minas meia cura, leite, óleo, ovos, sal.', 6.00, 25, 'Salgados', 64, 'Pão de Queijo 1000px x 667px.png', 0, 1),
('Hamburgão Cheddar Bacon', 'Um sanduíche pra quem não brinca com sabor: hamburgão suculento, cheddar cremoso envolvendo tudo e fatias crocantes de bacon que dão o toque final. É o combo perfeito entre potência e conforto.\r\n\r\nIngredientes: pão tipo brioche, hambúrguer bovino, queijo cheddar processado, bacon em fatias, cebola crispy.', 7.00, 22, 'Salgados', 65, 'Hamburguer Cheddar.bacon 1000px x 667px.png', 0, 0),
('Brigadeiro', 'O docinho que abraça a alma: textura cremosa, brilho de festa e o sabor marcante do chocolate que conquista qualquer um. Simples, direto ao ponto e delicioso.\r\n\r\nIngredientes: leite condensado, chocolate em pó, manteiga, granulado de chocolate.', 3.00, 35, 'Doces', 71, 'Brigadeiro de rolo.png', 1, 0),
('Mousse de Limão', 'Uma sobremesa leve, refrescante e cremosa, com aquele azedinho gostoso que desperta o paladar e deixa tudo mais suave. É a colherada perfeita pra fechar o dia com frescor.\r\n\r\nIngredientes: leite condensado, creme de leite, suco de limão, raspas de limão.', 3.00, 32, 'Doces', 72, 'Doce de limão.png', 1, 0),
('Doce de Morango', 'Um docinho delicado e cheio de sabor, combinando a doçura cremosa com o toque frutado do morango. Aquele clássico que perfuma, encanta e some rápido do pote.\r\n\r\nIngredientes: morangos frescos, açúcar, leite condensado, creme de leite.', 5.00, 20, 'Doces', 73, 'Doce de Morango.png', 1, 0),
('Brigadeiro de pote', 'Cremoso, macio e viciante: o brigadeiro em sua forma mais pura, feito pra comer de colher sem culpa e sem moderação. É chocolate em modo conforto máximo.\r\n\r\nIngredientes: leite condensado, creme de leite, chocolate em pó, manteiga, granulado de chocolate.', 3.50, 25, 'Doces', 74, 'Brigadeiro de pote.png', 0, 0),
('Sorvete açaí 300g', 'Gelado, encorpado e com aquele sabor intenso que só o açaí verdadeiro entrega. Perfeito pra refrescar, dar energia e matar a vontade de algo doce de um jeito único.\r\n\r\nIngredientes: polpa de açaí congelada, xarope de guaraná.', 7.00, 20, 'Doces', 76, 'Açai.png', 1, 0),
('Coca-Cola 350ml', 'Clássica, geladinha e com aquele sabor inconfundível que já chega refrescando antes mesmo do primeiro gole. É o combo perfeito entre doçura, gás e nostalgia.\r\n\r\nInformação nutricional (por 350 ml):\r\n\r\nValor energético: 154 kcal \r\nCarboidratos: 37 g \r\nAçúcares: 37 g \r\nSódio: 18 mg ', 4.00, 35, 'Bebidas', 77, 'CocaCola.png', 1, 1),
('Frango Adollyzado', 'Pizza Frango Catupiry + Dolly 2 Litros\r\n\r\nUm combo que entrega cremosidade e refrescância sem esforço: a pizza de frango com catupiry chega leve, macia e super cremosa, com frango desfiado bem distribuído e o catupiry dando aquele toque inconfundível. Pra acompanhar, um Dolly de 2 litros que equilibra tudo com o sabor doce e gelado do guaraná. É o combo perfeito pra dividir… ou pra não dividir também', 40.00, 15, 'Outros', 80, 'Pizza FC & Dolly 1000px x 677px.png', 1, 0),
('Dolly Acalabresado', 'Pizza de Calabresa + Dolly 2 Litros\r\n\r\nClássico com clássico: a pizza de calabresa traz a combinação marcante de calabresa fatiada, cebola e mussarela derretida, tudo sobre uma massa assada no ponto certo. O Dolly de 2 litros chega garantindo a refrescância, fechando o combo com um toque doce e geladinho. Simples, direto e irresistível.\r\n', 22.00, 13, 'Outros', 81, 'Pizza C & Dolly 1000px x 677px.png', 1, 0),
('Mousse de Maracujá', 'Uma sobremesa leve, cremosa e refrescante, com aquele azedinho icônico do maracujá que desperta o paladar na primeira colherada. Doce na medida certa e perfeita pra fechar qualquer refeição com frescor.\r\n\r\nIngredientes: leite condensado, creme de leite, suco de maracujá, raspas de maracujá.', 5.00, 25, 'Doces', 82, 'Mousse de Maracujá.png', 0, 0),
('Esfiha de Chocolate com M&Ms', 'A combinação que faz a alegria de qualquer um: massa macia assada recheada com chocolate derretido, finalizada com M&Ms que trazem cor, crocância e aquele saborzinho viciante. É pura felicidade em formato de esfiha.\r\n\r\nIngredientes: massa de farinha de trigo, chocolate ao leite, M&Ms.', 7.00, 30, 'Doces', 83, 'Esfiha de Chocolate 1000px x 667px.png', 0, 0),
('X-Salada', 'Um clássico que nunca falha: hambúrguer suculento, queijo derretido, alface fresquinha, tomate cortado na hora e maionese cremosa, tudo dentro de um pão macio que abraça bem cada camada. Simples, direto e delicioso.\r\n\r\nIngredientes: pão de hambúrguer, hambúrguer bovino, queijo mussarela, alface, tomate, maionese.', 12.00, 15, 'Salgados', 84, 'X-Salada 1000px x 677px.png', 0, 0),
('X-Egg', 'O X-Salada com um upgrade de respeito: hambúrguer suculento, queijo derretendo, verduras fresquinhas e um ovo bem feito que dá aquele sabor a mais e uma cremosidade irresistível. É reforçado e cheio de personalidade.\r\n\r\nIngredientes: pão de hambúrguer, hambúrguer bovino, queijo mussarela, alface, tomate, maionese, ovo.', 12.00, 15, 'Salgados', 85, 'X-Egg 1000px x 677px.png', 0, 0),
(' Pizza de Calabresa', 'Sabor tradicional que conquista qualquer mesa: massa assada no ponto perfeito, molho de tomate bem distribuído, generosas fatias de calabresa e cebola que perfuma tudo. Um clássico que nunca decepciona.\r\n\r\nIngredientes: massa de pizza, molho de tomate, calabresa fatiada, cebola, orégano.', 35.00, 10, 'Outros', 86, 'Pizza C 1000px x 677px.png', 0, 0),
('Pizza Frango Catupiry', 'Cremosa e irresistível: massa leve, queijo derretido, frango desfiado bem distribuído e aquele catupiry autêntico que traz a cremosidade que todo mundo ama. Uma pizza que abraça a alma.\r\n\r\nIngredientes: massa de pizza, molho de tomate, frango desfiado, queijo mussarela, catupiry, orégano.', 35.00, 10, 'Outros', 87, 'Pizza FC 1000px x 677px.png', 0, 0),
('Halls Cereja', 'Bala refrescante com sabor marcante de cereja e sensação gelada prolongada.', 5.00, 30, 'Doces', 88, 'Halls 1000px x 677px.png', 0, 0),
('Trident Menta', 'Chiclete com sabor intenso de menta, que garante hálito fresco por mais tempo.', 4.00, 30, 'Doces', 89, 'Trident 1000px x 677px.png', 0, 0),
('Água', 'Pura, leve e essencial — a opção que combina com tudo e sempre salva quando o calor aperta.', 4.00, 30, 'Bebidas', 90, 'Agua.png', 0, 0),
('Del Valle Maracujá 290ml', 'Refrescante e com o azedinho característico do maracujá, é a bebida que dá aquela acalmada gostosa e combina com qualquer salgado.\r\n\r\nInformação nutricional (por 290 ml):\r\n\r\nValor energético: 120 kcal \r\nCarboidratos: 29 g \r\nAçúcares: 29 g \r\nSódio: 11 mg ', 6.00, 20, 'Bebidas', 91, 'DelvalleMaracuja.png', 1, 0),
('Del Valle Manga 290ml', 'Cremoso, doce na medida e com cara de tarde de verão. Um gole e a sensação é de fruta madura direto do pé.\r\n\r\nInformação nutricional (por 290 ml):\r\n\r\nValor energético: 120 kcal \r\nCarboidratos: 29 g \r\nAçúcares: 29 g \r\nSódio: 11 mg ', 6.00, 20, 'Bebidas', 92, 'DelvalleManga.png', 0, 0),
('Del Valle Pêssego 290ml', 'Leve, suave e super aromático. Aquele saborzinho que desce macio e agrada geral.\r\n\r\nInformação nutricional (por 290 ml):\r\n\r\nValor energético: 120 kcal \r\nCarboidratos: 29 g \r\nAçúcares: 29 g \r\nSódio: 11 mg ', 6.00, 20, 'Bebidas', 93, 'DelVallePessego.png', 0, 0),
('Del Valle Uva 290ml', 'Sabor marcante, frutado e cheio de personalidade. É o tipo de suco que você sente o cheiro e já reconhece.\r\n\r\nInformação nutricional (por 290 ml):\r\n\r\nValor energético: 120 kcal \r\nCarboidratos: 29 g \r\nAçúcares: 29 g \r\nSódio: 11 mg \r\n\r\n', 6.00, 20, 'Bebidas', 94, 'DelValleUva.png', 0, 0),
('Dolly Guaraná 600ml', 'Dolly Docinho, vibrante e com aquele gostinho tradicional de guaraná que todo mundo conhece. Um gole e já dá vontade de outro.', 6.00, 20, 'Bebidas', 95, 'DoliGuarana.png', 0, 0),
('Itubaína 300ml', 'O refrigerante raiz: aroma único, sabor nostálgico e aquele clima de “isso aqui tem história”. Perfeito pra quem curte algo diferente dos sabores comuns.', 7.00, 20, 'Bebidas', 96, 'ItubainaOriginal.png', 1, 0),
('Sukita de Laranja', 'Refri com aquela pegada cítrica, doce e super aromática, trazendo o gostinho clássico de laranja que refresca na hora. É leve, vibrante e perfeito pra acompanhar qualquer lanche sem erro.', 6.00, 20, 'Bebidas', 97, 'SukitaLaranja.png', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `cpf` char(11) NOT NULL,
  `nome_itens` text NOT NULL,
  `quantidade_itens` text NOT NULL,
  `preco_itens` text NOT NULL,
  `preco_total` decimal(10,2) NOT NULL,
  `status` enum('Sendo Preparado','Concluído','Cancelado') NOT NULL DEFAULT 'Sendo Preparado',
  `data_pedido` date NOT NULL DEFAULT curdate(),
  `hora_pedido` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id`, `cpf`, `nome_itens`, `quantidade_itens`, `preco_itens`, `preco_total`, `status`, `data_pedido`, `hora_pedido`) VALUES
(21, '12345678940', 'Pão de queijo, X-Egg, Coca-Cola 350ml', '1x, 2x, 1x', 'R$6,00, R$24,00, R$4,00', 34.00, 'Sendo Preparado', '2025-11-23', '10:44:56'),
(22, '12345678940', 'Esfiha de Carne, Sorvete açaí 300g, Halls Cereja', '2x, 1x, 1x', 'R$14,00, R$7,00, R$5,00', 26.00, 'Concluído', '2025-11-23', '10:45:33'),
(23, '12345678940', 'Dolly Guaraná 600ml, Pizza Frango Catupiry', '1x, 1x', 'R$6,00, R$35,00', 41.00, 'Concluído', '2025-11-23', '10:45:54'),
(24, '12345678940', 'Água, Del Valle Maracujá 290ml', '2x, 1x', 'R$8,00, R$6,00', 14.00, 'Concluído', '2025-11-23', '10:46:19'),
(25, '12345678940', 'Mousse de Limão, Brigadeiro', '1x, 3x', 'R$3,00, R$9,00', 12.00, 'Cancelado', '2025-11-23', '10:46:36'),
(26, '12345678940', 'Hamburgão Cheddar Bacon, Mousse de Limão, Sorvete açaí 300g', '3x, 1x, 1x', 'R$21,00, R$3,00, R$7,00', 31.00, 'Cancelado', '2025-11-23', '10:48:33'),
(27, '12345678940', 'Hamburgão Cheddar Bacon, Mousse de Limão, Sorvete açaí 300g, Pão de queijo, X-Egg, X-Salada, Coxinha de frango, Bauru, Esfiha de Carne, Brigadeiro, Croissant de frango, Croissant de calabresa, Doce de Morango, Mousse de Maracujá, Brigadeiro de pote,', '4x, 2x, 2x, 8x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x', 'R$28,00, R$6,00, R$14,00, R$48,00, R$12,00, R$12,00, R$7,00, R$7,00, R$7,00, R$3,00, R$7,00, R$7,00, R$5,00, R$5,00, R$3,50, R$5,00, R$7,00, R$4,00, R$6,00, R$4,00, R$4,00, R$6,00, R$6,00, R$6,00, R$6,00, R$7,00, R$6,00, R$35,00, R$22,00, R$40,00, R$35,00', 370.50, 'Sendo Preparado', '2025-11-23', '10:49:57'),
(28, '12345678940', 'Hamburgão Cheddar Bacon, Mousse de Limão, Sorvete açaí 300g, Pão de queijo, X-Egg, X-Salada, Coxinha de frango, Bauru, Esfiha de Carne, Brigadeiro, Croissant de frango, Croissant de calabresa, Doce de Morango, Mousse de Maracujá, Brigadeiro de pote,', '4x, 2x, 2x, 8x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x, 1x', 'R$28,00, R$6,00, R$14,00, R$48,00, R$12,00, R$12,00, R$7,00, R$7,00, R$7,00, R$3,00, R$7,00, R$7,00, R$5,00, R$5,00, R$3,50, R$5,00, R$7,00, R$4,00, R$6,00, R$4,00, R$4,00, R$6,00, R$6,00, R$6,00, R$6,00, R$7,00, R$6,00, R$35,00, R$22,00, R$40,00, R$35,00', 370.50, 'Cancelado', '2025-11-23', '19:12:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_itens`
--

CREATE TABLE `pedido_itens` (
  `id` int(10) UNSIGNED NOT NULL,
  `pedido_id` int(10) UNSIGNED NOT NULL,
  `nome_item` varchar(255) NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL,
  `preco_item` decimal(10,2) NOT NULL,
  `data_pedido` date NOT NULL DEFAULT curdate(),
  `hora_pedido` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido_itens`
--

INSERT INTO `pedido_itens` (`id`, `pedido_id`, `nome_item`, `quantidade`, `preco_item`, `data_pedido`, `hora_pedido`) VALUES
(25, 21, 'Pão de queijo', 1, 6.00, '2025-11-23', '14:44:56'),
(26, 21, 'X-Egg', 2, 24.00, '2025-11-23', '14:44:56'),
(27, 21, 'Coca-Cola 350ml', 1, 4.00, '2025-11-23', '14:44:56'),
(28, 22, 'Esfiha de Carne', 2, 14.00, '2025-11-23', '14:45:33'),
(29, 22, 'Sorvete açaí 300g', 1, 7.00, '2025-11-23', '14:45:33'),
(30, 22, 'Halls Cereja', 1, 5.00, '2025-11-23', '14:45:33'),
(31, 23, 'Dolly Guaraná 600ml', 1, 6.00, '2025-11-23', '14:45:54'),
(32, 23, 'Pizza Frango Catupiry', 1, 35.00, '2025-11-23', '14:45:54'),
(33, 24, 'Água', 2, 8.00, '2025-11-23', '14:46:19'),
(34, 24, 'Del Valle Maracujá 290ml', 1, 6.00, '2025-11-23', '14:46:19'),
(35, 25, 'Mousse de Limão', 1, 3.00, '2025-11-23', '14:46:36'),
(36, 25, 'Brigadeiro', 3, 9.00, '2025-11-23', '14:46:36'),
(37, 26, 'Hamburgão Cheddar Bacon', 3, 21.00, '2025-11-23', '14:48:33'),
(38, 26, 'Mousse de Limão', 1, 3.00, '2025-11-23', '14:48:33'),
(39, 26, 'Sorvete açaí 300g', 1, 7.00, '2025-11-23', '14:48:33'),
(40, 27, 'Hamburgão Cheddar Bacon', 4, 28.00, '2025-11-23', '14:49:57'),
(41, 27, 'Mousse de Limão', 2, 6.00, '2025-11-23', '14:49:57'),
(42, 27, 'Sorvete açaí 300g', 2, 14.00, '2025-11-23', '14:49:57'),
(43, 27, 'Pão de queijo', 8, 48.00, '2025-11-23', '14:49:57'),
(44, 27, 'X-Egg', 1, 12.00, '2025-11-23', '14:49:57'),
(45, 27, 'X-Salada', 1, 12.00, '2025-11-23', '14:49:57'),
(46, 27, 'Coxinha de frango', 1, 7.00, '2025-11-23', '14:49:57'),
(47, 27, 'Bauru', 1, 7.00, '2025-11-23', '14:49:57'),
(48, 27, 'Esfiha de Carne', 1, 7.00, '2025-11-23', '14:49:57'),
(49, 27, 'Brigadeiro', 1, 3.00, '2025-11-23', '14:49:57'),
(50, 27, 'Croissant de frango', 1, 7.00, '2025-11-23', '14:49:57'),
(51, 27, 'Croissant de calabresa', 1, 7.00, '2025-11-23', '14:49:57'),
(52, 27, 'Doce de Morango', 1, 5.00, '2025-11-23', '14:49:57'),
(53, 27, 'Mousse de Maracujá', 1, 5.00, '2025-11-23', '14:49:57'),
(54, 27, 'Brigadeiro de pote', 1, 3.50, '2025-11-23', '14:49:57'),
(55, 27, 'Halls Cereja', 1, 5.00, '2025-11-23', '14:49:57'),
(56, 27, 'Esfiha de Chocolate com M&Ms', 1, 7.00, '2025-11-23', '14:49:57'),
(57, 27, 'Trident Menta', 1, 4.00, '2025-11-23', '14:49:57'),
(58, 27, 'Del Valle Maracujá 290ml', 1, 6.00, '2025-11-23', '14:49:57'),
(59, 27, 'Água', 1, 4.00, '2025-11-23', '14:49:57'),
(60, 27, 'Coca-Cola 350ml', 1, 4.00, '2025-11-23', '14:49:57'),
(61, 27, 'Del Valle Manga 290ml', 1, 6.00, '2025-11-23', '14:49:57'),
(62, 27, 'Del Valle Pêssego 290ml', 1, 6.00, '2025-11-23', '14:49:57'),
(63, 27, 'Del Valle Uva 290ml', 1, 6.00, '2025-11-23', '14:49:57'),
(64, 27, 'Sukita de Laranja', 1, 6.00, '2025-11-23', '14:49:57'),
(65, 27, 'Itubaína 300ml', 1, 7.00, '2025-11-23', '14:49:57'),
(66, 27, 'Dolly Guaraná 600ml', 1, 6.00, '2025-11-23', '14:49:57'),
(67, 27, 'Pizza de Calabresa', 1, 35.00, '2025-11-23', '14:49:57'),
(68, 27, 'Dolly Acalabresado', 1, 22.00, '2025-11-23', '14:49:57'),
(69, 27, 'Frango Adollyzado', 1, 40.00, '2025-11-23', '14:49:57'),
(70, 27, 'Pizza Frango Catupiry', 1, 35.00, '2025-11-23', '14:49:57'),
(71, 28, 'Hamburgão Cheddar Bacon', 4, 28.00, '2025-11-23', '23:12:09'),
(72, 28, 'Mousse de Limão', 2, 6.00, '2025-11-23', '23:12:09'),
(73, 28, 'Sorvete açaí 300g', 2, 14.00, '2025-11-23', '23:12:09'),
(74, 28, 'Pão de queijo', 8, 48.00, '2025-11-23', '23:12:09'),
(75, 28, 'X-Egg', 1, 12.00, '2025-11-23', '23:12:09'),
(76, 28, 'X-Salada', 1, 12.00, '2025-11-23', '23:12:09'),
(77, 28, 'Coxinha de frango', 1, 7.00, '2025-11-23', '23:12:09'),
(78, 28, 'Bauru', 1, 7.00, '2025-11-23', '23:12:09'),
(79, 28, 'Esfiha de Carne', 1, 7.00, '2025-11-23', '23:12:09'),
(80, 28, 'Brigadeiro', 1, 3.00, '2025-11-23', '23:12:09'),
(81, 28, 'Croissant de frango', 1, 7.00, '2025-11-23', '23:12:09'),
(82, 28, 'Croissant de calabresa', 1, 7.00, '2025-11-23', '23:12:09'),
(83, 28, 'Doce de Morango', 1, 5.00, '2025-11-23', '23:12:09'),
(84, 28, 'Mousse de Maracujá', 1, 5.00, '2025-11-23', '23:12:09'),
(85, 28, 'Brigadeiro de pote', 1, 3.50, '2025-11-23', '23:12:09'),
(86, 28, 'Halls Cereja', 1, 5.00, '2025-11-23', '23:12:09'),
(87, 28, 'Esfiha de Chocolate com M&Ms', 1, 7.00, '2025-11-23', '23:12:09'),
(88, 28, 'Trident Menta', 1, 4.00, '2025-11-23', '23:12:09'),
(89, 28, 'Del Valle Maracujá 290ml', 1, 6.00, '2025-11-23', '23:12:09'),
(90, 28, 'Água', 1, 4.00, '2025-11-23', '23:12:09'),
(91, 28, 'Coca-Cola 350ml', 1, 4.00, '2025-11-23', '23:12:09'),
(92, 28, 'Del Valle Manga 290ml', 1, 6.00, '2025-11-23', '23:12:09'),
(93, 28, 'Del Valle Pêssego 290ml', 1, 6.00, '2025-11-23', '23:12:09'),
(94, 28, 'Del Valle Uva 290ml', 1, 6.00, '2025-11-23', '23:12:09'),
(95, 28, 'Sukita de Laranja', 1, 6.00, '2025-11-23', '23:12:09'),
(96, 28, 'Itubaína 300ml', 1, 7.00, '2025-11-23', '23:12:09'),
(97, 28, 'Dolly Guaraná 600ml', 1, 6.00, '2025-11-23', '23:12:09'),
(98, 28, 'Pizza de Calabresa', 1, 35.00, '2025-11-23', '23:12:09'),
(99, 28, 'Dolly Acalabresado', 1, 22.00, '2025-11-23', '23:12:09'),
(100, 28, 'Frango Adollyzado', 1, 40.00, '2025-11-23', '23:12:09'),
(101, 28, 'Pizza Frango Catupiry', 1, 35.00, '2025-11-23', '23:12:09');

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
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `fk_pedidoitens_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
