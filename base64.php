<?php 

$params = array(
    'param1' => 'DWBDEjmGG', 
    'param2' => 'gKndZaSxe',
    'param3' => 'kZmHwSfHk'
);

foreach($params as $key => $value) {
    $params[$key] = base64_encode($value);
}


print_r($params);
$queryString = http_build_query($params);

$url = 'http://192.168.0.38/estudos-rapha/criptografia/index.php?method=base64&' . $queryString;
# http://192.168.0.38/estudos-rapha/criptografia/index.php?param1=RFdCREVqbUdH¶m2=Z0tuZFphU3hl¶m3=a1ptSHdTZkhr

echo $url;

