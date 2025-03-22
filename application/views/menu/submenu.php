        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
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
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3" data-toggle="modal"
                        data-target="#SubBaru" href="">Buat Submenu Baru</a>
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Submenu</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Url</th>
                                            <th scope="col">Ikon</th>
                                            <th scope="col">Status Submenu</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$query = "SELECT *, menu.id_menu, menu
														FROM menu_sub, menu
														WHERE menu_sub.id_menu = menu.id_menu";
											$submenu = $this->db->query($query)->result_array();
											$i = 1;
											foreach($submenu as $sub) :
										?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $sub['nama_sub']; ?></td>
                                            <td><?= $sub['menu']; ?> (<?= $sub['id_menu']; ?>)</td>
                                            <td><?= $sub['url']; ?></td>
                                            <td><?= $sub['ikon']; ?></td>
                                            <td>
                                                <?php if($sub['is_active'] == 0) {
		                                        	echo 'Non-aktif (0)';
												} else {
		                                        	echo 'Aktif (1)';
	                                        	} 
												?>
                                            </td>
                                            <td><button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                    data-toggle="modal"
                                                    data-target="#EditSub<?= $sub['id_submenu']; ?>">Edit</button>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>menu/hapusSub/<?= $sub['id_submenu']; ?>"
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
        <div class="modal fade" id="SubBaru" tabindex="-1" aria-labelledby="SubBaruLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="SubBaruLabel">Buat Menu Baru</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('menu/submenu'); ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama submenu</label>
                                <input type="text" class="form-control" id="nama_sub" name="nama_sub"
                                    value="<?= set_value('nama_sub'); ?>" placeholder="">
                                <?= form_error('nama_sub', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">ID Menu</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="id_menu">
                                    <?php foreach($menu as $me) : ?>
                                    <option value="<?= $me['id_menu']; ?>"><?= $me['menu']; ?>
                                        (<?= $me['id_menu']; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">URL</label>
                                <input type="text" class="form-control" id="url" name="url"
                                    value="<?= set_value('url'); ?>" placeholder="">
                                <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Ikon</label>
                                <input type="text" class="form-control" id="ikon" name="ikon"
                                    value="<?= set_value('ikon'); ?>" placeholder="">
                                <?= form_error('ikon', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_active"
                                        id="is_active" checked>
                                    <label class="form-check-label" for="is_active">
                                        Status aktif? (Centang apabila iya)
                                    </label>
                                </div>
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
			foreach($submenu as $sub) :
			$no++;
		?>
        <div class="modal fade" id="EditSub<?= $sub['id_submenu']; ?>" tabindex="-1" aria-labelledby="EditSubLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditSubLabel">Edit Submenu</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('menu/editsub'); ?>">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $sub['id_submenu']; ?>">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama submenu</label>
                                <input type="text" class="form-control" id="nama_sub" name="nama_sub"
                                    value="<?= $sub['nama_sub']; ?>" placeholder="">
                                <?= form_error('nama_sub', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">ID Menu</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="id_menu">
                                    <?php foreach($menu as $me) : ?>
                                    <option value="<?= $me['id_menu']; ?>"><?= $me['menu']; ?>
                                        (<?= $me['id_menu']; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">URL</label>
                                <input type="text" class="form-control" id="url" name="url" value="<?= $sub['url']; ?>"
                                    placeholder="">
                                <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Ikon</label>
                                <input type="text" class="form-control" id="ikon" name="ikon"
                                    value="<?= $sub['ikon']; ?>" placeholder="">
                                <?= form_error('ikon', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_active"
                                        id="is_active" checked>
                                    <label class="form-check-label" for="is_active">
                                        Status aktif? (Centang apabila iya)
                                    </label>
                                </div>
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