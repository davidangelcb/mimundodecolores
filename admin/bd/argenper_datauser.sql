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

/*Data for the table `argenper_users` */

insert  into `argenper_users`(`iduser`,`usuario`,`password`,`nombre`,`apellido`,`telefono`,`email`,`tipo`,`estado`,`intentos`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','Admin','.','987-897-987','admin@gmail.com','A','E',0),(2,'david','21232f297a57a5a743894a0e4a801fc3','David','Cama','378-4115','david@mayopi.com','A','E',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
