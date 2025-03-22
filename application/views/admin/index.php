        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

            <div class="row">
                <?php foreach($short as $sh) : ?>
                <!-- Data Mahasiswa -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a class="<?= $sh['card_class'] ?>" href="<?= $sh['url'] ?>">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="<?= $sh['text_upper'] ?>">
                                        <?= $sh['nama_short'] ?></div>
                                    <div class="<?= $sh['text_count'] ?>">
                                        <?= $this->db->get($sh["nama_tabel"])->num_rows(); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="<?= $sh['ikon_class'] ?>"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <?php endforeach; ?>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>

        <!-- End of Main Content -->