<?php

ob_start();

include "checkJson.php";
include '../../config/php/connection.php';

ob_clean();



// Überprüfen, ob beide Werte vorhanden sind

// SQL-Abfrage mit Prepared Statement
$sql = "INSERT INTO infotherminals (titel, ipAdresse) VALUES (?, ?)";
$params = array($name, $ip);
$stmt = sqlsrv_prepare($conn, $sql, $params);

if ($stmt) {
    // Statement ausführen
    if (sqlsrv_execute($stmt)) {
        echo "Datensatz erfolgreich eingefügt";
        $ip = "";
        $name = "";
    } else {
        echo "Fehler beim Einfügen: ";
        print_r(sqlsrv_errors());
    }
    // Statement schließen

} else {
    // echo "Fehler bei der Vorbereitung: ";
    print_r(sqlsrv_errors());
    
}


sqlsrv_free_stmt($stmt);

sqlsrv_close($conn);
