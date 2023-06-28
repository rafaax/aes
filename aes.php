<?php 

$secret_key = openssl_random_pseudo_bytes(32); ## chave secreta 
$vi = openssl_random_pseudo_bytes(16); ## vetor de inicializacao

$params = array(
    'param1' => 'DWBDEjmGG', 
    'param2' => 'gKndZaSxe',
    'param3' => 'kZmHwSfHk'
);



foreach ($params as $secret_key => $value) {
    $params[$key] = openssl_encrypt($value, 'AES-128-CBC', $secret_key, 0, $vi);
}


$query = http_build_query($params);



print_r($params);
$url = 'http://192.168.0.38/estudos-rapha/criptografia/index.php?method=aes&' . $query;

// header('Location:'.$url);


