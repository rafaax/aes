<?php 

/*  linkedin: https://www.linkedin.com/in/raphael-meireles-0482b522a/
    github: https://github.com/rafaax
    :) 
*/ 

// parametros para passar via get
$params = array(
    'param1' => 'DWBDEjmGG', 
    'param2' => 'gKndZaSxe',
    'param3' => 'kZmHwSfHk'
);

// criptografa as variaveis que vao ser passadas via get
foreach($params as $key => $value) {
    $params[$key] = base64_encode($value);
}

// print_r($params);

$query = http_build_query($params); # $querystring = param1=RFdCREVqbUdH&param2=Z0tuZFphU3hl&param3=a1ptSHdTZkhr

$url = 'http://192.168.0.38/estudos-rapha/criptografia/index.php?type=base64&' . $query;
# http://192.168.0.38/estudos-rapha/criptografia/index.php?param1=RFdCREVqbUdH¶m2=Z0tuZFphU3hl¶m3=a1ptSHdTZkhr


// redireciona para o index passando os parametros
header('Location:'. $url); 
