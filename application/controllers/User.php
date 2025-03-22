<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class User extends CI_Controller {

		public function __construct() {
			// Method ini akan berjalan di semua function (lebih praktis karena hanya perlu sekali memanggil saja)
			parent::__construct();
			apakah_login();
			$this->load->library('form_validation');
			$this->load->model('M_Auth');
			$this->load->model('M_User');
		}

		public function index() {
			// Mengambil data dari sesi login user berdasarkan email
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'judul' => 'Profil Saya'
			];
			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/session/footer');
		}

		public function editGambar() {
			$this->M_User->updateGambar();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gambar berhasil diganti!</div>');
			redirect('user');
		}

		public function editProfil() {
			// Mengambil data dari sesi login user berdasarkan email
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'judul' => 'Profil Saya'
			];

			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong!']);

			if($this->form_validation->run() == false) {
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('user/index', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_User->updateProfile();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil berhasil diupdate!</div>');
				redirect('user');
			}
		}

		public function ubahPass() {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'judul' => 'Profil Saya'
			];

			$this->form_validation->set_rules('old_pass', 'Password Lama', 'required|trim', ['required' => 'Pass Lama harus diisi!']);
			$this->form_validation->set_rules('new_pass1', 'Password Baru', 'required|trim|min_length[3]|matches[new_pass2]', [
				'required' => 'Pass Baru harus diisi!',
				'min_length' => 'Password terlalu pendek',
				'matches' => 'Password tidak sama dengan Konfirmasi!'
			]);
			$this->form_validation->set_rules('new_pass2', 'Konfirmasi Pass Baru', 'required|trim|matches[new_pass1]', [
				'required' => 'Pass Konfirmasi harus diisi!',
				'matches' => 'Konfirmasi tidak sama dengan Pass Baru!'
			]);

			if($this->form_validation->run() == false) {
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('user/index', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_User->updatePass();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diganti!</div>');
				redirect('user');
			}
		}

		public function info() {
			// Mengambil data dari sesi login user berdasarkan email
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'judul' => 'Info Website'
			];
			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('info/index', $data);
			$this->load->view('templates/session/footer');
		}
	}
