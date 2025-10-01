<?php
session_start();
require_once __DIR__ . '/db/dbconn.php';

$debugLog = __DIR__ . '/logs/admin_stocks_debug.log';
if (!is_dir(dirname($debugLog))) mkdir(dirname($debugLog), 0755, true);

function logDebug($msg){
    global $debugLog;
    file_put_contents($debugLog, "[".date('Y-m-d H:i:s')."] ".$msg.PHP_EOL, FILE_APPEND);
}

if (empty($_SESSION['employee_logged_in']) || !($conn instanceof mysqli)) {
    logDebug('Access denied for request: ' . json_encode([
        'method'=>$_SERVER['REQUEST_METHOD'],
        'uri'=>$_SERVER['REQUEST_URI'],
        'post'=>$_POST
    ]));
    $msg = ['success'=>false,'message'=>'Access denied'];
    if (isset($_REQUEST['action'])) {
        header('Content-Type: application/json; charset=utf-8', true, 403);
        echo json_encode($msg);
    } else {
        http_response_code(403);
        echo 'Access denied';
    }
    exit;
}

if (isset($_REQUEST['action'])) {
    header('Content-Type: application/json; charset=utf-8');
    $action = $_REQUEST['action'];

    if ($action === 'list') {
        $sql = "SELECT Part_ID, Name, Part_Type, Brand, Price, Stock_Quantity FROM part ORDER BY Part_ID DESC";
        $res = $conn->query($sql);
        $rows = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
        echo json_encode(['success' => true, 'data' => $rows]);
        exit;
    }

    if ($action === 'add') {
        $name  = trim($_POST['name'] ?? '');
        $type  = trim($_POST['type'] ?? '');
        $brand = trim($_POST['brand'] ?? '');
        $price = (float) trim($_POST['price'] ?? 0);
        $stock = (int) ($_POST['stock'] ?? 0);

        if ($name === '') {
            echo json_encode(['success' => false, 'message' => 'Name required']);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO part (Name, Part_Type, Brand, Price, Stock_Quantity) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssdi', $name, $type, $brand, $price, $stock);
        $ok = $stmt->execute();
        if (!$ok) {
            logDebug("INSERT error: " . $stmt->error . " -- params: name=$name, price=$price, stock=$stock");
        } else {
            $id = $conn->insert_id;
            logDebug("INSERT OK id={$id} name={$name} price={$price} stock={$stock}");
        }
        $id = $ok ? $conn->insert_id : null;
        $msg = $ok ? '' : $stmt->error;
        $stmt->close();
        echo json_encode(['success' => $ok, 'id' => $id, 'message' => $msg]);
        exit;
    }

    if ($action === 'update') {
        $id    = (int) ($_POST['id'] ?? 0);
        $name  = trim($_POST['name'] ?? '');
        $type  = trim($_POST['type'] ?? '');
        $brand = trim($_POST['brand'] ?? '');
        $price = (float) trim($_POST['price'] ?? 0);
        $stock = (int) ($_POST['stock'] ?? 0);

        if ($id <= 0 || $name === '') {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
            exit;
        }

        $stmt = $conn->prepare("UPDATE part SET Name = ?, Part_Type = ?, Brand = ?, Price = ?, Stock_Quantity = ? WHERE Part_ID = ? LIMIT 1");
        $stmt->bind_param('sssdii', $name, $type, $brand, $price, $stock, $id);
        $ok = $stmt->execute();
        if (!$ok) logDebug("UPDATE error: " . $stmt->error);
        $msg = $ok ? '' : $stmt->error;
        $stmt->close();
        echo json_encode(['success' => $ok, 'message' => $msg]);
        exit;
    }

    if ($action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid id']);
            exit;
        }
        $stmt = $conn->prepare("DELETE FROM part WHERE Part_ID = ? LIMIT 1");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $msg = $ok ? '' : $stmt->error;
        $stmt->close();
        echo json_encode(['success' => $ok, 'message' => $msg]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Unknown action']);
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Parts / Stocks Management</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>body{background:#f8f9fa;padding:20px}.card{max-width:1100px;margin:0 auto}   body {
background-image: url("https://www.shutterstock.com/image-photo/image-blur-bicycle-shop-background-600nw-450918220.jpg");
 background-repeat: no-repeat;
 background-size: cover;
}</style> 
</head>
<body>
<div class="card shadow">
  <div class="card-body">
    <div class="d-flex mb-3">
      <h5 class="me-auto">Parts / Stocks</h5>
      <button id="btnAdd" class="btn btn-sm btn-success">Add Part</button>
    </div>

    <div id="alert"></div>

    <div class="table-responsive">
      <table class="table table-striped table-hover" id="stocksTable">
        <thead class="table-light">
          <tr><th>ID</th><th>Name</th><th>Type</th><th>Brand</th><th>Price</th><th>Stock</th><th class="text-end">Actions</th></tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>  

<div class="modal fade" id="modalStock" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formStock" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Part</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="stockId">
        <div class="mb-2"><label class="form-label">Name</label><input name="name" id="stockName" class="form-control" required></div>
        <div class="mb-2"><label class="form-label">Part Type</label><input name="type" id="stockType" class="form-control"></div>
        <div class="mb-2"><label class="form-label">Brand</label><input name="brand" id="stockBrand" class="form-control"></div>
        <div class="mb-2"><label class="form-label">Price</label><input name="price" id="stockPrice" class="form-control"></div>
        <div class="mb-2"><label class="form-label">Stock Quantity</label><input name="stock" id="stockQty" type="number" class="form-control"></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script>
function showAlert(msg, type='success'){ $('#alert').html('<div class="alert alert-'+type+'">'+msg+'</div>'); setTimeout(()=>$('#alert').html(''),3000); }

function fetchList(){
  $.getJSON('admin_stocks.php', { action: 'list' }, function(resp){
    if (!resp.success) { showAlert(resp.message,'danger'); return; }
    const tbody = $('#stocksTable tbody').empty();
    resp.data.forEach(r=>{
      const tr = $('<tr>');
      tr.append('<td>'+r.Part_ID+'</td>');
      tr.append('<td>'+$('<div>').text(r.Name).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Part_Type).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Brand).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Price).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Stock_Quantity).html()+'</td>');
      tr.append('<td class="text-end">'+
        '<button class="btn btn-sm btn-primary me-1 btn-edit" data-id="'+r.Part_ID+'">Edit</button>'+
        '<button class="btn btn-sm btn-danger btn-del" data-id="'+r.Part_ID+'">Delete</button>'+
        '</td>');
      tbody.append(tr);
    });
  });
}

$(function(){
  fetchList();

  $('#btnAdd').on('click', function(){
    $('#formStock')[0].reset();
    $('#stockId').val('');
    new bootstrap.Modal(document.getElementById('modalStock')).show();
  });

  $(document).on('click', '.btn-edit', function(){
    const id = $(this).data('id');
    $.getJSON('admin_stocks.php', { action: 'list' }, function(resp){
      const item = resp.data.find(x=>x.Part_ID == id);
      if (!item) { showAlert('Item not found','danger'); return; }
      $('#stockId').val(item.Part_ID);
      $('#stockName').val(item.Name);
      $('#stockType').val(item.Part_Type);
      $('#stockBrand').val(item.Brand);
      $('#stockPrice').val(item.Price);
      $('#stockQty').val(item.Stock_Quantity);
      new bootstrap.Modal(document.getElementById('modalStock')).show();
    });
  });

  $(document).on('click', '.btn-del', function(){
    if (!confirm('Delete this part?')) return;
    const id = $(this).data('id');
    $.post('admin_stocks.php', { action: 'delete', id: id }, function(resp){
      if (resp.success) { showAlert('Deleted'); fetchList(); } else showAlert(resp.message,'danger');
    }, 'json');
  });

  $('#formStock').on('submit', function(e){
    e.preventDefault();
    const id = $('#stockId').val();
    const action = id ? 'update' : 'add';
    const data = $(this).serialize() + '&action=' + action;
    $.post('admin_stocks.php', data, function(resp){
      if (resp.success) {
        showAlert('Saved');
        fetchList();
        bootstrap.Modal.getInstance(document.getElementById('modalStock')).hide();
      } else {
        console.warn('Server returned success=false payload:', resp);
        showAlert(resp.message || 'Error','danger');
      }
    }, 'json').fail(function(xhr){
      console.error('AJAX error', xhr.responseText);
      showAlert('Request failed: ' + (xhr.responseText || 'server error'), 'danger');
    });
  });
});
</script>
</body>
</html>