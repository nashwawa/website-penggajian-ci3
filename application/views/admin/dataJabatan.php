<div class="container-fluid py-4" id="ngilang">
    <div style="width:95%; margin-left:2rem;">
        <?= $this->session->flashdata('alert',true)?>
    </div>
</div>


<div class="card shadow-sm rounded-lg p-4" style="background-color: #ffffff;">
    <h4 class="card-title">Data Jabatan</h4>
    <div class="text-left py-3 mb-3">
        <button type="button" class="btn rounded-pill px-4" data-toggle="modal" data-target="#exampleModal"
            style="background-color: #5fa8d3; border: none; color: #fff;">
            <strong>Tambah Data Jabatan</strong>
        </button>
    </div>

    <div class="table-responsive">
        <table class="table mb-0" style="background-color: #fff0f5; border-radius: 10px;">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Tj.Transport</th>
                    <th>Uang makan</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($jabatan as $aa) { ?>
                    <tr>
                        <td style="font-size: 14px;"><?= $no; ?></td>
                        <td style="font-size: 14px;"><?= $aa['nama_jabatan'] ?></td>
                        <td style="font-size: 14px;">Rp. <?= number_format($aa['gaji_pokok'], 0, ',', '.'); ?></td>
                        <td style="font-size: 14px;">Rp. <?= number_format($aa['tj_transport'], 0, ',', '.'); ?></td>
                        <td style="font-size: 14px;">Rp. <?= number_format($aa['uang_makan'], 0, ',', '.'); ?></td>
                        <td style="font-size: 14px;">Rp. <?= number_format($aa['gaji_pokok'] + $aa['tj_transport'] + $aa['uang_makan'], 0, ',', '.'); ?></td>
                        <td> 
                            <a href="#" onclick="konfirmasiHapus('<?= site_url('admin/data_jabatan/delete_data/'.$aa['id_jabatan']); ?>')" class="btn btn-inverse-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </a>

                            <a href="<?= site_url('admin/data_jabatan/edit/' . $aa['id_jabatan']); ?>" class="btn btn-inverse-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>

                    </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal dipindahkan ke luar .card agar tampil sempurna -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="<?= base_url('admin/data_jabatan/simpan') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Masukkan nama jabatan" required>
                    </div>
                    <div class="form-group">
                        <label for="gaji_pokok">Gaji Pokok</label>
                        <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" placeholder="Masukkan gaji pokok" required>
                    </div>
                    <div class="form-group">
                        <label for="tj_transport">Tunjangan Transportasi</label>
                        <input type="text" class="form-control" id="tj_transport" name="tj_transport" placeholder="Masukkan Tj Transport" required>
                    </div>
                    <div class="form-group">
                        <label for="uang_makan">Uang Makan</label>
                        <input type="text" class="form-control" id="uang_makan" name="uang_makan" placeholder="Masukkan Uang Makan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 20px;
        background-color: white;
    }

    .btn-primary {
        background-color: #4b4bb7;
        border: none;
    }
</style>

<script>
    function konfirmasiHapus(url) {
        Swal.fire({
            title: 'Yakin hapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>





