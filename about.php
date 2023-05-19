<?php
session_start();
require 'connection.php';
?>
<!doctype html>
<html lang="en">

<head>
  <title>CarRental</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body>


  <div class="site-wrap" id="home-section">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>



    <header class="site-navbar site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center position-relative">

          <div class="col-3">
            <div class="site-logo">
              <a href="index.php"><strong>CarRental</strong></a>
            </div>
          </div>

          <div class="col-9  text-right">

            <span class="d-inline-block d-lg-none"><a href="#" class=" site-menu-toggle js-menu-toggle py-5 "><span class="icon-menu h3 text-black"></span></a></span>

            <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
              <ul class="site-menu main-menu js-clone-nav ml-auto ">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="listing.php" class="nav-link">Listing</a></li>
                <li><a href="testimonials.php" class="nav-link">Testimonials</a></li>
                <li class="active"><a href="about.php" class="nav-link">About</a></li>
                <?php
                if (isset($_SESSION['customer_id'])) {
                  $Id = $_SESSION['customer_id'];
                  $query = "SELECT * FROM customer WHERE customer_id='$Id'";
                  $result = mysqli_query($conn, $query);
                  $row = mysqli_fetch_assoc($result);
                  $fname = $row["fname"];
                  echo "<li><span class='icon-user-o'></span> $fname</li>";
                  echo "<li><a href='logout.php' class='nav-link'>Logout</a><span class='icon-sign-out'></span></li>";
                } else {
                  echo '<li><a href="signIn.php" class="nav-link">Sign In</a></li>';
                }
                ?>
              </ul>
            </nav>
          </div>


        </div>
      </div>

    </header>


    <div class="hero inner-page" style="background-image: url('images/hero_1_a.jpg');">

      <div class="container">
        <div class="row align-items-end ">
          <div class="col-lg-5">

            <div class="intro">
              <h1><strong>About</strong></h1>
              <div class="custom-breadcrumbs"><a href="index.php">Home</a> <span class="mx-2">/</span>
                <strong>About</strong>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>



    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0 order-lg-2">
            <img src="images/hero_2.jpg" alt="Image" class="img-fluid rounded">
          </div>
          <div class="col-lg-4 mr-auto">
            <h2>Car Company</h2>
            <p>CarRental was founded in 2022 with the goal of providing convenient and affordable car rental services to travelers. Our company has grown significantly since then, and we now have a fleet of 200 vehicles and multiple locations throughout Alexandria.</p>
            <p>Over the months, we have consistently strived to improve our services and meet the needs of our customers. We have introduced online booking and reservation, flexible rental periods, and a wide range of vehicles to choose from, including economy, luxury, and SUVs. We have also implemented a loyalty program and offer various promotions and discounts to our customers.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5 section-2-title">
          <div class="col-md-6">
            <h2 class="mb-4">Meet Our Team</h2>
          </div>
        </div>
        <div class="row align-items-stretch">

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="post-entry-1 h-100 person-1">

              <img src="images/person_1.jpg" alt="Image" class="img-fluid">

              <div class="post-entry-1-contents">
                <span class="meta">Founder</span>
                <h2>James Doe</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, sapiente.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5">
            <div class="post-entry-1 h-100 person-1">

              <img src="images/person_2.jpg" alt="Image" class="img-fluid">

              <div class="post-entry-1-contents">
                <span class="meta">Founder</span>
                <h2>James Doe</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, sapiente.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="post-entry-1 h-100 person-1">

              <img src="images/person_3.jpg" alt="Image" class="img-fluid">

              <div class="post-entry-1-contents">
                <span class="meta">Founder</span>
                <h2>James Doe</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, sapiente.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="post-entry-1 h-100 person-1">

              <img src="images/person_4.jpg" alt="Image" class="img-fluid">

              <div class="post-entry-1-contents">
                <span class="meta">Founder</span>
                <h2>James Doe</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, sapiente.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="post-entry-1 h-100 person-1">

              <img src="images/person_5.jpg" alt="Image" class="img-fluid">

              <div class="post-entry-1-contents">
                <span class="meta">Founder</span>
                <h2>James Doe</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, sapiente.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="post-entry-1 h-100 person-1">

              <img src="images/person_1.jpg" alt="Image" class="img-fluid">

              <div class="post-entry-1-contents">
                <span class="meta">Founder</span>
                <h2>James Doe</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, sapiente.</p>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <img src="images/hero_1.jpg" alt="Image" class="img-fluid rounded">
          </div>
          <div class="col-lg-4 ml-auto">
            <h2>Our History</h2>
            <p>Our company is committed to providing excellent customer service and ensuring that our customers have a smooth and stress-free rental experience. We have a team of friendly and knowledgeable staff who are always ready to assist our customers with any questions or concerns they may have. We also offer 24/7 roadside assistance for added peace of mind.</p>
            <p>At CarRental, we are proud of our history and look forward to continuing to serve our customers and help them make the most of their travels.</p>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section bg-primary py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mb-4 mb-md-0">
            <h2 class="mb-0 text-white">What are you waiting for?</h2>
            <p class="mb-0 opa-7">Sign up now and get 50% off on your first car rent.</p>
          </div>
          <div class="col-lg-5 text-md-right">
            <a href="index.php" class="btn btn-primary btn-white">Rent a car now</a>
          </div>
        </div>
      </div>
    </div>

    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <h2 class="footer-heading mb-4">About Us</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
              blind texts. </p>
            <ul class="list-unstyled social">
              <li><a href="#"><span class="icon-facebook"></span></a></li>
              <li><a href="#"><span class="icon-instagram"></span></a></li>
              <li><a href="#"><span class="icon-twitter"></span></a></li>
              <li><a href="#"><span class="icon-linkedin"></span></a></li>
            </ul>
          </div>
          <div class="col-lg-8 ml-auto">
            <div class="row">
              <div class="col-lg-3">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Terms of Service</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-lg-3">
                <h2 class="footer-heading mb-4">Resources</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Terms of Service</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-lg-3">
                <h2 class="footer-heading mb-4">Support</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Terms of Service</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-lg-3">
                <h2 class="footer-heading mb-4">Company</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Terms of Service</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

</body>

</html>