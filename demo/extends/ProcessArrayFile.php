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

class ProcessArrayFile extends ProcessArray
{
	protected $statePath;

	public function setStatePath(string $path)
	{
		$this->statePath = $path;
	}

    public function loadState()
	{
		$try = file_get_contents($path);

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
		$res = $this->result->output();

		file_put_contents($this->statePath, json_encode($res));
	}

}
