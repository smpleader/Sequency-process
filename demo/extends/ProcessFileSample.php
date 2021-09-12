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
	public function levelToName($ind = null)
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

		$current = $this->levelToName($this->level);
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

	public function final()
	{
		$current = $this->levelToName($this->level);
		$this->result->setMsg( 'We finished '.$current);

		$this->result->final();
		$this->finished();
		return $this->result->output();
	}

	public function next()
	{
		$current = $this->levelToName($this->level);
		switch($current)
		{
			case 'step1':
				$this->result->setMsg('Start next step 2');
				break;
			case 'step2':
				$this->result->setMsg('Start next step 3');
				$this->result->limit = 5;
				break;
			case 'step3':
				$this->result->setMsg('Oh, I see the destination');
				break;
		}

		$this->level++;
		$this->result->next($this->level);
		$this->finished();
		return $this->result->output();
	}
}
