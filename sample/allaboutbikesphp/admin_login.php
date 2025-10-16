<?php
session_start();
require_once __DIR__ . '/db/dbconn.php';

// Simple admin login using employee table. Use password_hash() when creating employees.
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $password === '') {
        $message = 'Username and password required';
    } else {
        $stmt = $conn->prepare('SELECT Employee_ID, Username, Password_Hash FROM employee WHERE Username = ? LIMIT 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res ? $res->fetch_assoc() : null;
        $stmt->close();
    if ($row && password_verify($password, $row['Password_Hash'])) {
      // regenerate session id to prevent fixation
      session_regenerate_id(true);
      $_SESSION['admin_logged_in'] = true;
      $_SESSION['admin_id'] = (int)$row['Employee_ID'];
      header('Location: admin_panel.php');
      exit;
    } else {
            $message = 'Invalid username or password';
        }
    }
}
?><!doctype html>
<html><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Admin Login</title>
<style>body{background:#f5f5f5;padding:40px}.card{max-width:420px;margin:0 auto}</style>
</head><body>
<div class="card shadow">
  <div class="card-body">
    <h5 class="mb-3">Admin Login</h5>
    <?php if ($message): ?>
      <script>
        // show server-side error using SweetAlert2
        document.addEventListener('DOMContentLoaded', function(){
          Swal.fire({
            icon: 'error',
            title: 'Login failed',
            text: <?= json_encode($message) ?>,
            confirmButtonColor: '#ff7b00'
          });
        });
      </script>
    <?php endif; ?>
    <form method="post">
      <div class="mb-2"><input name="username" class="form-control" placeholder="Username"></div>
      <div class="mb-2"><input name="password" type="password" class="form-control" placeholder="Password"></div>
      <div class="d-flex">
        <button class="btn btn-primary me-2">Login</button>
        <a href="homepage/homepage.php" class="btn btn-secondary">Home</a>
      </div>
    </form>
  </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body></html>