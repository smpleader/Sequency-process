<?php if ( 'cli' != php_sapi_name() ) die('Only CLI');

require_once '../include.php'; 

// Declare
$process = new ProcessArrayFile();
$process->setStatePath( PATH.'cli/state.log' );
$process->setArray( demo::sampleArray() );

$sequence = new SequencyProcess\Sequence($process);

// Process each segment
$state = $process->loadState();
$start = isset($state['start']) ? (int)$state['start'] : 0;
$limit = 5; // should have this from a configuration
$output = $sequence->run($start, $limit);

// Print result to terminal
foreach($output as $key=>$value)
{
    print("$key: $value.\n");
}
