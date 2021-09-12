<?php if ( 'cli' != php_sapi_name() ) die('Only CLI');

require_once '../include.php'; 

// Declare
$level = isset($state['level']) ? (int)$state['level'] : 0;
$process = new SequencyProcess\ProcessFileCli($level);
$process->setStatePath( DEMO_PATH.'cli/state.log' );
$process->setArray( demo::sampleArray() );

$sequence = new SequencyProcess\Sequence($process);

// Process each segment
$state = $process->loadState();
$start = isset($state['start']) ? (int)$state['start'] : 0;
$limit = isset($state['limit']) ? (int)$state['limit'] : 5; 
$output = $sequence->run($start, $limit);

// Print result to terminal
foreach($output as $key=>$value)
{
    print("$key: $value.\n");
}
