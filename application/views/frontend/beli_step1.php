<!DOCTYPE html>
<html lang="zxx" class="no-js">

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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--CSS-->
	<?php $this->load->view('frontend/include/base_css'); ?>
</head>

<body>
	<!-- navbar -->
	<?php $this->load->view('frontend/include/base_nav'); ?>
	<section class="service-area section-gap relative">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<!-- Default Card Example -->
					<div class="card mb-5">
						<div class="card-header">
							<i class="fas fa-info-circle"></i> Ticket Description
						</div>
						<div class="card-body">
							<ul>
								<li>► Destination <b>
										<?php echo $asal['sehir_varis'] . " - " . $jadwal['sehir_varis'] . " [" . $jadwal['kd_varis'] . "]"; ?>
									</b></li>
								<li>► Name of Bus <b>
										<?php echo $jadwal['isim_otobus']; ?>
									</b></li>
								<li>► Bus Number <b>
										<?php echo $jadwal['plaka_otobus']; ?>
									</b></li>
								<li>► Departure <b>
										<?php echo strtoupper($asal['sehir_varis']) . " - " . $asal['terminal_varis']; ?>
									</b></li>
								<li>► Arrival <b>
										<?php echo strtoupper($jadwal['sehir_varis']) . " - " . $jadwal['terminal_varis']; ?>
									</b></li>
								<li>► Prices: <b>$
										<?php echo number_format((float) ($jadwal['fiyat_sefer']), 0, ",", "."); ?>
									</b></li>
								<li>► Depart Date <b>
										<?php echo nama_hari($tanggal) . "," . tgl_indo($tanggal) ?>
									</b></li>
								<li>► Depart. Time <b>at
										<?php echo $jadwal['kalkis_saati_sefer']; ?>
									</b></li>
								<li>► Arrival Time <b>at
										<?php echo $jadwal['varis_saati_sefer']; ?>
									</b></li>
								<li>► Please select a seat</li>
								<li>► Select a maximum of 4 seats</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<form action="<?php echo base_url('tiket/afterbeli') ?>" method="get">
						<input type="hidden" name="tgl" value="<?php echo $tanggal ?>">
						<!-- Default Card Example -->
						<div class="card mb-5">
							<div class="card-header">
								<i class="fas fa-bus"></i> Seat Selection
							</div>

							<center class="">
								<?php
								$total_seats = 20;
								$seats_per_row = 3;
								$driver_seat_position = 0; // Driver's seat position
								$seat_number = 1; // Initialize seat number starting from 1
								
								?>

								<table class="">
									<?php for ($i = 0; $i < $total_seats; $i += $seats_per_row): ?>
										<tr>
											<?php for ($j = $i; $j < $i + $seats_per_row; $j++): ?>
												<?php if ($j == $driver_seat_position): ?>
													<td class=''>
														<label class='btn btn-primary'>
															<a value='' autocomplete='off' disabled='disabled'>Driver's Seat</a>
														</label>
													</td>
												<?php else: ?>
													<td class=''>
														<?php
														$isChecked = false;
														foreach ($kursi as $koltuk) {
															if ($koltuk['no_koltuk_siparis'] == $seat_number) {
																if ($koltuk['cinsiyet'] == 'Erkek') {
																	echo "<label class='custom-checkbox checked-e'>";
																} elseif ($koltuk['cinsiyet'] == 'Kadin') {
																	echo "<label class='custom-checkbox checked-k'>";
																}
																$isChecked = true;
																break;
															}
														}
														if (!$isChecked) {
															echo "<label class='custom-checkbox'>";
														}
														?>
														<input name='kursi[]' value='<?php echo $seat_number; ?>'
															id='<?php echo $seat_number; ?>'
															onclick='cer(this); showGenderPopUp(<?php echo $seat_number; ?>);'
															autocomplete='off' type='checkbox' <?php if ($isChecked) {
																echo "disabled";
															} ?>>
														<?php echo $seat_number; ?>
														</label>
														<div id="genderPopUp_<?php echo $seat_number; ?>" class="pop-up">
															<button type="button" class="male"
																onclick="handleGenderSelection('<?php echo $seat_number; ?>', 'Erkek')">Erkek
															</button>
															<button type="button" class="female"
																onclick="handleGenderSelection('<?php echo $seat_number; ?>', 'Kadın')">Kadın
															</button>
														</div>
														<?php $seat_number++; ?>
													</td>
												<?php endif; ?>
											<?php endfor; ?>
										</tr>
									<?php endfor; ?>
								</table>
							</center>

						</div>
				</div>
				<!-- Log on to codeastro.com for more projects -->
				<div class="col-lg-4">
					<!-- Default Card Example -->
					<div class="card mb-5">
						<div class="card-header">
							<i class="fas fa-bookmark"></i> Booking Confirmation
						</div>
						<div class="alert alert-success" role="alert">
							<p>After selecting a seat, please click the 'Next' button to proceed.</p>
							<div class='btn-group'>
								<a href="<?php echo base_url('tiket/cekjadwal/' . $tanggal . '/' . $asal['kd_varis'] . '/' . $jadwal['sehir_varis']) ?>"
									class='btn btn-default'>Go Back</a>
								<input class="btn btn-info pull-right" disabled="disabled" type="submit" value="Next">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->
	<!-- End Generic Start -->
	<!-- Log on to codeastro.com for more projects -->
	<!-- start footer Area -->
	<?php $this->load->view('frontend/include/base_footer'); ?>
	<style>
		.custom-checkbox input {
			display: none;
		}

		.custom-checkbox::before {
			content: "";
			display: none;
			position: absolute;
			top: 50%;
			left: 50%;
			width: 8px;
			height: 8px;
			background-color: #007bff;
			transform: translate(-50%, -50%);
		}

		.custom-checkbox input:checked+label::before {
			display: block;
		}

		.custom-checkbox.checked-e input:checked+label::before {
			background-color: lightblue;
		}

		.custom-checkbox.checked-k input:checked+label::before {
			background-color: lightpink;
		}

		.custom-checkbox {
			width: 40px;
			height: 40px;
			display: inline-block;
			cursor: pointer;
			text-align: center;
			border: 1px solid #ccc;
			padding: 5px;
			margin: 5px;
		}

		.pop-up {
			display: none;
			position: absolute;
			background-color: #fff;
			border: 1px solid #ccc;
			padding: 10px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
			z-index: 1;
		}

		.pop-up button {
			margin: 5px;
		}

		.custom-checkbox.checked-e {
			background-color: lightblue;
		}

		.custom-checkbox.checked-k {
			background-color: lightpink;
		}
	</style>

	<!-- js -->
	<script>
		jQuery(document).ready(function () {
			var checkboxes = $("input[type='checkbox']"),
				submitButt = $("input[type='submit']");

			checkboxes.click(function () {
				submitButt.attr("disabled", !checkboxes.is(":checked"));
			});
		});

		var selectedSeatsCount = 0;
		function cer(checkbox) {
			var checkboxParent = checkbox.parentNode;

			if (checkbox.checked) {
				if (selectedSeatsCount >= 4) {
					swal("En fazla 4 koltuk seçebilirsiniz!");
					checkbox.checked = false;
				} else {
					if (!checkboxParent.style.backgroundColor || checkboxParent.style.backgroundColor !== "lightgreen") {
						checkboxParent.style.backgroundColor = "";
						selectedSeatsCount++;
					}
				}
			} else {
				checkboxParent.style.backgroundColor = "";
				selectedSeatsCount--;
			}
		}

		function showGenderPopUp(seatNumber) {
			var genderPopUp = document.getElementById('genderPopUp_' + seatNumber);
			var checkbox = document.getElementById(seatNumber);

			if (checkbox.checked) {
				if (!checkbox.parentNode.style.backgroundColor || checkbox.parentNode.style.backgroundColor !== "lightgreen") {
					genderPopUp.style.display = 'block';
				}
			} else {
				genderPopUp.style.display = 'none';
			}
		}

		function handleGenderSelection(seatNumber, selectedGender) {
			var checkbox = document.getElementById(seatNumber);
			var genderPopUp = document.getElementById('genderPopUp_' + seatNumber);

			if (selectedGender === 'Erkek') {
				checkbox.parentNode.style.backgroundColor = 'lightblue';
			} else if (selectedGender === 'Kadın') {
				checkbox.parentNode.style.backgroundColor = 'lightpink';
			}

			genderPopUp.style.display = 'none';
		}
	</script>
	<?php $this->load->view('frontend/include/base_js'); ?>
</body>

</html>