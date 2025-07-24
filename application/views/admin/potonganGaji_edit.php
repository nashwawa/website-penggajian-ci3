<div class="card-body">
    <h4 class="card-title">Edit Data Potongan Gaji</h4>
    <form
        class="forms-sample"
        action="<?= base_url('admin/potongan_gaji/update') ?>"
        method="post">
        <input type="hidden" name="id_potongan" value="<?= $pot_gaji->id_potongan; ?>">
        <div class="form-group">
            <label for="potongan">Potongan</label>
            <input
                type="text"
                class="form-control"
                id="potongan"
                name="potongan"
                value="<?= $pot_gaji->potongan; ?>" 
                placeholder="Masukkan nama jabatan"></div>
        <div class="form-group">
            <label for="jml_potongan">Jumlah Potongan</label>
            <input
                type="text"
                class="form-control"
                id="jml_potongan"
                name="jml_potongan"
                value="<?= $pot_gaji->jml_potongan; ?>" 
                placeholder="Masukkan gaji pokok"></div>

        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="<?= site_url('admin/potongan_gaji'); ?>" class="btn btn-light">
             Cancel
        </a>
    </form>
</div>