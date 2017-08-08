--# 1 - Qui conduit la voiture 503
SELECT c.prenom, c.nom
FROM conducteur c, vehicule v, association_vehicule_conducteur a 
WHERE c.id_conducteur = a.id_conducteur
AND a.id_vehicule = v.id_vehicule
AND v.id_vehicule = 503;

--# 2 - Qui conduit quoi ?
SELECT c.prenom, c.nom, v.marque, v.modele, v.couleur
FROM conducteur c, vehicule v, association_vehicule_conducteur a
WHERE c.id_conducteur = a.id_conducteur
AND a.id_vehicule = v.id_vehicule;

SELECT conducteur.*, vehicule.*
FROM conducteur, vehicule, association_vehicule_conducteur
WHERE conducteur.id_conducteur = association_vehicule_conducteur.id_conducteur
AND vehicule.id_vehicule = association_vehicule_conducteur.id_vehicule;

-- Utilisation du c.* sur la table déclarée en SELECT
SELECT c.*, v.*
FROM conducteur c, vehicule v, association_vehicule_conducteur a
WHERE c.id_conducteur = a.id_conducteur
AND v.id_vehicule = a.id_vehicule;

-- 3 Ajouter vous dans la table conducteur, ensuite, afficher tous les conducteurs (même ceux absents d'association) ainsi que les véhicules qu'ils conduisent si c'est le cas
-- LEFT JOIN
INSERT INTO conducteur VALUES (NULL, "Jordan", "Muller");

SELECT c.prenom, c.nom, v.id_vehicule, v.marque, v.couleur, v.modele, v.immatriculation
FROM conducteur c
LEFT JOIN association_vehicule_conducteur a ON c.id_conducteur = a.id_conducteur 
LEFT JOIN vehicule v ON v.id_vehicule = a.id_vehicule;

-- 4 Ajoutez un nouveau véhicule sur la table véhicule, ensuite affichez tous les véhicules (meme ceux qui ne sont pas présents sur association) ainsi que les conducteurs conduisant si c'est le cas.
INSERT INTO vehicule VALUES (NULL, "Citroen", "ZX", "gris", "AB-123-OO");

SELECT c.prenom, c.nom, v.id_vehicule, v.marque, v.couleur, v.modele, v.immatriculation
FROM vehicule v -- La première table est uniquement prioritaire et affiche toutes les données
LEFT JOIN association_vehicule_conducteur a ON v.id_vehicule = a.id_vehicule
LEFT JOIN conducteur c ON c.id_conducteur = a.id_conducteur; 

-- On reprend la réponse de la 3 et on remplace les LEFT par des RIGHT
SELECT c.prenom, c.nom, v.id_vehicule, v.marque, v.couleur, v.modele, v.immatriculation
FROM conducteur c
RIGHT JOIN association_vehicule_conducteur a ON c.id_conducteur = a.id_conducteur 
RIGHT JOIN vehicule v ON v.id_vehicule = a.id_vehicule; -- La dernière table est prioritaire

-- 5 Affichez tous les véhicules et tous les conducteurs sans exception qu'ils soient sur associaiton vehicule ou pas.

SELECT c.id_conducteur, c.prenom, c.nom, v.id_vehicule, v.marque, v.couleur, v.modele, v.immatriculation
FROM conducteur c
LEFT JOIN association_vehicule_conducteur a ON c.id_conducteur = a.id_conducteur 
LEFT JOIN vehicule v ON v.id_vehicule = a.id_vehicule
UNION
SELECT c.id_conducteur, c.prenom, c.nom, v.id_vehicule, v.marque, v.couleur, v.modele, v.immatriculation
FROM vehicule v
LEFT JOIN association_vehicule_conducteur a ON v.id_vehicule = a.id_vehicule
LEFT JOIN conducteur c ON c.id_conducteur = a.id_conducteur;

-- En plus concis
SELECT c.*, v.*
FROM conducteur c
LEFT JOIN association_vehicule_conducteur a ON c.id_conducteur = a.id_conducteur 
LEFT JOIN vehicule v ON v.id_vehicule = a.id_vehicule
UNION
SELECT c.*, v.*
FROM vehicule v
LEFT JOIN association_vehicule_conducteur a ON v.id_vehicule = a.id_vehicule
LEFT JOIN conducteur c ON c.id_conducteur = a.id_conducteur;



