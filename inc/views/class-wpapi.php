<?php
/**
 * Project: api-client
 * Project Sponsor: BCcampus <https://bccampus.ca>
 * Copyright 2012-2017 Brad Payne <https://bradpayne.ca>
 * Date: 2017-09-12
 * Licensed under GPLv3, or any later version
 *
 * @author Brad Payne
 * @package BCcampus\ApiClientViews
 * @license https://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright (c) 2012-2017, Brad Payne
 */

namespace BCcampus\ApiClient\Views;

use BCcampus\ApiClient\Models;

/**
 * Class WpApi
 * @package BCcampus\ApiClient\Views
 */
class WpApi {

	private $events;

	public function __construct( Models\WpApi $data, $args ) {
		$this->events = $data->retrieve( $args );
	}

	public function renderAll() {
		$html = '';
		//      echo "<pre>";
		//      print_r( $this->events );
		//      echo "</pre>";
		//      die();
		if ( ! empty( $this->events ) ) {
			foreach ( $this->events as $event ) {
				$html .= "<h4><a href='{$event['link']}' target='_blank'>{$event['title']['rendered']}</a></h4>";
				if ( isset( $event['content']['rendered'] ) ) {
					$html .= "{$event['content']['rendered']}<hr>";
				} else {
					$html .= "<p>{$event['excerpt']['rendered']}</p>";

				}
			}
		}
		echo $html;
	}
}
