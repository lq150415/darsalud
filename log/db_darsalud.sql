-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2017 a las 09:44:54
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_darsalud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL,
  `NOM_ESP` text,
  `TIP_ESP` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id`, `NOM_ESP`, `TIP_ESP`, `created_at`, `updated_at`) VALUES
(1, 'Evaluacion medica', 1, NULL, NULL),
(2, 'Evaluacion psicologica', 1, NULL, NULL),
(3, 'Evaluacion otorrinolaringologica', 1, NULL, NULL),
(4, 'Evaluacion oftalmologica', 1, NULL, NULL),
(5, 'Consulta externa', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id` int(11) NOT NULL,
  `NOM_EVA` text,
  `COS_EVA` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionmedica`
--

CREATE TABLE `evaluacionmedica` (
  `id` int(11) NOT NULL,
  `FEC_MED` timestamp NULL DEFAULT NULL,
  `LUG_MED` varchar(45) DEFAULT NULL,
  `FOT_PAC` varchar(105) DEFAULT NULL,
  `ACO_MED` text,
  `APA_MED` text,
  `HBE_MED` varchar(45) DEFAULT NULL,
  `HFU_MED` varchar(45) DEFAULT NULL,
  `VAM_MED` varchar(45) DEFAULT NULL,
  `VTE_MED` varchar(45) DEFAULT NULL,
  `GSA_MED` varchar(45) DEFAULT NULL,
  `SIG_MED` varchar(45) DEFAULT NULL,
  `TEM_MED` float DEFAULT NULL,
  `PRE_MED` float DEFAULT NULL,
  `FRC_MED` float DEFAULT NULL,
  `FRR_MED` float DEFAULT NULL,
  `SOM_MED` float DEFAULT NULL,
  `TAL_MED` float DEFAULT NULL,
  `PES_MED` float DEFAULT NULL,
  `ECA_MED` text,
  `ECU_MED` text,
  `ECR_MED` text,
  `EGO_MED` text,
  `MOC_MED` text,
  `REC_MED` text,
  `ETR_MED` varchar(45) DEFAULT NULL,
  `LEN_MED` varchar(45) DEFAULT NULL,
  `CAM_MED` text,
  `COL_MED` text,
  `VPR_MED` text,
  `ALD_MED` varchar(45) DEFAULT NULL,
  `ASD_MED` varchar(45) DEFAULT NULL,
  `ALI_MED` varchar(45) DEFAULT NULL,
  `ASI_MED` varchar(45) DEFAULT NULL,
  `ACD_MED` varchar(45) DEFAULT NULL,
  `ACI_MED` varchar(45) DEFAULT NULL,
  `EOE_MED` text,
  `OTO_MED` text,
  `TWE_MED` text,
  `TRI_MED` text,
  `EXT_MED` text,
  `EXC_MED` text,
  `EXA_MED` text,
  `TRS_MED` text,
  `TMS_MED` text,
  `FMS_MED` text,
  `TIN_MED` text,
  `TMI_MED` text,
  `FMI_MED` text,
  `CMA_MED` text,
  `REF_MED` text,
  `PTR_MED` text,
  `PDN_MED` text,
  `PRG_MED` text,
  `FAM_MED` text,
  `REE_MED` varchar(45) DEFAULT NULL,
  `MRE_MED` varchar(45) DEFAULT NULL,
  `REV_MED` varchar(45) DEFAULT NULL,
  `REP_MED` varchar(45) DEFAULT NULL,
  `RFI_MED` text,
  `ID_USU` int(11) DEFAULT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `ID_TIC` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `RFS_MED` varchar(45) DEFAULT NULL,
  `RFT_MED` varchar(45) DEFAULT NULL,
  `MNA_MED` text,
  `APT_MED` int(11) DEFAULT NULL,
  `ESP_MED` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionoftalmo`
--

CREATE TABLE `evaluacionoftalmo` (
  `id` int(11) NOT NULL,
  `FEC_OFT` timestamp NULL DEFAULT NULL,
  `ULE_OFT` varchar(45) DEFAULT NULL,
  `UCV_OFT` timestamp NULL DEFAULT NULL,
  `VBI_OFT` text,
  `SAL_OFT` text,
  `ROD_OFT` text,
  `ROI_OFT` text,
  `ESD_OFT` text,
  `ESI_OFT` text,
  `CID_OFT` text,
  `CII_OFT` text,
  `EJD_OFT` text,
  `EJI_OFT` text,
  `AVD_OFT` text,
  `AVI_OFT` text,
  `CDI_OFT` text NOT NULL,
  `CRC_OFT` text NOT NULL,
  `RUS_OFT` text,
  `RMA_OFT` text,
  `OBS_OFT` text,
  `RFO_OFT` text NOT NULL,
  `ID_MED` int(11) DEFAULT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `ID_TIC` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionotorrino`
--

CREATE TABLE `evaluacionotorrino` (
  `id` int(11) NOT NULL,
  `FEC_OTO` timestamp NULL DEFAULT NULL,
  `LUG_NAC` varchar(100) DEFAULT NULL,
  `ANT_OTO` text,
  `EFI_OTO` text,
  `CON_OTO` text,
  `RFI_OTO` varchar(1000) DEFAULT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `ID_MED` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ID_TIC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionpsicologica`
--

CREATE TABLE `evaluacionpsicologica` (
  `id` int(11) NOT NULL,
  `FEC_PSI` timestamp NULL DEFAULT NULL,
  `LUG_NAC` text,
  `HIS_PSI` text,
  `EX1_PSI` text,
  `EX2_PSI` text,
  `EX3_PSI` text,
  `EX4_PSI` text,
  `RFI_PSI` text,
  `ID_MED` int(11) DEFAULT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `ID_TIC` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `NOM_PAC` varchar(45) DEFAULT NULL,
  `APA_PAC` varchar(45) DEFAULT NULL,
  `AMA_PAC` varchar(45) DEFAULT NULL,
  `SEX_PAC` varchar(20) DEFAULT NULL,
  `CI_PAC` varchar(20) DEFAULT NULL,
  `FEC_NAC` date DEFAULT NULL,
  `REF_PAC` bigint(20) DEFAULT NULL,
  `ID_USU` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `DOM_PAC` text,
  `NRO_PAC` int(11) DEFAULT NULL,
  `ZON_PAC` varchar(45) DEFAULT NULL,
  `PRO_PAC` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `COD_PRO` varchar(45) DEFAULT NULL,
  `NOM_PRO` varchar(100) DEFAULT NULL,
  `DES_PRO` text,
  `CAN_PRO` int(11) DEFAULT NULL,
  `PRE_PRO` float DEFAULT NULL,
  `FEC_PRO` date DEFAULT NULL,
  `ID_USU` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `COD_PRO`, `NOM_PRO`, `DES_PRO`, `CAN_PRO`, `PRE_PRO`, `FEC_PRO`, `ID_USU`, `created_at`, `updated_at`) VALUES
(2, '3212', 'ACICLOVIR CREMA X 5 GR. TBO. SAE', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '1436', 'AGUA TRIDESTILADA X 5 ML. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '4676', 'ALBENDAZOL 400 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '3327', 'AMBROXOL 30 MGR.COMP. MUXOL', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '39', 'AMBROXOL JBE 15MGR/5ML.X 100 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '43', 'AMBROXOL JBE 30MGR/5ML. X 100 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '52', 'AMINOFILINA 250 MGR/ 10 ML. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '65', 'AMOXICILINA 500 MGR. COMP. SAE', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '4740', 'ANTIGRIPAL  COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '460', 'ASGESIC 20 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '3419', 'ASGESIC 60 MG. INY.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '4174', 'ASMACORT AEROSOL 120 DOSIS', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '107', 'AZIMUT 200 MGR. SUSP. X 30 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '3306', 'AZITROMICINA 500 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '561', 'BACITRACINA NEOMICINA DERMICA 10 GR.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '4674', 'BETAMETASONA 1% CREMA X 15 GR.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '135', 'BICARBONATO DE SODIO X 20 ML. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '432', 'BONAGEL SUSP. X 120 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '828', 'BRANULA # 22', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, '3368', 'CARISOPRODOL CAFEINA COMP. RELAX VITA', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, '168', 'CEFALEXIN 250 MGR SUSP. X 60 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, '170', 'CEFALEXIN 500 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, '175', 'CEFOTAXIN 1 GR. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, '176', 'CEFTRIAXON 1 GR. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, '189', 'CIPROFLOXACINO 500 MG. COMP. SAE', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, '191', 'CIPROVAL SOL. OFTALMICA X 5 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, '4657', 'CITERIZINA 10 MGR COMP. QUILAB', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, '3837', 'CITOL DEXA COLIRIO X 10 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, '816', 'CLARITROMICINA 500 MGR COMP. LCH.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, '74', 'CLAVINEX DUO COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, '218', 'CLORANFENICOL 1% SOL.OFTM. X 5 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, '225', 'CLORFENAMINA 10 MG/2 ML. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, '229', 'CLORFENAMINA 4 MG. TAB.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, '3241', 'CLOXACILINA 500 GR INY.  AMP. BETACLOX', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, '4673', 'CODEINA 10 MGR. JARABE X 100 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, '775', 'COFAMIN K AMP. VITAMINA K  10 MGR/ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, '258', 'COTRIMOXAZOL 960 MGR COMP. SAE', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, '295', 'DICLOFENACO 100 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, '303', 'DICLOFENACO 50 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, '307', 'DICLOFENACO 75 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, '325', 'DICLOXACIL 250 MGR. SUSP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, '338', 'DOMPERIDONA 10 MG. COMP. L.CH.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, '348', 'DOXICICLINA 100 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, '373', 'EFORTIL AMP. ETILADRIONAL 10 MGR./ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, '356', 'EPINEFRINA 1 MGR/ML/ADRENALINA', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, '861', 'EQUIPO DE SUERO C/CONECTOR EN Y', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, '862', 'EQUIPO DE SUERO INTRAFIX', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, '361', 'ERITROBOL 250 MGR SUSP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, '364', 'ERITROBOL 500 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, '3455', 'ESPASMO LOXADIN INY.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, '391', 'FENTANYL 0.5 MGR/ML. X 10 ML AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, '2568', 'FUROSEMIDA 20 MGR/2ML.  AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, '2569', 'FUROSEMIDA 40 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, '410', 'GENTAMICINA 80 MGR. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, '422', 'GLUCONATO DE CALCIO 10% X 10 ML. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, '49', 'GLUMIKIN 500 MGR. INY. AMIKACINA', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, '4675', 'HIDROCORTISONA 1 % CREMA 15 GR.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, '3174', 'HIDROCORTISONA 1% CREMA X 10 GR. TBO.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, '909', 'HILO MONONYLON # 3/0  C/A.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, '2618', 'HILO MONONYLON # 3/0  C/A. ETHICON', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, '941', 'HILO VICRYL DEXON # 1 C/A 4 CM. ETHICON', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, '3780', 'IBUPROFENO 400 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, '445', 'IBUPROFENO 400 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, '328', 'IDANTINA 100 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, '3753', 'IFANICOL 1 GR. CLORANFENICOL 1 GR. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, '960', 'JERINGA DESCART. 10 ML', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, '961', 'JERINGA DESCART. 20 ML', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, '2605', 'KETAMINA 50 MGR. X 10 ML. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, '481', 'LIDOCAINA 2 % X 20 ML. TERBOCAINA', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, '3317', 'LIDRAMINA AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, '327', 'LIDRAMINA POMADA X 15 GR.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, '4656', 'LORATADINA 10 MGR COMP. QUILAB', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, '502', 'MEBENFAR 100 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, '721', 'MERIDIAN 300 MGR COMP. TEOFILINA 300 MGR', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, '522', 'METOCLOPRAMIDA 10 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, '3715', 'METOCLOPRAMIDA 10 MGR/ML AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, '531', 'METROGYN 250 MGR SUSP. X 200 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, '530', 'METROGYN 500 MGR INFUSOR X 100 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, '537', 'METRONIDAZOL 500 MGR.COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, '544', 'MIDAZOLAM 15 MGR/3 ML.  AMP. DALAM', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, '57', 'MOXILIN 1 GR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, '60', 'MOXILIN 250 MGR SUSP.X 60 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, '30', 'NALIDIX 500 MGR', NULL, 28, 3, '2019-03-08', 27, '0000-00-00 00:00:00', '2017-03-05 05:41:28'),
(85, '27', 'NALIDIX FORTE 250 MGR SUSP.', NULL, 63, 6.5, '2017-02-24', 27, '0000-00-00 00:00:00', '2017-02-06 03:44:03'),
(86, '559', 'NALOXONA 0,4 MGR. AMP. ANTIOPIAZ', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, '144', 'NEOCAINA PESADA AMP. BUPIVACAINA 0,05 %', 'NULL', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, '565', 'NEOSTIGMINA 0.5 MGR/ML. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, '4162', 'NITROFURANTOINA 100 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, '581', 'NORFLOXACINA 400 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, '147', 'NOVABUPI AMP. BUPIVACAINA+EPINEF. X 20 M', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, '584', 'OMEPRAZOL 20 MGR. CAP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, '407', 'OPTAMICIN SOL OFTM.X 5 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, '604', 'PARACETAMOL 500 MG. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, '3514', 'PENICILINA  1.000.000 U.I. G SODICA', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, '730', 'PENTOTAL 1 GR. FCO/AMP. THIPENTAL SODICO', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, '3347', 'PIRANTELINA 250 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, '595', 'PIRANTELINA SUSP. X 15 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, '3555', 'PREDNISONA 20 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, '3673', 'QUEMADERM CREMA X 30 GR', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, '666', 'RANITIDINA 150 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, '678', 'SALBUTAMOL 4 MGR. COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, '679', 'SALBUTAMOL AEROSOL 100 UG X 200 DOSIS', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, '685', 'SEVOCRIS ML. SEVOFLUORANO X ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, '1021', 'SONDA KERS N? 12-14-16', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, '691', 'SUCCINATO DE HIDROCORTISONA 100 MGR.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, '693', 'SUCCINATO HIDROCORTISONA 500 MGR.AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, '671', 'SUERO DE REHIDRAT. C/SABOR X 1 LT.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, '697', 'SUERO FISIOLOGICO ISOT. 1000 CC.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, '702', 'SUERO GLUCOSADO 5% 1000 CC.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, '705', 'SUERO RINGER LACTATO H. 1000 CC.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, '707', 'SUERO RINGER NORMAL 1000 CC.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, '709', 'SUERO SOLUCI?N MANITOL 20 %  500 CC.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, '712', 'SULFATO DE ATROPINA1 MG/ML AMP. ALFA', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, '172', 'SUPRACEF 1 GR AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, '4660', 'TERADOL 1 GR. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, '629', 'TERBOCYL 1.200.000. AMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, '154', 'TERBODINA 250 MGR. SUSP. X 60 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, '155', 'TERBODINA 500 MGR COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, '734', 'TINIDAZOL 1 GR. COMP', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, '623', 'TRIO VAL SUSP. X 100 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, '284', 'TUSBOL JARABE X 100 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, '1120', 'VENDA DE YESO 10 CM.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, '1121', 'VENDA DE YESO 12 CM.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, '1123', 'VENDA DE YESO 20 CM.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, '1089', 'VENDA GASA 10 CM', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, '1092', 'VENDA GASA 5 CM', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, '1093', 'VENDA GASA 7.5 CM', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, '1135', 'VENDA ORTOPEDICA 10 CM.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, '3396', 'VITAESPASMO COMPUESTO COMP.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, '4245', 'ZMOL JARABE 160 MGR/5 ML. X 60 ML.', 'null', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, '3421', 'ACICLOVIR 200 MGR COMP.', 'NULL', 0, 0, '0000-00-00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, '30', 'NALIDIX 500 MGR', NULL, 10, 3.5, '2019-03-08', 27, '2017-03-05 06:03:47', '2017-03-05 06:03:47'),
(134, '30', 'NALIDIX 500 MGR', NULL, 10, 3.5, '2020-02-01', 27, '2017-03-05 06:05:02', '2017-03-05 06:05:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id` int(11) NOT NULL,
  `DES_REC` text,
  `FEC_REC` timestamp NULL DEFAULT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `ID_MED` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `FEC_RES` date DEFAULT NULL,
  `HOR_RES` time DEFAULT NULL,
  `ID_TIC` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sanguineo`
--

CREATE TABLE `sanguineo` (
  `id` int(11) NOT NULL,
  `TIPO` varchar(5) DEFAULT NULL,
  `FACTOR` char(5) DEFAULT NULL,
  `ID_PAC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `EST_TIC` int(11) DEFAULT NULL,
  `EVA_TIC` varchar(50) DEFAULT NULL,
  `IMP_TIC` int(11) DEFAULT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `ID_MED` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `NOM_USU` varchar(45) DEFAULT NULL,
  `APA_USU` varchar(45) DEFAULT NULL,
  `AMA_USU` varchar(45) DEFAULT NULL,
  `EST_USU` text,
  `ARE_USU` varchar(45) DEFAULT NULL,
  `TEL_USU` bigint(20) DEFAULT NULL,
  `NIV_USU` int(11) DEFAULT NULL,
  `NIC_USU` varchar(45) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `remember_token` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `NOM_USU`, `APA_USU`, `AMA_USU`, `EST_USU`, `ARE_USU`, `TEL_USU`, `NIV_USU`, `NIC_USU`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mercedes', 'Apaza', 'Nina', 'Dar salud 20 de octubre', 'Psicologa', 73595866, 2, 'mapaza', '$2y$10$miAlmDwWoIXZDCZcy16UQuEZFrKGlxpZjpUOtYEl0iAddI29h4lGa', 'qEtKHGS3EDv5c2vFJGqujII15kwfGkibzPwD8ePgWWZN0DV0IKhWYjBUxIsE', '2016-07-12 23:59:36', '2016-07-13 00:21:01'),
(2, 'Ronald', 'Quisbert', 'Mamani', 'Dar salud 20 de octubre', 'Medico', 72587353, 2, 'RONALD.QUISBERT', '$2y$10$FW5SZopnFsUnvne4lbNuDOSifbW//fwBprf7vVxxWti.acqwM75DC', 'WldgGvGoDvcMdXKLkb0yF8rDHeZqzK7dmtuzHQ4usYavZ8mL9m8mixBEslpE', '2016-07-13 00:24:22', '2017-01-27 19:57:26'),
(3, 'Karen', 'Illatarco', 'Condori', 'Dar salud 20 de octubre', 'Recepcion', 73262840, 3, 'killatarco', '$2y$10$3b.9iCcXFKa2qqasrqioUOPr6Z3IO9gq5TGYsNa.HBixUBXEofuAm', '3POE83aYNbczGb9xFlAziPbRIDwqsxQSFLa5uSElOEd1KIEFS8UWt2rwGSCj', '2016-07-13 01:01:33', '2017-01-13 22:40:48'),
(4, 'Helen', 'Gomez', 'Asin', 'Dar salud 20 de octubre', 'Recepcion', 72583744, 3, 'hgomez', '$2y$10$GHElHiH1/FzhIXNeI2VXU.tJfWi97iied4rq.yl/n2rz2P5SNY37C', 'SCtsMrJbfq2igvLIUvp8QuHQ1cGFcuawDzvRnHuQU0NJTRFU7G26Vz060fOZ', '2016-07-13 01:03:38', '2016-07-13 01:34:15'),
(5, 'Amy Luisa', 'Salazar', 'Helguero', 'Dar salud', 'Medico', 0, 2, 'asalazar', '$2y$10$72vsaKd/q3p8ypw2mIRDh.GYzlQ10uvE4M1WoRZWHBKmpk4sDEc1W', 'D7S8JsU32jHrSwxGA2patZKOdDB7gfxyf3PblWgTQ33YyBk7pM7TKem5tlJx', '2016-08-12 02:16:41', '2017-03-05 08:41:40'),
(6, 'Claudia Mabel', 'Rojas ', 'Lafuente', 'Dar salud', 'Medico', 0, 2, 'crojas', '$2y$10$fnRmSgjV5wnXsjcYNM/jI.copvPRQNq9H1EmsQRRHUGzmPL9Mh4be', 'UULnHSkGIESO1Y8lgvx3IjDneJylCeHqVfwOlAcQq7hgxpQq3utdIrqlYDfF', '2016-08-12 02:17:26', '2016-10-07 17:47:54'),
(7, 'Marco Samir', 'Perez', 'Alvarado', 'Dar salud', 'Fisioterapeuta', 0, 2, 'mperez', '$2y$10$bylf.xvULw7vhphnK2v32uiHiT81P1kDiVuX2CVwiLsrJuwVjsByS', NULL, '2016-08-12 02:18:25', '2016-08-12 02:18:25'),
(8, 'Jenny ', 'Yevara', 'Espinoza', 'Dar salud', 'Recepcionista', 0, 3, 'jyevara', '$2y$10$gVbYXRLfSVRlfTXpUut06ueY8QkRFtcOoH2x9nX7dQu58484NoOBu', 'meENKkr8IEboU4MBOe5oURaETPhJ7BLZ0XzCBMLAVIdtWZpHmdvWREDTr8xB', '2016-08-12 02:19:46', '2017-01-10 22:24:55'),
(9, 'Shirley ', 'Aguilar', 'Capuara', 'Dar salud', 'Medico', 0, 2, 'saguilar', '$2y$10$T5Pax3YWpw3Hknkxc0Dyzub/gwntGXtjF4IFTtL47GWCdWfdgFKRG', '9ADQs7cIUAoyxRlLQvtL70S0HuMFVqUzc5mlBuOMF3xumrvsv9DCLvyNqhCg', '2016-08-12 02:20:27', '2017-01-26 23:42:21'),
(10, 'Edwin Boris', 'Condori', 'Ramirez', 'Dar salud', 'Optometra', 0, 2, 'econdori', '$2y$10$WRATEEJnQrSkbACN7ELQb.fSpgkLFG7UPAuvyx9TptwyGfXU67Oni', 'Zniww2DoNrIAuJbLDig4IHx0S9ksBVFRx6vj5gS1dLbKRfcPagTjUq794NET', '2016-08-12 02:21:05', '2016-11-22 16:51:57'),
(11, 'Omar Guillermo', 'Alvarado', 'Alarcon', 'Dar salud', 'Bioquimico', 0, 2, 'oalvarado', '$2y$10$GrGJWrU4//dguSU3.t9M6uafJqujYGenseuZGh5lZfT3uOh1zsWVG', NULL, '2016-08-12 02:21:44', '2016-08-12 02:21:44'),
(12, 'Maria Guillermina', 'Mamani', '', 'Dar salud', 'Ginecologa', 0, 2, 'mmamani', '$2y$10$83VI9Y4j6xeI/x4QvyFwxeh5EE6fYlNzTNOgIZiuARPiWl0Z5lUJ.', NULL, '2016-08-12 02:22:58', '2016-08-12 02:22:58'),
(13, 'Orietta', 'Montero', '', 'Dar salud', 'Otorrinolaringologa', 0, 2, 'omontero', '$2y$10$cPjNvYgoJ8QkSBmgc4UoXO7LdaJn691RHeXfb2xetMC8oXx4gZt/a', NULL, '2016-08-12 02:23:38', '2016-08-12 02:23:38'),
(14, 'Adriana', 'Nuñez del Prado', 'Rodriguez', 'Dar salud', 'Odontologa', 0, 2, 'anuñez', '$2y$10$xUCp8MrMsj2KFWcEaLoBH.d1VVzF9TbN7VWL5RENmVnbJvKHSxO4O', NULL, '2016-08-12 02:24:32', '2016-08-12 02:24:32'),
(15, 'Marco Antonio', 'Bolaños', 'Solares', 'Dar salud', 'Traumatologo', 0, 2, 'mbolaños', '$2y$10$auG22wa7A968jhF4K.o3veKCRS/ubkmdEdekzRE6lsKYEwg34obB6', NULL, '2016-08-12 02:25:15', '2016-08-12 02:25:15'),
(16, 'Sidar Fernando', 'Diaz', 'Johannsseen', 'Dar salud', 'Pediatra', 0, 2, 'sdiaz', '$2y$10$AWiaRs0DGFBjwoJ6RmUz1.EZ0lR2.Z.rLkRrN09Ilqvl8rOb/01h.', NULL, '2016-08-12 02:25:57', '2016-08-12 02:25:57'),
(17, 'Benjamin', 'Castelo', 'Oporto', 'Dar salud', 'Neumologo', 0, 2, 'bcastelo', '$2y$10$Nyo41dG43uYClowtV3L1zOIViphqqxOpuWGkZb0og7Pkm6n7/.R4a', NULL, '2016-08-12 02:26:36', '2016-08-12 02:26:36'),
(18, 'Arminda Concepcion', 'Perez', 'Correa', 'Dar salud', 'Administradora', 60500012, 1, 'aperez', '$2y$10$Iza8qjCZz6zwwD9Okhgxp.2hwLJkBQpqL0Tiaw2GqJ1HjD./vJYPm', NULL, '2016-08-12 02:29:47', '2016-08-12 02:29:47'),
(19, 'Geogina A.', 'Romero', 'Reynaga', 'Dar salud', 'Psicologa', 0, 2, 'gromero', '$2y$10$Czt/nJ5Qk3Cm09es9G/ZqOcP202O/lfoiyCOabyAwAAc9alO8btxC', 'IlHLWlBA49uO4WNvhcEZZUftsHaYlqpufVQLDBeGRYvd3k4lKwQ4aBCWfcLA', '2016-08-12 02:30:48', '2017-01-27 20:22:47'),
(20, 'Wilson', 'Yucra', 'Gutierrez', 'Dar salud', 'Administrador', 70657043, 1, 'wyucra', '$2y$10$uVxuVOCeEHaG83bWig5VuOHFATVVKPsf6bbqGkeCIPoJuos9AJgby', NULL, '2016-08-12 02:32:17', '2016-08-12 02:32:17'),
(21, 'Arminda Concepcion', 'Perez', 'Correa', 'Dar salud', 'Recepcionista', 60500012, 3, 'cperez', '$2y$10$6xrg9YMDvc1FeyCI0Rwj7.3I2E2haqiUDCtz40NbDlyi//6cw1L1a', 'mWgWExYZSrA9aX1o0i1guKo7gHlYaRaX3EWOKChYx2y4eBrUTqTwVxTOxzMU', '2016-08-12 02:33:18', '2017-01-25 23:59:30'),
(25, 'Wilson Omar', 'Yucra', 'Gutierrez', 'Dar salud 20 de octubre', 'Recepcion', 0, 3, 'oyucra', '$2y$10$VOSSiRcC3aFO9ce9FN9raeJFh5Ml34fNf3AmBjIwPsvKfKL.zItXK', 'I8TgilN9RmgdtIM16DdKHhQNPfzbEPNB6v8OdstBvYDD3KOpqU9e5EM0Df1H', '2016-09-01 23:15:21', '2016-12-02 00:48:56'),
(26, 'Ana Maria', 'Zapata', 'Guzman', 'Dar salud 20 de octubre', 'Medico', 0, 2, 'azapata', '$2y$10$CeaUMG7WPLk49S3sEh4mVO1HYnAvOfhPchZXg/ZOe6F4lS5v5Tf.y', 'gM26Rfe2SFtwanFcLuAFNS3RsKLD2X2XcAA1qnYUohx84OsUEm1PzVD9I8NC', '2016-09-02 23:32:07', '2017-01-27 18:15:05'),
(27, 'Luis', 'Quisbert', 'Quispe', 'Dar salud 20 de octubre', 'Medico', 0, 3, 'lquisbert', '$2y$10$g.ZhZmzXGWWpUuaNRiGaR.C3HQHnIjoQ/iVPNjQ2JV/sSNxT/i4U2', 'lW6kQLQGMjczfj4zwQ09YzZA5PGaxf0IsWRRC8aiOnsjwTzIyjKbz9VYXZ48', '2017-02-06 03:40:39', '2017-03-05 08:23:43'),
(28, 'Luis', 'Quisbert', 'Quispe', 'Dar salud 20 de octubre', 'Medico', 0, 1, 'fquisbert', '$2y$10$2VS6Tey14g5aMHL5ADOmg.d5GTmP39SIwa/uUuA2c7TVtJuW18cwW', 'IH0dy8iMIMXaxnJdi0jQSEfN1NxilzYNAP7isq2Rhw8SHTJ7NKZNI3SqBU05', '2017-02-06 20:39:37', '2017-03-05 05:49:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluacionmedica`
--
ALTER TABLE `evaluacionmedica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medico_idx` (`ID_USU`),
  ADD KEY `pacienteeva_idx` (`ID_PAC`),
  ADD KEY `ticketmed_idx` (`ID_TIC`);

--
-- Indices de la tabla `evaluacionoftalmo`
--
ALTER TABLE `evaluacionoftalmo`
  ADD KEY `ticketotft_idx` (`ID_TIC`),
  ADD KEY `pacienteoft_idx` (`ID_PAC`),
  ADD KEY `medicofti_idx` (`ID_MED`);

--
-- Indices de la tabla `evaluacionotorrino`
--
ALTER TABLE `evaluacionotorrino`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pac_oto_idx` (`ID_PAC`),
  ADD KEY `med_oto_idx` (`ID_MED`),
  ADD KEY `tic_oto_idx` (`ID_TIC`);

--
-- Indices de la tabla `evaluacionpsicologica`
--
ALTER TABLE `evaluacionpsicologica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicocopsi_idx` (`ID_MED`),
  ADD KEY `pacientepscoi_idx` (`ID_PAC`),
  ADD KEY `tickpsico_idx` (`ID_TIC`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_idx` (`ID_USU`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickres_idx` (`ID_TIC`);

--
-- Indices de la tabla `sanguineo`
--
ALTER TABLE `sanguineo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_idx` (`ID_PAC`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicotick_idx` (`ID_MED`),
  ADD KEY `pacientetick_idx` (`ID_PAC`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `evaluacionmedica`
--
ALTER TABLE `evaluacionmedica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4921;
--
-- AUTO_INCREMENT de la tabla `evaluacionotorrino`
--
ALTER TABLE `evaluacionotorrino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evaluacionpsicologica`
--
ALTER TABLE `evaluacionpsicologica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5185;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sanguineo`
--
ALTER TABLE `sanguineo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6553;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evaluacionmedica`
--
ALTER TABLE `evaluacionmedica`
  ADD CONSTRAINT `medico` FOREIGN KEY (`ID_USU`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pacienteeva` FOREIGN KEY (`ID_PAC`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ticketmed` FOREIGN KEY (`ID_TIC`) REFERENCES `ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluacionoftalmo`
--
ALTER TABLE `evaluacionoftalmo`
  ADD CONSTRAINT `medicooft` FOREIGN KEY (`ID_MED`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pacienteoft` FOREIGN KEY (`ID_PAC`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ticketoft` FOREIGN KEY (`ID_TIC`) REFERENCES `ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluacionotorrino`
--
ALTER TABLE `evaluacionotorrino`
  ADD CONSTRAINT `med_oto` FOREIGN KEY (`ID_MED`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pac_oto` FOREIGN KEY (`ID_PAC`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tic_oto` FOREIGN KEY (`ID_TIC`) REFERENCES `ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluacionpsicologica`
--
ALTER TABLE `evaluacionpsicologica`
  ADD CONSTRAINT `medicopsi` FOREIGN KEY (`ID_MED`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pacientepsi` FOREIGN KEY (`ID_PAC`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tickpsico` FOREIGN KEY (`ID_TIC`) REFERENCES `ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `usuario` FOREIGN KEY (`ID_USU`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `tickres` FOREIGN KEY (`ID_TIC`) REFERENCES `ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sanguineo`
--
ALTER TABLE `sanguineo`
  ADD CONSTRAINT `paciente` FOREIGN KEY (`ID_PAC`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `medicotick` FOREIGN KEY (`ID_MED`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pacientetick` FOREIGN KEY (`ID_PAC`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
