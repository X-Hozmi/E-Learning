<?php 
	class M_User extends CI_Model {

		public function __construct() {
			parent::__construct();
			$this->load->model('M_Auth');
		}

		public function getAllUser() {
			return $this->db->get('user')->result_array();
		}

		public function getID($id) {
			return $this->db->get_where('user', ['id_user' => $id]);
		}

		public function totalUser() {
			return $this->db->get('user')->num_rows();
		}

		public function update() {
			$id = $this->input->post('id', true);
			$data = [
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'is_active' => $this->input->post('status'),
				'id_role' => $this->input->post('level'),
			];
			$this->db->where('id_user', $id);
			$this->db->update('user', $data);
		}

		public function delete($id) {
			$this->db->where('id_user', $id);
    		$this->db->delete('user');
    	}

		public function getAllRole() {
			return $this->db->get('user_role')->result_array();
		}

		public function getIDRole($id_role) {
			return $this->db->get_where('user_role', ['id' => $id_role])->row_array();
		}

		public function totalRole() {
			return $this->db->get('user_role')->num_rows();
		}

		public function createRole() {
			$data = [
				'role' => $this->input->post('role')
			];
			$this->db->insert('user_role', $data);
		}

		public function updateRole() {
			$id = $this->input->post('id', true);
			$data = [
				'role' => $this->input->post('role')
			];
			$this->db->where('id', $id);
			$this->db->update('user_role', $data);
		}

		public function ubahRoleAkses() {
			// Mengambil data post dari ajax
			$id_menu = $this->input->post('IDmenu');
			$id_role = $this->input->post('IDrole');
			$data = [
				'id_menu' => $id_menu,
				'id_role' => $id_role
			];

			// Mencocokan data dengan kolom pada tabel menu_akses
			$result = $this->db->get_where('menu_akses', $data);

			// Apabila result tidak ada isinya
			if($result->num_rows() < 1) {
				$this->db->insert('menu_akses', $data);
			} else {
				// Apabila result ada isinya
				$this->db->delete('menu_akses', $data);
			}
		}

		public function deleteRole($id) {
			$this->db->where('id', $id);
    		$this->db->delete('user_role');
    	}

		public function updateGambar() {
			$data['user'] = $this->M_Auth->ceksesi();
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');

				// Jika ada gambar yang diupload
				$upload_gambar = $_FILES['gambar']['name'];	

				if($upload_gambar) {
					// Syarat agar gambar bisa terupload
					$config['allowed_types']	= 'gif|jpg|png';
					$config['max_size'] 		= '10240'; // Satuan Kilobyte
					$config['upload_path']		= './assets/img/profile/'; // '.' adalah URL pada routes
					$this->load->library('upload', $config);
				
					if($this->upload->do_upload('gambar')) {
						// File gambar lama yang sudah pernah diupload user akan dihapus jika ganti foto profil lagi, kecuali default.jpg
						// Untuk menghindari pembengkakan penyimpanan
						$gambar_lama = $data['user']['gambar'];
						if($gambar_lama != 'default.jpg') {
							// FCPATH = Front Controller Path, sama seperti '.' di atas
							// Tanda '.' diantara parameter adalah concat, berfungsi sebagai penyambung
							unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
						}

						// Gambar yang diupload akan masuk penyimpanan dan merubah nilai data kolom 'gambar' pada tabel 'user'
						$gambar = $this->upload->data('file_name');
						$this->db->set('gambar', $gambar);
					} else {
						echo $this->upload->display_errors();
					}
				}

			$this->db->set('nama', $nama);
			$this->db->where('email', $email);
			$this->db->update('user');
		}


		public function updateProfile() {
			$email = $this->input->post('email');
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'email' => htmlspecialchars($this->input->post('email', true))
			];
			$where_data = ['email' => $email];
			$this->db->update('user', $data, $where_data);
		}

		public function updatePass() {
			$data['user'] = $this->M_Auth->ceksesi();
			$old_pass = $this->input->post('old_pass');
			$new_pass = $this->input->post('new_pass1');

			// Apabila password lama salah
			if(!password_verify($old_pass, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pass Lama Salah!</div>');
				redirect('user/ubahPass');
			} else if($old_pass == $new_pass) {
				// Apabila password lama = password baru
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pass Baru tidak boleh sama dengan Pass Lama!</div>');
					redirect('user/ubahPass');
			} else {
				// Apabila password OK
				$pass_hash = password_hash($new_pass, PASSWORD_DEFAULT);
				$this->db->set('password', $pass_hash);
				$this->db->where('email', $this->session->userdata('email'));
				$this->db->update('user');
			}
		}
	}