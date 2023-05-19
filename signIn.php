<?php
require 'connection.php';
?>
<!DOCTYPE html>
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

    <style>
        form {
            width: 400px;
            background-color: rgb(255, 255, 255);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            color: #000000;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
            font-size: 16px;
            font-weight: 500;
        }

        form input,
        .input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 5px;
            font-size: 14px;
            font-weight: 300;
            font-family: inherit;
            color: #000000;
        }

        ::placeholder {
            color: #000000;
        }

        input:focus {
            background-color: rgba(226, 226, 226, 0.67);
        }

        .link {
            text-align: center;
            margin: 10px 0px;
        }

        .link-sub {
            color: blue;
        }
    </style>

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
                        <div class="site-logo font-size-30">
                            <a href="index.php"><strong>CarRental</strong></a>
                        </div>
                    </div>
                </div>
        </header>
        <div class="hero" style="background-image: url('images/hero_1_a.jpg');">
            <form action=" " method="post">
                <h3>Login Here</h3>

                <label for="username">Username</label>
                <input type="email" placeholder="Email Address" id="username" name="email" required>

                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password" required>
                <?php
                if (isset($_POST["loginButton"])) {
                    session_start();
                    $userEmail = $_POST["email"];
                    $password = md5($_POST["password"]);
                    $query = "SELECT * FROM customer WHERE email='$userEmail'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    if (mysqli_num_rows($result) > 0) {
                        if ($password == $row['password']) {
                            $_SESSION['customer_id'] = $row["customer_id"];
                            header("Location: index.php");
                            die;
                        } else {
                            unset($_SESSION['customer_id']);
                            echo '<p class="font-size-12 text-danger text-center">Username or password are wrong, please try again</p>';
                        }
                    } else {
                        $_SESSION["login"] = false;
                        echo '<p class="font-size-15 text-primary text-center">Username doesnot exist, sign up Now!</p>';
                    }
                }
                ?>
                <div class="mb-3 mb-md-0">
                    <input type="submit" value="Login" name="loginButton" class="btn btn-primary btn-block py-3" style="margin-top: 25px;">
                </div>
                <div class="link">
                    Need an account?
                    <a href="signUp.php" class="link-sub"> Sign up now!</a></li>
                </div>
            </form>
        </div>
    </div>
</body>

</html>