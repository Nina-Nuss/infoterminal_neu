<?php
// include("connection.php");

ob_start();
include("../database/selectInfotherminal.php");
include("../database/selectSchemas.php");
include("../database/selectUser.php");
ob_end_clean();
ob_clean();


$infoterminalListLength = count($infotherminalList1);
$schemalistLength = count($schemaList1);
$userlistLength = count($userList1);



$jsonFile = '../../config/config.json'; // Pfad zur JSON-Datei
$jsonData = json_decode(file_get_contents($jsonFile), true); // In ein PHP-Array umwandeln

global $listelengthValue;
$listelengthValue = array();


foreach ($jsonData as $key => $value) {
    if ($key === 'defaultMaxCountForInfoTerminals') {
        array_push($listelengthValue, [$value, $infoterminalListLength]);
    }
    if ($key === 'defaultMaxCountForInfoPages') {
        array_push($listelengthValue, [$value, $schemalistLength]);
    }
    if ($key === 'defaultUserLimit'){
        array_push($listelengthValue, [$value, $userlistLength]);
    }


}
foreach($listelengthValue as $key => $value){
    foreach($value as $key2 => $value2){
        echo ''. $key2 .''. $value2 .'';
    }
};

return $listelengthValue;