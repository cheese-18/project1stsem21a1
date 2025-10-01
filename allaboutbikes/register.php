<?php
session_start();
require_once __DIR__ . '/db/dbconn.php';

$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empId = (int) ($_POST['Employee_ID'] ?? 0);
    $username = trim($_POST['employeeUsername'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    if ($empId <= 0 || $username === '' || $password === '' || $confirm === '') {
        $error = 'Employee ID, username and passwords are required.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {

        $stmt = $conn->prepare("SELECT Employee_ID, passwordHash FROM employee WHERE Employee_ID = ? LIMIT 1");
        if (! $stmt) {
            $error = 'Database error: ' . htmlspecialchars($conn->error);
        } else {
            $stmt->bind_param('i', $empId);
            $stmt->execute();
            $res = $stmt->get_result();
            if (! $res || $res->num_rows === 0) {
                $error = 'Employee ID not found. Registration not allowed.';
            } else {
                $row = $res->fetch_assoc();

                if (!empty($row['passwordHash'])) {
                    $error = 'This employee is already registered.';
                } else {

                    $chk = $conn->prepare("SELECT 1 FROM employee WHERE employeeUsername = ? AND Employee_ID <> ? LIMIT 1");
                    if (! $chk) {
                        $error = 'Database error: ' . htmlspecialchars($conn->error);
                    } else {
                        $chk->bind_param('si', $username, $empId);
                        $chk->execute();
                        $chk->store_result();
                        if ($chk->num_rows > 0) {
                            $error = 'Username already taken.';
                        } else {
                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            $upd = $conn->prepare("UPDATE employee SET employeeUsername = ?, passwordHash = ? WHERE Employee_ID = ? LIMIT 1");
                            if (! $upd) {
                                $error = 'Database error: ' . htmlspecialchars($conn->error);
                            } else {
                                $upd->bind_param('ssi', $username, $hash, $empId);
                                if ($upd->execute()) {
                                    $success = 'Registration complete. You may now log in.';
                                } else {
                                    $error = 'Registration failed: ' . htmlspecialchars($upd->error);
                                }
                                $upd->close();
                            }
                        }
                        $chk->close();
                    }
                }
            }
            $stmt->close();
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Employee Register</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
    body { background:#f8f9fa; padding:20px; }
    .card { max-width:540px; margin:30px auto; }
</style>
</head>
<body>
<div class="card shadow">
  <div class="card-body">
    <h5 class="card-title mb-3">Employee Registration</h5>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
      <div class="mb-2">
        <label class="form-label">Employee ID</label>
        <input type="number" name="Employee_ID" class="form-control" required value="<?= htmlspecialchars($_POST['Employee_ID'] ?? '') ?>">
        <div class="form-text">Registration allowed only if this Employee ID already exists in the employee table.</div>
      </div>

      <div class="mb-2">
        <label class="form-label">Username</label>
        <input type="text" name="employeeUsername" class="form-control" required value="<?= htmlspecialchars($_POST['employeeUsername'] ?? '') ?>">
      </div>

      <div class="mb-2">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="confirm" class="form-control" required>
      </div>

      <button class="btn btn-primary w-100" type="submit">Register</button>
      <a href="adminlogin.php" class="btn btn-link w-100 mt-2">Back to Login</a>
    </form>
  </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>