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
					<form action="<?php echo base_url() ?>tiket/gettiket/" method="post">
						<input type="hidden" name="tgl" value="<?php echo $tglberangkat ?>">

						<?php $i = 1;
						foreach ($kursi as $row) { ?>
							<div class="card mb-5">
								<div class="card-header">
									<i class="fas fa-id-card"></i>
									<?php echo $row; ?> Numaralı Koltuk
								</div>
								<div class="card-body">
									<div class="form-group">
										<label for="CN">Yolcunun İsmi</label>
										<input type="text" id="" class="form-control" id="" name="nama[]">
										<input type="hidden" name="kursi[]" value="<?php echo $row ?>">
									</div>
									<div class="form-group">
										<select name="tahun[]" class="form-control js-example-basic-single" required>
											<option value="" selected disabled="">Yolcunun Yaşı</option>
											<?php
											$thn_skr = 90;
											for ($x = $thn_skr; $x >= 1; $x--) {
												?>
												<option value="<?php echo $x ?>">
													<?php echo $x ?>
												</option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="card mb-5">
							<?php foreach ($kursi as $index => $seat): ?>
								<div class='form-group'>
									<div class='col-sm-12'>
										<label for="cinsiyet_<?php echo $seat; ?>">Koltuk
											<?php echo $seat; ?> Cinsiyeti:
										</label>
										<select name='cinsiyet[]' id="cinsiyet_<?php echo $seat; ?>" class='form-control'
											required>
											<option value='' disabled>Cinsiyet Seçiniz</option>
											<option value='Erkek' <?php echo (isset ($selectedGenders[$seat]) && $selectedGenders[$seat] == 'Erkek') ? 'selected' : ''; ?>>Erkek</option>
											<option value='Kadin' <?php echo (isset ($selectedGenders[$seat]) && $selectedGenders[$seat] == 'Kadin') ? 'selected' : ''; ?>>Kadın</option>
										</select>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
				</div>
				<div class="col-sm-4">
					<?php
					foreach ($kursi as $index => $row) {
						// İlk geçişte selectedSeat'i güncelle
						if ($index === 0) {
							$selectedSeat = $row;
						}
						?>
						<div class="card mb-5">
							<div class="card-header">
								<i class="fas fa-user"></i> Yolcu Bilgileri
								<?php echo $row; ?>
							</div>
							<div class="card-body">
								<div class='form-group'>
									<div class='col-sm-12'>
										<input name='no_ktp' required="" maxlength='64' class='form-control required'
											placeholder='Kimlik Numarası' type='text' title='ID number must be filled.'
											value="<?php echo ($row == $selectedSeat) ? $this->session->userdata('ktp') : ''; ?>">
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-12'>
										<input name='nama_pemesan' required="" maxlength='64' class='form-control required'
											placeholder='Müşteri Numarası' type='text' title='Müşteri Numarası'
											value="<?php echo ($row == $selectedSeat) ? $this->session->userdata('nama_lengkap') : ''; ?>">
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-12'>
										<input name='hp' required="" maxlength='16' class='form-control required'
											placeholder='Handphone' type='text' title='Required Field'
											value="<?php echo ($row == $selectedSeat) ? $this->session->userdata('telpon') : ''; ?>">
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-12'>
										<textarea name='alamat' cols='20' rows='3' id='alamat' required="" maxlength='256'
											class='form-control required' placeholder='Address'
											title='Address Required.'><?php echo ($row == $selectedSeat) ? $this->session->userdata('alamat') : ''; ?></textarea>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-12'>
										<input name='email' required="" maxlength='64' class='form-control'
											placeholder='Email' type='text'
											value="<?php echo ($row == $selectedSeat) ? $this->session->userdata('email') : ''; ?>">
									</div>
								</div>



							</div>
							<!-- Diğer input alanları için aynı mantıkla devam edebilirsiniz -->
						</div>

					<?php } ?>
				</div>

				<div class="col">
					<div class="card">
						<div class="card-header">
							<i class="fas fa-dollar-sign"></i> Payment Method
						</div>
						<div class="card-body">
							<form action="<?php echo base_url() ?>tiket/cektiketmu" method="post">
								<div class="form-group">
									<label for="exampleInputEmail1">Select Bank </label>
									<select class="form-control" name="bank" required>
										<option value="" selected disabled="">Select Bank</option>
										<?php foreach ($bank as $row) { ?>
											<option value="<?php echo $row['kd_banka'] ?>">
												<?php echo $row['isim_banka']; ?>
											</option>
										<?php } ?>
									</select>
								</div>
								<hr>
								<div class='form-group'>
									<a href='javascript:history.back()' class='btn btn-default pull-left'>Go Back</a>
									<button class="btn btn-success pull-right">Process Ticket</button>
								</div>
							</form>
							<!-- Log on to codeastro.com for more projects -->
						</div>

					</div>
				</div>
			</div>
	</section>
	<!-- End banner Area -->
	<!-- End Generic Start -->
	<!-- start footer Area -->
	<?php $this->load->view('frontend/include/base_footer'); ?>
	<!-- js -->
	<?php $this->load->view('frontend/include/base_js'); ?>
	<script type="text/javascript">
		$(document).ready(function () {
			$('.js-example-basic-single').select2();
		});
	</script>
</body>

</html>