-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 08 Haz 2019, 10:56:12
-- Sunucu sürümü: 10.3.14-MariaDB-cll-lve
-- PHP Sürümü: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `datasoli_hastane`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doktorlar`
--

CREATE TABLE `doktorlar` (
  `doktorlarID` int(11) NOT NULL,
  `doktorlarAdSoyad` varchar(255) NOT NULL,
  `doktorlarBolumID` int(11) NOT NULL,
  `doktorlarGorsel` varchar(255) NOT NULL,
  `doktorlarHastaneID` int(11) NOT NULL,
  `doktorlarTel` varchar(255) NOT NULL,
  `doktorlarMail` varchar(255) NOT NULL,
  `doktorlarAciklama` text NOT NULL,
  `doktorlarEklenmeTarihi` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `doktorlar`
--

INSERT INTO `doktorlar` (`doktorlarID`, `doktorlarAdSoyad`, `doktorlarBolumID`, `doktorlarGorsel`, `doktorlarHastaneID`, `doktorlarTel`, `doktorlarMail`, `doktorlarAciklama`, `doktorlarEklenmeTarihi`) VALUES
(4, 'Dt. Hacı Mehmet KUTUP', 5, 'doktor_6387.jpg', 5, '', 'mehmet.kutup@medipol.com.tr', '<p>Uluslararası hakemli dergilerde yayınlanan makaleler -SCI &amp; SSCI &amp; Arts and Humanities-,</p>\r\n', '2019-02-09 18:21:20'),
(5, 'Uzm. Dr. Berna EROL', 6, 'doktor_1920.jpg', 5, '', ' berna.erol@medipol.com.tr', '<p>1-) Travma Res&uuml;sitasyon Kursu (Ulusal travma ve Acil Cerrahi Derneği): 26-29 Kasım 2013</p>\r\n\r\n<p>2-) &Ccedil;SGB İşyeri Hekimliği Sertifika Programı: Ocak 2012&nbsp;</p>\r\n', '2019-02-09 18:23:37'),
(6, 'Uzm. Dr. Filiz ARSLAN', 7, 'doktor_9902.png', 5, '', 'filiz.arslan@medipol.com.tr', '<p>1. Aspirasyon pnomonisinde yeni yaklaşımlar</p>\r\n\r\n<p>2. Asperjillus pnomonisi ve sepsisinde tedavi</p>\r\n', '2019-02-09 18:26:39'),
(7, 'Uzm. Dr. Hafize Gülşah ÖZCAN', 7, 'doktor_4576.jpg', 5, '', 'gulsah.ozcan@medipol.com.tr', '<p>Anatomi ve anestezi g&uuml;nleri</p>\r\n', '2019-02-09 18:28:26'),
(8, 'Doktor Nuri Güzel Ayer', 3, 'doktor_5264.jpg', 2, '', 'nuri.guzel@kutahyahastanesi.com.tr', '<p>G&ouml;z Sağlığı ve Hastalıkları&nbsp;uzmanı</p>\r\n', '2019-02-09 18:37:19'),
(9, 'Dr. Kıvanç Şahin ', 22, 'doktor_2426.jpg', 2, '', 'kivanc.sahin@acibadem.com', '<p>Acıbadem Kayseri Hastanesi Kadın Hastalıkları ve Doğum B&ouml;l&uuml;m&uuml; ekibine katılan Dr. Kıvan&ccedil; Şahin, 2010 yılından beri Kadın Hastalıkları ve Doğum Uzmanı olarak g&ouml;rev yapıyor.</p>\r\n', '2019-02-09 18:56:08'),
(10, 'debneme', 2, 'doktor_6294.jpg', 2, '6336', 'UILI', '<p>DFERGRGR</p>\r\n', '2019-06-01 16:51:02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hastaneGorseller`
--

CREATE TABLE `hastaneGorseller` (
  `hastaneGorsellerID` int(11) NOT NULL,
  `hastaneGorsellerHastaneID` int(11) NOT NULL,
  `hastaneGorseli` varchar(255) NOT NULL,
  `hastaneGorsellerSirasi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `hastaneGorseller`
--

INSERT INTO `hastaneGorseller` (`hastaneGorsellerID`, `hastaneGorsellerHastaneID`, `hastaneGorseli`, `hastaneGorsellerSirasi`) VALUES
(4, 2, 'hastane_3683.jpg', 2),
(3, 2, 'hastane_6251.jpg', 1),
(5, 2, 'hastane_9629.jpg', 3),
(6, 2, 'hastane_1594.jpg', 4),
(7, 2, 'hastane_2414.jpg', 5),
(8, 2, 'hastane_8462.jpg', 7),
(9, 4, 'hastane_7126.jpg', 1),
(10, 4, 'hastane_6104.jpg', 2),
(11, 4, 'hastane_4813.png', 3),
(12, 4, 'hastane_1835.jpg', 4),
(13, 5, 'hastane_2326.jpg', 1),
(14, 5, 'hastane_9390.jpg', 2),
(15, 5, 'hastane_8555.jpg', 3),
(16, 5, 'hastane_4641.jpg', 5),
(17, 6, 'hastane_5027.jpg', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hastaneler`
--

CREATE TABLE `hastaneler` (
  `hastanelerID` int(11) NOT NULL,
  `hastanelerAdi` varchar(255) NOT NULL,
  `hastanelerAciklama` text NOT NULL,
  `hastanelerXkoordinat` double NOT NULL,
  `hastanelerYkoordinat` double NOT NULL,
  `hastanelerKapakGorsel` varchar(255) NOT NULL,
  `hastanelerEklenmeTarihi` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `hastaneler`
--

INSERT INTO `hastaneler` (`hastanelerID`, `hastanelerAdi`, `hastanelerAciklama`, `hastanelerXkoordinat`, `hastanelerYkoordinat`, `hastanelerKapakGorsel`, `hastanelerEklenmeTarihi`) VALUES
(2, 'Acıbadem Hastanesi', '<ul>\r\n	<li>Acıbadem Hastanesi</li>\r\n</ul>\r\n', 33, 33, 'hastaneKapak_8717.jpg', '2019-01-22 19:05:07'),
(4, 'Koru Hastanesi', '<ul>\r\n	<li>Koru Hastanesi</li>\r\n</ul>\r\n', 42, 20, 'hastaneKapak_5111.png', '2019-02-09 17:58:27'),
(5, 'Medipol Hastanesi', '<p>Medipol Hastanesi</p>\r\n', 30, 30, 'hastaneKapak_2214.jpg', '2019-02-09 18:11:56'),
(6, 'deneme', '<p>wfefdgdfgd</p>\r\n', 33, 45, 'hastaneKapak_4232.jpg', '2019-06-01 16:38:28');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `istatistik`
--

CREATE TABLE `istatistik` (
  `istatistikID` int(11) NOT NULL,
  `istatistikBilgi` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `istatistik`
--

INSERT INTO `istatistik` (`istatistikID`, `istatistikBilgi`) VALUES
(1, '<h1>Deneme istatistik.<strong>150&nbsp; &nbsp; &nbsp; debenece&nbsp;</strong></h1>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `popular`
--

CREATE TABLE `popular` (
  `popularID` int(11) NOT NULL,
  `popularTipi` int(11) NOT NULL COMMENT '1 ise doktor 2 ise hastane',
  `popularOlanID` int(11) NOT NULL,
  `popularSirasi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `popular`
--

INSERT INTO `popular` (`popularID`, `popularTipi`, `popularOlanID`, `popularSirasi`) VALUES
(2, 2, 2, 55);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tipAltBolumHatane`
--

CREATE TABLE `tipAltBolumHatane` (
  `tipAltBolumHataneID` int(11) NOT NULL,
  `tipAltBolumHataneHastaneID` int(11) NOT NULL,
  `tipAltBolumHataneBolumID` int(11) NOT NULL,
  `tipAltBolumHataneTutar` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tipAltBolumHatane`
--

INSERT INTO `tipAltBolumHatane` (`tipAltBolumHataneID`, `tipAltBolumHataneHastaneID`, `tipAltBolumHataneBolumID`, `tipAltBolumHataneTutar`) VALUES
(2, 2, 2, 240),
(4, 2, 3, 555);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tipAltBolumleri`
--

CREATE TABLE `tipAltBolumleri` (
  `tipAltBolumleriID` int(11) NOT NULL,
  `tipAltBolumleriBolumID` int(11) NOT NULL,
  `tipAltBolumleriTanim` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tipAltBolumleri`
--

INSERT INTO `tipAltBolumleri` (`tipAltBolumleriID`, `tipAltBolumleriBolumID`, `tipAltBolumleriTanim`) VALUES
(2, 2, 'deneme 3'),
(3, 3, 'KONEA NAAKLİ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tipBolumHatsane`
--

CREATE TABLE `tipBolumHatsane` (
  `tipBolumHatsaneID` int(11) NOT NULL,
  `tipBolumHatsaneTipID` int(11) NOT NULL,
  `tipBolumHatsaneHastaneID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tipBolumHatsane`
--

INSERT INTO `tipBolumHatsane` (`tipBolumHatsaneID`, `tipBolumHatsaneTipID`, `tipBolumHatsaneHastaneID`) VALUES
(2, 2, 2),
(3, 3, 2),
(4, 6, 2),
(5, 5, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tipBolumleri`
--

CREATE TABLE `tipBolumleri` (
  `tipBolumleriID` int(11) NOT NULL,
  `tipBolumleriAdi` varchar(255) NOT NULL,
  `tipBolumleriAciklama` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tipBolumleri`
--

INSERT INTO `tipBolumleri` (`tipBolumleriID`, `tipBolumleriAdi`, `tipBolumleriAciklama`) VALUES
(2, 'İç Hastalıkları', '<p>İ&ccedil; Hastalıkları</p>\r\n'),
(3, 'Göz Hastalıkları', '<p>G&ouml;z Hastalıkları</p>\r\n'),
(4, 'Psikoloji', '<p>Psikoloji</p>\r\n'),
(5, 'Ağız, Diş ve Çene Hastalıkları', '<p>Ağız, Diş ve &Ccedil;ene Hastalıkları Kliniğimizde verilen hizmetler:</p>\r\n'),
(6, 'Aile Hekimi', '<h3>Aile Hekimi</h3>\r\n'),
(7, 'Anesteziyoloji ve Reanimasyon', '<h3>Anesteziyoloji ve Reanimasyon</h3>\r\n'),
(22, 'Kadın Hastalıkları ve Doğum', '<p>Kadın Hastalıkları ve Doğum</p>\r\n'),
(9, 'Beyin, Omurilik ve Sinir Cerrahisi', '<h3>Beyin, Omurilik ve Sinir Cerrahisi</h3>\r\n'),
(10, 'Biyokimya ve Klinik Biyokimya', '<h3>Biyokimya ve Klinik Biyokimya</h3>\r\n'),
(11, 'Cildiye', '<h3>Cildiye</h3>\r\n'),
(12, 'Çocuk Kardiyolojisi', '<h3>&Ccedil;ocuk Kardiyolojisi</h3>\r\n'),
(13, 'Dahiliye', '<h3>Dahiliye</h3>\r\n'),
(14, 'Endokrinoloji ve Metabolizma Hastalıkları', '<h3>Endokrinoloji ve Metabolizma Hastalıkları</h3>\r\n'),
(15, 'Enfeksiyon Hastalıkları ve Klinik Mikrobiyoloji', '<h3>Enfeksiyon Hastalıkları ve Klinik Mikrobiyoloji</h3>\r\n'),
(16, 'Estetik, Plastik ve Rekanstrüktif Cerrahi', '<h3>Estetik, Plastik ve Rekanstr&uuml;ktif Cerrahi</h3>\r\n'),
(17, 'Fizik Tedavi ve Rehabilitasyon', '<h3>Fizik Tedavi ve Rehabilitasyon</h3>\r\n'),
(18, 'Gastroenteroloji', '<h3>Gastroenteroloji</h3>\r\n'),
(19, 'Genel Cerrahi', '<h3>Genel Cerrahi</h3>\r\n'),
(20, 'Göğüs Hastalıkları', '<h3>G&ouml;ğ&uuml;s Hastalıkları</h3>\r\n'),
(23, 'denem', '<p>sdcdsvs</p>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `uyelerID` int(11) NOT NULL,
  `uyelerAdSoyad` varchar(255) NOT NULL,
  `uyelerMail` varchar(255) NOT NULL,
  `uyelerTel` varchar(15) NOT NULL,
  `uyelerSifre` varchar(255) NOT NULL,
  `uyelerYetki` int(11) NOT NULL COMMENT '1 ise yönetici 2 ise uye',
  `uyelerKayitTarihi` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`uyelerID`, `uyelerAdSoyad`, `uyelerMail`, `uyelerTel`, `uyelerSifre`, `uyelerYetki`, `uyelerKayitTarihi`) VALUES
(2, 'emre', 'emre@emre.com', '05343381468', '16400', 1, '2019-01-25 16:17:53'),
(4, 'Demo', 'demo@demo.com', '444444', 'demo123', 1, '2019-02-17 18:15:30'),
(5, 'denem', 'emre@emrea.com', '5466464664', '', 1, '2019-06-01 16:44:39');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorumlarID` int(11) NOT NULL,
  `yorumlarTipi` int(11) NOT NULL COMMENT '1 ise doktor 2 ise hastane',
  `yorumlarYapilanID` int(11) NOT NULL,
  `yorumlarYapanID` int(11) NOT NULL,
  `yorumlarPuan` float NOT NULL,
  `yorumlarYorum` text NOT NULL,
  `yorumlarOnay` tinyint(1) NOT NULL COMMENT '1 ise onaylanmıştır',
  `yorumlarEklenmeTarihi` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`yorumlarID`, `yorumlarTipi`, `yorumlarYapilanID`, `yorumlarYapanID`, `yorumlarPuan`, `yorumlarYorum`, `yorumlarOnay`, `yorumlarEklenmeTarihi`) VALUES
(16, 2, 2, 2, 3.5, '<p>ufjf</p>\r\n', 1, '2019-02-09 20:41:39'),
(15, 2, 2, 2, 3.5, '<p>ufjf</p>\r\n', 1, '2019-02-09 20:41:39'),
(14, 2, 2, 2, 4, '<p>ufjf</p>\r\n', 1, '2019-02-09 20:41:39'),
(13, 2, 2, 2, 3.5, '<p>ufjf</p>\r\n', 1, '2019-02-09 20:41:39'),
(12, 2, 2, 2, 3.5, '<p>bxbx</p>\r\n', 1, '2019-02-09 20:41:34'),
(9, 1, 5, 2, 4.5, '<p>fff</p>\r\n', 1, '2019-02-09 20:36:03'),
(10, 1, 5, 2, 4.5, 'g', 1, '2019-02-09 20:36:07'),
(11, 1, 5, 2, 3, '<p>ufjf</p>\r\n', 1, '2019-02-09 20:36:11'),
(17, 1, 5, 2, 3, '<p>ufjf</p>\r\n', 1, '2019-02-09 20:36:11'),
(18, 1, 5, 2, 3, '<p>ufjf</p>\r\n', 1, '2019-02-09 20:36:11'),
(19, 1, 4, 2, 4, 'ghfg', 0, '2019-02-10 15:34:52'),
(20, 2, 6, 2, 3.5, '<p>deneme yorum</p>\r\n', 1, '2019-06-01 16:42:26');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `doktorlar`
--
ALTER TABLE `doktorlar`
  ADD PRIMARY KEY (`doktorlarID`);

--
-- Tablo için indeksler `hastaneGorseller`
--
ALTER TABLE `hastaneGorseller`
  ADD PRIMARY KEY (`hastaneGorsellerID`);

--
-- Tablo için indeksler `hastaneler`
--
ALTER TABLE `hastaneler`
  ADD PRIMARY KEY (`hastanelerID`);

--
-- Tablo için indeksler `istatistik`
--
ALTER TABLE `istatistik`
  ADD PRIMARY KEY (`istatistikID`);

--
-- Tablo için indeksler `popular`
--
ALTER TABLE `popular`
  ADD PRIMARY KEY (`popularID`);

--
-- Tablo için indeksler `tipAltBolumHatane`
--
ALTER TABLE `tipAltBolumHatane`
  ADD PRIMARY KEY (`tipAltBolumHataneID`);

--
-- Tablo için indeksler `tipAltBolumleri`
--
ALTER TABLE `tipAltBolumleri`
  ADD PRIMARY KEY (`tipAltBolumleriID`);

--
-- Tablo için indeksler `tipBolumHatsane`
--
ALTER TABLE `tipBolumHatsane`
  ADD PRIMARY KEY (`tipBolumHatsaneID`);

--
-- Tablo için indeksler `tipBolumleri`
--
ALTER TABLE `tipBolumleri`
  ADD PRIMARY KEY (`tipBolumleriID`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`uyelerID`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorumlarID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `doktorlar`
--
ALTER TABLE `doktorlar`
  MODIFY `doktorlarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `hastaneGorseller`
--
ALTER TABLE `hastaneGorseller`
  MODIFY `hastaneGorsellerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `hastaneler`
--
ALTER TABLE `hastaneler`
  MODIFY `hastanelerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `istatistik`
--
ALTER TABLE `istatistik`
  MODIFY `istatistikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `popular`
--
ALTER TABLE `popular`
  MODIFY `popularID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `tipAltBolumHatane`
--
ALTER TABLE `tipAltBolumHatane`
  MODIFY `tipAltBolumHataneID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `tipAltBolumleri`
--
ALTER TABLE `tipAltBolumleri`
  MODIFY `tipAltBolumleriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `tipBolumHatsane`
--
ALTER TABLE `tipBolumHatsane`
  MODIFY `tipBolumHatsaneID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `tipBolumleri`
--
ALTER TABLE `tipBolumleri`
  MODIFY `tipBolumleriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `uyelerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorumlarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
