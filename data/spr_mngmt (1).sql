-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2021 at 08:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spr_mngmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `loc_id` int(11) NOT NULL,
  `mach_name` varchar(5) NOT NULL,
  `mach_area` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`loc_id`, `mach_name`, `mach_area`) VALUES
(1, 'aa', 's01'),
(2, 'aa', 's02'),
(3, 'aa', 's07'),
(4, 'aa', 's08'),
(5, 'aa', 's09'),
(6, 'aa', 'operator'),
(7, 'aa', 'unwinder'),
(8, 'aa', 'transfer roll'),
(9, 'aa', 'rewinder'),
(10, 'aa', 'trolly jumbo '),
(11, 'aa', 'trim os ds'),
(12, 'aa', 'trolly fg'),
(13, 'bb', 'e01'),
(14, 'bb', 'e06'),
(15, 'bb', 'e08'),
(16, 'bb', 'operator'),
(17, 'bb', 'unwinder'),
(18, 'bb', 'px90'),
(19, 'bb', 'transfer roll'),
(20, 'bb', 'rewinder'),
(21, 'bb', 'trim'),
(22, 'bb', 'trolly fg'),
(23, 'ta', 'e1'),
(24, 'ta', 'e2'),
(25, 'ta', 'e3'),
(26, 'ta', 'e4'),
(27, 'ta', 'e5'),
(28, 'ta', 'e6'),
(29, 'ta', 'e7'),
(30, 'ta', 'e8'),
(31, 'ta', 'e9'),
(32, 'ta', 'e10'),
(33, 'ta', 'operator'),
(34, 'ta', 'p9'),
(35, 'ta', 'unwinder'),
(36, 'ta', 'rewinder'),
(37, 'ta', 'trim'),
(38, 'ta', 'e11'),
(39, 'ta', 'hydraulic'),
(40, 'ta', 'trolly jumbo'),
(41, 'te', 'e1'),
(42, 'te', 'e2'),
(43, 'te', 'e3'),
(44, 'te', 'e4'),
(45, 'te', 'e5'),
(46, 'te', 'unwinder'),
(47, 'te', 'rewinder'),
(48, 'v', 'p0'),
(49, 'v', 'e0'),
(50, 'v', 'e1'),
(51, 'v', 'e2'),
(52, 'v', 'e3'),
(53, 'v', 'e4'),
(54, 'v', 'e5'),
(55, 'v', 'e6'),
(56, 'v', 'e7'),
(57, 'v', 'e8'),
(58, 'v', 'unwinder'),
(59, 'v', 'p12'),
(60, 'v', 'p11'),
(61, 'v', 'p9'),
(62, 'v', 'p8'),
(63, 'v', 'p7'),
(64, 'v', 'x3'),
(65, 'v', 'p6'),
(66, 'v', 'p5'),
(67, 'v', 'p14'),
(68, 'n', 'e01'),
(69, 'n', 'e2'),
(70, 'n', 'e3'),
(71, 'n', 'trim'),
(72, 'n', 'rewinder'),
(73, 'n', 'unwinder'),
(75, 'n', 'e4'),
(76, 'n', 'operator'),
(77, 'n', 'hydraulic');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `parts_code` varchar(20) NOT NULL,
  `part_name` text NOT NULL,
  `part_spec` text NOT NULL,
  `part_unit` varchar(5) NOT NULL,
  `part_sts` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`parts_code`, `part_name`, `part_spec`, `part_unit`, `part_sts`) VALUES
('10', 'digital_input', 'siemens 6es7 131-4bd01-0aa0 et200s 4di standard 24v dc', 'pcs', 0),
('100', 'control_module_profibus', 'x20 bc0063', 'pcs', 0),
('101', 'bus_module_supply', 'x20 bb 80', 'pcs', 0),
('102', 'bus_transmitter', 'x20 bt9400', 'pcs', 0),
('103', 'supply_bus_controller', 'x20 ps 9400', 'pcs', 0),
('104', 'plc', 's7-300 cpu317f-2pn/dp 317-2fk14-0ab0', 'pcs', 0),
('105', 'power_supply', 'sitop psu200m 24/5 6ep1333-3ba10', 'pcs', 0),
('106', 'air_conditioner_panel', 'pfannenberg dts 9011h', 'pcs', 0),
('11', 'digital_output', 'siemens 6es7 132-4bd02-0aa0 et200s 4 do standard 24 v dc/0.5 a', 'pcs', 0),
('111', 'power_module', '6es7 138-4ca01-0aa0', 'pcs', 0),
('112', 'monitor', 'prolite t1931sr plt1900', 'pcs', 0),
('113', 'fan_panel', 'nmb-mat 4715ms-23t-b5a', 'pcs', 0),
('114', 'computer', 'beckhoff c6920-1015', 'pcs', 0),
('115', 'limit_switch', 'telemecanique osiswitch (zcp21+zce02)', 'pcs', 0),
('116', 'fan_motor', 'ziehl-abegg gr25v-6ik.bf.1r 114182 30719413', 'pcs', 0),
('117', 'sensor_edge_guide', 'sug 70-b-viet-j sitron', 'pcs', 0),
('12', 'interface_module', 'siemens 6es7 151-1ba02-0ab0 et200s dp im151-1', 'pcs', 0),
('120', 'ac_induction_motor', '1ph7 184-7qd140ga3', 'pcs', 0),
('122', 'ac_servo_synchronous_motor', '1fk7042-5af71-1kv5-z', 'pcs', 0),
('123', 'proximity_magnetic_sensor', 'norgren spc 000232 (camozzi cst-232)', 'pcs', 0),
('12345', 'circuit_breaker_motor_protection', 'siemens 3rv1021 - 4aa15 (11-16 a)', 'pcs', 0),
('125', 'sensor_reflex', 'wenglor hd11pc3', 'pcs', 0),
('127', 'ac_induction_motor', 'bauer bk 10-71v/d08ma4. no. z 25606848-1. 0.55kw/1.6a', 'pcs', 0),
('128', 'sensor_angle', 'elobau 424b19a03001', 'pcs', 0),
('129', 'ac_servo_synchronous_motor', '1fk7083-5af71-1ua3-z', 'pcs', 0),
('129-10401245', 'repeater', 'siemens rs485 6es7 972-0aa02-0xa0', 'pcs', 0),
('13', 'auxiliary_switch_block', 'siemens 3rh1921-1ha22 2 no 2 nc. 4-pole. screw terminal. for motor contactors. size s0 .. s3 ', 'pcs', 0),
('130', 'ac_induction_motor', 'h7 1b/4, 0.37kw, 1470 rpm, 1.2a', 'pcs', 0),
('133', 'proximity_magnetic_sensor', 'norgren spc 000232', 'pcs', 0),
('134', 'proximity_sensor', 'pulsotronic 9984-2065', 'pcs', 0),
('136', 'ac_servo_synchronous_motor', '1fk7022-5ak71-1vh3', 'pcs', 0),
('137', 'gearbox', 'hpg-14a-45-bl3', 'pcs', 0),
('138', 'ac_servo_synchronous_motor', '1fk7032-5ak71-1vh0', 'pcs', 0),
('139', 'gearbox', 'spn uz-45', 'pcs', 0),
('14', 'contactor', '3rt1017-1ap01 (ac)', 'pcs', 0),
('140', 'ac_induction_motor', '1pl6 184-7qd030aa3', 'pcs', 0),
('142', 'ac_induction_motor', '1ph7133-7qd02-0ba3', 'pcs', 0),
('143', 'ac_servo_synchronous_motor', '1fk7022-5ak71-1vg3', 'pcs', 0),
('145', 'ac_servo_synchronous_motor', '1fk7105-5af71-1kh3', 'pcs', 0),
('146', 'ac_servo_synchronous_motor', '1fk7101-5ac71-1ug3-z', 'pcs', 0),
('147', 'ac_servo_synchronous_motor', '1fk7103-5aa71-1ug3-z', 'pcs', 0),
('148', 'sensor_beam_receiver', 'ipf pe991379', 'pcs', 0),
('149', 'sensor_beam_transmitter', 'ipf ps991378', 'pcs', 0),
('15', 'contactor', '3rh1262-1ap00 (ac)', 'pcs', 0),
('150', 'fan_motor', 'w2d210-eb10-19', 'pcs', 0),
('151', 'fan_motor', 'ziehl-abegg rf22p-2dk-3f-5r', 'pcs', 0),
('154', 'proximity_sensor', 'pulsotronic 37296/930-200', 'pcs', 0),
('155', 'contactor', 'siemens 3rt1026-1kb4..0', 'pcs', 0),
('156', 'auxiliary_switch_block', '3 rh1921-1ca01', 'pcs', 0),
('157', 'auxiliary_switch_block', '3 rh1921-1ca10', 'pcs', 0),
('158', 'static_eliminator', 'simco powermax easy speed', 'pcs', 0),
('16', 'contactor', '3rt1024-1b...4 (dc)', 'pcs', 0),
('160', 'proximity_magnetic_sensor', 'norgren m50/eap/cp', 'pcs', 0),
('162', 'ac_induction_motor', 'siemens 1le1002-1cb23-4ja0', 'pcs', 0),
('163', 'ac_induction_motor', 'atb af 71/2c-11 221589201-x 0016', 'pcs', 0),
('164', 'ac_induction_motor', 'sew-eurodrive faz77 drs80m4ee05/tf/dh 01.1355651801000110', 'pcs', 0),
('165', 'output_interface', '3tx7002-1ab00', 'pcs', 0),
('166', 'limit_switch', 'telemecanique osiswitch (zc21+zcy18)', 'pcs', 0),
('17', 'contactor', '3rh1140-1bb40 (dc)', 'pcs', 0),
('171', 'encoder', 'leine linde rsa 608 s/n 30102486', 'pcs', 0),
('172', 'sensor_reflex', 'wenglor hd11pc', 'pcs', 0),
('173', 'proximity_sensor', 'pepperl+fuchs nbb5-18gm50-e2-v1 10-30v', 'pcs', 0),
('176', 'proximity_sensor', 'pulsotronic 9964-4465', 'pcs', 0),
('177', 'proximity_sensor', 'pulsotronic sj6-m12mb68-dpo-v2', 'pcs', 0),
('178', 'safety_bumper', 'long', 'pcs', 0),
('179', 'safety_bumper', 'medium', 'pcs', 0),
('18', 'contactor', '3rt1026-1b...4 (dc)', 'pcs', 0),
('180', 'safety_bumper', 'small 1', 'pcs', 0),
('181', 'safety_bumper', 'small 2', 'pcs', 0),
('185', 'analog_output', '6es7135-4fb01-0ab0', 'pcs', 0),
('187', 'interface_module', '6es7-151-1aa05-0ab0', 'pcs', 0),
('189', 'sensor_angle', 'elobau 424b19a06001', 'pcs', 0),
('194', 'ac_induction_motor', 'bauer bg06-11/d05la4-s/e003b9', 'pcs', 0),
('195', 'ac_servo_synchronous_motor', '1fk7101-5af71-1ug3', 'pcs', 0),
('196', 'ac_servo_synchronous_motor', '1fk7015-5ak71-1jh3', 'pcs', 0),
('197', 'ac_induction_motor', 'cheng day 0.4 kw, 380 v, 1420 rpm, 1.6a, ip=44, serial no ust 10000425', 'pcs', 0),
('198', 'mcb_3_phase', '6 amp', 'pcs', 0),
('199', 'transformator', '380 vac to 220vac', 'pcs', 0),
('200', 'contactor', 'lc1d09 .220vac .9 a ', 'pcs', 0),
('201', 'auxiliary_switch_block', 'ladn11 .10 a', 'pcs', 0),
('202', 'push_button_block', 'zbe-101', 'pcs', 0),
('203', 'push_button_block', 'zbe-102', 'pcs', 0),
('204', 'chain_cable_carier', 'series 2500-03-055', 'mtr', 0),
('205', 'cable', 'n2xy 4 x 2.5 mm', 'mtr', 0),
('206', 'limit_switch', 'omron type wlca 12-2n', 'pcs', 0),
('22', 'sensor_module_cabinet', '6sl3055-0aa00-5ba3 (24vdc / 0.6 a)', 'pcs', 0),
('23', 'switch_disconnector', 'siemens 3ke4330-0ca', 'pcs', 0),
('25', 'output_interface', 'phoenix contact mcr-c-ui-ui-dci no2810913 (18-30 vdc)', 'pcs', 0),
('26', 'fuse_holder', 'wohner 690vac 160a iec 60947-3', 'pcs', 0),
('27', 'nh_fuse', 'siba 25a', 'pcs', 0),
('28', 'nh_fuse', 'siba 20a', 'pcs', 0),
('29', 'nh_fuse', 'bussmann 25a', 'pcs', 0),
('3', 'circuit_breaker_motor_protection', 'siemens 3rv1011 - 1ca15 (1.8-2.6 a)', 'pcs', 0),
('30', 'nh_fuse', 'siemens 25a', 'pcs', 0),
('31', 'active_interface_module', 'siemens 6sl3100-0be28-0ab0', 'pcs', 0),
('32', 'contactor', '3rt1056-6ap36 (215 a ) ', 'pcs', 0),
('33', 'contactor', '3rt1017-1bb443ma0', 'pcs', 0),
('35', 'line_reactor', 'etku art.nr.168-0014', 'pcs', 0),
('36', 'power_supply', 'block pvse 400/24-40', 'pcs', 0),
('37', 'power_supply', 'sitop psu 300m 48/10 6ep1456-3ba00', 'pcs', 0),
('38', 'active_line_module', 'siemens 1p 6sl3130-7te28-0aa3', 'pcs', 0),
('39', 'single_motor_module', 'siemens 1p 6sl3120-1te28-5aa3 (85a)', 'pcs', 0),
('40', 'single_motor_module', 'siemens 1p 6sl3120-1te15-0aa3 (5a)', 'pcs', 0),
('41', 'double_motor_module', 'siemens 1p 6sl3120-2te13-0aa3 (3a)', 'pcs', 0),
('42', 'double_motor_module', 'siemens 1p 6sl3120-2te21-0aa3 (9a)', 'pcs', 0),
('43', 'nh_fuse', 'siba 160a', 'pcs', 0),
('44', 'single_motor_module', 'siemens 1p 6sl3120-1te13-0aa4 ( 3a )', 'pcs', 0),
('46', 'circuit_breaker_motor_protection', 'siemens 3rv1011-1aa15 (1.1 - 1.6 a )', 'pcs', 0),
('47', 'circuit_breaker_motor_protection', 'siemens 3rv1011-1ba15 (1.4 - 2 a )', 'pcs', 0),
('48', 'circuit_breaker_motor_protection', 'siemens 3rv1011-0ha15 ( 0.55 - 0.8 a )', 'pcs', 0),
('5', 'circuit_breaker_motor_protection', 'siemens 3rv1011 - 1da15 (2.2 - 3.2 a)', 'pcs', 0),
('50', 'output_interface', '3tx7002-1bb00 ( 24vdc )', 'pcs', 0),
('51', 'drive-cliq_hub_module_cabinet', 'siemens 6sl3055-0aa00-6aa0', 'pcs', 0),
('52', 'sensor_module_cabinet', 'siemens 6sl3055-0aa00-5ba2', 'pcs', 0),
('55', 'double_motor_module', 'siemens 1p 6sl3120-2te13-0aa3 ( 3 a )', 'pcs', 0),
('56', 'double_motor_module', 'siemens 1p 6sl3120-2te21-8aa3 ( 18 a )', 'pcs', 0),
('57', 'power_supply', 'sitop modular 24/40 6ep1437-3ba00', 'pcs', 0),
('58', 'power_supply', 'block pvse 400/24-40 a', 'pcs', 0),
('59', 'digital_output', '6es7 132-4bd02-0aa0', 'pcs', 0),
('6', 'mcb_1_phase', 'siemens 5sy61 c4', 'pcs', 0),
('60', 'single_motor_module', 'siemens 6sl3120-1te23-0aa3 ( 30 a )', 'pcs', 0),
('61', 'single_motor_module', 'siemens 6sl3120-1te31-3aa3 ( 132 a )', 'pcs', 0),
('62', 'circuit_breaker_motor_protection', 'siemens 3rv1011 - 0ea15 (0.28 - 0.4 a )', 'pcs', 0),
('63', 'circuit_breaker_motor_protection', 'siemens 3rv1011 - 0ha15 (0.66 - 0.8 a)', 'pcs', 0),
('64', 'circuit_breaker_motor_protection', 'siemens 3rv1011 - 1ea15 (2.8 - 4 a)', 'pcs', 0),
('65', 'mcb_1_phase', 'schneider c60h', 'pcs', 0),
('66', 'mcb_1_phase', 'siemens c4 a', 'pcs', 0),
('67', 'contactor', '3rt1017-1bb42 (dc)', 'pcs', 0),
('7', 'mcb_1_phase', 'siemens 5sy61 c6', 'pcs', 0),
('70', 'control_unit', '6sl3040-0ma00-0aa1', 'pcs', 0),
('71', 'analog_input', '6es7 134-4bl02-0ab0 ', 'pcs', 0),
('72', 'digital_input', '6es7 131-4bd01-0aa0', 'pcs', 0),
('73', 'interface_module', '6es7 151-1aa05-0ab0', 'pcs', 0),
('74', 'power_module', '6es7 138-4ca01-0aa0 (24 vdc)', 'pcs', 0),
('75', 'repeater', '6es7 972-0aa01-0xa0', 'pcs', 0),
('76', 'double_motor_module', 'siemens 1p 6sl3120-2te21-8aa3 (18 a)', 'pcs', 0),
('77', 'double_motor_module', 'siemens 1p 6sl3120-2te21-0aa3 ( 9 a )', 'pcs', 0),
('78', 'single_motor_module', 'siemens 1p 6sl3120-1te23-0aa3 ( 30 a )', 'pcs', 0),
('79', 'push_button_block', 'zbe-101 dia : 22 mm', 'pcs', 0),
('8', 'profisafe_digital_input', 'siemens 6es7 138-4fa04-0ab0 et200s 4/8 24v', 'pcs', 0),
('80', 'emergency_switch', 'zbe-102 dia : 22 mm', 'pcs', 0),
('81', 'relay_emergency_block', 'ssw-40-12-2', 'pcs', 0),
('82', 'emergency_switch', 'emergency_switch', 'pcs', 0),
('83', 'key_switch_non_iluminate', 'key_switch_non_iluminate', 'pcs', 0),
('87', 'selector_switch', 'selector_switch', 'pcs', 0),
('88', 'push_button_lamp', 'push_button_lamp', 'pcs', 0),
('9', 'profisafe_digital_output', 'siemens 6es7138-4fb03-0ab0 et200s 4 f-do 24v', 'pcs', 0),
('90', 'pilot_lamp', 'pilot_lamp', 'pcs', 0),
('91', 'push_button_block', 'push_button_block', 'pcs', 0),
('92', 'selenoid_valve', 'norgren shu vs26s527df313a', 'pcs', 0),
('93', 'selenoid_valve', 'norgren sku vs26s522df313a', 'pcs', 0),
('94', 'selenoid_valve', 'norgren smu vs26s622df313a vs2616m00301', 'pcs', 0),
('95', 'start_dump_valve', 'norgren vsp150122 24vdc 3-10 bar', 'pcs', 0),
('96', 'base_plate_valve', 'norgren vzs2606m00300', 'pcs', 0),
('97', 'proportional_valve', 'norgren ', 'pcs', 0),
('98', 'proportional_valve', 'sentronic 608160111 24vdc 0.85a 9bar', 'pcs', 0),
('99', 'bus_transmitter', 'x20 bt9100', 'pcs', 0);

-- --------------------------------------------------------

--
-- Table structure for table `part_history`
--

CREATE TABLE `part_history` (
  `history_id` int(11) NOT NULL,
  `part_names` text NOT NULL,
  `lifetime` int(20) NOT NULL,
  `load_cap` int(5) NOT NULL,
  `load_act` int(5) NOT NULL,
  `temp_act` int(3) NOT NULL,
  `changes` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_history`
--

INSERT INTO `part_history` (`history_id`, `part_names`, `lifetime`, `load_cap`, `load_act`, `temp_act`, `changes`) VALUES
(4, 'auxiliary_switch_block', 13737600, 21, 3, 45, 'Yes'),
(5, 'auxiliary_switch_block', 13737600, 100, 80, 60, 'No'),
(6, 'auxiliary_switch_block', 13737600, 30, 20, 60, 'Yes'),
(7, 'circuit_breaker_motor_protection', 13737600, 50, 30, 60, 'Yes'),
(8, 'circuit_breaker_motor_protection', 13769005, 90, 21, 100, 'Yes'),
(9, 'circuit_breaker_motor_protection', 13769242, 90, 30, 60, 'Yes'),
(10, 'circuit_breaker_motor_protection', 163, 0, 0, 0, 'No'),
(11, 'circuit_breaker_motor_protection', 13769433, 0, 0, 0, 'No'),
(12, 'ac_servo_synchronous_motor', 31865, 0, 0, 0, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `part_match`
--

CREATE TABLE `part_match` (
  `match_id` int(11) NOT NULL,
  `match_area` int(11) NOT NULL,
  `match_part` varchar(20) NOT NULL,
  `match_dp` varchar(25) NOT NULL,
  `match_update` datetime NOT NULL,
  `match_priority` varchar(8) NOT NULL,
  `match_used` decimal(6,2) NOT NULL,
  `match_spare` decimal(6,2) NOT NULL,
  `match_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_match`
--

INSERT INTO `part_match` (`match_id`, `match_area`, `match_part`, `match_dp`, `match_update`, `match_priority`, `match_used`, `match_spare`, `match_note`) VALUES
(1, 13, '129-10401245', 'Electrical Big Slitter', '2021-03-27 01:03:04', 'high', '2.00', '2.00', ' '),
(2, 1, '64', 'Electrical Big Slitter', '2021-09-04 00:00:00', 'medium', '2.00', '2.00', ' '),
(3, 23, '12345', 'Electrical Big Slitter', '2021-09-04 00:00:00', 'medium', '1.00', '2.00', ' tatat'),
(4, 1, '3', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '1.00', ' '),
(5, 1, '63', 'Electrical Big Slitter', '2021-09-04 08:43:25', 'medium', '1.00', '2.00', ' 21'),
(6, 1, '5', 'Electrical Big Slitter', '2021-09-04 08:47:22', 'high', '1.00', '3.00', ' 444'),
(7, 1, '6', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '12.00', '0.00', ' '),
(8, 1, '7', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '3.00', '0.00', ' '),
(9, 1, '8', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '1.00', ' '),
(10, 1, '9', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '1.00', ' '),
(11, 1, '12', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '1.00', ' '),
(12, 1, '13', 'Electrical Big Slitter', '2021-09-04 00:00:00', 'medium', '2.00', '1.00', ' 12322'),
(13, 1, '14', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '0.00', ' '),
(14, 1, '15', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '0.00', ' '),
(15, 1, '16', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '3.00', '1.00', ' '),
(16, 1, '17', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '2.00', '0.00', ' '),
(17, 1, '18', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '0.00', ' '),
(18, 1, '67', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '0.00', ' '),
(19, 13, '122', 'Electrical Big Slitter', '2021-09-04 00:00:00', 'high', '1.00', '1.00', '123'),
(20, 1, '74', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '3.00', '0.00', ' '),
(21, 1, '22', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '1.00', ' '),
(22, 1, '23', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '0.00', ' '),
(23, 1, '165', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '3.00', '1.00', ' '),
(24, 1, '25', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '1.00', '1.00', ' '),
(25, 1, '29', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '2.00', '2.00', ' '),
(26, 1, '26', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '4.00', '0.00', ' '),
(27, 1, '27', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '3.00', '0.00', ' '),
(28, 1, '28', 'Electrical Big Slitter', '2021-03-29 00:00:00', 'high', '3.00', '0.00', ' '),
(29, 8, '12345', 'Electrical Big Slitter', '2021-04-05 00:00:00', 'high', '1.00', '1.00', ''),
(30, 28, '12345', 'Electrical Big Slitter', '2021-04-05 00:00:00', 'high', '1.00', '1.00', ''),
(31, 50, '12345', 'Electrical Big Slitter', '2021-04-05 00:00:00', 'high', '1.00', '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nik` int(5) NOT NULL,
  `name` varchar(40) NOT NULL,
  `department` varchar(25) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nik`, `name`, `department`, `password`) VALUES
(14077, 'Santhi Apriliani', 'Electrical Big Slitter', '$2y$10$Bp4XmiH.np71yz4XaJ.I..EEZY5N51CTSjd6PvsUlGGQau91p2ocS'),
(14256, 'Haris', 'Electrical Big Slitter', '$2y$10$5V9f42qL4r5XxBa0TxuaPeJ4rjNyDLmVpWfs.YiXRLw79wTh.4NEi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`parts_code`);

--
-- Indexes for table `part_history`
--
ALTER TABLE `part_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `part_match`
--
ALTER TABLE `part_match`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `area_fk` (`match_area`),
  ADD KEY `part_fk` (`match_part`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `department` (`department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `part_history`
--
ALTER TABLE `part_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `part_match`
--
ALTER TABLE `part_match`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `nik` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22223;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `part_match`
--
ALTER TABLE `part_match`
  ADD CONSTRAINT `area_fk` FOREIGN KEY (`match_area`) REFERENCES `machine` (`loc_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `part_fk` FOREIGN KEY (`match_part`) REFERENCES `parts` (`parts_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
