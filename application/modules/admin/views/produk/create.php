<div class="container-fluid ">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <?php echo form_open_multipart('admin/produk/store'); ?>
                <div class="form-group">
                    <label><strong>Nama Produk : </strong></label>
                    <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk ...." required>
                </div>
                <div class="form-group">
                    <label><strong>Kategori Produk : </strong></label>
                    <select class="form-control" name="id_kategori">
                        <option>-- Pilih Kategori Produk --</option>
                        <?php foreach ($kategori as $data) { ?>
                            <option value="<?= $data['id'] ?>"> <?= $data['nama'] ?></option>
                        <?php  } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><strong>Harga : </strong></label>
                    <input type="number" class="form-control" name="harga" placeholder="Harga Produk ..." required>
                </div>
                <div class="form-group">
                    <label><strong>Stock : </strong></label>
                    <input type="number" class="form-control" name="stock" placeholder="Stok Produk ..." maxlength="100" minlength="0" require>
                </div>
                <div class="form-group">
                    <label><strong>Foto Produk : </strong></label>
                    <input type="file" class="form-control-file" name="gambar">
                </div>
                <!-- button trigger -->
                <button type="submit" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Simpan</span>
                </button>
                <button onclick="window.history.go(-1); return false;" class="btn btn-dark btn-icon-split">
                    <span class="icon text-white-50">
                        X
                    </span>
                    <span class="text">Kembali</span>
                </button>
                <!-- end button trigger -->
                </form>
            </div>
        </div>
    </div>
</div>