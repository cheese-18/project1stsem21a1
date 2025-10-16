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

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Nunito:wght@400;600&display=swap" rel="stylesheet" />

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  body { 
    font-family: 'Nunito', sans-serif; 
    background: linear-gradient(180deg, #fff8dc, #ffedc2, #ffd580); 
    color:#222; 
  }
  .navbar { 
    background: linear-gradient(90deg, #ff7b00, #ffb703); 
    box-shadow: 0 4px 15px rgba(0,0,0,0.15); 
  }
  .navbar-brand { 
    font-family: 'Rajdhani', sans-serif; 
    font-weight:700; 
    color:#fff !important; 
    letter-spacing:2px; 
  }
  .nav-link {
    color: #fff !important;
    font-weight: 600;
    transition: all 0.3s;
    border-radius: 8px;
    padding: 6px 12px;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .nav-link:hover {
    background: #fff2b2;
    color: #333 !important;
  }

  .hero { 
    background: url("https://i.pinimg.com/originals/3d/90/12/3d901264b0ab64b2a00b5b31389c8901.jpg") center/cover no-repeat; 
    color:#fff; 
    padding:110px 20px; 
    text-align:center; 
    position:relative; 
    box-shadow: inset 0 0 80px rgba(0,0,0,0.35); 
  }
  .hero::after { 
    content: ""; position:absolute; inset:0; background: rgba(0,0,0,0.55); 
  }
  .hero h1 { 
    font-family: 'Rajdhani', sans-serif; font-size:3.2rem; position:relative; z-index:2; text-shadow: 0 6px 18px rgba(0,0,0,0.75); 
  }
  .hero p { 
    color:#fff7e6; position:relative; z-index:2; text-shadow: 0 4px 12px rgba(0,0,0,0.7); 
  }
  .hero .container { position: relative; z-index:2; }

  .card-item { 
    background: linear-gradient(180deg,#fff,#fff2cc); 
    border-radius:20px; 
    box-shadow:0 10px 30px rgba(0,0,0,0.1); 
    padding:22px; 
    transition:transform .3s; 
  }
  .card-item:hover { 
    transform:translateY(-10px); 
    box-shadow:0 20px 40px rgba(0,0,0,0.12); 
  }
  .price { 
    color:#fb8500; font-weight:700; font-size:1.05rem; 
  }
  .btn-book {
    background: linear-gradient(90deg,#ff7b00,#ffb703);
    color: white;
    font-weight: bold;
    border-radius: 8px;
    transition: 0.3s;
  }
  .btn-book:hover {
    opacity: 0.9;
  }
  @media (max-width:768px){ 
    .hero{padding:70px 12px} 
    .hero h1{font-size:2rem} 
  }
</style>
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand fw-bold text-light" href="homepage.php">🚴 ALL ABOUT BIKES</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="homepage.php"><i class="bi bi-house-fill"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="homepage.php#about"><i class="bi bi-info-circle-fill"></i> About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact2.php"><i class="bi bi-envelope-fill"></i> Contact</a>
        </li>
      </ul>
    </div>
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
            <button 
              class="btn btn-book w-100 mt-3" 
              onclick="bookService('<?= htmlspecialchars($service['name']) ?>', '₱<?= number_format($service['price'], 2) ?>')">
              Repair Now
            </button>
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

<script>
function bookService(serviceName, servicePrice) {
  Swal.fire({
    title: `
      <div style="width:80px;height:80px;border-radius:50%;border:4px solid #ff7b00;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
        <span style="font-size:2.5rem;color:#ff7b00;font-weight:bold;">!</span>
      </div>
      <h2 style="font-weight:600;color:#333;margin:0;">Proceed to Checkout?</h2>
    `,
    html: `
      <p style="color:#555;font-size:1rem;margin-top:10px;">
        You are about to request <strong>${serviceName}</strong><br>
        <span style="color:#ff7b00;font-weight:bold;">${servicePrice}</span><br><br>
        Please review your selection before continuing.
      </p>
    `,
    showCancelButton: true,
    confirmButtonColor: '#ff7b00',
    cancelButtonColor: '#4b4b4b',
    confirmButtonText: 'Proceed to Checkout',
    cancelButtonText: 'Cancel',
    background: '#ffffff',
    color: '#000',
    width: '500px',
    padding: '2.5em',
    customClass: {
      popup: 'shadow-lg rounded-4',
      confirmButton: 'px-4 py-2 fw-bold',
      cancelButton: 'px-4 py-2 fw-bold'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'checkout.php?service=' + encodeURIComponent(serviceName);
    }
  });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>