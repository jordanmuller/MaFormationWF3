USE wf3_entreprise;
START TRANSACTION; --# Démarre la zone de mise en tampon
SELECT * FROM employes;

UPDATE employes SET prenom = "Test_tansaction" WHERE id_employes = 350;
SELECT * FROM employes; 

ROLLBACK; --# Annule toutes les opérations effectuées durant cette transaction.
SELECT * FROM employes;

COMMIT; --# A l'inverse, le COMMIT va valider toutes les actions effectuées durant la transaction.

--# Si l'on ferme la console (session en cours) et qu'aucun commit ou rollback n'a été effectué, ce sera un rollback par défaut.

--# TRANSACTION AVANCEE & SAVEPOINT
SELECT * FROM employes;

START TRANSACTION;

SAVEPOINT point1;
UPDATE employes SET salaire = 1500 WHERE id_employes = 350;
SELECT * FROM employes;

SAVEPOINT point2;
UPDATE employes SET salaire = 5000 WHERE service = "informatique"; 
SELECT * FROM employes;

SAVEPOINT point3;
UPDATE employes SET salaire = 100;
SELECT * FROM employes;

SAVEPOINT point4;
UPDATE employes SET salaire = 2000;
SELECT * FROM employes;

ROLLBACK TO point2; -- On revient au point 2 et on annule toutes les requêtes suivantes, on a toujours la modification du point1
SELECT * FROM employes;

ROLLBACK TO point4; -- On ne peut pas revenir au point4 car on est déjà revenu au point2 
-- ERROR 1305 (42000): SAVEPOINT point4 does not exist
SELECT * FROM employes;

ROLLBACK TO point1; -- On revient bien au point1 qui existe encore car il est placé avant le point2
SELECT *FROM employes;

ROLLBACK; -- On annule tout, on remonte à START TRANSACTION (la transaction se termine aussi), si l'on veut sauvegarder, on écrit COMMIT. Le COMMIT ou le ROLLBACK ferment la transaction

-- PRIVILEGIER LES SAVEPOINT