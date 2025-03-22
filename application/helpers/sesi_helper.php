<?php 

function apakah_login() {
	// get_instance() berfungsi memanggil fungsi-fungsi dari PHP framework Codeigniter 3
	$ci = get_instance();
	// Memblokir akses menu apabila user belum login
	if(!$ci->session->userdata('email')) {
		redirect('autentikasi');
	} else {
		// Memblokir akses menu apabila role nya tidak sesuai
		$id_role = $ci->session->userdata('id_role');
		$menu = $ci->uri->segment(1);

		$query = $ci->db->get_where('menu', ['menu' => $menu])->row_array();
		$id_menu = $query['id_menu'];

		$aksesUser = $ci->db->get_where('menu_akses', [
			'id_role' => $id_role,
			'id_menu' => $id_menu
		]);

		if(!$aksesUser->num_rows()) {
			redirect('autentikasi/blokir');
		}
	}
}

function check_akses($id_role, $id_menu) {
	$ci = get_instance();

	$result = $ci->db->get_where('menu_akses', [
		'id_role' => $id_role,
		'id_menu' => $id_menu
	]);

	// Jika baris tersedia
	if($result->num_rows() > 0) {
		//List akses terceklis di checkbox
		return "checked='checked'";
	}
}
