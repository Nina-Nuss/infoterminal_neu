<?php
// ...existing code..

// Versuche Konfiguration aus JSON-Datei zu laden

// $server =  "10.1.6.3";
$serverName = "Nina\\SQLEXPRESS";

// $serverName = "Nina\\SQLEXPRESS";
$database = "testdbTerminal";
$UID = "";
$PWD = "";


$connectionOptions = array(
    "Database" => $database ?? "testdbTerminal",
    "CharacterSet" =>  "UTF-8",
    "TrustServerCertificate" =>  true,
    "Encrypt" =>  true,
    "UID" => $UID ?? "",
    "PWD" =>  $PWD ?? "",
);

// Verbindung herstellen
global $conn;
$conn = sqlsrv_connect( $serverName ?? "10.1.6.3", $connectionOptions);

// Verbindung überprüfen
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . print_r(sqlsrv_errors(), true));
} else {
    // echo "Verbindung erfolgreich hergestellt.";
}
?>