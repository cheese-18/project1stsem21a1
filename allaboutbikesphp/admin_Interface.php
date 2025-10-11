<?php
session_start();
require_once __DIR__ . '/db/dbconn.php';

if (empty($_SESSION['employee_logged_in']) || $_SESSION['employee_logged_in'] !== true) {
    header('Location: adminlogin.php');
    exit;
}

$rows = [];
$error = null;
$sql = "SELECT Employee_ID, Employee_name, employeeUsername, Position, Payment FROM employee ORDER BY Employee_ID ASC";
if ($res = $conn->query($sql)) {
    $rows = $res->fetch_all(MYSQLI_ASSOC);
    $res->free();
} else {
    $error = $conn->error;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Employee Interface</title>
<style>    body {
background-image: url("https://www.shutterstock.com/image-photo/image-blur-bicycle-shop-background-600nw-450918220.jpg");
 background-repeat: no-repeat;
 background-size: cover;
}</style>
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Employee Interface</span>
    <div class="d-flex">
      <span class="me-3 align-self-center"><?= htmlspecialchars($_SESSION['employee_name'] ?? 'User') ?></span>
      <a href="admin_rent.php" class="btn btn-outline-primary btn-sm me-2">Rent Management</a>
      <button class="btn btn-outline-success btn-sm me-2" id="openAddPartBtn">Add Part</button>
      <a href="admin_stocks.php" class="btn btn-outline-secondary btn-sm me-2">Stocks</a>
      <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <div class="card shadow-sm">
    <div class="card-body bg-info shadow-lg p-3 ">
      <div class="d-flex mb-3 ">
        <h5 class="me-auto mb-0">Employees</h5>
        <a href="register.php" class="btn btn-sm btn-primary">Register</a>
      </div>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th style="width:80px">ID</th>
              <th>Full Name</th>
              <th>Username</th>
              <th>Position</th>
              <th>Payment</th>
              <th class="text-end" style="width:160px">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($rows)): ?>
              <tr><td colspan="6" class="text-center py-4">No employees found.</td></tr>
            <?php else: ?>
              <?php foreach ($rows as $r): ?>
                <tr>
                  <td class="text-center"><?= htmlspecialchars($r['Employee_ID']) ?></td>
                  <td><?= htmlspecialchars($r['Employee_name']) ?></td>
                  <td><?= htmlspecialchars($r['employeeUsername']) ?></td>
                  <td><?= htmlspecialchars($r['Position']) ?></td>
                  <td><?= htmlspecialchars($r['Payment']) ?></td>
                  <td class="text-end">
                    <a href="employee_edit.php?id=<?= urlencode($r['Employee_ID']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="employee_delete.php?id=<?= urlencode($r['Employee_ID']) ?>" class="btn btn-sm btn-outline-danger ms-1" onclick="return confirm('Delete this employee?')">Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="addPartModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addPartForm" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Add Part</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="partAlert"></div>
        <div class="mb-2">
          <label class="form-label">Name</label>
          <input name="name" id="partName" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Part Type</label>
          <input name="type" id="partType" class="form-control">
        </div>
        <div class="mb-2">
          <label class="form-label">Brand</label>
          <input name="brand" id="partBrand" class="form-control">
        </div>
        <div class="mb-2">
          <label class="form-label">Price</label>
          <input name="price" id="partPrice" class="form-control">
        </div>
        <div class="mb-2">
          <label class="form-label">Stock Quantity</label>
          <input name="stock" id="partStock" type="number" class="form-control" value="0">
        </div>
        <div class="mb-2">
          <label class="form-label">Image</label>
          <input type="file" name="image" id="partImage" accept="image/*" class="form-control">
          <img id="partPreview" src="#" class="img-fluid mt-2 d-none" style="max-height:160px;">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save Part</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function showPartAlert(msg, type='success'){ $('#partAlert').html('<div class="alert alert-'+type+'">'+msg+'</div>'); setTimeout(()=>$('#partAlert').html(''),3000); }

document.getElementById('openAddPartBtn').addEventListener('click', function(){
  $('#addPartForm')[0].reset();
  $('#partPreview').addClass('d-none').attr('src','#');
  new bootstrap.Modal(document.getElementById('addPartModal')).show();
});

$('#partImage').on('change', function(e){
  const file = e.target.files[0];
  const img = $('#partPreview');
  if (!file) { img.addClass('d-none').attr('src','#'); return; }
  img.removeClass('d-none').attr('src', URL.createObjectURL(file));
});

$('#addPartForm').on('submit', function(e){
  e.preventDefault();
  const form = new FormData(this);
  form.append('action', 'add');
  $.ajax({
    url: 'admin_stocks.php',
    method: 'POST',
    data: form,
    processData: false,
    contentType: false,
    dataType: 'json',
    success(resp){
      if (resp.success) {
        showPartAlert('Part added', 'success');
        setTimeout(()=> location.href = 'admin_stocks.php', 700);
      } else {
        showPartAlert(resp.message || 'Failed to add part', 'danger');
      }
    },
    error(){ showPartAlert('Request failed','danger'); }
  });
});
</script>
</body>
</html>