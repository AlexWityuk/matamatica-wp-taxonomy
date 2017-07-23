 <!DOCTYPE html> 
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> >
		<div class="navbar-collapse" id="main-menu">
			<?php wp_nav_menu( array(
				'theme_location'   => 'primary',
				'menu_class' => 'navbar_nav menu'
			) ); ?>
		</div>
