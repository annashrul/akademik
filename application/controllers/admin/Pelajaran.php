<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelajaran extends CI_Controller {

	public function index(){
		$jurusan = $this->mAdmin->get('jurusan')->result();
		$pelajaran = $this->mAdmin->join(
			'pelajaran.*,jurusan.*',
	    'jurusan',
	    'jurusan.id_jurusan = pelajaran.id_jurusan',
	    'pelajaran',NULL,NULL,'nama_pelajaran','ASC'
		)->result();
		$data = [
			'title'	=> 'Pelajaran',
			'jurusan' => $jurusan,
			'pelajaran' => $pelajaran,
			'isi'		=> 'admin/pelajaran/list'
		];
		$this->load->view('layout/wrapper', $data);
	}

	public function tambah(){
		$nama_pelajaran = $this->input->post('nama_pelajaran');
		$id_jurusan 		= $this->input->post('id_jurusan');
		$query = $this->mAdmin->get_where('pelajaran',array('nama_pelajaran' => $nama_pelajaran))->row_array();
		if($nama_pelajaran == "" ){
			$result['pesan'] = 'nama pelajaran wajib diisi';
		}elseif(count($query['nama_pelajaran']) == 1){
			$result['pesan'] = 'nama pelajaran '.$nama_pelajaran.' sudah ada';
		}else{
			$result['pesan'] = '';
			$data = [
				'nama_pelajaran' 	=> $nama_pelajaran,
				'id_jurusan' 			=> $id_jurusan,
				'keterangan' 			=> $id_jurusan,
			];
			$this->mAdmin->insert('pelajaran',$data);
		}
		echo json_encode($result);
	}

	public function edit(){
		$id_pelajaran 	= $this->input->post('id_pelajaran');
		$nama_pelajaran = $this->input->post('nama_pelajaran');
		$id_jurusan 		= $this->input->post('id_jurusan');
		$data = [
			'nama_pelajaran' 	=> $nama_pelajaran,
			'id_jurusan' 			=> $id_jurusan,
			'keterangan' 			=> $id_jurusan,
		];
		$where = ['id_pelajaran' => $id_pelajaran];
		$this->mAdmin->update('pelajaran',$data,$where);
		redirect('admin/pelajaran');
	}

	public function delete($id_pelajaran){
		$where = ['id_pelajaran' => $id_pelajaran];
		$this->mAdmin->delete('pelajaran',$where);
		redirect('admin/pelajaran');
	}

	public function hapus_banyak(){
		foreach ($_POST['id_pelajaran'] as $id_pelajaran) {
			$where = ['id_pelajaran' => $id_pelajaran];
			$this->mAdmin->delete('pelajaran',$where);
		}
		$this->session->set_flashdata('data pelajaran berhasil dihapus');
		return redirect('admin/pelajaran');
	}	

	
}

/* End of file Pelajaran.php */
/* Location: ./application/controllers/admin/Pelajaran.php */