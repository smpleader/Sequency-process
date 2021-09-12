<?php

require_once '../include.php'; 

// Declare
$level = isset($_GET['level']) ? (int)$_GET['level'] : 0;
$process = new SequencyProcess\ProcessFile($level);
$process->setArray( demo::sampleArray() );

$sequence = new SequencyProcess\Sequence($process);

// Process each segment
$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
$output = $sequence->run($start, $limit); 

// Output json result
http_response_code(200);
header('Content-Type: application/json;charset=utf-8');
echo json_encode($output);

die;