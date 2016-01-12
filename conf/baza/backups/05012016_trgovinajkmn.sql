-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2016 at 06:58 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trgovinajkmn`
--

-- --------------------------------------------------------

--
-- Table structure for table `Izdelek`
--

CREATE TABLE IF NOT EXISTS `Izdelek` (
  `idIzdelek` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `opis` varchar(256) NOT NULL,
  `cena` double NOT NULL,
  `aktivno` tinyint(1) NOT NULL,
  PRIMARY KEY (`idIzdelek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Narocilo`
--

CREATE TABLE IF NOT EXISTS `Narocilo` (
  `idNarocilo` int(11) NOT NULL AUTO_INCREMENT,
  `cenaSkupaj` double NOT NULL,
  `status` int(11) NOT NULL,
  `idStranke` int(11) NOT NULL,
  `datumOddaje` datetime NOT NULL,
  `idProdajalca` int(11) DEFAULT NULL,
  `datumPotrditve` datetime DEFAULT NULL,
  PRIMARY KEY (`idNarocilo`),
  KEY `fk_Narocilo_Uporabnik1_idx` (`idStranke`),
  KEY `fk_Narocilo_Uporabnik2_idx` (`idProdajalca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `OcenaIzdelka`
--

CREATE TABLE IF NOT EXISTS `OcenaIzdelka` (
  `idUporabnik` int(11) NOT NULL,
  `idIzdelek` int(11) NOT NULL,
  `ocena` int(11) NOT NULL,
  PRIMARY KEY (`idUporabnik`,`idIzdelek`),
  KEY `fk_OcenaIzdelka_Uporabnik1_idx` (`idUporabnik`),
  KEY `fk_OcenaIzdelka_Izdelek1_idx` (`idIzdelek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Posta`
--

CREATE TABLE IF NOT EXISTS `Posta` (
  `postnaSt` int(11) NOT NULL,
  `imePoste` varchar(45) NOT NULL,
  PRIMARY KEY (`postnaSt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Posta`
--

INSERT INTO `Posta` (`postnaSt`, `imePoste`) VALUES
(1000, 'Ljubljana'),
(1001, 'Ljubljana - poštni predali'),
(1210, 'Ljubljana - Šentvid'),
(1211, 'Ljubljana - Šmartno'),
(1215, 'Medvode'),
(1216, 'Smlednik'),
(1217, 'Vodice'),
(1218, 'Komenda'),
(1219, 'Laze v Tuhinju'),
(1221, 'Motnik'),
(1222, 'Trojane'),
(1223, 'Blagovica'),
(1225, 'Lukovica'),
(1230, 'Domžale'),
(1231, 'Ljubljana - Črnuče'),
(1232, 'Vir pri Domžalah'),
(1233, 'Dob'),
(1234, 'Mengeš'),
(1235, 'Radomlje'),
(1236, 'Trzin'),
(1241, 'Kamnik'),
(1242, 'Stahovica'),
(1251, 'Moravče'),
(1252, 'Vače'),
(1260, 'Ljubljana - Polje'),
(1261, 'Ljubljana - Dobrunje'),
(1262, 'Dol pri Ljubljani'),
(1270, 'Litija'),
(1272, 'Polšnik'),
(1273, 'Dole pri Litiji'),
(1274, 'Gabrovka'),
(1275, 'Šmartno pri Litiji'),
(1276, 'Primskovo'),
(1281, 'Kresnice'),
(1282, 'Sava'),
(1290, 'Grosuplje'),
(1291, 'Škofljica'),
(1292, 'Ig'),
(1293, 'Šmarje - Sap'),
(1294, 'Višnja Gora'),
(1295, 'Ivančna Gorica'),
(1296, 'Šentvid pri Stični'),
(1301, 'Krka'),
(1303, 'Zagradec'),
(1310, 'Ribnica'),
(1311, 'Turjak'),
(1312, 'Videm - Dobrepolje'),
(1313, 'Struge'),
(1314, 'Rob'),
(1315, 'Velike Lašče'),
(1316, 'Ortnek'),
(1317, 'Sodražica'),
(1318, 'Loški Potok'),
(1319, 'Draga'),
(1330, 'Kočevje'),
(1331, 'Dolenja vas'),
(1332, 'Stara Cerkev'),
(1336, 'Vas'),
(1337, 'Osilnica'),
(1338, 'Kočevska Reka'),
(1351, 'Brezovica pri Ljubljani'),
(1352, 'Preserje'),
(1353, 'Borovnica'),
(1354, 'Horjul'),
(1355, 'Polhov Gradec'),
(1356, 'Dobrova'),
(1357, 'Notranje Gorice'),
(1358, 'Log pri Brezovici'),
(1360, 'Vrhnika'),
(1370, 'Logatec'),
(1372, 'Hotedršica'),
(1373, 'Rovte'),
(1380, 'Cerknica'),
(1381, 'Rakek'),
(1382, 'Begunje pri Cerknici'),
(1384, 'Grahovo'),
(1385, 'Nova vas'),
(1386, 'Stari trg pri Ložu'),
(1410, 'Zagorje ob Savi'),
(1411, 'Izlake'),
(1412, 'Kisovec'),
(1413, 'Čemšenik'),
(1414, 'Podkum'),
(1420, 'Trbovlje'),
(1423, 'Dobovec, Trbovlje'),
(1430, 'Hrastnik'),
(1431, 'Dol pri Hrastniku'),
(1432, 'Zidani Most'),
(1433, 'Radeče'),
(1434, 'Loka pri Zidanem Mostu'),
(2000, 'Maribor'),
(2201, 'Zgornja Kungota'),
(2204, 'Miklavž na Dravskem polju'),
(2205, 'Starše'),
(2206, 'Marjeta na Dravskem polju'),
(2208, 'Pohorje'),
(2211, 'Pesnica pri Mariboru'),
(2212, 'Šentilj v Slovenskih goricah'),
(2213, 'Zgornja Velka'),
(2214, 'Sladki Vrh'),
(2215, 'Ceršak'),
(2221, 'Jarenina'),
(2222, 'Jakobski Dol'),
(2223, 'Jurovski Dol'),
(2229, 'Malečnik'),
(2230, 'Lenart v Slovenskih goricah'),
(2231, 'Pernica'),
(2232, 'Voličina'),
(2233, 'Sv. Ana v Slovenskih goricah'),
(2234, 'Benedikt'),
(2235, 'Sv. Trojica v Slovenskih goricah'),
(2236, 'Cerkvenjak'),
(2241, 'Spodnji Duplek'),
(2242, 'Zgornja Korena'),
(2250, 'Ptuj'),
(2251, 'Ptuj - Breg'),
(2252, 'Dornava'),
(2253, 'Destrnik'),
(2254, 'Trnovska vas'),
(2255, 'Vitomarci'),
(2256, 'Juršinci'),
(2257, 'Polenšak'),
(2258, 'Sveti Tomaž'),
(2259, 'Ivanjkovci'),
(2270, 'Ormož'),
(2272, 'Gorišnica'),
(2273, 'Podgorci'),
(2274, 'Velika Nedelja'),
(2275, 'Miklavž pri Ormožu'),
(2276, 'Kog'),
(2277, 'Središče ob Dravi'),
(2281, 'Markovci'),
(2282, 'Cirkulane'),
(2283, 'Zavrč'),
(2284, 'Videm pri Ptuju'),
(2285, 'Zgornji Leskovec'),
(2286, 'Podlehnik'),
(2287, 'Žetale'),
(2288, 'Hajdina'),
(2289, 'Stoperce'),
(2310, 'Slovenska Bistrica'),
(2311, 'Hoče'),
(2312, 'Orehova vas'),
(2313, 'Fram'),
(2314, 'Zgornja Polskava'),
(2315, 'Šmartno na Pohorju'),
(2316, 'Zgornja Ložnica'),
(2317, 'Oplotnica'),
(2318, 'Laporje'),
(2319, 'Poljčane'),
(2321, 'Makole'),
(2322, 'Majšperk'),
(2323, 'Ptujska Gora'),
(2324, 'Lovrenc na Dravskem polju'),
(2325, 'Kidričevo'),
(2326, 'Cirkovce'),
(2327, 'Rače'),
(2331, 'Pragersko'),
(2341, 'Limbuš'),
(2342, 'Ruše'),
(2343, 'Fala'),
(2344, 'Lovrenc na Pohorju'),
(2345, 'Bistrica ob Dravi'),
(2351, 'Kamnica'),
(2352, 'Selnica ob Dravi'),
(2353, 'Sv. Duh na Ostrem Vrhu'),
(2354, 'Bresternica'),
(2360, 'Radlje ob Dravi'),
(2361, 'Ožbalt'),
(2362, 'Kapla'),
(2363, 'Podvelka'),
(2364, 'Ribnica na Pohorju'),
(2365, 'Vuhred'),
(2366, 'Muta'),
(2367, 'Vuzenica'),
(2370, 'Dravograd'),
(2371, 'Trbonje'),
(2372, 'Libeliče'),
(2373, 'Šentjanž pri Dravogradu'),
(2380, 'Slovenj Gradec'),
(2381, 'Podgorje'),
(2382, 'Mislinja'),
(2383, 'Šmartno pri Slovenj Gradcu'),
(2390, 'Ravne na Koroškem'),
(2391, 'Prevalje'),
(2392, 'Mežica'),
(2393, 'Črna na Koroškem'),
(2394, 'Kotlje'),
(3000, 'Celje'),
(3201, 'Šmartno v Rožni dolini'),
(3202, 'Ljubečna'),
(3203, 'Nova Cerkev'),
(3204, 'Dobrna'),
(3205, 'Vitanje'),
(3206, 'Stranice'),
(3210, 'Slovenske Konjice'),
(3211, 'Škofja vas'),
(3212, 'Vojnik'),
(3213, 'Frankolovo'),
(3214, 'Zreče'),
(3215, 'Loče'),
(3220, 'Štore'),
(3221, 'Teharje'),
(3222, 'Dramlje'),
(3223, 'Loka pri Žusmu'),
(3224, 'Dobje pri Planini'),
(3225, 'Planina pri Sevnici'),
(3230, 'Šentjur'),
(3231, 'Grobelno'),
(3232, 'Ponikva'),
(3233, 'Kalobje'),
(3240, 'Šmarje pri Jelšah'),
(3241, 'Podplat'),
(3250, 'Rogaška Slatina'),
(3252, 'Rogatec'),
(3253, 'Pristava pri Mestinju'),
(3254, 'Podčetrtek'),
(3255, 'Buče'),
(3256, 'Bistrica ob Sotli'),
(3257, 'Podsreda'),
(3260, 'Kozje'),
(3261, 'Lesično'),
(3262, 'Prevorje'),
(3263, 'Gorica pri Slivnici'),
(3264, 'Sveti Štefan'),
(3270, 'Laško'),
(3271, 'Šentrupert pri Laškem'),
(3272, 'Rimske Toplice'),
(3273, 'Jurklošter'),
(3301, 'Petrovče'),
(3302, 'Griže'),
(3303, 'Gomilsko'),
(3304, 'Tabor'),
(3305, 'Vransko'),
(3310, 'Žalec'),
(3311, 'Šempeter v Savinjski dolini'),
(3312, 'Prebold'),
(3313, 'Polzela'),
(3314, 'Braslovče'),
(3320, 'Velenje'),
(3325, 'Šoštanj'),
(3326, 'Topolšica'),
(3327, 'Šmartno ob Paki'),
(3330, 'Mozirje'),
(3331, 'Nazarje'),
(3332, 'Rečica ob Savinji'),
(3333, 'Ljubno ob Savinji'),
(3334, 'Luče'),
(3335, 'Solčava'),
(3341, 'Šmartno ob Dreti'),
(3342, 'Gornji Grad'),
(4000, 'Kranj'),
(4201, 'Zgornja Besnica'),
(4202, 'Naklo'),
(4203, 'Duplje'),
(4204, 'Golnik'),
(4205, 'Preddvor'),
(4206, 'Zgornje Jezersko'),
(4207, 'Cerklje na Gorenjskem'),
(4208, 'Šenčur'),
(4209, 'Žabnica'),
(4210, 'Brnik aerodrom'),
(4211, 'Mavčiče'),
(4212, 'Visoko'),
(4220, 'Škofja Loka'),
(4223, 'Poljane nad Škofjo Loko'),
(4224, 'Gorenja vas'),
(4225, 'Sovodenj'),
(4226, 'Žiri'),
(4227, 'Selca'),
(4228, 'Železniki'),
(4229, 'Sorica'),
(4240, 'Radovljica'),
(4243, 'Brezje'),
(4244, 'Podnart'),
(4245, 'Kropa'),
(4246, 'Kamna Gorica'),
(4247, 'Zgornje Gorje'),
(4248, 'Lesce'),
(4260, 'Bled'),
(4263, 'Bohinjska Bela'),
(4264, 'Bohinjska Bistrica'),
(4265, 'Bohinjsko jezero'),
(4267, 'Srednja vas v Bohinju'),
(4270, 'Jesenice'),
(4273, 'Blejska Dobrava'),
(4274, 'Žirovnica'),
(4275, 'Begunje na Gorenjskem'),
(4276, 'Hrušica'),
(4280, 'Kranjska Gora'),
(4281, 'Mojstrana'),
(4282, 'Gozd - Martuljek'),
(4283, 'Rateče - Planica'),
(4290, 'Tržič'),
(4294, 'Križe'),
(5000, 'Nova Gorica'),
(5210, 'Deskle'),
(5211, 'Kojsko'),
(5212, 'Dobrovo v Brdih'),
(5213, 'Kanal'),
(5214, 'Kal nad Kanalom'),
(5215, 'Ročinj'),
(5216, 'Most na Soči'),
(5220, 'Tolmin'),
(5222, 'Kobarid'),
(5223, 'Breginj'),
(5224, 'Srpenica'),
(5230, 'Bovec'),
(5231, 'Log pod Mangartom'),
(5232, 'Soča'),
(5242, 'Grahovo ob Bači'),
(5243, 'Podbrdo'),
(5250, 'Solkan'),
(5251, 'Grgar'),
(5252, 'Trnovo pri Gorici'),
(5253, 'Čepovan'),
(5261, 'Šempas'),
(5262, 'Črniče'),
(5263, 'Dobravlje'),
(5270, 'Ajdovščina'),
(5271, 'Vipava'),
(5272, 'Podnanos'),
(5273, 'Col'),
(5274, 'Črni Vrh nad Idrijo'),
(5275, 'Godovič'),
(5280, 'Idrija'),
(5281, 'Spodnja Idrija'),
(5282, 'Cerkno'),
(5283, 'Slap ob Idrijci'),
(5290, 'Šempeter pri Gorici'),
(5291, 'Miren'),
(5292, 'Renče'),
(5293, 'Volčja Draga'),
(5294, 'Dornberk'),
(5295, 'Branik'),
(5296, 'Kostanjevica na Krasu'),
(5297, 'Prvačina'),
(6000, 'Koper/Capodistria'),
(6210, 'Sežana'),
(6215, 'Divača'),
(6216, 'Podgorje'),
(6217, 'Vremski Britof'),
(6219, 'Lokev'),
(6221, 'Dutovlje'),
(6222, 'Štanjel'),
(6223, 'Komen'),
(6224, 'Senožeče'),
(6225, 'Hruševje'),
(6230, 'Postojna'),
(6232, 'Planina'),
(6240, 'Kozina'),
(6242, 'Materija'),
(6243, 'Obrov'),
(6244, 'Podgrad'),
(6250, 'Ilirska Bistrica'),
(6251, 'Ilirska Bistrica - Trnovo'),
(6253, 'Knežak'),
(6254, 'Jelšane'),
(6255, 'Prem'),
(6256, 'Košana'),
(6257, 'Pivka'),
(6258, 'Prestranek'),
(6271, 'Dekani'),
(6272, 'Gračišče'),
(6273, 'Marezige'),
(6274, 'Šmarje'),
(6275, 'Črni Kal'),
(6276, 'Pobegi'),
(6280, 'Ankaran/Ancarano'),
(6281, 'Škofije'),
(6310, 'Izola/Isola'),
(6311, 'Jagodje'),
(6320, 'Portorož/Portorose'),
(6323, 'Strunjan/Strugnano'),
(6330, 'Piran/Pirano'),
(6333, 'Sečovlje/Sicciole'),
(8000, 'Novo mesto'),
(8210, 'Trebnje'),
(8211, 'Dobrnič'),
(8212, 'Velika Loka'),
(8213, 'Veliki Gaber'),
(8216, 'Mirna Peč'),
(8220, 'Šmarješke Toplice'),
(8222, 'Otočec'),
(8230, 'Mokronog'),
(8231, 'Trebelno'),
(8232, 'Šentrupert na Dolenjskem'),
(8233, 'Mirna'),
(8250, 'Brežice'),
(8251, 'Čatež ob Savi'),
(8253, 'Artiče'),
(8254, 'Globoko'),
(8255, 'Pišece'),
(8256, 'Sromlje'),
(8257, 'Mostec'),
(8258, 'Kapele'),
(8259, 'Bizeljsko'),
(8261, 'Jesenice'),
(8262, 'Krška vas'),
(8263, 'Cerklje ob Krki'),
(8270, 'Krško'),
(8272, 'Zdole'),
(8273, 'Leskovec pri Krškem'),
(8274, 'Raka'),
(8275, 'Škocjan'),
(8276, 'Bučka'),
(8280, 'Brestanica'),
(8281, 'Senovo'),
(8282, 'Koprivnica'),
(8283, 'Blanca'),
(8290, 'Sevnica'),
(8292, 'Zabukovje nad Sevnico'),
(8293, 'Studenec'),
(8294, 'Boštanj'),
(8295, 'Tržišče'),
(8296, 'Krmelj'),
(8297, 'Šentjanž'),
(8310, 'Šentjernej'),
(8311, 'Kostanjevica na Krki'),
(8312, 'Podbočje'),
(8321, 'Brusnice'),
(8322, 'Stopiče'),
(8323, 'Uršna sela'),
(8330, 'Metlika'),
(8331, 'Suhor'),
(8332, 'Gradac'),
(8333, 'Semič'),
(8340, 'Črnomelj'),
(8341, 'Adlešiči'),
(8342, 'Stari trg ob Kolpi'),
(8343, 'Dragatuš'),
(8344, 'Vinica'),
(8350, 'Dolenjske Toplice'),
(8351, 'Straža'),
(8360, 'Žužemberk'),
(8361, 'Dvor'),
(8362, 'Hinje'),
(9000, 'Murska Sobota'),
(9201, 'Puconci'),
(9202, 'Mačkovci'),
(9203, 'Petrovci'),
(9204, 'Šalovci'),
(9205, 'Hodoš/Hodos'),
(9206, 'Križevci'),
(9207, 'Prosenjakovci/Partosfalva'),
(9208, 'Fokovci'),
(9220, 'Lendava/Lendva'),
(9221, 'Martjanci'),
(9222, 'Bogojina'),
(9223, 'Dobrovnik/Dobronak'),
(9224, 'Turnišče'),
(9225, 'Velika Polana'),
(9226, 'Moravske Toplice'),
(9227, 'Kobilje'),
(9231, 'Beltinci'),
(9232, 'Črenšovci'),
(9233, 'Odranci'),
(9240, 'Ljutomer'),
(9241, 'Veržej'),
(9242, 'Križevci pri Ljutomeru'),
(9243, 'Mala Nedelja'),
(9244, 'Sv. Jurij ob Ščavnici'),
(9245, 'Spodnji Ivanjci'),
(9250, 'Gornja Radgona'),
(9251, 'Tišina'),
(9252, 'Radenci'),
(9253, 'Apače'),
(9261, 'Cankova'),
(9262, 'Rogašovci'),
(9263, 'Kuzma'),
(9264, 'Grad'),
(9265, 'Bodonci');

-- --------------------------------------------------------

--
-- Table structure for table `PostavkaNarocila`
--

CREATE TABLE IF NOT EXISTS `PostavkaNarocila` (
  `idNarocilo` int(11) NOT NULL,
  `idIzdelek` int(11) NOT NULL,
  `kolicina` int(11) DEFAULT NULL,
  PRIMARY KEY (`idNarocilo`,`idIzdelek`),
  KEY `fk_PostavkaNarocila_Narocilo1_idx` (`idNarocilo`),
  KEY `fk_PostavkaNarocila_Izdelek1_idx` (`idIzdelek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PrijavaLog`
--

CREATE TABLE IF NOT EXISTS `PrijavaLog` (
  `idPrijavaLog` int(11) NOT NULL AUTO_INCREMENT,
  `idUporabnik` int(11) NOT NULL,
  `casPrijave` datetime DEFAULT NULL,
  PRIMARY KEY (`idPrijavaLog`),
  KEY `fk_PrijavaLog_Uporabnik1_idx` (`idUporabnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `PrijavaLog`
--

INSERT INTO `PrijavaLog` (`idPrijavaLog`, `idUporabnik`, `casPrijave`) VALUES
(1, 1, '2016-01-05 18:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `SlikaIzdelka`
--

CREATE TABLE IF NOT EXISTS `SlikaIzdelka` (
  `idSlikaIzdelka` int(11) NOT NULL AUTO_INCREMENT,
  `idIzdelek` int(11) NOT NULL,
  `slika` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`idSlikaIzdelka`),
  KEY `fk_SlikaIzdelka_Izdelek1_idx` (`idIzdelek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Uporabnik`
--

CREATE TABLE IF NOT EXISTS `Uporabnik` (
  `idUporabnik` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `priimek` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `geslo` varchar(255) NOT NULL,
  `idVloga` int(11) NOT NULL,
  `telefon` varchar(45) DEFAULT NULL,
  `naslov` varchar(45) DEFAULT NULL,
  `idPosta` int(11) DEFAULT NULL,
  `datumRegistracije` datetime NOT NULL,
  `aktivno` tinyint(1) NOT NULL,
  PRIMARY KEY (`idUporabnik`),
  UNIQUE KEY `idUporabnik_UNIQUE` (`idUporabnik`),
  KEY `fk_Uporabnik_Posta_idx` (`idPosta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Uporabnik`
--

INSERT INTO `Uporabnik` (`idUporabnik`, `ime`, `priimek`, `email`, `geslo`, `idVloga`, `telefon`, `naslov`, `idPosta`, `datumRegistracije`, `aktivno`) VALUES
(1, 'Administrator', 'Veliki', 'info@makro.si', '$2y$10$OgKbpgzAcFRO.OhlMe.jo.v0aWOp5HSj5hoi3xI8Du1QnG39FWNpm', 1, '', NULL, NULL, '2016-01-05 18:42:00', 1),
(2, 'Prodajalec', 'Miha', 'prodajalec@gmail.com', '$2y$10$rF1Q7uD.MD4E.jrd5WKTVOdfVARu/8FBQh6nc4.hSSojZfroYxtVu', 2, NULL, NULL, NULL, '2016-01-05 18:45:37', 1),
(3, 'Stranka', 'Bogdan', 'stranka@gmail.com', '$2y$10$MBys7fo9flow/NJSpVRyseQI9lfc4Svz/z//6rlAkicnW/2Nl5g92', 3, '041 000 000', 'Brusnice 1a', 8000, '2016-01-05 18:48:03', 1),
(4, 'Prodajalka', 'Špela', 'spela@gmail.com', '$2y$10$uOcU4a8JSF/ixvh1Ss8GfevAh7BPmHurzVXtU/BGHQINk02uxaBIe', 2, NULL, NULL, NULL, '2016-01-05 18:48:26', 1),
(5, 'Prodajalec', 'Boltažar', 'boltazar@gmail.com', '$2y$10$Cfy.24GKIkcmsXBPWxCZIevRmoIp5qP4V2vDjmRWq7ptJv6Pe49Qu', 2, NULL, NULL, NULL, '2016-01-05 18:48:49', 0),
(6, 'Stranka', 'Janez', 'janez@gmail.com', '$2y$10$LRD3FxR2TsvQCDCz/jDZpuoGOAi6JosOwpTLx1CEjcKqZ2aay.qEm', 3, '031 000 000', 'Grmada 9', 1310, '2016-01-05 18:49:52', 0),
(7, 'Stranka', 'Pavla', 'pavla@gmail.com', '$2y$10$xZs530xhn5Y0ARHZrhJV0O2xasDaYu1oQxsUA./KrX/zCjU62AQfG', 3, '051 942 618', 'Mengeš 45', 1351, '2016-01-05 18:51:27', 0),
(8, 'Stranka', 'zEmailom', 'matic.internet@gmail.com', '$2y$10$4iRmzf9Oxwg6XxeUSNVLa.4RiK37N14SRjb54JpQKO.VlSYsSCOE2', 3, '090 000 000', 'Hajdrihova 25', 1000, '2016-01-05 18:57:34', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Narocilo`
--
ALTER TABLE `Narocilo`
  ADD CONSTRAINT `fk_Narocilo_Uporabnik1` FOREIGN KEY (`idStranke`) REFERENCES `Uporabnik` (`idUporabnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Narocilo_Uporabnik2` FOREIGN KEY (`idProdajalca`) REFERENCES `Uporabnik` (`idUporabnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `OcenaIzdelka`
--
ALTER TABLE `OcenaIzdelka`
  ADD CONSTRAINT `fk_OcenaIzdelka_Uporabnik1` FOREIGN KEY (`idUporabnik`) REFERENCES `Uporabnik` (`idUporabnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OcenaIzdelka_Izdelek1` FOREIGN KEY (`idIzdelek`) REFERENCES `Izdelek` (`idIzdelek`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `PostavkaNarocila`
--
ALTER TABLE `PostavkaNarocila`
  ADD CONSTRAINT `fk_PostavkaNarocila_Narocilo1` FOREIGN KEY (`idNarocilo`) REFERENCES `Narocilo` (`idNarocilo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PostavkaNarocila_Izdelek1` FOREIGN KEY (`idIzdelek`) REFERENCES `Izdelek` (`idIzdelek`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `PrijavaLog`
--
ALTER TABLE `PrijavaLog`
  ADD CONSTRAINT `fk_PrijavaLog_Uporabnik1` FOREIGN KEY (`idUporabnik`) REFERENCES `Uporabnik` (`idUporabnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `SlikaIzdelka`
--
ALTER TABLE `SlikaIzdelka`
  ADD CONSTRAINT `fk_SlikaIzdelka_Izdelek1` FOREIGN KEY (`idIzdelek`) REFERENCES `Izdelek` (`idIzdelek`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Uporabnik`
--
ALTER TABLE `Uporabnik`
  ADD CONSTRAINT `fk_Uporabnik_Posta` FOREIGN KEY (`idPosta`) REFERENCES `Posta` (`postnaSt`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
