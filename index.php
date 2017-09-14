<?php
/**
 * Load this file if you need to bypass WordPress
 *
 */

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

$args = $_GET;
new \BCcampus\ApiClient\Controllers\WpApi( $args );
