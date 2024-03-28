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
    <h1 class="h5 text-gray-800">Otobüsler</h1>
    <!-- DataTales Example -->
    <!-- Log on to codeastro.com for more projects -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#ModalTujuan">
          Otobüs Ekle
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Otobüs Kodu</th>
                <th>Otobüs Adı</th>
                <th>Otobüs Plaka</th>
                <th>Koltuk Kapasitesi</th>
                <th>Durum</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($bus as $row) { ?>
                <tr>
                  <td>
                    <?= $i++; ?>
                  </td>
                  <td>
                    <?= strtoupper($row['kd_otobus']); ?>
                  </td>
                  <td>
                    <?= strtoupper($row['isim_otobus']); ?>
                  </td>
                  <td>
                    <?= strtoupper($row['plaka_otobus']); ?>
                  </td>
                  <td>
                    <?= $row['kapasite_otobus'] ?>
                  </td>
                  <?php if ($row['durum_otobus'] == '1') { ?>
                    <td class="btn-success"> Aktif</td>
                  <?php } else { ?>
                    <td class="btn-danger">Pasif</td>
                  <?php } ?>
                  <td align="center"><a href="<?= base_url('backend/otobus/viewbus/' . $row['kd_otobus']) ?>"
                      class="btn btn btn-info">Görüntüle</a></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.container-fluid -->
  </div>
  <!-- End of Main Content -->
  <!-- Footer --><!-- Log on to codeastro.com for more projects -->
  <?php $this->load->view('backend/include/base_footer'); ?>
  <!-- End of Footer -->
  <!-- Modal -->
  <div class="modal fade" id="ModalTujuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Otobüs Ekle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url() ?>backend/otobus/tambahbus" method="post">
            <div class="form-group">
              <label for="platbus" class="">Otobus Adı</label>
              <input type="text" class="form-control" name="isim_otobus" placeholder="">
            </div>
            <div class="form-group">
              <label for="platbus" class="">Otobus Plaka No</label>
              <input type="text" class="form-control" name="plaka_otobus" placeholder="">
            </div>
            <div class="form-group">
              <label for="seat" class="">Koltuk Sayısı</label>
              <input type="number" class="form-control" id="seat" name="seat" placeholder="[Max 23]">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
              <button class="btn btn-success">Kaydet</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- js -->
  <?php $this->load->view('backend/include/base_js'); ?>
</body>

</html>