<?php
class M_Berkas extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Dosen');
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Matkul');
	}

	public function getAllDokumen()
	{
		return $this->db->get('dokumen')->result_array();
	}

	public function insert() {
		$data['dokumen'] = $this->getAllDokumen();
		$kode_doc = $this->input->post('kode_doc');
		$kode_dosen = $this->input->post('kode_dosen');

		// Jika ada berkas yang diupload
		$upload_berkas = $_FILES['berkas']['name'];	

		if($upload_berkas) {
			// Syarat agar berkas bisa terupload
			$config['allowed_types']	= 'docx|pptx|pdf|zip|rar|txt';
			$config['max_size'] 		= '1048576'; // Satuan Kilobyte
			$config['upload_path']		= './assets/dokumen/'; // '.' adalah URL pada routes
			$this->load->library('upload', $config);
				
			if($this->upload->do_upload('berkas')) {
				// File berkas lama yang sudah pernah diupload user akan dihapus jika ganti berkas yang sama
				// Untuk menghindari pembengkakan penyimpanan
				$berkas_lama = $data['dokumen']['berkas'];
				if($berkas_lama) {
					// FCPATH = Front Controller Path, sama seperti '.' di atas
					// Tanda '.' diantara parameter adalah concat, berfungsi sebagai penyambung
					unlink(FCPATH . 'assets/dokumen/' . $berkas_lama);
				}

				// berkas yang diupload akan masuk penyimpanan dan merubah nilai data kolom 'berkas' pada tabel 'dokumen'
				$file = [
					'size' => $this->upload->data('file_size'),
					'berkas' => $this->upload->data('file_name')
				];
				$this->db->set($file);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'nama_doc' => htmlspecialchars($this->input->post('nama_doc', true)),
			'title_doc' => $this->input->post('title_doc'),
			'kode_doc' => $kode_doc,
			'tipe_doc' => $this->input->post('tipe_doc'),
			'kode_matkul' => $this->input->post('kode_matkul'),
			'kode_dosen' => $kode_dosen,
			'komentar_doc' => $this->input->post('komentar_doc'),
			'date_created' => date('Y-m-d')
		];

		$array_kondisi = [
			'kode_doc' => $kode_doc,
			'kode_dosen' => $kode_dosen,
		];

		//$this->db->set($data);
		//$this->db->where($array_kondisi);
		$this->db->insert('dokumen', $data);
	}

	public function update() {
		$data['dokumen'] = $this->getAllDokumen();
		$kode_doc = $this->input->post('kode_doc');
		$kode_dosen = $this->input->post('kode_dosen');

		// Jika ada berkas yang diupload
		$upload_berkas = $_FILES['berkas']['name'];	

		if($upload_berkas) {
			// Syarat agar berkas bisa terupload
			$config['allowed_types']	= 'docx|pptx|pdf|zip|rar|txt';
			$config['max_size'] 		= '1048576'; // Satuan Kilobyte
			$config['upload_path']		= './assets/dokumen/'; // '.' adalah URL pada routes
			$this->load->library('upload', $config);
				
			if($this->upload->do_upload('berkas')) {
				// File berkas lama yang sudah pernah diupload user akan dihapus jika ganti berkas yang sama
				// Untuk menghindari pembengkakan penyimpanan
				$berkas_lama = $data['dokumen']['berkas'];
				if($berkas_lama) {
					// FCPATH = Front Controller Path, sama seperti '.' di atas
					// Tanda '.' diantara parameter adalah concat, berfungsi sebagai penyambung
					unlink(FCPATH . 'assets/dokumen/' . $berkas_lama);
				}

				// berkas yang diupload akan masuk penyimpanan dan merubah nilai data kolom 'berkas' pada tabel 'dokumen'
				$file = [
					'size' => $this->upload->data('file_size'),
					'berkas' => $this->upload->data('file_name')
				];
				$this->db->set($file);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'nama_doc' => htmlspecialchars($this->input->post('nama_doc', true)),
			'title_doc' => $this->input->post('title_doc'),
			'kode_doc' => $kode_doc,
			'tipe_doc' => $this->input->post('tipe_doc'),
			'kode_matkul' => $this->input->post('kode_matkul'),
			'kode_dosen' => $kode_dosen,
			'komentar_doc' => $this->input->post('komentar_doc')
		];
		
		$array_kondisi = [
			'id_doc' => $this->input->post('id', true),
			'kode_doc' => $kode_doc,
			'kode_dosen' => $kode_dosen,
		];

		$this->db->set($data);
		$this->db->where($array_kondisi);
		$this->db->update('dokumen');
	}

	public function delete($id) {
		$data = $this->db->get_where('dokumen',['id_doc'=>$id])->row();
		unlink('assets/dokumen/' . $data->berkas);
		$this->db->where('id_doc', $id);
		$this->db->delete('dokumen');
	}

	public function uploadTugas() {
		$data['dokumen'] = $this->getAllDokumen();
		$kode_doc = $this->input->post('kode_doc');
		$kode_dosen = $this->input->post('kode_dosen');
		$npm = $this->input->post('npm');

		// Jika ada berkas yang diupload
		$upload_berkas = $_FILES['berkas']['name'];	

		if($upload_berkas) {
			// Syarat agar berkas bisa terupload
			$config['allowed_types']	= 'docx|pptx|pdf|zip|rar|txt';
			$config['max_size'] 		= '1048576'; // Satuan Kilobyte
			$config['upload_path']		= './assets/dokumen/'; // '.' adalah URL pada routes
			$this->load->library('upload', $config);
				
			if($this->upload->do_upload('berkas')) {
				// File berkas lama yang sudah pernah diupload user akan dihapus jika ganti berkas yang sama
				// Untuk menghindari pembengkakan penyimpanan
				$berkas_lama = $data['dokumen']['berkas'];
				if($berkas_lama) {
					// FCPATH = Front Controller Path, sama seperti '.' di atas
					// Tanda '.' diantara parameter adalah concat, berfungsi sebagai penyambung
					unlink(FCPATH . 'assets/dokumen/' . $berkas_lama);
				}

				// berkas yang diupload akan masuk penyimpanan dan merubah nilai data kolom 'berkas' pada tabel 'dokumen'
				$file = [
					'size' => $this->upload->data('file_size'),
					'berkas' => $this->upload->data('file_name')
				];
				$this->db->set($file);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'nama_doc' => htmlspecialchars($this->input->post('nama_doc', true)),
			'title_doc' => $this->input->post('title_doc'),
			'kode_doc' => $kode_doc,
			'tipe_doc' => 3,
			'kode_matkul' => $this->input->post('kode_matkul'),
			'kode_dosen' => $kode_dosen,
			'npm' => $npm,
			'komentar_doc' => $this->input->post('komentar_doc'),
			'date_created' => date('Y-m-d')
		];

		$array_kondisi = [
			'kode_doc' => $kode_doc,
			'kode_dosen' => $kode_dosen,
		];

		//$this->db->set($data);
		//$this->db->where($array_kondisi);
		$this->db->insert('dokumen', $data);
	}

	public function autoDeleteDokumen() {
		$tenggat = 7;
		$query = "DELETE FROM dokumen
          			WHERE DATEDIFF(CURDATE(), date_created) > $tenggat
					AND tipe_doc ='2'";
		$hasil = $this->db->query($query);

		if($hasil) {
			$data = $this->db->get_where('dokumen',['tipe_doc' => 2])->row();
			unlink('assets/dokumen/' . $data->berkas);
		}
	}
}