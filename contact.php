<?php
include "app/connection.php";
include "app/helper.php";
$pageTitle = "Bakery - Contact Us";
include "common/header.php";
?>

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
	<div class="container">
		<div class="row">
			<div class="map-wrap" style="width:100%; height: 445px;" id="map"></div>
			<div class="col-lg-4 d-flex flex-column address-wrap">
				<div class="single-contact-address d-flex flex-row">
					<div class="icon">
						<span class="lnr lnr-home"></span>
					</div>
					<div class="contact-details">
						<h5>Binghamton, New York</h5>
						<p>
							4343 Hinkle Deegan Lake Road
						</p>
					</div>
				</div>
				<div class="single-contact-address d-flex flex-row">
					<div class="icon">
						<span class="lnr lnr-phone-handset"></span>
					</div>
					<div class="contact-details">
						<h5>00 (958) 9865 562</h5>
						<p>Mon to Fri 9am to 6 pm</p>
					</div>
				</div>
				<div class="single-contact-address d-flex flex-row">
					<div class="icon">
						<span class="lnr lnr-envelope"></span>
					</div>
					<div class="contact-details">
						<h5>support@colorlib.com</h5>
						<p>Send us your query anytime!</p>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<form class="form-area " id="myForm" class="contact-form text-right">
					<div class="row">
						<div class="col-12">
							<h4 id="response" class="text-center"></h4>
						</div>
						<div class="col-lg-6 form-group">
							<input name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" type="text">

							<input name="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" type="email">

							<input name="subject" placeholder="Enter subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter subject'" class="common-input mb-20 form-control" type="text">
						</div>
						<div class="col-lg-6 form-group">
							<textarea class="common-textarea form-control" name="message" placeholder="Enter Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Messege'"></textarea>
						</div>
						<div class="col-lg-12">
							<div class="alert-msg" style="text-align: left;"></div>
							<button id="btn-submit" class="genric-btn primary" style="float: right;">Send Message</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- End contact-page Area -->
<?php
include "common/footer.php"
?>

<script>
	$("#myForm").on(
		"submit",
		function() {
			var formData = $(this).serialize();
			$.ajax({
				url: "contact-ajax.php",
				type: "post",
				data: formData,
				beforeSend: function() {
					$("#btn-submit").attr("disabled", true).text("Loading...");
				},
				// status: 1: Enquiry, 2: Incomplete data, 3: Server error
				success: function(json) {
					var resp = JSON.parse(json);
					if (resp.status == 0) {
						$("#response").addClass("text-danger").removeClass('text-success').text(resp.message);
					} else {
						$("#response").addClass("text-success").removeClass('text-danger').text(resp.message);
					}
					$("#btn-submit").attr("disabled", false).text("Send Message");
				}
			})
			return false;
		}
	)
</script>