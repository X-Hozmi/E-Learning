        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="m-0 font-weight-bold text-primary" style="margin-top:-5px;">
                                Form Absensi Mahasiswa
                            </h3>
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
                            <?= form_open_multipart('dosen/simpanAbsen'); ?>
                            <input type="hidden" name="jurusan" value="<?= $_POST['jurusan'] ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Profil</th>
                                            <th>NPM</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        // $studos = $this->M_Dosen->sedo();
                                        $nama_jurusan = $_POST['jurusan'];
                                        $query = "SELECT * FROM mahasiswa a
                                                        JOIN jurusan b
                                                        ON a.jurusan = b.jurusan
                                                        WHERE a.jurusan = '$nama_jurusan'";
                                        // echo var_dump($nama_jurusan);
                                        $absensi = $this->db->query($query)->result_array();
                                        $i = 1;
                                        foreach ($absensi as $absn) :
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" class="img-fluid rounded-start" style="width:50px;height:50px;" alt="..."></td>
                                                <td><?= $absn['npm']; ?></td>
                                                <td><?= $absn['nama_mhs']; ?></td>
                                                <td>
                                                    <label class="radio-inline"><input type="radio" name="<?= 'ket' . $absn["npm"]; ?>" id="<?php echo 'opsi1' . $absn['npm']; ?>" value="Hadir">Hadir</label>
                                                    <label class="radio-inline"><input type="radio" name="<?= 'ket' . $absn["npm"]; ?>" id="<?php echo 'opsi1' . $absn['npm']; ?>" value="Absen">Absen</label>
                                                    <label class="radio-inline"><input type="radio" name="<?= 'ket' . $absn["npm"]; ?>" id="<?php echo 'opsi1' . $absn['npm']; ?>" value="Sakit">Sakit</label>
                                                    <label class="radio-inline"><input type="radio" name="<?= 'ket' . $absn["npm"]; ?>" id="<?php echo 'opsi1' . $absn['npm']; ?>" value="Izin">Izin</label>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 col-md-2 offset-10">Simpan
                                Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>

        <!-- End of Main Content -->