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
                    <a class="nav-link active" id="pills-materi-tab" data-toggle="pill" href="#pills-materi" role="tab"
                        aria-controls="pills-materi" aria-selected="true">Materi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-tugas-tab" data-toggle="pill" href="#pills-tugas" role="tab"
                        aria-controls="pills-tugas" aria-selected="false">Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Konten 3</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-materi" role="tabpanel"
                    aria-labelledby="pills-materi-tab">
                    <div class="row">
                        <?php
						$query = "SELECT *
									FROM dokumen
									WHERE tipe_doc = '1'";
						$dokumen = $this->db->query($query)->result_array();
						foreach($dokumen as $dok) : 
						?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <?= $dok['title_doc']; ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $dok['komentar_doc']; ?></div>
                                            <div class="mb-0 font-weight-bold text-info">
                                                <small><b>Ukuran file: <?= $dok['size']; ?> KB</b></small>
                                            </div>
                                            <div class="mb-0 font-weight-bold text-gray-800">
                                                <small>Diupload pada
                                                    <?= date_format(date_create($dok['date_created']),'d F Y'); ?></small>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a class="fas fa-download fa-2x text-info"
                                                href="<?= base_url(); ?>mahasiswa/downloadDokumen/<?= $dok['id_doc']; ?>"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-tugas" role="tabpanel" aria-labelledby="pills-tugas-tab">
                    <div class="row">
                        <?php
							$query = "SELECT *
										FROM dokumen
										WHERE tipe_doc = '2'";

							$dokumen = $this->db->query($query)->result_array();
							foreach($dokumen as $dok) :
						?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <?= $dok['title_doc']; ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $dok['komentar_doc']; ?></div>
                                            <div class="mb-0 font-weight-bold text-info">
                                                <small><b>Ukuran file: <?= $dok['size']; ?> KB</b></small>
                                            </div>
                                            <div class="mb-0 font-weight-bold text-gray-800">
                                                <small>Diupload pada
                                                    <?= date_format(date_create($dok['date_created']),'d F Y') ?>
                                                </small>
                                            </div>
                                            <div class="mb-0 font-weight-bold text-danger">
                                                <small>Tenggat waktu:
                                                    <?= date('d F Y', (strtotime("+7 day", strtotime($dok['date_created'])))) ?>
                                                </small>
                                            </div>
                                            <button class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                data-toggle="modal"
                                                data-target="#UploadTugas<?= $dok['id_doc']; ?>">Upload laporan
                                                tugas</button>
                                        </div>
                                        <div class="col-auto">
                                            <a class="fas fa-download fa-2x text-info"
                                                href="<?= base_url(); ?>mahasiswa/downloadDokumen/<?= $dok['id_doc']; ?>"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    ...
                </div>
            </div>
            <!-- Modal Edit -->
            <?php
				$query = "SELECT * FROM dokumen
							JOIN matkul ON dokumen.kode_matkul = matkul.kode_matkul
							JOIN dosen ON dokumen.kode_dosen = dosen.kode_dosen";
				$dokumen = $this->db->query($query)->result_array();
				$no = 0;
				foreach($dokumen as $dok) : 
				$no++;
			?>
            <div class="modal fade" id="UploadTugas<?= $dok['id_doc']; ?>" tabindex="-1"
                aria-labelledby="UploadTugasLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary" id="UploadTugasLabel">Upload laporan
                                tugas
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <?= form_open_multipart('mahasiswa/uploadTugas'); ?>
                        <div class="modal-body">
                            <div class="row mx-auto">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Nama Dokumen</label>
                                        <input type="text" class="form-control" id="nama_doc" name="nama_doc"
                                            value="<?= $dok['nama_doc']; ?>" placeholder="" readonly>
                                        <?= form_error('nama_doc', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Judul Dokumen</label>
                                        <input type="text" class="form-control" id="title_doc" name="title_doc"
                                            value="<?= $dok['title_doc']; ?>" placeholder="" readonly>
                                        <?= form_error('title_doc', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Kode Dokumen</label>
                                        <input type="text" class="form-control" id="kode_doc" name="kode_doc"
                                            value="<?= $dok['kode_doc']; ?>" placeholder="" readonly>
                                        <?= form_error('kode_doc', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Nama Mata Kuliah</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="kode_matkul">
                                            <option value="<?= $dok['kode_matkul']; ?>"><?= $dok['matkul']; ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Kode Dosen</label>
                                    <input type="text" class="form-control" id="kode_dosen" name="kode_dosen"
                                        value="<?= $dok['kode_dosen']; ?>" placeholder="" readonly>
                                    <?= form_error('kode_dosen', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" id="nama_mhs" name="nama_mhs"
                                        value="<?= $sema['nama_mhs'] ?>" placeholder="" readonly>
                                    <?= form_error('nama_mhs', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">NPM</label>
                                    <input type="text" class="form-control" id="npm" name="npm"
                                        value="<?= $sema['npm'] ?>" placeholder="" readonly>
                                    <?= form_error('npm', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="TextareaKomentar">Komentar Upload</label>
                                    <textarea class="form-control" id="TextareaKomentar" name="komentar_doc"
                                        value="<?= set_value('komentar_doc'); ?>" rows=" 3"></textarea>
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
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <?php endforeach; ?>

        </div>
        <!-- /.container-fluid -->

        </div>



        <!-- End of Main Content -->