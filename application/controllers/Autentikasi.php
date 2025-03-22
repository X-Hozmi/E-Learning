<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Autentikasi extends CI_Controller {

		public function __construct() {
			// Method ini akan berjalan di semua function (lebih praktis karena hanya perlu sekali memanggil saja)
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model('M_Auth');
		}

		public function index() {
			// User yang sedang login tidak akan bisa logout dengan mengetik manual URL logout
			if($this->session->userdata('email')) {
				redirect('user');
			}
			// Validasi dari form login dengan email dan password ('atribut', 'alias', 'syarat validasi')
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
				// Data array disini berfungsi mengubah pesan error default yang ada pada syarat validasi menjadi pesan error yang kita buat
				'required' => 'Email tidak boleh kosong!',
				'valid_email' => 'Email tidak valid!'
			]);
			$this->form_validation->set_rules('password', 'Password', 'required|trim', [
				'required' => 'Password tidak boleh kosong!'
			]);
			// Apabila form_validation tidak/belum dijalankan, maka akan menampilkan menu login.php
			if($this->form_validation->run() == false) {
				$data['judul'] = 'Login!';
				$this->load->view('templates/auth/header', $data);
				$this->load->view('autentikasi/login');
				$this->load->view('templates/auth/footer');
			} else {
				// Apabila form_validation dijalakan dan sukses, maka proses akan dilanjutkan ke method login() di M_Auth.php
				$this->M_Auth->login();
			}
		}

		public function verifikasi() {
			// Fungsi yang digunakan untuk verifikasi akun yang daftar sebelum bisa digunakan
			$this->M_Auth->verifikasi();
		}
		
		public function register() {
			// User yang sedang login tidak akan bisa logout dengan mengetik manual URL logout
			if($this->session->userdata('email')) {
				redirect('user');
			}
			// Validasi pendaftaran untuk user baru ('atribut', 'alias', 'syarat validasi')
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
				'valid_email' => 'Email tidak valid!',
				'is_unique' => 'Email sudah terdaftar!'
			]);
			$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
				'matches' => 'Password tidak sama!',
				'min_length' => 'Password terlalu pendek!'
			]);
			$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
			// Apabila form_validation tidak/belum dijalankan, maka akan menampilkan menu register.php
			if($this->form_validation->run() == false) {
				$data['judul'] = 'Registrasi!';
				$this->load->view('templates/auth/header', $data);
				$this->load->view('autentikasi/register');
				$this->load->view('templates/auth/footer');
			} else {
				// Apabila form_validation dijalankan dan sukses
				// Maka akan menjalankan method register() pada file M_Register.php
				$this->M_Auth->register();
				// Pesan peringatan berhasil yang akan muncul di login.php
				// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi berhasil, silahkan aktivasi akun anda terlebih dahulu!</div>');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi berhasil, silahkan login!</div>');
					redirect('autentikasi');
			}
		}

		public function logout() {
			// Membersihkan userdata yang login
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('id_role');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil logout!</div>');
			redirect('autentikasi');
		}

		public function blokir() {
			$this->load->view('blokir');
		}
	}