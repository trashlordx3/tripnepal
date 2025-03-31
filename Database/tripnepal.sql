-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2025 at 03:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tripnepal`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity`, `description`) VALUES
('Trekking', 'Nepal is a trekker\'s paradise, home to the world’s highest peaks, including Mount Everest, and a vast network of trails that offer breathtaking landscapes, rich cultural experiences, and thrilling adventures. Whether you’re a seasoned mountaineer or a beginner seeking a scenic walk through the hills, Nepal has something for everyone.'),
('Tour', 'Nepal, a country of breathtaking landscapes and rich cultural heritage, is one of the best travel destinations in the world. Whether you\'re an adventure seeker, nature lover, or cultural explorer, Nepal offers an unforgettable experience. From the towering Himalayas to ancient temples, serene lakes, and vibrant cities, a tour in Nepal has something for everyone.'),
('Rafting', 'Nepal is a paradise for rafting enthusiasts, offering some of the best white-water experiences in the world. With its fast-flowing rivers originating from the Himalayas, Nepal provides thrilling rapids, stunning scenery, and a mix of adventure and relaxation. Whether you\'re a beginner or an experienced rafter, Nepal has rivers suited to all skill levels.\r\n'),
('Hiking', 'Hiking in Nepal is a perfect way to explore the country\'s natural beauty and cultural richness without the challenges of long and strenuous treks. With short trails leading through lush forests, traditional villages, and scenic hills, hiking in Nepal is ideal for those who want to experience the Himalayas at a relaxed pace.');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` varchar(50) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `distination` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`distination`, `description`) VALUES
('Kathmandu', 'Kathmandu, the capital city of Nepal, is a vibrant blend of ancient culture, rich history, and modern urban life. Nestled in a valley surrounded by the Himalayas, it is the largest city in the country and serves as its political, cultural, and economic hub. Kathmandu is home to several UNESCO World Heritage Sites, including the iconic Swayambhunath Stupa (Monkey Temple), the sacred Pashupatinath Temple, and the historic Kathmandu Durbar Square. These landmarks showcase the city\'s deep-rooted Hindu and Buddhist traditions, along with stunning Newar architecture.As the gateway to Nepal’s trekking destinations, Kathmandu is a hotspot for travelers. Thamel, a bustling tourist district, is filled with lively streets, shops, cafes, and trekking agencies. Visitors often start their Himalayan adventures here before heading to Everest Base Camp, Annapurna, or Langtang.Kathmandu offers a mix of traditional and modern lifestyles. Local markets like Ason and Indra Chowk are famous for their spices, textiles, and street food, while the city\'s restaurants serve everything from Newari cuisine (Yomari, Bara, Choila) to international dishes.'),
('Pokhara', 'Pokhara, often called the \'Tourist Capital of Nepal,\' is a breathtaking city known for its stunning natural beauty, adventure activities, and peaceful atmosphere. Located about 200 km west of Kathmandu, it is Nepal\'s second-largest city and a gateway to the Annapurna region. Pokhara is famous for its serene lakes, the most iconic being Phewa Lake, where visitors can enjoy boating with the beautiful reflection of Mt. Machhapuchhre (Fishtail) on the water. Other lakes like Begnas Lake and Rupa Lake offer a more peaceful escape into nature.Pokhara is the starting point for some of Nepal’s most famous trekking routes, including the Annapurna Circuit and Poon Hill Trek. It’s also a paradise for adventure lovers, offering paragliding, ultra-light flights, zip-lining, and bungee jumping with stunning Himalayan views.'),
('Chitwan', 'Chitwan, located in the Terai region of Nepal, is famous for its rich biodiversity, dense forests, and vibrant Tharu culture. It is home to Chitwan National Park, Nepal’s first national park and a UNESCO World Heritage Site, making it a top destination for wildlife lovers and nature enthusiasts.Chitwan National Park is one of the best places in Asia for wildlife safaris. It covers 932 sq. km of lush forests, grasslands, and rivers, providing a habitat for rare and endangered species such as:\r\nOne-horned rhinoceros 🦏 (one of the main attractions)\r\nRoyal Bengal tiger 🐅\r\nAsian elephant 🐘\r\nGharial crocodile 🐊\r\nOver 500 bird species 🦜\r\n'),
('Lumbini', 'Lumbini, located in the Rupandehi district of Nepal, is one of the most sacred pilgrimage sites in the world. It is the birthplace of Siddhartha Gautama (Lord Buddha) and a UNESCO World Heritage Site. This peaceful and spiritual destination attracts Buddhists and travelers from all over the world.At the center of Lumbini lies the Maya Devi Temple, marking the exact spot where Queen Maya Devi gave birth to Prince Siddhartha in 563 BCE. Inside the temple, visitors can see an ancient stone marker and the remains of old structures from Buddha’s time.Emperor Ashoka of India, a great follower of Buddhism, visited Lumbini in 249 BCE and erected the Ashoka Pillar with an inscription confirming it as Buddha’s birthplace. This historical pillar stands as evidence of Lumbini’s authenticity.'),
('Pokhara', 'Pokhara, often called the \'Tourist Capital of Nepal,\' is a breathtaking city known for its stunning natural beauty, adventure activities, and peaceful atmosphere. Located about 200 km west of Kathmandu, it is Nepal\'s second-largest city and a gateway to the Annapurna region. Pokhara is famous for its serene lakes, the most iconic being Phewa Lake, where visitors can enjoy boating with the beautiful reflection of Mt. Machhapuchhre (Fishtail) on the water. Other lakes like Begnas Lake and Rupa Lake offer a more peaceful escape into nature.Pokhara is the starting point for some of Nepal’s most famous trekking routes, including the Annapurna Circuit and Poon Hill Trek. It’s also a paradise for adventure lovers, offering paragliding, ultra-light flights, zip-lining, and bungee jumping with stunning Himalayan views.'),
('Chitwan', 'Chitwan, located in the Terai region of Nepal, is famous for its rich biodiversity, dense forests, and vibrant Tharu culture. It is home to Chitwan National Park, Nepal’s first national park and a UNESCO World Heritage Site, making it a top destination for wildlife lovers and nature enthusiasts.Chitwan National Park is one of the best places in Asia for wildlife safaris. It covers 932 sq. km of lush forests, grasslands, and rivers, providing a habitat for rare and endangered species such as:\r\nOne-horned rhinoceros 🦏 (one of the main attractions)\r\nRoyal Bengal tiger 🐅\r\nAsian elephant 🐘\r\nGharial crocodile 🐊\r\nOver 500 bird species 🦜\r\n'),
('Lumbini', 'Lumbini, located in the Rupandehi district of Nepal, is one of the most sacred pilgrimage sites in the world. It is the birthplace of Siddhartha Gautama (Lord Buddha) and a UNESCO World Heritage Site. This peaceful and spiritual destination attracts Buddhists and travelers from all over the world.At the center of Lumbini lies the Maya Devi Temple, marking the exact spot where Queen Maya Devi gave birth to Prince Siddhartha in 563 BCE. Inside the temple, visitors can see an ancient stone marker and the remains of old structures from Buddha’s time.Emperor Ashoka of India, a great follower of Buddhism, visited Lumbini in 249 BCE and erected the Ashoka Pillar with an inscription confirming it as Buddha’s birthplace. This historical pillar stands as evidence of Lumbini’s authenticity.'),
('Mustang', 'Mustang, often referred to as \'The Last Forbidden Kingdom,\' is one of Nepal\'s most mystical and scenic regions. Located in the northwestern Himalayas, Mustang is divided into Upper Mustang and Lower Mustang, each offering unique landscapes, rich culture, and historical significance.Mustang’s geography is unlike any other place in Nepal. The region is characterized by:\r\n\r\nArid desert-like terrain with deep gorges and rock formations.\r\n\r\nSnow-capped peaks of the Annapurna and Dhaulagiri ranges.\r\n\r\nKali Gandaki Gorge, the world’s deepest gorge.Mustang has a deep-rooted Tibetan Buddhist culture, reflected in its ancient monasteries, chortens, and caves. The region was once an independent Tibetan kingdom, and its influence is still evident today.'),
('Solukhumbu', 'Solukhumbu, located in eastern Nepal, is one of the most iconic regions of the country. It is home to Mount Everest (Sagarmatha), the world\'s highest peak, and is a major destination for trekkers, mountaineers, and adventure seekers. The district is part of the Sagarmatha National Park, a UNESCO World Heritage Site known for its stunning landscapes, glaciers, and unique Sherpa culture.Major Attractions in Solukhumbu\r\nMount Everest (8,848.86m) 🏔️ – The tallest mountain on Earth, attracting climbers from all over the world.\r\n\r\nEverest Base Camp (EBC) ⛺ – A bucket-list trekking destination that offers breathtaking views of Everest, Lhotse, and Nuptse.\r\n\r\nNamche Bazaar 🏡 – The vibrant trading hub and gateway to Everest, filled with cafes, lodges, and markets.\r\n\r\nTengboche Monastery 🛕 – The largest monastery in the Khumbu region, offering spiritual significance and stunning Himalayan views.\r\n\r\nGokyo Lakes 🌊 – A series of stunning turquoise glacial lakes, providing a peaceful and scenic alternative to the EBC trek.\r\n                                Solukhumbu is home to the Sherpa community, known for their mountaineering skills and hospitality. Visitors can experience:\r\n\r\nTraditional Sherpa villages like Khumjung and Phakding.\r\n\r\nMani walls, chortens, and prayer flags that reflect Tibetan Buddhist traditions.\r\n\r\nWarm hospitality in tea houses and lodges along trekking routes.\r\nTrekking & Adventure\r\nEverest Base Camp Trek 🥾 – A 12-14 day journey through breathtaking landscapes.\r\n\r\nThree Passes Trek ⛰️ – A challenging route crossing Kongma La, Cho La, and Renjo La.\r\n\r\nGokyo Ri Trek 🏞️ – A stunning trek to panoramic viewpoints of Everest and the Gokyo Lakes.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `tripid` int(11) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itinerary`
--

CREATE TABLE `itinerary` (
  `itinerary_id` int(11) NOT NULL,
  `tripid` int(11) NOT NULL,
  `day_number` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `tripid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `transportation` varchar(100) DEFAULT NULL,
  `accomodation` varchar(100) DEFAULT NULL,
  `maximumaltitude` varchar(20) DEFAULT NULL,
  `departurefrom` varchar(50) DEFAULT NULL,
  `bestseason` varchar(50) DEFAULT NULL,
  `triptype` varchar(50) DEFAULT NULL,
  `meals` varchar(100) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `fitnesslevel` varchar(30) DEFAULT NULL,
  `groupsize` int(11) DEFAULT NULL,
  `minimumage` int(11) DEFAULT NULL,
  `maximumage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `triptypes`
--

CREATE TABLE `triptypes` (
  `triptype` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `triptypes`
--

INSERT INTO `triptypes` (`triptype`, `description`) VALUES
('Cultural', 'Nepal is a land of rich cultural heritage, where ancient traditions, diverse ethnic groups, and spiritual beliefs coexist harmoniously. With influences from both Hinduism and Buddhism, Nepal\'s culture is deeply rooted in its festivals, arts, music, dance, architecture, and way of life. The country is home to more than 120 ethnic groups and over 100 languages, making it a unique cultural melting pot.'),
('Nature Friendly', 'Nepal, home to stunning mountains, lush forests, and diverse wildlife, is a paradise for eco-conscious travelers. Nature-friendly trips in Nepal focus on sustainable tourism, preserving the environment, supporting local communities, and minimizing the impact on nature. Whether trekking in the Himalayas, exploring national parks, or staying in eco-lodges, Nepal offers numerous eco-friendly travel experiences.'),
('Budget Friendly', 'Nepal is one of the most affordable travel destinations in the world, offering breathtaking landscapes, rich cultural experiences, and thrilling adventures at a low cost. Whether you are a backpacker or a budget-conscious traveler, Nepal provides plenty of opportunities to explore without breaking the bank. From trekking in the Himalayas to experiencing local culture in vibrant cities, budget-friendly trips in Nepal are both exciting and affordable.');

-- --------------------------------------------------------

--
-- Table structure for table `trip_overviews`
--

CREATE TABLE `trip_overviews` (
  `overviewid` int(11) NOT NULL,
  `tripid` int(11) NOT NULL,
  `overview` text NOT NULL,
  `highlight1` varchar(100) DEFAULT NULL,
  `highlight2` varchar(100) DEFAULT NULL,
  `highlight3` varchar(100) DEFAULT NULL,
  `highlight4` varchar(100) DEFAULT NULL,
  `highlight5` varchar(100) DEFAULT NULL,
  `highlight6` varchar(100) DEFAULT NULL,
  `highlight7` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` varchar(50) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip_postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilepic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `phone_number`, `address`, `zip_postal_code`, `country`, `first_name`, `last_name`, `user_name`, `email`, `password`, `profilepic`) VALUES
('user_67e7a0931e8e3', NULL, NULL, NULL, NULL, 'suresh', NULL, NULL, 'sureshjimba3333@gmail.com', '$2y$10$aWc7.vX4b2n1QLMJnyHjw.P/.sN3iL/Q7oogzK8Akq/T1xaqDVk2W', NULL),
('user_67e8986281369', NULL, NULL, NULL, NULL, 'hilson', NULL, NULL, 'hilson@gmail.com', '$2y$10$sEHFSPJCugsLqyQD8Acso.J3iBdwBFfoBeMlnMvBinxK8uUkO7ln6', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `tripid` (`tripid`);

--
-- Indexes for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD PRIMARY KEY (`itinerary_id`),
  ADD UNIQUE KEY `tripid` (`tripid`,`day_number`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`tripid`);

--
-- Indexes for table `trip_overviews`
--
ALTER TABLE `trip_overviews`
  ADD PRIMARY KEY (`overviewid`),
  ADD KEY `tripid` (`tripid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itinerary`
--
ALTER TABLE `itinerary`
  MODIFY `itinerary_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `tripid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip_overviews`
--
ALTER TABLE `trip_overviews`
  MODIFY `overviewid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`tripid`) REFERENCES `trips` (`tripid`) ON DELETE CASCADE;

--
-- Constraints for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD CONSTRAINT `itinerary_ibfk_1` FOREIGN KEY (`tripid`) REFERENCES `trips` (`tripid`) ON DELETE CASCADE;

--
-- Constraints for table `trip_overviews`
--
ALTER TABLE `trip_overviews`
  ADD CONSTRAINT `trip_overviews_ibfk_1` FOREIGN KEY (`tripid`) REFERENCES `trips` (`tripid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
