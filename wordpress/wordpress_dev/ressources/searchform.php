<form id="form-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="group-form">
		<input id="search" type="search" title="Indiquez les termes à rechercher" name="s" value="" size="22" placeholder="Tapez votre recherche" />
		<button type="submit" name="sa">
			<span class="icon-search"  aria-hidden="true"></span>
			<span class="screen-reader-text">Lancer la recherche</span>
		</button>
	</div>
</form>