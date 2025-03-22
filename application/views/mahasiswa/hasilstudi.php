        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <dl class="row">
                        <dd class="col-sm-4">NPM</dd>
                        <dd class="col-sm-8">: <?= $sema['npm'] ?? '' ?></dd>
                        <dd class="col-sm-4">Nama Mahasiswa</dd>
                        <dd class="col-sm-8">: <?= $sema['nama_mhs'] ?? '' ?></dd>
                        <dd class="col-sm-4">Jurusan</dd>
                        <dd class="col-sm-8">: <?= $sema['jurusan'] ?? '' ?></dd>
                    </dl>
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Mata Kuliah</th>
                                            <th scope="col">UTS</th>
                                            <th scope="col">Tugas</th>
                                            <th scope="col">UAS</th>
                                            <th scope="col">Rata-Rata</th>
                                            <th scope="col">Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($studima as $stud) :
                                        ?>
                                            <tr role="row">
                                                <td><?= $i; ?></td>
                                                <td><?= $stud['npm'] ?></td>
                                                <td><?= $stud['uts'] ?></td>
                                                <td><?= $stud['tugas'] ?></td>
                                                <td><?= $stud['uas'] ?></td>
                                                <td><?= $stud['average'] ?></td>
                                                <td><?= $stud['grade'] ?></td>
                                            </tr>
                                    </tbody>
                                <?php
                                            $i++;
                                        endforeach;
                                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>

        <!-- End of Main Content -->