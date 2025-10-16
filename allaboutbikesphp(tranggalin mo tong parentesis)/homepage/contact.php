<?php $current = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact | All About Bikes</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Nunito:wght@400;600&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(180deg, #fffaf0, #ffecc2, #ffd580);
      color: #333;
      overflow-x: hidden;
    }


    .navbar {
      background: linear-gradient(90deg, #ff7b00, #ffb703);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .navbar-brand {
      font-family: 'Rajdhani', sans-serif;
      font-size: 1.8rem;
      font-weight: 700;
      color: #fff !important;
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
    .nav-link.active, .nav-link:hover {
      background: #fff2b2;
      color: #333 !important;
    }


    .hero {
      background: url('download.jpg') center/cover no-repeat;
      color: #fff;
      text-align: center;
      padding: 150px 20px;
      position: relative;
      box-shadow: inset 0 0 60px rgba(0,0,0,0.5);
      overflow: hidden;
    }
    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.55);
    }
    .hero h1, .hero p {
      position: relative;
      z-index: 2;
    }
    .hero h1 {
      font-family: 'Rajdhani', sans-serif;
      font-size: 3.2rem;
      font-weight: 700;
      text-shadow: 0 6px 16px rgba(0,0,0,0.7);
    }
    .hero p {
      color: #ffefc9;
      font-size: 1.2rem;
    }
    .contact-section { padding: 80px 0; }
    .contact-box {
      background: linear-gradient(180deg, #fff, #fff7e5);
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      padding: 40px;
      transition: all 0.3s ease;
    }
    .contact-box:hover {
      transform: translateY(-8px);
      box-shadow: 0 0 25px rgba(255, 187, 51, 0.4);
    }
    .contact-box h4 {
      color: #ff7b00;
      font-weight: 700;
      margin-bottom: 15px;
    }
    .contact-icon {
      color: #ff7b00;
      margin-right: 10px;
      font-size: 1.3rem;
    }
    .form-control {
      border-radius: 10px;
      border: 1px solid #ccc;
      padding: 10px 15px;
    }
    .btn-custom {
      background: linear-gradient(90deg, #ff7b00, #ffb703);
      border: none;
      color: #fff;
      font-weight: 600;
      border-radius: 10px;
      padding: 10px 25px;
      transition: 0.3s ease;
    }
    .btn-custom:hover {
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(255, 153, 0, 0.4);
    }
    iframe {
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    footer {
      background: linear-gradient(90deg, #ffb703, #ffd166);
      color: #222;
      text-align: center;
      padding: 20px;
      margin-top: 100px;
      font-weight: 600;
      box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="homepage.php">🚴 ALL ABOUT BIKES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMenu">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link <?php echo ($current === 'homepage.php') ? 'active' : ''; ?>" href="homepage.php">
              <i class="bi bi-house-fill"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($current === 'about.php') ? 'active' : ''; ?>" href="about.php">
              <i class="bi bi-info-circle-fill"></i> About
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($current === 'contact.php') ? 'active' : ''; ?>" href="contact2.php">
              <i class="bi bi-envelope-fill"></i> Contact
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <section class="hero">
      <h1>Let’s Connect</h1>
      <p>Need repairs, rentals, or custom builds? We’re just a message away!</p>
    </div>
  </section>

  <section class="contact-section">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-md-6">
          <div class="contact-box">
            <h4><i class="bi bi-telephone-fill contact-icon"></i>Call Us</h4>
            <p>+63 912 345 6789</p>
            <h4><i class="bi bi-envelope-fill contact-icon"></i>Email</h4>
            <p>aab.rentandrapairs@gmail.com</p>
            <h4><i class="bi bi-geo-alt-fill contact-icon"></i>Location</h4>
            <p>Zone 5, Barangay Maligaya, Quezon City, Philippines</p>
            <h4><i class="bi bi-clock-fill contact-icon"></i>Business Hours</h4>
            <p>Mon–Sat: 9:00 AM – 7:00 PM<br>Sunday: Closed</p>
          </div>
        </div>

        <div class="col-md-6">
          <div class="contact-box">
            <h4><i class="bi bi-chat-dots-fill contact-icon"></i>Send us a message</h4>
            <form method="post" action="#">
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Your Name" required>
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" placeholder="Your Email" required>
              </div>
              <div class="mb-3">
                <textarea class="form-control" rows="4" placeholder="Your Message" required></textarea>
              </div>
              <button type="submit" class="btn btn-custom w-100">Send Message</button>
            </form>
          </div>
        </div>
      </div>

 
      <div class="mt-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.615077065199!2d120.98421987589017!3d14.599512677093624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c97fd0a8c2f3%3A0x84b515e08153b947!2sQuezon%20City%2C%20Philippines!5e0!3m2!1sen!2sph!4v1700000000000!5m2!1sen!2sph"
          width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 All About Bikes | Pedal Forward with Passion.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>