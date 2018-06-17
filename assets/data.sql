-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Sam 16 Juin 2018 à 20:00
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dorotheev_movies`
--

-- --------------------------------------------------------

--
-- Structure de la table `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `actors`
--

INSERT INTO `actors` (`id`, `firstname`, `lastname`) VALUES
(1, 'Jake', 'Gyllenhaal'),
(2, 'Holmes', 'Osborne'),
(3, 'Maggie', 'Gyllenhaal'),
(4, 'Ken\'ichi', 'Matsuyama'),
(5, 'Tatsuya', 'Fujiwara'),
(6, 'Erika', 'Toda'),
(7, 'Kevin', 'Costner'),
(8, 'Tina', 'Majorino'),
(9, 'Jeanne', 'Tripplehorn'),
(10, 'Dennis', 'Hopper'),
(11, 'Jack', 'Black'),
(12, 'Emile', 'Hirsch'),
(13, 'Marcia ', 'Gay Harden'),
(14, 'William', 'Hurt'),
(18, 'Ed', 'Harris'),
(19, 'Mary', 'Elisabeth'),
(20, 'Michael', 'Biehn'),
(21, 'Ryan', 'Reynolds'),
(22, 'Morena', 'Baccarin'),
(23, 'Ed', 'Skrein'),
(24, 'Michael J.', 'Fox'),
(25, 'Christopher', 'Lloyd'),
(26, 'Lea', 'Thompson'),
(27, 'Jaeden', 'Lieberher'),
(28, 'Bill', 'Skarsgård'),
(29, 'Finn', 'Wolfhard'),
(30, 'Christian', 'Bale'),
(31, 'Matthew', 'McConaughey'),
(32, 'Gerard', 'Butler'),
(33, 'Leonardo', 'Dicaprio'),
(34, 'Marion', 'Cotillard'),
(35, 'Ellen', 'Page'),
(36, 'Edward', 'Norton'),
(37, 'Brad', 'Pitt'),
(38, 'Helena', 'Bonham Carter'),
(39, 'Joseph', 'Gordon-Levitt'),
(40, 'Shaielene', 'Woodley'),
(41, 'Zachary', 'Quinto');

-- --------------------------------------------------------

--
-- Structure de la table `actors_movies`
--

CREATE TABLE `actors_movies` (
  `actors_id` int(11) NOT NULL,
  `movies_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `actors_movies`
--

INSERT INTO `actors_movies` (`actors_id`, `movies_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 2),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 4),
(13, 4),
(14, 4),
(18, 6),
(19, 6),
(20, 6),
(21, 7),
(22, 7),
(23, 7),
(24, 8),
(25, 8),
(26, 8),
(27, 9),
(28, 9),
(29, 9),
(30, 10),
(31, 10),
(32, 10),
(33, 11),
(34, 11),
(35, 11),
(36, 12),
(37, 12),
(38, 12),
(39, 13),
(40, 13),
(41, 13);

-- --------------------------------------------------------

--
-- Structure de la table `directors`
--

CREATE TABLE `directors` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `directors`
--

INSERT INTO `directors` (`id`, `firstname`, `lastname`) VALUES
(1, 'Richard', 'Kelly'),
(2, 'Shūsuke ', 'Kaneko'),
(3, 'Kevin ', 'Reynolds'),
(4, 'Sean', 'Penn'),
(6, 'James', 'Cameron'),
(7, 'Tim', 'Miller'),
(8, 'Robert', 'Zemeckis'),
(9, 'Andres', 'Muschietti'),
(10, 'Rob S', 'Bowman'),
(11, 'Christopher', 'Nolan'),
(12, 'David', 'Fincher'),
(13, 'Oliver', 'Stone');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Thriller'),
(2, 'Science-fiction'),
(3, 'Drame'),
(4, 'Fantasy'),
(5, 'Action'),
(6, 'Horreur'),
(7, 'Thriller politique');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext,
  `year` year(4) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `year`, `poster`) VALUES
(1, 'Donnie Darko', 'Donnie Darko est un adolescent de seize ans pas comme les autres. Intelligent et doté d\'une grande imagination, il a pour ami Frank, une créature que lui seul peut voir et entendre.Lorsque Donnie survit par miracle à un accident, Frank lui propose un étrange marché. La fin du monde approche et ce dernier doit accomplir sa destinée. Des événements bizarres surviennent dans la petite ville tranquille, mais Donnie sait que derrière tout cela se cachent d\'inavouables secrets. Frank l\'aidera à les mettre à jour, semant ainsi le trouble au sein de la communauté. ', 2001, 'donnie_darko.jpg'),
(2, 'Death Note', 'Le cahier de la mort. Il suffit d\'y apposer le nom d\'une personne que l\'on souhaite châtier et de garder en tête son visage pour que cette dernière meure. Quand ce cahier tombe entre les mains de Light, brillant lycéen au tempérament assez taciturne, il décide de l\'exploiter pour appliquer sa propre justice et devenir l\'égal de la mort. Ainsi Light note soigneusement les noms des meurtriers les plus recherchés par la police et restés impunis jusqu\'alors.', 2006, 'death_note.jpg'),
(3, 'Waterworld', 'Le monde s\'est transformé en un immense océan. Dans des embarcations délabrées et dans des villes flottantes improvisées appelées, les atolls, on lutte dans l\'espoir de trouver un jour le Dryland mythique. Deacon, le chef de la bande des pirates, attaque l\'atoll où habitent la jeune Enola et Helen se mère adoptive. Mais Mariner, un vagabond, découvre que la jeune Enola possède un trésor qui peut le monde.', 1995, 'waterworld.jpg'),
(4, 'Into The Wild', 'Tout juste diplômé, Christopher McCandless, 22 ans, est promis à un brillant avenir. Pourtant, tournant le dos à l\'existence confortable et sans surprise qui l\'attend, le jeune homme décide de prendre la route en laissant tout derrière lui. Des champs de blé du Dakota aux flots tumultueux du Colorado, en passant par les communautés hippies de Californie, Christopher va rencontrer des personnages hauts en couleur. Chacun, à sa manière, va façonner sa vision de la vie et des autres.', 2008, 'into_the_wild.jpg'),
(6, 'Abyss', 'Heurté par un objet non identifié, Le Montana, un sous-marin nucléaire, se retrouve sur le rebord d\'une faille, à plusieurs centaines de mètres de profondeur. Pour explorer le bateau coulé, la marine américaine réquisitionne la plate-forme pétrolière expérimentale Deepcore. Quelques techniciens, emmenés par leur chef, ainsi que trois sauveteurs de la marine partent en reconnaissance au fond des mers, rejoindre l\'épave.', 1989, 'abyss.png'),
(7, 'Deadpool', 'Deadpool, est l\'anti-héros le plus atypique de l\'univers Marvel. A l\'origine, il s\'appelle Wade Wilson : un ancien militaire des Forces Spéciales devenu mercenaire. Après avoir subi une expérimentation hors norme qui va accélérer ses pouvoirs de guérison, il va devenir Deadpool. Armé de ses nouvelles capacités et d\'un humour noir survolté, Deadpool va traquer l\'homme qui a bien failli anéantir sa vie. ', 2016, 'deadpool.jpg'),
(8, 'Retour vers le futur', 'Marty Mc Fly est un adolescent américain des années 80: il va au lycée, aime le Rock, fait du skate-board ... Mais il est aussi l\'ami d\'un savant excentrique, le Dr Emmet Brown, inventeur d\'une machine à remonter le temps très particulière, une Delorean. Marty se retrouve propulsé par hasard en 1955, à une époque où il n\'était même pas né. Avant d\'entreprendre son voyage de retour vers le futur, il va devoir s\'assurer que ses parents, encore étudiants, se rencontrent... et se marient !!!', 1985, 'retour_vers_le_futur.jpg'),
(9, 'Ça', 'Plusieurs disparitions d\'enfants sont signalées dans la petite ville de Derry, dans le Maine. Au même moment, une bande d\'adolescents doit affronter un clown maléfique et tueur, du nom de Grippe-Sou, qui sévit depuis des siècles. Ils vont connaître leur plus grande terreur.', 2017, 'ca.jpg'),
(10, 'Le règne du feu', 'À Londres, en 2008, le jeune Quinn accompagne sa mère sur un chantier. Celle-ci supervise la construction de tunnels pour le nouveau tracé du métro. Lors du creusement, une paroi s\'effondre, révélant un gouffre sans fond. La mère de Quinn s\'y engage, mais une immense colonne de feu s\'en échappe et tue tous ceux qui se trouvent sur son passage. Resté à l\'extérieur, le garçon assiste, médusé, à ce tragique événement. Un dragon jaillit alors du gouffre.', 2002, 'le_regne_du_feu.jpg'),
(11, 'Inception', 'Dom Cobb est un voleur expérimenté, passé maître dans l\'art de l\'extraction, un homme très prisé dans l\'univers parallèle de l\'espionnage industriel. Sa spécialité consiste en effet à s\'approprier les secrets les plus précieux, les plus intimes d\'un individu pendant son sommeil. Mais Dom Cobb est aussi un fugitif traqué dans le monde entier, un homme qui a perdu tout ce qui lui était cher. Une ultime mission pourrait lui permettre de retrouver sa vie d\'avant : au lieu de subtiliser un rêve, Cobb et son équipe doivent faire l\'inverse, c\'est-à-dire implanter une idée dans l\'esprit d\'un homme. S\'ils y parviennent, ils pourraient avoir accompli le crime parfait.', 2010, 'inception.jpg'),
(12, 'Fight Club', ' Jack ne souhaite qu\'une chose : s\'évader de son quotidien monotone. Très vite, il rencontre Tyler Durden, un vendeur de savon charismatique à la philosophie tordue et anarchiste. Ensemble, ils décident de créer un club de combat clandestin dont les règles s\'établissent partout dans le monde. Règle n° 1 : ne pas parler du Fight Club. Règle n° 2 : ne pas parler du Fight Club.', 1999, 'fight_club.jpg'),
(13, 'Snowden', 'Patriote idéaliste et enthousiaste, le jeune Edward Snowden semble réaliser son rêve quand il rejoint les équipes de la CIA puis de la NSA. Il découvre alors au cœur des Services de Renseignements américains l’ampleur insoupçonnée de la cyber-surveillance. Violant la Constitution, soutenue par de grandes entreprises, la NSA collecte des montagnes de données et piste toutes les formes de télécommunications à un niveau planétaire. Choqué par cette intrusion systématique dans nos vies privées, Snowden décide de rassembler des preuves et de tout divulguer. Devenu lanceur d’alerte, il sacrifiera sa liberté et sa vie privée. En juin 2013, deux journalistes prennent le risque de le rencontrer dans une chambre d’hôtel à Hong Kong. Une course contre la montre s’engage pour analyser les preuves irréfutables présentées par Snowden avant leur publication. Les révélations qui vont être faites dans cette pièce seront au cœur du plus grand scandale d’espionnage de l’histoire des États-Unis.', 2016, 'snowden.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `movies_directors`
--

CREATE TABLE `movies_directors` (
  `movies_id` int(11) NOT NULL,
  `directors_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `movies_directors`
--

INSERT INTO `movies_directors` (`movies_id`, `directors_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13);

-- --------------------------------------------------------

--
-- Structure de la table `movies_genres`
--

CREATE TABLE `movies_genres` (
  `movies_id` int(11) NOT NULL,
  `genres_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `movies_genres`
--

INSERT INTO `movies_genres` (`movies_id`, `genres_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(4, 3),
(4, 5),
(6, 1),
(7, 2),
(8, 2),
(9, 6),
(10, 4),
(11, 2),
(12, 1),
(13, 7);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `actors_movies`
--
ALTER TABLE `actors_movies`
  ADD PRIMARY KEY (`actors_id`,`movies_id`),
  ADD KEY `fk_actors_has_movies_movies1_idx` (`movies_id`),
  ADD KEY `fk_actors_has_movies_actors1_idx` (`actors_id`);

--
-- Index pour la table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movies_directors`
--
ALTER TABLE `movies_directors`
  ADD PRIMARY KEY (`movies_id`,`directors_id`),
  ADD KEY `fk_movies_has_directors_directors1_idx` (`directors_id`),
  ADD KEY `fk_movies_has_directors_movies_idx` (`movies_id`);

--
-- Index pour la table `movies_genres`
--
ALTER TABLE `movies_genres`
  ADD PRIMARY KEY (`movies_id`,`genres_id`),
  ADD KEY `fk_movies_has_genres_genres1_idx` (`genres_id`),
  ADD KEY `fk_movies_has_genres_movies1_idx` (`movies_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `actors_movies`
--
ALTER TABLE `actors_movies`
  ADD CONSTRAINT `fk_actors_has_movies_actors1` FOREIGN KEY (`actors_id`) REFERENCES `actors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_actors_has_movies_movies1` FOREIGN KEY (`movies_id`) REFERENCES `movies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `movies_directors`
--
ALTER TABLE `movies_directors`
  ADD CONSTRAINT `fk_movies_has_directors_directors1` FOREIGN KEY (`directors_id`) REFERENCES `directors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movies_has_directors_movies` FOREIGN KEY (`movies_id`) REFERENCES `movies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `movies_genres`
--
ALTER TABLE `movies_genres`
  ADD CONSTRAINT `fk_movies_has_genres_genres1` FOREIGN KEY (`genres_id`) REFERENCES `genres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movies_has_genres_movies1` FOREIGN KEY (`movies_id`) REFERENCES `movies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
