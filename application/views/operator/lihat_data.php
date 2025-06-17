<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            Data Operator
        </h2>
    </div>
</div>
<!-- ROW -->
<div class="row">
    <div class="col-md-12">
        <?php
        $msg = $this->session->flashdata('teks');
        if ($msg) {
            echo $msg;
        }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo anchor('operator/post', 'Tambah Data', array('class' => 'btn btn-danger btn-sm')) ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Last Login</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($record->result() as $r) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $r->nama_lengkap ?></td>
                                    <td><?= $r->username ?></td>
                                    <td><?= $r->last_login ?></td>
                                    <td class="center">
                                        <?= anchor('operator/edit/' . $r->operator_id, '<button class="btn btn-primary btn-sm">Edit</button>') ?>
                                        <?= anchor('operator/delete/' . $r->operator_id, '<button class="btn btn-danger btn-sm">Delete</button>', 'class="alert_notif"') ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

    <!-- SweetAlert for Success -->
    <?php if ($msg) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '<?= $msg ?>',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

    <!-- SweetAlert for Delete Confirmation -->
    <script>
        $('.alert_notif').on('click', function(e) {
            e.preventDefault();
            var getLink = $(this).attr('href');
            Swal.fire({
                title: "Yakin hapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = getLink;
                }
            });
        });
    </script>
</div>
