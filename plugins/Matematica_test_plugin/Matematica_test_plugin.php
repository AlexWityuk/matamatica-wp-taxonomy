<?php
/*
Plugin Name: Matematica Test 
Plugin URI: 
Description: Taxonomy Order and Products User post types
Version: 1.0
Author: Aleksandr Wityuk
Author URI:
*/
/**
 * Loads the image management javascript
 */
global $post;
require_once plugin_dir_path( __FILE__ ) . 'admin/class_matematica_test_plugin_create_orders.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/class_matematica_test_plugin_create_product.php';
new Matematica_Test_Plugin_Create_Orders();
new Matematica_Test_Plugin_Create_Products();
?>