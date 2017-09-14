<?php
/**
 * Project: api-client
 * Project Sponsor: BCcampus <https://bccampus.ca>
 * Copyright 2012-2017 Brad Payne <https://bradpayne.ca>
 * Date: 2017-09-12
 * Licensed under GPLv3, or any later version
 *
 * @author Brad Payne
 * @package BCcampus\ApiClient\Controllers
 * @license https://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright (c) 2012-2017, Brad Payne
 */

namespace BCcampus\ApiClient\Controllers;

use BCcampus\ApiClient\Models;
use BCcampus\ApiClient\Views;

/**
 * Class Control
 * @package BCcampus\ApiClient\Controllers
 */
class WpApi {
	/**
	 * @var array
	 */
	protected $defaultArgs = array(
		'context'            => 'embed', // embed, view, edit
		'page'               => '1',
		'per_page'           => '100',
		'search'             => '',
		'after'              => '',
		'author'             => '',
		'author_exclude'     => '',
		'include'            => '',
		'offset'             => '',
		'order'              => 'desc',
		'orderby'            => 'date',
		'slug'               => '',
		'status'             => 'publish',
		'categories'         => '',
		'categories_exclude' => '',
		'tags'               => '',
		'tags_exclude'       => '',
		'sticky'             => '',
	);

	/**
	 * @var array
	 */
	private $args = array();


	/**
	 * constructor
	 *
	 * @param $args
	 */
	public function __construct( $args ) {
		// sanity check
		if ( ! is_array( $args ) ) {
			// TODO: add proper error handling
			//new Views\Errors( [ 'msg' => 'Sorry, this does not pass the smell test' ] );
		}

		$args_get = array(

			// Remove all characters except digits, plus and minus sign.
			'page'     => array(
				'filter' => FILTER_SANITIZE_NUMBER_INT,
			),
			'per_page' => array(
				'filter' => FILTER_SANITIZE_NUMBER_INT,
			),
			'offset' => array(
				'filter' => FILTER_SANITIZE_NUMBER_INT,
			),
			'author' => array(
				'filter' => FILTER_SANITIZE_NUMBER_INT,
			),
			'author_exclude' => array(
				'filter' => FILTER_SANITIZE_NUMBER_INT,
			),
		);

		// filter get input, delete empty values
		$get = ( false !== filter_input_array( INPUT_GET, $args_get, false ) ) ? filter_input_array( INPUT_GET, $args_get, false ) : '';

		if ( is_array( $get ) ) {
			// filtered get overrides defaultArgs
			$this->args = array_merge( $this->defaultArgs, $get );
			// programmer arguments override everything
			$this->args = array_merge( $this->args, $args );

		} else {
			// programmers can override everything if it's hardcoded
			$this->args = array_merge( $this->defaultArgs, $args );
		}

		$this->formatArgs( $this->args );
		$this->decider();
	}


	/**
	 * Ensures the arguments are formatted correctly before passing them
	 * to a Model class
	 *
	 * @param $args
	 */
	private function formatArgs( $args ) {
		if ( ! is_array( $args ) ) {
			return;
		}
		$this->args = $args;
	}

	/**
	 * Controls which views get returned
	 *
	 */
	protected function decider() {
		$rest_api = new Models\WpApi();

		$view = new Views\WpApi( $rest_api, $this->args );
		$view->renderAll();
	}

}
