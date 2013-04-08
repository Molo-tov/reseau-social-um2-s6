-- phpMyAdmin SQL Dump
-- version 3.5.7deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 08 Avril 2013 à 16:14
-- Version du serveur: 5.5.29-0ubuntu1
-- Version de PHP: 5.4.9-4ubuntu2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `Winky`
--

-- --------------------------------------------------------

--
-- Structure de la table `AlbumPhoto`
--

CREATE TABLE IF NOT EXISTS `AlbumPhoto` (
  `idAlbum` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `idParent` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlbum`),
  KEY `idParent` (`idParent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `AssocPhoto`
--

CREATE TABLE IF NOT EXISTS `AssocPhoto` (
  `idAssoc` int(11) NOT NULL AUTO_INCREMENT,
  `idAlbum` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL,
  PRIMARY KEY (`idAssoc`),
  KEY `idAlbum` (`idAlbum`),
  KEY `idPhoto` (`idPhoto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Association : la photo idPhoto est contenue dans l''album idAlbum' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `CategorieAmis`
--

CREATE TABLE IF NOT EXISTS `CategorieAmis` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `optionDroit` int(11) NOT NULL DEFAULT '0',
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idCategorie`),
  KEY `idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des catégories d''amis dans la liste d''amis de idUtilisateur' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Commentaire`
--

CREATE TABLE IF NOT EXISTS `Commentaire` (
  `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `idNotification` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL,
  PRIMARY KEY (`idCommentaire`),
  KEY `idNotification` (`idNotification`),
  KEY `idPublication` (`idPublication`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des commentaires sur la publication idPublication' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Evennement`
--

CREATE TABLE IF NOT EXISTS `Evennement` (
  `idEvennement` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `descriptif` text,
  `dateEvennement` datetime DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `idNotification` int(11) NOT NULL,
  PRIMARY KEY (`idEvennement`),
  KEY `idNotification` (`idNotification`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des evennements et leurs informations associées' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `GroupeOpinion`
--

CREATE TABLE IF NOT EXISTS `GroupeOpinion` (
  `idGroupeO` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `descriptif` text,
  `idGerant` int(11) NOT NULL,
  PRIMARY KEY (`idGroupeO`),
  KEY `idGerant` (`idGerant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des groupes d''opinions et de leurs informations' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `InscriptionEnAttente`
--

CREATE TABLE IF NOT EXISTS `InscriptionEnAttente` (
  `idInscription` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `dateNaissance` date NOT NULL,
  `sexe` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`idInscription`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des inscriptions en attente de confirmation' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Like`
--

CREATE TABLE IF NOT EXISTS `Like` (
  `idLike` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `idNotification` int(11) NOT NULL,
  PRIMARY KEY (`idLike`),
  KEY `idUtilisateur` (`idUtilisateur`),
  KEY `idNotification` (`idNotification`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des likes : idUtilisateur like idNotification' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text,
  `fichier` varchar(255) DEFAULT NULL COMMENT 'Pièce jointe définie par son URL',
  `idNotification` int(11) NOT NULL,
  `idDestinataire` int(11) NOT NULL,
  PRIMARY KEY (`idMessage`),
  KEY `idNotification` (`idNotification`),
  KEY `idDestinataire` (`idDestinataire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des messages privés envoyés a idDestinataire' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Notification`
--

CREATE TABLE IF NOT EXISTS `Notification` (
  `idNotification` int(11) NOT NULL AUTO_INCREMENT,
  `dateNotification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idExpediteur` int(11) NOT NULL,
  PRIMARY KEY (`idNotification`),
  KEY `idExpediteur` (`idExpediteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste de tout ce que poste idExpediteur' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Photo`
--

CREATE TABLE IF NOT EXISTS `Photo` (
  `idPhoto` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `idPublication` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPhoto`),
  KEY `idPublication` (`idPublication`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Liste des photos ayant pour adresse image' AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Photo`
--

INSERT INTO `Photo` (`idPhoto`, `image`, `titre`, `idPublication`) VALUES
(1, 'img01.jpg', 'Moi', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Publication`
--

CREATE TABLE IF NOT EXISTS `Publication` (
  `idPublication` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text,
  `idNotification` int(11) NOT NULL,
  `idDestinataire` int(11) NOT NULL,
  PRIMARY KEY (`idPublication`),
  KEY `idDestinataire` (`idDestinataire`),
  KEY `idNotification` (`idNotification`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des publications sur le mur de idDestinataire' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `RelationAmitie`
--

CREATE TABLE IF NOT EXISTS `RelationAmitie` (
  `idRelation` int(11) NOT NULL AUTO_INCREMENT,
  `enAttente` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 si en attente, 0 sinon',
  `idUtilisateur` int(11) NOT NULL,
  `idAmi` int(11) NOT NULL,
  `idCategorie` int(11) DEFAULT NULL COMMENT 'NULL si l''ami est dans la catégorie standard',
  PRIMARY KEY (`idRelation`),
  KEY `idUtilisateur` (`idUtilisateur`),
  KEY `idAmi` (`idAmi`),
  KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Relations d''amitié : idUtilisateur a idAmi dans son groupe d''amis idCategorie' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Tchat`
--

CREATE TABLE IF NOT EXISTS `Tchat` (
  `idTchat` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `dateEnvois` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idExpediteur` int(11) NOT NULL,
  `idDestinataire` int(11) NOT NULL,
  PRIMARY KEY (`idTchat`),
  KEY `idExpediteur` (`idExpediteur`),
  KEY `idDestinataire` (`idDestinataire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des messages du tchat de idExpediteur vers idDestinataire' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE IF NOT EXISTS `Utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `dateNaissance` date NOT NULL,
  `optionDroit` int(11) NOT NULL DEFAULT '0',
  `sexe` int(11) NOT NULL COMMENT '0 pour garçon, 1 pour fille',
  `idPhoto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `email` (`email`),
  KEY `idPhoto` (`idPhoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Liste des utilisateurs avec leurs informations personnelles' AUTO_INCREMENT=7 ;

--
-- Contenu de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`idUtilisateur`, `password`, `email`, `nom`, `prenom`, `dateNaissance`, `optionDroit`, `sexe`, `idPhoto`) VALUES
(1, 'client', 'client@client.com', 'Nclient', 'Pclient', '2013-04-17', 0, 0, 1),
(5, 'Baltosss1989', 'fredverdier30@hotmail.fr', 'Verdier', 'Fred', '1989-07-13', 0, 0, NULL),
(6, 'moa', 'toto@gmail.com', 'Ferrero', 'quety', '1989-07-13', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Wink`
--

CREATE TABLE IF NOT EXISTS `Wink` (
  `idWink` int(11) NOT NULL AUTO_INCREMENT,
  `idNotification` int(11) NOT NULL,
  `idDestinataire` int(11) NOT NULL,
  PRIMARY KEY (`idWink`),
  KEY `idNotification` (`idNotification`),
  KEY `idDestinataire` (`idDestinataire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des Winks envoyés a idDestinataire' AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `AlbumPhoto`
--
ALTER TABLE `AlbumPhoto`
  ADD CONSTRAINT `AlbumPhoto_ibfk_3` FOREIGN KEY (`idParent`) REFERENCES `AlbumPhoto` (`idAlbum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `AssocPhoto`
--
ALTER TABLE `AssocPhoto`
  ADD CONSTRAINT `AssocPhoto_ibfk_1` FOREIGN KEY (`idAlbum`) REFERENCES `AlbumPhoto` (`idAlbum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AssocPhoto_ibfk_2` FOREIGN KEY (`idPhoto`) REFERENCES `Photo` (`idPhoto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `CategorieAmis`
--
ALTER TABLE `CategorieAmis`
  ADD CONSTRAINT `CategorieAmis_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD CONSTRAINT `Commentaire_ibfk_1` FOREIGN KEY (`idNotification`) REFERENCES `Notification` (`idNotification`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Commentaire_ibfk_2` FOREIGN KEY (`idPublication`) REFERENCES `Publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Evennement`
--
ALTER TABLE `Evennement`
  ADD CONSTRAINT `Evennement_ibfk_1` FOREIGN KEY (`idNotification`) REFERENCES `Notification` (`idNotification`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `GroupeOpinion`
--
ALTER TABLE `GroupeOpinion`
  ADD CONSTRAINT `GroupeOpinion_ibfk_1` FOREIGN KEY (`idGerant`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Like`
--
ALTER TABLE `Like`
  ADD CONSTRAINT `Like_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Like_ibfk_2` FOREIGN KEY (`idNotification`) REFERENCES `Notification` (`idNotification`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`idNotification`) REFERENCES `Notification` (`idNotification`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`idDestinataire`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Notification`
--
ALTER TABLE `Notification`
  ADD CONSTRAINT `Notification_ibfk_1` FOREIGN KEY (`idExpediteur`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `Photo_ibfk_2` FOREIGN KEY (`idPublication`) REFERENCES `Publication` (`idPublication`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `Publication`
--
ALTER TABLE `Publication`
  ADD CONSTRAINT `Publication_ibfk_1` FOREIGN KEY (`idNotification`) REFERENCES `Notification` (`idNotification`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Publication_ibfk_2` FOREIGN KEY (`idDestinataire`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `RelationAmitie`
--
ALTER TABLE `RelationAmitie`
  ADD CONSTRAINT `RelationAmitie_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `RelationAmitie` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RelationAmitie_ibfk_2` FOREIGN KEY (`idAmi`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RelationAmitie_ibfk_3` FOREIGN KEY (`idCategorie`) REFERENCES `CategorieAmis` (`idCategorie`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `Tchat`
--
ALTER TABLE `Tchat`
  ADD CONSTRAINT `Tchat_ibfk_1` FOREIGN KEY (`idExpediteur`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tchat_ibfk_2` FOREIGN KEY (`idDestinataire`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD CONSTRAINT `Utilisateur_ibfk_1` FOREIGN KEY (`idPhoto`) REFERENCES `Photo` (`idPhoto`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `Wink`
--
ALTER TABLE `Wink`
  ADD CONSTRAINT `Wink_ibfk_1` FOREIGN KEY (`idNotification`) REFERENCES `Notification` (`idNotification`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Wink_ibfk_2` FOREIGN KEY (`idDestinataire`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
