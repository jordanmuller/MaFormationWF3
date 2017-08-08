--# EXERCICES
-- 01 - Afficher la profession de l'employe ayant l'identifiant 547
SELECT id_employes, service FROM employes WHERE id_employes = 547;
+-------------+------------+
| id_employes | service    |
+-------------+------------+
|         547 | commercial |
+-------------+------------+
-- 02 - Afficher la date d'embauche d'Amandine
SELECT date_embauche, prenom FROM employes WHERE prenom = 'amandine';
+---------------+----------+
| date_embauche | prenom   |
+---------------+----------+
| 2010-01-23    | Amandine |
+---------------+----------+
-- 03 - Afficher le nom de famille de Guillaume
SELECT nom, prenom FROM employes WHERE prenom = 'Guillaume';
+--------+-----------+
| nom    | prenom    |
+--------+-----------+
| Miller | Guillaume |
+--------+-----------+
-- 04 - Afficher le nombre d'employes ayant un identifiant commençant par le chiffre 5
SELECT COUNT(*) AS 'nombre d\'employes ayant un id commençant par 5' FROM employes WHERE id_employes LIKE '5%';
+------------------------------------------------+
| nombre demployes ayant un id commençant par 5  |
+------------------------------------------------+
|                                              3 |
+------------------------------------------------+
-- 05 - Afficher le nombre de commerciaux
SELECT COUNT(*) As 'Nombre de commerciaux' FROM employes WHERE service = 'commercial';
+-----------------------+
| Nombre de commerciaux |
+-----------------------+
|                     6 |
+-----------------------+
-- 06 - Afficher le salaire moyen des informaticiens (arrondi en entier)
SELECT ROUND(AVG(salaire)) AS 'Salaire moyen des informaticiens' FROM employes WHERE service = 'informatique';
+----------------------------------+
| Salaire moyen des informaticiens |
+----------------------------------+
|                             2242 |
+----------------------------------+
-- 07 - Afficher les 5 premiers employes après les avoir classé par ordre alphabetique du nom
SELECT * FROM employes ORDER BY nom ASC LIMIT 0, 5;
+-------------+---------+----------+------+--------------+---------------+---------+
| id_employes | prenom  | nom      | sexe | service      | date_embauche | salaire |
+-------------+---------+----------+------+--------------+---------------+---------+
|         592 | Laura   | Blanchet | f    | direction    | 2005-06-09    |    4500 |
|         854 | Daniel  | Chevel   | m    | informatique | 2011-09-28    |    1700 |
|         547 | Melanie | Collier  | f    | commercial   | 2004-09-08    |    3100 |
|         699 | Julien  | Cottet   | m    | secretariat  | 2007-01-18    |    1390 |
|         739 | Thierry | Desprez  | m    | secretariat  | 2009-11-17    |    1500 |
+-------------+---------+----------+------+--------------+---------------+---------+
-- 08 - Afficher le coût des commerciaux sur une année
SELECT SUM(salaire*12) FROM employes WHERE service = 'commercial';
+-----------------+
| SUM(salaire*12) |
+-----------------+
|          184200 |
+-----------------+
-- 09 - Afficher le salaire moyen par service (service + salaire moyen)
SELECT service, ROUND(AVG(salaire)) as 'Salaire moyen' FROM employes GROUP BY service;
+---------------+---------------+
| service       | Salaire moyen |
+---------------+---------------+
| assistant     |          1775 |
| commercial    |          2558 |
| communication |          1500 |
| comptabilite  |          1900 |
| direction     |          4750 |
| informatique  |          2242 |
| juridique     |          3200 |
| production    |          2225 |
| secretariat   |          1497 |
+---------------+---------------+
-- 10 - Afficher le nombre de recrutement sur l'année 2010 (avec un alias si possible)
SELECT COUNT(*) AS 'Nombre de recrutement en 2010' FROM employes WHERE date_embauche LIKE '2010%';
SELECT COUNT(*) AS 'Nombre de recrutement en 2010' FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2010-12-31';
SELECT COUNT(*) AS 'Nombre de recrutement en 2010' FROM employes WHERE date_embauche  >= '2010-01-01' AND date_embauche <= '2010-12-31';

-- 11 - Afficher le salaire moyen appliqué sur les recrutements de la période allant de 2005 à 2007
SELECT ROUND(AVG(salaire)) FROM employes WHERE date_embauche BETWEEN '2005-01-01' AND '2007-12-31';
+---------------------+
| ROUND(AVG(salaire)) |
+---------------------+
|                2623 |
+---------------------+
-- 12 - Afficher le nombre de service différent
SELECT COUNT(DISTINCT service) AS 'Nombre de service' FROM employes;
+-------------------+
| Nombre de service |
+-------------------+
|                 9 |
+-------------------+
-- 13 - Afficher tous les employes sauf ceux des services production et secretariat
SELECT nom, prenom, service FROM employes WHERE service NOT IN ('production', 'secretariat');
SELECT nom, prenom, service FROM employes WHERE service != 'production' AND service != 'secretariat';
+----------+-------------+---------------+
| nom      | prenom      | service       |
+----------+-------------+---------------+
| Quittard | Mathieu     | informatique  |
| Laborde  | Jean-pierre | direction     |
| Gallet   | Clement     | commercial    |
| Winter   | Thomas      | commercial    |
| Grand    | Fabrice     | comptabilite  |
| Collier  | Melanie     | commercial    |
| Blanchet | Laura       | direction     |
| Miller   | Guillaume   | commercial    |
| Perrin   | Celine      | commercial    |
| Vignal   | Mathieu     | informatique  |
| Thoyer   | Amandine    | communication |
| Durand   | Damien      | informatique  |
| Chevel   | Daniel      | informatique  |
| Martin   | Nathalie    | juridique     |
| Sennard  | Emilie      | commercial    |
| Lafaye   | Stephanie   | assistant     |
| Quittard | Mathieu     | informatique  |
| Quittard | Mathieu     | informatique  |
+----------+-------------+---------------+
-- 14 - Afficher le nombre d'homme et de femme (sexe + nombre)
SELECT sexe, COUNT(*) AS 'nombre' FROM employes GROUP BY sexe;
+------+--------+
| sexe | nombre |
+------+--------+
| m    |     14 |
| f    |      9 |
+------+--------+
-- 15 - Afficher les commerciaux ayant été recruté avant 2005 de sexe masculin et gagnant un salaire supérieur à 2500
SELECT * FROM employes WHERE service = 'commercial' AND date_embauche < '2005-01-01' AND sexe= 'm' AND salaire > 2500;
+-------------+--------+--------+------+------------+---------------+---------+
| id_employes | prenom | nom    | sexe | service    | date_embauche | salaire |
+-------------+--------+--------+------+------------+---------------+---------+
|         415 | Thomas | Winter | m    | commercial | 2000-05-03    |    3550 |
+-------------+--------+--------+------+------------+---------------+---------+
-- 16 - Qui a été embauché en dernier
SELECT nom, prenom, date_embauche FROM employes ORDER BY date_embauche DESC LIMIT 0, 1;
+----------+---------+---------------+
| nom      | prenom  | date_embauche |
+----------+---------+---------------+
| Quittard | Mathieu | 2017-06-14    |
+----------+---------+---------------+
SELECT * FROM  employes WHERE date_embauche = (SELECT MAX(date_embauche) FROM employes);
+-------------+---------+----------+------+--------------+---------------+---------+
| id_employes | prenom  | nom      | sexe | service      | date_embauche | salaire |
+-------------+---------+----------+------+--------------+---------------+---------+
|           1 | Mathieu | Quittard | m    | informatique | 2017-06-14    |    2500 |
|         991 | Mathieu | Quittard | m    | informatique | 2017-06-14    |    2500 |
|         994 | Mathieu | Quittard | m    | informatique | 2017-06-14    |    2500 |
+-------------+---------+----------+------+--------------+---------------+---------+
-- 17 - Afficher les informations de l'employé du service commercial ayant le salaire le plus elevé
SELECT * FROM employes WHERE service = 'commercial' ORDER BY salaire DESC LIMIT 0, 1;
+-------------+--------+--------+------+------------+---------------+---------+
| id_employes | prenom | nom    | sexe | service    | date_embauche | salaire |
+-------------+--------+--------+------+------------+---------------+---------+
|         415 | Thomas | Winter | m    | commercial | 2000-05-03    |    3550 |
+-------------+--------+--------+------+------------+---------------+---------+
SELECT * FROM employes WHERE service = 'commercial' AND salaire = (SELECT MAX(salaire) FROM employes WHERE service = 'commercial');
SELECT * FROM employes WHERE salaire = (SELECT MAX(salaire) FROM employes WHERE service = 'commercial') AND service = 'commercial';
-- 18 - Afficher le prénom de l'employe du service informatique ayant ete embauche en premier
SELECT prenom, date_embauche, service FROM employes WHERE service = 'informatique' ORDER BY date_embauche LIMIT 0, 1;
+---------+---------------+--------------+
| prenom  | date_embauche | service      |
+---------+---------------+--------------+
| Mathieu | 2008-12-03    | informatique |
+---------+---------------+--------------+
-- 19 - Augmenter le salaire de chaque employé de 100€
UPDATE employes SET salaire = salaire + 100;
-- 20 - Supprimer les employes du service secretariat uniquement.
DELETE FROM employes WHERE service = 'secretariat';









