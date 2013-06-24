<?php defined('SYSPATH') or die('No direct script access.');

class Model_Ordit extends Model_Ordit_Ordit 
{
	protected function get_username()
	{
		return 'Override ' . __CLASS__ . '::' . __FUNCTION__  ;
	}
}