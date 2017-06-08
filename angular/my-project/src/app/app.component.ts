// -- 1. Importation de la Librairie Angular Core
import { Component } from '@angular/core';
import { Contact } from './shared/models/contact';

// -- 2. Déclaration du Composant
@Component({
  
  // -- Le Sélecteur pour le rendu de l'application
  selector: 'app-root',

  // -- Le Contenu html de notre composant
  templateUrl: './app.component.html',
  // -- Les styles CSS de notre composant 
  styleUrls: ['./app.component.css'] 

})

// -- 3. Notre code JS
export class AppComponent {
  // -- Déclaration d'une variable title
  title: string = 'contacts';

  // -- Déclaration d'un objet Contact
  Contact: Contact = {
    id : 1,
    fullname : "Jordan MULLER",
    username : "jordanmuller" 
  }

  // -- Je travaille avec des contacts
  Contacts: Contact[] = [
    {id : 1, fullname : "Jordan MULLER", username : "jordanmuller" },
    {id : 2, fullname : "Tanguy MANAS", username : "tanguymanas" },
    {id : 3, fullname : "Yimin JI", username : "yiminji" }
  ]

  // -- Choix de mon utilisateur actif
  contactActif: Contact;

  // -- Ma fonction choisirUnContact, prend un contact en paramètre et le transmet à la variable contactActif
  choisirUnContact(contact) {

    // -- Le this renvoie à la class AppComponent
    this.contactActif = contact;
    
  }

}
