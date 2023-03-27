-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 mars 2023 à 16:32
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
-- Base de données : `todo_co`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230210102455', '2023-02-10 11:25:30', 49),
('DoctrineMigrations\\Version20230210215046', '2023-02-10 22:51:11', 137),
('DoctrineMigrations\\Version20230215090245', '2023-02-15 10:03:10', 51);

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '(DC2Type:datetime_immutable)',
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `is_done` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `created_at`, `title`, `content`, `is_done`, `user_id`) VALUES
(9, '2023-02-15 10:20:46', 'Etablir le budget', 'Prévoir le coût de l’inscription (participation demandée, prise en compte des frais de repas), le nombre minimal d’inscription pour la tenue de l’événement et le coût lié aux intervenants (en cas de prestation payante).', 0, 60),
(10, '2023-03-04 19:22:46', 'Choix des intervenants', 'Un comité d’accueil ayant pour mandat d’accueillir les participants, les intervenants, les animateurs d’ateliers, les exposants, les\r\nrestaurateurs… et d’orienter vers le vestiaire assurera un accueil chaleureux et invitant.', 1, 60),
(11, '2023-02-15 10:20:46', 'Notes de remerciement', 'Après avoir administré et analysé le questionnaire de satisfaction, il est important de remercier les intervenants après l’événement et faire connaître les évaluations des ateliers aux animateurs.', 1, 60),
(12, '2023-02-15 10:20:46', 'Réservation de la salle', 'La réunion technique pourra être organisée dans les locaux d’un partenaire, dans une salle municipale ou dans une entreprise volontaire.\r\nOutre le lieu, le dimensionnement de la capacité d’accueil, l’organisation se devra d’être en cohérence avec votre message.', 0, 60),
(13, '2023-02-15 10:20:46', 'Questionnaire de satisfaction', 'Un questionnaire de satisfaction peut être distribué en fin d’événement ou transmis (par voie électronique) à la suite de celui-ci. Il permet\r\nde préparer le bilan. ', 1, 60),
(14, '2023-02-15 10:20:46', 'Organiser une animation', 'Selon l’importance de l’événement, un président d’honneur accompagne le maître de cérémonie. Ce dernier présente les intervenants,\r\nintroduit le thème de l’événement, établit les liens entre les ateliers, anime la plénière et s’assure du respect des horaires. \r\n', 0, 60),
(16, '2023-03-23 14:42:12', 'Objectif de la mission', 'Afin de bien organiser un déplacement professionnel, il est nécessaire de prendre en compte certaines conditions. Définir les objectifs à accomplir et les motifs du déplacement professionnel.', 0, 61),
(17, '2023-03-23 14:44:04', 'Formalités officielles', 'Se renseigner sur la destination du déplacement professionnel, choisir son moyen de transport pour s’y rendre.', 1, 58),
(18, '2023-03-23 14:45:29', 'Réservation transport', 'Après avoir obtenu l’ordre de mission du voyage d’affaires, il est temps de réserver le déplacement. La première étape est celle des transports, pour cela, réalisez un tableau comparatif des prix. ', 0, 58),
(19, '2023-03-23 14:46:42', 'Hebergement', 'Le choix de l’hébergement est essentiel pour un déplacement professionnel. Vérifiez si l’entreprise privilégie une chaîne hôtelière. ', 0, 64),
(20, '2023-03-23 14:48:33', 'Programme de travail', 'Il est indispensable de faire le point sur les objectifs du déplacement professionnel, cela afin de bien préparer le voyage.', 0, 61),
(21, '2023-03-23 14:51:13', 'Gestion des assurances', 'Si nos cartes bleues et la responsabilité civile nous couvrent généralement, vérifiez qu’une assurance pour un trajet professionnel à l’étranger est prévue pour chacun des collaborateurs concernés. ', 0, 64),
(22, '2023-03-23 15:20:06', 'Calcul des frais', 'Afin de ne rien oublier, faites une liste de tous les documents professionnels dont vous aurez besoin pour le calcul des frais comme : les dossiers, les reportings, les contrats, les notes de synthèse, les documents d’entreprise, etc.', 0, 59);

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
(58, 'aime.lemonnier@gmail.com', '[\"ROLE_USER\"]', '$2y$13$qfQ7O7Vgko5p6mdhQRMstuvfta6HyIx9bB/pcmvKiQRy./EMFvxeG', 'Aimé Lemonnier'),
(59, 'valerie.guillet@ribeiro.com', '[\"ROLE_USER\"]', '$2y$13$5N8ob/iKpExrRe7sYFh/ZOZ0ihH2WLsgBxDVl5Zhui1/P33Z7PaBu', 'Valérie Guillet'),
(60, 'anonyme30@rey.fr', '[\"ROLE_USER\"]', '$2y$13$AwTP4R8VzaegM.B2awel9eni//ha28M7mTtAYelIIdKSu6ngJN3c6', 'Anonyme'),
(61, 'jr@list.com', '[\"ROLE_ADMIN\"]', '$2y$13$gOZV4ma74IN4N28FCOdMv.iwrjYH6sEfyLVs32Lf.wo6xrJn9JQne', 'Jean Reno'),
(62, 'salomon@list.com', '[\"ROLE_USER\"]', '$2y$13$qdAcfFCOvWdwC/E5Jpb8NeU6Yj8lSeSd07eUO/eaMgeuMVMmNtffG', 'Salomon Coli'),
(63, 'noemi@list.com', '[\"ROLE_ADMIN\"]', '$2y$13$OtEOW2xN8uQtsW02FAhH8.AxnNuxWYgaj7AX6DkD0jR7vsEa4p30W', 'Noemi Abo'),
(64, 'nathalie@list.com', '[\"ROLE_USER\"]', '$2y$13$8A2pUgilu6DJ3EZjsQWmJOfExPqeFl0Igz6TiUyAfgXPS4fNyF4TG', 'Nathalie Colin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

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
