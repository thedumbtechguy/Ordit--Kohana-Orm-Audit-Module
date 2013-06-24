<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ordit extends Controller {

    /**
     * @var View
     */
    public $layout;

    private $_year;
    private $_month;
    private $_day;
    private $_action;

    function before()
    {
        $this->layout = new View('ordit/layout');

        $today = getdate();
        $this->_year = $this->request->param('year', $today['year'] );
        $this->_month = $this->request->param('month', $today['mon']);
        $this->_day = $this->request->param('day', $today['mday']);
        $this->_action = $this->request->param('act', null);
    }

	public function action_index()
	{	
		$this->_setLayoutVars();
        if($this->_getMonths()){
            $this->layout->set('content', $this->_getLogReport($this->_action));

        } else {
            $this->layout->set('content', $this->_createMessage("<b>No logs yet!</b> Make sure you are extending Ordit in your models.", 'error' ));
        }

        $this->response->body($this->layout);
	}

    protected function _setLayoutVars()
    {
        $this->layout->set('months', $this->_getMonths());
        $this->layout->set('days', $this->_getDays());

        $this->layout->set_global('active_month', "$this->_year/$this->_month");
        $this->layout->set_global('active_day', $this->_day);
        $this->layout->set_global('active_report', "$this->_day.php");
        $this->layout->set_global('log_action', $this->_action);
    }

    private function _getMonths()
    {
		$months = array();
        
		$query = DB::query(Database::SELECT, 'SELECT DISTINCT(SUBSTRING(  `timestamp_created` , 1, 7 )) AS ym FROM `ordit_logs`');
		foreach($query->execute()->as_array() as $row)
		{
			$months[] = str_replace('-', '\\', $row['ym']);
		}
		
        return $months;
    }

    private function _getDays()
    {
        $query = DB::query(Database::SELECT, 'SELECT DISTINCT(SUBSTRING(`timestamp_created` , 9, 2)) AS d 
												FROM `ordit_logs` 
												WHERE `timestamp_created` LIKE :ym');
		$query->parameters(array(
			':ym' => "{$this->_year}-{$this->_month}%",
		));
		
		$days = Arr::pluck($query->execute()->as_array(), 'd');

        return $days;
    }

    private function _getLogReport($action = null)
    {
		$logs = ORM::factory('Ordit_Log')->where('timestamp_created', 'LIKE', "{$this->_year}-{$this->_month}-{$this->_day}%");
		
		if($action) 
		{
			$logs->and_where('action', '=', strtolower($action));
		}
		
		$logs = $logs->find_all()->as_array(); 
		
		if(!empty($logs))
		{
            $title  = "Log Report - {$this->_year}/{$this->_month}/{$this->_day}";
            $title .= ' <small>'. (($this->_action) ? strtoupper(" {$this->_action}") : ' All'). ' Logs</small>';
            
            return View::factory('ordit/report', array(
                      'logs' => $logs,
                      'header' => $title
                    ));

		} 
		else 
		{
            return $this->_createMessage("<b>No logs found for {$this->_year}/{$this->_month}/{$this->_day}!</b> Please select a date from left sidebar.", 'warning');
        }
    }

    /**
     * Create HTML for alert message
     *
     * @param $message
     * @param $type error|success|info|warning
     * @return string Message HTML
     */
    private function _createMessage($message, $type)
    {
        return "<div class=\"alert-message {$type}\"><p>{$message}</p></i></div>";
    }



} // End Controller_Logs
