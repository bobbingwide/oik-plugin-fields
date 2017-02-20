<?php 
/**
Plugin Name: oik plugin fields
Depends: oik base plugin, oik fields, oik plugins
Plugin URI: http://www.oik-plugins.com/oik-plugins/oik-plugin-fields
Description: Additional fields for oik-plugins
Version: 0.0.1
Author: bobbingwide
Author URI: http://www.oik-plugins.com/author/bobbingwide
Text Domain: oik-plugin-fields
Domain Path: /languages/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

    Copyright 2017 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

oikplf_plugin_loaded();

/**
 * Register the additional fields and taxonomies for oik-plugins
 */ 
function oikplf_plugin_loaded() {
  add_action( 'oik_fields_loaded', 'oikplf_oik_fields_loaded', 11 );
	//add_action( "run_oik-plugin-fields.php", "oikplf_run_oikplf" );
	//add_action( "init", "oikplf_init" );
	add_action( "oik_admin_menu", "oikplf_oik_admin_menu" );

}

/**
 * Implement
 */
function oikplf_init() {
}	

/**
 * 
 * Registers additional fields and taxonomies for the oik-plugins post type
 * and defines 
 * 
 * Can't think of any at present that aren't already defined... other than
 * - rating
 * - 
 */ 
function oikplf_oik_fields_loaded() {
	//gob();
}

/**
 * Registers hooks to automatically set missing fields.
 */
function oikplf_oik_admin_menu() {
	add_action( "save_post_oik-plugins", "oikplf_save_post_oik_plugins", 10, 3 );
	add_action( "save_post", "oikplf_save_post", 10, 3 );
}

/**
 * Batch run oik-plugin-fields to define the taxonomy terms
 */
function oikplf_run_oikplf() {
	oik_require( "admin/oik-plugin-fields-run.php", "oik-plugin-fields" );
	oikplf_lazy_run_oikplf();
}

/**
 * Return a GitHub image file URL
 * 
 * @param string $gitrepo consisting of owner/repository e.g. bobbingwide/genesis-oik
 * @param string $file the image file we want to display - we assume it exists
 * @return string the full file URL
 */ 
function oikplf_github_image_file( $gitrepo, $file='screenshot.png' ) {
	$github[] = "https://raw.githubusercontent.com";
	$github[] = $gitrepo;
	$github[] = "master/assets";
	$github[] = $file;
	$target = implode( "/", $github );
	return( $target );
}

/**
 * Return the GitHub repository screenshot file
 *
 */
function oikplf_github_repo_screenshot() {
	$image_file = null;
	$post = get_post( null );
	//bw_trace2( $post, "post", null );
	if ( $post->post_type == "oik-plugins" ) {
		$gitrepo = get_post_meta( $post->ID, "_oikp_git", true );
		$slug = get_post_meta( $post->ID, "_oikp_slug", true );
		
		//bw_trace2( $gitrepo, "gitrepo", null );
		if ( oikplf_banner_expected( $gitrepo, $slug ) ) {
			
			$image_file = oikplf_github_image_file( $gitrepo, "$slug-banner-772x250.jpg" ); 
		}
	}
	return( $image_file );
}

function oikplf_banner_expected( $gitrepo, $slug ) {

	$banner_expected = false;
	if ( $gitrepo && $slug ) {
		if ( $gitrepo == "bobbingwide/$slug" ) {
			$banner_expected = true;
		}
	}
	return( $banner_expected );
}

	

/**
 * Implements 'save_post_oik-plugins' action for oik-plugin-fields
 * 
 * Lazy loads the logic
 *
 * @TODO Determine if this should this be done on 'save_post' or 'wp_insert_post'?
 * - save_post_${post_type} is invoked first
 * - save_post is invoked for every post type
 * - wp_insert_post is invoked for every post type
 * 
 * If we want to intercept save_post we could choose "save_post_oik-plugins"
 
 * 
 * @param ID $post_ID ID of the post 
 * @param object $post the post object
 * @param bool $update true if it's an update
 */ 
function oikplf_save_post_oik_plugins( $post_ID, $post, $update ) {
	if ( "auto-draft" !== $post->post_status ) { 
		oik_require( "admin/oik-plugin-fields-save-post.php", "oik-plugin-fields" );
		oikplf_lazy_save_post_oik_plugins( $post_ID, $post, $update );
	}
	//gob();

}

/**
 * Implements 'save_post' for oik-plugin-fields
 * 
 * Not a good idea when working with other post types
 * but this can be used to produce a Fatal message during the post update
 * before we redirect to edit post, a separate transaction. 
 */
function oikplf_save_post( $post_ID, $post, $update ) {	
	//gob();
}
 

