-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 25. Aug 2026 um 19:56
-- Server-Version: 8.0.44
-- PHP-Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `meal_planner`
--
CREATE DATABASE IF NOT EXISTS `meal_planner` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `meal_planner`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dietary_type`
--

CREATE TABLE `dietary_type` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `restriction_level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `dietary_type`
--

INSERT INTO `dietary_type` (`id`, `name`, `restriction_level`) VALUES
(1, 'Vegan', 1),
(2, 'Vegetarian', 2),
(3, 'Omnivore', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260818184208', '2026-08-18 18:42:16', 98),
('DoctrineMigrations\\Version20260818184637', '2026-08-18 18:46:43', 12),
('DoctrineMigrations\\Version20260818190333', '2026-08-18 19:03:37', 19),
('DoctrineMigrations\\Version20260820135223', '2026-08-20 13:52:30', 30),
('DoctrineMigrations\\Version20260821120000', '2026-08-24 09:15:50', 74);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`) VALUES
(36, 'Almonds'),
(34, 'Apple'),
(68, 'Avocado'),
(5, 'Baking Powder'),
(93, 'Baking Soda'),
(2, 'Banana'),
(83, 'Basil'),
(12, 'Basmati Rice'),
(43, 'Bay Leaf'),
(37, 'Beef'),
(38, 'Beetroot'),
(63, 'Bell Pepper'),
(44, 'Black Pepper'),
(72, 'Bread'),
(64, 'Broccoli'),
(31, 'Brown Sugar'),
(29, 'Butter'),
(42, 'Canola Oil'),
(39, 'Carrot'),
(55, 'Cheese'),
(60, 'Cherry Tomato'),
(79, 'Chicken Breast'),
(75, 'Chickpeas'),
(14, 'Chili'),
(20, 'Cilantro'),
(32, 'Cinnamon'),
(4, 'Cocoa Powder'),
(78, 'Coconut Milk'),
(54, 'Cream'),
(24, 'Crispy Fried Onions'),
(22, 'Cucumber'),
(89, 'Cumin'),
(88, 'Curry Powder'),
(26, 'Egg'),
(50, 'Egg White'),
(3, 'Flour'),
(15, 'Garlic'),
(80, 'Ground Beef'),
(90, 'Honey'),
(77, 'Kidney Beans'),
(118, 'Lasagna Sheets'),
(35, 'Lemon'),
(45, 'Lemon Juice'),
(76, 'Lentils'),
(67, 'Lettuce'),
(18, 'Lime'),
(53, 'Milk'),
(21, 'Mint'),
(120, 'Mozzarella'),
(66, 'Mushroom'),
(8, 'Neutral Oil'),
(74, 'Oats'),
(51, 'Olive Oil'),
(28, 'Onion'),
(84, 'Oregano'),
(87, 'Paprika'),
(56, 'Parmesan'),
(19, 'Parsley'),
(71, 'Pasta'),
(23, 'Peanuts'),
(9, 'Plant-Based Milk'),
(27, 'Potato'),
(58, 'Red Onion'),
(13, 'Red Thai Curry Paste'),
(70, 'Rice'),
(119, 'Ricotta'),
(30, 'Rolled Oats'),
(86, 'Rosemary'),
(25, 'Rye Flour'),
(81, 'Salmon'),
(6, 'Salt'),
(46, 'Sour Cream'),
(91, 'Soy Sauce'),
(65, 'Spinach'),
(59, 'Spring Onion'),
(69, 'Strawberry'),
(7, 'Sugar'),
(62, 'Sweet Potato'),
(16, 'Tamari'),
(85, 'Thyme'),
(41, 'Tomato'),
(61, 'Tomato Paste'),
(73, 'Tortilla'),
(82, 'Tuna'),
(10, 'Vanilla Extract'),
(33, 'Vegan Butter'),
(11, 'Vegan Chocolate Chips'),
(52, 'Vegetable Oil'),
(92, 'Vinegar'),
(17, 'Water'),
(40, 'White Cabbage'),
(47, 'Whole Grain Bread'),
(57, 'Yogurt'),
(1, 'Zucchini');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `planned_meal`
--

CREATE TABLE `planned_meal` (
  `id` int NOT NULL,
  `scheduled_for` date NOT NULL,
  `meal_time` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `recipe_id` int NOT NULL,
  `servings` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `planned_meal`
--

INSERT INTO `planned_meal` (`id`, `scheduled_for`, `meal_time`, `user_id`, `recipe_id`, `servings`) VALUES
(21, '2026-08-18', 'lunch', 1, 4, 12),
(22, '2026-08-20', 'dinner', 1, 2, 5),
(23, '2026-08-13', 'lunch', 1, 1, 15),
(25, '2026-08-26', 'lunch', 6, 4, 6),
(26, '2026-08-25', 'dinner', 1, 3, 50),
(27, '2026-08-27', 'dinner', 1, 4, 6),
(29, '2026-08-27', 'snack', 7, 4, 2),
(30, '2026-08-25', 'snack', 7, 1, 2),
(31, '2026-08-28', 'snack', 7, 4, 2),
(32, '2026-08-26', 'snack', 7, 1, 2),
(34, '2026-08-30', 'snack', 7, 10, 2),
(36, '2026-08-30', 'lunch', 7, 3, 4),
(37, '2026-08-25', 'lunch', 7, 2, 2),
(38, '2026-08-24', 'dinner', 7, 2, 2),
(39, '2026-08-25', 'dinner', 7, 11, 2),
(40, '2026-08-26', 'lunch', 7, 11, 2),
(41, '2026-08-24', 'lunch', 7, 3, 2),
(42, '2026-08-27', 'dinner', 7, 5, 2),
(43, '2026-08-24', 'breakfast', 7, 12, 2),
(44, '2026-08-25', 'breakfast', 7, 12, 2),
(45, '2026-08-26', 'breakfast', 7, 12, 2),
(46, '2026-08-27', 'breakfast', 7, 12, 2),
(47, '2026-08-28', 'breakfast', 7, 12, 2),
(48, '2026-08-29', 'breakfast', 7, 12, 2),
(49, '2026-08-30', 'breakfast', 7, 12, 2),
(50, '2026-08-27', 'lunch', 7, 13, 2),
(51, '2026-08-26', 'dinner', 7, 13, 2),
(52, '2026-08-28', 'lunch', 7, 5, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipe`
--

CREATE TABLE `recipe` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `cooking_time_minutes` int NOT NULL,
  `short_description` longtext,
  `instructions` longtext NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `servings` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `dietary_type_id` int NOT NULL,
  `creator_id` int NOT NULL,
  `calories_per_serving` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `cooking_time_minutes`, `short_description`, `instructions`, `source`, `servings`, `image`, `created_at`, `updated_at`, `dietary_type_id`, `creator_id`, `calories_per_serving`) VALUES
(1, 'Vegan Zucchini Brownies', 45, 'Moist and fudgy vegan chocolate brownies made with zucchini and banana.', 'Preheat the oven to 175°C. Grease and line a baking pan with parchment paper. Finely grate the zucchini without peeling or squeezing it and mash the banana. In a large bowl, combine flour, cocoa powder, baking powder, salt and sugar. Add the neutral oil, plant-based milk, vanilla extract, mashed banana and grated zucchini. Mix only until combined. Spread the batter evenly in the prepared pan and sprinkle with vegan chocolate chips if using. Bake for about 35 minutes. Let the brownies cool in the pan for about 15 minutes, then remove them and allow them to cool completely before cutting.', 'https://biancazapatka.com/en/vegan-zucchini-brownies/', 15, 'brownies-sm-6a86b1fa3fda1.jpg', '2026-08-18 21:15:53', '2026-08-20 07:51:22', 1, 1, NULL),
(2, 'Crispy Rice Salad', 40, 'A fresh vegan salad with crispy curry rice, herbs, cucumber, peanuts and a sweet and spicy lime dressing.', 'Preheat the oven to 220°C and line a baking tray with parchment paper. Combine the cooked rice with red Thai curry paste, oil and a little salt, then spread it evenly over the tray. Bake for about 30 minutes until golden and crispy, turning the rice halfway through. For the dressing, remove the seeds from the chili and finely chop it. Press or finely chop the garlic and combine both with tamari, sugar, water and freshly squeezed lime juice. Dice the cucumber and roughly chop the parsley, cilantro, mint and peanuts. Let the crispy rice cool slightly, then combine it with the cucumber, herbs, peanuts, crispy fried onions and dressing. Serve immediately, with additional lime wedges if desired.', 'https://biancazapatka.com/en/crispy-rice-salad/', 4, 'rice-sm-6a86b20b6851a.jpg', '2026-08-18 21:15:53', '2026-08-20 11:18:51', 1, 2, NULL),
(3, 'East Tyrolean Schlipfkrapfen', 65, 'Traditional Austrian filled dumplings with a potato, onion, garlic and herb filling.', 'Combine the wheat flour and rye flour with a little salt, the eggs and enough water to form a smooth pasta dough. Cover the dough and let it rest for about 2 hours. Meanwhile, cook the potatoes until soft, allow them to cool slightly and press or mash them. Finely chop the onion and garlic and sauté them in a generous amount of butter until translucent. Add them to the potatoes. Finely chop the parsley and mix it into the filling. Roll the rested dough out thinly on a floured surface and cut out round pieces. Place some filling in the center of each round, fold the dough over and press the edges firmly together with a fork. Cook the filled dumplings in boiling salted water for about 2–3 minutes, then drain. Serve with melted butter.', 'https://www.chefkoch.de/rezepte/3133271466707231/Osttiroler-Schlipfkrapfen.html', 4, 'schlipf-sm-6a86b21807e50.jpg', '2026-08-18 21:15:53', '2026-08-20 07:51:52', 2, 1, NULL),
(4, 'Vegan Apple Crumble', 45, 'Warm baked apples topped with a crisp cinnamon, oat and vegan butter crumble.', 'Preheat the oven to 200°C. For the crumble topping, combine flour, rolled oats, salt, brown sugar and cinnamon in a bowl. Cut the vegan butter into small cubes, add it to the dry ingredients and work everything together until coarse crumbs form. Wash and core the apples, cut them into cubes and toss them with freshly squeezed lemon juice. Transfer the apples to a baking dish. Spread the crumble mixture evenly over the apples and add slivered almonds and a little extra brown sugar if desired. Bake for about 30 minutes until the topping is golden brown. Allow the crumble to cool briefly before serving.', 'https://biancazapatka.com/en/vegan-apple-crumble/', 6, 'crumble-sm-6a86b239c70e0.jpg', '2026-08-18 21:15:53', '2026-08-25 18:20:40', 1, 2, 264),
(5, 'Borscht', 110, 'A hearty Eastern European beetroot and beef soup with potatoes, cabbage and root vegetables.', 'Bring the water to a boil in a large pot, reduce the heat and add the beef in one piece. Cover and simmer for about 1 hour, removing any foam that collects on the surface. Meanwhile, finely dice the onion and chop the garlic. Peel the beetroot, potatoes and carrots and cut them into roughly 1–2 cm pieces. Wash the cabbage, remove any tough core and slice it into thin strips. Cut the tomatoes into pieces. Remove the cooked beef from the broth and cut it into bite-sized pieces. Heat the canola oil in a second large pot and sauté the onion, garlic and tomatoes. Add the beetroot, potatoes, carrots and cabbage and briefly sauté them as well. Sprinkle the flour over the vegetables, stir well and pour in the beef broth. Add the beef, bay leaf, salt and pepper and simmer for about 45 minutes, until the vegetables are tender. Finely chop the parsley. Remove the bay leaf, season the soup with additional salt, pepper and lemon juice to taste, and serve topped with sour cream and parsley, with whole grain bread on the side.', 'https://www.einfachkochen.de/rezepte/borschtsch-soo-wuerzig-lecker', 1, 'borscht-sm-6a86b24b566ec.jpg', '2026-08-18 21:15:53', '2026-08-25 19:09:38', 3, 1, NULL),
(10, 'Meringue', 90, 'Light and crisp meringues with a delicate, sweet center.', 'Preheat the oven to 100°C. Beat the egg whites until soft peaks form. Gradually add the sugar while continuing to beat until the mixture is glossy and stiff. Mix in the lemon juice. Spoon small portions onto a lined baking tray and bake for about 90 minutes. Allow the meringues to cool completely before serving.', NULL, 6, 'meringue-7c888cc8376ad25e.jpg', '2026-08-25 18:33:35', '2026-08-25 18:38:35', 2, 7, 120),
(11, 'Chickpea Curry', 30, 'A simple and flavorful chickpea curry with tomatoes and coconut milk.', 'Sauté the onion and garlic until soft. Add the curry powder and cook briefly. Stir in the chickpeas, tomatoes and coconut milk. Simmer for about 20 minutes until the sauce has thickened. Serve warm.', NULL, 4, 'curry-31c8025fc9d48e76.jpg', '2026-08-25 18:43:41', '2026-08-25 18:46:34', 1, 7, NULL),
(12, 'Berry Yogurt Muesli', 5, 'A quick and fresh breakfast with oats, yogurt, fruit and honey.', 'Divide the oats and yogurt between two bowls. Slice the banana and strawberries and add them on top. Drizzle with honey and serve immediately.', NULL, 2, 'berry-sm-6671922693331d6e.jpg', '2026-08-25 18:57:29', NULL, 2, 7, 350),
(13, 'Tomato Mozzarella Pasta', 25, 'A simple vegetarian pasta with fresh tomatoes, mozzarella and basil.', 'Cook the pasta according to the package instructions. Chop the tomatoes and cook them briefly in olive oil. Add the drained pasta and mix well. Stir in the mozzarella and basil, then serve immediately.', NULL, 4, 'mozz-88ce13859863c1a4.jpg', '2026-08-25 19:03:28', NULL, 2, 7, 520);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipe_ingredient`
--

CREATE TABLE `recipe_ingredient` (
  `id` int NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit` varchar(20) NOT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `recipe_id` int NOT NULL,
  `ingredient_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `recipe_ingredient`
--

INSERT INTO `recipe_ingredient` (`id`, `quantity`, `unit`, `specification`, `recipe_id`, `ingredient_id`) VALUES
(1, 300.00, 'g', NULL, 1, 1),
(2, 1.00, 'piece', NULL, 1, 2),
(3, 180.00, 'g', 'all-purpose', 1, 3),
(4, 60.00, 'g', 'unsweetened', 1, 4),
(5, 1.50, 'tsp', NULL, 1, 5),
(6, 0.50, 'tsp', NULL, 1, 6),
(7, 150.00, 'g', NULL, 1, 7),
(8, 75.00, 'g', 'canola or sunflower', 1, 8),
(9, 80.00, 'ml', NULL, 1, 9),
(10, 1.00, 'tsp', NULL, 1, 10),
(11, 90.00, 'g', NULL, 1, 11),
(12, 500.00, 'g', NULL, 2, 12),
(13, 2.00, 'tbsp', NULL, 2, 13),
(14, 3.00, 'tsp', NULL, 2, 8),
(15, NULL, 'to taste', NULL, 2, 6),
(16, 1.00, 'piece', NULL, 2, 14),
(17, 2.00, 'clove', NULL, 2, 15),
(18, 2.00, 'tbsp', NULL, 2, 16),
(19, 2.00, 'tbsp', NULL, 2, 7),
(20, 60.00, 'ml', NULL, 2, 17),
(21, 0.50, 'piece', NULL, 2, 18),
(22, 0.50, 'bunch', NULL, 2, 19),
(23, 0.50, 'bunch', NULL, 2, 20),
(24, 0.50, 'bunch', NULL, 2, 21),
(25, 1.00, 'piece', NULL, 2, 22),
(26, 60.00, 'g', 'roasted and salted', 2, 23),
(27, 60.00, 'g', NULL, 2, 24),
(28, 250.00, 'g', 'wheat', 3, 3),
(29, 250.00, 'g', NULL, 3, 25),
(30, 2.00, 'piece', NULL, 3, 26),
(31, NULL, 'as needed', NULL, 3, 17),
(32, 500.00, 'g', 'floury', 3, 27),
(33, 1.00, 'bunch', NULL, 3, 19),
(34, 2.00, 'clove', NULL, 3, 15),
(35, 1.00, 'piece', 'small', 3, 28),
(36, NULL, 'as needed', NULL, 3, 29),
(37, 100.00, 'g', 'all-purpose', 4, 3),
(38, 50.00, 'g', 'quick-cooking', 4, 30),
(39, NULL, 'pinch', NULL, 4, 6),
(40, 50.00, 'g', NULL, 4, 31),
(41, 1.00, 'tsp', NULL, 4, 32),
(42, 100.00, 'g', NULL, 4, 33),
(43, 500.00, 'g', NULL, 4, 34),
(44, 0.50, 'piece', NULL, 4, 35),
(45, 40.00, 'g', 'slivered', 4, 36),
(46, 1200.00, 'ml', NULL, 5, 17),
(47, 300.00, 'g', 'boneless soup beef', 5, 37),
(48, 1.00, 'piece', NULL, 5, 28),
(49, 2.00, 'clove', NULL, 5, 15),
(50, 300.00, 'g', 'fresh', 5, 38),
(51, 300.00, 'g', 'floury', 5, 27),
(52, 150.00, 'g', NULL, 5, 39),
(53, 200.00, 'g', NULL, 5, 40),
(54, 150.00, 'g', NULL, 5, 41),
(55, 1.00, 'tbsp', NULL, 5, 42),
(56, 1.00, 'tbsp', NULL, 5, 3),
(57, 1.00, 'piece', NULL, 5, 43),
(58, 0.50, 'tsp', NULL, 5, 6),
(59, 0.50, 'tsp', NULL, 5, 44),
(60, 1.00, 'tbsp', NULL, 5, 45),
(61, 1.00, 'bunch', NULL, 5, 19),
(62, 100.00, 'g', NULL, 5, 46),
(63, 4.00, 'slice', NULL, 5, 47),
(77, 3.00, 'piece', NULL, 10, 50),
(78, 150.00, 'g', NULL, 10, 7),
(79, 1.00, 'tsp', NULL, 10, 45),
(80, NULL, 'pinch', NULL, 10, 6),
(81, 400.00, 'g', NULL, 11, 75),
(82, 400.00, 'ml', NULL, 11, 78),
(83, 400.00, 'g', NULL, 11, 41),
(84, 1.00, 'piece', NULL, 11, 28),
(85, 2.00, 'piece', NULL, 11, 15),
(86, 1.00, 'tbsp', NULL, 11, 88),
(87, 100.00, 'g', NULL, 12, 74),
(88, 250.00, 'g', NULL, 12, 57),
(89, 1.00, 'piece', NULL, 12, 2),
(90, 100.00, 'g', NULL, 12, 69),
(91, 1.00, 'tbsp', NULL, 12, 90),
(92, 400.00, 'g', NULL, 13, 71),
(93, 400.00, 'g', NULL, 13, 41),
(94, 200.00, 'g', NULL, 13, 120),
(95, 2.00, 'tbsp', NULL, 13, 51),
(96, 1.00, 'tsp', NULL, 13, 83);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `is_blocked` tinyint NOT NULL,
  `dietary_type_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `is_blocked`, `dietary_type_id`) VALUES
(1, 'aaa@a.at', '[\"ROLE_ADMIN\"]', '$2y$13$ptYMAboDmel.hZwEfhwng.p6Q14PzDbCmdh88OrHsgaljo2LuWEHm', 'Aaa', 'Aaa', 0, 2),
(2, 'bbb@b.at', '[\"ROLE_USER\"]', '$2y$13$ptYMAboDmel.hZwEfhwng.p6Q14PzDbCmdh88OrHsgaljo2LuWEHm', 'Bbb', 'Bbb', 1, 1),
(3, 'ccc@c.at', '[\"ROLE_ADMIN\"]', '$2y$13$cCHLq29JvJsoLrFEg3sn2OCTF2mmbOdaRbmaVW9K0/V5UExJqPYoe', 'Ccc', 'Ccc', 0, 3),
(4, 'ddd@d.at', '[]', '$2y$13$Ewkm5e2Z2LHAKj5cGIJo6ON0i0QvS1Nrdz2sg1.x294mgb9CDDWme', 'Dd', 'Ddd', 1, NULL),
(5, 'fff@f.at', '[\"ROLE_ADMIN\"]', '$2y$13$1ZDhqQWErBRbLI0M4wKLBO6LjLpUl0fwzVwaR7Q8ls6NhxNMNESCO', 'Fff', 'Fff', 0, 2),
(6, 'xxx@x.at', '[]', '$2y$13$LTkLA0D27c4JXQSs/WFQq.YUPfS7RHPL4Yr9QgbmSr4nN9C2mMWRq', 'Xxx', 'Xxx', 0, 2),
(7, 'user@user.at', '[]', '$2y$13$z5EJ3aDYgbCE7urwBDjPUeGsaqXfKLDjRBOqqbVM13ezMr4fikg3m', 'User', 'Example', 0, 2),
(8, 'admin@admin.at', '[\"ROLE_ADMIN\"]', '$2y$13$whQhWRGkjf6ooJV7TuhoCeSJYtvguWUGA43Hm1xUM7XyImdwoO4t.', 'Admin', 'Example', 0, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `dietary_type`
--
ALTER TABLE `dietary_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BDDB89495E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_BDDB89494C80AE2` (`restriction_level`);

--
-- Indizes für die Tabelle `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indizes für die Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6BAF78705E237E06` (`name`);

--
-- Indizes für die Tabelle `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`);

--
-- Indizes für die Tabelle `planned_meal`
--
ALTER TABLE `planned_meal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_planned_meal` (`user_id`,`recipe_id`,`scheduled_for`,`meal_time`),
  ADD KEY `IDX_25AEE301A76ED395` (`user_id`),
  ADD KEY `IDX_25AEE30159D8A214` (`recipe_id`);

--
-- Indizes für die Tabelle `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DA88B137E24A5B9C` (`dietary_type_id`),
  ADD KEY `IDX_DA88B13761220EA6` (`creator_id`);

--
-- Indizes für die Tabelle `recipe_ingredient`
--
ALTER TABLE `recipe_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_recipe_ingredient` (`recipe_id`,`ingredient_id`),
  ADD KEY `IDX_22D1FE1359D8A214` (`recipe_id`),
  ADD KEY `IDX_22D1FE13933FE08C` (`ingredient_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  ADD KEY `IDX_8D93D649E24A5B9C` (`dietary_type_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `dietary_type`
--
ALTER TABLE `dietary_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT für Tabelle `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `planned_meal`
--
ALTER TABLE `planned_meal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT für Tabelle `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `recipe_ingredient`
--
ALTER TABLE `recipe_ingredient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `planned_meal`
--
ALTER TABLE `planned_meal`
  ADD CONSTRAINT `FK_25AEE30159D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
  ADD CONSTRAINT `FK_25AEE301A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `FK_DA88B13761220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_DA88B137E24A5B9C` FOREIGN KEY (`dietary_type_id`) REFERENCES `dietary_type` (`id`);

--
-- Constraints der Tabelle `recipe_ingredient`
--
ALTER TABLE `recipe_ingredient`
  ADD CONSTRAINT `FK_22D1FE1359D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
  ADD CONSTRAINT `FK_22D1FE13933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`);

--
-- Constraints der Tabelle `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649E24A5B9C` FOREIGN KEY (`dietary_type_id`) REFERENCES `dietary_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
