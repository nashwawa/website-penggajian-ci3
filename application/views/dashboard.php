<h2 class="fw-bold">Selamat Datang Di PT.Bali Jaya</h2>
<p>Halo, selamat datang di sistem penggajian Perusahaan Bali Jaya! Terima kasih telah menjadi bagian dari tim kami | <a href="#">Bali Jaya</a></p>

<!-- Statistik Cards -->
<div class="row mt-4">
  <div class="col-md-3 col-sm-6 mb-3">
    <a href="<?= site_url('admin/data_pegawai') ?>" style="text-decoration: none;">
      <div class="card h-100 shadow" style="background-color: #FFD6E8;">
        <div class="card-body text-center">
          <h5 class="card-title text-dark">Data Pegawai</h5>
          <h3 class="text-dark"><?php echo $pegawai ?></h3>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-3 col-sm-6 mb-3">
    <a href="<?= site_url('admin/data_pegawai') ?>" style="text-decoration: none;">
      <div class="card h-100 shadow" style="background-color: #D5F0FF;">
        <div class="card-body text-center">
          <h5 class="card-title text-dark">Data Admin</h5>
          <h3 class="text-dark"><?php echo $admin ?></h3>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-3 col-sm-6 mb-3">
    <a href="<?= site_url('admin/data_jabatan') ?>" style="text-decoration: none;">
      <div class="card h-100 shadow" style="background-color: #E5D9F2;">
        <div class="card-body text-center">
          <h5 class="card-title text-dark">Data Jabatan</h5>
          <h3 class="text-dark"><?php echo $jabatan ?></h3>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-3 col-sm-6 mb-3">
    <a href="<?= site_url('admin/data_absensi') ?>" style="text-decoration: none;">
      <div class="card h-100 shadow" style="background-color: #FFF3CD;">
        <div class="card-body text-center">
          <h5 class="card-title text-dark">Data Kehadiran</h5>
          <h3 class="text-dark"><?php echo $kehadiran ?></h3>
        </div>
      </div>
    </a>
  </div>
</div>

<!-- Footer -->



