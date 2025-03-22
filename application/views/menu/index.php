        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

            <div class="row">
                <div class="col-lg-6">

                    <?php if(validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                    <?php endif; ?>
                    <?= $this->session->flashdata('message'); ?>

                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3" data-toggle="modal"
                        data-target="#MenuBaru" href="">Buat Menu Baru</a>

                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i = 1;
											foreach($menu as $me) :
										?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <th scope="row"><?= $me['id_menu']; ?></th>
                                            <td><?= $me['menu']; ?></td>
                                            <td><button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                    data-toggle="modal"
                                                    data-target="#EditMenu<?= $me['id_menu']; ?>">Edit</button>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>menu/hapusMenu/<?= $me['id_menu']; ?>"
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
        <!-- /.container-fluid -->

        </div>


        <!-- End of Main Content -->

        <!-- Modal Baru -->
        <div class="modal fade" id="MenuBaru" tabindex="-1" aria-labelledby="MenuBaruLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="MenuBaruLabel">Buat Menu Baru</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('menu'); ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama menu</label>
                                <input type="text" class="form-control" id="menu" name="menu" placeholder="">
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
		foreach($menu as $me) :
		$no++;
		?>
        <div class="modal fade" id="EditMenu<?= $me['id_menu']; ?>" tabindex="-1" aria-labelledby="EditMenuLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditMenuLabel">Buat Menu Baru</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('menu/editMenu'); ?>">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $me['id_menu']; ?>">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama menu</label>
                                <input type="text" class="form-control" id="menu" name="menu"
                                    value="<?= $me['menu']; ?>" placeholder="">
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