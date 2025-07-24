<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Penggajian</title>

  <!-- Vendor CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/skydash/')?>css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="<?= base_url('assets/skydash/')?>images/bajy.png">

  <!-- Custom styling -->
  <style>
    body {
      background-color: #ffffff;
    }

    .auth-form-light {
      background-color: #ffffff !important;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .btn-primary {
      background-color: #80cbc4 !important;
      border: none;
    }

    .btn-primary:hover {
      background-color: #4db6ac !important;
    }

    .custom-alert {
      background-color: #e0f7f1;
      color: #00695c;
      border-left: 5px solid #4db6ac;
      padding: 15px 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 14px;
      position: relative;
    }

    .custom-alert strong {
      display: block;
      font-weight: 600;
      margin-bottom: 4px;
    }

    .custom-alert .close-alert {
      position: absolute;
      top: 10px;
      right: 15px;
      color: #00695c;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">

              <a class="navbar-brand brand-logo mr-5" href="#">
                <img src="<?= base_url('images/bajy_br.png') ?>" alt="logo" style="width: 150px;">
              </a>

              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>

              <!-- Flashdata Notifikasi -->
              <?php if ($this->session->flashdata('alert')): ?>
                <div class="custom-alert">
                  <strong>Informasi:</strong> <?= $this->session->flashdata('alert'); ?>
                  <span class="close-alert">&times;</span>
                </div>
              <?php endif; ?>

              <form method="post" action="<?= base_url('auth/login') ?>" class="pt-3">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input id="username" type="text" class="form-control" name="username" required autofocus>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Sign in
                  </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Vendor JS -->
  <script src="<?= base_url('assets/skydash/')?>vendors/js/vendor.bundle.base.js"></script>
  <script src="<?= base_url('assets/skydash/')?>js/off-canvas.js"></script>
  <script src="<?= base_url('assets/skydash/')?>js/template.js"></script>
  <script src="<?= base_url('assets/skydash/')?>js/settings.js"></script>
  <script src="<?= base_url('assets/skydash/')?>js/todolist.js"></script>

  <!-- JS close alert -->
  <script>
    document.querySelectorAll('.close-alert').forEach(button => {
      button.addEventListener('click', function () {
        this.parentElement.style.display = 'none';
      });
    });
  </script>
</body>
</html>
