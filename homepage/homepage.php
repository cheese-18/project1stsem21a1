<?php $current = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALL ABOUT BIKES - Homepage</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Nunito:wght@400;600&display=swap" rel="stylesheet" />

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

    .hero .container { position: relative; z-index: 2; }


    .card {
      background: linear-gradient(180deg, #fff, #fff2cc);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      padding: 30px 20px;
      transition: all 0.3s ease;
      height: 100%;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 0 25px rgba(255, 153, 0, 0.3);
    }

    .card i {
      font-size: 2.5rem;
      color: #ff7b00;
      margin-bottom: 15px;
    }

    .card h5 { color: #fb8500; font-weight: 700; }

    .btn-custom {
      background: linear-gradient(90deg, #ff7b00, #ffb703);
      color: #fff;
      border: none;
      border-radius: 50px;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      transform: translateY(-4px);
    }


    footer {
      background: linear-gradient(90deg, #ffb703, #ffd166);
      color: #222;
      text-align: center;
      padding: 15px;
      margin-top: 100px;
      font-weight: 600;
      box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
      .hero h1 { font-size: 2rem; }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="homepage.php">🚴 ALL ABOUT BIKES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMenu">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="homepage.php" class="<?php echo ($current === 'homepage.php') ? 'nav-link active' : 'nav-link'; ?>">
              <i class="bi bi-house-fill"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a href="about.php" class="<?php echo ($current === 'about.php') ? 'nav-link active' : 'nav-link'; ?>">
              <i class="bi bi-info-circle-fill"></i> About
            </a>
          </li>
          <li class="nav-item">
            <a href="contact.php" class="<?php echo ($current === 'contact.php') ? 'nav-link active' : 'nav-link'; ?>">
              <i class="bi bi-envelope-fill"></i> Contact
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
  <section class="hero">
    <div class="container">
      <h1>Welcome to ALL ABOUT BIKES</h1>
      <p>Your trusted partner for bike repairs, rentals, and quality parts!</p>
    </div>
  </section>


  <section id="services" class="py-5">
    <div class="container">
      <div class="row text-center">

        <div class="col-md-4 mb-4">
          <div class="card p-4">
            <div class="card-body">
              <i class="bi bi-tools fs-1 text-info mb-3"></i>
              <h5 class="card-title">Repair</h5>
              <p class="card-text">Need a quick fix? Our expert mechanics are ready to tune up your ride.</p>
              <a href="repair.php" class="btn btn-custom">Learn More</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card p-4">
            <div class="card-body">
              <i class="bi bi-bicycle fs-1 text-success mb-3"></i>
              <h5 class="card-title">Rental</h5>
              <p class="card-text">No bike? No problem! Choose from our wide selection of rentals.</p>
              <a href="rental.php" class="btn btn-custom">Learn More</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card p-4">
            <div class="card-body">
              <i class="bi bi-bag-check-fill fs-1 text-warning mb-3"></i>
              <h5 class="card-title">Items</h5>
              <p class="card-text">Browse our store for helmets, tires, tools, and more bike essentials.</p>
              <a href="items.php" class="btn btn-custom">Learn More</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <footer class="text-center py-3">
    <p>&copy; 2025 ALL ABOUT BIKES. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JS (bundle includes Popper) -->
  <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>