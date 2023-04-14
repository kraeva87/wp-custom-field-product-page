<?php
// Additional information to product page
function product_page_custom_field() {
	global $post;
	$t_id = $post->ID;
	$term_meta = get_option( "taxonomy_$t_id" );
	$content = $term_meta['additional_info'] ? wp_kses_post( $term_meta['additional_info'] ) : '';
	$settings = array( 'textarea_name' => 'term_meta['.$t_id.'][additional_info]' );
	?>
	<div class="options_group">
		<p class="form-field"><label for="term_meta[<?php echo $t_id; ?>][additional_info]">Additional information</label>
		<?php wp_editor( $content, 'additional_info', $settings ); ?>
		</p>
	</div>
	<?php
}
add_action( 'woocommerce_product_options_general_product_data', 'product_page_custom_field' );

// Save the custom field
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );
function woo_add_custom_general_fields_save( $post_id ){
	if ( isset( $_POST['term_meta'] ) ) {
		foreach ( $_POST['term_meta'] as $t_id=>$value ) {
			$term_meta = get_option( "taxonomy_$t_id" );
			$keys = array_keys( $value );
			foreach ( $keys as $key ) {
				if ( isset ( $_POST['term_meta'][$t_id][$key] ) ) {
					$term_meta[$key] = wp_kses_post( stripslashes($_POST['term_meta'][$t_id][$key]) );
				}
				update_option( "taxonomy_$t_id", $term_meta );
			}
		}
	}
}
