-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: bd_appgestionintegral
-- ------------------------------------------------------
-- Server version	5.7.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Asignatura_dependencia`
--

DROP TABLE IF EXISTS `Asignatura_dependencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Asignatura_dependencia` (
  `codigo_asignatura` varchar(20) NOT NULL,
  `codigo_dependencia` varchar(5) NOT NULL,
  `id_asignatura_dependencia` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_asignatura_dependencia`),
  KEY `codigo_asignatura_idx` (`codigo_asignatura`),
  KEY `codigo_dependencia_idx` (`codigo_dependencia`),
  CONSTRAINT `codigo_asignatura` FOREIGN KEY (`codigo_asignatura`) REFERENCES `Asignaturas` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `codigo_dependencia` FOREIGN KEY (`codigo_dependencia`) REFERENCES `Dependencias` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Asignatura_dependencia`
--

LOCK TABLES `Asignatura_dependencia` WRITE;
/*!40000 ALTER TABLE `Asignatura_dependencia` DISABLE KEYS */;
INSERT INTO `Asignatura_dependencia` VALUES ('ABCD','0001',1),('EFGH','0002',2),('IJKL','0003',3),('MNÑO','0004',4),('PQRS','0005',5),('UVWX','0006',6);
/*!40000 ALTER TABLE `Asignatura_dependencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Asignaturas`
--

DROP TABLE IF EXISTS `Asignaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Asignaturas` (
  `codigo` varchar(20) NOT NULL,
  `nombre_asignatura` varchar(150) NOT NULL,
  `creditos` tinyint(20) NOT NULL,
  `horas_semanales` tinyint(250) NOT NULL,
  `jornada` varchar(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Asignaturas`
--

LOCK TABLES `Asignaturas` WRITE;
/*!40000 ALTER TABLE `Asignaturas` DISABLE KEYS */;
INSERT INTO `Asignaturas` VALUES ('ABCD','ASIGNATURA-PRUEBA1',4,4,'D'),('EFGH','ASIGNATURA-PRUEBA2',3,3,'N'),('IJKL','ASIGNATURA-PRUEBA3',3,4,'D'),('MNÑO','ASIGNATURA-PRUEBA4',5,4,'D'),('PQRS','ASIGNATURA-PRUEBA5',2,2,'D'),('UVWX','ASIGNATURA-PRUEBA6',3,3,'D');
/*!40000 ALTER TABLE `Asignaturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dependencias`
--

DROP TABLE IF EXISTS `Dependencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Dependencias` (
  `codigo` varchar(5) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `id_coordinador` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `id_coordinador_idx` (`id_coordinador`),
  CONSTRAINT `id_coordinador` FOREIGN KEY (`id_coordinador`) REFERENCES `Usuarios` (`Numero_cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dependencias`
--

LOCK TABLES `Dependencias` WRITE;
/*!40000 ALTER TABLE `Dependencias` DISABLE KEYS */;
INSERT INTO `Dependencias` VALUES ('0001','DEPENDENCIA 1','4567'),('0002','DEPENDENCIA 2','4567'),('0003','DEPENDENCIA 3','4567'),('0004','DEPENDENCIA 4','45678'),('0005','DEPENDENCIA 5','45678'),('0006','DEPENDENCIA 6','45678');
/*!40000 ALTER TABLE `Dependencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Horarios`
--

DROP TABLE IF EXISTS `Horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Horarios` (
  `id_Horario` int(11) NOT NULL AUTO_INCREMENT,
  `id_asignatura_dependencia` int(11) NOT NULL,
  `dia` varchar(45) NOT NULL,
  `hora_inicial` time NOT NULL,
  `cantidad_horas` tinyint(20) NOT NULL,
  `id_usuario` varchar(20) NOT NULL,
  PRIMARY KEY (`id_Horario`),
  KEY `id_asignatura_dependencia_idx` (`id_asignatura_dependencia`),
  KEY `id_usuario_idx` (`id_usuario`),
  CONSTRAINT `id_asignatura_dependencia` FOREIGN KEY (`id_asignatura_dependencia`) REFERENCES `Asignatura_dependencia` (`id_asignatura_dependencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`Numero_cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Horarios`
--

LOCK TABLES `Horarios` WRITE;
/*!40000 ALTER TABLE `Horarios` DISABLE KEYS */;
INSERT INTO `Horarios` VALUES (1,1,'JUEVES','08:00:00',4,'789'),(2,2,'JUEVES','14:00:00',3,'789'),(3,3,'LUNES','08:00:00',2,'789'),(4,4,'MIERCOLES','09:00:00',2,'789'),(5,5,'VIERNES','08:00:00',2,'789'),(6,6,'SABADO','14:00:00',3,'789'),(7,3,'MARTES','16:00:00',2,'789'),(8,3,'LUNES','14:00:00',2,'7891'),(9,4,'MIERCOLES','15:00:00',2,'789');
/*!40000 ALTER TABLE `Horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Perfiles`
--

DROP TABLE IF EXISTS `Perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Perfiles` (
  `id` int(1) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Perfiles`
--

LOCK TABLES `Perfiles` WRITE;
/*!40000 ALTER TABLE `Perfiles` DISABLE KEYS */;
INSERT INTO `Perfiles` VALUES (0,'ADMINISTRADORXS'),(1,'COORDINADORXS'),(2,'PROFESORXS'),(3,'MONITORXS');
/*!40000 ALTER TABLE `Perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Registros`
--

DROP TABLE IF EXISTS `Registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Registros` (
  `id_Registros` int(11) NOT NULL AUTO_INCREMENT,
  `id_horario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_llegada` time NOT NULL,
  PRIMARY KEY (`id_Registros`),
  KEY `id_horario_idx` (`id_horario`),
  CONSTRAINT `id_horario` FOREIGN KEY (`id_horario`) REFERENCES `Horarios` (`id_Horario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Registros`
--

LOCK TABLES `Registros` WRITE;
/*!40000 ALTER TABLE `Registros` DISABLE KEYS */;
/*!40000 ALTER TABLE `Registros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `Numero_cedula` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `estado` binary(1) NOT NULL DEFAULT '0',
  `id_perfil` int(1) NOT NULL,
  PRIMARY KEY (`Numero_cedula`),
  KEY `pk` (`id_perfil`),
  CONSTRAINT `pk` FOREIGN KEY (`id_perfil`) REFERENCES `Perfiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES ('1234','1234','ROOT','root@correounivale.edu.co','0',0),('4567','4567','COORDINADOR','coordinador@correounivale.edu.co','0',1),('45678','45678','COORDINADORA','coordinadora@correounivale.edu.co','0',1),('789','789','DOCENTE-PRUEBA','docente-prueba@correounivale.edu.co','0',2),('7891','7891','DOCENTE-PRUEBA1','docente-prueba1@correounivale.edu.co','0',2);
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_04_21_143359_create_sessions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-04 22:02:16
