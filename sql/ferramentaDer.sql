-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 19/06/2018 às 06:01
-- Versão do servidor: 5.5.56-MariaDB
-- Versão do PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ferramentaDer`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(11) NOT NULL,
  `activity_title` varchar(255) NOT NULL,
  `activity_description` text NOT NULL,
  `activity_status` tinyint(4) NOT NULL DEFAULT '0',
  `fk_student_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(45) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comments_id` int(11) NOT NULL,
  `comments_title` varchar(45) DEFAULT NULL,
  `comments_description` text NOT NULL,
  `fk_activity` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_comments` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `diagram`
--

CREATE TABLE IF NOT EXISTS `diagram` (
  `diagram_id` int(11) NOT NULL,
  `diagram_name` varchar(150) NOT NULL,
  `diagram_description` text,
  `diagram_json` text NOT NULL,
  `relatioship_json` text NOT NULL,
  `fk_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `student_group`
--

CREATE TABLE IF NOT EXISTS `student_group` (
  `student_group_id` int(11) NOT NULL,
  `fk_user_teacher` int(11) NOT NULL,
  `fk_user_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `user_cpf` varchar(45) NOT NULL,
  `user_rg` varchar(45) NOT NULL,
  `user_type` smallint(6) NOT NULL,
  `user_state` char(2) NOT NULL,
  `user_city` varchar(45) NOT NULL,
  `user_public_space` varchar(150) NOT NULL,
  `user_number` varchar(45) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `fk_student_group` (`fk_student_group`) USING BTREE;

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Índices de tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comments_id`),
  ADD KEY `fk_activity` (`fk_activity`),
  ADD KEY `fkComments` (`fk_comments`);

--
-- Índices de tabela `diagram`
--
ALTER TABLE `diagram`
  ADD PRIMARY KEY (`diagram_id`),
  ADD UNIQUE KEY `fk_activity` (`fk_activity`),
  ADD KEY `fk_activuty` (`fk_activity`) USING BTREE;

--
-- Índices de tabela `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`student_group_id`),
  ADD UNIQUE KEY `fk_student` (`fk_user_student`),
  ADD KEY `fk_teacher` (`fk_user_teacher`) USING BTREE;

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `comments_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `diagram`
--
ALTER TABLE `diagram`
  MODIFY `diagram_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `student_group`
--
ALTER TABLE `student_group`
  MODIFY `student_group_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `fk_student_group_activity` FOREIGN KEY (`fk_student_group`) REFERENCES `student_group` (`student_group_id`);

--
-- Restrições para tabelas `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `activity_comments` FOREIGN KEY (`fk_activity`) REFERENCES `activity` (`activity_id`),
  ADD CONSTRAINT `comments_comments_child` FOREIGN KEY (`fk_comments`) REFERENCES `comments` (`comments_id`);

--
-- Restrições para tabelas `diagram`
--
ALTER TABLE `diagram`
  ADD CONSTRAINT `fk_activity_diagram` FOREIGN KEY (`fk_activity`) REFERENCES `activity` (`activity_id`);

--
-- Restrições para tabelas `student_group`
--
ALTER TABLE `student_group`
  ADD CONSTRAINT `fk_student_group_student` FOREIGN KEY (`fk_user_student`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `fk_student_group_teacher` FOREIGN KEY (`fk_user_teacher`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
