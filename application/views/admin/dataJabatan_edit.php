<div class="card shadow-sm rounded-lg p-4" style="background-color: #fdfdfd;">
    <div class="card-body">
        <h4 class="card-title mb-4 text-primary font-weight-bold">Edit Data Jabatan</h4>
        <form action="<?= base_url('admin/data_jabatan/update') ?>" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="id_jabatan" value="<?= $jabatan->id_jabatan; ?>">

            <div class="form-group mb-3">
                <label for="nama_jabatan" class="font-weight-semibold">Nama Jabatan</label>
                <input type="text" class="form-control rounded-pill" id="nama_jabatan" name="nama_jabatan" value="<?= $jabatan->nama_jabatan; ?>" placeholder="Masukkan nama jabatan" required>
            </div>

            <div class="form-group mb-3">
                <label for="gaji_pokok" class="font-weight-semibold">Gaji Pokok</label>
                <input type="text" class="form-control rounded-pill" id="gaji_pokok" name="gaji_pokok" value="<?= $jabatan->gaji_pokok; ?>" placeholder="Masukkan gaji pokok" required>
            </div>

            <div class="form-group mb-3">
                <label for="tj_transport" class="font-weight-semibold">Tunjangan Transportasi</label>
                <input type="text" class="form-control rounded-pill" id="tj_transport" name="tj_transport" value="<?= $jabatan->tj_transport; ?>" placeholder="Masukkan tunjangan" required>
            </div>

            <div class="form-group mb-4">
                <label for="uang_makan" class="font-weight-semibold">Uang Makan</label>
                <input type="text" class="form-control rounded-pill" id="uang_makan" name="uang_makan" value="<?= $jabatan->uang_makan; ?>" placeholder="Masukkan uang makan" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success rounded-pill px-4">Simpan</button>
                <a href="<?= site_url('admin/data_jabatan'); ?>" class="btn btn-secondary rounded-pill px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
