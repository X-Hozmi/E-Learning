<?php
class M_Absensi extends CI_Model
{
	public function __construct()
	{
		// Method ini akan berjalan di semua function (lebih praktis karena hanya perlu sekali memanggil saja)
		parent::__construct();
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Dosen');
		$this->load->model('M_Jurusan');
	}

	public function getAllAbsensi()
	{
		return $this->db->get('absensi')->result_array();
	}

	public function simpanAbsen()
	{
		$data['absensi'] = $this->getAllAbsensi();
		$data = [
			'keterangan' => $this->input->post('keterangan'),
			'jadwal' => $this->input->post('jadwal'),
			'id_jurusan' => $this->input->post('id_jurusan'),
			'npm' => $this->input->post('npm')
		];
		$this->db->insert('absensi', $data);
	}
}
