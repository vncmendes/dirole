-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 14-Set-2020 às 04:15
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Sertanejo'),
(2, 'Funk'),
(4, 'Rock / Metal'),
(5, 'Rap / HipHop'),
(6, 'Pagode / Samba'),
(7, 'Reggae'),
(8, 'Eletrônica'),
(10, 'LGBTQ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `idest` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estrutura`
--

CREATE TABLE `estrutura` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estrutura`
--

INSERT INTO `estrutura` (`id`, `nome`) VALUES
(1, 'Open Air'),
(2, 'Close Air'),
(3, 'Com DJ'),
(4, 'Bar / Pub'),
(5, 'Festival'),
(6, 'Multicultura'),
(7, 'Privado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `gv` tinyint(1) DEFAULT NULL,
  `estacionamento` tinyint(1) DEFAULT NULL,
  `horainicial` time DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `horafinal` time DEFAULT NULL,
  `idadm` int(11) DEFAULT NULL,
  `ingresso` float DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `data`, `localizacao`, `descricao`, `gv`, `estacionamento`, `horainicial`, `nome`, `horafinal`, `idadm`, `ingresso`, `arquivo`) VALUES
(91, '2018-07-09', 'Praia', 'do Rap ao Funk', 0, NULL, '23:59:00', 'Skye', '06:00:00', NULL, 50, ''),
(103, '2018-12-23', 'rua', 'bailÃ£oooooo', 0, NULL, '23:00:00', 'BailÃ£o', '06:00:00', NULL, 20, ''),
(104, '0123-12-12', 'kkkkkkkkkk', 'kkkkkkkkk', 1, NULL, '12:03:00', 'OI', '12:23:00', NULL, 10, ''),
(106, '3233-02-23', 'asd3', 'asd', 1, NULL, '23:33:00', 'asdasd', '23:33:00', NULL, 10, ''),
(108, '0000-00-00', 'asdasdasdasd', 'asdasd  dwdwd', 1, NULL, '12:45:00', 'nnnnnnnnnnnnn', '12:45:00', NULL, 20, ''),
(109, '2018-02-23', 'nao sei', 'asdasdasd', 1, NULL, '23:00:00', 'ma oe', '06:00:00', NULL, 55, ''),
(110, '2018-02-23', 'nao sei', 'asdasdasd', 1, NULL, '23:00:00', 'ma oe', '06:00:00', NULL, 55, ''),
(111, '2018-12-12', 'asd', 'asd', 0, NULL, '23:00:00', 'asd', '16:00:00', NULL, 15, ''),
(112, '2220-09-22', 'lÃ¡', 'longe', 1, NULL, '02:00:00', 'Bailao', '15:00:00', NULL, 50, ''),
(113, '0000-00-00', '', '', 0, NULL, '00:00:00', '', '00:00:00', NULL, 0, ''),
(114, '0000-00-00', '', '', 0, NULL, '00:00:00', '', '00:00:00', NULL, 0, ''),
(115, '2018-07-09', 'Praia', 'do Rap ao Funk', 0, NULL, '23:59:00', 'Skyeeee', '06:00:00', NULL, 50, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingresso`
--

CREATE TABLE `ingresso` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` varchar(10) DEFAULT NULL,
  `valor` varchar(10) DEFAULT NULL,
  `quantidade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `registra_eventocategoria`
--

CREATE TABLE `registra_eventocategoria` (
  `idcategoria` int(11) DEFAULT NULL,
  `idevento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `registra_eventocategoria`
--

INSERT INTO `registra_eventocategoria` (`idcategoria`, `idevento`) VALUES
(5, 91),
(1, 103),
(5, 103),
(4, 104),
(6, 104),
(4, 106),
(5, 106),
(6, 108),
(5, 109),
(5, 110),
(5, 112),
(1, 112),
(2, 112),
(7, 112),
(8, 112);

-- --------------------------------------------------------

--
-- Estrutura da tabela `registra_eventoestrutura`
--

CREATE TABLE `registra_eventoestrutura` (
  `idestrutura` int(11) DEFAULT NULL,
  `idevento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `registra_eventoestrutura`
--

INSERT INTO `registra_eventoestrutura` (`idestrutura`, `idevento`) VALUES
(3, 91),
(4, 91),
(3, 103),
(4, 103),
(4, 104),
(4, 106),
(1, 108),
(2, 108),
(4, 109),
(4, 110),
(3, 112),
(4, 112),
(2, 112),
(3, 112),
(4, 112);

-- --------------------------------------------------------

--
-- Estrutura da tabela `useradm`
--

CREATE TABLE `useradm` (
  `id` int(11) NOT NULL,
  `cpf` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `useradm`
--

INSERT INTO `useradm` (`id`, `cpf`, `nome`, `email`, `senha`, `sobrenome`, `foto`) VALUES
(1, 19230192, 'asd', 'asd@asd.com', '123', 'asdasd', NULL),
(2, 19230192, 'asd', 'asd@asd.com', '123', 'asdasd', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `sobrenome` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `nome`, `sobrenome`, `foto`) VALUES
(68, 'lao@tse.com', '7088d9c11f95e0f2a877b019ff519175', 'lao', 'tse', NULL),
(69, 'vini@vini.com', '4297f44b13955235245b2497399d7a93', 'vini', 'mendes', NULL),
(72, 'tio@joao.com', 'a3dcb4d229de6fde0db5686dee47145d', 'tio', 'joao', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idest` (`idest`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estrutura`
--
ALTER TABLE `estrutura`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idadm` (`idadm`);

--
-- Indexes for table `registra_eventocategoria`
--
ALTER TABLE `registra_eventocategoria`
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idevento` (`idevento`);

--
-- Indexes for table `registra_eventoestrutura`
--
ALTER TABLE `registra_eventoestrutura`
  ADD KEY `idestrutura` (`idestrutura`),
  ADD KEY `idevento` (`idevento`);

--
-- Indexes for table `useradm`
--
ALTER TABLE `useradm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estrutura`
--
ALTER TABLE `estrutura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `useradm`
--
ALTER TABLE `useradm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `cidade_ibfk_1` FOREIGN KEY (`idest`) REFERENCES `estado` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
