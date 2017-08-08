-- UNION permet de fusionner deux résultats dans une même liste (colonne)
-- par exemple sur la BDD bibliotheque, nous voulons fusionner tous les abonnes et les auteurs dans un même résultat

SELECT prenom AS 'liste personne physique' FROM abonne 
UNION 
SELECT auteur FROM livre; -- Il n'y a pas de doublons dans la table

-- UNION est un DISTINCT par défaut.
-- Pour avoir tous les résultats sans DISTINCT, nous pouvons utiliser UNION ALL

SELECT prenom AS 'liste personne physique' FROM abonne 
UNION ALL
SELECT auteur FROM livre;

-- On peut passer plusieurs paramètres dans les SELECT