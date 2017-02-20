<?php // (C) Copyright Bobbing Wide 2017

/**
 * Class: OIK_plugins_featured_image
 */
class OIK_plugins_featured_image {

	public $oik_plugin_fields;
	public $featured_image;
	public $file;
	
	function __construct( $oik_plugin_fields ) {
		$this->oik_plugin_fields = $oik_plugin_fields;
		$this->featured_image = null;
	}
	
	/**
	 * Sets the featured image
	 *
	 * Note: In the current version this routine gets invoked when the featured image is not set ( -1 in _thumbnail_id )
	 * Perhaps we need to cater for when it is already set. 
	 */
	function set_featured_image() {
		$this->determine_featured_image();
		$this->attach_image();
		$this->set_thumbnail_id();
	}
	
	/**
	 * Determines the featured image
	 *  
	 * - We need the slug to locate the plugin locally, or on WordPress.org, or on GitHub 
	 * - And to find the name of the plugin's banner and icon images
	 * - If the GitHub repo is set then the slug should have been determined from that.
	 *
	 */
	function determine_featured_image() {
		$this->file = null;
		$methods = $this->determine_finder_methods();
		if ( $methods ) {
			$methods = bw_as_array( $methods );
			foreach ( $methods as $method ) {
				if ( null === $this->file ) {
					$this->file = $this->$method();
				}
			}
		}
	}
	
	/**
	 * Uploads the image and attaches it to the post.
	 */
	function attach_image() {
		if ( $this->file ) {
		}
	
	}
	
	function determine_finder_methods() {
		$type_methods = array( "0" => null
		                , "1" => "local,dotorg,github"
										, "2" => "local,github"
										, "3" => "local,github"
										, "4" => null
										, "5" => "local,github"
										, "6" => "local,dotorg,github"
										);
		$methods = bw_array_get( $type_methods, $this->oik_plugin_fields->oikp_type, null );
		return( $methods );
										
	} 
	
	
	function set_thumbnail_id() {
		if ( $this->featured_image ) {
			$_POST['thumbnail_id'] = $this->featured_image;
		}
	}
	
	/**
	 * Locate the image from a local copy of the plugin
	 * 
	 * Here we assume that there is a file in the assets directory.
	 * 
	 */
	function local() {
		$filename = $this->banner_image_name();
		return $filename ;
	}
	
	/**
	 * Returns the banner image file name
	 * 
	 * @TODO Same code as oik-zip? 
	 */
	function banner_image_name() {
		$slug = $this->oik_plugin_fields->oikp_slug;
		$filename = oik_path( "assets/$slug-banner-772x250.jpg", $slug );
		if ( !file_exists( $filename ) ) {
			$filename = oik_path( "assets/$slug-banner-772x250.png", $slug );
			if ( !file_exists( $filename ) ) {
				$filename = null;
			}
    }
		return $filename;
  }
	
	/**
	 * Returns the banner image file name for a GitHub repo
	 * 
	 * This will be an URL which we need to get as a file.
	 * 
	 * We might want to look for:
	 * $slug-banner-772x250.jpg 
	 * banner-772x250.jpg
	 *
	 * 
	 */
	function github() {
		$file = $this->get_github_image_file( $this->oik_plugin_fields->oikp_git, "{$this->oik_plugin_fields->oikp_slug}-banner-772x250.jpg" );
		return $file; 
	
	}
	
	function get_github_image_file( $gitrepo, $file ) {
		$url = $this->github_image_file_url( $gitrepo, $file );
		$file = $this->download_url( $url );
		return( $file );
	
	}
	
	function download_url( $url ) {
		$file = download_url( $url );
		bw_trace2( $file, "file or WP_Error" );
		if ( is_wp_error( $file ) ) {
			$file = null;
		}
		return( $file );
	}

	/**
	 * Return a GitHub image file URL
	 * 
	 * @param string $gitrepo consisting of owner/repository e.g. bobbingwide/genesis-oik
	 * @param string $file the image file we want to display - we assume it exists
	 * @return string the full file URL
	 */ 
	function github_image_file_url( $gitrepo, $file ) {
		$github[] = "https://raw.githubusercontent.com";
		$github[] = $gitrepo;
		$github[] = "master/assets";
		$github[] = $file;
		$target = implode( "/", $github );
		return( $target );
	}
	
	/**
	 * Returns the banner image file name for a WordPress repo
	 * 
	 * Anyone of these should be acceptable:
	 *
	 * banner-772x250.jpg
	 * banner-772x250.png
	 * icon-256x256.jpg
	 * icon-256x256.png
	 * icon-128x128.jpg
	 * icon-128x128.png
	 
	 */
	function dotorg() {
		return null;
	
	} 
}
