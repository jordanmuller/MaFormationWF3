-- Une valeur NULL se teste avec IS
-- Voir les id des livres qui n'ont pas encore été rendus
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL; -- et non = NULL;
UPDATE emprunt SET id_livre = 100 WHERE id_emprunt = 8;

-- Inverse : IS NOT
SELECT id_livre FROM emprunt WHERE date_rendu IS NOT NULL;

--# REQUETE IMBRIQUEE
-- Les titres des livres qui n'ont pas été rendus
-- Le champ en condition doit avoir le même champ mais d'une autre table en condition
SELECT titre, auteur FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);
-- Pour faire une requête imbriquée ou en jointure (voir plus bas), il faut obligatoirement un champ commun sur la requete au dessus le champ en commun est id_livre

-- LES CHAMPS COMMUNS ENTRE DEUX TABLES PEUVENT AVOIR DES NOMS DIFFERENTS MAIS DOIVENT AVOIR LES MEMES VALEURS

-- Nous aimerions connaître le numéro id_livre des livres que Chloe a emprunté à la bibliothèque
SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = "Chloe");

-- EXERCICE Afficher les prénoms des abonnés ayant emprunté un livre le 19/12/2014
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE date_sortie = "2014-12-19");

-- EXERCICE Combien de livres Guillaume a emprunté à la bibliothèque
SELECT COUNT(*) AS 'nombre de livres empruntés par Guillaume' FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'Guillaume');

-- EXERCICE Afficher les prénoms des abonnés ayant déjà emprunté un livre écrit par Alphonse Daudet
SELECT prenom FROM abonne WHERE id_abonne IN
	(SELECT id_abonne FROM emprunt WHERE id_livre IN
		(SELECT id_livre FROM livre WHERE auteur = "ALPHONSE DAUDET"));
		
-- EXERCICE Nous aimerions afficher les titres des livres que Chloe n'a pas emprunté
SELECT titre FROM livre WHERE id_livre NOT IN 
	(SELECT id_livre FROM emprunt WHERE id_abonne IN 
		(SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
		
-- Quels sont le ou les titres des livres que Chloé n'a pas encore rendu à la bibliothèque
SELECT titre FROM livre WHERE id_livre IN 
	(SELECT id_livre FROM emprunt WHERE date_rendu IS NULL AND id_abonne IN
		(SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
		
-- EXERCICE - Qui a emprunté le plus de livre à la bibliothèque
SELECT prenom FROM abonne WHERE id_abonne = 
	(SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC LIMIT 0 ,1);
	
	
--# REQUETE DE JOINTURE
--# Une requête en jointure sera possible dans tous les cas.
--# Une requête imbriquée n'est possible que si les informations que l'on récupère ne proviennent que d'une seule table

-- Nous aimerions connaître les dates de sortie et de rendu pour l'abonne Guillaume	
SELECT date_sortie, date_rendu FROM emprunt WHERE id_abonne IN 
	(SELECT id_abonne FROM abonne WHERE prenom = "Guillaume");
	
SELECT abonne.prenom, emprunt.date_sortie, emprunt.date_rendu
FROM emprunt, abonne -- On déclare les deux classes
WHERE emprunt.id_abonne = abonne.id_abonne
AND abonne.prenom = "Guillaume";		

-- On donne des alias aux tables, on doit les conserver toute la requête.
SELECT a.prenom, e.date_sortie, e.date_rendu
FROM emprunt e, abonne a -- e et a sont des alias pour aller plus vite
WHERE e.id_abonne = a.id_abonne -- On place dans les conditions les champs dont les valeurs sont égales
AND a.prenom = "Guillaume";  -- On ajoute le nom Guillaume en condition

-- Première ligne : ce que l'on veut récupérer
-- Deuxième ligne : d'où cela provient, de quelles tables nous avons besoin
-- Troisième ligne et les suivantes : la oul es conditions + les éventuels GROUP BY, ORDER BY etc...

--EXERCICE Nous aimerions connaitre les dates de sortie et date de rendu pour les livres écrits par Alphonse Daudet
-- Requête de jointure
SELECT e.date_sortie, e.date_rendu, l.auteur 
FROM emprunt e, livre l
WHERE e.id_livre = l.id_livre
AND l.auteur = "Alphonse DAUDET";

-- Requête imbriquée
SELECT date_sortie, date_rendu FROM emprunt WHERE id_livre IN
	(SELECT id_livre FROM livre WHERE auteur = "Alphonse Daudet");
	
-- EXERCICE - Qui a emprunté le livre une vie sur l'année 2014	

SELECT a.prenom, l.titre, e.date_sortie
FROM abonne a, livre l, emprunt e
WHERE a.id_abonne = e.id_abonne
AND e.id_livre = l.id_livre
AND l.titre = "une vie"
AND e.date_sortie LIKE "2014%";

-- EXERCICE nous aimerions connaître le nombre de livres empruntés par chaque abonné
SELECT a.prenom, COUNT(*) AS "nombre de livres empruntés par abonnés" 
FROM abonne a, emprunt e
WHERE a.id_abonne = e.id_abonne -- On joint les deux tables qui n'en forment plus qu'une seule
GROUP BY e.id_abonne
ORDER BY COUNT(*) DESC -- COUNT(*) ne renvoie qu'une valeur, qui sont triés ensuite, il ne compte que les id_abonne qui correspondent entre les deux tables
LIMIT 0, 1;

-- Qui a emprunté quoi et quand
SELECT a.prenom, l.titre, e.date_sortie
FROM abonne a, livre l, emprunt e
WHERE a.id_abonne = e.id_abonne
AND e.id_livre = l.id_livre;

--# S'ajouter dans la table
INSERT INTO abonne (id_abonne, prenom) VALUES (NULL, 'Jordan');

--# SI on fait la dernière requête select, la dernière insertion n'est pas présente du fait de ne pas avoir encore d'emprunt (abonne.id_abonne = emprunt.id_abonne)

--# Dans ce cas-là, afin de récupérer tout le contenu d'une table pour ensuite y joindre les informations d'une autre selon la relation entre les tables => LEFT JOIN ou RIGHT JOIN

--#Afficher les prenoms plus les id_livre qu'ils ont emprunté
SELECT abonne.prenom, emprunt.id_livre
FROM abonne, emprunt
WHERE abonne.id_abonne = emprunt.id_abonne;

SELECT abonne.prenom, emprunt.id_livre
FROM abonne
INNER JOIN emprunt ON abonne.id_abonne = emprunt.id_abonne;


--# la même requête sans correspondance exigée
SELECT a.prenom, e.id_livre
FROM abonne a -- la table abonne a la priorité
LEFT JOIN emprunt e -- la table emprunt est minoritaire
ON a.id_abonne = e.id_abonne;

SELECT a.prenom, e.id_livre
FROM emprunt e -- la table emprunt est minoritaire
RIGHT JOIN abonne a -- la table abonne a la priorité avec RIGHT JOIN
ON a.id_abonne = e.id_abonne;

INSERT INTO livre VALUES (NULL, "ALEXANDRE DUMAS", "Le Comte de Monte Cristo");

-- Afficher tous les titres et l'id abonné de ceux qui l'ont emprunté
SELECT emprunt.id_abonne, livre.titre
FROM emprunt
RIGHT JOIN livre
ON livre.id_livre = emprunt.id_livre;

SELECT livre.titre, emprunt.id_abonne 
FROM livre
LEFT JOIN emprunt
ON livre.id_livre = emprunt.id_livre;

