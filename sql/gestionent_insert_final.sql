-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2017 at 09:15 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestionent`
--


--
-- les drops...
--

DROP TABLE IF EXISTS `contact`;
DROP TABLE IF EXISTS `eleve`;
DROP TABLE IF EXISTS `commentaires`;
DROP TABLE IF EXISTS `entreprises`;
DROP TABLE IF EXISTS `enseignant`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `type_entreprise`;
DROP TABLE IF EXISTS `promotion`;
DROP TABLE IF EXISTS `devenir`;



-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `c_code` tinyint(4) NOT NULL,
  `c_login` varchar(20) NOT NULL,
  `c_dateheure` datetime DEFAULT NULL,
  `c_texte` varchar(80) NOT NULL,
  `c_type` varchar(10) DEFAULT NULL,
  `e_code` int(11) DEFAULT NULL,
  `u_code` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`c_code`, `c_login`, `c_dateheure`, `c_texte`, `c_type`, `e_code`, `u_code`) VALUES
(2, 'etu', '2017-09-11 14:56:27', '        ', 'Couriel', 5, 1),
(3, 'etu', '2017-09-11 14:56:52', '        un coup de téléphone pour un stage', 'Téléphone', 5, 1),
(4, 'etu', '2017-09-11 14:58:02', '        un coup de téléphone pour un stage', 'Téléphone', 5, 2),
(5, 'claude', '2017-09-18 11:40:36', '        ', 'Couriel', 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `co_code` int(11) NOT NULL,
  `u_code` tinyint(4) NOT NULL,
  `co_date` date DEFAULT NULL,
  `co_international` tinyint(1) DEFAULT NULL,
  `co_precisions` char(255) DEFAULT NULL,
  `d_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`co_code`, `u_code`, `co_date`, `co_international`, `co_precisions`, `d_code`) VALUES
(1, 12, '2017-10-12', 0, 'L\'étudiant est au chômage.', 5),
(2, 6, '2017-10-17', 0, 'Admin réseau à Merleau-Ponty', 3),
(3, 7, '2017-10-18', 0, 'A. Gacher commence un Bac+3.', 1),
(4, 4, '2017-10-18', 1, 'Aurélia fait un bac+3 à l\'international.', 1),
(5, 5, '2017-01-18', 1, 'Tanguy est à Berlin.', 4),
(6, 13, '2017-10-19', 0, 'L\'étudiant poursuit ses études en bachelor Admin Réseaux à l\'étranger.', 1),
(7, 8, '2017-10-02', 0, 'Mathias travail dans une ESN à Paris.', 4),
(8, 16, '2017-08-17', 0, 'Maxime continue ses études à Niort à l\'ENI.', 1),
(9, 9, '2017-10-02', 0, 'Tim travaille en tant que Community Manager.', 3),
(10, 10, '2017-10-11', 0, 'Sonia continue ses études dans une école de Game Design.', 1),
(11, 11, '2017-08-17', 0, 'Alicia continue ses études en licence pro multimédia à La Rochelle.', 1),
(12, 17, '2017-10-03', 0, 'Alexandre Prouillet a trouvé un CDI de développeur PHP. Il travaille actuellement à Nantes pour une société d\'électro-ménager.', 4),
(13, 14, '2017-08-31', 0, 'Adam recherche un poste d\'administrateur dans la sécurité informatique.', 5),
(14, 15, '2017-07-10', 0, 'Teava se reconvertit dans l\'électronique.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `devenir`
--

CREATE TABLE `devenir` (
  `d_code` int(11) NOT NULL,
  `d_devenir` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devenir`
--

INSERT INTO `devenir` (`d_code`, `d_devenir`) VALUES
(1, 'Poursuite d\'études'),
(2, 'Changement de voie'),
(3, 'Travail en CDD'),
(4, 'Travail en CDI'),
(5, 'Chômage');

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

CREATE TABLE `eleve` (
  `u_code` tinyint(4) NOT NULL,
  `pr_code` int(11) NOT NULL,
  `el_redoublant` tinyint(1) DEFAULT NULL,
  `el_date_naissance` date DEFAULT NULL,
  `el_sexe` tinyint(1) DEFAULT NULL,
  `el_diplome_prec` char(32) DEFAULT NULL,
  `el_option` char(4) DEFAULT NULL,
  `el_mail` varchar(60) DEFAULT NULL,
  `el_obtention_bts` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`u_code`, `pr_code`, `el_redoublant`, `el_date_naissance`, `el_sexe`, `el_diplome_prec`, `el_option`, `el_mail`, `el_obtention_bts`) VALUES
(4, 2, NULL, '1995-03-09', 1, 'Autre', 'SLAM', 'aurelia.sarradin@gmail.com', 1),
(5, 2, NULL, '1995-10-18', 0, 'Bac Pro SEN', 'SLAM', 'tanguy.bouchet@gmail.com', 1),
(6, 1, 1, '1998-10-10', 1, 'Bac STMG', 'SISR', NULL, 1),
(7, 1, NULL, '1998-10-18', 0, 'Bac S', 'SLAM', NULL, 1),
(8, 1, NULL, '1997-10-01', 0, 'Bac S', 'SLAM', NULL, 1),
(9, 1, 1, '1997-05-05', 0, 'Bac STMG', 'SLAM', NULL, 1),
(10, 2, NULL, '1998-11-06', 1, 'Bac STMG', 'SLAM', NULL, 1),
(11, 2, NULL, '1998-12-14', 1, 'Bac ES', 'SLAM', NULL, 1),
(12, 2, NULL, '1998-10-10', 0, 'Bac STI2D', 'SISR', NULL, 1),
(13, 2, NULL, '1997-10-16', 0, 'Bac Pro SEN', 'SISR', NULL, 1),
(14, 2, NULL, '1997-10-11', 0, 'Bac Pro SEN', 'SISR', NULL, 1),
(15, 2, NULL, '1997-10-23', 0, 'Bac STMG', 'SISR', NULL, 1),
(16, 1, NULL, '1996-10-09', 0, 'Bac S', 'SLAM', 'maxime.g@gmail.com', 1),
(17, 1, NULL, '1997-09-03', 0, 'Bac STMG', 'SLAM', 'alexandre.prouillet@gmail.com', 1),
(18, 1, NULL, '1996-12-12', 1, 'Autre', 'SLAM', 'mounadh@yahoo.com', 1),
(19, 1, NULL, '1996-03-03', 1, 'Bac STMG', 'SISR', NULL, 1),
(20, 2, 1, '1996-11-29', 0, 'Bac Pro SEN', 'SISR', 'aymerick.mallet@gmail.com', 1),
(21, 2, 1, '1996-08-14', 0, 'Bac STMG', 'SISR', 'florian.pinaud@gmail.com', 1),
(22, 1, NULL, '1996-11-02', 0, 'Bac Pro SEN', 'SISR', 'florian.kratz@yahoo.com', 1),
(23, 1, NULL, '1995-08-02', 0, 'Bac Pro SEN', 'SISR', 'johnny.andre@gmail.com', 1),
(24, 1, NULL, '1997-09-02', 0, 'Bac STMG', 'SLAM', 'quentin-p@yahoo.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `u_code` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE `entreprises` (
  `e_code` int(11) NOT NULL,
  `e_nom` varchar(30) DEFAULT NULL,
  `e_adresse1` varchar(120) DEFAULT NULL,
  `e_adresse2` varchar(120) DEFAULT NULL,
  `e_ville` varchar(30) DEFAULT NULL,
  `e_codpostal` char(5) DEFAULT NULL,
  `e_nom_contact` varchar(150) DEFAULT NULL,
  `e_tel` varchar(150) DEFAULT NULL,
  `e_mail` varchar(30) DEFAULT NULL,
  `te_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`e_code`, `e_nom`, `e_adresse1`, `e_adresse2`, `e_ville`, `e_codpostal`, `e_nom_contact`, `e_tel`, `e_mail`, `te_code`) VALUES
(1, 'Aerazur', '58 Rue de Segonzac', NULL, 'COGNAC', '16100', ' Aurélien BOUILLON', '05 45 83 20 84', 'aurelien.bouillon@zodiacaerosp', 1),
(2, 'AT INTERNET', 'Parc d\'activités La devèze - 8 impasse Rudolf Diesel', NULL, 'Merignac', '33700', 'Nicolas Boineau', '01 56 54 14 30', 'nicolas.boineau@atinternet.com', 1),
(3, 'Auto-école du Littoral', '17, Rue Pujos,', NULL, 'ROCHEFORT', '17300', 'Fourchaud Stéphane', '05 46 87 69 69', 'aedulittoral@laposte.net', 1),
(4, 'Base aérienne 721', '', NULL, 'Rochefort AIR', '17', 'Sébastien Bédouet', '0699724594 0546888095', 'Sebastien.bedouet@intradef.gou', 1),
(5, ' IDK Stratégie Multimédia', 'Hotel d\'entreprise, local n°3 ', '1 Rue de la Trinquette', 'La Rochelle (Minnimes) ', '17000', 'Borgia Bafounta ', '06 50 34 61 07 -05 46 27 00 79', 'Bbafounta@gmail.com', 4),
(6, 'Léa Nature', '23Avenue Paul Langevin,', NULL, 'Perigny Cedex', '17183', 'Jean-Marc BOURREAU', '05 46 52 00 81', 'jm.bourreau@leanature.com', 1),
(7, 'Novatique', '17 place Joffre', NULL, '', '0', '', '', '', 1),
(8, 'Novatique', '', 'Frédéric RAULT', 'AURAY', '56400', 'frederic.rault@novatique.com', '06 45 60 95 13', 'frederic.rault@novatique.com', 1),
(9, 'Pays Rochefortais', '3 avenue Maurice Chupin Parc des Fouriers', NULL, 'Rochefort', '17300', 'Paticat François', '05 46 82 40 57', 'f.paticat@cda-paysrochefortais', 1),
(10, 'Sacrée Com', '15 rue Renouleau', NULL, 'Tonnay-Charente', '17430', 'Jean-Philippe PETIT', '06 86 21 50 51', 'jppetit@sacreecom.org', 1),
(11, 'TESSI TECHNOLOGIES', '1-3 Avenue des Satellites', NULL, 'Le Haillan', '33185', 'Schmitt Nicola', '05 57 22 20 61', 'nicolas.schmitt@tessi.fr', 1),
(12, '4DConcept', '41-43 Avenue du centre MONTIGNY LE BRETONNEUX ', 'Mr BALCERAK Mathieu ', 'MONTIGNY LE BRETONNEUX ', '78180', 'Mr BALCERAK Mathieu ', '01 61 08 50 20 ', 'mathieu.balcerak@4dconcept.fr ', 4),
(13, '6 TEM\' INFORMATIQUE', '2 RD 734 ', '', 'Dolus ', '17550', 'Cyril DURAND  ', '05 46 36 70 70 ', 'durand.cyril@wanadoo.fr ', 5),
(14, 'A2I Informatique ', 'Rue Augustin Fresnel –', 'Vincent PACOMME Directeur serv', 'PERIGNY ', '17183', 'Vincent PACOMME Directeur serv', '05 46 57 69 71 ', 'vpacomme@novenci.fr ', 1),
(15, 'A2I INFORMATIQUE', ' ZAC Les Montagnes BP5 ', '', 'CHAMPNIERS ', '16430', 'Vincent PACOMME', '05 43 37 18 08 ', 'vpacomme@novenci.fr ', 5),
(16, 'ACT Service', '18 rue de la Bonnette Les minimes', '', 'La Rochelle ', '17000', 'Mr Maudet ', '05 46 44 44 59 ', '', 5),
(17, 'Adequat Systeme', '14 avenue Jean de Vivonne  ', '', 'Pisany', '17600', 'Adam Julien', '08-11-09-24-60', 'adequat@adequat-systeme.fr', 4),
(18, 'ALPMS', '3, Rue J.B. Charcot ', NULL, 'La Rochelle ', '17000', 'Louis LE BLEVEC  ', '05 46 41 32 32 ', 'louis.leblevec@wanadoo.fr ', 1),
(19, 'Alstom', 'Avenue Commdt Lysiack', 'Stephane Petit ', 'Aytré ', '17440', 'Stephane Petit ', '05-46-', 'stephane.petit@itc.alstom.com ', 3),
(20, 'Archipel', '', NULL, 'ROCHEFORT ', '17300', 'Philippe Raad ', '', 'support@archipelweb.fr ', 1),
(21, 'Astron Associate SA', 'Ch du grand Puits 38 CP 339 CH – 1217 Meyrin - 1 ', NULL, 'Meyrin- Suisse ', '0', 'Heger Jean-Christophe ', '0041 76 324 05 25 ', 'jean-christophe@astron-assoc.c', 1),
(22, 'CARA', '107 avenue de ROCHEFORT ', NULL, 'Royan ', '17200', 'François PINET ', '05 46 22 19 14 ', 'f.pinet@agglo-royan,fr ', 1),
(23, 'Caserne Renaudin', 'av Porte Dauphine ', NULL, 'LA ROCHELLE ', '17000', 'M. Naudet ', '05 46 51 45 70 ', 'pierre.naudet@base-transit.com', 1),
(24, 'CC17', '37 rue du Dr Peltier ', NULL, 'ROCHEFORT ', '17300', 'PROUX ', '546875608', '', 1),
(25, 'CCI Rochefort et Saintonges', 'Corderie Royale Rue Audebert  ', NULL, 'ROCHEFORT ', '17300', 'M. André Jonathan ', '05-46-84-70-95', 'j.andre@rochefort-cci.fr', 1),
(26, 'Centre hospitalier de Rochefor', '16, Rue du Docteur Peltier', NULL, 'ROCHEFORT ', '17300', 'Thierry MOSCATO Chef du centre', '05 46 82 20 36 ', 'thierry.moscato@ch-rochefort.f', 1),
(27, 'Centre hospitalier de Royan', '', NULL, 'Royan ', '17205', 'Thierry PETITGIRARD', '', '', 1),
(28, 'Directeur adjoint ', '05 46 39 52 43 ', NULL, '', '0', '', '', '', 1),
(29, 'Centre Hospitalier De Saintong', '11 Bd Ambroise Paré BP326', NULL, 'SAINTES ', '17108', 'Vincent MAHAU ', '05-46-95-12-70 ', 'v.mahau@saintonge.fr ', 1),
(30, 'Cetios', 'Allée de la Baucette', NULL, 'Surgères', '17700', '', '05 46 07 68 00', '', 1),
(31, 'CH Jonzac', ' Av, Winston churchild, BP 109 ', NULL, 'Jonzac ', '17503', 'Mme PESNEL ', '05 46 48 75 68 ', 'c,pesnel@ch-jonzac.fr ', 1),
(32, 'cipecma', '', NULL, 'Chatelaillon ', '17340', 'MALISZKIEWICZ ', '', '', 1),
(33, 'Clinique Pasteur ', '', NULL, 'Royan ', '17200', 'M.Péchereau ', '05 46 22 22 33 ', 'epechereau@clinique-pasteur-ro', 1),
(34, 'CMAF ', '', NULL, 'LA ROCHELLE ', '17000', 'GARZIANO ', '', '', 1),
(35, 'Communauté d\'agglomération de ', '', NULL, 'PERIGNY ', '17180', 'Laurent Cagna ', '06-84-53-23-70 05-46-30-34-32 ', 'laurent.cagna@agglo-larochelle', 1),
(36, 'Commune Château-Larcher', '4, Rue de la Mairie ', NULL, 'CHATEAU LARCHER ', '86370', 'Francis GARGOUIL Maire ', '05 49 43 40 56 ', 'château-larcher@cg86.fr ', 1),
(37, 'CYBERNET COPY 17', ' 37, rue du Docteur Peltier ', NULL, 'ROCHEFORT ', '17300', 'Frédéric PROUX Chef d\'entrepri', '05 46 87 56 08 ', 'cc17@wanadoo.fr ', 1),
(38, 'CYBERTEK', 'Avenue Fourneaux ', NULL, 'ANGOULINS SUR MER ', '17690', 'Cyril MICHAUD Resp. point de v', '05 46 42 46 33 ', 'angoulins@cybertek.fr ', 1),
(39, 'DATACLIC ', '47, Rue Pierre de Campet', NULL, 'SAUJON ', '17600', 'Alexandre OZON Gérant ', '05 46 06 65 45 ', 'contact@dataclic.fr Alexandre.', 1),
(40, 'DDAF- ', '', NULL, 'LA ROCHELLE ', '17000', 'LELANN ', '05 46 68 61 18 ', '', 1),
(41, 'DDSV ', '', NULL, 'LA ROCHELLE ', '17000', 'MME MAZEREAU ', '05 46 68 61 44 ', '', 1),
(42, 'DELAMET SAS ', '16, Rue Gambetta ', NULL, 'Saint Aigulin ', '17360', 'Thomas HUCHET Directeur Généra', '05 46 04 08 08 ', 't.huchet@delamet.com ', 1),
(43, 'DIGITAL', '751 rue de la Génoise,Parc d\'activité Les Montagnes ', NULL, 'CHAMPNIERS ', '16430', 'Sébastien CARVAJAL Resp. SAV ', '05 45 37 15 30 ', 'contact@cardinaud-hall.com ', 1),
(44, 'EIGSI - ', '', NULL, 'La Rochelle ', '17000', 'Mr Nerrand ', '', 'olivier.nerrand@eigsi.fr ', 1),
(45, 'ENILIA – ENSMIC', 'Avenue François Mitterand BP 49 ', NULL, 'SURGERES ', '17700', 'Julien COUTANT Resp. service i', '05 46 27 69 09 ', 'julien.coutant@educagri.fr ', 1),
(46, 'ERDF', 'rue Chauvin', NULL, 'ROCHEFORT ', '17300', '', '', '', 1),
(47, 'exedra', '29 avenue des martyrs de la liberation', NULL, 'merignac ', '33700', 'Ronald LALOUE Thibaud Mori', '05 56 13 86 44 ', 'ronald.laloue@exedra.fr thibau', 1),
(48, 'Foyer départemental Lannelongu', 'Etablissement public départemental', NULL, 'Saint Trojan Les Bains ', '17370', 'Emmanuel PROUST Informaticien ', '05 46 76 22 29 ', '', 1),
(49, 'GARANDEAU FRERES Chamblanc ', '', NULL, 'Cherves-Richemont ', '16370', 'Christian Gourinel ', '05.45.83.24.11 ', '', 1),
(50, 'Groupe Coop Atlantique', '3 rue du docteur jean ', NULL, 'SAINTES ', '17100', 'Mr Roy Jannick ', '681482711', 'jroy@coop-atlantique.fr ', 1),
(51, 'Groupe Gibaud', '15 rue de l\'ormeau du Pied Saintes ', NULL, 'SAINTES ', '17100', 'Jean-Sebastien BONCOUR ', '', 'js.boncour@barns.fr ', 1),
(52, 'Groupe Léa Nature', 'Avenue Paul Langevin', NULL, 'Périgny', '17180', '', '', '', 1),
(53, 'Groupe SUP DE CO', '102, Rue de Coureilles ', NULL, 'La Rochelle ', '17000', 'Mr Pierre Laurent ', '05 46 51 77 42 ', 'pierrel@esc-larochelle.fr ', 1),
(54, 'Groupe SUP DE CO', '102, Rue de Coureilles ', NULL, 'La Rochelle ', '17000', 'Aurélien MARTY Resp. Système d', '05 46 51 77 68 ', 'sig@esc-larochelle.fr ', 1),
(55, 'Hano-communication ', ' place Charles De Gaulle  ', NULL, 'Aulnay', '17450', 'Billaud Mickaël', '05 46 33 39 66', 'm.billaud@hano-communication.f', 1),
(56, 'IN TECH', ' 2bis rue Ferdinand Gateau', NULL, 'Tonnay Charente ', '17430', 'Alain RUISI Gérant ', '05 46 87 35 10 ', 'in-tech.fr ', 1),
(57, 'IUT La Rochelle ', '', NULL, 'La Rochelle ', '17000', 'Degenne Charly ', '05 46 51 39 26 ', 'charly@univ-lr.fr ', 1),
(58, 'IUT La Rochelle ', '15 rue François De Vaux Foletier ', NULL, ' LA ROCHELE cedex 01 ', '17026', 'SAUZET Olivier ', '546513900', 'olivier,sauzet@univ-lr,fr ', 1),
(59, 'Groupe Michel', ' 163 Avenue Jean-Paul SARTRE ', NULL, 'La Rochelle ', '17000', 'Jean PRAILLE Coordinateur info', '05 46 44 01 00 ', 'jean.praille.larochelle@reseau', 1),
(60, 'Jean-Noël Informatique', '37 avenue d\'aunis ', NULL, 'tonnay-charente ', '17430', 'BENOIST Julien ', '05 46 88 06 93 ', 'jni17@orange.fr ', 1),
(61, 'KUEHNE+NAGEL DSIA', '16 rue de la petite sensive ', NULL, 'Nantes ', '44323', 'Mr Huteau ', '02 51 81 85 85 ', 'patrice.huteau@kuehne-nagel.co', 1),
(62, 'Leroy Somer', 'Boulevard Marcelin Leroy', NULL, 'Angoulème', '0', 'Copin Damien', '05 45 64 49 72', 'Damien.COPIN@Emerson.com ', 1),
(63, 'LP Jean Rostand louise lériget', '', NULL, 'Angouleme ', '16000', 'M. Bosseli ', '05 45 97 45 42 ', '', 1),
(64, 'Lycée ?', '66 Boulevard de châtenay ', NULL, 'Cognac ', '16100', 'GARNIER Gilles ', '05 45 36 83 94 ', 'gilles.garnier@ac-poitiers.fr ', 1),
(65, 'Lycée agricole', 'Site de l\'oisellerie ', NULL, 'Angouleme ', '16000', 'Fortin Eric ', '0545 67 10 04 ', 'eric,fortin@educagri.fr ', 1),
(66, 'Lycée Agricole Bordeaux ', '', NULL, 'Blanquefort ', '33290', 'M. BEINCHET Olivier ', '06 84 61 31 23 ', 'olivier.beinchet@educagri.fr ', 1),
(67, 'Lycee bellevue ', '', NULL, 'SAINTES ', '17100', 'mallawe ', '', '', 1),
(68, 'Lycée Bernard Palissy', '1, Rue de Gascogne', NULL, 'SAINTES ', '17100', 'Yannick DRIEUX ATPR ', '05 46 92 08 15 ', 'ce.0170060y@ac-poitiers.fr ', 1),
(69, 'lycée Georges Desclaude', 'rue Georges Desclaude', '', 'Saintes', '17100', 'Manuel Deveaud', '546933122', 'manuel.deveaud@educagri.fr', 1),
(70, 'Lycée georges Leygues ', '', NULL, 'Villeneuve\\lot ', '47300', 'M..Certain ', '', '', 1),
(71, 'Lycée Jamain', '2A Boulevard Pouzet ', NULL, 'ROCHEFORT ', '17300', 'M.Celerier Sébastien ', '05 46 99 06 68 ', 'sebastien.celerier@ac-poitiers', 1),
(72, 'Lycée Jean DAUTET ', '', NULL, 'La Rochelle ', '17000', 'Philippe PETIT ATPR ', 'non donné ', 'ph.petit@cr-poitou-charnentes.', 1),
(73, 'Lycée Léonce Vieljeux ', 'Rue des Gonthières ', NULL, 'La Rochelle ', '17000', 'REGEON Cédric ', '546347932', 'cedric.regeon@ac-poitiers.fr ', 1),
(74, 'Lycée Marcel Dassault - ', '', NULL, 'ROCHEFORT ', '17300', 'M. WOJCIECHOWSKI ', '05 46 88 13 09 ', 'nicolas.wojciechowski@ac-poiti', 1),
(75, 'lycée Professionnel Régional I', '', NULL, 'COGNAC ', '16100', 'M.Renard ', '05 45 35 86 70 ', '', 1),
(76, 'Lycée Professionnel Rompsay', ' Rue de Périgny ', NULL, 'La Rochelle', '17025', 'Stephane Arcade', '', 'atp-rompsay@ac-poitiers.fr', 1),
(77, 'Lycée Victor hugo ', '', NULL, 'Poitiers ', '86000', 'Mickaël GUERIN ', '05 49 41 91 04 ', 'mickael.guerin@lyc-victorhugo.', 1),
(78, 'MAAF Assurances', 'SA Chauray ', NULL, 'Niort ', '79036', 'Mr Caquineau ', '05 49 34 35 36 ', 'antonino.cacace@maaf.fr ', 1),
(79, 'Maiano Informatique', ' 17 rue de l\'électricité 17200 Royan ', NULL, 'Royan ', '17200', 'Dominique Maiano ', '05 46 49 48 68 ', 'contact@maianoinfo.com ', 1),
(80, 'Mairie de Saintes', 'Square Andre Maudet ', NULL, 'SAINTES ', '17100', 'Bialowas ', '05 46 92 34 29 ', '', 1),
(81, 'Mairie de Chatelaillon ', '', NULL, 'Chatelaillon ', '17340', 'Claude MARLIENGEAS ', '', '', 1),
(82, 'Mairie de Meschers', '8 rue Paul Massy ', NULL, 'MESCHERS SUR GIRONDE', '17132', 'RAT Jean-Luc', '05 46 39 71 13', 'informatique@meschers.com', 1),
(83, 'Mairie de Poitiers Informatiqu', 'Rue du Dolmen', NULL, 'Poitiers', '86000', '', '05 49 30 81 55', '', 1),
(84, 'Mairie de Pont l\'Abbé d\'Arnoul', 'Place du général de Gaulle', NULL, 'Pont l\'Abbé d\'Arnoult ', '17250', 'M. Yannick DIEU ', '06 80 07 12 21 ', 'yannick.dieu@wanadoo.fr ', 1),
(85, 'MAIRIE DE ROYAN', ' 80, avenue de Pontaillac ', NULL, 'Royan ', '17200', 'François CHAUVEAU Responsable ', '05 46 39 56 56 ', 'f.chauveau@mairie-royan.fr ', 1),
(86, 'MAIRIE DE SAUJON', ' Hotel de ville BP 108 ', NULL, 'SAUJON ', '17600', 'Stéphane MOINARD Animateur mul', '05 46 02 94 71 ', 'mediatheque_saujon@hotmail.com', 1),
(87, 'Maison de l\'emploi', 'Parc des Fourriers', NULL, 'ROCHEFORT ', '17300', 'Emmanuel Ecale', '546998000', 'e.ecale@mde-paysrochefortais.f', 1),
(88, 'Malichaud atlantique', '13 rue Hubert Pennevert', NULL, 'ROCHEFORT ', '17300', 'David Carré ', '05 46 84 79 19 ', 'david.carre@malichaudatlantiqu', 1),
(89, 'MAPA Mutuelle d\'Assurance', 'Rue Anatole Contré ', NULL, 'Saint Jean d\'Angély ', '17400', 'Christophe MAROQUESNE Resp. ex', '05 46 59 54 16 ', 'service.informatique@mapa-assu', 1),
(90, 'Metal Néo', 'ZI des Soeurs, 21 Boulevard du vercors', '', 'Rochefort', '17300', 'Jean François Pailler', '', '', 1),
(91, 'MSA ', '', NULL, 'Angouleme ', '16000', 'Mr. Nicoine ', '05 45 97 81 60 ', 'nicoine.pascal@msa16.msa.fr ', 1),
(92, 'NEOPC', 'ZI OUEST voie C ', NULL, 'SURGERES ', '17700', 'Michel SUIRE Gérant ', '05 46 30 09 71 ', 'neopc1@orange.fr ', 1),
(93, 'NEVA technologies', '40 Rue de Marignan', '', 'Cognac', '16', 'Bruno Klapita', '545352725', 'bklapita@nevatec.fr', 1),
(94, 'ORECO S.A. ', '44 bd Oscar Planat ', NULL, 'COGNAC ', '16100', 'Daniel de SAINT-OURS directeur', '05 45 35 13 83 ', 'daniel.desaintours@oreco.fr ch', 1),
(95, 'Orix Informatique', '6 rue pape', NULL, 'SAINTES ', '17100', 'DEGABRIEL Ludovic ', '', 'support@orixinfo.fr ', 1),
(96, 'Boutique?', 'Parc d\'activité Les Montagnes ', NULL, 'ROCHEFORT ', '17300', 'Nicolas SIGNORELLO Technicien ', '05 46 99 15 54 ', 'nicolas.s@easy-ordi.com ', 1),
(97, 'PRODWARE', '9 rue jacques cartier ', NULL, 'AYTRE ', '17440', 'Jean Philippe ROBBE ', '06 76 48 28 35 ', 'jprobbe@prodware.fr ', 1),
(98, 'Romain Informatique', '20 rue de saint-vivien', NULL, ' Bords', '17430', 'Galin Romain', '05-46-84-00-14', 'contact@romain-informatique.fr', 1),
(99, 'Saint jean d\'Y / Val de Sainto', ' rue texier ', NULL, 'Saint Jean d\'Angély ', '17400', 'Jean-Philipe BIGOIS ', '', 'jean-philipe,bigois@valsdesain', 1),
(100, 'SAINTRONIC', ' parc atlantique, l\'ormeau de pied ', NULL, 'SAINTES ', '17101', 'Jean Jacques PAILLE ', '546927152', 'jean-jacques,paille@saintronic', 1),
(101, 'SARL A.I.P.C. ', '18, route de Frontenay RUFFIGNY', NULL, 'LA CRECHE ', '79260', 'Eric CARLET Gérant ', '05 49 75 19 19 ', 'eric.carlet@aipc-info.fr ', 1),
(102, 'SARL Concept Joueur Cité Joueu', '15, rue Jean Fougerat ', NULL, 'Angouleme ', '16000', 'Nicolas VIROULAUD Gérant ', '06 68 91 71 88 ', 'n.viroulaud@citejoueur.com ', 1),
(103, 'SARL DIF Informatique', 'ZA de chez Bernard 25 route de Cognac', NULL, 'Archiac', '17520', 'Roda Teddy', '', 'teddy@dif-informatique.com', 1),
(104, 'SARL LE MONDE DU PC ', '16,rue G. Claude ', NULL, 'Vaux Sur Mer ', '17640', 'Fabrice ERB Gérant ', '05 46 22 06 57 ', '', 1),
(105, 'Satti informatique ', 'rue Augustin Fresnel ZI ', NULL, 'PERIGNY ', '17183', 'M.Thoulon ', '05 46 51 65 65 ', 'vthoulon@novenci,fr ', 1),
(106, 'Services-emedia', '12 rue de la boulangerie ', NULL, 'Bernay Saint-Martin ', '17330', 'Christian FREBUTTE ', '05 16 51 70 43 ', 'contact@services-emedia,fr ', 1),
(107, 'Simair', '17 avenue André Dublin', NULL, 'ROCHEFORT', '17300', 'Jaunas Jérôme', '05 46 99 87 73', 'j.jaunas@simair.com', 1),
(108, 'SOGEMAP', '40, Rue de Marignan', NULL, 'COGNAC ', '16100', 'Bertrand MACHEFERT Technicien ', '05 45 35 27 25 ', 'bmachefert@nevatec.fr ', 1),
(109, 'SS2i-services', '1 rue Alexandre Fleming', NULL, 'LA ROCHELLE ', '17000', 'Jean-Charles Briatte', '05 46 42 02 77', 'Jean-charles.briatte@ss2i-serv', 1),
(110, 'STEF INFORMATIX ', '61, av. Lafayette ', NULL, 'ROCHEFORT ', '17300', 'M. LOMBARD Chef d\'entreprise ', '06 80 07 19 16 / 05 46 87 13 4', 'contact@stefinformatix.com ', 1),
(111, 'Soluris', '', NULL, 'SAINTES ', '17100', 'M. Piekarek lienard', '05 46 92 39 05 ', 'j.piekarek@si17.fr ', 1),
(112, 'SYSTEL SA', '17 Rue Leverrien', NULL, 'AYTRE', '17440', 'F. Baudoux', '06.30.52.50.07', 'f.baudoux@systel-sa.com', 1),
(113, 'URANIE ', 'Zone d\'activité des docks maritimes Bat A Quai Carriet ', NULL, 'Lormont ', '33310', 'Sylvain BERGER Ingénieur infor', '05 56 39 79 08 ', 'sylvain.berger@uranie-conseil.', 1),
(114, 'Zolux', '141 cours Paul Doumer', NULL, 'Saintes', '17100', 'BERTIN Romain', '05 46 97 90 24', 'romain.bertin@zolux.com', 1),
(156, 'Mairie Ecurat', 'route de ', '', 'Ecurat', '17560', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `pr_code` int(11) NOT NULL,
  `pr_date_debut` date DEFAULT NULL,
  `pr_date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`pr_code`, `pr_date_debut`, `pr_date_fin`) VALUES
(1, '2015-09-01', '2017-07-01'),
(2, '2016-09-01', '2018-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `type_entreprise`
--

CREATE TABLE `type_entreprise` (
  `te_code` int(11) NOT NULL,
  `te_libelle` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_entreprise`
--

INSERT INTO `type_entreprise` (`te_code`, `te_libelle`) VALUES
(1, 'Mairie'),
(2, 'Hopital'),
(3, 'Industrie'),
(4, 'Société de communication'),
(5, 'SSII/ESN'),
(6, 'Boutique informatique'),
(7, 'Association'),
(8, 'Armée'),
(9, 'Administration'),
(10, 'Hopital/clinique'),
(11, 'Mairie'),
(12, 'Lycée/Ecole/CFA'),
(13, 'Service/Conseil'),
(14, 'Assurance');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_code` tinyint(4) NOT NULL,
  `u_login` varchar(20) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_nom` varchar(80) NOT NULL,
  `u_prenom` varchar(50) NOT NULL,
  `u_role` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_code`, `u_login`, `u_password`, `u_nom`, `u_prenom`, `u_role`) VALUES
(1, 'etu', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Diant', 'Etu', 'etu'),
(2, 'prof', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Pédagogique', 'Equipe', 'admin'),
(3, 'exterieur', '', 'exterieur', 'exterieur', 'ext'),
(4, 'aurelia', '', 'Sarradin', 'Aurélia', 'admin'),
(5, 'tanguy', '', 'Bouchet', 'Tanguy', 'admin'),
(6, 'chloep', '', 'Picoron', 'Chloé', 'etu'),
(7, 'aurelieng', '', 'Gacher', 'Aurélien', 'etu'),
(8, 'mathiasr', '', 'Rousseau', 'Mathias', 'etu'),
(9, 'timothyp', '', 'Philippe', 'Timothy', 'etu'),
(10, 'soniag', '', 'Goulevent', 'Sonia', 'etu'),
(11, 'aliciar', '', 'Rivière', 'Alicia', 'etu'),
(12, 'maximer', '', 'Renneteau', 'Maxime', 'etu'),
(13, 'alistairt', '', 'Thoor', 'Alistair', 'etu'),
(14, 'adamh', '', 'Hammas', 'Adam', 'etu'),
(15, 'teavat', '', 'Tuiteala', 'Teava', 'etu'),
(16, 'maximeg', '', 'Gombeaud', 'Maxime', 'etu'),
(17, 'alexandrep', '', 'Prouillet', 'Alexandre', 'etu'),
(18, 'mounad', '', 'Dahmani', 'Mouna', 'etu'),
(19, 'anaist', '', 'Tortorici', 'Anaïs', 'etu'),
(20, 'aymerickm', '', 'Mallet', 'Aymerick', 'etu'),
(21, 'florianp', '', 'Pinaud', 'Florian', 'etu'),
(22, 'floriank', '', 'Kratz', 'Florian', 'etu'),
(23, 'johnnya', '', 'André', 'Johnny', 'etu'),
(24, 'quentinp', '', 'Passebon', 'Quentin', 'etu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`c_code`),
  ADD KEY `fk_commentaires_e_code` (`e_code`),
  ADD KEY `fk_commentaires_u_code` (`u_code`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`co_code`),
  ADD KEY `i_fk_contact_eleve` (`u_code`),
  ADD KEY `d_code` (`d_code`);

--
-- Indexes for table `devenir`
--
ALTER TABLE `devenir`
  ADD PRIMARY KEY (`d_code`);

--
-- Indexes for table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`u_code`),
  ADD KEY `i_fk_eleve_promotion` (`pr_code`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`u_code`);

--
-- Indexes for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`e_code`),
  ADD KEY `fk_entreprise_te_code` (`te_code`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`pr_code`);

--
-- Indexes for table `type_entreprise`
--
ALTER TABLE `type_entreprise`
  ADD PRIMARY KEY (`te_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `c_code` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `co_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `devenir`
--
ALTER TABLE `devenir`
  MODIFY `d_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `e_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `pr_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type_entreprise`
--
ALTER TABLE `type_entreprise`
  MODIFY `te_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_code` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`e_code`) REFERENCES `entreprises` (`e_code`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`u_code`) REFERENCES `users` (`u_code`),
  ADD CONSTRAINT `fk_commentaires_u_code` FOREIGN KEY (`u_code`) REFERENCES `users` (`u_code`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`d_code`) REFERENCES `devenir` (`d_code`),
  ADD CONSTRAINT `contact_ibfk_2` FOREIGN KEY (`u_code`) REFERENCES `eleve` (`u_code`);

--
-- Constraints for table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`pr_code`) REFERENCES `promotion` (`pr_code`),
  ADD CONSTRAINT `eleve_ibfk_2` FOREIGN KEY (`u_code`) REFERENCES `users` (`u_code`);

--
-- Constraints for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`u_code`) REFERENCES `users` (`u_code`);

--
-- Constraints for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD CONSTRAINT `entreprises_ibfk_1` FOREIGN KEY (`te_code`) REFERENCES `type_entreprise` (`te_code`),
  ADD CONSTRAINT `fk_entreprise_te_code` FOREIGN KEY (`te_code`) REFERENCES `type_entreprise` (`te_code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
