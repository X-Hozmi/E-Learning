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


            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-kuis-tab" data-toggle="pill" href="#pills-kuis" role="tab"
                        aria-controls="pills-kuis" aria-selected="true">Daftar Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-fmkuis-tab" data-toggle="pill" href="#pills-fmkuis" role="tab"
                        aria-controls="pills-fmkuis" aria-selected="false">Form Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-laporanquiz-tab" data-toggle="pill" href="#pills-laporanquiz"
                        role="tab" aria-controls="pills-laporanquiz" aria-selected="false">Laporan Quiz</a>
                </li>
            </ul>
            <!-- kumpulan quiz -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-kuis" role="tabpanel" aria-labelledby="pills-kuis-tab">
                    <div class="row">
                        <?php
                        $studos = $this->M_Dosen->sedo();
                        $kode = $studos['kode_dosen'] ?? '';
                        $query = "SELECT * FROM quiz a LEFT JOIN matkul b ON a.kode_matkul = b.kode_matkul WHERE a.npm IS NULL AND a.kode_dosen = '$kode'";
                        $quiz = $this->db->query($query)->result_array();
                        $i = 1;
                        foreach ($quiz as $kuis) :
                        ?>
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h3 font-weight-bold text-capitalize text-dark mb-0">
                                                    <?= $kuis['judul_quiz']; ?></div>
                                                <div class="h4 mt-0 font-weight-bold text-info text-capitalize"
                                                    style="border-bottom: 2px solid black; padding-bottom: 10px;">
                                                    <small><b><?= $kuis['deskripsi']; ?></b></small>
                                                </div>
                                                <div class="h1 mb-2 font-weight-bold text-capitalize text-gray-800">
                                                    <?= $kuis['pertanyaan']; ?> ?</div>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>dosen/hapusQuiz/<?= $kuis['id_quiz']; ?>"
                                                    onclick="return confirm('Yakin ingin hapus data?');">Hapus </a>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                    href="">detail </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- form quiz -->
                <div class="tab-pane fade" id="pills-fmkuis" role="tabpanel" aria-labelledby="pills-fmkuis-tab">
                    <form action="<?= base_url('dosen/quiz'); ?>" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul_quiz" class="control-label">Judul Quiz</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="judul_quiz" id="judul_quiz"
                                            data-error="Judul Quiz harus diisi" placeholder="Judul Quiz" />
                                        <?= form_error('judul_quiz', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi" class="control-label">Deskripsi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="deskripsi" id="deskripsi"
                                            placeholder="Deskripsi" />
                                        <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_dosen" class="control-label">Kode Dosen</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="kode_dosen" name="kode_dosen"
                                            value="<?= $sedo['kode_dosen'] ?? ''; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group baru-data">
                                    <label for="tanggal_lahir" class="control-label">Mata Kuliah</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="kode_matkul">
                                        <?php foreach ($studidos as $stud) : ?><option
                                                value="<?= $stud['kode_matkul']; ?>">
                                                <?= $stud['matkul']; ?>(<?= $stud['kode_matkul']; ?>)
                                            <option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="dynamic_form">
                                    <label for="pertanyaan" class="control-label">Pertanyaaan</label>
                                    <div class="input-group baru-data">
                                        <input type="text" class="form-control" name="pertanyaan"
                                            id="pertanyaan"></input>
                                    </div>
                                    <div class="button-group">
                                        <button type="button" class="btn btn-success btn-tambah"><i
                                                class="fa fa-plus"></i></button>
                                        <button type="button" class="btn btn-danger btn-hapus" style="display:none;"><i
                                                class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-simpan">Save</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-laporanquiz" role="tabpanel"
                    aria-labelledby="pills-laporanquiz-tab">
                    <div class="row">
                        <?php
                        $studos = $this->M_Dosen->sedo();
                        $kode = $studos['kode_dosen'] ?? '';
                        $query = "SELECT * FROM quiz a LEFT JOIN matkul b ON a.kode_matkul = b.kode_matkul WHERE a.npm IS NOT NULL AND a.kode_dosen = '$kode'";
                        $quiz = $this->db->query($query)->result_array();
                        $i = 1;
                        foreach ($quiz as $kuis) :
                        ?>
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h3 font-weight-bold text-capitalize text-dark mb-0">
                                                    <?= $kuis['judul_quiz']; ?></div>
                                                <div class="h4 mt-0 font-weight-bold text-info text-capitalize"
                                                    style="border-bottom: 2px solid black; padding-bottom: 10px;">
                                                    <small><b><?= $kuis['deskripsi']; ?></b></small>
                                                </div>
                                                <div class="h1 mb-2 font-weight-bold text-capitalize text-gray-800">
                                                    <?= $kuis['pertanyaan']; ?> ?</div>
                                                <div class="h3 mb-4 font-weight-bold text-capitalize text-gray-800">
                                                    Jawaban: <?= $kuis['jawaban']; ?></div>

                                                <div class="mb-2 font-weight-bold text-capitalize text-success">
                                                    <small><b>Pertanyaan Ini Di Jawab Oleh NPM :
                                                            [<?= $kuis['npm']; ?>]</b></small>
                                                </div>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>dosen/hapusQuiz/<?= $kuis['id_quiz']; ?>"
                                                    onclick="return confirm('Yakin ingin hapus data?');">Hapus </a>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                    href="">detail </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>



            <!-- Modal Edit -->


        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- gabisa masuk ke database yg masuk cuma satu doang  -->
        <script>
            function addForm() {
                var addrow = '<div class="input-group baru-data">\
                    <input type="text" class="form-control" name="pertanyaan"id="pertanyaan"></input>\
                    <div class="button-group">\
                    <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                    <button type="button" class="btn btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
                    </div>\
                </div>'
                $("#dynamic_form").append(addrow);
            }

            $("#dynamic_form").on("click", ".btn-tambah", function() {
                addForm()
                $(this).css("display", "none")
                var valtes = $(this).parent().find(".btn-hapus").css("display", "");
            })

            $("#dynamic_form").on("click", ".btn-hapus", function() {
                $(this).parent().parent('.baru-data').remove();
                var bykrow = $(".baru-data").length;
                if (bykrow == 1) {
                    $(".btn-hapus").css("display", "none")
                    $(".btn-tambah").css("display", "");
                } else {
                    $('.baru-data').last().find('.btn-tambah').css("display", "");
                }
            });

            $('.btn-simpan').on('click', function() {
                $('#dynamic_form').find('input[type="text"], input[type="number"], select, textarea').each(function() {
                    if ($(this).val() == "") {
                        event.preventDefault()
                        $(this).css('border-color', 'red');

                        $(this).on('focus', function() {
                            $(this).css('border-color', '#ccc');
                        });
                    }
                })
            })
        </script>