<?php
// Minimal admin dashboard (no auth) listing parts with quick actions.
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin Dashboard - Parts</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/sweetalert2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>body{background:#f8f9fa;padding:20px}.card{max-width:1200px;margin:0 auto}</style>
</head>
<body>
<div class="card shadow">
  <div class="card-body">
    <div class="d-flex mb-3">
      <h4 class="me-auto">Admin Dashboard - Parts</h4>
      <a href="admin_stocks.php" class="btn btn-sm btn-primary">Open Parts Manager</a>
    </div>
    <div id="alert"></div>
    <div class="table-responsive">
      <table class="table table-striped" id="partsTable">
        <thead>
          <tr><th>ID</th><th>Name</th><th>Type</th><th>Brand</th><th>Price</th><th>Stock</th><th class="text-end">Actions</th></tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>
<script>
function toast(msg, icon='success'){
  Swal.fire({toast:true,position:'top-end',icon:icon,title:msg,showConfirmButton:false,timer:2000});
}
function loadParts(){
  $.getJSON('admin_stocks.php',{action:'list'}, function(resp){
    if (!resp.success){ toast(resp.message,'error'); return; }
    const tbody = $('#partsTable tbody').empty();
    resp.data.forEach(r=>{
      const pid = parseInt(r.Part_ID,10);
      if (isNaN(pid) || pid<=0) return;
      const tr = $('<tr>');
      tr.append('<td>'+pid+'</td>');
      tr.append('<td>'+$('<div>').text(r.Name).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Part_Type).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Brand).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Price).html()+'</td>');
      tr.append('<td>'+$('<div>').text(r.Stock_Quantity).html()+'</td>');
      tr.append('<td class="text-end"><button class="btn btn-sm btn-danger btn-del" data-id="'+pid+'">Delete</button></td>');
      tbody.append(tr);
    });
  });
}
$(function(){
  loadParts();
  $(document).on('click','.btn-del', function(){
    const id = parseInt($(this).data('id'),10);
    if (isNaN(id) || id<=0){ toast('Invalid id','error'); return; }
    Swal.fire({title:'Delete?',text:'Delete this part?',icon:'warning',showCancelButton:true,confirmButtonText:'Yes'}).then(res=>{
      if (!res.isConfirmed) return;
      $.post('admin_stocks.php',{action:'delete',id:id}, function(resp){
        if (resp.success){ toast('Deleted'); loadParts(); } else { toast(resp.message||'Delete failed','error'); }
      },'json').fail(function(){ toast('Server error','error'); });
    });
  });
});
</script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>