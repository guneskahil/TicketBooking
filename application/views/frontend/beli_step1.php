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
								<table class="">
									<tr>
										<td class=''>
											<label class='btn btn-primary'>
												<a value='' autocomplete='off' disabled='disabled'>Şoför Koltuğu</a>
											</label>
										</td>
										<td class=''>
											<label width='40' class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '1'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('1')">
												<input name='kursi[]' value='1' id='1' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '1'), $kursi)) {
														echo "disabled checked";
													} ?>>1
											</label>
											<label width='40' class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '2'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('2')">
												<input name='kursi[]' value='2' id='2' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '2'), $kursi)) {
														echo "disabled checked";
													} ?>>2
											</label>
											<div id="genderPopUp_1" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('1', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('1', 'Kadın')">Kadın</button>
											</div>
											<div id="genderPopUp_2" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('2', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('2', 'Kadın')">Kadın</button>
											</div>
										</td>

									</tr>
									<tr>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '3'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('3')">
												<input name='kursi[]' value='3' id='3' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '3'), $kursi)) {
														echo "disabled checked";
													} ?>>3
											</label>
											<div id="genderPopUp_3" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('3', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('3', 'Kadın')">Kadın</button>
											</div>
										</td>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '4'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('4')" style="width: 40px;">
												<input name='kursi[]' value='4' id='4' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '4'), $kursi)) {
														echo "disabled checked";
													} ?>>4
											</label>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '5'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('5')" style="width: 40px;">
												<input name='kursi[]' value='5' id='5' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '5'), $kursi)) {
														echo "disabled checked";
													} ?>>5
											</label>
											<div id="genderPopUp_4" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('4', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('4', 'Kadın')">Kadın</button>
											</div>
											<div id="genderPopUp_5" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('5', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('5', 'Kadın')">Kadın</button>
											</div>
										</td>
									</tr>
									<tr>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '6'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('6')" style="width: 40px;">
												<input name='kursi[]' value='6' id='6' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '6'), $kursi)) {
														echo "disabled checked";
													} ?>>6
											</label>
											<div id="genderPopUp_6" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('6', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('6', 'Kadın')">Kadın</button>
											</div>
										</td>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '7'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('7')" style="width: 40px;">
												<input name="kursi[]" value="7" id="7" onclick='cer(this)'
													autocomplete="off" type="checkbox" style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '7'), $kursi)) {
														echo "disabled checked";
													} ?>>
												7
											</label>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '8'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('8')" style="width: 40px;">
												<input name="kursi[]" value="8" id="8" onclick='cer(this)'
													autocomplete="off" type="checkbox" style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '8'), $kursi)) {
														echo "disabled checked";
													} ?>>8
											</label>
											<div id="genderPopUp_7" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('7', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('7', 'Kadın')">Kadın</button>
											</div>
											<div id="genderPopUp_8" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('8', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('8', 'Kadın')">Kadın</button>
											</div>
										</td>
									</tr>
									<tr>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '9'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('9')">
												<input name='kursi[]' value='9' id='9' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '9'), $kursi)) {
														echo "disabled checked";
													} ?>>9
											</label>
											<div id="genderPopUp_9" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('9', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('9', 'Kadın')">Kadın</button>
											</div>
										</td>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '10'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('10')">
												<input name='kursi[]' value='10' id='10' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '10'), $kursi)) {
														echo "disabled checked";
													} ?>>10
											</label>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '11'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('11')">
												<input name='kursi[]' value='11' id='11' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '11'), $kursi)) {
														echo "disabled checked";
													} ?>>11
											</label>
											<div id="genderPopUp_10" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('10', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('10', 'Kadın')">Kadın</button>
											</div>
											<div id="genderPopUp_11" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('11', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('11', 'Kadın')">Kadın</button>
											</div>
										</td>
									</tr>
									<tr>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '12'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('12')">
												<input name='kursi[]' value='12' id='12' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '12'), $kursi)) {
														echo "disabled checked";
													} ?>>12
											</label>
											<div id="genderPopUp_12" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('12', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('12', 'Kadın')">Kadın</button>
											</div>
										</td>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '13'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('13')">
												<input name='kursi[]' value='13' id='13' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '13'), $kursi)) {
														echo "disabled checked";
													} ?>>13
											</label>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '14'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('14')">
												<input name='kursi[]' value='14' id='14' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '14'), $kursi)) {
														echo "disabled checked";
													} ?>>14
											</label>
											<div id="genderPopUp_13" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('13', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('13', 'Kadın')">Kadın</button>
											</div>
											<div id="genderPopUp_14" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('14', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('14', 'Kadın')">Kadın</button>
											</div>
										</td>
									</tr>
									<tr>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '15'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('15')">
												<input name='kursi[]' value='15' id='15' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '15'), $kursi)) {
														echo "disabled checked";
													} ?>>15
											</label>
											<div id="genderPopUp_15" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('15', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('15', 'Kadın')">Kadın</button>
											</div>
										</td>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '16'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('16')">
												<input name='kursi[]' value='16' id='16' autocomplete='off'
													type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '16'), $kursi)) {
														echo "disabled checked";
													} ?>>16
											</label>

											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '17'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('17')">
												<input name='kursi[]' value='17' id='17' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '17'), $kursi)) {
														echo "disabled checked";
													} ?>>17
											</label>

											<!-- Pop-up için genderPopUp_16 ve genderPopUp_17 oluşturuldu -->
											<div id="genderPopUp_16" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('16', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('16', 'Kadın')">Kadın</button>
											</div>

											<div id="genderPopUp_17" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('17', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('17', 'Kadın')">Kadın</button>
											</div>
										</td>
									</tr>
									<tr>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '18'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('18')">
												<input name='kursi[]' value='18' id='18' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '18'), $kursi)) {
														echo "disabled checked";
													} ?>>18
											</label>
											<div id="genderPopUp_18" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('18', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('18', 'Kadın')">Kadın</button>
											</div>
										</td>
										<td class=''>
											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '19'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('19')">
												<input name='kursi[]' value='19' id='19' autocomplete='off'
													type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '19'), $kursi)) {
														echo "disabled checked";
													} ?>>19
											</label>

											<label class="custom-checkbox <?php if (in_array(array('no_koltuk_siparis' => '20'), $kursi)) {
												echo "checked";
											} ?>" onclick="showGenderPopUp('20')">
												<input name='kursi[]' value='20' id='20' onclick='cer(this)'
													autocomplete='off' type='checkbox' style="display: none;" <?php if (in_array(array('no_koltuk_siparis' => '20'), $kursi)) {
														echo "disabled checked";
													} ?>>20
											</label>

											<!-- Pop-up için genderPopUp_19 ve genderPopUp_20 oluşturuldu -->
											<div id="genderPopUp_19" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('19', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('19', 'Kadın')">Kadın</button>
											</div>

											<div id="genderPopUp_20" class="pop-up">
												<button type="button" class="male"
													onclick="handleGenderSelection('20', 'Erkek')">Erkek</button>
												<button type="button" class="female"
													onclick="handleGenderSelection('20', 'Kadın')">Kadın</button>
											</div>
										</td>
									</tr>
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
	</style>
	<script>
		//function changeColor(colorBoxId) {
		//	var colorBox = document.getElementById(colorBoxId);
		//	colorBox.classList.toggle("clicked");
		//}
	</script>
	<!-- js -->
	<script type="text/javascript">
		jQuery(document).ready(function () {

			var checkboxes = $("input[type='checkbox']"),
				submitButt = $("input[type='submit']");

			checkboxes.click(function () {
				submitButt.attr("disabled", !checkboxes.is(":checked"));

			});
			checkboxes.each(function () {
				var checkbox = $(this);
				if (checkbox.is(":checked")) {
					checkbox.parent().css("background-color", "lightgreen");
				} else {
					checkbox.parent().css("background-color", "");
				}
			});
		})

		var selectedSeatsCount = 0;
		function cer(checkbox) {
			var checkboxParent = checkbox.parentNode;

			if (checkbox.checked) {
				if (selectedSeatsCount >= 4) {
					swal("En fazla 4 koltuk seçebilirsiniz!");
					checkbox.checked = false;
				} else {
					// Koltuk rengi kırmızı değilse işlemleri yap
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
				// Eğer koltuk seçili değilse, pop-up'ı görünür yap
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

			// Pop-up'ı gizle
			genderPopUp.style.display = 'none';
		}
	</script>
	<?php $this->load->view('frontend/include/base_js'); ?>
</body>

</html>