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
	private static $statePath;
	public static function getState(string $path)
	{
		if(file_exists($path))
		{
			$try = file_get_contents($path);

			if(false === $try)
			{
				die('Can not read '. $path);
			}
			
			$state = (array) json_decode($try);
		}
		else 
		{
			$state = ['start'=>0];
		}

		static::$statePath = $path;

		return $state;
	}

	public static function setState( $state )
	{
		file_put_contents(static::$statePath, json_encode($state));
	}

	public function finished()
	{
		if ( 'cli' == php_sapi_name())
		{
			static::setState(
				$this->result->output()
			);
		}
	}
}
