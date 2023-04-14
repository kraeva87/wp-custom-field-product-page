<?php
  global $product;
	$t_id = $product->get_id();
	$term_meta = get_option( "taxonomy_$t_id" );
	$term_meta_content = $term_meta['additional_info'];
	if ( $term_meta_content != '' ) {
		echo '<div class="additional_info">';
		echo apply_filters( 'the_content', $term_meta_content );
		echo '</div>';
	}
