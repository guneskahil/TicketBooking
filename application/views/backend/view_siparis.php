<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>
    <?= $title ?>
  </title>
  <!-- css -->
  <?php $this->load->view('backend/include/base_css'); ?>
</head>

<body id="page-top">
  <!-- navbar -->
  <?php $this->load->view('backend/include/base_nav'); ?>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <!-- Log on to codeastro.com for more projects -->
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rezervasyon Kodu [
          <?= $tiket[0]['kd_siparis']; ?>]
        </h6>
      </div>
      <div class="card-body">
        <form action="<?= base_url() . 'backend/siparis/inserttiket' ?>" method="post" enctype="multipart/form-data">

          <div class="card-body">
            <div class="row">
              <?php foreach ($tiket as $row) { ?>
                <input type="hidden" class="form-control" name="kd_musteri" value="<?= $row['kd_musteri'] ?>" readonly>
                <input type="hidden" class="form-control" name="kd_siparis" value="<?= $row['kd_siparis'] ?>" readonly>
                <input type="hidden" class="form-control" name="asal_beli" value="<?= $row['kalkis_siparis'] ?>" readonly>
                <input type="hidden" class="form-control" name="kd_bilet[]" value="<?= $row['kd_bilet'] ?>" readonly>
                <div class="col-sm-6">
                  <label>Bilet Kodu <b>
                      <?= $row['kd_bilet'] ?>
                    </b></label>
                  <p>Müşteri Adı <b>
                      <?= $row['isim_siparis']; ?>
                    </b></p>
                  <hr>
                  <div class="row form-group">
                    <label for="nama" class="col-sm-4 control-label">Sefer Kodu</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="kd_sefer" value="<?= $row['kd_sefer'] ?>" readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="nama" class="col-sm-4 control-label">Müşteri Adı</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="nama[]" value="<?= $row['isim_koltuk_siparis'] ?>"
                        readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">Koltuk No</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="no_kursi[]" value="<?= $row['no_koltuk_siparis'] ?>"
                        readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">Müşteri Yaş</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="umur_kursi[]>"
                        value="<?= $row['yas_koltuk_siparis'] ?> Years" readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">Bilet Fiyatı</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="harga" value="<?php echo $row['fiyat_sefer']; ?>"
                        readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">Ödeme</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="tgl_beli"
                        value="<?= hari_indo(date('N', strtotime($row['gecerlilik_siparis']))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $row['gecerlilik_siparis'] . ''))) . ', ' . date('H:i', strtotime($row['gecerlilik_siparis'])); ?>"
                        readonly>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <div class="col-sm-6">
                <div class="row form-group">
                  <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                        viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path
                          d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                      </svg>Ödeme Onayını Kontrol Edin!!!</h4>
                    <p>Burada müşterilerin ödeme onaylarını kontrol edebilirsiniz. Müşteriden gelen ödeme kanıtını
                      görmek için görüntüle düğmesine tıklamanız yeterlidir.</p>
                    <hr>
                    <p class="mb-0"> <a
                        href="<?= base_url('backend/onay/viewkonfirmasi/' . $tiket[0]['kd_siparis']) ?>"
                        class="btn btn-success">Görüntüle</a></p>
                  </div>

                </div>
              </div>
              <div class="col-sm-6">
                <div class="row form-group">
                  <label for="" class="col-sm-4 control-label">Durum</label>
                  <div class="col-sm-8">
                    <?php if ($tiket[0]['durum_siparis'] == '1') { ?>
                      <select class="form-control" name="status" required>
                        <option value='' selected disabled>Ödenmedi</option>
                        <option value='2'>Ödendi</option>
                        <option value='3'>Siparisi Sil</option>
                      </select>
                    <?php } elseif ($tiket[0]['durum_siparis'] == '2') { ?>
                      <p class="btn "><b class="btn btn-outline-success">Ödendi</b> </p>

                    <?php } else { ?>
                      <p class="btn"><b class="btn btn-outline-warning">İptal Edildi</b></p>
                    <?php } ?>

                  </div>
                </div>
                <div class="row form-group">
                  <label for="" class="col-sm-4 control-label">Toplam Ödeme</label>
                  <div class="col-sm-8">
                    <p><b>
                        <?php $total = count($tiket) * $tiket[0]['fiyat_sefer'];
                        echo number_format($total) ?> TL
                      </b></p>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <hr><a class="btn btn-danger float-left" href="<?= base_url() . 'backend/siparis' ?>"> Go Back</a>
            <?php if ($tiket[0]['durum_siparis'] == '1') { ?>
              <button type="submit" class="btn btn-success">Submit</button>
            <?php } else if ($tiket[0]['durum_siparis'] == '3') { ?>
                <p><b>Cancelled Ticket</b></p>
            <?php } else { ?>
                <a class="btn btn-primary float-right"
                  href="<?= base_url('assets/backend/upload/ebilet/' . $row['kd_siparis'] . '.pdf') ?>" target="_blank"> Print
                  E-Ticket</a>
                <!-- <a class="btn btn-primary float-right" href="<?= base_url('backend/siparis/kirimemail/' . $row['kd_siparis']) ?>"> Send E-Ticket</a> -->
            <?php } ?>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>
  <!-- End of Main Content -->
  <!-- Footer -->
  <?php $this->load->view('backend/include/base_footer'); ?>
  <!-- End of Footer -->
  </div>
  <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Log on to codeastro.com for more projects -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- js -->
  <?php $this->load->view('backend/include/base_js'); ?>
</body>

</html>