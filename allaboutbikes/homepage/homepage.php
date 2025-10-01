<!DOCTYPE html>
<html lang="en">
<head>
  <m	eta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Homepage</title>
  <style>
      body {
background-image: url("https://www.shutterstock.com/image-photo/image-blur-bicycle-shop-background-600nw-450918220.jpg");
 background-repeat: no-repeat;
 background-size: cover;
}
  </style>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="homepage.php">ALL ABOUT BIKES</a>
      <ul class="nav">
        <li class="nav-item"><a class="nav-link text-light btn btn-outline-primary" href="homepage.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-light btn btn-outline-primary" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link text-light btn btn-outline-primary" href="contact.php">Contact</a></li>
      </ul>
    </div>
  </nav>

  <section class=" text-dark text-center p-5">
    <div class="container"> 
      <h1 class="display-4 text-light">Welcome to the Homepage</h1>
      <p class="lead text-light">This is a website for our bikeshop.</p>
    </div>
  </section>

  <section id="services" class="py-5">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Repair</h5>
              <p class="card-text">this button leads you to our contact for our repair services.</p>
              <a href="repair.php" class="btn btn-outline-primary">Learn More</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Rental</h5>
              <p class="card-text">Here you can see all the bikes that are available for rent.</p>
              <a href="rental.php" class="btn btn-outline-primary">Learn More</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Items</h5>
              <p class="card-text">Here you can see the list of items available in our store.</p>
              <a href="items.php  " class="btn btn-outline-primary">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <footer class="bg-dark text-light text-center py-3" style="margin-top: 241px;">
    <p class="mb-0">&copy; 2025 MyWebsite. All rights reserved.</p>
  </footer>

</body>
</html>
