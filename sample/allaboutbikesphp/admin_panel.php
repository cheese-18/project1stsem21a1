<?php
session_start();
// protect route
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}
require_once __DIR__ . '/db/dbconn.php';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Panel</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/sweetalert2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>body{background:#f8f9fa;padding:20px} .card{max-width:1200px;margin:0 auto} .topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}</style>
</head>
<body>
<div class="topbar">
  <h3 class="m-0">Admin Panel</h3>
  <div>
    <a href="admin_dashboard.php" class="btn btn-sm btn-primary me-2">Dashboard</a>
    <a href="admin_logout.php" class="btn btn-sm btn-danger">Logout</a>
  </div>
</div>

<div class="row g-4">
  <div class="col-md-7">
    <div class="card p-3">
      <h5>Parts</h5>
      <div class="mb-2">
        <button id="btnNewPart" class="btn btn-sm btn-success">New Part</button>
      </div>
      <div class="table-responsive">
        <table class="table table-striped" id="partsTable"><thead><tr><th>ID</th><th>Name</th><th>Type</th><th>Brand</th><th>Price</th><th>Stock</th><th class="text-end">Actions</th></tr></thead><tbody></tbody></table>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card p-3">
      <h5>Repairs</h5>
      <div class="table-responsive">
        <table class="table table-sm" id="repairsTable"><thead><tr><th>ID</th><th>Service</th><th>Price</th><th>Status</th><th class="text-end">Actions</th></tr></thead><tbody></tbody></table>
      </div>
    </div>
  </div>
</div>

<!-- Part modal -->
<div class="modal fade" id="partModal" tabindex="-1"><div class="modal-dialog"><form id="partForm" class="modal-content"><div class="modal-header"><h5 class="modal-title">Part</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><input type="hidden" name="id" id="partId"><div class="mb-2"><label>Name</label><input name="name" id="partName" class="form-control" required></div><div class="mb-2"><label>Type</label><input name="type" id="partType" class="form-control"></div><div class="mb-2"><label>Brand</label><input name="brand" id="partBrand" class="form-control"></div><div class="mb-2"><label>Price</label><input name="price" id="partPrice" type="number" step="0.01" min="0" class="form-control"></div><div class="mb-2"><label>Stock</label><input name="stock" id="partStock" type="number" min="0" class="form-control"></div></div><div class="modal-footer"><button class="btn btn-primary">Save</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></form></div></div>

<script src="js/bootstrap.bundle.min.js"></script>
<script>
// SweetAlert2 toast mixin for consistent toasts
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2500,
  timerProgressBar: true
});
function toast(msg, icon='success'){ Toast.fire({icon:icon, title: msg}); }

function showLoadingTable($table, cols=7){
  $table.find('tbody').html('<tr><td colspan="'+cols+'" class="text-center">Loading...</td></tr>');
}

function loadParts(){
  const $table = $('#partsTable'); showLoadingTable($table, 7);
  $.getJSON('api/admin_api.php',{action:'list_parts'}, function(resp){
    const tbody = $table.find('tbody').empty();
    if (!resp.success){ toast(resp.message,'error'); return; }
    resp.data.forEach(r=>{
      const pid = parseInt(r.Part_ID,10);
      if (isNaN(pid)||pid<=0) return;
      const tr = $('<tr>');
      tr.append('<td>'+pid+'</td>');
      tr.append('<td>'+$('<div>').text(r.Name).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Part_Type).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Brand).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Price).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Stock_Quantity).html()+'</td>');
      tr.append('<td class="text-end">'+
        '<button class="btn btn-sm btn-primary me-1 btn-edit" data-id="'+pid+'">Edit</button>'+
        '<button class="btn btn-sm btn-danger btn-del" data-id="'+pid+'">Delete</button>'+
        '</td>');
      tbody.append(tr);
    });
  }).fail(function(){ $table.find('tbody').html('<tr><td colspan="7" class="text-center text-danger">Failed to load</td></tr>'); });
}

function loadRepairs(){
  const $table = $('#repairsTable'); showLoadingTable($table, 5);
  $.getJSON('api/admin_api.php',{action:'list_repairs'}, function(resp){
    const tbody = $table.find('tbody').empty();
    if (!resp.success){ toast(resp.message,'error'); return; }
    resp.data.forEach(r=>{
      const rid = parseInt(r.Repair_ID,10);
      const tr = $('<tr>');
      tr.append('<td>'+rid+'</td>');
      tr.append('<td>'+$('<div>').text(r.Service).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Price).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Status).html()+'</td>');
      tr.append('<td class="text-end">'+
        '<button class="btn btn-sm btn-secondary me-1 btn-update-status" data-id="'+rid+'">Toggle Status</button>'+
        '</td>');
      tbody.append(tr);
    });
  }).fail(function(){ $table.find('tbody').html('<tr><td colspan="5" class="text-center text-danger">Failed to load</td></tr>'); });
}

$(function(){
  loadParts(); loadRepairs();

  $('#btnNewPart').on('click', function(){
    $('#partForm')[0].reset(); $('#partId').val(''); new bootstrap.Modal(document.getElementById('partModal')).show();
  });

  $(document).on('click', '.btn-edit', function(){
    const id = parseInt($(this).data('id'),10);
    $.getJSON('api/admin_api.php',{action:'list_parts'}, function(resp){
      const item = resp.data.find(x=>parseInt(x.Part_ID,10)===id);
      if (!item){ toast('Not found','error'); return; }
      $('#partId').val(item.Part_ID); $('#partName').val(item.Name); $('#partType').val(item.Part_Type); $('#partBrand').val(item.Brand); $('#partPrice').val(item.Price); $('#partStock').val(item.Stock_Quantity);
      new bootstrap.Modal(document.getElementById('partModal')).show();
    });
  });

  $(document).on('click', '.btn-del', function(){
    const id = parseInt($(this).data('id'),10);
    Swal.fire({title:'Delete?',text:'Delete this part?',icon:'warning',showCancelButton:true}).then(res=>{ if (!res.isConfirmed) return; $.post('api/admin_api.php',{action:'delete_part',id:id}, function(resp){ if (resp.success){ toast('Deleted'); loadParts(); } else toast(resp.message||'Delete failed','error'); },'json'); });
  });

  $('#partForm').on('submit', function(e){
    e.preventDefault();
    const id = parseInt($('#partId').val()||'0',10);
    const action = id>0 ? 'update_part' : 'add_part';
    const data = $(this).serialize() + '&action=' + action;
    $.post('api/admin_api.php', data, function(resp){ if (resp.success){ toast('Saved'); loadParts(); bootstrap.Modal.getInstance(document.getElementById('partModal')).hide(); } else toast(resp.message||'Error','error'); },'json');
  });

  $(document).on('click', '.btn-update-status', function(){
    const id = parseInt($(this).data('id'),10);
    const row = $(this).closest('tr');
    const current = row.find('td').eq(3).text().trim();
    const next = current === 'pending' ? 'done' : 'pending';
    $.post('api/admin_api.php',{action:'update_repair',id:id,status:next}, function(resp){ if (resp.success){ toast('Updated'); loadRepairs(); } else toast(resp.message||'Error','error'); },'json');
  });

});
</script>
</body>
</html>