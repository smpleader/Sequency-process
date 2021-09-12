<?php
/**
 * Sequency Process - Class Process by an array
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Class to process the sequency of an array
 * 
 */

namespace SequencyProcess;

class ProcessArray extends ProcessAbstract
{
	protected $arr;
	protected $result;
	protected $data;
	protected $level;

    public function setArray(array $input)
	{
		$this->arr = $input;
	}

    public function getTotal()
	{
		return is_array($this->arr) ? count($this->arr) : 0;
	}

	public function execute()
	{
		$this->try_execute();

		if($this->error)
		{
			$this->result->failed( $this->error );
		}
		else
		{
			$this->result->success($this->data, $this->level);
		}
	}

	public function final()
	{
		$this->result->final();
	}

	public function next()
	{
		$this->level++;
		$this->result->next($this->level);
	}

	public function prepare($start, $limit)
	{
		$this->result = new ProcessResult($start, $limit, $this->getTotal());
	}

	public function result()
	{
		$this->finished();
		return $this->result->output();
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

	protected function finished(){}
}
