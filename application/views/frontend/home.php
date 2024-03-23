<!DOCTYPE html>
<html lang="tr" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/elements/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="colorlib">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Log on to codeastro.com for more projects -->
	<!-- Site Title -->
	<title>BUS TICKET BOOKING</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<style type="text/css">
		.services-container {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 20px;
			padding: 20px;
			position: relative;
		}

		.service-overlay {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: rgba(0, 0, 0, 0.5);
			/* Or any other overlay effect */
			z-index: -1;
		}

<<<<<<< Updated upstream
		.service {
			background: #ffffff;
			border-radius: 10px;
			padding: 20px;
			text-align: center;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.service-icon img {
			width: 150px;
			height: 150px;
			margin-bottom: 15px;
		}

		.service-info h4 {
			margin-bottom: 10px;
			color: #333333;
		}

		.service-info p {
			color: #666666;
=======
		/* Define the hover effect */
		.service:hover {
			background-color: #e6f7e8;
			/* Light green color */
		}

		/* Style for service cards */
		.service {
			display: flex;
			flex-direction: column;
			align-items: center;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin: 10px;
			background-color: #fff;
			/* White background color */
			transition: background-color 0.3s ease;
		}

		.service-icon img {
			width: 100px;
			/* Adjust as needed */
		}

		.service-info {
			text-align: center;
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
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
=======
						<h4>Gezi Ayrıntılarını Seçin</h4>
						<br>
						<p>
							Kalkış yerini, varış yerini, seyahat tarihini girin ve ardından 'Bilet Ara'ya tıklayın.</p>
>>>>>>> Stashed changes
					</div>
				</div>
				<div class="service">
					<div class="service-icon">
						<img src="<?php echo base_url() ?>assets/frontend/img/b2.png" alt="Choose Your Bus and Seat">
					</div>
					<div class="service-info">
						<h4>Otobüsünüzü Seçin</h4>
						<br>
						<p>
							Otobüs, koltuk, kalkış yeri, varış yeri seçin, yolcu bilgilerini doldurun ve 'Ödeme Onayı'
							butonuna tıklayın</p>
					</div>
<<<<<<< Updated upstream
					<div class="col-lg-4 col-md-6">
						<div class="single-service">
							<img class="img-fluid" src="<?php echo base_url() ?>assets/frontend/img/b2.png" width="150"
								height="150" alt="">
							<h4>Choose your bus and seat</h4>
							<p>
								Select bus, seat, place of departure, destination, fill in passenger details and click
								'Payment'
							</p>
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
=======
				</div>
				<div class="service">
					<div class="service-icon">
						<img src="<?php echo base_url() ?>assets/frontend/img/b3.png" alt="Easy Payment Method">
					</div>
					<div class="service-info">
						<h4>Kolay Ödeme Yöntemi</h4>
						<br>
						<p>Ödeme internet bankacılığı yoluyla yapılabilir.</p>
>>>>>>> Stashed changes
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