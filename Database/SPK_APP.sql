-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2024 at 08:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SPK_APP`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `notelp` bigint(20) NOT NULL,
  `divisi` enum('MARKETING','COLLECTOR','ACCOUNTING') NOT NULL,
  `periode` varchar(50) NOT NULL,
  `diterima` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama`, `notelp`, `divisi`, `periode`, `diterima`) VALUES
(87, 'ALI MURTADO BILQIYAS  F ZEN', 81510133851, 'ACCOUNTING', '2023-11', 5),
(88, 'ANISA AGUSTIN', 81908647757, 'ACCOUNTING', '2023-11', 5),
(89, 'NIKEN SULISTIA', 81386706102, 'ACCOUNTING', '2023-11', 5),
(90, 'AKHMAD IKHROMAN FIDIN', 82112555331, 'ACCOUNTING', '2023-11', 5),
(91, 'MILASARI', 82122853285, 'ACCOUNTING', '2023-11', 5),
(92, 'YUNIA PRAMTUS AZZAHRA', 85224387371, 'ACCOUNTING', '2023-11', 5),
(93, 'RISMA JULIANTI', 82122448485, 'ACCOUNTING', '2023-11', 5),
(94, 'RIAN FIRDIANSYAH', 8161454271, 'ACCOUNTING', '2023-11', 5),
(95, 'NURUL FAJRI', 81617468190, 'ACCOUNTING', '2023-11', 5),
(96, 'IQBAL JANUARI', 81912545667, 'ACCOUNTING', '2023-11', 5),
(97, 'NURJANAH', 82111914487, 'ACCOUNTING', '2023-11', 5),
(98, 'SRI BUDININGSIH', 82113085823, 'ACCOUNTING', '2023-11', 5),
(99, 'YULIS MULAYANATI ULFAH', 81219945543, 'ACCOUNTING', '2023-11', 5),
(100, 'MELISA SEPTIYANI', 81220000451, 'ACCOUNTING', '2023-11', 5),
(101, 'SELA PUJI LESTARI', 81220555434, 'ACCOUNTING', '2023-11', 5),
(102, 'KOMALA SARI', 81222066333, 'MARKETING', '2023-11', 5),
(103, 'HANAFI SULHAN AL HASANI', 81222808102, 'MARKETING', '2023-11', 5),
(104, 'FATHONI ANDHRIYANTO', 81224866745, 'MARKETING', '2023-11', 5),
(105, 'SUDARYO', 81236084495, 'MARKETING', '2023-11', 5),
(106, 'AGUNG SETIAWAN', 81276339098, 'MARKETING', '2023-11', 5),
(107, 'IVANA ARNELITA', 81513053651, 'MARKETING', '2023-11', 5),
(108, 'HARYONO', 81319345669, 'MARKETING', '2023-11', 5),
(109, 'FERI ATALENA SURYONO', 81927000100, 'MARKETING', '2023-11', 5),
(110, 'SITI NUR AFIANI', 8127025315, 'MARKETING', '2023-11', 5),
(111, 'YENI TRIYANA', 81388686990, 'MARKETING', '2023-11', 5),
(112, 'DEWI NOVITA INDIKA SARI', 8112736727, 'MARKETING', '2023-11', 5),
(113, 'DEBY VIKI DWI PRASETYO', 81216095872, 'MARKETING', '2023-11', 5),
(114, 'YURI GAGARIN', 81226569708, 'MARKETING', '2023-11', 5),
(115, 'WANISA', 8122718610, 'MARKETING', '2023-11', 5),
(116, 'PUTRI MEISI', 81229756094, 'MARKETING', '2023-11', 5),
(117, 'ARYA R KASURA', 8125101980, 'MARKETING', '2023-11', 5),
(118, 'APRI RIYANTO', 81283321388, 'MARKETING', '2023-11', 5),
(119, 'NUGARI', 81283389912, 'MARKETING', '2023-11', 5),
(120, 'IRWAN NIRWANTO', 81328440400, 'MARKETING', '2023-11', 5),
(121, 'ADE SRI MULYA', 81384867424, 'MARKETING', '2023-11', 5),
(122, 'IQBAL MAULANA', 81568273710, 'MARKETING', '2023-11', 5),
(123, 'SUGIRI', 81903708320, 'MARKETING', '2023-11', 5),
(124, 'ARDIYANSAH', 82211552290, 'MARKETING', '2023-11', 5),
(125, 'YANTO ARIYANTON', 82223814199, 'MARKETING', '2023-11', 5),
(126, 'ADE AGUNG', 82226213343, 'MARKETING', '2023-11', 5),
(127, 'SAMSUDIN', 85100979620, 'COLLECTOR', '2023-11', 5),
(128, 'ADE RIAWAN', 85234323633, 'COLLECTOR', '2023-11', 5),
(129, 'AMINUDIN', 85647265839, 'COLLECTOR', '2023-11', 5),
(130, 'MOH AMIN MUBAROK', 85719364721, 'COLLECTOR', '2023-11', 5),
(131, 'RUDI. H ARYANTO', 85742250865, 'COLLECTOR', '2023-11', 5),
(132, 'LUCKY GILANG RAMADHAN', 85869406077, 'COLLECTOR', '2023-11', 5),
(133, 'JUNENDI', 895355499100, 'COLLECTOR', '2023-11', 5),
(134, 'ALVIN PRASETIYO', 89630916201, 'COLLECTOR', '2023-11', 5),
(135, 'M. NAJMI MUHARAM', 811201831, 'COLLECTOR', '2023-11', 5),
(136, 'REZZA FERIAN PERMANA', 85221337721, 'COLLECTOR', '2023-11', 5),
(181, 'BAU', 852213377233, 'MARKETING', '2024-06', NULL),
(182, 'TEST', 811111, 'MARKETING', '2024-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_alternatif`, `nilai`) VALUES
(1, 182, 0),
(2, 181, 1),
(3, 136, 0.169333),
(4, 135, 0.494333),
(5, 134, 0.485333),
(6, 133, 0.257742),
(7, 132, 0.330667),
(8, 131, 0.248742),
(9, 130, 0.257742),
(10, 129, 0.242075),
(11, 128, 0.330667),
(12, 127, 0.242075),
(13, 126, 0.472333),
(14, 125, 0.523667),
(15, 124, 0.326667),
(16, 123, 0.196409),
(17, 122, 0.476333),
(18, 121, 0.490333),
(19, 120, 0.251075),
(20, 119, 0.242075),
(21, 118, 0.229076),
(22, 117, 0.627),
(23, 116, 0.478667),
(24, 115, 0.387),
(25, 114, 0.112947),
(26, 113, 0.174333),
(27, 112, 0.116947),
(28, 111, 0.238075),
(29, 110, 0.194),
(30, 109, 0.384333),
(31, 108, 0.485333),
(32, 107, 0.0539733),
(33, 106, 0.335667),
(34, 105, 0.554667),
(35, 104, 0.415667),
(36, 103, 0.536667),
(37, 102, 0.235409),
(38, 101, 0.103947),
(39, 100, 0.329),
(40, 99, 0.203587),
(41, 98, 0.188409),
(42, 97, 0.351333),
(43, 96, 0.499333),
(44, 95, 0.357667),
(45, 94, 0.51),
(46, 93, 0.371333),
(47, 92, 0.364333),
(48, 91, 0.481333),
(49, 90, 0.541667),
(50, 89, 0.199),
(51, 88, 0.331667),
(52, 87, 0.311);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kode_kriteria` varchar(100) NOT NULL,
  `bobot` float DEFAULT NULL,
  `prioritas` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `keterangan`, `kode_kriteria`, `bobot`, `prioritas`) VALUES
(56, 'Kemampuan', 'K1', 0.456667, '1'),
(57, 'Usia', 'K2', 0.256667, '2'),
(58, 'Tes Wawancara', 'K3', 0.156667, '3'),
(59, 'Psikotes', 'K4', 0.09, '4'),
(60, 'Pendidikan', 'K5', 0.04, '5');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(547, 87, 56, 280),
(548, 87, 57, 318),
(549, 87, 58, 291),
(550, 87, 59, 324),
(551, 87, 60, 301),
(552, 88, 56, 280),
(553, 88, 57, 318),
(554, 88, 58, 290),
(555, 88, 59, 323),
(556, 88, 60, 302),
(557, 89, 56, 281),
(558, 89, 57, 318),
(559, 89, 58, 290),
(560, 89, 59, 322),
(561, 89, 60, 301),
(562, 90, 56, 279),
(563, 90, 57, 319),
(564, 90, 58, 290),
(565, 90, 59, 322),
(566, 90, 60, 301),
(567, 91, 56, 279),
(568, 91, 57, 318),
(569, 91, 58, 290),
(570, 91, 59, 323),
(571, 91, 60, 301),
(572, 92, 56, 280),
(573, 92, 57, 318),
(574, 92, 58, 289),
(575, 92, 59, 322),
(576, 92, 60, 300),
(577, 93, 56, 280),
(578, 93, 57, 319),
(579, 93, 58, 291),
(580, 93, 59, 323),
(581, 93, 60, 301),
(582, 94, 56, 279),
(583, 94, 57, 318),
(584, 94, 58, 289),
(585, 94, 59, 322),
(586, 94, 60, 300),
(587, 95, 56, 280),
(588, 95, 57, 318),
(589, 95, 58, 290),
(590, 95, 59, 321),
(591, 95, 60, 300),
(592, 96, 56, 279),
(593, 96, 57, 318),
(594, 96, 58, 290),
(595, 96, 59, 321),
(596, 96, 60, 301),
(597, 97, 56, 280),
(598, 97, 57, 318),
(599, 97, 58, 289),
(600, 97, 59, 323),
(601, 97, 60, 301),
(602, 98, 56, 282),
(603, 98, 57, 319),
(604, 98, 58, 291),
(605, 98, 59, 323),
(606, 98, 60, 302),
(607, 99, 56, 281),
(608, 99, 57, 318),
(609, 99, 58, 289),
(610, 99, 59, 324),
(611, 99, 60, 300),
(612, 100, 56, 280),
(613, 100, 57, 318),
(614, 100, 58, 291),
(615, 100, 59, 322),
(616, 100, 60, 301),
(617, 101, 56, 282),
(618, 101, 57, 318),
(619, 101, 58, 290),
(620, 101, 59, 324),
(621, 101, 60, 301),
(622, 102, 56, 281),
(623, 102, 57, 319),
(624, 102, 58, 292),
(625, 102, 59, 322),
(626, 102, 60, 300),
(627, 103, 56, 279),
(628, 103, 57, 319),
(629, 103, 58, 290),
(630, 103, 59, 323),
(631, 103, 60, 300),
(632, 104, 56, 280),
(633, 104, 57, 319),
(634, 104, 58, 289),
(635, 104, 59, 322),
(636, 104, 60, 300),
(637, 105, 56, 279),
(638, 105, 57, 319),
(639, 105, 58, 290),
(640, 105, 59, 321),
(641, 105, 60, 300),
(642, 106, 56, 280),
(643, 106, 57, 318),
(644, 106, 58, 290),
(645, 106, 59, 323),
(646, 106, 60, 301),
(647, 107, 56, 282),
(648, 107, 57, 318),
(649, 107, 58, 291),
(650, 107, 59, 324),
(651, 107, 60, 301),
(652, 108, 56, 279),
(653, 108, 57, 318),
(654, 108, 58, 290),
(655, 108, 59, 323),
(656, 108, 60, 300),
(657, 109, 56, 280),
(658, 109, 57, 319),
(659, 109, 58, 291),
(660, 109, 59, 322),
(661, 109, 60, 300),
(662, 110, 56, 281),
(663, 110, 57, 318),
(664, 110, 58, 290),
(665, 110, 59, 323),
(666, 110, 60, 300),
(667, 111, 56, 281),
(668, 111, 57, 319),
(669, 111, 58, 291),
(670, 111, 59, 323),
(671, 111, 60, 301),
(672, 112, 56, 282),
(673, 112, 57, 318),
(674, 112, 58, 290),
(675, 112, 59, 323),
(676, 112, 60, 300),
(677, 113, 56, 281),
(678, 113, 57, 318),
(679, 113, 58, 291),
(680, 113, 59, 323),
(681, 113, 60, 301),
(682, 114, 56, 282),
(683, 114, 57, 318),
(684, 114, 58, 290),
(685, 114, 59, 323),
(686, 114, 60, 301),
(687, 115, 56, 280),
(688, 115, 57, 319),
(689, 115, 58, 290),
(690, 115, 59, 323),
(691, 115, 60, 301),
(692, 116, 56, 279),
(693, 116, 57, 318),
(694, 116, 58, 291),
(695, 116, 59, 322),
(696, 116, 60, 300),
(697, 117, 56, 278),
(698, 117, 57, 318),
(699, 117, 58, 290),
(700, 117, 59, 323),
(701, 117, 60, 301),
(702, 118, 56, 281),
(703, 118, 57, 319),
(704, 118, 58, 291),
(705, 118, 59, 324),
(706, 118, 60, 301),
(707, 119, 56, 281),
(708, 119, 57, 319),
(709, 119, 58, 291),
(710, 119, 59, 323),
(711, 119, 60, 300),
(712, 120, 56, 281),
(713, 120, 57, 319),
(714, 120, 58, 291),
(715, 120, 59, 322),
(716, 120, 60, 300),
(717, 121, 56, 279),
(718, 121, 57, 318),
(719, 121, 58, 290),
(720, 121, 59, 322),
(721, 121, 60, 301),
(722, 122, 56, 279),
(723, 122, 57, 318),
(724, 122, 58, 290),
(725, 122, 59, 324),
(726, 122, 60, 300),
(727, 123, 56, 282),
(728, 123, 57, 319),
(729, 123, 58, 291),
(730, 123, 59, 323),
(731, 123, 60, 300),
(732, 124, 56, 280),
(733, 124, 57, 318),
(734, 124, 58, 290),
(735, 124, 59, 324),
(736, 124, 60, 301),
(737, 125, 56, 279),
(738, 125, 57, 319),
(739, 125, 58, 290),
(740, 125, 59, 324),
(741, 125, 60, 301),
(742, 126, 56, 279),
(743, 126, 57, 318),
(744, 126, 58, 290),
(745, 126, 59, 324),
(746, 126, 60, 301),
(747, 127, 56, 281),
(748, 127, 57, 319),
(749, 127, 58, 291),
(750, 127, 59, 323),
(751, 127, 60, 300),
(752, 128, 56, 280),
(753, 128, 57, 318),
(754, 128, 58, 290),
(755, 128, 59, 324),
(756, 128, 60, 300),
(757, 129, 56, 281),
(758, 129, 57, 319),
(759, 129, 58, 291),
(760, 129, 59, 323),
(761, 129, 60, 300),
(762, 130, 56, 281),
(763, 130, 57, 319),
(764, 130, 58, 290),
(765, 130, 59, 323),
(766, 130, 60, 300),
(767, 131, 56, 281),
(768, 131, 57, 319),
(769, 131, 58, 290),
(770, 131, 59, 324),
(771, 131, 60, 300),
(772, 132, 56, 280),
(773, 132, 57, 318),
(774, 132, 58, 290),
(775, 132, 59, 324),
(776, 132, 60, 300),
(777, 133, 56, 281),
(778, 133, 57, 319),
(779, 133, 58, 290),
(780, 133, 59, 323),
(781, 133, 60, 300),
(782, 134, 56, 279),
(783, 134, 57, 318),
(784, 134, 58, 290),
(785, 134, 59, 323),
(786, 134, 60, 300),
(787, 135, 56, 279),
(788, 135, 57, 318),
(789, 135, 58, 290),
(790, 135, 59, 322),
(791, 135, 60, 300),
(792, 136, 56, 281),
(793, 136, 57, 318),
(794, 136, 58, 291),
(795, 136, 59, 324),
(796, 136, 60, 300),
(867, 182, 56, 282),
(868, 182, 57, 318),
(869, 182, 58, 292),
(870, 182, 59, 324),
(871, 182, 60, 302);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `deskripsi`, `nilai`) VALUES
(278, 56, 'Sangat Buruk', 1),
(279, 56, 'Buruk', 2),
(280, 56, 'Cukup', 3),
(281, 56, 'Bagus', 4),
(282, 56, 'Sangat Bagus', 5),
(288, 58, 'Sangat Buruk', 1),
(289, 58, 'Buruk', 2),
(290, 58, 'Cukup', 3),
(291, 58, 'Bagus', 4),
(292, 58, 'Sangat Bagus', 5),
(298, 60, 'SD', 1),
(299, 60, 'SMP', 2),
(300, 60, 'SMA', 3),
(301, 60, 'D3', 4),
(302, 60, 'S1', 5),
(318, 57, '18 - 25 Tahun', 5),
(319, 57, '26 - 35 Tahun', 3),
(320, 59, '1 - 3', 1),
(321, 59, '4 - 6', 2),
(322, 59, '7 - 9', 3),
(323, 59, '10 - 12', 4),
(324, 59, '13 - 15', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_user_level`, `nama`, `email`, `username`, `password`) VALUES
(1, 1, 'Admin Cek', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(9, 1, 'Deka Royanto', 'deka@gmail.com', 'deka', '57ef16a773d505292b52918bcd6d8d29'),
(10, 1, 'Test Baru Nih', 'testbaru@gmail.com', 'test', '098f6bcd4621d373cade4e832627b4f6');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_user_level` int(11) NOT NULL,
  `user_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_user_level`, `user_level`) VALUES
(1, 'Administrator'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `nilai` (`nilai`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user_level` (`id_user_level`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=872;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`nilai`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id_user_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
