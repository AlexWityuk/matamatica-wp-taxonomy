<?php
class Matematica_Test_Plugin_Create_Products {
	function __construct(){
		add_action('init', array($this, 'init_Products'));
		add_action( 'init', array($this, 'kategorii_dlja_products'));
		add_action('add_meta_boxes', array($this, 'links_custom_meta_products'));
		add_action('save_post', array($this, 'product_save'));
	}

	function init_Products (){
		register_post_type('Products',
			array(
				'labels' => array(
                'name' => 'Products',
                'singular_name' => 'Products',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Product',
                'edit' => 'Edit',
                'edit_item' => 'Edit Products',
                'new_item' => 'New Products',
                'view' => 'View',
                'view_item' => 'View Products',
                'search_items' => 'Search Products',
                'not_found' => 'No Products found',
                'not_found_in_trash' => 'No Order found in Trash',
                'parent' => 'Parent Products'
            ),
            'public' => true,
            'menu_position' => 5,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-cart',
            'has_archive' => true
			)
		);
	}

	function links_custom_meta_products() {
	    add_meta_box( 'product_metabox',
                  'Product Fields',
                  array($this, 'product_meta_callback'),
                  'Products',
                  'normal',
                  'high' );
	}

	function product_meta_callback($post) {
		$product_name = get_post_meta( $post->ID, 'product_name', true );
	    ?>
	    <table>
	        <tr>
	            <td style="width: 100%">Наименование товара</td>
	            <td><input type="text" size="80" name ="product_name_field" value="<?php echo $product_name; ?>" /></td>
	        </tr>
	    </table>
	    <?php
	}

	function product_save( $post_id ) {
        update_post_meta( $post_id, 'product_name', $_POST[ 'product_name_field' ] );
	}

	function kategorii_dlja_products(){
		register_taxonomy_for_object_type( 'category', 'products');
		register_taxonomy_for_object_type( 'post_tag', 'products');
	}
}
?>