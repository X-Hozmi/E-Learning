<?php 
	class M_Matkul extends CI_Model {
		
		public function getAllMatkul() {
			return $this->db->get('matkul')->result_array();
		}

		public function totalMatkul() {
			return $this->db->get('matkul')->num_rows();
		}

		public function infoMatkul() {
			return $this->db->query("SELECT *
										FROM matkul
										JOIN dosen
										ON matkul.kode_dosen = dosen.kode_dosen")->result_array();
		}

		/*public function matkulByDosen() {
			$data = $this->M_Matkul->getAllMatkul();
			$query = $this->db->query("SELECT *, dosen.kode_dosen, nama_dosen
						FROM matkul, dosen
						WHERE matkul.kode_dosen = dosen.kode_dosen")->result_array();
			$matkul = [$data, $query];
			return $matkul;
		}*/

		public function create() {
			$data = [
				'matkul' => $this->input->post('matkul'),
				'kode_matkul' => $this->input->post('kode'),
				'kode_dosen' => $this->input->post('kode_dosen')
			];
			$this->db->insert('matkul', $data);
		}

		public function update() {
			$id = $this->input->post('id', true);
			$data = [
				'matkul' => $this->input->post('matkul'),
				'kode_matkul' => $this->input->post('kode'),
				'kode_dosen' => $this->input->post('kode_dosen')
			];
			$this->db->where('id_matkul', $id);
			$this->db->update('matkul', $data);
		}

		public function delete($id) {
			$this->db->where('id_matkul', $id);
    		$this->db->delete('matkul');
    	}
	}