<?php
// CLI helper to create an admin user in the `employee` table.
// Usage (PowerShell):
//   php .\tools\create_admin_user.php <username> <password>
// If arguments are omitted the script will prompt for them.

if (PHP_SAPI !== 'cli') {
    echo "This script must be run from the command line.\n";
    exit(1);
}

require_once __DIR__ . '/../db/dbconn.php';

$argv0 = $argv[0] ?? 'create_admin_user.php';
$username = $argv[1] ?? null;
$password = $argv[2] ?? null;

if (!$username) {
    echo "Enter username: ";
    $username = trim(fgets(STDIN));
}

if (!$password) {
    // Basic prompt; hiding input is possible on some systems but omitted for portability
    echo "Enter password: ";
    $password = trim(fgets(STDIN));
}

if ($username === '' || $password === '') {
    echo "Username and password are required.\n";
    exit(1);
}

// Check if username already exists
$stmt = $conn->prepare('SELECT Employee_ID FROM employee WHERE Username = ? LIMIT 1');
if (!$stmt) {
    echo "Prepare failed: " . $conn->error . "\n";
    exit(1);
}
$stmt->bind_param('s', $username);
$stmt->execute();
$res = $stmt->get_result();
$exists = $res && $res->num_rows > 0;
$stmt->close();

if ($exists) {
    echo "User '$username' already exists. Aborting.\n";
    exit(1);
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO employee (Username, Password_Hash, Full_Name, Role) VALUES (?, ?, ?, ?)');
if (!$stmt) {
    echo "Prepare failed: " . $conn->error . "\n";
    exit(1);
}
$full = 'Admin';
$role = 'admin';
$stmt->bind_param('ssss', $username, $hash, $full, $role);
$ok = $stmt->execute();
if ($ok) {
    echo "Admin user created successfully (username: $username).\n";
} else {
    echo "Failed to create user: " . $stmt->error . "\n";
}
$stmt->close();
$conn->close();

?>