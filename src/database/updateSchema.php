<?php

ob_start();

include '../../config/php/connection.php';

ob_clean();
// JSON-Daten aus der Anfrage abrufen
$data = json_decode(file_get_contents('php://input'), true);

echo "Received data: " . json_encode($data);

// Daten aus der Anfrage abrufen
$titel = $data["titel"];
$beschreibung = $data["beschreibung"];
$imagePath = $data["imagePath"];
$selectedTime = $data["selectedTime"];
$isAktiv = $data["isAktiv"];
$startTime = $data["startTime"];
$endTime = $data["endTime"];
$startDateTime = $data["startDateTime"];
$endDateTime = $data["endDateTime"];
$timeAktiv = $data["timeAktiv"] ?? false;
$wochentage = $data["wochentage"];
$dateAktiv = $data["dateAktiv"] ?? false;
$id = $data["id"]; // ID muss ebenfalls aus der Anfrage abgerufen werden

// SQL-Abfrage mit Prepared Statement für MSSQL - erweitert um timeAktiv und dateAktiv
$sql = "UPDATE schemas
SET titel = ?, beschreibung = ?, imagePath = ?, selectedTime = ?, isAktiv = ?, startTime = ?, endTime = ?, startDateTime = ?, endDateTime = ?, wochentage = ?, timeAktiv = ?, dateAktiv = ?
WHERE id = ?";

$params = array($titel, $beschreibung, $imagePath, $selectedTime, $isAktiv, $startTime, $endTime, $startDateTime, $endDateTime, $wochentage, $timeAktiv, $dateAktiv, $id);
$stmt = sqlsrv_prepare($conn, $sql, $params);

if ($stmt) {
    // Statement ausführen
    if (sqlsrv_execute($stmt)) {
        echo "Datensatz erfolgreich aktualisiert";
    } else {
        echo "Fehler beim Aktualisieren: ";
        print_r(sqlsrv_errors());
    }
    sqlsrv_free_stmt($stmt);
} else {
    echo "Fehler bei der Vorbereitung: ";
    print_r(sqlsrv_errors());
}

// Verbindung schließen
sqlsrv_close($conn);
