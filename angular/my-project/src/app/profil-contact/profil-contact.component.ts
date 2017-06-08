import { Component, Input } from '@angular/core';
import { Contact } from '../shared/models/contact';

@Component({
  selector: 'app-profil-contact',
  templateUrl: './profil-contact.component.html',
  styleUrls: ['./profil-contact.component.css']
})
export class ProfilContactComponent {
  // On rentre une variable contact, de type class Contact dans la classe ProfilContactComponent qui définit les fichiers profils-contact-component.html/css
  // En Angular, les variables se définissent sans var ou less
  @Input() contact: Contact; 
}

