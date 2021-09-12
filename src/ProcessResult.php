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
	protected $percentage;  

	public function __construct($start, $limit, $length)
	{
		$this->start = $start;
		$this->limit = $limit;
		$this->length = $length;
	}

	public function setMsg($msg)
	{
		$this->msg = $msg;
	}

	public function getMsg( $default='')
	{
		return empty($this->msg) ? $default : $this->msg;
	}

	public function failed($msg)
	{
		$this->output = [
			'msg' => $msg,
			'data' => false
		];
	}

	public function getNext()
	{
		return $this->start + $this->limit;
	}

	public function getPercentage()
	{
		if( null === $this->percentage )
		{
			$next = $this->getNext();
			$this->percentage = $next > $this->length ? 100 : ($next / $this->length) * 100;
			$this->percentage = (int)$this->percentage;
		}

		return $this->percentage;
	}

	public function success($data=null, $level, $msg='')
	{ 
		$percentage = $this->getPercentage();
		$next = $this->getNext();

		if( empty($msg) )
		{
			$msg = $this->getMsg($percentage.'% done');
		}

		$this->output = [
			'msg' => $msg,
			'data'=> $data,
			'level'=> $level,
			'start'=> $next,
			'limit' => $this->limit,
			'percentage'=> $percentage
		];
	}

	public function final($msg = '')
	{
		if( empty($msg) )
		{
			$msg = $this->getMsg('DONE');
		}

		$this->output = [
			'msg' => $msg,
			'data' => true
		];
	}

	public function next($level, $msg='')
	{
		if( empty($msg) )
		{
			$msg = $this->getMsg('Next step '.$level);
		}
		
		$this->output = [
			'msg' => $msg,
			'level' => $level,
			'start' => 0,
			'limit' => $this->limit,
			'data'=> true,
			'percentage'=> 0
		];
	}

	public function output()
	{
		return $this->output;
	}
}
