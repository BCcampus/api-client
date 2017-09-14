<?php
/**
 * Plugin Name:     WP API Client Shortcode
 * Plugin URI:      https://github.com/bccampus/api-client
 * Description:     Display content from another site using the WP API
 * Author:          bdolor
 * Author URI:      https://bradpayne.ca
 * Text Domain:     api-client
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         BCcampus\ApiClient
 */

// If file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

/*
|--------------------------------------------------------------------------
| Constants
|--------------------------------------------------------------------------
|
|
|
|
*/

if ( ! defined( 'API_CLIENT_PLUGIN_DIR' ) ) {
	define( 'API_CLIENT_PLUGIN_DIR', ( __DIR__ . '/' ) );
}
/*
|--------------------------------------------------------------------------
| Autoload
|--------------------------------------------------------------------------
|
|
|
|
*/

require API_CLIENT_PLUGIN_DIR . 'autoloader.php';

new \BCcampus\ApiClient\Events();
