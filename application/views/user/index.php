        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

            <div class="row">
                <div class="col-lg-2">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 order-lg-2">
                    <div class="card shadow mb-4">
                        <div class="card-profile-image mt-4 text-center">
                            <img id="myImg" alt="<?= $user['gambar']; ?>" class="rounded-circle avatar"
                                style="font-size: 60px; height: 180px; width: 180px;"
                                src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>"></img>

                            <!-- The display -->
                            <div id="mydisplay" class="display">

                                <!-- The Close Button -->
                                <span class="close">&times;</span>

                                <!-- display Content (The Image) -->
                                <img class="display-content" id="img01">

                                <!-- display Caption (Image Text) -->
                                <div id="caption"></div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <h4 class="font-weight-bold text-gray-800"><?= $user['nama']; ?></h4>
                                        <?php
											if($this->session->userdata('id_role') == 1) {
												echo "<p class='m-0 font-weight-bold text-danger'>Administrator</p>";
											} else if($this->session->userdata('id_role') == 2) {
												echo "<p class='m-0 font-weight-bold text-info'>Member</p>";
											} else if($this->session->userdata('id_role') == 3) {
												echo "<p class='m-0 font-weight-bold text-primary'>Dosen</p>";
											} else if($this->session->userdata('id_role') == 4) {
												echo "<p class='m-0 font-weight-bold text-success'>Mahasiswa</p>";
											}
										?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <small>
                                            <p class="m-0 font-weight-bold text-info">Anggota Sejak
                                                <?= date('d F Y', $user['date_created']); ?></p>
                                        </small>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="card-profile-stats">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-profile-stats">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-profile-stats">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Gambar</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('user/editGambar'); ?>
                            <input type="hidden" name="nama" value="<?= $user['nama']; ?>">
                            <input type="hidden" name="email" value="<?= $user['email']; ?>">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="browse custom-file-input" id="gambar"
                                                name="gambar">
                                            <label class="custom-file-label" for="gambar">Pilih file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Ganti</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="ml-2 col-sm-6">
                                        <img id="preview" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="col-lg-8 order-lg-1">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Akun</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('user/editProfil'); ?>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label font-weight-bold text-gray-800"
                                                for="nama">Nama Lengkap<span class="small text-danger">*</span></label>
                                            <input type="text" id="nama" class="form-control" name="nama"
                                                placeholder="Nama" value="<?= $user['nama']; ?>">
                                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold text-gray-800"
                                                for="email">Alamat Email<span class="small text-danger">*</span></label>
                                            <input type="email" id="email" class="form-control" name="email"
                                                placeholder="example@example.com" value="<?= $user['email']; ?>"
                                                readonly>
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Password</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('user/ubahPass'); ?>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label font-weight-bold text-gray-800"
                                                for="old_pass">Password
                                                Sekarang</label>
                                            <input type="password" id="old_pass" class="form-control" name="old_pass"
                                                placeholder="Password Sekarang">
                                            <?= form_error('old_pass', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label font-weight-bold text-gray-800"
                                                for="new_pass1">Password Baru</label>
                                            <input type="password" id="new_pass1" class="form-control" name="new_pass1"
                                                placeholder="Password Baru">
                                            <?= form_error('new_pass1', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label font-weight-bold text-gray-800"
                                                for="new_pass2">Ulangi
                                                Password</label>
                                            <input type="password" id="new_pass2" class="form-control" name="new_pass2"
                                                placeholder="Ulangi Password">
                                            <?= form_error('new_pass2', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>






        <!-- End of Main Content
 -->
