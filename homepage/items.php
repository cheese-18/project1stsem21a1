<?php

$items = [
    ["name" => "Mountain Bike XTR", "brand" => "Trek", "price" => 25999, "image" => "https://mtb.shimano.com/_assets/images/products/mtb/xtr/mtb-xtr-bike.png", "description" => "Durable aluminum frame with front suspension for off-road adventures."],
    ["name" => "Road Bike Pro", "brand" => "Giant", "price" => 34999, "image" => "https://www.roevalleycycles.co.uk/wp-content/uploads/2020/06/trek-emonda-sl-6-pro-disc-road-bike-2021-trek-black-radioactive-red-roe-valley-cycles-1.jpg", "description" => "Lightweight carbon frame and aerodynamic design for speed lovers."],
    ["name" => "City Commuter Bike", "brand" => "Phoenix", "price" => 15999, "image" => "https://pedegoelectricbikes.ca/wp-content/uploads/2018/08/pedego-city-commuter-1.jpg", "description" => "Comfortable city bike perfect for everyday commuting."],
    ["name" => "Folding Bike Mini", "brand" => "Dahon", "price" => 18999, "image" => "https://cdn.bmwblog.com/wp-content/uploads/mini-folding-bike-09.jpg", "description" => "Compact folding bike ideal for urban riders."],
    ["name" => "Bike Helmet", "brand" => "Giro", "price" => 2499, "image" => "https://m.media-amazon.com/images/I/61oa-6TE4jL._AC_SL1500_.jpg", "description" => "Protective helmet with adjustable straps and air vents."],
    ["name" => "LED Bike Light Set", "brand" => "Rockbros", "price" => 899, "image" => "https://i5.walmartimages.com/seo/Concord-Deluxe-LED-Bike-Light-Set-200-Lumens-Front-and-Rear_053e61b8-54aa-4012-8ffd-dd448147e0fc.0aaf62edc2243847488b4d6d82cf2d15.jpeg", "description" => "Front and rear lights for night riding safety."],
    ["name" => "Cycling Gloves", "brand" => "Fox", "price" => 699, "image" => "https://m.media-amazon.com/images/I/71HstTP1djL._AC_SL1500_.jpg", "description" => "Comfortable gloves with anti-slip palm padding."],
    ["name" => "Water Bottle Holder", "brand" => "Shimano", "price" => 299, "image" => "https://m.media-amazon.com/images/I/61G9n6DzxtL._AC_SL1500_.jpg", "description" => "Lightweight alloy bottle cage for easy access on the go."],
    ["name" => "Bike Chain Lubricant", "brand" => "Finish Line", "price" => 349, "image" => "https://www.bigw.com.au/medias/sys_master/images/images/h99/h6c/10763709251614.jpg", "description" => "Premium chain oil for smooth and quiet rides."],
    ["name" => "Cycling Jersey", "brand" => "Specialized", "price" => 1299, "image" => "https://cdn.shopify.com/s/files/1/0262/3733/7649/products/01-1.jpg?v=1666418378", "description" => "Breathable jersey with full zip and moisture control."],
    ["name" => "Bike Pedals Set", "brand" => "Shimano", "price" => 999, "image" => "https://i5.walmartimages.com/seo/Bike-Shop-Universal-Fit-Replacement-Platform-Bike-Pedal-Set_b38d3e52-98f8-4b33-8227-1e166387260e.91a7eea4f3ae48775d393502419e44f2.jpeg", "description" => "Durable alloy pedals with strong grip design."],
    ["name" => "Bike Tire 26x2.1", "brand" => "Maxxis", "price" => 799, "image" => "https://m.media-amazon.com/images/I/71C+mvkYZQL.jpg", "description" => "High-traction tire ideal for rough terrain and trails."]
];


$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$filteredItems = array_filter($items, function($item) use ($search) {
    return $search === '' ||
           str_contains(strtolower($item['name']), $search) ||
           str_contains(strtolower($item['brand']), $search);
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ALL ABOUT BIKES - Items</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Nunito:wght@400;600&display=swap" rel="stylesheet" />

<style>
  body { font-family: 'Nunito', sans-serif; background: linear-gradient(180deg, #fff8dc, #ffedc2, #ffd580); color:#222; }
  .navbar { background: linear-gradient(90deg, #ff7b00, #ffb703); box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
  .navbar-brand { font-family: 'Rajdhani', sans-serif; font-weight:700; color:#fff !important; letter-spacing:2px; }
  .hero { background: url("https://i.pinimg.com/originals/3d/90/12/3d901264b0ab64b2a00b5b31389c8901.jpg") center/cover no-repeat; color:#fff; padding:80px 20px; text-align:center; position:relative; box-shadow: inset 0 0 80px rgba(0,0,0,0.35); }
  .hero { background: url("https://i.pinimg.com/originals/3d/90/12/3d901264b0ab64b2a00b5b31389c8901.jpg") center/cover no-repeat; color:#fff; padding:80px 20px; text-align:center; position:relative; box-shadow: inset 0 0 80px rgba(0,0,0,0.35); }
  .hero::after { content: ""; position:absolute; inset:0; background: rgba(0,0,0,0.55); }
  .hero h1 { font-family: 'Rajdhani', sans-serif; font-size:2.6rem; position:relative; z-index:2; text-shadow: 0 6px 18px rgba(0,0,0,0.75); }
  .hero p { position:relative; z-index:2; text-shadow: 0 4px 12px rgba(0,0,0,0.7); }
  .hero .container { position: relative; z-index:2; }
  .card-item { background: linear-gradient(180deg,#fff,#fff2cc); border-radius:18px; box-shadow:0 10px 30px rgba(0,0,0,0.1); transition:transform .25s; overflow:hidden; }
  .card-item:hover { transform:translateY(-8px); }
  .price { color:#fb8500; font-weight:700; }
  .search-bar input { border-radius:50px; padding:10px 18px; }
  .list-group-item { cursor:pointer; }
  img.card-img-top { height:180px; object-fit:cover; }
</style>
</head>
<body>

  <nav class="navbar navbar-dark">
    <div class="container">
      <a class="navbar-brand fw-bold text-light" href="homepage.php">🚴 ALL ABOUT BIKES</a>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link text-light" href="homepage.php">
            <i class="bi bi-house-fill"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="about.php">
            <i class="bi bi-info-circle-fill"></i> About
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="contact2.php">
            <i class="bi bi-envelope-fill"></i> Contact
          </a>
        </li>
      </ul>
    </div>
  </nav>
  
<section class="hero">
  <div class="container">
    <h1>Shop Items</h1>
    <p class="mb-0">Quality parts and accessories for every ride.</p>
  </div>
</section>


<div class="container py-5">
  <div class="d-flex align-items-center mb-4">
    <div>
      <h2 class="h3 mb-0">Store Items</h2>
      <div class="text-muted">Browse helmets, tires, tools and other bike essentials.</div>
    </div>
    <div class="ms-auto" style="min-width:320px;">
      <form class="mb-0" method="get">
        <div class="input-group position-relative">
          <input id="searchInput" type="text" name="search" class="form-control" placeholder="Search items (name, brand)..." autocomplete="off" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
          <button class="btn text-white" style="background:linear-gradient(90deg,#ff7b00,#ffb703);" type="submit">Search</button>
          <?php if (!empty($search)): ?>
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="btn btn-outline-secondary">Clear</a>
          <?php endif; ?>
          <div id="suggestionsList" class="list-group position-absolute w-100" style="top:100%;left:0;z-index:1050;display:none;max-height:220px;overflow:auto;"></div>
        </div>
      </form>
    </div>
  </div>

  <div class="row g-4">
    <?php if (count($filteredItems) > 0): ?>
      <?php foreach ($filteredItems as $item): ?>
        <div class="col-md-4 col-lg-3">
          <div class="card-item h-100">
            <img src="<?= htmlspecialchars($item['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>">
            <div class="p-3">
              <h5 class="mb-1"><?= htmlspecialchars($item['name']) ?></h5>
              <div class="text-muted small mb-2"><?= htmlspecialchars($item['brand']) ?></div>
              <div class="d-flex align-items-center justify-content-between">
                <div class="price">₱<?= number_format($item['price'], 2) ?></div>
                <button class="btn btn-sm text-white" style="background:linear-gradient(90deg,#ff7b00,#ffb703);">Add to Cart</button>
              </div>
              <p class="small text-muted mt-2 mb-0"><?= htmlspecialchars($item['description']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center text-muted">
        <h4>No items found for "<strong><?= htmlspecialchars($search) ?></strong>"</h4>
      </div>
    <?php endif; ?>
  </div>
</div>

<footer class="text-center py-3" style="background:linear-gradient(90deg,#ffb703,#ffd166);margin-top:40px;">
  <p class="mb-0">&copy; 2025 ALL ABOUT BIKES. Ride Bright, Ride Bold.</p>
</footer>


<script>
const ITEMS = <?php echo json_encode(array_map(fn($it) => ['name'=>$it['name'],'brand'=>$it['brand']], $items)); ?>;
(function(){
  const input = document.getElementById('searchInput');
  const list = document.getElementById('suggestionsList');
  const seen = new Set(); const all = [];
  ITEMS.forEach(it => {
    ['name','brand'].forEach(k => {
      const v = (it[k]||'').trim();
      if(v && !seen.has(v)) { seen.add(v); all.push(v); }
    });
  });

  function renderMatches(q){
    list.innerHTML = '';
    if(!q){ list.style.display='none'; return; }
    const ql = q.toLowerCase();
    const matches = all.filter(x => x.toLowerCase().includes(ql)).slice(0,50);
    if(matches.length === 0){ list.style.display='none'; return; }
    matches.forEach(m => {
      const btn = document.createElement('button');
      btn.type='button'; btn.className='list-group-item list-group-item-action';
      btn.textContent = m;
      btn.addEventListener('click', ()=>{ input.value=m; list.style.display='none'; input.focus(); });
      list.appendChild(btn);
    });
    list.style.display='block';
  }

  let hideTimer=null;
  input.addEventListener('input', e=>renderMatches(e.target.value));
  input.addEventListener('focus', e=>renderMatches(e.target.value));
  input.addEventListener('keydown', e=>{ if(e.key==='Escape') list.style.display='none'; });
  input.addEventListener('blur', ()=>{ hideTimer=setTimeout(()=>{ list.style.display='none'; },150); });
  list.addEventListener('mousedown', ()=>{ if(hideTimer) clearTimeout(hideTimer); });
})();
</script>

</body>
</html>