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


    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-quiz-tab" data-toggle="pill" href="#pills-quiz" role="tab"
                aria-controls="pills-quiz" aria-selected="true">quiz</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" id="pills-formks-tab" data-toggle="pill" href="#pills-formks" role="tab"
                aria-controls="pills-formks" aria-selected="false">Form Quiz</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" id="pills-laporanquiz-tab" data-toggle="pill" href="#pills-laporanquiz" role="tab"
                aria-controls="pills-laporanquiz" aria-selected="false">Laporan Quiz</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-quiz" role="tabpanel" aria-labelledby="pills-quiz-tab">
            <div class="row">
                <?php
                $query = "SELECT * FROM quiz a LEFT JOIN matkul b ON a.kode_matkul = b.kode_matkul WHERE a.npm IS NULL ";
                $quiz = $this->db->query($query)->result_array();
                foreach ($quiz as $kuis) :
                ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <?= $kuis['judul_quiz']; ?></div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= $kuis['pertanyaan']; ?></div>
                                    <div class="mb-0 font-weight-bold text-info">
                                        <small><b><?= $kuis['deskripsi']; ?></b></small>
                                    </div>
                                    <div class="mb-0 font-weight-bold text-gray-800">
                                        <small>Diupload pada</small>
                                    </div>
                                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                        id="pills-formks-tab" data-toggle="pill"
                                        href="#pills-formks_<?= $kuis['id_quiz']; ?>" role="tab"
                                        aria-controls="pills-formks" aria-selected="false">Jawab</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php

        foreach ($quiz as $kuis) :
        ?>
        <div class="tab-pane fade" id="pills-formks_<?= $kuis['id_quiz']; ?>" role="tabpanel"
            aria-labelledby="pills-formks-tab">
            <?= form_open_multipart('mahasiswa/jawabQuiz'); ?>
            <div class="row">
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body" style="width: 500px;">
                            <div class="row no-gutters align-items-center">
                                <div class="col-md-8">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <input type="text" class="form-control" id="judul_quiz" name="judul_quiz"
                                            value="<?= $kuis['judul_quiz']; ?>" placeholder="" readonly>
                                        <?= form_error('judul_quiz', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800">
                                        <input type="text" class="form-control" id="pertanyaan" name="pertanyaan"
                                            value="<?= $kuis['pertanyaan']; ?>" placeholder="" readonly>
                                        <?= form_error('pertanyaan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800">
                                        <input type="text" class="form-control" id="kode_matkul" name="kode_matkul"
                                            value="<?= $kuis['kode_matkul']; ?>" placeholder="" readonly>
                                        <?= form_error('kode_matkul', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800">
                                        <input type="text" class="form-control" id="kode_dosen" name="kode_dosen"
                                            value="<?= $kuis['kode_dosen']; ?>" placeholder="" readonly>
                                        <?= form_error('kode_dosen', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800">
                                        <input type="text" class="form-control" id="nama_mhs" name="nama_mhs"
                                            value="<?= $sema['nama_mhs']; ?>" placeholder="" readonly>
                                        <?= form_error('nama_mhs', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800">
                                        <input type="text" class="form-control" id="npm" name="npm"
                                            value="<?= $sema['npm']; ?>" placeholder="" readonly>
                                        <?= form_error('npm', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="mb-0 font-weight-bold text-info">
                                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                            value="<?= $kuis['deskripsi']; ?>" placeholder="" readonly>
                                        <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="mb-3 font-weight-bold text-gray-800">
                                        <input type="text" class="form-control" id="jawaban" name="jawaban">
                                        <?= form_error('jawaban', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                    <!-- gabisa balik lagi ke Form Quiz -->
                                    <a class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                                        id="pills-formks-tab" data-toggle="pill" href="#pills-quiz" role="tab">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="tab-pane fade" id="pills-laporanquiz" role="tabpanel" aria-labelledby="pills-laporanquiz-tab">
            <div class="row">
                <h1>Laporan</h1>
            </div>
        </div>
    </div>



</div>
</div>