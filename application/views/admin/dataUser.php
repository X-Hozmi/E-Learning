<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- ISI -->
    <h1 class="h3 font-weight-bold mb-4 text-primary"><?= $judul; ?></h1>

    <div class="row">
        <div class="col-lg-2">
            <?php if(validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="col-lg-12">
            <div class="tab-content responsive">
                <div class="tab-pane active" id="user">
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Status Akun</th>
                                            <th>Level User</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i = 1;
											foreach($akun as $ak) :
										?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $ak['nama']; ?></td>
                                            <td><?= $ak['email']; ?></td>
                                            <td>
                                                <?php if($ak['is_active'] == 0) {
													echo 'Non-aktif (0)';
												} else {
		                                       		echo 'Aktif (1)';
												}
												?>
                                            </td>
                                            <td>
                                                <?php if($ak['id_role'] == 1) {
		                            				echo 'Admin (1)';
												} else if($ak['id_role'] == 2) {
		                        				    echo 'User (2)';
												} else if($ak['id_role'] == 3) {
		                        				    echo 'Dosen (3)'; 
												} else if($ak['id_role'] == 4) {
		                        				    echo 'Mahasiswa (4)';
												}
												?>
                                            </td>
                                            <td><button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                    data-toggle="modal"
                                                    data-target="#EditAkun<?= $ak['id_user']; ?>">Edit</button>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>admin/hapusUser/<?= $ak['id_user']; ?>"
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

</div>
<!-- /.container-fluid -->

</div>


<!-- End of Main Content -->

<!-- Modal Edit -->
<?php $no = 0; foreach($akun as $ak) : $no++; ?>
<div class="modal fade" id="EditAkun<?= $ak['id_user']; ?>" tabindex="-1" aria-labelledby="EditAkunLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="EditAkunLabel">Edit Akun</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/editUser'); ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $ak['id_user']; ?>">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama User</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $ak['nama']; ?>"
                            placeholder="" <?php if($ak['id_role'] != 1) {
								echo 'readonly'; } ?>>
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Email User</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $ak['email']; ?>"
                            placeholder="" readonly>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Status Akun</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="status"
                            <?= $ak['is_active']; ?>>
                            <?php foreach($status as $stat) : ?>
                            <option value="<?= $stat ?>">
                                <?php if($stat == 0) {
									echo 'Non-aktif (0)';
								} else {
		                            echo 'Aktif (1)';
								}
								?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Level User</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="level" <?= $ak['id_role']; ?>>
                            <?php foreach($level as $lvl) : ?>
                            <option value="<?= $lvl ?>">
                                <?php if($lvl == 1) {
		                            echo 'Admin (1)';
								} else if($lvl == 2) {
		                            echo 'User (2)';
								} else if($lvl == 3) {
		                            echo 'Dosen (3)'; 
								} else if($lvl == 4) {
		                            echo 'Mahasiswa (4)';
								}
								?>
                            </option>
                            <?php endforeach; ?>
                        </select>
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
