<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index(){
		if($this->session->userdata('hak_akses') == 'admin'){
			// $pie = $this->db->query("SELECT kelas.daftar_kelas, jenis_kelamin,COUNT(*) FROM siswa LEFT JOIN kelas ON kelas.id_kelas = siswa.id_kelas GROUP BY jenis_kelamin");
			$pie = $this->db->query("SELECT siswa.nama, COUNT(siswa.nama) AS nm, jurusan.nama_jurusan FROM siswa LEFT JOIN jurusan ON jurusan.id_jurusan = siswa.id_jurusan GROUP BY jurusan.nama_jurusan")->result();
			$data = [
				'title'	=> 'Dashboard Admin',
				'pie'		=> $pie,
				'isi'		=> 'admin/dashboard/list'
			];
			$this->load->view('layout/wrapper', $data);
		}elseif($this->session->userdata('hak_akses') == 'guru'){
			$data = [
        'title' => 'Dashboard Guru',
        'isi'   => 'guru/dashboard'
      ];
      $this->load->view('layout/wrapper', $data);
    }
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */