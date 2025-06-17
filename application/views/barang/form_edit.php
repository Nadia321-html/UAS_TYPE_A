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
                <?php echo form_open('barang/edit'); ?>
                <input type="hidden" name="id" value="<?php echo $record['barang_id'] ?>">
                <div class="form-group">
                    <label for="nama_barang">Nama barang</label>
                    <input type="text" name="nama_barang" class="form-control" placeholder="kategori"
                        value="<?php echo $record['nama_barang'] ?>">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" class="form-control">
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k->kategori_id ?>" <?=$record['kategori_id']== $k->kategori_id?'selected':'' ?>>
                                <?= $k->nama_kategori ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input class="form-control" name="harga" value="<?php echo $record['barang_id'] ?>">
                </div>

                <button type="submit" name="submit" class="btn btn-primary btn-am">Update</button>
                <?php echo anchor('barang', 'kembali', array('class' => 'btn-denger btn-sm')) ?>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <!-- Panel -->
</div>
<!-- RON -->