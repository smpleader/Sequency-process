<?php
/**
 * Sequency Process - Class Process by an array use state from a file
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Class to process the sequency of an array from a file
 * 
 */

namespace SequencyProcess;

class ProcessFileCli extends ProcessFile
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
				$this->setStatePath( DEMO_PATH. 'state.log' );
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

	public function finished()
	{
		if ( 'cli' == php_sapi_name())
		{
			$res = $this->result->output();
			file_put_contents($this->statePath, json_encode($res));
		}
	}
}
