
<div class="container-fluid py-4" id="ngilang">
    <div style="width:95%; margin-left:2rem;">
        <?= $this->session->flashdata('alert', true) ?>
    </div>
</div>


<div class="card shadow-sm rounded-lg p-4" style="background-color: #ffffff;">
    <h4 class="card-title">Data Pegawai</h4>

    <div class="text-left py-3 mb-3">
        <button type="button" class="btn rounded-pill px-4" data-toggle="modal" data-target="#exampleModal"
            style="background-color: #5fa8d3; border: none; color: #fff;">
            <strong>Tambah Data Pegawai</strong>
        </button>
    </div>

    <div class="table-responsive">
        <table class="table mb-0 " style="background-color: #fff0f5; border-radius: 10px;">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <!-- <th>No Tlp</th> -->
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                    <th>Jenis Kelamin</th>
                    <th>Photo</th>
                    <th>Hak Akses</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($pegawai as $aa) : ?>
                <tr>
                    <td style="font-size: 14px;"><?= $no++ ?></td>
                    <td style="font-size: 14px;"><?= $aa['nik'] ?></td>
                    <td style="font-size: 14px;"><?= $aa['nama_pegawai'] ?></td>
                    <!-- <td style="font-size: 14px;"><?= $aa['no_tlp'] ?></td> -->
                    <td style="font-size: 14px;"><?= $aa['email'] ?></td>
                    <td style="font-size: 14px;"><?= $aa['jabatan'] ?></td>
                    <td style="font-size: 14px;"><?= $aa['tanggal_masuk'] ?></td>
                    <td style="font-size: 14px;"><?= $aa['status'] ?></td>
                    <td style="font-size: 14px;"><?= $aa['jenis_kelamin'] ?></td>
                    <td>
                        <a href="<?= base_url('assets/photo/') . $aa['photo'] ?>" target="_blank">
                            <span class="tf-icons bx bx-search"></span> Lihat Foto
                        </a>
                    </td>
                    <td style="font-size: 14px; text-align: center;">
                        <?= ($aa['hak_akses'] == '1') ? 'Admin' : 'Pegawai' ?>
                    </td>
                    <td>
                        <a href="javascript:void(0)" onclick="konfirmasiHapus('<?= site_url('admin/data_pegawai/delete_data/' . $aa['id_pegawai']); ?>')" class="btn btn-inverse-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </a>
                        <a href="<?= site_url('admin/data_pegawai/edit/' . $aa['id_pegawai']); ?>" class="btn btn-inverse-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Pegawai -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/data_pegawai/simpan') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_pegawai">Nama</label>
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Masukkan nama pegawai" required>
                    </div>
                    <div class="form-group">
                        <label for="no_tlp">No Tlp</label>
                        <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="Masukkan no tlp" required>
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select id="jabatan" name="jabatan" class="form-control" required>
                            <option value="">--Pilih Jabatan--</option>
                            <?php
                                $jabatanUnik = array_unique(array_column($pegawai, 'jabatan'));
                                foreach ($jabatanUnik as $jabatan) :
                            ?>
                                <option value="<?= $jabatan ?>"><?= $jabatan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="">Pilih Status</option>
                            <option value="tetap">Pegawai Tetap</option>
                            <option value="tdk_tetap">Pegawai Tidak Tetap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="hak_akses">Hak Akses</label>
                        <select name="hak_akses" class="form-control" id="hak_akses" required>
                            <option value="">Pilih Hak Akses</option>
                            <option value="1">Admin</option>
                            <option value="2">Pegawai</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Style tambahan -->
<style>
    .card {
        border-radius: 20px;
        background-color: white;
    }

    .btn-primary {
        background-color: #4b4bb7;
        border: none;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    table {
        white-space: nowrap; /* agar isi tabel tidak membungkus baris */
    }
</style>

<!-- Tambahkan ini sebelum penutup </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Script konfirmasi hapus -->
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
