-- Création de la database
CREATE DATABASE wf3_bibliotheque;

-- Utilisation de la db 
USE wf3_bibliotheque;

-- Déclaration des tables
CREATE TABLE abonne (
id_abonne INT(3) NOT NULL AUTO_INCREMENT,
prenom VARCHAR(255) NOT NULL,
PRIMARY KEY (id_abonne)
) ENGINE=InnoDB;

INSERT INTO abonne (id_abonne, prenom) VALUES
(1, 'Guillaume'),
(2, 'Benoit'),
(3, 'Chloe'),
(4, 'Laura');



-- On peut aussi écrire INSERT INTO emprunt VALUES (si l'on rentre des valeurs pour tous les champs)
CREATE TABLE emprunt ( 
id_emprunt INT(3) NOT NULL AUTO_INCREMENT,
id_livre INT(3) DEFAULT NULL,
id_abonne INT(3) DEFAULT NULL,
date_sortie DATE DEFAULT NULL,
date_rendu DATE DEFAULT NULL,
PRIMARY KEY (id_emprunt)
) ENGINE=InnoDB;

INSERT INTO emprunt (id_emprunt, id_livre, id_abonne, date_sortie, date_rendu) VALUES
(1, 100, 1, '2014-12-17', '2014-12-18'),
(2, 101, 2, '2014-12-18', '2014-12-20'),
(3, 100, 3, '2014-12-19', '2014-12-22'),
(4, 103, 4, '2014-12-19', '2014-12-22'),
(5, 104, 1, '2014-12-19', '2014-12-28'),
(6, 105, 2, '2015-03-20', '2015-03-26'),
(7, 105, 3, '2015-06-13', NULL),
(8, 105, 2, '2015-06-15', NULL);

CREATE TABLE livre (
id_livre INT(3) NOT NULL AUTO_INCREMENT,
auteur VARCHAR(255) NOT NULL,
titre VARCHAR(255) NOT NULL,
PRIMARY KEY (id_livre)
) ENGINE=InnoDB;

-- On peut aussi écrire INSERT INTO livre VALUES
INSERT INTO livre (id_livre, auteur, titre) VALUES
(100, 'GUY DE MAUPASSANT', 'Une vie'),
(101, 'GUY DE MAUPASSANT', 'Bel-Ami'),
(102, 'HONORE DE BALZAC', 'Le pere Goriot'),
(103, 'ALPHONSE DAUDET', 'Le Petit chose'),
(104, 'ALEXANDRE DUMAS', 'La Reine Margot'),
(105, 'ALEXANDRE DUMAS', 'Les Trois Mousquetaires');