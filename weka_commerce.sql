-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11-Jan-2023 às 13:58
-- Versão do servidor: 8.0.27
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "africa";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `weka_commerce`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_adm`
--

DROP TABLE IF EXISTS `tb_adm`;
CREATE TABLE IF NOT EXISTS `tb_adm` (
  `id_adm` int NOT NULL AUTO_INCREMENT,
  `localiza` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

DROP TABLE IF EXISTS `tb_cliente`;
CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comentario`
--

DROP TABLE IF EXISTS `tb_comentario`;
CREATE TABLE IF NOT EXISTS `tb_comentario` (
  `id_comentario` int NOT NULL AUTO_INCREMENT,
  `comentario` varchar(400) DEFAULT NULL,
  `permitircoment` tinyint(1) DEFAULT NULL,
  `id_adm` int DEFAULT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fornecedor`
--

DROP TABLE IF EXISTS `tb_fornecedor`;
CREATE TABLE IF NOT EXISTS `tb_fornecedor` (
  `id_fornecedor` int NOT NULL AUTO_INCREMENT,
  `nome_fornecedor` varchar(30) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `id_indereço` int DEFAULT NULL,
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_login`
--

DROP TABLE IF EXISTS `tb_login`;
CREATE TABLE IF NOT EXISTS `tb_login` (
  `id_lohin` int NOT NULL AUTO_INCREMENT,
  `id_pessooa` int DEFAULT NULL,
  PRIMARY KEY (`id_lohin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pessoa`
--

DROP TABLE IF EXISTS `tb_pessoa`;
CREATE TABLE IF NOT EXISTS `tb_pessoa` (
  `id_pessoa` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `senha` varchar(10) NOT NULL,
  PRIMARY KEY (`id_pessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

DROP TABLE IF EXISTS `tb_produto`;
CREATE TABLE IF NOT EXISTS `tb_produto` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(30) DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  `imagem_produto` varchar(100) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `marca` varchar(60) DEFAULT NULL,
  `valor_compra` float DEFAULT NULL,
  `valor_venda` decimal(6,2) DEFAULT NULL,
  `cor` varchar(15) DEFAULT NULL,
  `tamanho` varchar(30) DEFAULT NULL,
  `id_fornecedor` int DEFAULT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_venda`
--

DROP TABLE IF EXISTS `tb_venda`;
CREATE TABLE IF NOT EXISTS `tb_venda` (
  `id_venda` int NOT NULL,
  `preço` decimal(3,2) NOT NULL,
  `tipo_pagamento` varchar(20) DEFAULT NULL,
  `num_cartão` varchar(30) DEFAULT NULL,
  `agencia_bancaria` varchar(35) DEFAULT NULL,
  `data_venda` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `id_pessooa` int DEFAULT NULL,
  `id_indereco_entrega` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
