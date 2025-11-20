<?php
$data = json_decode(file_get_contents('php://input'), true);
$key = $data['key'] ?? "test";
$value = $data['value'] ?? "tesdfdsfst";

$key2 = $data['key2'] ?? "test2";

// echo json_encode("Key: " . $key . " Value: " . $value . "\n");

$jsonData = file_get_contents('../../../config/configTest.json');
$config = json_decode($jsonData, true);



$key = $data['key'];
$value = $data['value'];

$list = [] ;

$config['webpageSettings'][0][$key] = "jsdsjflksjflkdsjflksjf";
$config['webpageSettings'][0][$key] = $value;

foreach ($config as $key => $value) {
    echo $key . " => " . json_encode($value) . "\n";
}

echo $config["testSettings"][$list[2]];

foreach ($list as $key => $value) {
    echo $value;
    echo $config["testSettings"][1] . " . ";
}

file_put_contents('../../../config/configTest.json', json_encode($config, JSON_PRETTY_PRINT));
