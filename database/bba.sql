-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 03:59 PM
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
-- Database: `bba`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id_admin` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `codeActivation` int(11) DEFAULT 0,
  `date_creation` datetime DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id_admin`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `codeActivation`, `date_creation`, `last_login`) VALUES
(1, 'oussama', 'nafour', 'oussama@nafour.com', '$2y$10$/DgnrNSQ0Q1NeHqwovQPAe.zBXxGgAEI6sL.D9NhXzFU6NWStyFKK', 'Head-Admin', 'Online', 0, '2024-06-02 00:21:18', '2025-04-23 13:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `image`, `designation`, `date_creation`) VALUES
(19, 'devcat.jpg', 'Web Development', '2024-06-08 21:04:09'),
(20, 'photographie.jpg', 'Photographie', '2024-06-08 23:13:36'),
(34, 'design.jpg', 'Design', '2024-06-28 23:21:53'),
(35, 'logicielinfo.jpg', 'informatique et logiciel', '2024-07-02 00:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id_course` int(11) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_instructor` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `date_post` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id_course`, `id_category`, `id_instructor`, `image`, `title`, `description`, `level`, `duration`, `date_post`) VALUES
(1, 19, 11, 'dev.png', 'HTML CSS And JAVASCRIPT', 'Unlock the potential of web development with our comprehensive course designed for beginners and those looking to enhance their coding skills. This all-in-one course covers the three core technologies of the web: HTML, CSS, and JavaScript.\r\nWhat You Will Learn:\r\nHTML (HyperText Markup Language):\r\nUnderstand the structure of web pages\r\nLearn how to create and organize content using HTML tags and attributes\r\nMaster semantic HTML to enhance accessibility and SEO\r\nCSS (Cascading Style Sheets):\r\n\r\nStyle your web pages with CSS to make them visually appealing\r\nLearn about selectors, properties, and values to customize the look and feel of your site\r\nExplore advanced topics such as flexbox, grid layout, and responsive design to ensure your site looks great on all devices\r\nJavaScript:\r\nAdd interactivity to your web pages with JavaScript\r\nUnderstand variables, functions, and events to create dynamic content\r\nLearn about DOM manipulation, event handling, and asynchronous programming to build more sophisticated web applications', 'All Levels', '22h54min', '2024-06-09 02:01:34'),
(15, 19, 7, 'laravel.jpg', 'Framework Laravel', 'Laravel est un framework PHP open-source élégant et puissant pour développer des applications web.\r\nIl suit le modèle MVC (Modèle-Vue-Contrôleur) et facilite le routage, l&#039;authentification, les bases de données et plus encore.\r\nGrâce à sa syntaxe expressive et ses outils intégrés (comme Eloquent ORM, Blade, Artisan), Laravel accélère le développement tout en restant structuré.', 'Beginer', '22h30min', '2024-07-01 21:13:12'),
(28, 19, 11, 'mysql.png', 'MySQL PhpMyAdmin Access SQL Server', 'La base de données est globalement définie comme un ensemble d’informations et de sources de connaissances auquel les utilisateurs peuvent accéder. Elle peut être actualisée grâce à l’ajout ou l’élimination de nouvelles données, ou par la modification des anciennes. Son utilisation au sein des entreprises a nettement évolué et prend une place de plus en plus prépondérante dans la conduite et le développement des affaires.', 'All Levels', '15h37min', '2024-07-03 21:03:54'),
(29, 35, 12, 'networkper.jpeg', 'Network', 'A network is a group of interconnected devices that communicate and share resources, like files or internet access.\r\nIt can be local (LAN) or wide-area (WAN), using wired or wireless connections.\r\nNetworks rely on protocols (like TCP/IP) to ensure data is transmitted accurately between devices.', 'Beginer', '5h02min', '2025-04-23 00:25:48');

--
-- Triggers `courses`
--
DELIMITER $$
CREATE TRIGGER `notifis` AFTER UPDATE ON `courses` FOR EACH ROW BEGIN
    DECLARE update_title VARCHAR(255);
    SET update_title = CONCAT('Update: ', NEW.title);

    INSERT INTO notifications (id_course, update_title, message)
    VALUES (NEW.id_course, update_title, 'This course has been updated. Feel free to check what''s new.');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id_instructor` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'Instructor',
  `domaine` varchar(50) DEFAULT NULL,
  `codeActivation` int(11) DEFAULT 0,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id_instructor`, `first_name`, `last_name`, `email`, `password`, `role`, `domaine`, `codeActivation`, `date_creation`) VALUES
(5, 'oussama', 'nafour', 'oeussamap@gmail.com', '$2y$10$ShwBLFY96UhxhJQBxaE0Vusejf6T67FWEIYEPD6rPKqlmWqxmMnyC', 'Instructors', 'Development', 0, '2024-06-07 17:55:39'),
(7, 'zineb', 'talebi', 'zinebtalebi33@gmail.com', '$2y$10$ShwBLFY96UhxhJQBxaE0Vusejf6T67FWEIYEPD6rPKqlmWqxmMnyC', 'Instructor', 'Development', 0, '2024-06-08 16:21:34'),
(11, 'zakaria', 'Hajji', 'zakaria@hajji.com', '$2y$10$ShwBLFY96UhxhJQBxaE0Vusejf6T67FWEIYEPD6rPKqlmWqxmMnyC', 'Instructor', 'Development', 0, '2024-06-11 23:56:42'),
(12, 'Jhon', 'Doe', 'jhon@doe.com', '$2y$10$RCe9V/D17Kldl.RI22TOiu1vuZMJvaEfmbl5WRv2pi8nyQqA6Umdy', 'Instructor', 'informatique et logiciel', 0, '2025-04-23 00:23:20'),
(13, 'achraf', 'Faiz', 'achraf@fiaz.com', '$2y$10$Jsb6JydMo3ik9mCHMOKupegrsmJCP92nbtzKNU3cuzsTw/UUNdnhq', 'Instructor', 'Web Development', 0, '2025-04-23 13:04:19');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id_lesson` int(11) NOT NULL,
  `id_course` int(11) DEFAULT NULL,
  `id_instructor` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `contenu_image` varchar(100) DEFAULT NULL,
  `contenu_video` varchar(100) DEFAULT NULL,
  `date_post` datetime DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id_lesson`, `id_course`, `id_instructor`, `title`, `description`, `contenu_image`, `contenu_video`, `date_post`, `last_update`) VALUES
(9, 1, 11, 'Introduction to HTML', 'HyperText Markup Language (HTML) is the standard markup language for documents designed to be displayed\r\nin a web browser. It defines the content and structure of web content.It is often assisted by \r\ntechnologies such as Cascading Style Sheets (CSS) and scripting languages such as JavaScript.', 'HTML5.png', 'Desktop 2024.06.09 - 13.44.25.01.mp4', '2024-07-04 21:56:55', NULL),
(10, 1, 11, 'Add a video in HTML5', 'in this lesson you gonna learn how to add a video in web browser\r\n- video tag and some features \r\n- source tag \r\nhope you enjoy it', 'HTML5.png', 'Learn how to add video in HTML .mp4', '2024-07-06 00:48:53', NULL),
(12, 1, 11, 'Generale Introduction to CSS', 'CSS (Cascading Style Sheets) is used to style and lay out web pages \r\nfor example, to alter the font, color, size, and spacing of your content,\r\n split it into multiple columns, or add animations and other decorative features\r\n. This module provides a gentle beginning to your path towards CSS\r\n mastery with the basics of how it works, what the syntax looks like, and how you can start using it to add styling to HTML.', 'css.png', 'general intro to CSS.mp4', '2024-07-07 03:45:35', NULL),
(14, 29, 12, 'Introduction to network', 'A network is a group of interconnected devices that communicate and share resources.\r\nNetworks can be wired or wireless, ranging from small home setups to large global systems like the internet.\r\nThey are essential for data exchange, communication, and access to services across multiple devices.', 'cyber.jpg', 'What is a network_.mp4', '2025-04-23 00:47:37', NULL),
(15, 29, 12, 'Network Devices ', 'Network devices are hardware components that connect and manage communication between computers in a network.\r\nCommon devices include routers, which direct data traffic, and switches, which connect multiple devices within a local network.\r\nModems enable internet access by converting digital signals to analog and vice versa.\r\nAccess points provide wireless connectivity, allowing devices to join the network without cables.', NULL, 'Network Devices Explained _ Hub, Bridge, Router, Switch.mp4', '2025-04-23 00:57:11', NULL),
(16, 29, 12, 'OSI Model', 'The OSI model (Open Systems Interconnection) is a 7-layer framework that standardizes network communication.\r\nEach layer—from Physical to Application—handles a specific part of data transfer across a network.\r\nIt helps developers design interoperable network systems and troubleshoot issues more effectively.', NULL, 'OSI Model Explained _ Real World Example.mp4', '2025-04-23 01:02:24', NULL),
(17, 29, 12, 'TCP/IP ', 'TCP/IP (Transmission Control Protocol/Internet Protocol) is the core communication protocol suite of the internet.\r\nIt consists of layers that handle how data is packaged, addressed, transmitted, and received across networks.\r\nTCP ensures reliable data delivery, while IP manages addressing and routing between devices.', NULL, 'IP Model Explained _ Cisco CCNA 200-301.mp4', '2025-04-23 01:03:10', NULL),
(18, 29, 12, 'IP Addresses ', 'An IP address is a unique numerical label assigned to each device connected to a network.\r\nIt identifies the device and enables communication over the internet or local networks.\r\nThere are two main versions: IPv4 (e.g., 192.168.1.1) and IPv6 (e.g., 2001:0db8::1).', NULL, 'IP address network and host portion _ subnet mask  explained in simple terms _ CCNA 200-301 _.mp4', '2025-04-23 01:08:58', NULL),
(19, 15, 7, 'introduction Laravel', 'Laravel', NULL, 'Laravel 6 Tutorial for Beginers #1 - Introduction.mp4', '2025-04-23 02:30:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL,
  `id_course` int(11) DEFAULT NULL,
  `update_title` varchar(50) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `date_notifs` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id_notification`, `id_course`, `update_title`, `message`, `date_notifs`) VALUES
(1, 28, 'Update: MySQL PhpMyAdmin Access SQL Server', 'This course has been updated. Feel free to check what\'s new.', '2024-07-04 20:36:33'),
(2, 8, 'Update: JAVASCRIPT', 'This course has been updated. Feel free to check what\'s new.', '2024-07-04 20:44:04'),
(3, 6, 'Update: maquette', 'This course has been updated. Feel free to check what\'s new.', '2024-07-07 02:51:36'),
(4, 29, 'Update: CyberSecurity', 'This course has been updated. Feel free to check what\'s new.', '2025-04-23 00:46:16'),
(5, 28, 'Update: MySQL PhpMyAdmin Access SQL Server', 'This course has been updated. Feel free to check what\'s new.', '2025-04-23 01:52:29'),
(6, 15, 'Update: Framework Laravel', 'This course has been updated. Feel free to check what\'s new.', '2025-04-23 02:04:06'),
(7, 15, 'Update: Framework Laravel', 'This course has been updated. Feel free to check what\'s new.', '2025-04-23 02:10:47'),
(8, 29, 'Update: Network', 'This course has been updated. Feel free to check what\'s new.', '2025-04-23 02:12:58'),
(9, 29, 'Update: Network', 'This course has been updated. Feel free to check what\'s new.', '2025-04-23 02:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `progresses`
--

CREATE TABLE `progresses` (
  `id_progress` int(11) NOT NULL,
  `titre_lesson` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_start` datetime DEFAULT current_timestamp(),
  `date_end` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_lesson` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `progresses`
--

INSERT INTO `progresses` (`id_progress`, `titre_lesson`, `status`, `date_start`, `date_end`, `id_user`, `id_lesson`) VALUES
(32, 'Introduction to network', 'Lesson finished', '2025-04-23 13:02:48', '2025-04-23 13:03:02', 10, 14),
(33, 'Network Devices ', 'In progress', '2025-04-23 13:03:33', NULL, 10, 15),
(34, 'OSI Model', 'In progress', '2025-04-23 13:03:40', NULL, 10, 16),
(35, 'introduction Laravel', 'In progress', '2025-05-05 14:51:37', NULL, 10, 19),
(36, 'Introduction to HTML', 'In progress', '2025-05-05 14:54:25', NULL, 10, 9),
(37, 'Add a video in HTML5', 'In progress', '2025-05-05 14:54:29', NULL, 10, 10),
(38, 'Generale Introduction to CSS', 'In progress', '2025-05-05 14:54:32', NULL, 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id_quiz` int(11) NOT NULL,
  `id_lesson` int(11) DEFAULT NULL,
  `id_instructor` int(11) DEFAULT NULL,
  `number_question` int(11) DEFAULT NULL,
  `question` varchar(100) DEFAULT NULL,
  `option1` varchar(100) NOT NULL,
  `option2` varchar(100) NOT NULL,
  `option3` varchar(100) NOT NULL,
  `option4` varchar(100) NOT NULL,
  `answer` varchar(100) DEFAULT NULL,
  `date_post` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id_quiz`, `id_lesson`, `id_instructor`, `number_question`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `date_post`) VALUES
(6, 9, 11, 1, 'What are tags?', 'Content is placed in between HTML tags', 'ordered list', 'Comments', 'Image map', 'Content is placed in between HTML tags', '2024-07-07 14:05:21'),
(7, 9, 11, 2, 'What is HTML ?', 'programming language', 'front-end script', 'that defines the structure of web pages', 'database', 'that defines the structure of web pages', '2024-07-07 16:19:29'),
(8, 9, 11, 3, 'What is an image map?', 'blank sequence', 'many different web pages using a single image', 'Surround the image', 'links that connect to another', 'many different web pages using a single image', '2024-07-07 19:48:20'),
(10, 14, 12, 1, 'What is the main purpose of a computer network?', 'To store data permanently', 'To connect printers only', 'To allow devices to communicate and share resources', 'To play offline games', 'To allow devices to communicate and share resources', '2025-04-23 01:23:06'),
(11, 14, 12, 2, 'Which device is used to direct data between different networks?', 'Switch', 'Modem', 'Router', 'Access Point', 'Router', '2025-04-23 01:23:53'),
(12, 14, 12, 3, 'What type of network connects computers within a small area, like a home or office?', 'WAN', 'LAN', 'MAN', 'PAN', 'LAN', '2025-04-23 01:25:08'),
(13, 14, 12, 4, 'Which of the following best describes the Internet?', 'A private network inside a company', 'A global network connecting millions of devices', 'A virus protection software', 'A type of programming language', 'A global network connecting millions of devices', '2025-04-23 01:25:46'),
(14, 15, 12, 1, 'Which device connects multiple devices within a local network and uses MAC addresses to forward data', 'Router', 'Modem', 'Switch', 'Firewall', 'Switch', '2025-04-23 01:27:15'),
(15, 15, 12, 2, 'What is the main function of a router in a network?', 'To store files', 'To manage user accounts', 'To direct data between different networks', 'To convert analog signals to digital', 'To direct data between different networks', '2025-04-23 01:28:00'),
(16, 15, 12, 3, 'Which device provides wireless access to a wired network?', 'Hub', 'Access Point', 'Switch', 'Modem', 'Access Point', '2025-04-23 01:28:39'),
(17, 15, 12, 4, 'What is the role of a modem in a home network?', 'Acts as a firewall', 'Connects the network to the internet', 'Stores network logs', 'Assigns IP addresses', 'Connects the network to the internet', '2025-04-23 01:29:20');

-- --------------------------------------------------------

--
-- Table structure for table `recordsquiz`
--

CREATE TABLE `recordsquiz` (
  `id` int(11) NOT NULL,
  `id_lesson` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_quiz` int(11) DEFAULT NULL,
  `lesson_title` varchar(100) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `recordsquiz`
--

INSERT INTO `recordsquiz` (`id`, `id_lesson`, `id_user`, `id_quiz`, `lesson_title`, `score`, `date`) VALUES
(14, 14, 10, 13, 'Introduction to network', 15, '2025-04-23 13:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Offline',
  `codeActivation` int(11) DEFAULT 0,
  `date_creation` datetime DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `email`, `password`, `status`, `codeActivation`, `date_creation`, `last_login`) VALUES
(10, 'assil', 'Nafour', 'oussi@naf.com', '$2y$10$eNLS4RD7vZ3vWBc8n0ZgFemQnsfySHdMLXBS5710K8qnbhfdF6RzG', 'Online', 0, '2025-04-23 13:02:26', '2025-05-05 14:55:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `foreign_key_instructor` (`id_instructor`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id_instructor`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id_lesson`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_instructor` (`id_instructor`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notification`);

--
-- Indexes for table `progresses`
--
ALTER TABLE `progresses`
  ADD PRIMARY KEY (`id_progress`),
  ADD KEY `progresses_ibfk_1` (`id_lesson`),
  ADD KEY `progresses_ibfk_2` (`id_user`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id_quiz`),
  ADD KEY `id_lesson` (`id_lesson`),
  ADD KEY `id_instructor` (`id_instructor`);

--
-- Indexes for table `recordsquiz`
--
ALTER TABLE `recordsquiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_quiz` (`id_quiz`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id_instructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id_lesson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `progresses`
--
ALTER TABLE `progresses`
  MODIFY `id_progress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `recordsquiz`
--
ALTER TABLE `recordsquiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`id_instructor`) REFERENCES `instructor` (`id_instructor`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`),
  ADD CONSTRAINT `lessons_ibfk_2` FOREIGN KEY (`id_instructor`) REFERENCES `instructor` (`id_instructor`);

--
-- Constraints for table `progresses`
--
ALTER TABLE `progresses`
  ADD CONSTRAINT `progresses_ibfk_1` FOREIGN KEY (`id_lesson`) REFERENCES `lessons` (`id_lesson`),
  ADD CONSTRAINT `progresses_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `recordsquiz`
--
ALTER TABLE `recordsquiz`
  ADD CONSTRAINT `recordsquiz_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `recordsquiz_ibfk_2` FOREIGN KEY (`id_quiz`) REFERENCES `quizzes` (`id_quiz`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
