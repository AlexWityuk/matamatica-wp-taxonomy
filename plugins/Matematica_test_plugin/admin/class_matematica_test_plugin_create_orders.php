<?php
class Matematica_Test_Plugin_Create_Orders {
	function __construct(){
		add_action('init', array($this, 'init_Orders'));
		add_action( 'init', array($this, 'init_New_delivery_method_taxonomy'));
		add_action( 'init', array($this, 'init_New_Status_taxonomy'));
		add_action('add_meta_boxes', array($this, 'links_custom_meta'));
		add_action('save_post', array($this, 'order_save'));
	}

	function init_Orders (){
		register_post_type('Orders',
			array(
				'labels' => array(
                'name' => 'Orders',
                'singular_name' => 'Orders',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Order',
                'edit' => 'Edit',
                'edit_item' => 'Edit Orders',
                'new_item' => 'New Orders',
                'view' => 'View',
                'view_item' => 'View Orders',
                'search_items' => 'Search Orders',
                'not_found' => 'No Orders found',
                'not_found_in_trash' => 'No Order found in Trash',
                'parent' => 'Parent Orders'
            ),
            'public' => true,
            'menu_position' => 5,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-megaphone',
            'has_archive' => true
			)
		);
	}

	function links_custom_meta() {
	    add_meta_box( 'orders_metabox',
                  'Order Fields',
                  array($this, 'order_meta_callback'),
                  'Orders',
                  'normal',
                  'high' );
	}

	function order_meta_callback($post) {
		$buyer_name = get_post_meta( $post->ID, 'buyer_name', true );
		$email = get_post_meta( $post->ID, 'email', true );
		$delivery_method = get_post_meta( $post->ID, 'delivery_method', true );
	    ?>
	    <table>
	        <tr>
	            <td style="width: 100%">Fio</td>
	            <td><input type="text" size="80" name ="buyer_name_field" value="<?php echo $buyer_name; ?>" /></td>
	        </tr>
	        <tr>
	            <td style="width: 100%">Email</td>
	            <td><input type="text" size="80" name ="email_field" value="<?php echo $email; ?>" /></td>
	        </tr>
	        <tr>
	            <td style="width: 100%">Delivery method</td>
	            <td><input type="text" size="80" name ="delivery_method_field" value="<?php echo $delivery_method; ?>" /></td>
	        </tr>
	    </table>
	    <?php
	}

	function order_save( $post_id ) {
        update_post_meta( $post_id, 'buyer_name', $_POST[ 'buyer_name_field' ] );
        update_post_meta( $post_id, 'email', $_POST[ 'email_field' ] );
        update_post_meta( $post_id, 'delivery_method', $_POST[ 'delivery_method_field' ] );
	}

	function init_New_delivery_method_taxonomy(){
		register_taxonomy('delivery_method',array('orders'),
			array(
				'hierarchical' => false,
				'labels' => array(
					'name' => 'Способ доставки',
					'singular_name' => 'Delivery method',
					'search_items' =>  '',
					'popular_items' => '',
					'all_items' => '',
					'parent_item' => null,
					'parent_item_colon' => null,
					'edit_item' => '', 
					'update_item' => '',
					'add_new_item' => 'Добавить новый ',
					'new_item_name' => 'Название нового способа доставки',
					'separate_items_with_commas' => 'Разделяйте способы доставки запятыми',
					'add_or_remove_items' => 'Добавить или удалить способ доставки',
					'choose_from_most_used' => 'Выбрать из наиболее часто используемых способов',
					'menu_name' => 'Delivery method'
				),
				'public' => true, 
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var' => true,
				'rewrite' => array(
					'slug' => 'delivery_method',
					'hierarchical' => false 
	 
				),
			)
		);
		
		wp_insert_term('Самовывоз','delivery_method' );
		wp_insert_term('Доставка почтой','delivery_method' );
		wp_insert_term('Куръерская доставка','delivery_method' );
	}
	function init_New_Status_taxonomy(){
		register_taxonomy('status',array('orders'),
			array(
				'hierarchical' => false,
				'labels' => array(
					'name' => 'Статус',
					'singular_name' => 'Status',
					'search_items' =>  '',
					'popular_items' => '',
					'all_items' => '',
					'parent_item' => null,
					'parent_item_colon' => null,
					'edit_item' => '', 
					'update_item' => '',
					'add_new_item' => 'Добавить новый ',
					'new_item_name' => 'Название нового статуса',
					'separate_items_with_commas' => 'Разделяйте статусы запятыми',
					'add_or_remove_items' => 'Добавить или удалить статус',
					'choose_from_most_used' => 'Выбрать из наиболее часто используемых статусов',
					'menu_name' => 'Status'
				),
				'public' => true, 
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var' => true,
				'rewrite' => array(
					'slug' => 'status',
					'hierarchical' => false 
	 
				),
			)
		);
		
		wp_insert_term('Обрабатывается','status' );
		wp_insert_term('Отправлен','status' );
		wp_insert_term('Отключен','status' );
	}
}
?>