-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2018 at 07:03 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `site_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `post_date` datetime NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`post_id`, `first_name`, `last_name`, `subject`, `message`, `post_date`) VALUES
(1, 'rome', 'rome', 'aa', 'aa', '2018-04-21 14:45:31'),
(2, 'rome', 'rome', 'yhtgrdxgtr', 'thgrdgbtr', '2018-04-21 15:00:55'),
(3, 'rome', 'rome', 'dsagreav', 'rgdadafrggre', '2018-04-21 15:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `forum_likes`
--

CREATE TABLE IF NOT EXISTS `forum_likes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `item_img` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total`, `order_date`) VALUES
(1, 23, '6103.00', '2018-04-21 13:57:04'),
(2, 23, '9980.00', '2018-04-21 15:12:01'),
(3, 23, '7980.00', '2018-04-21 15:24:44'),
(4, 23, '2000.00', '2018-04-21 17:43:07'),
(5, 23, '644.00', '2018-04-21 17:46:21'),
(6, 23, '28.00', '2018-04-21 17:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_contents`
--

CREATE TABLE IF NOT EXISTS `order_contents` (
  `content_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT '1',
  `price` decimal(4,2) NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `order_contents`
--

INSERT INTO `order_contents` (`content_id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, '99.99'),
(2, 1, 2, 1, '99.99'),
(3, 1, 22, 1, '65.00'),
(4, 1, 28, 1, '28.00'),
(5, 1, 31, 1, '20.00'),
(6, 2, 1, 2, '99.99'),
(7, 2, 2, 1, '99.99'),
(8, 3, 1, 2, '99.99'),
(9, 4, 2, 1, '99.99'),
(10, 5, 28, 23, '28.00'),
(11, 6, 28, 1, '28.00');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL,
  `item_type` varchar(20) NOT NULL,
  `colour` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `item_desc` mediumtext NOT NULL,
  `item_img` varchar(100) NOT NULL,
  `item_price` int(7) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`item_id`, `item_name`, `item_type`, `colour`, `gender`, `item_desc`, `item_img`, `item_price`) VALUES
(1, 'PW HumanRace NMD "Nerd"', 'shoe', 'black', 'men', 'This N.E.R.D. iteration of the adidas NMD Hu features a Black-based upper highlighted with texts of “Y.O.U” on the right shoe and “N.E.R.D” on the left in Reflective Silver. It comes completed with a Black Boost midsole and matching rubber trail outsole.', 'images/AdidasPWHumanRaceNMDTRNerd2.png', 3990),
(2, 'PW HumanRace NMD "Pharrell"', 'shoe', 'yellow', 'men', 'Adidas and Pharrell come together once again to release the adidas HU NMD x Pharrell Williams "EQT Yellow." Part of the "Human Race" adidas NMD styles, the sneaker features a yellow and black upper with the words "HUMAN" and "RACE" emblazoned on the uppers which sit on a white and black Boost soles. Making this version of the Human Race a favorite among fans.', 'images/PWHumanRaceNMDpharrell2.png', 2000),
(3, 'PW HumanRace NMD "Pharrell"', 'shoe', 'beige', 'men', 'Introducing the Pharrell Williams x adidas NMD Hu Trail Pale Nude. Warning: this crep won’t be easy to cop! In fact, this is already being labelled as one of 2017s biggest sneaker releases, and it’s not even launched yet?! Sizes are expected to be limited and demand is through the roof. That’s not a good combination for those praying for a ‘win’. The ‘Pale Nude’ Pharrell HU NMD opts for understated vibes met with colourful tones. That laid-back upper – crafted from Primeknit – is complimented by a set of blue rope laces and hits of orange to the synthetic lace caging. The word ‘BREATHE’ is stamped across the tongue in black.', 'images/PWHumanRaceNMDpharrellBEIGE2.png', 460),
(4, 'PW HumanRace NMD "Pharrell"', 'shoe', 'blue', 'men', 'A purpose-built silhouette designed for boundless urban exploration, the NMD fuses the Adidas Originals DNA with ground-breaking BOOST technology. Pharrell Williams’ influence on this iconic silhouette is evident through the bold, colourful design with a graphic slogan embroidered to the PrimeKnit upper. The usual BOOST sole unit features prominently for sublime underfoot cushioning, while a newly designed cage stabiliser and lacing system has been crafted for this highly sought after sneaker.', 'images/PWHumanRaceNMDpharrellBLUE2.png', 850),
(5, 'PW HumanRace NMD "Friends and Fam"', 'shoe', 'red', 'men', 'Now Pharrell continues to roll out more NMDs with adidas, but this time it’s a limited friends and family version. Featuring the same lace closure as the previous “Human Made” drop, the burgundy execution is adorned with Japanese characters that signify “Friends” and “Family,” complete with Pharrell and adidas trefoil branding on each heel.', 'images/PWHumanRaceNMDpharrellFRIENDSANDFAMILY2.png', 8000),
(6, 'PW HumanRace NMD "Pharrell"', 'shoe', 'green', 'men', 'Collaborating with adidas Originals, genre-defying star Pharrell Williams celebrates the hues of humanity. His special edition of the NMD shoe has a two-piece upper with bold printed kanji graphics on top, a curved collar and combination lace system-stabiliser cage. With a reflexology-inspired insole.', 'images/PWHumanRaceNMDpharrellGREEN2.png', 680),
(7, 'PW HumanRace NMD "Pharrell"', 'shoe', 'mix', 'men', 'This unisex model features a newly designed lace system, which goes through the cage of the stabilizer to create a moccasin type of feel, giving support as well as freedom right where it is needed. The silhouette has become one of the most popular shoes of the year, and the ones Pharrell was spotted wearing featured ostentatious branding down the tongue area, further adding to its hype value.', 'images/PWHumanRaceNMDpharrellMIX2.png', 480),
(8, 'PW HumanRace NMD "Pharrell"', 'shoe', 'red', 'men', 'Keeping the same unique form as that yellow model, this pair blends contemporary style with ultra cool performance. Soft and flexible mesh takes on a vibrant shade of red, while the words ‘HUMAN’ and ‘RACE’ dominate in white across each silhouette. Black detailing compliments this look, and features to that re-engineered heel surround, as well as the EVA midsole plugs.', 'images/PWHumanRaceNMDpharrellRED2.png', 1150),
(9, 'PW HumanRace NMD "Pharrell"', 'shoe', 'blue', 'men', 'Collaborating with adidas Originals, genre-defying star Pharrell Williams celebrates the hues of humanity. His special edition of the NMD shoe has a two-piece upper with bold printed slogans on top, a curved collar and a combination lace system-stabiliser cage. The shoes feature a reflexology-inspired graphic insole.', 'images/PWHumanRaceNMDpharrellTURQ2.png', 425),
(10, 'PW HumanRace NMD "Billionaire"', 'shoe', 'grey', 'men', 'The forthcoming colorway hosts a trail-ready outsole unit while its traditional BOOST cushioning returns to provide the ultimate comfort. The upper serves as the main attraction thanks to its Pink and Light Blue coloring throughout its Primeknit weaving. The Cotton Candy-esque coloring is complemented by the model’s\r\ntraditional large wording found on the right and left shoe for its final pop.', 'images/PWHumanRaceNMDTRbillionaireboysclub2.png', 2230),
(11, 'PW HumanRace NMD "Friends and Fam"', 'shoe', 'purple', 'men', 'Once again, Pharrell Williams gifted a short list of family and friends like rapper Pusha T with an unreleased version of his adidas NMD “Human Race” model. This sneaker surfaced early 2017, making it the second “Friends & Family” release, after the maroon pair arrived the previous year. This version sports a vibrant colorway that’s complemented by full-length Boost cushioning on the midsole and black accents on the NMD bumpers and caging.', 'images/PWHumanRaceNMDtrfRIENDSANDFAMILY2.png', 12500),
(12, 'PW HumanRace NMD TR "Pharrell"', 'shoe', 'grey', 'men', 'The next chapter in the Pharrell x adidas Human Race story focuses on functionality much more than past releases. Here''s the NMD Hu Trail, featuring the familiar one-piece woven Primeknit upper atop of Boost cushioning and a rigid outsole constructed for outdoor wear. This "Core Black" colorway sports a textured look throughout the weaving, with the words "Moon" and "Clouds" appearing on the left and right foot, respectively.', 'images/PWHumanRaceNMDTRpharrell2.png', 675),
(18, 'Pharrell Williams Hu Holi Shorts', 'shorts', 'mix', 'men', 'Celebrate the hues of humanity with Pharrell Williams. With this new adidas Originals collection, Pharrell shows off looks inspired by the Hindu Holi festival, a celebration of peace, love and equality.\r\nMade of heavyweight cotton French terry, this men''s shorts have a robust feel and an allover powder-dye design that gives each piece a unique look. Pharrell''s multicoloured artwork on the back further reflects the festive theme.', 'images/PHARRELL_WILLIAMS_HU_HOLI_SHORTSPHARRELL_WILLIAMS_HU_HOLI_SHORTS.png', 63),
(19, 'Pharrell Williams Hu Holi Tee', 'tee', 'mix', 'men', 'Celebrate the hues of humanity with Pharrell Williams. With this new adidas Originals collection, Pharrell shows off looks inspired by the Hindu Holi festival, a celebration of peace, love and equality.\r\nMade of heavyweight cotton French terry, this men''s t-shirt provides the perfect canvas for Pharrell''s work. A special allover powder-dye design gives each piece a unique look while multicoloured artwork on the back ties to the collection''s festive theme.', 'images/PHARRELL_WILLIAMS_HU_HOLI_TEE.png', 110),
(20, 'Pharrell Williams Hu Holi Track Jacket', 'jacket', 'white', 'men', 'Celebrate the hues of humanity with artist, designer and musician Pharrell Williams. In this new adidas Originals collection, Pharrell is inspired by the Hindu Holi festival, a spring celebration of peace, love and equality.\r\nBased on an archive designs, this men''s track jacket transforms into a reimagined canvas for Pharrell. Multicoloured artwork gives new identity to a heritage sportswear style.', 'images/PHARRELL_WILLIAMS_HU_HOLI_TRACK_JACKET.png', 230),
(21, 'Pharrell Williams Hu Holi Windbreaker', 'windbreaker', 'mix', 'men', 'Celebrate the hues of humanity with Pharrell Williams. With this new adidas Originals collection, Pharrell shows off looks inspired by the Hindu Holi festival, a celebration of peace, love and equality.\r\nMade of heavyweight cotton French terry, this men''s windbreaker mixes authentic adidas heritage with Pharrell''s signature aesthetic. An allover powder-dye design gives each piece a unique look while special multicoloured artwork appears front and back.', 'images/PHARRELL_WILLIAMS_HU_HOLI_WINDBREAKER.png', 160),
(22, 'Pharrell Williams Tennis Hu Shoes', 'shoe', 'red', 'kids', 'Pharrell Williams'' work in music, film and fashion blurs boundaries to unite different elements. These juniors'' shoes rework a classic tennis silhouette. They have sock-like mesh upper and a grid pattern on the outsole. Embroidered 3-Stripes and Pharrell''s sign-off add creative flair.', 'images/PHARRELL_WILLIAMS_TENNIS_HU_SHOES_KID.png', 65),
(23, 'Pharrell Williams Tennis Hu Shoes', 'shoe', 'blue', 'kids', 'Pharrell Williams'' work in music, film and fashion blurs boundaries to unite different elements. These juniors'' shoes rework a classic tennis silhouette. They have sock-like mesh upper and a grid pattern on the outsole. Embroidered 3-Stripes and Pharrell''s sign-off add creative flair.', 'images/PHARRELL_WILLIAMS_TENNIS_HU_SHOES1_KID.png', 65),
(24, 'Pharrell Williams Tennis Hu Shoes2', 'shoe', 'white', 'kids', 'Pharrell Williams'' work in music, film and fashion blurs boundaries to unite different elements. These juniors'' shoes rework a classic tennis silhouette. They have a sock-like mesh upper and a grid pattern on the outsole. Embroidered 3-Stripes and Pharrell''s sign-off add creative flair.', 'images/PHARRELL_WILLIAMS_TENNIS_HU_SHOES2_KID.png', 65),
(25, 'Pharrell Williams Tennis Hu Shoes', 'shoe', 'grey', 'kids', 'The adidas Originals Hu Collection showcases Pharrell Williams'' creative flair for celebrating human diversity. These kids'' shoes reimagine a classic tennis silhouette with a modern sock-like knit upper. Embroidered 3-Stripes and Pharrell''s logo add distinctive details.', 'images/PHARRELL_WILLIAMS_TENNIS_HU_SHOES3_KID.png', 65),
(26, 'Pharrell Williams Tennis Hu Shoes', 'shoe', 'red', 'kids', 'Pharrell Williams'' work in music, film and fashion blurs boundaries to unite different elements. These juniors'' shoes rework a classic tennis silhouette. They have a mélange knit upper and a grid pattern on the outsole. Embroidered 3-Stripes and Pharrell''s sign-off add creative flair.', 'images/PHARRELL_WILLIAMS_TENNIS_HU_SHOES4_KID.png', 65),
(27, 'Pharrell Williams Tennis Hu Shoes6', 'shoe', 'black', 'kids', 'The adidas Originals Hu Collection showcases Pharrell Williams'' creative flair for celebrating human diversity. These kids'' shoes reimagine a classic tennis silhouette with a modern sock-like knit upper. Embroidered 3-Stripes and Pharrell''s logo add distinctive details.', 'images/PHARRELL_WILLIAMS_TENNIS_HU_SHOES6_KID.png', 65),
(28, 'New York Colorblock Tank Top', 'tanktop', 'mix', 'women', 'Celebrate the powerful ground strokes and scrappy spirit of Simona Halep in this women''s slim-fit tennis tank top. Designed with a polo collar and an open back, it features smooth allover graphics with multicolour stripes that offer a stylish look as you take control of the court. It''s made of mesh and includes climacool® ventilation to help manage moisture all match long.', 'images/NEW_YORK_COLORBLOCK_TANK_TOP.png', 28),
(29, 'New York Skirt', 'skirt', 'blue', 'women', 'Celebrate the powerful ground strokes and scrappy spirit of Simona Halep in this women''s pleated tennis skirt. It includes vivid multicoloured stripes at the hem. Built-in tights offer a splash of contrast colour. The skirt is made of breathable recycled mesh, while climalite® helps keep you stay comfortable and dry all match long.', 'images/NEW_YORK_SKIRT.png', 24),
(30, 'New York Striped Tank Top', 'tanktop', 'white', 'women', 'Pin your opponent to the baseline in this women''s tennis tank top. Cut for a slim fit, it features stripes in an allover print for a stylish look. Made of moisture-wicking fabric, it includes an opening in back for targeted ventilation as you power your serve for a winner.', 'images/NEW_YORK_STRIPED_TANK_TOP.png', 28),
(31, 'New York Tee', 'tee', 'mix', 'women', 'Pin your opponent to the baseline in this women''s tennis t-shirt. Cut for a slim fit, it features smooth graphics on the front, back and sleeves. The tee is made of moisture-wicking recycled mesh to help keep you dry as you dominate the match.', 'images/NEW_YORK_TEE.png', 20),
(32, 'Pharrell Williams Tennis Hu Shoes', 'shoe', 'white', 'women', 'Pharrell Williams'' work in music, film and fashion blurs boundaries to unite different elements. These women''s shoes rework a classic tennis silhouette. They have a modern knit upper and a grid pattern on the outsole. Embroidered 3-Stripes and Pharrell''s sign-off add creative flair.', 'images/PHARRELL_WILLIAMS_TENNIS_HU_SHOES2.png', 80),
(33, 'Pharrell Williams Tennis Hu Shoes', 'shoe', 'pink', 'women', 'A collaboration between adidas Originals and Pharrell Williams, these women''s sneakers were inspired by the beauty of humanity in all of its colours. A modern take on classic tennis style, the shoes f', 'images/PHARRELL_WILLIAMS_TENNIS_HU_SHOES3.png', 80);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` char(40) NOT NULL,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `birthday`, `phone`, `gender`, `email`, `pass`, `reg_date`) VALUES
(10, 'j', 'b', '1998-05-16', '01268757886', 'male', 'j@b.com', '5c2dd944dde9e08881bef0894fe7b22a5c9c4b06', '2018-04-17 13:20:50'),
(12, 'j', 'b', '1998-05-16', '012654654654', 'male', 'j@bigboy.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '2018-04-17 15:03:09'),
(13, 'f', 'f', '1221-02-12', '21', 'male', 'f', '4a0a19218e082a343a1b17e5333409af9d98f0f5', '2018-04-17 15:05:20'),
(14, 'a', 'a', '1111-12-04', '7467474', 'male', 'xdcd', '27d5482eebd075de44389774fce28c69f45c8a75', '2018-04-17 15:10:41'),
(15, 'a', 'a', '1111-12-04', '7467474', 'male', 'xdco', '516b9783fca517eecbd1d064da2d165310b19759', '2018-04-17 15:12:23'),
(16, 'a', 'a', '1111-12-04', '7467474', 'male', 'xdcf', '51e69892ab49df85c6230ccc57f8e1d1606caccc', '2018-04-17 15:13:32'),
(17, 'a', 'a', '1111-12-04', '7467474', 'male', 'xdcq', '54fd1711209fb1c0781092374132c66e79e2241b', '2018-04-17 15:14:28'),
(18, 'a', 'a', '1111-12-04', '7467474', 'male', 'xdcm', '51e69892ab49df85c6230ccc57f8e1d1606caccc', '2018-04-17 15:16:01'),
(19, 'yolo', 'yolo', '4244-02-24', '64535', 'male', 'gfrasdg', '7a81af3e591ac713f81ea1efe93dcf36157d8376', '2018-04-17 15:18:27'),
(20, 'yolo', 'yolo', '4244-02-24', '64535', 'male', 'gfrasdp', '516b9783fca517eecbd1d064da2d165310b19759', '2018-04-17 15:18:52'),
(21, 'yolo', 'yolo', '4244-02-24', '64535', 'male', 'gfrasdpjh', '13fbd79c3d390e5d6585a21e11ff5ec1970cff0c', '2018-04-17 15:20:04'),
(22, 'yolo', 'yolo', '4244-02-24', '64535', 'male', 'gfrasdpjli', '516b9783fca517eecbd1d064da2d165310b19759', '2018-04-17 15:20:59'),
(23, 'rome', 'rome', '2222-02-22', '1234', 'male', 'rome', '249f3bef9c6ea608de9311d5054d19da8c6c0367', '2018-04-18 21:16:58');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
