<?php

namespace EYPD\Polymorphism;

interface RestInterface {

function retrieve( $args );
function create();
function replace();
function remove();
}
