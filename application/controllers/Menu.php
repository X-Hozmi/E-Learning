<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Menu extends CI_Controller {

		public function __construct() {
			// Method ini akan berjalan di semua function (lebih praktis karena hanya perlu sekali memanggil saja)
			parent::__construct();
			apakah_login();
			$this->load->library('form_validation');
			$this->load->model('M_Auth');
			$this->load->model('M_Menu');
		}

		public function index() {
			// Mengambil data dari sesi login user berdasarkan email, proses ada pada M_Auth.php
			$data['user'] = $this->M_Auth->ceksesi();

			// Menampilkan daftar menu
			$data['menu'] = $this->M_Menu->getAllMenu();

			// Form validasi untuk membuat menu baru
			$this->form_validation->set_rules('menu', 'Menu', 'required', [
				'required' => 'Form harus diisi!'
			]);

			// Kondisi ini dibuat untuk menjalakan perintah: menambahkan menu baru
			// Apabila form_validation tidak/belum dijalankan, maka akan menampilkan menu menu.php
			if($this->form_validation->run() == false) {
				$data['judul'] = 'Menu Management';
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('menu/index', $data);
				$this->load->view('templates/session/footer');
			} else {
				// Apabila form_validation dijalakan dan sukses, maka data menu baru akan diinput ke tabel 'menu' di kolom 'menu'
				$this->M_Menu->createMenu();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil ditambahkan!</div>');
					redirect('menu');
			}
		}

		public function editmenu() {
			$this->M_Menu->updateMenu();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berubah!</div>');
				redirect('menu');
		}

		public function hapusmenu($id) {
			$this->M_Menu->deleteMenu($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dihapus!</div>');
				redirect('menu');
		}

		public function submenu() {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'menu' => $this->M_Menu->getAllMenu(),
				'submenu' => $this->M_Menu->getAllSub(),
				'judul' => 'Submenu Management'
			];

			$this->form_validation->set_rules('nama_sub', 'Submenu', 'required', [
				'required' => 'Form harus diisi!'
			]);
			$this->form_validation->set_rules('url', 'URL', 'required', [
				'required' => 'URL tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('ikon', 'Ikon', 'required', [
				'required' => 'Ikon harus diisi!'
			]);

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('menu/submenu', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Menu->createSub();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil ditambahkan!</div>');
					redirect('menu/submenu');
			}
		}

		public function editsub() {
			$this->form_validation->set_rules('nama_sub', 'Submenu', 'required|trim', [
				'required' => 'Nama harus diisi!'
			]);
			$this->form_validation->set_rules('url', 'URL', 'required|trim', [
				'required' => 'URL tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('ikon', 'Ikon', 'required|trim', [
				'required' => 'Ikon harus diisi!'
			]);
			
			if ($this->form_validation->run() == false) {
				$data = [
					'user' => $this->M_Auth->ceksesi(),
					'submenu' => $this->M_Menu->getAllSub(),
					'judul' => 'Submenu Management'
				];
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('menu/submenu', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Menu->updateSub();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berubah!</div>');
					redirect('menu/submenu');
			}
		}

		public function hapusSub($id) {
			$this->M_Menu->deleteSub($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dihapus!</div>');
				redirect('menu/submenu');
		}

		public function short() {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'short' => $this->M_Menu->getAllShort(),
				'judul' => 'Shortcut Management'
			];

			$this->form_validation->set_rules('nama_short', 'Shortcut', 'required|trim', [
				'required' => 'Nama shortcut harus diisi!'
			]);
			$this->form_validation->set_rules('nama_tabel', 'Nama Tabel', 'required|trim', [
				'required' => 'Nama tabel harus diisi!'
			]);
			$this->form_validation->set_rules('url', 'URL', 'required|trim', [
				'required' => 'URL tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('card_class', 'Card', 'required|trim', [
				'required' => 'Card harus diisi!'
			]);
			$this->form_validation->set_rules('text_upper', 'Text Upper', 'required|trim', [
				'required' => 'Text Upper harus diisi!'
			]);
			$this->form_validation->set_rules('text_count', 'Text Count', 'required|trim', [
				'required' => 'Text Count harus diisi!'
			]);
			$this->form_validation->set_rules('ikon', 'Ikon', 'required|trim', [
				'required' => 'Ikon harus diisi!'
			]);

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('menu/short', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Menu->createShort();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Shortcut berhasil ditambahkan!</div>');
					redirect('menu/short');
			}
		}

		public function editshort() {
			$this->form_validation->set_rules('nama_short', 'Shortcut', 'required|trim', [
				'required' => 'Nama shortcut harus diisi!'
			]);
			$this->form_validation->set_rules('nama_tabel', 'Nama Tabel', 'required|trim', [
				'required' => 'Nama tabel harus diisi!'
			]);
			$this->form_validation->set_rules('url', 'URL', 'required|trim', [
				'required' => 'URL tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('card_class', 'Card', 'required|trim', [
				'required' => 'Card harus diisi!'
			]);
			$this->form_validation->set_rules('text_upper', 'Text Upper', 'required|trim', [
				'required' => 'Text Upper harus diisi!'
			]);
			$this->form_validation->set_rules('text_count', 'Text Count', 'required|trim', [
				'required' => 'Text Count harus diisi!'
			]);
			$this->form_validation->set_rules('ikon', 'Ikon', 'required|trim', [
				'required' => 'Ikon harus diisi!'
			]);

			if ($this->form_validation->run() == false) {
				$data = [
					'user' => $this->M_Auth->ceksesi(),
					'short' => $this->M_Menu->getAllShort(),
					'judul' => 'Shortcut Management'
				];
				$this->load->view('templates/session/header', $data);
				$this->load->view('templates/session/sidebar', $data);
				$this->load->view('templates/session/topbar', $data);
				$this->load->view('menu/short', $data);
				$this->load->view('templates/session/footer');
			} else {
				$this->M_Menu->updateShort();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berubah!</div>');
					redirect('menu/short');
			}
		}

		public function hapusShort($id) {
			$this->M_Menu->deleteShort($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dihapus!</div>');
				redirect('menu/short');
		}
	}
