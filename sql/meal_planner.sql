-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 18. Aug 2026 um 19:46
-- Server-Version: 8.0.44
-- PHP-Version: 8.3.30
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Datenbank: `meal_planner`
--
CREATE DATABASE IF NOT EXISTS `meal_planner` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

USE `meal_planner`;

-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `dietary_type`
--
CREATE TABLE `dietary_type` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `restriction_level` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `dietary_type`
--
INSERT INTO
  `dietary_type` (`id`, `name`, `restriction_level`)
VALUES
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `doctrine_migration_versions`
--
INSERT INTO
  `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`)
VALUES
  (
    'DoctrineMigrations\\Version20260818184208',
    '2026-08-18 18:42:16',
    98
  ),
  (
    'DoctrineMigrations\\Version20260818184637',
    '2026-08-18 18:46:43',
    12
  ),
  (
    'DoctrineMigrations\\Version20260818190333',
    '2026-08-18 19:03:37',
    19
  );

-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `ingredient`
--
CREATE TABLE `ingredient` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `ingredient`
--
INSERT INTO
  `ingredient` (`id`, `name`)
VALUES
  (36, 'Almonds'),
  (34, 'Apple'),
  (5, 'Baking Powder'),
  (2, 'Banana'),
  (12, 'Basmati Rice'),
  (43, 'Bay Leaf'),
  (37, 'Beef'),
  (38, 'Beetroot'),
  (44, 'Black Pepper'),
  (31, 'Brown Sugar'),
  (29, 'Butter'),
  (42, 'Canola Oil'),
  (39, 'Carrot'),
  (14, 'Chili'),
  (20, 'Cilantro'),
  (32, 'Cinnamon'),
  (4, 'Cocoa Powder'),
  (24, 'Crispy Fried Onions'),
  (22, 'Cucumber'),
  (26, 'Egg'),
  (3, 'Flour'),
  (15, 'Garlic'),
  (35, 'Lemon'),
  (45, 'Lemon Juice'),
  (18, 'Lime'),
  (21, 'Mint'),
  (8, 'Neutral Oil'),
  (28, 'Onion'),
  (19, 'Parsley'),
  (23, 'Peanuts'),
  (9, 'Plant-Based Milk'),
  (27, 'Potato'),
  (13, 'Red Thai Curry Paste'),
  (30, 'Rolled Oats'),
  (25, 'Rye Flour'),
  (6, 'Salt'),
  (46, 'Sour Cream'),
  (7, 'Sugar'),
  (16, 'Tamari'),
  (41, 'Tomato'),
  (10, 'Vanilla Extract'),
  (33, 'Vegan Butter'),
  (11, 'Vegan Chocolate Chips'),
  (17, 'Water'),
  (40, 'White Cabbage'),
  (47, 'Whole Grain Bread'),
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `planned_meal`
--
CREATE TABLE `planned_meal` (
  `id` int NOT NULL,
  `scheduled_for` date NOT NULL,
  `meal_time` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `recipe_id` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

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
  `creator_id` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `recipe`
--
INSERT INTO
  `recipe` (
    `id`,
    `title`,
    `cooking_time_minutes`,
    `short_description`,
    `instructions`,
    `source`,
    `servings`,
    `image`,
    `created_at`,
    `updated_at`,
    `dietary_type_id`,
    `creator_id`
  )
VALUES
  (
    1,
    'Vegan Zucchini Brownies',
    45,
    'Moist and fudgy vegan chocolate brownies made with zucchini and banana.',
    'Preheat the oven to 175°C. Grease and line a baking pan with parchment paper. Finely grate the zucchini without peeling or squeezing it and mash the banana. In a large bowl, combine flour, cocoa powder, baking powder, salt and sugar. Add the neutral oil, plant-based milk, vanilla extract, mashed banana and grated zucchini. Mix only until combined. Spread the batter evenly in the prepared pan and sprinkle with vegan chocolate chips if using. Bake for about 35 minutes. Let the brownies cool in the pan for about 15 minutes, then remove them and allow them to cool completely before cutting.',
    'https://biancazapatka.com/en/vegan-zucchini-brownies/',
    15,
    NULL,
    '2026-08-18 21:15:53',
    NULL,
    1,
    1
  ),
  (
    2,
    'Crispy Rice Salad',
    40,
    'A fresh vegan salad with crispy curry rice, herbs, cucumber, peanuts and a sweet and spicy lime dressing.',
    'Preheat the oven to 220°C and line a baking tray with parchment paper. Combine the cooked rice with red Thai curry paste, oil and a little salt, then spread it evenly over the tray. Bake for about 30 minutes until golden and crispy, turning the rice halfway through. For the dressing, remove the seeds from the chili and finely chop it. Press or finely chop the garlic and combine both with tamari, sugar, water and freshly squeezed lime juice. Dice the cucumber and roughly chop the parsley, cilantro, mint and peanuts. Let the crispy rice cool slightly, then combine it with the cucumber, herbs, peanuts, crispy fried onions and dressing. Serve immediately, with additional lime wedges if desired.',
    'https://biancazapatka.com/en/crispy-rice-salad/',
    4,
    NULL,
    '2026-08-18 21:15:53',
    NULL,
    1,
    2
  ),
  (
    3,
    'East Tyrolean Schlipfkrapfen',
    65,
    'Traditional Austrian filled dumplings with a potato, onion, garlic and herb filling.',
    'Combine the wheat flour and rye flour with a little salt, the eggs and enough water to form a smooth pasta dough. Cover the dough and let it rest for about 2 hours. Meanwhile, cook the potatoes until soft, allow them to cool slightly and press or mash them. Finely chop the onion and garlic and sauté them in a generous amount of butter until translucent. Add them to the potatoes. Finely chop the parsley and mix it into the filling. Roll the rested dough out thinly on a floured surface and cut out round pieces. Place some filling in the center of each round, fold the dough over and press the edges firmly together with a fork. Cook the filled dumplings in boiling salted water for about 2–3 minutes, then drain. Serve with melted butter.',
    'https://www.chefkoch.de/rezepte/3133271466707231/Osttiroler-Schlipfkrapfen.html',
    4,
    NULL,
    '2026-08-18 21:15:53',
    NULL,
    2,
    1
  ),
  (
    4,
    'Vegan Apple Crumble',
    45,
    'Warm baked apples topped with a crisp cinnamon, oat and vegan butter crumble.',
    'Preheat the oven to 200°C. For the crumble topping, combine flour, rolled oats, salt, brown sugar and cinnamon in a bowl. Cut the vegan butter into small cubes, add it to the dry ingredients and work everything together until coarse crumbs form. Wash and core the apples, cut them into cubes and toss them with freshly squeezed lemon juice. Transfer the apples to a baking dish. Spread the crumble mixture evenly over the apples and add slivered almonds and a little extra brown sugar if desired. Bake for about 30 minutes until the topping is golden brown. Allow the crumble to cool briefly before serving.',
    'https://biancazapatka.com/en/vegan-apple-crumble/',
    6,
    NULL,
    '2026-08-18 21:15:53',
    NULL,
    1,
    2
  ),
  (
    5,
    'Borscht',
    110,
    'A hearty Eastern European beetroot and beef soup with potatoes, cabbage and root vegetables.',
    'Bring the water to a boil in a large pot, reduce the heat and add the beef in one piece. Cover and simmer for about 1 hour, removing any foam that collects on the surface. Meanwhile, finely dice the onion and chop the garlic. Peel the beetroot, potatoes and carrots and cut them into roughly 1–2 cm pieces. Wash the cabbage, remove any tough core and slice it into thin strips. Cut the tomatoes into pieces. Remove the cooked beef from the broth and cut it into bite-sized pieces. Heat the canola oil in a second large pot and sauté the onion, garlic and tomatoes. Add the beetroot, potatoes, carrots and cabbage and briefly sauté them as well. Sprinkle the flour over the vegetables, stir well and pour in the beef broth. Add the beef, bay leaf, salt and pepper and simmer for about 45 minutes, until the vegetables are tender. Finely chop the parsley. Remove the bay leaf, season the soup with additional salt, pepper and lemon juice to taste, and serve topped with sour cream and parsley, with whole grain bread on the side.',
    'https://www.einfachkochen.de/rezepte/borschtsch-soo-wuerzig-lecker',
    1,
    NULL,
    '2026-08-18 21:15:53',
    NULL,
    3,
    1
  );

-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `recipe_ingredient`
--
CREATE TABLE `recipe_ingredient` (
  `id` int NOT NULL,
  `quantity` decimal(10, 2) DEFAULT NULL,
  `unit` varchar(20) NOT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `recipe_id` int NOT NULL,
  `ingredient_id` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `recipe_ingredient`
--
INSERT INTO
  `recipe_ingredient` (
    `id`,
    `quantity`,
    `unit`,
    `specification`,
    `recipe_id`,
    `ingredient_id`
  )
VALUES
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
  (17, 2.00, 'cloves', NULL, 2, 15),
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
  (30, 2.00, 'pieces', NULL, 3, 26),
  (31, NULL, 'as needed', NULL, 3, 17),
  (32, 500.00, 'g', 'floury', 3, 27),
  (33, 1.00, 'bunch', NULL, 3, 19),
  (34, 2.00, 'cloves', NULL, 3, 15),
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
  (46, 1.20, 'l', NULL, 5, 17),
  (47, 300.00, 'g', 'boneless soup beef', 5, 37),
  (48, 1.00, 'piece', NULL, 5, 28),
  (49, 2.00, 'cloves', NULL, 5, 15),
  (50, 300.00, 'g', 'fresh', 5, 38),
  (51, 300.00, 'g', 'floury or mainly waxy', 5, 27),
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
  (63, 4.00, 'slices', 'whole grain', 5, 47);

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `user`
--
INSERT INTO
  `user` (
    `id`,
    `email`,
    `roles`,
    `password`,
    `first_name`,
    `last_name`,
    `is_blocked`,
    `dietary_type_id`
  )
VALUES
  (
    1,
    'aaa@a.at',
    '[\"ROLE_ADMIN\"]',
    '$2y$13$ptYMAboDmel.hZwEfhwng.p6Q14PzDbCmdh88OrHsgaljo2LuWEHm',
    'Aaa',
    'Aaa',
    0,
    3
  ),
  (
    2,
    'bbb@b.at',
    '[\"ROLE_USER\"]',
    '$2y$13$ptYMAboDmel.hZwEfhwng.p6Q14PzDbCmdh88OrHsgaljo2LuWEHm',
    'Aaa',
    'Aaa',
    0,
    1
  );

--
-- Indizes der exportierten Tabellen
--
--
-- Indizes für die Tabelle `dietary_type`
--
ALTER TABLE
  `dietary_type`
ADD
  PRIMARY KEY (`id`),
ADD
  UNIQUE KEY `UNIQ_BDDB89495E237E06` (`name`),
ADD
  UNIQUE KEY `UNIQ_BDDB89494C80AE2` (`restriction_level`);

--
-- Indizes für die Tabelle `doctrine_migration_versions`
--
ALTER TABLE
  `doctrine_migration_versions`
ADD
  PRIMARY KEY (`version`);

--
-- Indizes für die Tabelle `ingredient`
--
ALTER TABLE
  `ingredient`
ADD
  PRIMARY KEY (`id`),
ADD
  UNIQUE KEY `UNIQ_6BAF78705E237E06` (`name`);

--
-- Indizes für die Tabelle `messenger_messages`
--
ALTER TABLE
  `messenger_messages`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`, `available_at`, `delivered_at`, `id`);

--
-- Indizes für die Tabelle `planned_meal`
--
ALTER TABLE
  `planned_meal`
ADD
  PRIMARY KEY (`id`),
ADD
  UNIQUE KEY `unique_planned_meal` (
    `user_id`,
    `recipe_id`,
    `scheduled_for`,
    `meal_time`
  ),
ADD
  KEY `IDX_25AEE301A76ED395` (`user_id`),
ADD
  KEY `IDX_25AEE30159D8A214` (`recipe_id`);

--
-- Indizes für die Tabelle `recipe`
--
ALTER TABLE
  `recipe`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `IDX_DA88B137E24A5B9C` (`dietary_type_id`),
ADD
  KEY `IDX_DA88B13761220EA6` (`creator_id`);

--
-- Indizes für die Tabelle `recipe_ingredient`
--
ALTER TABLE
  `recipe_ingredient`
ADD
  PRIMARY KEY (`id`),
ADD
  UNIQUE KEY `unique_recipe_ingredient` (`recipe_id`, `ingredient_id`),
ADD
  KEY `IDX_22D1FE1359D8A214` (`recipe_id`),
ADD
  KEY `IDX_22D1FE13933FE08C` (`ingredient_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE
  `user`
ADD
  PRIMARY KEY (`id`),
ADD
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
ADD
  KEY `IDX_8D93D649E24A5B9C` (`dietary_type_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--
--
-- AUTO_INCREMENT für Tabelle `dietary_type`
--
ALTER TABLE
  `dietary_type`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT für Tabelle `ingredient`
--
ALTER TABLE
  `ingredient`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 48;

--
-- AUTO_INCREMENT für Tabelle `messenger_messages`
--
ALTER TABLE
  `messenger_messages`
MODIFY
  `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `planned_meal`
--
ALTER TABLE
  `planned_meal`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `recipe`
--
ALTER TABLE
  `recipe`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT für Tabelle `recipe_ingredient`
--
ALTER TABLE
  `recipe_ingredient`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 64;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE
  `user`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;

--
-- Constraints der exportierten Tabellen
--
--
-- Constraints der Tabelle `planned_meal`
--
ALTER TABLE
  `planned_meal`
ADD
  CONSTRAINT `FK_25AEE30159D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
ADD
  CONSTRAINT `FK_25AEE301A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `recipe`
--
ALTER TABLE
  `recipe`
ADD
  CONSTRAINT `FK_DA88B13761220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`),
ADD
  CONSTRAINT `FK_DA88B137E24A5B9C` FOREIGN KEY (`dietary_type_id`) REFERENCES `dietary_type` (`id`);

--
-- Constraints der Tabelle `recipe_ingredient`
--
ALTER TABLE
  `recipe_ingredient`
ADD
  CONSTRAINT `FK_22D1FE1359D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
ADD
  CONSTRAINT `FK_22D1FE13933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`);

--
-- Constraints der Tabelle `user`
--
ALTER TABLE
  `user`
ADD
  CONSTRAINT `FK_8D93D649E24A5B9C` FOREIGN KEY (`dietary_type_id`) REFERENCES `dietary_type` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;