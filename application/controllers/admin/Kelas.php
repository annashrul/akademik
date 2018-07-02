<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function index(){
		$jurusan = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
		$kelas = $this->mAdmin->join(
			'kelas.*,jurusan.nama_jurusan,jurusan.id_jurusan',
			'jurusan',
			'jurusan.id_jurusan = kelas.id_jurusan',
			'kelas',NULL,NULL,'jurusan.id_jurusan','DESC'
		)->result();
		$data = [
			'title'		=> 'Kelas',
			'jurusan'	=> $jurusan,
			'kelas'		=> $kelas,
			'isi'			=> 'admin/kelas/list'
		];
		$this->load->view('layout/wrapper',$data);
	}

	// public function ambil(){
	// 	$jurusan = $this->mAdmin->join(
	// 		'kelas.*,jurusan.nama_jurusan',
	// 		'jurusan',
	// 		'jurusan.id_jurusan = kelas.id_jurusan',
	// 		'kelas',NULL,NULL,'jurusan.id_jurusan','ASC'
	// 	)->result();
	// 	echo json_encode($jurusan);
	// }
	// public function ambil_jurusan(){
	// 	$jurusan = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
	// 	echo json_encode($jurusan);
	// }
	// public function ambilIdKelas(){
	// 	$id_kelas = $this->input->post('id_kelas');
	// 	$data = ['id_kelas' => $id_kelas];
	// 	$kelas 		= $this->mAdmin->get_where('kelas',$data)->row();
	// 	echo json_encode($kelas);
	// }
	public function cek_kelas(){
    $dk = $_POST['daftar_kelas'];
    $q = $this->mAdmin->get_where('kelas',['daftar_kelas' => $dk])->row();
    count($q);
    echo $q;
  }
	public function insert() {
   	$this->form_validation->set_rules('daftar_kelas[]', 'Daftar Kelas', 'required|trim|xss_clean');
   	if ($this->form_validation->run() == FALSE){
    	echo validation_errors(); // tampilkan apabila ada error
   	}else{
    	$dk = $this->input->post('daftar_kelas');
    	$result = array();
    	foreach($dk AS $key => $val){
     		$result[] = array(
      		"id_jurusan"  	=> $_POST['id_jurusan'][$key],
      		"daftar_kelas"  => $_POST['daftar_kelas'][$key],
     		);
    	}            
    	$this->db->insert_batch('kelas', $result); // fungsi dari codeigniter untuk menyimpan multi array
     	redirect('admin/kelas');
   	}
  }

  public function update(){
  	$id_kelas	= $this->input->post('id_kelas');
  	$data = [
  		'id_jurusan'	=> $this->input->post('id_jurusan'),
  		'daftar_kelas'=> $this->input->post('daftar_kelas'),
  	];
  	$where = ['id_kelas' => $id_kelas];
  	$this->mAdmin->update('kelas',$data,$where);
  	redirect('admin/kelas');
  }

  public function delete($id_kelas){
  	// $id_kelas = $this->input->post('id_kelas');
  	$where = ['id_kelas' => $id_kelas];
  	$kelas = $this->mAdmin->delete('kelas',$where);
  	redirect('admin/kelas');
  	// echo json_encode($kelas);
  }

	// public function get_kelas(){
	// 	$id_kelas = $this->input->post('id_jurusan');
	// 	$kelas  	= $this->mAdmin->get_where('kelas',['id_jurusan' => $id_kelas])->result(); 
	//  	echo '<option> Pilih kota </option>';
	//  	foreach ($kelas as $k){
	//  		echo '<option>'.$k->daftar_kelas.'</option>'; 
	//  	}
	//  }

}

/* End of file Kelas.php */
/* Location: ./application/controllers/admin/Kelas.php */