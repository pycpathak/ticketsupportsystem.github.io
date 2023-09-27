-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 09:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tssystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `maintopics`
--

CREATE TABLE `maintopics` (
  `topic_id` int(20) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `topic_desc` varchar(255) NOT NULL,
  `topic_logo` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintopics`
--

INSERT INTO `maintopics` (`topic_id`, `topic_name`, `topic_desc`, `topic_logo`, `created`) VALUES
(1, 'HTML', 'The HyperText Markup Language or HTML is the standard markup language for documents designed to be displayed in a web browser. It defines web page.', 'assets\\images\\html5.png', '2023-09-05 04:04:44'),
(2, 'CSS', 'Cascading Style Sheets is a style sheet language used for describing the presentation of a document written in a markup language such as HTML or XML.', 'assets\\images\\css3.jpg', '2023-09-05 03:50:11'),
(3, 'Javascript', 'JavaScript, often abbreviated as JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. ', 'assets\\images\\javascript.png', '2023-09-13 07:03:29'),
(4, 'PHP', 'PHP is a general-purpose scripting language geared towards web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf.', 'assets\\images\\php.jpg', '2023-09-05 04:01:46'),
(5, 'MySQL', 'MySQL HeatWave is a fully managed database service for transactions, real- time analytics across data warehouses and data lakes, and machine learning.', 'assets\\images\\mysql.png', '2023-09-14 14:49:30'),
(7, 'Python', 'Python is dynamically typed and garbage-collected. It supports multiple programming paradigms, including structured (particularly procedural).\r\n', 'assets\\images\\python.png', '2023-09-14 14:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `replies_id` int(20) NOT NULL,
  `replies_desc` varchar(255) NOT NULL,
  `thread_id` int(20) NOT NULL,
  `reply_by` int(20) NOT NULL,
  `thread_cat_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`replies_id`, `replies_desc`, `thread_id`, `reply_by`, `thread_cat_id`) VALUES
(6, 'To add these symbols to an HTML page, you can use the HTML entity name. If no entity name exists, you can use the entity number. If the character does not have an entity name, you can use a decimal (or hexadecimal) reference.', 2, 4, 1),
(20, 'cx cx x', 33, 1, 2),
(21, 'so you have include margin:0px into * selector', 33, 2, 2),
(24, 'event bubbling is a method to create events', 35, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(20) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` varchar(255) NOT NULL,
  `thread_cat_id` int(20) NOT NULL,
  `thread_user_id` int(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES
(1, 'What are void elements in HTML?', 'HTML elements which do not have closing tags or do not need to be closed are Void elements.', 1, 1, '2023-09-05 15:33:35'),
(2, ' What are HTML Entities?', 'In HTML some characters are reserved like ‘<’, ‘>’, ‘/’, etc. To use these characters in our webpage we need to use the character entities called HTML Entities. Below are a few mapping between the reserved character and its respective entity character to ', 1, 1, '2023-09-05 15:34:23'),
(3, 'What is the ‘class’ attribute in Javascript ?', 'The class attribute is used to specify the class name for an HTML element. Multiple elements in HTML can have the same class value. Also, it is mainly used to associate the styles written in the stylesheet with the HTML elements.', 3, 1, '2023-09-05 15:35:26'),
(24, 'What causes a PHP error?', 'Finally, errors are unrecoverable (execution will stop). Typical causes of errors are parsing errors like missing semi-colons, function, or class definitions, or other problems the engine does not know how to resolve.', 4, 4, '2023-09-08 13:31:30'),
(29, 'CSS margin problem', 'it is not deleting margin\r\n', 2, 1, '2023-09-09 00:23:41'),
(31, 'What happens if browser doesn&#039;t understand CSS?', 'If the browser does not understand that line of CSS, it just skips it and gets on with the next thing it does understand.', 2, 5, '2023-09-11 22:54:29'),
(32, 'What is latest version of MySQL?', 'I want to know the  latest version of MySQL', 5, 1, '2023-09-12 12:37:51'),
(33, 'i am facing css margin problem', 'i am facing css margin problem', 2, 1, '2023-09-12 18:00:18'),
(34, 'What is HTML entities reference?', 'To add these symbols to an HTML page, you can use the HTML entity name. If no entity name exists, you can use the entity number.', 1, 2, '2023-09-12 23:25:48'),
(35, 'What is event bubbling in JS?', 'Event bubbling is a method of event propagation in the HTML DOM API when an event is in an element inside another element, and both elements have registered a handle to that event.', 3, 5, '2023-09-13 12:01:01'),
(36, 'What is latest version of python?', 'Python 3.11.4 is the newest major release of the Python programming language, and it contains many new features and optimizations.', 7, 1, '2023-09-13 16:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `email`, `password`) VALUES
(1, 'Parth Pathak', 'parth@gmail.com', '123'),
(2, 'Aditya King', 'aditya@gmail.com', '789'),
(4, 'Parth Pathaka', 'down@yahoo.com', 'Parth@123'),
(5, 'Vishal Verma', 'vishal@yahoo.com', 'Vishal@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maintopics`
--
ALTER TABLE `maintopics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`replies_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maintopics`
--
ALTER TABLE `maintopics`
  MODIFY `topic_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `replies_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
