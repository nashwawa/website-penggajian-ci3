
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>penggajian</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/skydash/')?>/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('assets/skydash/')?>/images/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<style>
  .card h3 {
  font-size: 28px;
  margin: 0;
}

.card h5 {
  font-size: 16px;
  font-weight: 500;
}

</style>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="">
          <img src="<?= base_url('images/bajy.png') ?>" class="mr-2" alt="logo" style="width: 150px; height: auto;"/>
        </a>
        <a class="navbar-brand brand-logo-mini" href="">
          <img src="<?= base_url('images/bajy_kecil.png') ?>" alt="logo" style="width: 150px; height: auto;"/>
        </a>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <span>
                    Selamat Datang 
                    <?= $this->session->userdata('nama_pegawai') ?? $this->session->userdata('nama_pegawai') ?? 'Pengguna' ?>
                </span>
                <?php 
                    $photo = $this->session->userdata('photo') ?? 'default.png'; 
                    $photo_path = base_url('assets/photo/' . $photo);
                ?>
                <img src="<?= $photo_path ?>" alt="profile" style="width: 40px; height: 40px; border-radius: 50%;">
            </a>

            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="<?php echo base_url('Profil') ?>" class="dropdown-item">
                <i class="ti-user text-primary"></i>
                Profile
              </a>
              <a href="<?php echo base_url('auth/logout') ?>" class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
         
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_settings-panel.html -->
  <div id="right-sidebar" class="settings-panel">
    <div class="tab-content" id="setting-content">
      <!-- To do section tab ends -->
      <!-- chat tab ends -->
    </div>
  </div>
  <!-- partial -->
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
  <?php if ($this->session->userdata('hak_akses') == '2') { ?>

    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('pegawai/Dashboard') ?>">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('pegawai/data_gaji') ?>">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Data Gaji</span>
      </a>
    </li>

  <?php } ?>

  <?php if ($this->session->userdata('hak_akses') == '1') { ?>

    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Dashboard') ?>">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Master Data</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/data_pegawai') ?>"> Data Pegawai</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/data_jabatan') ?>"> Data Jabatan</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Transaksi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/data_absensi') ?>">Data Absensi</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/potongan_gaji') ?>">Potongan Gaji</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/data_gaji') ?>">Data Gaji</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Laporan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/laporan_gaji') ?>">Laporan Gaji</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/laporan_absensi') ?>">Laporan Absensi</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('admin/slip_gaji') ?>">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Slip Gaji</span>
      </a>
    </li>

    <?php } ?>

    <!-- Menu untuk ADMIN dan PEGAWAI -->
    <?php if (in_array($this->session->userdata('hak_akses'), ['1', '2'])) { ?>

    

    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('admin/ubah_password') ?>">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Ubah Password</span>
      </a>
    </li>

    <?php } ?>

    <!-- Menu Logout untuk SEMUA -->
    <!-- <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('auth/logout') ?>">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Logout</span>
      </a>
    </li> -->

  </ul>
</nav>


  <!-- Footer -->

<footer class="footer fixed-bottom">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
      © <?= date('Y'); ?> <strong>PT. Bali Jaya</strong>. Sistem Penggajian Karyawan. Seluruh hak cipta dilindungi undang-undang.
    </span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
      Dibuat dengan <i class="ti-heart text-danger ml-1"></i> oleh Tim IT PT. Bali Jaya
    </span>
  </div>
</footer>

  <!-- ========================= MAIN CONTENT ========================= -->
  <div class="main-panel" style="width: 100%;">
    <div class="content-wrapper p-4">
    <h2><?= $contents; ?></h2>
  </div>
  <!-- ========================= END MAIN CONTENT ========================= -->

</div> <!-- page-body-wrapper -->

  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?= base_url('assets/skydash/')?>/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?= base_url('assets/skydash/')?>/vendors/chart.js/Chart.min.js"></script>
  <script src="<?= base_url('assets/skydash/')?>/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?= base_url('assets/skydash/')?>/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="<?= base_url('assets/skydash/')?>/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url('assets/skydash/')?>/js/off-canvas.js"></script>
  <script src="<?= base_url('assets/skydash/')?>/js/hoverable-collapse.js"></script>
  <script src="<?= base_url('assets/skydash/')?>/js/template.js"></script>
  <script src="<?= base_url('assets/skydash/')?>/js/settings.js"></script>
  <script src="<?= base_url('assets/skydash/')?>/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?= base_url('assets/skydash/')?>/js/dashboard.js"></script>
  <script src="<?= base_url('assets/skydash/')?>/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
  <script>
    $(document).ready(function() {
        // Flash alert delay
        $('#ngilang').delay(2000).slideUp(500, function() {
            $(this).alert('close');
        });
    });
</script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function konfirmasiHapus(url) {
        Swal.fire({
            title: 'Yakin hapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>




</body>

</html>