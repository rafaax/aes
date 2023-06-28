<?php 
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $param1 = $_GET['param1'];
    $param2 = $_GET['param2'];
    $param3 = $_GET['param3'];
    $type  = $_GET['type'];

    if($type == 'base64'){

        $response = array(
            'param1' => $param1,
            'param2' => $param2, 
            'param3' => $param3
        );

        $queryString = http_build_query($response);
        
        $decodedParams = array();
        parse_str($queryString, $decodedParams);

        foreach ($decodedParams as $key => $value) {
            $decodedParams[$key] = base64_decode($value);
        }   

        $decodedparam = $decodedParams['param1']; 
        $decodedparam2 = $decodedParams['param2']; 
        $decodedparam3 = $decodedParams['param3']; 

        file_put_contents('response_base64.txt', $decodedparam . PHP_EOL . $decodedparam2 . PHP_EOL . $decodedparam3);

    }else if($type == 'aes'){
        
        $key = file_get_contents('chave_aes.txt'); 
        $vi = file_get_contents('vetor.txt');
        
        $response = array(
            'param1' => $param1,
            'param2' => $param2, 
            'param3' => $param3
        );

        $queryString = http_build_query($response);
        
        $decodedParams = array();
        parse_str($queryString, $decodedParams);

        foreach($decodedParams as $key => $value) {
            $decodedParams[$key] = openssl_decrypt($value, 'AES-128-CBC', $key, 0, $vi);
        }

        $decodedparam = $decodedParams['param1']; 
        $decodedparam2 = $decodedParams['param2']; 
        $decodedparam3 = $decodedParams['param3'];

        file_put_contents('response_aes.txt', $decodedparam . PHP_EOL . $decodedparam2 . PHP_EOL . $decodedparam3);


    }else{
        echo 'type needs to be base64 or aes';
    }
}