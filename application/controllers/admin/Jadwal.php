<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	

	public function index(){
		if($this->session->userdata('hak_akses') == 'admin'){
	    $guru    			= $this->mAdmin->get('guru',NULL,'nama','ASC')->result();
	    $kelas    	= $this->mAdmin->get('kelas',NULL,'daftar_kelas','ASC')->result();
			$jurusan    = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
	    $pelajaran  = $this->mAdmin->get('pelajaran',NULL,'nama_pelajaran','ASC')->result();
			$jadwal = $this->mAdmin->batch_join(
	      'jadwal.*,guru.nama,guru.id_guru,kelas.daftar_kelas,jurusan.nama_jurusan,pelajaran.nama_pelajaran',
	      array('guru','kelas','jurusan','pelajaran'),
	      array(
	      	'guru.id_guru = jadwal.id_guru',
	      	'kelas.id_kelas = jadwal.id_kelas',
	      	'jurusan.id_jurusan = jadwal.id_jurusan',
	      	'pelajaran.id_pelajaran = jadwal.id_pelajaran'
	      ), 
	      'jadwal',NULL,NULL,'hari','ASC'
	    )->result();
   		$valid = $this->form_validation;
    	$valid->set_rules('hari','Hari','required');
    	if($valid->run() == FALSE){
		    $data = [
		      'title'     => 'Kelola Jadwal',
		      'guru' 			=> $guru,
		      'kelas' 		=> $kelas,
		      'jurusan'   => $jurusan,
		      'pelajaran' => $pelajaran,
		      'jadwal' 		=> $jadwal,
		      'isi'       => 'admin/jadwal/list'
		    ];
		    $this->load->view('layout/wrapper',$data);
    	}else{
	    	$input = $this->input->post();
	    	$data = [
	    		'id_guru'			=> $input['id_guru'],
	    		'id_jurusan'	=> $input['id_jurusan'],
	    		'id_kelas'		=> $input['id_kelas'],
	    		'id_pelajaran'=> $input['id_pelajaran'],
	    		'hari'				=> $input['hari'],
	    		'jam'					=> $input['jam'],
	    	];
    		foreach($jadwal as $jadwal){
		    	if($input['id_guru'] == $jadwal->id_guru && $input['id_jurusan'] == $jadwal->id_jurusan && $input['id_kelas'] == $jadwal->id_kelas && 
		    		$input['id_pelajaran'] == $jadwal->id_pelajaran && $input['hari'] == $jadwal->hari && $input['jam'] == $jadwal->jam){
		    			$this->session->set_flashdata('sukses','<b>Oppss '.$jadwal->nama .' sudah mempunyai jadwal untuk hari '.$input['hari'].' di kelas '.$jadwal->daftar_kelas.'</b>');
			    		redirect('admin/jadwal/test');
		    	}elseif($input['id_guru'] == $jadwal->id_guru && $input['id_jurusan'] == $jadwal->id_jurusan && $input['id_kelas'] == $jadwal->id_kelas){
		    		$this->session->set_flashdata('sukses','<b>Oppss '.$jadwal->nama .' sudah mempunyai jadwal di Jurusan '.$jadwal->nama_jurusan.' kelas ' . $jadwal->daftar_kelas. 'pada hari ' . $jadwal->hari .' jam '. $jadwal->jam .'</b>');
		    		redirect('admin/jadwal/test');
	    		}elseif($input['id_jurusan'] == $jadwal->id_jurusan && $input['id_kelas'] == $jadwal->id_kelas && $input['hari'] == $jadwal->hari && $input['jam'] == $jadwal->jam){
	    			$this->session->set_flashdata('sukses','<b>Oppss jadwal di kelas '. $jadwal->daftar_kelas .' jurusan ' . $jadwal->nama_jurusan .' pada hari '. $jadwal->hari .' jam '. $jadwal->jam .' sudah ada</b>');
    				redirect('admin/jadwal/test');
	    		}elseif($input['hari'] == $jadwal->hari && $input['jam'] == $jadwal->jam){
	    			$this->session->set_flashdata('sukses','<b>Oppss '. $jadwal->nama .' sudah mempunyai jadwal untuk hari '. $jadwal->hari .' jam '. $jadwal->jam .' di jurusan '. $jadwal->nama_jurusan .' kelas '. $jadwal->daftar_kelas .'</b>');
    				redirect('admin/jadwal/test');
	    		}
    		}
	  		$this->mAdmin->insert('jadwal',$data);
	    	$this->session->set_flashdata('sukses','Data Berhasil Disimpan');
	    	redirect('admin/jadwal');
    	}
	  }
	}

	public function jadwal_by_guru($id_guru){
		$guru    		= $this->mAdmin->get('guru',NULL,'nama','ASC')->result();
  	$jadwal = $this->mAdmin->batch_join(
      'jadwal.*,guru.nama,guru.id_guru,kelas.daftar_kelas,jurusan.nama_jurusan,pelajaran.nama_pelajaran',
      array('guru','kelas','jurusan','pelajaran'),
      array(
      	'guru.id_guru = jadwal.id_guru',
      	'kelas.id_kelas = jadwal.id_kelas',
      	'jurusan.id_jurusan = jadwal.id_jurusan',
      	'pelajaran.id_pelajaran = jadwal.id_pelajaran'
      ), 
      'jadwal',"guru.id_guru = '$id_guru'",NULL,'id_jadwal','ASC'
    )->result();
    if(count($jadwal) > 0 ){
	    $data = [
	      'title' => 'Jadwal '.$jadwal[0]->nama,
	      'jadwal'=> $jadwal,
	      'guru' 	=> $guru,
	      'isi'   => 'admin/jadwal/list_by_guru'
	    ];
	    $this->load->view('layout/wrapper',$data);
	  }else{
	  	$this->session->set_flashdata('sukses','Anda belum memiliki jadwal');
  	 	echo '<script>alert("Data has been Saved");window.location="'.base_url("admin/jadwal").'"</script>';
	  }
  }

  public function get_kelas(){
    $id_kelas = $this->input->post('id_jurusan');
    $kelas    = $this->mAdmin->get_where('kelas',['id_jurusan' => $id_kelas])->result(); 
    foreach ($kelas as $k){
      echo '<option value="'.$k->id_kelas.'">'.$k->daftar_kelas.'</option>'; 
    }
  }
  public function test(){
		$guru    			= $this->mAdmin->get('guru',NULL,'nama','ASC')->result();
    $kelas    	= $this->mAdmin->get('kelas',NULL,'daftar_kelas','ASC')->result();
		$jurusan    = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
    $pelajaran  = $this->mAdmin->get('pelajaran',NULL,'nama_pelajaran','ASC')->result();
		$jadwal = $this->mAdmin->batch_join(
      'jadwal.*,guru.nama,guru.id_guru,kelas.daftar_kelas,jurusan.nama_jurusan,pelajaran.nama_pelajaran',
      array('guru','kelas','jurusan','pelajaran'),
      array(
      	'guru.id_guru = jadwal.id_guru',
      	'kelas.id_kelas = jadwal.id_kelas',
      	'jurusan.id_jurusan = jadwal.id_jurusan',
      	'pelajaran.id_pelajaran = jadwal.id_pelajaran'
      ), 
      'jadwal',NULL,NULL,'hari','ASC'
    )->result();

    $valid = $this->form_validation;
    $valid->set_rules('hari','Hari','required');
    if($valid->run() == FALSE){
	    $data = [
	      'title'     => 'Kelola Jadwal',
	      'guru' 			=> $guru,
	      'kelas' 		=> $kelas,
	      'jurusan'   => $jurusan,
	      'pelajaran' => $pelajaran,
	      'jadwal' 		=> $jadwal,
	      'isi'       => 'admin/jadwal/debug'
	    ];
	    $this->load->view('layout/wrapper',$data);
    }else{
    	$input = $this->input->post();
    	$data = [
    		'id_guru'			=> $input['id_guru'],
    		'id_jurusan'	=> $input['id_jurusan'],
    		'id_kelas'		=> $input['id_kelas'],
    		'id_pelajaran'=> $input['id_pelajaran'],
    		'hari'				=> $input['hari'],
    		'jam'					=> $input['jam'],
    	];
    	foreach($jadwal as $jadwal){
	    	if($input['id_guru'] == $jadwal->id_guru && $input['id_jurusan'] == $jadwal->id_jurusan && $input['id_kelas'] == $jadwal->id_kelas && $input['id_pelajaran'] == $jadwal->id_pelajaran && $input['hari'] == $jadwal->hari && $input['jam'] == $jadwal->jam) {
	    		$this->session->set_flashdata('sukses','<b>Oppss '.$jadwal->nama .' sudah mempunyai jadwal untuk hari '.$input['hari'].' di kelas '.$jadwal->daftar_kelas.'</b>');
		    	redirect('admin/jadwal/test');
	    	}
	    	elseif($input['id_guru'] == $jadwal->id_guru && $input['id_jurusan'] == $jadwal->id_jurusan && $input['id_kelas'] == $jadwal->id_kelas){
		    	$this->session->set_flashdata('sukses','<b>Oppss '.$jadwal->nama .' sudah mempunyai jadwal di Jurusan '.$jadwal->nama_jurusan.' kelas ' . $jadwal->daftar_kelas. 'pada hari ' . $jadwal->hari .' jam '. $jadwal->jam .'</b>');
		    	redirect('admin/jadwal/test');
	    	}elseif($input['id_jurusan'] == $jadwal->id_jurusan && $input['id_kelas'] == $jadwal->id_kelas && $input['hari'] == $jadwal->hari && $input['jam'] == $jadwal->jam){
	    		$this->session->set_flashdata('sukses','<b>Oppss jadwal di kelas '. $jadwal->daftar_kelas .' jurusan ' . $jadwal->nama_jurusan .' pada hari '. $jadwal->hari .' jam '. $jadwal->jam .' sudah ada</b>');
    			redirect('admin/jadwal/test');
	    	}elseif($input['hari'] == $jadwal->hari && $input['jam'] == $jadwal->jam){
	    		$this->session->set_flashdata('sukses','<b>Oppss '. $jadwal->nama .' sudah mempunyai jadwal untuk hari '. $jadwal->hari .' jam '. $jadwal->jam .' di jurusan '. $jadwal->nama_jurusan .' kelas '. $jadwal->daftar_kelas .'</b>');
    			redirect('admin/jadwal/test');
	    	}
	    	
    	}
  		$this->mAdmin->insert('jadwal',$data);
    	$this->session->set_flashdata('sukses','Data Berhasil Disimpan');
    	redirect('admin/jadwal/test');
    	
    }
	}

	public function update(){
		$id_jadwal = $this->input->post('id_jadwal');
		$input = $this->input->post();
		$data = [
			'id_guru'			=> $input['id_guru'],
			'id_jurusan'	=> $input['id_jurusan'],
			'id_kelas'		=> $input['id_kelas'],
			'id_pelajaran'=> $input['id_pelajaran'],
			'hari'				=> $input['hari'],
			'jam'					=> $input['jam'],
		];
		$where = ['id_jadwal' => $id_jadwal];
		$this->mAdmin->update('jadwal',$data,$where);
		$this->session->set_flashdata('sukses','Data Berhasil Disimpan');
		redirect('admin/jadwal');
	}

	public function delete($id_jadwal){
		$where = ['id_jadwal' => $id_jadwal];
		$this->mAdmin->delete('jadwal',$where);
		$this->session->set_flashdata('sukses','Data Berhasil Dihapus');
  	redirect('admin/jadwal/test');
	}


}//END CLASS

/* End of file Jadwal.php */
/* Location: ./application/controllers/admin/Jadwal.php */