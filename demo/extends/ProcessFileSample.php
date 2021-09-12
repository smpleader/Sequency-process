<?php
/**
 * Sequency Process - Class Process by an array use data from a file
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Class to process the sequency of an array from a file
 * 
 */

use SequencyProcess\ProcessFile;

class ProcessFileSample extends ProcessFile
{
	public function getLevelName($ind = null)
	{
		$levels = [
			'step1',
			'step2',
			'step3'
		];

		return null === $ind ? $levels : $levels[$ind];
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

		if(empty($this->error))
		{
			$current = $this->getLevelName($this->level);
			switch($current)
			{
				case 'step1':
					$this->result->setMsg('Step 1 processed '. $this->result->getPercentage().'%' );
					break;
				case 'step2':
					$this->result->setMsg('Step 2 processed '. $this->result->getPercentage().'%');
					break;
				case 'step3':
					$this->result->setMsg('Step 3 processed '. $this->result->getPercentage().'%');
					break;
			}
		}
	}

	public function final()
	{
		$this->result->final('We finished the work!');
	}

	public function next()
	{
		$current = $this->getLevelName($this->level);
		switch($current)
		{
			case 'step1':
				$this->result->setMsg('Start step 2');
				$this->result->limit = 25;
				break;
			case 'step2':
				$this->result->setMsg('Start step 3');
				$this->result->limit = 5;
				break;
			case 'step3':
				$this->result->setMsg('Oh, I see the destination');
				break;
		}

		$this->level++;
		$this->result->next($this->level);
	}
}
