<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	public function index(){
		$data = [
			'title'	=> 'Jurusan',
			'isi'		=> 'admin/jurusan/list'
		];
		$this->load->view('layout/wrapper',$data);
	}
	public function ambil(){
		$jurusan = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
		echo json_encode($jurusan);
	}
	public function ambilId(){
		$id_jurusan = $this->input->post('id_jurusan');
		$data = array('id_jurusan' => $id_jurusan);
		$query = $this->mAdmin->get_where('jurusan',array('id_jurusan' => $id_jurusan))->row_array();
		echo json_encode($query);
	}
	public function tambah(){
		$nama_jurusan = $this->input->post('nama_jurusan');
		$query = $this->mAdmin->get_where('jurusan',array('nama_jurusan' => $nama_jurusan))->row_array();
		if($nama_jurusan == "" ){
			$result['pesan'] = 'nama jurusan wajib diisi';
		}elseif(count($query['nama_jurusan']) == 1){
			$result['pesan'] = 'nama jurusan sudah ada';
		}else{
			$result['pesan'] = '';
			$data = [
				'nama_jurusan' => $nama_jurusan
			];
			$this->mAdmin->insert('jurusan',$data);
		}
		echo json_encode($result);
	}
	public function edit(){
		$id_jurusan 	= $this->input->post('id_jurusan');
		$nama_jurusan = $this->input->post('nama_jurusan');
		$query = $this->mAdmin->get_where('jurusan',array('nama_jurusan' => $nama_jurusan))->row_array();
		if($nama_jurusan == "" ){
			$result['pesan'] = 'nama jurusan wajib diisi';
		}elseif(count($query['nama_jurusan']) == 1){
			$result['pesan'] = 'nama jurusan sudah ada';
		}else{
			$result['pesan'] = '';
			$data = [
				'nama_jurusan'=> $nama_jurusan,
			];
			$where = ['id_jurusan' => $id_jurusan];
			$this->mAdmin->update('jurusan',$data,$where);
		}
		echo json_encode($result);
	}

	public function hapus(){
		$id_jurusan = $this->input->post('id_jurusan');
		$where = ['id_jurusan' => $id_jurusan];
		$query = $this->mAdmin->delete('jurusan',$where);
		echo json_encode($query);
	}
}

/* End of file Jurusan.php */
/* Location: ./application/controllers/admin/Jurusan.php */