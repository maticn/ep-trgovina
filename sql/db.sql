drop database if exists bookstore;
create database bookstore;
use bookstore;
-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: bookstore
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `description` text COLLATE utf8_slovenian_ci NOT NULL,
  `price` float NOT NULL,
  `year` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES 
(1,'Ivan Bratko','Prolog Programming for Artificial Intelligence','The fourth edition of this best-selling guide to Prolog and Artificial Intelligence has been updated to include key developments in the field while retaining its lucid approach to these topics. New and extended topics include Constraint Logic Programming, abductive reasoning and partial order planning. Divided into two parts, the first part of the book introduces the programming language Prolog, while the second part teaches Artificial Intelligence using Prolog as a tool for the implementation of AI techniques. This textbook is meant to teach Prolog as a practical programming tool and so it concentrates on the art of using the basic mechanisms of Prolog to solve interesting problems. The fourth edition has been fully revised and extended to provide an even greater range of applications, making it a self-contained guide to Prolog, AI or AI Programming for students and professional programmers.',62.95, 2003),
(2,'Dušan Kodek','Arhitektura računalniških sistemov','Knjiga Arhitektura in Organizacija Računalniških Sistemov prinaša znanja, ki so potrebna za razumevanje in uporabo današnjih računalnikov. V prvi vrsti je namenjena študentom računalništva in informatike; zanje je razumevanje dogajanja v strojih, ki jim pravimo računalniki, potreba in sestavni del študija. Knjiga bo koristna tudi za vse, ki že dolgo delajo z računalniki in bi radi bolje razumeli dogajanje v njih. Posebno zanimiva bo za sistemske programerje, ki delajo na prevajalnikih in operacijskih sistemih, in ki brez razumevanja pogosto zapletenih podrobnosti v delovanju, ne morejo dobro opraviti svojega dela. V knjigi so temeljna znanja o računalniški organizaciji in arhitekturi združena s poglobljeno obravnavo najnovejših spoznanj. V vseh poglavjih so posebej poudarjeni osnovni principi in rešitve, ki so trajnega pomena. Različni pristopi in rešitve so poleg tega primerjani in analizirani s pomočjo velikega števila iz resničnega sveta vzetih zgledov. V knjigo so vk jučena vsa najpomembnejša področja, med katerimi so računalniška aritmetika, arhitektura ukazov, vsi nivoji pomnilniške hierarhije, vhod/izhod in še posebej arhitektura procesorjev. Podrobno je opisana pot od zasnove procesorja do njegove realizacije, najprej preproste, kasneje pa vse bolj zahtevne in zmogljive. Podan je tudi opis najnovejših rešitev pri superskalarnih procesorjih in način njihovega vključevanja v obstoječe sisteme. Knjiga predstavlja razširjeno in z najnovejšimi spoznanji posodobljeno različico knjige Arhitektura Računalniških Sistemov iz leta 2000.',84.6, 2005),
(3,'Denis Trček','Managing Information Systems Security and Privacy','The book deals with the management of information systems security and privacy, based on a model that covers technological, organizational and legal views. This is the basis for a focused and methodologically structured approach that presents \'the big picture\' of information systems security and privacy, while targeting managers and technical profiles. The book addresses principles in the background, regardless of a particular technology or organization. It enables a reader to suit these principles to an organization\'s needs and to implement them accordingly by using explicit procedures from the book. Additionally, the content is aligned with relevant standards and the latest trends. Scientists from social and technical sciences are supposed to find a framework for further research in this broad area, characterized by a complex interplay between human factors and technical issues.',91.62, 2006);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-12 16:45:04
