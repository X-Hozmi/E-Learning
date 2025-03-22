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

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- card menu absensi -->
                    <div class="row">
                        <!-- Collapsable Card Absensi -->
                        <div class="col-md-4 animated--fade-in">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#absen" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                    aria-expanded="true" aria-controls="absen">
                                    <h6 class="m-0 font-weight-bold text-primary">Menu Pengisian Absensi</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse hide" id="absen">
                                    <div class="card-body">
                                        <form role="form" action="<?= base_url('dosen/formabsen'); ?>" method="post"
                                            name="postform" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan</label>
                                                <select id="jurusan" class="form-control" name="jurusan">
                                                    <?php foreach ($jurusan as $jsn) : ?>
                                                    <option value="<?= $jsn['jurusan']; ?>">
                                                        <?= $jsn['jurusan']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jadwal">Jadwal</label>
                                                <select id="jadwal" class="form-control" name="jadwal">
                                                    <option selected>Minggu 1</option>
                                                    <option>Minggu 2</option>
                                                    <option>Minggu 3</option>
                                                    <option>Minggu 4</option>
                                                    <option>Minggu 5</option>
                                                    <option>Minggu 6</option>
                                                    <option>Minggu 7</option>
                                                    <option>Minggu 8</option>
                                                    <option>Minggu 9</option>
                                                    <option>Minggu 10</option>
                                                    <option>Minggu 11</option>
                                                    <option>Minggu 12</option>
                                                    <option>Minggu 13</option>
                                                    <option>Minggu 14</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Lihat</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- card rekap jurusan -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#rekap" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                    aria-expanded="true" aria-controls="rekap">
                                    <h6 class="m-0 font-weight-bold text-primary">Menu Rekap Absensi</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse hide" id="rekap">
                                    <div class="card-body">
                                        <form role="form" action="<?= base_url('dosen/formrekap'); ?>" method="post"
                                            name="postform" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan</label>
                                                <select id="jurusan" class="form-control" name="jurusan">
                                                    <?php foreach ($jurusan as $jsn) : ?>
                                                    <option value="<?= $jsn['jurusan']; ?>">
                                                        <?= $jsn['jurusan']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Pilih Jurusan</button>
                                        </form>
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