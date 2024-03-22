<!DOCTYPE html>
<html lang="tr" class="no-js">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="img/elements/fav.png">
	<meta name="author" content="colorlib">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta charset="UTF-8">
	<title>Umuttepe Turizm</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
	<style type="text/css">
		body {
			font-family: 'Roboto', sans-serif;
			color: #333;
			line-height: 1.6;
		}

		.services-container {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			gap: 20px;
			padding: 20px;
		}

		.service {
			background: #fff;
			border: 1px solid #ddd;
			border-radius: 5px;
			padding: 20px;
			text-align: center;
			width: calc(33.333% - 20px);
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.service-icon img {
			width: 100px;
			height: 100px;
			margin-bottom: 15px;
		}

		.service-info h4 {
			margin-bottom: 10px;
			color: #007bff;
		}

		.service-info p {
			color: #666;
		}

		@media (max-width: 768px) {
			.service {
				width: calc(50% - 20px);
			}
		}

		@media (max-width: 480px) {
			.service {
				width: 100%;
			}
		}
	</style>

	<?php $this->load->view('frontend/include/base_css'); ?>
</head>

<body>
	<!-- navbar -->
	<?php $this->load->view('frontend/include/base_nav'); ?>
	<!-- start banner Area -->
	<section class="banner-area relative section-gap relative" id="home"
		style="background-image: url('assets/frontend/img/otobüs.jpeg'); image-opacity: 0.7;">

		<br><br><br><br><br><br><br><br>
		<div class="container" style="width: 100%;">
			<br><br><br><br><br><br><br><br>
			<div class="services-container">
				<div class="service-overlay"></div>
				<div class="service">
					<div class="service-icon">
						<img src="<?php echo base_url() ?>assets/frontend/img/b1.png" alt="Select Trip Details">
					</div>
					<div class="service-info">
						<h4>Select Trip Details</h4>
						<p>Enter the place of departure, destination, travel date and then click 'Search'</p>
					</div>
				</div>
				<div class="service">
					<div class="service-icon">
						<img src="<?php echo base_url() ?>assets/frontend/img/b2.png" alt="Choose Your Bus and Seat">
					</div>
					<div class="service-info">
						<h4>Choose Your Bus and Seat</h4>
						<p>Select bus, seat, place of departure, destination, fill in passenger details and click
							'Payment'</p>
					</div>
				</div>
				<div class="service">
					<div class="service-icon">
						<img src="<?php echo base_url() ?>assets/frontend/img/b3.png" alt="Easy Payment Method">
					</div>
					<div class="service-info">
						<h4>Easy Payment Method</h4>
						<p>Payment can be made via ATM transfer, Internet banking.</p>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!-- End service Area -->
	<!-- End feature Area -->
	<!-- Log on to codeastro.com for more projects -->
	<!-- End Generic Start -->
	<!-- start footer Area -->
	<?php $this->load->view('frontend/include/base_footer'); ?>
	<!-- js -->
	<?php $this->load->view('frontend/include/base_js'); ?>
</body>

</html>