-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 08-Nov-2022 às 16:03
-- Versão do servidor: 10.5.16-MariaDB
-- versão do PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id19519721_brazza`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bebidas`
--

CREATE TABLE `bebidas` (
  `idBebidas` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Preco` decimal(10,2) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bebidas`
--

INSERT INTO `bebidas` (`idBebidas`, `Nome`, `Preco`, `ativo`) VALUES
(1, 'Refrigerante Lata (350ml)', 4.00, 1),
(2, 'Refrigerante Lata (220ml)', 3.00, 1),
(3, 'Refrigerante pet taça de Cristal (250ml)', 3.00, 1),
(4, 'Refrigerante Coca Cola (200ml)', 3.00, 1),
(5, 'Refrigerante pet Guaraná Antártica (200ml)', 3.00, 1),
(6, 'Refrigerante pet refripet (2l)', 6.00, 1),
(7, 'Refrigerante Coca Cola (2l)', 12.00, 1),
(8, 'Suco Daflora (500ml)', 4.00, 1),
(9, 'Água (500ml)', 2.00, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `combo`
--

CREATE TABLE `combo` (
  `idCombo` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Especialidades` varchar(450) DEFAULT NULL,
  `Preco` decimal(10,2) NOT NULL,
  `Imagem` varchar(450) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `combo`
--

INSERT INTO `combo` (`idCombo`, `Nome`, `Especialidades`, `Preco`, `Imagem`, `ativo`) VALUES
(1, 'Combo Kids', 'Acompanha Brinde', 20.00, 'd63f84f766f2daa108eb1eb2515a102d.jpg', 1),
(2, 'Combo Black', 'Acompanha Porção de Fritas', 20.00, 'bfd88cb2e72e1276582fe48a51d8da1e.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `combo_com_bebida`
--

CREATE TABLE `combo_com_bebida` (
  `idCombo` int(11) NOT NULL,
  `idBebidas` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `combo_com_bebida`
--

INSERT INTO `combo_com_bebida` (`idCombo`, `idBebidas`, `Quantidade`) VALUES
(1, 3, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `combo_com_lanche`
--

CREATE TABLE `combo_com_lanche` (
  `idCombo` int(11) NOT NULL,
  `idLanches` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `combo_com_lanche`
--

INSERT INTO `combo_com_lanche` (`idCombo`, `idLanches`, `Quantidade`) VALUES
(1, 3, 1),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `complemento`
--

CREATE TABLE `complemento` (
  `idComplemento` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Preco` decimal(10,2) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `complemento`
--

INSERT INTO `complemento` (`idComplemento`, `Nome`, `Preco`, `ativo`) VALUES
(1, 'Pão com gergelim', 4.00, 0),
(2, 'Pão de Hambúrguer', 3.00, 0),
(3, 'Hambúrguer 160g', 8.00, 1),
(4, 'Hambúrguer 120g', 7.00, 1),
(5, 'Filé de frango', 4.00, 1),
(6, 'Queijo Prato', 3.00, 1),
(7, 'Queijo Cheddar', 3.00, 1),
(8, 'Queijo Mussarela', 3.00, 1),
(9, 'Cream Cheese', 3.00, 1),
(10, 'Maionese da casa', 3.00, 1),
(11, 'Molho Tasty', 3.00, 1),
(12, 'Pasta de Bacon e Catupiry zero lactose', 4.00, 1),
(13, 'Cebola Caramelizada', 1.00, 1),
(14, 'Cebola Roxa', 1.00, 1),
(15, 'Ovo', 2.00, 1),
(16, 'Alface', 1.00, 1),
(17, 'Rúcula', 1.00, 1),
(18, 'Tomate', 1.00, 1),
(19, 'Tomate cereja', 1.00, 1),
(20, 'Abacaxi', 2.00, 1),
(21, 'Porção de Fritas', 4.00, 1),
(22, 'Bacon em Fatias', 4.00, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE `config` (
  `entrega` int(11) NOT NULL,
  `taxa` decimal(10,2) NOT NULL,
  `mensagemerro` varchar(450) NOT NULL,
  `aceitandopedido` int(11) NOT NULL,
  `mensagempedido` varchar(450) NOT NULL,
  `localdebusca` varchar(450) NOT NULL,
  `pais` int(11) NOT NULL,
  `ddd` int(11) NOT NULL,
  `telefone` int(11) NOT NULL,
  `chavepix` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`entrega`, `taxa`, `mensagemerro`, `aceitandopedido`, `mensagempedido`, `localdebusca`, `pais`, `ddd`, `telefone`, `chavepix`) VALUES
(1, 3.00, 'Infelizmente estamos sem entregador no momento', 1, 'não estamos recebendo pedidos no momento', 'teste', 55, 35, 984438596, 'CPF: 11374514675');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_de_pagamento`
--

CREATE TABLE `formas_de_pagamento` (
  `idformas_de_pagamento` int(11) NOT NULL,
  `forma_de_pagamento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formas_de_pagamento`
--

INSERT INTO `formas_de_pagamento` (`idformas_de_pagamento`, `forma_de_pagamento`) VALUES
(1, 'PIX'),
(2, 'Cartão'),
(3, 'Dinheiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lanches`
--

CREATE TABLE `lanches` (
  `idLanches` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Preco` decimal(10,2) NOT NULL,
  `Imagem` varchar(450) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lanches`
--

INSERT INTO `lanches` (`idLanches`, `Nome`, `Preco`, `Imagem`, `ativo`) VALUES
(1, 'Anunciação', 20.00, '4ed9f0444cdccfee2f49264291b36623.jpg', 1),
(2, 'La Belle de Jour', 16.00, '80a6ab37236196b4600bc6024e1b5c0b.jpg', 1),
(3, 'Coração Bobo', 15.00, 'f1b57299d56786b32019f0327b535354.jpg', 1),
(4, 'Morena Tropicana', 18.00, 'deb95e1e9dd97a7671b8b9cd01c6fbb6.jpg', 1),
(5, 'Ai que saudade d\'ocê', 18.00, '66eb82c74910912e34954136d5a9ba18.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lanches_com_complemento`
--

CREATE TABLE `lanches_com_complemento` (
  `idLanches` int(11) NOT NULL,
  `idComplemento` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lanches_com_complemento`
--

INSERT INTO `lanches_com_complemento` (`idLanches`, `idComplemento`, `Quantidade`) VALUES
(1, 1, 1),
(1, 3, 1),
(1, 22, 1),
(1, 6, 1),
(1, 13, 1),
(1, 16, 1),
(1, 18, 1),
(1, 10, 1),
(2, 1, 1),
(2, 5, 1),
(2, 9, 1),
(2, 13, 1),
(2, 17, 1),
(2, 19, 1),
(2, 11, 1),
(3, 2, 1),
(3, 4, 1),
(3, 22, 1),
(3, 8, 1),
(3, 11, 1),
(3, 21, 1),
(4, 1, 1),
(4, 3, 1),
(4, 22, 1),
(4, 7, 1),
(4, 20, 1),
(4, 10, 1),
(5, 1, 1),
(5, 3, 1),
(5, 12, 1),
(5, 16, 1),
(5, 18, 1),
(5, 11, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `cliente` varchar(45) NOT NULL,
  `rua` varchar(45) DEFAULT NULL,
  `numerocasa` int(11) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `valorpedido` decimal(10,2) NOT NULL,
  `pagamento` int(11) NOT NULL,
  `datadopedido` date NOT NULL,
  `horadopedido` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`idPedido`, `cliente`, `rua`, `numerocasa`, `bairro`, `valorpedido`, `pagamento`, `datadopedido`, `horadopedido`) VALUES
(1, 'Gustavo', 'Rua Milton Resende', 31, 'Residencial Jardins', 50.00, 3, '2022-11-02', '14:21:08'),
(6, 'Gustavo ', 'Rua Milton Resende ', 31, 'Residencial Jardins ', 50.00, 1, '2022-11-02', '16:21:15'),
(7, 'Rafa Magalhães', 'rua dos bobos', 0, 'casa engraçada', 51.00, 3, '2022-11-02', '18:12:00'),
(8, 'Gustavo', 'Rua Milton Resende ', 31, 'Residencial Jardins', 50.00, 1, '2022-11-03', '13:44:13'),
(9, 'Gustavo', 'Rua Milton Resende', 31, 'Residencial Jardins ', 50.00, 1, '2022-11-03', '23:29:26'),
(10, 'Gustavo', 'buscou', 0, '0', 43.00, 1, '2022-11-04', '00:33:32'),
(11, 'teste', 'Rua Milton Resende', 31, 'Residencial Jardins', 69.00, 1, '2022-11-04', '11:45:05'),
(12, 'Bruna ', 'Rua Milton Resende ', 31, 'Residencial Jardins ', 34.00, 3, '2022-11-04', '11:55:23'),
(13, '', 'buscou', 0, '0', 43.00, 1, '2022-11-04', '12:22:03'),
(14, 'Gustavo', 'Milton resende', 31, 'Residencial Jardins', 60.00, 3, '2022-11-07', '13:26:42'),
(15, 'Maria', 'buscou', 0, '0', 68.00, 1, '2022-11-07', '13:47:14'),
(16, 'Caruzo', 'Rua João Pinheiro', 347, 'Centro', 0.00, 3, '2022-11-07', '20:44:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_com_lanche`
--

CREATE TABLE `pedido_com_lanche` (
  `pedido_idPedido` int(11) NOT NULL,
  `idLanches` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido_com_lanche`
--

INSERT INTO `pedido_com_lanche` (`pedido_idPedido`, `idLanches`, `quantidade`) VALUES
(1, 1, 1),
(6, 1, 1),
(7, 1, 1),
(7, 5, 1),
(8, 1, 2),
(9, 3, 1),
(10, 1, 1),
(11, 1, 2),
(12, 1, 1),
(13, 1, 1),
(14, 1, 1),
(14, 3, 1),
(15, 3, 1),
(15, 4, 1),
(16, 1, 20),
(16, 3, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_has_bebidas`
--

CREATE TABLE `pedido_has_bebidas` (
  `pedido_idPedido` int(11) NOT NULL,
  `bebidas_idBebidas` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido_has_bebidas`
--

INSERT INTO `pedido_has_bebidas` (`pedido_idPedido`, `bebidas_idBebidas`, `quantidade`) VALUES
(1, 1, 1),
(6, 1, 1),
(7, 3, 1),
(8, 1, 1),
(9, 7, 1),
(10, 2, 1),
(11, 4, 1),
(12, 1, 2),
(13, 2, 1),
(15, 7, 1),
(16, 4, 10),
(16, 9, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_has_combo`
--

CREATE TABLE `pedido_has_combo` (
  `pedido_idPedido` int(11) NOT NULL,
  `combo_idCombo` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido_has_combo`
--

INSERT INTO `pedido_has_combo` (`pedido_idPedido`, `combo_idCombo`, `quantidade`) VALUES
(1, 1, 1),
(6, 2, 1),
(9, 2, 1),
(10, 2, 1),
(11, 1, 1),
(13, 2, 1),
(14, 2, 1),
(15, 1, 1),
(16, 1, 11),
(16, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_has_complemento`
--

CREATE TABLE `pedido_has_complemento` (
  `pedido_idPedido` int(11) NOT NULL,
  `complemento_idComplemento` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido_has_complemento`
--

INSERT INTO `pedido_has_complemento` (`pedido_idPedido`, `complemento_idComplemento`, `quantidade`) VALUES
(1, 6, 1),
(6, 7, 1),
(7, 4, 1),
(8, 7, 2),
(9, 7, 1),
(11, 7, 2),
(12, 7, 1),
(14, 5, 1),
(14, 14, 1),
(15, 7, 1),
(16, 3, 20),
(16, 4, 20),
(16, 5, 20),
(16, 6, 20),
(16, 7, 20),
(16, 8, 20),
(16, 9, 20),
(16, 10, 20),
(16, 11, 20),
(16, 12, 20),
(16, 13, 20),
(16, 14, 20),
(16, 21, 20),
(16, 22, 20),
(16, 3, 20),
(16, 4, 20),
(16, 5, 20),
(16, 6, 20),
(16, 7, 20),
(16, 8, 20),
(16, 9, 20),
(16, 10, 20),
(16, 11, 20),
(16, 12, 20),
(16, 13, 20),
(16, 14, 20),
(16, 15, 20),
(16, 16, 20),
(16, 18, 20),
(16, 20, 20),
(16, 21, 20),
(16, 22, 20);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`idBebidas`);

--
-- Índices para tabela `combo`
--
ALTER TABLE `combo`
  ADD PRIMARY KEY (`idCombo`);

--
-- Índices para tabela `combo_com_bebida`
--
ALTER TABLE `combo_com_bebida`
  ADD PRIMARY KEY (`idCombo`,`idBebidas`),
  ADD KEY `fk_Combo_has_Bebidas_Bebidas1_idx` (`idBebidas`),
  ADD KEY `fk_Combo_has_Bebidas_Combo1_idx` (`idCombo`);

--
-- Índices para tabela `combo_com_lanche`
--
ALTER TABLE `combo_com_lanche`
  ADD PRIMARY KEY (`idCombo`,`idLanches`),
  ADD KEY `fk_Combo_has_Lanches_Lanches1_idx` (`idLanches`),
  ADD KEY `fk_Combo_has_Lanches_Combo1_idx` (`idCombo`);

--
-- Índices para tabela `complemento`
--
ALTER TABLE `complemento`
  ADD PRIMARY KEY (`idComplemento`);

--
-- Índices para tabela `formas_de_pagamento`
--
ALTER TABLE `formas_de_pagamento`
  ADD PRIMARY KEY (`idformas_de_pagamento`);

--
-- Índices para tabela `lanches`
--
ALTER TABLE `lanches`
  ADD PRIMARY KEY (`idLanches`);

--
-- Índices para tabela `lanches_com_complemento`
--
ALTER TABLE `lanches_com_complemento`
  ADD KEY `fk_Lanches_has_Complemento_Complemento1_idx` (`idComplemento`),
  ADD KEY `fk_Lanches_has_Complemento_Lanches1_idx` (`idLanches`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`,`pagamento`),
  ADD KEY `fk_pedido_formas_de_pagamento1_idx` (`pagamento`);

--
-- Índices para tabela `pedido_com_lanche`
--
ALTER TABLE `pedido_com_lanche`
  ADD KEY `fk_Lanches_has_Complemento_Lanches1_idx` (`idLanches`),
  ADD KEY `fk_pedido_com_lanche_pedido1` (`pedido_idPedido`);

--
-- Índices para tabela `pedido_has_bebidas`
--
ALTER TABLE `pedido_has_bebidas`
  ADD KEY `fk_pedido_has_bebidas_bebidas1_idx` (`bebidas_idBebidas`),
  ADD KEY `fk_pedido_has_bebidas_pedido1_idx` (`pedido_idPedido`);

--
-- Índices para tabela `pedido_has_combo`
--
ALTER TABLE `pedido_has_combo`
  ADD PRIMARY KEY (`pedido_idPedido`,`combo_idCombo`),
  ADD KEY `fk_pedido_has_combo_combo1_idx` (`combo_idCombo`),
  ADD KEY `fk_pedido_has_combo_pedido1_idx` (`pedido_idPedido`);

--
-- Índices para tabela `pedido_has_complemento`
--
ALTER TABLE `pedido_has_complemento`
  ADD KEY `fk_pedido_has_complemento_complemento1_idx` (`complemento_idComplemento`),
  ADD KEY `fk_pedido_has_complemento_pedido1_idx` (`pedido_idPedido`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `idBebidas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `combo`
--
ALTER TABLE `combo`
  MODIFY `idCombo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `complemento`
--
ALTER TABLE `complemento`
  MODIFY `idComplemento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `lanches`
--
ALTER TABLE `lanches`
  MODIFY `idLanches` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `combo_com_bebida`
--
ALTER TABLE `combo_com_bebida`
  ADD CONSTRAINT `fk_Combo_has_Bebidas_Bebidas1` FOREIGN KEY (`idBebidas`) REFERENCES `bebidas` (`idBebidas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Combo_has_Bebidas_Combo1` FOREIGN KEY (`idCombo`) REFERENCES `combo` (`idCombo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `combo_com_lanche`
--
ALTER TABLE `combo_com_lanche`
  ADD CONSTRAINT `fk_Combo_has_Lanches_Combo1` FOREIGN KEY (`idCombo`) REFERENCES `combo` (`idCombo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Combo_has_Lanches_Lanches1` FOREIGN KEY (`idLanches`) REFERENCES `lanches` (`idLanches`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `lanches_com_complemento`
--
ALTER TABLE `lanches_com_complemento`
  ADD CONSTRAINT `fk_Lanches_has_Complemento_Complemento1` FOREIGN KEY (`idComplemento`) REFERENCES `complemento` (`idComplemento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Lanches_has_Complemento_Lanches1` FOREIGN KEY (`idLanches`) REFERENCES `lanches` (`idLanches`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_formas_de_pagamento1` FOREIGN KEY (`pagamento`) REFERENCES `formas_de_pagamento` (`idformas_de_pagamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido_com_lanche`
--
ALTER TABLE `pedido_com_lanche`
  ADD CONSTRAINT `fk_Lanches_has_Complemento_Lanches10` FOREIGN KEY (`idLanches`) REFERENCES `lanches` (`idLanches`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_com_lanche_pedido1` FOREIGN KEY (`pedido_idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido_has_bebidas`
--
ALTER TABLE `pedido_has_bebidas`
  ADD CONSTRAINT `fk_pedido_has_bebidas_bebidas1` FOREIGN KEY (`bebidas_idBebidas`) REFERENCES `bebidas` (`idBebidas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_has_bebidas_pedido1` FOREIGN KEY (`pedido_idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido_has_combo`
--
ALTER TABLE `pedido_has_combo`
  ADD CONSTRAINT `fk_pedido_has_combo_combo1` FOREIGN KEY (`combo_idCombo`) REFERENCES `combo` (`idCombo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_has_combo_pedido1` FOREIGN KEY (`pedido_idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido_has_complemento`
--
ALTER TABLE `pedido_has_complemento`
  ADD CONSTRAINT `fk_pedido_has_complemento_complemento1` FOREIGN KEY (`complemento_idComplemento`) REFERENCES `complemento` (`idComplemento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_has_complemento_pedido1` FOREIGN KEY (`pedido_idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
