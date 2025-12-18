<?php
$json = file_get_contents("../../config/config.json");
$json = json_decode($json);
foreach($json as $value => $key){
    echo $key;     
}
// if(!is_array($json)){
//     echo json_encode(['success' => false, 'message' => 'Ungültige Konfigurationsdatei']);
//     exit;


?>