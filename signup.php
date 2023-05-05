<?php
include "app/connection.php";
include "app/helper.php";
$pageTitle = "Menu List";
$cid = $_GET['cid'];
$error = 0;
$msg = "";
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];

    if ($name == "" || $email == "" || $password == "" || $con_password == "") {
        $msg = "Please enter all the fields";
        $error = 1;
    } else {
        if ($password !== $con_password) {
            $msg = "Password and Confirm password must match";
            $error = 1;
        } else {
            $selUser = "SELECT * FROM users WHERE user_email = '$email'";
            $resUser = $conn->query($selUser);
            if ($resUser->num_rows != 0) {
                $msg = "Email address already exists";
                $error = 1;
            } else {
                $password = md5($password);
                $ins = "INSERT INTO users SET user_name = '$name', user_email = '$email', user_password = '$password'";
                try {
                    $conn->query($ins);
                    $msg = "Signup successfull";
                    $error = 0;
                    $email = "";
                    $name = "";
                } catch (Exception $err) {
                    $msg = "Unable to create account right now";
                    $error = 1;
                }
            }
        }
    }
}

include "common/header.php";
?>

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Sign Up
                </h1>
                <p class="text-white link-nav"><a href="index.php">Home </a> <span class="lnr lnr-arrow-right"></span> <a href="menu.php"> Sign Up</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- Start menu-list Area -->
<section class="menu-list-area section-gap">
    <div class="container">
        <div class="row">
            <div class="mx-auto col-6">
                <h1 class="mb-3 text-center">
                    Sign Up
                </h1>
                <h4 class="text-center my-2 <?php echo $error == 1 ? 'text-danger' : 'text-success'  ?>">
                    <?php echo $msg ?>
                </h4>
                <form class="form-area" method="post">
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <input name="name" placeholder="Enter your name" class="common-input mb-20 form-control" required="" type="text" value="<?php echo $name ?>">

                            <input name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" class="common-input mb-20 form-control" required="" type="email" value="<?php echo $email ?>">

                            <input name="password" placeholder="Enter password" class="common-input mb-20 form-control" required="" type="password">

                            <input name="con_password" placeholder="Re-enter password" class="common-input mb-20 form-control" required="" type="password">
                        </div>
                        <div class="col-lg-12">
                            <button class="genric-btn primary" name="signup">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End menu-list Area -->

<!-- End about-video Area -->
<?php
include "common/footer.php";
?>