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

	public function success($data=null, $level, $msg='')
	{ 
		$next = $this->start + $this->limit;
		$percentage = $next > $this->length ? 100 : ($next / $this->length) * 100;
		$percentage = (int)$percentage;

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
			'data'=> true,
			'percentage'=> 0
		];
	}

	public function output()
	{
		return $this->output;
	}
}
