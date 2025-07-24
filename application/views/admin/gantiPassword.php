<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ubah Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fce4ec;
      font-family: 'Segoe UI', sans-serif;
    }

    .password-card {
      max-width: 500px;
      margin: 80px auto;
      background-color: #fff0f5;
      border-radius: 18px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }

    .card-header {
      background-color: #f8bbd0;
      color: #6d2c41;
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
      color: #7b3e57;
    }

    .form-control {
      border-radius: 10px;
      padding: 10px 14px;
      font-size: 14px;
      border: 1px solid #f5c6d6;
      background-color: #ffffff;
    }

    .form-control:focus {
      border-color: #f48fb1;
      box-shadow: none;
    }

    .btn-pink {
      background-color: #f48fb1;
      color: white;
      font-weight: 500;
      padding: 10px 24px;
      border-radius: 10px;
      border: none;
    }

    .btn-pink:hover {
      background-color: #ec407a;
    }
  </style>
</head>
<body>

<div class="password-card">
  <div class="card-header">
    Form Ubah Password
  </div>
  <div class="card-body pt-4">
  

    <form action="<?= base_url('admin/Ubah_password/ubahPasswordAksi') ?>" method="POST">
      <!-- Hidden input untuk ID Pegawai -->
      <input type="hidden" name="id_pegawai" value="<?= $this->session->userdata('id_pegawai') ?>">

      <div class="mb-3">
        <label for="password_baru" class="form-label">Password Baru</label>
        <input type="password" class="form-control" id="password_baru" name="password_baru" required>
        <?php echo form_error('password_baru', '<div class="text-small text-danger mt-1">', '</div>')?>
      </div>

      <div class="mb-3">
        <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
        <?php echo form_error('konfirmasi_password', '<div class="text-small text-danger mt-1">', '</div>')?>
      </div>

      <div class="text-end mt-4">
        <button type="submit" class="btn btn-pink">Ubah Password</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
