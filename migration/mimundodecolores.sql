-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-04-2015 a las 20:36:56
-- Versión del servidor: 5.5.32-cll-lve
-- Versión de PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mimundodecolores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(10) NOT NULL,
  `galeryComentario` char(1) DEFAULT 'Y',
  `galeryTiempo` int(10) DEFAULT '4',
  `animacionnubetiempo` int(10) DEFAULT '20',
  `animacionnube` char(1) DEFAULT 'Y',
  `correocontacto` varchar(70) DEFAULT 'david@mayopi.com',
  `correocccontacto` varchar(70) DEFAULT NULL,
  `ambienteComentario` char(1) DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `galeryComentario`, `galeryTiempo`, `animacionnubetiempo`, `animacionnube`, `correocontacto`, `correocccontacto`, `ambienteComentario`) VALUES
(1, 'Y', 5, 30, 'Y', 'nido_mimundodecolores@hotmail.com', 'david@mayopi.com', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mimundo_contacto`
--

CREATE TABLE IF NOT EXISTS `mimundo_contacto` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(60) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `telefono` varchar(16) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `comentario` text,
  `fecha` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT 'I',
  `fechaarchivo` datetime DEFAULT NULL,
  `iduser` int(10) DEFAULT NULL,
  `envioEmail` char(1) DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `mimundo_contacto`
--

INSERT INTO `mimundo_contacto` (`id`, `apellidos`, `nombre`, `email`, `telefono`, `direccion`, `comentario`, `fecha`, `estado`, `fechaarchivo`, `iduser`, `envioEmail`) VALUES
(1, 'cama buleje', 'davidq', 'david@mayopi.com', '987654312', 'jr coercio  cerro aul canete', 'aca es todo lo que opinas', '2014-03-09 05:00:00', 'A', '2014-03-09 20:43:29', 1, 'Y'),
(2, 'd', 'demo', 'demo@demo.com', '978987987', '', '', '2014-03-09 12:43:58', 'A', '2014-03-09 12:43:58', NULL, 'N'),
(3, 'Juan', 'carlos Orderique', 'juancarlos@loscien.com', '984-849-985', 'Jr camana 874- Cercado', 'Bueno quisiera saber costos y facilidades de pago o medios de pagos de los servicios que se ofrece', '2014-03-09 12:44:43', 'A', '2014-03-09 22:25:24', 1, 'N'),
(4, 'Juan Sebas', 'carlos Orderique', 'juancarlos@loscien.com', '984-849-985', 'Jr camana 874- Cercado', 'Bueno quisiera saber costos y facilidades de pago o medios de pagos de los servicios que se ofrece', '2014-03-09 12:46:04', 'A', '2014-03-09 20:43:29', 1, 'N'),
(5, 'Elsa', 'Sanchez', 'elsita@mayopi.com', '654987564', 'jr coeio er54', 'ola cotizacion', '2014-03-09 20:35:24', 'I', NULL, NULL, 'N'),
(6, 'Josepht', 'Antoni', 'ja_3232@gmail.com', '4758965', 'Jr jormei sjxg654', 'jr comerio 65456', '2014-03-09 20:36:03', 'I', NULL, NULL, 'N'),
(7, 'rodriguez ', 'julissa', 'espiralgrafiko@gmail.com', '2624702', '', 'gloria ola probando hoy martes 17 de febrero 3.50pm\n', '2015-02-17 15:45:24', 'I', NULL, NULL, 'Y'),
(8, 'rodriguez', 'julissa', 'espiralgrafiko@hotmail.com', '2624702', '', 'ola ola ', '2015-02-17 15:55:31', 'I', NULL, NULL, 'Y'),
(9, 'rodriguez', 'julissa', 'miskigrafik@gmail.com', '2624702', 'domingonieto 219', 'ola p`robando', '2015-02-17 16:04:53', 'I', NULL, NULL, 'Y'),
(10, 'deo', 'dmo', 'cdavid5684@hotmail.com', '654987', '5654', '654654', '2015-02-20 10:53:33', 'A', '2015-02-20 12:07:00', 1, 'Y'),
(11, 'Cama Buleje', 'David Angel', 'davidangelcb@gmail.com', '3784115', 'Jr comercio  719 cerro azu', 'Testing', '2015-02-20 12:08:59', 'I', NULL, NULL, 'Y'),
(12, 'rodriguez', 'julissa', 'espirallgrafiko@gmai.com', '991184437', 'domingo nietp ', 'herramienta ista ', '2015-02-20 15:40:15', 'I', NULL, NULL, 'Y'),
(13, 'Orellana Davila', 'Angelica', 'angyorel@hotmail.com', '4175503', 'av canevaro 850', 'desearia saber el costo de sus mensualidades', '2015-04-08 14:37:15', 'A', '2015-04-08 14:39:53', 1, 'Y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mimundo_galeria`
--

CREATE TABLE IF NOT EXISTS `mimundo_galeria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `descri` text,
  `imagename` varchar(120) DEFAULT NULL,
  `imagenamenew` varchar(120) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `iduser` int(10) DEFAULT NULL,
  `estado` char(1) DEFAULT 'E',
  `tipo` varchar(35) DEFAULT 'GALERIA',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `mimundo_galeria`
--

INSERT INTO `mimundo_galeria` (`id`, `nombre`, `descri`, `imagename`, `imagenamenew`, `date`, `iduser`, `estado`, `tipo`) VALUES
(1, 'Demo 1 aÃƒÂ±o1', 'mi Hijito saludando', 'banner3.png', 'f69731f91c5b836da4784d4fbd694f74.png', '2014-03-08 17:06:33', NULL, 'X', 'GALERIA'),
(2, 'CumpleaÃƒÂ±os 1', '1er cumpleaÃƒÂ±os de Eythan', '10954_296706667125581_2143794930_n[1].jpg', 'd3284ee13e6894b28320461983fefbcf.jpg', '2014-03-08 17:12:54', NULL, 'X', 'GALERIA'),
(3, 'demo 100', 'demo la imagen numero 100', '164634_263509470442952_559333305_n.jpg', '2cf61aae866893e7484cdc4c1dc8e423.jpg', '2014-03-08 17:52:34', NULL, 'X', 'GALERIA'),
(4, 'Inicial', 'desde los 3 aÃƒÂ±os los niÃƒÂ±os empiezan con el aprendizaje orientado y guiado por nuestros mejores docentes..', 'demo1.png', 'bb51023dc7749a4af9898a43d7ad22f8.png', '2014-03-08 20:30:53', NULL, 'E', 'GALERIA'),
(5, 'Nido', 'Los niÃƒÂ±os de un inicio ingresan a esta area ya sea de 2 o 3 aÃƒÂ±os...', 'demo2.png', 'fcb3b85dfd17898691517d547d750cec.png', '2014-03-08 20:32:03', NULL, 'E', 'GALERIA'),
(6, 'testing', 'demostacion', 'fondo1.png', '4df3115b012f8c37f3207884a6c45d9d.png', '2014-03-29 14:23:06', NULL, 'X', 'GALERIA'),
(7, 'casa demostracion', 'casita demo', 'fondo2.png', 'ed4c7052cca6706139eba15202c45c65.png', '2014-03-29 15:01:48', NULL, 'X', 'GALERIA'),
(8, 'Ambiente de Aulas', 'Este Ambiente es muy lindo', 'img_01.jpg', '41df88e460c30d3697516cc22599993a.jpg', '2014-03-29 15:03:18', NULL, 'E', 'AMBIENTE'),
(9, 'Ambiente de salones', 'salones', 'fondo2.png', 'ac1efddcd4f4d1d3f8d2d13b9605ce4b.png', '2014-03-29 15:06:55', NULL, 'X', 'AMBIENTE'),
(10, 'sca', 'acac', 'igm1_06.png', 'f59014878f0d1af46ed92d6b27cd83fd.png', '2014-03-29 21:37:35', NULL, 'X', 'AMBIENTE'),
(11, 'acacaca', 'acac', 'mi-mundo-web_06.png', 'b137d143b5d9f3c0c4ed3cd4d36fcea4.png', '2014-03-29 21:40:19', NULL, 'X', 'AMBIENTE'),
(12, 'Item1', 'demo1', 'img1.png', '5c473d151cb26dc1acc0ea4003040de1.png', '2014-03-29 21:45:10', NULL, 'X', 'AMBIENTE'),
(13, 'demo', 'demo', 'kanko.jpg', '741a7676e4c880e7923269b0fd8fa21c.jpg', '2015-02-20 11:29:34', NULL, 'X', 'GALERIA'),
(14, 'Familia', 'Familias felices', 'kike.jpg', '8e60e7d36f8901a10fa7b51b3950f216.jpg', '2015-02-20 11:36:34', NULL, 'X', 'GALERIA'),
(15, 'Demo Ambiente 1', 'demo', 'kanko.jpg', '2adbc0be7a587b9d990ef964ba2c067a.jpg', '2015-02-20 11:44:59', NULL, 'X', 'AMBIENTE'),
(16, 'prueba', 'animales', 'ninho-nic3b1o[1].jpg', '35af9b6adc8fa1450b3dd7561454dc87.jpg', '2015-02-20 15:54:56', NULL, 'X', 'GALERIA'),
(17, 'Aula 1', 'Aula 1', 'AULA  1[1].jpg', 'f4cf76c49c184a1e43f3ff891248bfac.jpg', '2015-02-27 18:32:45', NULL, 'E', 'AMBIENTE'),
(18, 'comedor', 'Comedor', 'JUEGOS (1).jpg', '31be004d99b34ef3b53dafd90a22eeda.jpg', '2015-02-27 18:33:32', NULL, 'E', 'AMBIENTE'),
(19, 'Aula 4', 'Aula 4', 'AULA 4.jpg', '5a54767f5f258c1a7a1aef7ccdddeeef.jpg', '2015-02-27 18:34:33', NULL, 'E', 'AMBIENTE'),
(20, 'En el aula', 'En el aula', 'IMG_8804.jpg', 'a489a82ddb757e01d38a6c785bc289c6.jpg', '2015-02-27 18:51:56', NULL, 'E', 'GALERIA'),
(21, 'En el aula', 'En el aula', 'IMG_8804.jpg', '7573313e70e5e6df198ea88dac415a4d.jpg', '2015-02-27 18:51:56', NULL, 'X', 'GALERIA'),
(22, 'En el aula', 'En el aula', 'IMG_8804.jpg', 'ebec890cdbdea6a5d64a3379511f70df.jpg', '2015-02-27 18:51:57', NULL, 'X', 'GALERIA'),
(23, 'Guarderia', 'Guarderia', 'niÃ±o-disfraz.jpg', '7ea0ee40adfd225bb54d1f1a79100997.jpg', '2015-02-27 18:53:43', NULL, 'E', 'GALERIA'),
(24, 'Banda', 'Banda', 'banda.jpg', '6bb724ae1957098ccbc69476884d9062.jpg', '2015-02-27 18:54:50', NULL, 'E', 'GALERIA'),
(25, 'danza', 'danza arabe', '525077_10150848258013202_1979833994_n.jpg', '5c0d72610679798ecc5932a01cb3fc13.jpg', '2015-04-08 14:42:13', NULL, 'X', 'GALERIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mimundo_login_logs`
--

CREATE TABLE IF NOT EXISTS `mimundo_login_logs` (
  `idlog` int(10) NOT NULL AUTO_INCREMENT,
  `iduser` int(10) NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`idlog`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Volcado de datos para la tabla `mimundo_login_logs`
--

INSERT INTO `mimundo_login_logs` (`idlog`, `iduser`, `ip`, `fecha`) VALUES
(29, 2, '::1', '2014-02-25 16:41:53'),
(30, 1, '::1', '2014-02-28 10:22:21'),
(31, 1, '::1', '2014-03-08 12:28:24'),
(32, 1, '::1', '2014-03-09 02:14:46'),
(33, 2, '::1', '2014-03-16 16:38:58'),
(34, 2, '::1', '2014-03-29 14:05:45'),
(35, 2, '::1', '2014-03-29 21:37:08'),
(36, 2, '::1', '2015-02-16 17:27:01'),
(37, 1, '181.67.172.144', '2015-02-16 17:59:34'),
(38, 1, '190.234.106.2', '2015-02-17 15:03:42'),
(39, 1, '190.234.106.2', '2015-02-17 15:04:22'),
(40, 1, '190.234.135.73', '2015-02-17 15:42:09'),
(41, 1, '190.234.135.73', '2015-02-17 15:42:25'),
(42, 1, '190.234.135.73', '2015-02-17 15:48:51'),
(43, 1, '190.234.135.73', '2015-02-17 15:49:27'),
(44, 1, '190.234.135.73', '2015-02-17 15:56:02'),
(45, 1, '190.234.135.73', '2015-02-17 15:56:12'),
(46, 1, '190.234.135.73', '2015-02-17 15:56:40'),
(47, 1, '190.234.135.73', '2015-02-17 15:57:15'),
(48, 1, '190.234.135.73', '2015-02-17 15:57:31'),
(49, 1, '190.234.135.73', '2015-02-17 16:03:44'),
(50, 1, '190.234.135.73', '2015-02-17 16:06:27'),
(51, 1, '190.234.135.73', '2015-02-17 16:14:40'),
(52, 1, '190.234.135.73', '2015-02-17 16:17:10'),
(53, 1, '181.64.192.38', '2015-02-18 09:44:41'),
(54, 1, '181.64.192.101', '2015-02-19 11:36:29'),
(55, 1, '200.121.173.43', '2015-02-19 15:55:40'),
(56, 1, '200.121.173.43', '2015-02-19 17:04:08'),
(57, 1, '200.121.173.43', '2015-02-20 15:26:31'),
(58, 1, '200.121.173.43', '2015-02-20 15:48:20'),
(59, 1, '200.121.173.43', '2015-02-20 15:59:38'),
(60, 1, '200.121.173.43', '2015-02-20 16:00:55'),
(61, 1, '190.234.106.252', '2015-02-27 18:30:07'),
(62, 1, '181.64.192.193', '2015-03-16 09:49:24'),
(63, 1, '181.64.192.193', '2015-03-16 09:50:02'),
(64, 1, '181.64.192.193', '2015-03-16 09:50:16'),
(65, 1, '190.222.238.204', '2015-04-08 14:37:38'),
(66, 1, '190.222.238.204', '2015-04-08 14:40:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mimundo_users`
--

CREATE TABLE IF NOT EXISTS `mimundo_users` (
  `iduser` int(10) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(60) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `telefono` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `tipo` char(1) DEFAULT 'A' COMMENT 'A=admin U=usuario',
  `estado` char(1) DEFAULT 'E' COMMENT 'E=enable D=disable',
  `intentos` int(10) DEFAULT '0',
  PRIMARY KEY (`iduser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `mimundo_users`
--

INSERT INTO `mimundo_users` (`iduser`, `usuario`, `password`, `nombre`, `apellido`, `telefono`, `email`, `tipo`, `estado`, `intentos`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '.', '987-897-987', 'admin@gmail.com', 'A', 'E', 0),
(2, 'davidcama', '21232f297a57a5a743894a0e4a801fc3', 'David', 'Cama', '378-4115', 'david@mayopi.com', 'A', 'E', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
