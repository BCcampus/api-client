<?php
/**
 * Project: eypd-events
 * Project Sponsor: BCcampus <https://bccampus.ca>
 * Copyright 2012-2017 Brad Payne <https://bradpayne.ca>
 * Date: 2017-09-11
 * Licensed under GPLv3, or any later version
 *
 * @author Brad Payne
 * @package Eypd_Events
 * @license https://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright (c) 2012-2017, Brad Payne
 */

namespace EYPD;


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
	protected $plugin_slug = 'eypd-events';

	/**
	 * Instance of this class.
	 *
	 * @since 0.1.0
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Events constructor.
	 */
	private function __construct() {
		// Load translations
		add_action( 'init', array( $this, 'loadPluginTextDomain' ) );

		// Setup our activation and deactivation hooks
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deActivate' ) );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	protected function loadPluginTextDomain() {
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

		add_option( 'eypd-events-activated', true );
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

		delete_option( 'eypd-events-activated' );
	}
}
