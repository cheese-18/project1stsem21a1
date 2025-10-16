<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALL ABOUT BIKES - Rental</title>

  <!-- Bootstrap CSS -->
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
      color: #222;
      overflow-x: hidden;
    }

    .navbar {
      background: linear-gradient(90deg, #ff7b00, #ffb703);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .navbar-brand {
      font-family: 'Rajdhani', sans-serif;
      font-weight: 700;
      color: #fff !important;
      letter-spacing: 2px;
      font-size: 1.4rem;
    }

    .nav-link {
      color: #fff !important;
      font-weight: 600;
      transition: all 0.3s;
    }

    .nav-link:hover {
      color: #333 !important;
      background: #ffefb3;
      border-radius: 8px;
      padding: 6px 12px;
    }

    .hero {
      background: url("https://i.pinimg.com/originals/3d/90/12/3d901264b0ab64b2a00b5b31389c8901.jpg") center/cover no-repeat;
      color: #fff;
      padding: 130px 20px;
      text-align: center;
      position: relative;
      box-shadow: inset 0 0 80px rgba(0, 0, 0, 0.4);
    }

    .hero::after {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.55);
    }

    .hero h1 {
      font-family: 'Rajdhani', sans-serif;
      font-size: 3.5rem;
      position: relative;
      z-index: 2;
      text-shadow: 0 6px 18px rgba(0,0,0,0.75);
    }

    .hero p {
      font-size: 1.2rem;
      margin-top: 15px;
      color: #fff7e6;
      position: relative;
      z-index: 2;
      text-shadow: 0 4px 12px rgba(0,0,0,0.7);
    }

    .gallery-card {
      border: 0;
      border-radius: 16px;
      overflow: hidden;
      transition: transform .18s ease, box-shadow .18s ease;
      box-shadow: 0 10px 30px rgba(0,0,0,.08);
      background: linear-gradient(180deg,#fff,#fff2cc);
      height: 100%;
    }

    .gallery-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(255,153,0,0.18);
    }

    .gallery-thumb {
      display: block;
      width: 100%;
      height: 200px;
      object-fit: contain;
      background: #fafafa;
      padding: 1rem;
    }

    .card-title {
      text-align: center;
      font-weight: 700;
      margin: 0.5rem 0 0.25rem;
      color: #fb8500;
    }

    .btn-custom {
      background: linear-gradient(90deg, #ff7b00, #ffb703);
      color: #fff;
      border: none;
      border-radius: 50px;
      transition: all 0.3s ease;
      padding: 6px 14px;
    }

    .btn-custom:hover {
      transform: scale(1.05);
      background: linear-gradient(90deg, #ff9e00, #ffcc33);
    }

    footer {
      background: linear-gradient(90deg, #ffb703, #ffd166);
      color: #222;
      text-align: center;
      padding: 15px;
      margin-top: 60px;
      font-weight: 600;
      box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.12);
    }

    @media (max-width: 768px) {
      .hero h1 { font-size: 2rem; }
      .gallery-thumb { height: 160px; }
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
      <h1>Bikes Gallery</h1>
      <p>Browse our rental fleet and available bikes</p>
    </div>
  </section>

  <div class="container my-5">
    <div class="row g-4">
      <!-- Bike 1 -->
      <div class="col-12 col-sm-6 col-md-4">
        <article class="gallery-card">
          <img class="gallery-thumb" src="https://mtb.shimano.com/_assets/images/products/mtb/xtr/mtb-xtr-bike.png" alt="Mountain Bike XTR">
          <div class="p-3 text-center">
            <h5 class="card-title">Mountain Bike XTR</h5>
            <p class="card-text">Durable aluminum frame with front suspension for off-road adventures.</p>
            <button class="btn btn-custom" onclick="showCaution()">Rent Now</button>
          </div>
        </article>
      </div>

      <!-- Bike 2 -->
      <div class="col-12 col-sm-6 col-md-4">
        <article class="gallery-card">
          <img class="gallery-thumb" src="https://www.roevalleycycles.co.uk/wp-content/uploads/2020/06/trek-emonda-sl-6-pro-disc-road-bike-2021-trek-black-radioactive-red-roe-valley-cycles-1.jpg" alt="Road Bike Pro">
          <div class="p-3 text-center">
            <h5 class="card-title">Road Bike Pro</h5>
            <p class="card-text">Lightweight carbon frame built for speed and endurance on smooth roads.</p>
            <button class="btn btn-custom" onclick="showCaution()">Rent Now</button>
          </div>
        </article>
      </div>

      <!-- Bike 3 -->
      <div class="col-12 col-sm-6 col-md-4">
        <article class="gallery-card">
          <img class="gallery-thumb" src="https://i5.walmartimages.com/seo/Jasion-CB1-Electric-Bike-Adults-500W-Motor-Ebike-450Wh-Removeable-Battery-26-City-Cruiser-Commuter-Bicycle-Woman-Shimano-7-Speed-UL2849_cede7659-fb7f-4c40-8e57-d8f4764d36c3.cdb58d8a1cfe3a0a396c39997ca8c390.jpeg" alt="City Cruiser">
          <div class="p-3 text-center">
            <h5 class="card-title">City Cruiser</h5>
            <p class="card-text">Perfect for city commuting — comfortable, stylish, and reliable.</p>
            <button class="btn btn-custom" onclick="showCaution()">Rent Now</button>
          </div>
        </article>
      </div>
    </div>
  </div>

  <footer>
    © 2025 ALL ABOUT BIKES | All rights reserved.
  </footer>

  <script>
    function showCaution() {
      Swal.fire({
        title: 'Proceed to Checkout?',
        text: 'Please review your bike selection before continuing.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Proceed to Checkout',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#ff7b00',
        cancelButtonColor: '#555',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'checkout.php';
        }
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>