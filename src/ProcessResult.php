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

	public function setMsg($key, $value='')
	{
		if( is_string($key) )
		{
			$this->msg[$key] = $value;
		}
		elseif( is_array($key))
		{
			$this->msg = $key;
		}
	}

	public function getMsg($key, $default='')
	{
		return isset($this->msg[$key]) ? $this->msg[$key] : $default;
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
		$percentage = (int)$this->getPercentage();

		if( empty($msg) )
		{
			$msg = $this->getMsg('success', $percentage.'% done');
		}

		$this->output = [
			'msg' => $msg,
			'data'=> $data,
			'level'=> $level,
			'start'=> $next,
			'percentage'=> $percentage
		];
	}

	public function final($msg = '')
	{
		if( empty($msg) )
		{
			$msg = $this->getMsg('final', 'DONE');
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
			$msg = $this->getMsg('next', 'Next step '.$level);
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
