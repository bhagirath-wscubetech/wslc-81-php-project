<?php
include "app/connection.php";
$pageTitle = "Menu List";
$cid = $_GET['cid'];
include "common/header.php";
error_reporting(E_ALL);
?>

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Menu List
				</h1>
				<p class="text-white link-nav"><a href="index.php">Home </a> <span class="lnr lnr-arrow-right"></span> <a href="menu.php"> Menu</a></p>
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start menu-list Area -->
<section class="menu-list-area section-gap">
	<div class="container">
		<div class="row">
			<div class="menu-cat mx-auto">
				<ul class="nav nav-pills" id="pills-tab" role="tablist">
					<?php
					$selCat = "SELECT * FROM categories WHERE status = 1";
					$resCat = $conn->query($selCat);
					$totalRows = $resCat->num_rows;
					while ($catData = $resCat->fetch_assoc()) {
					?>
						<li class="nav-item">
							<!-- active -->
							<span onclick="getProducts(this)" data-cid="<?php echo $catData['id'] ?>" class="nav-link" style="cursor: pointer;"><?php echo $catData['name']; ?> </span>
						</li>
					<?php
					}
					?>
				</ul>
			</div>

		</div>
		<?php
		if ($cid != "") {
			$proSel = "SELECT * FROM products WHERE category_id = $cid AND status = 1";
			$proRes = $conn->query($proSel);
		?>
			<div id="pills-tabContent" class="tab-content absolute">
				<?php
				if ($proRes->num_rows == 0) {
					echo "<h2 class='text-center'> No Product Found </h2>";
				} else {
					while ($proData = $proRes->fetch_assoc()) {
				?>
						<div class="tab-pane fade show active" id="pizza" role="tabpanel" aria-labelledby="pizza-tab">
							<div class="single-menu-list row justify-content-between align-items-center">
								<div class="col-lg-9">
									<!-- <a href="product-details.php?pid=<?php echo $proData['product_id'] ?>"> -->
									<h4><?php echo $proData['product_name'] ?></h4>
									<!-- CTRL + SHIFT + $ -->
									<!-- </a> -->
									<p>
										<?php echo $proData['description'] ?>
									</p>
								</div>
								<div class="col-lg-3 flex-row d-flex price-size">
									<img src="img/product/<?php echo $proData['image'] ?>" width="150" alt="">
								</div>
							</div>
						</div>
				<?php
					}
				}
			} else {
				?>
				<div id="pills-tabContent" class="tab-content absolute">
				</div>
			<?php
			}
			?>
			</div>
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
<script>
	function getProducts(item) {
		// console.log($(item).data('cid'));
		var cId = $(item).data('cid');
		$.ajax({
			type: "get",
			data: {
				cid: cId
			},
			url: "category_product.ajax.php",
			beforeSend: function() {
				$("#pills-tabContent").html("<h2 class='text-center'> Loading </h2>");
			},
			success: function(resp) {
				$("#pills-tabContent").html(resp);
			}
		})
	}
</script>