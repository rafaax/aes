<?php 
if ($_SERVER['REQUEST_METHOD'] === 'GET') { // valida se a requisicao é get

    // recupera os parametros e atribui-os à variáveis
    $param1 = $_GET['param1'];
    $param2 = $_GET['param2'];
    $param3 = $_GET['param3'];
    $type  = $_GET['type'];

    
    // valida o tipo
    if($type == 'base64'){

        $response = array(
            'param1' => $param1,
            'param2' => $param2, 
            'param3' => $param3
        );

        // builda a query
        $queryString = http_build_query($response);
        
        // cria o array decodedParams
        $decodedParams = array();
        // separa o array em variáveis
        parse_str($queryString, $decodedParams);

        // decriptografa as variáveis
        foreach ($decodedParams as $key => $value) {
            $decodedParams[$key] = base64_decode($value);
        }   

        // separa em 3 variáveis
        $decodedparam = $decodedParams['param1']; 
        $decodedparam2 = $decodedParams['param2']; 
        $decodedparam3 = $decodedParams['param3']; 

        // escreve a resposta em um txt
        file_put_contents('response_base64.txt', $decodedparam . PHP_EOL . $decodedparam2 . PHP_EOL . $decodedparam3);

    }else if($type == 'aes'){
        
        // recupera a key e o vetor de inicializacao dos respectivos arquivos
        $key = file_get_contents('chave_aes.txt'); 
        $vi = file_get_contents('vetor.txt');
        
        // cria um array com os valores do get
        $response = array(
            'param1' => $param1,
            'param2' => $param2, 
            'param3' => $param3
        );

        // cria a query
        $queryString = http_build_query($response);
        
        // cria o array decodedParams
        $decodedParams = array();
        // separa o array em variáveis
        parse_str($queryString, $decodedParams);

        // decriptografa as variáveis
        foreach($decodedParams as $key => $value) {
            $decodedParams[$key] = openssl_decrypt($value, 'AES-128-CBC', $key, 0, $vi);
        }

        // separa em 3 variáveis
        $decodedparam = $decodedParams['param1']; 
        $decodedparam2 = $decodedParams['param2']; 
        $decodedparam3 = $decodedParams['param3'];

        // escreve a resposta em um txt
        file_put_contents('response_aes.txt', $decodedparam . PHP_EOL . $decodedparam2 . PHP_EOL . $decodedparam3);


    }else{
        echo 'type precisa ser base64 ou aes';
    }
}else{
    echo 'requisicao precisa ser GET';
}