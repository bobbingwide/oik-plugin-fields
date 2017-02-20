<?php // (C) Copyright Bobbing Wide 2017

/**
 * Class: OIK_plugins_plugin_file
 * 
 * In each WordPress plugin's plugin file there's a comment block that contains
 * information that we copy into the oik-plugins post type.
 *
 * We need to get a local copy and then use WordPress logic to extract the fields
 * How much of the logic in OIK_plugins_featured_image should be in classes that we extend?
 * Should we use interfaces? 
 
 * Automatically sets field values for a plugin from what's available.
 * 
 * Fields we'll try to set are:
 * 
 * Name       | Contents
 * ---------- | --------------
 * _oikp_desc | the plugin plugin file's ( _oikp_name ) Description: line
 * oik_tags   | From readme.txt Tags: .e.g shortcodes, smart, lazy
 * 
 * The Description is also available using the WordPress API.
 *	
 */
class OIK_plugins_plugin_file {

	public $plugin_file;
	public $oik_plugins_fields;
	
	
	function __construct( $oik_plugins_fields ) {
		$this->oik_plugins_fields = $oik_plugins_fields;
		$this->plugin_file = null;
		$this->load_plugin_file();
	}
	
	function load_plugin_file() {
		$this->plugin_file = $this->oik_plugins_fields->oikp_name;
	}
	
	function set_desc() {
	
	}
	





}
