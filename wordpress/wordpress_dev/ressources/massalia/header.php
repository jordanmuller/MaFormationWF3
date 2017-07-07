<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<?php wp_head(); ?>
</head>

	<body <?php body_class(); ?>>
		<ul id="menu-evitement" class="evitement menu-hz">
			<li><a href="#contenu">Aller au contenu</a></li>
			<li><a href="#navigation-principale">Aller au menu</a></li>
		</ul>
		<header id="banner" class="center max-largeur" role="banner">
			<div class="grid grid-1-2-1 grid-center">
					<div id="logo">
						
					</div>
					
					<div id="slogan">
						
					</div>

					<div id="recherche">
						
					</div>
			</div>
		</header>
		
		<div id="wrapper-navigation-principale" class="center">
			<button id="menu-rwd" aria-controls="navigation-principale" aria-expanded="false">
				<span class="icon-menu" aria-hidden="true"></span>
				<span class="intitule">Menu</span>
			</button>
			<nav id="navigation-principale" class="center max-largeur" role="navigation" aria-label="Menu principal">
				
			</nav>
		</div>
		<div id="bandeau" class="center">
			
		</div>
		<main id="main" class="center max-largeur" role="main">
			<?php 
				if (!is_front_page()) : 
					if ( function_exists('yoast_breadcrumb') ) :
						echo '<div id="ariane" class="breadcrumbs">', yoast_breadcrumb('','',false), '</div>';
					endif;
				endif;
			?>	