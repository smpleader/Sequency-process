<?php
/**
 * Sequency Process - Class Sequence
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Class process the sequency
 * 
 */

namespace SequencyProcess;

class Sequence
{
    protected $process;
    protected $maxLevel;

    public function __construct(Process $process, $maxLevel=0)
    {
        $this->process = $process;
        $this->maxLevel = $maxLevel;
    }

    public function run($start, $limit = 20)
    {
		$length = $this->process->getTotal();

		if($start >= $length)
		{
            if( empty($this->maxLevel) || $this->maxLevel == $this->process->level )
            {
                return $this->process->final();
            }
            
            return $this->process->next();
		}

		return $this->process->execute($start, $limit);
    }
}
