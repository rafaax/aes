<?php 

$param1 = $_GET['param1'];
$param2 = $_GET['param2'];
$param3 = $_GET['param3'];


$response = array(
    'param1' => $param1,
    'param2' => $param2, 
    'param3' => $param3
);

// print_r($response);
file_put_contents('response.txt', $response);


$decodedParams = array();
parse_str($query, $decodedParams);

foreach($decodedParams as $key => $value) {
    $decodedParams[$key] = openssl_decrypt($value, 'AES-128-CBC', $key, 0, $iv);
}

$param1 = $decodedParams['param1']; 
$param2 = $decodedParams['param2']; 
$param3 = $decodedParams['param3'];

file_put_contents('response_decriptograda.txt', $param1 . PHP_EOL . $param2 . PHP_EOL . $param3);