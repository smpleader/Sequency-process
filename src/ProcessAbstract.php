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

    abstract function getTotal();

	// process each step
	abstract function execute($start, $limit);

	// start new level
	abstract function next();

	// finished all
	abstract function final();
}
