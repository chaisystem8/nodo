-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 24, 2021 at 09:20 PM
-- Server version: 5.7.24
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nodo`
--
CREATE DATABASE IF NOT EXISTS `nodo` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `nodo`;

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre`, `apellido`, `usuario`, `password`, `correo`, `deleted_at`) VALUES
(1, 'Isaias', 'Soto', 'Isoto', '$2y$10$5UH4x1ZC1a2ytEQk8NTQ7eF.LUBzfH5rrRn.8ve1kocr.7L8OXLq2', 'isoto@correo.com', NULL),
(2, 'Juan', 'Solo', 'juans', '123123', 'juan@correo.com', NULL),
(3, 'Pedro', 'Paramo', 'pparamo', '$2y$10$tWrzgwn4d2Fs3WNVnyk6s.DgHmGeoWkW0lJODQUcKCDZT5QZ5bJQm', 'pparamo@correo.com', NULL),
(4, 'Gaby', 'Solo', 'gsolo', '$2y$10$TlvvwJZQIWBFlcNa4BTfWOO9RiA7h9cOyWF9VbPMZOvrXFCzJoVxC', 'gsolo@correo.com', NULL),
(5, 'Luis', 'Vaca', 'lvaca', '$2y$10$P/v.1Wn6DcrJqM0jXpwlGOQ5izrymTdMCzUFc4IR3J5intmHxkvoi', 'lvaca@correo.com', NULL),
(6, 'Isaiase23s', 'Soto', 'chais', '$2y$10$sWaPWzi6SjUPjf18CnXNueX6AMZhJdOzNS7y4p.ovMwLQqUHtx9Xm', 'chais@correo.com', '2021-04-24 23:59:25'),
(7, 'nuevo otro', 'asd', 'dsadasd', '$2y$10$BLh5jhSUqkVmLx2/t6nfkuDsZMCZgonje5DkuwgKlKBWl5EX/xVQC', 'asdasd', '2021-04-24 08:59:28'),
(8, 'borrar', 'sdfsdf', 'sdfsdf', '$2y$10$MnaNwz4Od5d9ZfZ5JaK63.2yD9I0txD8JE5fOGbchoHpH.DW0tAEa', 'sdfsdfsd', '2021-04-24 05:50:11'),
(9, 'Trigger', 'mysql', 'tri', '$2y$10$Ft8Kyc4dszs5DuFx3gaGgOiQMQLTprbsLAAIWC37C9OoXmlcEM2sy', 'tri@correo.com', NULL),
(10, 'Trigger 2', 'my', 'trig2', '$2y$10$XhiXXhukirMNE4lpOk/hAeJsQ7tS4CWFrHgy6wiY71GcvsaBtasV.', 'trig2@correo.com', NULL),
(11, 'borrrar', 'sdf', 'sdf', '$2y$10$dESoTReoOUoPfVwCLaCB1OuP1oWMwD2ck2b0O.7wSu.R.yQgIjG4y', 'sdf', '2021-04-25 02:07:08');

--
-- Triggers `alumnos`
--
DELIMITER $$
CREATE TRIGGER `insertautoperiodo` AFTER INSERT ON `alumnos` FOR EACH ROW INSERT INTO periodos(id_alumno,id_grado,id_grupo,periodo)
VALUES (NEW.id_alumno, (SELECT ROUND((RAND() * (6-1))+1)), 1, 'Junio 2021 - Diciembre 2021')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `detalle_alumno_periodo`
-- (See below for the actual view)
--
CREATE TABLE `detalle_alumno_periodo` (
`id_alumno` int(11)
,`id_periodo` int(11)
,`nombre` varchar(501)
,`usuario` varchar(250)
,`correo` varchar(250)
,`periodo` varchar(250)
,`grado` varchar(250)
,`grupo` varchar(250)
,`materias` text
);

-- --------------------------------------------------------

--
-- Table structure for table `grados`
--

CREATE TABLE `grados` (
  `id_grado` int(11) NOT NULL,
  `grado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grados`
--

INSERT INTO `grados` (`id_grado`, `grado`) VALUES
(1, '1er Semestre'),
(2, '2do Semestre'),
(3, '3er Semestre'),
(4, '4to Semestre'),
(5, '5to Semestre'),
(6, '6to Semestre');

-- --------------------------------------------------------

--
-- Table structure for table `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `grupo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `grupo`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(11) NOT NULL,
  `materia` varchar(250) NOT NULL,
  `id_grado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materias`
--

INSERT INTO `materias` (`id_materia`, `materia`, `id_grado`) VALUES
(1, 'Matematicas 1', 1),
(2, 'Matematicas 2', 2),
(3, 'Física 1', 1),
(6, 'Matematicas 3', 3),
(7, 'Matematicas 4', 4),
(8, 'Matematicas 5', 5),
(9, 'Matematicas 6', 6),
(10, 'Fisica 2', 2),
(11, 'Fisica 3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `periodos`
--

CREATE TABLE `periodos` (
  `id_periodo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `periodo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `periodos`
--

INSERT INTO `periodos` (`id_periodo`, `id_alumno`, `id_grado`, `id_grupo`, `periodo`) VALUES
(1, 1, 1, 1, 'Enero 2021 - junio 2021'),
(2, 2, 2, 2, 'Junio 2021 - Diciembre 2021'),
(3, 9, 1, 1, 'Junio 2021 - Diciembre 2021'),
(4, 10, 4, 1, 'Junio 2021 - Diciembre 2021'),
(5, 11, 2, 1, 'Junio 2021 - Diciembre 2021');

-- --------------------------------------------------------

--
-- Structure for view `detalle_alumno_periodo`
--
DROP TABLE IF EXISTS `detalle_alumno_periodo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detalle_alumno_periodo`  AS  select `a`.`id_alumno` AS `id_alumno`,`p`.`id_periodo` AS `id_periodo`,concat(`a`.`nombre`,' ',`a`.`apellido`) AS `nombre`,`a`.`usuario` AS `usuario`,`a`.`correo` AS `correo`,`p`.`periodo` AS `periodo`,`g`.`grado` AS `grado`,`gu`.`grupo` AS `grupo`,group_concat(`m`.`materia` separator ',') AS `materias` from ((((`periodos` `p` left join `alumnos` `a` on((`a`.`id_alumno` = `p`.`id_alumno`))) left join `grados` `g` on((`g`.`id_grado` = `p`.`id_grado`))) left join `grupos` `gu` on((`gu`.`id_grupo` = `p`.`id_grupo`))) left join `materias` `m` on((`m`.`id_grado` = `p`.`id_grado`))) group by `p`.`id_periodo` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indexes for table `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `id_grado` (`id_grado`);

--
-- Indexes for table `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id_periodo`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_grado` (`id_grado`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `grados`
--
ALTER TABLE `grados`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`);

--
-- Constraints for table `periodos`
--
ALTER TABLE `periodos`
  ADD CONSTRAINT `periodos_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`),
  ADD CONSTRAINT `periodos_ibfk_2` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`),
  ADD CONSTRAINT `periodos_ibfk_3` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
