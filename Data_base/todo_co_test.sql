-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 05 avr. 2023 à 18:21
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todo_co_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '(DC2Type:datetime_immutable)',
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `is_done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `user_id`, `created_at`, `title`, `content`, `is_done`) VALUES
(2, 59, '2023-03-29 08:29:28', 'Etablir le budget', 'C\'est à vous de savoir ce que le budget \r\n                                mis en œuvre peut vous rapporter par la suite. \r\n                                Le retour sur investissement, très important, est donc à prendre en compte.', 0),
(6, 61, '2023-03-06 12:03:05', 'Organisation des promotions', 'Il reste juste à promouvoir votre jeu-concours en l\'annonçant le plus possible. Le succès d\'une opération marketing de ce type dépend beaucoup de sa visibilité.', 0),
(7, 61, '2023-03-06 13:01:08', 'Designer les gagnants', 'Désignez les gagnants et annoncez-les aux participants. Faites alors le bilan. Celui-ci est positif dans la plupart des cas. Mais si les résultats attendus ne sont pas au rendez-vous, ', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`) VALUES
(58, 'aime.lemonnier@gmail.com', '[\"ROLE_USER\"]', '$2y$13$f5KhScTwxrOPMXmfzBGwteNV.L.sZWB79P2SGg1jpzi8iTWMH9/wK', 'Aime Lemonnier'),
(59, 'valerie.guillet@ribeiro.com', '[\"ROLE_USER\"]', '$2y$04$2Q8xuu1BA0lAOmOmDcwGnOnI1G5lLRaE6jIuLlMPZSnGeDK4LG3Eu', 'Valerie Guillet'),
(60, 'anonyme30@rey.fr', '[\"ROLE_USER\"]', '$2y$13$AwTP4R8VzaegM.B2awel9eni//ha28M7mTtAYelIIdKSu6ngJN3c6', 'Anonyme'),
(61, 'jr@list.com', '[\"ROLE_ADMIN\"]', '$2y$13$gOZV4ma74IN4N28FCOdMv.iwrjYH6sEfyLVs32Lf.wo6xrJn9JQne', 'Jean Reno'),
(69, 'mk@todo.com', '[\"ROLE_USER\"]', '$2y$04$vGRBLO6hn2/ktzqW.4m1ROUNzb1C38qLAVjijO.DEgnO8Z/3Rlwqm', 'Marie Kondo');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_527EDB25A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
