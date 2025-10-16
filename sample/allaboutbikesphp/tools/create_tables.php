<?php
require_once __DIR__ . '/../db/dbconn.php';
$sqlFile = __DIR__ . '/../db/create_tables.sql';
if (!file_exists($sqlFile)) {
    echo "SQL file not found: $sqlFile\n";
    exit(1);
}
$sql = file_get_contents($sqlFile);
if ($conn->multi_query($sql)) {
    do {
        if ($res = $conn->store_result()) {
            $res->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    echo "SQL executed successfully.\n";
} else {
    echo "Error executing SQL: " . $conn->error . "\n";
}
$conn->close();
?>