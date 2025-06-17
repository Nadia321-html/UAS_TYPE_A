<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            Sales Order 
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= form_open('transaksi/laporan', array('class' => 'form-inline')); ?>
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="text" name="tanggal1" class="form-control" placeholder="Tanggal Mulai">
                </div>
                <div class="form-group">
                    <label for="">-</label>
                    <input type="text" name="tanggal2" class="form-control" placeholder="Tanggal Selesai">
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tampilkan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Transaksi</th>
                                <th>Operator</th>
                                <th>Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            $total = 0;
                            foreach ($record->result() as $r) { ?>
                                <tr class="gradeU">
                                    <td>
                                        <?= $no ?>
                                    </td>
                                    <td>
                                        <?= $r->tanggal_transaksi ?>
                                    </td>
                                    <td>
                                        <?= $r->nama_lengkap ?>
                                    </td>
                                    <td>
                                        <?= $r->total ?>
                                    </td>
                                </tr>
                            <?php $total = $total + $r->total;
                                $no++;
                            } ?>

                            <tr class="gradeA">
                                <td colspan="3">T O T A L</td>
                                <td>Rp
                                    <?= number_format($total, 0, ',', '.') ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>