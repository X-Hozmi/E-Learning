<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends CI_Controller {

		public function __construct() {
			// Method ini akan berjalan di semua function (lebih praktis karena hanya perlu sekali memanggil saja)
			parent::__construct();
			apakah_login();
			$this->load->library('form_validation');
			$this->load->model('M_User');
			$this->load->model('M_Menu');
			$this->load->model('M_Auth');
			$this->load->model('M_Mahasiswa');
			$this->load->model('M_Dosen');
			$this->load->model('M_Matkul');
			$this->load->model('M_Jurusan');
		}
		
		public function index() {
			$data = [
				// Mengambil data dari sesi level login user berdasarkan email
				'user' => $this->M_Auth->ceksesi(),
				'matkul' => $this->M_Matkul->totalMatkul(),
				'jurusan' => $this->M_Jurusan->totalJurusan(),
				'mahasiswa' => $this->M_Mahasiswa->totalMahasiswa(),
				'dosen' => $this->M_Dosen->totalDosen(),
				'menu' => $this->M_Menu->totalMenu(),
				'short' => $this->M_Menu->getAllShort(),
				'judul' => 'Dashboard',
			];
			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('admin/index', $data);
			$this->load->view('templates/session/footer');
		}

		public function dataUser() {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'akun' => $this->M_User->getAllUser(),
				'status' => ['0', '1'],
				'level' => ['1', '2', '3', '4'],
				'judul' => 'Account',
			];
			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('admin/dataUser', $data);
			$this->load->view('templates/session/footer');
		}

		public function editUser() {
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
				'required' => 'Nama wajib diisi!'
			]);
			$this->form_validation->set_rules('email', 'Email', 'required|trim', [
				'required' => 'Email wajib diisi!'
			]);

			if($this->form_validation->run() == false) {
			$data = [
				'akun' => $this->M_User->getAllUser(),
				'user' => $this->M_Auth->ceksesi(),
				'judul' => 'Account'
			];
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataUser', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_User->update();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berubah!</div>');
					redirect('admin/dataUser');
			}	
		}

		public function hapusUser($id) {
			$this->M_User->delete($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dihapus!</div>');
				redirect('admin/dataUser');
		}

		public function dataMHS() {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'mahasiswa' => $this->M_Mahasiswa->getAllMahasiswa(),
				'jurusan' => $this->M_Jurusan->getAllJurusan(),
				'kelamin' => ['Laki-laki', 'Perempuan']
			];

			$this->form_validation->set_rules('npm', 'NPM', 'required|trim|is_unique[mahasiswa.npm]', [
				'is_unique' => 'NPM sudah terdaftar!',
				'required' => 'NPM wajib diisi!'
			]);
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama tidak boleh kosong!']);
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[mahasiswa.email]', [
				'required' => 'Email harus diisi!',
				'valid_email' => 'Email tidak valid!',
				'is_unique' => 'Email sudah terdaftar!'
			]);
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
				'required' => 'Email harus diisi!',
				'valid_email' => 'Email tidak valid!',
				'is_unique' => 'Email sudah terdaftar!'
			]);
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
				'required' => 'Password tidak boleh kosong!',
				'min_length' => 'Password terlalu pendek!'
			]);
			$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', ['required' => 'Tempat Lahir harus diisi!']);
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal Lahir harus diisi!']);
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi!']);
			$this->form_validation->set_rules('ortu', 'Ortu', 'required|trim', ['required' => 'Nama Orang Tua harus diisi!']);

			if($this->form_validation->run() == false) {
				$data['judul'] = 'Data Mahasiswa';
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataMHS', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Mahasiswa->create();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
					redirect('admin/dataMHS');
			}
		}

		public function editMHS() {
			$this->form_validation->set_rules('npm', 'NPM', 'required|trim', [
				'required' => 'NPM wajib diisi!'
			]);
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama tidak boleh kosong!']);
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
				'required' => 'Email harus diisi!',
				'valid_email' => 'Email tidak valid!',
			]);
			$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', ['required' => 'Tempat Lahir harus diisi!']);
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal Lahir harus diisi!']);
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi!']);
			$this->form_validation->set_rules('ortu', 'Ortu', 'required|trim', ['required' => 'Nama Orang Tua harus diisi!']);
			
			if($this->form_validation->run() == false) {
				$data = [ 
					'user' => $this->M_Auth->ceksesi(),
					'mahasiswa' => $this->M_Mahasiswa->getAllMahasiswa(),
					'jurusan' => $this->M_Jurusan->getAllJurusan(),
					'kelamin' => ['Laki-laki', 'Perempuan'],
					'judul' => 'Data Mahasiswa'
				];
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataMHS', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Mahasiswa->update();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berubah!</div>');
					redirect('admin/dataMHS');
			}
		}

		public function hapusMHS($id) {
			$this->M_Mahasiswa->delete($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
				redirect('admin/dataMHS');
		}

		public function dataDosen() {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'dosen' => $this->M_Dosen->getAllDosen(),
				'kelamin' => ['Laki-laki', 'Perempuan']
			];

			$this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[dosen.nip]', [
				'is_unique' => 'NIP sudah terdaftar!',
				'required' => 'NIP wajib diisi!'
			]);
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama tidak boleh kosong!']);
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[dosen.email]', [
				'required' => 'Email harus diisi!',
				'valid_email' => 'Email tidak valid!',
				'is_unique' => 'Email sudah terdaftar!'
			]);
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
				'required' => 'Email harus diisi!',
				'valid_email' => 'Email tidak valid!',
				'is_unique' => 'Email sudah terdaftar!'
			]);
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
				'required' => 'Password tidak boleh kosong!',
				'min_length' => 'Password terlalu pendek!'
			]);
			$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', ['required' => 'Tempat Lahir harus diisi!']);
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal Lahir harus diisi!']);
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi!']);

			if($this->form_validation->run() == false) {
				$data['judul'] = 'Data Dosen';
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataDosen', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Dosen->create();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
					redirect('admin/dataDosen');
			}
		}

		public function editDosen() {
			$this->form_validation->set_rules('nip', 'NIP', 'required|trim', [
				'required' => 'NIP wajib diisi!'
			]);
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama tidak boleh kosong!']);
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
				'required' => 'Email harus diisi!',
				'valid_email' => 'Email tidak valid!',
			]);
			$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', ['required' => 'Tempat Lahir harus diisi!']);
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal Lahir harus diisi!']);
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi!']);

			if($this->form_validation->run() == false) {
				$data = [
					'user' => $this->M_Auth->ceksesi(),
					'dosen' => $this->M_Dosen->getAllDosen(),
					'kelamin' => ['Laki-laki', 'Perempuan'],
					'judul' => 'Data Dosen'
				];
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataDosen', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Dosen->update();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berubah!</div>');
					redirect('admin/dataDosen');
			}
		}

		public function hapusDosen($id) {
			$this->M_Dosen->delete($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
				redirect('admin/dataDosen');
		}

		public function dataJurusan() {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'jurusan' => $this->M_Jurusan->getAllJurusan(),
				'judul' => 'Data Jurusan'
			];

			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim|is_unique[jurusan.jurusan]', [
				'is_unique' => 'Jurusan sudah terdaftar!',
				'required' => 'Jurusan wajib diisi!'
			]);
			$this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim', ['required' => 'Jenjang tidak boleh kosong!']);

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataJurusan', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Jurusan->create();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
					redirect('admin/dataJurusan');
			}
		}

		public function editJurusan() {

			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', [
				'required' => 'Jurusan wajib diisi!'
			]);
			$this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim', ['required' => 'Jenjang tidak boleh kosong!']);
			
			if($this->form_validation->run() == false) {
				$data = [
					'user' => $this->M_Auth->ceksesi(),
					'jurusan' => $this->M_Jurusan->getAllJurusan(),
					'judul' => 'Data Jurusan'
				];
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataJurusan', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Jurusan->update();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berubah!</div>');
					redirect('admin/dataJurusan');
			}
		}

		public function hapusJurusan($id) {
			$this->M_Jurusan->delete($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
				redirect('admin/dataJurusan');
		}

		public function dataMatkul() {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'matkul' => $this->M_Matkul->getAllMatkul(),
				//'matbydos' => $this->M_Matkul->matkulByDosen(),
				'dosen' => $this->M_Dosen->getAllDosen(),
				'judul' => 'Data Matkul',
			];

			$this->form_validation->set_rules('matkul', 'Matkul', 'required|trim|is_unique[matkul.matkul]', [
				'is_unique' => 'Matkul sudah terdaftar!',
				'required' => 'Matkul wajib diisi!'
			]);
			$this->form_validation->set_rules('kode', 'Kode Matkul', 'required|trim|is_unique[matkul.kode_matkul]', [
				'is_unique' => 'Kode Matkul sudah terdaftar!',
				'required' => 'Kode Matkul tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('kode_dosen', 'Kode Dosen', 'required|trim', [
				'required' => 'Kode dosen tidak boleh kosong!'
			]);

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataMatkul', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Matkul->create();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
					redirect('admin/dataMatkul');
			}
		}

		public function editMatkul() {
			$this->form_validation->set_rules('matkul', 'Matkul', 'required|trim', [
				'required' => 'Matkul wajib diisi!'
			]);
			$this->form_validation->set_rules('kode', 'Kode Matkul', 'required|trim', [
				'required' => 'Kode Matkul tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('kode_dosen', 'Kode Dosen', 'required|trim', [
				'required' => 'Kode dosen tidak boleh kosong!'
			]);

			if($this->form_validation->run() == false) {
				$data = [
					'user' => $this->M_Auth->ceksesi(),
					'matkul' => $this->M_Matkul->getAllMatkul(),
					'dosen' => $this->M_Dosen->getAllDosen(),
					'judul' => 'Data Matkul',
				];
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataMatkul', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Matkul->update();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berubah!</div>');
					redirect('admin/dataMatkul');
			}
		}

		public function hapusMatkul($id) {
			$this->M_Matkul->delete($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
				redirect('admin/dataMatkul');
		}

		public function dataRole() {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'role' => $this->M_User->getAllRole(),
				'judul' => 'Data Role',
			];

			$this->form_validation->set_rules('role', 'Role', 'required|trim', [
				'required' => 'Role wajib diisi!'
			]);

			if($this->form_validation->run() == false) {
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataRole', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_User->createRole();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berubah!</div>');
				redirect('admin/dataRole');
			}
		}

		public function dataRoleAkses($id_role) {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'role' => $this->M_User->getIDRole($id_role),
				'menu' => $this->M_Menu->getAllexAdmin(),
				'judul' => 'Akses Role',
			];

			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('admin/dataRoleAkses', $data);
			$this->load->view('templates/session/footer');
		}

		public function ubahRoleAkses() {
			// Function ini melanjutkan dari script ajax pada footer.php
			$hasil = $this->M_User->ubahRoleAkses();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses berubah!</div>');
		}

		public function editRole() {
			$this->form_validation->set_rules('role', 'Role', 'required|trim', [
				'required' => 'Role wajib diisi!'
			]);

			if($this->form_validation->run() == false) {
				$data = [
					'user' => $this->M_Auth->ceksesi(),
					'role' => $this->M_User->getAllRole(),
					'judul' => 'Data Role',
				];
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('admin/dataRole', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_User->updateRole();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berubah!</div>');
				redirect('admin/dataRole');
			}
		}

		public function hapusRole($id) {
			$this->M_User->deleteRole($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
				redirect('admin/dataRole');
		}
	}
	