-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 08 juil. 2024 à 00:43
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `brainboost_academy`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrators`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrators`
--

INSERT INTO `administrators` (`id_admin`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `codeActivation`, `date_creation`, `last_login`) VALUES
(1, 'oussama', 'nafour', 'oussama@nafour.com', '$2y$10$fyxtHL7b6CW7odkQ3rIwHej1DDQRa6nCYrVFBhy7k.thjhG07v8xq', 'Head-Admin', 'Online', 0, '2024-06-02 00:21:18', '2024-07-07 12:21:52'),
(5, 'zineb', 'talebi', 'zinebtalebi33@gmail.com', '$2y$10$fyxtHL7b6CW7odkQ3rIwHej1DDQRa6nCYrVFBhy7k.thjhG07v8xq', 'Trail-Admin', 'Online', 0, '2024-06-08 04:26:52', '2024-07-06 17:33:58');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_category`, `image`, `designation`, `date_creation`) VALUES
(19, 'devcat.jpg', 'Web Development', '2024-06-08 21:04:09'),
(20, 'photographie.jpg', 'Photographie', '2024-06-08 23:13:36'),
(34, 'design.jpg', 'Design', '2024-06-28 23:21:53'),
(35, 'logicielinfo.jpg', 'informatique et logiciel', '2024-07-02 00:32:08');

-- --------------------------------------------------------

--
-- Structure de la table `courses`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`id_course`, `id_category`, `id_instructor`, `image`, `title`, `description`, `level`, `duration`, `date_post`) VALUES
(1, 19, 11, 'dev.png', 'HTML CSS And JAVASCRIPT', 'Unlock the potential of web development with our comprehensive course designed for beginners and those looking to enhance their coding skills. This all-in-one course covers the three core technologies of the web: HTML, CSS, and JavaScript.\r\nWhat You Will Learn:\r\nHTML (HyperText Markup Language):\r\nUnderstand the structure of web pages\r\nLearn how to create and organize content using HTML tags and attributes\r\nMaster semantic HTML to enhance accessibility and SEO\r\nCSS (Cascading Style Sheets):\r\n\r\nStyle your web pages with CSS to make them visually appealing\r\nLearn about selectors, properties, and values to customize the look and feel of your site\r\nExplore advanced topics such as flexbox, grid layout, and responsive design to ensure your site looks great on all devices\r\nJavaScript:\r\nAdd interactivity to your web pages with JavaScript\r\nUnderstand variables, functions, and events to create dynamic content\r\nLearn about DOM manipulation, event handling, and asynchronous programming to build more sophisticated web applications', 'All Levels', '22h54min', '2024-06-09 02:01:34'),
(6, 34, 5, 'design.jpg', 'maquette', 'et voila c &#039; &#039;trop compliqué mais il est très facile pour le faire ', 'All Levels', '17H05min', '2024-06-30 00:41:29'),
(8, 19, 5, 'javascriptfull.png', 'JAVASCRIPT', 'JavaScript est un langage de programmation polyvalent et essentiellement utilisé pour créer des applications web interactives. Voici une brève description de ses principales caractéristiques et utilisations\r\n', 'Beginer', '11h54min', '2024-06-30 20:53:19'),
(13, 19, 5, 'jjavaScript.jpg', 'Prevent in javascript', 'aaaaaaaaa', 'Beginer', '13h20min', '2024-07-01 20:28:37'),
(15, 19, 7, 'js.png', 'JavaScript', 'complete course in javascript', 'All Levels', '22h30min', '2024-07-01 21:13:12'),
(28, 19, 11, 'sql.png', 'MySQL PhpMyAdmin Access SQL Server', 'La base de données est globalement définie comme un ensemble d’informations et de sources de connaissances auquel les utilisateurs peuvent accéder. Elle peut être actualisée grâce à l’ajout ou l’élimination de nouvelles données, ou par la modification des anciennes. Son utilisation au sein des entreprises a nettement évolué et prend une place de plus en plus prépondérante dans la conduite et le développement des affaires.', 'All Levels', '15h37min', '2024-07-03 21:03:54');

--
-- Déclencheurs `courses`
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
-- Structure de la table `instructor`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `instructor`
--

INSERT INTO `instructor` (`id_instructor`, `first_name`, `last_name`, `email`, `password`, `role`, `domaine`, `codeActivation`, `date_creation`) VALUES
(5, 'oussama', 'nafour', 'oeussamap@gmail.com', '$2y$10$ShwBLFY96UhxhJQBxaE0Vusejf6T67FWEIYEPD6rPKqlmWqxmMnyC', 'Instructors', 'Development', 0, '2024-06-07 17:55:39'),
(7, 'zineb', 'talebi', 'zinebtalebi33@gmail.com', '$2y$10$ShwBLFY96UhxhJQBxaE0Vusejf6T67FWEIYEPD6rPKqlmWqxmMnyC', 'Instructor', 'Development', 0, '2024-06-08 16:21:34'),
(11, 'zakaria', 'Hajji', 'zakaria@hajji.com', '$2y$10$ShwBLFY96UhxhJQBxaE0Vusejf6T67FWEIYEPD6rPKqlmWqxmMnyC', 'Instructor', 'Development', 0, '2024-06-11 23:56:42');

-- --------------------------------------------------------

--
-- Structure de la table `lessons`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lessons`
--

INSERT INTO `lessons` (`id_lesson`, `id_course`, `id_instructor`, `title`, `description`, `contenu_image`, `contenu_video`, `date_post`, `last_update`) VALUES
(9, 1, 11, 'Introduction to HTML', 'HyperText Markup Language (HTML) is the standard markup language for documents designed to be displayed\r\nin a web browser. It defines the content and structure of web content.It is often assisted by \r\ntechnologies such as Cascading Style Sheets (CSS) and scripting languages such as JavaScript.', 'HTML5.png', 'Desktop 2024.06.09 - 13.44.25.01.mp4', '2024-07-04 21:56:55', NULL),
(10, 1, 11, 'Add a video in HTML5', 'in this lesson you gonna learn how to add a video in web browser\r\n- video tag and some features \r\n- source tag \r\nhope you enjoy it', 'HTML5.png', 'Learn how to add video in HTML .mp4', '2024-07-06 00:48:53', NULL),
(12, 1, 11, 'Generale Introduction to CSS', 'CSS (Cascading Style Sheets) is used to style and lay out web pages \r\nfor example, to alter the font, color, size, and spacing of your content,\r\n split it into multiple columns, or add animations and other decorative features\r\n. This module provides a gentle beginning to your path towards CSS\r\n mastery with the basics of how it works, what the syntax looks like, and how you can start using it to add styling to HTML.', 'css.png', 'general intro to CSS.mp4', '2024-07-07 03:45:35', NULL),
(13, 15, 7, 'Intoduction to JAVASCRIPT', 'JavaScript is a lightweight, cross-platform, single-threaded,\r\n and interpreted compiled programming language. It is also known as the scripting language for \r\nwebpages. It is well-known for the development of web pages', 'javascriptfull.png', 'introduction javascript.mp4', '2024-07-07 21:35:08', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL,
  `id_course` int(11) DEFAULT NULL,
  `update_title` varchar(50) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `date_notifs` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id_notification`, `id_course`, `update_title`, `message`, `date_notifs`) VALUES
(1, 28, 'Update: MySQL PhpMyAdmin Access SQL Server', 'This course has been updated. Feel free to check what\'s new.', '2024-07-04 20:36:33'),
(2, 8, 'Update: JAVASCRIPT', 'This course has been updated. Feel free to check what\'s new.', '2024-07-04 20:44:04'),
(3, 6, 'Update: maquette', 'This course has been updated. Feel free to check what\'s new.', '2024-07-07 02:51:36');

-- --------------------------------------------------------

--
-- Structure de la table `progresses`
--

CREATE TABLE `progresses` (
  `id_progress` int(11) NOT NULL,
  `titre_lesson` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_start` datetime DEFAULT current_timestamp(),
  `date_end` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_lesson` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `progresses`
--

INSERT INTO `progresses` (`id_progress`, `titre_lesson`, `status`, `date_start`, `date_end`, `id_user`, `id_lesson`) VALUES
(11, 'Introduction to HTML', 'Lesson finished', '2024-07-07 03:43:21', '2024-07-07 03:43:54', 3, 9),
(12, 'Add a video in HTML5', 'Lesson finished', '2024-07-07 03:44:12', '2024-07-07 03:44:35', 3, 10),
(13, 'Generale Introduction to CSS', 'Lesson finished', '2024-07-07 03:45:48', '2024-07-07 03:46:06', 3, 12),
(14, 'Introduction to HTML', 'Lesson finished', '2024-07-07 03:58:54', '2024-07-07 03:59:02', 5, 9),
(15, 'Add a video in HTML5', 'Lesson finished', '2024-07-07 04:00:03', '2024-07-07 04:00:50', 5, 10),
(16, 'Generale Introduction to CSS', 'Lesson finished', '2024-07-07 04:01:03', '2024-07-07 04:01:10', 5, 12),
(17, 'Intoduction to JAVASCRIPT', 'Lesson finished', '2024-07-07 21:41:42', '2024-07-07 21:41:53', 3, 13);

-- --------------------------------------------------------

--
-- Structure de la table `quizzes`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quizzes`
--

INSERT INTO `quizzes` (`id_quiz`, `id_lesson`, `id_instructor`, `number_question`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `date_post`) VALUES
(6, 9, 11, 1, 'What are tags?', 'Content is placed in between HTML tags', 'ordered list', 'Comments', 'Image map', 'Content is placed in between HTML tags', '2024-07-07 14:05:21'),
(7, 9, 11, 2, 'What is HTML ?', 'programming language', 'front-end script', 'that defines the structure of web pages', 'database', 'that defines the structure of web pages', '2024-07-07 16:19:29'),
(8, 9, 11, 3, 'What is an image map?', 'blank sequence', 'many different web pages using a single image', 'Surround the image', 'links that connect to another', 'many different web pages using a single image', '2024-07-07 19:48:20'),
(9, 13, 7, 1, 'how to declare a variable in javascript ?', '$x', '@x', 'let x', 'int x', 'let x', '2024-07-07 21:40:54');

-- --------------------------------------------------------

--
-- Structure de la table `recordsquiz`
--

CREATE TABLE `recordsquiz` (
  `id` int(11) NOT NULL,
  `id_lesson` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_quiz` int(11) DEFAULT NULL,
  `lesson_title` varchar(100) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recordsquiz`
--

INSERT INTO `recordsquiz` (`id`, `id_lesson`, `id_user`, `id_quiz`, `lesson_title`, `score`, `date`) VALUES
(7, 9, 3, 8, 'Introduction to HTML', 15, '2024-07-07 23:38:12'),
(8, 13, 3, 9, 'Intoduction to JAVASCRIPT', 5, '2024-07-07 23:38:39');

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `email`, `password`, `status`, `codeActivation`, `date_creation`, `last_login`) VALUES
(3, 'oussama', 'nafour', 'nafour@oussama.com', '$2y$10$oMln4XXiIlZYcU7CZYKKKOVHb2HKo/z21TGR4i9aMiBNHF7u1Lp96', 'Online', 0, '2024-06-07 21:58:48', '2024-07-07 22:37:18'),
(4, 'Mehdi', 'abounouare', 'mehdi@abu.com', '$2y$10$xBJOCxVCSgP/b7RU/WjjCu1dThkkLqI0DRsuaXOm8XgJMKStPrLVG', 'Online', 0, '2024-07-05 22:34:05', '2024-07-06 02:06:54'),
(5, 'Amine', 'Nafour', 'amine@nafour.com', '$2y$10$.QnANBOTtDgXL0JUhB1pnucaVIly8lOECrhxOkz8vtI9PrEmrPLqy', 'Offline', 0, '2024-07-05 23:32:04', '2024-07-07 20:24:02');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `foreign_key_instructor` (`id_instructor`);

--
-- Index pour la table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id_instructor`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id_lesson`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_instructor` (`id_instructor`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notification`);

--
-- Index pour la table `progresses`
--
ALTER TABLE `progresses`
  ADD PRIMARY KEY (`id_progress`),
  ADD KEY `progresses_ibfk_1` (`id_lesson`),
  ADD KEY `progresses_ibfk_2` (`id_user`);

--
-- Index pour la table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id_quiz`),
  ADD KEY `id_lesson` (`id_lesson`),
  ADD KEY `id_instructor` (`id_instructor`);

--
-- Index pour la table `recordsquiz`
--
ALTER TABLE `recordsquiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_quiz` (`id_quiz`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id_instructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id_lesson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `progresses`
--
ALTER TABLE `progresses`
  MODIFY `id_progress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `recordsquiz`
--
ALTER TABLE `recordsquiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`id_instructor`) REFERENCES `instructor` (`id_instructor`);

--
-- Contraintes pour la table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`),
  ADD CONSTRAINT `lessons_ibfk_2` FOREIGN KEY (`id_instructor`) REFERENCES `instructor` (`id_instructor`);

--
-- Contraintes pour la table `progresses`
--
ALTER TABLE `progresses`
  ADD CONSTRAINT `progresses_ibfk_1` FOREIGN KEY (`id_lesson`) REFERENCES `lessons` (`id_lesson`),
  ADD CONSTRAINT `progresses_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `recordsquiz`
--
ALTER TABLE `recordsquiz`
  ADD CONSTRAINT `recordsquiz_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `recordsquiz_ibfk_2` FOREIGN KEY (`id_quiz`) REFERENCES `quizzes` (`id_quiz`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
