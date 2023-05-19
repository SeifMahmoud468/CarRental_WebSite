<?php
session_start();
header("refresh: 30;");
require 'connection.php';
if (isset($_SESSION["search"])) {
  $tran = $_SESSION["transmission"];
  $brand =  $_SESSION["brand"];
  $office = $_SESSION["office"];
  $query = "SELECT * FROM `cars` WHERE `brand`" . $brand . " AND `transmission`" . $tran . " AND `office_id`" . $office . " AND `state` = 'Available' ORDER BY `cars`.`year` DESC;";
  unset($_SESSION["search"]);
} else {
  $query = "SELECT * FROM `cars` WHERE `state` = 'Available' ORDER BY `cars`.`year` DESC";
}
$rows = mysqli_query($conn, $query);
$items = mysqli_num_rows($rows);
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
                <li class="active"><a href="listing.php" class="nav-link">Listing</a></li>
                <li><a href="testimonials.php" class="nav-link">Testimonials</a></li>
                <li><a href="about.php" class="nav-link">About</a></li>
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
              <h1><strong>Listings</strong></h1>
              <div class="custom-breadcrumbs"><a href="index.php">Home</a> <span class="mx-2">/</span>
                <strong>Listings</strong>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Car Listings</strong></h2><br><br>
          </div>
        </div>

        <div class="row">
          <?php foreach ($rows as $row) : ?>
            <div class="col-md-6 col-lg-4 mb-4">

              <div class="listing d-block  align-items-stretch">
                <div class="listing-img h-100 mr-4">
                  <img src="img/<?php echo $row["image"]; ?>" alt="Image" class="img-fluid" style="height: 232px; width: 290px;">
                </div>
                <div class="listing-contents h-100">
                  <h3 class="text-capitalize"><?php echo "$row[brand] $row[model]"; ?></h3>
                  <div class="rent-price">
                    <strong>$<?php echo $row["price"]; ?></strong><span class="mx-1">/</span>day
                  </div>
                  <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                    <div class="listing-feature pr-4">
                      <span class="caption">Transmission:</span>
                      <span class="text"><?php echo $row["transmission"]; ?></span>
                    </div>
                    <div class="listing-feature pr-4">
                      <span class="caption">Passenger:</span>
                      <span class="number"><?php echo $row["seats"]; ?></span>
                    </div>
                    <div class="listing-feature pr-4">
                      <span class="caption">Year:</span>
                      <span class="number"><?php echo $row["year"]; ?></span>
                    </div>
                  </div>
                  <div class="d-md-flex justify-content-around">
                    <?php
                    $number = $row["plate_number"];
                    $officeNo = $row["office_id"];
                    $query1 = "SELECT * FROM `office` WHERE `office_id`= '$officeNo'";
                    $result1 = mysqli_query($conn, $query1);
                    $res = mysqli_fetch_assoc($result1);
                    ?>
                    <div class="listing-feature pr-4">
                      <span class="caption"><strong>Office:</strong></span><br>
                      <span class="text"><?php echo $res['city']; ?></span>
                    </div>
                    <?php
                    if (isset($_SESSION['customer_id'])) {
                      echo "<div><a href='viewCar.php?plate_number=$number' class='btn btn-primary btn-sm'>Rent Now</a></div>";
                    } else {
                      echo '<div><a href="signIn.php" class="btn btn-primary btn-sm">Rent Now</a></div>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <?php
          if ($items == 0) {
            echo '<p class="font-size-25 text-danger text-center">We apologize, but we were unable to find any results for your search. Please make sure your search criteria is correct and try again, or consider broadening your search to include more options. If you need further assistance, please donot hesitate to contact us.</p>';
          }
          ?>

        </div>
        <!-- Pageing part -->
        <!-- <div class="row">
          <div class="col-5">
            <div class="custom-pagination">
              <a href="#">1</a>
              <span>2</span>
              <a href="#">3</a>
              <a href="#">4</a>
              <a href="#">5</a>
            </div>
          </div>
        </div> -->
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