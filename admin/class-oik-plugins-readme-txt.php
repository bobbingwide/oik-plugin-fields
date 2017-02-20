<?php // (C) Copyright Bobbing Wide 2017

/**
 * Class: OIK_plugins_readme_txt
 *
 * Each WordPress plugin should have a readme.txt file that contains
 * lots of lovely information that can be put into the post
 * 
 * We need to get a local copy and then use WordPress logic to extract the fields
 * How much of the logic in OIK_plugins_featured_image should be in classes that we extend?
 * Should we use interfaces? 
 
 * Automatically sets field values for a plugin from what's available.
 * 
 * Fields we'll try to set are:
 * 
 * Name      | Contents
 * --------- | --------------
 * _oikp_desc | From readme.txt Description section OR the main plugin file's ( _oikp_name ) Description: line
 * oik_tags | From readme.txt Tags: .e.g shortcodes, smart, lazy
 *	
 */
class OIK_plugins_readme_txt {

	public $readme_txt_file;
	
	public $oik_plugins_fields;
	
	
	function __construct( $oik_plugins_fields ) {
		$this->oik_plugins_fields = $oik_plugins_fields;
		$this->readme_txt_file = null;
	}
	
	function load_readme_txt() {
	
	
	}

	function set_oik_tags() {
	
	}	





}
