<?php defined('SYSPATH') or die('No direct script access.');


Route::set('orditlogviewer', 'ordit/(<year>(/<month>(/<day>(/<act>))))')
	->defaults(array(
		'controller' => 'ordit',
		'action'     => 'index',
	));
