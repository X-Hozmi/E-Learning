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
                data-target="#DosenBaru" href="">Tambah Dosen</a>
            <div class="tab-content responsive">
                <div class="tab-pane active" id="dosen">
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Kode</th>
                                            <th>J Kelamin</th>
                                            <th>No. HP</th>
                                            <th>Alamat Email</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Agama</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											function ubahformatTgl3($tanggal) {
												$pisah = explode('-',$tanggal);		
												$urutan = array($pisah[2],$pisah[1],$pisah[0]);
												$satukan = implode('-',$urutan);
												return $satukan;
											}
											$i = 1;
											foreach($dosen as $dos) :
										?>
                                        <tr>
                                            <?php
												$tgl_lahir = $dos['tgl_lahir'];
												$lahir = ubahformatTgl3($tgl_lahir)
											?>
                                            <td><?= $i; ?></td>
                                            <td><?= $dos['nip']; ?></td>
                                            <td><?= $dos['nama_dosen']; ?></td>
                                            <td><?= $dos['kode_dosen']; ?></td>
                                            <td><?= $dos['kelamin']; ?></td>
                                            <td><?= $dos['no_hp']; ?></td>
                                            <td><?= $dos['email']; ?></td>
                                            <td><?= $dos['tmp_lahir']; ?>, <?= $lahir; ?></td>
                                            <td><?= $dos['alamat']; ?></td>
                                            <td><?= $dos['agama']; ?></td>
                                            <td><button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                    data-toggle="modal"
                                                    data-target="#DosEdit<?= $dos['id_dosen']; ?>">Edit</button>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>admin/hapusDosen/<?= $dos['id_dosen']; ?>"
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
<div class="modal fade" id="DosenBaru" tabindex="-1" aria-labelledby="DosenBaruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="DosenBaruLabel">Input Dosen Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/dataDosen'); ?>">
                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col">
                            <div class="form-group">
                                <label for="formGroupExampleInput">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip"
                                    value="<?= set_value('nip'); ?>" placeholder="">
                                <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama Dosen</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?= set_value('nama'); ?>" placeholder="">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Kode Dosen</label>
                                <input type="text" class="form-control" id="kode" name="kode"
                                    value="<?= set_value('kode'); ?>" placeholder="">
                                <?= form_error('kode', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nomor Handphone</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="<?= set_value('no_hp'); ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="<?= set_value('email'); ?>" placeholder="">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Password</label>
                                <input type="password" name="password" class="form-control form-control-user"
                                    id="password" placeholder="">
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="kelamin">
                                    <?php foreach($kelamin as $kel) : ?>
                                    <option value="<?= $kel ?>"><?= $kel ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir"
                                    value="<?= set_value('tmp_lahir'); ?>" placeholder="">
                                <?= form_error('tmp_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tanggal Lahir</label>
                                <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                    value="<?= set_value('tgl_lahir'); ?>" placeholder="dd/mm/yyyy">
                                <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="<?= set_value('alamat'); ?>" placeholder="">
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Agama</label>
                                <input type="text" class="form-control" id="agama" name="agama"
                                    value="<?= set_value('agama'); ?>" placeholder="">
                                <?= form_error('agama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
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
	function ubahformatTgl4($tanggal) {
		$pisah = explode('-',$tanggal);		
		$urutan = array($pisah[2],$pisah[1],$pisah[0]);
		$satukan = implode('/',$urutan);
	return $satukan;
	}
	$no = 0;
	foreach($dosen as $dos) : 
	$no++;
?>
<div class="modal fade" id="DosEdit<?= $dos['id_dosen']; ?>" tabindex="-1" aria-labelledby="DosEditLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="DosEditLabel">Edit Data Dosen</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/editDosen'); ?>">
                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col">
                            <input type="hidden" name="id" value="<?= $dos['id_dosen']; ?>">
                            <div class="form-group">
                                <label for="formGroupExampleInput">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="<?= $dos['nip']; ?>"
                                    placeholder="">
                                <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama Dosen</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?= $dos['nama_dosen']; ?>" placeholder="">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Kode Dosen</label>
                                <input type="text" class="form-control" id="kode" name="kode"
                                    value="<?= $dos['kode_dosen']; ('kode'); ?>" placeholder="">
                                <?= form_error('kode', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nomor Handphone</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="<?= $dos['no_hp']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="<?= $dos['email']; ?>" placeholder="">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="kelamin">
                                    <?php foreach($kelamin as $kel) : ?>
                                    <option value="<?= $kel ?>"><?= $kel ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir"
                                    value="<?= $dos['tmp_lahir']; ?>" placeholder="">
                                <?= form_error('tmp_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <?php
									$tgl_lahir = $dos['tgl_lahir'];
									$lahir = ubahformatTgl4($tgl_lahir)
								?>
                                <label for="formGroupExampleInput">Tanggal Lahir (dd/mm/yyyy)</label>
                                <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                    value="<?= $lahir; ?>" placeholder="dd/mm/yyyy">
                                <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="<?= $dos['alamat']; ?>" placeholder="">
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Agama</label>
                                <input type="text" class="form-control" id="agama" name="agama"
                                    value="<?= $dos['agama']; ?>" placeholder="">
                                <?= form_error('agama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
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
