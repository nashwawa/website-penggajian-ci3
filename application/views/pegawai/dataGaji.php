<div class="card shadow-sm rounded-lg p-4" style="background-color: #ffffff;">
    <h4 class="card-title">Data Gaji</h4>
    <?php if(count($gaji) > 0) { ?>
    <div class="table-responsive">
        <table class="table mb-0" style="background-color: #fff0f5; border-radius: 10px;">
            <thead class="thead-light">
                <tr>
                    <th>Bulan/Tahun</th>
                    <th>Gaji Pokok</th>
                    <th>Tj. Transportasi</th>
                    <th>Uang Makan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    <th>Cetak Slip</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gaji as $aa): 
                    $alpha = $aa->alpha;
                    $gaji_pokok = $aa->gaji_pokok;
                    $tj_transport = $aa->tj_transport;
                    $uang_makan = $aa->uang_makan;
                    $jml_potongan = $alpha * $potongan;
                    $total_gaji = $gaji_pokok + $tj_transport + $uang_makan - $jml_potongan;
                ?>
                    <tr>
                        <td><?= $aa->bulan ?>/<?= $tahun ?></td>
                        <td><?= number_format($gaji_pokok, 0, ',', '.') ?></td>
                        <td><?= number_format($tj_transport, 0, ',', '.') ?></td>
                        <td><?= number_format($uang_makan, 0, ',', '.') ?></td>
                        <td><?= number_format($jml_potongan, 0, ',', '.') ?></td>
                        <td><?= number_format($total_gaji, 0, ',', '.') ?></td>
                        <td>
                            <a href="<?= site_url('pegawai/data_gaji/cetak_gaji?bulan='.$aa->bulan.'&tahun='.$tahun) ?>" class="btn btn-primary btn-sm" target="_blank">
                                <i class="fas fa-print"></i> Cetak Slip
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php } else { ?>
        <div class="alert alert-warning">Data gaji belum tersedia.</div>
    <?php } ?>
</div>
