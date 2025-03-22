        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

            <div class="row">
                <div class="col-lg-6">

                    <?= $this->session->flashdata('message'); ?>

                    <h5 class="font-weight-bold mb-4 text-success">Role : <?= $role['role']; ?></h5>
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
                                            <th scope="col">Akses</th>
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
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        <?= check_akses($role['id'], $me['id_menu']); ?>
                                                        data-role="<?= $role['id']; ?>"
                                                        data-menu="<?= $me['id_menu']; ?>">
                                                </div>
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