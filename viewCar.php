<?php
session_start();
require 'connection.php';
unset($_SESSION['start_date']);
unset($_SESSION['end_date']);
unset($_SESSION["inVaild"]);
unset($_SESSION["rented"]);

if (isset($_POST["check_car"])) {
    $_SESSION['start_date'] = $_POST["start_date"];
    $_SESSION['end_date'] = $_POST["end_date"];
    $_SESSION['plate_number'] = $_GET['plate_number'];

    $date1 = date_create($_POST["start_date"]);
    $date2 = date_create($_POST["end_date"]);
    $start_date = date_format($date1, "Y-m-d");
    $end_date = date_format($date2, "Y-m-d");

    if (strtotime($_POST["start_date"]) > strtotime('today')) {
        if (($_SESSION['end_date'] > $_SESSION['start_date'])) {
            $_SESSION["insert"] = true;
            $check_query = "SELECT * FROM reservation
                            WHERE
                                (
                                    (
                                        start_date >= '$start_date' AND end_date <= '$end_date'
                                    ) OR(
                                        start_date <= '$start_date' AND end_date >= '$end_date'
                                    ) OR(
                                        start_date BETWEEN '$start_date' AND '$end_date'
                                    ) OR(
                                        end_date BETWEEN '$start_date' AND '$end_date'
                                    )
                                ) AND plate_number = '$_GET[plate_number]' ;";
            $result = mysqli_query($conn, $check_query);
            if (mysqli_num_rows($result) == 0) {
                header("Location: payment.php");
                unset($_SESSION["inVaild"]);
            } else {
                $_SESSION["rented"] = true;
            }
        }
    } else {
        $_SESSION["inVaild"] = true;
    }
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

<body onLoad="window.scroll(0, 150)">


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
                            <h1><strong>Veiw Car</strong></h1>
                            <div class="custom-breadcrumbs"><a href="index.php">Home</a> <span class="mx-2">/</span>
                                <strong>View Car</strong>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Section -->
        <div class="site-section bg-light">
            <div class="container">
                <div class="row">
                    <?php
                    $number = $_GET['plate_number'];
                    $query = "SELECT * FROM `cars` where plate_number = '$number'";
                    $result = mysqli_query($conn, $query);
                    $row = $result->fetch_assoc();;
                    ?>
                    <div class="col-md-4 col-lg-4 mb-4">
                        <div class="listing d-block align-items-stretch h-100" style="background-color: transparent!important;">
                            <div class="listing-img mr-4">
                                <img src="img/<?php echo $row["image"]; ?>" alt="Image" class="img-fluid">
                            </div>
                            <div class="listing-contents h-100 mt-4">
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
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-8 mb-4">
                        <div class="container d-md-flex flex-wrap">
                            <h2 class="section-heading w-100"><strong>Car Information:</strong></h2><br><br>
                            <div class="col-md-6">
                                <h5><strong>Car brand:</strong></h5>
                                <p class="mb-2 text-capitalize"><?php echo $row['brand'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Car type:</strong></h5>
                                <p class="mb-2 text-capitalize"><?php echo $row['type'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Car Color:</strong></h5>
                                <p class="mb-2 text-capitalize"><?php echo $row['color'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Number of Kilometers:</strong></h5>
                                <p class="mb-2 text-capitalize">45,000 km</p>
                            </div>
                            <div class="w-100 ml-3">
                                <h5><strong>Car description:</strong></h5>
                                <p class="mb-2"><?php echo $row['description'] ?></p>
                            </div>
                        </div>
                        <form class="trip-form p-4" method="POST">

                            <div class="row align-items-center">
                                <div class="mb-3 mb-md-0 col-md-3">
                                    <div class="form-control-wrap">
                                        <input type="text" id="cf-3" placeholder="Pick up" class="form-control datepicker px-3" name="start_date" require>
                                        <span class="icon icon-date_range"></span>

                                    </div>
                                </div>
                                <div class="mb-3 mb-md-0 col-md-3">
                                    <div class="form-control-wrap">
                                        <input type="text" id="cf-4" placeholder="Drop off" class="form-control datepicker px-3" name="end_date" require>
                                        <span class="icon icon-date_range"></span>
                                    </div>
                                </div>
                                <div class="mb-3 mb-md-0 col-md-6 w-100">
                                    <input type="submit" class='btn btn-primary btn-block py-3' value="Check for avalability" name="check_car">
                                </div>
                            </div>
                            <?php
                            if (isset($_SESSION["inVaild"])) {
                                echo "<p class='font-size-22 text-danger text-center mb-2 mt-3'>We're sorry, but it looks like there may have been a mistake in the information you provided. Please double-check your entry and try again. If you continue to have difficulties, don't hesitate to contact us for assistance.</p>";
                            }
                            if (isset($_SESSION["rented"])) {
                                echo '<p class="font-size-22 text-warning text-center mb-2 mt-3">Sorry, the car is not available at this time. Please consider trying another car or rental period.</p>';
                            }
                            ?>
                        </form>
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
        <!-- Site footer  -->
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