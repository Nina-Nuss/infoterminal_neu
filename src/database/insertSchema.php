<?php
ob_start();
include("../php/checkJson.php");
include '../../config/php/connection.php';
ob_clean();

$file = file_get_contents('php://input');
$data = json_decode($file, true);

if (!is_array($data)) {
    sqlsrv_close($conn);
    echo json_encode(['success' => false, 'message' => 'Ungültige JSON-Daten']);
    exit;
}

$imagePath = $data["imagePath"];
$selectedTime = $data["selectedTime"];
$aktiv = $data["aktiv"];
$startTime = $data["startTime"];
$endTime = $data["endTime"];
$startDate = $data["startDateTime"];
$endDate = $data["endDateTime"];
$timeAktiv = $data["timeAktiv"];
$dateAktiv = $data["dateAktiv"];
$wochentage = $data["wochentage"];
$titel = $data["titel"] ?? null;
$beschreibung = $data["beschreibung"] ?? null;

// SQL-Abfrage mit Prepared Statement
$sql = "INSERT INTO schemas (imagePath, selectedTime, isAktiv, startTime, endTime, startDateTime, endDateTime, timeAktiv, dateAktiv, titel, wochentage, beschreibung) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$params = array($imagePath, $selectedTime, $aktiv, $startTime, $endTime, $startDate, $endDate, $timeAktiv, $dateAktiv, $titel, $wochentage, $beschreibung);
$stmt = sqlsrv_prepare($conn, $sql, $params);

if (!$stmt) {
    sqlsrv_close($conn);
    echo json_encode(['success' => false, 'message' => 'Prepare failed', 'errors' => sqlsrv_errors()]);
    exit;
}

if (!sqlsrv_execute($stmt)) {
    sqlsrv_free_stmt($stmt); // ✅ Statement schließen
    sqlsrv_close($conn);
    echo json_encode(['success' => false, 'message' => 'Execute failed', 'errors' => sqlsrv_errors()]);
    exit;
}

// ✅ Erstes Statement schließen
sqlsrv_free_stmt($stmt);

// Letzte eingefügte ID abrufen
$sql2 = "SELECT TOP 1 id FROM dbo.schemas ORDER BY id DESC";
$stmt2 = sqlsrv_query($conn, $sql2);

if ($stmt2 === false) {
    sqlsrv_close($conn);
    echo json_encode(['success' => false, 'message' => 'Query failed', 'errors' => sqlsrv_errors()]);
    exit;
}

$row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);

// ✅ Zweites Statement schließen
sqlsrv_free_stmt($stmt2);
sqlsrv_close($conn);

// ✅ Konsistente Response-Struktur
if ($row === null) {
    echo json_encode(['success' => false, 'message' => 'Keine ID gefunden']);
} else {
    echo json_encode(['success' => true, 'id' => $row["id"]]);
}

exit; // ✅ Script explizit beenden
?>