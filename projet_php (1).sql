-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 avr. 2024 à 08:48
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
-- Base de données : `projet_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `nom` varchar(11) NOT NULL,
  `valeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`nom`, `valeur`) VALUES
('En Attente', 1),
('En cours', 2),
('Termine', 3),
('Historique', 4);

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

CREATE TABLE `intervention` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `standardiste_id` int(11) NOT NULL,
  `intervenant_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `urgences` int(11) NOT NULL DEFAULT 3,
  `etat` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `intervention`
--

INSERT INTO `intervention` (`id`, `nom`, `date`, `client_id`, `standardiste_id`, `intervenant_id`, `description`, `urgences`, `etat`) VALUES
(2, 'test', '2024-04-18', 15, 14, 24, 'test termine', 1, 3),
(6, 'test', '2003-06-02', 15, 14, 14, 'test\r\n', 3, 1),
(8, 'ghjnk,', '2024-04-18', 20, 20, 24, 'LOUNA', 3, 3),
(9, 'test', '2024-04-10', 15, 14, 14, 'MAJ TICKETS', 5, 1),
(15, 'test', '2024-05-02', 23, 14, 24, 'premier ticketSSS', 1, 1),
(17, 'test15', '2024-04-26', 25, 0, 0, 'test156', 3, 1),
(18, 'hgdsf', '2024-05-03', 25, 0, 0, 'qdfshjk', 3, 1),
(19, 'hgfds', '2024-04-26', 15, 0, 0, 'qdfsghj', 3, 1),
(20, 'hgfds', '2024-04-26', 15, 0, 0, 'qdfsghj', 3, 1),
(21, 'testt', '2024-05-01', 15, 0, 0, 'setsetset', 3, 1),
(22, 'mljkd', '2024-04-24', 15, 0, 0, 'Je change le problemeSSSS', 1, 1),
(23, 'test56', '2024-04-09', 25, 0, 0, 'test56\r\n', 3, 1),
(31, 'test14', '2024-04-04', 15, 0, 0, 'testsetsets', 3, 1),
(32, '<wdfghb,;', '2024-04-12', 15, 0, 0, 'bj,vhgcfsdq', 3, 1),
(33, 'dsfjk', '2024-04-03', 15, 0, 0, 'hvjbkhgcfxdws', 3, 1),
(34, 'mkljh,gfbdcw', '2024-04-13', 15, 0, 0, 'bnwSQDFGTHYGU', 3, 1),
(35, 'f,nxwbvfbx', '2024-04-26', 15, 0, 0, 'wdfhnxbwv<dwdwbc', 3, 1),
(36, 'allez', '2024-04-05', 15, 0, 0, 'allez', 3, 1),
(37, 'jcp', '2024-04-14', 15, 0, 0, 'jcp', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `nom`, `permission`) VALUES
(1, 'Client', 0),
(2, 'Intervenant', 1),
(3, 'Standardiste', 2),
(4, 'Admin', 3);

-- --------------------------------------------------------

--
-- Structure de la table `urgence`
--

CREATE TABLE `urgence` (
  `titre` varchar(20) NOT NULL,
  `valeur` int(11) NOT NULL,
  `couleur` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `urgence`
--

INSERT INTO `urgence` (`titre`, `valeur`, `couleur`) VALUES
('très faible', 1, 'vert'),
('faible', 2, 'jaune'),
('moyen', 3, 'orange'),
('eleve', 4, 'rouge'),
('très eleve', 5, 'violet');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `profil_id` int(11) NOT NULL DEFAULT 1,
  `mail` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `mots_de_passe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `profil_id`, `mail`, `age`, `identifiant`, `mots_de_passe`) VALUES
(7, 'tom', 'tom', 1, 'tom.tom@gmail.com', 21, 'tom', 'tom123'),
(8, 'paul', 'paul', 1, 'paul.paul@paul.fr', 21, 'paulo', 'paulo123'),
(14, 'Verrier', 'Hugo', 4, 'hugo.verrier@test.com', 24, 'loki', 'loki'),
(15, 'test', 'test', 1, 'test.test@test.com', 18, 'test', 'test'),
(20, 'mam', 'mam', 1, 'mam@g.com', 20, 'mam', 'mam'),
(21, 'fghj', 'fghj', 1, 'fghj@t.com', 20, 'fghj', 'fghj'),
(22, 'hjkl', 'hjkl', 1, 'hjkl@h.com', 20, 'hjkl', 'hjkl'),
(23, 'mlk', 'mlk', 1, 'mlk@u.com', 20, 'mlk', 'mlk'),
(24, 'tom', 'Paire', 2, 'tom.paire@gmail.com', 20, 'loki2', 'loki'),
(25, 'Evan', 'Nikta', 3, 'evan.nikta@gmail.com', 20, 'loki3', 'loki');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`valeur`);

--
-- Index pour la table `intervention`
--
ALTER TABLE `intervention`
  ADD PRIMARY KEY (`id`),
  ADD KEY `urgences` (`urgences`),
  ADD KEY `etat` (`etat`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `urgence`
--
ALTER TABLE `urgence`
  ADD PRIMARY KEY (`valeur`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_id` (`profil_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `intervention`
--
ALTER TABLE `intervention`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `intervention`
--
ALTER TABLE `intervention`
  ADD CONSTRAINT `intervention_ibfk_1` FOREIGN KEY (`urgences`) REFERENCES `urgence` (`valeur`),
  ADD CONSTRAINT `intervention_ibfk_2` FOREIGN KEY (`etat`) REFERENCES `etat` (`valeur`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`profil_id`) REFERENCES `profil` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
