(function(jQuery){
	jQuery.fn.menuDeroulant=function(){
	
		jQuery(this).each(function(){// this = premier niveau du menu déroulant, on boucle sur chaque li
			$lien = jQuery(this).children("a");
			$texte = $lien.text();
			/*if ($texte != 'Accueil'){
				$lien.replaceWith('<span tabindex="0">' + $texte + ' <span class="invisible">sous-menu</span></span>');
			}*/
			jQuery(this)
					.mouseover(function(){
						/*jQuery(".sub-menu").removeClass("visible");
						jQuery(".menu-item-has-children").removeClass("onHover");*/
						jQuery(this).addClass("onHover");
						jQuery(this).children(".sub-menu").addClass("visible");
					})
					.mouseout(function(){
						jQuery(this).removeClass("onHover");
						jQuery(this).children(".sub-menu").removeClass("visible");
					})
					.focusin(function(){
						jQuery(this).addClass("onHover");
						jQuery(this).children(".sub-menu").addClass("visible");
					})
					.focusout(function(){
						jQuery(this).removeClass("onHover");
						jQuery(this).children(".sub-menu").removeClass("visible");
					});
		
			return jQuery(this); // rendre pour le chainage
		});
	};
	
	
})(jQuery); // pour englober les fonctions, espace privé pour les variables

jQuery(document).ready(function(){
			jQuery('#navigation-principale > ul > li').menuDeroulant(); // s'applique à tous les éléments li de premier niveau
});