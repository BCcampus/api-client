<?php
/**
 * Project: api-client
 * Project Sponsor: BCcampus <https://bccampus.ca>
 * Copyright 2012-2017 Brad Payne <https://bradpayne.ca>
 * Date: 2017-09-11
 * Licensed under GPLv3, or any later version
 *
 * @author Brad Payne
 * @package BCcampus\ApiClient
 * @license https://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright (c) 2012-2017, Brad Payne
 */

namespace BCcampus\ApiClient;

use BCcampus\ApiClient\Controllers;

/**
 * Class Events
 * @package BCcampus\ApiClient
 */
class Events {
	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	const VERSION = '0.1.0';

	/**
	 * Unique identifier for plugin.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $plugin_slug = 'api-client';

	/**
	 * Events constructor.
	 */
	public function __construct() {
		// Load translations
		//add_action( 'init', array( $this, 'loadPluginTextDomain' ) );

		// Setup our activation and deactivation hooks
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deActivate' ) );

		add_shortcode( 'eypd_events', array( $this, 'renderEypdEvents' ) );

	}

	function loadPluginTextDomain() {
		$domain = $this->plugin_slug;
		apply_filters( 'plugin_locale', get_locale(), $domain );
	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    0.1.0
	 * @return    Plugin slug variable.
	 */
	function getPluginSlug() {
		return $this->plugin_slug;
	}

	/**
	 * Fires when plugin is activated
	 *
	 * @since 0.1.0
	 */
	function activate() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		add_option( 'api-client-activated', true );
	}

	/**
	 * Fires when the plugin is deactivated.
	 *
	 * @since 0.1.0
	 */
	function deActivate() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		delete_option( 'api-client-activated' );
	}

	function renderEypdEvents( $atts ) {
		ob_start();

		// merge defaults with attributes passed
		$atts = shortcode_atts( array(
			'context'  => 'embed',
			'per_page' => '50',
			'search'   => '',
			'author'   => '',
		), $atts, 'eypd_events' );

		// merge $_GET arguments from the page
		$args = array_merge( $atts, $_GET );

		new Controllers\WpApi( $args );

		return ob_get_clean();
	}
}
