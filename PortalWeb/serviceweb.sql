-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 25-07-2006 a las 15:47:06
-- Versión del servidor: 5.0.18
-- Versión de PHP: 5.1.2
-- 
-- Base de datos: `ecomercio`
-- 

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

INSERT INTO `admin` VALUES ('admin', 'admin', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `categoriaproductos`
-- 

CREATE TABLE `categoriaproductos` (
  `CategoriaID` tinyint(4) NOT NULL auto_increment,
  `CategoriaNombre` varchar(20) NOT NULL,
  PRIMARY KEY  (`CategoriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- 
-- Volcar la base de datos para la tabla `categoriaproductos`
-- 

INSERT INTO `categoriaproductos` VALUES (11, 'Warfare');
INSERT INTO `categoriaproductos` VALUES (12, 'Radiocrontrol');
INSERT INTO `categoriaproductos` VALUES (13, 'Puzzles');
INSERT INTO `categoriaproductos` VALUES (14, 'Gadgets');
INSERT INTO `categoriaproductos` VALUES (15, 'Peluches');
INSERT INTO `categoriaproductos` VALUES (16, 'Figuritas');
INSERT INTO `categoriaproductos` VALUES (17, 'Posters');
INSERT INTO `categoriaproductos` VALUES (18, 'Stickers');
INSERT INTO `categoriaproductos` VALUES (19, 'Accesorios');
INSERT INTO `categoriaproductos` VALUES (20, 'Poleras');
INSERT INTO `categoriaproductos` VALUES (21, 'Herramientas');
INSERT INTO `categoriaproductos` VALUES (22, 'Robots');

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

INSERT INTO `noticias` VALUES (3, 'Aspiradora USB de escritorio', 'Nada mejor que una pequeña aspiradora USB conectada al computador. Se puede limpiar el teclado, el escritorio y las migas de pan que quedan en el bigote después de tomar desayuno frente a la pantalla.\r\n\r\nEl artilugio de aseo oficinístico cuesta sólo $18 dólares y mide sólo 10.5 x 13.5 x 3.5 cms ', '<strong>Link: </strong><a href="http://www.gadgets.co.uk/buy-gadgets/item/USBVAC/HOME/USB-Powered-Mini-Vacuum-Cleaner.html">USB Powered Mini Vacuum Cleane</a>', 'Aspiradora_USB-1.jpg', '2006/07/21');
INSERT INTO `noticias` VALUES (4, 'Robot acróbata', 'No es barato, cuesta $1.200 dólares pero con sus 30 centímetros es capaz de correr, saltar, patear, equilibrarse en una pierna, hacer la rueda, bailar y otra serie acrobacias. 16 motores permiten que el robot haga movimientos que hasta el momento sólo estaban reservados para humanoides no comerciales y de mucho mayor valor.', '', 'robot.jpeg', '2006/07/21');
INSERT INTO `noticias` VALUES (5, 'Scoot: el scooter recargable', 'Mientras que en Venezuela llenan el estanque del auto con $3.000 pesos, por acá mejor pensamos en otras alternativas a la gasolina. El Scoot Concept tiene una autonomía de 50 km, la batería intercambiable de litio ion se recarga en 6 horas y tiene una velocidad máxima de 30 km/hr. Aunque parece un scooter entra en la clasificación de bicicleta, así que puedes chocar sin tener licencia.', 'Es un concepto cuyo precio estimado es de $1.875 dólares, pero con los precios de los combustibles en alza no sería raro que salga a la venta.\r\n<strong>Link:</strong> <a href="http://www.productdose.com/article.php?article_id=4003">Two Pennies a Mile?</a> <em>(Product Dose)</em>', 'Scoot.jpg', '2006/07/21');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- 
-- Volcar la base de datos para la tabla `orden`
-- 

INSERT INTO `orden` VALUES (21, 1, '0', '2006/07/25');
INSERT INTO `orden` VALUES (22, 7, '0', '2006/07/25');
INSERT INTO `orden` VALUES (23, 1, '0', '2006/07/25');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

-- 
-- Volcar la base de datos para la tabla `ordenesdetalles`
-- 

INSERT INTO `ordenesdetalles` VALUES (41, 21, 16, 1);
INSERT INTO `ordenesdetalles` VALUES (42, 22, 16, 1);
INSERT INTO `ordenesdetalles` VALUES (43, 23, 16, 1);
INSERT INTO `ordenesdetalles` VALUES (44, 23, 17, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- 
-- Volcar la base de datos para la tabla `productos`
-- 

INSERT INTO `productos` VALUES (11, 'Star Wars Force FX L', '<p><strong>Star Wars Force FX Lightsabers</strong></p>\r\n<p>Espada laser diferentes modelos disponibles, tu eliges tu destino, con estos modelos de laser:</p>\r\n<ul>\r\n   <li> <strong>Darth Vader</strong> - Red Blade - (episode V <em>Empire Strikes Back</em>) </li>\r\n  <li> <strong>Anakin Skywalker</strong> - Blue Blade - (episode III <em>Revenge of the Sith</em>) </li>\r\n  <li> <strong>Mace Windu</strong> - Purple Blade - (Episode II <em>Attack Of The Clones</em>) </li>\r\n  <li> <strong>Luke Skywalker</strong> - Green Blade - (Episode VI <em>Return Of The Jedi</em>) </li>\r\n</ul>\r\n<p>  Anakin y Darth Vader  rquieren <strong>3 pilas AA</strong> (no incluidas). </p>', 45000, '20', 'lightsaber_extend-small.gif', 11);
INSERT INTO `productos` VALUES (12, 'Baquetas', '<p><strong>Otra para el batero que todos llevamos dentro</strong></p>\r\n<p>Este par de baquetas  vienen con unos parlantes incorporados, se puede cambiar el tipo de  tambor o platillo que se toca y suenan al golpear algo o simplemente al  “golpear” en el aire. </p>\r\n<p>Nada reemplaza a una batería de verdad, pero a sólo este precio, es lo más parecido a una de verdad que van a encontrar. </p>\r\n<p><strong>Necesita de 4  baterías AAA</strong>. </p>', 24000, '10', 'baqueta.jpg', 14);
INSERT INTO `productos` VALUES (13, 'Raptor 4.0 Extreme', '<p><strong>Raptor 4.0 Extreme</strong></p>\r\n<p>El skate (más bien longboard) de arriba llamado Raptor 4.0 Extreme es  capaz de ir de 0 a 24 km/hr en sólo 4 segundos. La potencia la entrega  un motor de 24 volts y 450 watts, así que es más que recomendado usar  casco y protecciones varias. La aceleración y frenado de esta tabla de  1 metro de largo y 22 kilos de peso se realiza a través de una  pistola-control remoto.</p>', 35000, '20', 'Raptor4.jpg', 12);
INSERT INTO `productos` VALUES (14, 'Aspiradora USB ', '<p><strong>aspiradora USB</strong></p>\r\n<p>Nada mejor que una pequeña aspiradora USB conectada al computador.  Se puede limpiar el teclado, el escritorio y las migas de pan que  quedan en el bigote después de tomar desayuno frente a la pantalla. </p>\r\n<p> El artilugio de aseo oficinístico  mide sólo 10.5 x 13.5 x 3.5 cms </p>', 28000, '4', 'Aspiradora_USB-1.jpg', 14);
INSERT INTO `productos` VALUES (15, 'Ruleta rusa ', '<p><strong>La Shocking Roulette</strong></p>\r\n<p>La Shocking Roulette es una &quot;divertida&quot; y dolorosa manera de pasar el  tiempo con tus amigos. El juego consiste en que los participantes meten  el dedo indice en la m&aacute;quina, luego presionan un bot&oacute;n y esperan  algunos segundos a que al menos afortunado le llegue una descarga  el&eacute;ctrica (todo con una emocinante y ruidosa cuenta regresiva).</p>', 45000, '7', 'Ruleta_rusa.jpg', 13);
INSERT INTO `productos` VALUES (16, 'Espejo retrovisor ', 'No hay respeto!, no se puede leer FayerWayer o ver porno en la oficina tranquilamente sin estar pensando en que aparecerá tu jefe en cualquier momento a interrumpirte. Para solucionar eso (y para que tu computador parezca micro), ahora pueden adquirir un lindo retrovisor para instalar en tu monitor. Claro que el instalar el espejo le indica a tu jefe que estás leyendo FW o bajando porno.\r\n\r\nSería bueno que para complementar el look de "micrero" del computador, fabricaran un mouse con una jaiba adentro. ', 26000, '11', 'retrovisor_computador.jpg', 19);
INSERT INTO `productos` VALUES (17, 'Batería para dedos', 'Si eres de esos que anda por ahí tocando batería con los dedos, este gadget es para ti. Esta batería para dedos es del tamaño de un mouse pad. Con sólo golpear el dispositivo en el tambor o platillo correspondiente, se produce un sonido que replica aquellos de una batería verdadera todo amplificado mediante el parlante integrado.\r\n\r\nLa batería puede grabar las sesiones de golpeteo y reproducirlas. Usa 4 pilas pequeñas', 36000, '30', 'fingerdrums.jpg', 14);
INSERT INTO `productos` VALUES (18, 'Superman Volador', 'Si eres de los que toma sus figuritas de acción y las hace volar por la habitación haciendo ruidos de avioncito, ahora podrás hacer que realmente vuelen. Si tienes más de 10 años y lo sigues haciendo, te recomendamos que compres este producto con urgencia y dejes de hacer el ridiculo (aunque sea en privado). Como es costumbre con cualquier superproducción de Hollywood, la nueva película de Superman viene con miles de productos relacionados. Incluyendo este Superman a control remoto que realmente vuela.', 20000, '50', 'rc_superman.jpg', 12);
INSERT INTO `productos` VALUES (19, 'Robot acróbata', 'con sus 30 centímetros es capaz de correr, saltar, patear, equilibrarse en una pierna, hacer la rueda, bailar y otra serie acrobacias. 16 motores permiten que el robot haga movimientos que hasta el momento sólo estaban reservados para humanoides no comerciales y de mucho mayor valor.', 67900, '20', '72992A.jpeg', 22);
INSERT INTO `productos` VALUES (20, 'Aspiradora de insectos', 'El desarrollo de los países se manifiesta en la forma en que matan a sus insectos. Mientras nosotros seguimos atacando a los bichos con el periódico, en los países desarrollados ya tienen aspiradoras para tal propósito. El aparato no deja manchas producidas por el aplastamiento y además de succionar a los bichos los mata con una indolora descarga eléctrica.\r\n\r\nEl brazo del aparato se alarga para no tener que subirse a una silla, es recargable y tiene indicador de batería.', 23000, '40', 'insect_vacuum.jpg', 14);
INSERT INTO `productos` VALUES (21, 'Scoot:  recargable', 'Mientras que en Venezuela llenan el estanque del auto con $3.000 pesos, por acá mejor pensamos en otras alternativas a la gasolina. El Scoot Concept tiene una autonomía de 50 km, la batería intercambiable de litio ion se recarga en 6 horas y tiene una velocidad máxima de 30 km/hr. Aunque parece un scooter entra en la clasificación de bicicleta, así que puedes chocar sin tener licencia.', 967000, '3', 'Scoot.jpg', 21);
INSERT INTO `productos` VALUES (22, 'Nike+iPod a la venta', 'El primer producto de la alianza Nike+iPod ya está a la venta y los tipos de iLounge lo pusieron a prueba. Entre las cosas que descubrieron es que la batería del sensor (que va en el zapato), no es reemplazable, aunque según ellos durara bastante tiempo y por su bajo precio (US$29) no deberia ser tan terrible. Tambien descubrieron que aunque la mejor opción es comprarte una zapatilla de la línea Nike+ para incrustarle el sensor, este puede ser colocado en cualquier zapato. Pero no leas este pobre resumen, mejor anda a ver la revisión completa que hicieron ellos.', 90000, '8', 'nike+ipod.jpg', 19);
INSERT INTO `productos` VALUES (23, ' SHE-SPAWN', '<p><strong>MANGA SHE-SPAWN<br />\r\n  <!-- Series Name -->\r\nSPAWN REBORN SERIES 2:</strong></p>\r\n<p> Paint: repaint<br />\r\n  Scale: 6-inch<br />\r\n  Format: action figure<br />\r\n  Packaging: clamshell<br />\r\n  <br />\r\n  Manga She-Spawn, completely redecorated figure, originally released in Spawn Series 9.</p>', 21000, '5', 'spawn1.jpg', 16);
INSERT INTO `productos` VALUES (24, 'Predator', '<strong>ALIEN VS. PREDATOR</strong><br />\r\n<br />\r\nPintura: original paint<br />\r\nEscale: 12-cms<br />\r\nFormato: accion figura<br />\r\n<br />\r\nScar  Predator, el ultimo mienbro de la fiesta de caceria es enviado ala tierra para enfrentarse contra la orda de Alien attackers, incluye una completa base, y pintura decorativas. 12 pulgadas de alto.', 24000, '20', 'avp.jpg', 16);
INSERT INTO `productos` VALUES (25, 'Alien', '<strong>ALIEN VS. PREDATOR</strong><br />\r\n<br />\r\nPintura: original paint<br />\r\nEscale: 12-cms<br />\r\nFormato: accion figura<br />\r\n<br />\r\nScar  Alien, el ultimo mienbro de la fiesta de caceria es enviado ala tierra para enfrentarse contra la orda de Alien attackers, incluye una completa base, y pintura decorativas. 12 pulgadas de alto.', 28700, '12', 'alien.jpg', 16);
INSERT INTO `productos` VALUES (26, 'Wallace', '<strong>Wallace</strong><br />\r\n<br />\r\nPintura: original paint<br />\r\nEscale: 12-cms<br />\r\nFormato: accion figura<br />\r\n<br />\r\nFigura a escla, extraido de la pelicula, completamente ariculado. Contiene autoadhesivos de la pelicula.', 25600, '9', 'wallace.jpg', 16);
INSERT INTO `productos` VALUES (27, 'Gromit', '<strong>Gromit</strong><br />\r\n<br />\r\nPintura: original paint<br />\r\nEscale: 12-cms<br />\r\nFormato: accion figura<br />\r\n<br />\r\nFigura a escla, extraido de la pelicula, completamente ariculado. Contiene autoadhesivos de la pelicula.', 27400, '12', 'gromit.jpg', 16);
INSERT INTO `productos` VALUES (28, 'Tom y Jerry', '<strong>Tom y Jerry </strong><br />\r\n<br />\r\nPintura: original paint<br />\r\nEscale: 12-cms<br />\r\nFormato: accion figura<br />\r\n<br />\r\nFigura a escla, extraido de la pelicula, completamente ariculado. Contiene autoadhesivos de la pelicula.', 25000, '8', 'hb_tjhouse_photo_02_dl.jpg', 16);
INSERT INTO `productos` VALUES (29, 'Kiss', '<strong>Kiss </strong><br />\r\n<br />\r\nPintura: original paint<br />\r\nEscale: 12-cms<br />\r\nFormato: accion figura<br />\r\n<br />\r\nFigura a escla, extraido de la pelicula, completamente ariculado. Contiene autoadhesivos de la pelicula.', 23000, '15', 'kisscreatures_demon_photo_02_dp.jpg', 16);
INSERT INTO `productos` VALUES (30, 'Eddie', '<strong>Eddi (Killers) </strong>\r\n<br />\r\n<br />\r\nPintura: original paint<br />\r\nEscale: 12-cms<br />\r\nFormato: accion figura<br />\r\n<br />\r\nFigura a escla, extraido de la pelicula, completamente ariculado. Contiene autoadhesivos de la pelicula.', 34000, '9', 'other_killers_photo_02_dp.jpg', 16);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES (1, 'Brianas', 'Garcia', 'Simontti', 'basurolandia@chile.cl', 'sepultura', 'Neuromantes', '2 norte no se', 127, 0);
INSERT INTO `usuarios` VALUES (2, 'neubaten', 'neubaten', 'garcia', 'neubaten@gmail.com', 'sepultura', 'Geek toys', '2 norte', 127, 0);
INSERT INTO `usuarios` VALUES (3, 'Juan', 'Perez', 'Perez', 'jperez@correo.cl', '', '12345', '12345', 127, 0);
INSERT INTO `usuarios` VALUES (4, 'Juan', 'Perez', 'Simontti', 'jp@nn.cl', '', '4', '4', 4, 0);
INSERT INTO `usuarios` VALUES (5, 'Juan', 'neubaten', 'Perez', 'perez@correo.cl', '', '123', '1', 0, 0);
INSERT INTO `usuarios` VALUES (6, 'Brian', 'Garcia', 'Simontti', 'neuromantes@123.cl', '1234', '1234', '1234', 127, 0);
INSERT INTO `usuarios` VALUES (7, 'Vilma', 'Corvalan', 'Castro', 'vcorvalan@educarchile.cl', 'picapiedra', 'Santa Marta', 'Chacabuco 53', 127, 0);

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
