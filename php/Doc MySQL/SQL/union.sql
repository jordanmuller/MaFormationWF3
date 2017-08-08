-- UNION permet de fusionner 2 résultats dans un même liste (colonne)
-- par exemple: sur la BDD bibliotheque, nous voulons fusionner tous les abonnes et les auteurs dans un même résultat

SELECT prenom as 'liste personne physique' FROM abonne 
UNION 
SELECT auteur FROM livre;

-- UNION applique un DISTINCT par défaut.
-- Pour avoir tous les résultats sans DISTINCT, nous pouvons utiliser UNION ALL
SELECT prenom as 'liste personne physique' FROM abonne 
UNION ALL 
SELECT auteur FROM livre;