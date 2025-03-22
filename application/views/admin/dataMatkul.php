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
                data-target="#MatkulBaru" href="">Tambah Matkul</a>
            <div class="tab-content responsive">
                <div class="tab-pane active" id="matkul">
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>Kode Mata Kuliah</th>
                                            <th>Dosen Pengampu</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        	$query = $this->db->query("SELECT *, dosen.kode_dosen, nama_dosen
														FROM matkul, dosen
														WHERE matkul.kode_dosen = dosen.kode_dosen")->result_array();
											$matkul = $query;
											$i = 1;
											foreach($matkul as $mat) :
										?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $mat['matkul']; ?></td>
                                            <td><?= $mat['kode_matkul']; ?></td>
                                            <td><?= $mat['nama_dosen']; ?> (<?= $mat['kode_dosen']; ?>)</td>
                                            <td><button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                    data-toggle="modal"
                                                    data-target="#EditMatkul<?= $mat['id_matkul']; ?>">Edit</button>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>admin/hapusMatkul/<?= $mat['id_matkul']; ?>"
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
<div class="modal fade" id="MatkulBaru" tabindex="-1" aria-labelledby="MatkulBaruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="MatkulBaruLabel">Matkul Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/dataMatkul'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Matkul</label>
                        <input type="text" class="form-control" id="matkul" name="matkul"
                            value="<?= set_value('matkul'); ?>" placeholder="">
                        <?= form_error('matkul', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Kode Matkul</label>
                        <input type="text" class="form-control" id="kode" name="kode" value="<?= set_value('kode'); ?>"
                            placeholder="">
                        <?= form_error('kode', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Dosen Pengampu</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="kode_dosen">
                            <?php foreach($dosen as $dos) : ?>
                            <option value="<?= $dos['kode_dosen']; ?>"><?= $dos['nama_dosen']; ?>
                                (<?= $dos['kode_dosen']; ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
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
<?php $no = 0; foreach($matkul as $mat) : $no++; ?>
<div class="modal fade" id="EditMatkul<?= $mat['id_matkul']; ?>" tabindex="-1" aria-labelledby="EditMatkulLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="EditMatkulLabel">Edit Data Matkul</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/editMatkul'); ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $mat['id_matkul']; ?>">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Matkul</label>
                        <input type="text" class="form-control" id="matkul" name="matkul" value="<?= $mat['matkul']; ?>"
                            placeholder="">
                        <?= form_error('matkul', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Kode Matkul</label>
                        <input type="text" class="form-control" id="kode" name="kode"
                            value="<?= $mat['kode_matkul']; ?>" placeholder="">
                        <?= form_error('kode', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Dosen Pengampu</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="kode_dosen">
                            <?php foreach($dosen as $dos) : ?>
                            <option value="<?= $dos['kode_dosen']; ?>"><?= $dos['nama_dosen']; ?>
                                (<?= $dos['kode_dosen']; ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
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