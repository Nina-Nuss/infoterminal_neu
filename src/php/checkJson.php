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

$jsonPageLimit = $jsonData['defaultMaxCountForInfoPages'];
$jsonInfoterminalLimit = $jsonData['defaultMaxCountForInfoTerminals'];
$jsonUserLimit = $jsonData['defaultUserLimit'];

global $listelengthValue;
$listelengthValue = array();



