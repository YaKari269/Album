CREATE TABLE `utilisateur`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(255) NOT NULL,
	`nom` VARCHAR(255) NOT NULL,
	`prenom` VARCHAR(255) NOT NULL,
	`login` VARCHAR(255) NOT NULL,
	`mdp` VARCHAR(255) NOT NULL,
	PRIMARY KEY(`id`)
);

INSERT INTO `utilisateur` (`id`, `email`, `nom`, `prenom`, `login`, `mdp`) VALUES
(NULL, 'aikari@laposte.net', 'KARI', 'Aichah', 'admin', 'admin');

CREATE TABLE `album`(
	`idAlbum` int(11) NOT NULL AUTO_INCREMENT,
	`nom_image` VARCHAR(255) NOT NULL,
	`imageP` VARCHAR(50) NOT NULL,
	`description` VARCHAR(50) NOT NULL,
	`utilisateur_id`  int(11) NOT NULL,
	PRIMARY KEY(`idAlbum`),
	FOREIGN KEY(`utilisateur_id`) REFERENCES utilisateur(id)
);

INSERT INTO `album` (`idAlbum`, `nom_image`, `imageP`, `description`, `utilisateur_id`) VALUES
(2, 'Bouquet mixte', 'bouquetmixte.jpg', 'Un jolie bouquet mixte', 1),
(1, 'Fleur blanche pour l''accueil', 'accueilblanc.jpg', 'Des fleurs blanches', 1);

CREATE TABLE `photo`(
	`idPhoto` int(11) NOT NULL AUTO_INCREMENT,
	`nom` VARCHAR(255) NOT NULL,
	`description` VARCHAR(50) NOT NULL,
	PRIMARY KEY(`idPhoto`)
);

CREATE TABLE `stocker`(
	`stocker` int(11) NOT NULL,
	`albums_id`  int(11) NOT NULL,
	`photos_id` int(11) NOT NULL,
	PRIMARY KEY(`stocker`,`albums_id`,`photos_id`),
	FOREIGN KEY(`albums_id`) REFERENCES album(idAlbum),
	FOREIGN KEY(`photos_id`) REFERENCES photo(idPhoto)
	
);



