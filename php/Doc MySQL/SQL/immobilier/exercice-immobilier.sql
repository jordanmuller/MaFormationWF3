-- 1
SELECT nom
FROM agence;

-- 2 
SELECT idAgence
FROM agence
WHERE nom = "Orpi";

-- 3 
SELECT *
FROM logement
ORDER BY idLogement ASC
LIMIT 0, 1;

-- 4 Il y a 28 logements
SELECT COUNT(*) AS "Nombre de logements"
FROM logement;

-- 5 Erreur avec l'�nonc�
SELECT *
FROM logement
WHERE prix < 150000
AND categorie = "vente"
ORDER BY prix ASC;

-- 6 
SELECT COUNT(*) AS "nb"
FROM logement
WHERE categorie = "location";

-- 7 
SELECT DISTINCT ville
FROM demande;

-- 8
SELECT ville, COUNT(*) AS "nombre de logements � vendre"
FROM logement
WHERE categorie = "vente"
GROUP BY ville;

-- 9
SELECT idLogement
FROM logement
WHERE categorie = "location";

-- 10
SELECT idLogement
FROM logement
WHERE superficie >= 20
AND superficie <= 30;

-- 11 Erreur avec l'�nonc�
SELECT MIN(prix) AS "Prix minimum"
FROM logement
WHERE categorie = "vente";

-- 12 Erreur avec l'�nonc�
SELECT ville
FROM logement
WHERE categorie = "vente"
AND type = "maison";

-- 13
UPDATE logement_agence 
SET frais = 730
WHERE idLogement = 5246;

-- 14
SELECT idLogement
FROM agence a, logement_agence l
WHERE a.idAgence = l.idAgence
AND a.nom = "laforet";

-- 15 Affiche 14
SELECT COUNT(*) AS "Nombre de propri�taires dans le 75"
FROM logement_personne lp, logement l
WHERE lp.idLogement = l.idLogement 
AND l.ville = "Paris";

-- 16
SELECT *
FROM demande d, personne p
WHERE p.idPersonne = d.idPersonne
LIMIT 0, 3;

-- 17
SELECT p.prenom
FROM personne p, logement_personne lp
WHERE p.idPersonne = lp.idPersonne
AND idLogement = 5770;

-- 18
SELECT p.prenom
FROM personne p, demande d
WHERE p.idPersonne = d.idPersonne
AND d.ville = "Lyon";

-- 19
SELECT p.prenom
FROM personne p, demande d
WHERE p.idPersonne = d.idPersonne
AND d.ville = "Paris"
AND d.categorie = "location";

-- 20 
SELECT p.prenom, d.superficie
FROM personne p, demande d
WHERE p.idPersonne = d.idPersonne
AND d.categorie = "vente"
ORDER BY d.superficie DESC;

-- 21 A rev�rifier pour SUM
SELECT l.prix + la.frais
FROM logement_agence la, logement l
WHERE la.idLogement = l.idLogement
AND l.idLogement = 5091;

-- 22 
SELECT l.idLogement, l.prix, la.frais
FROM logement_agence la, logement l
WHERE la.idLogement = l.idLogement
AND l.idLogement = 5873;

-- 23 Valeur diff�rentes 
SELECT a.nom, SUM(la.frais) AS "Benefice"
FROM agence a, logement_agence la
WHERE a.idAgence = la.idAgence
GROUP BY a.nom
ORDER BY SUM(la.frais) ASC;

-- 24
SELECT a.nom, l.idLogement, l.prix, la.frais
FROM agence a, logement_agence la, logement l
WHERE a.idAgence = la.idAgence
AND la.idLogement = l.idLogement
AND l.categorie = "location"
ORDER BY l.prix ASC;

-- 25
SELECT p.prenom, l.prix
FROM personne p, logement l, logement_personne lp
WHERE p.idPersonne = lp.idPersonne
AND lp.idLogement = l.idLogement
AND l.categorie = "location"
ORDER BY l.prix ASC
LIMIT 0, 1;

-- 26
SELECT p.prenom, l.ville
FROM personne p, logement l, logement_personne lp
WHERE p.idPersonne = lp.idPersonne
AND lp.idLogement = l.idLogement

-- 27
SELECT a.nom, COUNT(*) AS "nombre" 
FROM agence a, logement l, logement_agence la
WHERE a.idAgence = la.idAgence
AND la.idLogement = l.idLogement
AND l.ville = "Paris"
GROUP BY a.nom
ORDER BY COUNT(*) DESC;

-- 28 
SELECT p.prenom, l.prix + la.frais AS "Prix final"
FROM personne p, logement l, logement_agence la, logement_personne lp, agence a
WHERE p.idPersonne = lp.idPersonne
AND lp.idLogement = l.idLogement
AND a.idAgence = la.idAgence
AND la.idLogement = l.idLogement
AND l.prix < 130000
AND l.categorie = "vente"
ORDER BY l.prix + la.frais ASC;

-- 29 Affiche 10
SELECT COUNT(*) AS "nombre"
FROM personne p, demande d, logement l
WHERE p.prenom = "hugo"
AND p.idPersonne = d.idPersonne 
AND d.ville = l.ville
AND l.categorie = "vente";

-- 30
SELECT COUNT(*) AS "nombre"
FROM personne p, demande d, logement l
WHERE p.prenom = "hugo"
AND p.idPersonne = d.idPersonne 
AND d.ville = l.ville
AND d.superficie <= l.superficie
AND l.categorie = "vente";

-- 31 Affiche 2
SELECT COUNT(*) AS "nombre"
FROM personne p, demande d, logement l, logement_agence la
WHERE p.prenom = "hugo"
AND p.idPersonne = d.idPersonne 
AND la.idLogement = l.idLogement
AND d.ville = l.ville
AND d.superficie <= l.superficie
AND d.type = l.type
AND d.budget >= l.prix
AND l.categorie = "vente";

-- 32
SELECT p.prenom AS "prospect", d.ville AS "ville_rech", d.budget AS "budget_max", d.superficie AS "sup_min", l.idLogement AS "ref_bien", a.nom AS "nom_agence", l.ville AS "ville_prop", l.prix + la.frais AS "prix_ttc", l.superficie AS "sup_prop", l.categorie AS "cat_prop"
FROM personne p, demande d, logement l, logement_agence la, agence a
WHERE p.prenom = "hugo"
AND p.idPersonne = d.idPersonne 
AND la.idLogement = l.idLogement
AND la.idAgence = a.idAgence
AND d.ville = l.ville
AND d.superficie <= l.superficie
AND d.type = l.type
AND d.budget >= l.prix
AND l.categorie = "vente";

-- 33
SELECT a.nom, COUNT(*)
FROM demande d, logement l, logement_agence la, agence a
WHERE la.idLogement = l.idLogement
AND la.idAgence = a.idAgence
AND d.ville = l.ville
AND d.superficie <= l.superficie
AND d.type = l.type
AND d.budget >= l.prix + la.frais
AND l.categorie = "vente"
GROUP BY a.nom
ORDER BY COUNT(*) DESC;

-- 34 Utiliser UNION ALL 
SELECT p.prenom AS "prospect", d.ville AS "ville_rech", SUM(d.budget*12) AS "budget_annee1", d.superficie AS "sup_min", d.categorie AS "cat_rech", a.nom AS "nom_agence", l.idLogement AS "ref", l.ville AS "ville_prop", SUM(l.prix*12) AS "prix_annee1", l.superficie AS "sup_prop", l.categorie AS "cat_prop"
FROM personne p, demande d, logement l, logement_agence la, agence a
WHERE p.idPersonne = d.idPersonne 
AND la.idLogement = l.idLogement
AND la.idAgence = a.idAgence
AND d.ville = l.ville
AND d.superficie <= l.superficie
AND d.type = l.type
AND d.budget >= l.prix
AND d.categorie = l.categorie
AND d.categorie = "location";










