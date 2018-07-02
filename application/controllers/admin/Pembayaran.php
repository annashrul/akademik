<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	// public function index(){
		
	// }
	public function spp(){
		$jenis 						= $this->input->post();
		$pembayaran 			= $this->mAdmin->get_where('pembayaran','jenis = "$jenis"')->row_array();
		$detailPembayaran = $this->mAdmin->get('detail_pembayaran',NULL,'id_detail_pembayaran','DESC')->result();
		// var_dump($detailPembayaran);die();
		$data = [
			'title'						 => 'Pembayaran SPP Tahun '.date('Y'),
			'pembayaran'			 => $pembayaran,
			'detailPembayaran' => $detailPembayaran,
			'isi'							 => 'admin/pembayaran/spp'
		];
		$this->load->view('layout/wrapper', $data);
	}
	public function get_data_pembayaran_spp(){
		$pembayaran = $this->mAdmin->get('pembayaran',NULL,'id_pembayaran','DESC')->result();
		$nis				=	$this->input->post('nis');
		$siswa 			= $this->mAdmin->batch_join(
	    'siswa.*,jurusan.*,kelas.daftar_kelas',
	    ['jurusan','kelas'],
	    ['jurusan.id_jurusan = siswa.id_jurusan','kelas.id_kelas = siswa.id_kelas'],
	    'siswa',"nis = '$nis'",NULL,'nis','ASC'
	  );
	  $data = [
	  	'siswa'				=> $siswa,
	  	'pembayaran'	=> $pembayaran,
	  ];
	  $this->load->view('admin/pembayaran/detail_data_pembayaran_spp', $data);
	}
	public function pembayaran_spp(){
		$valid = $this->form_validation;
		$valid->set_rules('biaya','biaya','required');
		$input = $this->input->post();
		if($valid->run()){
			$data = [
				'nis'							=> $input['nis'],
				'nama'						=> $input['nama'],
				'id_kelas'				=> $input['id_kelas'],
				'jurusan'					=> $input['jurusan'],
				'jenis'						=> $input['jenis'],
				'biaya'						=> $input['biaya'],
				'bulan'						=> $input['bulan'],
				'jumlah_uang'			=> $input['jumlah_uang'],
				'kembalian'				=> $input['kembalian'],
				'tanggal_bayar'		=> $input['tanggal_bayar'],
			];
			$this->mAdmin->insert('detail_pembayaran',$data);
			$this->session->set_flashdata('sukses','Data Pembayaran Berhasil Disimpan');
			redirect('admin/pembayaran/spp');
		}
	}
	public function cetak_pembayaran($id_detail_pembayaran){
		$cb = $this->mAdmin->get_where('detail_pembayaran',['id_detail_pembayaran' => $id_detail_pembayaran])->row();
		// var_dump($cetak_pembayaran);die();
		$data = [
			'judul'							=> 'Pembayaran '.$cb->jenis,
			'cb' 	=> $cb
		];
		$this->load->view('admin/pembayaran/cetak',$data);
	}
	public function pembangunan(){
		$data = [
			'title'	=> 'Pembayaran Bangunan',
			'isi'		=> 'admin/pembayaran/pembangunan'
		];
		$this->load->view('layout/wrapper', $data);
	}
	




}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/admin/Pembayaran.php */