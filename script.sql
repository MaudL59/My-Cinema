-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my-cinema`
--
CREATE DATABASE IF NOT EXISTS `my-cinema`;
USE `my-cinema`;

-- --------------------------------------------------------

--
-- Structure de la table `Movie`
--

CREATE TABLE `Movie` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `releaseYear` int(4) DEFAULT NULL,
  `duration` int(10) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `genre` varchar(1000) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Movie`
--

INSERT INTO `Movie` (`id`, `title`, `releaseYear`, `duration`, `description`, `genre`, `poster`) VALUES
(2, 'Le Roi Lion', 1994, 88, 'Sur les Hautes terres d’Afrique règne un lion tout-puissant, le roi Mufasa, que tous les hôtes de la jungle respectent et admirent pour sa sagesse et sa générosité. Son jeune fils Simba sait qu’un jour il lui succédera, mais il est loin de deviner les épreuves et les sacrifices que lui imposera l’exercice du pouvoir. Espiègle, naïf et turbulent, le lionceau passe le plus clair de son temps à jouer avec Nala et à taquiner Zazu . Scar, le frère de Mufasa, aspire en effet depuis toujours au trône. Misant sur la curiosité enfantine et le tempérament aventureux de Simba, il révèle à celui-ci l’existence d’un mystérieux et dangereux cimetière d’éléphants. Simba, oubliant les avertissements répétés de son père, s’y rend aussitôt en secret avec Nala et se fait attaquer par 3 hyènes féroces. Par chance, Mufasa arrive à temps pour sauver l’imprudent lionceau et sa petite compagne. Mais Scar ne renonce pas à ses sinistres projets.', 'Animation, Aventure,', 'roiLion.jpg'),
(3, 'Interstellar', 2014, 169, 'Le film raconte les aventures d’un groupe d’explorateurs qui utilisent une faille récemment découverte dans l’espace-temps afin de repousser les limites humaines et partir à la conquête des distances astronomiques dans un voyage interstellaire. ', 'Drame, Science Fiction', 'interstellar.jpg'),
(4, 'Gladiator', 2000, 155, 'Le général romain Maximus est le plus fidèle soutien de l\'empereur Marc Aurèle, qu\'il a conduit de victoire en victoire avec une bravoure et un dévouement exemplaires. Jaloux du prestige de Maximus, et plus encore de l\'amour que lui voue l\'empereur, le fils de MarcAurèle, Commode, s\'arroge brutalement le pouvoir, puis ordonne l\'arrestation du général et son exécution. Maximus échappe à ses assassins mais ne peut empêcher le massacre de sa famille. Capturé par un marchand d\'esclaves, il devient gladiateur et prépare sa vengeance.', 'Action, Aventure, Historique', 'gladiator.jpg'),
(5, 'The Dark Knight', 2008, 152, 'Dans ce nouveau volet, Batman augmente les mises dans sa guerre contre le crime. Avec l\'appui du lieutenant de police Jim Gordon et du procureur de Gotham, Harvey Dent, Batman vise à éradiquer le crime organisé qui pullule dans la ville. Leur association est très efficace mais elle sera bientôt bouleversée par le chaos déclenché par un criminel extraordinaire que les citoyens de Gotham connaissent sous le nom de Joker.', 'Action, Thriller', 'batman.jpg'),
(6, 'Toy Story', 1995, 81, 'Un jeune garçon de 6 ans ne peut pas tout savoir. C’est ainsi que le jeune Andy ignore que dès qu’il sort de sa chambre, ses jouets mènent leur propre vie et que son préféré, le cow-boy Woody, est leur chef. Il ne se doute pas non plus qu’à chaque anniversaire, Zigzag -le chien à ressort-, le colérique Monsieur Patate, Rex -le dinosaure complexé-, Bayonne -la tirelire dite « Tête de lard »- et Bergère -la jolie lampe- angoissent à l’idée qu’un nouveau jouet ne les concurrence aux yeux de leur jeune maître et ne les relègue au placard... La vie de cette communauté va donc se trouver bouleversée par l’arrivée de Buzz l’Eclair, un cosmonaute électronique doté d’un rayon laser, d’ailes rétractables, d’une voix synthétique et d’un système de communication intergalactique. Au grand dam du fidèle cow-boy, Buzz l’Eclair devient en effet la coqueluche du jeune garçon et de tous les autres jouets. ', ' Animation, Comédie, Famille', 'toyStory.jpg'),
(7, 'Avatar', 2009, 162, 'Malgré sa paralysie, Jake Sully, un ancien marine immobilisé dans un fauteuil roulant, est resté un combattant au plus profond de son être. Il est recruté pour se rendre à des années-lumière de la Terre, sur Pandora, où de puissants groupes industriels exploitent un minerai rarissime destiné à résoudre la crise énergétique sur Terre. Parce que l\'atmosphère de Pandora est toxique pour les humains, ceux-ci ont créé le Programme Avatar, qui permet à des \" pilotes \" humains de lier leur esprit à un avatar, un corps biologique commandé à distance, capable de survivre dans cette atmosphère létale. Ces avatars sont des hybrides créés génétiquement en croisant l\'ADN humain avec celui des Na\'vi, les autochtones de Pandora.', ' Aventure, Science Fiction', 'avatar.jpg'),
(8, 'Titanic', 1997, 194, 'Southampton, 10 avril 1912. Le paquebot le plus grand et le plus moderne du monde, réputé pour son insubmersibilité, le \"Titanic\", appareille pour son premier voyage. Quatre jours plus tard, il heurte un iceberg. A son bord, un artiste pauvre et une grande bourgeoise tombent amoureux.', 'Drame, Romance', 'titanic.jpg'),
(9, 'Matrix', 1999, 136, 'Programmeur anonyme dans un service administratif le jour, Thomas Anderson devient Neo la nuit venue. Sous ce pseudonyme, il est l\'un des pirates les plus recherchés du cyber-espace. A cheval entre deux mondes, Neo est assailli par d\'étranges songes et des messages cryptés provenant d\'un certain Morpheus. Celui-ci l\'exhorte à aller au-delà des apparences et à trouver la réponse à la question qui hante constamment ses pensées : qu\'est-ce que la Matrice ? Nul ne le sait, et aucun homme n\'est encore parvenu à en percer les defenses. Mais Morpheus est persuadé que Neo est l\'Elu, le libérateur mythique de l\'humanité annoncé selon la prophétie. Ensemble, ils se lancent dans une lutte sans retour contre la Matrice et ses terribles agents...', 'Action, Science Fiction', 'matrix.jpg'),
(10, 'Spider-Man : Across the Spider-Verse', 2023, 140, 'Après avoir retrouvé Gwen Stacy, Spider-Man, le sympathique héros originaire de Brooklyn, est catapulté à travers le Multivers, où il rencontre une équipe de Spider-Héros chargée d\'en protéger l\'existence. Mais lorsque les héros s\'opposent sur la façon de gérer une nouvelle menace, Miles se retrouve confronté à eux et doit redéfinir ce que signifie être un héros afin de sauver les personnes qu\'il aime le plus.', ' Action, Animation, Aventure, Fantastique', 'spiderman.jpg'),
(11, 'Forrest Gump', 1994, 142, 'Quelques décennies d\'histoire américaine, des années 1940 à la fin du XXème siècle, à travers le regard et l\'étrange odyssée d\'un homme simple et pur, Forrest Gump.\r\n\r\n', 'Comédie, Drame, Romance', 'forestGump.jpg'),
(12, 'Zootopie', 2016, 108, 'Zootopie est une ville qui ne ressemble à aucune autre : seuls les animaux y habitent ! On y trouve des quartiers résidentiels élégants comme le très chic Sahara Square, et d’autres moins hospitaliers comme le glacial Tundratown. Dans cette incroyable métropole, chaque espèce animale cohabite avec les autres. Qu’on soit un immense éléphant ou une minuscule souris, tout le monde a sa place à Zootopia !\r\n\r\n', ' Animation, Comédie, Famille', 'zootopie.jpg'),
(26, 'Jurassic Park', 1993, 122, 'Parc où des dinosaures s\'échappent', 'Aventure, Science fiction', 'jurassicPark.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Room`
--

CREATE TABLE `Room` (
  `id` int(3) NOT NULL,
  `name` varchar(15) NOT NULL,
  `capacity` int(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Room`
--

INSERT INTO `Room` (`id`, `name`, `capacity`, `type`, `active`) VALUES
(1, 'Salle 1', 700, '3D', 0),
(2, 'Salle 2', 500, 'standard', 0),
(3, 'Salle 3', 500, 'IMAX', 0),
(4, 'Salle 4', 500, 'standard', 0),
(5, 'Salle 5', 500, 'standard', 0),
(15, 'Salle 8', 250, 'standard', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Screening`
--

CREATE TABLE `Screening` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `screening_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Screening`
--

INSERT INTO `Screening` (`id`, `movie_id`, `room_id`, `screening_date`) VALUES
(1, 7, 1, '2026-02-09 11:00:00'),
(2, 11, 2, '2026-02-09 11:00:00'),
(3, 6, 5, '2026-03-03 11:00:00'),
(8, 2, 1, '2026-02-07 14:00:00'),
(11, 5, 3, '2026-02-08 20:48:00'),
(12, 3, 2, '2026-03-03 11:00:00'),
(14, 6, 4, '2026-03-18 20:59:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Room`
--
ALTER TABLE `Room`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Screening`
--
ALTER TABLE `Screening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_screening_room` (`room_id`),
  ADD KEY `fk_screening_movie` (`movie_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `Room`
--
ALTER TABLE `Room`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `Screening`
--
ALTER TABLE `Screening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Screening`
--
ALTER TABLE `Screening`
  ADD CONSTRAINT `fk_screening_movie` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_screening_room` FOREIGN KEY (`room_id`) REFERENCES `Room` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;