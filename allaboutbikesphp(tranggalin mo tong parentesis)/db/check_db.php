<?php
// Quick DB checker for this project. Run from a browser or CLI (php db/check_db.php)
require_once __DIR__ . '/dbconn.php';

$expected = [
    'employee','customer','bike','part','sale','sale_detail','rental','repair'
];

$found = [];
$res = $conn->query("SHOW TABLES");
if ($res) {
    while ($row = $res->fetch_array()) {
        $found[] = $row[0];
    }
}

$missing = array_diff($expected, $found);

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'connected' => ($conn instanceof mysqli && !$conn->connect_error),
    'database' => $conn->real_escape_string($conn->query("SELECT DATABASE() AS db")->fetch_object()->db ?? null),
    'found_tables' => $found,
    'missing_tables' => array_values($missing)
], JSON_PRETTY_PRINT);

?>