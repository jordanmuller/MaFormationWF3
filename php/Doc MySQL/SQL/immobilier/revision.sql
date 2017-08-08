-- 1
SELECT nom
FROM agence;

-- 2
SELECT idAgence
FROM agence
WHERE idAgence = 608870;

-- 3 
SELECT *
FROM logement
LIMIT 0, 1;

-- 4
SELECT COUNT(*)
FROM logement;

-- 5
SELECT *
FROM logement
WHERE prix < 150000
AND categorie = "vente"
ORDER BY prix ASC;

-- 6 
SELECT COUNT(*) AS "nombre"
FROM logement
WHERE categorie = "location";

-- 7
SELECT DISTINCT ville
FROM demande;

-- 8
SELECT ville, COUNT(*) AS "nombre"
FROM logement
GROUP BY ville;

-- 9
SELECT idLogement
FROM logement
WHERE categorie = "location";

-- 10
SELECT idLogement
FROM logement
WHERE categorie = "location"
AND superficie >= 20
AND superficie <= 30;

-- 11
SELECT prix AS "prix minimum"
FROM logement
WHERE categorie = "vente"
ORDER BY prix ASC
LIMIT 0, 1;

-- 12 
SELECT type, ville
FROM logement
WHERE type = "maison"
AND categorie = "vente";

-- 13
UPDATE logement_agence SET frais = 730
WHERE idLogement = 5246;

-- 14
SELECT idLogement
FROM  agence a, logement_agence la
WHERE la.idAgence = a.idAgence
AND a.nom = "laforet";

-- 15
SELECT COUNT(*) AS "nombre_de_propriétaires_du_75"
FROM logement_personne lp, logement l
WHERE lp.idLogement = l.idLogement
AND l.ville = "paris";

-- 16
SELECT * 
FROM demande d, personne p
WHERE d.idPersonne = p.idPersonne
AND d.categorie = "vente"
LIMIT 0, 3;

-- 17
SELECT p.prenom
FROM logement_personne lp, personne p
WHERE lp.idPersonne = p.idPersonne
AND lp.idLogement = 5770

-- 18
SELECT p.prenom
FROM personne p, demande d
WHERE p.idPersonne = d.idPersonne
AND d.ville = "lyon";

-- 19
SELECT p.prenom
FROM personne p, demande d
WHERE p.idPersonne = d.idPersonne
AND d.ville = "paris"
AND d.categorie ="location";

-- 20
SELECT p.prenom, d.superficie
FROM personne p, demande d
WHERE p.idPersonne= d.idPersonne
AND d.categorie = "vente"
ORDER BY d.superficie DESC

-- 21
SELECT l.prix + la.frais AS "prix_final"
FROM logement l, logement_agence la
WHERE l.idLogement = la.idLogement
AND l.idLogement = 5091;

-- 22
SELECT l.idLogement, l.prix, la.frais
FROM logement l, logement_agence la
WHERE l.idLogement = la.idLogement
AND l.idLogement = 5873;

-- 23
SELECT a.nom, SUM(la.frais) AS "Bénéfices"
FROM agence a, logement_agence la
WHERE a.idAgence = la.idAgence
GROUP BY a.nom
ORDER BY SUM(la.frais) ASC;

-- 24
SELECT a.nom, l.idLogement, l.prix, la.frais
FROM agence a, logement l, logement_agence la
WHERE a.idAgence = la.idAgence
AND la.idLogement = l.idLogement
AND l.categorie = "location"
ORDER BY l.prix ASC;

-- 25 
SELECT p.prenom, l.prix
FROM personne p, logement_personne lp, logement l
WHERE p.idPersonne = lp.idPersonne
AND lp.idLogement= l.idLogement
ORDER BY l.prix ASC
LIMIT 0, 1; 

-- 26
SELECT p.prenom, l.ville
FROM personne p, logement_personne lp, logement l
WHERE p.idPersonne = lp.idPersonne
AND lp.idLogement = l.idLogement;

-- 27 
SELECT a.nom, COUNT(*) AS "nombre"
FROM agence a, logement_agence la, logement l
WHERE a.idAgence = la.idAgence
AND la.idLogement = l.idLogement
AND l.ville = "paris"
GROUP BY a.nom
ORDER BY COUNT(*) DESC;

-- 28
SELECT p.prenom, l.prix + la.frais AS "prix final"
FROM personne p, logement_personne lp, logement l, logement_agence la
WHERE p.idPersonne = lp.idPersonne
AND lp.idLogement = l.idLogement
AND la.idLogement = l.idLogement 
AND l.prix + la .frais < 130000
AND l.categorie = "vente"
ORDER BY l.prix + la.frais ASC;

-- 29 
SELECT COUNT(*) AS "nombre"
FROM personne p, demande d, logement l
WHERE p.idPersonne = d.idPersonne
AND d.ville = l.ville
AND l.categorie = "vente"
AND p.prenom = "Hugo";


-- 30 
SELECT COUNT(*) AS "nombre"
FROM personne p, demande d, logement l
WHERE p.idPersonne = d.idPersonne
AND d.ville = l.ville
AND l.categorie = "vente"
AND p.prenom = "Hugo"
AND d.superficie <= l.superficie;

-- 31
SELECT COUNT(*) AS "nombre"
FROM personne p, demande d, logement l, logement_agence la
WHERE p.idPersonne = d.idPersonne
AND d.ville = l.ville
AND l.categorie = "vente"
AND la.idLogement = l.idLogement
AND p.prenom = "Hugo"
AND d.superficie <= l.superficie
AND d.type = l.type
AND d.budget >= l.prix;

-- 32
SELECT * 
FROM personne p, demande d, logement l, logement_agence la
WHERE p.idPersonne = d.idPersonne
AND d.ville = l.ville
AND l.categorie = "vente"
AND la.idLogement = l.idLogement
AND p.prenom = "Hugo"
AND d.superficie <= l.superficie
AND d.type = l.type
AND d.budget >= l.prix + la.frais;

-- 33
SELECT a.nom, COUNT(*) AS "nombre"
FROM agence a, logement_agence la, demande d, logement l
WHERE a.idAgence = la.idAgence
AND la.idLogement = l.idLogement
AND d.ville = l.ville
AND d.type = l.type
AND d.budget >= l.prix + la.frais
AND d.superficie <= l.superficie
AND l.categorie = "vente"
GROUP BY a.nom
ORDER BY COUNT(*) DESC;

-- 34
SELECT p.prenom AS "prospect", d.ville AS "ville_rech", d.budget * 12 AS "budget_annee_1", d.superficie AS "sup_min", d.categorie AS "cat_rech", a.nom AS "nom_agence", l.idLogement AS "ref", l.ville AS "ville_prop", l.prix * 12 AS "prix_annee_1", l.superficie AS "sup_prop", l.categorie AS "cat_prop"
FROM personne p, demande d, logement l, agence a, logement_agence la
WHERE p.idPersonne = d.idPersonne 
AND a.idAgence = la.idAgence
AND la.idLogement = l.idLogement
AND d.ville = l.ville
AND d.budget >= l.prix 
AND d.categorie = "location"
AND d.superficie <= l.superficie
AND d.type = l.type;

