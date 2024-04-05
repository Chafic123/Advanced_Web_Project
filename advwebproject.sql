-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 10:22 PM
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
-- Database: `advwebproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountNum` int(11) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `Birthday` date NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Address` text NOT NULL,
  `City` varchar(20) NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountNum`, `Email`, `Phone`, `Birthday`, `FirstName`, `LastName`, `Password`, `Address`, `City`, `IsAdmin`) VALUES
(1, 'danadabdoub@gmail.com', '76058707', '2004-10-31', 'Dana', 'Dabdoub', 'password1', 'Random Street, Beirut', 'Beirut', 0),
(2, 'ChaficAchour@gmail.com', '81657588', '2004-04-10', 'Chafic', 'Achour', 'Chafic', 'Chehim', 'Beirut', 0),
(3, '', '', '0000-00-00', '', '', '', '', '', 0),
(4, 'admin@gmail.com', '', '0000-00-00', 'Admin', '', 'password', '', '', 1),
(5, 'mirnaelkhatib@gmail.com', '76732944', '2004-03-13', 'Mirna', 'El Khatib', 'mirna1', 'Saida', 'Saida', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ItemNum` int(11) NOT NULL,
  `AccountNum` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ItemNum`, `AccountNum`, `Quantity`) VALUES
(2, 1, 1),
(3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `Name`) VALUES
(1, 'Starters'),
(2, 'Platters'),
(3, 'Sandwiches'),
(4, 'Burgers'),
(5, 'Pasta'),
(6, 'Pizza'),
(7, 'Salads'),
(8, 'Kids Meals'),
(9, 'Desserts'),
(10, 'Hot Beverages'),
(11, 'Cold Beverages');

-- --------------------------------------------------------

--
-- Table structure for table `guestreviewer`
--

CREATE TABLE `guestreviewer` (
  `Email` varchar(320) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guestreviewer`
--

INSERT INTO `guestreviewer` (`Email`, `FirstName`, `LastName`) VALUES
('ellagreen038@gmail.com', 'Ella', 'Green'),
('no_one', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `includes`
--

CREATE TABLE `includes` (
  `ItemNum` int(11) NOT NULL,
  `OrderNum` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE `menuitem` (
  `ItemNum` int(11) NOT NULL,
  `Category` int(11) NOT NULL,
  `ItemName` varchar(30) NOT NULL,
  `Description` text NOT NULL,
  `Price` double NOT NULL,
  `Photo` varchar(520) NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`ItemNum`, `Category`, `ItemName`, `Description`, `Price`, `Photo`, `IsActive`) VALUES
(1, 1, 'French Fries', 'A bucket of golden fries with a side of ketchup.', 3, '../Food/fries.jpg', 1),
(2, 1, 'Curly Fries', 'A bucket of curly fries with a side of ketchup.', 4, '../Food/curly-fries.jpg', 1),
(3, 1, 'Mozzarella Sticks', '6 pcs. served with Thousand Island Sauce.', 6, '../Food/mozzarella-sticks.jpg', 1),
(4, 1, 'Halloumi Sticks', '6 pcs. served with salsa.', 6, '../Food/halloumi-fries.jpg', 1),
(5, 1, 'Onion Rings', '8 pcs. served with BBQ Sauce.', 5.5, '../Food/onion-rings.jpg', 1),
(6, 1, 'Nachos', 'Nachos served with Salsa & Sour Cream.', 7, '../Food/nachos.jpg', 1),
(7, 1, 'Spring Rolls', '4pcs served with soy sauce.', 5.6, '../Food/spring-rolls.jpg', 1),
(8, 1, 'Garlic Bread', '4 pcs of baked bread topped with cheese and garlic served with salsa.', 5.5, '../Food/garlic-bread.jpg', 1),
(9, 1, 'Hummus', 'A chickpea dip served with olive oil and arabic bread.', 4, '../Food/hummus.jpg', 1),
(10, 1, 'Warak Enab', '6 pcs of grape leaves stuffed with rice and meat.', 6, '../Food/warak-enab.jpg', 1),
(11, 1, 'Kibbeh', 'Made out of beef, these football-shaped croquettes are a flavorful blend of herbs and spices filling meat, and hearty bulgur wheat.', 10, '../Food/kibbeh.jpg', 1),
(12, 1, 'Crispy Shrimp', '8pcs of deep fried breaded shrimp with a side of thousand islands sauce.', 10, '../Food/crispy-shrimp.jpg', 1),
(13, 1, 'Crispy Chicken', '8pcs of deep fried breaded chicken strips with a side of honey mustard sauce.', 10, '../Food/crispy-chicken.jpg', 1),
(14, 2, 'Grilled Shrimps Platter', 'A flavorful feast of succulent grilled shrimp, vibrant vegetables, and white rice, all complemented by a zesty lemon-herb sauce.', 25, '../Food/grilled-shrimp.jpg', 1),
(15, 2, 'Grilled Chicken Platter', 'A symphony of grilled flavors, featuring juicy chicken, crispy vegetables, and white rice, all enveloped in a zesty lemon-herb sauce.', 20, '../Food/grilled-chicken.jpg', 1),
(16, 2, 'Grilled Beef Steak Platter', 'A tender grilled steak served with savory vegetables, and white rice, all drizzled with a rich and creamy béarnaise sauce.', 28, '../Food/grilled-beef.jpg', 1),
(17, 2, 'Grilled Shish Kafta Platter', 'Juicy grilled kafta skewers served with vibrant vegetables, arabic bread, and a dollop of creamy hummus and tangy tahini sauce.', 20, '../Food/kafta.jpg', 1),
(18, 2, 'Grilled Shish Tawouk Platter', 'Tender grilled chicken skewers marinated in aromatic spices, accompanied by grilled vegetables, arabic bread, and a garlic dip.', 20, '../Food/grilled-tawouk.jpg', 1),
(19, 2, 'Grilled Shish Beef Platter', 'Juicy and tender grilled beef skewers, accompanied by vibrant vegetables, arabic bread, and a savory marinade.', 20, '../Food/shish-beef.jpg', 1),
(20, 2, 'Mixed Grill Platter', 'An assortment of grilled meats accompanied by a medley of grilled vegetables, fries, and arabic bread.', 30, '../Food/mixed-grill.jpg', 1),
(21, 3, 'Grilled Chicken Sandwich', 'A savory combination of grilled chicken, crisp toppings, and a toasted bun.', 7.5, '../Food/grilled-chicken-san.jpg', 1),
(22, 3, 'American Sub', 'A classic sandwich piled high with deli meats, cheeses, and vegetables.', 10, '../Food/american-sub.jpg', 1),
(23, 3, 'Philly Cheese Steak Sandwich', 'A hearty blend of thinly sliced steak, melted cheese, and onions on a toasted hoagie roll.', 11.25, '../Food/philly-steak.jpg', 1),
(24, 3, 'Fries Sandwich', 'A unique twist on a classic, featuring crispy fries tucked between two slices of bread.', 3, '../Food/fries-san.jpg', 1),
(25, 3, 'Tawouk Sandwich', 'A Lebanese delight, featuring marinated and grilled chicken pieces wrapped in fresh pita bread.', 6, '../Food/tawouk-san.jpg', 1),
(26, 3, 'Spicy Chicken Sandwich', 'A bold and flavorful combination of spicy chicken, creamy sauce, and crunchy toppings.', 6.5, '../Food/spicy-chicken-san.jpg', 1),
(27, 3, 'Falafel Sandwich', 'A vegetarian staple, featuring deep-fried chickpea patties, fresh vegetables, and a tangy tahini sauce.', 5.2, '../Food/falafel-san.jpg', 1),
(28, 4, 'Grilled Chicken Burger', 'A juicy and healthy option, featuring a grilled chicken patty, fresh toppings, and a toasted bun.', 4, '../Food/grilled-chicken-bur.jpg', 1),
(29, 4, 'Mozzarella Chicken Burger', 'A cheesy and flavorful combination, featuring a grilled chicken patty, melted mozzarella cheese, and fresh toppings.', 5.5, '../Food/mozz-bur.jpg', 1),
(30, 4, 'Grilled Beef Burger', 'A classic burger experience, featuring a savory beef patty, melted cheese, and your choice of toppings.', 5, '../Food/grilled-beef-bur.jpg', 1),
(31, 4, 'Swiss Cheese Burger', 'A gourmet twist, featuring a juicy beef patty topped with melted Swiss cheese, pickles, and onions.', 6.4, '../Food/swiss-bur.jpg', 1),
(32, 5, 'Spaghetti Bolognaise', 'A rich and meaty sauce with spaghetti, a classic Italian comfort food.', 10, '../Food/spaghetti-bolo.jpg', 1),
(33, 5, 'Pasta Carbonara', 'A creamy and cheesy pasta dish with beef bacon, eggs, and Parmesan cheese.', 11.5, '../Food/carbonara.jpg', 1),
(34, 5, 'Fettucine Alfredo', 'A simple yet elegant pasta dish with fettuccine noodles tossed in a rich and creamy Alfredo sauce.', 15, '../Food/alfredo.jpg', 1),
(35, 5, 'Spinach Ravioli', 'Delicate pasta pockets filled with spinach and ricotta cheese, a delightful vegetarian option.', 14.3, '../Food/ravioli.jpg', 1),
(36, 6, 'Margarita Pizza', 'A classic combination of fresh mozzarella cheese, tomatoes, and basil on a thin crust.', 10, '../Food/margarita.jpg', 1),
(37, 6, 'Veggie Pizza', 'A colorful and nutritious option, featuring an assortment of fresh vegetables on a crispy crust.', 12, '../Food/veggie.jpg', 1),
(38, 6, 'Pepperoni Pizza', 'A crowd-pleaser with spicy pepperoni slices scattered over a savory tomato sauce.', 14.5, '../Food/pepperoni.jpg', 1),
(39, 7, 'Caesar Salad', 'A salad containing grilled chicken slices, lettuce, parmsean cheese, and crotons mixed in with our signiture Caesar sauce.', 7.5, '../Food/caesar.jpg', 1),
(40, 7, 'Fatoush', 'A refreshing Lebanese salad with toasted pita bread, mixed greens, tomatoes, cucumbers, and a lemony dressing.', 8.4, '../Food/fatoush.jpg', 1),
(41, 7, 'Tabouleh', 'A light and flavorful Middle Eastern salad with bulgur wheat, parsley, mint, tomatoes, and a lemon-olive oil dressing.', 9, '../Food/tabouleh.jpg', 1),
(42, 8, 'Mini Chicken Burger Meal', 'A kid-sized version of the classic burger, served with fries and orange juice.', 5, '../Food/mini-c-bur.jpg', 1),
(43, 8, 'Mini Beef Burger Meal', 'A satisfying option for little ones, featuring a mini beef patty, fries, and orange juice.', 6, '../Food/mini-b-bur.jpg', 1),
(44, 8, 'Dino Nuggets Meal', 'A fun and playful meal for kids, featuring bite-sized chicken nuggets, fries, and orange juice.', 5, '../Food/dino-nuggets.jpg', 1),
(45, 9, 'Blueberry Cheesecake', 'A rich and creamy dessert with a buttery graham cracker crust, a layer of tangy blueberry filling, and a dollop of whipped cream.', 6, '../Food/blueberry.jpg', 1),
(46, 9, 'Strawberry Cheesecake', 'A classic dessert featuring a buttery graham cracker crust, a layer of creamy cheesecake, and fresh strawberries.', 6, '../Food/strawberry.jpg', 1),
(47, 9, 'Chocolate Cake', 'A decadent dessert with a rich chocolate cake layer, a smooth chocolate frosting, and chocolate shavings.', 4.5, '../Food/chocolate.jpg', 1),
(48, 9, 'Cinnamon Roll', 'A soft and gooey pastry with a swirl of cinnamon and sugar, topped with a creamy vanilla icing.', 2, '../Food/cinnamon.jpg', 1),
(49, 10, 'Green Tea', 'A delicate and slightly sweet tea with a vegetal aroma, known for its calming properties.', 1, '../Food/green.jpg', 1),
(50, 10, 'Chamomile Tea', 'A soothing and caffeine-free tea with a floral aroma, often used to promote relaxation.', 1, '../Food/chamo.jpg', 1),
(51, 10, 'Jasmine Tea', 'A fragrant and aromatic tea with a floral and slightly sweet flavor.', 1, '../Food/jasmine.jpg', 1),
(52, 10, 'Expresso', 'A strong and concentrated coffee drink made by forcing hot water through finely-ground coffee beans.', 2, '../Food/express.jpg', 1),
(53, 10, 'Cappuccino', 'A coffee drink made with espresso, steamed milk, and foamed milk, often dusted with cocoa powder.', 3, '../Food/cappu.jpg', 1),
(54, 10, 'Latte', 'A coffee drink made with espresso, steamed milk, and foamed milk, often dusted with cocoa powder.', 2.75, '../Food/latte.jpg', 1),
(55, 11, 'Iced Tea Peach', 'A refreshing and fruity drink made with brewed tea, peach juice, and ice.', 2.5, '../Food/it-peach.jpg', 1),
(56, 11, 'Iced Tea Lemon', 'A classic and refreshing drink made with brewed tea, lemon juice, and ice.', 2.5, '../Food/it-lemon.jpg', 1),
(57, 11, 'Lemonade', 'A refreshing drink made with lemon juice, sugar, and water.', 3, '../Food/lemon.jpg', 1),
(58, 11, 'Minted Lemonade', 'A twist on classic lemonade, infused with fresh mint leaves for a refreshing and invigorating flavor.', 3.5, '../Food/mint-lemon.jpg', 1),
(59, 11, 'Orange Juice', 'A naturally sweet and citrusy drink made by juicing oranges.', 2.3, '../Food/orange.jpg', 1),
(60, 11, 'Pepsi', 'A carbonated cola-flavored soft drink with a caffeine content.', 1.25, '../Food/pepsi.jpg', 1),
(61, 11, '7up', 'A carbonated lemon-lime flavored soft drink with a caffeine content.', 1.25, '../Food/7up.jpg', 1),
(62, 11, 'Miranda', 'A carbonated fruit-flavored soft drink with a caffeine content.', 1.25, '../Food/miranda.jpg', 1),
(63, 11, 'Coca Cola', 'A classic carbonated cola-flavored soft drink with a caffeine content.', 1.25, '../Food/Coca Cola.png', 1),
(64, 11, 'Red Bull', 'An energy drink', 1.5, '../Food/Red Bull.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderNum` int(11) NOT NULL,
  `AccountNum` int(11) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `TotalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `ReviewNum` int(11) NOT NULL,
  `ReviewDate` date NOT NULL,
  `GuestEmail` varchar(320) NOT NULL,
  `AccountNum` int(11) NOT NULL,
  `ServiceType` tinyint(1) NOT NULL,
  `Field1` double NOT NULL,
  `Field2` double NOT NULL,
  `Field3` double NOT NULL,
  `Field4` double NOT NULL,
  `Field5` double NOT NULL,
  `Location` varchar(20) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewNum`, `ReviewDate`, `GuestEmail`, `AccountNum`, `ServiceType`, `Field1`, `Field2`, `Field3`, `Field4`, `Field5`, `Location`, `Message`) VALUES
(2, '2024-02-20', 'ellagreen038@gmail.com', 3, 0, 2, 5, 4, 5, 5, '', 'The delivery time could be faster.'),
(3, '2024-02-20', 'ellagreen038@gmail.com', 3, 1, 4, 4, 5, 5, 0, 'Beirut', 'Loved it though the service could be better.'),
(4, '2024-02-20', 'ellagreen038@gmail.com', 3, 1, 4, 5, 5, 5, 0, 'Tripoli', 'Nothing'),
(5, '2024-02-20', 'no_one', 1, 1, 5, 5, 5, 5, 0, 'Beirut', 'I loved it! no improvements'),
(6, '2024-02-20', 'no_one', 1, 0, 4, 4, 5, 4, 5, '', ''),
(7, '2024-02-20', 'no_one', 2, 0, 5, 3, 5, 4, 5, '', ''),
(9, '2024-02-24', 'ellagreen038@gmail.com', 3, 0, 3, 5, 4, 5, 4, '', 'Loved the food!'),
(10, '2024-02-24', 'ellagreen038@gmail.com', 3, 0, 5, 4, 4, 4, 4, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountNum`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ItemNum`,`AccountNum`),
  ADD KEY `AccountNum` (`AccountNum`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `guestreviewer`
--
ALTER TABLE `guestreviewer`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `includes`
--
ALTER TABLE `includes`
  ADD PRIMARY KEY (`ItemNum`,`OrderNum`),
  ADD KEY `OrderNum` (`OrderNum`);

--
-- Indexes for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD PRIMARY KEY (`ItemNum`),
  ADD KEY `Category` (`Category`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderNum`),
  ADD KEY `AccountNum` (`AccountNum`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewNum`) USING BTREE,
  ADD KEY `AccountNum` (`AccountNum`),
  ADD KEY `GuestEmail` (`GuestEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `AccountNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `menuitem`
--
ALTER TABLE `menuitem`
  MODIFY `ItemNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `ReviewNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`AccountNum`) REFERENCES `account` (`AccountNum`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ItemNum`) REFERENCES `menuitem` (`ItemNum`);

--
-- Constraints for table `includes`
--
ALTER TABLE `includes`
  ADD CONSTRAINT `includes_ibfk_1` FOREIGN KEY (`ItemNum`) REFERENCES `menuitem` (`ItemNum`),
  ADD CONSTRAINT `includes_ibfk_2` FOREIGN KEY (`OrderNum`) REFERENCES `orders` (`OrderNum`);

--
-- Constraints for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD CONSTRAINT `menuitem_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`AccountNum`) REFERENCES `account` (`AccountNum`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`AccountNum`) REFERENCES `account` (`AccountNum`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`GuestEmail`) REFERENCES `guestreviewer` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
