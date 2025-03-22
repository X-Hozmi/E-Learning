<?php
class M_Studi extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_Dosen');
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Matkul');
	}

	public function getAllStudi() {
		return $this->db->get('hasilstudi')->result_array();
	}

	public function getStudiForDosen() {
		// View hasil studi mahasiswa untuk dosen yang login dengan mata kuliah relevan
		$studos = $this->M_Dosen->sedo();
		$kode = $studos['kode_dosen'];
        $query = $this->db->query("SELECT *
					FROM hasilstudi JOIN matkul
					ON hasilstudi.kode_dosen = matkul.kode_dosen
					AND hasilstudi.kode_matkul = matkul.kode_matkul
					JOIN mahasiswa ON hasilstudi.npm = mahasiswa.npm
					WHERE matkul.kode_dosen = '$kode'");
		return $this->db->query($query)->result_array();
	}

	public function totalStudi() {
		return $this->db->get('hasilstudi')->num_rows();
	}

	public function create() {
		$nilai = [
			'kehadiran' => $this->input->post('kehadiran'),
			'uts' => $this->input->post('uts'),
			'tugas' => $this->input->post('tugas'),
			'uas' => $this->input->post('uas')
		];
		$kehadiran	= ($nilai['kehadiran'] / 14) * 0.1;
		$uts		= $nilai['uts'] * 0.3;
		$tugas		= $nilai['tugas'] * 0.2;
		$uas		= $nilai['uas'] * 0.4;
		$sum_nilai	= $kehadiran + $uts + $tugas + $uas;
		$average	= $sum_nilai;

		if($average <= 45.9) {
			$grade = 'E';
		} else if($average <= 55.9) {
			$grade = 'D';
		} else if($average <= 65.9) {
			$grade = 'C';
		} else if($average <= 79.9) {
			$grade = 'B';
		} else if($average <= 100) {
			$grade = 'A';
		}

		$data = [
			'kode_dosen' => $this->input->post('kode_dosen'),
			'kode_matkul' => $this->input->post('kode_matkul'),
			'npm' => $this->input->post('npm'),
			'kehadiran' => $this->input->post('kehadiran'),
			'uts' => $this->input->post('uts'),
			'tugas' => $this->input->post('tugas'),
			'uas' => $this->input->post('uas'),
			'average' => $average,
			'grade' => $grade
		];
		$this->db->insert('hasilstudi', $data);
	}

	public function update() {
		$nilai = [
			'kehadiran' => $this->input->post('kehadiran'),
			'uts' => $this->input->post('uts'),
			'tugas' => $this->input->post('tugas'),
			'uas' => $this->input->post('uas')
		];
		$kehadiran	= ($nilai['kehadiran'] / 14) * 0.1;
		$uts		= $nilai['uts'] * 0.3;
		$tugas		= $nilai['tugas'] * 0.2;
		$uas		= $nilai['uas'] * 0.4;
		$sum_nilai	= $kehadiran + $uts + $tugas + $uas;
		$average	= $sum_nilai;

		if($average <= 45.9) {
			$grade = 'E';
		} else if($average <= 55.9) {
			$grade = 'D';
		} else if($average <= 65.9) {
			$grade = 'C';
		} else if($average <= 79.9) {
			$grade = 'B';
		} else if($average <= 100) {
			$grade = 'A';
		}

		$id = $this->input->post('id', true);
		$data = [
			'kode_dosen' => $this->input->post('kode_dosen'),
			'kode_matkul' => $this->input->post('kode_matkul'),
			'npm' => $this->input->post('npm'),
			'kehadiran' => $this->input->post('kehadiran'),
			'uts' => $this->input->post('uts'),
			'tugas' => $this->input->post('tugas'),
			'uas' => $this->input->post('uas'),
			'average' => $average,
			'grade' => $grade
		];
		$this->db->where('id_studi', $id);
		$this->db->update('hasilstudi', $data);
	}

	public function delete($id) {
		$this->db->where('id_studi', $id);
		$this->db->delete('hasilstudi');
	}

	public function modul_insert($tabel, $data) {
		$this->db->insert($tabel, $data);
	}
	public function modul_update($tabel, $data, $where) {
		$this->db->update($tabel, $data, $where);
	}
	public function modul_delete($tabel, $where) {
		$this->db->delete($tabel, $where);
	}
}
