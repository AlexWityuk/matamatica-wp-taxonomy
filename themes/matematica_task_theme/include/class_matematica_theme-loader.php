<?php
class Matamatica_Theme_loader{
	function __construct(){
		add_action( 'after_setup_theme', array($this, 'matematica_theme_setup'));
		add_action( 'widgets_init', array($this, 'matematica_theme_widgets_init'));
	}

	function matematica_theme_setup() {

		add_theme_support( 'title-tag' );

		add_theme_support( 'menus' );

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		$defaults = array(
			'default-image'          => '',
			'width'                  => 1600,
			'height'                 => 260,
			'flex-height'            => false,
			'flex-width'             => true,
			'uploads'                => true,
			'header-text'            => true,
			'default-text-color'     => '#fff'
		);
		add_theme_support( 'custom-header', $defaults );

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 75,
			'flex-width'  => true,
			'header-text' => array( 'site-title' ),
		) );

		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'matematica_theme', get_template_directory() . '/languages' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'matematica_theme' ),
			'top' => __( 'Top Navigation', 'matematica_theme' ),
		) );


		// This theme allows users to set a custom background
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
}
?>