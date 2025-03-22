<?php 
	class M_Jurusan extends CI_Model {
		public function getAllJurusan() {
			return $this->db->get('jurusan')->result_array();
		}

		public function totalJurusan() {
			return $this->db->get('jurusan')->num_rows();
		}

		public function create() {
			$data = [
				'jurusan' => $this->input->post('jurusan'),
				'jenjang' => $this->input->post('jenjang')
			];
			$this->db->insert('jurusan', $data);
		}

		public function update() {
			$id = $this->input->post('id', true);
			$data = [
				'jurusan' => $this->input->post('jurusan'),
				'jenjang' => $this->input->post('jenjang')
			];
			$this->db->where('id_jurusan', $id);
			$this->db->update('jurusan', $data);
		}

		public function delete($id) {
			$this->db->where('id_jurusan', $id);
    		$this->db->delete('jurusan');
    	}
	}
