<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- ISI -->
    <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

    <div class="row">
        <div class="col-lg-2">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="col-lg-12">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3" data-toggle="modal"
                data-target="#StudiBaru" href="">Laporan Hasil Studi Baru</a>
            <div class="tab-content responsive">
                <div class="tab-pane active" id="dosen">
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>NPM</th>
                                            <th>Mata Kuliah</th>
                                            <th>Kehadiran</th>
                                            <th>UTS</th>
                                            <th>Tugas</th>
                                            <th>UAS</th>
                                            <th>Rata-rata</th>
                                            <th>Grade</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $studos = $this->M_Dosen->sedo();
                                        $kode = $studos['kode_dosen'] ?? '';
                                        $query = "SELECT *
														FROM hasilstudi JOIN matkul
														ON hasilstudi.kode_dosen = matkul.kode_dosen
														AND hasilstudi.kode_matkul = matkul.kode_matkul
														JOIN mahasiswa ON hasilstudi.npm = mahasiswa.npm
														WHERE matkul.kode_dosen = '$kode'";
                                        $hasil = $this->db->query($query)->result_array();
                                        $i = 1;
                                        foreach ($hasil as $has) :
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $has['nama_mhs']; ?></td>
                                                <td><?= $has['npm']; ?></td>
                                                <td><?= $has['matkul']; ?></td>
                                                <td><?= $has['kehadiran']; ?></td>
                                                <td><?= $has['uts']; ?></td>
                                                <td><?= $has['tugas']; ?></td>
                                                <td><?= $has['uas']; ?></td>
                                                <td><?= $has['average']; ?></td>
                                                <td><?= $has['grade']; ?></td>
                                                <td><button
                                                        class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                        data-toggle="modal"
                                                        data-target="#StudiEdit<?= $has['id_studi']; ?>">Edit</button>
                                                    <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                        href="<?= base_url(); ?>dosen/hapusStudi/<?= $has['id_studi']; ?>"
                                                        onclick="return confirm('Yakin ingin hapus data?');">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>


<!-- End of Main Content -->

<!-- Modal Baru -->

<div class="modal fade" id="StudiBaru" tabindex="-1" aria-labelledby="StudiBaruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="StudiBaruLabel">Input Hasil Studi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('dosen/studi'); ?>">
                <div class="modal-body">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Kode Dosen</label>
                            <input type="text" class="form-control" id="kode_dosen" name="kode_dosen"
                                value="<?= $sedo['kode_dosen'] ?? ''; ?>" placeholder="" readonly>
                            <?= form_error('kode_dosen', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Kode Matkul</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="kode_matkul">
                                <?php foreach ($studidos as $stud) : ?>
                                    <option value="<?= $stud['kode_matkul']; ?>"><?= $stud['matkul']; ?>
                                        (<?= $stud['kode_matkul']; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Nama Mahasiswa</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="npm">
                                <?php foreach ($mahasiswa as $mhs) : ?>
                                    <option value="<?= $mhs['npm']; ?>"><?= $mhs['nama_mhs']; ?> [<?= $mhs['npm']; ?>]
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row mx-auto">
                            <div class="col">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Total Kehadiran</label>
                                    <input type="text" class="form-control" id="kehadiran" name="kehadiran"
                                        value="<?= set_value('kehadiran'); ?>" placeholder="">
                                    <?= form_error('kehadiran', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nilai UTS</label>
                                    <input type="text" class="form-control" id="uts" name="uts"
                                        value="<?= set_value('uts'); ?>" placeholder="">
                                    <?= form_error('uts', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nilai Tugas</label>
                                    <input type="text" class="form-control" id="tugas" name="tugas"
                                        value="<?= set_value('tugas'); ?>" placeholder="">
                                    <?= form_error('tugas', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nilai UAS</label>
                                    <input type="text" name="uas" class="form-control form-control-user" id="uas"
                                        value="<?= set_value('uas'); ?>" placeholder="">
                                    <?= form_error('uas', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php
$no = 0;
foreach ($hasil as $has) :
    $no++;
?>
    <div class="modal fade" id="StudiEdit<?= $has['id_studi']; ?>" tabindex="-1" aria-labelledby="StudiEditLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="StudiEditLabel">Edit Laporan Studi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('dosen/editStudi'); ?>">
                    <div class="modal-body">
                        <div class="col">
                            <input type="hidden" name="id" value="<?= $has['id_studi']; ?>">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Kode Dosen</label>
                                <input type="text" class="form-control" id="kode_dosen" name="kode_dosen"
                                    value="<?= $has['kode_dosen']; ?>" placeholder="" readonly>
                                <?= form_error('kode_dosen', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kode Matkul</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="kode_matkul">
                                    <?php foreach ($studidos as $stud) : ?>
                                        <option value="<?= $stud['kode_matkul']; ?>"><?= $stud['matkul']; ?>
                                            (<?= $stud['kode_matkul']; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Nama Mahasiswa</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="npm">
                                    <option value="<?= $has['npm']; ?>"><?= $has['nama_mhs']; ?> [<?= $has['npm']; ?>]
                                    </option>
                                </select>
                            </div>
                            <div class="row mx-auto">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Total Kehadiran</label>
                                        <input type="text" class="form-control" id="kehadiran" name="kehadiran"
                                            value="<?= $has['kehadiran']; ?>" placeholder="">
                                        <?= form_error('kehadiran', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Nilai UTS</label>
                                        <input type="text" class="form-control" id="uts" name="uts"
                                            value="<?= $has['uts']; ?>" placeholder="">
                                        <?= form_error('uts', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Nilai Tugas</label>
                                        <input type="text" class="form-control" id="tugas" name="tugas"
                                            value="<?= $has['tugas']; ?>" placeholder="">
                                        <?= form_error('tugas', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Nilai UAS</label>
                                        <input type="text" name="uas" class="form-control form-control-user" id="uas"
                                            value="<?= $has['uas']; ?>" placeholder="">
                                        <?= form_error('uas', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>