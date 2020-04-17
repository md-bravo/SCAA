-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2020 at 05:14 PM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_scaa`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_setCustomVal` (IN `sSeqName` VARCHAR(50) CHARSET utf8, IN `sSeqGroup` VARCHAR(10) CHARSET utf8, IN `nVal` INT UNSIGNED)  NO SQL
BEGIN
    IF (SELECT COUNT(*) FROM _sequence  
            WHERE seq_name = sSeqName  
                AND seq_group = sSeqGroup) = 0 THEN
        INSERT INTO _sequence (seq_name,seq_group,seq_val)
        VALUES (sSeqName,sSeqGroup,nVal);
    ELSE
        UPDATE _sequence SET seq_val = nVal
        WHERE seq_name = sSeqName AND seq_group = sSeqGroup;
    END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getNextCustomSeq` (`sSeqName` VARCHAR(50) CHARSET utf8, `sSeqGroup` VARCHAR(10) CHARSET utf8) RETURNS VARCHAR(20) CHARSET utf8 NO SQL
BEGIN
    DECLARE nLast_val INT; 
 
    SET nLast_val =  (SELECT seq_val
                          FROM _sequence
                          WHERE seq_name = sSeqName
                                AND seq_group = sSeqGroup);
    IF nLast_val IS NULL THEN
        SET nLast_val = 1;
        INSERT INTO _sequence (seq_name,seq_group,seq_val)
        VALUES (sSeqName,sSeqGroup,nLast_Val);
    ELSE
        SET nLast_val = nLast_val + 1;
        UPDATE _sequence SET seq_val = nLast_val
        WHERE seq_name = sSeqName AND seq_group = sSeqGroup;
    END IF; 
 
    SET @ret = (SELECT concat(sSeqGroup,'-',lpad(nLast_val,6,'0')));
    RETURN @ret;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `actividades`
--

CREATE TABLE `actividades` (
  `id_Act` int(11) NOT NULL,
  `nombre_Act` varchar(60) DEFAULT NULL,
  `peso_Act` float DEFAULT NULL,
  `id_Area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actividades`
--

INSERT INTO `actividades` (`id_Act`, `nombre_Act`, `peso_Act`, `id_Area`) VALUES
(501, 'Instalación Banda Ancha', 0.71, 201),
(502, 'Instalación total de OST POTS', 1, 201),
(503, 'Empalme de 24 fibras', 4.5, 202),
(504, 'Rehacer empalme de 100 pares (ducto o aéreo)', 3, 202),
(505, 'Instalación de órdenes de servicios empresariales', 2.5, 203),
(506, 'Atención de averías de servicios empresariales', 1.25, 203),
(507, 'Capacitaciones (por hora)', 0.56, NULL),
(508, 'Reuniones de personal (por hora)', 0.56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id_Area` int(11) NOT NULL,
  `nombre_Area` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id_Area`, `nombre_Area`) VALUES
(201, 'Lineas'),
(202, 'Cables'),
(203, 'Empresariales'),
(204, 'Gestión');

-- --------------------------------------------------------

--
-- Table structure for table `estados_reg_act`
--

CREATE TABLE `estados_reg_act` (
  `id_Estado_Reg_Act` int(11) NOT NULL,
  `estado_Reg_Act` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estados_reg_act`
--

INSERT INTO `estados_reg_act` (`id_Estado_Reg_Act`, `estado_Reg_Act`) VALUES
(71, 'Abierto'),
(72, 'Cerrado'),
(73, 'Eliminado');

-- --------------------------------------------------------

--
-- Table structure for table `estado_usuario`
--

CREATE TABLE `estado_usuario` (
  `id_Estado` int(11) NOT NULL,
  `nombre_Estado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estado_usuario`
--

INSERT INTO `estado_usuario` (`id_Estado`, `nombre_Estado`) VALUES
(51, 'Activo'),
(52, 'Inactivo');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_Log` int(11) NOT NULL,
  `usuario` int(11) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL,
  `IP` varchar(15) DEFAULT NULL,
  `Nombre_PC` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `regiones`
--

CREATE TABLE `regiones` (
  `id_Region` int(11) NOT NULL,
  `nombre_Reg` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regiones`
--

INSERT INTO `regiones` (`id_Region`, `nombre_Reg`) VALUES
(1, 'Pacífico Central y Norte');

-- --------------------------------------------------------

--
-- Table structure for table `reg_act`
--

CREATE TABLE `reg_act` (
  `id_Reg_Act` int(11) NOT NULL,
  `consecutivo` varchar(20) DEFAULT NULL,
  `OST` int(11) DEFAULT NULL,
  `SIGA` int(11) DEFAULT NULL,
  `cantidad_eventos` int(11) DEFAULT NULL,
  `numero_servicio` int(11) DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL,
  `fecha_hora_apertura` datetime DEFAULT NULL,
  `fecha_hora_cierre` datetime DEFAULT NULL,
  `tiempo_total` varchar(50) DEFAULT NULL,
  `peso_total` varchar(11) DEFAULT NULL,
  `usuario_asignado` int(11) DEFAULT NULL,
  `usuario_asignador` int(11) DEFAULT NULL,
  `usuario_cierra` int(11) DEFAULT NULL,
  `id_Act` int(11) DEFAULT NULL,
  `id_Estado_Reg_Act` int(11) DEFAULT NULL,
  `id_Grupo_Reg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reg_act`
--

INSERT INTO `reg_act` (`id_Reg_Act`, `consecutivo`, `OST`, `SIGA`, `cantidad_eventos`, `numero_servicio`, `detalle`, `fecha_hora_apertura`, `fecha_hora_cierre`, `tiempo_total`, `peso_total`, `usuario_asignado`, `usuario_asignador`, `usuario_cierra`, `id_Act`, `id_Estado_Reg_Act`, `id_Grupo_Reg`) VALUES
(49, '2019-000049', 567, 987, 2, 1234, 'Llamar al cliente.', '2019-12-13 11:05:28', NULL, NULL, '0', 503490441, 503510142, NULL, 501, 71, NULL),
(50, '2019-000050', 999, 877, 2, 343324, 'Llamar al cliente.', '2019-12-13 11:05:54', NULL, NULL, '0', 502790419, 503510142, NULL, 505, 71, NULL),
(59, '2019-000059', NULL, NULL, 1, NULL, NULL, '2019-12-13 14:57:52', NULL, NULL, '1.25', 502790419, 503510142, NULL, 506, 71, NULL),
(62, '2019-000062', 432, 456, 1, 26694030, 'Instalación urgente.', '2019-12-13 16:27:49', NULL, NULL, '1.00', 503490441, 503510142, NULL, 502, 71, NULL),
(91, '2019-000091', 765, 987, 1, 1786443, 'AYA.', '2019-12-19 16:47:07', NULL, NULL, '2.50', 502800586, 503510142, NULL, 505, 71, NULL),
(98, '2019-000098', 4433, 332, 2, 222, 'INS Liberia Gte.', '2019-12-26 08:33:54', NULL, NULL, '1.42', 602840387, 503510142, NULL, 501, 71, NULL),
(117, '2019-000117', 111, 222, 2, 333, 'MSAN', '2019-12-26 17:18:23', NULL, NULL, '1.42', 502030089, 503510142, NULL, 501, 71, NULL),
(122, '2019-000122', NULL, NULL, 2, NULL, 'Despacho', '2019-12-26 18:30:48', NULL, NULL, '1.12', 113430700, 503510142, NULL, 508, 71, NULL),
(123, '2019-000123', NULL, NULL, 2, NULL, 'Despacho', '2019-12-26 18:30:48', NULL, NULL, '1.12', 110760527, 503510142, NULL, 508, 71, NULL),
(126, '2019-000126', NULL, NULL, 3, NULL, 'Despacho', '2019-12-26 18:39:46', NULL, NULL, '1.68', 113430700, 503510142, NULL, 508, 71, 1),
(127, '2019-000127', NULL, NULL, 3, NULL, 'Despacho', '2019-12-26 18:39:46', NULL, NULL, '1.68', 503030145, 503510142, NULL, 508, 71, 1),
(128, '2019-000128', NULL, NULL, 3, NULL, 'Despacho', '2019-12-26 18:39:46', NULL, NULL, '1.68', 110760527, 503510142, NULL, 508, 71, 1),
(129, '2019-000129', NULL, NULL, 1, NULL, 'Prueba', '2019-12-26 18:42:37', NULL, NULL, '2.50', 502800586, 503510142, NULL, 505, 71, 2),
(130, '2019-000130', NULL, NULL, 1, NULL, 'Prueba', '2019-12-26 18:42:37', NULL, NULL, '2.50', 502790419, 503510142, NULL, 505, 71, 2),
(132, '2020-000002', 66675, 778765, 4, 546545, 'Nicoya, llamar al cliente.', '2020-01-06 09:46:01', NULL, NULL, '2.84', 602840387, 503510142, NULL, 501, 71, 3),
(134, '2020-000004', 66675, 778765, 4, 546545, 'Nicoya, llamar al cliente.', '2020-01-06 09:46:01', NULL, NULL, '2.84', 503490441, 503510142, NULL, 501, 71, 3),
(135, '2020-000005', 8887, 78798, 2, 898989, 'Prueba', '2020-01-06 13:09:34', NULL, NULL, '1.42', 503490441, 503510142, NULL, 501, 71, NULL),
(136, '2020-000006', NULL, NULL, 1, NULL, 'Prueba', '2020-01-06 13:27:59', NULL, NULL, '0.56', 602840387, 503510142, NULL, 507, 71, 4),
(137, '2020-000007', NULL, NULL, 1, NULL, 'Prueba', '2020-01-06 13:27:59', NULL, NULL, '0.56', 110760527, 503510142, NULL, 507, 71, 4),
(138, '2020-000008', NULL, NULL, 1, NULL, 'Prueba', '2020-01-06 13:27:59', NULL, NULL, '0.56', 503490441, 503510142, NULL, 507, 71, 4);

--
-- Triggers `reg_act`
--
DELIMITER $$
CREATE TRIGGER `custom_autonums_bi` BEFORE INSERT ON `reg_act` FOR EACH ROW BEGIN
   SET NEW.consecutivo = getNextCustomSeq(year(now()),year(now()));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reg_act_agrupados`
--

CREATE TABLE `reg_act_agrupados` (
  `id_Grupo_Reg` int(11) NOT NULL,
  `consecutivos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reg_act_agrupados`
--

INSERT INTO `reg_act_agrupados` (`id_Grupo_Reg`, `consecutivos`) VALUES
(1, '[126,127,128]'),
(2, '[129,130]'),
(3, '[132,134]'),
(4, '[136,137,138]');

-- --------------------------------------------------------

--
-- Table structure for table `reg_act_cerrados`
--

CREATE TABLE `reg_act_cerrados` (
  `id_Reg_Act` int(11) NOT NULL,
  `consecutivo` varchar(20) DEFAULT NULL,
  `OST` int(11) DEFAULT NULL,
  `SIGA` int(11) DEFAULT NULL,
  `cantidad_eventos` int(11) DEFAULT NULL,
  `numero_servicio` int(11) DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL,
  `fecha_hora_apertura` datetime DEFAULT NULL,
  `fecha_hora_cierre` datetime DEFAULT NULL,
  `tiempo_total` varchar(50) DEFAULT NULL,
  `peso_total` varchar(11) DEFAULT NULL,
  `usuario_asignado` int(11) DEFAULT NULL,
  `usuario_asignador` int(11) DEFAULT NULL,
  `usuario_cierra` int(11) DEFAULT NULL,
  `id_Act` int(11) DEFAULT NULL,
  `id_Estado_Reg_Act` int(11) DEFAULT NULL,
  `id_Grupo_Reg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reg_act_cerrados`
--

INSERT INTO `reg_act_cerrados` (`id_Reg_Act`, `consecutivo`, `OST`, `SIGA`, `cantidad_eventos`, `numero_servicio`, `detalle`, `fecha_hora_apertura`, `fecha_hora_cierre`, `tiempo_total`, `peso_total`, `usuario_asignado`, `usuario_asignador`, `usuario_cierra`, `id_Act`, `id_Estado_Reg_Act`, `id_Grupo_Reg`) VALUES
(39, '2019-000039', 12, 34, 2, 1768975, 'Intalación Nueva ok', '2019-12-13 08:32:10', '2019-12-19 13:16:48', '6 días, 4 horas, 44 minutos', '1.42', 503490441, 503510142, 503510142, 501, 72, NULL),
(40, '2019-000040', 22, 33, 1, 4567, 'Orden Empresarial', '2019-12-13 08:32:52', '2019-12-19 16:26:50', '6 días, 7 horas, 53 minutos', '2.50', 108540222, 503510142, 503510142, 505, 72, NULL),
(41, '2019-000041', 450, 560, 50, 17685640, 'Varias Ordenes Ejecutadas', '2019-12-13 08:34:17', '2019-12-19 12:47:11', '6 días, 4 horas, 12 minutos', '35.50', 602840387, 503510142, 503510142, 501, 72, NULL),
(42, '2019-000042', 450, 560, 50, 17685640, 'Varias Ordenes Ejecutadas', '2019-12-13 08:34:17', '2019-12-19 12:47:11', '6 días, 4 horas, 12 minutos', '35.50', 502790419, 503510142, 503510142, 501, 72, NULL),
(43, '2019-000043', 450, 560, 50, 17685640, 'Varias Ordenes Ejecutadas', '2019-12-13 08:34:17', '2019-12-19 12:47:11', '6 días, 4 horas, 12 minutos', '35.50', 503490441, 503510142, 503510142, 501, 72, NULL),
(44, '2019-000044', NULL, NULL, 2, 26690202, 'Prueba Completa', '2019-12-13 10:13:02', '2019-12-26 08:37:14', '12 días, 22 horas, 24 minutos', '5.00', 104650901, 503510142, 503510142, 505, 72, NULL),
(45, '2019-000045', NULL, NULL, 1, NULL, 'Prueba.', '2019-12-13 10:14:03', '2019-12-19 13:15:25', '6 días, 3 horas, 1 minuto', '0.71', 303560808, 503510142, 503510142, 501, 72, NULL),
(46, '2019-000046', NULL, NULL, 1, NULL, 'Empresarial', '2019-12-13 10:14:53', '2019-12-26 07:45:52', '12 días, 21 horas, 30 minutos', '2.50', 502800586, 503510142, 503510142, 505, 72, NULL),
(47, '2019-000047', NULL, NULL, 2, NULL, 'Reunión', '2019-12-13 10:17:09', '2020-01-17 11:12:49', '1 mes, 4 días, 55 minutos', '1.12', 110760527, 503510142, 503510142, 508, 72, NULL),
(48, '2019-000048', NULL, NULL, 3, NULL, 'N1', '2019-12-13 10:55:17', '2019-12-26 10:17:51', '12 días, 23 horas, 22 minutos', '1.68', 104650901, 503510142, 503510142, 508, 72, NULL),
(51, '2019-000051', 333, 65433, 1, 666, 'Mucha afectación.', '2019-12-13 11:06:24', '2019-12-19 13:03:36', '6 días, 1 hora, 57 minutos', '4.50', 502800586, 503510142, 503510142, 503, 72, NULL),
(52, '2019-000052', 333, 65433, 1, 666, 'Mucha afectación.', '2019-12-13 11:06:24', '2019-12-19 13:03:36', '6 días, 1 hora, 57 minutos', '4.50', 112060215, 503510142, 503510142, 503, 72, NULL),
(53, '2019-000053', 333, 65433, 1, 666, 'Mucha afectación.', '2019-12-13 11:06:24', '2019-12-19 13:03:36', '6 días, 1 hora, 57 minutos', '4.50', 113610705, 503510142, 503510142, 503, 72, NULL),
(55, '2019-000055', NULL, NULL, 1, NULL, 'Instalación.', '2019-12-13 12:45:27', '2019-12-19 16:32:43', '6 días, 3 horas, 47 minutos', '0.71', 502030089, 503510142, 503510142, 501, 72, NULL),
(56, '2019-000056', NULL, NULL, 3, NULL, 'Curso Calix.', '2019-12-13 12:46:53', '2019-12-19 13:14:54', '6 días, 28 minutos', '1.68', 113430700, 503510142, 503510142, 507, 72, NULL),
(57, '2019-000057', NULL, NULL, 3, NULL, 'Curso Calix.', '2019-12-13 12:46:53', '2019-12-19 13:14:54', '6 días, 28 minutos', '1.68', 503030145, 503510142, 503510142, 507, 72, NULL),
(58, '2019-000058', NULL, NULL, 3, NULL, 'Curso Calix.', '2019-12-13 12:46:53', '2019-12-19 13:14:54', '6 días, 28 minutos', '1.68', 110760527, 503510142, 503510142, 507, 72, NULL),
(64, '2019-000064', 1, 2, 1, 3, 'Tramo Cañas-Limonal', '2019-12-13 16:29:56', '2019-12-19 14:56:44', '5 días, 22 horas, 26 minutos', '3.00', 108540222, 503510142, 503510142, 504, 72, NULL),
(65, '2019-000065', 1, 2, 1, 3, 'Tramo Cañas-Limonal', '2019-12-13 16:29:56', '2019-12-19 14:56:44', '5 días, 22 horas, 26 minutos', '3.00', 502270412, 503510142, 503510142, 504, 72, NULL),
(66, '2019-000066', 1, 2, 1, 3, 'Tramo Cañas-Limonal', '2019-12-13 16:29:56', '2019-12-19 14:56:44', '5 días, 22 horas, 26 minutos', '3.00', 503570411, 503510142, 503510142, 504, 72, NULL),
(67, '2019-000067', NULL, NULL, 4, NULL, 'Capacitación Siemens y Calix.', '2019-12-13 16:34:16', '2019-12-19 16:28:28', '5 días, 23 horas, 54 minutos', '2.24', 113430700, 503510142, 503510142, 507, 72, NULL),
(68, '2019-000068', NULL, NULL, 4, NULL, 'Capacitación Siemens y Calix.', '2019-12-13 16:34:16', '2019-12-19 16:28:28', '5 días, 23 horas, 54 minutos', '2.24', 503030145, 503510142, 503510142, 507, 72, NULL),
(69, '2019-000069', NULL, NULL, 4, NULL, 'Capacitación Siemens y Calix.', '2019-12-13 16:34:16', '2019-12-19 16:28:28', '5 días, 23 horas, 54 minutos', '2.24', 110760527, 503510142, 503510142, 507, 72, NULL),
(70, '2019-000070', 23801, 103331, 1, 26683761, 'Prueba', '2019-12-13 16:52:24', '2019-12-19 12:33:05', '200', '201', 503510142, 503510142, 503510142, 501, 72, NULL),
(71, '2019-000071', 9800, 103987, 1, 26594030, 'Llamar al cliente.', '2019-12-17 10:47:32', '2019-12-19 13:16:19', '2 días, 2 horas, 28 minutos', '1.00', 502880630, 503510142, 503510142, 502, 72, NULL),
(72, '2019-000072', 555, 666, 1, 17888888, 'Cliente Dos Pinos', '2019-12-17 12:59:11', '2019-12-19 13:00:12', '2 días, 1 minuto', '1.25', 113610705, 503510142, 503510142, 506, 72, NULL),
(73, '2019-000073', 65899, 103899, 1, 17654321, 'Cliente BCR Cañas. Ok', '2019-12-17 15:39:55', '2019-12-19 12:55:52', '1 día, 21 horas, 15 minutos', '2.50', 502800586, 503510142, 503510142, 505, 72, NULL),
(74, '2019-000074', 65899, 103899, 1, 17654321, 'Cliente BCR Cañas. Ok', '2019-12-17 15:39:55', '2019-12-19 12:55:52', '1 día, 21 horas, 15 minutos', '2.50', 502790419, 503510142, 503510142, 505, 72, NULL),
(75, '2019-000075', 4354, 4354, 2, 764567, 'Prueba Update 5', '2019-12-17 18:56:02', '2019-12-19 14:51:54', '1 día, 19 horas, 55 minutos', '6.00', 603130914, 503510142, 503510142, 504, 72, NULL),
(76, '2019-000076', 4354, 4354, 2, 764567, 'Prueba Update 5', '2019-12-17 18:56:02', '2019-12-19 14:51:54', '1 día, 19 horas, 55 minutos', '6.00', 502080179, 503510142, 503510142, 504, 72, NULL),
(77, '2019-000077', 4354, 4354, 2, 764567, 'Prueba Update 5', '2019-12-17 18:56:02', '2019-12-19 14:51:54', '1 día, 19 horas, 55 minutos', '6.00', 104650901, 503510142, 503510142, 504, 72, NULL),
(78, '2019-000078', 777, 8888, 1, 9999, 'Instalación MSAN.', '2019-12-19 11:42:57', '2019-12-19 13:02:46', '1 hora, 19 minutos', '0.71', 602840387, 503510142, 503510142, 501, 72, NULL),
(79, '2019-000079', 3, 3, 3, 3, 'Prueba Update 3', '2019-12-19 12:35:12', '2019-12-19 12:44:30', '9 minutos', '1.68', 503510142, 503510142, 503510142, 507, 72, NULL),
(80, '2019-000080', 123, 123, 1, 321, 'Prueba 1', '2019-12-19 14:29:07', '2019-12-19 14:33:55', '4 minutos', '0.71', 602840387, 503510142, 503510142, 501, 72, NULL),
(81, '2019-000081', NULL, NULL, 1, NULL, NULL, '2019-12-19 14:31:07', '2019-12-19 14:36:30', '5 minutos', '2.50', 502790419, 503510142, 503510142, 505, 72, NULL),
(82, '2019-000082', 4300, 3400, 1, 26802390, 'Linea de la Escuela.', '2019-12-19 14:35:11', '2019-12-19 14:36:27', '1 minuto', '1.00', 502030089, 503510142, 503510142, 502, 72, NULL),
(83, '2019-000083', 2345, 5432, 2, 26563040, 'Urge.', '2019-12-19 14:37:25', '2019-12-19 14:44:14', '6 minutos', '2.00', 502030089, 503510142, 503510142, 502, 72, NULL),
(84, '2019-000084', NULL, NULL, 1, NULL, NULL, '2019-12-19 14:38:20', '2019-12-19 14:44:20', '6 minutos', '4.50', 108540222, 503510142, 503510142, 503, 72, NULL),
(85, '2019-000085', NULL, NULL, 1, NULL, NULL, '2019-12-19 14:43:24', '2019-12-19 15:55:33', '1 hora, 12 minutos', '1.25', 502080179, 503510142, 503510142, 506, 72, NULL),
(86, '2019-000086', NULL, NULL, 4, NULL, 'Reunión Despacho.', '2019-12-19 16:29:38', '2019-12-19 16:49:57', '20 minutos', '2.24', 113430700, 503510142, 503510142, 508, 72, NULL),
(87, '2019-000087', NULL, NULL, 4, NULL, 'Reunión Despacho.', '2019-12-19 16:29:38', '2019-12-19 16:49:57', '20 minutos', '2.24', 503030145, 503510142, 503510142, 508, 72, NULL),
(88, '2019-000088', NULL, NULL, 4, NULL, 'Reunión Despacho.', '2019-12-19 16:29:38', '2019-12-19 16:49:57', '20 minutos', '2.24', 110760527, 503510142, 503510142, 508, 72, NULL),
(89, '2019-000089', 444, 5555, 3, 17654323, 'Barrio Las Palmas.', '2019-12-19 16:46:36', '2019-12-26 09:20:54', '6 días, 16 horas, 34 minutos', '2.13', 602840387, 503510142, 503510142, 501, 72, NULL),
(90, '2019-000090', 444, 5555, 3, 17654323, 'Barrio Las Palmas.', '2019-12-19 16:46:36', '2019-12-26 09:20:54', '6 días, 16 horas, 34 minutos', '2.13', 503490441, 503510142, 503510142, 501, 72, NULL),
(115, '2019-000115', 54656, 445, 2, 444, 'Inst. en Nicoya', '2019-12-26 17:17:53', '2019-12-26 17:29:02', '11 minutos', '5.00', 502790419, 503510142, 503510142, 505, 72, NULL),
(131, '2020-000001', NULL, NULL, 2, NULL, 'Reunión con N1', '2020-01-06 09:44:36', '2020-01-06 13:08:07', '3 horas, 23 minutos', '1.12', 503510142, 503510142, 503510142, 508, 72, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reg_act_eliminados`
--

CREATE TABLE `reg_act_eliminados` (
  `id_Reg_Act` int(11) NOT NULL,
  `consecutivo` varchar(20) DEFAULT NULL,
  `OST` int(11) DEFAULT NULL,
  `SIGA` int(11) DEFAULT NULL,
  `cantidad_eventos` int(11) DEFAULT NULL,
  `numero_servicio` int(11) DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL,
  `fecha_hora_apertura` datetime DEFAULT NULL,
  `fecha_hora_cierre` datetime DEFAULT NULL,
  `tiempo_total` varchar(50) DEFAULT NULL,
  `peso_total` varchar(11) DEFAULT NULL,
  `usuario_asignado` int(11) DEFAULT NULL,
  `usuario_asignador` int(11) DEFAULT NULL,
  `usuario_cierra` int(11) DEFAULT NULL,
  `id_Act` int(11) DEFAULT NULL,
  `id_Estado_Reg_Act` int(11) DEFAULT NULL,
  `id_Grupo_Reg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reg_act_eliminados`
--

INSERT INTO `reg_act_eliminados` (`id_Reg_Act`, `consecutivo`, `OST`, `SIGA`, `cantidad_eventos`, `numero_servicio`, `detalle`, `fecha_hora_apertura`, `fecha_hora_cierre`, `tiempo_total`, `peso_total`, `usuario_asignado`, `usuario_asignador`, `usuario_cierra`, `id_Act`, `id_Estado_Reg_Act`, `id_Grupo_Reg`) VALUES
(54, '2019-000054', NULL, NULL, 1, NULL, 'Prueba', '2019-12-13 12:35:46', '2019-12-26 17:03:45', '13 días, 4 horas, 27 minutos', NULL, 108540222, 503510142, 503510142, 502, 73, NULL),
(63, '2019-000063', NULL, NULL, 2, NULL, 'Reunión con N1', '2019-12-13 16:28:58', '2019-12-26 15:55:07', '12 días, 23 horas, 26 minutos', '1.12', 110760527, 503510142, 503510142, 508, 73, NULL),
(92, '2019-000092', NULL, 103450, 1, NULL, 'Afectación de Internet.', '2019-12-19 16:48:11', '2019-12-26 16:29:54', '6 días, 23 horas, 41 minutos', '3.00', 108520766, 503510142, 503510142, 504, 73, NULL),
(93, '2019-000093', NULL, 103450, 1, NULL, 'Afectación de Internet.', '2019-12-19 16:48:11', '2019-12-26 16:28:58', '6 días, 23 horas, 40 minutos', '3.00', 502270412, 503510142, 503510142, 504, 73, NULL),
(94, '2019-000094', NULL, 103450, 1, NULL, 'Afectación de Internet.', '2019-12-19 16:48:11', '2019-12-26 16:29:54', '6 días, 23 horas, 41 minutos', '3.00', 503570411, 503510142, 503510142, 504, 73, NULL),
(95, '2019-000095', NULL, NULL, 5, NULL, 'GPON', '2019-12-19 16:48:43', '2019-12-26 15:58:45', '6 días, 23 horas, 10 minutos', '2.80', 113430700, 503510142, 503510142, 507, 73, NULL),
(96, '2019-000096', NULL, NULL, 5, NULL, 'GPON', '2019-12-19 16:48:43', '2019-12-26 15:58:45', '6 días, 23 horas, 10 minutos', '2.80', 503030145, 503510142, 503510142, 507, 73, NULL),
(97, '2019-000097', NULL, NULL, 5, NULL, 'GPON', '2019-12-19 16:48:43', '2019-12-26 15:58:45', '6 días, 23 horas, 10 minutos', '2.80', 110760527, 503510142, 503510142, 507, 73, NULL),
(99, '2019-000099', NULL, NULL, 1, NULL, 'Avería grave.', '2019-12-26 08:34:33', '2019-12-26 17:05:19', '8 horas, 30 minutos', '4.50', 502270412, 503510142, 503510142, 503, 73, NULL),
(100, '2019-000100', NULL, NULL, 1, NULL, 'Avería grave.', '2019-12-26 08:34:33', '2019-12-26 17:04:29', '8 horas, 29 minutos', '4.50', 502800586, 503510142, 503510142, 503, 73, NULL),
(101, '2019-000101', NULL, NULL, 1, NULL, 'Avería grave.', '2019-12-26 08:34:33', '2019-12-26 17:09:46', '8 horas, 35 minutos', '4.50', 502790419, 503510142, 503510142, 503, 73, NULL),
(102, '2019-000102', 5667, 8788, 2, 444, 'Prueba Eliminación.', '2019-12-26 16:49:58', '2019-12-26 17:09:58', '20 minutos', '1.42', 602840387, 503510142, 503510142, 501, 73, NULL),
(103, '2019-000103', 5667, 8788, 2, 444, 'Prueba Eliminación.', '2019-12-26 16:49:58', '2019-12-26 16:50:23', '25 segundos', '1.42', 503490441, 503510142, 503510142, 501, 73, NULL),
(104, '2019-000104', NULL, NULL, 4, NULL, 'Prueba Eliminado.', '2019-12-26 17:11:08', '2019-12-26 17:12:13', '1 minuto', '2.24', 503510142, 503510142, 503510142, 507, 73, NULL),
(105, '2019-000105', NULL, NULL, 1, NULL, 'Prueba eliminado grupo-', '2019-12-26 17:11:41', '2019-12-26 17:15:39', '3 minutos', '4.50', 602840387, 503510142, 503510142, 503, 73, NULL),
(106, '2019-000106', NULL, NULL, 1, NULL, 'Prueba eliminado grupo-', '2019-12-26 17:11:41', '2019-12-26 17:12:43', '1 minuto', '4.50', 502790419, 503510142, 503510142, 503, 73, NULL),
(107, '2019-000107', NULL, NULL, 1, NULL, 'Prueba eliminado grupo-', '2019-12-26 17:11:41', '2019-12-26 17:13:08', '1 minuto', '4.50', 503490441, 503510142, 503510142, 503, 73, NULL),
(108, '2019-000108', NULL, NULL, 6, NULL, 'Calix', '2019-12-26 17:16:24', '2019-12-26 18:36:41', '1 hora, 20 minutos', '3.36', 113430700, 503510142, 503510142, 507, 73, NULL),
(109, '2019-000109', NULL, NULL, 6, NULL, 'Calix', '2019-12-26 17:16:24', '2019-12-26 18:36:41', '1 hora, 20 minutos', '3.36', 503030145, 503510142, 503510142, 507, 73, NULL),
(110, '2019-000110', NULL, NULL, 6, NULL, 'Calix', '2019-12-26 17:16:24', '2019-12-26 18:36:41', '1 hora, 20 minutos', '3.36', 110760527, 503510142, 503510142, 507, 73, NULL),
(111, '2019-000111', NULL, NULL, 3, NULL, 'Reunión N1', '2019-12-26 17:16:49', '2019-12-26 17:27:04', '10 minutos', '1.68', 113430700, 503510142, 503510142, 508, 73, NULL),
(112, '2019-000112', NULL, NULL, 3, NULL, 'Reunión N1', '2019-12-26 17:16:49', '2019-12-26 17:27:04', '10 minutos', '1.68', 503030145, 503510142, 503510142, 508, 73, NULL),
(113, '2019-000113', NULL, NULL, 3, NULL, 'Reunión N1', '2019-12-26 17:16:49', '2019-12-26 17:27:04', '10 minutos', '1.68', 110760527, 503510142, 503510142, 508, 73, NULL),
(114, '2019-000114', 54656, 445, 2, 444, 'Inst. en Nicoya', '2019-12-26 17:17:53', '2019-12-26 17:25:20', '7 minutos', '5.00', 502800586, 503510142, 503510142, 505, 73, NULL),
(116, '2019-000116', 54656, 445, 2, 444, 'Inst. en Nicoya', '2019-12-26 17:17:53', '2019-12-26 17:24:29', '6 minutos', '5.00', 113610705, 503510142, 503510142, 505, 73, NULL),
(118, '2019-000118', 556, 7776, 2, 444, 'Samara', '2019-12-26 17:18:49', '2019-12-26 17:21:10', '2 minutos', '2.00', 502880630, 503510142, 503510142, 502, 73, NULL),
(119, '2019-000119', NULL, NULL, 1, NULL, 'Ciudad Carmona', '2019-12-26 17:19:32', '2019-12-26 18:36:36', '1 hora, 17 minutos', '4.50', 502270412, 503510142, 503510142, 503, 73, NULL),
(120, '2019-000120', NULL, NULL, 1, NULL, 'Ciudad Carmona', '2019-12-26 17:19:32', '2019-12-26 18:36:36', '1 hora, 17 minutos', '4.50', 113430700, 503510142, 503510142, 503, 73, NULL),
(121, '2019-000121', NULL, NULL, 1, NULL, 'Ciudad Carmona', '2019-12-26 17:19:32', '2019-12-26 18:36:36', '1 hora, 17 minutos', '4.50', 112060215, 503510142, 503510142, 503, 73, NULL),
(124, '2019-000124', NULL, NULL, 1, NULL, 'xxxasasa', '2019-12-26 18:34:15', '2019-12-26 18:36:25', '2 minutos', '1.00', 602840387, 503510142, 503510142, 502, 73, NULL),
(125, '2019-000125', NULL, NULL, 1, NULL, 'xxxasasa', '2019-12-26 18:34:15', '2019-12-26 18:36:25', '2 minutos', '1.00', 503490441, 503510142, 503510142, 502, 73, NULL),
(133, '2020-000003', 66675, 778765, 4, 546545, 'Nicoya, llamar al cliente.', '2020-01-06 09:46:01', '2020-01-06 13:07:16', '3 horas, 21 minutos', '4.00', 502880630, 503510142, 503510142, 502, 73, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_Rol` int(11) NOT NULL,
  `nombre_Rol` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_Rol`, `nombre_Rol`) VALUES
(301, 'Vista'),
(302, 'Tecnico'),
(303, 'Operador'),
(304, 'Administrador'),
(305, 'Super');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre1` varchar(30) DEFAULT NULL,
  `nombre2` varchar(30) DEFAULT NULL,
  `apellido1` varchar(30) DEFAULT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `id_Zona` int(11) DEFAULT NULL,
  `id_Rol` int(11) DEFAULT NULL,
  `id_Estado` int(11) DEFAULT NULL,
  `id_Area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `codigo`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `email`, `telefono`, `password`, `id_Zona`, `id_Rol`, `id_Estado`, `id_Area`) VALUES
(104650901, 104650901, 'Sergio', '', 'Arguello', 'Bejarano', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 103, 301, 51, 202),
(108520766, 108520766, 'Jesús', 'Alberto', 'Calvo', 'Soto', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 101, 301, 51, 202),
(108540222, 108540222, 'Jesús', NULL, 'Alpizar', 'Castro', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 103, 301, 51, 203),
(110760527, 110760527, 'Tamara', NULL, 'Hoffmaister', 'Ghiraldini', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 103, 303, 51, 204),
(112060215, 112060215, 'Luis', 'Diego', 'Rodriguez', 'Fajardo', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 102, 301, 51, 202),
(113430700, 113430700, 'Luis', 'Angel', 'Gómez', 'Gómez', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 102, 303, 51, 204),
(113610705, 113610705, 'Francisco', 'Javier', 'Sibaja', 'Matarrita', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 102, 301, 51, 203),
(203740604, 203740604, 'Edwin', NULL, 'Araya', 'Castro', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 103, 301, 51, 202),
(303560808, 303560808, 'Danny', 'Alberto', 'Allan', 'Soto', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 103, 301, 51, 201),
(502030089, 502030089, 'Paulo', NULL, 'Atán', 'Chacón', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 102, 301, 51, 201),
(502080179, 502080179, 'Delmer', NULL, 'Alvarez', 'Rosales', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 103, 301, 51, 203),
(502270412, 502270412, 'Martin', NULL, 'Dávila', 'Canales', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 101, 301, 51, 202),
(502790419, 502790419, 'Reindel', 'Javier', 'Quintero', 'Arias', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 101, 301, 51, 203),
(502800586, 502800586, 'Didier', NULL, 'Mayorga', 'Esquivel', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 101, 301, 51, 203),
(502880630, 502880630, 'Iener', 'Francisco', 'Obando', 'Gutiérrez', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 102, 301, 51, 201),
(503030145, 503030145, 'Gerssan', 'De Jesús', 'Gonzaga', 'López', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 101, 303, 51, 204),
(503170025, 503170025, 'Henry', 'Mauricio', 'García', 'Jimenez', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 102, 301, 51, 203),
(503490441, 503490441, 'Bryan', 'Antonio', 'Soto', 'Herrera', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 101, 301, 51, 201),
(503510142, 204, 'Mac', 'Donald', 'Bravo', 'Barahona', 'mbravob@hotmail.com', 83358713, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 101, 305, 51, 204),
(503570411, 503570411, 'Josué', 'Manuel', 'Díaz', 'Díaz', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 102, 301, 51, 202),
(602840387, 602840387, 'Iván', 'Alexis', 'Alfaro', 'Mora', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 101, 301, 51, 201),
(603130914, 603130914, 'Christian', 'Gerardo', 'Alfaro', 'Mora', 'correo@ice.go.cr', 88998899, '$2y$12$dYFdhZqjH.L69KcI8E2miu/CEL.Iy433VuwEecFFKi8IgQJ15xPAm', 103, 301, 51, 201);

-- --------------------------------------------------------

--
-- Table structure for table `zonas`
--

CREATE TABLE `zonas` (
  `id_Zona` int(11) NOT NULL,
  `nombre_Zona` varchar(30) DEFAULT NULL,
  `id_Region` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zonas`
--

INSERT INTO `zonas` (`id_Zona`, `nombre_Zona`, `id_Region`) VALUES
(101, 'Liberia', 1),
(102, 'Nicoya', 1),
(103, 'Barranca', 1);

-- --------------------------------------------------------

--
-- Table structure for table `_sequence`
--

CREATE TABLE `_sequence` (
  `seq_name` varchar(50) NOT NULL,
  `seq_group` varchar(10) NOT NULL,
  `seq_val` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_sequence`
--

INSERT INTO `_sequence` (`seq_name`, `seq_group`, `seq_val`) VALUES
('2019', '2019', 130),
('2020', '2020', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_Act`),
  ADD KEY `FK` (`id_Area`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_Area`);

--
-- Indexes for table `estados_reg_act`
--
ALTER TABLE `estados_reg_act`
  ADD PRIMARY KEY (`id_Estado_Reg_Act`);

--
-- Indexes for table `estado_usuario`
--
ALTER TABLE `estado_usuario`
  ADD PRIMARY KEY (`id_Estado`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_Log`),
  ADD KEY `FK` (`usuario`);

--
-- Indexes for table `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`id_Region`);

--
-- Indexes for table `reg_act`
--
ALTER TABLE `reg_act`
  ADD PRIMARY KEY (`id_Reg_Act`),
  ADD KEY `regAct_Act` (`id_Act`),
  ADD KEY `regAct_Estado` (`id_Estado_Reg_Act`),
  ADD KEY `regAct_Grupo` (`id_Grupo_Reg`),
  ADD KEY `FK` (`usuario_asignado`,`usuario_asignador`,`id_Act`,`id_Estado_Reg_Act`,`id_Grupo_Reg`,`usuario_cierra`) USING BTREE,
  ADD KEY `regAct_usuarioAsignador` (`usuario_asignador`),
  ADD KEY `regAct_usuarioCierra` (`usuario_cierra`);

--
-- Indexes for table `reg_act_agrupados`
--
ALTER TABLE `reg_act_agrupados`
  ADD PRIMARY KEY (`id_Grupo_Reg`);

--
-- Indexes for table `reg_act_cerrados`
--
ALTER TABLE `reg_act_cerrados`
  ADD PRIMARY KEY (`id_Reg_Act`),
  ADD KEY `regAct_Act` (`id_Act`),
  ADD KEY `regAct_Estado` (`id_Estado_Reg_Act`),
  ADD KEY `regAct_Grupo` (`id_Grupo_Reg`),
  ADD KEY `FK` (`usuario_asignado`,`usuario_asignador`,`id_Act`,`id_Estado_Reg_Act`,`id_Grupo_Reg`,`usuario_cierra`) USING BTREE,
  ADD KEY `regAct_usuarioAsignador` (`usuario_asignador`),
  ADD KEY `regAct_usuarioCierra` (`usuario_cierra`);

--
-- Indexes for table `reg_act_eliminados`
--
ALTER TABLE `reg_act_eliminados`
  ADD PRIMARY KEY (`id_Reg_Act`),
  ADD KEY `regAct_Act` (`id_Act`),
  ADD KEY `regAct_Estado` (`id_Estado_Reg_Act`),
  ADD KEY `regAct_Grupo` (`id_Grupo_Reg`),
  ADD KEY `FK` (`usuario_asignado`,`usuario_asignador`,`id_Act`,`id_Estado_Reg_Act`,`id_Grupo_Reg`,`usuario_cierra`) USING BTREE,
  ADD KEY `regAct_usuarioAsignador` (`usuario_asignador`),
  ADD KEY `regAct_usuarioCierra` (`usuario_cierra`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_Rol`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `FK` (`id_Zona`,`id_Rol`,`id_Estado`,`id_Area`),
  ADD KEY `usuario_rol` (`id_Rol`),
  ADD KEY `usuario_estado` (`id_Estado`),
  ADD KEY `usuario_area` (`id_Area`);

--
-- Indexes for table `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id_Zona`),
  ADD KEY `FK` (`id_Region`);

--
-- Indexes for table `_sequence`
--
ALTER TABLE `_sequence`
  ADD PRIMARY KEY (`seq_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id_Act` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=509;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id_Area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `estados_reg_act`
--
ALTER TABLE `estados_reg_act`
  MODIFY `id_Estado_Reg_Act` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `estado_usuario`
--
ALTER TABLE `estado_usuario`
  MODIFY `id_Estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_Log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regiones`
--
ALTER TABLE `regiones`
  MODIFY `id_Region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reg_act`
--
ALTER TABLE `reg_act`
  MODIFY `id_Reg_Act` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `reg_act_agrupados`
--
ALTER TABLE `reg_act_agrupados`
  MODIFY `id_Grupo_Reg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id_Zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `act_area` FOREIGN KEY (`id_Area`) REFERENCES `areas` (`id_Area`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`cedula`);

--
-- Constraints for table `reg_act`
--
ALTER TABLE `reg_act`
  ADD CONSTRAINT `regAct_Act` FOREIGN KEY (`id_Act`) REFERENCES `actividades` (`id_Act`),
  ADD CONSTRAINT `regAct_Estado` FOREIGN KEY (`id_Estado_Reg_Act`) REFERENCES `estados_reg_act` (`id_Estado_Reg_Act`),
  ADD CONSTRAINT `regAct_Grupo` FOREIGN KEY (`id_Grupo_Reg`) REFERENCES `reg_act_agrupados` (`id_Grupo_Reg`),
  ADD CONSTRAINT `regAct_usuarioAsignado` FOREIGN KEY (`usuario_asignado`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `regAct_usuarioAsignador` FOREIGN KEY (`usuario_asignador`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `regAct_usuarioCierra` FOREIGN KEY (`usuario_cierra`) REFERENCES `usuarios` (`cedula`);

--
-- Constraints for table `reg_act_cerrados`
--
ALTER TABLE `reg_act_cerrados`
  ADD CONSTRAINT `reg_act_cerrados_ibfk_1` FOREIGN KEY (`id_Act`) REFERENCES `actividades` (`id_Act`),
  ADD CONSTRAINT `reg_act_cerrados_ibfk_2` FOREIGN KEY (`id_Estado_Reg_Act`) REFERENCES `estados_reg_act` (`id_Estado_Reg_Act`),
  ADD CONSTRAINT `reg_act_cerrados_ibfk_3` FOREIGN KEY (`id_Grupo_Reg`) REFERENCES `reg_act_agrupados` (`id_Grupo_Reg`),
  ADD CONSTRAINT `reg_act_cerrados_ibfk_4` FOREIGN KEY (`usuario_asignado`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `reg_act_cerrados_ibfk_5` FOREIGN KEY (`usuario_asignador`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `reg_act_cerrados_ibfk_6` FOREIGN KEY (`usuario_cierra`) REFERENCES `usuarios` (`cedula`);

--
-- Constraints for table `reg_act_eliminados`
--
ALTER TABLE `reg_act_eliminados`
  ADD CONSTRAINT `reg_act_eliminados_ibfk_1` FOREIGN KEY (`id_Act`) REFERENCES `actividades` (`id_Act`),
  ADD CONSTRAINT `reg_act_eliminados_ibfk_2` FOREIGN KEY (`id_Estado_Reg_Act`) REFERENCES `estados_reg_act` (`id_Estado_Reg_Act`),
  ADD CONSTRAINT `reg_act_eliminados_ibfk_3` FOREIGN KEY (`id_Grupo_Reg`) REFERENCES `reg_act_agrupados` (`id_Grupo_Reg`),
  ADD CONSTRAINT `reg_act_eliminados_ibfk_4` FOREIGN KEY (`usuario_asignado`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `reg_act_eliminados_ibfk_5` FOREIGN KEY (`usuario_asignador`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `reg_act_eliminados_ibfk_6` FOREIGN KEY (`usuario_cierra`) REFERENCES `usuarios` (`cedula`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuario_area` FOREIGN KEY (`id_Area`) REFERENCES `areas` (`id_Area`),
  ADD CONSTRAINT `usuario_estado` FOREIGN KEY (`id_Estado`) REFERENCES `estado_usuario` (`id_Estado`),
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`id_Rol`) REFERENCES `roles` (`id_Rol`),
  ADD CONSTRAINT `usuario_zonas` FOREIGN KEY (`id_Zona`) REFERENCES `zonas` (`id_Zona`);

--
-- Constraints for table `zonas`
--
ALTER TABLE `zonas`
  ADD CONSTRAINT `zonas_ibfk_1` FOREIGN KEY (`id_Region`) REFERENCES `regiones` (`id_Region`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `mover_reg_cerrados` ON SCHEDULE EVERY 1 MINUTE STARTS '2019-12-19 01:00:00' ON COMPLETION PRESERVE ENABLE COMMENT 'Mover registros cerrados y eliminarlos' DO BEGIN
INSERT INTO reg_act_cerrados SELECT * FROM reg_act WHERE id_Estado_Reg_Act IN (SELECT id_Estado_Reg_Act FROM `estados_reg_act` WHERE estado_Reg_Act = 'Cerrado');
DELETE FROM reg_act WHERE id_Estado_Reg_Act IN (SELECT id_Estado_Reg_Act FROM `estados_reg_act` WHERE estado_Reg_Act = 'Cerrado');
END$$

CREATE DEFINER=`root`@`localhost` EVENT `reset_id_grupos` ON SCHEDULE EVERY 1 MINUTE STARTS '2019-12-26 01:30:00' ON COMPLETION PRESERVE ENABLE COMMENT 'Reiniciar contador de id a 0' DO BEGIN
	IF (SELECT COUNT(*) FROM reg_act_agrupados) = 0
    THEN
    	ALTER TABLE reg_act_agrupados AUTO_INCREMENT = 1;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `mover_reg_eliminados` ON SCHEDULE EVERY 1 MINUTE STARTS '2019-12-26 02:00:00' ON COMPLETION PRESERVE ENABLE COMMENT 'Copia los registros eliminados y los borra de la tabla' DO BEGIN
INSERT INTO reg_act_eliminados SELECT * FROM reg_act WHERE id_Estado_Reg_Act IN (SELECT id_Estado_Reg_Act FROM `estados_reg_act` WHERE estado_Reg_Act = 'Eliminado');
DELETE FROM reg_act WHERE id_Estado_Reg_Act IN (SELECT id_Estado_Reg_Act FROM `estados_reg_act` WHERE estado_Reg_Act = 'Eliminado');
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
