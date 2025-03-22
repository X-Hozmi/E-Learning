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
                data-target="#MHSBaru" href="">Tambah Mahasiswa</a>
            <div class="tab-content responsive">
                <div class="tab-pane active" id="mahasiswa">
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NPM</th>
                                            <th>Nama</th>
                                            <th>J Kelamin</th>
                                            <th>No. HP</th>
                                            <th>Alamat Email</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Agama</th>
                                            <th>Nama Orang Tua</th>
                                            <th>No. Telepon Ortu</th>
                                            <th>Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											function ubahformatTgl5($tanggal) {
												$pisah = explode('-',$tanggal);		
												$urutan = array($pisah[2],$pisah[1],$pisah[0]);
												$satukan = implode('-',$urutan);
												return $satukan;
											}
											$i = 1;
											foreach($mahasiswa as $mhs) :
										?>
                                        <tr>
                                            <?php
												$tgl_lahir = $mhs['tgl_lahir'];
												$lahir = ubahformatTgl5($tgl_lahir)
											?>
                                            <td><?= $i; ?></td>
                                            <td><?= $mhs['npm']; ?></td>
                                            <td><?= $mhs['nama_mhs']; ?></td>
                                            <td><?= $mhs['kelamin']; ?></td>
                                            <td><?= $mhs['no_hp']; ?></td>
                                            <td><?= $mhs['email']; ?></td>
                                            <td><?= $mhs['tmp_lahir']; ?>, <?= $lahir; ?></td>
                                            <td><?= $mhs['alamat']; ?></td>
                                            <td><?= $mhs['agama']; ?></td>
                                            <td><?= $mhs['ortu']; ?></td>
                                            <td><?= $mhs['no_ortu']; ?></td>
                                            <td><?= $mhs['jurusan']; ?></td>
                                            <td><button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                                                    data-toggle="modal"
                                                    data-target="#MHSEdit<?= $mhs['id_mhs']; ?>">Edit</button>
                                                <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                                    href="<?= base_url(); ?>admin/hapusMHS/<?= $mhs['id_mhs']; ?>"
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
<div class="modal fade" id="MHSBaru" tabindex="-1" aria-labelledby="MHSBaruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="MHSBaruLabel">Input Mahasiswa Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/dataMHS'); ?>">
                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col">
                            <div class="form-group">
                                <label for="formGroupExampleInput">NPM</label>
                                <input type="text" class="form-control" id="npm" name="npm"
                                    value="<?= set_value('npm'); ?>" placeholder="">
                                <?= form_error('npm', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?= set_value('nama'); ?>" placeholder="">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
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
                        </div>
                        <div class="col">
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
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama Orang Tua</label>
                                <input type="text" class="form-control" id="ortu" name="ortu"
                                    value="<?= set_value('ortu'); ?>" placeholder="">
                                <?= form_error('ortu', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">No. HP Orang Tua</label>
                                <input type="text" class="form-control" id="no_ortu" name="no_ortu"
                                    value="<?= set_value('no_ortu'); ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Jurusan</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="jurusan">
                                    <?php foreach($jurusan as $jur) : ?>
                                    <option value="<?= $jur['jurusan']; ?>"><?= $jur['jurusan']; ?>
                                        <?php if($jur['jenjang'] == 'Sarjana') {
											echo '(S1)';
										} else if($jur['jenjang'] == 'Diploma') {
		                                    echo '(D3)';
	                                    } else if($jur['jenjang'] == 'Magister') {
		                                    echo '(S2)';
	                                    } else if($jur['jenjang'] == 'Doktor') {
		                                    echo '(S3)';
										}
									?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
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
	function ubahformatTgl6($tanggal) {
		$pisah = explode('-',$tanggal);		
		$urutan = array($pisah[2],$pisah[1],$pisah[0]);
		$satukan = implode('/',$urutan);
		return $satukan;
	}
	$no = 0;
	foreach($mahasiswa as $mhs) : 
	$no++; 
?>
<div class="modal fade" id="MHSEdit<?= $mhs['id_mhs']; ?>" tabindex="-1" aria-labelledby="MHSEditLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="MHSEditLabel">Edit Data Mahasiswa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('admin/editMHS'); ?>">
                    <div class="row mx-auto">
                        <div class="col">
                            <input type="hidden" name="id" value="<?= $mhs['id_mhs']; ?>">
                            <div class="form-group">
                                <label for="formGroupExampleInput">NPM</label>
                                <input type="text" class="form-control" id="npm" name="npm" value="<?= $mhs['npm']; ?>"
                                    placeholder="">
                                <?= form_error('npm', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?= $mhs['nama_mhs']; ?>" placeholder="">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nomor Handphone</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="<?= $mhs['no_hp']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="<?= $mhs['email']; ?>" placeholder="">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
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
                                    value="<?= $mhs['tmp_lahir']; ?>" placeholder="">
                                <?= form_error('tmp_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <?php
									$tgl_lahir = $mhs['tgl_lahir'];
									$lahir = ubahformatTgl6($tgl_lahir)
								?>
                                <label for="formGroupExampleInput">Tanggal Lahir (dd/mm/yyyy)</label>
                                <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                    value="<?= $lahir ?>" placeholder="dd/mm/yyyy">
                                <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="<?= $mhs['alamat']; ?>" placeholder="">
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Agama</label>
                                <input type="text" class="form-control" id="agama" name="agama"
                                    value="<?= $mhs['agama']; ?>" placeholder="">
                                <?= form_error('agama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nama Orang Tua</label>
                                <input type="text" class="form-control" id="ortu" name="ortu"
                                    value="<?= $mhs['ortu']; ?>" placeholder="">
                                <?= form_error('ortu', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">No. HP Orang Tua</label>
                                <input type="text" class="form-control" id="no_ortu" name="no_ortu"
                                    value="<?= $mhs['no_ortu']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Jurusan</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="jurusan">
                                    <?php foreach($jurusan as $jur) : ?>
                                    <option value="<?= $jur['jurusan']; ?>"><?= $jur['jurusan']; ?>
                                        <?php if($jur['jenjang'] == 'Sarjana') {
											echo '(S1)';
										} else if($jur['jenjang'] == 'Diploma') {
		                                    echo '(D3)';
	                                    } else if($jur['jenjang'] == 'Magister') {
		                                    echo '(S2)';
	                                    } else if($jur['jenjang'] == 'Doktor') {
		                                    echo '(S3)';
										}
									?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
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