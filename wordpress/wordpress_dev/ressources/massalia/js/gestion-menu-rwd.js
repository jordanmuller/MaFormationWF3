(function(jQuery){
	jQuery.fn.afficherMenu=function(){
	
		jQuery(this).each(function(){
			var obj = jQuery(this);
			var span = obj.find(".intitule");
			var texte = span.html();
			var menu = jQuery('#navigation-principale');

			obj.on('click', function(){
				if ( obj.attr('aria-expanded') == "false") {
					obj.attr({
							'aria-expanded' : 'true'
					});
					obj.find('.icon-menu').attr({
							'class' : 'icon-fermer'
					});
					span.html("Fermer");
					menu.addClass('show');
				}
				else{
					obj.attr({
							'aria-expanded' : 'false'

					});	
					obj.find('.icon-fermer').attr({
							'class' : 'icon-menu'
					});
					span.html("Menu");
					menu.removeClass('show');
					
				}
			});

		});
		return jQuery(this);
	};
	
})(jQuery);

jQuery(document).ready(function(){
			jQuery('#menu-rwd').afficherMenu();

});