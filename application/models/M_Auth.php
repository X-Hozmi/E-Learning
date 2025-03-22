<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {
	public function register() {
		// Data yang masuk melalui form_validation akan diproses untuk dimasukkan ke dalam tabel 'user'
		$email = $this->input->post('email', true);
		$data = [
			'nama' => htmlspecialchars($this->input->post('nama', true)),
			'email' => htmlspecialchars($email),
			'gambar' => 'default.jpg',
			'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
			'id_role' => 2,
			'is_active' => 1,
			'date_created' => time()
		];

		// Random bytes berfungsi untuk men-generate cryptographically secure pseudo-random bytes
		// Base64 encode berfungsi menerjemahkan bytes yang terenkripsi
		// $token = base64_encode(random_bytes(32));
		// $user_token = [ 'email' => $email, 'token' => $token, 'date_created' => time()];
		
		$this->db->insert('user', $data);
		// $this->db->insert('user_token', $user_token);
		// Fungsi di-disable karena Google men-disable fitur SMTP mereka per tanggal 30 Mei 2022
		// $this->_sendEmail($token, 'verify');
	}

	private function _sendEmail($token, $type) {
		// SMTP = Simple Mail Transfer Protocol
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'sanhibiki4@gmail.com',
			'smtp_pass' => 'abdillah123',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];
		$this->load->library('email', $config);

		$this->email->from('sanhibiki4@gmail.com', 'Hibiki');
		$this->email->to($this->input->post('email'));

		if($type == 'verify') {
			$this->email->subject('Verifikasi Akun');
			$this->email->message('Klik link ini untuk verifikasi akun anda : 
			<a href="' . base_url() . 'autentikasi/verifikasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">
				Aktivasi
			</a>');
		}
		
		if($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
		}
	}

	public function verifikasi() {
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		// Validasi kecocokan email dari user yang baru daftar
		if($user) {
			// Validasi kecocokan token dari user yang baru daftar
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if($user_token) {
				// Verifikasi waktu dengan batas waktu 1 hari sebelum token hangus
				if(time() - $user_token['date_created'] < (60*60*24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">'. $email .' sudah aktif, silahkan login!</div>');
						redirect('autentikasi');
				} else {
					// Apabila melebihi batas waktu verifikasi
					// Hapus akun yang telat verifikasi
					$this->db->delete('user', ['user' => $email]);
					$this->db->delete('user', ['user_token' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token hangus!</div>');
						redirect('autentikasi');
				}
			} else {
				// Apabila token tidak valid
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token salah!</div>');
					redirect('autentikasi');
			}
		} else {
			// Apabila email tidak valid
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Email salah!</div>');
				redirect('autentikasi');
		}
	}

	public function login() {
		// Melanjutkan method dari login() pada function index di Autentikasi.php
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// Validasi apabila email telah terdaftar
		$user = $this->db->get_where('user', [
			'email' => $email
		])->row_array();

		// Validasi apakah user tersedia
		if($user) {
			//Validasi apakah user aktif
			if($user['is_active'] == 1) {
				// Validasi password
				if(password_verify($password, $user['password'])) {
					// Validasi level user
					$data = [
						'email' => $user['email'],
						'id_role' => $user['id_role']
					];
					// Pengarahan sesi login sesuai dengan level user, lalu diarahkan ke controller yang relevan
					$this->session->set_userdata($data);
					if($user['id_role'] == 1) {
						redirect('admin');
					} else if($user['id_role'] == 2) {
						redirect('user');
					} else if($user['id_role'] == 3) {
						redirect('dosen');
					} else if($user['id_role'] == 4) {
						redirect('mahasiswa'); 
					}
				} else {
					// Jika password tidak cocok
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
					// Pengarahan ke controller Autentikasi
					redirect('autentikasi');
				}
			} else {
				// Jika user belum aktif
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diaktivasi, silahkan aktivasi dahulu!</div>');
				redirect('autentikasi');
			}
		} else {
			// Jika user belum terdaftar
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar, silahkan daftar terlebih dahulu!</div>');
			redirect('autentikasi');
		}
	}

	public function ceksesi() {
		// Mengambil data dari sesi login user berdasarkan email
		return $this->db->get_where('user', [
			'email' => $this->session->userdata('email'),
			'id_role' => $this->session->userdata('id_role')
		])->row_array();
	}

}
