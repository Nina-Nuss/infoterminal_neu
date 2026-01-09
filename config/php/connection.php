<?php
// ...existing code..
// Versuche Konfiguration aus JSON-Datei zu laden
// $server =  "10.1.6.3";
// $serverName = "10.1.6.21";
$serverName = "FIS-BW-03\SQLEXPRESS";
//  $serverName = "NINA\SQLEXPRESS";
$database = "dbTerminal";
// $UID = "sa";
// $PWD = "A%00000p&";
// $UID = "sa";

// $PWD = "123456789";

$connectionOptions = array(
    "Database" => $database ?? "dbTerminal",
    "CharacterSet" =>  "UTF-8",
    "TrustServerCertificate" =>  true,
    "Encrypt" =>  true,
    "UID" => $UID ?? "",
    "PWD" =>  $PWD ?? "",
);
global $conn;
$conn = sqlsrv_connect( $serverName ?? "FIS-BW-03\SQLEXPRESS", $connectionOptions);
if (!$conn) {
    header("Location: /src/output/connectionError.php");
    exit();
} else {
    
    // echo "Verbindung erfolgreich hergestellt.";
}
?>

















