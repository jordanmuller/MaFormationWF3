// INCREMEBNTATION ET DECREMENTATION

// Incréméntation

var nb1 = 1;
nb1 = nb1 + 1;
nb1 += 1;
nb1++; // Ecriture simplifiée
console.log(nb1);

// Décrémentation

var nb1 = 1;
nb1 = nb1 - 1;
nb1 -= 1;
nb1--;
console.log(nb1);

//  Subtilité

nb1 = 1;
console.log("nb1++ = " + nb1++);
// nb1 = 1, l'incrémentation a lieu après l'affichage
console.log(nb1);  // nb1 = 2
nb1= 1;
console.log("++nb1 = " + ++nb1);
// nb1 = 2, l'incrémentation a lieu avant l'affichage
