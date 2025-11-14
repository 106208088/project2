-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2025 at 03:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `Job_Reference_Number` varchar(5) NOT NULL,
  `First_name` varchar(20) NOT NULL,
  `Last_name` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Street_address` varchar(40) NOT NULL,
  `Suburb` varchar(40) NOT NULL,
  `State` varchar(3) NOT NULL,
  `Postcode` varchar(4) NOT NULL,
  `Email_address` varchar(50) NOT NULL,
  `Phone_number` varchar(12) NOT NULL,
  `Skills_list` text DEFAULT NULL,
  `Other_skills` text DEFAULT NULL,
  `Status` varchar(10) DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `reference` varchar(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `salary_range` varchar(50) DEFAULT NULL,
  `reporting_to` varchar(50) DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `essential_skills` text DEFAULT NULL,
  `preferable_skills` text DEFAULT NULL,
  `closing_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `reference`, `title`, `description`, `salary_range`, `reporting_to`, `responsibilities`, `essential_skills`, `preferable_skills`, `closing_date`) VALUES
(1, 'NA12B', 'Network Administrator', 'The Network Administrator manages corporate LAN/WAN, ensures uptime, configures enterprise switches/routers, performs monitoring, and implements security controls.', 'AU$85,000 - AU$105,000 per annum', 'Senior Network Engineer', '1. Deploy and maintain network switches, routers, firewalls and wireless systems. 2. Monitor network health and respond to incidents to achieve SLA targets. 3. Carry out network configuration changes, backups and documentation. 4. Collaborate with security team to apply patches and firewall rules.', 'Bachelor\'s degree in IT or equivalent experience, 3+ years in network administration, Knowledge of TCP/IP/VLANs/OSPF/BGP/DHCP/DNS, CCNA or equivalent certification.', 'Experience with automation (Ansible) and scripting (Python, Bash), Experience in cloud networking (AWS VPC / Azure VNets).', 'Dec 31st 2025'),
(2, 'ITSM7', 'IT Service Management Analyst', 'The ITSM Analyst focuses on ITIL-based incident, problem and change processes, drives service improvements and coordinates between stakeholders to ensure high-quality IT service delivery.', 'AU$70,000 - AU$90,000 per annum', 'IT Operations Manager', '1. Manage incident lifecycle and ensure first response SLAs are met. 2. Run problem investigations and document root causes. 3. Coordinate change approvals and release windows with stakeholders.', '2+ years in IT support or service management, Familiarity with ITIL foundations and ticketing systems (Jira Service Management preferred).', 'Experience with service automation and reporting (Power BI/Excel).', 'Dec 31st 2026');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `manager_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`manager_id`, `username`, `password_hash`) VALUES
(1, 'hr_manager', '$2y$10$OJuJk6wq3z.Sy6pok2lZrOyvGE3KCP/b6.j6XhQuLU1PoKZYSy5am');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`manager_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
