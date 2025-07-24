<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Absensi Karyawan</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      font-size: 13px;
      background-color: #fef6f9; /* pastel pink background */
      color: #333;
      margin: 0;
      padding: 0;
    }

    .filter-box {
      background-color: #f3e8ff; /* pastel ungu muda */
      border-left: 6px solid #c084fc;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 16px;
    }

    .filter-box h3 {
      color: #6b21a8;
      font-size: 15px;
      margin-bottom: 12px;
    }

    .form-group {
      display: inline-block;
      margin-right: 12px;
      margin-bottom: 8px;
    }

    select {
      padding: 6px;
      border-radius: 8px;
      border: 1px solid #ccc;
      background-color: #fff;
      font-size: 13px;
    }

    .btn {
      padding: 6px 14px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-size: 13px;
      margin-top: 5px;
    }

    .btn-blue {
      background-color: #d8b4fe;
      color: #4c1d95;
    }

    .btn-green {
      background-color: #fcd5ce;
      color: #78350f;
    }

    .info-box {
      background-color: #e0f2fe;
      color: #0369a1;
      padding: 10px;
      border-left: 4px solid #38bdf8;
      border-radius: 8px;
      margin-bottom: 16px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #fde2e4;
      color: #7c2d12;
    }

    tr:nth-child(even) {
      background-color: #fdf2f8;
    }

    tr:nth-child(odd) {
      background-color: #fff7fc;
    }

    tr:hover {
      background-color: #fce7f3;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 6px;
    }

    .btn-edit {
      background-color: #fef3c7;
      color: #92400e;
    }

    .btn-delete {
      background-color: #fbcfe8;
      color: #9d174d;
    }
  </style>
</head>
<body>
<form method="POST" action="">
  <div class="filter-box">
    <h3 style="font-size: 14px; ">Input Absensi Pegawai</h3>
    <div class="form-group">
      <label for="bulan">Bulan:</label>
      <select id="bulan" name="bulan">
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

    <div class="form-group">
        <label for="tahun">Tahun:</label>
        <select id="tahun" name="tahun">
            <option value="">--Pilih Tahun--</option>
            <?php $tahun = date('Y'); 
            for($i=2020;$i<$tahun+6;$i++) {?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mr-2 ml-auto" style="font-size: 12px; padding: 12px 20px;">Generate</button>
    
  </div>
  <?php
    if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan.$tahun;

    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan.$tahun;
    }
  
  ?>              
  <div class="info-box" style="font-size: 14px; ">
    Menampilkan Data Kehadiran Karyawan Bulan : <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun : <span class="font-weight-bold"><?php echo $tahun ?></span>
  </div>

  <form method="post" action="<?= base_url('admin/data_absensi/input_absensi') ?>">
  <button type="submit" class="btn btn-success btn-fw mb-3" style="font-size: 12px; padding: 12px 20px;" name="submit" value="submit">Simpan</button>
  <table>
  <table>
    <thead>
      <tr>
        <th style="font-size: 14px; ">No Rekap</th>
        <th style="font-size: 14px; ">NIK</th>
        <th style="font-size: 14px; ">Nama Karyawan</th>
        <th style="font-size: 14px; ">Jenis Kelamin</th>
        <th style="font-size: 14px; ">Jabatan</th>
        <th style="font-size: 14px; " width= "10%">Hadir</th>
        <th style="font-size: 14px; " width= "10%">Sakit</th>
        <th style="font-size: 14px; " width= "10%">Alpha</th>
      
      </tr>
    </thead>
    <tbody>
    <?php $no = 1; foreach ($input_absensi as $aa) { ?>
        <tr>
            <input type="hidden" name="bulan[]" value="<?php echo $bulantahun ?>">
            <input type="hidden" name="nik[]" class="form-control" value="<?= $aa['nik'] ?>">
            <input type="hidden" name="nama_pegawai[]" class="form-control" value="<?= $aa['nama_pegawai'] ?>">
            <input type="hidden" name="jenis_kelamin[]" class="form-control" value="<?= $aa['jenis_kelamin'] ?>">
            <input type="hidden" name="nama_jabatan[]" class="form-control" value="<?= $aa['nama_jabatan'] ?>">
        

            <td style="font-size: 14px;"><?= $no; ?></td>
            <td style="font-size: 14px;"><?= $aa['nik'] ?></td>
            <td style="font-size: 14px;"><?= $aa['nama_pegawai'] ?></td>
            <td style="font-size: 14px;"><?= $aa['jenis_kelamin'] ?></td>
            <td style="font-size: 14px;"><?= $aa['nama_jabatan'] ?></td>
            <td style="font-size: 14px;"><input type="number" name="hadir[]" class="form-control" value="0"></td>
            <td style="font-size: 14px;"><input type="number" name="sakit[]" class="form-control" value="0"></td>
            <td style="font-size: 14px;"><input type="number" name="alpha[]" class="form-control" value="0"></td>
 
               

        </tr>
    <?php $no++; } ?>
     
    </tbody>
  </table>
</form>

</body>
</html>
