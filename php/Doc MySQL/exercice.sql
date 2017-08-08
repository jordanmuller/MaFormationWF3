--# EXERCICES

-- 1 - Afficher la profession de l'employe

SELECT prenom, nom, service FROM employes WHERE id_employes = 547;

-- 2 Afficher le prenom Amandine et sa date d'embauche
SELECT prenom, nom, date_embauche FROM employes WHERE prenom = "Amandine";

-- 3 Afficher le nom de famille de Guillaume
SELECT prenom, nom FROM employes WHERE prenom = "Guillaume"; 

-- 4 Afficher tous les utilisateurs dont l'id commence par 5
SELECT COUNT(*) AS 'employés commençant par un "5"' FROM employes WHERE id_employes LIKE '5%';

--5 Compter le nombre de commerciaux
SELECT COUNT(*) AS "nombre de commerciaux" FROM employes WHERE service = "commercial";

-- 6 Faire la moyenne arrondie des salaires de tous les employés
SELECT ROUND(AVG(salaire)) AS 'Salaire Moyen' FROM employes WHERE service = "informatique";

-- 7 afficher les 5 premiers employés après les avoir classés par ordre alphabétique à partir du nom
SELECT * FROM employes ORDER BY nom ASC LIMIT 0, 5;

--8 salaires des commerciaux sur une année
SELECT prenom, salaire * 12 AS "salaire annuel" FROM employes WHERE service = "commercial";
SELECT SUM(salaire*12) AS 'Masse Salariale des commerciaux' FROM employes WHERE service = "commercial"; 

--9 afficher le salaire moyen par service (service + salaire moyen)
SELECT service, AVG(salaire) AS "Salaire Moyen" FROM employes GROUP BY service;

--10 afficher le nb dfe recrutement sur l'année 2010
SELECT COUNT(*) AS "Nombre de recrutements" FROM employes WHERE date_embauche BETWEEN "2010-01-01" AND "2010-12-31";
SELECT COUNT(*) AS "Nombre de recrutements" FROM employes WHERE date_embauche LIKE "2010%";
SELECT COUNT(*) AS "Nombre de recrutements" FROM employes WHERE date_embauche >= "2010-01-01" AND date_embauche <= "2010-12-31";

--11 Afficher le salaire moyen aplliqué sur les recrutements de la période allant de 2005 à 2007
SELECT AVG(salaire) AS "Salaire Moyen de 2005 à 2007" FROM employes WHERE date_embauche BETWEEN "2005-01-01" AND "2007-12-31";

--12 Afficher le nombre de services différents
SELECT COUNT(DISTINCT service) FROM employes; -- Qu'est-ce qu'on va compter, les distinct services !

--13 Afficher tous les employés sauf ceux des services production et secrétariat
SELECT * FROM employes WHERE service != "production" AND service != "secretariat";
SELECT * FROM employes WHERE service NOT IN ('production', 'secretariat');

--14 Afficher le nombre d'hommes et de femmes sexe + nombre
SELECT sexe FROM employes;
SELECT sexe, COUNT(*) FROM employes GROUP BY sexe;

--15 afficher les commerciaux recruté avant 2005 de sexe m et gagnant > 2500
SELECT * FROM employes WHERE service = "commercial" AND (date_embauche < "2005-01-01" AND salaire > 2500 AND sexe = "m");

--16 qui a été eùmbauché en dernier 
SELECT * FROM employes ORDER BY date_embauche DESC LIMIT 1, 1;
SELECT * FROM employes WHERE date_embauche = (SELECT MAX(date_embauche) FROM employes);

--17 afficher les informations de l'employé du sevice commercial ayant le salaire le + élevé
SELECT * FROM employes WHERE service= "commercial" AND ORDER BY salaire DESC LIMIT 0, 1;
SELECT * FROM employes WHERE service= "commercial" AND salaire = (SELECT MAX(salaire) FROM employes WHERE service="commercial" ); -- Pour les requêtes imbriquées, il faut repréciser les conditions à chaque fois, dans la 1ere et la 2eme 
SELECT * FROM employes WHERE salaire = 2000 AND service = "commercial";

--18 afficher le prénom de l'employé du service informatique ayant ete embauche en 1er
SELECT * FROM employes WHERE service = "informatique" ORDER BY date_embauche LIMIT 0, 1;
SELECT prenom, service, date_embauche FROM employes WHERE service = "informatique" AND date_embauche = (SELECT MIN(date_embauche) FROM employes WHERE service = "informatique");

-- 19 Augmenter le salaire de chaque employé de 100€ 
SELECT * FROM employes;
-- On UPDATE toujours la table en entier puis on précise où avec la condition WHERE si besoin
UPDATE employes SET salaire = salaire + 100;

-- 20 supprimer les employés du service secrétariat uniquement
DELETE * FROM employes WHERE service = "secretariat";