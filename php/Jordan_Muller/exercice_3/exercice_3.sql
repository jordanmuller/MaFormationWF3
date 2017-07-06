-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 06 Juillet 2017 à 17:19
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exercice_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_movie` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `actors` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `year_of_prod` year(4) NOT NULL,
  `language` varchar(255) NOT NULL,
  `category` enum('action','comedy','romance','horror','drama') NOT NULL,
  `storyline` text NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `actors`, `director`, `producer`, `year_of_prod`, `language`, `category`, `storyline`, `video`) VALUES
(5, 'The Dark Knight : Le Chevalier noir', 'Christian Bale, Heath Ledger, Aaron Eckhart ', 'Christopher Nolan', 'Warner Bros', 2008, 'French', 'action', 'Dans ce nouveau volet, Batman augmente les mises dans sa guerre contre le crime. Avec l''appui du lieutenant de police Jim Gordon et du procureur de Gotham, Harvey Dent, Batman vise à éradiquer le crime organisé qui pullule dans la ville. Leur association est très efficace mais elle sera bientôt bouleversée par le chaos déclenché par un criminel extraordinaire que les citoyens de Gotham connaissent sous le nom de Joker.', 'http://www.allocine.fr/video/player_gen_cmedia=18785651&cfilm=115362.html'),
(6, 'Schindler''s List', 'Liam Neeson, Ben Kingsley, Ralph Fiennes', 'Steven Spielberg', 'Universal Pictures', 1993, 'English', 'drama', 'Evocation des années de guerre d''Oskar Schindler, fils d''industriel d''origine autrichienne rentré à Cracovie en 1939 avec les troupes allemandes. Il va, tout au long de la guerre, protéger des juifs en les faisant travailler dans sa fabrique et en 1944 sauver huit cents hommes et trois cents femmes du camp d''extermination de Auschwitz-Birkenau.', 'http://www.allocine.fr/video/player_gen_cmedia=18802634&cfilm=9393.html'),
(7, 'Gran Torino', 'Clint Eastwood, Bee Vang, Ahney Her ', 'Clint Eastwood', 'Malpaso Productions', 2009, 'English', 'drama', 'Walt Kowalski est un ancien de la guerre de Corée, un homme inflexible, amer et pétri de préjugés surannés. Après des années de travail à la chaîne, il vit replié sur lui-même, occupant ses journées à bricoler, traînasser et siroter des bières. Avant de mourir, sa femme exprima le voeu qu''il aille à confesse, mais Walt n''a rien à avouer, ni personne à qui parler. Hormis sa chienne Daisy, il ne fait confiance qu''à son M-1, toujours propre, toujours prêt à l''usage...', 'http://www.allocine.fr/video/player_gen_cmedia=18857742&cfilm=135063.html'),
(8, 'Le Dîner de cons', 'Thierry Lhermitte, Jacques Villeret, Francis Huster ', 'Francis Veber', 'Gaumont', 1998, 'French', 'comedy', 'Tous les mercredis, Pierre Brochant et ses amis organisent un dîner où chacun doit amener un con. Celui qui a trouvé le plus spectaculaire est declaré vainqueur. Ce soir, Brochant exulte, il est sur d''avoir trouvé la perle rare, un con de classe mondiale: Francois Pignon, comptable au ministère des Finances et passionné de modèles réduits en allumettes. Ce qu''il ignore c''est que Pignon est passe maître dans l''art de déclencher des catastrophes.', 'http://www.allocine.fr/video/player_gen_cmedia=18781052&cfilm=16731.html'),
(9, 'La vita è bella', 'Roberto Benigni, Horst Buchholz, Marisa Paredes ', 'Roberto Benigni', 'Melampo Cinematografica', 1997, 'Italian', 'drama', 'En 1938, Guido, jeune homme plein de gaieté, rêve d''ouvrir une librairie, malgré les tracasseries de l''administration fasciste. Il tombe amoureux de Dora, institutrice étouffée par le conformisme familial et l''enlève le jour de ses fiançailles avec un bureaucrate du régime. Cinq ans plus tard, Guido et Dora ont un fils: Giosue. Mais les lois raciales sont entrées en vigueur et Guido est juif. Il est alors déporté avec son fils. Par amour pour eux, Dora monte de son plein gré dans le train qui les emmène aux camps de la mort où Guido veut tout faire pour éviter l''horreur à son fils...', 'http://www.allocine.fr/video/player_gen_cmedia=18639108&cfilm=64439.html'),
(10, 'La piel que habito', 'Antonio Banderas, Elena Anaya, Marisa Paredes', 'Pedro Almodóvar', 'El Deseo S.A.', 2011, 'Spanish', 'drama', 'Depuis que sa femme a été victime de brûlures dans un accident de voiture, le docteur Robert Ledgard, éminent chirurgien esthétique, se consacre à la création d’une nouvelle peau, grâce à laquelle il aurait pu sauver son épouse. Douze ans après le drame, il réussit dans son laboratoire privé à cultiver cette peau : sensible aux caresses, elle constitue néanmoins une véritable cuirasse contre toute agression, tant externe qu’interne, dont est victime l’organe le plus étendu de notre corps. Pour y parvenir, le chirurgien a recours aux possibilités qu’offre la thérapie cellulaire.', 'http://www.allocine.fr/video/player_gen_cmedia=19227944&cfilm=124897.html');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movie`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movie` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
