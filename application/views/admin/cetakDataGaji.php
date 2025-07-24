<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Gaji Pegawai</title>
  <style>
    body {
      font-family: 'Courier New', Courier, monospace;
      font-size: 13px;
      color: #000;
      margin: 40px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 8px;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 5px;
      font-size: 14px;
    }

    .center {
      text-align: center;
    }

    .terimakasih {
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
    }

    @media print {
      .page-break {
        page-break-after: always;
      }
    }
  </style>
</head>
<body>

<?php
  if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
  } else {
    $bulan = date('m');
    $tahun = date('Y');
  }
?>

<h1 class="center">PT. BALI JAYA</h1>
<h2 class="center">Daftar Gaji Pegawai</h2>

<table>
  <tr>
    <td width="25%">Tanggal</td>
    <td>: <?= date('d-m-Y') ?></td>
  </tr>
  <tr>
    <td>Periode Gaji</td>
    <td>: <?= $bulan ?>/<?= $tahun ?></td>
  </tr>
</table>

<br>

<table>
  <thead>
    <tr>
      <th>No</th>
      <th>NIK</th>
      <th>Nama Pegawai</th>
      <th>Jenis Kelamin</th>
      <th>Jabatan</th>
      <th>TJ. Transport</th>
      <th>Gaji Pokok</th>
      <th>Uang Makan</th>
      <th>Potongan</th>
      <th>Total Gaji</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($cetak_gaji as $aa) {
      $alpha = $aa['alpha'];
      $gaji_pokok = $aa['gaji_pokok'];
      $tj_transport = $aa['tj_transport'];
      $uang_makan = $aa['uang_makan'];
      $jml_potongan = $alpha * $potongan;
      $total_gaji = $gaji_pokok + $tj_transport + $uang_makan - $jml_potongan;
    ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $aa['nik'] ?></td>
        <td><?= $aa['nama_pegawai'] ?></td>
        <td><?= $aa['jenis_kelamin'] ?></td>
        <td><?= $aa['nama_jabatan'] ?></td>
        <td><?= number_format($tj_transport, 0, ',', '.') ?></td>
        <td><?= number_format($gaji_pokok, 0, ',', '.') ?></td>
        <td><?= number_format($uang_makan, 0, ',', '.') ?></td>
        <td><?= number_format($jml_potongan, 0, ',', '.') ?></td>
        <td><?= number_format($total_gaji, 0, ',', '.') ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<br><br><br>

<table width="100%" class="no-border">
  <tr>
    <td></td>
    <td width="200px">
      <p>Karanganyar, <?= date("d M Y") ?><br>Finance</p>
      <br><br>
      <p style="border-bottom: 1px solid #000; width: 100%;"></p>
    </td>
  </tr>
</table>


<div class="terimakasih">** TERIMA KASIH **</div>

<script>
  window.print();
</script>

</body>
</html>
