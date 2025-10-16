<?php
  $current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bike Rental Shop</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
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
      font-size: 1.8rem;
    }

    .nav-link {
      color: #fff !important;
      font-weight: 600;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .nav-link:hover,
    .nav-link.active {
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
      color: #fff7e1;
      z-index: 2;
      position: relative;
      text-shadow: 0 4px 12px rgba(0,0,0,0.7);
    }

    .about {
      margin-top: 90px;
      background: #fffdf5;
      border-radius: 25px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      padding: 60px;
      transition: all 0.3s;
    }

    .about:hover {
      transform: translateY(-10px);
    }

    .about h2 {
      color: #ff7b00;
      font-weight: 700;
    }

    .about-img {
      border-radius: 20px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      width: 100%;
      height: 340px;
      object-fit: cover;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .service-card {
      background: linear-gradient(180deg, #fff, #fff2cc);
      border-radius: 20px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      padding: 40px 20px;
      transition: all 0.3s ease;
      height: 100%;
    }

    .service-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 0 25px rgba(255, 153, 0, 0.4);
    }

    .service-card i {
      font-size: 2.5rem;
      color: #ff7b00;
      margin-bottom: 15px;
    }

    .team-card {
      border: none;
      background: linear-gradient(135deg, #fff, #fff6e0);
      border-radius: 18px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 150px;
    }

    .team-card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 0 25px rgba(255, 187, 51, 0.5);
    }

    .card-title {
      color: #ff7b00;
      font-weight: 700;
    }

    footer {
      background: linear-gradient(90deg, #ffb703, #ffd166);
      text-align: center;
      padding: 20px;
      margin-top: 100px;
      font-weight: 600;
      color: #222;
    }

    @media (max-width: 768px) {
      .hero h1 { font-size: 2rem; }
      .about-img { height: 220px; }
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="homepage.php">🚴 ALL ABOUT BIKES</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
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
      <h1>Pedal. Power. Perform.</h1>
      <p>Professional bike repair and custom builds — keeping your ride flawless and fast.</p>
    </div>
  </section>


  <section class="container about mt-5">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="download.jpg" class="img-fluid about-img" alt="Bike Shop">
      </div>
      <div class="col-md-6">
        <h2>About Bike Rental Shop</h2>
        <p>We’re passionate cyclists and expert mechanics dedicated to keeping your bike in perfect condition. From professional repairs to custom builds — we make sure every bike rides like a dream.</p>
        <p>Our commitment: precision service, bright smiles, and smooth rides every time.</p>
      </div>
    </div>
  </section>


  <section class="container text-center py-5">
    <h2 class="mb-5">Our Services</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="service-card">
          <i class="bi bi-tools"></i>
          <h3>Bike Diagnostics</h3>
          <p class="mb-0">We assess every part of your bike to identify and fix hidden issues quickly and efficiently.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service-card">
          <i class="bi bi-gear-wide-connected"></i>
          <h3>Gear &amp; Brake Tuning</h3>
          <p class="mb-0">Get precise adjustments and friction-free performance for safe and fun rides.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service-card">
          <i class="bi bi-lightning-charge"></i>
          <h3>Custom Builds</h3>
          <p class="mb-0">Design your dream ride — we’ll bring it to life with expert craftsmanship and attention to detail.</p>
        </div>
      </div>
    </div>
  </section>

  
  <section class="container text-center py-5">
    <h2 class="mb-5">Meet the Crew</h2>
    <div class="row justify-content-center g-4">
      <?php
        $team = [
          ['name' => 'Ferinand Victor G. Pidlaoan', 'role' => 'Workshop Supervisor / Lead Mechanic'],
          ['name' => 'Gilbert A. Adlawan', 'role' => 'Customer Service Representative'],
          ['name' => 'John Gomez', 'role' => 'Bike Mechanic / Technician'],
          ['name' => 'Rean Karl A. Coopera', 'role' => 'Bike Assembler'],
          ['name' => 'Ron Rafael A. Legaspi', 'role' => 'Cashier']
        ];
        foreach ($team as $member) {
          echo "
            <div class='col-6 col-md-2'>
              <div class='card team-card'>
                <div class='card-body'>
                  <h5 class='card-title'>{$member['name']}</h5>
                  <p class='card-text'>{$member['role']}</p>
                </div>
              </div>
            </div>
          ";
        }
      ?>
    </div>
  </section>


  <footer>
    <p>© 2025 VeloFix Garage | Bright Rides. Bold Spirits.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>