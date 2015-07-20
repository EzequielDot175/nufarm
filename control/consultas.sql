CREATE TABLE `consultas` (
  `idConsulta` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `strAsunto` varchar(100) NOT NULL,
  `strCampo` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `respondido` smallint(1) NOT NULL,
  `tipo` smallint(1) NOT NULL,
  `respuesta_de` int(11) NOT NULL,
  PRIMARY KEY (`idConsulta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;