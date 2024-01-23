-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para crowdfunding
CREATE DATABASE IF NOT EXISTS `crowdfunding` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `crowdfunding`;

-- Volcando estructura para tabla crowdfunding.donaciones
CREATE TABLE IF NOT EXISTS `donaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL,
  `donacion` int(11) NOT NULL DEFAULT 0,
  `fecha` int(11) DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_donaciones_usuarios` (`idUsuario`),
  KEY `FK_donaciones_proyectos` (`idProyecto`),
  CONSTRAINT `FK_donaciones_proyectos` FOREIGN KEY (`idProyecto`) REFERENCES `proyectos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_donaciones_usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crowdfunding.donaciones: ~1 rows (aproximadamente)
REPLACE INTO `donaciones` (`id`, `idUsuario`, `idProyecto`, `donacion`, `fecha`) VALUES
	(16, 17, 7, 321, 2147483647),
	(17, 17, 7, 100000, 2147483647),
	(18, 17, 8, 100, 2147483647),
	(19, 17, 9, 2147483647, 2147483647);

-- Volcando estructura para tabla crowdfunding.proyectos
CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `descripcion` char(100) DEFAULT NULL,
  `ruta_foto` varchar(100) DEFAULT NULL,
  `goal` int(11) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Información de los proyectos disponibles';

-- Volcando datos para la tabla crowdfunding.proyectos: ~6 rows (aproximadamente)
REPLACE INTO `proyectos` (`id`, `titulo`, `descripcion`, `ruta_foto`, `goal`, `fecha_creacion`) VALUES
	(6, 'dwadwa', 'dwadwa', './../assets/project-images/imagen_1706042583.png', 321321, '2024-01-23 21:43:03'),
	(7, 'dwadwa', 'dwadwa', './../assets/project-images/imagen_1706042600.png', 321321, '2024-01-23 21:43:20'),
	(8, 'dwadwa', 'dwadwa', './../assets/project-images/imagen_1706042637.png', 321321, '2024-01-23 21:43:57'),
	(9, 'dwadwada', 'dwadwa', './../assets/project-images/imagen_1706042671.png', 321321, '2024-01-23 21:44:31'),
	(10, 'dwadwa', 'dwadwadwa', './../assets/project-images/imagen_1706042744.png', 321321, '2024-01-23 21:45:44'),
	(11, 'dwadwa', 'dwaodwao', './../assets/project-images/imagen_1706043686.png', 321321, '2024-01-23 22:01:26');

-- Volcando estructura para tabla crowdfunding.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `contrasena` char(60) DEFAULT NULL,
  `correo` char(100) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Datos de los usuarios de la base de datos';

-- Volcando datos para la tabla crowdfunding.usuarios: ~2 rows (aproximadamente)
REPLACE INTO `usuarios` (`id`, `nombre`, `usuario`, `contrasena`, `correo`, `fecha_creacion`) VALUES
	(16, 'mario', 'mario', '$2y$10$CbZgHedhZDfRHHD0SaBoSOE/JpWZ/XPuIuH75PCKe/gZq1anYMAsK', 'mario@gmail.com', '2024-01-23 21:09:23'),
	(17, 'luis', 'luis', '$2y$10$Fkha8uW7J3ZnnQ/l7vALlevfZnG2gIcLpI/puwOzaCcaVwX9HCsye', 'luis@gmail.com', '2024-01-23 22:46:01');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
