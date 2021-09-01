<?php
/**
 * Sequency Process - Demo get data from a file
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Class to process the sequency of an array from a file
 * 
 */

use SequencyProcess\ProcessArray;

class ProcessFile extends ProcessArray
{
	protected $statePath;

	public function setStatePath(string $path)
	{
		$this->statePath = $path;
		if(!file_exists($this->statePath))
		{
			$try = fopen($this->statePath, 'a+');
			if(false === $try)
			{
				$this->setStatePath( PATH. 'state.log' );
			}
		}
	}

    public function loadState()
	{
		$try = file_get_contents($this->statePath);

		if(false === $try)
		{
			$this->error = 'Invalid file '. $path;
			$state = ['start'=>0];
		}
		else
		{
			$state = (array) json_decode($try);
		}

		return $state;
	}

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

	protected function process($data)
	{
		$this->data = $data;
	}

	public function finished()
	{
		if ( 'cli' == php_sapi_name())
		{
			$res = $this->result->output();
			file_put_contents($this->statePath, json_encode($res));
		}
	}

}