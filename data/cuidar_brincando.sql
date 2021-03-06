-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 15/05/2013 às 14:55:43
-- Versão do Servidor: 5.5.31
-- Versão do PHP: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `cuidar_brincando`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_administrador_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `crianca`
--

CREATE TABLE IF NOT EXISTS `crianca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `escola` varchar(50) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `diagnostico` varchar(50) NOT NULL,
  `dataInternacao` datetime NOT NULL,
  `dataAlta` datetime DEFAULT NULL,
  `composicaoFamiliar` text,
  `pessoa_id` int(11) NOT NULL,
  `atividades` text,
  PRIMARY KEY (`id`),
  KEY `fk_crianca_pessoa1` (`pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `crianca_responsavel`
--

CREATE TABLE IF NOT EXISTS `crianca_responsavel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `crianca_id` int(11) NOT NULL,
  `responsavel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_crianca_responsavel_crianca1` (`crianca_id`),
  KEY `fk_crianca_responsavel_responsavel1` (`responsavel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `educador`
--

CREATE TABLE IF NOT EXISTS `educador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `semestreEntrada` varchar(6) NOT NULL,
  `rga` varchar(15) NOT NULL,
  `renda` varchar(30) NOT NULL,
  `curriculo` text NOT NULL,
  `bolsista` tinyint(4) NOT NULL,
  `tipoBolsa` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_educador_pessoa1` (`pessoa_id`),
  KEY `fk_educador_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco` varchar(255) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `pais` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(12) DEFAULT NULL,
  `apelido` varchar(50) DEFAULT NULL,
  `dataNascimento` varchar(10) NOT NULL,
  `sexo` enum('M','F','I') NOT NULL,
  `cor` enum('PR','PA','AM','BR') NOT NULL COMMENT 'PR = PRETO\nPA = PARDO\nAM = AMARELO\nBR = BRANCO',
  `escolaridade` enum('N','FI','F','MI','M','SI','S') NOT NULL COMMENT 'N - Nenhum\nFI - Fundamental Incompleto\nF - Fundamental Completo\nMI - Medio incompleto\nM - Medio completo\nSI - Superior incompleto\nS - Superior completo',
  `foto` varchar(45) DEFAULT NULL,
  `identidade` varchar(15) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `tituloEleitor` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pessoa_endereco1` (`endereco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `graduacao` varchar(100) NOT NULL,
  `mestrado` varchar(100) DEFAULT NULL,
  `doutorado` varchar(100) DEFAULT NULL,
  `phd` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_professor_pessoa1` (`pessoa_id`),
  KEY `fk_professor_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio`
--

CREATE TABLE IF NOT EXISTS `relatorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` text NOT NULL,
  `data` datetime NOT NULL,
  `feitoPor` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio_comentario`
--

CREATE TABLE IF NOT EXISTS `relatorio_comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relatorio_id` int(11) NOT NULL,
  `comentario` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_relatorio_comentario_relatorio1` (`relatorio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio_crianca`
--

CREATE TABLE IF NOT EXISTS `relatorio_crianca` (
  `id` int(11) NOT NULL,
  `relatorio_id` int(11) NOT NULL,
  `crianca_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_table1_relatorio1` (`relatorio_id`),
  KEY `fk_table1_crianca1` (`crianca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio_participante`
--

CREATE TABLE IF NOT EXISTS `relatorio_participante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relatorio_id` int(11) NOT NULL,
  `educador_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_relatorio_participante_educador` (`educador_id`),
  KEY `fk_relatorio_participante_relatorio1` (`relatorio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel`
--

CREATE TABLE IF NOT EXISTS `responsavel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) NOT NULL,
  `ajudaFamilia` enum('S','A','N') NOT NULL COMMENT 'S = SEMPRE\nA = ASVEZES\nN = NUNCA',
  `renda` varchar(20) DEFAULT NULL,
  `beneficios` enum('F','M','FA','N') DEFAULT NULL COMMENT 'F = FORTE\nM = MEDIO\nFA = FRACO\nN =  NUNCA',
  `situacaoPsicologica` text,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_responsavel_pessoa1` (`pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel_crianca`
--

CREATE TABLE IF NOT EXISTS `responsavel_crianca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `responsavel_id` int(11) NOT NULL,
  `crianca_id` int(11) NOT NULL,
  `grauParentesco` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_responsavel_crianca_responsavel1` (`responsavel_id`),
  KEY `fk_responsavel_crianca_crianca1` (`crianca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `tipo` enum('A','P','E','EB') NOT NULL COMMENT 'A - Administrador\nP - Professor\nE - Educador\nEB - Educador Bolsista',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_administrador_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `crianca`
--
ALTER TABLE `crianca`
  ADD CONSTRAINT `fk_crianca_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `crianca_responsavel`
--
ALTER TABLE `crianca_responsavel`
  ADD CONSTRAINT `fk_crianca_responsavel_crianca1` FOREIGN KEY (`crianca_id`) REFERENCES `crianca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_crianca_responsavel_responsavel1` FOREIGN KEY (`responsavel_id`) REFERENCES `responsavel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `educador`
--
ALTER TABLE `educador`
  ADD CONSTRAINT `fk_educador_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_educador_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `fk_pessoa_endereco1` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `fk_professor_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_professor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `relatorio_comentario`
--
ALTER TABLE `relatorio_comentario`
  ADD CONSTRAINT `fk_relatorio_comentario_relatorio1` FOREIGN KEY (`relatorio_id`) REFERENCES `relatorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `relatorio_crianca`
--
ALTER TABLE `relatorio_crianca`
  ADD CONSTRAINT `fk_table1_relatorio1` FOREIGN KEY (`relatorio_id`) REFERENCES `relatorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_crianca1` FOREIGN KEY (`crianca_id`) REFERENCES `crianca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `relatorio_participante`
--
ALTER TABLE `relatorio_participante`
  ADD CONSTRAINT `fk_relatorio_participante_educador` FOREIGN KEY (`educador_id`) REFERENCES `educador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_relatorio_participante_relatorio1` FOREIGN KEY (`relatorio_id`) REFERENCES `relatorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `responsavel`
--
ALTER TABLE `responsavel`
  ADD CONSTRAINT `fk_responsavel_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `responsavel_crianca`
--
ALTER TABLE `responsavel_crianca`
  ADD CONSTRAINT `fk_responsavel_crianca_responsavel1` FOREIGN KEY (`responsavel_id`) REFERENCES `responsavel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_responsavel_crianca_crianca1` FOREIGN KEY (`crianca_id`) REFERENCES `crianca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
