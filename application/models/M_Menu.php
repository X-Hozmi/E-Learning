<?php 
	class M_Menu extends CI_Model {
		public function getAllMenu() {
			return $this->db->get('menu')->result_array();
		}
		
		public function getAllexAdmin() {
			// ID Admin disembunyikan agar tidak terjadi kesalahan fatal saat mengubah hak akses menu
			$this->db->where('id_menu !=', 1);
			return $this->db->get('menu')->result_array();
		}

		public function getAllSub() {
			return $this->db->get('menu_sub')->result_array();
		}

		public function getAllShort() {
			return $this->db->get('menu_short')->result_array();
		}

		public function totalMenu() {
			return $this->db->get('menu')->num_rows();
		}
		
		public function createMenu() {
			return $this->db->insert('menu', [
				'menu' => $this->input->post('menu')
			]);
		}

		public function updateMenu() {
			$id = $this->input->post('id');
			$data = ['menu' => $this->input->post('menu')];
			$this->db->where('id_menu', $id);
			$this->db->update('menu', $data);
		}

		public function deleteMenu($id) {
			$this->db->where('id_menu', $id);
    		$this->db->delete('menu');
    	}
		
		public function createSub() {
			$data = [
				'nama_sub' => $this->input->post('nama_sub'),
				'id_menu' => $this->input->post('id_menu'),
				'url' => $this->input->post('url'),
				'ikon' => $this->input->post('ikon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('menu_sub', $data);
		}

		public function updateSub() {
			$id = $this->input->post('id', true);
			$data = [
				'nama_sub' => $this->input->post('nama_sub'),
				'id_menu' => $this->input->post('id_menu'),
				'url' => $this->input->post('url'),
				'ikon' => $this->input->post('ikon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->where('id_submenu', $id);
			$this->db->update('menu_sub', $data);
		}
		
		public function deleteSub($id) {
			$this->db->where('id_submenu', $id);
    		$this->db->delete('menu_sub');
    	}

		public function createShort() {
			$data = [
				'nama_short' => $this->input->post('nama_short'),
				'nama_tabel' => $this->input->post('nama_tabel'),
				'url' => $this->input->post('url'),
				'card_class' => $this->input->post('card_class'),
				'text_upper' => $this->input->post('text_upper'),
				'text_count' => $this->input->post('text_count'),
				'ikon_class' => $this->input->post('ikon')
			];
			$this->db->insert('menu_short', $data);
		}

		public function updateShort() {
			$id = $this->input->post('id', true);
			$data = [
				'nama_short' => $this->input->post('nama_short'),
				'nama_tabel' => $this->input->post('nama_tabel'),
				'url' => $this->input->post('url'),
				'card_class' => $this->input->post('card_class'),
				'text_upper' => $this->input->post('text_upper'),
				'text_count' => $this->input->post('text_count'),
				'ikon_class' => $this->input->post('ikon')
			];
			$this->db->where('id_short', $id);
			$this->db->update('menu_short', $data);
		}

		public function deleteShort($id) {
			$this->db->where('id_short', $id);
    		$this->db->delete('menu_short');
    	}
	}