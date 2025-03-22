<?php
class M_Quiz extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Dosen');
        $this->load->model('M_Mahasiswa');
        $this->load->model('M_Matkul');
    }

    public function getAllQuiz()
    {
        return $this->db->get('quiz')->result_array();
    }

    public function insert()
    {
        $data['quiz'] = $this->getAllQuiz();
        $kode_dosen = $this->input->post('kode_dosen');

        $data = [
            'judul_quiz' => $this->input->post('judul_quiz'),
            'deskripsi' => $this->input->post('deskripsi'),
            'kode_matkul' => $this->input->post('kode_matkul'),
            'kode_dosen' => $kode_dosen,
            'pertanyaan' => $this->input->post('pertanyaan'),
            'date_created' => date('Y-m-d')
        ];
        $this->db->insert('quiz', $data);
    }

    public function jawabQuiz()
    {
        // $data['quiz'] = $this->getAllQuiz();
        $kode_dosen = $this->input->post('kode_dosen');
        $npm = $this->input->post('npm');


        $data = [
            'judul_quiz' => $this->input->post('judul_quiz'),
            'deskripsi' => $this->input->post('deskripsi'),
            'kode_matkul' => $this->input->post('kode_matkul'),
            'kode_dosen' => $kode_dosen,
            'npm' => $npm,
            'pertanyaan' => $this->input->post('pertanyaan'),
            'jawaban' => $this->input->post('jawaban'),
            'date_created' => date('Y-m-d')
        ];
        $this->db->insert('quiz', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_quiz', $id);
        $this->db->delete('quiz');
    }
}
