<?php
/*
Template Name: Full page without sidebar
*/
?>
<?php get_header(); ?>
<div class="matematica_task-content col-lg-12">
	<form class="form-horizontal">
		<select class="form-control slct-product">
			<?php
			$current_user = wp_get_current_user();

			$args = array(
                   'post_type' => 'products',
                   'publish' => true,
                   'paged' => get_query_var('paged'),
               );
            query_posts($args);
            if ( have_posts() ) :
				while ( have_posts() ) : 
					the_post();
			?>
			<option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
			<?php endwhile; ?>
			<?php endif; ?>
		</select>
		<div class="form-group">
			<label for="fio-ord" class="col-sm-2 control-label">Ф.И.О.</label>
			<div class="col-sm-10">
				<?php if (isset($current_user)) : ?>
			  	<input type="text" class="form-control" id="fio-ord" 
		  			placeholder="" 
		  			value="<?php echo $current_user->user_firstname."".$current_user->user_lastname ?>" 
		  			name="fio-for-order">
	  			<?php else: ?>
			  		<input type="text" class="form-control" id="fio-ord" placeholder="Фамилия Имя Отчечтво" name="fio-for-order">
			  <?php endif; ?>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
				<?php if (isset($current_user)) : ?>
				<input type="email" class="form-control" id="inputEmail3" 
					placeholder=""
					value="<?php echo $current_user->user_email; ?>"  name="email">
				<?php else: ?>
				<input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
				<?php endif; ?>
			</div>
		</div>
		<div class="form-group">
			<label for="slct-method" class="col-sm-2 control-label">Способ доставки</label>
			<select class="form-control slct-method">
			<?php
			$terms = get_terms( 'delivery_method' );
			foreach ($terms as $term) :
			?>
			<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
			<?php endforeach; ?>
		</select>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button id="create-order-btn" type="button" class="btn btn-success">Заказать</button>
			</div>
		</div>
	</form>
</div><!--.bon-appetit-content-->
<?php get_footer(); ?>