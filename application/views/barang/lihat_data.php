<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            Data Barang
        </h2>
    </div>
</div>
<!-- ROW -->
<div class="row">
    <div class="col-md-12">
        <?php
        $mag = $this->session->flashdata('teks');
        if ($mag == TRUE) {
            echo $mag;
        }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo anchor('barang/post', 'Tambah Data', array('class' => 'btn-danger btn-sm')) ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($record->result() as $r) { ?>
                                <tr class="gradeU">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $r->nama_barang ?></td>
                                    <td><?php echo $r->nama_kategori ?></td>
                                    <td>Rp. <?php echo number_format($r->harga, 2) ?></td>
                                    <td class="center">
                                        <?php echo anchor('barang/edit/' . $r->barang_id, '<button class="btn btn-primary">Edit</button>'); ?>
                                        <?php echo anchor('barang/delete/' . $r->barang_id, '<button class="btn btn-danger">Delete</button>', 'class="alert_notif"'); ?>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <!-- jangan lupa menambahkan script js sweet alert di bawah ini  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set di dalam session sukses  -->
    <?php
    $msg = $this->session->flashdata('teks');
    if ($msg == TRUE) { ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Data berhasil dihapus',
                timer: 3000,
                showConfirmButton: false
            })
        </script>
        <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php
        $updatealert = null;
        $this->session->set_flashdata($updatealert);
    } ?>
    <!-- di bawah ini adalah script untuk konfirmasi hapus data dengan sweet alert  -->
    <script>
        $('.alert_notif').on('click', function() {
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
                //jika klik ya maka arahkan ke delete
                if (result.isConfirmed) {
                    window.location.href = getLink
                }
            })
            return false;
        });
    </script>
</div>