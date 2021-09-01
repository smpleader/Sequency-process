<?php
/**
 * Sequency Process - Class Result
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Class to standardized the result
 * 
 */

namespace SequencyProcess;

class ProcessResult
{
	public $start;  
	public $limit;  
	protected $msg; 
	protected $length;  
	protected $output;  

	public function __construct($start, $limit, $length)
	{
		$this->start = $start;
		$this->limit = $limit;
		$this->length = $length;
	}

	public function failed($msg)
	{
		$this->output = [
			'msg' => $msg,
			'data' => false
		];
	}

	public function success($data=null, $level, $msg='')
	{ 
		$next = $this->start + $this->limit;
		$percentage = $next > $this->length ? 100 : ($next / $this->length) * 100;
		$percentage = (int)$percentage;

		if( empty($msg) )
		{
			$msg = $percentage.'% done';
		}

		$this->output = [
			'msg' => $msg,
			'data'=> $data,
			'level'=> $level,
			'start'=> $next,
			'percentage'=> $percentage
		];
	}

	public function final($msg = 'DONE')
	{
		$this->output = [
			'msg' => $msg,
			'data' => true
		];
	}

	public function next($level, $msg='')
	{
		$this->output = [
			'msg' => $msg,
			'level' => $level,
			'start' => 0,
			'data'=> true,
			'percentage'=> 0
		];
	}

	public function output()
	{
		return $this->output;
	}
}
