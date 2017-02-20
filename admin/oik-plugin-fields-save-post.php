<?php // (C) Copyright Bobbing Wide 2017

/**
 * Autosets oik-plugins fields
 * 
 * @param ID $ID
 *  
 */
function oikplf_lazy_save_post_oik_plugins( $post_ID, $post, $update ) {
	oik_require( "admin/class-oik-plugin-fields.php", "oik-plugin-fields" );
	$oik_plugin_fields = new OIK_plugin_fields();
	$oik_plugin_fields->save_post( $post_ID, $post, $update );
}



