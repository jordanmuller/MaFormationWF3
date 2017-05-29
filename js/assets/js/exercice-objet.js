// Petite fonction de raccourci (lesflemards.js)

function w(t) {
    document.write(t);
}

function l(e) {
    console.log(e);
}
//  Création d'un tableau 3D en JS !

var premierTrimestre = [
    {
        "nom"      :  "LIEGEARD",
        "prenom"   :  "Hugo",
        "moyenne"  : {
                        "Français": 4,
                        "Maths": 8,
                        "Physique": 18
                     }
    },
    {
        "nom"      :  "MANAS",
        "prenom"   :  "Tanguy",
        "moyenne"  : {
                        "Français": 6,
                        "Maths": 15,
                        "Physique": 9,
                        "Anglais": 15.5
                     }
    },
    {
        "nom"      :  "ARAUJO",
        "prenom"   :  "Thiago",
        "moyenne"  : {
                        "Français": 10,
                        "Maths": 15,
                        "Physique": 16
                     }
    }
]; 
l(premierTrimestre);
w("<ol>");
// Je souhaite afficher la liste de mes étudiants
for (i=0; i < premierTrimestre.length; i++) {
    //  On récupère l'objet étudiant de l'itération
    let etudiant = premierTrimestre[i];
    l(etudiant);

    // Afficher le prénom et le nom d'un étudiant
    w("<li>");
        w( etudiant.prenom + " " + premierTrimestre[i].nom);
    w("</li>");
        // Affiche la moyenne de l'étudiant aux différentes matières.    
        w("<ul>")
        // Je définis ces deux vars à 0, une var doit toujours être définie avant d'être utilisée
        var somme = 0, diviseur = 0;
        for (let matiere in etudiant.moyenne) {
            l(matiere);  // Affiche le nom de la clé, passé dans la variable à chaque tour de boucle effectuée dans l'objet
            l(etudiant.moyenne[matiere]); // Affiche la valeur de la clé, passée car matière, qui prend à chaque tour de boucle la valeur du résultat, comme premierTrimestre[i] mais pour les objets et non les tableaux est en paramètre de etudiant.moyenne
            diviseur++;  // On incrémente le diviseur ou le nbDeMatieres
            somme += etudiant.moyenne[matiere]; // On ajoute à chaque itération la valeur de chaque note, de etudiant.moyenne[matiere]
            w("<li>")
                w(matiere + " : " + etudiant.moyenne[matiere]);
            w("</li>")    
        } // Fin de la boucle matiere
        var moyGen = Math.round(somme/diviseur);
            w("<li>")
                w("<strong> Moyenne générale :</strong>" + " " + moyGen);
            w("</li>")
        w("</ul>")
}
w("</ol>")