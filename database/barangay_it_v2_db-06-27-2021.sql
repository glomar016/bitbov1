-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2021 at 11:15 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barangay_it_v2_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `search_resident` (IN `search_val` VARCHAR(255))  BEGIN
	SELECT RESIDENT_ID
	, CONCAT(FIRSTNAME,' ', LASTNAME) AS FULLNAME
	, CONCAT(MONTHNAME(DATE_OF_BIRTH),' ',DAY(DATE_OF_BIRTH),', ',YEAR(DATE_OF_BIRTH)) AS DATE_OF_BIRTH
	, PLACE_OF_BIRTH
	, CONCAT(ADDRESS_HOUSE_NO,' ',ADDRESS_STREET_NO, ' ',ADDRESS_STREET) AS FULL_ADDRESS
	, PROFILE_PICTURE
    , YEAR(curdate()) - YEAR(`bi`.`DATE_OF_BIRTH`) - (right(curdate(),5) < right(`bi`.`DATE_OF_BIRTH`,5)) AS `AGE`
    ,SEX
    ,CITIZENSHIP
	FROM t_resident_basic_info as  bi
	WHERE 
	CONCAT(FIRSTNAME,' ', LASTNAME) LIKE CONCAT('%',search_val, '%')
	AND bi.RESIDENT_ID NOT IN (SELECT RESIDENT_ID FROM t_barangay_official) ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_patient` (IN `param_resident_id` INT, IN `param_body_temp` DOUBLE, IN `param_blood_pressure` VARCHAR(50), IN `param_pulse_rate` DOUBLE, IN `param_respiratory_rate` DOUBLE, IN `param_weight` VARCHAR(50), IN `param_height` VARCHAR(50), IN `param_pregnant` INT(11), IN `param_lmp` DATETIME, IN `param_edc` DATETIME, IN `param_edd` DATETIME)  NO SQL
BEGIN
insert into t_patient_records
(
    RESIDENT_ID,
    BODY_TEMPERATURE,
    BLOOD_PRESSURE,
    PULSE_RATE,
    RESPIRATORY_RATE,
    WEIGHT,
    HEIGHT,
    IS_PREGNANT,
    LAST_MENSTRUAL_PERIOD,
    ESTIMATED_DATE_OF_CONCEPTION,
    ESTIMATED_DATE_OF_DELIVERY
)
VALUES
(
   param_resident_id,
   param_body_temp,
   param_blood_pressure,
   param_pulse_rate,
   param_respiratory_rate,
   param_weight,
   param_height,
   param_pregnant,
   param_lmp,
   param_edc,
   param_edd
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gethousehold_mebers` (IN `header_id` INT)  BEGIN

	SELECT TB.FAMILY_HEADER_ID
		, CONCAT(T.LASTNAME, ' ', T.FIRSTNAME, ' ', T.MIDDLENAME) AS FULLNAME
		, LASTNAME
		, FIRSTNAME
		, MIDDLENAME
		, QUALIFIER
		, T.CONTACT_NUMBER
		, T.ADDRESS_HOUSE_NO
		
		, T.ADDRESS_STREET
		, T.ADDRESS_PHASE
	  , T.PLACE_OF_BIRTH
		, T.DATE_OF_BIRTH
		, T.SEX
		, T.CIVIL_STATUS
		, T.CITIZENSHIP
		, T.OCCUPATION
		, T.RELATION_TO_HOUSEHOLD_HEAD
		, T.ADDRESS_HOUSE_NO

FROM T_RESIDENT_BASIC_INFO AS T
INNER JOIN T_HOUSEHOLD_INFORMATION AS HI 
ON T.HOUSEHOLD_ID = HI.HOUSEHOLD_ID
INNER JOIN T_HOUSEHOLD_MEMBERS AS TH 
ON T.RESIDENT_ID = TH.RESIDENT_ID
INNER JOIN T_HOUSEHOLD_BATCH AS TB
ON TH.FAMILY_HEADER_ID = TB.FAMILY_HEADER_ID
WHERE TB.FAMILY_HEADER_ID = header_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_occupancy` (IN `PBUILDING_ID` INT, IN `PTRANSACTION_ID` INT)  BEGIN
SELECT 
BUILDING_ID
, OCCUPANCY
, COUNT(OCCUPANCY) AS TOTAL
, UNIT_FLOOR_AREA
FROM t_building_occupancy
WHERE BUILDING_ID = PBUILDING_ID
GROUP BY OCCUPANCY;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_permissions` ()  BEGIN
	SELECT
	
	DISTINCT(concat( `rbi`.`FIRSTNAME`, ' ', `rbi`.`MIDDLENAME`, ' ', `rbi`.`LASTNAME` )) AS `FULLNAME`
	,p.POSITION_NAME
	,`u`.`PERMIS_RESIDENT_BASIC_INFO` AS `PERMIS_RESIDENT_BASIC_INFO`
	,`u`.`PERMIS_FAMILY_PROFILE` AS `PERMIS_FAMILY_PROFILE`
	,`u`.`PERMIS_COMMUNITY_PROFILE` AS `PERMIS_COMMUNITY_PROFILE`
	,`u`.`PERMIS_BLOTTER` AS `PERMIS_BLOTTER`
	,`u`.`PERMIS_PATAWAG` AS `PERMIS_PATAWAG`
	,`u`.`PERMIS_BARANGAY_OFFICIAL` AS `PERMIS_BARANGAY_OFFICIAL`
	,`u`.`PERMIS_BUSINESSES` AS `PERMIS_BUSINESSES`
	,`u`.`PERMIS_ISSUANCE_OF_FORMS` AS `PERMIS_ISSUANCE_OF_FORMS`
	,`u`.`PERMIS_ORDINANCES` AS `PERMIS_ORDINANCES`
	,`u`.`PERMIS_SYSTEM_REPORT` AS `PERMIS_SYSTEM_REPORT`
	,`u`.`PERMIS_HEALTH_SERVICES` AS `PERMIS_HEALTH_SERVICES`
	,`u`.`PERMIS_DATA_MIGRATION` AS `PERMIS_DATA_MIGRATION`
	,`u`.`PERMIS_USER_ACCOUNTS` AS `PERMIS_USER_ACCOUNTS`
	,`u`.`PERMIS_BARANGAY_CONFIG` AS `PERMIS_BARANGAY_CONFIG`
	,`u`.`PERMIS_BUSINESS_APPROVAL` AS `PERMIS_BUSINESS_APPROVAL`
	,`u`.`PERMIS_APPLICATION_FORM` AS `PERMIS_APPLICATION_FORM`
	,`u`.`PERMIS_APPLICATION_FORM_EVALUATION` AS `PERMIS_APPLICATION_FORM_EVALUATION`
	
FROM
	(
	(
	(
	(
	( `t_users` `u` JOIN `t_barangay_official` `bo` ON ( ( `bo`.`BARANGAY_OFFICIAL_ID` = `u`.`BARANGAY_OFFICIAL_ID` ) ) )
	JOIN `r_barangay_information` `bs` ON ( ( `bs`.`BARANGAY_ID` = `bo`.`BARANGAY_ID` ) ) 
	)
	JOIN `t_resident_basic_info` `rbi` ON ( ( `bo`.`RESIDENT_ID` = `rbi`.`RESIDENT_ID` ) ) 
	)
	JOIN `r_position` `p` ON ( ( `p`.`POSITION_ID` = `u`.`POSITION_ID` ) ) 
	)
	JOIN `r_municipal_information` `mi` ON ( ( `mi`.`MUNICIPAL_ID` = `bs`.`MUNICIPAL_ID` ) ) 
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_positions` ()  BEGIN
	SELECT POSITION_ID, POSITION_NAME FROM r_position;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_house_no` (IN `header_id` INT)  BEGIN

	SELECT T.ADDRESS_HOUSE_NO

FROM T_RESIDENT_BASIC_INFO AS T
INNER JOIN T_HOUSEHOLD_INFORMATION AS HI 
ON T.HOUSEHOLD_ID = HI.HOUSEHOLD_ID
INNER JOIN T_HOUSEHOLD_MEMBERS AS TH 
ON T.RESIDENT_ID = TH.RESIDENT_ID
INNER JOIN T_HOUSEHOLD_BATCH AS TB
ON TH.FAMILY_HEADER_ID = TB.FAMILY_HEADER_ID
WHERE TB.FAMILY_HEADER_ID = header_id
LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_manage_checkup` (IN `type` VARCHAR(50), IN `search_val` VARCHAR(50), IN `mother_resident_id` INT(11), IN `param_patient_id` INT(11), IN `param_cc` VARCHAR(400), IN `param_diagnosis` VARCHAR(400), IN `param_mt` VARCHAR(400), IN `param_health_insurance` VARCHAR(100), IN `param_date_of_checkup` TIMESTAMP)  NO SQL
BEGIN
DECLARE COUNTS INT;
IF type = 'FETCH'
THEN 
 select TRBI.RESIDENT_ID
	, CONCAT(FIRSTNAME,' ', LASTNAME) AS FULLNAME
	, CONCAT(MONTHNAME(DATE_OF_BIRTH),' ',DAY(DATE_OF_BIRTH),', ',YEAR(DATE_OF_BIRTH)) AS DATE_OF_BIRTH
	, PLACE_OF_BIRTH
	, CONCAT(ADDRESS_HOUSE_NO,' ',ADDRESS_STREET_NO, ' ',ADDRESS_STREET) AS FULL_ADDRESS
	, PROFILE_PICTURE
    ,YEAR(CURDATE())-YEAR(DATE_OF_BIRTH) as AGE
    ,SEX
    ,PATIENT_ID
    ,BODY_TEMPERATURE
    ,BLOOD_PRESSURE
    ,PULSE_RATE
    ,RESPIRATORY_RATE
    ,WEIGHT
    ,HEIGHT
    from t_patient_records as TPR
 inner join t_resident_basic_info as TRBI
 	on TRBI.RESIDENT_ID = TPR.RESIDENT_ID  
    where TPR.STATUS = 'PENDING';
END IF;


IF type = 'SEARCH'
THEN 
 select TRBI.RESIDENT_ID
	, CONCAT(FIRSTNAME,' ', LASTNAME) AS FULLNAME
	, CONCAT(MONTHNAME(DATE_OF_BIRTH),' ',DAY(DATE_OF_BIRTH),', ',YEAR(DATE_OF_BIRTH)) AS DATE_OF_BIRTH
	, PLACE_OF_BIRTH
	, CONCAT(ADDRESS_HOUSE_NO,' ',ADDRESS_STREET_NO, ' ',ADDRESS_STREET) AS FULL_ADDRESS
	, PROFILE_PICTURE
    ,YEAR(CURDATE())-YEAR(DATE_OF_BIRTH) as AGE
    ,SEX
    ,PATIENT_ID
    ,BODY_TEMPERATURE
    ,BLOOD_PRESSURE
    ,PULSE_RATE
    ,RESPIRATORY_RATE
    ,WEIGHT
    ,HEIGHT
    from t_patient_records as TPR
 inner join t_resident_basic_info as TRBI
 	on TRBI.RESIDENT_ID = TPR.RESIDENT_ID  
    WHERE TPR.RESIDENT_ID NOT IN (SELECT RESIDENT_ID FROM t_barangay_official) 
	AND CONCAT(FIRSTNAME,' ', LASTNAME) LIKE CONCAT('%',search_val, '%')
	AND FIRSTNAME LIKE CONCAT('%',search_val, '%') OR LASTNAME  LIKE CONCAT('%',search_val, '%') AND TPR.STATUS = 'PENDING';
END IF;


IF type = 'CHECK_IF_MOTHER'
THEN 
	SET COUNTS = (select COUNT(*)
    FROM t_mothers_profile 
    where RESIDENT_ID = mother_resident_id);
    
    IF COUNTS=0
    THEN 
    	INSERT INTO t_mothers_profile(RESIDENT_ID)VALUES(mother_resident_id);
    END IF;
    	
END IF;


IF type = 'STORE'
THEN 	
    update t_patient_records
    	SET CHIEF_COMPLAINT = param_cc,
        	DIAGNOSIS	 = param_diagnosis,
            MEDICATION_TREATMENT = param_mt,
            HEALTH_INSURANCE = param_health_insurance,
            DATE_OF_CHECKUP = param_date_of_checkup
            where PATIENT_ID = param_patient_id;   
    	
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_municipal_info` (IN `barangay_id` INT)  BEGIN

SELECT MI.MUNICIPAL_NAME, MI.PROVINCE_NAME, MI.REGION , BI.BARANGAY_NAME
FROM r_barangay_information AS BI
INNER JOIN r_municipal_information AS MI
ON BI.MUNICIPAL_ID = MI.MUNICIPAL_ID
WHERE BI.BARANGAY_ID = barangay_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_residents_not_official` ()  BEGIN
	SELECT RESIDENT_ID, CONCAT(FIRSTNAME,' ',LASTNAME) AS FULLNAME FROM t_resident_basic_info
	WHERE RESIDENT_ID NOT IN (SELECT RESIDENT_ID FROM t_barangay_official);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_resident_info` (IN `search_val` VARCHAR(100))  BEGIN
SELECT RESIDENT_ID
, LASTNAME
, FIRSTNAME
, MIDDLENAME
, QUALIFIER
, SEX
, DATE_OF_BIRTH
, CIVIL_STATUS
, OCCUPATION
, CITIZENSHIP
, RELATION_TO_HOUSEHOLD_HEAD
, CONTACT_NUMBER
, DATE_OF_BIRTH
, PLACE_OF_BIRTH
, ADDRESS_UNIT_NO
, ADDRESS_PHASE
, ADDRESS_HOUSE_NO
, ADDRESS_STREET
, ADDRESS_STREET_NO
, ADDRESS_SUBDIVISION
, ADDRESS_BUILDING
, DATE_STARTED_WORKING
, DATE_OF_ARRIVAL
, 	concat(
	
	IFNULL( concat( `t_resident_basic_info`.`ADDRESS_HOUSE_NO`, ' ' ), '' )
	, IFNULL( concat( `t_resident_basic_info`.`ADDRESS_BUILDING`, ' ' ), '' )
	, IFNULL( concat( `t_resident_basic_info`.`ADDRESS_PHASE`, ' ' ), '')
	, IFNULL( concat( `t_resident_basic_info`.`ADDRESS_BLOCK_NO`, ' ' ), '' )
	, IFNULL( concat( `t_resident_basic_info`.`ADDRESS_STREET`, ' ' ), '' )
	
	, IFNULL( concat( `t_resident_basic_info`.`ADDRESS_SUBDIVISION`, ' ' ), '' ) 
	, IFNULL( concat( `t_resident_basic_info`.`ADDRESS_STREET_NO`), '' )
	) AS `ADDRESS`
FROM t_resident_basic_info
WHERE RESIDENT_ID NOT IN (SELECT RESIDENT_ID FROM t_barangay_official) 
	AND CONCAT(FIRSTNAME,' ', LASTNAME) LIKE CONCAT('%',search_val, '%')
	AND FIRSTNAME LIKE CONCAT('%',search_val, '%') OR LASTNAME  LIKE CONCAT('%',search_val, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_search_detegatory` (IN `fname` MEDIUMTEXT)  SELECT * FROM `t_blotter`
WHERE RESPONDENT LIKE CONCAT('%',fname,'%')
COLLATE utf8mb4_general_ci
AND `STATUS` = 'Pending'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_search_resident_foradding_member` (IN `search_val` VARCHAR(255))  BEGIN
	SELECT T.RESIDENT_ID
	, CONCAT(FIRSTNAME,' ', LASTNAME) AS FULLNAME
	, CONCAT(MONTHNAME(DATE_OF_BIRTH),' ',DAY(DATE_OF_BIRTH),', ',YEAR(DATE_OF_BIRTH)) AS DATE_OF_BIRTH
	, PLACE_OF_BIRTH
	, CONCAT(ADDRESS_HOUSE_NO,' ',ADDRESS_STREET_NO, ' ',ADDRESS_STREET) AS FULL_ADDRESS
	, PROFILE_PICTURE
	FROM t_resident_basic_info AS T
	LEFT JOIN t_household_members AS HM
	ON T.RESIDENT_ID = HM.RESIDENT_ID
	WHERE T.RESIDENT_ID NOT IN (SELECT RESIDENT_ID FROM t_household_members)
	AND
	 LASTNAME LIKE CONCAT((SELECT LASTNAME FROM t_resident_basic_info AS T 
									LEFT JOIN t_household_members AS HM
									ON T.RESIDENT_ID = HM.RESIDENT_ID
									WHERE LASTNAME LIKE CONCAT(search_val,'%') GROUP BY LASTNAME),'%');
--  OR FIRSTNAME LIKE CONCAT('%',(SELECT FIRSTNAME FROM t_resident_basic_info AS T 
-- 									LEFT JOIN t_household_members AS HM
-- 									ON T.RESIDENT_ID = HM.RESIDENT_ID
-- 									WHERE FIRSTNAME LIKE CONCAT('%',search_val,'%') GROUP BY FIRSTNAME),'%')
--  OR CONCAT(FIRSTNAME,' ',LASTNAME) LIKE CONCAT('%',(SELECT CONCAT(FIRSTNAME,' ',LASTNAME) AS FULLNAME FROM t_resident_basic_info AS T 
-- 									LEFT JOIN t_household_members AS HM
-- 									ON T.RESIDENT_ID = HM.RESIDENT_ID
-- 									WHERE CONCAT(FIRSTNAME,' ',LASTNAME) LIKE CONCAT('%',search_val,'%') GROUP BY FULLNAME),'%')
--  OR CONCAT(LASTNAME,' ',FIRSTNAME) LIKE CONCAT('%',(SELECT CONCAT(LASTNAME,' ',FIRSTNAME) AS FULLNAME FROM t_resident_basic_info AS T 
-- 									LEFT JOIN t_household_members AS HM
-- 									ON T.RESIDENT_ID = HM.RESIDENT_ID
-- 									WHERE CONCAT(LASTNAME,' ',FIRSTNAME) LIKE CONCAT('%',search_val,'%') GROUP BY FULLNAME),'%');
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `r_barangay_information`
--

CREATE TABLE `r_barangay_information` (
  `BARANGAY_ID` int(11) NOT NULL,
  `BARANGAY_NAME` varchar(255) DEFAULT NULL,
  `BARANGAY_SEAL` varchar(150) DEFAULT NULL,
  `LAND_AREA` double(255,0) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT current_timestamp(),
  `ACTIVE_FLAG` int(11) DEFAULT 1,
  `USER_ID` int(11) DEFAULT NULL,
  `MUNICIPAL_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `r_barangay_information`
--

INSERT INTO `r_barangay_information` (`BARANGAY_ID`, `BARANGAY_NAME`, `BARANGAY_SEAL`, `LAND_AREA`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `USER_ID`, `MUNICIPAL_ID`) VALUES
(1, 'WAWA', 'wawalogo.jfif', 155, '2020-11-05 09:50:50', '2020-11-05 09:50:50', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_barangay_zone`
--

CREATE TABLE `r_barangay_zone` (
  `BARANGAY_ZONE_ID` int(11) NOT NULL,
  `BARANGAY_ZONE_NAME` varchar(250) DEFAULT NULL,
  `BARANGAY_ZONE_DESC` varchar(250) DEFAULT NULL,
  `BARANGAY_ID` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT current_timestamp(),
  `ACTIVE_FLAG` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `r_bf_line_of_business`
--

CREATE TABLE `r_bf_line_of_business` (
  `LINE_OF_BUSINESS_ID` int(11) NOT NULL,
  `LINE_OF_BUSINESS_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `r_bf_line_of_business`
--

INSERT INTO `r_bf_line_of_business` (`LINE_OF_BUSINESS_ID`, `LINE_OF_BUSINESS_NAME`) VALUES
(1, 'MFRRS - Manufacturers, assemblers, etc'),
(2, 'WHLRS - Wholesalers, distributors, etc'),
(3, 'EXPTR - Exporters, etc'),
(4, 'RETLR - Retailers'),
(5, 'CONTR - Contractors and Independent Contractors'),
(6, 'BNKFI - Banks and other Financial Institution'),
(7, 'PEDLR - Peddlers'),
(8, 'OTHBS - Other businesses');

-- --------------------------------------------------------

--
-- Table structure for table `r_blotter_subjects`
--

CREATE TABLE `r_blotter_subjects` (
  `BLOTTER_SUBJECT_ID` int(11) NOT NULL,
  `BLOTTER_NAME` varchar(50) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `r_blotter_subjects`
--

INSERT INTO `r_blotter_subjects` (`BLOTTER_SUBJECT_ID`, `BLOTTER_NAME`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(17, 'Missing person', '2019-10-04 01:25:07', NULL, 1),
(18, 'Missing person', '2019-10-04 01:25:38', NULL, 1),
(19, 'Sample', '2019-10-08 12:29:31', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_business_nature`
--

CREATE TABLE `r_business_nature` (
  `BUSINESS_NATURE_ID` int(11) NOT NULL,
  `BUSINESS_NATURE_NAME` varchar(500) DEFAULT NULL,
  `BUSINESS_NATURE_DESCRIPTION` varchar(250) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT current_timestamp(),
  `ACTIVE_FLAG` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `r_business_nature`
--

INSERT INTO `r_business_nature` (`BUSINESS_NATURE_ID`, `BUSINESS_NATURE_NAME`, `BUSINESS_NATURE_DESCRIPTION`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(1, '01450 - Hog farming', 'Pig/hog raising, breeding, etc', '2019-10-14 10:58:40', '2020-11-10 09:58:23', 1),
(2, '01471 - Raising of duck broiler', 'Raising of duck broiler', '2019-10-14 10:58:40', '2020-11-10 09:58:50', 1),
(3, '03211 - Operation of freshwater fishpond, except fish breeding and nurseries', 'Operation of freshwater fishpond, except fish breeding and nurseries', '2019-10-14 10:58:40', '2020-11-10 09:59:17', 1),
(4, '03212 - Operation of freshwater fish pens and fish cages', 'Operation of freshwater fish pens and fish cages', '2019-10-14 10:58:40', '2020-11-10 09:59:35', 1),
(5, '10795 - Egg processing including fertilized egg (balut) and salted eggs', 'Egg processing including fertilized egg (balut) and salted eggs', '2019-10-14 10:58:40', '2020-11-10 09:59:56', 1),
(6, '14210 - Custom tailoring', 'Custom tailoring', '2019-10-14 10:59:29', '2020-11-10 10:00:15', 1),
(7, '45201 - Repair of motor vehicles, including overhauling', 'Repair of motor vehicles, including overhauling', '2019-10-14 10:59:29', '2020-11-10 10:00:36', 1),
(8, '47113 - Retail selling in sari-sari stores', 'Retail selling in sari-sari stores', '2019-10-14 10:59:29', '2020-11-10 10:00:55', 1),
(9, '47214 - Retail sale of bakery products', 'Retail sale of bakery products', '2019-10-14 10:59:29', '2020-11-10 10:01:12', 1),
(10, '47913 - Retail sale via internet', 'Retail sale via internet', '2019-10-14 10:59:29', '2020-11-10 10:01:31', 1),
(11, '47994 - Retail sale of water (including distribution)', 'Retail sale of water (including distribution)', '2019-10-31 19:06:58', '2020-11-10 10:01:50', 1),
(12, '49322 - Tricycles and pedicabs operation', 'Tricycles and pedicabs operation', '2020-11-10 18:02:23', '2020-11-10 18:02:23', 1),
(13, '56103 - Cafeterias', 'Cafeterias, fixed', '2020-11-10 18:02:52', '2020-11-10 18:02:52', 1),
(14, '56104 - Refreshment stands, kiosks and counters', 'Refreshment stands, kiosks and counters', '2020-11-10 18:03:09', '2020-11-10 18:03:09', 1),
(15, '56109 - Other restaurants and mobile food service activities, not elsewhere classified', 'Other restaurants and mobile food service activities, not elsewhere classified', '2020-11-10 18:03:23', '2020-11-10 18:03:23', 1),
(16, '61300 - Satellite telecommunications activities', 'Satellite telecommunications activities', '2020-11-10 18:03:39', '2020-11-10 18:03:39', 1),
(17, '64929 - Other credit granting, not elsewhere classified', 'Other credit granting, not elsewhere classified', '2020-11-10 18:03:53', '2020-11-10 18:03:53', 1),
(18, '68110 - Real estate buying, selling, renting, leasing and operating of self-owned/leased apartment buildings, non-residential and dwellings', 'Real estate buying, selling, renting, leasing and operating of self-owned/leased apartment buildings, non-residential and dwellings', '2020-11-10 18:04:40', '2021-02-01 05:59:05', 1),
(19, '68200 - Real estate acitivies on a fee or contract basis', 'Real estate acitivies on a fee or contract basis', '2020-11-10 18:09:35', '2020-11-10 18:09:35', 1),
(20, '96300 - Funeral and related activities', 'Funeral and related activities', '2020-11-10 18:11:24', '2020-11-10 18:11:24', 1),
(21, '82191 - Photocopying services activities', 'Photocopying services activities', '2020-11-10 18:12:03', '2020-11-10 18:12:03', 1),
(22, '77306 - Renting of computers and computer peripherals equipment', 'Renting of computers and computer peripherals equipment', '2020-11-10 18:26:50', '2020-11-10 18:26:50', 1),
(23, '61902 - Internet access in facilities open to the public service activities', 'Internet access in facilities open to the public service activities', '2020-11-10 18:27:34', '2020-11-10 18:27:34', 1),
(24, '47731 - Retail sale of feeds, fertilizers and insecticides', 'Retail sale of feeds, fertilizers and insecticides', '2021-02-02 13:44:48', '2021-02-02 13:44:48', 1),
(25, '56210 - Event catering', 'Event catering', '2021-02-02 13:48:56', '2021-02-02 13:48:56', 1),
(26, '52299 - Activities of other transport agencies, n.e.c.', 'Activities of other transport agencies, n.e.c.', '2021-02-02 13:51:02', '2021-02-02 13:51:02', 1),
(27, '13140 - Preparation and finishing of textiles (integrated)', 'Preparation And Finishing Of Textiles (Integrated)', '2021-02-02 14:01:41', '2021-02-02 14:01:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_municipal_information`
--

CREATE TABLE `r_municipal_information` (
  `MUNICIPAL_ID` int(11) NOT NULL,
  `MUNICIPAL_NAME` varchar(50) NOT NULL,
  `PROVINCE_NAME` varchar(50) NOT NULL,
  `MUNICIPAL_SEAL` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `REGION` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `r_municipal_information`
--

INSERT INTO `r_municipal_information` (`MUNICIPAL_ID`, `MUNICIPAL_NAME`, `PROVINCE_NAME`, `MUNICIPAL_SEAL`, `CREATED_AT`, `UPDATED_AT`, `REGION`) VALUES
(1, 'TANAY', 'RIZAL', 'tanaylogo.bmp', '2020-11-05 09:50:50', '2021-01-07 10:23:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `r_ordinance_category`
--

CREATE TABLE `r_ordinance_category` (
  `ORDINANCE_CATEGORY_ID` int(11) NOT NULL,
  `ORDINANCE_CATEGORY_NAME` varchar(100) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `r_ordinance_category`
--

INSERT INTO `r_ordinance_category` (`ORDINANCE_CATEGORY_ID`, `ORDINANCE_CATEGORY_NAME`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(5, 'Social - Protection of Children', '2019-10-03 16:03:08', '2021-03-19 05:43:49', 1),
(6, 'Economic - Aquatics and Fisheries Management', NULL, '2021-03-19 05:44:01', NULL),
(7, 'Economic - Promotion of Culture and the Arts', '2019-10-08 12:29:48', '2021-03-19 05:44:17', 1),
(8, 'Institutional - Disaster Risk Reduction and Management', '2021-03-19 05:44:36', '2021-03-19 06:07:53', 1),
(9, 'Infrastructure & Land Use', '2021-03-19 05:45:03', NULL, 1),
(10, 'Environmental', '2021-03-19 05:45:17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_paper_type`
--

CREATE TABLE `r_paper_type` (
  `PAPER_TYPE_ID` int(11) NOT NULL,
  `PAPER_TYPE_NAME` varchar(100) NOT NULL,
  `PAPER_TYPE_CATEGORY` varchar(100) NOT NULL,
  `PAPER_TYPE_DECRIPTION` varchar(250) DEFAULT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ACTIVE_FLAG` tinyint(4) NOT NULL DEFAULT 1,
  `PAPER_TYPE_CODE` varchar(50) DEFAULT NULL,
  `SERIES` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_paper_type`
--

INSERT INTO `r_paper_type` (`PAPER_TYPE_ID`, `PAPER_TYPE_NAME`, `PAPER_TYPE_CATEGORY`, `PAPER_TYPE_DECRIPTION`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `PAPER_TYPE_CODE`, `SERIES`) VALUES
(1, 'Application Barangay Business Permit Form', 'Form', 'Business', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF01', NULL),
(2, 'Application Barangay Clearance Form', 'Form', 'Business', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF02', NULL),
(3, 'Request Barangay Certification Form', 'Form', 'Resident', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF03', NULL),
(4, 'Application Use Of Barangay Property Facilities', 'Form', '', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF04', NULL),
(5, 'Request Freedom Of Information', 'Form', '', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF05', NULL),
(6, 'Transient Registration Form', 'Form', '', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF06', NULL),
(8, 'Socio Demographic Profile', 'Form', '', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF08', NULL),
(9, 'VAWC Intake Form', 'Form', '', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF09', NULL),
(10, 'Request Assistance', 'Form', '', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF9', NULL),
(11, 'Referral Form', 'Form', '', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF10', NULL),
(12, 'Application Barangay Protection Order', 'Form', '', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF11', NULL),
(13, 'Feedback Form', 'Form', '', '2019-10-13 19:10:01', '0000-00-00 00:00:00', 1, 'BF100', NULL),
(14, 'Barangay Business Permit', 'Clearance', 'Business', '2019-10-13 19:21:28', NULL, 1, 'FM-BBP-001', NULL),
(15, 'Barangay Clearance Building', 'Clearance', 'Business', '2019-10-13 19:21:28', NULL, 1, 'FM-BC-001A', NULL),
(16, 'Barangay Clearance Business', 'Clearance', 'Business', '2019-10-13 19:21:28', NULL, 1, 'FM-BC-001B', NULL),
(17, 'Barangay Clearance Zonal', 'Clearance', 'Business', '2019-10-13 19:21:28', NULL, 1, 'FM-BC-001C', NULL),
(18, 'Barangay Clearance Tricycle', 'Clearance', 'Business', '2019-10-13 19:21:28', NULL, 1, 'FM-BC-001D', NULL),
(19, 'Barangay Clearance General Purposes', 'Clearance', 'Business', '2019-10-13 19:21:28', NULL, 1, 'FM-BC-001E', NULL),
(20, 'Barangay Clearance Inhabitant', 'Clearance', NULL, '2019-10-13 19:21:28', NULL, 1, 'FM-BC-001F', NULL),
(21, 'Barangay Clearance Negative', 'Clearance', NULL, '2019-10-13 19:21:28', NULL, 1, 'FM-BC-001X', NULL),
(22, 'Barangay Certificate Residency', 'Certification', 'Resident', '2019-10-13 19:21:28', NULL, 1, 'FM-BCert-001A', NULL),
(23, 'Barangay Certificate Calamity Loan SSS-GSIS', 'Certification', 'Resident', '2019-10-13 19:24:21', NULL, 1, 'FM-BCert-001B', NULL),
(24, 'Barangay Certificate Calamity Loan OFW', 'Certification', 'Resident', '2019-10-13 19:24:21', NULL, 1, 'FM-BCert-001C', NULL),
(25, 'Barangay Certificate SPES', 'Certification', 'Resident', '2019-10-13 19:24:21', NULL, 1, 'FM-BCert-001D', NULL),
(26, 'Barangay Certificate Solo Parent', 'Certification', 'Resident', '2019-10-13 19:24:21', NULL, 1, 'FM-BCert-001E', NULL),
(27, 'Barangay Certificate Indigency', 'Certification', 'Resident', '2019-10-13 19:24:21', NULL, 1, 'FM-BCert-001F', NULL),
(28, 'Permit Use Of Barangay Property Facility', 'Unknown', NULL, '2019-10-13 19:26:37', NULL, 1, 'FM-BPermit', NULL),
(29, 'Barangay Clearance Weights and Measure', 'Clearance', 'Business', '2020-08-02 20:11:57', '2020-08-02 20:11:57', 1, 'FM-BC-001G', NULL),
(30, 'Barangay Clearance Fishery Rental and Privellege', 'Clearance', 'Business', '2020-08-02 20:12:35', '2020-08-02 20:12:35', 1, 'FM-BC-001H', NULL),
(31, 'Barangay Certificate Travel', 'Certification', 'Resident', '2020-08-17 11:04:24', '2020-09-01 20:37:30', 1, 'FM-QTP-001', NULL),
(32, 'Barangay Clearance For Individual', 'Certification', 'Resident', '2021-02-03 15:53:20', '2021-02-03 15:53:20', 1, NULL, NULL),
(33, 'Patient Record Form', 'Form', '', '2019-10-13 19:10:01', '2021-02-11 15:59:04', 1, 'BF07', NULL),
(35, 'Barangay Clearance Building (Non-Business)', 'Clearance', 'Resident', '2021-02-24 00:00:00', '2021-02-24 15:54:16', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `r_position`
--

CREATE TABLE `r_position` (
  `POSITION_ID` int(11) NOT NULL,
  `POSITION_NAME` varchar(50) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `r_position`
--

INSERT INTO `r_position` (`POSITION_ID`, `POSITION_NAME`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(6, 'Admin', '2019-07-30 12:15:06', NULL, 1),
(35, 'Secretary', '2019-10-03 23:45:06', NULL, 1),
(36, 'Census Officer', '2019-10-03 23:45:06', NULL, 1),
(37, 'Barangay Chairman', '2019-10-03 23:45:07', NULL, 1),
(38, 'Chief Tanod', '2019-10-16 10:21:37', NULL, 1),
(39, 'Lupon', '2019-10-16 10:56:52', NULL, 1),
(40, 'Admin', NULL, NULL, 1),
(41, 'Doctor', NULL, NULL, 1),
(42, 'Health Care Staff', '2020-06-04 17:38:27', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_resident_type`
--

CREATE TABLE `r_resident_type` (
  `TYPE_ID` int(11) NOT NULL,
  `TYPE_NAME` varchar(50) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `r_resident_type`
--

INSERT INTO `r_resident_type` (`TYPE_ID`, `TYPE_NAME`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(1, 'Native Residents', '2019-08-05 04:48:04', NULL, 1),
(2, 'Migrants', '2019-08-05 04:49:10', NULL, 1),
(3, 'Transients', '2019-08-05 04:49:27', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_application_form`
--

CREATE TABLE `t_application_form` (
  `FORM_ID` int(11) NOT NULL,
  `FORM_DATE` datetime DEFAULT current_timestamp(),
  `FORM_TIME` time DEFAULT NULL,
  `TIME_RECEIVED` time DEFAULT NULL,
  `RECEIVED_BY` varchar(250) DEFAULT NULL,
  `FORM_NUMBER` varchar(50) DEFAULT NULL,
  `PAPER_TYPE_ID` int(11) DEFAULT NULL,
  `REQUESTED_PAPER_TYPE_ID` int(11) NOT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `BUSINESS_ID` int(11) DEFAULT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `BUILDING_ID` int(11) DEFAULT NULL,
  `APPLICANT_NAME` varchar(250) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT 1,
  `TRANSACTION_ID` int(11) DEFAULT NULL,
  `WEIGHTS_AND_MEASURE_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_application_form`
--

INSERT INTO `t_application_form` (`FORM_ID`, `FORM_DATE`, `FORM_TIME`, `TIME_RECEIVED`, `RECEIVED_BY`, `FORM_NUMBER`, `PAPER_TYPE_ID`, `REQUESTED_PAPER_TYPE_ID`, `STATUS`, `BUSINESS_ID`, `RESIDENT_ID`, `BUILDING_ID`, `APPLICANT_NAME`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `TRANSACTION_ID`, `WEIGHTS_AND_MEASURE_ID`) VALUES
(1, '2021-04-13 22:55:34', NULL, NULL, 'URSUS RAMON ROMERO', 'XXXX-XXX', 35, 35, 'Approved', NULL, NULL, 44, 'RALPH LAWRENCE TARLAC', '2021-04-13 22:55:34', '2021-04-14 00:00:00', 1, 48, NULL),
(2, '2021-04-14 02:11:39', NULL, NULL, 'URSUS RAMON ROMERO', 'XXXX-XXX', 35, 35, 'Approved', NULL, NULL, 44, 'RALPH LAWRENCE TARLAC', '2021-04-14 02:11:39', '2021-04-14 00:00:00', 1, 50, NULL),
(3, '2021-04-29 02:23:50', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Approved', 31, NULL, NULL, 'MELINDA RAMOS GUERRERO', '2021-04-29 02:23:50', '2021-04-29 00:00:00', 1, NULL, NULL),
(4, '2021-06-04 21:41:48', NULL, NULL, 'URSUS RAMON ROMERO', 'XXXX-XXX', 15, 15, 'Approved', 38, NULL, NULL, 'Test', '2021-06-04 21:41:48', '2021-06-04 00:00:00', 1, NULL, NULL),
(5, '2021-06-04 21:41:58', NULL, NULL, 'URSUS RAMON ROMERO', 'XXXX-XXX', 15, 15, 'Declined', 38, NULL, NULL, 'Test', '2021-06-04 21:41:58', '2021-06-04 00:00:00', 1, NULL, NULL),
(6, '2021-06-08 12:28:14', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Pending', 39, NULL, NULL, 'John Raven Tamang Glomar', '2021-06-08 12:28:14', NULL, 1, NULL, NULL),
(7, '2021-06-08 12:45:43', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Approved', 32, NULL, NULL, 'ROSARIO M DELA CRUZ', '2021-06-08 12:45:43', '2021-06-08 00:00:00', 1, NULL, NULL),
(8, '2021-06-08 12:49:39', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Pending', 32, NULL, NULL, 'ROSARIO M DELA CRUZ', '2021-06-08 12:49:39', NULL, 1, NULL, NULL),
(9, '2021-06-10 19:37:29', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Pending', 23, NULL, NULL, 'CARL CHRISTIAN OCAMPO CRUZ', '2021-06-10 19:37:29', NULL, 1, NULL, NULL),
(10, '2021-06-11 13:44:20', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Pending', 39, NULL, NULL, 'John Raven Tamang Glomar', '2021-06-11 13:44:20', NULL, 1, NULL, NULL),
(11, '2021-06-15 18:28:59', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Approved', NULL, NULL, NULL, 'CAROLINE BERNABEO CASAS', '2021-06-15 18:28:59', '2021-06-15 00:00:00', 1, NULL, 5),
(12, '2021-06-17 15:55:07', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Approved', NULL, NULL, NULL, 'RALPH null TARLAC', '2021-06-17 15:55:07', '2021-06-17 00:00:00', 1, NULL, 7),
(13, '2021-06-17 15:55:12', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Approved', NULL, NULL, NULL, 'RALPH null TARLAC', '2021-06-17 15:55:12', '2021-06-17 00:00:00', 1, NULL, 6),
(14, '2021-06-18 15:29:46', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Approved', NULL, NULL, NULL, 'John Raven Tamang Glomar', '2021-06-18 15:29:46', '2021-06-18 00:00:00', 1, NULL, 8),
(15, '2021-06-18 15:56:01', NULL, NULL, 'URSUS RAMON ROMERO', 'SSSS-SSSS', 29, 29, 'Pending', NULL, NULL, NULL, 'John Raven Tamang Glomar', '2021-06-18 15:56:01', NULL, 1, NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `t_application_form_evaluation`
--

CREATE TABLE `t_application_form_evaluation` (
  `AF_EVALUATION_ID` int(11) NOT NULL,
  `FORM_ID` int(11) DEFAULT NULL,
  `EVALUATED_BY` varchar(250) DEFAULT NULL,
  `DATE_EVALUATED` datetime DEFAULT current_timestamp(),
  `EVALUATION_STATUS` varchar(50) DEFAULT NULL,
  `REMARKS` varchar(500) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_application_form_evaluation`
--

INSERT INTO `t_application_form_evaluation` (`AF_EVALUATION_ID`, `FORM_ID`, `EVALUATED_BY`, `DATE_EVALUATED`, `EVALUATION_STATUS`, `REMARKS`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(119, 1, 'URSUS RAMON ROMERO', '2021-04-14 00:00:00', 'Approved', NULL, '2021-04-13 22:56:03', NULL, 1),
(120, 2, 'URSUS RAMON ROMERO', '2021-04-14 00:00:00', 'Approved', NULL, '2021-04-14 02:12:40', NULL, 1),
(121, 3, 'URSUS RAMON ROMERO', '2021-04-29 00:00:00', 'Approved', 'OKAY', '2021-04-29 02:24:12', NULL, 1),
(122, 4, 'URSUS RAMON ROMERO', '2021-06-04 00:00:00', 'Approved', NULL, '2021-06-04 21:42:13', NULL, 1),
(123, 5, 'URSUS RAMON ROMERO', '2021-06-04 00:00:00', 'Declined', NULL, '2021-06-04 21:42:20', NULL, 1),
(124, 7, 'URSUS RAMON ROMERO', '2021-06-08 00:00:00', 'Approved', 'Remarks', '2021-06-08 12:51:41', NULL, 1),
(125, NULL, 'URSUS RAMON ROMERO', '2021-06-15 00:00:00', 'Pending', NULL, '2021-06-15 18:12:59', NULL, 1),
(126, 11, 'URSUS RAMON ROMERO', '2021-06-15 00:00:00', 'Approved', 'Remarks', '2021-06-15 18:49:48', NULL, 1),
(127, 12, 'URSUS RAMON ROMERO', '2021-06-17 00:00:00', 'Approved', NULL, '2021-06-17 15:55:37', NULL, 1),
(128, 13, 'URSUS RAMON ROMERO', '2021-06-17 00:00:00', 'Approved', NULL, '2021-06-17 15:55:52', NULL, 1),
(129, 14, 'URSUS RAMON ROMERO', '2021-06-18 00:00:00', 'Approved', NULL, '2021-06-18 15:30:15', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_barangay_official`
--

CREATE TABLE `t_barangay_official` (
  `BARANGAY_OFFICIAL_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `BARANGAY_ID` int(11) DEFAULT NULL,
  `POSITION_ID` int(11) DEFAULT NULL,
  `START_TERM` date DEFAULT NULL,
  `END_TERM` date DEFAULT NULL,
  `EMPLOYEE_NUMBER` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_barangay_official`
--

INSERT INTO `t_barangay_official` (`BARANGAY_OFFICIAL_ID`, `RESIDENT_ID`, `BARANGAY_ID`, `POSITION_ID`, `START_TERM`, `END_TERM`, `EMPLOYEE_NUMBER`, `EMAIL`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(1, 1, 1, NULL, '2020-08-13', '2023-08-13', '045812020-000010', NULL, '2020-11-05 15:34:40', NULL, 1),
(2, 2, 1, 36, '2020-08-03', '2023-08-03', '045812020-000022', 'mhylenreyta@gmail.com', '2020-11-05 17:52:25', NULL, 1),
(3, 3, 1, 37, '2020-08-10', '2023-08-10', '045812020-000001', 'virayarturo14@gmail.com', '2020-11-10 16:19:32', NULL, 1),
(4, 6, 1, 36, '2020-08-13', '2023-08-13', '045812020-00024', 'cristina.jesuitas@gmail.com', '2021-02-09 13:57:21', NULL, 1),
(5, 6, 1, 36, '2020-08-13', '2023-08-13', '045812020-00024', 'cristina.jesuitas@gmail.com', '2021-02-09 14:09:01', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_bf_barangay_certification`
--

CREATE TABLE `t_bf_barangay_certification` (
  `BARANGAY_CERTIFICATION_ID` int(11) NOT NULL,
  `REQUESTOR_NAME` varchar(250) DEFAULT NULL,
  `SSS_NO` varchar(50) DEFAULT NULL,
  `CALAMITY_NAME` varchar(100) DEFAULT NULL,
  `CALAMITY_DATE` date DEFAULT NULL,
  `COUNTRY` varchar(100) DEFAULT NULL,
  `CATEGORY_SINGLE_PARENT` varchar(100) DEFAULT NULL,
  `PURPOSE` varchar(500) DEFAULT NULL,
  `PLACE_DESTINATION` varchar(100) DEFAULT NULL,
  `DESTINATION_ADDRESS` varchar(100) DEFAULT NULL,
  `TRAVEL_DATE` date DEFAULT NULL,
  `RETURN_DATE` date DEFAULT NULL,
  `FORM_ID` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATE_AT` datetime DEFAULT current_timestamp(),
  `ACTIVE_FLAG` tinyint(4) DEFAULT 1,
  `MAIDEN_NAME` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `t_bf_barangay_certification`
--

INSERT INTO `t_bf_barangay_certification` (`BARANGAY_CERTIFICATION_ID`, `REQUESTOR_NAME`, `SSS_NO`, `CALAMITY_NAME`, `CALAMITY_DATE`, `COUNTRY`, `CATEGORY_SINGLE_PARENT`, `PURPOSE`, `PLACE_DESTINATION`, `DESTINATION_ADDRESS`, `TRAVEL_DATE`, `RETURN_DATE`, `FORM_ID`, `CREATED_AT`, `UPDATE_AT`, `ACTIVE_FLAG`, `MAIDEN_NAME`) VALUES
(11, NULL, NULL, NULL, NULL, NULL, NULL, 'Local employment', NULL, NULL, NULL, NULL, 12, '2021-02-03 15:56:05', '2021-02-03 15:56:05', 1, NULL),
(12, NULL, NULL, NULL, NULL, NULL, NULL, 'Local Employment', NULL, NULL, NULL, NULL, 13, '2021-02-08 16:22:02', '2021-02-08 16:22:02', 1, NULL),
(13, NULL, NULL, NULL, NULL, NULL, NULL, 'tRAVEL ABROAD', NULL, NULL, NULL, NULL, 14, '2021-02-10 13:50:38', '2021-02-10 13:50:38', 1, NULL),
(14, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAVEL ABROAD', NULL, NULL, NULL, NULL, 15, '2021-02-10 13:54:11', '2021-02-10 13:54:11', 1, NULL),
(15, NULL, NULL, NULL, NULL, NULL, NULL, 'LOCAL EMPLOYMENT', NULL, NULL, NULL, NULL, 16, '2021-02-10 15:27:34', '2021-02-10 15:27:34', 1, 'CATUIRA'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, 'Funeral of immediate family', 'MORONG BATAAN', 'JOSE P RIZAL', '2021-02-15', '2021-02-19', 19, '2021-02-11 11:11:34', '2021-02-11 11:11:34', 1, NULL),
(17, NULL, NULL, NULL, NULL, NULL, NULL, 'PCSO mEDICAL ASSISTANCE', NULL, NULL, NULL, NULL, 20, '2021-02-11 11:13:05', '2021-02-11 11:13:05', 1, NULL),
(18, NULL, NULL, NULL, NULL, NULL, NULL, 'pCSO MEDICAL ASSISTANCE', NULL, NULL, NULL, NULL, 21, '2021-02-11 11:29:49', '2021-02-11 11:29:49', 1, NULL),
(19, NULL, NULL, NULL, NULL, NULL, NULL, 'PCSO MEDICAL ASSISTANCE REQUEST', NULL, NULL, NULL, NULL, 22, '2021-02-11 13:04:18', '2021-02-11 13:04:18', 1, NULL),
(20, NULL, NULL, NULL, NULL, NULL, NULL, 'PCSO Medical Assistance Request', NULL, NULL, NULL, NULL, 23, '2021-02-11 13:48:26', '2021-02-11 13:48:26', 1, NULL),
(22, NULL, NULL, NULL, NULL, NULL, NULL, 'pAGCOR Hospitalization Assistance Request', NULL, NULL, NULL, NULL, 24, '2021-02-11 14:46:38', '2021-02-11 14:46:38', 1, NULL),
(23, NULL, NULL, NULL, NULL, NULL, NULL, 'PHILHEALTH INDIGENT MEMBERSHIP', NULL, NULL, NULL, NULL, 25, '2021-02-11 15:04:38', '2021-02-11 15:04:38', 1, NULL),
(25, NULL, '33-0441286-6', 'Typhoon Rolly', '2021-02-11', 'United Arab Emirates - Dubai', NULL, NULL, NULL, NULL, NULL, NULL, 27, '2021-02-11 15:33:10', '2021-02-11 15:33:10', 1, NULL),
(26, NULL, '33-14344-5', 'TYPHOON ROLLY', '2020-11-03', 'UAE-DUBAI', NULL, NULL, NULL, NULL, NULL, NULL, 28, '2021-02-11 16:57:56', '2021-02-11 16:57:56', 1, NULL),
(27, NULL, '33-14344-55', 'TYPHOON ROLLY', '2020-11-03', 'UAE-DUBAI', NULL, NULL, NULL, NULL, NULL, NULL, 29, '2021-02-11 16:59:15', '2021-02-11 16:59:15', 1, NULL),
(28, NULL, '33-123456-78', 'TYPHOON ROLLY', '2020-11-03', 'USA', NULL, NULL, NULL, NULL, NULL, NULL, 30, '2021-02-15 10:24:47', '2021-02-15 10:24:47', 1, NULL),
(29, NULL, 'test', 'typhoon rolly', '2021-02-15', 'AEDUBAI', NULL, NULL, NULL, NULL, NULL, NULL, 31, '2021-02-15 10:51:44', '2021-02-15 10:51:44', 1, NULL),
(30, NULL, '123-11', 'BAGYONG ROLLY', '2021-02-01', 'AEDUBAI', NULL, NULL, NULL, NULL, NULL, NULL, 32, '2021-02-15 11:07:39', '2021-02-15 11:07:39', 1, NULL),
(31, NULL, '12-123', 'ROLLY', '2021-02-02', 'AEDUBAI', NULL, NULL, NULL, NULL, NULL, NULL, 33, '2021-02-15 11:15:23', '2021-02-15 11:15:23', 1, NULL),
(32, NULL, 'TESTES', 'TSE', '2021-02-01', 'ESTSE', NULL, NULL, NULL, NULL, NULL, NULL, 34, '2021-02-15 11:21:00', '2021-02-15 11:21:00', 1, NULL),
(33, NULL, '234-12', 'RAET', '2021-02-02', 'SAET', NULL, NULL, NULL, NULL, NULL, NULL, 35, '2021-02-15 11:28:55', '2021-02-15 11:28:55', 1, NULL),
(34, NULL, 'TSET', 'TSE', '2021-02-01', 'TEST', NULL, NULL, NULL, NULL, NULL, NULL, 36, '2021-02-15 11:30:43', '2021-02-15 11:30:43', 1, NULL),
(35, NULL, 'SAET', 'SAET', '2021-02-02', 'SAET', NULL, NULL, NULL, NULL, NULL, NULL, 37, '2021-02-15 11:33:13', '2021-02-15 11:33:13', 1, NULL),
(36, NULL, '12-23112', 'BAGYONG ROLLY', '2021-02-01', 'AEDUABAI', NULL, NULL, NULL, NULL, NULL, NULL, 38, '2021-02-15 11:47:00', '2021-02-15 11:47:00', 1, NULL),
(37, NULL, '33-12346-78', 'TYPHOON ONDOY', '2009-09-26', 'USA', NULL, NULL, NULL, NULL, NULL, NULL, 39, '2021-02-15 13:09:33', '2021-02-15 13:09:33', 1, NULL),
(38, NULL, '33-12346-78', 'TYPHOON ROLLY', '2020-11-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40, '2021-02-15 13:14:18', '2021-02-15 13:14:18', 1, NULL),
(39, NULL, NULL, NULL, NULL, NULL, NULL, 'MERALCO ELECTRIC SERVICE APPLICATION', NULL, NULL, NULL, NULL, 41, '2021-02-15 14:02:26', '2021-02-15 14:02:26', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_bf_barangay_clearance`
--

CREATE TABLE `t_bf_barangay_clearance` (
  `BARANGAY_CLEARANCE_ID` int(11) NOT NULL,
  `REGISTERED_NAME` varchar(150) DEFAULT NULL,
  `APPLICANT_NAME` varchar(250) DEFAULT NULL,
  `KIND_OF_BUSINESS` varchar(50) DEFAULT NULL,
  `CONSTRUCTION_ADDRESS` varchar(100) DEFAULT NULL,
  `PROJECT_LOCATION` varchar(250) DEFAULT NULL,
  `SCOPE_OF_WORK_ID` int(11) DEFAULT NULL,
  `OCCUPANCY_TYPE` varchar(50) DEFAULT NULL,
  `KIND_OF_SIGNAGE` varchar(50) DEFAULT NULL,
  `SIGNAGE_WORDINGS` varchar(50) DEFAULT NULL,
  `NO_STOREYS_BUILDING` varchar(50) DEFAULT NULL,
  `START_DATE_INSTALLATION` date DEFAULT NULL,
  `END_COMPLETION` date DEFAULT NULL,
  `OCT_TCT_NUMBER` varchar(50) DEFAULT NULL,
  `TAX_DECLARATION` varchar(50) DEFAULT NULL,
  `BUSINESS_AREA` varchar(50) DEFAULT NULL,
  `AREA_CLASSIFICATION` varchar(250) DEFAULT NULL,
  `PURPOSE` varchar(250) DEFAULT NULL,
  `D_DRIVER_LICENSE_NO` varchar(50) DEFAULT NULL,
  `D_MUDGUARD_NO` varchar(50) DEFAULT NULL,
  `D_CR_NO` varchar(50) DEFAULT NULL,
  `D_OR_NO` varchar(50) DEFAULT NULL,
  `D_OR_DATE` date DEFAULT NULL,
  `FORM_ID` int(11) NOT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` tinyint(4) NOT NULL DEFAULT 1,
  `F_LICENSE_NO` varchar(50) DEFAULT NULL,
  `F_DEVICE_TYPE` varchar(50) DEFAULT NULL,
  `F_CAPACITY` varchar(50) DEFAULT NULL,
  `F_SERIAL_NO` varchar(50) DEFAULT NULL,
  `F_BRAND` varchar(50) DEFAULT NULL,
  `F_MODEL` varchar(50) DEFAULT NULL,
  `F_REGISTRATION_NUMBER` varchar(50) DEFAULT NULL,
  `MAKE` varchar(50) DEFAULT NULL,
  `PLATE_NO` varchar(50) DEFAULT NULL,
  `PROJECT_TYPE` varchar(100) DEFAULT NULL,
  `PROJECT_TYPE_OF_OCCUPANCY` varchar(100) DEFAULT NULL,
  `PROJECT_AREA` varchar(100) DEFAULT NULL,
  `PROJECT_TENURE` varchar(100) DEFAULT NULL,
  `PROJECT_LAND_USE` varchar(100) DEFAULT NULL,
  `PROJECT_COST` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `t_bf_barangay_clearance`
--

INSERT INTO `t_bf_barangay_clearance` (`BARANGAY_CLEARANCE_ID`, `REGISTERED_NAME`, `APPLICANT_NAME`, `KIND_OF_BUSINESS`, `CONSTRUCTION_ADDRESS`, `PROJECT_LOCATION`, `SCOPE_OF_WORK_ID`, `OCCUPANCY_TYPE`, `KIND_OF_SIGNAGE`, `SIGNAGE_WORDINGS`, `NO_STOREYS_BUILDING`, `START_DATE_INSTALLATION`, `END_COMPLETION`, `OCT_TCT_NUMBER`, `TAX_DECLARATION`, `BUSINESS_AREA`, `AREA_CLASSIFICATION`, `PURPOSE`, `D_DRIVER_LICENSE_NO`, `D_MUDGUARD_NO`, `D_CR_NO`, `D_OR_NO`, `D_OR_DATE`, `FORM_ID`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `F_LICENSE_NO`, `F_DEVICE_TYPE`, `F_CAPACITY`, `F_SERIAL_NO`, `F_BRAND`, `F_MODEL`, `F_REGISTRATION_NUMBER`, `MAKE`, `PLATE_NO`, `PROJECT_TYPE`, `PROJECT_TYPE_OF_OCCUPANCY`, `PROJECT_AREA`, `PROJECT_TENURE`, `PROJECT_LAND_USE`, `PROJECT_COST`) VALUES
(85, NULL, 'RALPH LAWRENCE TARLAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'for new construction', NULL, NULL, NULL, NULL, NULL, 1, '2021-04-13 22:55:34', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'contractual', NULL),
(86, NULL, 'RALPH LAWRENCE TARLAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MERALCO BUILDING', NULL, NULL, NULL, NULL, NULL, 2, '2021-04-14 02:11:40', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'TANAY RURAL BANK', NULL, NULL, '20 CECILIO STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2021-04-29 02:23:50', NULL, 1, 'LIC NO 001', 'DEV 001', 'CAP 001', 'SER 001', 'BRAND 001', 'MMODEL 001', 'REG NO 001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, NULL, 'Test', NULL, 'Test', 'Test', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, '2021-06-04 21:41:59', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'Sari Sari Store', NULL, NULL, 'Purok 8 Unit 5 Adarna Extension Barangay Commonwealth', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, '2021-06-08 12:28:14', NULL, 1, '123', '123', '123', '123', '123', '123', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2021-06-08 12:45:43', NULL, 1, 'ASD-123', 'Test Device', '50 kg', 'Test Serial No', 'Test Brand', 'Test Model', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, '2021-06-08 12:49:39', NULL, 1, 'ASD-123', 'Test Device', '50 kg', 'Test Serial No', 'Test Brand', 'Test Model', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-06-10 19:37:29', NULL, 1, 'FHG123', 'TestNew', 'TestCapacity', 'TestSerialNo', 'TestBrand', 'TestModal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2021-06-11 13:44:20', NULL, 1, '213', '123', '50 Kg', '123', '123', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, '2021-06-15 18:28:59', NULL, 1, '213', '123', '50 kg', '123', '123', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '2021-06-17 15:55:07', NULL, 1, 'ASD-456', 'Test Device Type 2', '150kg', '789-012', 'Test Brand 2', 'Test Model 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, '2021-06-17 15:55:12', NULL, 1, 'ASD-123', 'Test Device Type', '100kg', '123-456', 'Test Brand', 'Test Model', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '2021-06-18 15:29:46', NULL, 1, 'ASD-123', 'Test Device', '150', 'ZXC-123', 'Test Brand', 'Test Model', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, '2021-06-18 15:56:01', NULL, 1, 'ASD-123', 'Test Device', '100', 'ZXC-123', 'Test Brand', 'Test Model', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_bf_business_activity`
--

CREATE TABLE `t_bf_business_activity` (
  `BUSINESS_ACTIVITY_ID` int(11) NOT NULL,
  `LINE_OF_BUSINESS_ID` int(11) NOT NULL,
  `NO_OF_UNITS` varchar(50) DEFAULT NULL,
  `CAPITALIZATION` varchar(50) DEFAULT NULL,
  `GROSS_RECEIPTS_ESSENTIAL` varchar(50) DEFAULT NULL,
  `GROSS_RECEIPTS_NON_ESSENTIAL` varchar(50) DEFAULT NULL,
  `BUSINESS_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_bf_business_activity`
--

INSERT INTO `t_bf_business_activity` (`BUSINESS_ACTIVITY_ID`, `LINE_OF_BUSINESS_ID`, `NO_OF_UNITS`, `CAPITALIZATION`, `GROSS_RECEIPTS_ESSENTIAL`, `GROSS_RECEIPTS_NON_ESSENTIAL`, `BUSINESS_ID`) VALUES
(9, 10, NULL, NULL, NULL, '5000', 14),
(10, 8, NULL, NULL, NULL, '30000', 14),
(11, 9, NULL, NULL, NULL, '5000', 15),
(12, 15, NULL, NULL, NULL, '500000', 16),
(13, 17, NULL, NULL, NULL, '1200800', 17),
(14, 12, NULL, NULL, NULL, '80000', 18),
(15, 12, NULL, NULL, NULL, NULL, 19),
(16, 8, NULL, NULL, NULL, '31000', 20),
(17, 24, NULL, NULL, NULL, '50000', 21),
(18, 27, NULL, NULL, NULL, '20000', 22),
(19, 25, NULL, NULL, NULL, '125000', 23),
(20, 4, NULL, NULL, '5000000', NULL, 24),
(21, 8, NULL, NULL, NULL, '5000', 25),
(22, 1, NULL, NULL, NULL, NULL, 30),
(23, 19, NULL, NULL, '5000000', NULL, 31),
(27, 2, '12', 'CAPITAL', '3000', '2000', 32),
(28, 18, '12', 'CAPITAL', '15000', '15000', 33),
(29, 6, '4', '4', '5000', '5000', 38),
(31, 1, '5', 'Test', '8000', '5000', 39);

-- --------------------------------------------------------

--
-- Table structure for table `t_bf_business_permit`
--

CREATE TABLE `t_bf_business_permit` (
  `BUSINESS_PERMIT_ID` int(11) NOT NULL,
  `AMENDMENT_FROM` varchar(50) DEFAULT NULL,
  `AMENDMENT_TO` varchar(50) DEFAULT NULL,
  `IS_ENJOYING_TAZ_INCENTIVE` tinyint(4) DEFAULT NULL,
  `SPECIFY_REASON` varchar(50) DEFAULT NULL,
  `TAX_YEAR` varchar(50) DEFAULT NULL,
  `QUARTER` varchar(50) DEFAULT NULL,
  `BARANGAY_PERMIT` varchar(50) DEFAULT NULL,
  `BUSINESS_TAX` varchar(50) DEFAULT NULL,
  `GARBAGE_FEE` varchar(50) DEFAULT NULL,
  `SIGNBOARD` varchar(50) DEFAULT NULL,
  `CTC` varchar(50) DEFAULT NULL,
  `FORM_ID` int(11) NOT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` tinyint(4) DEFAULT 1,
  `PLATE_NO` varchar(50) DEFAULT NULL,
  `PLATE_FEE` varchar(50) DEFAULT NULL,
  `STICKER` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `t_bf_business_permit`
--

INSERT INTO `t_bf_business_permit` (`BUSINESS_PERMIT_ID`, `AMENDMENT_FROM`, `AMENDMENT_TO`, `IS_ENJOYING_TAZ_INCENTIVE`, `SPECIFY_REASON`, `TAX_YEAR`, `QUARTER`, `BARANGAY_PERMIT`, `BUSINESS_TAX`, `GARBAGE_FEE`, `SIGNBOARD`, `CTC`, `FORM_ID`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `PLATE_NO`, `PLATE_FEE`, `STICKER`) VALUES
(10, NULL, NULL, NULL, NULL, '2021', '4th', NULL, '50.00', '360.00', '50.00', NULL, 1, '2021-01-28 16:42:39', NULL, 1, '654321', '50.00', NULL),
(11, NULL, NULL, NULL, NULL, '2021', '4th', NULL, '50', '360', NULL, NULL, 11, '2021-02-03 13:06:18', NULL, 1, '654326', '50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_bf_scope_of_work`
--

CREATE TABLE `t_bf_scope_of_work` (
  `SCOPE_OF_WORK_ID` int(11) NOT NULL,
  `SCOPE_OF_WORK_NAME` varchar(50) NOT NULL,
  `SCOPE_OF_WORK_SPECIFY` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_bf_scope_of_work`
--

INSERT INTO `t_bf_scope_of_work` (`SCOPE_OF_WORK_ID`, `SCOPE_OF_WORK_NAME`, `SCOPE_OF_WORK_SPECIFY`) VALUES
(10, 'Construction', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `t_blotter`
--

CREATE TABLE `t_blotter` (
  `BLOTTER_ID` int(10) UNSIGNED NOT NULL,
  `BLOTTER_SUBJECT_ID` int(11) DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `BARANGAY_ID` int(11) DEFAULT NULL,
  `BLOTTER_CODE` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `INCIDENT_DATE` date NOT NULL,
  `INCIDENT_AREA` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `COMPLAINT_NAME` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ACCUSED_RESIDENT` int(11) DEFAULT NULL,
  `COMPLAINT_STATEMENT` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RESOLUTION` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `COMPLAINT_DATE` date NOT NULL,
  `CLOSED_DATE` date DEFAULT NULL,
  `STATUS` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `RESPONDENT` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BLOTTER_SUBJECT` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NO_OF_PATAWAG` int(11) NOT NULL DEFAULT 0,
  `ACTIVE_FLAG` int(11) NOT NULL DEFAULT 1,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_blotter`
--

INSERT INTO `t_blotter` (`BLOTTER_ID`, `BLOTTER_SUBJECT_ID`, `USER_ID`, `BARANGAY_ID`, `BLOTTER_CODE`, `INCIDENT_DATE`, `INCIDENT_AREA`, `COMPLAINT_NAME`, `ACCUSED_RESIDENT`, `COMPLAINT_STATEMENT`, `RESOLUTION`, `COMPLAINT_DATE`, `CLOSED_DATE`, `STATUS`, `RESPONDENT`, `BLOTTER_SUBJECT`, `NO_OF_PATAWAG`, `ACTIVE_FLAG`, `CREATED_AT`, `UPDATED_AT`) VALUES
(1, NULL, NULL, NULL, 'BLOT-1', '2021-01-23', 'CATAMBAY STREET, BARANGAY WAWA, TANAY, RIZAL', 'JUAN DELA CRUZ', NULL, 'Bandang alas 4 ng hapon, bilang na lang po akong binato ng bato ni Gilbert catambay sa hindi po malamang kadahilanan.  Ako po ay naglalakad sa Catambay Street, Barangay Wawa, Tanay, Rizal ng si Gilbert Catambay ay lumabas galing sa kanilang bahay at bigla na lang po akong binato sa ulo.', 'Complainant filed Affidavit of Desistance', '2021-02-03', '2021-02-03', 'Resolved', 'GILBERT L CATAMBAY', 'PHYSICAL INJURY', 1, 1, '2021-02-03 03:16:26', NULL),
(2, NULL, NULL, NULL, 'BLOT-2', '2021-01-25', 'CATAMBAY STREET, BARANGAY WAWA, TANAY, RIZAL', 'MARIA CRUZ, JUANA CRUZ, GARDO VERSOZA', NULL, 'Ika 4 ng hapon, ako po ay dumadaan sa tapat ng bahay ni sec gilbert ng ako po ay tawagin nina Sec Gilbert, mario talavera at cardo dela rama.  Ako po tumigil at sila ay aking nilapitan.  Tumayo po sina Sec Gilbert at Mario at ako po ay pinitsarahan.  At bigla na lang po akong pinagsasampal at sinuntok ng tatlo, sina sec Gilbert, Mario at Cardo dela rama', NULL, '2021-02-03', NULL, 'Pending', 'SEC GILBERT, MARIO TALAVERA, CARDO DELA RAMA', 'PHYSICAL INJURY', 1, 1, '2021-02-03 05:41:48', NULL),
(3, NULL, NULL, NULL, 'BLOT-2021-01-00003', '2021-01-05', 'test', 'test', NULL, 'test', NULL, '2021-02-09', NULL, 'Pending', 'test', 'test', 0, 1, '2021-02-09 08:39:18', NULL),
(4, NULL, NULL, NULL, 'BLOT-2021-01-00004', '2021-02-07', 'trinidad Street, Barangay Wawa, Tanay, Rizal', 'MARIA CRUZ, JUANA CRUZ, GARDO VERSOZA', NULL, 'Nais ko po sanang maipatawag sa isang pagkaharap harap sina Kap turo, Sec Bo at si Ms Myhlen dahil po sa paninirang puri na kanila pong pinagkakalat dito po sa barangay laban sa akin.   Sabi po ng aking kapitbahay na ang tatlong nabanggit po ay nakapaghatid ng di kanais nais na salita patungkol sa akin.  Kanila pong pinagkakalat na ako po ay may maganda mukha, mahubog na katawan at may porselanang kutis.  Ang kinasasama po ng loob ko ay nung di po nila nabanggit ang maganda kong buhok', NULL, '2021-02-09', NULL, 'Pending', 'Kap Turo, Sec Bo at Myhlen', 'Paninirang Puri', 0, 1, '2021-02-09 08:44:10', NULL),
(5, NULL, NULL, NULL, 'BLOT-2021-01-00005', '2021-02-08', 'Trinidad corner Cecilio Santos Street, Tanay, Rizal', 'Mhylen Casamina Reyta', NULL, 'Ganap na ika 1 ng hapon, nung ako po ay may inaabot sa ibabang bahagi ng aking cabinet na narito sa likod ng aking lamesa, si kapitan turo po ay bigla po akong kinalabit sa may aking likod na malapit sa aking pang-upo.  Ako po ay nagulat dahil hindi ko po inaasahan ang gagawin ni kapitan.  Agad ko po siyang kinompronta sa kanyang ginawang sa aking palagay ay kahalayan.', NULL, '2021-02-09', NULL, 'Pending', 'Arturo M Viray', 'Sexual Harrassment', 0, 1, '2021-02-09 08:54:01', NULL),
(6, NULL, NULL, NULL, 'BLOT-2021-02-00006', '2021-03-02', 'Cecilio Santos Street, barangay wawa, tanay, rizal', 'Wena Jesuitas, Levy Sidon, alias achie', NULL, 'Nung March 3 2021 ganap na ika 4 ng hapon, narinig ko   po ang paninira sa akin nina  wena jesuitas at levy sidon.  Sinabi po nya sa kasamahan ko sa trabaho na ako po daw ay masamang babae at nakikisama sa may asawa.  Nais ko po silang ipatawag sa kanilang sinasabi na wala na pong basehan', NULL, '2021-03-19', NULL, 'Pending', 'Beverly Santos', 'Oral defamation', 1, 1, '2021-03-19 06:35:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_building_information`
--

CREATE TABLE `t_building_information` (
  `BUILDING_ID` int(11) NOT NULL,
  `BUILDING_NAME` varchar(100) DEFAULT NULL,
  `BUILDING_ID_NUMBER` varchar(100) DEFAULT NULL,
  `BUILDING_OCCUPANCY` varchar(50) DEFAULT NULL,
  `LAND_USE` varchar(50) DEFAULT NULL,
  `SCOPE_OF_WORK` varchar(50) DEFAULT NULL,
  `PROJECT_TYPE` varchar(255) DEFAULT NULL,
  `PROJECT_LOCATION` varchar(100) DEFAULT NULL,
  `PROJECT_COST` decimal(10,0) DEFAULT NULL,
  `PROJECT_FLOOR_AREA` varchar(50) DEFAULT NULL,
  `PROJECT_LOT_AREA` varchar(50) DEFAULT NULL,
  `APPLICANT_NAME` varchar(100) DEFAULT NULL,
  `APPLICANT_TELEPHONE_NO` varchar(25) DEFAULT NULL,
  `APPLICANT_MOBILE_NO` varchar(25) DEFAULT NULL,
  `APPLICANT_EMAIL` varchar(100) DEFAULT NULL,
  `POSTAL_CODE` varchar(25) DEFAULT NULL,
  `FORM_OWNERSHIP` varchar(50) DEFAULT NULL,
  `ENTERPRISE_NAME` varchar(100) DEFAULT NULL,
  `STATUS` varchar(25) DEFAULT NULL,
  `IS_REQUESTED` int(11) DEFAULT 0,
  `LESSOR_NAME` varchar(50) DEFAULT NULL,
  `LESSOR_ADDRESS` varchar(100) DEFAULT NULL,
  `LESSOR_NO` varchar(25) DEFAULT NULL,
  `LESSOR_EMAIL` varchar(25) DEFAULT NULL,
  `MONTHLY_RENTAL` decimal(10,0) DEFAULT NULL,
  `APPLICANT_ADDRESS` varchar(100) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL,
  `LOT_NUMBER` varchar(100) DEFAULT NULL,
  `IS_IMPROVEMENT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `t_building_information`
--

INSERT INTO `t_building_information` (`BUILDING_ID`, `BUILDING_NAME`, `BUILDING_ID_NUMBER`, `BUILDING_OCCUPANCY`, `LAND_USE`, `SCOPE_OF_WORK`, `PROJECT_TYPE`, `PROJECT_LOCATION`, `PROJECT_COST`, `PROJECT_FLOOR_AREA`, `PROJECT_LOT_AREA`, `APPLICANT_NAME`, `APPLICANT_TELEPHONE_NO`, `APPLICANT_MOBILE_NO`, `APPLICANT_EMAIL`, `POSTAL_CODE`, `FORM_OWNERSHIP`, `ENTERPRISE_NAME`, `STATUS`, `IS_REQUESTED`, `LESSOR_NAME`, `LESSOR_ADDRESS`, `LESSOR_NO`, `LESSOR_EMAIL`, `MONTHLY_RENTAL`, `APPLICANT_ADDRESS`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `LOT_NUMBER`, `IS_IMPROVEMENT`) VALUES
(44, 'ANGEL GRACE DEPT.', 'BLD-0001', NULL, 'Residential', 'Land Related', '2 STOREY CLASSROOM', '123 AREA 2 BARANGAY WAWA TANAY RIZAL', '500000', '9000', '10000', 'RALPH LAWRENCE TARLAC', NULL, NULL, NULL, NULL, 'Single', NULL, 'Pending', 0, NULL, NULL, NULL, NULL, NULL, '123 AREA 2 BARANGAY WAWA TANAY RIZAL', '2021-04-13 05:20:13', NULL, 1, 'LOT-0001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_building_occupancy`
--

CREATE TABLE `t_building_occupancy` (
  `BUILDING_ID` int(11) DEFAULT NULL,
  `OCCUPANCY` varchar(50) DEFAULT NULL,
  `STOREY_NO` int(11) DEFAULT NULL,
  `UNIT_NO` int(11) DEFAULT NULL,
  `UNIT_FLOOR_AREA` varchar(50) DEFAULT NULL,
  `TRANSACTION_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_building_occupancy`
--

INSERT INTO `t_building_occupancy` (`BUILDING_ID`, `OCCUPANCY`, `STOREY_NO`, `UNIT_NO`, `UNIT_FLOOR_AREA`, `TRANSACTION_ID`) VALUES
(44, 'Institutional', 8, 12, '123123', 50);

-- --------------------------------------------------------

--
-- Table structure for table `t_building_transactions`
--

CREATE TABLE `t_building_transactions` (
  `TRANSACTION_ID` int(11) NOT NULL,
  `BUILDING_ID` int(11) DEFAULT NULL,
  `SCOPE_OF_WORK` varchar(50) DEFAULT NULL,
  `T_STATUS` varchar(50) DEFAULT NULL,
  `T_IS_REQUESTED` int(11) NOT NULL DEFAULT 0,
  `T_IS_IMPROVEMENT` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_building_transactions`
--

INSERT INTO `t_building_transactions` (`TRANSACTION_ID`, `BUILDING_ID`, `SCOPE_OF_WORK`, `T_STATUS`, `T_IS_REQUESTED`, `T_IS_IMPROVEMENT`) VALUES
(47, 44, 'Land Related', 'Pending', 0, 0),
(48, 44, 'New Construction', 'Approved', 1, 1),
(49, 44, 'Land Related', 'Pending', 0, 1),
(50, 44, 'Erection', 'Approved', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_business_approval`
--

CREATE TABLE `t_business_approval` (
  `APPROVAL_ID` int(11) NOT NULL,
  `BUSINESS_ID` int(11) DEFAULT NULL,
  `BUILDING_ID` int(11) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT NULL,
  `APPROVED_BY` varchar(255) DEFAULT NULL,
  `DATE_APPROVED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_business_approval`
--

INSERT INTO `t_business_approval` (`APPROVAL_ID`, `BUSINESS_ID`, `BUILDING_ID`, `STATUS`, `APPROVED_BY`, `DATE_APPROVED`) VALUES
(1, 1, NULL, 'Evaluated', NULL, '2021-01-07 00:00:00'),
(2, 2, NULL, 'Evaluated', NULL, '2021-01-14 00:00:00'),
(3, 3, NULL, 'Evaluated', NULL, '2021-01-15 00:00:00'),
(4, 4, NULL, 'Evaluated', NULL, '2021-01-18 00:00:00'),
(5, 5, NULL, 'Evaluated', NULL, '2021-01-18 00:00:00'),
(6, 11, NULL, 'Evaluated', NULL, '2021-01-27 00:00:00'),
(7, 12, NULL, 'Evaluated', NULL, '2021-01-27 00:00:00'),
(8, 13, NULL, 'Evaluated', NULL, '2021-01-27 00:00:00'),
(9, 14, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-01-28 00:00:00'),
(10, 15, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-01-28 00:00:00'),
(11, 16, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-01-28 00:00:00'),
(12, 17, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-01-28 00:00:00'),
(13, 16, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-01-28 00:00:00'),
(14, 18, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-01 00:00:00'),
(15, 18, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-01 00:00:00'),
(16, 18, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-01 00:00:00'),
(17, 19, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-01 00:00:00'),
(18, 22, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-02 00:00:00'),
(19, 23, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-02 00:00:00'),
(20, 20, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-02 00:00:00'),
(21, 21, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-02 00:00:00'),
(22, 24, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-02 00:00:00'),
(23, 25, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-02 00:00:00'),
(24, NULL, 2, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-02-24 00:00:00'),
(25, NULL, 3, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-01 00:00:00'),
(26, NULL, 4, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-01 00:00:00'),
(27, NULL, 5, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-02 00:00:00'),
(28, NULL, 6, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-02 00:00:00'),
(29, NULL, 7, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-02 00:00:00'),
(30, NULL, 8, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-02 00:00:00'),
(31, NULL, 10, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-02 00:00:00'),
(32, NULL, 12, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-02 00:00:00'),
(33, NULL, 13, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-02 00:00:00'),
(34, NULL, 14, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-02 00:00:00'),
(35, NULL, 15, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-03 00:00:00'),
(36, NULL, 1, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-05 00:00:00'),
(37, NULL, 15, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-09 00:00:00'),
(38, NULL, 15, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-09 00:00:00'),
(39, NULL, 15, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-10 00:00:00'),
(40, NULL, 15, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-11 00:00:00'),
(41, NULL, 18, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-11 00:00:00'),
(42, NULL, 16, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-12 00:00:00'),
(43, NULL, 17, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-12 00:00:00'),
(44, NULL, 18, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-12 00:00:00'),
(45, NULL, 19, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-12 00:00:00'),
(46, NULL, 20, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-12 00:00:00'),
(47, NULL, 23, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-16 00:00:00'),
(48, NULL, 24, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-16 00:00:00'),
(49, NULL, 25, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-16 00:00:00'),
(50, NULL, 23, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-16 00:00:00'),
(51, NULL, 24, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-16 00:00:00'),
(52, NULL, 25, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-16 00:00:00'),
(53, NULL, 23, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-16 00:00:00'),
(54, 32, NULL, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-03-19 00:00:00'),
(55, NULL, 27, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-22 00:00:00'),
(56, NULL, 31, 'Evaluated', 'URSUS RAMON ROMERO', '2021-03-29 00:00:00'),
(57, NULL, 30, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-03-30 00:00:00'),
(58, NULL, 32, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-03-30 00:00:00'),
(59, NULL, 33, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-06 00:00:00'),
(60, NULL, 34, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-06 00:00:00'),
(61, NULL, 35, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-06 00:00:00'),
(62, NULL, 35, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-06 00:00:00'),
(63, NULL, 35, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-06 00:00:00'),
(64, NULL, 35, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-06 00:00:00'),
(65, NULL, 36, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-08 00:00:00'),
(66, NULL, 37, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-08 00:00:00'),
(67, NULL, 37, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-08 00:00:00'),
(68, NULL, 38, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-08 00:00:00'),
(69, NULL, 38, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-08 00:00:00'),
(70, NULL, 39, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-12 00:00:00'),
(71, NULL, 40, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-12 00:00:00'),
(72, NULL, 40, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-12 00:00:00'),
(73, NULL, 41, 'Evaluated', 'GILBERT LLOSALA CATAMBAY', '2021-04-12 00:00:00'),
(74, NULL, 41, 'Evaluated', 'URSUS RAMON ROMERO', '2021-04-13 00:00:00'),
(75, NULL, 42, 'Evaluated', 'URSUS RAMON ROMERO', '2021-04-13 00:00:00'),
(76, NULL, 42, 'Evaluated', 'URSUS RAMON ROMERO', '2021-04-13 00:00:00'),
(77, NULL, 44, 'Evaluated', 'URSUS RAMON ROMERO', '2021-04-14 00:00:00'),
(78, NULL, 44, 'Evaluated', 'URSUS RAMON ROMERO', '2021-04-14 00:00:00'),
(79, 31, NULL, 'Evaluated', 'URSUS RAMON ROMERO', '2021-04-27 00:00:00'),
(80, 33, NULL, 'Evaluated', 'URSUS RAMON ROMERO', '2021-04-29 00:00:00'),
(81, 34, NULL, 'Evaluated', NULL, '2021-05-28 00:00:00'),
(82, 34, NULL, 'Evaluated', NULL, '2021-05-28 00:00:00'),
(83, 36, NULL, 'Evaluated', NULL, '2021-05-28 00:00:00'),
(84, 38, NULL, 'Evaluated', 'URSUS RAMON ROMERO', '2021-06-04 00:00:00'),
(85, 39, NULL, 'Evaluated', 'URSUS RAMON ROMERO', '2021-06-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_business_information`
--

CREATE TABLE `t_business_information` (
  `BUSINESS_ID` int(11) NOT NULL,
  `BUSINESS_NAME` varchar(50) DEFAULT NULL,
  `TRADE_NAME` varchar(50) DEFAULT NULL,
  `BUSINESS_NATURE_ID` int(11) DEFAULT NULL,
  `BUSINESS_OWNER_FIRSTNAME` varchar(150) DEFAULT NULL,
  `BUSINESS_OWNER_MIDDLENAME` varchar(50) DEFAULT NULL,
  `BUSINESS_OWNER_LASTNAME` varchar(50) DEFAULT NULL,
  `BUSINESS_ADDRESS` varchar(255) DEFAULT NULL,
  `BUILDING_NUMBER` varchar(50) DEFAULT NULL,
  `BUILDING_NAME` varchar(50) DEFAULT NULL,
  `UNIT_NO` varchar(50) DEFAULT NULL,
  `STREET` varchar(50) DEFAULT NULL,
  `SITIO` varchar(50) DEFAULT NULL,
  `SUBDIVISION` varchar(50) DEFAULT NULL,
  `BUSINESS_OR_NUMBER` varchar(50) DEFAULT NULL,
  `BUSINESS_OR_ACQUIRED_DATE` date DEFAULT NULL,
  `BARANGAY_ZONE_ID` int(11) DEFAULT NULL,
  `TIN_NO` varchar(50) DEFAULT NULL,
  `DTI_REGISTRATION_NO` varchar(50) DEFAULT NULL,
  `DTI_NO_DATE` date DEFAULT NULL,
  `TYPE_OF_BUSINESS` varchar(50) DEFAULT NULL,
  `BUSINESS_POSTAL_CODE` varchar(50) DEFAULT NULL,
  `BUSINESS_EMAIL_ADD` varchar(100) DEFAULT NULL,
  `BUSINESS_TELEPHONE_NO` varchar(50) DEFAULT NULL,
  `BUSINESS_MOBILE_NO` varchar(50) DEFAULT NULL,
  `OWNER_ADDRESS` varchar(150) DEFAULT NULL,
  `OWNER_POSTAL_CODE` varchar(50) DEFAULT NULL,
  `OWNER_EMAIL_ADD` varchar(100) DEFAULT NULL,
  `OWNER_TELEPHONE_NO` varchar(50) DEFAULT NULL,
  `OWNER_MOBILE_NO` varchar(50) DEFAULT NULL,
  `EMERGENCY_CONTACT_PERSON` varchar(150) DEFAULT NULL,
  `EMERGENCY_PERSON_CONTACT_NO` varchar(50) DEFAULT NULL,
  `EMERGENCY_PERSON_EMAIL_ADD` varchar(50) DEFAULT NULL,
  `BUSINESS_AREA` varchar(50) DEFAULT NULL,
  `NO_EMPLOYEE_ESTABLISHMENT` int(11) DEFAULT NULL,
  `NO_EMPLOYEE_LGU` int(11) DEFAULT NULL,
  `NO_FEMALE_EMPLOYEE` int(11) DEFAULT NULL,
  `NO_MALE_EMPLOYEE` int(11) DEFAULT NULL,
  `NO_FEMALE_LGU` int(11) DEFAULT NULL,
  `NO_MALE_LGU` int(11) DEFAULT NULL,
  `LESSOR_NAME` varchar(150) DEFAULT NULL,
  `LESSOR_ADDRESS` varchar(150) DEFAULT NULL,
  `LESSOR_POSTAL` varchar(50) DEFAULT NULL,
  `LESSOR_CONTACT_NO` varchar(50) DEFAULT NULL,
  `LESSOR_TELEPHONE` varchar(50) DEFAULT NULL,
  `LESSOR_MOBILE_NO` varchar(50) DEFAULT NULL,
  `LESSOR_EMAIL_ADD` varchar(100) DEFAULT NULL,
  `MONTHLY_RENTAL` varchar(50) DEFAULT NULL,
  `REFERENCED_BUSINESS_ID` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT NULL,
  `NEW_RENEW_STATUS` varchar(50) DEFAULT 'New',
  `EVALUATED` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_business_information`
--

INSERT INTO `t_business_information` (`BUSINESS_ID`, `BUSINESS_NAME`, `TRADE_NAME`, `BUSINESS_NATURE_ID`, `BUSINESS_OWNER_FIRSTNAME`, `BUSINESS_OWNER_MIDDLENAME`, `BUSINESS_OWNER_LASTNAME`, `BUSINESS_ADDRESS`, `BUILDING_NUMBER`, `BUILDING_NAME`, `UNIT_NO`, `STREET`, `SITIO`, `SUBDIVISION`, `BUSINESS_OR_NUMBER`, `BUSINESS_OR_ACQUIRED_DATE`, `BARANGAY_ZONE_ID`, `TIN_NO`, `DTI_REGISTRATION_NO`, `DTI_NO_DATE`, `TYPE_OF_BUSINESS`, `BUSINESS_POSTAL_CODE`, `BUSINESS_EMAIL_ADD`, `BUSINESS_TELEPHONE_NO`, `BUSINESS_MOBILE_NO`, `OWNER_ADDRESS`, `OWNER_POSTAL_CODE`, `OWNER_EMAIL_ADD`, `OWNER_TELEPHONE_NO`, `OWNER_MOBILE_NO`, `EMERGENCY_CONTACT_PERSON`, `EMERGENCY_PERSON_CONTACT_NO`, `EMERGENCY_PERSON_EMAIL_ADD`, `BUSINESS_AREA`, `NO_EMPLOYEE_ESTABLISHMENT`, `NO_EMPLOYEE_LGU`, `NO_FEMALE_EMPLOYEE`, `NO_MALE_EMPLOYEE`, `NO_FEMALE_LGU`, `NO_MALE_LGU`, `LESSOR_NAME`, `LESSOR_ADDRESS`, `LESSOR_POSTAL`, `LESSOR_CONTACT_NO`, `LESSOR_TELEPHONE`, `LESSOR_MOBILE_NO`, `LESSOR_EMAIL_ADD`, `MONTHLY_RENTAL`, `REFERENCED_BUSINESS_ID`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `STATUS`, `NEW_RENEW_STATUS`, `EVALUATED`) VALUES
(14, 'KRIZZPYLICIOUS ONLINE STORE', NULL, 4, 'KRIS', 'PINTACASI', 'JESUITAS', '01 JOSE ABAD SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'RETLR-00001', NULL, NULL, '11122233000', '11112222', '2020-11-08', 'Single', '1980', NULL, NULL, NULL, 'HOLY CROSS ROAD, SITIO BUKAL, BARANGAY TANDANG KUTYO, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-28 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(15, 'TRENDY TREASURES VARIETY STORE', NULL, 4, 'SANDY', 'PINTACASI', 'JESUITAS', '02 JOSE ABAD SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'RETLR-00002', NULL, NULL, '111222334000', '11112223', '2020-10-31', 'Single', '1980', NULL, NULL, NULL, 'HOLY CROSS ROAD, SITIO BUKAL, BARANGAY TANDANG KUTYO, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-28 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(16, 'Fresh N Vegetables Enterprise', 'MacDonald\'s', 4, 'MARYJANE', 'ABALOS', 'MINA', '10 J P LAUREL CORNER M H DEL PILAR STREETS, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'RETLR-00003', NULL, NULL, '111222334000', '11112224', '2020-12-01', 'Corporation', '1980', NULL, NULL, NULL, '1256 DON MARIANO HEIGHTS SUBDIVISION, BARANGAY SAN ANTONIO, CAINTA, RIZAL', '1930', NULL, NULL, NULL, NULL, NULL, NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, 'AMEDEO GUTIERREZ FULAGADO', '15 RODRIGUEZ AVENUE, BARANGAY KATIPUNAN BAYANI, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, '100000', NULL, '2021-01-28 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(17, 'MUMBAI MICROLENDING BUSINESS', NULL, 6, 'KANA', 'DITO', 'UTANG', '03 JOSE ABAD SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'BNKFI-00001', NULL, NULL, '111222336000', '11112225', '2020-09-26', 'Single', '1980', NULL, NULL, NULL, '56 CELSO T CATAMBAY STREET, BARANGAY MAG-AMPON, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-28 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(18, NULL, NULL, 8, 'ARBIE', 'IPOSADA', 'LLEGO', '79 I YUJUICO STREET, BARANGAY TABING-ILOG, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'OTHBS-00001', NULL, NULL, '111222337000', '227018783', '2015-07-20', 'Single', '1980', NULL, NULL, NULL, '08 JOSE ABAD SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-01 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(19, NULL, NULL, 8, 'ARBIE', 'IPOSADA', 'LLEGO', '79 I YUJUICO STREET, BARANGAY TABING ILOG, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'OTHBS-00002', NULL, NULL, NULL, '227018784', '2015-07-20', 'Single', '1980', NULL, NULL, NULL, '07 JOSE ABAD SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-01 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(20, 'D INDAY\'S STORE', NULL, 4, 'MELANIE', 'PENADA', 'AGDA', '89 PASTOR G SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'RETLR-00004', NULL, NULL, NULL, NULL, NULL, 'Single', '1980', NULL, NULL, NULL, '89 PASTOR G SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(21, '4VD=S AGRIVET SUPPLIES', NULL, 4, 'VINYA RONNETTE', 'G', 'ARADO', '02 G TRINIDAD STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'RETLR-00005', NULL, NULL, NULL, NULL, NULL, 'Single', '1980', NULL, NULL, NULL, '02 G TRINIDAD STREET, BARANGAY WAWA, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(22, NULL, NULL, 1, 'CAROLINE', 'BERNABEO', 'CASAS', '154 PASTOR G SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'MFRRS-00001', NULL, NULL, NULL, NULL, NULL, 'Single', '1980', NULL, NULL, NULL, '154 PASTOR G SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(23, 'CTB88 CATERING SERVICES', NULL, 8, 'CARL CHRISTIAN', 'OCAMPO', 'CRUZ', '23 SEVERINO OCAMPO SR STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'OTHBS-00003', NULL, NULL, NULL, NULL, NULL, 'Single', '1980', NULL, NULL, NULL, '23 SEVERINO OCAMPO SR STREET, BARANGAY WAWA, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(24, 'FRABELLE FISHING CORPORATION', NULL, 2, 'LANIE', 'PACARDO', 'LIM', 'FISHPEN, LAGUNA LAKE, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'WHLRS', NULL, NULL, NULL, NULL, NULL, 'Corporation', '1980', NULL, NULL, NULL, 'MAKATI CITY', '2040', NULL, NULL, NULL, NULL, NULL, NULL, '50000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(25, 'J \'SIS SARI-SARI STORE', NULL, 4, 'JOCELYN', 'AGDA', 'MEMPIN', 'G TRINIDAD STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'RETLR-00006', NULL, NULL, NULL, NULL, NULL, 'Single', '1980', NULL, NULL, NULL, 'G TRINIDAD STREET, BARANGAY WAWA, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(26, 'STO NINO INTEGRATED SCHOOL', NULL, NULL, 'KARHEENA', 'F', 'COQUIA-FABIAN', 'STO NINO INTEGRATED SCHOOL, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'BUILDING-00001', NULL, NULL, NULL, NULL, NULL, '-- Type of Business --', '1980', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '218.50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-16 00:00:00', NULL, NULL, 'Pending', 'New', 0),
(27, 'STO NINO INTEGRATED SCHOOL', NULL, NULL, 'KARHEENA', 'F', 'COQUIA-FABIAN', 'STO NINO INTEGRATED SCHOOL, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'BUILDING-00001', NULL, NULL, NULL, NULL, NULL, '-- Type of Business --', '1980', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '218.50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-16 00:00:00', NULL, NULL, 'Pending', 'New', 0),
(28, 'STO NINO INTEGRATED SCHOOL', NULL, NULL, 'KARHEENA', 'F', 'COQUIA-FABIAN', 'STO NINO INTEGRATED SCHOOL, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'BUILDING-00001', NULL, NULL, NULL, NULL, NULL, '-- Type of Business --', '1980', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '218.50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-16 00:00:00', NULL, NULL, 'Pending', 'New', 0),
(29, 'STO NINO INTEGRATED SCHOOL', NULL, NULL, 'KARHEENA', 'F', 'COQUIA-FABIAN', 'STO NINO INTEGRATED SCHOOL, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'BUILDING-00001', NULL, NULL, NULL, NULL, NULL, '-- Type of Business --', '1980', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '218.50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-16 00:00:00', NULL, NULL, 'Pending', 'New', 0),
(30, 'STO NINO INTEGRATED SCHOOL', NULL, NULL, 'KARHEENA', 'F', 'COQUIA-FABIAN', 'STO NINO INTEGRATED SCHOOL, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'BUILDING-00001', NULL, NULL, NULL, NULL, NULL, '-- Type of Business --', '1980', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '218.50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-16 00:00:00', NULL, NULL, 'Pending', 'New', 0),
(31, 'TANAY RURAL BANK', NULL, 6, 'MELINDA', 'RAMOS', 'GUERRERO', '20 CECILIO STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'BNKFI-00001', NULL, NULL, '123456792', '111-222-350', '2021-01-15', 'Corporation', '1980', NULL, NULL, NULL, '10H JESUITAS STREET, BARANGAY PINAGKAMALIGAN, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-18 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(32, 'OCEAN PEARL FISHING CORPORATION', 'OCEAN PEARL FISHING CORPORATION', 2, 'ROSARIO', 'M', 'DELA CRUZ', 'LAGUNA LAKE, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'WHLRS-00002', NULL, NULL, '987654321', '123456789', '2009-07-19', 'Corporation', '1980', NULL, NULL, NULL, 'MANILA CITY', '2050', NULL, NULL, NULL, NULL, NULL, NULL, '10000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 00:00:00', NULL, NULL, 'Approved', 'Renew', 1),
(33, 'TANAY RURAL BANK', 'INC', 4, 'RALPH', NULL, 'TARLAC', '20 CECILIO STREET, BARANGAY WAWA, TANAY, RIZAL', NULL, NULL, NULL, NULL, NULL, NULL, 'TANAY RURAL BANK', NULL, NULL, NULL, NULL, NULL, 'Single', '1119', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-29 00:00:00', NULL, NULL, 'Approved', 'New', 1),
(34, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cooperative', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-28 00:00:00', NULL, NULL, 'Approved', 'New', 0),
(35, NULL, NULL, NULL, 'ARBIE', 'IPOSADA', 'LLEGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OTHBS-00001', NULL, NULL, '111222337000', '227018783', NULL, 'Single', '1980', NULL, NULL, NULL, '08 JOSE ABAD SANTOS STREET, BARANGAY WAWA, TANAY, RIZAL', '1980', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2021-05-28 00:00:00', NULL, NULL, 'Pending', 'Renew', 0),
(39, 'Sari Sari Store', NULL, 3, 'John Raven', 'Tamang', 'Glomar', 'Purok 8 Unit 5 Adarna Extension Barangay Commonwealth', NULL, NULL, NULL, NULL, NULL, NULL, 'WHLRS-00002', NULL, NULL, NULL, NULL, '2021-06-09', 'Partnership', '1110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-08 00:00:00', NULL, NULL, 'Approved', 'Renew', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_children_profile`
--

CREATE TABLE `t_children_profile` (
  `CHILDREN_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `BIRTH_ORDER` int(11) DEFAULT NULL,
  `IS_REGISTERED` int(11) DEFAULT NULL,
  `BORN_AT` varchar(50) DEFAULT NULL,
  `CHILDER_MOTHER_TONGUE` varchar(25) DEFAULT NULL,
  `CHILDREN_OTHER_DIALECT` varchar(50) DEFAULT NULL,
  `CHILDREN_HEIGHT` decimal(10,0) DEFAULT NULL,
  `CHILDREN_WEIGHT` decimal(10,0) DEFAULT NULL,
  `DOES_IT_HAVE_ECCD_CARD` varchar(11) DEFAULT NULL,
  `DOES_IT_HAVE_MOTHER_CHILD_BOOK` varchar(11) DEFAULT NULL,
  `DOES_IT_HAVE_OTHERS` varchar(50) DEFAULT NULL,
  `VACCINATION_BCG` varchar(10) DEFAULT NULL,
  `VACCINATION_DPT` varchar(11) DEFAULT NULL,
  `VACCINATION_ORAL_POLIO` varchar(11) DEFAULT NULL,
  `VACCINATION_HEPA_B` varchar(11) DEFAULT NULL,
  `VACCINATION_MEASLES` varchar(11) DEFAULT NULL,
  `VACCINATION_OTHERS` varchar(50) DEFAULT NULL,
  `DEFORMITY_HARE_LIP` int(11) DEFAULT NULL,
  `DEFORMITY_DISABLE_LEG` int(11) DEFAULT NULL,
  `DEFORMITY_CROSS_EYED` int(11) DEFAULT NULL,
  `DEFORMITY_DISABLE_ARM_LEG` int(11) DEFAULT NULL,
  `DEFORMITY_FINGER_TOES` int(11) DEFAULT NULL,
  `DEFORMITY_DEAF` int(11) DEFAULT NULL,
  `DEFORMITY_BLIND` int(11) DEFAULT NULL,
  `PROBLEMS_WITH_BEHAVIOR` int(11) DEFAULT NULL,
  `PROBLEMS_WITH_SPEAKING` int(11) DEFAULT NULL,
  `PROBLEMS_WITH_HEARING` int(11) DEFAULT NULL,
  `PROBLEMS_WITH_VISION` int(11) DEFAULT NULL,
  `IS_LEFT_HANDED` int(11) DEFAULT NULL,
  `CHILDHOOD_EXP_NURSERY` int(11) DEFAULT NULL,
  `CHILDHOOD_EXP_KINDERGARTEN` int(11) DEFAULT NULL,
  `CHILDHOOD_EXP_PREPARATORY` int(11) DEFAULT NULL,
  `LEARNS_WHERE` varchar(50) DEFAULT NULL,
  `LEARNS_AT_HOME_W_PARENTS` int(11) DEFAULT NULL,
  `LEARNS_AT_HOME_W_NOBODY` int(11) DEFAULT NULL,
  `LEARNS_AT_HOME_W_SIBLINGS` int(11) DEFAULT NULL,
  `LEARNS_AT_HOME_W_RELATIVES` int(11) DEFAULT NULL,
  `LEARNS_AT_HOME_W_MAID` int(11) DEFAULT NULL,
  `LEARNS_AT_HOME_TUTOR` int(11) DEFAULT NULL,
  `LEARNS_AT_HOME_W_OTHERS` varchar(50) DEFAULT NULL,
  `INTERACTS_W_OLDER_SIBLINGS` int(11) DEFAULT NULL,
  `INTERACTS_W_YOUNGER_SIBLINGS` int(11) DEFAULT NULL,
  `INTERACTS_W_SAME_AGE` int(11) DEFAULT NULL,
  `EATS_MEAL_BEFORE_SCHOOL` varchar(50) DEFAULT NULL,
  `HAS_BAON` varchar(50) DEFAULT NULL,
  `FOOD_NORMALLY_EATEN` varchar(50) DEFAULT NULL,
  `TRAVEL_TIME_TO_DCC` varchar(25) DEFAULT NULL,
  `MODE_TRANSPORTATION_TO_DCC` varchar(25) DEFAULT NULL,
  `TRAVEL_TIME_TO_NCDC` varchar(25) DEFAULT NULL,
  `MODE_TRANSPORTATION_TO_NCDC` varchar(25) DEFAULT NULL,
  `PUBLIC_TRANSPORTATION_ID` varchar(50) DEFAULT NULL,
  `TRANSPORTATION_FARE` varchar(50) DEFAULT NULL,
  `GOES_TO_SCHOOL_WITH` varchar(25) DEFAULT NULL,
  `CHILD_DEVELOPMENT_TEACHER` varchar(50) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_clearance_certification`
--

CREATE TABLE `t_clearance_certification` (
  `CLEARANCE_CERTIFICATION_ID` int(11) NOT NULL,
  `CONTROL_NO` varchar(100) DEFAULT NULL,
  `ISSUED_DATE` datetime DEFAULT NULL,
  `OR_NO` varchar(50) DEFAULT NULL,
  `OR_DATE` datetime DEFAULT NULL,
  `OR_AMOUNT` varchar(50) DEFAULT NULL,
  `FORM_ID` int(11) DEFAULT NULL,
  `PAPER_TYPE_ID` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_clearance_certification`
--

INSERT INTO `t_clearance_certification` (`CLEARANCE_CERTIFICATION_ID`, `CONTROL_NO`, `ISSUED_DATE`, `OR_NO`, `OR_DATE`, `OR_AMOUNT`, `FORM_ID`, `PAPER_TYPE_ID`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(96, 'FM-BBP-2021-4-1', '2021-04-14 00:00:00', 'OR-0003', '2021-04-14 00:00:00', '750.00', 1, 35, '2021-04-13 22:56:04', NULL, 1),
(97, 'FM-BBP-2021-4-2', '2021-04-14 00:00:00', 'OR-0004', '2021-04-14 00:00:00', '590.00', 2, 35, '2021-04-14 02:12:40', NULL, 1),
(98, 'FM-BBP-2021-4-3', '2021-04-29 00:00:00', 'OR-0001', '2021-04-29 00:00:00', '100.00', 3, 29, '2021-04-29 02:24:12', NULL, 1),
(99, 'FM-BBP-2021-6-4', '2021-06-04 00:00:00', 'Test', '2021-06-04 00:00:00', '0.00', 4, 15, '2021-06-04 21:42:13', NULL, 1),
(100, 'FM-BBP-2021-6-5', '2021-06-08 00:00:00', 'Test', '2021-06-08 00:00:00', '0.00', 7, 29, '2021-06-08 12:51:41', NULL, 1),
(101, 'FM-BBP-2021-6-6', '2021-06-15 00:00:00', '123-123', '2021-06-30 00:00:00', '100.00', 11, NULL, '2021-06-15 18:49:48', NULL, 1),
(102, 'FM-BBP-2021-6-7', '2021-06-17 00:00:00', 'OR-123', '2021-06-19 00:00:00', '1000.00', 12, NULL, '2021-06-17 15:55:37', NULL, 1),
(103, 'FM-BBP-2021-6-8', '2021-06-17 00:00:00', 'OR-456', '2021-06-24 00:00:00', '1500.00', 13, NULL, '2021-06-17 15:55:52', NULL, 1),
(104, 'FM-BBP-2021-6-9', '2021-06-18 00:00:00', 'OR-123', '2021-06-26 00:00:00', '1000.00', 14, NULL, '2021-06-18 15:30:15', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_confirm_deregatory`
--

CREATE TABLE `t_confirm_deregatory` (
  `BLOTTER_ID` int(11) DEFAULT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `FORM_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_confirm_deregatory`
--

INSERT INTO `t_confirm_deregatory` (`BLOTTER_ID`, `RESIDENT_ID`, `FORM_ID`) VALUES
(2, 1, 14),
(5, 3, 14);

-- --------------------------------------------------------

--
-- Table structure for table `t_fathers_profile`
--

CREATE TABLE `t_fathers_profile` (
  `FATHERS_ID` int(11) NOT NULL,
  `FATHER_MOTHER_TONGUE` varchar(25) DEFAULT NULL,
  `FATHER_OTHER_DIALECTS` varchar(50) DEFAULT NULL,
  `FATHER_EDUCATIONAL_ATTAINMENT` varchar(50) DEFAULT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_food_eaten`
--

CREATE TABLE `t_food_eaten` (
  `FOOD_EATEN_ID` int(11) NOT NULL,
  `CHILDREN_ID` int(11) DEFAULT NULL,
  `VEGETABLE` int(11) DEFAULT NULL,
  `RICE` int(11) DEFAULT NULL,
  `CEREAL` int(11) DEFAULT NULL,
  `PORK` int(11) DEFAULT NULL,
  `NOODLE` int(11) DEFAULT NULL,
  `FRUIT_JUICE` int(11) DEFAULT NULL,
  `CHICKEN` int(11) DEFAULT NULL,
  `SOUP` int(11) DEFAULT NULL,
  `MILK` int(11) DEFAULT NULL,
  `BEEF` int(11) DEFAULT NULL,
  `BREAD` int(11) DEFAULT NULL,
  `FISH` int(11) DEFAULT NULL,
  `FRUIT` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_household_batch`
--

CREATE TABLE `t_household_batch` (
  `FAMILY_HEADER_ID` int(11) NOT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_household_batch`
--

INSERT INTO `t_household_batch` (`FAMILY_HEADER_ID`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(1, '2020-11-05 07:34:40', '2020-11-05 07:34:40', 1),
(2, '2020-11-10 07:50:27', '2020-11-10 07:50:27', 1),
(3, '2020-12-28 06:44:58', '2020-12-28 06:44:58', 1),
(4, '2021-01-04 05:25:31', '2021-01-04 05:25:31', 1),
(5, '2021-02-10 05:00:18', '2021-02-10 05:00:18', 1),
(6, '2021-02-10 05:53:45', '2021-02-10 05:53:45', 1),
(7, '2021-02-11 04:19:57', '2021-02-11 04:19:57', 1),
(8, '2021-02-11 07:03:36', '2021-02-11 07:03:36', 1),
(9, '2021-02-22 01:49:30', '2021-02-22 01:49:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_household_information`
--

CREATE TABLE `t_household_information` (
  `HOUSEHOLD_ID` int(11) NOT NULL,
  `HOME_OWNERSHIP` varchar(50) DEFAULT NULL,
  `LOT_OWNERSHIP` varchar(50) DEFAULT NULL,
  `PERSON_STAYING_IN_HOUSEHOLD` varchar(50) DEFAULT NULL,
  `HOME_MATERIALS` varchar(10) DEFAULT NULL,
  `STREET_ADDRESS` varchar(50) DEFAULT NULL,
  `BARANGAY_ZONE_ADDRESS` varchar(150) DEFAULT NULL,
  `BARANGAY_ID` int(11) DEFAULT NULL,
  `NUMBER_OF_ROOMS` int(11) DEFAULT NULL,
  `TOILET_HOME` int(11) DEFAULT NULL,
  `PLAY_AREA_HOME` int(11) DEFAULT NULL,
  `BEDROOM_HOME` int(11) DEFAULT NULL,
  `DINING_ROOM_HOME` int(11) DEFAULT NULL,
  `SALA_HOME` int(11) DEFAULT NULL,
  `KITCHEN_HOME` int(11) DEFAULT NULL,
  `WATER_UTILITIES` int(11) DEFAULT NULL,
  `ELECTRICITY_UTILITIES` int(11) DEFAULT NULL,
  `AIRCON_UTILITIES` int(11) DEFAULT NULL,
  `PHONE_UTILITIES` int(11) DEFAULT NULL,
  `COMPUTER_UTILITIES` int(11) DEFAULT NULL,
  `INTERNET_UTILITIES` int(11) DEFAULT NULL,
  `TV_UTILITIES` int(11) DEFAULT NULL,
  `CD_PLAYER_UTILITIES` int(11) DEFAULT NULL,
  `RADIO_UTILITIES` int(11) DEFAULT NULL,
  `COMICS_ENTERTAINMENT` int(11) DEFAULT NULL,
  `NEWS_PAPER_ENTERTAINMENT` int(11) DEFAULT NULL,
  `PETS_ENTERTAINMENT` int(11) DEFAULT NULL,
  `BOOKS_ENTERTAINMENT` int(11) DEFAULT NULL,
  `STORY_BOOKS_ENTERTAINMENT` int(11) DEFAULT NULL,
  `TOYS_ENTERTAINMENT` int(11) DEFAULT NULL,
  `BOARD_GAMES_ENTERTAINMENT` int(11) DEFAULT NULL,
  `PUZZLES_ENTERTAINMENT` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_household_information`
--

INSERT INTO `t_household_information` (`HOUSEHOLD_ID`, `HOME_OWNERSHIP`, `LOT_OWNERSHIP`, `PERSON_STAYING_IN_HOUSEHOLD`, `HOME_MATERIALS`, `STREET_ADDRESS`, `BARANGAY_ZONE_ADDRESS`, `BARANGAY_ID`, `NUMBER_OF_ROOMS`, `TOILET_HOME`, `PLAY_AREA_HOME`, `BEDROOM_HOME`, `DINING_ROOM_HOME`, `SALA_HOME`, `KITCHEN_HOME`, `WATER_UTILITIES`, `ELECTRICITY_UTILITIES`, `AIRCON_UTILITIES`, `PHONE_UTILITIES`, `COMPUTER_UTILITIES`, `INTERNET_UTILITIES`, `TV_UTILITIES`, `CD_PLAYER_UTILITIES`, `RADIO_UTILITIES`, `COMICS_ENTERTAINMENT`, `NEWS_PAPER_ENTERTAINMENT`, `PETS_ENTERTAINMENT`, `BOOKS_ENTERTAINMENT`, `STORY_BOOKS_ENTERTAINMENT`, `TOYS_ENTERTAINMENT`, `BOARD_GAMES_ENTERTAINMENT`, `PUZZLES_ENTERTAINMENT`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(1, 'Owned', NULL, 'Parents', 'Concrete', NULL, NULL, NULL, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '2020-11-05 15:34:40', '2020-11-05 17:27:57', 1),
(2, 'Owned', 'Owned', 'Parents', 'Concrete', NULL, NULL, NULL, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020-11-05 17:09:01', '2020-11-10 17:34:37', 1),
(3, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-10 15:50:27', NULL, 1),
(4, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-10 17:31:30', NULL, 1),
(5, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-28 14:44:58', NULL, 1),
(6, 'Rent-free with Owner Consent', 'Rent-free with Owner Consent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-29 10:04:39', NULL, 1),
(7, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-04 09:08:06', NULL, 1),
(8, 'Owned', 'Owned', 'Non-Relatives', 'Concrete', NULL, NULL, NULL, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '2021-01-04 13:25:31', '2021-01-04 13:32:23', 1),
(9, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-10 12:47:57', NULL, 1),
(10, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-10 13:00:18', NULL, 1),
(11, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-10 13:53:45', NULL, 1),
(12, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 12:17:54', NULL, 1),
(13, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 12:18:31', NULL, 1),
(14, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 12:18:54', NULL, 1),
(15, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 12:19:09', NULL, 1),
(16, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 12:19:57', NULL, 1),
(17, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 13:03:14', NULL, 1),
(18, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 15:03:36', NULL, 1),
(19, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 10:17:16', NULL, 1),
(20, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 10:18:38', NULL, 1),
(21, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 10:20:34', NULL, 1),
(22, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 10:23:29', NULL, 1),
(23, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 13:08:54', NULL, 1),
(24, 'Owned', 'Owned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 14:01:38', NULL, 1),
(25, 'Owned', 'Owned', 'Parents', 'Concrete', NULL, NULL, NULL, 2, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-02-22 09:49:30', '2021-02-22 09:50:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_household_members`
--

CREATE TABLE `t_household_members` (
  `FAMILY_INFORMATION_ID` int(11) NOT NULL,
  `FAMILY_HEADER_ID` int(11) DEFAULT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_household_members`
--

INSERT INTO `t_household_members` (`FAMILY_INFORMATION_ID`, `FAMILY_HEADER_ID`, `RESIDENT_ID`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(1, 1, 1, '2020-11-05 07:34:40', NULL, 1),
(2, 2, 3, '2020-11-10 07:50:27', NULL, 1),
(3, 0, 4, NULL, NULL, 1),
(4, 3, 5, '2020-12-28 06:44:58', NULL, 1),
(5, 4, 8, '2021-01-04 05:25:31', NULL, 1),
(6, 5, 9, '2021-02-10 05:00:18', NULL, 1),
(7, 6, 10, '2021-02-10 05:53:45', NULL, 1),
(8, 7, 11, '2021-02-11 04:19:57', NULL, 1),
(9, 6, 12, NULL, NULL, 1),
(10, 8, 13, '2021-02-11 07:03:36', NULL, 1),
(11, 9, 17, '2021-02-22 01:49:30', NULL, 1),
(12, 9, 16, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_adolescent`
--

CREATE TABLE `t_hs_adolescent` (
  `ADOLESCENT_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `MMRTD_DATE` date DEFAULT NULL,
  `IS_REFERRED` int(11) DEFAULT NULL,
  `DATE_OF_VISIT` date DEFAULT NULL,
  `REMARKS` varchar(50) DEFAULT NULL,
  `CS_DIABETIC` int(11) DEFAULT NULL,
  `CS_MATAAS_PRESYON` int(11) DEFAULT NULL,
  `CS_CANCER` int(11) DEFAULT NULL,
  `CS_BUKOL` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_hs_adolescent`
--

INSERT INTO `t_hs_adolescent` (`ADOLESCENT_ID`, `RESIDENT_ID`, `MMRTD_DATE`, `IS_REFERRED`, `DATE_OF_VISIT`, `REMARKS`, `CS_DIABETIC`, `CS_MATAAS_PRESYON`, `CS_CANCER`, `CS_BUKOL`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`) VALUES
(1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-10 17:31:30', NULL, 1),
(2, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-10 13:00:18', NULL, 1),
(3, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-10 13:53:45', NULL, 1),
(4, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 12:19:57', NULL, 1),
(5, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 13:03:15', NULL, 1),
(6, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-11 15:03:36', NULL, 1),
(7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 10:23:29', NULL, 1),
(8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 14:01:38', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_child`
--

CREATE TABLE `t_hs_child` (
  `CHILD_ID` int(11) NOT NULL,
  `TYPE_OF_HOME_RECORD` varchar(100) DEFAULT NULL,
  `DANGERS_OBSERVED` varchar(25) DEFAULT NULL,
  `SOURCE_OF_SERVICE_RESERVED` varchar(100) DEFAULT NULL,
  `HAD_DEWORMING` int(11) DEFAULT NULL,
  `HAD_MMR_12_15_MO` int(11) DEFAULT NULL,
  `HAD_VITAMIN_A_12_59_MO` int(11) DEFAULT NULL,
  `OPT_DATE` date DEFAULT NULL,
  `OPT_WEIGHT` varchar(25) DEFAULT NULL,
  `OPT_HEIGHT` varchar(25) DEFAULT NULL,
  `GP_APRIL_DEWORMING` int(11) DEFAULT NULL,
  `GP_OCTOBER_DEWORMING` int(11) DEFAULT NULL,
  `DO_A` int(11) DEFAULT 0,
  `DO_B` int(11) DEFAULT 0,
  `DO_C` int(11) DEFAULT 0,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `INFANT_ID` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_chronic_cough`
--

CREATE TABLE `t_hs_chronic_cough` (
  `CHRONIC_COUGH_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `HAD_MORE_THAN_2_WEEKS` int(11) DEFAULT NULL,
  `DATE_OF_VISIT` datetime DEFAULT NULL,
  `REMARKS` varchar(500) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL,
  `NONRESIDENT_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_chronic_disease`
--

CREATE TABLE `t_hs_chronic_disease` (
  `CHRONIC_DISEASE_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `CHRONIC_DISEASE_NAME` varchar(100) DEFAULT NULL,
  `HAD_HIGH_FEVER` int(11) DEFAULT NULL,
  `DATE_OF_VISIT` datetime DEFAULT NULL,
  `REMARKS` varchar(50) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_elderly`
--

CREATE TABLE `t_hs_elderly` (
  `ELDERLY_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(10) DEFAULT NULL,
  `HAD_FLUE_VACCINE` int(11) DEFAULT 0,
  `HAD_PNEUMOCCOCAL` int(11) DEFAULT 0,
  `REMARKS` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_hs_elderly`
--

INSERT INTO `t_hs_elderly` (`ELDERLY_ID`, `RESIDENT_ID`, `HAD_FLUE_VACCINE`, `HAD_PNEUMOCCOCAL`, `REMARKS`, `CREATED_AT`, `UPDATED_AT`) VALUES
(1, 15, 0, 0, NULL, '2021-02-15 13:08:54', '2021-02-15 13:08:54'),
(2, 17, 0, 0, NULL, '2021-02-22 09:49:30', '2021-02-22 09:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_family_planning`
--

CREATE TABLE `t_hs_family_planning` (
  `FD_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `FP_METHOD` varchar(50) DEFAULT NULL,
  `FP_SOURCE` varchar(100) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_family_planning_users_visitations`
--

CREATE TABLE `t_hs_family_planning_users_visitations` (
  `VISITATION_ID` int(11) NOT NULL,
  `FP_ID` int(11) DEFAULT NULL,
  `VISITATION_DATE` date DEFAULT NULL,
  `VISITATION_REMARKS` varchar(255) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_infant`
--

CREATE TABLE `t_hs_infant` (
  `INFANT_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `NEW_BORN_ID` int(11) DEFAULT NULL,
  `TYPE_OF_HOME_RECORD` varchar(50) DEFAULT NULL,
  `OPT_DATE` date DEFAULT NULL,
  `OPT_WEIGHT` decimal(10,0) DEFAULT NULL,
  `OPT_HEIGHT` decimal(10,0) DEFAULT NULL,
  `GP_APRIL_VIT_A` int(11) DEFAULT NULL,
  `GP_OCTOBER_VIT_A` int(11) DEFAULT NULL,
  `DANGERS_OBSERVED` varchar(300) DEFAULT NULL,
  `SOURCE_OF_SERVICE_RECEIVED` varchar(100) DEFAULT NULL,
  `HAD_BREASTFEED` int(11) DEFAULT NULL,
  `HAD_PENTA_1` int(11) DEFAULT NULL,
  `HAD_PENTA_2` int(11) DEFAULT NULL,
  `HAD_PENTA_3` int(11) DEFAULT NULL,
  `HAD_OPV_1` int(11) DEFAULT NULL,
  `HAD_OPV_2` int(11) DEFAULT NULL,
  `HAD_OPV_3` int(11) DEFAULT NULL,
  `HAD_ROTA_1` int(11) DEFAULT NULL,
  `HAD_ROTA_2` int(11) DEFAULT NULL,
  `HAD_MEASLES` int(11) DEFAULT NULL,
  `HAD_VITAMIN_A` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL,
  `DO_A` tinyint(4) DEFAULT 0,
  `DO_B` tinyint(4) DEFAULT 0,
  `DO_C` tinyint(4) DEFAULT 0,
  `DO_D` tinyint(4) DEFAULT 0,
  `DO_E` tinyint(4) DEFAULT 0,
  `DO_F` tinyint(4) DEFAULT 0,
  `DO_G` tinyint(4) DEFAULT 0,
  `DO_H` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_newborn`
--

CREATE TABLE `t_hs_newborn` (
  `NEWBORN_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `TYPE_OF_HOME_RECORD` varchar(100) DEFAULT NULL,
  `BIRTH_WEIGHT` varchar(25) DEFAULT NULL,
  `BIRTH_LENGTH` varchar(25) DEFAULT NULL,
  `HAD_BCG` int(11) DEFAULT NULL,
  `HAD_HEPA_B` int(11) DEFAULT NULL,
  `HAD_NEWBORN_SCREENING` int(11) DEFAULT NULL,
  `HAD_BREASTFEED` int(11) DEFAULT NULL,
  `DANGERS_OBSERVED` varchar(25) DEFAULT NULL,
  `DO_A` tinyint(4) DEFAULT 0,
  `DO_B` tinyint(4) DEFAULT 0,
  `DO_C` tinyint(4) DEFAULT 0,
  `DO_D` tinyint(4) DEFAULT 0,
  `DO_E` tinyint(4) DEFAULT 0,
  `DO_F` tinyint(4) DEFAULT 0,
  `SOURCE_OF_SERVICE_RESERVED` varchar(100) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT 1,
  `NONRESIDENT_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_hs_newborn`
--

INSERT INTO `t_hs_newborn` (`NEWBORN_ID`, `RESIDENT_ID`, `TYPE_OF_HOME_RECORD`, `BIRTH_WEIGHT`, `BIRTH_LENGTH`, `HAD_BCG`, `HAD_HEPA_B`, `HAD_NEWBORN_SCREENING`, `HAD_BREASTFEED`, `DANGERS_OBSERVED`, `DO_A`, `DO_B`, `DO_C`, `DO_D`, `DO_E`, `DO_F`, `SOURCE_OF_SERVICE_RESERVED`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `NONRESIDENT_ID`) VALUES
(1, NULL, 'Immunization Card (ECCD)', '20', '90', 1, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 'Health Center', '2021-03-19 00:00:00', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_non_family_planning_users`
--

CREATE TABLE `t_hs_non_family_planning_users` (
  `NON_FP_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `IS_INTERESTED_IN_FP` int(11) DEFAULT NULL,
  `REASONS_NOT_USING` varchar(100) DEFAULT NULL,
  `DATE_OF_VISIT` date DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_post_partum`
--

CREATE TABLE `t_hs_post_partum` (
  `POST_PATRUM_ID` int(11) NOT NULL,
  `PREGNANT_ID` int(11) DEFAULT NULL,
  `BIRTH_PLACE` varchar(50) DEFAULT NULL,
  `BIRTH_COORDINATOR` varchar(50) DEFAULT NULL,
  `DANGERS_OBSERVED` varchar(50) DEFAULT NULL,
  `IS_FP_USER` int(11) DEFAULT NULL,
  `INTERESTED_IN_FP` int(11) DEFAULT NULL,
  `SOURCE_OF_SERVICE_RECEIVED` varchar(100) DEFAULT NULL,
  `BIRH_DATE` date DEFAULT NULL,
  `HAD_BREASTFEED_1_HR` int(11) DEFAULT NULL,
  `HAD_POSTNATAL_24_HRS` int(11) DEFAULT NULL,
  `HAD_POSTNATAL_72_HRS` int(11) DEFAULT NULL,
  `HAD_POSTNATAL_7_DAYS` int(11) DEFAULT NULL,
  `DO_A` int(11) DEFAULT NULL,
  `DO_B` int(11) DEFAULT NULL,
  `DO_C` int(11) DEFAULT NULL,
  `DO_D` int(11) DEFAULT NULL,
  `FERROUS_SULFATE` tinyint(255) DEFAULT NULL,
  `VITAMIN_A` varchar(255) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_pregnant`
--

CREATE TABLE `t_hs_pregnant` (
  `PREGNANT_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `NONRESIDENT_ID` int(11) DEFAULT NULL,
  `TYPE_OF_HOME_RECORD` varchar(100) DEFAULT NULL,
  `NUMBER_OF_MONTHS_PREGNANT` int(11) DEFAULT NULL,
  `HAD_BIRTH_PLAN` int(11) DEFAULT NULL,
  `BLOOD_TYPE` varchar(5) DEFAULT NULL,
  `DANGERS_OBSERVED` varchar(25) DEFAULT NULL,
  `DUE_DATE` date DEFAULT NULL,
  `PREGNANCY_CONCLUSION` varchar(100) DEFAULT NULL,
  `HAD_FERRO_SULFATE_FOLIC_ACID` int(11) DEFAULT NULL,
  `HAD_TETANOUS_TOXOID_1` int(11) DEFAULT NULL,
  `HAD_TETANOUS_TOXOID_2` int(11) DEFAULT NULL,
  `HAD_TETANOUS_TOXOID_3` int(11) DEFAULT NULL,
  `HAD_TETANOUS_TOXOID_4` int(11) DEFAULT NULL,
  `HAD_TETANOUS_TOXOID_5` int(11) DEFAULT NULL,
  `PRENATAL_CHECKUP_1TRI` int(11) DEFAULT NULL,
  `PRENATAL_CHECKUP_2TRI` int(11) DEFAULT NULL,
  `PRENATAL_CHECKUP_3TRI` int(11) DEFAULT NULL,
  `DO_A` tinyint(4) DEFAULT 0,
  `DO_B` tinyint(4) DEFAULT 0,
  `DO_C` tinyint(4) DEFAULT 0,
  `DO_D` tinyint(4) DEFAULT 0,
  `DO_E` tinyint(4) DEFAULT 0,
  `DO_F` tinyint(4) DEFAULT 0,
  `DO_G` tinyint(4) DEFAULT 0,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_hs_pwd`
--

CREATE TABLE `t_hs_pwd` (
  `PWD_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `DISABILITY` varchar(100) DEFAULT NULL,
  `DATE_OF_DEATH` date DEFAULT NULL,
  `REASON_OF_DEATH` varchar(100) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_issuance`
--

CREATE TABLE `t_issuance` (
  `ISSUANCE_ID` int(11) NOT NULL,
  `ISSUANCE_TYPE_ID` int(11) DEFAULT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `BUSINESS_ID` int(11) DEFAULT NULL,
  `ISSUANCE_PURPOSE` varchar(100) DEFAULT NULL,
  `ISSUANCE_DATE` date DEFAULT NULL,
  `ISSUANCE_NUMBER` varchar(50) DEFAULT NULL,
  `TIME_RECEIVED` datetime DEFAULT NULL,
  `RECEIVED_BY` varchar(255) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT NULL,
  `REMARKS` varchar(150) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT current_timestamp(),
  `ACTIVE_FLAG` int(11) DEFAULT NULL,
  `OR_NUMBER` varchar(50) DEFAULT NULL,
  `OR_AMOUNT` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_mothers_profile`
--

CREATE TABLE `t_mothers_profile` (
  `MOTHERS_ID` int(11) NOT NULL,
  `IS_PREGNANT` int(11) DEFAULT NULL,
  `MOTHER_MOTHER_TONGUE` varchar(25) DEFAULT NULL,
  `MOTHER_OTHER_DIALECTS` varchar(50) DEFAULT NULL,
  `MOTHER_EDUCATIONAL_ATTAINMENT` varchar(50) DEFAULT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ACTIVE_FLAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_nonresident_basic_info`
--

CREATE TABLE `t_nonresident_basic_info` (
  `NONRESIDENT_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(100) DEFAULT NULL,
  `MIDDLE_NAME` varchar(50) DEFAULT NULL,
  `LAST_NAME` varchar(50) DEFAULT NULL,
  `SEX` varchar(20) DEFAULT NULL,
  `BIRTHDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_nonresident_basic_info`
--

INSERT INTO `t_nonresident_basic_info` (`NONRESIDENT_ID`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `SEX`, `BIRTHDATE`) VALUES
(1, 'AYUMI', 'MORENO', 'GONZALES', 'Female', '2021-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `t_ordinance`
--

CREATE TABLE `t_ordinance` (
  `ORDINANCE_ID` int(11) NOT NULL,
  `BARANGAY_OFFICIAL_ID` int(11) DEFAULT NULL,
  `ORDINANCE_TITLE` varchar(50) DEFAULT NULL,
  `ORDINANCE_DESCRIPTION` varchar(100) DEFAULT NULL,
  `ORDINANCE_REMARKS` varchar(50) DEFAULT NULL,
  `ORDINANCE_SANCTION` varchar(50) DEFAULT NULL,
  `ORDINANCE_AUTHOR` varchar(50) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ACTIVE_FLAG` int(11) DEFAULT 1,
  `CATEGORY_ID` int(11) DEFAULT NULL,
  `ORDINANCE_TYPE` varchar(100) DEFAULT NULL,
  `ORDINANCE_NUMBER` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_ordinance`
--

INSERT INTO `t_ordinance` (`ORDINANCE_ID`, `BARANGAY_OFFICIAL_ID`, `ORDINANCE_TITLE`, `ORDINANCE_DESCRIPTION`, `ORDINANCE_REMARKS`, `ORDINANCE_SANCTION`, `ORDINANCE_AUTHOR`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `CATEGORY_ID`, `ORDINANCE_TYPE`, `ORDINANCE_NUMBER`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, '2021-03-19 14:00:23', NULL, 1, 5, 'ORDINANCE', NULL),
(2, 1, 'awas', 'aaa', 'aa', 'aaa', 'aa', '2021-03-19 14:00:45', '2021-03-25 15:06:01', 0, 8, 'ORDINANCE', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `t_ordinance_images`
--

CREATE TABLE `t_ordinance_images` (
  `ORDINANCE_IMAGE_ID` int(11) NOT NULL,
  `ORDINANCE_ID` int(11) NOT NULL,
  `FILE_NAME` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_patawag`
--

CREATE TABLE `t_patawag` (
  `PATAWAG_ID` int(10) UNSIGNED NOT NULL,
  `BLOTTER_ID` int(10) UNSIGNED NOT NULL,
  `PATAWAG_SCHED_DATETIME` datetime NOT NULL,
  `PATAWAG_SCHED_PLACE` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `STATUS` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `ACTIVE_FLAG` int(11) NOT NULL DEFAULT 1,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_patawag`
--

INSERT INTO `t_patawag` (`PATAWAG_ID`, `BLOTTER_ID`, `PATAWAG_SCHED_DATETIME`, `PATAWAG_SCHED_PLACE`, `STATUS`, `ACTIVE_FLAG`, `CREATED_AT`, `UPDATED_AT`) VALUES
(1, 1, '2021-02-03 09:00:00', 'TANGGAPAN NG LUPONG TAGAPAMAYAPA, BARANGAY HALL, TRINIDAD COR CECILIO STREETS, BARANGAY WAWA, TANAY, RIZAL', 'Settled', 1, NULL, NULL),
(2, 2, '2021-02-03 09:30:00', 'TANGGAPAN NG PUNONG TAGAPAMAYAPA, BARANGAY HALL, TRINIDAD CORNER CECILIO SANTOS STREETS, BARANGAY WAWA, TANAY, RIZAL', 'Settled', 1, NULL, NULL),
(3, 6, '2021-03-20 08:00:00', 'TANGGAPAN NG PUNONG TAGAPAMAYAPA, BARANGAY HALL, TRINIDAD CORNER CECILIO SANTOS STREETS, BARANGAY WAWA, TANAY, RIZAL', 'Pending', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_patient_records`
--

CREATE TABLE `t_patient_records` (
  `PATIENT_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) NOT NULL,
  `BODY_TEMPERATURE` double NOT NULL DEFAULT 0,
  `BLOOD_PRESSURE` varchar(50) NOT NULL DEFAULT '0',
  `PULSE_RATE` double NOT NULL DEFAULT 0,
  `RESPIRATORY_RATE` double NOT NULL DEFAULT 0,
  `WEIGHT` varchar(50) NOT NULL DEFAULT '0',
  `HEIGHT` varchar(50) NOT NULL DEFAULT '0',
  `CHECKUP_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `IS_PREGNANT` bit(1) NOT NULL DEFAULT b'0',
  `STATUS` varchar(50) NOT NULL DEFAULT 'PENDING',
  `LAST_MENSTRUAL_PERIOD` date DEFAULT NULL,
  `ESTIMATED_DATE_OF_CONCEPTION` date DEFAULT NULL,
  `ESTIMATED_DATE_OF_DELIVERY` date DEFAULT NULL,
  `CHIEF_COMPLAINT` varchar(400) NOT NULL,
  `DIAGNOSIS` varchar(400) NOT NULL,
  `MEDICATION_TREATMENT` varchar(400) NOT NULL,
  `HEALTH_INSURANCE` varchar(100) DEFAULT NULL,
  `DATE_OF_CHECKUP` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_patient_records`
--

INSERT INTO `t_patient_records` (`PATIENT_ID`, `RESIDENT_ID`, `BODY_TEMPERATURE`, `BLOOD_PRESSURE`, `PULSE_RATE`, `RESPIRATORY_RATE`, `WEIGHT`, `HEIGHT`, `CHECKUP_DATE`, `IS_PREGNANT`, `STATUS`, `LAST_MENSTRUAL_PERIOD`, `ESTIMATED_DATE_OF_CONCEPTION`, `ESTIMATED_DATE_OF_DELIVERY`, `CHIEF_COMPLAINT`, `DIAGNOSIS`, `MEDICATION_TREATMENT`, `HEALTH_INSURANCE`, `DATE_OF_CHECKUP`) VALUES
(1, 12, 36, '32', 2, 3, '23', '43', '2021-02-18 14:54:01', b'0', 'DONE', NULL, NULL, NULL, 'head ache', 'highblood', 'catapress', 'Philhealth Paying Member', '2021-03-19 08:24:22'),
(2, 14, 36, '110/120', 12, 12, '150', '150', '2021-03-19 15:28:17', b'0', 'PENDING', NULL, NULL, NULL, '', '', '', NULL, '2021-03-19 15:28:17'),
(3, 12, 36, '110/120', 125, 125, '150', '160', '2021-03-19 16:25:55', b'0', 'PENDING', NULL, NULL, NULL, '', '', '', NULL, '2021-03-19 16:25:55'),
(4, 4, 36, '110/120', 12, 12, '25', '120', '2021-03-19 16:35:23', b'0', 'PENDING', NULL, NULL, NULL, '', '', '', NULL, '2021-03-19 16:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `t_resident_basic_info`
--

CREATE TABLE `t_resident_basic_info` (
  `RESIDENT_ID` int(11) NOT NULL,
  `HOUSEHOLD_ID` int(11) DEFAULT NULL,
  `LASTNAME` varchar(50) DEFAULT NULL,
  `MIDDLENAME` varchar(50) DEFAULT NULL,
  `FIRSTNAME` varchar(50) DEFAULT NULL,
  `ADDRESS_UNIT_NO` varchar(50) DEFAULT NULL,
  `ADDRESS_PHASE` varchar(50) DEFAULT NULL,
  `ADDRESS_BLOCK_NO` varchar(50) DEFAULT NULL,
  `ADDRESS_HOUSE_NO` varchar(50) DEFAULT NULL,
  `ADDRESS_STREET_NO` varchar(50) DEFAULT NULL,
  `ADDRESS_STREET` varchar(50) DEFAULT NULL,
  `ADDRESS_SUBDIVISION` varchar(50) DEFAULT NULL,
  `ADDRESS_BUILDING` varchar(50) DEFAULT NULL,
  `QUALIFIER` varchar(25) DEFAULT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `PLACE_OF_BIRTH` varchar(50) DEFAULT NULL,
  `SEX` varchar(50) DEFAULT NULL,
  `CIVIL_STATUS` varchar(25) DEFAULT NULL,
  `IS_OFW` int(11) DEFAULT NULL,
  `OCCUPATION` varchar(50) DEFAULT NULL,
  `MONTHLY_INCOME` decimal(19,2) DEFAULT NULL,
  `INCOME_STATUS` varchar(50) DEFAULT NULL,
  `EMPLOYMENT_STATUS` varchar(50) DEFAULT NULL,
  `PLACE_OF_WORK` varchar(100) DEFAULT NULL,
  `DATE_STARTED_WORKING` date DEFAULT NULL,
  `CITIZENSHIP` varchar(25) DEFAULT NULL,
  `RELATION_TO_HOUSEHOLD_HEAD` varchar(50) DEFAULT NULL,
  `DATE_OF_ARRIVAL` date DEFAULT NULL,
  `ARRIVAL_STATUS` int(11) DEFAULT NULL,
  `IS_INDIGENOUS` int(11) DEFAULT NULL,
  `CONTACT_NUMBER` varchar(25) DEFAULT NULL,
  `TIN_NO` varchar(50) DEFAULT NULL,
  `SSS_NO` varchar(255) DEFAULT NULL,
  `GSIS_NO` int(11) DEFAULT NULL,
  `EMAIL_ADDRESS` varchar(255) DEFAULT NULL,
  `IS_REGISTERED_VOTER` int(11) DEFAULT NULL,
  `VOTING_PRECINCT` varchar(100) DEFAULT NULL,
  `PREVIOUS_RESIDENCE` varchar(100) DEFAULT NULL,
  `EDUCATIONAL_ATTAINMENT` varchar(255) DEFAULT NULL,
  `ENROLLMENT_STATUS` varchar(25) DEFAULT NULL,
  `SCHOOL_TYPE` varchar(50) DEFAULT NULL,
  `PERSONS STAYING IN THE HOUSHOLD` varchar(255) DEFAULT NULL,
  `FROM_WHAT_COUNTRY` varchar(255) DEFAULT NULL,
  `PLACE_OF_DELIVERY` varchar(255) DEFAULT NULL,
  `BIRTH_ATTENDANT` varchar(255) DEFAULT NULL,
  `IMMUNIZATION` varchar(100) DEFAULT NULL,
  `HEALTH_FACILITY_VISITED_LAST_SIX_MONTHS` varchar(255) DEFAULT NULL,
  `REASONFOR_VISIT` varchar(255) DEFAULT NULL,
  `DISABILITY` varchar(255) DEFAULT NULL,
  `SOLO_PARENT` varchar(50) DEFAULT NULL,
  `IS_REGISTERED_SENIOR_CITIZEN` tinyint(1) DEFAULT NULL,
  `PLACE_OF_SCHOOL` varchar(255) DEFAULT NULL,
  `RELIGION` varchar(255) DEFAULT NULL,
  `ETHNICITY` varchar(50) DEFAULT NULL,
  `TYPE_OF_DOCUMENT` varchar(255) DEFAULT NULL,
  `ISSUED_DATE` date DEFAULT NULL,
  `WHERE_DOCUMENT_ISSUED` varchar(255) CHARACTER SET latin7 DEFAULT NULL,
  `SKILLS_DEVELOPMENT_TRAINING` varchar(255) DEFAULT NULL,
  `IS_RBI_COMPLETE` int(11) DEFAULT 0,
  `IS_MIC_COMPLETE` int(11) DEFAULT 0,
  `PROFILE_PICTURE` varchar(255) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT current_timestamp(),
  `ACTIVE_FLAG` int(11) UNSIGNED DEFAULT 1,
  `LOT_OWNERSHIP` varchar(50) DEFAULT NULL,
  `BLK_LOT_PHASE` text DEFAULT NULL,
  `ADDRESS` text NOT NULL,
  `NATIONAL_ID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `t_resident_basic_info`
--

INSERT INTO `t_resident_basic_info` (`RESIDENT_ID`, `HOUSEHOLD_ID`, `LASTNAME`, `MIDDLENAME`, `FIRSTNAME`, `ADDRESS_UNIT_NO`, `ADDRESS_PHASE`, `ADDRESS_BLOCK_NO`, `ADDRESS_HOUSE_NO`, `ADDRESS_STREET_NO`, `ADDRESS_STREET`, `ADDRESS_SUBDIVISION`, `ADDRESS_BUILDING`, `QUALIFIER`, `DATE_OF_BIRTH`, `PLACE_OF_BIRTH`, `SEX`, `CIVIL_STATUS`, `IS_OFW`, `OCCUPATION`, `MONTHLY_INCOME`, `INCOME_STATUS`, `EMPLOYMENT_STATUS`, `PLACE_OF_WORK`, `DATE_STARTED_WORKING`, `CITIZENSHIP`, `RELATION_TO_HOUSEHOLD_HEAD`, `DATE_OF_ARRIVAL`, `ARRIVAL_STATUS`, `IS_INDIGENOUS`, `CONTACT_NUMBER`, `TIN_NO`, `SSS_NO`, `GSIS_NO`, `EMAIL_ADDRESS`, `IS_REGISTERED_VOTER`, `VOTING_PRECINCT`, `PREVIOUS_RESIDENCE`, `EDUCATIONAL_ATTAINMENT`, `ENROLLMENT_STATUS`, `SCHOOL_TYPE`, `PERSONS STAYING IN THE HOUSHOLD`, `FROM_WHAT_COUNTRY`, `PLACE_OF_DELIVERY`, `BIRTH_ATTENDANT`, `IMMUNIZATION`, `HEALTH_FACILITY_VISITED_LAST_SIX_MONTHS`, `REASONFOR_VISIT`, `DISABILITY`, `SOLO_PARENT`, `IS_REGISTERED_SENIOR_CITIZEN`, `PLACE_OF_SCHOOL`, `RELIGION`, `ETHNICITY`, `TYPE_OF_DOCUMENT`, `ISSUED_DATE`, `WHERE_DOCUMENT_ISSUED`, `SKILLS_DEVELOPMENT_TRAINING`, `IS_RBI_COMPLETE`, `IS_MIC_COMPLETE`, `PROFILE_PICTURE`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `LOT_OWNERSHIP`, `BLK_LOT_PHASE`, `ADDRESS`, `NATIONAL_ID`) VALUES
(1, 1, 'CATAMBAY', 'LLOSALA', 'GILBERT', NULL, NULL, NULL, '187', 'Manuel Peñaranda Street', 'NA', NULL, NULL, NULL, '1974-11-10', 'Tanay Rizal', 'Male', 'Single', NULL, 'Barangay Secretary', NULL, NULL, NULL, NULL, NULL, 'Filipino', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-11-05 15:34:40', '2020-11-05 15:34:40', 1, NULL, '', '', ''),
(2, 2, 'REYTA', 'CASAMINA', 'MHYLEN', NULL, NULL, NULL, '0', 'DOLORES  STREET', 'NA', NULL, NULL, NULL, '1983-01-17', 'tanay rizal', 'Female', 'Single', NULL, 'Barangay Staff', NULL, NULL, NULL, NULL, NULL, 'Filipino', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-11-05 17:09:01', '2020-11-05 17:57:17', 1, NULL, '', '', ''),
(3, 3, 'VIRAY', 'MENGORIO', 'ARTURO', NULL, NULL, NULL, '0', 'Manuel Peñaranda', 'Sitio Kabilang Ibayo', NULL, NULL, NULL, '1966-10-14', 'tANAY RIZAL', 'Male', 'Married', NULL, 'Punong Barangay', NULL, NULL, NULL, NULL, NULL, 'Filipino', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-11-10 15:50:27', '2020-11-10 15:51:36', 1, NULL, '', '', ''),
(4, 4, 'ALTOVEROS', 'REYTA', 'MATT GEIVRIEL', NULL, NULL, NULL, NULL, 'DOLORES STREET', NULL, NULL, NULL, 'NA', '2009-09-13', 'MORONG RIZAL', 'Male', 'Single', NULL, 'NA', NULL, NULL, NULL, NULL, NULL, 'FILIPINO', 'Daughter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-11-10 17:31:30', '2020-11-10 17:31:30', 1, NULL, '', '', ''),
(5, 5, 'MELGAR', 'GOMEZ', 'JOSEPH', NULL, NULL, NULL, '0', 'PASTOR G. SANTOS STREET', NULL, NULL, NULL, 'N/A', '1984-09-25', 'TANAY RIZAL', 'Male', 'Married', NULL, 'ELECTRICIAN', NULL, NULL, NULL, NULL, NULL, 'FILIPINO', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-12-28 14:44:58', '2020-12-28 14:44:58', 1, NULL, '', '', ''),
(6, 6, 'ROMERO', 'RAMON', 'URSUS', NULL, NULL, NULL, NULL, 'JOSE ABAD SANTOS STREET', NULL, NULL, NULL, 'N/A', '1972-09-19', 'tanay, rizal', 'Male', 'Married', NULL, 'unemployed', NULL, NULL, NULL, NULL, NULL, 'filipino', 'Spouse', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-12-29 10:04:39', '2020-12-29 10:04:39', 1, NULL, '', '', ''),
(7, 7, 'TALAMAYAN', 'EVANGELISTA', 'JOAN', NULL, NULL, NULL, '11', 'MANUEL RESURECCION STREET', NULL, NULL, NULL, 'NA', '1981-12-27', 'tanay rizal', 'Female', 'Married', NULL, 'businesswoman', NULL, NULL, NULL, NULL, NULL, 'filipino', 'Spouse', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2021-01-04 09:08:06', '2021-01-04 09:08:06', 1, NULL, '', '', ''),
(8, 8, 'SOLAIMAN', 'MALAWI', 'SAHARA', NULL, NULL, NULL, '45', 'JOSE ABAD SANTOS STREET', NULL, NULL, NULL, NULL, '1986-06-30', 'matungao lanao Del Norte', 'Female', 'Single', NULL, 'Vendor', NULL, NULL, NULL, NULL, NULL, 'Filipino', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2021-01-04 13:25:31', '2021-01-06 15:08:21', 1, NULL, '', '', ''),
(9, 10, 'JESUITAS', 'NE', 'CRISTINA', NULL, NULL, NULL, '123', 'area 2 oriole sstreet', 'barangay wawa tanay rizal', NULL, NULL, '', '1995-02-10', 'tanay rizal', 'Female', 'Single', NULL, 'none', NULL, NULL, NULL, NULL, NULL, 'filipino', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'cpj.JPG', '2021-02-10 13:00:18', '2021-02-10 13:00:18', 1, NULL, 'lot 10', '', ''),
(10, 11, 'JESUITAS', 'PINTACASI', 'CRISTINA', NULL, NULL, NULL, NULL, 'HOLY CROSS ROAD', 'SITIO BUKAL', NULL, NULL, '', '1969-09-26', 'TANAY RIZAL', 'Female', 'Married', NULL, 'GOVERNMENT EMPLOYEE', NULL, NULL, NULL, NULL, NULL, 'FILIPINO', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'cpj.JPG', '2021-02-10 13:53:45', '2021-02-10 13:53:45', 1, NULL, '', '', ''),
(11, 16, 'DENVER', 'AE', 'MARK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1997-06-17', 'TANAY RIZAL', 'Male', 'Separated', NULL, 'GOVERNMENT EMPLOYEE', NULL, NULL, NULL, NULL, NULL, 'filipino', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 'cpj.JPG', '2021-02-11 12:19:57', '2021-02-11 12:19:57', 1, NULL, NULL, 'Manuel Peñaranda Sitio Kabilang Ibayo barangay wawa tanay rizal', '11032-12-af-2'),
(12, 17, 'JESUITAS', 'PINTACASI', 'KRIS EVERT', NULL, NULL, NULL, 'Z02S001L001-00001', NULL, NULL, NULL, NULL, '', '1986-11-08', 'MORONG RIZAL', 'Female', 'Single', NULL, 'OFW', NULL, NULL, NULL, NULL, NULL, 'FILIPINO', 'Daughter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 'cpj.JPG', '2021-02-11 13:03:14', '2021-02-11 13:03:14', 1, NULL, NULL, 'HOLY CROSS ROAD, SITIO BUKAL, BARANGAY WAWA, TANAY, RIZAL', NULL),
(13, 18, 'JESUITAS', 'PINTACASI', 'MARK ARVIN', NULL, NULL, NULL, 'Z02S001L001-00002', NULL, NULL, NULL, NULL, '', '1988-10-31', 'MORONG RIZAL', 'Male', 'Single', NULL, 'DRIVER', NULL, NULL, NULL, NULL, NULL, 'FILIPINO', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '147313574_10219310146889238_2674385558656837329_n.jpg', '2021-02-11 15:03:36', '2021-02-11 15:03:36', 1, NULL, NULL, 'HOLY CROSS ROAD, SITIO BUKAL', NULL),
(14, 22, 'JESUITAS', 'FULGUERAS', 'VIRGILIO', NULL, NULL, NULL, 'Z02S001L001-00001', NULL, NULL, NULL, NULL, '', '1964-03-28', 'TANAY RIZAL', 'Male', 'Married', NULL, 'OFW', NULL, NULL, NULL, NULL, NULL, 'FILIPINO', 'Spouse', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '', '2021-02-15 10:23:29', '2021-02-15 10:23:29', 1, NULL, NULL, '79 I YUJUICO STREET, BARANGAY WAWA, TANAY, RIZAL', NULL),
(15, 23, 'PINTACASI', 'ALMEDA', 'REYNITA', NULL, NULL, NULL, 'Z01S001L002-00001', NULL, NULL, NULL, NULL, '', '1947-10-07', 'TANAY RIZAL', 'Female', 'Married', NULL, 'OFW', NULL, NULL, NULL, NULL, NULL, 'FILIPINO', 'Spouse', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '', '2021-02-15 13:08:54', '2021-02-15 13:08:54', 1, NULL, NULL, '79 I YUJUICO STREET, BARANGAY WAWA, TANAY, RIZAL', NULL),
(16, 24, 'CANDAZA', 'TONGOHAN', 'FUNDADOR', NULL, NULL, NULL, 'Z01S001L002-00002', NULL, NULL, NULL, NULL, '', '1981-06-26', 'TANAY RIZAL', 'Male', 'Single', NULL, 'GOVERNMENT EMPLOYEE', NULL, NULL, NULL, NULL, NULL, 'FILIPINO', 'Daughter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '', '2021-02-15 14:01:38', '2021-02-15 14:01:38', 1, NULL, NULL, '81 A bonifacio street, barangay wawa, tanay, rizal', NULL),
(17, 25, 'CANDAZA', 'CATUIRA', 'VIRGILIO', NULL, NULL, NULL, 'Z01S001L002-00003', NULL, NULL, NULL, NULL, '', '1956-08-01', 'TANAY RIZAL', 'Male', 'Married', NULL, 'SSS PENSIONER', NULL, NULL, NULL, NULL, NULL, 'FILIPINO', 'Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '', '2021-02-22 09:49:30', '2021-02-22 09:49:30', 1, NULL, NULL, '132 A BONIFACIO STREET, BARANGAY WAWA, TANAY, RIZAL', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_solo_parent_children`
--

CREATE TABLE `t_solo_parent_children` (
  `CHILD_ID` int(11) NOT NULL,
  `CHILD_NAME` varchar(250) DEFAULT NULL,
  `CHILD_AGE` varchar(50) DEFAULT NULL,
  `IS_PWD` varchar(4) DEFAULT NULL,
  `BARANGAY_CERTIFICATION_ID` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` tinyint(4) DEFAULT 1,
  `CHILD_NAME_2` varchar(250) DEFAULT ' ',
  `CHILD_AGE_2` varchar(50) DEFAULT ' ',
  `IS_PWD_2` varchar(4) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_transient_record`
--

CREATE TABLE `t_transient_record` (
  `TRANSIENT_RECORD_ID` int(11) NOT NULL,
  `RESIDENT_ID` int(11) DEFAULT NULL,
  `CITIZENSHIP_ACQUISITION` varchar(50) DEFAULT NULL,
  `NATURALIZED_DATE` date DEFAULT NULL,
  `CERTIFICATE_NO` varchar(50) DEFAULT NULL,
  `PERIOD_OF_STAY_START_DATE` date DEFAULT NULL,
  `PERIOD_OF_STAY_END_DATE` date DEFAULT NULL,
  `REASON_FOR_COMING` varchar(255) DEFAULT NULL,
  `CREATED_AT` date DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `ACTIVE_FLAG` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `USER_ID` int(11) NOT NULL,
  `BARANGAY_ID` int(11) DEFAULT NULL,
  `BARANGAY_OFFICIAL_ID` int(11) DEFAULT NULL,
  `POSITION_ID` int(11) DEFAULT NULL,
  `FIRSTNAME` varchar(25) DEFAULT NULL,
  `MIDDLENAME` varchar(25) DEFAULT NULL,
  `LASTNAME` varchar(25) DEFAULT NULL,
  `USERNAME` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `EMAIL_VERIFIED_AT` date DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `SECRET_QUESTION` varchar(100) DEFAULT NULL,
  `SECRET_ANSWER` varchar(100) DEFAULT NULL,
  `PERMIS_RESIDENT_BASIC_INFO` int(11) DEFAULT NULL,
  `PERMIS_FAMILY_PROFILE` int(11) DEFAULT NULL,
  `PERMIS_COMMUNITY_PROFILE` int(11) DEFAULT NULL,
  `PERMIS_BARANGAY_OFFICIAL` int(11) DEFAULT NULL,
  `PERMIS_BUSINESSES` int(11) DEFAULT NULL,
  `PERMIS_ISSUANCE_OF_FORMS` int(11) DEFAULT NULL,
  `PERMIS_ORDINANCES` int(11) DEFAULT NULL,
  `PERMIS_BLOTTER` int(11) DEFAULT NULL,
  `PERMIS_PATAWAG` int(11) DEFAULT NULL,
  `PERMIS_SYSTEM_REPORT` int(11) DEFAULT NULL,
  `PERMIS_HEALTH_SERVICES` int(11) DEFAULT NULL,
  `PERMIS_DATA_MIGRATION` int(11) DEFAULT NULL,
  `PERMIS_USER_ACCOUNTS` int(11) DEFAULT NULL,
  `PERMIS_BARANGAY_CONFIG` int(11) DEFAULT NULL,
  `PERMIS_APPLICATION_FORM` int(11) DEFAULT NULL,
  `PERMIS_APPLICATION_FORM_EVALUATION` int(11) DEFAULT NULL,
  `REMEMBER_TOKEN` varchar(50) DEFAULT NULL,
  `IS_FIRST_LOGGED_IN` tinyint(1) NOT NULL DEFAULT 1,
  `CREATED_AT` datetime DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ACTIVE_FLAG` int(11) DEFAULT NULL,
  `PERMIS_BUSINESS_APPROVAL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`USER_ID`, `BARANGAY_ID`, `BARANGAY_OFFICIAL_ID`, `POSITION_ID`, `FIRSTNAME`, `MIDDLENAME`, `LASTNAME`, `USERNAME`, `EMAIL`, `EMAIL_VERIFIED_AT`, `PASSWORD`, `SECRET_QUESTION`, `SECRET_ANSWER`, `PERMIS_RESIDENT_BASIC_INFO`, `PERMIS_FAMILY_PROFILE`, `PERMIS_COMMUNITY_PROFILE`, `PERMIS_BARANGAY_OFFICIAL`, `PERMIS_BUSINESSES`, `PERMIS_ISSUANCE_OF_FORMS`, `PERMIS_ORDINANCES`, `PERMIS_BLOTTER`, `PERMIS_PATAWAG`, `PERMIS_SYSTEM_REPORT`, `PERMIS_HEALTH_SERVICES`, `PERMIS_DATA_MIGRATION`, `PERMIS_USER_ACCOUNTS`, `PERMIS_BARANGAY_CONFIG`, `PERMIS_APPLICATION_FORM`, `PERMIS_APPLICATION_FORM_EVALUATION`, `REMEMBER_TOKEN`, `IS_FIRST_LOGGED_IN`, `CREATED_AT`, `UPDATED_AT`, `ACTIVE_FLAG`, `PERMIS_BUSINESS_APPROVAL`) VALUES
(1, 1, NULL, 6, NULL, NULL, NULL, 'admin', 'cristina.jesuitas@tanay.gov.ph', NULL, '$2y$10$IPa/qnXIYH0nyXdJpfJPn.wXj.zHyj8ShEg3gMiqeY5lSjKJ9oss6', 'What is your mother\'s maiden name?', 'almeda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 0, NULL, '2021-02-22 10:34:39', 1, NULL),
(2, 1, 1, 35, NULL, NULL, NULL, 'GILBERT.CATAMBAY', 'glcatambay08@gmail.com', NULL, '$2y$10$8Kl5R5GXtv7I9lAWSVHt0e05ZDe7y0bLyonqcXMas99HzvAHh8A.i', NULL, NULL, 1, 1, NULL, NULL, 1, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, NULL, 0, '2020-11-05 15:34:40', '2021-02-11 08:40:27', 1, 1),
(3, 1, 2, 36, NULL, NULL, NULL, 'MHYLEN.REYTA', 'mhylenreyta@gmail.com', NULL, '$2y$10$rFBIaZCDW/hhGg9TO5ikYuI8AgQQbkqlny8gReHBLzmIxp.Zf/ihm', NULL, NULL, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, 1, 1, NULL, 0, '2020-11-05 17:52:25', '2020-11-10 17:14:07', 1, 1),
(4, 1, 3, 37, NULL, NULL, NULL, 'ARTURO.VIRAY', 'virayarturo14@gmail.com', NULL, '$2y$10$rMjBhS106E2Qa9Pn3THF7.8KnAF.apW7eCf2kSuaLavY8UYssxB2O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-11-10 16:19:33', NULL, 1, NULL),
(5, 1, 4, 36, NULL, NULL, NULL, 'URSUS.ROMERO', 'cristina.jesuitas@gmail.com', NULL, '$2y$10$6TaoMV356HTI9En9UqRVHulfzdF.6Mbvr4Lbb6xltuAad7IRJwxHW', NULL, NULL, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, 1, 1, NULL, 0, '2021-02-09 13:57:21', '2021-02-22 10:38:48', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_weights_and_measure`
--

CREATE TABLE `t_weights_and_measure` (
  `WEIGHTS_AND_MEASURE_ID` int(11) NOT NULL,
  `BUSINESS_ID` int(11) DEFAULT NULL,
  `LICENSE_NO` varchar(255) DEFAULT NULL,
  `LICENSE_DATE` date DEFAULT NULL,
  `DEVICE_TYPE` varchar(255) DEFAULT NULL,
  `BRAND` varchar(255) DEFAULT NULL,
  `MODEL` varchar(255) DEFAULT NULL,
  `CAPACITY` varchar(255) DEFAULT NULL,
  `SERIAL_NO` varchar(255) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp(),
  `STATUS` varchar(255) DEFAULT NULL,
  `ACTIVE_FLAG` bit(1) DEFAULT b'1',
  `EVALUATED` bit(1) DEFAULT b'0',
  `NEW_RENEW_STATUS` varchar(255) DEFAULT 'New',
  `DEVICE_NUMBER` varchar(255) DEFAULT NULL,
  `DEACTIVATION_REASON` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_weights_and_measure`
--

INSERT INTO `t_weights_and_measure` (`WEIGHTS_AND_MEASURE_ID`, `BUSINESS_ID`, `LICENSE_NO`, `LICENSE_DATE`, `DEVICE_TYPE`, `BRAND`, `MODEL`, `CAPACITY`, `SERIAL_NO`, `CREATED_AT`, `STATUS`, `ACTIVE_FLAG`, `EVALUATED`, `NEW_RENEW_STATUS`, `DEVICE_NUMBER`, `DEACTIVATION_REASON`) VALUES
(5, 22, '213', '2021-06-24', '123', '123', '123', '50 kg', '123', '2021-06-15 18:28:00', 'Pending', b'0', b'1', 'New', NULL, NULL),
(6, 33, 'ASD-123', '2022-02-18', 'Test Device Type', 'Test Brand', 'Test Model', '100kg', '123-456', '2021-06-17 15:54:45', 'Pending', b'1', b'1', 'New', NULL, NULL),
(7, 33, 'ASD-456', '2022-02-18', 'Test Device Type 2', 'Test Brand 2', 'Test Model 2', '150kg', '789-012', '2021-06-17 15:54:45', 'Pending', b'1', b'1', 'New', NULL, NULL),
(8, 39, 'ASD-123', '2022-06-18', 'Test Device', 'Test Brand', 'Test Model', '150', 'ZXC-123', '2021-06-18 15:27:15', 'Pending', b'0', b'1', 'New', NULL, 'Test Deactivation'),
(9, 39, 'ASD-123', '2021-06-26', 'Test Device', 'Test Brand', 'Test Model', '100', 'ZXC-123', '2021-06-18 15:32:06', 'Pending', b'1', b'1', 'New', NULL, NULL),
(10, 14, '123', '2021-06-25', 'GS', '123', '123', '123', '123', '2021-06-27 09:04:53', NULL, b'1', b'0', 'New', NULL, NULL),
(11, 21, '123', '2021-07-07', 'LM', '123', '123', '123', '123', '2021-06-27 14:18:35', NULL, b'1', b'0', 'New', 'LM-06272021-00001', NULL),
(12, 21, '123', '2021-07-07', 'MC', '123', '123', '123', '123', '2021-06-27 14:18:35', NULL, b'1', b'0', 'New', 'MC-06272021-00001', NULL),
(13, 21, '123', '2021-07-03', 'LM', '123', '123', '123', '123', '2021-06-27 14:18:35', NULL, b'1', b'0', 'New', 'LM-06272021-00002', NULL),
(14, 21, '123', '2021-07-08', 'GS', '123', '123', '123', '123', '2021-06-27 14:18:35', NULL, b'1', b'0', 'New', 'GS-06272021-00002', NULL),
(15, 21, '123', '2021-07-01', 'GS', '123', '123', '123', '123', '2021-06-27 14:18:35', NULL, b'1', b'0', 'New', 'GS-06272021-00003', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_adminaccount`
-- (See below for the actual view)
--
CREATE TABLE `v_adminaccount` (
`USER_ID` int(11)
,`BARANGAY_ID` int(11)
,`FULL_NAME` varchar(76)
,`POSITION_NAME` varchar(50)
,`USERNAME` varchar(100)
,`PASSWORD` varchar(100)
,`EMAIL` varchar(50)
,`BARANGAY_NAME` varchar(255)
,`BARANGAY_SEAL` varchar(150)
,`ACTIVE_FLAG` int(11)
,`MUNICIPAL_SEAL` varchar(50)
,`MUNICIPAL_NAME` varchar(50)
,`PROVINCE_NAME` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_application_form_resident`
-- (See below for the actual view)
--
CREATE TABLE `v_application_form_resident` (
`updated_at` datetime
,`RESIDENT_ID` int(11)
,`RESIDENT_NAME` varchar(152)
,`SEX` varchar(50)
,`CIVIL_STATUS` varchar(25)
,`AGE` bigint(21)
,`DATE_OF_BIRTH` date
,`ADDRESS` text
,`STATUS` varchar(20)
,`FORM_ID` int(11)
,`REQUESTED_PAPER_TYPE` varchar(100)
,`FORM_PAPER_TYPE` varchar(100)
,`REQUESTED_PAPER_TYPE_ID` int(11)
,`PAPER_TYPE_ID` int(11)
,`CREATED_AT` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_approved_application_form`
-- (See below for the actual view)
--
CREATE TABLE `v_approved_application_form` (
`BUSINESS_ID` int(11)
,`BUSINESS_NAME` varchar(50)
,`TRADE_NAME` varchar(50)
,`BUSINESS_OWNER_FIRSTNAME` varchar(150)
,`BUSINESS_OWNER_MIDDLENAME` varchar(50)
,`BUSINESS_OWNER_LASTNAME` varchar(50)
,`BUSINESS_ADDRESS` varchar(310)
,`BUSINESS_OR_NUMBER` varchar(50)
,`BUSINESS_OR_ACQUIRED_DATE` date
,`TIN_NO` varchar(50)
,`DTI_REGISTRATION_NO` varchar(50)
,`BUSINESS_POSTAL_CODE` varchar(50)
,`BUSINESS_EMAIL_ADD` varchar(100)
,`BUSINESS_TELEPHONE_NO` varchar(50)
,`BUSINESS_AREA` varchar(50)
,`BUSINESS_NATURE_NAME` varchar(500)
,`BUSINESS_PERIOD_YEAR` bigint(21)
,`BUSINESS_PERIOD_MONTH` bigint(21)
,`STATUS` varchar(20)
,`FORM_ID` int(11)
,`REQUESTED_PAPER_TYPE` varchar(100)
,`FORM_PAPER_TYPE` varchar(100)
,`REQUESTED_PAPER_TYPE_ID` int(11)
,`PAPER_TYPE_ID` int(11)
,`FORM_NUMBER` varchar(50)
,`APPLICANT_NAME` varchar(250)
,`FORM_DATE` date
,`OPERATOR_NAME` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_approved_business`
-- (See below for the actual view)
--
CREATE TABLE `v_approved_business` (
`BUSINESS_ID` int(11)
,`BUSINESS_NAME` varchar(50)
,`TRADE_NAME` varchar(50)
,`BUSINESS_OWNER_FIRSTNAME` varchar(150)
,`BUSINESS_OWNER_MIDDLENAME` varchar(50)
,`BUSINESS_OWNER_LASTNAME` varchar(50)
,`BUSINESS_ADDRESS` varchar(310)
,`BUSINESS_OR_NUMBER` varchar(50)
,`BUSINESS_OR_ACQUIRED_DATE` date
,`TIN_NO` varchar(50)
,`DTI_REGISTRATION_NO` varchar(50)
,`BUSINESS_POSTAL_CODE` varchar(50)
,`BUSINESS_EMAIL_ADD` varchar(100)
,`BUSINESS_TELEPHONE_NO` varchar(50)
,`BUSINESS_AREA` varchar(50)
,`BUSINESS_NATURE_NAME` varchar(500)
,`BUSINESS_PERIOD_YEAR` bigint(21)
,`BUSINESS_PERIOD_MONTH` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_barangay_certificate`
-- (See below for the actual view)
--
CREATE TABLE `v_barangay_certificate` (
`place_destination` varchar(100)
,`destination_address` varchar(100)
,`travel_date` date
,`return_date` date
,`REQUESTOR_NAME` varchar(250)
,`SSS_NO` varchar(50)
,`CALAMITY_NAME` varchar(100)
,`CALAMITY_DATE` varchar(73)
,`COUNTRY` varchar(100)
,`CATEGORY_SINGLE_PARENT` varchar(100)
,`PURPOSE` varchar(500)
,`MAIDEN_NAME` varchar(50)
,`FORM_ID` int(11)
,`RESIDENT_NAME` varchar(152)
,`SEX` varchar(50)
,`PROFILE_PICTURE` varchar(255)
,`ADDRESS` text
,`SEX_ADDRESS` varchar(3)
,`CIVIL_STATUS` varchar(25)
,`AGE` int(6)
,`CONTROL_NO` varchar(100)
,`OR_NO` varchar(50)
,`OR_AMOUNT` varchar(50)
,`ISSUED_DATE` date
,`OR_DATE` date
,`REMARKS` varchar(500)
,`PAPER_TYPE_NAME` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_barangay_clearance`
-- (See below for the actual view)
--
CREATE TABLE `v_barangay_clearance` (
`remarks` varchar(500)
,`citizenship` varchar(25)
,`place_of_birth` varchar(50)
,`RESIDENT_ID` int(11)
,`fname` varchar(50)
,`Name_exp_6` varchar(1)
,`mname` varchar(50)
,`Name_exp_8` varchar(1)
,`lname` varchar(50)
,`SEX` varchar(50)
,`SEX_ADDRESS` varchar(3)
,`CIVIL_STATUS` varchar(25)
,`AGE` bigint(21)
,`DATE_OF_BIRTH` date
,`ADDRESS` varchar(310)
,`CONTROL_NO` varchar(100)
,`ISSUED_DATE` datetime
,`OR_NO` varchar(50)
,`OR_DATE` date
,`OR_AMOUNT` varchar(50)
,`PAPER_TYPE_NAME` varchar(100)
,`FORM_ID` int(11)
,`REQUESTOR_NAME` varchar(250)
,`SSS_NO` varchar(50)
,`CALAMITY_NAME` varchar(100)
,`CALAMITY_DATE` date
,`COUNTRY` varchar(100)
,`CATEGORY_SINGLE_PARENT` varchar(100)
,`PURPOSE` varchar(500)
,`CHILD_NAME` varchar(250)
,`CHILD_AGE` varchar(50)
,`IS_PWD` varchar(4)
,`CHILD_NAME_2` varchar(250)
,`CHILD_AGE_2` varchar(50)
,`IS_PWD_2` varchar(4)
,`BUSINESS_ID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_building_application`
-- (See below for the actual view)
--
CREATE TABLE `v_building_application` (
`FORM_ID` int(11)
,`RECEIVED_BY` varchar(250)
,`REQUESTED_PAPER_TYPE_ID` int(11)
,`STATUS` varchar(20)
,`APPLICANT_NAME` varchar(250)
,`CREATED_AT` datetime
,`BUILDING_ID` int(11)
,`BUILDING_NAME` varchar(100)
,`BUILDING_ID_NUMBER` varchar(100)
,`LOT_NUMBER` varchar(100)
,`BUILDING_OCCUPANCY` varchar(50)
,`LAND_USE` varchar(50)
,`SCOPE_OF_WORK` varchar(50)
,`PROJECT_TYPE` varchar(255)
,`PROJECT_LOCATION` varchar(100)
,`PROJECT_COST` decimal(10,0)
,`PROJECT_FLOOR_AREA` varchar(50)
,`PROJECT_LOT_AREA` varchar(50)
,`ENTERPRISE_NAME` varchar(100)
,`PAPER_TYPE_NAME` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_building_issuance`
-- (See below for the actual view)
--
CREATE TABLE `v_building_issuance` (
`FORM_ID` int(11)
,`BUILDING_ID` int(11)
,`REQUESTED_PAPER_TYPE_ID` int(11)
,`BUILDING_NAME` varchar(100)
,`BUILDING_ID_NUMBER` varchar(100)
,`BUILDING_OCCUPANCY` varchar(50)
,`LAND_USE` varchar(50)
,`SCOPE_OF_WORK` varchar(50)
,`LOT_NUMBER` varchar(100)
,`PROJECT_TYPE` varchar(255)
,`PROJECT_LOCATION` varchar(100)
,`PROJECT_COST` varchar(18)
,`PROJECT_FLOOR_AREA` varchar(50)
,`PROJECT_LOT_AREA` varchar(50)
,`APPLICANT_NAME` varchar(100)
,`ENTERPRISE_NAME` varchar(100)
,`PAPER_TYPE_ID` int(11)
,`REQUESTED_PAPER_TYPE` varchar(100)
,`PURPOSE` varchar(250)
,`PROJECT_LAND_USE` varchar(100)
,`CONTROL_NO` varchar(100)
,`ISSUED_DATE` datetime
,`OR_NO` varchar(50)
,`OR_DATE` datetime
,`OR_AMOUNT` varchar(50)
,`FORM_DATE` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_building_list`
-- (See below for the actual view)
--
CREATE TABLE `v_building_list` (
`BUILDING_ID` int(11)
,`BUILDING_NAME` varchar(100)
,`BUILDING_ID_NUMBER` varchar(100)
,`BUILDING_OCCUPANCY` varchar(50)
,`LAND_USE` varchar(50)
,`PROJECT_TYPE` varchar(255)
,`PROJECT_LOCATION` varchar(100)
,`PROJECT_COST` decimal(10,0)
,`PROJECT_FLOOR_AREA` varchar(50)
,`PROJECT_LOT_AREA` varchar(50)
,`APPLICANT_NAME` varchar(100)
,`APPLICANT_TELEPHONE_NO` varchar(25)
,`APPLICANT_MOBILE_NO` varchar(25)
,`APPLICANT_EMAIL` varchar(100)
,`POSTAL_CODE` varchar(25)
,`FORM_OWNERSHIP` varchar(50)
,`ENTERPRISE_NAME` varchar(100)
,`IS_REQUESTED` int(11)
,`LESSOR_NAME` varchar(50)
,`LESSOR_ADDRESS` varchar(100)
,`LESSOR_NO` varchar(25)
,`LESSOR_EMAIL` varchar(25)
,`MONTHLY_RENTAL` decimal(10,0)
,`APPLICANT_ADDRESS` varchar(100)
,`CREATED_AT` datetime
,`ACTIVE_FLAG` int(11)
,`LOT_NUMBER` varchar(100)
,`TRANSACTION_ID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_building_related`
-- (See below for the actual view)
--
CREATE TABLE `v_building_related` (
`FORM_ID` int(11)
,`BUILDING_ID` int(11)
,`BUILDING_NAME` varchar(100)
,`LOT_NUMBER` varchar(100)
,`BUILDING_ID_NUMBER` varchar(100)
,`LAND_USE` varchar(50)
,`SCOPE_OF_WORK` varchar(50)
,`PROJECT_TYPE` varchar(255)
,`PROJECT_LOCATION` varchar(100)
,`PROJECT_COST` varchar(18)
,`PROJECT_LOT_AREA` varchar(50)
,`PROJECT_FLOOR_AREA` varchar(50)
,`APPLICANT_MOBILE_NO` varchar(25)
,`APPLICANT_TELEPHONE_NO` varchar(25)
,`APPLICANT_EMAIL` varchar(100)
,`POSTAL_CODE` varchar(25)
,`FORM_OWNERSHIP` varchar(50)
,`ENTERPRISE_NAME` varchar(100)
,`LESSOR_NAME` varchar(50)
,`LESSOR_ADDRESS` varchar(100)
,`LESSOR_NO` varchar(25)
,`LESSOR_EMAIL` varchar(25)
,`MONTHLY_RENTAL` decimal(10,0)
,`APPLICANT_ADDRESS` varchar(100)
,`REGISTERED_NAME` varchar(150)
,`APPLICANT_NAME` varchar(250)
,`OWNER_NAME` varchar(100)
,`PROJECT_LAND_USE` varchar(100)
,`PURPOSE` varchar(250)
,`CONTROL_NO` varchar(100)
,`OR_NO` varchar(50)
,`OR_DATE` date
,`OR_AMOUNT` varchar(50)
,`TRANSACTION_ID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_building_transactions`
-- (See below for the actual view)
--
CREATE TABLE `v_building_transactions` (
`BUILDING_ID` int(11)
,`BUILDING_NAME` varchar(100)
,`BUILDING_ID_NUMBER` varchar(100)
,`BUILDING_OCCUPANCY` varchar(50)
,`LAND_USE` varchar(50)
,`PROJECT_TYPE` varchar(255)
,`PROJECT_LOCATION` varchar(100)
,`PROJECT_COST` decimal(10,0)
,`PROJECT_FLOOR_AREA` varchar(50)
,`PROJECT_LOT_AREA` varchar(50)
,`APPLICANT_NAME` varchar(100)
,`APPLICANT_TELEPHONE_NO` varchar(25)
,`APPLICANT_MOBILE_NO` varchar(25)
,`APPLICANT_EMAIL` varchar(100)
,`POSTAL_CODE` varchar(25)
,`FORM_OWNERSHIP` varchar(50)
,`ENTERPRISE_NAME` varchar(100)
,`STATUS` varchar(25)
,`T_STATUS` varchar(50)
,`IS_REQUESTED` int(11)
,`LESSOR_NAME` varchar(50)
,`LESSOR_ADDRESS` varchar(100)
,`LESSOR_NO` varchar(25)
,`LESSOR_EMAIL` varchar(25)
,`MONTHLY_RENTAL` decimal(10,0)
,`APPLICANT_ADDRESS` varchar(100)
,`CREATED_AT` datetime
,`ACTIVE_FLAG` int(11)
,`LOT_NUMBER` varchar(100)
,`IS_IMPROVEMENT` int(11)
,`SCOPE_OF_WORK` varchar(50)
,`TRANSACTION_ID` int(11)
,`T_IS_REQUESTED` int(11)
,`T_IS_IMPROVEMENT` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_business_activity`
-- (See below for the actual view)
--
CREATE TABLE `v_business_activity` (
`BUSINESS_ID` int(11)
,`GROSS_RECEIPTS_ESSENTIAL` varchar(50)
,`GROSS_RECEIPTS_NON_ESSENTIAL` varchar(50)
,`LINE_OF_BUSINESS_ID` int(11)
,`LINE_OF_BUSINESS_NAME` varchar(50)
,`BUSINESS_ACTIVITY_ID` int(11)
,`NO_OF_UNITS` varchar(50)
,`CAPITALIZATION` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_business_information`
-- (See below for the actual view)
--
CREATE TABLE `v_business_information` (
`BUSINESS_ID` int(11)
,`BUSINESS_NAME` varchar(50)
,`TRADE_NAME` varchar(50)
,`BUSINESS_OWNER` varchar(250)
,`BUSINESS_OWNER_FIRSTNAME` varchar(150)
,`BUSINESS_OWNER_MIDDLENAME` varchar(50)
,`BUSINESS_OWNER_LASTNAME` varchar(50)
,`BUSINESS_ADDRESS` varchar(301)
,`BUILDING_NAME` varchar(50)
,`BUILDING_NUMBER` varchar(50)
,`UNIT_NO` varchar(50)
,`STREET` varchar(50)
,`SITIO` varchar(50)
,`SUBDIVISION` varchar(50)
,`BUSINESS_OR_NUMBER` varchar(50)
,`BUSINESS_OR_ACQUIRED_DATE` date
,`BARANGAY_ZONE_ID` int(11)
,`TIN_NO` varchar(50)
,`DTI_REGISTRATION_NO` varchar(50)
,`TYPE_OF_BUSINESS` varchar(50)
,`BUSINESS_POSTAL_CODE` varchar(50)
,`BUSINESS_EMAIL_ADD` varchar(100)
,`BUSINESS_TELEPHONE_NO` varchar(50)
,`BUSINESS_MOBILE_NO` varchar(50)
,`OWNER_ADDRESS` varchar(150)
,`OWNER_POSTAL_CODE` varchar(50)
,`OWNER_EMAIL_ADD` varchar(100)
,`OWNER_TELEPHONE_NO` varchar(50)
,`OWNER_MOBILE_NO` varchar(50)
,`EMERGENCY_CONTACT_PERSON` varchar(150)
,`EMERGENCY_PERSON_CONTACT_NO` varchar(50)
,`EMERGENCY_PERSON_EMAIL_ADD` varchar(50)
,`BUSINESS_AREA` varchar(50)
,`NO_EMPLOYEE_ESTABLISHMENT` int(11)
,`NO_EMPLOYEE_LGU` int(11)
,`LESSOR_NAME` varchar(150)
,`LESSOR_ADDRESS` varchar(150)
,`LESSOR_POSTAL` varchar(50)
,`LESSOR_CONTACT_NO` varchar(50)
,`LESSOR_TELEPHONE` varchar(50)
,`LESSOR_MOBILE_NO` varchar(50)
,`LESSOR_EMAIL_ADD` varchar(100)
,`MONTHLY_RENTAL` varchar(50)
,`REFERENCED_BUSINESS_ID` int(11)
,`NO_OF_UNITS` varchar(50)
,`STATUS` varchar(50)
,`NEW_RENEW_STATUS` varchar(50)
,`CAPITALIZATION` varchar(50)
,`GROSS_RECEIPTS_ESSENTIAL` varchar(50)
,`GROSS_RECEIPTS_NON_ESSENTIAL` varchar(50)
,`BUSINESS_NATURE_NAME` varchar(500)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_business_nature`
-- (See below for the actual view)
--
CREATE TABLE `v_business_nature` (
`BUSINESS_NATURE_ID` int(11)
,`BUSINESS_NATURE_NAME` varchar(500)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_business_permit`
-- (See below for the actual view)
--
CREATE TABLE `v_business_permit` (
`BUSINESS_NAME` varchar(50)
,`BUSINESS_ADDRESS` varchar(255)
,`BUSINESS_NATURE_NAME` varchar(50)
,`TAX_YEAR` varchar(50)
,`QUARTER` varchar(50)
,`OR_NO` varchar(50)
,`OR_AMOUNT` varchar(50)
,`OR_DATE` date
,`BARANGAY_PERMIT` varchar(50)
,`BUSINESS_TAX` varchar(50)
,`GARBAGE_FEE` varchar(50)
,`SIGNBOARD` varchar(50)
,`CTC` varchar(50)
,`FORM_ID` int(11)
,`CONTROL_NO` varchar(100)
,`ISSUED_DATE` date
,`BUSINESS_OR_NUMBER` varchar(50)
,`PLATE_NO` varchar(50)
,`STICKER` varchar(50)
,`PLATE_FEE` varchar(50)
,`TOTAL_AMOUNT` double
,`BUSINESS_ID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_declined_application_form`
-- (See below for the actual view)
--
CREATE TABLE `v_declined_application_form` (
`BUSINESS_ID` int(11)
,`BUSINESS_NAME` varchar(50)
,`TRADE_NAME` varchar(50)
,`BUSINESS_OWNER_FIRSTNAME` varchar(150)
,`BUSINESS_OWNER_MIDDLENAME` varchar(50)
,`BUSINESS_OWNER_LASTNAME` varchar(50)
,`BUSINESS_ADDRESS` varchar(310)
,`BUSINESS_OR_NUMBER` varchar(50)
,`BUSINESS_OR_ACQUIRED_DATE` date
,`TIN_NO` varchar(50)
,`DTI_REGISTRATION_NO` varchar(50)
,`BUSINESS_POSTAL_CODE` varchar(50)
,`BUSINESS_EMAIL_ADD` varchar(100)
,`BUSINESS_TELEPHONE_NO` varchar(50)
,`BUSINESS_AREA` varchar(50)
,`BUSINESS_NATURE_NAME` varchar(500)
,`BUSINESS_PERIOD_YEAR` bigint(21)
,`BUSINESS_PERIOD_MONTH` bigint(21)
,`STATUS` varchar(20)
,`FORM_ID` int(11)
,`REQUESTED_PAPER_TYPE` varchar(100)
,`FORM_PAPER_TYPE` varchar(100)
,`REQUESTED_PAPER_TYPE_ID` int(11)
,`PAPER_TYPE_ID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_declined_business`
-- (See below for the actual view)
--
CREATE TABLE `v_declined_business` (
`BUSINESS_ID` int(11)
,`BUSINESS_NAME` varchar(50)
,`TRADE_NAME` varchar(50)
,`BUSINESS_OWNER_FIRSTNAME` varchar(150)
,`BUSINESS_OWNER_MIDDLENAME` varchar(50)
,`BUSINESS_OWNER_LASTNAME` varchar(50)
,`BUSINESS_ADDRESS` varchar(310)
,`BUSINESS_OR_NUMBER` varchar(50)
,`BUSINESS_OR_ACQUIRED_DATE` date
,`TIN_NO` varchar(50)
,`DTI_REGISTRATION_NO` varchar(50)
,`BUSINESS_POSTAL_CODE` varchar(50)
,`BUSINESS_EMAIL_ADD` varchar(100)
,`BUSINESS_TELEPHONE_NO` varchar(50)
,`BUSINESS_NATURE_NAME` varchar(500)
,`BUSINESS_PERIOD_YEAR` bigint(21)
,`BUSINESS_PERIOD_MONTH` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_dpoaccount`
-- (See below for the actual view)
--
CREATE TABLE `v_dpoaccount` (
`USER_ID` int(11)
,`BARANGAY_ID` int(11)
,`DPO_Name` varchar(76)
,`POSITION_NAME` varchar(50)
,`USERNAME` varchar(100)
,`PASSWORD` varchar(100)
,`EMAIL` varchar(50)
,`BARANGAY_NAME` varchar(255)
,`BARANGAY_SEAL` varchar(150)
,`ACTIVE_FLAG` int(11)
,`PERMIS_BARANGAY_CONFIG` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_filter_residents`
-- (See below for the actual view)
--
CREATE TABLE `v_filter_residents` (
`LASTNAME` varchar(50)
,`FIRSTNAME` varchar(50)
,`MIDDLENAME` varchar(50)
,`ADDRESS` text
,`DATE_OF_BIRTH` varchar(10)
,`PLACE_OF_BIRTH` varchar(50)
,`SEX` varchar(50)
,`CIVIL_STATUS` varchar(25)
,`IS_OFW` varchar(1)
,`OCCUPATION` varchar(50)
,`OCCUPATION2` varchar(50)
,`DATE_STARTED_WORKING` varchar(10)
,`CITIZENSHIP` varchar(25)
,`RELATION_TO_HOUSEHOLD_HEAD` varchar(50)
,`DATE_OF_ARRIVAL` varchar(10)
,`TYPE_NAME` varchar(50)
,`IS_INDIGENOUS` varchar(1)
,`CONTACT_NUMBER` varchar(25)
,`EDUCATIONAL_ATTAINMENT` varchar(255)
,`HOME_OWNERSHIP` varchar(50)
,`PERSON_STAYING_IN_HOUSEHOLD` varchar(50)
,`HOME_MATERIALS` varchar(10)
,`NUMBER_OF_ROOMS` varchar(11)
,`TOILET_HOME` varchar(1)
,`PLAY_AREA_HOME` varchar(1)
,`BEDROOM_HOME` varchar(1)
,`DINING_ROOM_HOME` varchar(1)
,`SALA_HOME` varchar(1)
,`KITCHEN_HOME` varchar(1)
,`WATER_UTILITIES` varchar(1)
,`ELECTRICITY_UTILITIES` varchar(1)
,`AIRCON_UTILITIES` varchar(1)
,`PHONE_UTILITIES` varchar(1)
,`COMPUTER_UTILITIES` varchar(1)
,`INTERNET_UTILITIES` varchar(1)
,`TV_UTILITIES` varchar(1)
,`CD_PLAYER_UTILITIES` varchar(1)
,`RADIO_UTILITIES` varchar(1)
,`COMICS_ENTERTAINMENT` varchar(1)
,`NEWS_PAPER_ENTERTAINMENT` varchar(1)
,`PETS_ENTERTAINMENT` varchar(1)
,`BOOKS_ENTERTAINMENT` varchar(1)
,`STORY_BOOKS_ENTERTAINMENT` varchar(1)
,`TOYS_ENTERTAINMENT` varchar(1)
,`BOARD_GAMES_ENTERTAINMENT` varchar(1)
,`PUZZLES_ENTERTAINMENT` varchar(1)
,`HOUSEHOLD_ID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_for_business_clearances`
-- (See below for the actual view)
--
CREATE TABLE `v_for_business_clearances` (
`remarks` varchar(500)
,`CONTROL_NO` varchar(100)
,`ISSUED_DATE` datetime
,`OR_NO` varchar(50)
,`OR_DATE` date
,`OR_AMOUNT` varchar(50)
,`PAPER_TYPE_NAME` varchar(100)
,`FORM_ID` int(11)
,`REQUESTOR_NAME` varchar(250)
,`PURPOSE` varchar(500)
,`BUSINESS_ID` int(11)
,`BUSINESS_ADDRESS` varchar(255)
,`BUSINESS_OWNER` varchar(253)
,`BUSINESS_NAME` varchar(50)
,`BUSINESS_NATURE_NAME` varchar(500)
,`PROJECT_LOCATION` varchar(250)
,`APPLICANT_NAME` varchar(250)
,`D_DRIVER_LICENSE_NO` varchar(50)
,`D_MUDGUARD_NO` varchar(50)
,`D_CR_NO` varchar(50)
,`D_OR_NO` varchar(50)
,`D_OR_DATE` date
,`OPERATOR_NAME` varchar(250)
,`SCOPE_OF_WORK_NAME` varchar(50)
,`MAKE` varchar(50)
,`PLATE_NO` varchar(50)
,`DTI_NO_DATE` date
,`BUSINESS_OR_NUMBER` varchar(50)
,`OWNER_ADDRESS` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_generatectrno`
-- (See below for the actual view)
--
CREATE TABLE `v_generatectrno` (
`CTR_NO` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_get_deregatory`
-- (See below for the actual view)
--
CREATE TABLE `v_get_deregatory` (
`RESIDENT_ID` int(11)
,`BLOTTER_ID` int(10) unsigned
,`BLOTTER_CODE` varchar(50)
,`BLOTTER_SUBJECT` varchar(255)
,`INCIDENT_DATE` date
,`INCIDENT_AREA` text
,`COMPLAINT_NAME` varchar(50)
,`COMPLAINT_STATEMENT` varchar(1000)
,`RESPONDENT` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_get_gross`
-- (See below for the actual view)
--
CREATE TABLE `v_get_gross` (
`BUSINESS_ID` int(11)
,`GROSS_TOTAL` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_household_information`
-- (See below for the actual view)
--
CREATE TABLE `v_household_information` (
`HOUSEHOLD_ID` int(11)
,`FULLNAME` varchar(152)
,`HOME_OWNERSHIP` varchar(50)
,`PERSON_STAYING_IN_HOUSEHOLD` varchar(50)
,`HOME_MATERIALS` varchar(10)
,`LASTNAME` varchar(50)
,`FIRSTNAME` varchar(50)
,`MIDDLENAME` varchar(50)
,`TOILET_HOME` int(11)
,`PLAY_AREA_HOME` int(11)
,`BEDROOM_HOME` int(11)
,`DINING_ROOM_HOME` int(11)
,`SALA_HOME` int(11)
,`KITCHEN_HOME` int(11)
,`WATER_UTILITIES` int(11)
,`ELECTRICITY_UTILITIES` int(11)
,`AIRCON_UTILITIES` int(11)
,`PHONE_UTILITIES` int(11)
,`COMPUTER_UTILITIES` int(11)
,`INTERNET_UTILITIES` int(11)
,`TV_UTILITIES` int(11)
,`CD_PLAYER_UTILITIES` int(11)
,`RADIO_UTILITIES` int(11)
,`COMICS_ENTERTAINMENT` int(11)
,`NEWS_PAPER_ENTERTAINMENT` int(11)
,`PETS_ENTERTAINMENT` int(11)
,`BOOKS_ENTERTAINMENT` int(11)
,`STORY_BOOKS_ENTERTAINMENT` int(11)
,`TOYS_ENTERTAINMENT` int(11)
,`BOARD_GAMES_ENTERTAINMENT` int(11)
,`PUZZLES_ENTERTAINMENT` int(11)
,`NUMBER_OF_ROOMS` int(11)
,`FAMILY_HEADER_ID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_line_of_business`
-- (See below for the actual view)
--
CREATE TABLE `v_line_of_business` (
`LINE_OF_BUSINESS_ID` int(11)
,`LINE_OF_BUSINESS_NAME` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_official_business_list`
-- (See below for the actual view)
--
CREATE TABLE `v_official_business_list` (
`BUSINESS_ID` int(11)
,`BUSINESS_NAME` varchar(50)
,`TRADE_NAME` varchar(50)
,`BUSINESS_OWNER_FIRSTNAME` varchar(150)
,`BUSINESS_OWNER_MIDDLENAME` varchar(50)
,`BUSINESS_OWNER_LASTNAME` varchar(50)
,`BUSINESS_ADDRESS` varchar(255)
,`BUSINESS_OR_NUMBER` varchar(50)
,`BUSINESS_OR_ACQUIRED_DATE` date
,`TIN_NO` varchar(50)
,`DTI_REGISTRATION_NO` varchar(50)
,`BUSINESS_POSTAL_CODE` varchar(50)
,`BUSINESS_EMAIL_ADD` varchar(100)
,`BUSINESS_TELEPHONE_NO` varchar(50)
,`BUSINESS_AREA` varchar(50)
,`BUSINESS_PERIOD_YEAR` bigint(21)
,`BUSINESS_PERIOD_MONTH` bigint(21)
,`BUSINESS_NATURE_NAME` varchar(50)
,`LINE_OF_BUSINESS_ID` int(11)
,`STATUS` varchar(50)
,`NEW_RENEW_STATUS` varchar(50)
,`REFERENCED_BUSINESS_ID` int(11)
,`EVALUATED` int(1)
,`CREATED_AT` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_paper_type`
-- (See below for the actual view)
--
CREATE TABLE `v_paper_type` (
`PAPER_TYPE_ID` int(11)
,`PAPER_TYPE_NAME` varchar(100)
,`PAPER_TYPE_CATEGORY` varchar(100)
,`PAPER_TYPE_DECRIPTION` varchar(250)
,`CREATED_AT` datetime
,`UPDATED_AT` datetime
,`ACTIVE_FLAG` tinyint(4)
,`PAPER_TYPE_CODE` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pending_application_form`
-- (See below for the actual view)
--
CREATE TABLE `v_pending_application_form` (
`BUSINESS_ID` int(11)
,`BUSINESS_NAME` varchar(50)
,`TRADE_NAME` varchar(50)
,`BUSINESS_OWNER_FIRSTNAME` varchar(150)
,`BUSINESS_OWNER_MIDDLENAME` varchar(50)
,`BUSINESS_OWNER_LASTNAME` varchar(50)
,`BUSINESS_ADDRESS` varchar(255)
,`BUSINESS_OR_NUMBER` varchar(50)
,`BUSINESS_OR_ACQUIRED_DATE` date
,`TIN_NO` varchar(50)
,`DTI_REGISTRATION_NO` varchar(50)
,`BUSINESS_POSTAL_CODE` varchar(50)
,`BUSINESS_EMAIL_ADD` varchar(100)
,`BUSINESS_TELEPHONE_NO` varchar(50)
,`BUSINESS_AREA` varchar(50)
,`BUSINESS_PERIOD_YEAR` bigint(21)
,`BUSINESS_PERIOD_MONTH` bigint(21)
,`STATUS` varchar(20)
,`FORM_ID` int(11)
,`FORM_NUMBER` varchar(50)
,`APPLICANT_NAME` varchar(250)
,`REQUESTED_PAPER_TYPE` varchar(100)
,`FORM_PAPER_TYPE` varchar(100)
,`REQUESTED_DATE` datetime
,`REQUESTED_PAPER_TYPE_ID` int(11)
,`PAPER_TYPE_ID` int(11)
,`FORM_DATE` date
,`BUSINESS_NATURE_NAME` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_permit_line_of_business`
-- (See below for the actual view)
--
CREATE TABLE `v_permit_line_of_business` (
`BUSINESS_ID` int(11)
,`LINE_OF_BUSINESS_NAME` varchar(500)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_qualified_for_permit`
-- (See below for the actual view)
--
CREATE TABLE `v_qualified_for_permit` (
`BUSINESS_ID` int(11)
,`BUSINESS_NAME` varchar(50)
,`TRADE_NAME` varchar(50)
,`BUSINESS_OWNER_FIRSTNAME` varchar(150)
,`BUSINESS_OWNER_MIDDLENAME` varchar(50)
,`BUSINESS_OWNER_LASTNAME` varchar(50)
,`BUSINESS_ADDRESS` varchar(255)
,`BUSINESS_OR_NUMBER` varchar(50)
,`BUSINESS_OR_ACQUIRED_DATE` date
,`TIN_NO` varchar(50)
,`DTI_REGISTRATION_NO` varchar(50)
,`BUSINESS_POSTAL_CODE` varchar(50)
,`BUSINESS_EMAIL_ADD` varchar(100)
,`BUSINESS_TELEPHONE_NO` varchar(50)
,`BUSINESS_AREA` varchar(50)
,`BUSINESS_PERIOD_YEAR` bigint(21)
,`BUSINESS_PERIOD_MONTH` bigint(21)
,`BUSINESS_NATURE_NAME` varchar(50)
,`LINE_OF_BUSINESS_ID` int(11)
,`STATUS` varchar(50)
,`NEW_RENEW_STATUS` varchar(50)
,`REFERENCED_BUSINESS_ID` int(11)
,`EVALUATED` int(1)
,`GROSS_TOTAL` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_realbarangayofficialsaccount`
-- (See below for the actual view)
--
CREATE TABLE `v_realbarangayofficialsaccount` (
`BARANGAY_OFFICIAL_ID` int(11)
,`BARANGAY_ID` int(11)
,`USER_ID` int(11)
,`FULLNAME` varchar(152)
,`USERNAME` varchar(100)
,`PASSWORD` varchar(100)
,`BARANGAY_NAME` varchar(255)
,`POSITION_NAME` varchar(50)
,`EMAIL` varchar(50)
,`START_TERM` date
,`END_TERM` date
,`PERMIS_RESIDENT_BASIC_INFO` int(11)
,`PERMIS_FAMILY_PROFILE` int(11)
,`PERMIS_COMMUNITY_PROFILE` int(11)
,`PERMIS_BLOTTER` int(11)
,`PERMIS_PATAWAG` int(11)
,`PERMIS_BARANGAY_OFFICIAL` int(11)
,`PERMIS_BUSINESSES` int(11)
,`PERMIS_ISSUANCE_OF_FORMS` int(11)
,`PERMIS_ORDINANCES` int(11)
,`PERMIS_SYSTEM_REPORT` int(11)
,`PERMIS_HEALTH_SERVICES` int(11)
,`PERMIS_DATA_MIGRATION` int(11)
,`PERMIS_USER_ACCOUNTS` int(11)
,`PERMIS_BARANGAY_CONFIG` int(11)
,`PERMIS_BUSINESS_APPROVAL` int(11)
,`PERMIS_APPLICATION_FORM` int(11)
,`PERMIS_APPLICATION_FORM_EVALUATION` int(11)
,`ACTIVE_FLAG` int(11)
,`BARANGAY_SEAL` varchar(150)
,`MUNICIPAL_SEAL` varchar(50)
,`MUNICIPAL_NAME` varchar(50)
,`PROVINCE_NAME` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_resident`
-- (See below for the actual view)
--
CREATE TABLE `v_resident` (
`RESIDENT_ID` int(11)
,`RESIDENT_NAME` varchar(152)
,`ADDRESS` text
,`AGE` bigint(21)
,`SEX` varchar(50)
,`IS_OFW` int(11)
,`CIVIL_STATUS` varchar(25)
,`FIRSTNAME` varchar(50)
,`MIDDLENAME` varchar(50)
,`LASTNAME` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_useraccounts`
-- (See below for the actual view)
--
CREATE TABLE `v_useraccounts` (
`BARANGAY_OFFICIAL_ID` int(11)
,`POSITION_NAME` varchar(50)
,`BARANGAY_NAME` varchar(255)
,`LASTNAME` varchar(25)
,`FIRSTNAME` varchar(25)
,`MIDDLENAME` varchar(25)
,`USERNAME` varchar(100)
,`PASSWORD` varchar(100)
,`ACTIVE_FLAG` int(11)
,`IS_FIRST_LOGGED_IN` tinyint(1)
,`USER_ID` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_adminaccount`
--
DROP TABLE IF EXISTS `v_adminaccount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_adminaccount`  AS SELECT `u`.`USER_ID` AS `USER_ID`, `bs`.`BARANGAY_ID` AS `BARANGAY_ID`, concat(`u`.`FIRSTNAME`,' ',`u`.`MIDDLENAME`,`u`.`LASTNAME`) AS `FULL_NAME`, `p`.`POSITION_NAME` AS `POSITION_NAME`, `u`.`USERNAME` AS `USERNAME`, `u`.`PASSWORD` AS `PASSWORD`, `u`.`EMAIL` AS `EMAIL`, `bs`.`BARANGAY_NAME` AS `BARANGAY_NAME`, `bs`.`BARANGAY_SEAL` AS `BARANGAY_SEAL`, `bs`.`ACTIVE_FLAG` AS `ACTIVE_FLAG`, `mi`.`MUNICIPAL_SEAL` AS `MUNICIPAL_SEAL`, `mi`.`MUNICIPAL_NAME` AS `MUNICIPAL_NAME`, `mi`.`PROVINCE_NAME` AS `PROVINCE_NAME` FROM (((`t_users` `u` join `r_barangay_information` `bs` on(`u`.`BARANGAY_ID` = `bs`.`BARANGAY_ID`)) join `r_position` `p` on(`p`.`POSITION_ID` = `u`.`POSITION_ID`)) join `r_municipal_information` `mi` on(`mi`.`MUNICIPAL_ID` = `bs`.`MUNICIPAL_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_application_form_resident`
--
DROP TABLE IF EXISTS `v_application_form_resident`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_application_form_resident`  AS SELECT `af`.`UPDATED_AT` AS `updated_at`, `resident`.`RESIDENT_ID` AS `RESIDENT_ID`, concat(ifnull(`resident`.`FIRSTNAME`,''),' ',ifnull(`resident`.`MIDDLENAME`,''),' ',ifnull(`resident`.`LASTNAME`,'')) AS `RESIDENT_NAME`, `resident`.`SEX` AS `SEX`, `resident`.`CIVIL_STATUS` AS `CIVIL_STATUS`, timestampdiff(YEAR,`resident`.`DATE_OF_BIRTH`,curdate()) AS `AGE`, `resident`.`DATE_OF_BIRTH` AS `DATE_OF_BIRTH`, `resident`.`ADDRESS` AS `ADDRESS`, `af`.`STATUS` AS `STATUS`, `af`.`FORM_ID` AS `FORM_ID`, (select `r_paper_type`.`PAPER_TYPE_NAME` from `r_paper_type` where `r_paper_type`.`PAPER_TYPE_ID` = `af`.`REQUESTED_PAPER_TYPE_ID`) AS `REQUESTED_PAPER_TYPE`, (select `r_paper_type`.`PAPER_TYPE_NAME` from `r_paper_type` where `r_paper_type`.`PAPER_TYPE_ID` = `af`.`PAPER_TYPE_ID`) AS `FORM_PAPER_TYPE`, `af`.`REQUESTED_PAPER_TYPE_ID` AS `REQUESTED_PAPER_TYPE_ID`, `af`.`PAPER_TYPE_ID` AS `PAPER_TYPE_ID`, `af`.`CREATED_AT` AS `CREATED_AT` FROM (`t_resident_basic_info` `resident` join `t_application_form` `af` on(`af`.`RESIDENT_ID` = `resident`.`RESIDENT_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_approved_application_form`
--
DROP TABLE IF EXISTS `v_approved_application_form`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_approved_application_form`  AS SELECT `b`.`BUSINESS_ID` AS `BUSINESS_ID`, `b`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `b`.`TRADE_NAME` AS `TRADE_NAME`, `b`.`BUSINESS_OWNER_FIRSTNAME` AS `BUSINESS_OWNER_FIRSTNAME`, `b`.`BUSINESS_OWNER_MIDDLENAME` AS `BUSINESS_OWNER_MIDDLENAME`, `b`.`BUSINESS_OWNER_LASTNAME` AS `BUSINESS_OWNER_LASTNAME`, concat(ifnull(`b`.`BUILDING_NAME`,''),' ',ifnull(`b`.`BUILDING_NUMBER`,''),convert(if(`b`.`UNIT_NO` is null,'',' Unit ') using latin1),ifnull(`b`.`UNIT_NO`,''),' ',ifnull(`b`.`STREET`,''),' ',ifnull(`b`.`SITIO`,''),' ',ifnull(`b`.`SUBDIVISION`,'')) AS `BUSINESS_ADDRESS`, `b`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `b`.`BUSINESS_OR_ACQUIRED_DATE` AS `BUSINESS_OR_ACQUIRED_DATE`, `b`.`TIN_NO` AS `TIN_NO`, `b`.`DTI_REGISTRATION_NO` AS `DTI_REGISTRATION_NO`, `b`.`BUSINESS_POSTAL_CODE` AS `BUSINESS_POSTAL_CODE`, `b`.`BUSINESS_EMAIL_ADD` AS `BUSINESS_EMAIL_ADD`, `b`.`BUSINESS_TELEPHONE_NO` AS `BUSINESS_TELEPHONE_NO`, `b`.`BUSINESS_AREA` AS `BUSINESS_AREA`, `n`.`BUSINESS_NATURE_NAME` AS `BUSINESS_NATURE_NAME`, timestampdiff(YEAR,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_YEAR`, timestampdiff(MONTH,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_MONTH`, `af`.`STATUS` AS `STATUS`, `af`.`FORM_ID` AS `FORM_ID`, (select `r_paper_type`.`PAPER_TYPE_NAME` from `r_paper_type` where `r_paper_type`.`PAPER_TYPE_ID` = `af`.`REQUESTED_PAPER_TYPE_ID`) AS `REQUESTED_PAPER_TYPE`, (select `r_paper_type`.`PAPER_TYPE_NAME` from `r_paper_type` where `r_paper_type`.`PAPER_TYPE_ID` = `af`.`PAPER_TYPE_ID`) AS `FORM_PAPER_TYPE`, `af`.`REQUESTED_PAPER_TYPE_ID` AS `REQUESTED_PAPER_TYPE_ID`, `af`.`PAPER_TYPE_ID` AS `PAPER_TYPE_ID`, `af`.`FORM_NUMBER` AS `FORM_NUMBER`, `af`.`APPLICANT_NAME` AS `APPLICANT_NAME`, cast(`af`.`FORM_DATE` as date) AS `FORM_DATE`, `fbc`.`APPLICANT_NAME` AS `OPERATOR_NAME` FROM ((((`t_business_information` `b` left join `r_business_nature` `n` on(`n`.`BUSINESS_NATURE_ID` = `b`.`BUSINESS_NATURE_ID`)) left join `t_application_form` `af` on(`af`.`BUSINESS_ID` = `b`.`BUSINESS_ID`)) left join `r_paper_type` `pt` on(`pt`.`PAPER_TYPE_ID` = `af`.`PAPER_TYPE_ID`)) left join `t_bf_barangay_clearance` `fbc` on(`af`.`FORM_ID` = `fbc`.`FORM_ID`)) WHERE `b`.`STATUS` = 'Approved' AND `af`.`STATUS` = 'Approved' ;

-- --------------------------------------------------------

--
-- Structure for view `v_approved_business`
--
DROP TABLE IF EXISTS `v_approved_business`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_approved_business`  AS SELECT `b`.`BUSINESS_ID` AS `BUSINESS_ID`, `b`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `b`.`TRADE_NAME` AS `TRADE_NAME`, `b`.`BUSINESS_OWNER_FIRSTNAME` AS `BUSINESS_OWNER_FIRSTNAME`, `b`.`BUSINESS_OWNER_MIDDLENAME` AS `BUSINESS_OWNER_MIDDLENAME`, `b`.`BUSINESS_OWNER_LASTNAME` AS `BUSINESS_OWNER_LASTNAME`, concat(ifnull(`b`.`BUILDING_NAME`,''),' ',ifnull(`b`.`BUILDING_NUMBER`,''),convert(if(`b`.`UNIT_NO` is null,'',' Unit ') using latin1),ifnull(`b`.`UNIT_NO`,''),' ',ifnull(`b`.`STREET`,''),' ',ifnull(`b`.`SITIO`,''),' ',ifnull(`b`.`SUBDIVISION`,'')) AS `BUSINESS_ADDRESS`, `b`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `b`.`BUSINESS_OR_ACQUIRED_DATE` AS `BUSINESS_OR_ACQUIRED_DATE`, `b`.`TIN_NO` AS `TIN_NO`, `b`.`DTI_REGISTRATION_NO` AS `DTI_REGISTRATION_NO`, `b`.`BUSINESS_POSTAL_CODE` AS `BUSINESS_POSTAL_CODE`, `b`.`BUSINESS_EMAIL_ADD` AS `BUSINESS_EMAIL_ADD`, `b`.`BUSINESS_TELEPHONE_NO` AS `BUSINESS_TELEPHONE_NO`, `b`.`BUSINESS_AREA` AS `BUSINESS_AREA`, `n`.`BUSINESS_NATURE_NAME` AS `BUSINESS_NATURE_NAME`, timestampdiff(YEAR,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_YEAR`, timestampdiff(MONTH,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_MONTH` FROM (`t_business_information` `b` left join `r_business_nature` `n` on(`n`.`BUSINESS_NATURE_ID` = `b`.`BUSINESS_NATURE_ID`)) WHERE `b`.`STATUS` = 'Approved' ;

-- --------------------------------------------------------

--
-- Structure for view `v_barangay_certificate`
--
DROP TABLE IF EXISTS `v_barangay_certificate`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barangay_certificate`  AS SELECT `bc`.`PLACE_DESTINATION` AS `place_destination`, `bc`.`DESTINATION_ADDRESS` AS `destination_address`, `bc`.`TRAVEL_DATE` AS `travel_date`, `bc`.`RETURN_DATE` AS `return_date`, `bc`.`REQUESTOR_NAME` AS `REQUESTOR_NAME`, `bc`.`SSS_NO` AS `SSS_NO`, `bc`.`CALAMITY_NAME` AS `CALAMITY_NAME`, date_format(`bc`.`CALAMITY_DATE`,'%M %e, %Y') AS `CALAMITY_DATE`, `bc`.`COUNTRY` AS `COUNTRY`, `bc`.`CATEGORY_SINGLE_PARENT` AS `CATEGORY_SINGLE_PARENT`, `bc`.`PURPOSE` AS `PURPOSE`, `bc`.`MAIDEN_NAME` AS `MAIDEN_NAME`, `af`.`FORM_ID` AS `FORM_ID`, concat(ifnull(`r`.`FIRSTNAME`,''),' ',ifnull(`r`.`MIDDLENAME`,''),' ',ifnull(`r`.`LASTNAME`,'')) AS `RESIDENT_NAME`, `r`.`SEX` AS `SEX`, `r`.`PROFILE_PICTURE` AS `PROFILE_PICTURE`, `r`.`ADDRESS` AS `ADDRESS`, if(`r`.`SEX` = 'Female','her','his') AS `SEX_ADDRESS`, `r`.`CIVIL_STATUS` AS `CIVIL_STATUS`, year(curdate()) - year(`r`.`DATE_OF_BIRTH`) - (right(curdate(),5) < right(`r`.`DATE_OF_BIRTH`,5)) AS `AGE`, `cc`.`CONTROL_NO` AS `CONTROL_NO`, `cc`.`OR_NO` AS `OR_NO`, `cc`.`OR_AMOUNT` AS `OR_AMOUNT`, cast(`cc`.`ISSUED_DATE` as date) AS `ISSUED_DATE`, cast(`cc`.`OR_DATE` as date) AS `OR_DATE`, `fe`.`REMARKS` AS `REMARKS`, `paper`.`PAPER_TYPE_NAME` AS `PAPER_TYPE_NAME` FROM (((((`t_bf_barangay_certification` `bc` join `t_application_form` `af` on(`bc`.`FORM_ID` = `af`.`FORM_ID`)) join `t_resident_basic_info` `r` on(`af`.`RESIDENT_ID` = `r`.`RESIDENT_ID`)) join `t_application_form_evaluation` `fe` on(`fe`.`FORM_ID` = `af`.`FORM_ID`)) join `t_clearance_certification` `cc` on(`cc`.`FORM_ID` = `af`.`FORM_ID`)) join `r_paper_type` `paper` on(`paper`.`PAPER_TYPE_ID` = `af`.`REQUESTED_PAPER_TYPE_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_barangay_clearance`
--
DROP TABLE IF EXISTS `v_barangay_clearance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barangay_clearance`  AS SELECT `tafe`.`REMARKS` AS `remarks`, `r`.`CITIZENSHIP` AS `citizenship`, `r`.`PLACE_OF_BIRTH` AS `place_of_birth`, `r`.`RESIDENT_ID` AS `RESIDENT_ID`, ifnull(`r`.`FIRSTNAME`,'') AS `fname`, ' ' AS `Name_exp_6`, ifnull(`r`.`MIDDLENAME`,'') AS `mname`, ' ' AS `Name_exp_8`, ifnull(`r`.`LASTNAME`,'') AS `lname`, `r`.`SEX` AS `SEX`, if(`r`.`SEX` = 'Female','her','his') AS `SEX_ADDRESS`, `r`.`CIVIL_STATUS` AS `CIVIL_STATUS`, timestampdiff(YEAR,`r`.`DATE_OF_BIRTH`,curdate()) AS `AGE`, `r`.`DATE_OF_BIRTH` AS `DATE_OF_BIRTH`, concat(convert(if(`r`.`ADDRESS_UNIT_NO` is null,'','Unit ') using latin1),ifnull(`r`.`ADDRESS_UNIT_NO`,''),' ',ifnull(`r`.`ADDRESS_BUILDING`,''),' ',ifnull(`r`.`ADDRESS_PHASE`,''),' ',ifnull(`r`.`ADDRESS_BLOCK_NO`,''),' ',ifnull(`r`.`ADDRESS_STREET`,''),' ',ifnull(`r`.`ADDRESS_SUBDIVISION`,'')) AS `ADDRESS`, `cc`.`CONTROL_NO` AS `CONTROL_NO`, `cc`.`ISSUED_DATE` AS `ISSUED_DATE`, `cc`.`OR_NO` AS `OR_NO`, cast(`cc`.`OR_DATE` as date) AS `OR_DATE`, `cc`.`OR_AMOUNT` AS `OR_AMOUNT`, `paper`.`PAPER_TYPE_NAME` AS `PAPER_TYPE_NAME`, `af`.`FORM_ID` AS `FORM_ID`, `bc`.`REQUESTOR_NAME` AS `REQUESTOR_NAME`, `bc`.`SSS_NO` AS `SSS_NO`, `bc`.`CALAMITY_NAME` AS `CALAMITY_NAME`, `bc`.`CALAMITY_DATE` AS `CALAMITY_DATE`, `bc`.`COUNTRY` AS `COUNTRY`, `bc`.`CATEGORY_SINGLE_PARENT` AS `CATEGORY_SINGLE_PARENT`, `bc`.`PURPOSE` AS `PURPOSE`, `solo`.`CHILD_NAME` AS `CHILD_NAME`, `solo`.`CHILD_AGE` AS `CHILD_AGE`, `solo`.`IS_PWD` AS `IS_PWD`, `solo`.`CHILD_NAME_2` AS `CHILD_NAME_2`, `solo`.`CHILD_AGE_2` AS `CHILD_AGE_2`, `solo`.`IS_PWD_2` AS `IS_PWD_2`, `af`.`BUSINESS_ID` AS `BUSINESS_ID` FROM ((((((`t_resident_basic_info` `r` left join `t_application_form` `af` on(`af`.`RESIDENT_ID` = `r`.`RESIDENT_ID`)) join `r_paper_type` `paper` on(`paper`.`PAPER_TYPE_ID` = `af`.`REQUESTED_PAPER_TYPE_ID`)) join `t_bf_barangay_certification` `bc` on(`bc`.`FORM_ID` = `af`.`FORM_ID`)) join `t_clearance_certification` `cc` on(`cc`.`FORM_ID` = `af`.`FORM_ID`)) left join `t_solo_parent_children` `solo` on(`solo`.`BARANGAY_CERTIFICATION_ID` = `bc`.`BARANGAY_CERTIFICATION_ID`)) join `t_application_form_evaluation` `tafe` on(`af`.`FORM_ID` = `tafe`.`FORM_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_building_application`
--
DROP TABLE IF EXISTS `v_building_application`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_building_application`  AS SELECT DISTINCT `af`.`FORM_ID` AS `FORM_ID`, `af`.`RECEIVED_BY` AS `RECEIVED_BY`, `af`.`REQUESTED_PAPER_TYPE_ID` AS `REQUESTED_PAPER_TYPE_ID`, `af`.`STATUS` AS `STATUS`, `af`.`APPLICANT_NAME` AS `APPLICANT_NAME`, `af`.`CREATED_AT` AS `CREATED_AT`, `af`.`BUILDING_ID` AS `BUILDING_ID`, `bi`.`BUILDING_NAME` AS `BUILDING_NAME`, `bi`.`BUILDING_ID_NUMBER` AS `BUILDING_ID_NUMBER`, `bi`.`LOT_NUMBER` AS `LOT_NUMBER`, `bi`.`BUILDING_OCCUPANCY` AS `BUILDING_OCCUPANCY`, `bi`.`LAND_USE` AS `LAND_USE`, `bi`.`SCOPE_OF_WORK` AS `SCOPE_OF_WORK`, `bi`.`PROJECT_TYPE` AS `PROJECT_TYPE`, `bi`.`PROJECT_LOCATION` AS `PROJECT_LOCATION`, `bi`.`PROJECT_COST` AS `PROJECT_COST`, `bi`.`PROJECT_FLOOR_AREA` AS `PROJECT_FLOOR_AREA`, `bi`.`PROJECT_LOT_AREA` AS `PROJECT_LOT_AREA`, `bi`.`ENTERPRISE_NAME` AS `ENTERPRISE_NAME`, `paper`.`PAPER_TYPE_NAME` AS `PAPER_TYPE_NAME` FROM (((`t_application_form` `af` join `t_building_information` `bi` on(`af`.`BUILDING_ID` = `bi`.`BUILDING_ID`)) join `r_paper_type` `paper` on(`af`.`REQUESTED_PAPER_TYPE_ID` = `paper`.`PAPER_TYPE_ID`)) join `t_building_transactions` `tbt` on(`bi`.`BUILDING_ID` = `tbt`.`BUILDING_ID`)) WHERE `tbt`.`T_STATUS` = 'Approved' AND `tbt`.`T_IS_REQUESTED` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `v_building_issuance`
--
DROP TABLE IF EXISTS `v_building_issuance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_building_issuance`  AS SELECT DISTINCT `af`.`FORM_ID` AS `FORM_ID`, `af`.`BUILDING_ID` AS `BUILDING_ID`, `af`.`REQUESTED_PAPER_TYPE_ID` AS `REQUESTED_PAPER_TYPE_ID`, `bi`.`BUILDING_NAME` AS `BUILDING_NAME`, `bi`.`BUILDING_ID_NUMBER` AS `BUILDING_ID_NUMBER`, `bi`.`BUILDING_OCCUPANCY` AS `BUILDING_OCCUPANCY`, `bi`.`LAND_USE` AS `LAND_USE`, `bi`.`SCOPE_OF_WORK` AS `SCOPE_OF_WORK`, `bi`.`LOT_NUMBER` AS `LOT_NUMBER`, `bi`.`PROJECT_TYPE` AS `PROJECT_TYPE`, `bi`.`PROJECT_LOCATION` AS `PROJECT_LOCATION`, concat('₱',format(`bi`.`PROJECT_COST`,2)) AS `PROJECT_COST`, `bi`.`PROJECT_FLOOR_AREA` AS `PROJECT_FLOOR_AREA`, `bi`.`PROJECT_LOT_AREA` AS `PROJECT_LOT_AREA`, `bi`.`APPLICANT_NAME` AS `APPLICANT_NAME`, `bi`.`ENTERPRISE_NAME` AS `ENTERPRISE_NAME`, `paper`.`PAPER_TYPE_ID` AS `PAPER_TYPE_ID`, `paper`.`PAPER_TYPE_NAME` AS `REQUESTED_PAPER_TYPE`, `bc`.`PURPOSE` AS `PURPOSE`, `bc`.`PROJECT_LAND_USE` AS `PROJECT_LAND_USE`, `cc`.`CONTROL_NO` AS `CONTROL_NO`, `cc`.`ISSUED_DATE` AS `ISSUED_DATE`, `cc`.`OR_NO` AS `OR_NO`, `cc`.`OR_DATE` AS `OR_DATE`, `cc`.`OR_AMOUNT` AS `OR_AMOUNT`, cast(`af`.`FORM_DATE` as date) AS `FORM_DATE` FROM (((((`t_building_information` `bi` join `t_application_form` `af` on(`bi`.`BUILDING_ID` = `af`.`BUILDING_ID`)) join `t_bf_barangay_clearance` `bc` on(`af`.`FORM_ID` = `bc`.`FORM_ID`)) join `r_paper_type` `paper` on(`af`.`REQUESTED_PAPER_TYPE_ID` = `paper`.`PAPER_TYPE_ID`)) join `t_clearance_certification` `cc` on(`af`.`FORM_ID` = `cc`.`FORM_ID`)) join `t_building_transactions` `tbt` on(`bi`.`BUILDING_ID` = `tbt`.`BUILDING_ID`)) WHERE `tbt`.`T_STATUS` = 'Approved' AND `af`.`STATUS` = 'Approved' ;

-- --------------------------------------------------------

--
-- Structure for view `v_building_list`
--
DROP TABLE IF EXISTS `v_building_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_building_list`  AS SELECT `bi`.`BUILDING_ID` AS `BUILDING_ID`, `bi`.`BUILDING_NAME` AS `BUILDING_NAME`, `bi`.`BUILDING_ID_NUMBER` AS `BUILDING_ID_NUMBER`, `bi`.`BUILDING_OCCUPANCY` AS `BUILDING_OCCUPANCY`, `bi`.`LAND_USE` AS `LAND_USE`, `bi`.`PROJECT_TYPE` AS `PROJECT_TYPE`, `bi`.`PROJECT_LOCATION` AS `PROJECT_LOCATION`, `bi`.`PROJECT_COST` AS `PROJECT_COST`, `bi`.`PROJECT_FLOOR_AREA` AS `PROJECT_FLOOR_AREA`, `bi`.`PROJECT_LOT_AREA` AS `PROJECT_LOT_AREA`, `bi`.`APPLICANT_NAME` AS `APPLICANT_NAME`, `bi`.`APPLICANT_TELEPHONE_NO` AS `APPLICANT_TELEPHONE_NO`, `bi`.`APPLICANT_MOBILE_NO` AS `APPLICANT_MOBILE_NO`, `bi`.`APPLICANT_EMAIL` AS `APPLICANT_EMAIL`, `bi`.`POSTAL_CODE` AS `POSTAL_CODE`, `bi`.`FORM_OWNERSHIP` AS `FORM_OWNERSHIP`, `bi`.`ENTERPRISE_NAME` AS `ENTERPRISE_NAME`, `bi`.`IS_REQUESTED` AS `IS_REQUESTED`, `bi`.`LESSOR_NAME` AS `LESSOR_NAME`, `bi`.`LESSOR_ADDRESS` AS `LESSOR_ADDRESS`, `bi`.`LESSOR_NO` AS `LESSOR_NO`, `bi`.`LESSOR_EMAIL` AS `LESSOR_EMAIL`, `bi`.`MONTHLY_RENTAL` AS `MONTHLY_RENTAL`, `bi`.`APPLICANT_ADDRESS` AS `APPLICANT_ADDRESS`, `bi`.`CREATED_AT` AS `CREATED_AT`, `bi`.`ACTIVE_FLAG` AS `ACTIVE_FLAG`, `bi`.`LOT_NUMBER` AS `LOT_NUMBER`, `bo`.`TRANSACTION_ID` AS `TRANSACTION_ID` FROM (`t_building_information` `bi` join `t_building_transactions` `bo` on(`bi`.`BUILDING_ID` = `bo`.`BUILDING_ID`)) WHERE `bo`.`T_IS_IMPROVEMENT` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `v_building_related`
--
DROP TABLE IF EXISTS `v_building_related`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_building_related`  AS SELECT DISTINCT `af`.`FORM_ID` AS `FORM_ID`, `af`.`BUILDING_ID` AS `BUILDING_ID`, `bi`.`BUILDING_NAME` AS `BUILDING_NAME`, `bi`.`LOT_NUMBER` AS `LOT_NUMBER`, `bi`.`BUILDING_ID_NUMBER` AS `BUILDING_ID_NUMBER`, `bi`.`LAND_USE` AS `LAND_USE`, `bt`.`SCOPE_OF_WORK` AS `SCOPE_OF_WORK`, `bi`.`PROJECT_TYPE` AS `PROJECT_TYPE`, `bi`.`PROJECT_LOCATION` AS `PROJECT_LOCATION`, concat('₱',format(`bi`.`PROJECT_COST`,2)) AS `PROJECT_COST`, `bi`.`PROJECT_LOT_AREA` AS `PROJECT_LOT_AREA`, `bi`.`PROJECT_FLOOR_AREA` AS `PROJECT_FLOOR_AREA`, `bi`.`APPLICANT_MOBILE_NO` AS `APPLICANT_MOBILE_NO`, `bi`.`APPLICANT_TELEPHONE_NO` AS `APPLICANT_TELEPHONE_NO`, `bi`.`APPLICANT_EMAIL` AS `APPLICANT_EMAIL`, `bi`.`POSTAL_CODE` AS `POSTAL_CODE`, `bi`.`FORM_OWNERSHIP` AS `FORM_OWNERSHIP`, `bi`.`ENTERPRISE_NAME` AS `ENTERPRISE_NAME`, `bi`.`LESSOR_NAME` AS `LESSOR_NAME`, `bi`.`LESSOR_ADDRESS` AS `LESSOR_ADDRESS`, `bi`.`LESSOR_NO` AS `LESSOR_NO`, `bi`.`LESSOR_EMAIL` AS `LESSOR_EMAIL`, `bi`.`MONTHLY_RENTAL` AS `MONTHLY_RENTAL`, `bi`.`APPLICANT_ADDRESS` AS `APPLICANT_ADDRESS`, `bc`.`REGISTERED_NAME` AS `REGISTERED_NAME`, `bc`.`APPLICANT_NAME` AS `APPLICANT_NAME`, `bi`.`APPLICANT_NAME` AS `OWNER_NAME`, `bc`.`PROJECT_LAND_USE` AS `PROJECT_LAND_USE`, `bc`.`PURPOSE` AS `PURPOSE`, `cc`.`CONTROL_NO` AS `CONTROL_NO`, `cc`.`OR_NO` AS `OR_NO`, cast(`cc`.`OR_DATE` as date) AS `OR_DATE`, `cc`.`OR_AMOUNT` AS `OR_AMOUNT`, `bt`.`TRANSACTION_ID` AS `TRANSACTION_ID` FROM ((((((`t_application_form` `af` join `t_building_transactions` `bt` on(`af`.`TRANSACTION_ID` = `bt`.`TRANSACTION_ID`)) join `t_building_information` `bi` on(`bt`.`BUILDING_ID` = `bi`.`BUILDING_ID`)) join `t_bf_barangay_clearance` `bc` on(`af`.`FORM_ID` = `bc`.`FORM_ID`)) join `r_paper_type` `ptype` on(`ptype`.`PAPER_TYPE_ID` = `af`.`REQUESTED_PAPER_TYPE_ID`)) join `t_clearance_certification` `cc` on(`af`.`FORM_ID` = `cc`.`FORM_ID`)) join `r_paper_type` `paper` on(`af`.`REQUESTED_PAPER_TYPE_ID` = `paper`.`PAPER_TYPE_ID`)) WHERE `paper`.`PAPER_TYPE_NAME` = 'Barangay Clearance Building (Non-Business)' ;

-- --------------------------------------------------------

--
-- Structure for view `v_building_transactions`
--
DROP TABLE IF EXISTS `v_building_transactions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_building_transactions`  AS SELECT `bt`.`BUILDING_ID` AS `BUILDING_ID`, `bi`.`BUILDING_NAME` AS `BUILDING_NAME`, `bi`.`BUILDING_ID_NUMBER` AS `BUILDING_ID_NUMBER`, `bi`.`BUILDING_OCCUPANCY` AS `BUILDING_OCCUPANCY`, `bi`.`LAND_USE` AS `LAND_USE`, `bi`.`PROJECT_TYPE` AS `PROJECT_TYPE`, `bi`.`PROJECT_LOCATION` AS `PROJECT_LOCATION`, `bi`.`PROJECT_COST` AS `PROJECT_COST`, `bi`.`PROJECT_FLOOR_AREA` AS `PROJECT_FLOOR_AREA`, `bi`.`PROJECT_LOT_AREA` AS `PROJECT_LOT_AREA`, `bi`.`APPLICANT_NAME` AS `APPLICANT_NAME`, `bi`.`APPLICANT_TELEPHONE_NO` AS `APPLICANT_TELEPHONE_NO`, `bi`.`APPLICANT_MOBILE_NO` AS `APPLICANT_MOBILE_NO`, `bi`.`APPLICANT_EMAIL` AS `APPLICANT_EMAIL`, `bi`.`POSTAL_CODE` AS `POSTAL_CODE`, `bi`.`FORM_OWNERSHIP` AS `FORM_OWNERSHIP`, `bi`.`ENTERPRISE_NAME` AS `ENTERPRISE_NAME`, `bi`.`STATUS` AS `STATUS`, `bt`.`T_STATUS` AS `T_STATUS`, `bi`.`IS_REQUESTED` AS `IS_REQUESTED`, `bi`.`LESSOR_NAME` AS `LESSOR_NAME`, `bi`.`LESSOR_ADDRESS` AS `LESSOR_ADDRESS`, `bi`.`LESSOR_NO` AS `LESSOR_NO`, `bi`.`LESSOR_EMAIL` AS `LESSOR_EMAIL`, `bi`.`MONTHLY_RENTAL` AS `MONTHLY_RENTAL`, `bi`.`APPLICANT_ADDRESS` AS `APPLICANT_ADDRESS`, `bi`.`CREATED_AT` AS `CREATED_AT`, `bi`.`ACTIVE_FLAG` AS `ACTIVE_FLAG`, `bi`.`LOT_NUMBER` AS `LOT_NUMBER`, `bi`.`IS_IMPROVEMENT` AS `IS_IMPROVEMENT`, `bt`.`SCOPE_OF_WORK` AS `SCOPE_OF_WORK`, `bt`.`TRANSACTION_ID` AS `TRANSACTION_ID`, `bt`.`T_IS_REQUESTED` AS `T_IS_REQUESTED`, `bt`.`T_IS_IMPROVEMENT` AS `T_IS_IMPROVEMENT` FROM (`t_building_transactions` `bt` join `t_building_information` `bi` on(`bt`.`BUILDING_ID` = `bi`.`BUILDING_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_business_activity`
--
DROP TABLE IF EXISTS `v_business_activity`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_business_activity`  AS SELECT `ba`.`BUSINESS_ID` AS `BUSINESS_ID`, `ba`.`GROSS_RECEIPTS_ESSENTIAL` AS `GROSS_RECEIPTS_ESSENTIAL`, `ba`.`GROSS_RECEIPTS_NON_ESSENTIAL` AS `GROSS_RECEIPTS_NON_ESSENTIAL`, `lob`.`LINE_OF_BUSINESS_ID` AS `LINE_OF_BUSINESS_ID`, `lob`.`LINE_OF_BUSINESS_NAME` AS `LINE_OF_BUSINESS_NAME`, `ba`.`BUSINESS_ACTIVITY_ID` AS `BUSINESS_ACTIVITY_ID`, `ba`.`NO_OF_UNITS` AS `NO_OF_UNITS`, `ba`.`CAPITALIZATION` AS `CAPITALIZATION` FROM (`t_bf_business_activity` `ba` left join `r_bf_line_of_business` `lob` on(`lob`.`LINE_OF_BUSINESS_ID` = `ba`.`LINE_OF_BUSINESS_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_business_information`
--
DROP TABLE IF EXISTS `v_business_information`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_business_information`  AS SELECT `business`.`BUSINESS_ID` AS `BUSINESS_ID`, `business`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `business`.`TRADE_NAME` AS `TRADE_NAME`, concat(`business`.`BUSINESS_OWNER_FIRSTNAME`,'',ifnull(`business`.`BUSINESS_OWNER_MIDDLENAME`,''),'',`business`.`BUSINESS_OWNER_LASTNAME`) AS `BUSINESS_OWNER`, `business`.`BUSINESS_OWNER_FIRSTNAME` AS `BUSINESS_OWNER_FIRSTNAME`, `business`.`BUSINESS_OWNER_MIDDLENAME` AS `BUSINESS_OWNER_MIDDLENAME`, `business`.`BUSINESS_OWNER_LASTNAME` AS `BUSINESS_OWNER_LASTNAME`, concat(ifnull(lcase(`business`.`BUILDING_NAME`),''),',',ifnull(`business`.`BUILDING_NUMBER`,''),'',ifnull(`business`.`UNIT_NO`,' '),'',ifnull(lcase(`business`.`STREET`),''),'',ifnull(lcase(`business`.`SITIO`),''),'',ifnull(lcase(`business`.`SUBDIVISION`),''),'') AS `BUSINESS_ADDRESS`, `business`.`BUILDING_NAME` AS `BUILDING_NAME`, `business`.`BUILDING_NUMBER` AS `BUILDING_NUMBER`, `business`.`UNIT_NO` AS `UNIT_NO`, `business`.`STREET` AS `STREET`, `business`.`SITIO` AS `SITIO`, `business`.`SUBDIVISION` AS `SUBDIVISION`, `business`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `business`.`BUSINESS_OR_ACQUIRED_DATE` AS `BUSINESS_OR_ACQUIRED_DATE`, `business`.`BARANGAY_ZONE_ID` AS `BARANGAY_ZONE_ID`, `business`.`TIN_NO` AS `TIN_NO`, `business`.`DTI_REGISTRATION_NO` AS `DTI_REGISTRATION_NO`, `business`.`TYPE_OF_BUSINESS` AS `TYPE_OF_BUSINESS`, `business`.`BUSINESS_POSTAL_CODE` AS `BUSINESS_POSTAL_CODE`, `business`.`BUSINESS_EMAIL_ADD` AS `BUSINESS_EMAIL_ADD`, `business`.`BUSINESS_TELEPHONE_NO` AS `BUSINESS_TELEPHONE_NO`, `business`.`BUSINESS_MOBILE_NO` AS `BUSINESS_MOBILE_NO`, `business`.`OWNER_ADDRESS` AS `OWNER_ADDRESS`, `business`.`OWNER_POSTAL_CODE` AS `OWNER_POSTAL_CODE`, `business`.`OWNER_EMAIL_ADD` AS `OWNER_EMAIL_ADD`, `business`.`OWNER_TELEPHONE_NO` AS `OWNER_TELEPHONE_NO`, `business`.`OWNER_MOBILE_NO` AS `OWNER_MOBILE_NO`, `business`.`EMERGENCY_CONTACT_PERSON` AS `EMERGENCY_CONTACT_PERSON`, `business`.`EMERGENCY_PERSON_CONTACT_NO` AS `EMERGENCY_PERSON_CONTACT_NO`, `business`.`EMERGENCY_PERSON_EMAIL_ADD` AS `EMERGENCY_PERSON_EMAIL_ADD`, `business`.`BUSINESS_AREA` AS `BUSINESS_AREA`, `business`.`NO_EMPLOYEE_ESTABLISHMENT` AS `NO_EMPLOYEE_ESTABLISHMENT`, `business`.`NO_EMPLOYEE_LGU` AS `NO_EMPLOYEE_LGU`, `business`.`LESSOR_NAME` AS `LESSOR_NAME`, `business`.`LESSOR_ADDRESS` AS `LESSOR_ADDRESS`, `business`.`LESSOR_POSTAL` AS `LESSOR_POSTAL`, `business`.`LESSOR_CONTACT_NO` AS `LESSOR_CONTACT_NO`, `business`.`LESSOR_TELEPHONE` AS `LESSOR_TELEPHONE`, `business`.`LESSOR_MOBILE_NO` AS `LESSOR_MOBILE_NO`, `business`.`LESSOR_EMAIL_ADD` AS `LESSOR_EMAIL_ADD`, `business`.`MONTHLY_RENTAL` AS `MONTHLY_RENTAL`, `business`.`REFERENCED_BUSINESS_ID` AS `REFERENCED_BUSINESS_ID`, `activity`.`NO_OF_UNITS` AS `NO_OF_UNITS`, `business`.`STATUS` AS `STATUS`, `business`.`NEW_RENEW_STATUS` AS `NEW_RENEW_STATUS`, `activity`.`CAPITALIZATION` AS `CAPITALIZATION`, `activity`.`GROSS_RECEIPTS_ESSENTIAL` AS `GROSS_RECEIPTS_ESSENTIAL`, `activity`.`GROSS_RECEIPTS_NON_ESSENTIAL` AS `GROSS_RECEIPTS_NON_ESSENTIAL`, `nature`.`BUSINESS_NATURE_NAME` AS `BUSINESS_NATURE_NAME` FROM ((`t_business_information` `business` left join `t_bf_business_activity` `activity` on(`activity`.`BUSINESS_ID` = `business`.`BUSINESS_ID`)) left join `r_business_nature` `nature` on(`business`.`BUSINESS_NATURE_ID` = `nature`.`BUSINESS_NATURE_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_business_nature`
--
DROP TABLE IF EXISTS `v_business_nature`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_business_nature`  AS SELECT `r_business_nature`.`BUSINESS_NATURE_ID` AS `BUSINESS_NATURE_ID`, `r_business_nature`.`BUSINESS_NATURE_NAME` AS `BUSINESS_NATURE_NAME` FROM `r_business_nature` WHERE `r_business_nature`.`ACTIVE_FLAG` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `v_business_permit`
--
DROP TABLE IF EXISTS `v_business_permit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_business_permit`  AS SELECT `business`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `business`.`BUSINESS_ADDRESS` AS `BUSINESS_ADDRESS`, `lob`.`LINE_OF_BUSINESS_NAME` AS `BUSINESS_NATURE_NAME`, `permit`.`TAX_YEAR` AS `TAX_YEAR`, `permit`.`QUARTER` AS `QUARTER`, `clearance`.`OR_NO` AS `OR_NO`, `clearance`.`OR_AMOUNT` AS `OR_AMOUNT`, cast(`clearance`.`OR_DATE` as date) AS `OR_DATE`, `permit`.`BARANGAY_PERMIT` AS `BARANGAY_PERMIT`, `permit`.`BUSINESS_TAX` AS `BUSINESS_TAX`, `permit`.`GARBAGE_FEE` AS `GARBAGE_FEE`, `permit`.`SIGNBOARD` AS `SIGNBOARD`, `permit`.`CTC` AS `CTC`, `form`.`FORM_ID` AS `FORM_ID`, `clearance`.`CONTROL_NO` AS `CONTROL_NO`, cast(`clearance`.`ISSUED_DATE` as date) AS `ISSUED_DATE`, `business`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `permit`.`PLATE_NO` AS `PLATE_NO`, `permit`.`STICKER` AS `STICKER`, `permit`.`PLATE_FEE` AS `PLATE_FEE`, ifnull(`permit`.`BUSINESS_TAX`,0) + ifnull(`permit`.`SIGNBOARD`,0) + ifnull(`permit`.`GARBAGE_FEE`,0) + ifnull(`permit`.`PLATE_FEE`,0) + ifnull(`permit`.`STICKER`,0) AS `TOTAL_AMOUNT`, `business`.`BUSINESS_ID` AS `BUSINESS_ID` FROM (((((`t_business_information` `business` join `t_application_form` `form` on(`business`.`BUSINESS_ID` = `form`.`BUSINESS_ID`)) join `t_bf_business_permit` `permit` on(`permit`.`FORM_ID` = `form`.`FORM_ID`)) join `t_clearance_certification` `clearance` on(`clearance`.`FORM_ID` = `form`.`FORM_ID`)) left join `t_bf_business_activity` `activity` on(`activity`.`BUSINESS_ID` = `business`.`BUSINESS_ID`)) left join `r_bf_line_of_business` `lob` on(`lob`.`LINE_OF_BUSINESS_ID` = `activity`.`LINE_OF_BUSINESS_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_declined_application_form`
--
DROP TABLE IF EXISTS `v_declined_application_form`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_declined_application_form`  AS SELECT `b`.`BUSINESS_ID` AS `BUSINESS_ID`, `b`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `b`.`TRADE_NAME` AS `TRADE_NAME`, `b`.`BUSINESS_OWNER_FIRSTNAME` AS `BUSINESS_OWNER_FIRSTNAME`, `b`.`BUSINESS_OWNER_MIDDLENAME` AS `BUSINESS_OWNER_MIDDLENAME`, `b`.`BUSINESS_OWNER_LASTNAME` AS `BUSINESS_OWNER_LASTNAME`, concat(ifnull(`b`.`BUILDING_NAME`,''),' ',ifnull(`b`.`BUILDING_NUMBER`,''),convert(if(`b`.`UNIT_NO` is null,'',' Unit ') using latin1),ifnull(`b`.`UNIT_NO`,''),' ',ifnull(`b`.`STREET`,''),' ',ifnull(`b`.`SITIO`,''),' ',ifnull(`b`.`SUBDIVISION`,'')) AS `BUSINESS_ADDRESS`, `b`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `b`.`BUSINESS_OR_ACQUIRED_DATE` AS `BUSINESS_OR_ACQUIRED_DATE`, `b`.`TIN_NO` AS `TIN_NO`, `b`.`DTI_REGISTRATION_NO` AS `DTI_REGISTRATION_NO`, `b`.`BUSINESS_POSTAL_CODE` AS `BUSINESS_POSTAL_CODE`, `b`.`BUSINESS_EMAIL_ADD` AS `BUSINESS_EMAIL_ADD`, `b`.`BUSINESS_TELEPHONE_NO` AS `BUSINESS_TELEPHONE_NO`, `b`.`BUSINESS_AREA` AS `BUSINESS_AREA`, `n`.`BUSINESS_NATURE_NAME` AS `BUSINESS_NATURE_NAME`, timestampdiff(YEAR,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_YEAR`, timestampdiff(MONTH,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_MONTH`, `af`.`STATUS` AS `STATUS`, `af`.`FORM_ID` AS `FORM_ID`, (select `r_paper_type`.`PAPER_TYPE_NAME` from `r_paper_type` where `r_paper_type`.`PAPER_TYPE_ID` = `af`.`REQUESTED_PAPER_TYPE_ID`) AS `REQUESTED_PAPER_TYPE`, (select `r_paper_type`.`PAPER_TYPE_NAME` from `r_paper_type` where `r_paper_type`.`PAPER_TYPE_ID` = `af`.`PAPER_TYPE_ID`) AS `FORM_PAPER_TYPE`, `af`.`REQUESTED_PAPER_TYPE_ID` AS `REQUESTED_PAPER_TYPE_ID`, `af`.`PAPER_TYPE_ID` AS `PAPER_TYPE_ID` FROM (((`t_business_information` `b` left join `r_business_nature` `n` on(`n`.`BUSINESS_NATURE_ID` = `b`.`BUSINESS_NATURE_ID`)) join `t_application_form` `af` on(`af`.`BUSINESS_ID` = `b`.`BUSINESS_ID`)) join `r_paper_type` `pt` on(`pt`.`PAPER_TYPE_ID` = `af`.`PAPER_TYPE_ID`)) WHERE `b`.`STATUS` = 'Approved' AND `af`.`STATUS` = 'Declined' ;

-- --------------------------------------------------------

--
-- Structure for view `v_declined_business`
--
DROP TABLE IF EXISTS `v_declined_business`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_declined_business`  AS SELECT `b`.`BUSINESS_ID` AS `BUSINESS_ID`, `b`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `b`.`TRADE_NAME` AS `TRADE_NAME`, `b`.`BUSINESS_OWNER_FIRSTNAME` AS `BUSINESS_OWNER_FIRSTNAME`, `b`.`BUSINESS_OWNER_MIDDLENAME` AS `BUSINESS_OWNER_MIDDLENAME`, `b`.`BUSINESS_OWNER_LASTNAME` AS `BUSINESS_OWNER_LASTNAME`, concat(ifnull(`b`.`BUILDING_NAME`,''),' ',ifnull(`b`.`BUILDING_NUMBER`,''),convert(if(`b`.`UNIT_NO` is null,'',' Unit ') using latin1),ifnull(`b`.`UNIT_NO`,''),' ',ifnull(`b`.`STREET`,''),' ',ifnull(`b`.`SITIO`,''),' ',ifnull(`b`.`SUBDIVISION`,'')) AS `BUSINESS_ADDRESS`, `b`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `b`.`BUSINESS_OR_ACQUIRED_DATE` AS `BUSINESS_OR_ACQUIRED_DATE`, `b`.`TIN_NO` AS `TIN_NO`, `b`.`DTI_REGISTRATION_NO` AS `DTI_REGISTRATION_NO`, `b`.`BUSINESS_POSTAL_CODE` AS `BUSINESS_POSTAL_CODE`, `b`.`BUSINESS_EMAIL_ADD` AS `BUSINESS_EMAIL_ADD`, `b`.`BUSINESS_TELEPHONE_NO` AS `BUSINESS_TELEPHONE_NO`, `n`.`BUSINESS_NATURE_NAME` AS `BUSINESS_NATURE_NAME`, timestampdiff(YEAR,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_YEAR`, timestampdiff(MONTH,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_MONTH` FROM (`t_business_information` `b` left join `r_business_nature` `n` on(`n`.`BUSINESS_NATURE_ID` = `b`.`BUSINESS_NATURE_ID`)) WHERE `b`.`STATUS` = 'Pending' ;

-- --------------------------------------------------------

--
-- Structure for view `v_dpoaccount`
--
DROP TABLE IF EXISTS `v_dpoaccount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dpoaccount`  AS SELECT `u`.`USER_ID` AS `USER_ID`, `bs`.`BARANGAY_ID` AS `BARANGAY_ID`, concat(`u`.`FIRSTNAME`,' ',`u`.`MIDDLENAME`,`u`.`LASTNAME`) AS `DPO_Name`, `p`.`POSITION_NAME` AS `POSITION_NAME`, `u`.`USERNAME` AS `USERNAME`, `u`.`PASSWORD` AS `PASSWORD`, `u`.`EMAIL` AS `EMAIL`, `bs`.`BARANGAY_NAME` AS `BARANGAY_NAME`, `bs`.`BARANGAY_SEAL` AS `BARANGAY_SEAL`, `bs`.`ACTIVE_FLAG` AS `ACTIVE_FLAG`, `u`.`PERMIS_BARANGAY_CONFIG` AS `PERMIS_BARANGAY_CONFIG` FROM ((`t_users` `u` join `r_barangay_information` `bs` on(`u`.`USER_ID` = `bs`.`USER_ID`)) join `r_position` `p` on(`p`.`POSITION_ID` = `u`.`POSITION_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_filter_residents`
--
DROP TABLE IF EXISTS `v_filter_residents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_filter_residents`  AS SELECT `t`.`LASTNAME` AS `LASTNAME`, `t`.`FIRSTNAME` AS `FIRSTNAME`, ifnull(`t`.`MIDDLENAME`,'') AS `MIDDLENAME`, `t`.`ADDRESS` AS `ADDRESS`, ifnull(`t`.`DATE_OF_BIRTH`,'') AS `DATE_OF_BIRTH`, ifnull(`t`.`PLACE_OF_BIRTH`,'') AS `PLACE_OF_BIRTH`, ifnull(`t`.`SEX`,'') AS `SEX`, ifnull(`t`.`CIVIL_STATUS`,'') AS `CIVIL_STATUS`, if(`t`.`IS_OFW` = 1,'Y','N') AS `IS_OFW`, ifnull(`t`.`OCCUPATION`,'') AS `OCCUPATION`, ifnull(`t`.`OCCUPATION`,'') AS `OCCUPATION2`, ifnull(`t`.`DATE_STARTED_WORKING`,'') AS `DATE_STARTED_WORKING`, ifnull(`t`.`CITIZENSHIP`,'') AS `CITIZENSHIP`, ifnull(`t`.`RELATION_TO_HOUSEHOLD_HEAD`,'') AS `RELATION_TO_HOUSEHOLD_HEAD`, ifnull(`t`.`DATE_OF_ARRIVAL`,'') AS `DATE_OF_ARRIVAL`, `rt`.`TYPE_NAME` AS `TYPE_NAME`, if(`t`.`IS_INDIGENOUS` = 1,'Y','N') AS `IS_INDIGENOUS`, ifnull(`t`.`CONTACT_NUMBER`,'NO CONTACT NUMBER') AS `CONTACT_NUMBER`, ifnull(`t`.`EDUCATIONAL_ATTAINMENT`,'') AS `EDUCATIONAL_ATTAINMENT`, ifnull(`h`.`HOME_OWNERSHIP`,'') AS `HOME_OWNERSHIP`, ifnull(`h`.`PERSON_STAYING_IN_HOUSEHOLD`,'') AS `PERSON_STAYING_IN_HOUSEHOLD`, ifnull(`h`.`HOME_MATERIALS`,'') AS `HOME_MATERIALS`, ifnull(`h`.`NUMBER_OF_ROOMS`,'') AS `NUMBER_OF_ROOMS`, if(`h`.`TOILET_HOME` = 1,'Y','N') AS `TOILET_HOME`, if(`h`.`PLAY_AREA_HOME` = 1,'Y','N') AS `PLAY_AREA_HOME`, if(`h`.`BEDROOM_HOME` = 1,'Y','N') AS `BEDROOM_HOME`, if(`h`.`DINING_ROOM_HOME` = 1,'Y','N') AS `DINING_ROOM_HOME`, if(`h`.`SALA_HOME` = 1,'Y','N') AS `SALA_HOME`, if(`h`.`KITCHEN_HOME` = 1,'Y','N') AS `KITCHEN_HOME`, if(`h`.`WATER_UTILITIES` = 1,'Y','N') AS `WATER_UTILITIES`, if(`h`.`ELECTRICITY_UTILITIES` = 1,'Y','N') AS `ELECTRICITY_UTILITIES`, if(`h`.`AIRCON_UTILITIES` = 1,'Y','N') AS `AIRCON_UTILITIES`, if(`h`.`PHONE_UTILITIES` = 1,'Y','N') AS `PHONE_UTILITIES`, if(`h`.`COMPUTER_UTILITIES` = 1,'Y','N') AS `COMPUTER_UTILITIES`, if(`h`.`INTERNET_UTILITIES` = 1,'Y','N') AS `INTERNET_UTILITIES`, if(`h`.`TV_UTILITIES` = 1,'Y','N') AS `TV_UTILITIES`, if(`h`.`CD_PLAYER_UTILITIES` = 1,'Y','N') AS `CD_PLAYER_UTILITIES`, if(`h`.`RADIO_UTILITIES` = 1,'Y','N') AS `RADIO_UTILITIES`, if(`h`.`COMICS_ENTERTAINMENT` = 1,'Y','N') AS `COMICS_ENTERTAINMENT`, if(`h`.`NEWS_PAPER_ENTERTAINMENT` = 1,'Y','N') AS `NEWS_PAPER_ENTERTAINMENT`, if(`h`.`PETS_ENTERTAINMENT` = 1,'Y','N') AS `PETS_ENTERTAINMENT`, if(`h`.`BOOKS_ENTERTAINMENT` = 1,'Y','N') AS `BOOKS_ENTERTAINMENT`, if(`h`.`STORY_BOOKS_ENTERTAINMENT` = 1,'Y','N') AS `STORY_BOOKS_ENTERTAINMENT`, if(`h`.`TOYS_ENTERTAINMENT` = 1,'Y','N') AS `TOYS_ENTERTAINMENT`, if(`h`.`BOARD_GAMES_ENTERTAINMENT` = 1,'Y','N') AS `BOARD_GAMES_ENTERTAINMENT`, if(`h`.`PUZZLES_ENTERTAINMENT` = 1,'Y','N') AS `PUZZLES_ENTERTAINMENT`, `t`.`HOUSEHOLD_ID` AS `HOUSEHOLD_ID` FROM ((`t_resident_basic_info` `t` join `t_household_information` `h` on(`t`.`HOUSEHOLD_ID` = `h`.`HOUSEHOLD_ID`)) left join `r_resident_type` `rt` on(`t`.`ARRIVAL_STATUS` = `rt`.`TYPE_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_for_business_clearances`
--
DROP TABLE IF EXISTS `v_for_business_clearances`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_for_business_clearances`  AS SELECT `tafe`.`REMARKS` AS `remarks`, `cc`.`CONTROL_NO` AS `CONTROL_NO`, `cc`.`ISSUED_DATE` AS `ISSUED_DATE`, `cc`.`OR_NO` AS `OR_NO`, cast(`cc`.`OR_DATE` as date) AS `OR_DATE`, `cc`.`OR_AMOUNT` AS `OR_AMOUNT`, `paper`.`PAPER_TYPE_NAME` AS `PAPER_TYPE_NAME`, `af`.`FORM_ID` AS `FORM_ID`, `bc`.`REQUESTOR_NAME` AS `REQUESTOR_NAME`, `bc`.`PURPOSE` AS `PURPOSE`, `af`.`BUSINESS_ID` AS `BUSINESS_ID`, `bi`.`BUSINESS_ADDRESS` AS `BUSINESS_ADDRESS`, concat(ifnull(concat(`bi`.`BUSINESS_OWNER_FIRSTNAME`,' '),''),ifnull(concat(`bi`.`BUSINESS_OWNER_MIDDLENAME`,' '),''),ifnull(concat(`bi`.`BUSINESS_OWNER_LASTNAME`,' '),'')) AS `BUSINESS_OWNER`, `bi`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `nature`.`BUSINESS_NATURE_NAME` AS `BUSINESS_NATURE_NAME`, `fbc`.`PROJECT_LOCATION` AS `PROJECT_LOCATION`, `fbc`.`APPLICANT_NAME` AS `APPLICANT_NAME`, `fbc`.`D_DRIVER_LICENSE_NO` AS `D_DRIVER_LICENSE_NO`, `fbc`.`D_MUDGUARD_NO` AS `D_MUDGUARD_NO`, `bi`.`DTI_REGISTRATION_NO` AS `D_CR_NO`, `fbc`.`D_OR_NO` AS `D_OR_NO`, `fbc`.`D_OR_DATE` AS `D_OR_DATE`, `fbc`.`APPLICANT_NAME` AS `OPERATOR_NAME`, `sw`.`SCOPE_OF_WORK_NAME` AS `SCOPE_OF_WORK_NAME`, `fbc`.`MAKE` AS `MAKE`, `fbc`.`PLATE_NO` AS `PLATE_NO`, `bi`.`DTI_NO_DATE` AS `DTI_NO_DATE`, `bi`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `bi`.`OWNER_ADDRESS` AS `OWNER_ADDRESS` FROM ((((((((`t_application_form` `af` join `r_paper_type` `paper` on(`paper`.`PAPER_TYPE_ID` = `af`.`REQUESTED_PAPER_TYPE_ID`)) left join `t_bf_barangay_certification` `bc` on(`bc`.`FORM_ID` = `af`.`FORM_ID`)) left join `t_clearance_certification` `cc` on(`cc`.`FORM_ID` = `af`.`FORM_ID`)) left join `t_application_form_evaluation` `tafe` on(`af`.`FORM_ID` = `tafe`.`FORM_ID`)) join `t_business_information` `bi` on(`bi`.`BUSINESS_ID` = `af`.`BUSINESS_ID`)) join `r_business_nature` `nature` on(`bi`.`BUSINESS_NATURE_ID` = `nature`.`BUSINESS_NATURE_ID`)) left join `t_bf_barangay_clearance` `fbc` on(`af`.`FORM_ID` = `fbc`.`FORM_ID`)) left join `t_bf_scope_of_work` `sw` on(`fbc`.`SCOPE_OF_WORK_ID` = `sw`.`SCOPE_OF_WORK_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_generatectrno`
--
DROP TABLE IF EXISTS `v_generatectrno`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_generatectrno`  AS SELECT concat(year(current_timestamp()),month(current_timestamp()),dayofmonth(current_timestamp())) AS `CTR_NO` ;

-- --------------------------------------------------------

--
-- Structure for view `v_get_deregatory`
--
DROP TABLE IF EXISTS `v_get_deregatory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_get_deregatory`  AS SELECT `cd`.`RESIDENT_ID` AS `RESIDENT_ID`, `blot`.`BLOTTER_ID` AS `BLOTTER_ID`, `blot`.`BLOTTER_CODE` AS `BLOTTER_CODE`, `blot`.`BLOTTER_SUBJECT` AS `BLOTTER_SUBJECT`, `blot`.`INCIDENT_DATE` AS `INCIDENT_DATE`, `blot`.`INCIDENT_AREA` AS `INCIDENT_AREA`, `blot`.`COMPLAINT_NAME` AS `COMPLAINT_NAME`, `blot`.`COMPLAINT_STATEMENT` AS `COMPLAINT_STATEMENT`, `blot`.`RESPONDENT` AS `RESPONDENT` FROM (`t_confirm_deregatory` `cd` join `t_blotter` `blot` on(`cd`.`BLOTTER_ID` = `blot`.`BLOTTER_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_get_gross`
--
DROP TABLE IF EXISTS `v_get_gross`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_get_gross`  AS SELECT `ba`.`BUSINESS_ID` AS `BUSINESS_ID`, sum(ifnull(`ba`.`GROSS_RECEIPTS_ESSENTIAL`,0) + ifnull(`ba`.`GROSS_RECEIPTS_NON_ESSENTIAL`,0)) AS `GROSS_TOTAL` FROM `v_business_activity` AS `ba` GROUP BY `ba`.`BUSINESS_ID` ;

-- --------------------------------------------------------

--
-- Structure for view `v_household_information`
--
DROP TABLE IF EXISTS `v_household_information`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_household_information`  AS SELECT `hi`.`HOUSEHOLD_ID` AS `HOUSEHOLD_ID`, concat(`t`.`LASTNAME`,' ',`t`.`FIRSTNAME`,' ',`t`.`MIDDLENAME`) AS `FULLNAME`, `hi`.`HOME_OWNERSHIP` AS `HOME_OWNERSHIP`, `hi`.`PERSON_STAYING_IN_HOUSEHOLD` AS `PERSON_STAYING_IN_HOUSEHOLD`, `hi`.`HOME_MATERIALS` AS `HOME_MATERIALS`, `t`.`LASTNAME` AS `LASTNAME`, `t`.`FIRSTNAME` AS `FIRSTNAME`, `t`.`MIDDLENAME` AS `MIDDLENAME`, `hi`.`TOILET_HOME` AS `TOILET_HOME`, `hi`.`PLAY_AREA_HOME` AS `PLAY_AREA_HOME`, `hi`.`BEDROOM_HOME` AS `BEDROOM_HOME`, `hi`.`DINING_ROOM_HOME` AS `DINING_ROOM_HOME`, `hi`.`SALA_HOME` AS `SALA_HOME`, `hi`.`KITCHEN_HOME` AS `KITCHEN_HOME`, `hi`.`WATER_UTILITIES` AS `WATER_UTILITIES`, `hi`.`ELECTRICITY_UTILITIES` AS `ELECTRICITY_UTILITIES`, `hi`.`AIRCON_UTILITIES` AS `AIRCON_UTILITIES`, `hi`.`PHONE_UTILITIES` AS `PHONE_UTILITIES`, `hi`.`COMPUTER_UTILITIES` AS `COMPUTER_UTILITIES`, `hi`.`INTERNET_UTILITIES` AS `INTERNET_UTILITIES`, `hi`.`TV_UTILITIES` AS `TV_UTILITIES`, `hi`.`CD_PLAYER_UTILITIES` AS `CD_PLAYER_UTILITIES`, `hi`.`RADIO_UTILITIES` AS `RADIO_UTILITIES`, `hi`.`COMICS_ENTERTAINMENT` AS `COMICS_ENTERTAINMENT`, `hi`.`NEWS_PAPER_ENTERTAINMENT` AS `NEWS_PAPER_ENTERTAINMENT`, `hi`.`PETS_ENTERTAINMENT` AS `PETS_ENTERTAINMENT`, `hi`.`BOOKS_ENTERTAINMENT` AS `BOOKS_ENTERTAINMENT`, `hi`.`STORY_BOOKS_ENTERTAINMENT` AS `STORY_BOOKS_ENTERTAINMENT`, `hi`.`TOYS_ENTERTAINMENT` AS `TOYS_ENTERTAINMENT`, `hi`.`BOARD_GAMES_ENTERTAINMENT` AS `BOARD_GAMES_ENTERTAINMENT`, `hi`.`PUZZLES_ENTERTAINMENT` AS `PUZZLES_ENTERTAINMENT`, `hi`.`NUMBER_OF_ROOMS` AS `NUMBER_OF_ROOMS`, `tb`.`FAMILY_HEADER_ID` AS `FAMILY_HEADER_ID` FROM (((`t_resident_basic_info` `t` join `t_household_information` `hi` on(`t`.`HOUSEHOLD_ID` = `hi`.`HOUSEHOLD_ID`)) left join `t_household_members` `th` on(`t`.`RESIDENT_ID` = `th`.`RESIDENT_ID`)) left join `t_household_batch` `tb` on(`th`.`FAMILY_HEADER_ID` = `tb`.`FAMILY_HEADER_ID`)) WHERE lcase(`t`.`RELATION_TO_HOUSEHOLD_HEAD`) = 'HEAD' ;

-- --------------------------------------------------------

--
-- Structure for view `v_line_of_business`
--
DROP TABLE IF EXISTS `v_line_of_business`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_line_of_business`  AS SELECT `r_bf_line_of_business`.`LINE_OF_BUSINESS_ID` AS `LINE_OF_BUSINESS_ID`, `r_bf_line_of_business`.`LINE_OF_BUSINESS_NAME` AS `LINE_OF_BUSINESS_NAME` FROM `r_bf_line_of_business` ;

-- --------------------------------------------------------

--
-- Structure for view `v_official_business_list`
--
DROP TABLE IF EXISTS `v_official_business_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_official_business_list`  AS SELECT `b`.`BUSINESS_ID` AS `BUSINESS_ID`, `b`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `b`.`TRADE_NAME` AS `TRADE_NAME`, `b`.`BUSINESS_OWNER_FIRSTNAME` AS `BUSINESS_OWNER_FIRSTNAME`, `b`.`BUSINESS_OWNER_MIDDLENAME` AS `BUSINESS_OWNER_MIDDLENAME`, `b`.`BUSINESS_OWNER_LASTNAME` AS `BUSINESS_OWNER_LASTNAME`, `b`.`BUSINESS_ADDRESS` AS `BUSINESS_ADDRESS`, `b`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `b`.`BUSINESS_OR_ACQUIRED_DATE` AS `BUSINESS_OR_ACQUIRED_DATE`, `b`.`TIN_NO` AS `TIN_NO`, `b`.`DTI_REGISTRATION_NO` AS `DTI_REGISTRATION_NO`, `b`.`BUSINESS_POSTAL_CODE` AS `BUSINESS_POSTAL_CODE`, `b`.`BUSINESS_EMAIL_ADD` AS `BUSINESS_EMAIL_ADD`, `b`.`BUSINESS_TELEPHONE_NO` AS `BUSINESS_TELEPHONE_NO`, `b`.`BUSINESS_AREA` AS `BUSINESS_AREA`, timestampdiff(YEAR,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_YEAR`, timestampdiff(MONTH,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_MONTH`, `ba`.`LINE_OF_BUSINESS_NAME` AS `BUSINESS_NATURE_NAME`, `ba`.`LINE_OF_BUSINESS_ID` AS `LINE_OF_BUSINESS_ID`, `b`.`STATUS` AS `STATUS`, `b`.`NEW_RENEW_STATUS` AS `NEW_RENEW_STATUS`, `b`.`REFERENCED_BUSINESS_ID` AS `REFERENCED_BUSINESS_ID`, `b`.`EVALUATED` AS `EVALUATED`, `b`.`CREATED_AT` AS `CREATED_AT` FROM (`t_business_information` `b` join `r_bf_line_of_business` `ba` on(`b`.`BUSINESS_NATURE_ID` = `ba`.`LINE_OF_BUSINESS_ID`)) ORDER BY `b`.`CREATED_AT` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `v_paper_type`
--
DROP TABLE IF EXISTS `v_paper_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_paper_type`  AS SELECT `r_paper_type`.`PAPER_TYPE_ID` AS `PAPER_TYPE_ID`, `r_paper_type`.`PAPER_TYPE_NAME` AS `PAPER_TYPE_NAME`, `r_paper_type`.`PAPER_TYPE_CATEGORY` AS `PAPER_TYPE_CATEGORY`, `r_paper_type`.`PAPER_TYPE_DECRIPTION` AS `PAPER_TYPE_DECRIPTION`, `r_paper_type`.`CREATED_AT` AS `CREATED_AT`, `r_paper_type`.`UPDATED_AT` AS `UPDATED_AT`, `r_paper_type`.`ACTIVE_FLAG` AS `ACTIVE_FLAG`, `r_paper_type`.`PAPER_TYPE_CODE` AS `PAPER_TYPE_CODE` FROM `r_paper_type` ;

-- --------------------------------------------------------

--
-- Structure for view `v_pending_application_form`
--
DROP TABLE IF EXISTS `v_pending_application_form`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pending_application_form`  AS SELECT `b`.`BUSINESS_ID` AS `BUSINESS_ID`, `b`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `b`.`TRADE_NAME` AS `TRADE_NAME`, `b`.`BUSINESS_OWNER_FIRSTNAME` AS `BUSINESS_OWNER_FIRSTNAME`, `b`.`BUSINESS_OWNER_MIDDLENAME` AS `BUSINESS_OWNER_MIDDLENAME`, `b`.`BUSINESS_OWNER_LASTNAME` AS `BUSINESS_OWNER_LASTNAME`, `b`.`BUSINESS_ADDRESS` AS `BUSINESS_ADDRESS`, `b`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `b`.`BUSINESS_OR_ACQUIRED_DATE` AS `BUSINESS_OR_ACQUIRED_DATE`, `b`.`TIN_NO` AS `TIN_NO`, `b`.`DTI_REGISTRATION_NO` AS `DTI_REGISTRATION_NO`, `b`.`BUSINESS_POSTAL_CODE` AS `BUSINESS_POSTAL_CODE`, `b`.`BUSINESS_EMAIL_ADD` AS `BUSINESS_EMAIL_ADD`, `b`.`BUSINESS_TELEPHONE_NO` AS `BUSINESS_TELEPHONE_NO`, `b`.`BUSINESS_AREA` AS `BUSINESS_AREA`, timestampdiff(YEAR,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_YEAR`, timestampdiff(MONTH,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_MONTH`, `af`.`STATUS` AS `STATUS`, `af`.`FORM_ID` AS `FORM_ID`, `af`.`FORM_NUMBER` AS `FORM_NUMBER`, `af`.`APPLICANT_NAME` AS `APPLICANT_NAME`, (select `r_paper_type`.`PAPER_TYPE_NAME` from `r_paper_type` where `r_paper_type`.`PAPER_TYPE_ID` = `af`.`REQUESTED_PAPER_TYPE_ID`) AS `REQUESTED_PAPER_TYPE`, (select `r_paper_type`.`PAPER_TYPE_NAME` from `r_paper_type` where `r_paper_type`.`PAPER_TYPE_ID` = `af`.`PAPER_TYPE_ID`) AS `FORM_PAPER_TYPE`, cast(`af`.`CREATED_AT` as datetime) AS `REQUESTED_DATE`, `af`.`REQUESTED_PAPER_TYPE_ID` AS `REQUESTED_PAPER_TYPE_ID`, `af`.`PAPER_TYPE_ID` AS `PAPER_TYPE_ID`, cast(`af`.`FORM_DATE` as date) AS `FORM_DATE`, group_concat(`nature`.`BUSINESS_NATURE_NAME` separator '\n') AS `BUSINESS_NATURE_NAME` FROM ((((`t_business_information` `b` join `t_bf_business_activity` `ba` on(`ba`.`BUSINESS_ID` = `b`.`BUSINESS_ID`)) join `r_business_nature` `nature` on(`ba`.`LINE_OF_BUSINESS_ID` = `nature`.`BUSINESS_NATURE_ID`)) join `t_application_form` `af` on(`af`.`BUSINESS_ID` = `b`.`BUSINESS_ID`)) join `r_paper_type` `pt` on(`pt`.`PAPER_TYPE_ID` = `af`.`PAPER_TYPE_ID`)) WHERE `b`.`STATUS` = 'Approved' AND `af`.`STATUS` = 'Pending' GROUP BY `b`.`BUSINESS_ID`, `b`.`BUSINESS_NAME`, `b`.`TRADE_NAME`, `b`.`BUSINESS_OWNER_FIRSTNAME`, `b`.`BUSINESS_OWNER_MIDDLENAME`, `b`.`BUSINESS_OWNER_LASTNAME`, `b`.`BUSINESS_ADDRESS`, `b`.`BUSINESS_OR_NUMBER`, `b`.`BUSINESS_OR_ACQUIRED_DATE`, `b`.`TIN_NO`, `b`.`DTI_REGISTRATION_NO`, `b`.`BUSINESS_POSTAL_CODE`, `b`.`BUSINESS_EMAIL_ADD`, `b`.`BUSINESS_TELEPHONE_NO`, `b`.`BUSINESS_AREA`, `af`.`STATUS`, `af`.`FORM_ID`, `af`.`FORM_NUMBER`, `af`.`APPLICANT_NAME`, `af`.`CREATED_AT`, `af`.`FORM_DATE`, `af`.`REQUESTED_PAPER_TYPE_ID`, `af`.`PAPER_TYPE_ID` ;

-- --------------------------------------------------------

--
-- Structure for view `v_permit_line_of_business`
--
DROP TABLE IF EXISTS `v_permit_line_of_business`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_permit_line_of_business`  AS SELECT `ba`.`BUSINESS_ID` AS `BUSINESS_ID`, `lob`.`BUSINESS_NATURE_NAME` AS `LINE_OF_BUSINESS_NAME` FROM (`t_bf_business_activity` `ba` join `r_business_nature` `lob` on(`ba`.`LINE_OF_BUSINESS_ID` = `lob`.`BUSINESS_NATURE_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_qualified_for_permit`
--
DROP TABLE IF EXISTS `v_qualified_for_permit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_qualified_for_permit`  AS SELECT `b`.`BUSINESS_ID` AS `BUSINESS_ID`, `b`.`BUSINESS_NAME` AS `BUSINESS_NAME`, `b`.`TRADE_NAME` AS `TRADE_NAME`, `b`.`BUSINESS_OWNER_FIRSTNAME` AS `BUSINESS_OWNER_FIRSTNAME`, `b`.`BUSINESS_OWNER_MIDDLENAME` AS `BUSINESS_OWNER_MIDDLENAME`, `b`.`BUSINESS_OWNER_LASTNAME` AS `BUSINESS_OWNER_LASTNAME`, `b`.`BUSINESS_ADDRESS` AS `BUSINESS_ADDRESS`, `b`.`BUSINESS_OR_NUMBER` AS `BUSINESS_OR_NUMBER`, `b`.`BUSINESS_OR_ACQUIRED_DATE` AS `BUSINESS_OR_ACQUIRED_DATE`, `b`.`TIN_NO` AS `TIN_NO`, `b`.`DTI_REGISTRATION_NO` AS `DTI_REGISTRATION_NO`, `b`.`BUSINESS_POSTAL_CODE` AS `BUSINESS_POSTAL_CODE`, `b`.`BUSINESS_EMAIL_ADD` AS `BUSINESS_EMAIL_ADD`, `b`.`BUSINESS_TELEPHONE_NO` AS `BUSINESS_TELEPHONE_NO`, `b`.`BUSINESS_AREA` AS `BUSINESS_AREA`, timestampdiff(YEAR,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_YEAR`, timestampdiff(MONTH,`b`.`BUSINESS_OR_ACQUIRED_DATE`,curdate()) AS `BUSINESS_PERIOD_MONTH`, `ba`.`LINE_OF_BUSINESS_NAME` AS `BUSINESS_NATURE_NAME`, `ba`.`LINE_OF_BUSINESS_ID` AS `LINE_OF_BUSINESS_ID`, `b`.`STATUS` AS `STATUS`, `b`.`NEW_RENEW_STATUS` AS `NEW_RENEW_STATUS`, `b`.`REFERENCED_BUSINESS_ID` AS `REFERENCED_BUSINESS_ID`, `b`.`EVALUATED` AS `EVALUATED`, sum(ifnull(`bp`.`GROSS_RECEIPTS_ESSENTIAL`,0) + ifnull(`bp`.`GROSS_RECEIPTS_NON_ESSENTIAL`,0)) AS `GROSS_TOTAL` FROM ((`t_business_information` `b` join `r_bf_line_of_business` `ba` on(`b`.`BUSINESS_NATURE_ID` = `ba`.`LINE_OF_BUSINESS_ID`)) join `t_bf_business_activity` `bp` on(`b`.`BUSINESS_ID` = `bp`.`BUSINESS_ID`)) GROUP BY `b`.`BUSINESS_ID`, `b`.`BUSINESS_NAME`, `b`.`TRADE_NAME`, `b`.`BUSINESS_OWNER_FIRSTNAME`, `b`.`BUSINESS_OWNER_MIDDLENAME`, `b`.`BUSINESS_OWNER_LASTNAME`, `b`.`BUSINESS_ADDRESS`, `b`.`BUSINESS_OR_NUMBER`, `b`.`BUSINESS_OR_ACQUIRED_DATE`, `b`.`TIN_NO`, `b`.`DTI_REGISTRATION_NO`, `b`.`BUSINESS_POSTAL_CODE`, `b`.`BUSINESS_EMAIL_ADD`, `b`.`BUSINESS_TELEPHONE_NO`, `b`.`BUSINESS_AREA`, `ba`.`LINE_OF_BUSINESS_NAME`, `ba`.`LINE_OF_BUSINESS_ID`, `b`.`STATUS`, `b`.`NEW_RENEW_STATUS`, `b`.`REFERENCED_BUSINESS_ID`, `b`.`EVALUATED` HAVING sum(ifnull(`bp`.`GROSS_RECEIPTS_ESSENTIAL`,0) + ifnull(`bp`.`GROSS_RECEIPTS_NON_ESSENTIAL`,0)) <= 30000 ;

-- --------------------------------------------------------

--
-- Structure for view `v_realbarangayofficialsaccount`
--
DROP TABLE IF EXISTS `v_realbarangayofficialsaccount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_realbarangayofficialsaccount`  AS SELECT `bo`.`BARANGAY_OFFICIAL_ID` AS `BARANGAY_OFFICIAL_ID`, `bo`.`BARANGAY_ID` AS `BARANGAY_ID`, `u`.`USER_ID` AS `USER_ID`, concat(`rbi`.`FIRSTNAME`,' ',`rbi`.`MIDDLENAME`,' ',`rbi`.`LASTNAME`) AS `FULLNAME`, `u`.`USERNAME` AS `USERNAME`, `u`.`PASSWORD` AS `PASSWORD`, `bs`.`BARANGAY_NAME` AS `BARANGAY_NAME`, `p`.`POSITION_NAME` AS `POSITION_NAME`, `u`.`EMAIL` AS `EMAIL`, `bo`.`START_TERM` AS `START_TERM`, `bo`.`END_TERM` AS `END_TERM`, `u`.`PERMIS_RESIDENT_BASIC_INFO` AS `PERMIS_RESIDENT_BASIC_INFO`, `u`.`PERMIS_FAMILY_PROFILE` AS `PERMIS_FAMILY_PROFILE`, `u`.`PERMIS_COMMUNITY_PROFILE` AS `PERMIS_COMMUNITY_PROFILE`, `u`.`PERMIS_BLOTTER` AS `PERMIS_BLOTTER`, `u`.`PERMIS_PATAWAG` AS `PERMIS_PATAWAG`, `u`.`PERMIS_BARANGAY_OFFICIAL` AS `PERMIS_BARANGAY_OFFICIAL`, `u`.`PERMIS_BUSINESSES` AS `PERMIS_BUSINESSES`, `u`.`PERMIS_ISSUANCE_OF_FORMS` AS `PERMIS_ISSUANCE_OF_FORMS`, `u`.`PERMIS_ORDINANCES` AS `PERMIS_ORDINANCES`, `u`.`PERMIS_SYSTEM_REPORT` AS `PERMIS_SYSTEM_REPORT`, `u`.`PERMIS_HEALTH_SERVICES` AS `PERMIS_HEALTH_SERVICES`, `u`.`PERMIS_DATA_MIGRATION` AS `PERMIS_DATA_MIGRATION`, `u`.`PERMIS_USER_ACCOUNTS` AS `PERMIS_USER_ACCOUNTS`, `u`.`PERMIS_BARANGAY_CONFIG` AS `PERMIS_BARANGAY_CONFIG`, `u`.`PERMIS_BUSINESS_APPROVAL` AS `PERMIS_BUSINESS_APPROVAL`, `u`.`PERMIS_APPLICATION_FORM` AS `PERMIS_APPLICATION_FORM`, `u`.`PERMIS_APPLICATION_FORM_EVALUATION` AS `PERMIS_APPLICATION_FORM_EVALUATION`, `bo`.`ACTIVE_FLAG` AS `ACTIVE_FLAG`, `bs`.`BARANGAY_SEAL` AS `BARANGAY_SEAL`, `mi`.`MUNICIPAL_SEAL` AS `MUNICIPAL_SEAL`, `mi`.`MUNICIPAL_NAME` AS `MUNICIPAL_NAME`, `mi`.`PROVINCE_NAME` AS `PROVINCE_NAME` FROM (((((`t_users` `u` join `t_barangay_official` `bo` on(`bo`.`BARANGAY_OFFICIAL_ID` = `u`.`BARANGAY_OFFICIAL_ID`)) join `r_barangay_information` `bs` on(`bs`.`BARANGAY_ID` = `bo`.`BARANGAY_ID`)) join `t_resident_basic_info` `rbi` on(`bo`.`RESIDENT_ID` = `rbi`.`RESIDENT_ID`)) join `r_position` `p` on(`p`.`POSITION_ID` = `u`.`POSITION_ID`)) join `r_municipal_information` `mi` on(`mi`.`MUNICIPAL_ID` = `bs`.`MUNICIPAL_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_resident`
--
DROP TABLE IF EXISTS `v_resident`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_resident`  AS SELECT `t_resident_basic_info`.`RESIDENT_ID` AS `RESIDENT_ID`, concat(`t_resident_basic_info`.`FIRSTNAME`,' ',`t_resident_basic_info`.`MIDDLENAME`,' ',`t_resident_basic_info`.`LASTNAME`) AS `RESIDENT_NAME`, `t_resident_basic_info`.`ADDRESS` AS `ADDRESS`, timestampdiff(YEAR,`t_resident_basic_info`.`DATE_OF_BIRTH`,curdate()) AS `AGE`, `t_resident_basic_info`.`SEX` AS `SEX`, `t_resident_basic_info`.`IS_OFW` AS `IS_OFW`, `t_resident_basic_info`.`CIVIL_STATUS` AS `CIVIL_STATUS`, `t_resident_basic_info`.`FIRSTNAME` AS `FIRSTNAME`, `t_resident_basic_info`.`MIDDLENAME` AS `MIDDLENAME`, `t_resident_basic_info`.`LASTNAME` AS `LASTNAME` FROM `t_resident_basic_info` ;

-- --------------------------------------------------------

--
-- Structure for view `v_useraccounts`
--
DROP TABLE IF EXISTS `v_useraccounts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_useraccounts`  AS SELECT `u`.`BARANGAY_OFFICIAL_ID` AS `BARANGAY_OFFICIAL_ID`, `p`.`POSITION_NAME` AS `POSITION_NAME`, ifnull(`bi`.`BARANGAY_NAME`,'Null') AS `BARANGAY_NAME`, `u`.`LASTNAME` AS `LASTNAME`, `u`.`FIRSTNAME` AS `FIRSTNAME`, `u`.`MIDDLENAME` AS `MIDDLENAME`, `u`.`USERNAME` AS `USERNAME`, `u`.`PASSWORD` AS `PASSWORD`, `u`.`ACTIVE_FLAG` AS `ACTIVE_FLAG`, `u`.`IS_FIRST_LOGGED_IN` AS `IS_FIRST_LOGGED_IN`, `u`.`USER_ID` AS `USER_ID` FROM (((`t_users` `u` left join `t_barangay_official` `bo` on(`u`.`BARANGAY_OFFICIAL_ID` = `bo`.`BARANGAY_OFFICIAL_ID`)) join `r_position` `p` on(`u`.`POSITION_ID` = `p`.`POSITION_ID`)) left join `r_barangay_information` `bi` on(`bo`.`BARANGAY_ID` = `bi`.`BARANGAY_ID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `r_barangay_information`
--
ALTER TABLE `r_barangay_information`
  ADD PRIMARY KEY (`BARANGAY_ID`) USING BTREE;

--
-- Indexes for table `r_barangay_zone`
--
ALTER TABLE `r_barangay_zone`
  ADD PRIMARY KEY (`BARANGAY_ZONE_ID`) USING BTREE,
  ADD KEY `FK_B_ID_BRGY_INFO` (`BARANGAY_ID`) USING BTREE;

--
-- Indexes for table `r_bf_line_of_business`
--
ALTER TABLE `r_bf_line_of_business`
  ADD PRIMARY KEY (`LINE_OF_BUSINESS_ID`) USING BTREE,
  ADD KEY `LINE_OF_BUSINESS_ID` (`LINE_OF_BUSINESS_ID`) USING BTREE,
  ADD KEY `LINE_OF_BUSINESS_ID_2` (`LINE_OF_BUSINESS_ID`) USING BTREE,
  ADD KEY `LINE_OF_BUSINESS_ID_3` (`LINE_OF_BUSINESS_ID`) USING BTREE,
  ADD KEY `LINE_OF_BUSINESS_ID_4` (`LINE_OF_BUSINESS_ID`) USING BTREE,
  ADD KEY `LINE_OF_BUSINESS_ID_5` (`LINE_OF_BUSINESS_ID`) USING BTREE;

--
-- Indexes for table `r_blotter_subjects`
--
ALTER TABLE `r_blotter_subjects`
  ADD PRIMARY KEY (`BLOTTER_SUBJECT_ID`) USING BTREE;

--
-- Indexes for table `r_business_nature`
--
ALTER TABLE `r_business_nature`
  ADD PRIMARY KEY (`BUSINESS_NATURE_ID`) USING BTREE;

--
-- Indexes for table `r_municipal_information`
--
ALTER TABLE `r_municipal_information`
  ADD PRIMARY KEY (`MUNICIPAL_ID`) USING BTREE;

--
-- Indexes for table `r_ordinance_category`
--
ALTER TABLE `r_ordinance_category`
  ADD PRIMARY KEY (`ORDINANCE_CATEGORY_ID`) USING BTREE;

--
-- Indexes for table `r_paper_type`
--
ALTER TABLE `r_paper_type`
  ADD PRIMARY KEY (`PAPER_TYPE_ID`);

--
-- Indexes for table `r_position`
--
ALTER TABLE `r_position`
  ADD PRIMARY KEY (`POSITION_ID`) USING BTREE;

--
-- Indexes for table `r_resident_type`
--
ALTER TABLE `r_resident_type`
  ADD PRIMARY KEY (`TYPE_ID`) USING BTREE;

--
-- Indexes for table `t_application_form`
--
ALTER TABLE `t_application_form`
  ADD PRIMARY KEY (`FORM_ID`) USING BTREE,
  ADD KEY `PAPER_TYPE_ID` (`PAPER_TYPE_ID`) USING BTREE,
  ADD KEY `FK_ApplicationForm_BusinessInformation` (`BUSINESS_ID`) USING BTREE,
  ADD KEY `FK_ApplicationForm_Resident` (`RESIDENT_ID`) USING BTREE,
  ADD KEY `FK_ApplicationFormRequest_PaperType` (`REQUESTED_PAPER_TYPE_ID`) USING BTREE,
  ADD KEY `WEIGHTS_AND_MEASURE_ID` (`WEIGHTS_AND_MEASURE_ID`);

--
-- Indexes for table `t_application_form_evaluation`
--
ALTER TABLE `t_application_form_evaluation`
  ADD PRIMARY KEY (`AF_EVALUATION_ID`),
  ADD KEY `FK_ApplicationFormEvaluation_ApplicationForm` (`FORM_ID`);

--
-- Indexes for table `t_barangay_official`
--
ALTER TABLE `t_barangay_official`
  ADD PRIMARY KEY (`BARANGAY_OFFICIAL_ID`) USING BTREE,
  ADD KEY `FK_BO_ID_BRGY_INFO` (`BARANGAY_ID`) USING BTREE,
  ADD KEY `FK_R_ID_T_RESIDENTS` (`RESIDENT_ID`) USING BTREE,
  ADD KEY `FK_POSITION_ID_R_POSITION` (`POSITION_ID`);

--
-- Indexes for table `t_bf_barangay_certification`
--
ALTER TABLE `t_bf_barangay_certification`
  ADD PRIMARY KEY (`BARANGAY_CERTIFICATION_ID`),
  ADD KEY `FK_BarangayCertification_ApplicationForm` (`FORM_ID`);

--
-- Indexes for table `t_bf_barangay_clearance`
--
ALTER TABLE `t_bf_barangay_clearance`
  ADD PRIMARY KEY (`BARANGAY_CLEARANCE_ID`) USING BTREE,
  ADD KEY `fk_BarangayClearance_ScopeOfWork` (`SCOPE_OF_WORK_ID`) USING BTREE,
  ADD KEY `FK_BarangayClearance_ApplicationForm` (`FORM_ID`);

--
-- Indexes for table `t_bf_business_activity`
--
ALTER TABLE `t_bf_business_activity`
  ADD PRIMARY KEY (`BUSINESS_ACTIVITY_ID`) USING BTREE,
  ADD KEY `fk_BusinessActivity_LineOfBusiness` (`LINE_OF_BUSINESS_ID`) USING BTREE,
  ADD KEY `FK_BusinessActivity_BusinessInfo` (`BUSINESS_ID`);

--
-- Indexes for table `t_bf_business_permit`
--
ALTER TABLE `t_bf_business_permit`
  ADD PRIMARY KEY (`BUSINESS_PERMIT_ID`) USING BTREE,
  ADD KEY `FK_BusinessPermit_ApplicationForm` (`FORM_ID`);

--
-- Indexes for table `t_bf_scope_of_work`
--
ALTER TABLE `t_bf_scope_of_work`
  ADD PRIMARY KEY (`SCOPE_OF_WORK_ID`) USING BTREE,
  ADD KEY `SCOPE_OF_WORK_ID` (`SCOPE_OF_WORK_ID`) USING BTREE,
  ADD KEY `SCOPE_OF_WORK_ID_2` (`SCOPE_OF_WORK_ID`) USING BTREE;

--
-- Indexes for table `t_blotter`
--
ALTER TABLE `t_blotter`
  ADD PRIMARY KEY (`BLOTTER_ID`) USING BTREE,
  ADD KEY `t_blotter_blotter_subject_foreign` (`BLOTTER_SUBJECT_ID`) USING BTREE,
  ADD KEY `t_blotter_accused_resident_foreign` (`ACCUSED_RESIDENT`) USING BTREE;

--
-- Indexes for table `t_building_information`
--
ALTER TABLE `t_building_information`
  ADD PRIMARY KEY (`BUILDING_ID`);

--
-- Indexes for table `t_building_transactions`
--
ALTER TABLE `t_building_transactions`
  ADD PRIMARY KEY (`TRANSACTION_ID`);

--
-- Indexes for table `t_business_approval`
--
ALTER TABLE `t_business_approval`
  ADD PRIMARY KEY (`APPROVAL_ID`) USING BTREE,
  ADD KEY `fk_Approval_Business` (`BUSINESS_ID`) USING BTREE;

--
-- Indexes for table `t_business_information`
--
ALTER TABLE `t_business_information`
  ADD PRIMARY KEY (`BUSINESS_ID`) USING BTREE,
  ADD KEY `FK_B_N_ID_TBINFO` (`BUSINESS_NATURE_ID`) USING BTREE,
  ADD KEY `FK_B_Z_ID_TBZONE` (`BARANGAY_ZONE_ID`) USING BTREE,
  ADD KEY `REFERENCED_BUSINESS_ID` (`REFERENCED_BUSINESS_ID`);

--
-- Indexes for table `t_children_profile`
--
ALTER TABLE `t_children_profile`
  ADD PRIMARY KEY (`CHILDREN_ID`) USING BTREE,
  ADD KEY `FK_CP_R_ID` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_clearance_certification`
--
ALTER TABLE `t_clearance_certification`
  ADD PRIMARY KEY (`CLEARANCE_CERTIFICATION_ID`),
  ADD KEY `FK_ClearanceCertification_ApplicationForm` (`FORM_ID`),
  ADD KEY `FK_ClearanceCertification_PaperType` (`PAPER_TYPE_ID`);

--
-- Indexes for table `t_fathers_profile`
--
ALTER TABLE `t_fathers_profile`
  ADD PRIMARY KEY (`FATHERS_ID`) USING BTREE,
  ADD KEY `FK_FP_R_ID` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_food_eaten`
--
ALTER TABLE `t_food_eaten`
  ADD PRIMARY KEY (`FOOD_EATEN_ID`) USING BTREE,
  ADD KEY `FK_C_ID_CPROFILE` (`CHILDREN_ID`) USING BTREE;

--
-- Indexes for table `t_household_batch`
--
ALTER TABLE `t_household_batch`
  ADD PRIMARY KEY (`FAMILY_HEADER_ID`) USING BTREE;

--
-- Indexes for table `t_household_information`
--
ALTER TABLE `t_household_information`
  ADD PRIMARY KEY (`HOUSEHOLD_ID`) USING BTREE,
  ADD KEY `FK_B_ID_HOUSEHOLDINFO` (`BARANGAY_ID`) USING BTREE;

--
-- Indexes for table `t_household_members`
--
ALTER TABLE `t_household_members`
  ADD PRIMARY KEY (`FAMILY_INFORMATION_ID`) USING BTREE;

--
-- Indexes for table `t_hs_adolescent`
--
ALTER TABLE `t_hs_adolescent`
  ADD PRIMARY KEY (`ADOLESCENT_ID`) USING BTREE,
  ADD KEY `FK_HS_A_R_ID` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_child`
--
ALTER TABLE `t_hs_child`
  ADD PRIMARY KEY (`CHILD_ID`) USING BTREE,
  ADD KEY `FK_HS_C_INFANT_ID` (`INFANT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_chronic_cough`
--
ALTER TABLE `t_hs_chronic_cough`
  ADD PRIMARY KEY (`CHRONIC_COUGH_ID`) USING BTREE,
  ADD KEY `FK_HS_CC_R_ID` (`RESIDENT_ID`) USING BTREE,
  ADD KEY `FK_ChronicCough_NonResident` (`NONRESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_chronic_disease`
--
ALTER TABLE `t_hs_chronic_disease`
  ADD PRIMARY KEY (`CHRONIC_DISEASE_ID`) USING BTREE,
  ADD KEY `FK_HS_CD_R_ID` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_elderly`
--
ALTER TABLE `t_hs_elderly`
  ADD PRIMARY KEY (`ELDERLY_ID`) USING BTREE,
  ADD KEY `fk_elderly_resident_id` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_family_planning`
--
ALTER TABLE `t_hs_family_planning`
  ADD PRIMARY KEY (`FD_ID`) USING BTREE,
  ADD KEY `FK_HS_FP_R_ID` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_family_planning_users_visitations`
--
ALTER TABLE `t_hs_family_planning_users_visitations`
  ADD PRIMARY KEY (`VISITATION_ID`) USING BTREE,
  ADD KEY `FK_FPUV_FP_ID` (`FP_ID`) USING BTREE;

--
-- Indexes for table `t_hs_infant`
--
ALTER TABLE `t_hs_infant`
  ADD PRIMARY KEY (`INFANT_ID`) USING BTREE,
  ADD KEY `FK_HS_INFT_NB_ID` (`NEW_BORN_ID`) USING BTREE;

--
-- Indexes for table `t_hs_newborn`
--
ALTER TABLE `t_hs_newborn`
  ADD PRIMARY KEY (`NEWBORN_ID`) USING BTREE,
  ADD KEY `FK_HS_NB_R_ID` (`RESIDENT_ID`) USING BTREE,
  ADD KEY `FK_NEWBORN_NONRESIDENT` (`NONRESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_non_family_planning_users`
--
ALTER TABLE `t_hs_non_family_planning_users`
  ADD PRIMARY KEY (`NON_FP_ID`) USING BTREE,
  ADD KEY `FK_HS_NON_FPU_R_ID` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_post_partum`
--
ALTER TABLE `t_hs_post_partum`
  ADD PRIMARY KEY (`POST_PATRUM_ID`) USING BTREE,
  ADD KEY `FK_HS_PP_P_ID` (`PREGNANT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_pregnant`
--
ALTER TABLE `t_hs_pregnant`
  ADD PRIMARY KEY (`PREGNANT_ID`) USING BTREE,
  ADD KEY `FK_HS_PRG_R_ID` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_hs_pwd`
--
ALTER TABLE `t_hs_pwd`
  ADD PRIMARY KEY (`PWD_ID`) USING BTREE,
  ADD KEY `FK_HS_PWD_R_ID` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_issuance`
--
ALTER TABLE `t_issuance`
  ADD PRIMARY KEY (`ISSUANCE_ID`) USING BTREE,
  ADD KEY `FK_IS_TYPE_ID` (`ISSUANCE_TYPE_ID`) USING BTREE,
  ADD KEY `FK_IS_R_ID` (`RESIDENT_ID`) USING BTREE,
  ADD KEY `FK_IS_B_ID` (`BUSINESS_ID`) USING BTREE;

--
-- Indexes for table `t_mothers_profile`
--
ALTER TABLE `t_mothers_profile`
  ADD PRIMARY KEY (`MOTHERS_ID`) USING BTREE,
  ADD KEY `FK_M_R_ID` (`RESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_nonresident_basic_info`
--
ALTER TABLE `t_nonresident_basic_info`
  ADD PRIMARY KEY (`NONRESIDENT_ID`) USING BTREE;

--
-- Indexes for table `t_ordinance`
--
ALTER TABLE `t_ordinance`
  ADD PRIMARY KEY (`ORDINANCE_ID`) USING BTREE,
  ADD KEY `FK_O_BO_ID` (`BARANGAY_OFFICIAL_ID`) USING BTREE,
  ADD KEY `CATEGORY_ID` (`CATEGORY_ID`);

--
-- Indexes for table `t_ordinance_images`
--
ALTER TABLE `t_ordinance_images`
  ADD PRIMARY KEY (`ORDINANCE_IMAGE_ID`),
  ADD KEY `FK_ORDINANCE_IMAGE` (`ORDINANCE_ID`);

--
-- Indexes for table `t_patawag`
--
ALTER TABLE `t_patawag`
  ADD PRIMARY KEY (`PATAWAG_ID`) USING BTREE,
  ADD KEY `t_patawag_blotter_id_foreign` (`BLOTTER_ID`) USING BTREE;

--
-- Indexes for table `t_patient_records`
--
ALTER TABLE `t_patient_records`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD KEY `FK_RESIDENT_CHECKUP` (`RESIDENT_ID`);

--
-- Indexes for table `t_resident_basic_info`
--
ALTER TABLE `t_resident_basic_info`
  ADD PRIMARY KEY (`RESIDENT_ID`) USING BTREE,
  ADD KEY `FK_RBI_HS_ID` (`HOUSEHOLD_ID`) USING BTREE;

--
-- Indexes for table `t_solo_parent_children`
--
ALTER TABLE `t_solo_parent_children`
  ADD PRIMARY KEY (`CHILD_ID`),
  ADD KEY `FK_SoloParentChild_BarangayCertificaiton` (`BARANGAY_CERTIFICATION_ID`);

--
-- Indexes for table `t_transient_record`
--
ALTER TABLE `t_transient_record`
  ADD PRIMARY KEY (`TRANSIENT_RECORD_ID`) USING BTREE;

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`USER_ID`) USING BTREE,
  ADD KEY `FK_U_BO_ID` (`BARANGAY_OFFICIAL_ID`) USING BTREE,
  ADD KEY `FK_U_POS_ID` (`POSITION_ID`) USING BTREE,
  ADD KEY `FK_BRGY_ID` (`BARANGAY_ID`) USING BTREE;

--
-- Indexes for table `t_weights_and_measure`
--
ALTER TABLE `t_weights_and_measure`
  ADD PRIMARY KEY (`WEIGHTS_AND_MEASURE_ID`),
  ADD KEY `BUSINESS_ID` (`BUSINESS_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_barangay_information`
--
ALTER TABLE `r_barangay_information`
  MODIFY `BARANGAY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `r_barangay_zone`
--
ALTER TABLE `r_barangay_zone`
  MODIFY `BARANGAY_ZONE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_bf_line_of_business`
--
ALTER TABLE `r_bf_line_of_business`
  MODIFY `LINE_OF_BUSINESS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `r_blotter_subjects`
--
ALTER TABLE `r_blotter_subjects`
  MODIFY `BLOTTER_SUBJECT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `r_business_nature`
--
ALTER TABLE `r_business_nature`
  MODIFY `BUSINESS_NATURE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `r_municipal_information`
--
ALTER TABLE `r_municipal_information`
  MODIFY `MUNICIPAL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `r_ordinance_category`
--
ALTER TABLE `r_ordinance_category`
  MODIFY `ORDINANCE_CATEGORY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `r_paper_type`
--
ALTER TABLE `r_paper_type`
  MODIFY `PAPER_TYPE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `r_position`
--
ALTER TABLE `r_position`
  MODIFY `POSITION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `r_resident_type`
--
ALTER TABLE `r_resident_type`
  MODIFY `TYPE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_application_form_evaluation`
--
ALTER TABLE `t_application_form_evaluation`
  MODIFY `AF_EVALUATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `t_barangay_official`
--
ALTER TABLE `t_barangay_official`
  MODIFY `BARANGAY_OFFICIAL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_bf_barangay_certification`
--
ALTER TABLE `t_bf_barangay_certification`
  MODIFY `BARANGAY_CERTIFICATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `t_bf_barangay_clearance`
--
ALTER TABLE `t_bf_barangay_clearance`
  MODIFY `BARANGAY_CLEARANCE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `t_bf_business_activity`
--
ALTER TABLE `t_bf_business_activity`
  MODIFY `BUSINESS_ACTIVITY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `t_bf_business_permit`
--
ALTER TABLE `t_bf_business_permit`
  MODIFY `BUSINESS_PERMIT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_bf_scope_of_work`
--
ALTER TABLE `t_bf_scope_of_work`
  MODIFY `SCOPE_OF_WORK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_blotter`
--
ALTER TABLE `t_blotter`
  MODIFY `BLOTTER_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_building_information`
--
ALTER TABLE `t_building_information`
  MODIFY `BUILDING_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `t_building_transactions`
--
ALTER TABLE `t_building_transactions`
  MODIFY `TRANSACTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `t_business_approval`
--
ALTER TABLE `t_business_approval`
  MODIFY `APPROVAL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `t_business_information`
--
ALTER TABLE `t_business_information`
  MODIFY `BUSINESS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `t_children_profile`
--
ALTER TABLE `t_children_profile`
  MODIFY `CHILDREN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_clearance_certification`
--
ALTER TABLE `t_clearance_certification`
  MODIFY `CLEARANCE_CERTIFICATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `t_fathers_profile`
--
ALTER TABLE `t_fathers_profile`
  MODIFY `FATHERS_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_food_eaten`
--
ALTER TABLE `t_food_eaten`
  MODIFY `FOOD_EATEN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_household_batch`
--
ALTER TABLE `t_household_batch`
  MODIFY `FAMILY_HEADER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_household_information`
--
ALTER TABLE `t_household_information`
  MODIFY `HOUSEHOLD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `t_household_members`
--
ALTER TABLE `t_household_members`
  MODIFY `FAMILY_INFORMATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_hs_adolescent`
--
ALTER TABLE `t_hs_adolescent`
  MODIFY `ADOLESCENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_hs_child`
--
ALTER TABLE `t_hs_child`
  MODIFY `CHILD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_hs_chronic_cough`
--
ALTER TABLE `t_hs_chronic_cough`
  MODIFY `CHRONIC_COUGH_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_hs_chronic_disease`
--
ALTER TABLE `t_hs_chronic_disease`
  MODIFY `CHRONIC_DISEASE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_hs_elderly`
--
ALTER TABLE `t_hs_elderly`
  MODIFY `ELDERLY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_hs_family_planning`
--
ALTER TABLE `t_hs_family_planning`
  MODIFY `FD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_hs_family_planning_users_visitations`
--
ALTER TABLE `t_hs_family_planning_users_visitations`
  MODIFY `VISITATION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_hs_infant`
--
ALTER TABLE `t_hs_infant`
  MODIFY `INFANT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_hs_newborn`
--
ALTER TABLE `t_hs_newborn`
  MODIFY `NEWBORN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_hs_non_family_planning_users`
--
ALTER TABLE `t_hs_non_family_planning_users`
  MODIFY `NON_FP_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_hs_post_partum`
--
ALTER TABLE `t_hs_post_partum`
  MODIFY `POST_PATRUM_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_hs_pregnant`
--
ALTER TABLE `t_hs_pregnant`
  MODIFY `PREGNANT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_mothers_profile`
--
ALTER TABLE `t_mothers_profile`
  MODIFY `MOTHERS_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_nonresident_basic_info`
--
ALTER TABLE `t_nonresident_basic_info`
  MODIFY `NONRESIDENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_ordinance`
--
ALTER TABLE `t_ordinance`
  MODIFY `ORDINANCE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_ordinance_images`
--
ALTER TABLE `t_ordinance_images`
  MODIFY `ORDINANCE_IMAGE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_patawag`
--
ALTER TABLE `t_patawag`
  MODIFY `PATAWAG_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_patient_records`
--
ALTER TABLE `t_patient_records`
  MODIFY `PATIENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_resident_basic_info`
--
ALTER TABLE `t_resident_basic_info`
  MODIFY `RESIDENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_weights_and_measure`
--
ALTER TABLE `t_weights_and_measure`
  MODIFY `WEIGHTS_AND_MEASURE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_application_form`
--
ALTER TABLE `t_application_form`
  ADD CONSTRAINT `t_application_form_ibfk_1` FOREIGN KEY (`WEIGHTS_AND_MEASURE_ID`) REFERENCES `t_weights_and_measure` (`WEIGHTS_AND_MEASURE_ID`),
  ADD CONSTRAINT `t_application_form_ibfk_2` FOREIGN KEY (`WEIGHTS_AND_MEASURE_ID`) REFERENCES `t_weights_and_measure` (`WEIGHTS_AND_MEASURE_ID`);

--
-- Constraints for table `t_barangay_official`
--
ALTER TABLE `t_barangay_official`
  ADD CONSTRAINT `FK_POSITION_ID_R_POSITION` FOREIGN KEY (`POSITION_ID`) REFERENCES `r_position` (`POSITION_ID`);

--
-- Constraints for table `t_ordinance`
--
ALTER TABLE `t_ordinance`
  ADD CONSTRAINT `t_ordinance_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `r_ordinance_category` (`ORDINANCE_CATEGORY_ID`);

--
-- Constraints for table `t_patient_records`
--
ALTER TABLE `t_patient_records`
  ADD CONSTRAINT `FK_RESIDENT_CHECKUP` FOREIGN KEY (`RESIDENT_ID`) REFERENCES `t_resident_basic_info` (`RESIDENT_ID`);

--
-- Constraints for table `t_weights_and_measure`
--
ALTER TABLE `t_weights_and_measure`
  ADD CONSTRAINT `t_weights_and_measure_ibfk_1` FOREIGN KEY (`BUSINESS_ID`) REFERENCES `t_business_information` (`BUSINESS_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
