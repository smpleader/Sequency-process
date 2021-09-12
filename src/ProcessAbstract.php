<?php
/**
 * Sequency Process - Abstract Process
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Abstract about process
 * 
 */

namespace SequencyProcess;

abstract class ProcessAbstract
{
	protected $level;
	protected $error;

	function __construct($level = 0)
	{
		$this->level = $level;
	}

    function getLevel()
	{
		return $this->level;
	}

    abstract function getTotal();

	// process each step
	abstract function prepare($start, $limit);

	// process each step
	abstract function execute();

	// start new level
	abstract function next();

	// finished all
	abstract function final();

	// output a result
	abstract function result();
}
