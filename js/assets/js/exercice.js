var noms = ["LIEGEARD", "MULLER", "IHADADENE", "HERICOURT", "MANAS"];
var prenoms = ["Hugo", "Jordan", "Karim", "Rudy", "Tanguy"];
var etudiants = [prenoms, noms];

var matieres = ["Français", "Mathématiques", "Physique"];
var notes = [4, 8, 18, 15, 14, 13, 12, 17, 13, 7, 11, 15, 19, 4, 16];
var sommes = [notes[0] + notes[1] + notes[2], notes[3] + notes[4] + notes[5], notes[6] + notes[7] + notes[8], notes[9] + notes[10] + notes[11], notes[12] + notes[13] + notes[14]];
var evaluations = [matieres, sommes];
var moyenneGenerale = [sommes/matieres.length];

var premierTrimestre = [etudiants, evaluations, moyenneGenerale];
var nbPrenoms = prenoms.length;
var nbMatieres = matieres.length;
var nbNotes = notes.length;


document.write("<ol>")
    for (i=0; i < nbPrenoms; i++) {
        document.write("<li>" + premierTrimestre[0][0][i] + " " + premierTrimestre[0][1][i] + "</li>");
    
    document.write("<ul>");
        for (j=0, k=0; j < nbMatieres && k < nbNotes; j++, k++) {
            document.write("<li>" + premierTrimestre[1][0][j] + ": " + premierTrimestre[1][1][k] + "</li>");
    }
    document.write("</ul>");
}


document.write("</ol>");