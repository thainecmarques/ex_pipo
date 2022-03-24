-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Mar-2022 às 01:53
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pipo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `beneficio`
--

CREATE TABLE `beneficio` (
  `id_beneficio` int(11) NOT NULL,
  `nome_beneficio` varchar(100) NOT NULL,
  `tipo_beneficio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `beneficio`
--

INSERT INTO `beneficio` (`id_beneficio`, `nome_beneficio`, `tipo_beneficio`) VALUES
(1, 'Norte Europa', 1),
(2, 'Pampulha Intermedica', 1),
(3, 'Dental Sorriso', 2),
(4, 'Mente Sa, Corpo Sao', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `beneficio_dados`
--

CREATE TABLE `beneficio_dados` (
  `id_beneficio` int(11) NOT NULL,
  `id_dados_func` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `beneficio_dados`
--

INSERT INTO `beneficio_dados` (`id_beneficio`, `id_dados_func`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 5),
(3, 1),
(3, 2),
(3, 6),
(3, 7),
(4, 2),
(4, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `senha_cliente` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome_cliente`, `senha_cliente`) VALUES
(1, 'Acme Co', 'ac123'),
(2, 'Tio Patinhas Bank', 'tpb123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_beneficio`
--

CREATE TABLE `cliente_beneficio` (
  `id_cliente` int(11) NOT NULL,
  `id_beneficio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente_beneficio`
--

INSERT INTO `cliente_beneficio` (`id_cliente`, `id_beneficio`) VALUES
(1, 1),
(1, 3),
(2, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_func`
--

CREATE TABLE `dados_func` (
  `id_dados_func` int(11) NOT NULL,
  `desc_dados` varchar(100) NOT NULL,
  `tipo_html` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dados_func`
--

INSERT INTO `dados_func` (`id_dados_func`, `desc_dados`, `tipo_html`) VALUES
(1, 'Nome', 'text'),
(2, 'CPF (apenas numeros)', 'text'),
(3, 'Data admissao', 'date'),
(4, 'Email', 'email'),
(5, 'Endereco', 'text'),
(6, 'Peso', 'number'),
(7, 'Altura', 'text'),
(8, 'Horas meditadas', 'number');

-- --------------------------------------------------------

--
-- Estrutura da tabela `func`
--

CREATE TABLE `func` (
  `id_func` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_dados_func` int(11) NOT NULL,
  `desc_func` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `func`
--

INSERT INTO `func` (`id_func`, `id_cliente`, `id_dados_func`, `desc_func`) VALUES
(1, 1, 1, 'Maria Silva'),
(1, 1, 2, '09222123567'),
(1, 1, 3, '2020-12-01'),
(1, 1, 4, 'mariasilva@empr.br'),
(1, 1, 6, '62'),
(1, 1, 7, '1,60'),
(2, 2, 1, 'Maria Silva'),
(2, 2, 2, '09222123567'),
(2, 2, 3, '2020-12-01'),
(2, 2, 5, 'Av Paulista, 1552, SÃ£o Paulo - SP'),
(2, 2, 6, '62'),
(2, 2, 7, '1,60'),
(2, 2, 8, '5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_beneficio`
--

CREATE TABLE `tipo_beneficio` (
  `id_tipo_ben` int(11) NOT NULL,
  `nome_tipo_ben` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_beneficio`
--

INSERT INTO `tipo_beneficio` (`id_tipo_ben`, `nome_tipo_ben`) VALUES
(1, 'Plano de Saude'),
(2, 'Plano Dental'),
(3, 'Plano de Saude Mental');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beneficio`
--
ALTER TABLE `beneficio`
  ADD PRIMARY KEY (`id_beneficio`),
  ADD KEY `tipo_beneficio` (`tipo_beneficio`);

--
-- Indexes for table `beneficio_dados`
--
ALTER TABLE `beneficio_dados`
  ADD KEY `id_dados_func` (`id_dados_func`),
  ADD KEY `fk_id_beneficio` (`id_beneficio`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `cliente_beneficio`
--
ALTER TABLE `cliente_beneficio`
  ADD KEY `id_beneficio` (`id_beneficio`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `dados_func`
--
ALTER TABLE `dados_func`
  ADD PRIMARY KEY (`id_dados_func`);

--
-- Indexes for table `func`
--
ALTER TABLE `func`
  ADD PRIMARY KEY (`id_func`,`id_cliente`,`id_dados_func`),
  ADD KEY `fk_cli_func` (`id_cliente`),
  ADD KEY `fk_dados_func` (`id_dados_func`);

--
-- Indexes for table `tipo_beneficio`
--
ALTER TABLE `tipo_beneficio`
  ADD PRIMARY KEY (`id_tipo_ben`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beneficio`
--
ALTER TABLE `beneficio`
  MODIFY `id_beneficio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dados_func`
--
ALTER TABLE `dados_func`
  MODIFY `id_dados_func` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tipo_beneficio`
--
ALTER TABLE `tipo_beneficio`
  MODIFY `id_tipo_ben` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `beneficio`
--
ALTER TABLE `beneficio`
  ADD CONSTRAINT `tipo_beneficio` FOREIGN KEY (`tipo_beneficio`) REFERENCES `tipo_beneficio` (`id_tipo_ben`);

--
-- Limitadores para a tabela `beneficio_dados`
--
ALTER TABLE `beneficio_dados`
  ADD CONSTRAINT `fk_id_beneficio` FOREIGN KEY (`id_beneficio`) REFERENCES `beneficio` (`id_beneficio`),
  ADD CONSTRAINT `id_dados_func` FOREIGN KEY (`id_dados_func`) REFERENCES `dados_func` (`id_dados_func`);

--
-- Limitadores para a tabela `cliente_beneficio`
--
ALTER TABLE `cliente_beneficio`
  ADD CONSTRAINT `id_beneficio` FOREIGN KEY (`id_beneficio`) REFERENCES `beneficio` (`id_beneficio`),
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Limitadores para a tabela `func`
--
ALTER TABLE `func`
  ADD CONSTRAINT `fk_cli_func` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `fk_dados_func` FOREIGN KEY (`id_dados_func`) REFERENCES `dados_func` (`id_dados_func`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
