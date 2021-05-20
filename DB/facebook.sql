-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 08:19 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `POST_ID` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `POST_ID`, `comment_by`, `comment`) VALUES
(219, 3, 5, 'hello'),
(220, 16, 5, 'hello'),
(221, 16, 5, 'yoollo'),
(222, 16, 5, 'hahahaha'),
(223, 16, 5, 'halalsdaf'),
(224, 16, 5, 'asdfasdfs'),
(225, 16, 5, 'sadgasdf'),
(226, 11, 5, 'hello hassan'),
(227, 15, 5, 'hello'),
(228, 15, 5, 'I am testing'),
(229, 8, 5, 'one'),
(230, 8, 5, 'two'),
(231, 11, 5, 'h'),
(232, 15, 5, 'okdfokg'),
(233, 16, 5, 'yes'),
(234, 20, 19, 'googd'),
(235, 18, 5, 'hello'),
(236, 5, 5, 'nice'),
(237, 16, 5, 'll'),
(238, 11, 5, 'hy'),
(239, 21, 5, 'yes'),
(240, 21, 20, 'oh my god'),
(241, 21, 5, 'yes'),
(242, 16, 5, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`) VALUES
(23, 8, 7),
(24, 7, 8),
(25, 7, 5),
(26, 5, 7),
(27, 5, 8),
(28, 8, 5),
(29, 5, 16),
(30, 16, 5),
(31, 5, 6),
(32, 6, 5),
(33, 8, 6),
(34, 6, 8),
(35, 5, 15),
(36, 15, 5),
(37, 5, 17),
(38, 17, 5),
(39, 16, 17),
(40, 17, 16),
(41, 8, 17),
(42, 17, 8),
(43, 8, 16),
(44, 16, 8),
(45, 16, 7),
(46, 7, 16),
(47, 19, 5),
(48, 5, 19),
(49, 20, 5),
(50, 5, 20);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `liked_by_id` int(11) NOT NULL,
  `like_status` text NOT NULL DEFAULT 'liked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `p_id`, `liked_by_id`, `like_status`) VALUES
(1, 11, 5, 'liked'),
(3, 8, 5, 'unliked'),
(4, 3, 5, 'unliked'),
(5, 15, 5, 'liked'),
(6, 15, 17, 'liked'),
(7, 15, 16, 'liked'),
(8, 2, 16, 'liked'),
(9, 7, 5, 'unliked'),
(10, 11, 17, 'liked'),
(11, 5, 5, 'liked'),
(12, 11, 8, 'unliked'),
(13, 15, 8, 'liked'),
(14, 13, 5, 'liked'),
(15, 12, 5, 'unliked'),
(16, 16, 5, 'liked'),
(17, 14, 5, 'unliked'),
(18, 6, 5, 'liked'),
(19, 2, 5, 'unliked'),
(20, 1, 5, 'unliked'),
(21, 1, 16, 'liked'),
(22, 13, 16, 'liked'),
(23, 12, 16, 'unliked'),
(24, 3, 16, 'liked'),
(25, 5, 16, 'liked'),
(26, 9, 16, 'unliked'),
(27, 16, 16, 'unliked'),
(28, 9, 5, 'liked'),
(29, 4, 16, 'liked'),
(30, 6, 7, 'liked'),
(31, 10, 5, 'unliked'),
(32, 18, 5, 'liked'),
(33, 20, 19, 'liked'),
(34, 20, 5, 'liked'),
(35, 21, 5, 'unliked');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message_sent_to` int(11) NOT NULL,
  `message_sent_by` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `message_status` text NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message_sent_to`, `message_sent_by`, `message`, `message_status`) VALUES
(1, 5, 16, 'hello Ehtisham', 'read'),
(2, 5, 16, '2nd message from hassan', 'read'),
(3, 5, 17, 'i am zunair', 'read'),
(4, 16, 5, 'i am ehtisham', 'read'),
(5, 16, 5, 'yalla habibi', 'read'),
(6, 5, 16, 'hello', 'read'),
(7, 16, 5, 'how are you hassan', 'read'),
(8, 16, 5, 'ok', 'read'),
(9, 16, 5, 'hello', 'read'),
(10, 16, 5, 'hello', 'unread'),
(11, 17, 5, 'yes sir', 'unread'),
(12, 17, 5, 'dfojod bjksdfbfs', 'unread'),
(13, 17, 5, '', 'unread'),
(14, 17, 5, 'tgfc', 'unread'),
(15, 17, 5, '', 'unread'),
(16, 17, 5, '', 'unread'),
(17, 17, 5, '', 'unread'),
(18, 17, 5, '', 'unread'),
(19, 17, 5, '', 'unread'),
(20, 16, 5, 'jjlj', 'unread'),
(21, 16, 5, 'dasdfasd', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `notification_by` int(11) NOT NULL,
  `notification_to` int(11) NOT NULL,
  `notification` text NOT NULL,
  `notification_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pending_requests`
--

CREATE TABLE `pending_requests` (
  `friends_tb_id` int(11) NOT NULL,
  `sent_by_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `friends_status` text NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending_requests`
--

INSERT INTO `pending_requests` (`friends_tb_id`, `sent_by_id`, `reciever_id`, `friends_status`) VALUES
(34, 8, 15, 'pending'),
(44, 16, 6, 'pending'),
(45, 16, 15, 'pending'),
(46, 18, 17, 'pending'),
(48, 5, 18, 'pending'),
(49, 22, 20, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(999) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_image`, `post_date`, `user_id`) VALUES
(1, 'I am Balo', '3D_Monster-wallpaper-10067276.jpg', '2020-09-17', 5),
(2, 'it\'s me', '3D_Monster-wallpaper-10067276.jpg', '2020-09-17', 5),
(3, 'Dragon\'s Here', '240220_Monkey kingHero is back-1.jpg', '2020-09-17', 5),
(4, 'Beaitfull Kid', '240217_Monkey kingHero is back-5.jpg', '2020-09-17', 5),
(5, 'how are you', 'Beautiful___Wolf-wallpaper-10748416.jpg', '2020-09-18', 5),
(6, 'This Is Heavy Bike', '2017_yamaha_fz-wallpaper-11100411.jpg', '2020-09-19', 7),
(7, 'Favourite game', '419788.jpg', '2020-09-20', 16),
(8, 'Cutie', '20658.jpg', '2020-09-20', 16),
(9, 'Oh no', 'best_hd-wallpaper-1920x1080.jpg', '2020-09-20', 16),
(10, 'Legend never die', '419787.jpg', '2020-09-20', 16),
(11, 'Watch dog 💖', 'Ariel_-mermaid-wallpaper-9147229.jpg', '2020-09-20', 16),
(12, 'Road Lover', '10958f0cbe7e8b9823a15cb5e8184068.jpg', '2020-09-20', 17),
(13, 'Game Lover', '566158.jpg', '2020-09-20', 17),
(14, 'Nature Beauty', '6e2251f94697963a856d808fcfabd088.jpg', '2020-09-20', 17),
(15, 'Its cold outside ooooooo!', 'cat_hqih-wallpaper-1920x1080.jpg', '2020-09-20', 17),
(16, 'Hello Fazey', 'Love-wallpaper-11153134.jpg', '2020-09-22', 5),
(18, 'group photo', '20160521_111036.jpg', '2020-09-24', 7),
(19, 'hy', '1101262.jpg', '2020-10-25', 19),
(20, 'hy', '1101262.jpg', '2020-10-25', 19),
(21, 'heelo', 'pngtree-vector-users-icon-png-image_4144740.jpg', '2021-02-15', 5);

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE `profile_images` (
  `images_id` int(11) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `profile_cover` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_images`
--

INSERT INTO `profile_images` (`images_id`, `profile_img`, `profile_cover`, `user_id`) VALUES
(4, 'FB_IMG_1460048190676.jpg', 'Funny_Monkey-wallpaper-11302573.jpg', 5),
(5, '', '', 6),
(6, '215354_Hero.jpg', '240217_Monkey kingHero is back-5.jpg', 7),
(7, 'IMG_0112_2.jpg', '', 8),
(8, 'FB_IMG_1495753788892.jpg', 'IMG-20171202-WA0014.jpg', 15),
(9, 'FB_IMG_1598009273537.jpg', '8k8h5t0qqef31.jpg', 16),
(10, 'team3.jpg', 'audi-tt-45-tfsi-quattro-s-line-quantum-gray-edition-4136x3103-2019-18126.jpeg', 17),
(11, '', '', 18),
(12, '', '', 19),
(13, '', '', 20),
(14, '', '', 21),
(15, 'FB_IMG_1459958404034.jpg', '', 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `gender` text NOT NULL,
  `status` text NOT NULL,
  `martial_status` text NOT NULL,
  `work_at` text NOT NULL,
  `From?` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `DOB`, `gender`, `status`, `martial_status`, `work_at`, `From?`) VALUES
(5, 'Ehtisham ', 'Saleem', 'saleemehtisham123@gmail.com', '12', '2020-09-02', 'Male', 'online', 'Married', 'Next Bridge as Software Developer Lahore Pakistan', 'Toba Tek Singh'),
(6, 'Mudassar', 'Habib', 'Mudassar@gmail.com', '1234', '2020-09-01', 'Male', 'offline', '', '', ''),
(7, 'Ayesha', 'Khan', 'Ayesha@gmail.com', '12', '1995-05-12', 'Female', 'offline', 'Single', 'Next Bride as software Developer ', 'Toba Tek singh'),
(8, 'Sarfaraz', 'Arshad', 'Fazey@gmail.com', '1234', '2020-09-09', 'Male', 'online', '', '', ''),
(15, 'Zahid', 'Saleem', 'Zahid@gmail.com', '1234', '1998-05-18', 'Male', 'offline', 'Single', '', ''),
(16, 'Hassan', 'Raza', 'hassanraza0140@gmail.com', '12345678', '1999-12-18', 'Male', 'offline', 'Married', 'Playing Games Everyday', 'New Noor Park'),
(17, 'Muhammad', 'Zunair', 'MuhammdZunair@gmail.com', 'asdf', '2020-09-18', 'Male', 'offline', '', '', ''),
(18, 'Nouman', 'Arshad', 'nouman@gmail.com', '12', '2020-10-11', 'Male', 'offline', '', '', ''),
(19, 'Mohsin', 'Ali', 'mohsinali@gmail.com', '1234', '2000-05-25', 'Male', 'offline', 'Single', '', ''),
(20, 'ehtisham', 'saleem', 'fazi@gmail.com', '12', '2020-12-30', 'Male', 'online', '', '', ''),
(21, 'shujat', 'HELLO', '2341231324', '12345678', '2021-02-23', 'Male', '', '', '', ''),
(22, 'shujat', 'saleem', 'shujat@gmail.com', '12345678', '2020-05-11', 'Male', 'offline', 'Single', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `pending_requests`
--
ALTER TABLE `pending_requests`
  ADD PRIMARY KEY (`friends_tb_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD PRIMARY KEY (`images_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_requests`
--
ALTER TABLE `pending_requests`
  MODIFY `friends_tb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `profile_images`
--
ALTER TABLE `profile_images`
  MODIFY `images_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
