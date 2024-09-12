-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Eyl 2024, 13:06:50
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `iptest`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cronlar`
--

CREATE TABLE `cronlar` (
  `CronID` bigint(20) NOT NULL,
  `CronAd` varchar(50) NOT NULL,
  `CronQeyd` text NOT NULL,
  `CronIslemeSayi` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ip`
--

CREATE TABLE `ip` (
  `ID` bigint(20) NOT NULL,
  `IP` varchar(15) NOT NULL,
  `IpNoktesiz` bigint(20) UNSIGNED NOT NULL,
  `IstifadeMeksediID` tinyint(4) NOT NULL,
  `IdareAD` varchar(50) NOT NULL,
  `Teyinati` varchar(50) NOT NULL,
  `BagliCihazinYeri` varchar(255) NOT NULL,
  `BagliCihazinMarkasi` varchar(255) NOT NULL,
  `BagliCihazinModeli` varchar(255) NOT NULL,
  `BagliCihazinMacAdresi` varchar(25) NOT NULL,
  `BagliCihazinAdi` varchar(50) NOT NULL,
  `BagliCihazinGroupu` varchar(100) NOT NULL,
  `BagliCihazinPortSayi` int(11) DEFAULT NULL,
  `SubnetMask` varchar(15) NOT NULL,
  `DefaultGateway` varchar(15) NOT NULL,
  `NVR` varchar(15) NOT NULL,
  `KameraTipi` tinyint(1) NOT NULL DEFAULT 0,
  `NVR_Status` tinyint(1) NOT NULL,
  `AlarmStatusu` int(11) DEFAULT NULL,
  `Alarm` int(11) DEFAULT NULL,
  `MulticastIpBir` varchar(15) DEFAULT NULL,
  `MulticastPortBir` int(11) DEFAULT NULL,
  `MulticastIpIki` varchar(15) DEFAULT NULL,
  `MulticastPortIki` int(11) DEFAULT NULL,
  `UserName` varchar(50) NOT NULL,
  `RAM` varchar(10) DEFAULT NULL,
  `DiskHecmi` varchar(255) DEFAULT NULL,
  `Disk_Tipi` varchar(50) NOT NULL,
  `Processor` varchar(255) NOT NULL,
  `SonCavabTarixi` datetime DEFAULT NULL,
  `IstifadeyeVerildiyiTarix` date DEFAULT NULL,
  `SonDuzelisTarixi` datetime DEFAULT NULL,
  `Qeyd` text DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `TelefonNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ipandmac`
--

CREATE TABLE `ipandmac` (
  `ID` bigint(20) NOT NULL,
  `IP` varchar(15) NOT NULL,
  `MacDate` date NOT NULL,
  `Mac` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `istifademeksedi`
--

CREATE TABLE `istifademeksedi` (
  `IstifadeMeksediID` int(11) NOT NULL,
  `ItifadeYeriAd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ping`
--

CREATE TABLE `ping` (
  `PingID` bigint(20) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `PingTarix` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Statusu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pingatilacaqipler`
--

CREATE TABLE `pingatilacaqipler` (
  `Pinga_Atilacaq_Id` bigint(20) NOT NULL,
  `Ping_Atilacaq_IP` varchar(20) NOT NULL,
  `IP_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pass`) VALUES
(1, 'admin', 'admin');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cronlar`
--
ALTER TABLE `cronlar`
  ADD PRIMARY KEY (`CronID`);

--
-- Tablo için indeksler `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `ipandmac`
--
ALTER TABLE `ipandmac`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `istifademeksedi`
--
ALTER TABLE `istifademeksedi`
  ADD PRIMARY KEY (`IstifadeMeksediID`);

--
-- Tablo için indeksler `ping`
--
ALTER TABLE `ping`
  ADD PRIMARY KEY (`PingID`),
  ADD KEY `IP` (`IP`,`PingTarix`,`Statusu`),
  ADD KEY `PingID` (`PingID`,`IP`,`PingTarix`,`Statusu`);

--
-- Tablo için indeksler `pingatilacaqipler`
--
ALTER TABLE `pingatilacaqipler`
  ADD PRIMARY KEY (`Pinga_Atilacaq_Id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cronlar`
--
ALTER TABLE `cronlar`
  MODIFY `CronID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ip`
--
ALTER TABLE `ip`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ipandmac`
--
ALTER TABLE `ipandmac`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `istifademeksedi`
--
ALTER TABLE `istifademeksedi`
  MODIFY `IstifadeMeksediID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ping`
--
ALTER TABLE `ping`
  MODIFY `PingID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pingatilacaqipler`
--
ALTER TABLE `pingatilacaqipler`
  MODIFY `Pinga_Atilacaq_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
