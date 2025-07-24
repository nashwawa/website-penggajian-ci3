

<div class="container-fluid py-4" id="ngilang">
    <div style="width:95%; margin-left:2rem;">
        <?= $this->session->flashdata('alert',true)?>
    </div>
</div>

<div class="card shadow-sm rounded-lg p-4" style="background-color: #ffffff;">
    <h4 class="card-title">Potongan Gaji</h4>
    <div class="text-left py-3 mb-3">
    <a class="btn btn-sm btn-success mb-3 mt-2 shadow-sm" data-toggle="modal" data-target="#exampleModal"
        href="<?php echo base_url('admin/potongan_gaji/tambah_data') ?>">
        <i class="fas fa-plus-circle"></i> 
        <span><strong>Tambah Data </strong></span>
</a>
    </div>

    <div class="table-responsive">
        <table class="table mb-0" style="background-color: #fff0f5; border-radius: 10px;">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Jenis Potongan</th>
                    <th>Jumlah Potongan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($pot_gaji as $aa) { ?>
                    <tr>
                        <td style="font-size: 14px;"><?= $no; ?></td>
                        <td style="font-size: 14px;"><?= $aa['potongan'] ?></td>
                        <td style="font-size: 14px;">Rp. <?= number_format($aa['jml_potongan'], 0, ',', '.'); ?></td>
                       
                        <td> 
                            <a onclick="konfirmasiHapus('<?= site_url('admin/potongan_gaji/delete_data/'.$aa['id_potongan']); ?>')" href="javascript:void(0)" class="btn btn-inverse-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </a>

                            <a href="<?= site_url('admin/potongan_gaji/edit/' . $aa['id_potongan']); ?>" class="btn btn-inverse-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>

                    </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Potongan Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="<?= base_url('admin/potongan_gaji/tambah_data') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="potongan">Potongan</label>
                        <input type="text" class="form-control" id="potongan" name="potongan" placeholder="Masukkan potongan" required>
                    </div>
                    <div class="form-group">
                        <label for="jml_potongan">Jumlah Potongan</label>
                        <input type="number" class="form-control" id="jml_potongan" name="jml_potongan" placeholder="Masukkan Jumlah Potongan" required>
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