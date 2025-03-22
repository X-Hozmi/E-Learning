        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="<?= base_url('dosen/rekappdf'); ?>" class="btn btn-danger mb-4 btn-icon-split">
                                <span class="icon text-gray-100">
                                    <i class="fas fa-file"></i>
                                </span>
                                <span class="text">Export PDF</span>
                            </a>
                        </div>
                    </div>




                    <!-- tabel -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa </h6>
                        </div>
                        <!-- absensi_simpan.php?id=<?php //echo $_POST['jurusan']; 
                                                    ?> -->
                        <div class="card-body">
                            <!-- <form role="form" action="<?php //echo base_url('dosen/absenSimpan'); 
                                                            ?>" method="post"
                                name="postform" enctype="multipart/form-data"> -->
                            <!-- <?= form_open_multipart('dosen/simpanAbsen'); ?> -->
                            <input type="hidden" name="jurusan" value="<?= $_POST['jurusan'] ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Profil</th>
                                            <th>NPM</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                            <th>Jadwal</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        // $studos = $this->M_Dosen->sedo();
                                        $nama_jurusan = $_POST['jurusan'];
                                        $query = "SELECT * from absensi a
                                                    JOIN mahasiswa b
                                                    ON a.npm = b.npm
                                                    WHERE b.jurusan = '$nama_jurusan'";
                                        $absensi = $this->db->query($query)->result_array();
                                        $i = 1;
                                        foreach ($absensi as $absn) :
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" class="img-fluid rounded-start" style="width:50px;height:50px;" alt="..."></td>
                                                <td><?= $absn['npm']; ?></td>
                                                <td><?= $absn['nama_mhs']; ?></td>
                                                <td><a href="<?= base_url('dosen/editrekap?npm=' . $absn['npm'] . '&jurusan=' . $absn['jurusan']); ?>" class="btn btn-warning btn-icon-split btn-sm">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-edit"></i>
                                                        </span>
                                                        <span class="text">Ubah</span>
                                                    </a>
                                                </td>
                                                <td><?= $absn['jadwal']; ?></td>
                                            <?php
                                            $i++;
                                        endforeach;
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>

        <!-- End of Main Content -->