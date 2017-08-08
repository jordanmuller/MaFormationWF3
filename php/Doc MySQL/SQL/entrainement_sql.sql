-- Ceci est un commentaire sur une ligne

-- Pour créer une base de données
CREATE DATABASE wf3_entreprise;

-- Pour voir toute les BDD sur le serveur
SHOW DATABASES;

-- Pour utiliser une BDD
USE nom_de_la_bdd;
USE wf3_entreprise;

-- Pour effacer une BDD
DROP DATABASE nom_de_la_bdd;

-- Pour effacer une table
DROP TABLE nom_de_la_table;

-- Pour vider une table sans l'effacer
TRUNCATE nom_de_la_table;

-- Pour observer la structure d'une table
DESC nom_de_la_table;



--# REQUETES SELECTION (question) -------------------

-- récupération de toutes les données de la table employes
SELECT id_employes, nom, prenom, sexe, service, date_embauche, salaire  FROM employes;

-- il est possible d'afficher tout le contenu d'une table avec le caractère universel * (ALL)
SELECT * FROM employes;

-- uniquement les prenoms et les noms
SELECT prenom, nom FROM employes;

-- Afficher tous les services
SELECT service FROM employes;
-- idem mais sans répétition
SELECT DISTINCT service FROM employes;

-- affichage des infos des employes du service informatique
SELECT nom, prenom, service FROM employes WHERE service = 'informatique';

-- BETWEEN
-- afficher les employes ayant été recruté entre 2010 et aujourd'hui
SELECT * FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2017-06-14';

-- la date du jour
SELECT CURDATE();
SELECT * FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND CURDATE();

-- LIKE
-- affichage des employes avec un prenom dont la première lettre commence par s
SELECT prenom FROM employes WHERE prenom LIKE 's%';
-- prenom finissant par 'ie'
SELECT prenom FROM employes WHERE prenom LIKE '%ie';
-- prenom contenant un trait d'union
SELECT prenom FROM employes WHERE prenom LIKE '%-%';

-- la liste des employes avec un salaire supérieur à 3000
SELECT nom, prenom, service, salaire FROM employes WHERE salaire > 3000;
-- opérateurs de comparaison  > ... < ... = ... != ... >= ... <=

-- Pour récupérer les infos avec un ordre
SELECT prenom FROM employes ORDER BY prenom ASC; -- ASC ascendant => valeur par defaut
SELECT prenom FROM employes ORDER BY prenom; -- ASC ascendant => valeur par defaut
-- l'inverse
SELECT prenom FROM employes ORDER BY prenom DESC; -- DESC descendant 

SELECT prenom, salaire FROM employes ORDER BY salaire ASC;
-- pour un deuxième classement
SELECT prenom, salaire FROM employes ORDER BY salaire ASC, prenom ASC;

-- LIMIT 
-- affichage des employes 3 par 3
SELECT prenom, nom FROM employes LIMIT 0, 3;
SELECT prenom, nom FROM employes LIMIT 3,3;
SELECT prenom, nom FROM employes LIMIT 6, 3;
-- avec limit la première valeur est la position de départ et la deuxième valeur représente le nombre de ligne à récupérer.

-- le salaire annuel des employes
SELECT prenom, salaire * 12 FROM employes;
SELECT prenom, salaire * 12 AS 'Salaire annuel' FROM employes;
-- AS => Alias

-- SUM()
-- la masse salariale
SELECT SUM(salaire*12) AS 'Masse salariale' FROM employes;

-- AVG() -- moyenne
-- le salaire moyen
SELECT AVG(salaire) AS 'Salaire moyen' FROM employes;
-- ROUND() -- arrondi
SELECT ROUND(AVG(salaire)) AS 'Salaire moyen' FROM employes;
-- avec deux décimales
SELECT ROUND(AVG(salaire), 2) AS 'Salaire moyen' FROM employes;

-- COUNT() 
-- affichage du nombre de femme dans la table employes
SELECT COUNT(*) AS 'Nombre de femme' FROM employes WHERE sexe = 'f';

-- MIN()
SELECT MIN(salaire) FROM employes;
-- MAX()
SELECT MAX(salaire) FROM employes;

-- afficher le nom, prenom de l'employes ayant le salaire le plus petit.
-- /!\ la requete suivante est FAUSSE
SELECT nom, prenom, MIN(salaire) FROM employes;
-- en effet, le MIN() bloque la requete car MIN() ne peut renvoyer qu'une seule ligne. Du coup on récupère le premier nom, prenom de la table et le salaire minimum qui ne correspond pas forcément au nom, prénom.
-- Pour avoir la bonne information, dans ce cas précis nous pouvons utiliser ORDER BY avec LIMIT
SELECT nom, prenom, salaire FROM employes ORDER BY salaire ASC LIMIT 0, 1;
--+--------+--------+---------+
--| nom    | prenom | salaire |
--+--------+--------+---------+
--| Cottet | Julien |    1390 |
--+--------+--------+---------+

-- requete imbriquée
SELECT nom, prenom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes);

-- IN -- inclusion
SELECT nom, prenom, service FROM employes WHERE service IN ('informatique', 'comptabilite');
-- IN permet de faire une comparaison sur plusieurs valeurs
-- avec = comparaison sur une seule valeur

-- NOT IN -- exclusion
SELECT nom, prenom, service, salaire FROM employes WHERE service NOT IN ('informatique', 'comptabilite') ORDER BY salaire;
-- NOT IN (plusieurs valeurs)
-- != (une seule valeur)

-- REQUETE avec plusieurs conditions
-- les employes du service commercial gagnat moins de 2000€
SELECT * FROM employes WHERE service = "commercial" AND salaire <= 2000;

-- les employes d u service production ayant un salaire de 1900 ou 2300
SELECT * FROM employes WHERE service = 'production' AND salaire = 1900 OR salaire = 2300;
-- /!\ attention la requete au dessus est fausse. sans les parenthèse, le OR crée une incohérence. La derniere condition ne se retrouve pas lié au service = 'production'
-- pour éviter, il faut mettre les parenthèse.
SELECT * FROM employes WHERE service = 'production' AND (salaire = 1900 OR salaire = 2300);

-- GROUP BY
-- le nombre d'employes par service
SELECT service, COUNT(*) FROM employes GROUP BY service; 

-- pour mettre une ou des conditions avec un group by
-- HAVING
-- meme requete qu'au dessus avec une condition si la valeur du COUNT(*) est supérieure à 2
SELECT service, COUNT(*) FROM employes GROUP BY service HAVING COUNT(*) > 2; 
-- le nombre d'employe (femme uniquement) par service
SELECT service, COUNT(*) FROM employes WHERE sexe="f" GROUP BY service;

-- GROUP BY permet de regrouper des informations
-- HAVING permet de mettre une condition sur le GROUP BY

--# REQUETE INSERTION (enregistrement)
INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (NULL, 'Mathieu', "Quittard", "m", "informatique", "2017-06-14", 2500);
SELECT * FROM employes;

-- si nous donnons tous les champs dans le même ordre que la table, il n'est pas nécessaire de préciser les champs.
INSERT INTO employes VALUES (NULL, 'Mathieu', "Quittard", "m", "informatique", "2017-06-14", 2500);
SELECT * FROM employes;

-- si l'on fait une insertion sans remplir tous les champs nous sommes obligé de préciser les champs
INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('Mathieu', "Quittard", "m", "informatique", "2017-06-14", 2500);
SELECT * FROM employes;


--# REQUETE UPDATE (modification)
UPDATE employes SET salaire = 1391 WHERE id_employes = 699;
-- pour une modification d'une entrée précise, il faut privilégier la condition sur la clé primaire de la table (ici id_employes)
UPDATE employes SET salaire = 1392, service = "informatique" WHERE id_employes = 699;


--# REQUETE DELETE (suppression)
SELECT * FROM employes;
DELETE FROM employes WHERE id_employes = 993;
SELECT * FROM employes;

DELETE FROM employes WHERE id_employes = 992 AND service = 'informatique';

DELETE FROM employes; -- equivalent à un TRUNCATE employes;






