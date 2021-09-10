<?php

require_once '../include.php'; 

// Declare
$process = new ProcessFile();
$process->setArray( demo::sampleArray() );

$sequence = new SequencyProcess\Sequence($process);

// Process each segment
$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
$limit = 5; // should have this from a configuration
$level = isset($_GET['level']) ? (int)$_GET['level'] : 0;
$output = $sequence->run($start, $limit, $level); 

// Output json result
http_response_code(200);
header('Content-Type: application/json;charset=utf-8');
echo json_encode($output);

die;