<div class="card shadow-sm rounded-lg p-4" style="background-color: #fdfdfd;">
    <div class="card-body">
        <h4 class="card-title mb-4 text-primary font-weight-bold">Edit Data Pegawai</h4>
        <form action="<?= base_url('admin/data_pegawai/update') ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <input type="hidden" name="id_pegawai" value="<?= $pegawai->id_pegawai; ?>">

            <div class="form-group mb-3">
                <label for="nik" class="font-weight-semibold">NIK</label>
                <input type="text" class="form-control rounded-pill" id="nik" name="nik" value="<?= $pegawai->nik; ?>" placeholder="Masukkan NIK" required>
            </div>

            <div class="form-group mb-3">
                <label for="nama_pegawai" class="font-weight-semibold">Nama</label>
                <input type="text" class="form-control rounded-pill" id="nama_pegawai" name="nama_pegawai" value="<?= $pegawai->nama_pegawai; ?>" placeholder="Masukkan Nama" required>
            </div>

            <div class="form-group mb-3">
                <label for="no_tlp" class="font-weight-semibold">No Tlp</label>
                <input type="text" class="form-control rounded-pill" id="no_tlp" name="no_tlp" value="<?= $pegawai->no_tlp; ?>" placeholder="Masukkan No Tlp" required>
            </div>
            <div class="form-group mb-3">
                <label for="email" class="font-weight-semibold">Email</label>
                <input type="text" class="form-control rounded-pill" id="email" name="email" value="<?= $pegawai->email; ?>" placeholder="Masukkan Email" required>
            </div>

            <div class="form-group mb-3">
                <label for="username" class="font-weight-semibold">Username</label>
                <input type="text" class="form-control rounded-pill" id="username" name="username" value="<?= $pegawai->username; ?>" placeholder="Masukkan Username" required>
            </div>

            <div class="form-group mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select id="jabatan" name="jabatan" class="form-select" required>
                    <option value="">--Pilih Jabatan--</option>
                    <?php foreach($jabatan as $j) : ?>
                        <option value="<?= $j->nama_jabatan; ?>" <?= ($pegawai->jabatan == $j->nama_jabatan) ? 'selected' : '' ?>>
                            <?= $j->nama_jabatan; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="tanggal_masuk" class="font-weight-semibold">Tanggal Masuk</label>
                <input type="date" class="form-control rounded-pill" id="tanggal_masuk" name="tanggal_masuk" value="<?= $pegawai->tanggal_masuk; ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="status" class="font-weight-semibold">Status</label>
                <input type="text" class="form-control rounded-pill" id="status" name="status" value="<?= $pegawai->status; ?>" placeholder="Masukkan Status" required>
            </div>

            <div class="form-group mb-3">
                <label for="photo" class="font-weight-semibold">Foto Pegawai</label><br>
                <?php if (!empty($pegawai->photo)): ?>
                    <img src="<?= base_url('assets/photo/' . $pegawai->photo) ?>" width="100" class="mb-2 rounded">
                <?php endif; ?>
                <input type="file" class="form-control rounded-pill mt-2" id="photo" name="photo" accept="image/png, image/jpg, image/jpeg">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
            </div>

            <div class="form-group mb-3">
                <label for="jenis_kelamin" class="font-weight-semibold">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control rounded-pill" required>
                    <option value="Laki-laki" <?= $pegawai->jenis_kelamin == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="hak_akses" class="font-weight-semibold">Hak Akses</label>
                <select name="hak_akses" class="form-control rounded-pill" id="hak_akses" required>
                    <option value="1" <?= $pegawai->hak_akses == '1' ? 'selected' : '' ?>>Admin</option>
                    <option value="2" <?= $pegawai->hak_akses == '2' ? 'selected' : '' ?>>Pegawai</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success rounded-pill px-4">Simpan</button>
                <a href="<?= site_url('admin/data_pegawai'); ?>" class="btn btn-secondary rounded-pill px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
