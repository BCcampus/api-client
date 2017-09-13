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

if ( ! defined( 'EYPD_EVENTS_PLUGIN_DIR' ) ) {
	define( 'EYPD_EVENTS_PLUGIN_DIR', ( __DIR__ . '/' ) );
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

require EYPD_EVENTS_PLUGIN_DIR . 'autoloader.php';

$args = $_GET;
new \EYPD\Controllers\Control( $args );
