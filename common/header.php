<div class=<!DOCTYPE html>
    <html lang="zxx" class="no-js">

    <head>
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <link rel="shortcut icon" href="img/fav.png">
        <!-- Author Meta -->
        <meta name="author" content="colorlib">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- Site Title -->
        <title><?php echo $pageTitle; ?></title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
        <!--
			CSS
			============================================= -->
        <link rel="stylesheet" href="css/linearicons.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/nice-select.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/main.css">
        <style>
            #snackbar {
                visibility: hidden;
                /* Hidden by default. Visible on click */
                min-width: 250px;
                /* Set a default minimum width */
                margin-left: -125px;
                /* Divide value of min-width by 2 */
                background-color: #333;
                /* Black background color */
                color: #fff;
                /* White text color */
                text-align: center;
                /* Centered text */
                border-radius: 2px;
                /* Rounded borders */
                padding: 16px;
                /* Padding */
                position: fixed;
                /* Sit on top of the screen */
                z-index: 1;
                /* Add a z-index if needed */
                left: 50%;
                /* Center the snackbar */
                bottom: 30px;
                /* 30px from the bottom */
            }

            /* Show the snackbar when clicking on a button (class added with JavaScript) */
            #snackbar.show {
                visibility: visible;
                /* Show the snackbar */
                /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
  However, delay the fade out process for 2.5 seconds */
                -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
                animation: fadein 0.5s, fadeout 0.5s 2.5s;
            }

            /* Animations to fade the snackbar in and out */
            @-webkit-keyframes fadein {
                from {
                    bottom: 0;
                    opacity: 0;
                }

                to {
                    bottom: 30px;
                    opacity: 1;
                }
            }

            @keyframes fadein {
                from {
                    bottom: 0;
                    opacity: 0;
                }

                to {
                    bottom: 30px;
                    opacity: 1;
                }
            }

            @-webkit-keyframes fadeout {
                from {
                    bottom: 30px;
                    opacity: 1;
                }

                to {
                    bottom: 0;
                    opacity: 0;
                }
            }

            @keyframes fadeout {
                from {
                    bottom: 30px;
                    opacity: 1;
                }

                to {
                    bottom: 0;
                    opacity: 0;
                }
            }
        </style>
    </head>

    <body>
        <div id="snackbar">Some text some message..</div>
        <header id="header" id="home">
            <div class="header-top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-6 col-4 header-top-left no-padding">
                            <div class="menu-social-icons">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-8 header-top-right no-padding">
                            <a class="btns" href="tel:+953 012 3654 896">+953 012 3654 896</a>
                            <a class="btns" href="mailto:support@colorlib.com">support@colorlib.com</a>
                            <a class="icons" href="tel:+953 012 3654 896">
                                <span class="lnr lnr-phone-handset"></span>
                            </a>
                            <a class="icons" href="mailto:support@colorlib.com">
                                <span class="lnr lnr-envelope"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container main-menu">
                <div class="row align-items-center justify-content-between d-flex">
                    <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="menu-active"><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="menu.php">Menu</a></li>
                            <li><a href="team.php">Team</a></li>
                            <li class="menu-has-children"><a href="">Blog</a>
                                <ul>
                                    <li><a href="blog-home.php">Blog Home</a></li>
                                    <li><a href="blog-single.php">Blog Single</a></li>
                                    <li class="menu-has-children"><a href="">Level 2</a>
                                        <ul>
                                            <li><a href="#">Item One</a></li>
                                            <li><a href="#">Item Two</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="contact.php">Contact</a></li>
                            <?php
                            if (isset($_SESSION['user_id'])) {
                            ?>
                                <li>
                                    <a href="profile.php">
                                        <?php echo $_SESSION['user_name'] ?>
                                    </a>
                                </li>
                                <li><a href="logout.php">Logout</a></li>
                                <?php
                                $userId = $_SESSION['user_id'];
                                $selCart = "SELECT * FROM cart WHERE user_id = $userId";
                                $cartRes = $conn->query($selCart);
                                ?>
                                <li><a href="cart.php">Cart (<span id="cart_count"><?php echo $cartRes->num_rows ?></span>) </a></li>
                            <?php
                            } else {
                            ?>
                                <li><a href="signup.php">Sign Up</a></li>
                                <li><a href="login.php">Login</a></li>
                            <?php
                            }
                            ?>

                        </ul>
                    </nav>
                    <!-- #nav-menu-container -->
                </div>
            </div>
        </header>
        <!-- #header -->