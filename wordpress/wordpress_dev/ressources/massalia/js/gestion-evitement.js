(function(jQuery){
	jQuery.fn.evitementCache=function(){
	
		jQuery(this).each(function(){
			var obj = jQuery(this);

			obj.focusin(function(){
				jQuery(this).addClass("visible");
			})
			.focusout(function(){
				jQuery(this).removeClass("visible");
			});
		});
		return jQuery(this);
	};
})(jQuery);

jQuery(document).ready(function(){
	jQuery('.evitement').evitementCache();

});