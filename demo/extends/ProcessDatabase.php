<?php
/**
 * Sequency Process - Demo get data from a database
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Class to process the sequency of an array records
 * 
 */

use SequencyProcess\ProcessArray;

class ProcessDatabase extends ProcessArray
{
	protected $db;
	protected $result;
	protected $data; 

    public function setDB(object $db)
	{
		$this->db = $db;
	}

    public function getTotal()
	{
		// TODO
		// return $this->db->query( SELECT COUNT(id) FROM #__tbl_records )
		return 0;
	}
 
	protected function try_execute()
	{
		try{
			// TODO
			// SELECT * FROM #__tbl_records LIMIT  $this->result->start, $this->result->limit
			$current = [];

			foreach($current as $value)
			{
				// TODO
				// process $value
			}

		} catch (Exception $e) {

			$this->error = $e->getMessage() ;
		}
	}

    public function loadState()
	{
		// TODO
		// $this->db->query( SELECT status FROM #__tbl_states )
		return null;
	}

	public function finished()
	{
		if ( 'cli' == php_sapi_name())
		{
			$res = $this->result->output();
			// TODO
			// $this->db->query( UPDATE #__tbl_states SET status = json_encode($res) )
		}
	}
}
