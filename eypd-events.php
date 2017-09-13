<?php
/**
 * Plugin Name:     Early Years Professional Development Events
 * Plugin URI:      https://github.com/bccampus/eypd-events
 * Description:     Display professional development events on your site
 * Author:          bdolor
 * Author URI:      https://bradpayne.ca
 * Text Domain:     eypd-events
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Eypd_Events
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

new \EYPD\Events();
