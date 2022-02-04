-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 04:14 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fmis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `account_id` int(100) NOT NULL,
  `account_code` varchar(100) NOT NULL,
  `account_description` varchar(100) NOT NULL,
  `acc_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`account_id`, `account_code`, `account_description`, `acc_category`) VALUES
(2, '1 07 04 010', 'Office Buildings', 'CAPITAL OUTLAY'),
(3, '1 07 04 990', 'Other Structures', 'CAPITAL OUTLAY'),
(4, '1 07 05 020', 'Office Equipment', 'CAPITAL OUTLAY'),
(5, '1 07 07 010', 'Furniture and Fixtures', 'CAPITAL OUTLAY'),
(6, '1 07 05 030', 'IT Equipment  and Software', 'CAPITAL OUTLAY'),
(7, '1 07 05 010', 'Machineries and Equipment', 'CAPITAL OUTLAY'),
(8, '1 07 05 040', 'Agricultural, Fishery and Forestry Equipment', 'CAPITAL OUTLAY'),
(9, '1 07 05 070', 'Communication Equipment', 'CAPITAL OUTLAY'),
(10, '1 07 05 080', 'Construction and Heavy Equipment', 'CAPITAL OUTLAY'),
(11, '1 07 05 110', 'Hospital Equipment', 'CAPITAL OUTLAY'),
(12, '1 07 05 990', 'Other Machinery and Equipment', 'CAPITAL OUTLAY'),
(13, '1 07 06 010', 'Motor Vehicles', 'CAPITAL OUTLAY'),
(14, '1 07 06 990', 'Other Transportation Equipment', 'CAPITAL OUTLAY'),
(15, '1 07 99 990', 'Other Property, Plant and Equipment', 'CAPITAL OUTLAY'),
(16, '5 01 01 010', 'Salaries and Wages - Regular ', 'PERSONAL SERVICES'),
(17, '5 01 01 020', 'Salaries and Wages - Casual', 'PERSONAL SERVICES'),
(18, '5 01 02 010', 'Personnel Economic Relief Allowance ( PERA) - Regular', 'PERSONAL SERVICES'),
(19, '5 01 02 010-1', 'Personnel Economic Relief Allowance ( PERA) - Casual', 'PERSONAL SERVICES'),
(20, '5 01 02 020', 'Representation Allowance (RA)', 'PERSONAL SERVICES'),
(21, '5 01 02 030', 'Transportation Allowance  (TA)', 'PERSONAL SERVICES'),
(22, '5 01 02 040', 'Clothing/Uniform Allowance - Regular', 'PERSONAL SERVICES'),
(23, '5 01 02 040-1', 'Clothing/Uniform Allowance - Casual', 'PERSONAL SERVICES'),
(24, '5 01 02 050', 'Subsistence Allowance', 'PERSONAL SERVICES'),
(25, '5 01 02 080', 'Productivity Incentive Allowance', 'PERSONAL SERVICES'),
(26, '5 01 02 990', 'Other Bonuses and Allowances', 'PERSONAL SERVICES'),
(27, '5 01 02 060', 'Laundry  Allowance', 'PERSONAL SERVICES'),
(28, '5 01 02 100', 'Honoraria', 'PERSONAL SERVICES'),
(29, '5 01 02 110', 'Hazard Pay', 'PERSONAL SERVICES'),
(30, '5 01 02 130', 'Overtime and Night Pay', 'PERSONAL SERVICES'),
(31, '5 01 02 120', 'Longevity Pay', 'PERSONAL SERVICES'),
(32, '5 01 02 150', 'Cash Gift', 'PERSONAL SERVICES'),
(33, '5 01 02 140', 'Year End Bonus', 'PERSONAL SERVICES'),
(34, '5 01 03 010', 'Life and Retirement Insurance Contributions - Regular', 'PERSONAL SERVICES'),
(35, '5 01 03 010 - 1', 'Life and Retirement Insurance Contributions - Casual', 'PERSONAL SERVICES'),
(36, '5 01 03 020', 'PAG-IBIG Contributions', 'PERSONAL SERVICES'),
(37, '5 01 03 020 - 1', 'PAG-IBIG Contributions - Casual', 'PERSONAL SERVICES'),
(38, '5 01 03 030', 'PHILHEALTH Contributions', 'PERSONAL SERVICES'),
(39, '5 01 03 030 - 1', 'PHILHEALTH Contributions - Casual', 'PERSONAL SERVICES'),
(40, '5 01 03 040', 'Employees Compensation Insurance Premiums - Regular', 'PERSONAL SERVICES'),
(41, '5 01 03 040 - 1', 'Employees Compensation Insurance Premiums - Casual', 'PERSONAL SERVICES'),
(42, '5 01 04 030', 'Terminal Leave Benefits', 'PERSONAL SERVICES'),
(43, '5 02 01 010', 'Traveling Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(44, '5 02 02 010', 'Training Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(45, '5 02 02 020', 'Scholarship Grants/Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(46, '5 02 03 010', 'Office Supplies Expenses ', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(47, '5 02 03 020', 'Accountable Forms Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(48, '5 02 03 040', 'Animal/Zoological Supplies Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(49, '5 02 03 050', 'Food Supplies Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(50, '5 02 03 060', 'Welfare Goods Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(51, '5 02 03 070', 'Drugs and Medicines Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(52, '5 02 03 080', 'Medical, Dental and Laboratory Supplies Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(53, '5 02 03 090', 'Fuel, Oil and Lubricants Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(54, '5 02 03 100', 'Agricultural and Marine Supplies Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(55, '5 02 03 110', 'Textbooks and Instructional Materials Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(56, '5 02 03 120', 'Military, Police and Traffic Supplies Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(57, '5 02 03 030', 'Non-Accountable Forms Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(58, '5 02 03 130', 'Chemical and Filtering Supplies Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(59, '5 02 03 990', 'Other Supplies and Materials Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(60, '5 02 04 010', 'Water Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(61, '5 02 04 020', 'Electricity Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(62, '5 02 05 010', 'Postage and Courier Services ', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(63, '5 02 05 020', 'Telephone Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(64, '5 02 05 030', 'Internet Subscription Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(65, '5 02 05 040', 'Cable, Satellite, Telegraph and Radio Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(66, '5 02 99 060', 'Membership Dues and Contributions to Organizations', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(67, '5 02 06 010', 'Awards/Rewards Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(68, '5 02 99 010', 'Advertising Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(69, '5 02 09 010', 'Generation, Transmission and Distribution Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(70, '5 02 99 050', 'Rent Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(71, '5 02 99 030', 'Representation Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(72, '5 02 99 070', 'Subscription Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(73, '5 02 07 010', 'Survey Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(74, '5 02 06 020', 'Prizes', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(75, '5 02 11 010', 'Legal Services', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(76, '5 02 11 020', 'Auditing Services', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(77, '5 02 11 030', 'Consultancy Services', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(78, '5 02 12 010', 'Environment/Sanitary Services', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(79, '5 02 12 990', 'Other General Services', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(80, '5 02 12 020', 'Janitorial Services', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(81, '5 02 12 030', 'Security Services', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(82, '5 02 11 990', 'Other Professional Services', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(83, '5 02 13 020', 'Repairs and Maintenance - Land Improvements', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(84, '5 02 13 030', 'Repairs and Maintenance - Infrastructure Assets', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(85, '5 02 13 040', 'Repairs and Maintenance - Buildings and Other Structures', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(86, '5 02 13 010', 'Repairs and Maintenance - Investment Property', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(87, '5 02 13 090', 'Repairs and Maintenance - Leased Assets Improvements', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(88, '5 02 13 050', 'Repairs and Maintenance - Machinery and Equipment ', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(89, '5 02 13 070', 'Repairs and Maintenance - Furniture and  Fixtures ', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(90, '5 02 13 060', 'Repairs and Maintenance - Transportation Equipment  ', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(91, '5 02 13 990', 'Repairs and Maintenance - Other Property, Plant and Equipment', 'MAINTENANCE AND OTHER OPERATING EXPENSES'),
(92, '5 02 99 990', 'Other Maintenance and Operating Expenses', 'MAINTENANCE AND OTHER OPERATING EXPENSES');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acc_category`
--

CREATE TABLE `tbl_acc_category` (
  `acc_category_id` int(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `cat_acronym` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_acc_category`
--

INSERT INTO `tbl_acc_category` (`acc_category_id`, `category`, `cat_acronym`, `type`) VALUES
(2, 'PERSONAL SERVICES', 'PS', 'O'),
(5, 'MAINTENANCE AND OTHER OPERATING EXPENSES', 'MOOE', 'O'),
(7, 'CAPITAL OUTLAY', 'CO', 'O');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allotment`
--

CREATE TABLE `tbl_allotment` (
  `allotment_id` int(50) NOT NULL,
  `appropriation_id` int(50) NOT NULL,
  `account_code` varchar(100) CHARACTER SET latin1 NOT NULL,
  `function_code` varchar(100) CHARACTER SET latin1 NOT NULL,
  `budget_year` int(4) NOT NULL,
  `first_qtr` decimal(15,2) NOT NULL,
  `second_qtr` decimal(15,2) NOT NULL,
  `third_qtr` decimal(15,2) NOT NULL,
  `fourth_qtr` decimal(15,2) NOT NULL,
  `total_allotment` decimal(15,2) NOT NULL,
  `user_name` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_allotment`
--

INSERT INTO `tbl_allotment` (`allotment_id`, `appropriation_id`, `account_code`, `function_code`, `budget_year`, `first_qtr`, `second_qtr`, `third_qtr`, `fourth_qtr`, `total_allotment`, `user_name`) VALUES
(16, 16, '5 01 01 010', '1011-06', 2022, '1310919.00', '0.00', '0.00', '0.00', '1310919.00', 'admin'),
(17, 17, '5 01 01 020', '1011-06', 2022, '375525.00', '0.00', '0.00', '0.00', '375525.00', 'admin'),
(18, 18, '5 01 02 010', '1011-06', 2022, '72000.00', '0.00', '0.00', '0.00', '72000.00', 'admin'),
(19, 19, '5 01 02 010-1', '1011-06', 2022, '60000.00', '0.00', '0.00', '0.00', '60000.00', 'admin'),
(20, 20, '5 01 02 020', '1011-06', 2022, '22500.00', '0.00', '0.00', '0.00', '22500.00', 'admin'),
(21, 21, '5 01 02 030', '1011-06', 2022, '22500.00', '0.00', '0.00', '0.00', '22500.00', 'admin'),
(22, 22, '5 01 02 040', '1011-06', 2022, '18000.00', '0.00', '0.00', '0.00', '18000.00', 'admin'),
(23, 23, '5 01 02 040-1', '1011-06', 2022, '15000.00', '0.00', '0.00', '0.00', '15000.00', 'admin'),
(24, 24, '5 01 03 010', '1011-06', 2022, '157325.00', '0.00', '0.00', '0.00', '157325.00', 'admin'),
(25, 25, '5 01 03 010 - 1', '1011-06', 2022, '45075.00', '0.00', '0.00', '0.00', '45075.00', 'admin'),
(26, 26, '5 01 03 020', '1011-06', 2022, '3600.00', '0.00', '0.00', '0.00', '3600.00', 'admin'),
(27, 27, '5 01 03 020 - 1', '1011-06', 2022, '3000.00', '0.00', '0.00', '0.00', '3000.00', 'admin'),
(28, 28, '5 01 03 030', '1011-06', 2022, '39844.25', '0.00', '0.00', '0.00', '39844.25', 'admin'),
(29, 29, '5 01 03 030 - 1', '1011-06', 2022, '12650.00', '0.00', '0.00', '0.00', '12650.00', 'admin'),
(30, 30, '5 01 03 040', '1011-06', 2022, '3600.00', '0.00', '0.00', '0.00', '3600.00', 'admin'),
(31, 31, '5 01 03 040 - 1', '1011-06', 2022, '3000.00', '0.00', '0.00', '0.00', '3000.00', 'admin'),
(32, 32, '5 01 02 110', '1011-06', 2022, '0.00', '0.00', '0.00', '0.00', '0.00', 'admin'),
(33, 33, '5 02 01 010', '1011-06', 2022, '63750.00', '0.00', '0.00', '0.00', '63750.00', 'admin'),
(34, 34, '5 02 03 010', '1011-06', 2022, '64600.00', '0.00', '0.00', '0.00', '64600.00', 'admin'),
(35, 35, '5 02 05 020', '1011-06', 2022, '17000.00', '0.00', '0.00', '0.00', '17000.00', 'admin'),
(36, 36, '5 02 13 050', '1011-06', 2022, '25500.00', '0.00', '0.00', '0.00', '25500.00', 'admin'),
(37, 37, '5 02 99 990', '1011-06', 2022, '24650.00', '0.00', '0.00', '0.00', '24650.00', 'admin'),
(38, 38, '1 07 05 020', '1011-06', 2022, '35000.00', '0.00', '0.00', '0.00', '35000.00', 'admin'),
(39, 39, '1 07 05 030', '1011-06', 2022, '549000.00', '0.00', '0.00', '0.00', '549000.00', 'admin'),
(40, 40, '1 07 05 990', '1011-06', 2022, '0.00', '0.00', '0.00', '0.00', '0.00', 'admin'),
(41, 41, '1 07 07 010', '1011-06', 2022, '0.00', '0.00', '0.00', '0.00', '0.00', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appropriation`
--

CREATE TABLE `tbl_appropriation` (
  `appropriation_id` int(50) NOT NULL,
  `account_code` varchar(100) NOT NULL,
  `function_code` varchar(100) NOT NULL,
  `amount_appropriation` decimal(15,2) NOT NULL,
  `budget_year` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_appropriation`
--

INSERT INTO `tbl_appropriation` (`appropriation_id`, `account_code`, `function_code`, `amount_appropriation`, `budget_year`, `user_name`) VALUES
(16, '5 01 01 010', '1011-06', '5243676.00', '2022', 'admin'),
(17, '5 01 01 020', '1011-06', '1502100.00', '2022', 'admin'),
(18, '5 01 02 010', '1011-06', '288000.00', '2022', 'admin'),
(19, '5 01 02 010-1', '1011-06', '240000.00', '2022', 'admin'),
(20, '5 01 02 020', '1011-06', '90000.00', '2022', 'admin'),
(21, '5 01 02 030', '1011-06', '90000.00', '2022', 'admin'),
(22, '5 01 02 040', '1011-06', '72000.00', '2022', 'admin'),
(23, '5 01 02 040-1', '1011-06', '60000.00', '2022', 'admin'),
(24, '5 01 03 010', '1011-06', '629300.00', '2022', 'admin'),
(25, '5 01 03 010 - 1', '1011-06', '180300.00', '2022', 'admin'),
(26, '5 01 03 020', '1011-06', '14400.00', '2022', 'admin'),
(27, '5 01 03 020 - 1', '1011-06', '12000.00', '2022', 'admin'),
(28, '5 01 03 030', '1011-06', '159377.00', '2022', 'admin'),
(29, '5 01 03 030 - 1', '1011-06', '50600.00', '2022', 'admin'),
(30, '5 01 03 040', '1011-06', '14400.00', '2022', 'admin'),
(31, '5 01 03 040 - 1', '1011-06', '12000.00', '2022', 'admin'),
(32, '5 01 02 110', '1011-06', '0.00', '2022', 'admin'),
(33, '5 02 01 010', '1011-06', '300000.00', '2022', 'admin'),
(34, '5 02 03 010', '1011-06', '304000.00', '2022', 'admin'),
(35, '5 02 05 020', '1011-06', '80000.00', '2022', 'admin'),
(36, '5 02 13 050', '1011-06', '120000.00', '2022', 'admin'),
(37, '5 02 99 990', '1011-06', '116000.00', '2022', 'admin'),
(38, '1 07 05 020', '1011-06', '35000.00', '2022', 'admin'),
(39, '1 07 05 030', '1011-06', '549000.00', '2022', 'admin'),
(40, '1 07 05 990', '1011-06', '0.00', '2022', 'admin'),
(41, '1 07 07 010', '1011-06', '0.00', '2022', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE `tbl_expenses` (
  `expense_id` int(100) NOT NULL,
  `obligation_id` int(11) NOT NULL,
  `function` varchar(100) CHARACTER SET latin1 NOT NULL,
  `allotment_class` varchar(50) CHARACTER SET latin1 NOT NULL,
  `expense_code` varchar(100) CHARACTER SET latin1 NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `trans_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_function`
--

CREATE TABLE `tbl_function` (
  `function_id` int(50) NOT NULL,
  `function_code` varchar(100) CHARACTER SET latin1 NOT NULL,
  `type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `description` varchar(300) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_function`
--

INSERT INTO `tbl_function` (`function_id`, `function_code`, `type`, `description`) VALUES
(3, '1071', 'OFFICE', 'Provincial Budget Office'),
(4, '1011-06', 'OFFICE', 'Management Information Services Office'),
(5, '1011-01', 'OFFICE', 'Provincial Governor\'s Office - Administrative Division'),
(6, '1011-05', 'OFFICE', 'Provincial Warden Office'),
(7, '1011-07', 'OFFICE', 'Pangasinan Housing and Urban Development Coordinating Office'),
(8, '1011-09', 'OFFICE', 'Pangasinan Provincial Library'),
(9, '1011-10', 'OFFICE', 'Internal Audit Division'),
(10, '1011-12', 'OFFICE', 'Sports Development Division'),
(11, '1011-13', 'OFFICE', 'Operation of Capitol Resort Hotel'),
(12, '1011-14', 'OFFICE', 'Provincial Archives and Records Center'),
(13, '1016', 'OFFICE', 'Office of the Vice-Governor'),
(14, '1021-01', 'OFFICE', 'Legislative Services'),
(15, '1021-02', 'OFFICE', 'Secretariat Services'),
(16, '1011-08', 'OFFICE', 'Provincial Tourism and Cultural Affairs Office'),
(17, '1011-11', 'OFFICE', 'Provincial Disaster Risk Reduction and Management Office'),
(18, '1032', 'OFFICE', 'Human Resource Management and Development Office'),
(19, '1041', 'OFFICE', 'Provincial Planning and Development Office'),
(20, '1061-01', 'OFFICE', 'General Services Office - Administrative Division'),
(21, '1061-02', 'OFFICE', 'General Services Office - Property and Supply Management Division'),
(22, '1061-03', 'OFFICE', 'General Services Office - Building, Parks and Security Support Division'),
(23, '1081', 'OFFICE', 'Provincial Accounting Office'),
(24, '1091-01', 'OFFICE', 'Provincial Treasury - Administrative Services'),
(25, '1091-02', 'OFFICE', 'Provincial Treasury - Treasury Administration Division'),
(26, '1091-03', 'OFFICE', 'Provincial Treasury - Treasury Operations Division'),
(27, '1101', 'OFFICE', 'Provincial Assessment Office'),
(28, '1121', 'OFFICE', 'Provincial Information Office'),
(29, '1131', 'OFFICE', 'Provincial Legal Office'),
(30, '5993', 'OFFICE', 'Provincial Employment Services Office'),
(31, '7611', 'OFFICE', 'Provincial Social Welfare and Development Office'),
(32, '7621', 'OFFICE', 'Provincial Population, Cooperative and Livelihood Development Office'),
(33, '8711', 'OFFICE', 'Provincial Agriculture Office'),
(34, '8721', 'OFFICE', 'Provincial Veterinary Office'),
(35, '8731', 'OFFICE', 'Environment and Natural Resources Office (ENRO) - Natural Resources Regulatory Group (NRRG)'),
(36, '8751', 'OFFICE', 'Provincial Engineering Office'),
(37, '4411', 'OFFICE', 'Provincial Health Office'),
(38, '4421-01', 'HOSPITAL', 'Pangasinan Provincial Hospital'),
(39, '4421-02', 'HOSPITAL', 'Eastern Pangasinan District Hospital - Tayug'),
(40, '4421-03', 'HOSPITAL', 'Western Pangasinan District Hospital - Alaminos City'),
(41, '4421-04', 'HOSPITAL', 'Urdaneta District Hospital'),
(42, '4421-05', 'HOSPITAL', 'Bayambang District Hospital'),
(43, '4421-06', 'HOSPITAL', 'Mangatarem District Hospital'),
(44, '4421-07', 'HOSPITAL', 'Lingayen District Hospital'),
(45, '4421-08', 'HOSPITAL', 'Asingan Community Hospital'),
(46, '4421-09', 'HOSPITAL', 'Bolinao District Hospital'),
(47, '4421-10', 'HOSPITAL', 'Umingan Community Hospital'),
(48, '4421-11', 'HOSPITAL', 'Dasol Community Hospital'),
(49, '4421-12', 'HOSPITAL', 'Manaoag Community Hospital'),
(50, '4421-13', 'HOSPITAL', 'Mapandan Community Hospital'),
(51, '4421-14', 'HOSPITAL', 'Pozorrubio Community Hospital'),
(52, '1011', 'NON-OFFICE', 'Subsidy  to National  Government Agencies (Add\"l. allow. of  RTC Judges, Prosecutors,  Attorneys &  MTC Judges).'),
(53, '1011', 'NON-OFFICE', 'Mid-year Bonus'),
(54, '1011', 'NON-OFFICE', 'Terminal Leave/Retirement Gratuity Benefits'),
(55, '1011', 'NON-OFFICE', 'Year-end  Bonus'),
(56, '1011', 'NON-OFFICE', 'Other Personnel Benefits/ PEI'),
(57, '1011', 'NON-OFFICE', 'Cash Gift '),
(58, '1014-1', 'NON-OFFICE', 'Basic Journalism Training Workshop for ILP Movers'),
(59, '1102', 'NON-OFFICE', 'General Revision Works '),
(60, '1102-1', 'NON-OFFICE', 'GIS, ITAX-RPTA System'),
(61, '1191', 'NON-OFFICE', 'Operation and Maintenance of Firefighting  Equipment/ Facilities'),
(62, '1914', 'NON-OFFICE', 'Peace and Order Council'),
(63, '1917', 'NON-OFFICE', 'Maintenance & Improvement of Provincial Buildings & Facilities'),
(64, '1917-2', 'NON-OFFICE', 'Insurance of Provincial Buildings & Facilities'),
(65, '1917-3', 'NON-OFFICE', 'Counterpart for Casa Real						\r\n'),
(66, '1999', 'NON-OFFICE', 'Water, Illumination and Power Services						\r\n'),
(67, '1999-1', 'NON-OFFICE', 'Advocacy Campaign						\r\n'),
(68, '1999-4', 'NON-OFFICE', 'SSS Premiums/Other Maintenance and Other Operating Expenses						\r\n'),
(69, '1999-5', 'NON-OFFICE', 'ISO Requirements						\r\n'),
(70, '3351', 'NON-OFFICE', 'Public Affairs Fund						\r\n'),
(71, '3351', 'NON-OFFICE', 'Public Affairs Fund (Pangasinan Day)						\r\n'),
(72, '3351-1', 'NON-OFFICE', 'Trainings, Seminars and Conferences						\r\n'),
(73, '3351-2', 'NON-OFFICE', 'Employment, Manpower  and Enterprise Development						\r\n'),
(74, '3351-4', 'NON-OFFICE', 'Cooperatives Development						\r\n'),
(75, '3371-1', 'NON-OFFICE', 'Consultancy Services						\r\n'),
(76, '3391', 'NON-OFFICE', 'Cultural Preservation & Incentive  Awards						\r\n'),
(77, '3391-1', 'NON-OFFICE', 'Gender-Related Activities/Projects						\r\n'),
(78, '3391-2', 'NON-OFFICE', 'Cultural Preservation &  Incentive Awards & Other Related Activities						\r\n'),
(79, '3391-3', 'NON-OFFICE', 'Cultural Preservation (Balitok a Tawir and Others)						\r\n'),
(80, '3391-4', 'NON-OFFICE', 'Program Awards & Incentives for Service Excellence						\r\n'),
(81, '3392', 'NON-OFFICE', 'Scouting Activities Prov\'l. Blood Network Program						\r\n'),
(82, '3392-1', 'NON-OFFICE', 'Palaro ng Bayan and other Official Sports Activities						\r\n'),
(83, '3392-2', 'NON-OFFICE', 'Youth and Sports Development						\r\n'),
(84, '3911', 'NON-OFFICE', 'Management Tools						\r\n'),
(85, '3911-1', 'NON-OFFICE', 'Reproduction of Media Materials/Tourism Investment Promotion Materials						\r\n'),
(86, '3919', 'NON-OFFICE', 'Scholarship Fund						\r\n'),
(87, '3919-1', 'NON-OFFICE', 'Governor\'s League Projects/Activities 						\r\n'),
(88, '3919-2', 'NON-OFFICE', 'Vice- Gov./ Board Member\'s  League Projects & Activities 						\r\n'),
(89, '4431', 'NON-OFFICE', 'Tuberculosis Elimination Program						\r\n'),
(90, '4918', 'NON-OFFICE', 'Maintenance/ Improvement of Various Hospitals						\r\n'),
(91, '4918-1', 'NON-OFFICE', 'Disposal of Hospital Sharp Waste						\r\n'),
(92, '4919', 'NON-OFFICE', 'Counterpart for Philhealth Premiums						\r\n'),
(93, '4994', 'NON-OFFICE', 'Nutrition Fund						\r\n'),
(94, '4999', 'NON-OFFICE', 'Anti-Illegal Drug Activities						\r\n'),
(95, '4999-1', 'NON-OFFICE', 'Kalusugan Karaban						\r\n'),
(96, '4999-2', 'NON-OFFICE', 'Operation of the Molecular Laboratory						\r\n'),
(97, '4999-3', 'NON-OFFICE', 'Operation of Blood Bank and the Provincial Blood Voluntary Program'),
(98, '4999-4', 'NON-OFFICE', 'Dengue Control Program'),
(99, '6543', 'NON-OFFICE', 'Food Production Program/Agro Industrial Development						\r\n'),
(100, '6543-1', 'NON-OFFICE', 'Umaani Festival						\r\n'),
(101, '6543-2', 'NON-OFFICE', 'Sustainable Free-Range Chicken Production						\r\n'),
(102, '6543-3', 'NON-OFFICE', 'Establishment of Food Processing Facilites						\r\n'),
(103, '6544', 'NON-OFFICE', 'Improvement & Maintenace of Maramba Blvd. and Capitol Grounds						\r\n'),
(104, '6544-1', 'NON-OFFICE', 'Improvement & Maint. of Provincial Parks and Other Facilities						\r\n'),
(105, '7621-1', 'NON-OFFICE', 'Population Services Management Program						\r\n'),
(106, '7999', 'NON-OFFICE', 'Social Welfare Fund						\r\n'),
(107, '7999-1', 'NON-OFFICE', 'Veterans Affairs						\r\n'),
(108, '7999-2', 'NON-OFFICE', 'Projects/Activities of Elderly/ Persons w/ Disabilities						\r\n'),
(109, '7999-3', 'NON-OFFICE', 'Support for Family Planning, Programs/Activities						\r\n'),
(110, '7999-4', 'NON-OFFICE', 'Livestock Upgrading/Artificial Insemination on Large Ruminant for 2021						\r\n'),
(111, '7999-5', 'NON-OFFICE', 'Maintenance of Established Checkpoints						\r\n'),
(112, '7999-6', 'NON-OFFICE', 'Crisis Intervention Center						\r\n'),
(113, '7999-8', 'NON-OFFICE', 'Provincial Livestock & Disease Prevention Control Program						\r\n'),
(114, '7999-9', 'NON-OFFICE', 'Employees Welfare, Wellness & Rewards Mgt.						\r\n'),
(115, '7999-10', 'NON-OFFICE', 'Anti-Illegal Recruitment Campaign/Human Trafficking and Poverty Alleviation Program OFW 						\r\n'),
(116, '7999-11', 'NON-OFFICE', 'Provincial Health Emergency & Response Team						\r\n'),
(117, '7999-12', 'NON-OFFICE', 'Center for Excellence in Organization & Employee Development						\r\n'),
(118, '7999-13', 'NON-OFFICE', 'Maintenance of Established Multiflier Farm at 3 Breeding Station						\r\n'),
(119, '7999-14', 'NON-OFFICE', 'Mobile Skills Training Program						\r\n'),
(120, '7999-15', 'NON-OFFICE', 'Rabies Control Program						\r\n'),
(121, '7999-16', 'NON-OFFICE', 'Establishment of Goat Multiplier Farm						\r\n'),
(122, '7999-17', 'NON-OFFICE', 'Program/Projects for the Protection of Children						\r\n'),
(123, '7999-19', 'NON-OFFICE', 'Economic Recovery Program (ABIG PANGASINAN)						\r\n'),
(124, '8821', 'NON-OFFICE', 'General/Transportation Services						\r\n'),
(125, '8851', 'NON-OFFICE', 'Carabao Development Program						\r\n'),
(126, '8851-1', 'NON-OFFICE', 'Corn/Rice Production Program						\r\n'),
(127, '8912', 'NON-OFFICE', 'Tourism Fund						\r\n'),
(128, '8912-2', 'NON-OFFICE', 'Operation and Maintenance of Narciso Ramos Sports & Civic Center 						\r\n'),
(129, '8917', 'NON-OFFICE', 'Maintenance of Communication System						\r\n'),
(130, '8919-3', 'NON-OFFICE', 'Capital Outlay						\r\n'),
(131, '8919-4', 'NON-OFFICE', 'Capital Outlay -Hospitals & Health Centers/ Hospital Equipment						\r\n'),
(132, '8999', 'NON-OFFICE', 'Counterpart for PRDP						\r\n'),
(133, '8999-1', 'NON-OFFICE', 'Center for Pangasinan Studies						\r\n'),
(134, '8999-2', 'NON-OFFICE', 'Kalinisan Karaban						\r\n'),
(135, '9921', 'NON-OFFICE', 'Contribution to Barangay Development Fund						\r\n'),
(136, '9921-1', 'NON-OFFICE', 'Amortization of Principal and Interest on Loan to the Land Bank of the Philippines						\r\n'),
(137, '9940', 'NON-OFFICE', '5% Local Disaster Risk Reduction & Management Fund						\r\n'),
(138, '9999', 'NON-OFFICE', 'Bids & Awards Committee - Supplies & Materials/ Advertising Exp.						\r\n'),
(139, '6511-1', 'NON-OFFICE', 'Housing Projects						\r\n'),
(140, '6911', 'NON-OFFICE', 'Community Development Projects						\r\n'),
(141, '3611-2', 'NON-OFFICE', 'Construction & Repair of Other Development Projects						\r\n'),
(142, '8911', 'NON-OFFICE', 'Irrigation						\r\n'),
(143, '8912-1', 'NON-OFFICE', 'Coastal Resources Management Projects						\r\n'),
(144, '8912-4', 'NON-OFFICE', 'Water/River Resources Management Projects						\r\n'),
(145, '8915', 'NON-OFFICE', 'Livelihood Projects and Counterpart for Loan						\r\n'),
(146, '8917-1', 'NON-OFFICE', 'Construction,  Repair & Maintenance of Various Roads and Bridges						\r\n'),
(147, '8919', 'NON-OFFICE', 'Reforestation						\r\n'),
(148, '8919-2', 'NON-OFFICE', 'Water & Sanitation						\r\n'),
(149, '8971-1', 'NON-OFFICE', 'Investment Promotion						\r\n'),
(150, '9921-1', 'NON-OFFICE', 'Amortization of Principal and Interest on Loan to the Land Bank of the Philippines						\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obligation`
--

CREATE TABLE `tbl_obligation` (
  `obligation_id` int(10) NOT NULL,
  `obr_number` int(10) NOT NULL,
  `pr_number` varchar(20) CHARACTER SET latin1 NOT NULL,
  `pr_date` date NOT NULL,
  `payee` varchar(150) CHARACTER SET latin1 NOT NULL,
  `office` varchar(10) CHARACTER SET latin1 NOT NULL,
  `request` varchar(150) CHARACTER SET latin1 NOT NULL,
  `function` varchar(50) CHARACTER SET latin1 NOT NULL,
  `allotment_class` varchar(50) CHARACTER SET latin1 NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `requesting_officer` varchar(10) CHARACTER SET latin1 NOT NULL,
  `requesting_position` varchar(10) CHARACTER SET latin1 NOT NULL,
  `budget_officer` varchar(10) CHARACTER SET latin1 NOT NULL,
  `budget_position` varchar(10) CHARACTER SET latin1 NOT NULL,
  `trans_date` date NOT NULL,
  `reference_number` varchar(10) CHARACTER SET latin1 NOT NULL,
  `user` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_office_code`
--

CREATE TABLE `tbl_office_code` (
  `id` int(100) NOT NULL,
  `office_code` varchar(100) NOT NULL,
  `office_acronym` varchar(100) NOT NULL,
  `office_description` varchar(100) NOT NULL,
  `office_main` varchar(150) NOT NULL,
  `office_main_acronym` varchar(50) NOT NULL,
  `office_head` varchar(150) NOT NULL,
  `head_position` varchar(150) NOT NULL,
  `classification` varchar(50) NOT NULL,
  `sector` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_office_code`
--

INSERT INTO `tbl_office_code` (`id`, `office_code`, `office_acronym`, `office_description`, `office_main`, `office_main_acronym`, `office_head`, `head_position`, `classification`, `sector`) VALUES
(101, '1011-01', 'ADMIN', 'Administrative Division', 'Provincial Governor\'s Office', 'PGO', 'ATTY.NIMROD S. CAMBA', 'Provincial Administrator', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(102, '1011-05', 'PWO', 'Office of the Provincial Warden', 'Provincial Governor\'s Office', 'PGO', 'FERDINAND T. NATIVIDAD', 'OIC-Provincial Warden\'s Office', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(103, '1011-06', 'MISO', 'Management Information Services Office', 'Provincial Governor\'s Office', 'PGO', 'MODESTO R. SINGSON', 'Computer Services Chief', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(104, '1011-07', 'PHUDCO', 'Provincial Housing and Urban Development Coordinating Office', 'Provincial Governor\'s Office', 'PGO', 'ENGR. ALVIN BIGAY', 'PHUDCO Chief', 'OFFICE', 'SOCIAL SERVICES'),
(105, '1011-09', 'OPLib', 'Pangasinan Provincial Library', 'Provincial Governor\'s Office', 'PGO', 'MA. CYNTHIA ENCSRNITA F. VILA', 'Provincial Librarian', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(106, '1011-10', 'IA', 'Internal Audit Division', 'Provincial Governor\'s Office', 'PGO', 'LOUIE F. OCAMPO', 'Internal Auditor', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(107, '1011-12', 'PSDMC', 'Provincial Sports Development and Management Council', 'Provincial Governor\'s Office', 'PGO', 'MODESTO M. OPERANIA', 'Executive Officer Provincial Sports Development and Management Council', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(108, '1011-13', 'CRH', 'Operation of Capitol Resort Hotel', 'Provincial Governor\'s Office', 'PGO', 'CRISTINA J.BUMILTAC', 'OIC - Capitol Resort Hotel (CRH)', 'OFFICE', 'ECONOMIC SERVICES'),
(109, '1016', 'PVGO', 'Office of the Provincial Vice Governor', 'Office of the Sangguniang Panlalawigan', 'SP', 'HON. MARK RONALD DG. LAMBINO', 'Provincial Vice Governor', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(110, '1021-01', 'LS', 'Legislative Services', 'Office of the Sangguniang Panlalawigan', 'SP', 'XXX', 'iii', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(111, '1021-02', 'SECRETARIAT', 'Secretariat Services', 'Office of the Sangguniang Panlalawigan', 'SP', 'ATTY. VERNA T. NAVA-PEREZ', '3f0e6b2950867e3c', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(112, '1011-08', 'PTCAO', 'Provincial Tourism and Cultural Affairs Office', 'Provincial Offices', 'PO', 'MA. LUISA A. ELDUAYAN', 'Provincial Tourism and Cultural Affairs Officer', 'OFFICE', 'ECONOMIC SERVICES'),
(113, '1011-11', 'PDRRMO', 'Provincial Disaster and Risk Reduction Management Office', 'Provincial Offices', 'PO', 'COL. RHODYN LUCHINVAR O. ORO (Ret.)', 'Provincial Disaster and Risk Reduction Management Officer, OIC-NRSCC', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(114, '1011-04', 'HRMDO', 'Human Resource Management Development Office', 'Provincial Offices', 'PO', 'JANETTE  C. ASIS', 'Human Resource Management and Development Officer', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(115, '1041', 'PPDO', 'Provincial Planning and Development Office', 'Provincial Offices', 'PO', 'BENITA M. PIZARRO', 'Provincial Planning and Development Officer ', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(116, '1061', 'GSO', 'General Services Office', 'Provincial Offices', 'PO', 'EVAN GLADISH P. DOMALANTA', 'General Services Officer', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(117, '1071', 'PBO', 'Provincial Budget Office', 'Provincial Offices', 'PO', 'HILARIA J. CLAVERIA', 'Provincial Budget Officer', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(118, '1081', 'PAO', 'Provincial Accounting Office', 'Provincial Offices', 'PO', 'ARTURO V. SORIANO', 'Provincial Accountant', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(119, '1091', 'PTO', 'Provincial Treasury Office', 'Provincial Offices', 'PO', 'MARILOU E. UTANES', 'Provincial Treasurer', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(120, '1101', 'PAssO', 'Provincial Assessment Office', 'Provincial Offices', 'PO', 'LOIDA Q. ALAMAR', 'OIC-Provincial Assessment Office', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(121, '1121', 'PIO', 'Provincial Information Office', 'Provincial Offices', 'PO', 'ORPHEUS M. VELASCO', 'Provincial Information Officer', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(122, '1131', 'PLO', 'Provincial Legal Office', 'Provincial Offices', 'PO', 'ATTY. GERALDINE U. BANIQUED', 'Provincial Legal Officer', 'OFFICE', 'GENERAL PUBLIC SERVICES'),
(123, '5993', 'PESO', 'Provincial Employment and Services Office', 'Provincial Offices', 'PO', 'ALEX F. FERRER', 'Provincial Employment and Services Office Manager ', 'OFFICE', 'SOCIAL SERVICES'),
(124, '7611', 'PSWDO', 'Provincial Social Welfare and Development Office', 'Provincial Offices', 'PO', 'EMILIO P. SAMSON, JR.', 'Provincial Social Welfare and Development Officer', 'OFFICE', 'SOCIAL SERVICES'),
(125, '7621', 'PPCLDO', 'Provincial Population Cooperative and Livelihood Development Office', 'Provincial Offices', 'PO', 'ELLSWORTH G. GONZALES', 'Provincial Population Cooperative and Livelihood Development Officer', 'OFFICE', 'SOCIAL SERVICES'),
(126, '8711', 'OPAG', 'Provincial Agriculture Office', 'Provincial Offices', 'PO', 'DALISAY A. MOYA', 'Provincial Agriculture Officer', 'OFFICE', 'ECONOMIC SERVICES'),
(127, '8721', 'OPVet', 'Office of Provincial Veterinarian', 'Provincial Offices', 'PO', 'DR. JOVITO TABAREJOS', 'OIC-Provincial Veterinarian', 'OFFICE', 'ECONOMIC SERVICES'),
(128, '8731', 'ENRO-NRRG', 'Environment & Natural Resources Office-Natural Resources Regulatory Group', 'Provincial Offices', 'PO', 'NATHANIEL L. PULIDO', 'OIC-ENRO-NRRG', 'OFFICE', 'ECONOMIC SERVICES'),
(129, '8751', 'PEO', 'Provincial Engineering Office', 'Provincial Offices', 'PO', 'ENGR. ANTONIETA C.DELOS SANTOS', 'Provincial Engineer', 'OFFICE', 'ECONOMIC SERVICES'),
(130, '4411', 'PHO', 'Provincial Health Office', 'Provincial Offices', 'PO', 'DR. ANNA MA.TERESA S. DE GUZMAN', 'Provincial Health Officer II', 'OFFICE', 'SOCIAL SERVICES'),
(131, '4421-01', 'PPH', 'Pangasinan Provincial Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. AURELIO CARIÑO', 'OIC CHIEF OF HOSPITAL', 'HOSPITAL', 'ECONOMIC SERVICES'),
(132, '4421-02', 'EPDH', 'Eastern Pangasinan District Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. DAVID BEN E. GURION', 'OIC Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(133, '4421-03', 'WPDH', 'Western Pangasinan District Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. EDGARDO C. ESPINOSA', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(134, '4421-04', 'UDH', 'Urdaneta District Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. MARIA VIVIAN A. VILLAR - ESPINO', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(135, '4421-05', 'BDH', 'Bayambang District Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. ATHENA MARIE C. MERRERA', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(136, '4421-06', 'MDH', 'Mangatarem District Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. NARIO G. FERRER', 'OIC Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(137, '4421-07', 'LDH', 'Lingayen District Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. CIPRIANO FERNANDEZ', 'OIC Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(138, '4421-08', 'ACH', 'Asingan Community Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. FERDINAND A. TOTAAN', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(139, '4421-09', 'BCH', 'Bolinao Community Hospital', 'OPERATION OF HOSPITALS', 'HO', 'Dr. GENEVIEVE S. RIVERA', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(140, '4421-10', 'UCH', 'Umingan Community Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. JULIAN B. ROSE, JR.', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(141, '4421-11', 'DCH', 'Dasol Community Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. EUGENIE E. GUIANG', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(142, '4421-12', 'MANAOAG CH', 'Manaoag Community Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. DONN P. DORIA', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(143, '4421-13', 'MAPANDAN CH', 'Mapandan Community Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. FRANKLIN A. SABLE', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES'),
(144, '4421-14', 'PCH', 'Pozorrubio Community Hospital', 'OPERATION OF HOSPITALS', 'HO', 'DR. ALFREDO L. SY', 'Chief of Hospital', 'HOSPITAL', 'ECONOMIC SERVICES');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password_temp` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `house_no` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `userlevel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `password_temp`, `firstname`, `middlename`, `lastname`, `contact_no`, `email`, `house_no`, `street`, `barangay`, `municipality`, `province`, `userlevel`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin123', 'admin', '-', '-', '09958901259', 'gabrielcedrickl@gmail.com', '85', 'rizal', 'poblacion', 'mangaldan', 'pangasinan', 'admin'),
(7, 'aa', '0cc175b9c0f1b6a831c399e269772661', 'a', 'JAY R', 'DELA', 'PENA', '03032585258', 'test@gmail.com', '', '', '', '', '', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tbl_acc_category`
--
ALTER TABLE `tbl_acc_category`
  ADD PRIMARY KEY (`acc_category_id`);

--
-- Indexes for table `tbl_allotment`
--
ALTER TABLE `tbl_allotment`
  ADD PRIMARY KEY (`allotment_id`);

--
-- Indexes for table `tbl_appropriation`
--
ALTER TABLE `tbl_appropriation`
  ADD PRIMARY KEY (`appropriation_id`);

--
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `tbl_function`
--
ALTER TABLE `tbl_function`
  ADD PRIMARY KEY (`function_id`);

--
-- Indexes for table `tbl_obligation`
--
ALTER TABLE `tbl_obligation`
  ADD PRIMARY KEY (`obligation_id`);

--
-- Indexes for table `tbl_office_code`
--
ALTER TABLE `tbl_office_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `account_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tbl_acc_category`
--
ALTER TABLE `tbl_acc_category`
  MODIFY `acc_category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_allotment`
--
ALTER TABLE `tbl_allotment`
  MODIFY `allotment_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_appropriation`
--
ALTER TABLE `tbl_appropriation`
  MODIFY `appropriation_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `expense_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_function`
--
ALTER TABLE `tbl_function`
  MODIFY `function_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `tbl_obligation`
--
ALTER TABLE `tbl_obligation`
  MODIFY `obligation_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_office_code`
--
ALTER TABLE `tbl_office_code`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
