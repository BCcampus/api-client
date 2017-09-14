<?php

namespace BCcampus\ApiClient\Polymorphism;

interface RestInterface {

	function retrieve( $args );
	function create();
	function replace();
	function remove();
}
