        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

            <div class="col-lg-2">
                <?php if(validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
                <?php endif; ?>
                <?= $this->session->flashdata('message'); ?>
            </div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-dokumen-tab" data-toggle="pill" href="#pills-dokumen"
                        role="tab" aria-controls="pills-dokumen" aria-selected="true">Dokumen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-tugas-tab" data-toggle="pill" href="#pills-tugas" role="tab"
                        aria-controls="pills-tugas" aria-selected="false">Laporan Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Konten 3</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-dokumen" role="tabpanel"
                    aria-labelledby="pills-dokumen-tab">
                    <div class="col-lg-12">
                        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3" data-toggle="modal"
                            data-target="#DokumenBaru" href="">Tambah Dokumen</a>
                        <div class="tab-content responsive">
                            <div class="tab-pane active" id="dokumen1">
                                <div class="card shadow mb-4">
                                    <div class="table-responsive">
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Judul</th>
                                                        <th>Kode</th>
                                                        <th>Matkul</th>
                                                        <th>Komentar</th>
                                                        <th>Tipe</th>
                                                        <th>Ukuran (KB)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
													$studos = $this->M_Dosen->sedo();
													$kode = $studos['kode_dosen'];
													$query = "SELECT *
															FROM dokumen JOIN matkul
															ON dokumen.kode_dosen = matkul.kode_dosen
															AND dokumen.kode_matkul = matkul.kode_matkul
															WHERE matkul.kode_dosen = '$kode'
                                                            AND tipe_doc != 3";
													$dokumen = $this->db->query($query)->result_array();
													$i = 1;
													foreach($dokumen as $dok) :
												?>
                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td><?= $dok['nama_doc']; ?></td>
                                                        <td><?= $dok['title_doc']; ?></td>
                                                        <td><?= $dok['kode_doc']; ?></td>
                                                        <td><?= $dok['matkul']; ?></td>
                                                        <td><?= $dok['komentar_doc']; ?></td>
                                                        <td>
                                                            <?php
														if($dok['tipe_doc'] == 1) {
															echo "Materi";
														} else if ($dok['tipe_doc'] == 2) {
															echo "Tugas";
														} else if ($dok['tipe_doc'] == 3) {
															echo "Laporan Tugas";
														}
													?>
                                                        </td>
                                                        <td><?= $dok['size']; ?></td>
                                                        <td><button
                                                                class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                                data-toggle="modal"
                                                                data-target="#DokEdit<?= $dok['id_doc']; ?>">Edit</button>
                                                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                                href="<?= base_url(); ?>dosen/downloadDokumen/<?= $dok['id_doc']; ?>">Download</a>
                                                            <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                                href="<?= base_url(); ?>dosen/hapusDokumen/<?= $dok['id_doc']; ?>"
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
                <div class="tab-pane fade" id="pills-tugas" role="tabpanel" aria-labelledby="pills-tugas-tab">
                    <div class="col-lg-12">
                        <div class="tab-content responsive">
                            <div class="tab-pane active" id="dokumen1">
                                <div class="card shadow mb-4">
                                    <div class="table-responsive">
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Judul</th>
                                                        <th>Kode</th>
                                                        <th>Matkul</th>
                                                        <th>Nama Mahasiswa</th>
                                                        <th>Komentar</th>
                                                        <th>Tipe</th>
                                                        <th>Ukuran (KB)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
													$studos = $this->M_Dosen->sedo();
													$kode = $studos['kode_dosen'];
													$query = "SELECT *
															FROM dokumen JOIN matkul
															ON dokumen.kode_dosen = matkul.kode_dosen
															AND dokumen.kode_matkul = matkul.kode_matkul
															JOIN mahasiswa
															ON dokumen.npm = mahasiswa.npm
															WHERE matkul.kode_dosen = '$kode'";
													$dokumen = $this->db->query($query)->result_array();
													$i = 1;
													foreach($dokumen as $dok) :
												?>
                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td><?= $dok['nama_doc']; ?></td>
                                                        <td><?= $dok['title_doc']; ?></td>
                                                        <td><?= $dok['kode_doc']; ?></td>
                                                        <td><?= $dok['matkul']; ?></td>
                                                        <td><?= $dok['nama_mhs']; ?> [<?= $dok['npm']; ?>]</td>
                                                        <td><?= $dok['komentar_doc']; ?></td>
                                                        <td>
                                                            <?php
														if($dok['tipe_doc'] == 1) {
															echo "Materi";
														} else if ($dok['tipe_doc'] == 2) {
															echo "Tugas";
														} else if ($dok['tipe_doc'] == 3) {
															echo "Laporan Tugas";
														}
													?>
                                                        </td>
                                                        <td><?= $dok['size']; ?></td>
                                                        <td><a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                                href="<?= base_url(); ?>dosen/downloadDokumen/<?= $dok['id_doc']; ?>">Download</a>
                                                            <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                                href="<?= base_url(); ?>dosen/hapusDokumen/<?= $dok['id_doc']; ?>"
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
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    ...
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Modal Baru -->
        <div class="modal fade" id="DokumenBaru" tabindex="-1" aria-labelledby="DokumenBaruLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-primary" id="DokumenBaruLabel">Input Dokumen Baru
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <?= form_open_multipart('dosen/dokumen'); ?>
                    <div class="modal-body">
                        <div class="row mx-auto">
                            <div class="col">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nama Dokumen</label>
                                    <input type="text" class="form-control" id="nama_doc" name="nama_doc"
                                        value="<?= set_value('nama_doc'); ?>" placeholder="">
                                    <?= form_error('nama_doc', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Judul Dokumen</label>
                                    <input type="text" class="form-control" id="title_doc" name="title_doc"
                                        value="<?= set_value('title_doc'); ?>" placeholder="">
                                    <?= form_error('title_doc', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Kode Dokumen</label>
                                    <input type="text" class="form-control" id="kode_doc" name="kode_doc"
                                        value="<?= set_value('kode_doc'); ?>" placeholder="">
                                    <?= form_error('kode_doc', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Tipe Dokumen</label>
                                    <select class="form-control" id="exampleFormControlSelect2" name="tipe_doc">
                                        <?php foreach($tipe as $tip) : ?>
                                        <option value="<?= $tip ?>">
                                            <?php if($tip == 1) {
		                            				echo 'Materi (1)';
												} else if($tip == 2) {
		                            				echo 'Tugas (2)';
												} else if($tip == 3) {
		                            				echo 'Laporan Tugas (3)'; 
												}
												?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Kode Matkul</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="kode_matkul">
                                        <?php foreach($studidos as $stud) : ?>
                                        <option value="<?= $stud['kode_matkul']; ?>"><?= $stud['matkul']; ?>
                                            (<?= $stud['kode_matkul']; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Kode Dosen</label>
                                    <input type="text" class="form-control" id="kode_dosen" name="kode_dosen"
                                        value="<?= $sedo['kode_dosen']; ?>" placeholder="" readonly>
                                    <?= form_error('kode_dosen', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="TextareaKomentar">Komentar</label>
                                <textarea class="form-control" id="TextareaKomentar" name="komentar_doc"
                                    value="<?= set_value('komentar_doc'); ?>" rows="3"></textarea>
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="berkas" name="berkas">
                                    <label class="custom-file-label" for="berkas">Pilih file</label>
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
        <div class="modal fade" id="DokEdit<?= $dok['id_doc']; ?>" tabindex="-1" aria-labelledby="DokEditLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-primary" id="DokEditLabel">Edit Dokumen
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <?= form_open_multipart('dosen/editDokumen'); ?>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $dok['id_doc']; ?>">
                        <div class="row mx-auto">
                            <div class="col">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nama Dokumen</label>
                                    <input type="text" class="form-control" id="nama_doc" name="nama_doc"
                                        value="<?= $dok['nama_doc']; ?>" placeholder="">
                                    <?= form_error('nama_doc', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Judul Dokumen</label>
                                    <input type="text" class="form-control" id="title_doc" name="title_doc"
                                        value="<?= $dok['title_doc']; ?>" placeholder="">
                                    <?= form_error('title_doc', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Kode Dokumen</label>
                                    <input type="text" class="form-control" id="kode_doc" name="kode_doc"
                                        value="<?= $dok['kode_doc']; ?>" placeholder="">
                                    <?= form_error('kode_doc', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Tipe Dokumen</label>
                                    <select class="form-control" id="exampleFormControlSelect2" name="tipe_doc">
                                        <?php foreach($tipe as $tip) : ?>
                                        <option value="<?= $tip ?>">
                                            <?php if($tip == 1) {
		                            				echo 'Materi (1)';
												} else if($tip == 2) {
		                            				echo 'Tugas (2)';
												} else if($tip == 3) {
		                            				echo 'Laporan Tugas (3)'; 
												}
												?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Kode Matkul</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="kode_matkul">
                                        <?php foreach($studidos as $stud) : ?>
                                        <option value="<?= $stud['kode_matkul']; ?>"><?= $stud['matkul']; ?>
                                            (<?= $stud['kode_matkul']; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Kode Dosen</label>
                                    <input type="text" class="form-control" id="kode_dosen" name="kode_dosen"
                                        value="<?= $sedo['kode_dosen']; ?>" placeholder="" readonly>
                                    <?= form_error('kode_dosen', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="TextareaKomentar">Komentar</label>
                                <textarea class="form-control" id="TextareaKomentar" name="komentar_doc"
                                    rows="3"><?= $dok['komentar_doc']; ?></textarea>
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="berkas" name="berkas">
                                    <label class="custom-file-label" for="berkas">Pilih file</label>
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