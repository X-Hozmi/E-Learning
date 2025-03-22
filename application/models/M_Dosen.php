<?php
class M_Dosen extends CI_Model
{
	public function getAllDosen()
	{
		return $this->db->get('dosen')->result_array();
	}

	public function getID($id)
	{
		return $this->db->get_where('dosen', ['id_dosen' => $id])->row_array();
	}

	public function totalDosen()
	{
		return $this->db->get('dosen')->num_rows();
	}

	public function sedo()
	{
		// Sesi Dosen
		return $this->db->get_where('dosen', [
			'email' => $this->session->userdata('email')
		])->row_array();
	}

	public function studidos()
	{
		// Input studi mahasiswa berdasarkan matkul dosen yang login
		$studos = $this->M_Dosen->sedo();
		$kode = $studos['kode_dosen'] ?? '';
		$query = "SELECT *
							FROM matkul JOIN dosen
							ON matkul.kode_dosen = dosen.kode_dosen
							WHERE dosen.kode_dosen = '$kode'";
		return $this->db->query($query)->result_array();
	}

	public function create()
	{

		function ubahformatTgl($tanggal)
		{
			// Karena format tanggal pada MySQL adalah yyyy-mm-dd
			// Maka data input dari form harus dipecah dulu karena formatnya adalah dd-mm-yyyy yang tidak cocok dengan MySQL
			// Explode berfungsi untuk memecah string dengan pemisah '/' menjadi data array
			$pisah = explode('/', $tanggal);
			// Disini, urutan tanggal disusun ulang menjadi yyyy-mm-dd
			$urutan = array($pisah[2], $pisah[1], $pisah[0]);
			// Implode berfungsi untuk menyatukan string array yang dipecah sebelumnya oleh explode
			$satukan = implode('-', $urutan);
			return $satukan;
		}

		$tgl_lahir = $this->input->post('tgl_lahir');
		$lahir = ubahformatTgl($tgl_lahir);
		$data = [
			'nip' => $this->input->post('nip'),
			'nama_dosen' => htmlspecialchars($this->input->post('nama', true)),
			'kode_dosen' => $this->input->post('kode'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'kelamin' => $this->input->post('kelamin'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $lahir,
			'alamat' => $this->input->post('alamat'),
			'agama' => $this->input->post('agama'),
			'gambar' => 'default.jpg',
		];
		$this->db->insert('dosen', $data);
		$user = [
			'identity' => $this->input->post('nip'),
			'nama' => htmlspecialchars($this->input->post('nama', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'gambar' => 'default.jpg',
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'id_role' => 3,
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

		$identity = $this->input->post('nip');
		$data_dosen = [
			'nip' => $this->input->post('nip'),
			'nama_dosen' => htmlspecialchars($this->input->post('nama', true)),
			'kode_dosen' => $this->input->post('kode'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'kelamin' => $this->input->post('kelamin'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $lahir,
			'alamat' => $this->input->post('alamat'),
			'agama' => $this->input->post('agama'),
		];
		$where_dosen = ['id_dosen' => $id];
		$this->modul_update('dosen', $data_dosen, $where_dosen);

		$data_user = [
			'nama' => htmlspecialchars($this->input->post('nama', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
		];
		$where_user = ['identity' => $identity];
		$this->modul_update('user', $data_user, $where_user);
	}

	public function delete($id)
	{
		$sql = $this->db->query("DELETE dosen,user 
					FROM dosen,user 
					WHERE dosen.email=user.email
					AND dosen.id_dosen = ?");
		$this->db->query($sql, array($id));
	}

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
