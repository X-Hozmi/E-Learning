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
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3" data-toggle="modal"
                data-target="#JurusanBaru" href="">Tambah Jurusan</a>
            <div class="tab-content responsive">
                <div class="tab-pane active" id="jurusan">
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jurusan</th>
                                            <th>Jenjang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i = 1;
											foreach($jurusan as $jur) :
										?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $jur['jurusan']; ?></td>
                                            <td><?= $jur['jenjang']; ?></td>
                                            <td><button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                    data-toggle="modal"
                                                    data-target="#EditJurusan<?= $jur['id_jurusan']; ?>">Edit</button>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>admin/hapusJurusan/<?= $jur['id_jurusan']; ?>"
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

<!-- Modal Baru -->
<div class="modal fade" id="JurusanBaru" tabindex="-1" aria-labelledby="JurusanBaruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="JurusanBaruLabel">Jurusan Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/dataJurusan'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan"
                            value="<?= set_value('jurusan'); ?>" placeholder="">
                        <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Jenjang</label>
                        <input type="text" class="form-control" id="jenjang" name="jenjang"
                            value="<?= set_value('jenjang'); ?>" placeholder="">
                        <?= form_error('jenjang', '<small class="text-danger pl-3">', '</small>'); ?>
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
<?php $no = 0; foreach($jurusan as $jur) : $no++; ?>
<div class="modal fade" id="EditJurusan<?= $jur['id_jurusan']; ?>" tabindex="-1" aria-labelledby="EditJurusanLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="EditJurusanLabel">Edit Data Jurusan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/editJurusan'); ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $jur['id_jurusan']; ?>">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan"
                            value="<?= $jur['jurusan']; ?>" placeholder="">
                        <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Jenjang</label>
                        <input type="text" class="form-control" id="jenjang" name="jenjang"
                            value="<?= $jur['jenjang']; ?>" placeholder="">
                        <?= form_error('jenjang', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="update" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>