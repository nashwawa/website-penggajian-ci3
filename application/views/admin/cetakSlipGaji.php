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

<?php if (!empty($slip_gaji)): ?>
  <?php
    $alpha = $slip_gaji['alpha'];
    $gaji_pokok = $slip_gaji['gaji_pokok'];
    $tj_transport = $slip_gaji['tj_transport'];
    $uang_makan = $slip_gaji['uang_makan'];
    $potongan = 100000; 
    $jml_potongan = $alpha * $potongan;
    $total_gaji = $gaji_pokok + $tj_transport + $uang_makan - $jml_potongan;
  ?>


  <h1 class="center">PT. BALI JAYA</h1>
  <h2 class="center">Slip Gaji Pegawai</h2>

  <table>
    <tr>
      <td width="25%">Nama Pegawai</td>
      <td>: <?= htmlspecialchars($slip_gaji['nama_pegawai']) ?></td>
    </tr>
    <tr>
      <td>NIK</td>
      <td>: <?= htmlspecialchars($slip_gaji['nik']) ?></td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td>: <?= htmlspecialchars($slip_gaji['nama_jabatan']) ?></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td>: <?= date('d-m-Y') ?></td>
    </tr>
  </table>

  <br>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Gaji Pokok</td>
        <td><?= number_format($gaji_pokok, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td>2</td>
        <td>Tunjangan Transportasi</td>
        <td><?= number_format($tj_transport, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td>3</td>
        <td>Uang Makan</td>
        <td><?= number_format($uang_makan, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td>4</td>
        <td>Potongan</td>
        <td><?= number_format($jml_potongan, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td colspan="2" class="center"><strong>Total Gaji</strong></td>
        <td><strong><?= number_format($total_gaji, 0, ',', '.') ?></strong></td>
      </tr>
    </tbody>
  </table>

  <br><br><br>

  <table width="100%" class="no-border">
    <tr>
      <td width="50%">
        <p>Pegawai</p>
        <br><br>
        <p style="border-bottom: 1px solid #000; width: 80%;"><?= $slip_gaji['nama_pegawai'] ?></p>
      </td>
      <td width="50%" style="text-align: right;">
        <p>Karanganyar, <?= date("d M Y") ?><br>Finance</p>
        <br><br>
        <p style="border-bottom: 1px solid #000; width: 80%;"></p>
      </td>
    </tr>
  </table>

  <div class="terimakasih">** TERIMA KASIH **</div>

  <script>
    window.print();
  </script>

<?php else: ?>
  <h2 class="center" style="color:red;">Data slip gaji tidak ditemukan.</h2>
  <p class="center">Silakan periksa kembali nama pegawai atau periode gaji yang dipilih.</p>
<?php endif; ?>

</body>
</html>
