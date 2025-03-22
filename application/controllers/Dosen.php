<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{

	public function __construct()
	{
		// Method ini akan berjalan di semua function (lebih praktis karena hanya perlu sekali memanggil saja)
		parent::__construct();
		apakah_login();
		$this->load->library('form_validation');
		$this->load->model('M_Auth');
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Dosen');
		$this->load->model('M_Jurusan');
		$this->load->model('M_Matkul');
		$this->load->model('M_Studi');
		$this->load->model('M_Berkas');
		$this->load->model('M_Absensi');
		$this->load->model('M_Quiz');
		date_default_timezone_set("Asia/Jakarta");
		// $data['user'] = $this->M_Auth->ceksesi();
	}

	public function index()
	{
		// Mengambil data dari sesi login user berdasarkan email
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'judul' => 'Siakad Dosen',
		];
		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('dosen/index', $data);
		$this->load->view('templates/session/footer');
	}

	public function studi()
	{
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'sedo' => $this->M_Dosen->sedo(),
			'studidos' => $this->M_Dosen->studidos(),
			'matkul' => $this->M_Matkul->getAllMatkul(),
			'jurusan' => $this->M_Jurusan->getAllJurusan(),
			'mahasiswa' => $this->M_Mahasiswa->getAllMahasiswa(),
			'dosen' => $this->M_Dosen->getAllDosen(),
			'hasil' => $this->M_Studi->getAllStudi(),
			'judul' => 'Hasil Studi',
		];

		$this->form_validation->set_rules('kehadiran', 'Kehadiran', 'required|trim');
		$this->form_validation->set_rules('uts', 'UTS', 'required|trim');
		$this->form_validation->set_rules('tugas', 'Tugas', 'required|trim');
		$this->form_validation->set_rules('uas', 'UAS', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('dosen/hasilstudi', $data);
			$this->load->view('templates/session/footer');
		} else {
			$this->M_Studi->create();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Laporan studi berhasil diinput!</div>');
			redirect('dosen/studi');
		}
	}

	public function editStudi()
	{
		$this->form_validation->set_rules('kehadiran', 'Kehadiran', 'required|trim');
		$this->form_validation->set_rules('uts', 'UTS', 'required|trim');
		$this->form_validation->set_rules('tugas', 'Tugas', 'required|trim');
		$this->form_validation->set_rules('uas', 'UAS', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'sedo' => $this->M_Dosen->sedo(),
				'studidos' => $this->M_Dosen->studidos(),
				'matkul' => $this->M_Matkul->getAllMatkul(),
				'jurusan' => $this->M_Jurusan->getAllJurusan(),
				'mahasiswa' => $this->M_Mahasiswa->getAllMahasiswa(),
				'dosen' => $this->M_Dosen->getAllDosen(),
				'hasil' => $this->M_Studi->getAllStudi(),
				'judul' => 'Hasil Studi',
			];
			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('dosen/hasilstudi', $data);
			$this->load->view('templates/session/footer');
		} else {
			$this->M_Studi->update();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Laporan studi berhasil diubah!</div>');
			redirect('dosen/studi');
		}
	}

	public function hapusStudi($id)
	{
		$this->M_Studi->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dihapus!</div>');
		redirect('dosen/studi');
	}

	public function absen()
	{
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'kehadiran' => $this->M_Mahasiswa->getAllMahasiswa(),
			'jurusan' => $this->M_Jurusan->getAllJurusan(),
			'sedo' => $this->M_Dosen->sedo(),
			'jurusan' => $this->M_Jurusan->getAllJurusan(),
			'judul' => 'Kehadiran Mahasiswa'
		];
		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('dosen/absen', $data);
		$this->load->view('templates/session/footer');
	}

	public function formabsen()
	{
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'kehadiran' => $this->M_Mahasiswa->getAllMahasiswa(),
			'jurusan' => $this->M_Jurusan->getAllJurusan(),
			// 'absensi' => $this->M_Absensi->getAllAbsensi(),
			'sedo' => $this->M_Dosen->sedo(),
			'jurusan' => $this->M_Jurusan->getAllJurusan(),
			'judul' => 'Kehadiran Mahasiswa'
		];
		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('dosen/formabsen', $data);
		$this->load->view('templates/session/footer');

		// $this->M_Absensi->simpanAbsen();
		// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil absen</div>');
		// redirect('dosen/absen');
	}
	public function formrekap()
	{
		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'kehadiran' => $this->M_Mahasiswa->getAllMahasiswa(),
			'jurusan' => $this->M_Jurusan->getAllJurusan(),
			'absensi' => $this->M_Absensi->getAllAbsensi(),
			'sedo' => $this->M_Dosen->sedo(),
			'judul' => 'Rekap Kehadiran Mahasiswa'
		];
		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('dosen/formrekap', $data);
		$this->load->view('templates/session/footer');

		// $this->M_Absensi->simpanAbsen();
		// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil absen</div>');
		// redirect('dosen/absen');
	}


	public function rekappdf()
	{

		$data = [
			'user' => $this->M_Auth->ceksesi(),
			'kehadiran' => $this->M_Mahasiswa->getAllMahasiswa(),
			'jurusan' => $this->M_Jurusan->getAllJurusan(),
			'absensi' => $this->M_Absensi->getAllAbsensi(),
			'sedo' => $this->M_Dosen->sedo(),
			'judul' => 'Rekap Kehadiran Mahasiswa'
		];
		// $this->load->view('templates/session/header', $data);
		// $this->load->view('templates/session/sidebar', $data);
		// $this->load->view('templates/session/topbar', $data);
		$this->load->view('dosen/rekappdf', $data);
		$this->load->library('dompdf_gen');
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("rekapabsensi.pdf", array('Attachment' => 0));
		// $this->load->view('templates/session/footer');
	}

	public function editrekap()
	{
		$npm 			= $this->input->get('npm');
		$jurusan 		= $this->input->get('jurusan');

		$query			= $this->db->get_where('absensi', ['npm' => $npm, 'jurusan' => $jurusan])->row_array();

		$data = [
			'user' 			=> $this->M_Auth->ceksesi(),
			'sedo' 			=> $this->M_Dosen->sedo(),
			'jadwal' 		=> $query['jadwal'],
			'keterangan' 	=> $query['keterangan'],
			'jurusan' 		=> $query['jurusan'],
			'npm' 			=> $query['npm'],
			'judul' 		=> 'Ubah Rekap Kehadiran Mahasiswa'
		];

		$this->load->view('templates/session/header', $data);
		$this->load->view('templates/session/sidebar', $data);
		$this->load->view('templates/session/topbar', $data);
		$this->load->view('dosen/editrekap', $data);
		$this->load->view('templates/session/footer');

		// $this->M_Absensi->simpanAbsen();
		// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil absen</div>');
		// redirect('dosen/absen');
	}

	public function simpanRekap()
	{
		$npm 			= $this->input->get('npm');
		$jurusan 		= $this->input->get('jurusan');
		$where			= ['npm' => $npm, 'jurusan' => $jurusan];
		$query			= $this->db->get_where('absensi', ['npm' => $npm, 'jurusan' => $jurusan])->row_array();

		$id_post 		= 'ket' . $query['id_absen'];
		$ket 			= $_POST[$id_post];
		$data 			= [
			'jadwal' 		=> $query['jadwal'],
			'keterangan' 	=> $ket,
			'jurusan' 		=> $query['jurusan'],
			'npm' 			=> $npm
		];
		$update	= $this->db->update('absensi', $data, $where);

		if ($update) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Presensi berhasil diubah</div>');
			redirect('dosen/absen');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Presensi gagal diubah</div>');
			redirect('dosen/absen');
		}
	}

	public function simpanAbsen()
	{
		$jurusan 	= $this->input->post('jurusan');
		$query		= $this->db->query("SELECT * FROM mahasiswa
										WHERE jurusan = '$jurusan'")->result_array();

		foreach ($query as $q) {
			$npm		= $q["npm"];
			$id_post 	= 'ket' . $npm;
			$ket 		= $_POST[$id_post];
			$data 		= [
				'jadwal' 		=> date('Y-m-d'),
				'keterangan' 	=> $ket,
				'jurusan' 		=> $q['jurusan'],
				'npm' 			=> $npm
			];
			$insert	= $this->db->insert('absensi', $data);
		}

		if ($insert) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Presensi berhasil</div>');
			redirect('dosen/absen');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Presensi gagal</div>');
			redirect('dosen/absen');
		}
	}

	public function quiz()
	{
		$this->form_validation->set_rules('judul_quiz', 'Nama Dokumen', 'required|trim');
		$this->form_validation->set_rules('deskripsi', 'Judul Dokumen', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'quiz' => $this->M_Quiz->getAllQuiz(),
				'sedo' => $this->M_Dosen->sedo(),
				'studidos' => $this->M_Dosen->studidos(),
				'matkul' => $this->M_Matkul->getAllMatkul(),
				'jurusan' => $this->M_Jurusan->getAllJurusan(),
				'mahasiswa' => $this->M_Mahasiswa->getAllMahasiswa(),
				'dosen' => $this->M_Dosen->getAllDosen(),
				'judul' => 'Daftar Quiz'
			];

			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('dosen/quiz', $data);
			$this->load->view('templates/session/footer');
		} else {
			$this->M_Quiz->insert();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Quiz</div>');
			redirect('dosen/quiz');
		}
	}

	public function hapusQuiz($id)
	{
		$this->M_Quiz->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dokumen dihapus!</div>');
		redirect('dosen/quiz');
	}

	public function dokumen()
	{
		$this->form_validation->set_rules('nama_doc', 'Nama Dokumen', 'required|trim');
		$this->form_validation->set_rules('title_doc', 'Judul Dokumen', 'required|trim');
		$this->form_validation->set_rules('kode_doc', 'Kode Dokumen', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'dokumen' => $this->M_Berkas->getAllDokumen(),
				'sedo' => $this->M_Dosen->sedo(),
				'studidos' => $this->M_Dosen->studidos(),
				'matkul' => $this->M_Matkul->getAllMatkul(),
				'jurusan' => $this->M_Jurusan->getAllJurusan(),
				'mahasiswa' => $this->M_Mahasiswa->getAllMahasiswa(),
				'dosen' => $this->M_Dosen->getAllDosen(),
				'tipe' => ['1', '2', '3'],
				'judul' => 'Dokumen Ajar',
			];
			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('dosen/dokumen', $data);
			$this->load->view('templates/session/footer');
		} else {
			$this->M_Berkas->insert();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil upload file!</div>');
			redirect('dosen/dokumen');
		}
	}

	public function editDokumen()
	{
		$this->form_validation->set_rules('nama_doc', 'Nama Dokumen', 'required|trim');
		$this->form_validation->set_rules('title_doc', 'Judul Dokumen', 'required|trim');
		$this->form_validation->set_rules('kode_doc', 'Kode Dokumen', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data = [
				'user' => $this->M_Auth->ceksesi(),
				'dokumen' => $this->M_Berkas->getAllDokumen(),
				'sedo' => $this->M_Dosen->sedo(),
				'studidos' => $this->M_Dosen->studidos(),
				'matkul' => $this->M_Matkul->getAllMatkul(),
				'jurusan' => $this->M_Jurusan->getAllJurusan(),
				'mahasiswa' => $this->M_Mahasiswa->getAllMahasiswa(),
				'dosen' => $this->M_Dosen->getAllDosen(),
				'tipe' => ['1', '2', '3'],
				'judul' => 'Dokumen Ajar',
			];
			$this->load->view('templates/session/header', $data);
			$this->load->view('templates/session/sidebar', $data);
			$this->load->view('templates/session/topbar', $data);
			$this->load->view('dosen/dokumen', $data);
			$this->load->view('templates/session/footer');
		} else {
			$this->M_Berkas->update();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dokumen berhasil dipudate!</div>');
			redirect('dosen/dokumen');
		}
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
		redirect('dosen/dokumen');
	}
}
