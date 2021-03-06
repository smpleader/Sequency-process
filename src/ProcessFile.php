<?php
/**
 * Sequency Process - Class Process by an array use data from a file
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Class to process the sequency of an array from a file
 * 
 */

namespace SequencyProcess;

class ProcessFile extends ProcessArray
{
    public function loadData(string $path)
	{
		$try = file_get_contents($path);

		if(false === $try)
		{
			$this->error = 'Invalid file '. $path;
			$arr = [];
		}
		else
		{
			$arr = (array) json_decode($try);
		}

		$this->setArray($arr);
	}

	protected function try_execute()
	{
		try{

			$current = array_slice($this->arr, $this->result->start, $this->result->limit);

			foreach($current as $value)
			{
				// do sth with $value
			}

		} catch (Exception $e) {
			
			$this->error = $e->getMessage() ;
		}
	}
}
