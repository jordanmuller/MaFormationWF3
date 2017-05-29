// LES OPERATEURS ARITHMETIQUES

// L'Addition

// -- Déclaration de plusieurs variables à la suite

var nb1, nb2, resultat;

nb1 = 10;
nb2 = 5;

resultat = nb1 + nb2;
console.log("L'addition de nb1 et nb2 est égale à : " + resultat);

//  La soustraction

// -- La soustraction de nb1 - nb2 avec "-"

resultat = nb1 - nb2;
console.log("La soustraction de nb1 et nb2 est égale à : " + resultat);

// La multiplication

// -- La multiplication de nb1 par nb2 avec "*"
resultat = nb1 * nb2;
console.log("La multiplication de nb1 par nb2 est égale à : " + resultat);

// La division

// -- La multiplication de nb1 par nb2 avec "/"
resultat = nb1 / nb2;
console.log("La division de nb1 par nb2 est égale à : " + resultat);

// Le modulo (retourne le reste de la division)
// -- Le modulo de nb1 par nb2 avec "%"
nb1 = 11;
resultat = nb1 % nb2;
console.log("Le modulo (reste de la division) de " + nb1 + " par " + nb2 + " est égale à : " + resultat);

// LES ECRITURES SIMPLIFIEES

nb1 = 15;
nb1 = nb1 + 5;
nb1 += 5; // Ca équivaut à écrire nb1 = nb1 + 5;
// On a incrémenté et réaffecté
console.log("nb1 vaut " + nb1);
// On peut procéder ainsi pour tous les opérateurs arithmétiques : "+", "-", "*", "/", "%"