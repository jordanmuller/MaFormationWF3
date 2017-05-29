// LE DOM

/* Le DOM est une interface de développement en JS pour HTML. Grâce au DOM, je vais être capable d'accéder / modifier mon HTML
 L'objet "document" : c'est le point d'entrée vers mon contenu html
 Chaque page chargée dans mon navigateur a un objet "document" */

//  Comment puis-je faire pour récupérer les différentes informations de ma page HTML ?

/*
 1 - le document.getElementById
document.getElementById() : c'est une fonction qui va permettre de récupérer un élément HTML à partir de son identifiant unique : ID
*/

var bonjour = document.getElementById("bonjour");
console.log(bonjour);

/*
2 - le document.getElementByClassName
document.getElementsByClassName() : c'est une fonction qui va permettre de récupérer un ou plusieurs éléments (une liste) HTML à partir de leur classe.
*/

var contenu = document.getElementsByClassName("contenu");
console.log(contenu);
//  Me renvoie un tableau JS avec mes éléments HTML, ou encore autrement dit, une collection d'éléments HTML

/*
3 - le document.getElementsByTagName
document.getElementsByTagName c'est une fonction qui va permettre de récupérer un ou plusieurs éléments (une liste) HTML à partir de leur balise.
*/
var span = document.getElementsByTagName("span");
console.log(span);
