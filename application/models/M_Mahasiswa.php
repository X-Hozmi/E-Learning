<?php
class M_Mahasiswa extends CI_Model
{
	public function getAllMahasiswa()
	{
		return $this->db->get('mahasiswa')->result_array();
	}

	public function getID($id)
	{
		return $this->db->get_where('mahasiswa', ['id_mhs' => $id])->row_array();
	}

	public function totalMahasiswa()
	{
		return $this->db->get('mahasiswa')->num_rows();
	}

	public function sema()
	{
		// Sesi Mahasiswa
		return $this->db->get_where('mahasiswa', [
			'email' => $this->session->userdata('email')
		])->row_array();
	}

	public function studima()
	{
		// Studi mahasiswa berdasarkan mahasiswa yang login
		$stuma = $this->sema();
		$npm = $stuma['npm'] ?? '';
		$query = $this->db->query("SELECT *
						FROM hasilstudi JOIN mahasiswa
						ON hasilstudi.npm = mahasiswa.npm
						JOIN matkul ON matkul.kode_matkul = hasilstudi.kode_matkul
						WHERE mahasiswa.npm = '$npm'");
		return $query->result_array();
	}

	public function create()
	{

		function ubahformatTgl($tanggal)
		{
			// Karena format tanggal pada MySQL adalah yy-mm-dddd
			// Maka data input dari form harus dipecah dulu karena formatnya adalah dddd-mm-yy yang tidak cocok dengan MySQL
			// Explode berfungsi untuk memecah string dengan pemisah '/' menjadi data array
			$pisah = explode('/', $tanggal);
			// Disini, urutan tanggal disusun ulang menjadi yy-mm-dddd
			$urutan = array($pisah[2], $pisah[1], $pisah[0]);
			// Implode berfungsi untuk menyatukan string array yang dipecah sebelumnya oleh explode
			$satukan = implode('-', $urutan);
			return $satukan;
		}

		$tgl_lahir = $this->input->post('tgl_lahir');
		$lahir = ubahformatTgl($tgl_lahir);
		$data = [
			'npm' => $this->input->post('npm'),
			'nama_mhs' => htmlspecialchars($this->input->post('nama', true)),
			'no_hp' => $this->input->post('no_hp'),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'kelamin' => $this->input->post('kelamin'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $lahir,
			'alamat' => $this->input->post('alamat'),
			'agama' => $this->input->post('agama'),
			'ortu' => $this->input->post('ortu'),
			'no_ortu' => $this->input->post('no_ortu'),
			'gambar' => 'default.jpg',
			'jurusan' => $this->input->post('jurusan'),
		];
		$this->db->insert('mahasiswa', $data);

		$user = [
			'identity' => $this->input->post('npm'),
			'nama' => htmlspecialchars($this->input->post('nama', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'gambar' => 'default.jpg',
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'id_role' => 4,
			'is_active' => 1,
			'date_created' => time()
		];
		$this->db->insert('user', $user);
	}

	public function update()
	{

		function ubahformatTgl2($tanggal)
		{
			$pisah = explode('/', $tanggal);
			$urutan = array($pisah[2], $pisah[1], $pisah[0]);
			$satukan = implode('-', $urutan);
			return $satukan;
		}

		$id = $this->input->post('id', true);
		$tgl_lahir = $this->input->post('tgl_lahir');
		$lahir = ubahformatTgl2($tgl_lahir);

		$identity = $this->input->post('npm');
		$data_mahasiswa = [
			'npm' => $this->input->post('npm'),
			'nama_mhs' => htmlspecialchars($this->input->post('nama', true)),
			'no_hp' => $this->input->post('no_hp'),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'kelamin' => $this->input->post('kelamin'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $lahir,
			'alamat' => $this->input->post('alamat'),
			'agama' => $this->input->post('agama'),
			'ortu' => $this->input->post('ortu'),
			'no_ortu' => $this->input->post('no_ortu'),
			'jurusan' => $this->input->post('jurusan'),
		];
		$where_mahasiswa = ['id_mhs' => $id];
		$this->modul_update('mahasiswa', $data_mahasiswa, $where_mahasiswa);

		$data_user = [
			'nama' => htmlspecialchars($this->input->post('nama', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
		];
		$where_user = ['identity' => $identity];
		$this->modul_update('user', $data_user, $where_user);
	}

	public function delete($id)
	{
		$sql = $this->db->query("DELETE mahasiswa,user 
					FROM mahasiswa,user 
					WHERE mahasiswa.email=user.email
					AND mahasiswa.id_mhs = ?");
		$this->db->query($sql, array($id));
	}

	#jadi ceritanya, setiap proses create update delete, cukup main array aja, wis, coba jalanin, atau mau lu cek dulu?
	public function modul_insert($tabel, $data)
	{
		$this->db->insert($tabel, $data);
	}
	public function modul_update($tabel, $data, $where)
	{
		$this->db->update($tabel, $data, $where);
	}
	public function modul_delete($tabel, $where)
	{
		$this->db->delete($tabel, $where);
	}
}
