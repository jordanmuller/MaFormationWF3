-- Une valeur NULL se test avec IS
-- Voir les id des livres qui n'ont pas encore été rendu 
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;
-- inverse => IS NOT
SELECT id_livre FROM emprunt WHERE date_rendu IS NOT NULL;

--# REQUETE IMBRIQUEE
-- Les titres des livres qui n'ont pas été rendu
SELECT titre FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);
-- pour faire une requete imbriquée ou en jointure (voir plus bas) il faut obligatoirement un champ commun. Sur la requete au dessus le champ en commun est id_livre.


-- Nous aimerions connaitre le n° (id) des livres que Chloe a emprunté à la bibliotheque.
SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'chloe');

-- EXERCICE - Afficher les prénoms des abonnés ayant emprunté un livre le 19/12/2014
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE date_sortie = '2014-12-19');

-- EXERCICE - Combien de livre Guillaume a emprunté à la bibliotheque.
SELECT COUNT(*) AS 'Emprunts Guillaume' FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom ="guillaume");

-- EXERCICE - Afficher les prénoms des abonnés ayant déjà emprunté un livre écrit par Alphonse Daudet
SELECT prenom FROM abonne WHERE id_abonne IN 
	(SELECT id_abonne FROM emprunt WHERE id_livre IN 
		(SELECT id_livre FROM livre WHERE auteur = 'alphonse daudet'));

-- EXERCICE - Nous aimerions maintenant connaitre les titres des livres que Chloe n'a pas encore emprunté
SELECT titre FROM livre WHERE id_livre NOT IN (SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'chloe'));

-- EXERCICE - Quels sont le ou les titres des livres que Chloe n'a pas encore rendu à la bibliotheque
SELECT titre FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL AND id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'chloe'));

-- EXERCICE - Qui a emprunté le plus de livre à la bibliotheque
-- GROUP BY / ORDER BY / LIMIT / COUNT
-- SELECT prenom 


--# REQUETE EN JOINTURE
--# Une requete en jointure sera possible dans tous les cas.
--# Une requete imbriquée n'est possible que si les informations que l'on récupère ne proviennent que d'une seule table.

-- Nous aimerions connaitre les dates de sortie et les dates de rendu pour l'abonne guillaume 
SELECT abonne.prenom, emprunt.date_sortie, emprunt.date_rendu 
FROM emprunt, abonne 
WHERE emprunt.id_abonne = abonne.id_abonne 
AND abonne.prenom = 'Guillaume';

SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e, abonne a 
WHERE e.id_abonne = a.id_abonne 
AND a.prenom = 'Guillaume';

-- premiere ligne => ce que l'on veut récupérer
-- deuxieme ligne => de quelle tables avons nous besoin
-- troisieme ligne et les suivantes => la ou les conditons + les eventuels GROUP BY / ORDER BY / etc...

-- EXERCICE - Nous aimerions connaitres les dates de sortie et dates de rendu pour les livres écrits par alphonse daudet.
SELECT emprunt.date_sortie, emprunt.date_rendu 
FROM emprunt, livre 
WHERE livre.auteur = 'alphonse daudet' 
AND livre.id_livre = emprunt.id_livre;
-------------------------------
-- | date_sortie | date_rendu |
-------------------------------
-- | 2014-12-19  | 2014-12-22 |
-------------------------------

-- EXERCICE -  Qui a emprunté le livre une vie sur l'année 2014
SELECT abonne.prenom, emprunt.date_sortie 
FROM abonne, emprunt, livre 
WHERE livre.titre = 'une vie' 
AND livre.id_livre = emprunt.id_livre 
AND emprunt.date_sortie LIKE '2014%' 
AND abonne.id_abonne = emprunt.id_abonne;

-- EXERCICE - nous aimerions connaitre le nombre de livre(s) emprunté par chaque abonné
SELECT a.prenom, COUNT(e.id_emprunt) AS 'nb de livre emprunté' 
FROM abonne a, emprunt e 
WHERE a.id_abonne = e.id_abonne 
GROUP BY e.id_abonne
ORDER BY COUNT(e.id_emprunt) DESC;

SELECT a.prenom, COUNT(*) AS 'nb de livre emprunté' 
FROM abonne a, emprunt e 
WHERE a.id_abonne = e.id_abonne 
GROUP BY e.id_abonne
ORDER BY COUNT(*) DESC;

-- EXERCICE - Qui a emprunté Quoi et Quand
SELECT abonne.prenom, emprunt.date_sortie, emprunt.date_rendu, livre.titre, livre.auteur 
FROM abonne, livre, emprunt 
WHERE abonne.id_abonne = emprunt.id_abonne 
AND livre.id_livre = emprunt.id_livre; 

--# Ajoutez vous dans la table
INSERT INTO abonne (id_abonne, prenom) VALUES (NULL, 'Mathieu');

--# Si on fait la derniere requete select, la derniere insertion n'est pas presente du fait de ne pas avoir encore d'emprunt. (abonne.id_abonne = emprunt.id_abonne)

--# Dans ce cas, afin de récupérer tout le contenu d'une table pour ensuite y joindre les informations d'une autre selon la relation entre les tables => LEFT JOIN ou RIGHT JOIN

--# afficher les prenom plus les id_livre qu'ils ont emprunté
SELECT abonne.prenom, emprunt.id_livre 
FROM abonne, emprunt 
WHERE abonne.id_abonne = emprunt.id_abonne;


SELECT abonne.prenom, emprunt.id_livre 
FROM abonne 
INNER JOIN emprunt ON abonne.id_abonne = emprunt.id_abonne;



--# la meme requete sans correspondance exigée
SELECT a.prenom, e.id_livre 
FROM abonne a
LEFT JOIN emprunt e ON a.id_abonne = e.id_abonne;

SELECT abonne.prenom, emprunt.id_livre FROM abonne LEFT JOIN emprunt ON abonne.id_abonne = emprunt.id_abonne;

SELECT abonne.prenom, emprunt.id_livre 
FROM emprunt 
RIGHT JOIN abonne ON abonne.id_abonne = emprunt.id_abonne;


--# Afficher tous les titres (sans exception) et joindre les id_abonne si le livre a deja ete emprunté
SELECT livre.titre, emprunt.id_abonne FROM livre LEFT JOIN emprunt ON livre.id_livre = emprunt.id_livre;
SELECT livre.titre, emprunt.id_abonne FROM emprunt RIGHT JOIN livre ON livre.id_livre = emprunt.id_livre;



 










