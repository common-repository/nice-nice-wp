<?php
/*
Plugin Name: NiceNice WP
Plugin URI: http://wordpress.org/extend/plugins/nice-nice-wp/
Description: Embed Vanilla Ice Everywhere in your WordPress Website with a widget or a shortcode.
Author: FAT Media
Version: 2.1.0
Author URI: http://youneedfat.com

  Copyright 2013 FAT Media  (email : why@youneedfat.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! class_exists( 'Fat_NiceNice_WP' ) ) {

	class Fat_NiceNice_WP {

		public function __construct() {

			/** Define plugin directory constants */
			define( 'FAT_NICENICE_CORE_DIR', dirname( __FILE__ ) );
			define( 'FAT_NICENICE_LIB_DIR', FAT_NICENICE_CORE_DIR . '/lib/' );
			define( 'FAT_NICENICE_PLUGIN_NAME', dirname( plugin_basename( __FILE__ ) ) );

			add_action( 'plugins_loaded', array( $this, 'loaded' ) );
		}

		public function loaded() {

			add_action( 'init', array( $this, 'load_translations' ) );

			/** Include core plugin files */
			require_once( FAT_NICENICE_LIB_DIR . 'shortcode.php' );
			require_once( FAT_NICENICE_LIB_DIR . 'widget.php' );
		}

		/**
		 * Translate all the things!
		 *
		 * @since 2.1.0
		 */
		function load_translations() {

			// The "plugin_locale" filter is also used in load_plugin_textdomain()
			$locale = apply_filters( 'plugin_locale', get_locale(), 'nicenicewp' );

			load_textdomain( 'nicenicewp', WP_LANG_DIR . '/nice-nice-wp/' . 'nicenicewp' . '-' . $locale . '.mo' );
			load_plugin_textdomain( 'nicenicewp', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Active and Deactivate the plugin
		 *
		 * @since 2.1.0
		 */
		public static function activate() {
			// Do nothing on activation
		}

		public static function deactivate() {
			// Do nothing on deactivation
		}
	}
}

if ( class_exists('Fat_NiceNice_WP' ) ) {
	// Installation and uninstallation hooks
	register_activation_hook( __FILE__, array( 'Fat_NiceNice_WP', 'activate' ) );
	register_deactivation_hook( __FILE__, array( 'Fat_NiceNice_WP', 'deactivate' ) );

	// instantiate the plugin class
	$_fat_nicenice_wp = new Fat_NiceNice_WP();
}
