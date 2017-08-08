-- Ceci est un commentaire sur une ligne

-- Pour créer une base de données, par convention les mots-clés sont écrits en majuscules
CREATE DATABASE wf3_entreprise;

-- Pour voir toutes les BDD sur le serveur, le S de DATABASES est obligatoire
SHOW DATABASES;

-- Pour utiliser une DB
USE nom_de_la_bdd
USE wf3_entreprise;

-- Pour effacer une DB
DROP DATABASE nom_de_la_bdd;

-- Pour effacer une table
DROP TABLE nom_de_la_table;

-- Pour vider une table sans l'effacer
TRUNCATE nom_de_la_table;

-- Pour afficher une table, au pluriel également
SHOW TABLES;

-- Pour observer la structure d'une table
DESC nom_de_la_table;

--# REQUETES SELECTION (les plus nombreuses, question que l'on pose)

-- Récupération des données de la table employes
SELECT id_employes, nom, prenom, sexe, service, date_embauche, salaire FROM employes;

-- Il est possible d'afficher tout le contenu d'une liste avec le caractère universel *, tout est sorti dans l'ordre de la table
SELECT * FROM employes;

-- Uniquement les prénoms et les noms
SELECT prenom, nom FROM employes;	

-- Afficher tous les services
SELECT service FROM employes;

-- Idem mais sans répétition
SELECT DISTINCT service FROM employes;

-- affichage des ifos des employes du service informatique, informatique ici est une valeur et doit être "", à l'inverse des champs: nom, service, qui s'écrivent sans ""
SELECT nom, prenom, service FROM employes WHERE service = "informatique";

-- BETWEEN
-- Afficher les employes ayant été recrutés entre 2010 et aujourd'hui
-- WHERE signifie à condition, BETWEEN est toujours suivi de AND, ENTRE ceci ET celà
SELECT * FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2017-06-14';

-- La date du jour, toujours sous format américian sous MySQL
SELECT CURDATE();

-- LIKE 
-- affichage des employes avec un prenom dont la première lettre commence par s, le % permet de limiter la recherche au s et uniquement le "s"
SELECT prenom FROM employes WHERE prenom LIKE 's%';

-- prenom finissant par "ie"
SELECT prenom FROM employes WHERE prenom LIKE '%ie';

-- prenom contenant un trait d'union, dans ce cas-là, les caractères entre les % peut se trouver n'importe où dans le prenom
SELECT prenom FROM employes WHERE prenom LIKE '%-%';

-- La liste des employes avec un salaire supérieur à 3000, ne pas mettre le nombre entre '' car MySQL réinterprète la valeur et perd de la performance
SELECT nom, prenom, service, salaire FROM employes WHERE salaire > 3000;

-- Opérateurs de comparaison > ... < ... = ... != ... >= ... <=

-- Pour récupérer les infos avec un ordre, ASC ascendant en anglais, est par défaut
SELECT prenom FROM employes ORDER BY prenom ASC;
SELECT prenom FROM employes ORDER BY prenom;

-- L'inverse, DESC pour descendant, à ne pas confondre avec DESC description
SELECT prenom FROM employes ORDER BY prenom DESC; 
SELECT prenom, salaire FROM employes ORDER BY salaire DESC;

-- pour un deuxième classement 
SELECT prenom, salaire FROM employes ORDER BY salaire ASC, prenom ASC;

-- ASC par défaut
SELECT prenom, salaire FROM employes ORDER BY salaire, prenom;

-- LIMIT
-- Affichage des employés 3 par 3 (pagination)
SELECT prenom, nom FROM employes ORDER BY prenom ASC LIMIT 0, 3; 
SELECT prenom, nom FROM employes LIMIT 3, 3; 
SELECT prenom, nom FROM employes LIMIT 6, 3; 
-- Avec LIMIT, la 1ère valeur est la position de départ et la 2ème représente le nombre de lignes à renvoyer

-- Le salaire annuel des employes
SELECT prenom, salaire * 12 FROM employes;

-- On réécrit le nom du champ avec AS 'nom du champ', '' car il y ades espaces
--AS -> Alias
SELECT prenom, salaire * 12 AS 'salaire annuel' FROM employes;

-- SUM(), c'est une valeur unique, on ne sélectionne rien d'autre
SELECT SUM(salaire*12) AS 'Masse Salariale' FROM employes; 

-- AVG() jamais d'espace avant () sinon MySQL n'interprète pas
SELECT AVG(salaire) AS 'Salaire Moyen' FROM employes;

-- arrondi avec ROUND() On place une fonction AVG() dans la fonction ROUND()
SELECT ROUND(AVG(salaire)) AS 'Salaire Moyen' FROM employes;

-- Pour arrondir au centième, on place une valeur après la première dans la fonction ROUND(), séparée par une ","
SELECT ROUND(AVG(salaire), 2) AS 'Salaire Moyen' FROM employes;

-- 	COUNT() va compter le nombre de lignes
-- Affichage du nombre de femmes dans la table employes, on place le '*' dans COUNT() pour qu'il passe en revue toutes les rangées. IL FAUT PRIVILEGIER LE *
SELECT COUNT(*) AS 'Nombre de femmes' FROM employes WHERE sexe='f';

-- MIN()
SELECT MIN(salaire) FROM employes;

-- MAX
SELECT MAX(salaire) FROM employes;

SELECT nom, prenom, salaire FROM employes ORDER BY salaire LIMIT 0, 1;

-- Afficher le nom, prenom de l'employé ayant le salaire le plus petit
-- /!\ la requête est fausse
SELECT nom, prenom, MIN(salaire) FROM employes;
-- En effet, le MIN() bloque la requête car elle ne peut renvoyer qu'une seule ligne Du coup on récupère le premier nom, prenom de la table et le salaire minimum qui ne correspond pas forcément au premier nom, prenom 

-- Dans ce cas précis où l'on ne cherche qu'une valeur, nous pouvons utiliser ORDER BY avec LIMIT
SELECT nom, prenom, salaire FROM employes ORDER BY salaire ASC LIMIT 0, 1;

--+--------+--------+---------+
--| nom    | prenom | salaire |
--+--------+--------+---------+
--| Cottet | Julien |    1390 |
--+--------+--------+---------+

-- Autre solution avec une requête imbriquée, à condition que WHERE salaire = (2eme requete)
SELECT nom, prenom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes); -- le "=" ne renvoie qu'une seule valeur

-- IN renvoie plusieurs valeurs -- inclusion
-- /!\ requête fausse
SELECT nom, prenom, service FROM employes WHERE service = 'informatique', "comptabilité";

SELECT nom, prenom, service FROM employes WHERE service IN ('informatique', "comptabilité"); 
-- IN permet de faire une comparaison sur plusieurs valeurs
-- avec = comparaison  sur une seule valeur

-- NOT IN -- exclusion
SELECT nom, prenom, service FROM employes WHERE service NOT IN ('informatique', 'comptabilité');
-- NOT IN : plusieurs valeurs
-- != : une seule valeur

SELECT nom, prenom, service FROM employes WHERE service NOT IN ('informatique', 'comptabilité') ORDER BY service;

-- REQUETE avec plusieurs conditions, on place AND après WHERE, on peut en rajouter à loisir
SELECT * FROM employes WHERE service = 'commercial' AND salaire <= 2000;

-- /!\ requête fausse, il faut mettre des parenthèses, le OR crée une incohérence. La dernière condition ne se retrouve pas lié au service "production"
SELECT * FROM employes WHERE service = "production" AND salaire = 1900 OR salaire = 2300;

-- Les employes du service production ayant un salaire de 1900 ou 2300
SELECT * FROM employes WHERE service = "production" AND (salaire = 1900 OR salaire = 2300);

-- GROUP BY
-- le nombre d'employés par service
SELECT service, COUNT(*) FROM employes GROUP BY service;

-- Pour mettre une ou des conditions avec un group by
-- HAVING
-- Le nompbre d'employés (de lignes avec COUNT()) par service 
-- Même requête qu'au dessus avec une condition si la valeur du COUNT(*) est supérieur à 2
SELECT service, COUNT(*) FROM employes GROUP BY service HAVING COUNT(*) > 2;

-- Le nombre d'employés femme par service
SELECT service, COUNT(*) FROM employes WHERE sexe = "f" GROUP BY service;

-- GROUP BY permet de regrouper des informations
-- HAVING permet de mettre une condition sur le GROUP BY

--# REQUETE INSERTION (enregistrement)
INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (NULL, 'Jordan', 'Muller', 'm', 'informatique', '2017-06-14', 2500);

-- Si nous donnons tous les champs dans le même ordre que la table, il n'est pas nécessaire de préciser ces champs
INSERT INTO employes VALUES (NULL, 'Jordan', 'Muller', 'm', 'informatique', '2017-06-14', 2500);
SELECT * FROM employes;

-- Si l'on fait une insertion sans remplir tous les champs, nous sommes obligés de précviser ces champs
INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES ('Jordan', 'Muller', 'm', 'informatique', '2017-06-14', 2500); -- On a supprimé la valeur de l'id_employes


--# REQUETE UPDATE (modification)
UPDATE employes SET salaire = 1391 WHERE id_employes = 699; -- On conditionne avec l'id (la clé primaire) car il est unique, il faut toujours que le champ soit unique.
-- Pour une modification d'une entrée précise, il faut privilégier la condition sur la clé primaire de la table (ici id_employes)

UPDATE employes SET salaire = 1391, service = 'informatique' WHERE id_employes = 699;


--# REQUETE DELETE (suppression)
SELECT * FROM employes;
DELETE FROM employes WHERE id_employes = 992;
SELECT * FROM employes;

DELETE FROM employes WHERE id_employes = 992 AND service = "informatique";

DELETE FROM employes; -- equivalent à un TRUNCATE employes, on supprime les données mais on garde la structure;
DROP TABLE employes; -- on efface les données et la structure

-- Affiche la date actuelle
SELECT CURDATE();

-- Affiche la date et l'heure actuelles
SELECT NOW();





