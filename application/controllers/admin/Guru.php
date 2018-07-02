<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public function index(){
    if($this->session->userdata('hak_akses') == 'admin'){
  		$guru = $this->mAdmin->get('guru',NULL,'nig','ASC')->result();
  		$data = [
  			'title' => 'Daftar Guru',
  			'guru'	=> $guru,
  			'isi'		=> 'admin/guru/list'
  		];
  		$this->load->view('layout/wrapper', $data);
    }
    else{
      $data = [
        'title' => 'Halaman Guru',
        'isi'   => 'guru/dashboard'
      ];
      $this->load->view('layout/wrapper', $data);
    }
	}
	public function tambah(){
    
		$valid = $this->form_validation;
    $valid->set_rules('nig','NIG','required|trim|alpha_numeric|is_unique[guru.nig]|max_length[7]',[
      'required'      => '* NIG Harus Diisi ',
      'alpha_numeric' => '* Anda Memasukan Karakter Aneh -_- Masukan Karakter Angka dan Huruf',
      'is_unique'     => '* NIG <strong>'.$this->input->post('nig').'</strong> sudah ada',
      'max_length'    => '* Tidak Boleh Dari 7 Karakter'
    ]);
    $valid->set_rules('nama','Nama','trim|required',[
      'required'  => '* Nama Harus Diisi '
    ]);
    $valid->set_rules('email', 'Email', 'trim|required|valid_email',[
      'required'    => '* Email Harus Diisi ',
      'valid_email' => '* Masukan Karakter @ dan .com'
    ]);
    $valid->set_rules('tgl_lahir','Tanggal Lahir','required',[
      'required'  => '* Tanggal Lahir Harus Diisi '
    ]);
    $valid->set_rules('no_hp','No Handphone','required|numeric',[
      'required'  => '* No Handphone Harus Diisi ',
      'numeric'		=> 'Karakter Harus Berupa Angka'
    ]);
    $valid->set_rules('alamat','Alamat','required',[
      'required'  => '* Alamat Harus Diisi '
    ]);
    if($valid->run()){
      $input = $this->input->post();
      $config = array(
        'upload_path'   => './assets/upload/guru/',
        'allowed_types' => 'jpg|png|jpeg',
        'max_size'      => '2048',
        'file_name'     => $input['nama'].'('.$input['nig'].')'.date('Y')
      );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('photo')){
        $img = $this->upload->data();
       
        $data = array(
          'photo'     => $img['file_name'],
          'nig'       => $input['nig'],
          'nama'      => $input['nama'],
          'email'     => $input['email'],
          'tgl_lahir' => $input['tgl_lahir'],
          'no_hp'     => $input['no_hp'],
          'alamat'    => $input['alamat'],
        );
        $this->mAdmin->insert('guru',$data);
        $id_guru = $this->db->insert_id();
        $data = [
          'id_guru'   => $id_guru,
          'username'  => $input['nig'],
          'password'  => $input['nig'],
          'hak_akses' => 'guru'
        ];
        $this->mAdmin->insert('pengguna',$data);
        $this->session->set_flashdata('sukses','Data Siswa Berhasil Ditambah');
        redirect('admin/guru');
      }else{
        $data = array(
          'nig'       => $input['nig'],
          'nama'      => $input['nama'],
          'email'     => $input['email'],
          'tgl_lahir' => $input['tgl_lahir'],
          'no_hp'     => $input['no_hp'],
          'alamat'    => $input['alamat'],
        );
        $this->mAdmin->insert('guru',$data);
        $id_guru = $this->db->insert_id();
        $data = [
          'id_guru'   => $id_guru,
          'username'  => $input['nig'],
          'password'  => $input['nig'],
          'hak_akses' => 'guru'
        ];
        $this->mAdmin->insert('pengguna',$data);
        $this->session->set_flashdata('sukses','Data Siswa Berhasil Ditambah');
        redirect('admin/guru');
      }
    }else{
      $data = [  
        'title' => 'Halaman Tambah Guru',
        'isi'   => 'admin/guru/tambah'
      ];
      $this->load->view('layout/wrapper',$data);
    }
		
	}
	public function edit($id_guru){
    $guru = $this->mAdmin->get_where('guru',['id_guru' => $id_guru])->row();
    $valid = $this->form_validation;
    $valid->set_rules('nama','Nama','trim|required',[
      'required'  => '* Nama Harus Diisi '
    ]);
		if($valid->run()){
      $config = array(
        'upload_path'   => './assets/upload/guru/',
        'allowed_types' => 'jpg|png|jpeg',
        'max_size'      => '2048',
        'file_name'     => $guru->nama.'('.$guru->nig.')'.date('Y')
      );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('photo')){
        $img = $this->upload->data();
        $guru != "" ? unlink('./assets/upload/guru/'.$guru->photo) : "";
        $input = $this->input->post();
        $data = array(
          'photo'     => $img['file_name'],
          // 'nig'       => $input['nig'],
          'nama'      => $input['nama'],
          'email'     => $input['email'],
          'tgl_lahir' => $input['tgl_lahir'],
          'no_hp'     => $input['no_hp'],
          'alamat'    => $input['alamat'],
        );
        $where = array('id_guru' => $id_guru);
        $this->mAdmin->update('guru',$data,$where);
        redirect('admin/guru');
      }else{
        $input = $this->input->post();
        $data = array(
          // 'nig'       => $input['nig'],
          'nama'      => $input['nama'],
          'email'     => $input['email'],
          'tgl_lahir' => $input['tgl_lahir'],
          'no_hp'     => $input['no_hp'],
          'alamat'    => $input['alamat'],
        );
        $where = array('id_guru' => $id_guru);
        $this->mAdmin->update('guru',$data,$where);
        redirect('admin/guru');
      }
    }else{
      $data = [  
        'title' => 'Halaman Edit Guru',
        'guru'  => $guru,
        'isi'   => 'admin/guru/edit'
      ];
      $this->load->view('layout/wrapper',$data);
    }
	}

	public function delete($id_guru){
		$guru = $this->mAdmin->get_where('guru',['id_guru' => $id_guru])->row();
		$guru != "" ? unlink("./assets/upload/guru/".$guru->photo) : "";
		$where = ['id_guru' => $id_guru];
		$this->mAdmin->delete('guru',$where);
    $where = ['id_guru' => $id_guru];
    $this->mAdmin->delete('pengguna',$where);
		$this->session->set_flashdata('sukses','Data Guru Berhasil Dihapus');
		redirect('admin/guru');
	}


  // public function pelajaran(){
  //   $jurusan    = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
  //   $guru    = $this->mAdmin->get('guru',NULL,'nama','ASC')->result();
  //   $kelas    = $this->mAdmin->get('kelas',NULL,'daftar_kelas','ASC')->result();
  //   // $pelajaran  = $this->mAdmin->get('pelajaran',NULL,'nama_pelajaran','ASC')->result();
  //   $pelajaran = $this->mAdmin->join(
  //     'pelajaran.*,jurusan.*',
  //     'jurusan',
  //     'jurusan.id_jurusan = pelajaran.id_jurusan',
  //     'pelajaran',NULL,NULL,'nama_pelajaran','ASC'
  //   )->result();
  //   $data = [
  //     'title'     => 'Kelola Pelajaran',
  //     'jurusan'   => $jurusan,
  //     'pelajaran' => $pelajaran,
  //     'guru' => $guru,
  //     'kelas' => $kelas,
  //     'isi'       => 'guru/pelajaran'
  //   ];
  //   $this->load->view('layout/wrapper',$data);
  // }
  // public function batchInsert(){
  //   $result = $this->mAdmin->batchInsert($_POST);
  //   if($result){
  //     echo 1;
  //   }
  //   else{
  //     echo 0;
  //   }
  //   exit;
  // }

  public function nilai(){
    $data = [
      'title' => 'Kelola Nilai',
      'isi'   => 'guru/nilai'
    ];
    $this->load->view('layout/wrapper',$data);
  }

}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */