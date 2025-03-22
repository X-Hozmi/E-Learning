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
                        data-target="#ShortBaru" href="">Buat Shortcut Baru</a>
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Short</th>
                                            <th scope="col">Table Count</th>
                                            <th scope="col">URL</th>
                                            <th scope="col">Card Class</th>
                                            <th scope="col">Text Upper</th>
                                            <th scope="col">Text Count</th>
                                            <th scope="col">Ikon Class</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i = 1;
											foreach($short as $sh) :
										?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $sh['nama_short']; ?></td>
                                            <td><?= $sh['nama_tabel']; ?></td>
                                            <td><?= $sh['url']; ?></td>
                                            <td><?= $sh['card_class']; ?></td>
                                            <td><?= $sh['text_upper']; ?></td>
                                            <td><?= $sh['text_count']; ?></td>
                                            <td><?= $sh['ikon_class']; ?></td>
                                            <td><button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                    data-toggle="modal"
                                                    data-target="#EditShort<?= $sh['id_short']; ?>">Edit</button>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>menu/hapusShort/<?= $sh['id_short']; ?>"
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
        <div class="modal fade" id="ShortBaru" tabindex="-1" aria-labelledby="ShortBaruLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ShortBaruLabel">Buat Shortcut Baru</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('menu/short'); ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama shortcut</label>
                                <input type="text" class="form-control" id="nama_short" name="nama_short"
                                    value="<?= set_value('nama_short'); ?>" placeholder="">
                                <?= form_error('nama_short', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama tabel</label>
                                <input type="text" class="form-control" id="nama_tabel" name="nama_tabel"
                                    value="<?= set_value('nama_tabel'); ?>" placeholder="">
                                <?= form_error('nama_tabel', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">URL</label>
                                <input type="text" class="form-control" id="url" name="url"
                                    value="<?= set_value('url'); ?>" placeholder="">
                                <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Card Class</label>
                                <input type="text" class="form-control" id="card_class" name="card_class"
                                    value="<?= set_value('card_class'); ?>" placeholder="">
                                <?= form_error('card_class', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Text Upper</label>
                                <input type="text" class="form-control" id="text_upper" name="text_upper"
                                    value="<?= set_value('text_upper'); ?>" placeholder="">
                                <?= form_error('text_upper', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Text Count</label>
                                <input type="text" class="form-control" id="text_count" name="text_count"
                                    value="<?= set_value('text_count'); ?>" placeholder="">
                                <?= form_error('text_count', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Ikon</label>
                                <input type="text" class="form-control" id="ikon" name="ikon"
                                    value="<?= set_value('ikon'); ?>" placeholder="">
                                <?= form_error('ikon', '<small class="text-danger pl-3">', '</small>'); ?>
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

        <?php
			$no = 0;
			foreach($short as $sh) :
			$no++;
		?>
        <!-- Modal Edit -->
        <div class="modal fade" id="EditShort<?= $sh['id_short']; ?>" tabindex="-1" aria-labelledby="EditShortLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditShortLabel">Edit Shortcut</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('menu/editshort'); ?>">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $sh['id_short']; ?>">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama shortcut</label>
                                <input type="text" class="form-control" id="nama_short" name="nama_short"
                                    value="<?= $sh['nama_short']; ?>" placeholder="">
                                <?= form_error('nama_short', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukkan nama tabel</label>
                                <input type="text" class="form-control" id="nama_tabel" name="nama_tabel"
                                    value="<?= $sh['nama_tabel']; ?>" placeholder="">
                                <?= form_error('nama_tabel', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">URL</label>
                                <input type="text" class="form-control" id="url" name="url" value="<?= $sh['url']; ?>"
                                    placeholder="">
                                <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Card Class</label>
                                <input type="text" class="form-control" id="card_class" name="card_class"
                                    value="<?= $sh['card_class']; ?>" placeholder="">
                                <?= form_error('card_class', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Text Upper</label>
                                <input type="text" class="form-control" id="text_upper" name="text_upper"
                                    value="<?= $sh['text_upper']; ?>" placeholder="">
                                <?= form_error('text_upper', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Text Count</label>
                                <input type="text" class="form-control" id="text_count" name="text_count"
                                    value="<?= $sh['text_count']; ?>" placeholder="">
                                <?= form_error('text_count', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Ikon Class</label>
                                <input type="text" class="form-control" id="ikon" name="ikon"
                                    value="<?= $sh['ikon_class']; ?>" placeholder="">
                                <?= form_error('ikon', '<small class="text-danger pl-3">', '</small>'); ?>
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
