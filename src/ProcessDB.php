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

class ProcessDB extends ProcessAbstract
{
	protected $db;
	protected $result;
	protected $data;
	protected $level = 0;

    public function setDB(object $db)
	{
		$this->db = $db;
	}

    public function getTotal()
	{
		// SELECT COUNT(id) FROM #__tbl_records
		return 0; // TODO return query_result
	}

	public function execute()
	{
		try{

			// SELECT * FROM #__tbl_records LIMIT  $this->result->start, $this->result->limit
			$current = []; // TODO return query_result

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

	public function prepare($start, $limit)
	{
		$this->result = new ProcessResult($start, $limit, $this->getTotal());
	}

	protected function process($data){}
	protected function finished(){}
}
