<?php 

// gera as chaves
$secret_key = openssl_random_pseudo_bytes(32); ## chave secreta 
$vi = openssl_random_pseudo_bytes(16); ## vetor de inicializacao

// escreve as variaveis em arquivos txt para serem carregadas no index para fazer a descriptografia
file_put_contents('chave_aes.txt', $secret_key); 
file_put_contents('vetor.txt', $vi);

// parametros para passar via get
$params = array(
    'param1' => 'DWBDEjmGG', 
    'param2' => 'gKndZaSxe',
    'param3' => 'kZmHwSfHk'
);


// faz a criptografia
foreach ($params as $secret_key => $value) {
    $params[$secret_key] = openssl_encrypt($value, 'AES-128-CBC', $secret_key, 0, $vi);
}

// print_r($params);

$query = http_build_query($params);
// $query = param1=bTozOBLTQQofU7MFrjU2uQ%3D%3D&param2=yUjcH6n4koI22dzjLvsQAQ%3D%3D&param3=4Ybd7UhQu%2FmhmSCo4vVjaw%3D%3D

$url = 'http://192.168.0.38/estudos-rapha/criptografia/index.php?type=aes&' . $query;
// index.php?type=aes&param1=bTozOBLTQQofU7MFrjU2uQ%3D%3D&param2=yUjcH6n4koI22dzjLvsQAQ%3D%3D&param3=4Ybd7UhQu%2FmhmSCo4vVjaw%3D%3D

// redireciona para o index
header('Location:'.$url);