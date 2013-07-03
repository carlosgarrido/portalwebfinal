-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 02-07-2013 a las 20:31:17
-- Versión del servidor: 5.0.18
-- Versión de PHP: 5.1.2
-- 
-- Base de datos: `serviweb`
-- 
CREATE DATABASE `serviweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE serviweb;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `admin`
-- 

CREATE TABLE `admin` (
  `UserID` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Nivel` tinyint(3) NOT NULL,
  PRIMARY KEY  (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `admin`
-- 

INSERT INTO `admin` VALUES ('admin', 'admin', 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `categoriaproductos`
-- 

CREATE TABLE `categoriaproductos` (
  `CategoriaID` tinyint(4) NOT NULL auto_increment,
  `CategoriaNombre` varchar(20) NOT NULL,
  PRIMARY KEY  (`CategoriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- 
-- Volcar la base de datos para la tabla `categoriaproductos`
-- 

INSERT INTO `categoriaproductos` VALUES (23, 'Reparaciones');
INSERT INTO `categoriaproductos` VALUES (24, 'Tarot');
INSERT INTO `categoriaproductos` VALUES (25, 'Informatica');
INSERT INTO `categoriaproductos` VALUES (26, 'Modelos');
INSERT INTO `categoriaproductos` VALUES (27, 'Niñeras');
INSERT INTO `categoriaproductos` VALUES (28, 'Otros Servicios');
INSERT INTO `categoriaproductos` VALUES (29, 'Salud');
INSERT INTO `categoriaproductos` VALUES (30, 'Belleza');
INSERT INTO `categoriaproductos` VALUES (31, 'Transporte');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `noticias`
-- 

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` text NOT NULL,
  `texto1` text NOT NULL,
  `texto2` text,
  `imagen` varchar(40) default NULL,
  `fecha` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `noticias`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `orden`
-- 

CREATE TABLE `orden` (
  `OrdenID` tinyint(12) NOT NULL auto_increment,
  `UsuarioID` tinyint(12) NOT NULL,
  `OrdenEstado` varchar(20) NOT NULL,
  `OrdenFecha` varchar(30) NOT NULL,
  PRIMARY KEY  (`OrdenID`),
  KEY `UsuarioID` (`UsuarioID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- 
-- Volcar la base de datos para la tabla `orden`
-- 

INSERT INTO `orden` VALUES (24, 9, '1', '2013/07/02');
INSERT INTO `orden` VALUES (25, 10, '0', '2013/07/02');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ordenesdetalles`
-- 

CREATE TABLE `ordenesdetalles` (
  `ID` tinyint(12) NOT NULL auto_increment,
  `OrdenID` tinyint(12) NOT NULL,
  `ProductoID` tinyint(12) NOT NULL,
  `Cantidad` tinyint(20) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `ProductoID` (`ProductoID`),
  KEY `OrdenID` (`OrdenID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

-- 
-- Volcar la base de datos para la tabla `ordenesdetalles`
-- 

INSERT INTO `ordenesdetalles` VALUES (46, 25, 32, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `productos`
-- 

CREATE TABLE `productos` (
  `ProductoID` tinyint(12) NOT NULL auto_increment,
  `ProductoNombre` text NOT NULL,
  `Detalles` text NOT NULL,
  `Precio` int(80) NOT NULL,
  `Stock` varchar(12) NOT NULL,
  `imagen` text,
  `CategoriaID` tinyint(4) NOT NULL,
  PRIMARY KEY  (`ProductoID`),
  KEY `CategoriaID` (`CategoriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- 
-- Volcar la base de datos para la tabla `productos`
-- 

INSERT INTO `productos` VALUES (32, 'perro', '', 300, '6', 'honor-a-bichon-frise-from-jpg.jpg', 31);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `UsuarioID` tinyint(12) NOT NULL auto_increment,
  `Nombre` varchar(20) NOT NULL,
  `ApellidoP` varchar(20) NOT NULL,
  `AplellidoM` varchar(20) default NULL,
  `Correo` varchar(60) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Empresa` varchar(20) default NULL,
  `Direccion` varchar(20) NOT NULL,
  `Fono` tinyint(20) NOT NULL,
  `Nivel` tinyint(3) default '0',
  PRIMARY KEY  (`UsuarioID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES (9, 'jose', 'cares', 'acevedo', 'jcares@pccurico.cl', '123456', 'pccurico', 'ksksk', 127, 0);
INSERT INTO `usuarios` VALUES (10, 'carlos', 'garrido', 'donoso', 'gg@gg.cl', '123456', 'cg', 'curico', 127, 0);

-- 
-- Filtros para las tablas descargadas (dump)
-- 

-- 
-- Filtros para la tabla `orden`
-- 
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`UsuarioID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Filtros para la tabla `ordenesdetalles`
-- 
ALTER TABLE `ordenesdetalles`
  ADD CONSTRAINT `ordenesdetalles_ibfk_1` FOREIGN KEY (`OrdenID`) REFERENCES `orden` (`OrdenID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenesdetalles_ibfk_2` FOREIGN KEY (`ProductoID`) REFERENCES `productos` (`ProductoID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Filtros para la tabla `productos`
-- 
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`CategoriaID`) REFERENCES `categoriaproductos` (`CategoriaID`) ON DELETE CASCADE ON UPDATE CASCADE;

