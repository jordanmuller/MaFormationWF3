-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 04 Juillet 2017 à 16:36
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wf3_site`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int(5) NOT NULL,
  `reference` int(15) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `taille` varchar(3) NOT NULL,
  `sexe` enum('m','f') NOT NULL DEFAULT 'm',
  `photo` varchar(255) NOT NULL,
  `prix` double(7,2) NOT NULL,
  `stock` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id_article`, `reference`, `categorie`, `titre`, `description`, `couleur`, `taille`, `sexe`, `photo`, `prix`, `stock`) VALUES
(4, 102, 'Parapluie', 'Parapluie pink', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Rose', 'M', 'm', '102_goods_12_140294.jpg', 50.00, 0),
(5, 103, 'Parapluie', 'Parapluie vert', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Vert', 'M', 'm', '103_goods_57_184814.jpg', 41.00, 50),
(6, 104, 'Parapluie', 'Parapluie bleu électrique', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Bleu', 'M', 'm', '104_goods_66_184814.jpg', 42.00, 50),
(7, 105, 'Parapluie', 'Parapluie bleu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Bleu', 'M', 'm', '105_goods_69_173034.jpg', 40.00, 0),
(8, 201, 'Chemise', 'Chemise blanche', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Blanc', 'L', 'm', '201_goods_00_183595.jpg', 35.00, 47),
(9, 202, 'Chemise', 'Chemise grise', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Gris', 'M', 'm', '202_goods_03_183595.jpg', 40.00, 50),
(10, 203, 'Chemise', 'Chemise jaune', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Gris', 'M', 'm', '203_goods_31_183595.jpg', 41.00, 50),
(11, 301, 'Chaussettes', 'Chaussettes jaunes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Jaune', 'M', 'm', '301_goods_40_182509.jpg', 10.00, 50),
(12, 302, 'Chaussettes', 'Chaussettes blanches', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Blanc', 'M', 'm', '302_goods_00_182509.jpg', 10.00, 47),
(13, 303, 'Chaussettes', 'Chaussettes grises', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Gris', 'M', 'm', '303_goods_02_182509.jpg', 10.00, 10),
(14, 304, 'Chaussettes', 'Chaussettes rouges', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Rouge', 'M', 'm', '304_goods_17_182509.jpg', 10.00, 50),
(16, 401, 'Manteau', 'Manteau bleu clair', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Bleu', 'M', 'm', '401_manteau_bleu.jpg', 70.00, 50),
(17, 402, 'Manteau', 'Manteau bleu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Bleu', 'M', 'm', '402_manteau_bleu_fonce.jpg', 70.00, 0),
(18, 403, 'Manteau', 'Manteau gris', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Gris', 'M', 'm', '403_manteau_gris.jpg', 70.00, 50),
(19, 501, 'Chapeau', 'Chapeau gris', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Gris', 'M', 'm', '501_goods_08_400035.jpg', 35.00, 49),
(20, 502, 'Chapeau', 'Chapeau gris foncé', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Gris', 'M', 'm', '502_goods_09_184799.jpg', 35.00, 50),
(22, 601, 'Pantalon', 'Pantalon noir', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Noir', 'M', 'm', '601_eugoods_09_163902.jpg', 56.00, 50),
(23, 602, 'Pantalon', 'Pantalon beige', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Jaune', 'M', 'm', '602_eugoods_31_163902.jpg', 63.00, 50),
(24, 603, 'Pantalon', 'Pantalon bleu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Bleu', 'M', 'm', '603_goods_69_146140.jpg', 70.00, 50),
(25, 604, 'Pantalon', 'Pantalon rouge', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rhoncus erat sed mattis vehicula. Mauris tincidunt at ipsum ut efficitur. Donec lacus elit, posuere et ex eu, aliquam eleifend ex. Fusce vel fermentum nisi, fringilla vestibulum dolor. Ut vel sem lacinia, ultricies lacus ut, finibus nisi. Maecenas congue ante non mi dictum varius. Phasellus a risus eget augue ultricies vehicula. Aliquam id augue tellus. Maecenas non nulla risus. Donec pretium sem nisl, mollis fringilla mauris faucibus quis. ', 'Rouge', 'M', 'm', '604_goods_19_146140.jpg', 70.00, 50);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(5) NOT NULL,
  `id_membre` int(5) DEFAULT NULL,
  `montant` double(7,2) NOT NULL,
  `date` datetime NOT NULL,
  `etat` enum('en cours de traitement','envoyé','livré') NOT NULL DEFAULT 'en cours de traitement'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `montant`, `date`, `etat`) VALUES
(1, 1, 204.00, '2017-07-04 15:14:48', 'en cours de traitement');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id_details_commande` int(5) NOT NULL,
  `id_commande` int(5) NOT NULL,
  `id_article` int(5) DEFAULT NULL,
  `quantite` int(3) NOT NULL,
  `prix` double(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `details_commande`
--

INSERT INTO `details_commande` (`id_details_commande`, `id_commande`, `id_article`, `quantite`, `prix`) VALUES
(1, 1, 12, 3, 12.00),
(2, 1, 8, 3, 42.00),
(3, 1, 19, 1, 42.00);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(5) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sexe` enum('m','f') NOT NULL DEFAULT 'm',
  `ville` varchar(255) NOT NULL,
  `cp` int(5) UNSIGNED ZEROFILL NOT NULL,
  `adresse` text NOT NULL,
  `statut` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `sexe`, `ville`, `cp`, `adresse`, `statut`) VALUES
(1, 'admin', 'admin', 'Lorem', 'Ipsum', 'admin@mail.fr', 'm', 'Paris', 75000, 'Rue de la place.', 1),
(3, 'test', 'test', 'Lorem', 'Ipsum', 'test@mail.fr', 'm', 'Paris', 75000, 'Rue de la place.', 0),
(5, 'Mathieu', 'password', 'Quittard', 'Mathieu', 'mail@mail.fr', 'm', 'Paris', 75000, 'Rue de l''arbre', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id_details_commande`),
  ADD KEY `id_commande` (`id_commande`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id_details_commande` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `details_commande_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
