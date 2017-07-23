jQuery(document).ready( function($) {
	jQuery( "#create-order-btn" ).on( "click", function() {
		var productname = jQuery( "select.slct-product :selected" ).text();
		var buyer_name = jQuery('#fio-ord').val();
		var email = jQuery('#inputEmail3').val();
		var delivery_method = $("select.slct-method :selected").text();

	  	var data = {
			'action': 'my_action',
			'ajax_productname': productname,
			'ajax_buyer_name': buyer_name,
			'ajax_email': email,
			'ajax_delivery_method': delivery_method
		};
	  jQuery.post( window.wp_data.ajaxurl, data, function( response ) {
			alert(response);
		});
	});
})