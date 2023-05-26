<?php
include "app/connection.php";
include "app/helper.php";

$productId = $_GET['pid'];
if ($productId  != "") {
	$proSel = "SELECT * FROM products WHERE product_id = $productId AND status = 1";
	$proRes = $conn->query($proSel);
	$data = $proRes->fetch_assoc();
	// p($data);
} else {
	die('404');
}



$pageTitle = "Bakery - Product";
include "common/header.php";
?>

<!-- start banner Area -->
<section class="banner-area relative" id="home">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?php echo $data['name'] ?>
				</h1>
				<p class="text-white link-nav"><a href="index.php">Home </a> <span class="lnr lnr-arrow-right"></span><a href="blog-home.php">Blog </a> <span class="lnr lnr-arrow-right"></span> <a href="blog-single.php"> <?php echo $data['name'] ?></a></p>
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start post-content Area -->
<section class="post-content-area single-post-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 posts-list">
				<dsiv class="single-post row">
					<div class="col-lg-12">
						<div class="feature-img">
							<img class="img-fluid" src="img/product/<?php echo $data['image'] ?>" alt="">
						</div>
					</div>
			</div>
			<div class="col-lg-6 ">
				<a class="posts-title" href="#">
					<h3><?php echo $data['name'] ?></h3>
				</a>
				<?php echo $data['description'] ?>
				<button class="btn btn-primary" onclick="addToCart(<?php echo $productId ?>,this)">Add to Cart</button>
			</div>
		</div>

	</div>
	</div>
	</div>
</section>
<!-- End post-content Area -->
<!-- End about-video Area -->
<?php
include "common/footer.php";
?>
<script>
	function addToCart(productId, btn) {
		$.ajax({
			url: "cart-ajax.php",
			data: {
				pId: productId
			},
			type: "get",
			beforeSend: function() {
				$(btn).attr("disabled", true);
			},
			success: function(resp) {
				var jsonResp = JSON.parse(resp);
				showSnackbar(jsonResp.status, jsonResp.message);
				$("#cart_count").text(jsonResp.count);
				$(btn).attr("disabled", false);
			}
		})
	}
</script>