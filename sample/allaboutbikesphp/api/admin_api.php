<?php
session_start();
require_once __DIR__ . '/../db/dbconn.php';
header('Content-Type: application/json; charset=utf-8');

if (empty($_SESSION['admin_logged_in'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit;
}
$action = $_REQUEST['action'] ?? '';

if ($action === 'list_parts') {
    $res = $conn->query("SELECT Part_ID, Name, Part_Type, Brand, Price, Stock_Quantity FROM part ORDER BY Part_ID DESC");
    $rows = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    echo json_encode(['success' => true, 'data' => $rows]);
    exit;
}

if ($action === 'delete_part') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id <= 0) { echo json_encode(['success' => false, 'message' => 'Invalid id']); exit; }
    $stmt = $conn->prepare("DELETE FROM part WHERE Part_ID = ? LIMIT 1");
    $stmt->bind_param('i', $id);
    $ok = $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => $ok]);
    exit;
}

if ($action === 'add_part' || $action === 'update_part') {
    $id = (int)($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $brand = trim($_POST['brand'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $stock = (int)($_POST['stock'] ?? 0);
    if ($name === '') { echo json_encode(['success' => false, 'message' => 'Name required']); exit; }
    if ($price < 0 || $stock < 0) { echo json_encode(['success' => false, 'message' => 'Negative values not allowed']); exit; }
    if ($action === 'add_part') {
        $stmt = $conn->prepare("INSERT INTO part (Name, Part_Type, Brand, Price, Stock_Quantity) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssdi', $name, $type, $brand, $price, $stock);
        $ok = $stmt->execute();
        $id = $conn->insert_id;
        $stmt->close();
        echo json_encode(['success' => $ok, 'id' => $id]);
        exit;
    } else {
        if ($id <= 0) { echo json_encode(['success' => false, 'message' => 'Invalid id']); exit; }
        $stmt = $conn->prepare("UPDATE part SET Name=?, Part_Type=?, Brand=?, Price=?, Stock_Quantity=? WHERE Part_ID=? LIMIT 1");
        $stmt->bind_param('sssdii', $name, $type, $brand, $price, $stock, $id);
        $ok = $stmt->execute();
        $stmt->close();
        echo json_encode(['success' => $ok]);
        exit;
    }
}

// repairs endpoints
if ($action === 'list_repairs') {
    $res = $conn->query("SELECT Repair_ID, Customer_ID, Bike_ID, Service, Price, Status, Created_At FROM repair ORDER BY Repair_ID DESC");
    $rows = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    echo json_encode(['success' => true, 'data' => $rows]);
    exit;
}
if ($action === 'update_repair') {
    $id = (int)($_POST['id'] ?? 0);
    $status = trim($_POST['status'] ?? '');
    if ($id <= 0) { echo json_encode(['success' => false, 'message' => 'Invalid id']); exit; }
    $stmt = $conn->prepare("UPDATE repair SET Status = ? WHERE Repair_ID = ? LIMIT 1");
    $stmt->bind_param('si', $status, $id);
    $ok = $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => $ok]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Unknown action']);
exit;
?>