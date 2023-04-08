<?php
include "app/connection.php";
include "app/helper.php";
include "common/header.php";
?>

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Annoucements
                </h1>
                <p class="text-white link-nav"><a href="index.php">Home </a> <span class="lnr lnr-arrow-right"></span> <a href="menu.php"> Annoucements</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- Start menu-list Area -->
<section class="menu-list-area section-gap">
    <div class="container">
        <?php
        $sel = "SELECT * FROM announcements WHERE status = 1";
        $result = $conn->query($sel);
        // while ($data = $result->fetch_assoc()) {
        while ($data = $result->fetch_assoc()) :
        ?>
            <div id="pills-tabContent" class="tab-content absolute">
                <div class="tab-pane fade show active" id="pizza" role="tabpanel" aria-labelledby="pizza-tab">
                    <div class="single-menu-list row justify-content-between align-items-center">
                        <div class="col-lg-9">
                            <a href="#">
                                <h4><?php echo $data['title'] ?></h4>
                            </a>
                            <p>
                                <?php echo $data['description'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile
        // }
        ?>
    </div>
</section>
<!-- End menu-list Area -->

<!-- Start about-video Area -->
<section class="about-video-area section-gap">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 about-video-left">
                <h6 class="text-uppercase">Brand new app to blow your mind</h6>
                <h1>
                    We’ve made a life <br>
                    that will change you
                </h1>
                <p>
                    <span>We are here to listen from you deliver exellence</span>
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed doeiusmo d tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <a class="primary-btn" href="#">Get Started Now</a>
            </div>
            <div class="col-lg-6 about-video-right justify-content-center align-items-center d-flex">
                <a class="play-btn" href="https://www.youtube.com/watch?v=ARA0AxrnHdM"><img class="img-fluid mx-auto" src="img/play.png" alt=""></a>
            </div>
        </div>
    </div>
</section>
<!-- End about-video Area -->
<?php
include "common/footer.php";
?>