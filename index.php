<?php
session_start();
header("refresh: 30;");
require 'connection.php';
if (isset($_POST["search"])) {
  $_SESSION["transmission"] = $_POST["transmission"];
  $_SESSION["brand"] = $_POST["brand"];
  $_SESSION["office"] = $_POST["office"];
  $_SESSION["search"] = true;
  header("Location: listing.php");
}
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
                <li class="active"><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="listing.php" class="nav-link">Listing</a></li>
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
                  echo "<li><a href='logout.php' class='nav-link'>Logout </a><span class='icon-sign-out'></span></li>";
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


    <div class="hero" style="background-image: url('images/hero_1_a.jpg');">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-10">

            <div class="row mb-5">
              <div class="col-lg-7 intro">
                <h1><strong>Rent a car</strong> is within your finger tips.</h1>
              </div>
            </div>

            <form class="trip-form" method="POST">
              <div class="row align-items-center">
                <?php
                $query = "SELECT * FROM `office`";
                $query2 = "SELECT DISTINCT `brand` FROM `cars`";
                $query3 = "SELECT DISTINCT `transmission` FROM `cars`";
                $rows = mysqli_query($conn, $query);
                $rows2 = mysqli_query($conn, $query2);
                $rows3 = mysqli_query($conn, $query3);
                ?>
                <div class="mb-3 mb-md-0 col-md-3">
                  <select name="office" class="custom-select form-control">
                    <option value="IS NOT NULL">Office</option>
                    <?php foreach ($rows as $row) : ?>
                      <option value="= '<?php echo $row['office_id'] ?>' "><?php echo $row['city'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3 mb-md-0 col-md-3">
                  <select name="brand" class="custom-select form-control">
                    <option value="IS NOT NULL">Brand</option>
                    <?php foreach ($rows2 as $row) : ?>
                      <option value="= '<?php echo $row['brand'] ?>'"><?php echo $row['brand'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3 mb-md-0 col-md-3">
                  <select name="transmission" class="custom-select form-control">
                    <option value="IS NOT NULL">Transmission</option>
                    <?php foreach ($rows3 as $row) : ?>
                      <option value="= '<?php echo $row['transmission'] ?>' "><?php echo $row['transmission'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3 mb-md-0 col-md-3">
                  <input type="submit" value="Search Now" name="search" class="btn btn-primary btn-block py-3">
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>



    <div class="site-section">
      <div class="container">
        <h2 class="section-heading"><strong>How it works?</strong></h2>
        <p class="mb-5">Easy steps to get you started</p>

        <div class="row mb-5">
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="step">
              <span>1</span>
              <div class="step-inner">
                <span class="number text-primary">01.</span>
                <h3>Set up your account</h3>
                <p>sign in by your account or sign up and setup the payments information for free</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="step">
              <span>2</span>
              <div class="step-inner">
                <span class="number text-primary">02.</span>
                <h3>Select a car</h3>
                <p>select the date you want then choose one of our available cars</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="step">
              <span>3</span>
              <div class="step-inner">
                <span class="number text-primary">03.</span>
                <h3>Payment</h3>
                <p>Enter the payment method to finish the payments and Gooo!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 text-center order-lg-2">
            <div class="img-wrap-1 mb-5">
              <img src="images/feature_01.png" alt="Image" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-4 ml-auto order-lg-1">
            <h3 class="mb-4 section-heading">
              <strong>You can easily avail our promo for renting a car.</strong>
            </h3>
            <p class="mb-5">Our company is committed to providing excellent customer service and ensuring that your car rental experience is smooth and stress-free. We have a team of friendly and knowledgeable staff ready to assist you with any questions or concerns you may have. We also offer 24/7 roadside assistance for added peace of mind.
            </p>
            <p><a href="about.php" class="btn btn-primary">Meet them now</a></p>
          </div>
        </div>
      </div>
    </div>



    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Car Listings</strong></h2>
            <p class="mb-5">Our new Collections</p>
          </div>
        </div>


        <div class="row">
          <?php
          $i = 1;
          $query = "SELECT * FROM `cars` ORDER BY `cars`.`year` DESC";
          $rows = mysqli_query($conn, $query);
          ?>
          <?php foreach ($rows as $row) : ?>
            <?php if ($i <= 6) : ?>
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
              <?php $i = $i + 1; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Features</strong></h2><br>
            <!-- <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 mb-5">
            <div class="service-1 dark">
              <span class="service-1-icon">
                <span class="icon-home"></span>
              </span>
              <div class="service-1-contents">
                <h3>Flexible rental periods</h3>
                <p>Offer customers the ability to rent a car for as long as they need, whether it's a few hours, a day, a week, or longer.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-5">
            <div class="service-1 dark">
              <span class="service-1-icon">
                <span class="icon-add_location"></span>
              </span>
              <div class="service-1-contents">
                <h3>Pick-up and drop-off locations</h3>
                <p>Offer customers the option to pick up and drop off their rental car at different locations, depending on their needs and itinerary.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-5">
            <div class="service-1 dark">
              <span class="service-1-icon">
                <span class="icon-watch_later"></span>
              </span>
              <div class="service-1-contents">
                <h3>24/7 customer support</h3>
                <p>Provide customers with access to 24/7 customer support, either through a phone line or online chat, to assist them with any questions or concerns they may have.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-5">
            <div class="service-1 dark">
              <span class="service-1-icon">
                <span class="icon-security"></span>
              </span>
              <div class="service-1-contents">
                <h3>Security of payments</h3>
                <p>Our website is also secured with a SSL (Secure Sockets Layer) certificate, which ensures that your data is transmitted securely and cannot be accessed by unauthorized parties.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-5">
            <div class="service-1 dark">
              <span class="service-1-icon">
                <span class="icon-local_offer"></span>
              </span>
              <div class="service-1-contents">
                <h3>Special deals and discounts</h3>
                <p>ffer promotions and discounts to customers, such as a percentage off their rental or a free upgrade, to encourage them to book with your company.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-5">
            <div class="service-1 dark">
              <span class="service-1-icon">
                <span class="icon-rate_review"></span>
              </span>
              <div class="service-1-contents">
                <h3>Customer reviews and ratings</h3>
                <p>Display customer reviews and ratings on your website to help potential customers make informed decisions and build trust in your company.</p>
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
            <h2 class="section-heading"><strong>Testimonials</strong></h2><br>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"I recently rented a car from CarRental for a weekend getaway and was extremely impressed with the level of service I received. The booking process was quick and easy, and the staff was friendly and helpful. The car was clean and well-maintained, and the rates were very competitive. I will definitely be using CarRental for all of my future car rental needs."</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="images/person_1.jpg" alt="Image" class="img-fluid mr-3">
                <div class="author-name">
                  <span class="d-block">Mike Fisher</span>
                  <span>Customer, Ford</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"I rented a car from CarRental for a business trip and couldn't have been happier with my experience. The staff was professional and efficient, and the car was in great condition. The online booking process was a breeze, and the rates were very reasonable. I highly recommend car rental for all of your CarRental needs."</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                <div class="author-name">
                  <span class="d-block">Jean Stanley</span>
                  <span>Traveler</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"I recently rented a car from CarRental for a family vacation and was blown away by the level of service I received. The staff was friendly and helpful, and the car was clean and well-maintained. The online booking process was quick and easy, and the rates were very reasonable. I will definitely be using CarRental for all of my future car rental needs."</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="images/person_3.jpg" alt="Image" class="img-fluid mr-3">
                <div class="author-name">
                  <span class="d-block">Katie Rose</span>
                  <span>Customer</span>
                </div>
              </div>
            </div>
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