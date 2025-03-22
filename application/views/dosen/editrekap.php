        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

            <div class="col-lg-2">
                <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
                <?php endif; ?>
                <?= $this->session->flashdata('message'); ?>
            </div>

            <form role="form" action="<?= base_url('dosen/simpanRekap?npm=' . $npm . '&jurusan=' . $jurusan) ?>"
                method="post" name="postform" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Mahasiswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>NPM</th>
                                            <th>Nama</th>
                                            <th>Jurusan</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $query = "SELECT * FROM absensi a
                                                        JOIN mahasiswa b
                                                        ON a.npm = b.npm
                                                        WHERE a.npm = '$npm'";
                                        $datamhs = $this->db->query($query)->row_array();
                                        ?>
                                        <th><?= $datamhs['npm']; ?></th>
                                        <th><?= $datamhs['nama_mhs']; ?></th>
                                        <th><?= $datamhs['jurusan']; ?></th>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Absensi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">

                                        <tr>
                                            <td><?= $datamhs['jadwal']; ?></td>
                                            <td>
                                                <label class="radio-inline"><input type="radio"
                                                        name="<?= 'ket' . $datamhs['id_absen']; ?>"
                                                        id="<?= 'opsi1' . $datamhs['id_absen']; ?>" <?php if ($datamhs['keterangan'] == "Hadir") {
                                                        echo "checked";
                                                    } ?> value="Hadir">Hadir</label>
                                                <label class="radio-inline"><input type="radio"
                                                        name="<?= 'ket' . $datamhs['id_absen']; ?>"
                                                        id="<?= 'opsi1' . $datamhs['id_absen']; ?>" <?php if ($datamhs['keterangan'] == "Absen") {
                                                        echo "checked";
                                                    } ?> value="Absen">Absen</label>
                                                <label class="radio-inline"><input type="radio"
                                                        name="<?= 'ket' . $datamhs['id_absen']; ?>"
                                                        id="<?= 'opsi1' . $datamhs['id_absen']; ?>" <?php if ($datamhs['keterangan'] == "Sakit") {
                                                        echo "checked";
                                                    } ?> value="Sakit">Sakit</label>
                                                <label class="radio-inline"><input type="radio"
                                                        name="<?= 'ket' . $datamhs['id_absen']; ?>"
                                                        id="<?= 'opsi1' . $datamhs['id_absen']; ?>" <?php if ($datamhs['keterangan'] == "Izin") {
                                                        echo "checked";
                                                    } ?> value="Izin">Izin</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

        </div>
        </div>

        </div>
        <!-- /.container-fluid -->

        </div>

        <!-- End of Main Content -->