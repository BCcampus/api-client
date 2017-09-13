<?php
/**
 * Project: eypd-events
 * Project Sponsor: BCcampus <https://bccampus.ca>
 * Copyright 2012-2017 Brad Payne <https://bradpayne.ca>
 * Date: 2017-09-12
 * Licensed under GPLv3, or any later version
 *
 * @author Brad Payne
 * @package EYPD\Views
 * @license https://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright (c) 2012-2017, Brad Payne
 */

namespace EYPD\Views;

use EYPD\Models;

/**
 * Class EypdPage
 * @package EYPD\Views
 */
class Page {

	private $events;

	public function __construct( Models\WpApi $data, $args ) {
		$this->events = $data->retrieve( $args );
	}

	public function renderAll() {
		$html = '<h2>Early Years Professional Development Events</h2>';

		foreach ( $this->events as $event ) {
			$html .= "<h4><a href='{$event['link']}'>{$event['title']['rendered']}</a></h4>";
			$html .= "<p>{$event['excerpt']['rendered']}</p>";
		}

		echo $html;

	}
}
