<!DOCTYPE html>
<html>
<head>
  <title>Profil Pegawai</title>
  <style>
    body {
    background-color: #fff6f9;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0; /* atau bisa padding: 20px 0; kalau kamu mau ada sedikit ruang vertikal */
    }

    .profile-card {
      max-width: 850px;
      background-color: #fff;
      border-radius: 20px;
      margin: auto;
      box-shadow: 0 10px 25px rgba(0,0,0,0.05);
      overflow: hidden;
    }
    .profile-header {
      background-color: #fddde6;
      padding: 30px;
      display: flex;
      align-items: center;
    }
    .photo-container {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      overflow: hidden;
      border: 4px solid #fff;
      background-color: #eee;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .photo-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .info-header {
      margin-left: 25px;
    }
    .info-header h2 {
      margin: 0;
      font-size: 24px;
      color: #333;
    }
    .info-header span {
      font-size: 15px;
      color: #666;
    }

    .profile-body {
      padding: 30px;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .section {
      width: 48%;
      margin-bottom: 20px;
    }

    .section h3 {
      margin-bottom: 8px;
      color: #e85d75;
      font-size: 18px;
    }

    .section p {
      margin: 5px 0;
      color: #444;
      font-size: 14px;
    }

    .section p span {
      font-weight: bold;
      color: #888;
    }

    .badge {
      display: inline-block;
      padding: 5px 14px;
      background-color: #ff6b81;
      color: white;
      font-size: 12px;
      border-radius: 20px;
      margin-top: 8px;
    }

    .contact-icon {
      margin-right: 6px;
      font-style: normal;
    }

    @media screen and (max-width: 768px) {
      .section {
        width: 100%;
      }
      .profile-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      .info-header {
        margin-left: 0;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

<?php
// fallback
$photo = !empty($pegawai->photo) ? $pegawai->photo : 'default.png';
?>

<div class="profile-card">
  <div class="profile-header">
    <!-- <div class="photo-container">
      <img src="<?= base_url('assets/uploads/' . $photo) ?>" alt="Photo">
    </div> -->
    <div class="photo-container">
      <img src="<?= base_url('assets/photo/' . ($pegawai->photo ?: 'default.png')) ?>" alt="Foto Pegawai">
    </div>
    <div class="info-header">
      <h2><?= $pegawai->nama_pegawai ?></h2>
      <span><?= ucfirst($pegawai->jabatan) ?></span><br>
      <span class="badge"><?= strtoupper($pegawai->status) ?></span>
    </div>
  </div>

  <div class="profile-body">
    <div class="section">
      <h3>Identitas</h3>
      <p><span>NIK:</span> <?= $pegawai->nik ?></p>
      <p><span>Jenis Kelamin:</span> <?= ucfirst($pegawai->jenis_kelamin) ?></p>
      <p><span>Tanggal Masuk:</span> <?= $pegawai->tanggal_masuk ?></p>
      <p><span>Username:</span> <?= $pegawai->username ?></p>
    </div>
    <div class="section">
      <h3>Kontak</h3>
      <p><span class="contact-icon">📧</span> <?= $pegawai->email ?? '-' ?></p>
      <p><span class="contact-icon">📱</span> <?= $pegawai->no_tlp ?? '-' ?></p>
    </div>
  </div>
</div>

</body>
</html>
