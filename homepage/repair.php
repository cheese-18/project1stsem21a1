<?php

$services = [
  ["name" => "Brake Adjustment", "price" => 499, "description" => "Precise tuning and alignment of front and rear brakes for safe stopping."],
  ["name" => "Gear Tune-Up", "price" => 699, "description" => "Fine-tuning of derailleurs and gear shifting system for smooth performance."],
  ["name" => "Flat Tire Repair", "price" => 199, "description" => "Patch or replace inner tube to fix flat or leaking tires."],
  ["name" => "Chain Replacement", "price" => 399, "description" => "Install a new bike chain and adjust drivetrain for optimal performance."],
  ["name" => "Wheel Truing", "price" => 499, "description" => "Straighten and align wheels to eliminate wobble and improve ride quality."],
  ["name" => "Full Bike Overhaul", "price" => 2499, "description" => "Complete cleaning, re-greasing, and tuning of all parts for a like-new bike."],
  ["name" => "Suspension Service", "price" => 999, "description" => "Inspection and maintenance of front/rear suspension for smoother rides."],
  ["name" => "Bike Cleaning & Detailing", "price" => 299, "description" => "Deep cleaning and polish to keep your bike looking brand new."]
];


$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$filteredServices = array_filter($services, function($s) use ($search) {
    return $search === '' || str_contains(strtolower($s['name']), $search);
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bike Repair Shop - ALL ABOUT BIKES</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Nunito:wght@400;600&display=swap" rel="stylesheet" />

</style>
  <style>
    body { font-family: 'Nunito', sans-serif; background: linear-gradient(180deg, #fff8dc, #ffedc2, #ffd580); color:#222; }
    .navbar { background: linear-gradient(90deg, #ff7b00, #ffb703); box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
    .navbar-brand { font-family: 'Rajdhani', sans-serif; font-weight:700; color:#fff !important; letter-spacing:2px; }
    .hero { background: url("https://i.pinimg.com/originals/3d/90/12/3d901264b0ab64b2a00b5b31389c8901.jpg") center/cover no-repeat; color:#fff; padding:110px 20px; text-align:center; position:relative; box-shadow: inset 0 0 80px rgba(0,0,0,0.35); }
    .hero::after { content: ""; position:absolute; inset:0; background: rgba(0,0,0,0.55); }

    .hero h1 { font-family: 'Rajdhani', sans-serif; font-size:3.2rem; position:relative; z-index:2; }
    .hero h1 { font-family: 'Rajdhani', sans-serif; font-size:3.2rem; position:relative; z-index:2; text-shadow: 0 6px 18px rgba(0,0,0,0.75); }
    .hero p { color:#fff7e6; }
    .hero p { color:#fff7e6; position:relative; z-index:2; text-shadow: 0 4px 12px rgba(0,0,0,0.7); }
    .hero .container { position: relative; z-index:2; }
    .card-item { background: linear-gradient(180deg,#fff,#fff2cc); border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.1); padding:22px; transition:transform .3s; }
    .card-item:hover { transform:translateY(-10px); box-shadow:0 20px 40px rgba(0,0,0,0.12); }
    .price { color:#fb8500; font-weight:700; font-size:1.05rem; }
    .search-bar input { border-radius:50px; padding:10px 18px; }
    @media (max-width:768px){ .hero{padding:70px 12px} .hero h1{font-size:2rem} }
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
          <a class="nav-link text-light" href="contact.php">
            <i class="bi bi-envelope-fill"></i> Contact
          </a>
        </li>
      </ul>
    </div>
  </nav>

<section class="hero">
  <div class="container">
    <h1>Bike Repair & Maintenance</h1>
    <p class="mb-0">Professional service to keep your ride smooth and safe.</p>
  </div>
</section>


<div class="container py-5">
  <div class="d-flex align-items-center mb-4">
    <div>
      <h2 class="h3 mb-0">Our Repair Services</h2>
      <div class="text-muted">Choose from our range of professional bike maintenance services.</div>
    </div>
    <div class="ms-auto" style="min-width:320px;">
      <form class="mb-0" method="get">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search service..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
          <button class="btn text-white" style="background:linear-gradient(90deg,#ff7b00,#ffb703);" type="submit">Search</button>
          <?php if (!empty($search)): ?>
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="btn btn-outline-secondary">Clear</a>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>

  <div class="row g-4">
    <?php if (count($filteredServices) > 0): ?>
      <?php foreach ($filteredServices as $service): ?>
        <div class="col-md-4 col-lg-3">
          <div class="card-item h-100 p-3 d-flex flex-column">
            <h5 class="mb-1"><?= htmlspecialchars($service['name']) ?></h5>
            <div class="price mb-2">₱<?= number_format($service['price'], 2) ?></div>
            <p class="small text-muted flex-grow-1"><?= htmlspecialchars($service['description']) ?></p>
            <button class="btn btn-sm text-white w-100 mt-3" style="background:linear-gradient(90deg,#ff7b00,#ffb703);">Book Service</button>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center text-muted">
        <h4>No services found for "<strong><?= htmlspecialchars($search) ?></strong>"</h4>
      </div>
    <?php endif; ?>
  </div>
</div>

<footer class="text-center py-3" style="background:linear-gradient(90deg,#ffb703,#ffd166);margin-top:40px;">
  <p class="mb-0">&copy; 2025 ALL ABOUT BIKES. Ride Bright, Ride Bold.</p>
</footer>
</body>
</html>