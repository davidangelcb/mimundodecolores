/*
SQLyog Enterprise - MySQL GUI v6.13
MySQL - 5.1.41 : Database - argenpersms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `argenpersms`;

USE `argenpersms`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `argenper_cron` */

DROP TABLE IF EXISTS `argenper_cron`;

CREATE TABLE `argenper_cron` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `proceso` varchar(150) DEFAULT NULL,
  `estatus` char(1) DEFAULT 'E',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `argenper_logcron` */

DROP TABLE IF EXISTS `argenper_logcron`;

CREATE TABLE `argenper_logcron` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_ref` int(10) DEFAULT NULL,
  `estado_origin` tinyint(4) DEFAULT NULL,
  `estado_fin` tinyint(4) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `response_api` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Table structure for table `argenper_login_logs` */

DROP TABLE IF EXISTS `argenper_login_logs`;

CREATE TABLE `argenper_login_logs` (
  `idlog` int(10) NOT NULL AUTO_INCREMENT,
  `iduser` int(10) NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`idlog`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Table structure for table `argenper_processlog` */

DROP TABLE IF EXISTS `argenper_processlog`;

CREATE TABLE `argenper_processlog` (
  `idlog` int(10) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `q` int(10) DEFAULT NULL,
  `ids` text,
  `ids_done` text,
  `ids_fail` text,
  `iduser` int(10) DEFAULT NULL,
  `estado` char(1) DEFAULT 'E',
  PRIMARY KEY (`idlog`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Table structure for table `argenper_sms` */

DROP TABLE IF EXISTS `argenper_sms`;

CREATE TABLE `argenper_sms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_template` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `nombres` varchar(150) DEFAULT NULL,
  `celular` char(15) DEFAULT NULL,
  `mensaje` text,
  `fecha` datetime DEFAULT NULL,
  `id_sms` int(11) DEFAULT NULL,
  `estatus_mensaje` tinyint(4) DEFAULT NULL,
  `log` text,
  `tipo` varchar(100) DEFAULT NULL,
  `id_ref` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Table structure for table `argenper_tblsms` */

DROP TABLE IF EXISTS `argenper_tblsms`;

CREATE TABLE `argenper_tblsms` (
  `id_ref` int(18) NOT NULL AUTO_INCREMENT,
  `numero_giro` varchar(20) DEFAULT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `nombre_oficina` varchar(50) DEFAULT NULL,
  `celular_cliente` varchar(15) DEFAULT NULL,
  `id_sms` int(11) DEFAULT NULL,
  `longitud_sms` int(10) DEFAULT NULL,
  `estado_envio` tinyint(4) DEFAULT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `fecha_proceso` datetime DEFAULT NULL,
  `fecha_actualizacion_estado` datetime DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `num_dia_ee` int(11) DEFAULT NULL,
  `tip_entrega` char(1) DEFAULT NULL,
  `mensaje_cliente` text,
  `userid` int(11) DEFAULT NULL,
  `ciudad_cliente` varchar(50) DEFAULT NULL,
  `respuesta_api` varchar(50) DEFAULT NULL,
  `telefono_oficina` varchar(30) DEFAULT NULL,
  `argenper_estado` char(2) DEFAULT NULL,
  `fecha_giro` datetime DEFAULT NULL,
  `numero_envios` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id_ref`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Table structure for table `argenper_template` */

DROP TABLE IF EXISTS `argenper_template`;

CREATE TABLE `argenper_template` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `titulo` varchar(120) DEFAULT NULL,
  `sms` text,
  `iduser` int(10) DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT 'E',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `argenper_users` */

DROP TABLE IF EXISTS `argenper_users`;

CREATE TABLE `argenper_users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
