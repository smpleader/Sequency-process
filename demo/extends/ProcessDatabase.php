<?php
/**
 * Sequency Process - Demo get data from a database
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Class to process the sequency of an array records
 * 
 */

use SequencyProcess\ProcessDB;

class ProcessDatabase extends ProcessDB
{
    public function loadState()
	{
		// TODO: query state from DB 
		return null;
	}

	protected function try_execute($data)
	{
		$this->data = $data;
	}

	public function finished()
	{
		if ( 'cli' == php_sapi_name())
		{
			$res = $this->result->output();
			// TODO: query to update state to DB
			// json_encode($res);
		}
	}
}
