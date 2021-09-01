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
	protected $level = 0;

    public function setArray(array $input)
	{
		$this->arr = $input;
	}

    public function getTotal()
	{
		return is_array($this->arr) ? 0 : sizeof($this->arr);
	}

	public function execute($start, $limit)
	{
		$this->result = new ProcessResult($start, $limit, $this->getTotal());

		try{

			$current = array_slice($this->arr, $start, $limit);

			foreach($current as $value)
			{
				$this->process($value);
			}

		} catch (Exception $e) {

			$this->result->failed( $e->getMessage() );
			$this->finished();
			return $this->result->output();
		}

		if($this->error)
		{
			$this->result->failed( $this->error );
		}
		else
		{
			$this->result->success($this->data, $this->level);
		}

		$this->finished();
		return $this->result->output();
	}

	public function final()
	{
		$this->result->final();
		$this->finished();
		return $this->result->output();
	}

	public function next()
	{
		$this->result->next($this->level++);
		$this->finished();
		return $this->result->output();
	}

	protected function process($data){}
	protected function finished(){}
}
