<?php
/**
 * @package ButtonFeatures
 */
/**
 * Plugin Name:       Button Features
 * Plugin URI:        https://gitlab.com/iti4ll/jatawiratama/button-features-plugin
 * Description:       Show mobile button features on website's homepage.
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      5.6
 * Author:            Muhammad Haryansyah
 * Author URI:        https://study-hary-id.github.io
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       button-features
 */
/*
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

Copyright 2005-2015 Automattic, Inc.
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! class_exists( 'ButtonFeatures' ) ) {
	/**
	 * Class ButtonFeatures is a constructor for this plugin.
	 */
	class ButtonFeatures
	{
		private $plugin;

		function __construct()
		{
			$this->plugin = plugin_basename( __FILE__ );
		}

		/**
		 * Add/register new action or filter to each hooks.
		 *
		 * @return void
		 */
		function register()
		{
//			add_filter(
//				"plugin_action_links_$this->plugin",
//				array( $this, 'settings_link' )
//			);

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'localize' ) );

//			add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
		}

		/**
		 * Listener uses when activate the plugin.
		 */
		function activate()
		{
			flush_rewrite_rules();
		}

		/**
		 * Listener uses when deactivate the plugin.
		 */
		function deactivate()
		{
			flush_rewrite_rules();
		}


		/**
		 * Add redirect link to the plugin's settings.
		 *
		 * @param array $links List of necessary links.
		 *
		 * @return array        Return list after added a new link element.
		 */
		function settings_link( $links )
		{
			$settings_link = '<a href="admin.php?page=">Settings</a>';
			array_push( $links, $settings_link );

			return $links;
		}


		/**
		 * Enqueue stylesheet and javascript files.
		 *
		 * @return void
		 */
		function enqueue()
		{
			wp_enqueue_style(
				'button-features',
				plugins_url( '/assets/css/style.css', __FILE__ )
			);
			wp_enqueue_script(
				'button-features',
				plugins_url( '/assets/js/script.js', __FILE__ ),
				array(),
				false,
				true
			);
		}

		/**
		 * Localize PHP output to javascript.
		 *
		 * @retun void
		 */
		function localize()
		{
			wp_localize_script(
				'button-features',
				'featuresLink',
				array( 'account' => home_url('/my-account' )
			));
		}

		/**
		 * Import the template of custom admin pages.
		 *
		 * @return void
		 */
		function admin_views()
		{
			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
		}

		/**
		 * Add/register new menu on admin side-bar.
		 *
		 * @return void
		 */
		function add_admin_pages()
		{
			add_menu_page(
				'',
				'Plugin',
				'manage_options',
				'',
				array( $this, 'admin_views' ),
				'',
				110
			);
		}
	}

	// Create an instance and register hooks.
	$button_features = new ButtonFeatures();
	$button_features->register();

	// Register listener for activation of the plugin.
	register_activation_hook(
		__FILE__, array( $button_features, 'activate' )
	);

	// Register listener for deactivation of the plugin.
	register_deactivation_hook(
		__FILE__, array( $button_features, 'deactivate' )
	);
}
