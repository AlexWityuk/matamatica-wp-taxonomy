
<?php get_header(); ?>
<div class="mail-content single-post col-lg-9 col-md-9 col-sm-9">
	<?php if ( have_posts() ) :
		the_post(); ?>
		<div <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<?php wp_nav_menu( array(
				'theme_location'   => 'top',
				'menu_class' => 'nav navbar_nav menu'
			) ); ?>
		</div>
	<?php else: ?>
		<?php _e( 'Sorry, no posts matched your criteria.', 'bonappetit' ); ?>
	<?php endif; ?>
</div><!--.mail-content-->
<?php get_footer(); ?>