<?php
global $product;
$t_id = $product->get_id();
$term_meta = get_option( "taxonomy_$t_id" );
$additional_info_content = $term_meta['additional_info'];
if ( $additional_info_content != '' ) {
	$product_tabs['add_info'] =  array(
		'title'      => __ ( 'Additional information', 'woocommerce' ),
		'priority'   =>  50,
		'callback'   =>  'woocommerce_product_additional_information_tab'
	);
}
