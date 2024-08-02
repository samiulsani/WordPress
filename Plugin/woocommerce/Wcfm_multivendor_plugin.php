/** This code hide virtual and downloadable option and automatic clickable in wcfm multivendor plugin **/


add_filter( 'wcfm_product_manage_fields_general', function( $general_fields, $product_id, $product_type ) {
	if( isset( $general_fields['is_virtual'] ) ) {
		$general_fields['is_virtual']['dfvalue'] = 'enable';
		$general_fields['is_virtual']['class'] = 'wcfm_custom_hide';
		$general_fields['is_virtual']['desc_class'] = 'wcfm_custom_hide';
	}
	if( isset( $general_fields['is_downloadable'] ) ) {
		$general_fields['is_downloadable']['dfvalue'] = 'enable';
		$general_fields['is_downloadable']['class'] = 'wcfm_custom_hide';
		$general_fields['is_downloadable']['desc_class'] = 'wcfm_custom_hide';
	}
	return $general_fields;
}, 50, 3 );


