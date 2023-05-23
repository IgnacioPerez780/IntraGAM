-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-05-2019 a las 20:28:31
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ventana`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

DROP TABLE IF EXISTS `archivos`;
CREATE TABLE IF NOT EXISTS `archivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_folio` int(11) NOT NULL,
  `checked` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_folio_id` (`fk_folio`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_comentario` datetime DEFAULT NULL,
  `comentario` longtext,
  `folio` int(11) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `estado1` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `folio` (`folio`),
  KEY `usuario` (`usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_agente`
--

DROP TABLE IF EXISTS `datos_agente`;
CREATE TABLE IF NOT EXISTS `datos_agente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `cua` varchar(12) DEFAULT NULL,
  `correov` varchar(250) DEFAULT NULL,
  `correog` varchar(250) DEFAULT NULL,
  `correoa` varchar(250) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `nomusuario` varchar(50) DEFAULT NULL,
  `id_tipo_usuario` int(11) DEFAULT NULL,
  `id_tipo_agente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  KEY `id_tipo_agente` (`id_tipo_agente`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_agente`
--

INSERT INTO `datos_agente` (`id`, `nombre`, `direccion`, `celular`, `cua`, `correov`, `correog`, `correoa`, `correo`, `password`, `nomusuario`, `id_tipo_usuario`, `id_tipo_agente`) VALUES
(1, 'CABALLERO BLAKE JAVIER', 'PLAZA CARSO', '5512368975', '78945', '', '', '', 'blake.3@hotmail.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'Javier Blake', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_operativos`
--

DROP TABLE IF EXISTS `datos_operativos`;
CREATE TABLE IF NOT EXISTS `datos_operativos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `telefono` int(50) DEFAULT NULL,
  `extension` int(10) DEFAULT NULL,
  `nomusuario` varchar(50) DEFAULT NULL,
  `id_tipo_usuario` int(11) DEFAULT NULL,
  `id_linea_negocio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  KEY `id_linea_negocio` (`id_linea_negocio`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_operativos`
--

INSERT INTO `datos_operativos` (`id`, `nombre`, `correo`, `password`, `telefono`, `extension`, `nomusuario`, `id_tipo_usuario`, `id_linea_negocio`) VALUES
(1, 'HERNANDEZ RODRIGUEZ YADIRA', 'vidayad@hotmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 551880938, 120, 'YadiraBlake', 2, 6),
(2, 'HERNANDEZ MORA CAROLINA', 'caro@hotmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2147483647, 121, 'Caro Hdz', 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`) VALUES
(1, 'PROCESO'),
(2, 'ACTIVADO'),
(3, 'CANCELADO'),
(4, 'TERMINADO'),
(5, 'TERMINADO CON POLIZA'),
(7, 'REPROCESO'),
(6, 'CANCELADO POR AGENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folios`
--

DROP TABLE IF EXISTS `folios`;
CREATE TABLE IF NOT EXISTS `folios` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `negocio` varchar(50) DEFAULT NULL,
  `t_solicitud` varchar(50) DEFAULT NULL,
  `producto` varchar(50) DEFAULT NULL,
  `rango` varchar(50) DEFAULT NULL,
  `moneda` varchar(50) DEFAULT NULL,
  `prima` varchar(50) DEFAULT NULL,
  `poliza` varchar(50) DEFAULT NULL,
  `movimiento` varchar(50) DEFAULT NULL,
  `monto` varchar(50) DEFAULT NULL,
  `contratante` varchar(100) DEFAULT NULL,
  `prioridad` varchar(50) DEFAULT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_agente` int(11) NOT NULL,
  `fgnp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_agente` (`id_agente`),
  KEY `estado` (`estado`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_negocio`
--

DROP TABLE IF EXISTS `linea_negocio`;
CREATE TABLE IF NOT EXISTS `linea_negocio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `linea_negocio`
--

INSERT INTO `linea_negocio` (`id`, `nombre`) VALUES
(1, 'GASTOS MEDICOS MAYORES'),
(2, 'DAÑOS'),
(3, 'AUTOS'),
(4, 'RECLAMACIÓN'),
(5, 'VIDA'),
(6, 'GERENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

DROP TABLE IF EXISTS `moneda`;
CREATE TABLE IF NOT EXISTS `moneda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` decimal(19,4)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`id`, `tipo`) VALUES
(1, 'DLLS'),
(2, 'PESOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

DROP TABLE IF EXISTS `oficina`;
CREATE TABLE IF NOT EXISTS `oficina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oficina`
--

INSERT INTO `oficina` (`id`, `nombre`) VALUES
(1, 'LOMAS VERDES'),
(2, 'REFORMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(255) NOT NULL,
  `id_tipo_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_solicitud` (`id_tipo_solicitud`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `producto`, `id_tipo_solicitud`) VALUES
(1, 'CAPITALIZA', 1),
(2, 'CONSOLIDA', 1),
(3, 'CONSOLIDA TOTAL', 1),
(4, 'DOTAL', 1),
(5, 'ELIGE', 1),
(6, 'IMPULSA', 1),
(7, 'ORDINARIO DE VIDA', 1),
(8, 'PLATINO', 1),
(9, 'PRIVILEGIO', 1),
(10, 'PRIVILEGIO UNIVERSAL', 1),
(11, 'PROFESIONAL', 1),
(12, 'PROYECTA', 1),
(13, 'TEMPORALES', 1),
(14, 'TRASCIENDE', 1),
(15, 'VIDA A TUS SUEÑOS', 1),
(16, 'VIDA INVERSIÓN', 1),
(17, 'VIDA NÓMINA', 1),
(18, 'VISIÓN PLUS', 1),
(19, 'CAMBIO DE FORMA DE PAGO', 2),
(20, 'CAMBIO DE CONDUCTO DE COBRO', 2),
(21, 'CAMBIO DE DIRECCIÓN', 2),
(22, 'CAMBIO DE CONTRATANTE', 2),
(23, 'DUPLICADO DE RECIBO O FACTURA', 2),
(24, 'CAMBIO Y CORRECCIÓN DE BENEFICIARIOS', 2),
(25, 'CORRECCIÓN DEL NOMBRE DEL ASEGURADO', 2),
(26, 'COMPROBRACIÓN DE EDAD', 2),
(27, 'CORRECIÓN A LA FECHA DE NAC S MODIFICAR LA EDAD', 2),
(28, 'CORRECIÓN A LA FECHA DE NAC ALTERANDO LA EDAD', 2),
(29, 'CANCELACIÓN DE BENEFICIOS ADICIONALES', 2),
(30, 'INCLUSIÓN DE BENEFICIOS ADICIONALES', 2),
(31, 'CAMBIO DE PLAN', 2),
(32, 'REHABILITACIÓN SIN CAMBIOS', 2),
(33, 'REHABILITACIÓN CON CAMBIOS', 2),
(34, 'RETIRO DEL FONDO DE INVERSIÓN', 2),
(35, 'RESCATE', 2),
(36, 'PRÉSTAMO PARA PAGO DE PRIMA', 2),
(37, 'PAGO DE PRIMA COMPLEMENTANDO CON EL FONDO DE INVERSIÓN', 2),
(38, 'PAGO DE PRIMA NUEVO NEGOCIO CON FONDO DE INVERSIÓN', 2),
(39, 'PAGO DE PRIMA RENOVACIÓN CON FONDO DE INVERSIÓN', 2),
(40, 'CAMBIO DE TELÉFONO, FAX, CORREO ELECTRÓNICO', 2),
(41, 'CORRECCIÓN DE R.F.C.', 2),
(42, 'SOLICITUD DE TALONARIO', 2),
(43, 'DETENCIÓN DE INCREMENTOS', 2),
(44, 'PAGO DE PRIMA DE OTRO RAMO', 2),
(45, 'CONVERSIÓN A SEGURO PRORROGADO', 2),
(46, 'CONVERSIÓN A SEGURO SALDADO', 2),
(47, 'PRÉSTAMO PARA EXPEDICIÓN DE CHEQUE', 2),
(48, 'REANUDACIÓN DE INCREMENTOS', 2),
(49, 'DUPLICADO DE PÓLIZA', 2),
(50, 'CESIÓN DE DERECHO', 2),
(51, 'DEVOLUCIÓN DE DEPÓSITO', 2),
(52, 'AUMENTO DE SUMA ASEGURADA', 2),
(53, 'ACLARACIONES', 2),
(54, 'ALTA, RECONSIDERACIÓN Y CANCELACIÓN DE EXTRAPRIMA', 2),
(55, 'DESGLOSE DE PRÉSTAMO', 2),
(56, 'DISMINUCIÓN DE SUMA ASEGURADA', 2),
(57, 'CAMBIOS AL FIDEICOMISO', 2),
(58, 'CONSTANCIA DE RETENCIÓN DE IMPUESTOS', 2),
(59, 'MOVIMIENTO FACULTATIVO', 2),
(60, 'REEXPEDICIONES BÁSICAS', 2),
(61, 'REEXPEDICIONES CON MANTENIMIENTO', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango`
--

DROP TABLE IF EXISTS `rango`;
CREATE TABLE IF NOT EXISTS `rango` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tiporan` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rango`
--

INSERT INTO `rango` (`id`, `tiporan`) VALUES
(1, 'RANGO A'),
(2, 'RANGO B'),
(3, 'RANGO C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_agente`
--

DROP TABLE IF EXISTS `tipo_agente`;
CREATE TABLE IF NOT EXISTS `tipo_agente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_agente`
--

INSERT INTO `tipo_agente` (`id`, `tipo`) VALUES
(1, 'NOVEL'),
(2, 'CONSOLIDADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_solicitud`
--

DROP TABLE IF EXISTS `tipo_solicitud`;
CREATE TABLE IF NOT EXISTS `tipo_solicitud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_solicitud`
--

INSERT INTO `tipo_solicitud` (`id`, `tipo`) VALUES
(1, 'ALTA DE POLIZA'),
(2, 'MOVIMIENTOS'),
(3, 'PAGOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `descripcion`) VALUES
(1, 'AGENTE'),
(2, 'CONSULTOR'),
(3, 'ADMINISTRADOR'),
(4, 'CAPACITACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramite_agente`
--

DROP TABLE IF EXISTS `tramite_agente`;
CREATE TABLE IF NOT EXISTS `tramite_agente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_linea_negocio` int(11) NOT NULL,
  `id_tipo_solicitud` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `id_rango` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_linea_negocio` (`id_linea_negocio`),
  KEY `id_tipo_solicitud` (`id_tipo_solicitud`),
  KEY `id_producto` (`id_producto`),
  KEY `id_moneda` (`id_moneda`),
  KEY `id_rango` (`id_rango`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomusuario` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validados`
--

DROP TABLE IF EXISTS `validados`;
CREATE TABLE IF NOT EXISTS `validados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_archivo` int(10) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validar_archivos`
--

DROP TABLE IF EXISTS `validar_archivos`;
CREATE TABLE IF NOT EXISTS `validar_archivos` (
  `idvalido` int(10) NOT NULL AUTO_INCREMENT,
  `idarchivo` int(100) DEFAULT NULL,
  PRIMARY KEY (`idvalido`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
