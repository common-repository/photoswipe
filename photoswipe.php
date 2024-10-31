<?php
/*
Plugin Name: Photoswipe for Wordpress
Version: 1.0
Plugin URI: http://www.andreknieriem.de/photoswipe/
Author: Andre Knieriem
Author URI: http://www.andreknieriem.de
Description: Add the awesome Photoswipe Plugin to your Wordpress Site

	Copyright (c) 2013, Andre Knieriem.

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/
/**
 * Main PhotoSwipe plugin class
 * 
 * All methods are used statically
 * 
 * @version 1.0
 */
class PhotoSwipe {
	
	public static $prefix = 'psw_';

	/**
	 * Initialize the plugin
	 */
	public static function init() {
		add_action('wp_enqueue_scripts', array('PhotoSwipe', 'load'));
	} // end function
	
	/**
	 * Loads Photoswipe JS & CSS components
	 */
	public static function load() {
	
		// Photoswipe libraries
		wp_enqueue_script('psw-klass', plugins_url('/lib/photoswipe/lib/klass.min.js', __FILE__), array('jquery'), '3.0.5', true);
		wp_enqueue_script('psw-jquery', plugins_url('/lib/photoswipe/code.photoswipe-3.0.5.min.js', __FILE__), array('jquery', 'psw-klass'), '3.0.5', true);

		// Photoswipe JS hook
		wp_enqueue_script('psw-call', plugins_url('/lib/startpsw.js', __FILE__), array('jquery', 'psw-jquery'), '1.0', true);
		
		// Photoswipe style
		wp_enqueue_style('psw-css', plugins_url('/lib/photoswipe/photoswipe.css', __FILE__));
		
		add_filter('the_content', 'autoexpand_rel_wlightbox', 99);
		add_filter('the_excerpt', 'autoexpand_rel_wlightbox', 99);
		
	} // end function
	

} // end class

// Auto Add Photoswipe to Content
function autoexpand_rel_wlightbox ($content) {
		global $post;
		$pattern        = "/(<a(?![^>]*?rel=['\"]lightbox.*)[^>]*?href=['\"][^'\"]+?\.(?:bmp|gif|jpg|jpeg|png)['\"][^\>]*)>/i";
		$replacement    = '$1 class="psw_lightbox" rel="lightbox['.$post->ID.']">';
		$content = preg_replace($pattern, $replacement, $content);
		return $content;
	}

/// MAIN----------------------------------------------------------------------

add_action('plugins_loaded', array('PhotoSwipe', 'init'));