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
  <link rel="stylesheet"
    href="<?= base_url('assets/frontend/timepicker') ?>/css/bootstrap-material-datetimepicker.css" />
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
        <h6 class="m-0 font-weight-bold text-primary">Sefer Ekle</h6>
      </div>
      <div class="card-body">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <form action="<?= base_url() ?>backend/sefer/tambahjadwal" method="post">
                <div class="form-group">
                  <label class="">Kalkış</label>
                  <select class="form-control" name="asal" required>
                    <option value="" selected disabled="">-Seç-</option>
                    <?php foreach ($tujuan as $row) { ?>
                      <option value="<?= $row['kd_varis'] ?>">
                        <?= strtoupper($row['sehir_varis']) . " - " . $row['terminal_varis']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="">Varış</label>
                  <select class="form-control" name="tujuan" required>
                    <option value="" selected disabled="">-Seç-</option>
                    <?php foreach ($tujuan as $row) { ?>
                      <option value="<?= $row['kd_varis'] ?>">
                        <?= strtoupper($row['sehir_varis']) . " - " . $row['terminal_varis']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="">Otobüs</label>
                  <select class="form-control" name="bus">
                    <option value="" selected disabled="">-Seç-</option>
                    <?php foreach ($bus as $row) { ?>
                      <option value="<?= $row['kd_otobus'] ?>">
                        <?= strtoupper($row['isim_otobus']); ?> -
                        <?php if ($row['durum_otobus'] == '1') { ?>
                          Aktif
                        <?php } else { ?>
                          Pasif
                        <?php } ?>-
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="">Kalkış Saati</label>
                  <input type="text" class="form-control" id="time" name="berangkat" required="" placeholder="">
                </div>
                <div class="form-group">
                  <label class="">Varış Saati</label>
                  <input type="text" class="form-control" id="time2" name="tiba" required="" placeholder="">
                </div>
                <div class="form-group">
                  <label class="">Sefer Fiyatı</label>
                  <input type="number" class="form-control" name="harga" required="" placeholder="">
                  <?= form_error('name'), '<small class="text-danger pl-3">', '</small>'; ?>
                </div>
            </div>
          </div>
          <hr>
          <a class="btn btn-danger" href="javascript:history.back()"> Geri Dön</a>
          <input type="submit" class="btn btn-success pull-rigth" value="Ekle">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Main Content -->
  <!-- The Modal -->
  <!-- Log on to codeastro.com for more projects -->
  <!-- Footer -->
  <?php $this->load->view('backend/include/base_footer'); ?>
  <!-- End of Footer -->
  <!-- js -->
  <?php $this->load->view('backend/include/base_js'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
  <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
  <script type="text/javascript"
    src="<?= base_url('assets/frontend/timepicker') ?>/js/bootstrap-material-datetimepicker.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#time').bootstrapMaterialDatePicker
        ({
          date: false,
          shortTime: false,
          format: 'HH:mm'
        });
    })
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#time2').bootstrapMaterialDatePicker
        ({
          date: false,
          shortTime: false,
          format: 'HH:mm'
        });
    })
  </script>

</body>

</html>