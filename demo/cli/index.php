<?php if ( 'cli' != php_sapi_name() ) die('Only CLI');

require_once '../include.php'; 

// Declare
$state = SequencyProcess\ProcessFileCli::getState( DEMO_PATH.'cli/state.log' );

$level = isset($state['level']) ? (int)$state['level'] : 0;
$start = isset($state['start']) ? (int)$state['start'] : 0;
$limit = isset($state['limit']) ? (int)$state['limit'] : 5; 

$process = new SequencyProcess\ProcessFileCli($level);
//$process->loadData( DEMO_PATH.'cli/array.php' ); can load data from a file
$process->setArray( demo::sampleArray() );

$sequence = new SequencyProcess\Sequence($process);

// Process each segment 
$output = $sequence->run($start, $limit);

// Print result to terminal
foreach($output as $key=>$value)
{
    print("$key: $value.\n");
}
