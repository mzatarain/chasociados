-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 11, 2019 at 10:18 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chasociados`
--

-- --------------------------------------------------------

--
-- Table structure for table `agreement`
--

DROP TABLE IF EXISTS `agreement`;
CREATE TABLE IF NOT EXISTS `agreement` (
  `idAgreement` int(11) NOT NULL AUTO_INCREMENT,
  `idClient` int(11) NOT NULL,
  `initialDebt` int(11) NOT NULL,
  `totalAmountToPay` double NOT NULL,
  `amountToPayByPeriod` double NOT NULL,
  `recurrenceOfPayment` varchar(100) NOT NULL,
  `paymentStartDate` date NOT NULL,
  `lastPaymentDate` date DEFAULT NULL,
  `reAgreement` tinyint(1) NOT NULL,
  PRIMARY KEY (`idAgreement`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agreement`
--

INSERT INTO `agreement` (`idAgreement`, `idClient`, `initialDebt`, `totalAmountToPay`, `amountToPayByPeriod`, `recurrenceOfPayment`, `paymentStartDate`, `lastPaymentDate`, `reAgreement`) VALUES
(116, 7, 11500, 9000, 1000, 'Semanal', '2019-08-26', '2019-09-10', 0),
(117, 5, 70000, 14000, 1000, 'Mensual', '2019-09-02', '2019-09-10', 0),
(118, 4, 86000, 70000, 1000, 'Semanal', '2019-09-07', '2019-09-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(100) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `fLastName` varchar(50) NOT NULL,
  `sLastName` varchar(50) NOT NULL,
  `homePhone` varchar(20) NOT NULL,
  `cellPhone` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `neighborhood` varchar(100) NOT NULL,
  `latitude` varchar(21844) NOT NULL,
  `longitude` varchar(21844) NOT NULL,
  `email` varchar(50) NOT NULL,
  `debt` varchar(100) NOT NULL,
  `hasACar` tinyint(1) NOT NULL,
  `hasAHouse` tinyint(1) NOT NULL,
  `notes` varchar(500) NOT NULL,
  `workplace` varchar(100) NOT NULL,
  `jobPosition` varchar(100) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `workAntiquity` varchar(20) NOT NULL,
  `workphone` varchar(20) NOT NULL,
  `workSchedule` varchar(50) NOT NULL,
  `idPortfolio` int(11) NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`idClient`, `number`, `name`, `fLastName`, `sLastName`, `homePhone`, `cellPhone`, `address`, `neighborhood`, `latitude`, `longitude`, `email`, `debt`, `hasACar`, `hasAHouse`, `notes`, `workplace`, `jobPosition`, `salary`, `workAntiquity`, `workphone`, `workSchedule`, `idPortfolio`) VALUES
(1, '85624210-1', 'Arturo', 'Hernandez', 'Anaya', '565654215', '54648548', 'Av República de Cuba #2098', 'Cuauhtemoc Norte', '32.664720', '-115.442340', 'a.samaniego@gmail.com', '50000', 0, 1, 'Ninguna', 'Skyworks', 'Ingeniero Jr', '20000', '2 años', '54685485541', 'Matutino', 1),
(2, '85624210-2', 'Julian', 'Peña', 'Hernandez', '654613216', '564816518', 'Av Costa Rica 2087', 'Cuauhtemoc Norte', '32.665340', '-115.443040', 'j.hernandez@gmail.com', '18000', 1, 1, 'Ninguna', 'Kenworth', 'Supervisor de línea', '10000', '3 años', '5465168', 'Nocturno', 1),
(4, '1525485-4', 'Joaquín', 'Morales', 'Zamora', '5616865151', '65168651651', 'Herreros #1984', 'Burócratas', '32.656030', '-115.454960', 'joaquinmz@outlook.com', '86000', 0, 1, 'Adeudo con 1 año de atraso', 'Famsa', 'Vendedor', '8000', '4 años', '546168516', 'Vespertino', 2),
(5, '1525485-5', 'José Luis', 'López', 'Morales', '68151515351', '6854561', 'Av Mariano Arista #1232', 'Prohogar', '32.653273', '-115.431600', 'jmorales@gmail.com', '70000', 1, 0, 'Ninguna', 'La Bodega', 'Carrocero', '10000', '3 años', '6825648655', 'Matutino', 2),
(7, '1525485-7', 'Jose', 'Zamora', 'Martinez', '56597842', '68624875211', 'Calle Buenos Aires #2938', 'Cuahutemoc Sur', '32.660853', '-115.441804', 'j.zamora@gmail.com', '11500', 1, 0, 'Adeudo reciente', 'Sony', 'Supervisor de linea', '8000', '1 año', '01254684852', 'Vespertino', 2);

-- --------------------------------------------------------

--
-- Table structure for table `collectioncostpayment`
--

DROP TABLE IF EXISTS `collectioncostpayment`;
CREATE TABLE IF NOT EXISTS `collectioncostpayment` (
  `idCollectionCost` int(11) NOT NULL AUTO_INCREMENT,
  `collectionCostPayment` varchar(50) NOT NULL,
  `collectionCostDate` date NOT NULL,
  `idAgreement` int(11) NOT NULL,
  PRIMARY KEY (`idCollectionCost`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collectioncostpayment`
--

INSERT INTO `collectioncostpayment` (`idCollectionCost`, `collectionCostPayment`, `collectionCostDate`, `idAgreement`) VALUES
(2, '100', '2019-09-11', 116),
(8, '100', '2019-09-11', 117),
(7, '50', '2019-09-11', 116);

-- --------------------------------------------------------

--
-- Table structure for table `dayslate`
--

DROP TABLE IF EXISTS `dayslate`;
CREATE TABLE IF NOT EXISTS `dayslate` (
  `idDayLate` int(11) NOT NULL AUTO_INCREMENT,
  `day` date NOT NULL,
  `idPayment` int(11) NOT NULL,
  PRIMARY KEY (`idDayLate`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `idEmployee` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `fLastName` varchar(60) NOT NULL,
  `sLastName` varchar(60) NOT NULL,
  `jobPosition` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `workPhone` varchar(20) DEFAULT NULL,
  `personalPhone` varchar(20) NOT NULL,
  PRIMARY KEY (`idEmployee`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`idEmployee`, `name`, `fLastName`, `sLastName`, `jobPosition`, `email`, `password`, `workPhone`, `personalPhone`) VALUES
(1, 'Manuel', 'Rodríguez', 'Zatarain', 'Admin', 'm.zatarain@hotmail.com', 'silence1', '526865659484', '526862279910'),
(3, 'Arturo', 'Samaniego', 'Jiménez', 'Admin', 'Sandman@gmail.com', 'SA&q9\"yhe.q63K', '5465489452', '5621561'),
(4, 'Daniel', 'Méndez', 'Herrera', 'Cobrador', 'd.herrera@gmail.com', 'abcdehjh', '65456486231', '5451351'),
(2, 'Laura', 'Rodríguez', 'Fuentes', 'Cobrador', 'laura.fuentes@gmail.com', 'abcde', '12345612354', '748592');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `idPayment` int(11) NOT NULL AUTO_INCREMENT,
  `paymentName` varchar(50) NOT NULL,
  `amountToPay` double NOT NULL,
  `paymentDueDate` date NOT NULL,
  `alreadyPaid` tinyint(4) NOT NULL,
  `paymentDate` date DEFAULT NULL,
  `collectionCost` varchar(50) NOT NULL DEFAULT '0',
  `collectionCostDate` date DEFAULT NULL,
  `idEmployee` int(11) DEFAULT NULL,
  `idAgreement` int(11) NOT NULL,
  PRIMARY KEY (`idPayment`)
) ENGINE=MyISAM AUTO_INCREMENT=838 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`idPayment`, `paymentName`, `amountToPay`, `paymentDueDate`, `alreadyPaid`, `paymentDate`, `collectionCost`, `collectionCostDate`, `idEmployee`, `idAgreement`) VALUES
(745, 'Pago 1', 1000, '2019-08-21', 1, '2019-08-23', '0', NULL, 2, 116),
(746, 'Pago 2', 1000, '2019-08-22', 1, '2019-08-25', '0', NULL, 1, 116),
(747, 'Pago 3', 1000, '2019-08-24', 1, '2019-08-28', '0', NULL, 1, 116),
(748, 'Pago 4', 1000, '2019-08-27', 1, '2019-09-07', '0', NULL, 3, 116),
(749, 'Pago 5', 1000, '2019-07-30', 1, '2019-09-10', '0', NULL, 1, 116),
(750, 'Pago 6', 1000, '2019-08-30', 1, '2019-09-10', '0', NULL, 1, 116),
(751, 'Pago 7', 1000, '2019-10-07', 0, NULL, '200', '2019-09-11', NULL, 116),
(752, 'Pago 8', 1000, '2019-10-14', 0, NULL, '0', NULL, NULL, 116),
(753, 'Pago 9', 1000, '2019-10-21', 0, NULL, '0', NULL, NULL, 116),
(754, 'Pago 1', 1000, '2019-09-02', 1, '2019-09-10', '0', NULL, 1, 117),
(755, 'Pago 2', 1000, '2019-10-02', 0, NULL, '0', NULL, NULL, 117),
(756, 'Pago 3', 1000, '2019-11-02', 0, NULL, '200', '2019-09-11', NULL, 117),
(757, 'Pago 4', 1000, '2019-12-02', 0, NULL, '0', NULL, NULL, 117),
(758, 'Pago 5', 1000, '2020-01-02', 0, NULL, '0', NULL, NULL, 117),
(759, 'Pago 6', 1000, '2020-02-02', 0, NULL, '0', NULL, NULL, 117),
(760, 'Pago 7', 1000, '2020-03-02', 0, NULL, '0', NULL, NULL, 117),
(761, 'Pago 8', 1000, '2020-04-02', 0, NULL, '0', NULL, NULL, 117),
(762, 'Pago 9', 1000, '2020-05-02', 0, NULL, '0', NULL, NULL, 117),
(763, 'Pago 10', 1000, '2020-06-02', 0, NULL, '0', NULL, NULL, 117),
(764, 'Pago 11', 1000, '2020-07-02', 0, NULL, '0', NULL, NULL, 117),
(765, 'Pago 12', 1000, '2020-08-02', 0, NULL, '0', NULL, NULL, 117),
(766, 'Pago 13', 1000, '2020-09-02', 0, NULL, '0', NULL, NULL, 117),
(767, 'Pago 14', 1000, '2020-10-02', 0, NULL, '0', NULL, NULL, 117),
(768, 'Pago 1', 1000, '2019-09-07', 1, '2019-09-10', '0', NULL, NULL, 118),
(769, 'Pago 2', 1000, '2019-09-14', 0, NULL, '0', NULL, NULL, 118),
(770, 'Pago 3', 1000, '2019-09-21', 0, NULL, '0', NULL, NULL, 118),
(771, 'Pago 4', 1000, '2019-09-28', 0, NULL, '0', NULL, NULL, 118),
(772, 'Pago 5', 1000, '2019-10-05', 0, NULL, '0', NULL, NULL, 118),
(773, 'Pago 6', 1000, '2019-10-12', 0, NULL, '0', NULL, NULL, 118),
(774, 'Pago 7', 1000, '2019-10-19', 0, NULL, '0', NULL, NULL, 118),
(775, 'Pago 8', 1000, '2019-10-26', 0, NULL, '0', NULL, NULL, 118),
(776, 'Pago 9', 1000, '2019-11-02', 0, NULL, '0', NULL, NULL, 118),
(777, 'Pago 10', 1000, '2019-11-09', 0, NULL, '0', NULL, NULL, 118),
(778, 'Pago 11', 1000, '2019-11-16', 0, NULL, '0', NULL, NULL, 118),
(779, 'Pago 12', 1000, '2019-11-23', 0, NULL, '0', NULL, NULL, 118),
(780, 'Pago 13', 1000, '2019-11-30', 0, NULL, '0', NULL, NULL, 118),
(781, 'Pago 14', 1000, '2019-12-07', 0, NULL, '0', NULL, NULL, 118),
(782, 'Pago 15', 1000, '2019-12-14', 0, NULL, '0', NULL, NULL, 118),
(783, 'Pago 16', 1000, '2019-12-21', 0, NULL, '0', NULL, NULL, 118),
(784, 'Pago 17', 1000, '2019-12-28', 0, NULL, '0', NULL, NULL, 118),
(785, 'Pago 18', 1000, '2020-01-04', 0, NULL, '0', NULL, NULL, 118),
(786, 'Pago 19', 1000, '2020-01-11', 0, NULL, '0', NULL, NULL, 118),
(787, 'Pago 20', 1000, '2020-01-18', 0, NULL, '0', NULL, NULL, 118),
(788, 'Pago 21', 1000, '2020-01-25', 0, NULL, '0', NULL, NULL, 118),
(789, 'Pago 22', 1000, '2020-02-01', 0, NULL, '0', NULL, NULL, 118),
(790, 'Pago 23', 1000, '2020-02-08', 0, NULL, '0', NULL, NULL, 118),
(791, 'Pago 24', 1000, '2020-02-15', 0, NULL, '0', NULL, NULL, 118),
(792, 'Pago 25', 1000, '2020-02-22', 0, NULL, '0', NULL, NULL, 118),
(793, 'Pago 26', 1000, '2020-02-29', 0, NULL, '0', NULL, NULL, 118),
(794, 'Pago 27', 1000, '2020-03-07', 0, NULL, '0', NULL, NULL, 118),
(795, 'Pago 28', 1000, '2020-03-14', 0, NULL, '0', NULL, NULL, 118),
(796, 'Pago 29', 1000, '2020-03-21', 0, NULL, '0', NULL, NULL, 118),
(797, 'Pago 30', 1000, '2020-03-28', 0, NULL, '0', NULL, NULL, 118),
(798, 'Pago 31', 1000, '2020-04-04', 0, NULL, '0', NULL, NULL, 118),
(799, 'Pago 32', 1000, '2020-04-11', 0, NULL, '0', NULL, NULL, 118),
(800, 'Pago 33', 1000, '2020-04-18', 0, NULL, '0', NULL, NULL, 118),
(801, 'Pago 34', 1000, '2020-04-25', 0, NULL, '0', NULL, NULL, 118),
(802, 'Pago 35', 1000, '2020-05-02', 0, NULL, '0', NULL, NULL, 118),
(803, 'Pago 36', 1000, '2020-05-09', 0, NULL, '0', NULL, NULL, 118),
(804, 'Pago 37', 1000, '2020-05-16', 0, NULL, '0', NULL, NULL, 118),
(805, 'Pago 38', 1000, '2020-05-23', 0, NULL, '0', NULL, NULL, 118),
(806, 'Pago 39', 1000, '2020-05-30', 0, NULL, '0', NULL, NULL, 118),
(807, 'Pago 40', 1000, '2020-06-06', 0, NULL, '0', NULL, NULL, 118),
(808, 'Pago 41', 1000, '2020-06-13', 0, NULL, '0', NULL, NULL, 118),
(809, 'Pago 42', 1000, '2020-06-20', 0, NULL, '0', NULL, NULL, 118),
(810, 'Pago 43', 1000, '2020-06-27', 0, NULL, '0', NULL, NULL, 118),
(811, 'Pago 44', 1000, '2020-07-04', 0, NULL, '0', NULL, NULL, 118),
(812, 'Pago 45', 1000, '2020-07-11', 0, NULL, '0', NULL, NULL, 118),
(813, 'Pago 46', 1000, '2020-07-18', 0, NULL, '0', NULL, NULL, 118),
(814, 'Pago 47', 1000, '2020-07-25', 0, NULL, '0', NULL, NULL, 118),
(815, 'Pago 48', 1000, '2020-08-01', 0, NULL, '0', NULL, NULL, 118),
(816, 'Pago 49', 1000, '2020-08-08', 0, NULL, '0', NULL, NULL, 118),
(817, 'Pago 50', 1000, '2020-08-15', 0, NULL, '0', NULL, NULL, 118),
(818, 'Pago 51', 1000, '2020-08-22', 0, NULL, '0', NULL, NULL, 118),
(819, 'Pago 52', 1000, '2020-08-29', 0, NULL, '0', NULL, NULL, 118),
(820, 'Pago 53', 1000, '2020-09-05', 0, NULL, '0', NULL, NULL, 118),
(821, 'Pago 54', 1000, '2020-09-12', 0, NULL, '0', NULL, NULL, 118),
(822, 'Pago 55', 1000, '2020-09-19', 0, NULL, '0', NULL, NULL, 118),
(823, 'Pago 56', 1000, '2020-09-26', 0, NULL, '0', NULL, NULL, 118),
(824, 'Pago 57', 1000, '2020-10-03', 0, NULL, '0', NULL, NULL, 118),
(825, 'Pago 58', 1000, '2020-10-10', 0, NULL, '0', NULL, NULL, 118),
(826, 'Pago 59', 1000, '2020-10-17', 0, NULL, '0', NULL, NULL, 118),
(827, 'Pago 60', 1000, '2020-10-24', 0, NULL, '0', NULL, NULL, 118),
(828, 'Pago 61', 1000, '2020-10-31', 0, NULL, '0', NULL, NULL, 118),
(829, 'Pago 62', 1000, '2020-11-07', 0, NULL, '0', NULL, NULL, 118),
(830, 'Pago 63', 1000, '2020-11-14', 0, NULL, '0', NULL, NULL, 118),
(831, 'Pago 64', 1000, '2020-11-21', 0, NULL, '0', NULL, NULL, 118),
(832, 'Pago 65', 1000, '2020-11-28', 0, NULL, '0', NULL, NULL, 118),
(833, 'Pago 66', 1000, '2020-12-05', 0, NULL, '0', NULL, NULL, 118),
(834, 'Pago 67', 1000, '2020-12-12', 0, NULL, '0', NULL, NULL, 118),
(835, 'Pago 68', 1000, '2020-12-19', 0, NULL, '0', NULL, NULL, 118),
(836, 'Pago 69', 1000, '2020-12-26', 0, NULL, '0', NULL, NULL, 118),
(837, 'Pago 70', 1000, '2021-01-02', 0, NULL, '0', NULL, NULL, 118);

-- --------------------------------------------------------

--
-- Table structure for table `penaltyfeepayment`
--

DROP TABLE IF EXISTS `penaltyfeepayment`;
CREATE TABLE IF NOT EXISTS `penaltyfeepayment` (
  `idPenaltyFeePayment` int(11) NOT NULL AUTO_INCREMENT,
  `penaltyFeePayment` varchar(50) NOT NULL,
  `penaltyFeePaymentDate` date NOT NULL,
  `idAgreement` int(11) NOT NULL,
  PRIMARY KEY (`idPenaltyFeePayment`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penaltyfeepayment`
--

INSERT INTO `penaltyfeepayment` (`idPenaltyFeePayment`, `penaltyFeePayment`, `penaltyFeePaymentDate`, `idAgreement`) VALUES
(1, '200', '2019-09-10', 116);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE IF NOT EXISTS `portfolio` (
  `idPortfolio` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(100) DEFAULT NULL,
  `source` varchar(100) NOT NULL,
  `dateOfPurchase` date NOT NULL,
  `amountOfAccounts` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPortfolio`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`idPortfolio`, `number`, `source`, `dateOfPurchase`, `amountOfAccounts`) VALUES
(1, '85624210', 'Banorte', '2019-07-18', 48),
(2, '1525485', 'Banamex', '2019-07-16', 30),
(4, '152654', 'Santander', '2019-06-18', 80),
(5, '1521025', 'HSBC', '2019-05-08', 91),
(7, '152585', 'BBVA', '2019-07-17', 30),
(8, '1525846', 'HSBC', '2019-07-12', 12),
(9, '1524565', 'Santander', '2019-07-12', 19),
(6, '152485', 'Inbursa', '2019-07-17', 18),
(10, '251515', 'Bancomer', '2019-09-10', 15);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
