<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

	public function __construct()
	{
		// Method ini akan berjalan di semua function (lebih praktis karena hanya perlu sekali memanggil saja)
		parent::__construct();
		apakah_login();
		$this->load->library('form_validation');
		$this->load->model('M_Auth');
		$this->load->model('M_Menu');
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Studi');
		$this->load->model('M_Jurusan');
		$this->load->model('M_Berkas');
		$this->load->model('M_Matkul');
		$this->load->model('M_Absensi');
		$this->load->model('M_Quiz');
	}

	public function index()
	{
		// Mengambil data dari sesi login user berdasarkan email
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'judul' => 'Siakad Mahasiswa'
		];
		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('mahasiswa/index', $data);
		$this->load->view('templates/session/footer');
	}

	public function studi()
	{
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'sema' => $this->M_Mahasiswa->sema(),
			'studima' => $this->M_Mahasiswa->studima(),
			'hasil' => $this->M_Studi->getAllStudi(),
			'judul' => 'Hasil Studi'
		];
		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('mahasiswa/hasilstudi', $data);
		$this->load->view('templates/session/footer');
	}

	public function dokumen()
	{
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'sema' => $this->M_Mahasiswa->sema(),
			'studima' => $this->M_Mahasiswa->studima(),
			'dokumen' => $this->M_Berkas->getAllDokumen(),
			'tipe' => ['1', '2', '3'],
			'judul' => 'Materi dan Tugas'
		];
		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('mahasiswa/dokumen', $data);
		$this->load->view('templates/session/footer');
	}

	public function uploadTugas()
	{
		$this->M_Berkas->uploadTugas();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Laporan tugas berhasil diupload!</div>');
		redirect('mahasiswa/dokumen');
	}

	public function downloadDokumen($id)
	{
		$data = $this->db->get_where('dokumen', ['id_doc' => $id])->row();
		force_download('assets/dokumen/' . $data->berkas, NULL);
	}

	public function hapusDokumen($id)
	{
		$this->M_Berkas->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dokumen dihapus!</div>');
		redirect('mahasiswa/dokumen');
	}

	public function absensi()
	{
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'judul' => 'Absensi',
			'matkul' => $this->M_Matkul->infoMatkul(),
			'sema' => $this->M_Mahasiswa->sema()
		];
		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('mahasiswa/absensi', $data);
		$this->load->view('templates/session/footer');
	}

	public function quiz()
	{
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'judul' => 'Pengisian Quiz',
			'sedo' => $this->M_Dosen->sedo(),
			'quiz' => $this->M_Quiz->getAllQuiz(),
			'sema' => $this->M_Mahasiswa->sema(),
			'studima' => $this->M_Mahasiswa->studima()
		];

		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('mahasiswa/quiz', $data);
		$this->load->view('templates/session/footer');
	}

	public function jawabQuiz()
	{
		$this->form_validation->set_rules('jawaban', 'Jawaban', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'judul' => 'Pengisian Quiz',
				'quiz' => $this->M_Quiz->getAllQuiz(),
				'sema' => $this->M_Mahasiswa->sema(),
				'studima' => $this->M_Mahasiswa->studima()
			];

			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('mahasiswa/quiz', $data);
			$this->load->view('templates/session/footer');
		} else {
			$this->M_Quiz->jawabQuiz();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jawaban Quiz</div>');
			redirect('mahasiswa/quiz');
		}
	}

	public function approveAbsensi()
	{

		$this->M_Absensi->approveAbsensi();
	}
}
