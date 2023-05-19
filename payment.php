<?php
require 'connection.php';
session_start();
unset($_SESSION['payment']);

if (!isset($_SESSION['customer_id'])) {
    header("Location: index.php");
} else {
    $Id = $_SESSION['customer_id'];
    $query = "SELECT * FROM customer WHERE customer_id='$Id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $fname = $row["fname"];
}
if (isset($_SESSION['start_date']) & isset($_SESSION['end_date'])) {
    $start_date = $_SESSION['start_date'];
    $end_date = $_SESSION['end_date'];
}
$number = $_SESSION['plate_number'];
$query2 = "SELECT * FROM `cars` where plate_number = '$number'";
$result2 = mysqli_query($conn, $query2);
$row2 = $result2->fetch_assoc();
$number = $_SESSION['plate_number'];
$query2 = "SELECT * FROM `cars` where plate_number = '$number'";
$result2 = mysqli_query($conn, $query2);
$row2 = $result2->fetch_assoc();
$query3 = "SELECT * FROM `reservation` ORDER BY `reservation`.`reservation_id` DESC";
$result3 = mysqli_query($conn, $query3);
$num = $result3->fetch_assoc();
$paymentNumber = $num['reservation_id'] + 1;
$date1 = date_create($start_date);
$date2 = date_create($end_date);
$diff = date_diff($date1, $date2);
$numDiff = $diff->format("%a") + 1;
$totalCost = $row2['price'] * $numDiff;
$currentDate = date("Y-m-d");
$start_date = date_format($date1, "Y-m-d");
$end_date = date_format($date2, "Y-m-d");


if (isset($_POST["Pay"])) {
    $total = $totalCost * -1;
    $insert_query = "INSERT INTO `reservation`(`customer_id`, `office_id`, `plate_number`, `start_date`, `end_date`, `total_cost`, `reserv_date`) VALUES ('$row[customer_id]','$row2[office_id]','$row2[plate_number]','$start_date','$end_date','$total','$currentDate')";
    mysqli_query($conn, $insert_query);
    $_SESSION["insert"] = true;
    unset($_POST["Pay"]);
    unset($_SESSION["insert"]);
    unset($_SESSION['payment']);
}
if (isset($_POST["Reserve"])) {
    $insert_query = "INSERT INTO `reservation`(`customer_id`, `office_id`, `plate_number`, `start_date`, `end_date`, `total_cost`, `reserv_date`) VALUES ('$row[customer_id]','$row2[office_id]','$row2[plate_number]','$start_date','$end_date','$totalCost','$currentDate')";
    mysqli_query($conn, $insert_query);
    $_SESSION["insert"] = true;
    unset($_POST["Pay"]);
    unset($_SESSION["insert"]);
    unset($_SESSION['payment']);
}

if (isset($_POST["Reserve_pay"])) {
    $_SESSION['payment'] = true;
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
                            <h1><strong>Payments</strong></h1>
                            <div class="custom-breadcrumbs"><a href="index.php">Home</a> <span class="mx-2">/</span>
                                <strong>Payments</strong>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="site-section bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-4 mb-4">
                        <div class="listing d-block align-items-stretch h-100" style="background-color: transparent!important;">
                            <div class="listing-img mr-4">
                                <img src="img/<?php echo $row2["image"]; ?>" alt="Image" class="img-fluid">
                            </div>
                            <div class="listing-contents h-100 mt-4">
                                <h3 class="text-capitalize"><?php echo "$row2[brand] $row2[model]"; ?></h3>
                                <div class="rent-price">
                                    <strong>$<?php echo $row2["price"]; ?></strong><span class="mx-1">/</span>day
                                </div>
                                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                                    <div class="listing-feature pr-4">
                                        <span class="caption">Transmission:</span>
                                        <span class="text"><?php echo $row2["transmission"]; ?></span>
                                    </div>
                                    <div class="listing-feature pr-4">
                                        <span class="caption">Passenger:</span>
                                        <span class="number"><?php echo $row2["seats"]; ?></span>
                                    </div>
                                    <div class="listing-feature pr-4">
                                        <span class="caption">Year:</span>
                                        <span class="number"><?php echo $row2["year"]; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-8 mb-4">
                        <div class="container d-md-flex flex-wrap align-items-baseline">
                            <h2 class="section-heading w-50"><strong>Payment Information:</strong></h2>
                            <h4 class="section-heading w-50 text-md-center"># <?php echo $paymentNumber ?></h4><br><br>

                            <div class="d-md-flex flex-lg-row w-100 font-size-20 align-items-baseline mb-1">
                                <h5 class="col-md-5"><strong>Customer Name:</strong></h5>
                                <p class="col-md-8 text-capitalize"><?php echo "$row[fname] $row[lname]" ?></p>
                            </div>
                            <div class="d-md-flex flex-lg-row w-100 font-size-20 align-items-baseline mb-1">
                                <h5 class="col-md-5"><strong>Start Date:</strong></h5>
                                <p class="col-md-8 text-capitalize"><?php echo $start_date ?></p>
                            </div>
                            <div class="d-md-flex flex-lg-row w-100 font-size-20 align-items-baseline mb-1">
                                <h5 class="col-md-5"><strong>End Date:</strong></h5>
                                <p class="col-md-8 text-capitalize"><?php echo $end_date ?></p>
                            </div>

                            <div class="d-md-flex flex-lg-row w-100 font-size-20 align-items-baseline mb-1">
                                <h5 class="col-md-5"><strong>Duration:</strong></h5>
                                <p class="col-md-8 text-capitalize"><?php echo $numDiff  ?> Days</p>
                            </div>
                            <div class="d-md-flex flex-lg-row w-100 font-size-20 align-items-baselinemt mb-2">
                                <h5 class="col-md-5"><strong>Payment: </strong></h5>
                                <p class="col-md-8 text-capitalize">$ <?php echo  $totalCost ?></p>
                            </div>
                        </div>
                        <?php if (isset($_SESSION["insert"]) & !isset($_SESSION['payment'])) : ?>
                            <form method="POST" class="container" action="" onsubmit="">
                                <div class="row align-items-center">
                                    <div class="mb-3 mb-md-0 col-md-4 w-100 mr-3">
                                        <input type="submit" class='btn btn-primary btn-block py-3' value="Reserve" name="Reserve" class="w-100">
                                    </div>
                                    <div class="mb-3 mb-md-0 col-md-4 w-100">
                                        <input type="submit" class='btn btn-primary btn-block py-3' value="Reserve and Pay" name="Reserve_pay" class="w-100">
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>

                        <?php if (!isset($_SESSION["insert"])) : ?>
                            <div class="container row align-items-center">
                                <p class="font-size-24 text-success text-center ml-3">Reservation has been made. <a href="index.php" class="text-primary">Back to CarRental</a></p>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['payment'])) : ?>
                            <form method="POST" class="container" action="" onsubmit="">
                                <div class="row .justify-content-center mb-3">
                                    <div class="mb-3 mb-md-0 col-md-6">
                                        <label for="card" class="d-md-flex flex-lg-row w-100 align-items-baselinemt"><span class="icon  icon-cc-visa font-size-23 mr-2"> </span> Card Number</label>
                                        <input type="text" placeholder="1234 5678 9000 1234" id="card" name="card" class="form-control" required>
                                    </div>
                                    <div class="mb-3 mb-md-0 col-md-3">
                                        <label for="date" class="d-md-flex flex-lg-row w-100 align-items-baselinemt"><span class="icon  icon-date_range font-size-23 mr-2"> </span> Card Exp.</label>
                                        <input type="text" placeholder="MM/YY" id="date" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="mb-3 mb-md-0 col-md-3">
                                        <div class="form-control-wrap">
                                            <input type="text" placeholder="CCV" name="CCV" class="form-control w-100" require>
                                            <span class="icon icon-credit-card position-absolute font-size-25" style="top: 0px; right: 20px; transform: translate(-15%, 16px);"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 mb-md-0 col-md-6 w-100">
                                        <input type="submit" class='btn btn-primary btn-block py-3' value="Make a payment" name="Pay" class="w-100">
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>
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
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>