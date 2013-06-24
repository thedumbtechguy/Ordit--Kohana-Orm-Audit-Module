<?php defined('SYSPATH') or die('No direct script access.');

abstract class Model_Ordit_Ordit extends ORM 
{
	/*This should return the current logged in user's username*/
	abstract protected function get_username();
	
	public static $Types = array(
		'update',
		'create',
		'delete',
	);
	
	public function save(Validation $validation = NULL)
	{
		if($this->loaded())
			$log = $this->get_ordit_log("update");
		parent::save($validation);
		
		$log->save();
	}	
	
	public function create(Validation $validation = NULL)
	{
		parent::create($validation);
		$log = $this->get_ordit_log("create");
		
		$log->save();
	}
	
	public function delete()
	{
		$log = $this->get_ordit_log("delete");
		parent::delete();
		
		$log->save();
	}
	
	protected function get_ordit_log($action)
	{
		if($action == "delete" || $action == "create")
		{
			$values = array();
			foreach ($this->_original_values as $column => $value)
			{
				// Generate list of column => values
				$values[$column] = $value;
			}
		
		}
		else
		{
			$values = array();
			foreach ($this->_changed as $column)
			{
				// Generate list of column => values
				$values[$column] = array(
										'original' => $this->_original_values[$column],
										'updated' => $this->_object[$column],
									);
			}

		}
		
		$log = ORM::factory('ordit_log');
		
		$log->model = $this->_object_name;
		$log->action = $action;
		$log->values = json_encode($values);
		$log->user = $this->get_username();
		
		return $log;
	}
	

	
	
	
	
}