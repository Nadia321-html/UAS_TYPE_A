<div class="row">
    <div class="cool-md-12">
        <h2 class="page-header">
            POS(Point Of Sale) <small>Tambahkan Data Barang</small>
        </h2>
    </div>
</div>
<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo form_open('barang/post'); ?>
                <div class="form-group">
                    <label>Nama barang</label>
                    <input class="form-control" name="nama_barang" class="form-control" placeholder="kategori">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control" placeholder="barang">
                        <?php foreach ($kategori as $k){
                            echo "<option value='$k->kategori_id'>$k->nama_kategori</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input class="form-control" name="harga" class="form-control" placeholder="harga">
                </div>

                <button type="submit" name="submit" class="btn btn-primary btn-am">Simpan</button>
                <?php echo anchor('barang', 'kembali', array('class' => 'btn-denger btn-sm')) ?>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <!-- Panel -->
</div>
<!-- RON -->