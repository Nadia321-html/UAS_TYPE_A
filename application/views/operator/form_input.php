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
                <?php echo form_open('kategori/post'); ?>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="kategori">
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-am">Simpan</button>
                <?php echo anchor('kategori', 'kembali', array('class' => 'btn-denger btn-sm')) ?>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <!-- Panel -->
</div>
<!-- RON -->