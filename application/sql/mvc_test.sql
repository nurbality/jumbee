-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 12, 2012 at 03:51 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mvc_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`) VALUES
(5, 'dan@evilf11.com', 'acb2d7d608285caa70a209f2994d754d', 'lbzd210'),
(7, 'dan@evilf11.com', 'b379d9c54472dc69cb611c157ec9db36', 'DannyV'),
(8, 'dan@evilf11.com', 'acb2d7d608285caa70a209f2994d754d', 'DannyV1'),
(9, 'dan@evilf11.com', 'acb2d7d608285caa70a209f2994d754d', 'DannyV12'),
(10, 'dan@evilf11.com', 'b379d9c54472dc69cb611c157ec9db36', 'DannyV121'),
(11, 'dan@evilf11.com', 'b379d9c54472dc69cb611c157ec9db36', 'DannyV1212'),
(12, 'dan@evilf11.com', 'b379d9c54472dc69cb611c157ec9db36', 'DannyV12121'),
(13, 'dan@evilf11.com', 'acb2d7d608285caa70a209f2994d754d', 'DannyV121211'),
(14, 'dan@evilf11.com', 'b379d9c54472dc69cb611c157ec9db36', 'DannyV1212112'),
(15, 'dan@evilf11.com', 'b379d9c54472dc69cb611c157ec9db36', 'DannyV12121121'),
(16, 'dan@evilf11.com', 'acb2d7d608285caa70a209f2994d754d', 'DannyV121211211');

-- --------------------------------------------------------

--
-- Table structure for table `user_attributes`
--

CREATE TABLE IF NOT EXISTS `user_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `attribute` varchar(60) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_attributes`
--

INSERT INTO `user_attributes` (`id`, `userId`, `attribute`, `value`) VALUES
(1, 15, 'first_name', 'Daniel'),
(2, 15, 'last_name', 'Vander Meer'),
(3, 16, 'first_name', 'Daniel'),
(4, 16, 'last_name', 'Vander Meer');

