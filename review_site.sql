-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 07:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `review_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_comment` varchar(100) NOT NULL,
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `review_id`, `user_id`, `content_comment`, `created`) VALUES
(5, 3, 1, 'sdjfalksdjf', '2022-04-19 14:38:12'),
(6, 3, 7, 'Hello \r\n', '2022-04-19 14:53:11'),
(7, 3, 7, 'Hello \r\n', '2022-04-19 14:53:28'),
(8, 3, 7, 'Hello \r\n', '2022-04-19 14:58:24'),
(9, 3, 7, 'Hello world \r\n', '2022-04-19 15:15:06'),
(10, 3, 7, 'Hello world \r\n', '2022-04-19 15:15:41'),
(11, 3, 7, 'Hello world \r\n', '2022-04-19 15:16:18'),
(12, 2, 7, 'Hello world ', '2022-04-19 15:19:45'),
(13, 2, 7, 'Google\r\n', '2022-04-19 15:21:16'),
(14, 2, 7, 'Google\r\n', '2022-04-19 15:21:20'),
(15, 1, 7, 'ooobobobo', '2022-04-19 15:22:15'),
(16, 1, 7, 'hajdsfhla', '2022-04-19 15:22:18'),
(17, 1, 11, 'I love making \r\n', '2022-04-19 15:46:11'),
(18, 2, 8, 'haha\r\n', '2022-04-19 15:47:30'),
(19, 2, 8, 'ahdsfjkla', '2022-04-19 15:47:48'),
(20, 3, 11, 'hello', '2022-04-19 15:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_image` varchar(100) NOT NULL,
  `review_description` longtext NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `review_name` varchar(255) NOT NULL,
  `review_foreword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `user_id`, `review_image`, `review_description`, `created`, `review_name`, `review_foreword`) VALUES
(1, 8, 'complaint.zip', 'I love my life.', '2022-04-17 22:24:07', 'The road not taken', ''),
(2, 7, '74241434_915401918846261_4519465266626691072_n.jpg', 'asd', '2022-04-17 23:24:45', 'The road not taken', ''),
(3, 7, 'frankestine.jpeg', 'Frankenstein is a novel written in 1818 by Mary Shelley. Also called The modern prometheus, it is known to be one of the most recognized works of literature.\r\nThe subtitle “The modern prometheus” is taken from Greek mythology, where ‘Prometheus’ is a titan. The myth states that Prometheus stole fire from the gods and gave it to mankind. As a result, this act helped mankind develop tremendously. However, because Prometheus committed a crime, Zeus had to punish him. In order to punish Prometheus , Zeus chained him to a rock and was left there to be eaten by vultures for eternity. \r\nThis can be taken as a cautionary tale, where if people overstep to a degree, consequences would follow. But, the romantics perceived this tale as a tribute to Prometheus, who went out of his way to help mankind with no concern about his own well being. If we are to dive into the myth itself, mankind would not have been able to develop without fire. The romantics argued that Prometheus was a figure that helped shape mankind into what it is today. \r\n\r\nThe book is almost 200 years old but is still relevant in literature to this day. This is the real power of the novel on display. There are not many works of literature that can stand the test of time so effortlessly as Frankenstein did. I like to think this is partially because of the marvellous themes and concepts discussed in the novel. Take this into consideration. The novel was written in 1818 where life expectancy was about 30-40 years. Let’s take the example of the condition of healthcare and biology at that time. And more interesting, Marry Shelly was able to think about these sophisticated concepts like biological cloning and bringing the dead back to life. Mary Shelly was way ahead of time in this aspect. She could think about something so sparse, let alone, accumulate that into a work of art. We are talking about an era where we didn’t even have the technology to help people live longer than 30- 40 years. The idea of  bringing something back to life was something never talked about, but, somehow Mary shelly was able to blend this notion with her writing when no one else was. This alone makes the novel an interesting read. Mary Shelly was merely 18 when she composed this masterpiece. All of these factors make the already amazing novel even more intriguing to read.  \r\n\r\nOne of the most fascinating things about the novel is considered to be the presence of constant contradiction. This can be seen in the case of Frankestine and the monster he creates. The novel never tells us which is the protagonist or who is the antagonist. That decision is on the reader. That concept, in my opinion, is the core factor that drives the novel further and further. We can naturally go on the side of Victor Frankestine because the novel, somehow, wants us to believe that. But, in contradiction, Mary shelly provides many instances in the novel where the “Monster” is looked at as something that is thrown away just because of its outer appearance and never given a single chance. The monster is left in the wild by his creator, who was the one to provide everything to him. We get to see the humane part of the monster and feel pity in his struggles. But, that emotion is left for only a moment when the monster drives itself into insanity and murders everyone that Victor loves. Again, you can defend the monster by arguing that if Victor took care and was responsible for his actions, the “problem” would have never even materialized.\r\n\r\nThe Novel engages with the reader in this way. The reader is never outright given information  about what actually happens in the novel and it leaves the reader to find their own interpretations of the text. The text never gives us a full explanation of who the protagonist is. This raises questions for the reader, for instance, why did Frankenstein leave his creation alone, when he should’ve clearly taken care of it? Why does the Monster behave so reckless after not understanding the full extent of human interactions and tendencies? And many more questions that add up to the lore behind the actual story. The text keeps this aspect ambiguous at all times so it keeps the reader guessing and speculating the possible answers to the question. It doesn\'t drop every minute piece of the puzzle nor does it spoon feed the reader with the desperate answers. The reader is left to think,  contemplate and find their own answers to the questions in their mind. \r\nThis, in my opinion, is a powerful element used to its full extent in Mary Shelly’s Frankenstein. Upon reading and closer inspection, this idea starts becoming more and more clear to the reader. \r\n\r\nThe language used in Frankenstein is really advanced. In some cases, Mary Shelly has written paragraphs using a single sentence. The book being written 200 years prior adds up to the situation here. There are numerous words that have, in my opinion, ceased to exist in one context or the other. By that I mean, there is no one that uses those words regularly in their vocabulary. The “era” of that language is over. The language is complex, and I like to think that it is because the language is pre-historic and we don’t have anything like that anymore. The language written today will be drastically different from language written two centuries ago. That is the beauty of language, it is always dynamic and many aspects of language change with time. Basically, the language used for 2 centuries is not relevant to the language we utilize and work inside today. \r\n\r\nI had already read this book, and this time I read it again. I realized all the nuances and the minute details that add up to the bigger picture of the novel. I could not fully understand the ideas and concepts discussed in this novel the first time I read the novel. The first time I read the novel, I never read it critically, but I only focused upon the storyline of the novel. I liked the novel because I always liked novels which are related to science fiction. However, I like the book solely because its storyline was different from any other novel I read.  \r\n\r\n\r\nAn interesting thing about re reading novels is that it is like walking a road you already know and walked. You already have prior knowledge about where the road will lead you. You’ve already  walked  the road, you have already come across the slippery slopes, the smooth edges and the abrupt u-turns. A unique feeling is that there is no “thinking twice” for you. You don’t have to think twice to step foot on the sketchiest of the routes. But what you start noticing is how beautiful the road is and how green and shiny that dense forest is. You already know where you’ll end up, but what’s unusual is that you have these different ideas that strike upon your mind, every time you read. These ideas may depend upon your environment, something that you witnessed, experienced or had to go through. The ideas and themes I discover reading the book once might be adversely different from the ideas I procure reading the novel at a different time. I might have personal experiences that I can relate to the text at the moment and many more things like this.', '2022-04-18 23:41:20', 'Frankestine', 'hello, this is a review written about this book. I have done good and hope that you will help me in this.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `registeredAt` datetime NOT NULL DEFAULT current_timestamp(),
  `image` longtext NOT NULL,
  `profile` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `registeredAt`, `image`, `profile`) VALUES
(1, 'Sashwat', 'Paudel', 'sas4az', NULL, '$2y$10$Sxc.wwSLe17gsoK8SB9XsOEDy', '2022-04-16 22:02:03', '76661254_570837770352537_6859749592817205248_n.jpg', NULL),
(2, 'Sashwat', 'Paudel', 'Sashwat', 'sashwatpaudel@google.com', '$2y$10$3zGuZNhaU3cle7sUJpRXCuTJI', '2022-04-16 23:14:00', '76661254_570837770352537_6859749592817205248_n.jpg', NULL),
(3, 'prashad', 'goog', 'goog', 'goog@gmail.com', '$2y$10$ro2chlJa0WBP4YJ0vyBFZuM6n', '2022-04-16 23:27:00', 'popped.jpg', NULL),
(4, 'hello', 'world', 'helloworld', 'helloworld@gmail.com', '$2y$10$GBd9W0DlSHDFS1HtLaTEW.o0L7tzLk1pLWROAKsj3LKq8EOZVyAVy', '2022-04-16 23:39:00', '', NULL),
(5, 'Sashwat', 'Paudel', 'sas3az', 'sashwatpaudel@hotmail.com', '$2y$10$CT27EpStRhLIdCz0XDubWut8GIRaxlB2gH8CFM7jWup2MKCq.Ch3S', '2022-04-17 16:27:23', '10.jpg', NULL),
(7, 'Sashwat', 'Paudel', 'Sashwat', 'paudelsashwat16@gmail.com', '', '2022-04-17 18:34:42', 'https://lh3.googleusercontent.com/a-/AOh14Gi9nvIjEx8k-nN_fG_PCcpiDfPapAQzudXvT_Audw=s96-c', NULL),
(8, 'Sashwat', 'Paudel', 'Sashwat', 'sashwat.paudel@sifal.deerwalk.edu.np', '', '2022-04-17 18:56:12', 'https://lh3.googleusercontent.com/a-/AOh14GiRK-9lM_Co7_zbvndkp7mQ0Xx8X1fZvnyXdr_y=s96-c', NULL),
(9, 'sas', 'wat', 'Hello', 'sashwatpaudel@outlook.com', '$2y$10$FX0kkKwZv.ZqiE0Q5GGGD.zUhGQKuH.TE2IHHtgvGYeZTzO5svYM2', '2022-04-17 20:15:24', 'baloon.jpg', NULL),
(10, 'asdjf', 'djdj', 'yeboii', 'yeboiii@gmail.com', '$2y$10$ySYCz2E9pWquF7MwB3mBM.p44iQvEejhysIuzi2rKOWDmDCikBPWi', '2022-04-17 21:41:53', 'will_down.jpg', NULL),
(11, 'Ashraya', 'Pidit', 'HandsomeBOi_Ashraya', 'ashraya@gmail.com', '$2y$10$3NyQJfxEIit1loidognOBePVXmzVpSNvGa/3qqXR4lNPvN/8GRugK', '2022-04-19 15:44:54', 'car.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_review_id` (`review_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_review_id` FOREIGN KEY (`review_id`) REFERENCES `review` (`review_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
