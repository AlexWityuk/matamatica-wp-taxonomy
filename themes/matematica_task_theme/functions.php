<?php

	function matematica_theme_setup() {

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'custom-header', $defaults );

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 75,
			'flex-width'  => true,
			'header-text' => array( 'site-title' ),
		) );

		load_theme_textdomain( 'matematica_theme', get_template_directory() . '/languages' );

		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'matematica_theme' ),
			'top' => __( 'Top Navigation', 'matematica_theme' ),
		) );

		add_custom_background();
	}

	function matematica_theme_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Widget Area', 'matematica_theme' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'matematica_theme' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	function matematica_theme_enqueue_style() {
		wp_enqueue_style( 'matematica_theme_style', get_stylesheet_uri() ); 
		wp_enqueue_style( 'matematica_theme_bootstrap_style', get_template_directory_uri().'/css/bootstrap.css' );
		wp_enqueue_script( 'matematica_theme_bootstrap_script', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '3.3.7', true );
		wp_enqueue_script( 'matematica_theme_script', get_template_directory_uri()
			. '/js/myscript.js', '', '1.0', true );
	}

	function js_variables(){
	    $variables = array (
	        'ajaxurl' => admin_url('admin-ajax.php')
	    );
	    echo(
	        '<script type="text/javascript">window.wp_data = '.
	        json_encode($variables).
	        ';</script>'
	    );
	}
	add_action('wp_head','js_variables');

	function my_action_callback() {
		$post_data = array(
			'post_title'    => '',
			'post_content'  => $_POST['ajax_productname'],
			'post_status'   => 'publish',
			'post_type' => 'orders'
		);

		$post_id = wp_insert_post( $post_data );

		$my_post = array();
		$my_post['ID'] = $post_id; 
		$my_post['post_title'] = 'Заказ №'.$post_id;
		wp_update_post( $my_post );

		wp_set_post_terms( $post_id, $_POST[ 'ajax_delivery_method' ], 'delivery_method', False );

		update_post_meta( $post_id, 'buyer_name', $_POST[ 'ajax_buyer_name' ] );
        update_post_meta( $post_id, 'email', $_POST[ 'ajax_email' ] );
        update_post_meta( $post_id, 'delivery_method', $_POST[ 'ajax_delivery_method' ] );
        echo 'Заказ успешно отправлен';
        wp_die();
	}
	add_action( 'wp_ajax_my_action', 'my_action_callback' );
	add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );

	add_action( 'after_setup_theme', 'matematica_theme_setup');
	add_action( 'widgets_init', 'matematica_theme_widgets_init');
	add_action( 'wp_enqueue_scripts', 'matematica_theme_enqueue_style' );
?>
