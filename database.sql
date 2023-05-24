-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 02 mai 2023 à 09:21
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `StrasGite`
--

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `title`) VALUES
(1, 'Stuff'),
(2, 'Doodads');

-- --------------------------------------------------------

--
-- Structure de la table `mealplan`
--

CREATE TABLE `mealplan` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mealplan`
--

INSERT INTO `mealplan` (`id`, `type`, `price`) VALUES
(1, 'Petit-dejeuner', '15.00'),
(2, 'Demi-pension', '30.00'),
(3, 'Pension complète', '45.00');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `datestart` date NOT NULL,
  `dateend` date NOT NULL,
  `nbpersonnes` int(11) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nbpersons` int(11) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `pricesp` decimal(5,2) DEFAULT NULL,
  `description` text,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`id`, `name`, `nbpersons`, `price`, `pricesp`, `description`, `image`) VALUES
(1, 'Chambre 1', 2, '80.00', '100.00', 'Le lit king-size est recouvert de draps en coton blancs et moelleux, accompagné de plusieurs oreillers douillets pour un sommeil parfait.', '/assets/images/HOMEPAGE/CHAMBRES/illustration_chambre1.jpg'),
(2, 'Chambre 2', 3, '100.00', '120.00', 'L\'espace de travail fonctionnel est équipé d\'un grand bureau et d\'une chaise confortable, idéal pour les voyageurs d\'affaires ou pour ceux qui ont besoin de travailler pendant leur séjour. ', '/assets/images/HOMEPAGE/CHAMBRES/illustration_chambre2.jpg'),
(3, 'Chambre 3', 3, '90.00', '130.00', 'La salle de bain moderne est équipée d\'une douche à l\'italienne avec des jets de pluie pour vous revigorer après une longue journée, ainsi que de produits de toilette de qualité pour votre confort. ', '/assets/images/HOMEPAGE/CHAMBRES/illustration_chambre3.jpg'),
(4, 'Chambre 4', 4, '120.00', '150.00', 'Cette chambre d\'hôtel contemporaine, est conçue pour répondre à tous vos besoins de confort et de style. En entrant dans la pièce, vous serez immédiatement frappé par l\'ambiance apaisante et moderne.', '/assets/images/HOMEPAGE/CHAMBRES/illustration_chambre4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `is_Admin` tinyint(1) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phonenb` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `mealplan`
--
ALTER TABLE `mealplan`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_room` (`id_room`);

--
-- Index pour la table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `mealplan`
--
ALTER TABLE `mealplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
