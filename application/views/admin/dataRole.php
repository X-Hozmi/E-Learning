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
                        data-target="#RoleBaru" href="">Buat Role Baru</a>

                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i = 1;
											foreach($role as $rl) :
										?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <th scope="row"><?= $rl['id']; ?></th>
                                            <td><?= $rl['role']; ?></td>
                                            <td><a class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"
                                                    href="<?= base_url('admin/dataRoleAkses/') . $rl['id']; ?>">Akses</a>
                                                <button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                    data-toggle="modal"
                                                    data-target="#RoleEdit<?= $rl['id']; ?>">Edit</button>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>admin/hapusRole/<?= $rl['id']; ?>"
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
        <div class="modal fade" id="RoleBaru" tabindex="-1" aria-labelledby="RoleBaruLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="RoleBaruLabel">Buat Role Baru</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('admin/dataRole'); ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama role</label>
                                <input type="text" class="form-control" id="role" name="role" placeholder=""
                                    value="<?= set_value('role'); ?>">
                                <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
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
			foreach($role as $rl) :
			$no++;
		?>
        <div class="modal fade" id="RoleEdit<?= $rl['id']; ?>" tabindex="-1" aria-labelledby="RoleEditLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="RoleEditLabel">Edit Role</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('admin/editRole'); ?>">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $rl['id']; ?>">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama role</label>
                                <input type="text" class="form-control" id="role" name="role"
                                    value="<?= $rl['role']; ?>" placeholder="">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
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