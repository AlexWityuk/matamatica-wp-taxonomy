<?php
/*
Template Name: index
*/
?>
<?php get_header(); ?>
	<div class="product_list-wrapper row">
		<?php
		$args = array(
                   'post_type' => 'products',
                   'publish' => true,
                   'paged' => get_query_var('paged'),
               );
            query_posts($args);?>
			<ul class="product clearfix">
				<?php if ( have_posts() ) :
				while ( have_posts() ) : 
					the_post(); ?>
				<li class="product-wrapper">
					<div <?php post_class(); ?> >
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<div class="post-content">
							<?php the_content( 'Read more' ); ?>
						</div><!--end post-content-->
						<?php wp_nav_menu( array(
							'theme_location'   => 'top',
							'menu_class' => 'nav navbar_nav menu'
						) ); ?>
					</div>
				</li>
				<?php endwhile; ?>
			</ul>
		<div class="matematica_theme-pagination pagination">
			<?php $args = array (
				'prev_text'  => __('«', 'bonappetit') . ' ',
				'next_text'  => ' '. __('»', 'bonappetit')
			);
			echo paginate_links( $args ); ?>
		</div><!--bon-appetit-pagination pagination-->
		<?php endif; ?>
	</div>
<?php get_footer(); ?>