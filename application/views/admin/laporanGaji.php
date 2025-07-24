<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Filter Laporan Gaji Pegawai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3f2fc;
      font-family: 'Segoe UI', sans-serif;
    }

    .filter-card {
      max-width: 500px;
      margin: 80px auto;
      background-color: #e6e4f9;
      border-radius: 18px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }

    .card-header {
      background-color: #c8bfff;
      color: #3d3569;
      font-weight: 600;
      font-size: 18px;
      text-align: center;
      padding: 16px;
    }

    .card-body {
      padding: 30px;
    }

    .form-label {
      font-size: 14px;
      font-weight: 600;
      color: #4e468e;
    }

    .form-control,
    select.form-select {
      border-radius: 10px;
      padding: 10px 14px;
      font-size: 14px;
      border: 1px solid #d4d1f0;
      background-color: #ffffff;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #b8a7f8;
      box-shadow: none;
    }

    .btn-purple {
      background-color: #b8a7f8;
      color: white;
      font-weight: 500;
      padding: 10px 24px;
      border-radius: 10px;
      border: none;
      margin-right: 6px;
    }

    .btn-purple:hover {
      background-color: #a997f2;
    }
  </style>
</head>
<body>

<div class="filter-card">
  <div class="card-header">
    Filter Laporan Gaji Pegawai
  </div>
  <div class="card-body pt-4">
    <form id="filterForm" method="GET">
      <div class="mb-3">
        <label for="bulan" class="form-label">Bulan</label>
        <select id="bulan" name="bulan" class="form-select" required>
          <option value="">--Pilih Bulan--</option>
          <option value="01">Januari</option>
          <option value="02">Februari</option>
          <option value="03">Maret</option>
          <option value="04">April</option>
          <option value="05">Mei</option>
          <option value="06">Juni</option>
          <option value="07">Juli</option>
          <option value="08">Agustus</option>
          <option value="09">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="tahun" class="form-label">Tahun</label>
        <select id="tahun" name="tahun" class="form-select" required>
          <option value="">--Pilih Tahun--</option>
          <?php
            $tahun = date('Y');
            for ($i = 2020; $i <= $tahun + 5; $i++) {
              echo "<option value=\"$i\">$i</option>";
            }
          ?>
        </select>
      </div>

      <div class="text-end mt-4">
        <!-- Tombol-tombol aksi -->
        <button type="submit" class="btn btn-purple" formaction="<?= base_url('admin/laporan_gaji/cetakLaporanGaji') ?>" formmethod="POST">
          Tampilkan
          </button>

        <a href="#" id="exportExcelBtn" class="btn btn-success">Export Excel</a>
        <a href="#" id="exportPdfBtn" class="btn btn-danger">Export PDF</a>

      </div>
    </form>
  </div>
</div>
<!-- Script untuk membuat tombol Export dinamis -->
<script>
  document.getElementById('exportExcelBtn').addEventListener('click', function(e) {
    e.preventDefault();
    const bulan = document.getElementById('bulan').value;
    const tahun = document.getElementById('tahun').value;

    if (bulan && tahun) {
      const url = `<?= base_url('admin/laporan_absensi/exportExcel') ?>?bulan=${bulan}&tahun=${tahun}`;
      window.open(url, '_blank');
    } else {
      alert('Silakan pilih bulan dan tahun terlebih dahulu.');
    }
  });

  document.getElementById('exportPdfBtn').addEventListener('click', function(e) {
    e.preventDefault();
    const bulan = document.getElementById('bulan').value;
    const tahun = document.getElementById('tahun').value;

    if (bulan && tahun) {
      const url = `<?= base_url('admin/laporan_absensi/exportPdf') ?>?bulan=${bulan}&tahun=${tahun}`;
      window.open(url, '_blank');
    } else {
      alert('Silakan pilih bulan dan tahun terlebih dahulu.');
    }
  });
</script>
</body>
</html>
