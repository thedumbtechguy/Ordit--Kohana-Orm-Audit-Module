<?php defined('SYSPATH') or die('No direct script access.');

class Model_Ordit_Log extends ORM 
{
	protected $_sorting = array( 'timestamp_created' => 'asc', );
}