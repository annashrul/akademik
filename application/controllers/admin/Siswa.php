<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function index(){
    $last_nis = $this->db->query("SELECT * FROM siswa WHERE id_siswa IN (SELECT MAX(id_siswa) FROM siswa GROUP BY id_jurusan) ORDER BY nis ASC")->result();
    $jurusan = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
    $kelas   = $this->mAdmin->get('kelas',NULL,'id_kelas','ASC')->result();
    if($this->session->userdata('hak_akses') == 'admin'){
      $siswa   = $this->mAdmin->batch_join(
        'siswa.*,jurusan.*,kelas.daftar_kelas',
        ['jurusan','kelas'],
        ['jurusan.id_jurusan = siswa.id_jurusan','kelas.id_kelas = siswa.id_kelas'],
        'siswa',NULL,NULL,'nis','ASC'
      )->result();
      // var_dump($siswa);die();
  	  $data = [
  			'title'  => 'Daftar Siswa',
        'siswa'  => $siswa,
        'jurusan'=> $jurusan,
  			'kelas'	 => $kelas,
  			'isi'		 => 'admin/siswa/list'
  		];
  		$this->load->view('layout/wrapper', $data);
    }else{
      $id_siswa = $this->session->userdata('id_siswa');
      $siswa = $this->mAdmin->get_where(
        'siswa',"id_siswa = '$id_siswa'"
      )->row_array();
      $data = [
        'title' => 'halaman siswa',
        'siswa' => $siswa,
        'isi'   => 'siswa/dashboard'
      ];
      $this->load->view('layout/wrapper', $data);
    }
	}

  public function get_kelas(){
    $id_kelas = $this->input->post('id_jurusan');
    $kelas    = $this->mAdmin->get_where('kelas',['id_jurusan' => $id_kelas])->result(); 
    // echo '<option> Pilih Kelas </option>';
    foreach ($kelas as $k){
      echo '<option value="'.$k->id_kelas.'">'.$k->daftar_kelas.'</option>'; 
    }
  }

  public function cek_nis(){
      $nis = $this->input->post('nis');
    // if(isset($nis)){
      $q = $this->mAdmin->get_where('siswa',['nis' => $nis])->row();
      count($q);
      echo $q;
      // if(count($cek) > 0){
      //   echo 'no';
      // }else{
      //   echo 'yes';
      // }
    // }
   }
	public function tambah(){
    // SELECT * FROM siswa WHERE id_siswa IN (SELECT MAX(id_siswa) FROM siswa GROUP BY id_jurusan)
    $last_nis = $this->db->query("SELECT * FROM siswa WHERE id_siswa IN (SELECT MAX(id_siswa) FROM siswa GROUP BY id_jurusan) ORDER BY nis ASC")->result();
    $jurusan  = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
		$kelas    = $this->mAdmin->get('kelas',NULL,'id_kelas','ASC')->result();
		$valid    = $this->form_validation;
    $valid->set_rules('nis','nis','required|trim|alpha_numeric|is_unique[siswa.nis]|max_length[9]',[
      'required'  		=> '* NIS Harus Diisi ',
      'alpha_numeric'	=> '* Anda Memasukan Karakter Aneh -_- Masukan Karakter Angka dan Huruf',
      'is_unique' 		=> '* NIS <strong>'.$this->input->post('nis').'</strong> sudah ada',
      'max_length'		=> '* Tidak Boleh Dari 9 Karakter'
    ]);
    $valid->set_rules('nama','Nama','required|trim',[
      'required'  => '* Nama Harus Diisi',
      'alpha'			=> '* Masukan Karakter Berupa Huruf'
    ]);
    $valid->set_rules('tgl_lahir','Tanggal Lahir','required',['required'=>'* Tanggal Lahir Harus Diisi']);
    $valid->set_rules('no_hp','No','required|numeric',['required'=>'* No Handphone Harus Diisi','numeric'=>'* Karakter Harus Berupa Angka']);
    $valid->set_rules('alamat','Alamat','required|trim',['required'=>'* Alamat Harus Diisi']);
    $valid->set_rules('angkatan','akatan','required|trim',['required'=>'* Angkatan Harus Diisi']);
    $valid->set_rules('jenis_kelamin','Jenis Kelamin','required|trim',['required'=>'* Jenis Kelamin Harus Diisi']);
    if($valid->run()){
      $input = $this->input->post();
      $config = array(
        'upload_path'   => './assets/upload/siswa/',
        'allowed_types' => 'jpg|png|jpeg',
        'max_size'      => '2048',
        'file_name'     => $input['nama'].'('.$input['nis'].')'.substr(date('Y'),2,4)
      );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('photo')){
        $img = $this->upload->data();
        $data = [
          'nis'           => $input['nis'],
          'nama'          => $input['nama'],
          'id_jurusan'    => $input['id_jurusan'],
          'id_kelas'      => $input['id_kelas'],
          'photo'         => $img['file_name'],
          'tgl_lahir'     => $input['tgl_lahir'],
          'no_hp'         => $input['no_hp'],
          'alamat'        => $input['alamat'],
          'angkatan'      => $input['angkatan'],
          'jenis_kelamin' => $input['jenis_kelamin'],
        ];
        $this->mAdmin->insert('siswa',$data);
        $id_siswa = $this->db->insert_id();
        $data = [
          'id_siswa'  => $id_siswa,
          'username'  => $input['nis'],
          'password'  => $input['nis'],
          'hak_akses' => 'siswa'
        ];
        $this->mAdmin->insert('pengguna',$data);
        $this->session->set_flashdata('sukses','Data Siswa Berhasil Disimpan');
        redirect('admin/siswa/tambah');
      }else{
        $data = array(
          'nis'           => $input['nis'],
          'nama'          => $input['nama'],
          'id_jurusan'    => $input['id_jurusan'],
          'id_kelas'      => $input['id_kelas'],
          'tgl_lahir'     => $input['tgl_lahir'],
          'no_hp'         => $input['no_hp'],
          'alamat'        => $input['alamat'],
          'angkatan'      => $input['angkatan'],
          'jenis_kelamin' => $input['jenis_kelamin'],
        );
        $this->mAdmin->insert('siswa',$data);
        $id_siswa = $this->db->insert_id();
        $data = [
          'id_siswa'  => $id_siswa,
          'username'  => $input['nis'],
          'password'  => $input['nis'],
          'hak_akses' => 'siswa'
        ];
        $this->mAdmin->insert('pengguna',$data);
        $this->session->set_flashdata('sukses','Data Siswa Berhasil Disimpan');
        redirect('admin/siswa/tambah');
      }
    }else{
      $data = [  
        'title'   => 'Halaman Tambah Siswa',
        'jurusan' => $jurusan,
        'kelas'	  => $kelas,
        'last_nis'=> $last_nis,
        'isi'     => 'admin/siswa/tambah'
      ];
      $this->load->view('layout/wrapper',$data);
    }
		
	}

	public function edit($id_siswa){
    $last_nis = $this->db->query("SELECT * FROM siswa WHERE id_siswa IN (SELECT MAX(id_siswa) FROM siswa GROUP BY id_jurusan) ORDER BY nis ASC")->result();
    $jurusan  = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
		$kelas 	  = $this->mAdmin->get('kelas',NULL,'id_kelas','ASC')->result();
		$siswa 		= $this->mAdmin->get_where('siswa',['id_siswa' => $id_siswa])->row();
		$where 		= ['id_siswa' => $id_siswa];
		$valid    = $this->form_validation;
    $valid->set_rules('nama','Nama','trim|required',['required'=>'* Nama Harus Diisi']);
    $valid->set_rules('tgl_lahir','Tanggal Lahir','required',['required'=>'* Tanggal Lahir Harus Diisi']);
    $valid->set_rules('no_hp','No Handphone','required|numeric',[
      'required'  => '* Alamat Harus Diisi ',
      'numeric'		=> 'Karakter Harus Berupa Angka'
    ]);
    $valid->set_rules('alamat','Alamat','required',['required'=>'* Alamat Harus Diisi']);
    $valid->set_rules('angkatan','akatan','required|trim',['required'=>'* Angkatan Harus Diisi ']);
    $valid->set_rules('jenis_kelamin','Jenis Kelamin','required|trim',['required'=>'* Jenis Kelamin Harus Diisi ',]);
    if($valid->run()){
      $input = $this->input->post();
      $config = [
        'upload_path'   => './assets/upload/siswa/',
        'allowed_types' => 'jpg|png|jpeg',
        'max_size'      => '2048',
        'file_name'     => $input['nama'].'('.$input['nis'].')'.substr(date('Y'),2,4)
      ];
      $this->load->library('upload',$config);
      if($this->upload->do_upload('photo')){
        $img = $this->upload->data();
       	$siswa != "" ? unlink("./assets/upload/siswa/".$siswa->photo) : "" ;
        $data = [
          'nis'           => $input['nis'],
          'nama'          => $input['nama'],
          'id_jurusan'    => $input['id_jurusan'],
          'id_kelas'      => $input['id_kelas'],
          'photo'         => $img['file_name'],
          'tgl_lahir'     => $input['tgl_lahir'],
          'no_hp'         => $input['no_hp'],
          'alamat'        => $input['alamat'],
          'angkatan'      => $input['angkatan'],
          'jenis_kelamin' => $input['jenis_kelamin'],
        ];
        $this->mAdmin->update('siswa',$data,$where);
        $id_siswa = $this->db->insert_id();
        $data = [
          'id_siswa'  => $id_siswa,
          'username'  => $input['nis'],
          'password'  => $input['nis'],
          'hak_akses' => 'siswa'
        ];
        $this->mAdmin->update('pengguna',$data,$where);
        $this->session->set_flashdata('sukses','Data Siswa Berhasil Diubah');
        redirect('admin/siswa');
      }else{
        $data = [
          'nis'           => $input['nis'],
          'nama'          => $input['nama'],
          'id_jurusan'    => $input['id_jurusan'],
          'id_kelas'      => $input['id_kelas'],
          'tgl_lahir'     => $input['tgl_lahir'],
          'no_hp'         => $input['no_hp'],
          'alamat'        => $input['alamat'],
          'angkatan'      => $input['angkatan'],
          'jenis_kelamin' => $input['jenis_kelamin'],
        ];
        $this->mAdmin->update('siswa',$data,$where);
        $id_siswa = $this->db->insert_id();
        $data = [
          'id_siswa'  => $id_siswa,
          'username'  => $input['nis'],
          'password'  => $input['nis'],
          'hak_akses' => 'siswa'
        ];
        $this->mAdmin->update('pengguna',$data,$where);
        $this->session->set_flashdata('sukses','Data Siswa Berhasil Diubah');
        redirect('admin/siswa');
      }
    }else{
      $data = [  
        'title' 	=> 'Halaman Edit Siswa',
        'jurusan' => $jurusan,
        'kelas'	  => $kelas,
        'siswa'		=> $siswa,
        'last_nis'=> $last_nis,
        'isi'   	=> 'admin/siswa/edit'
      ];
      $this->load->view('layout/wrapper',$data);
    }
		
	}

	public function delete($id_siswa){
		$siswa = $this->db->get_where('siswa',['id_siswa' => $id_siswa])->row();
		$siswa != "" ? unlink("./assets/upload/siswa/".$siswa->photo) : "";
		$where = ['id_siswa' => $id_siswa];
		$this->mAdmin->delete('siswa',$where);
    $where = ['id_siswa' => $id_siswa];
    $this->mAdmin->delete('pengguna',$where);
		$this->session->set_flashdata('sukses','Data Siswa Berhasil Dihapus');
		redirect('admin/siswa');
	}

  public function hapus_banyak(){
    // $ids = $this->input->post('id_siswa');
    
    $id_siswa = $_POST['id_siswa'];
    foreach ($id_siswa as $id) {
      $siswa = $this->db->get_where('siswa',['id_siswa' => $id])->row();
      $siswa != "" ? unlink("./assets/upload/siswa/".$siswa->photo) : "";
      $where = ['id_siswa' => $id];
      $this->mAdmin->delete('siswa',$where);
      $this->session->set_flashdata('sukses','data Siswa berhasil dihapus sebanyak'.count($_POST['id_siswa']));
    }
    return redirect('admin/siswa');
  } 

  public function siswa_by_jurusan($id_jurusan){
    $jurusan = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
    $siswa = $this->mAdmin->batch_join(
      'siswa.*,jurusan.*,kelas.daftar_kelas',
      ['jurusan','kelas'],
      ['jurusan.id_jurusan = siswa.id_jurusan','kelas.id_kelas = siswa.id_kelas'],
      'siswa',"jurusan.id_jurusan = '$id_jurusan'",NULL,'nis','ASC'
    )->result();
    if(count($siswa) > 0){
      $data = [
        'title'   => 'Siswa '.$siswa[0]->nama_jurusan,
        'siswa'   => $siswa,
        'jurusan' => $jurusan,
        // 'kelas' => $kelas,
        'isi'     => 'admin/siswa/siswaByJurusan'
      ];
     
      $this->load->view('layout/wrapper', $data);
    }else{
      $this->session->set_flashdata('sukses','Data Siswa Kosong');
      redirect('admin/siswa');
      // echo '<script>alert("Data Siswa Kosong");window.location="'.base_url("admin/siswa").'"</script>';
    }
  }

  public function siswa_by_kelas($id_jurusan,$kelas){
    $jurusan = $this->mAdmin->get('jurusan',NULL,'nama_jurusan','ASC')->result();
    $siswa = $this->mAdmin->batch_join(
      'siswa.*,jurusan.*,kelas.daftar_kelas',
      ['jurusan','kelas'],
      ['jurusan.id_jurusan = siswa.id_jurusan','kelas.id_kelas = siswa.id_kelas'],
      'siswa',"jurusan.id_jurusan = '$id_jurusan' && kelas.daftar_kelas = '$kelas'",NULL,'kelas.daftar_kelas','ASC'
    )->result();
    $kelas = $this->mAdmin->batch_join(
      'siswa.*,jurusan.*,kelas.daftar_kelas',
      ['jurusan','kelas'],
      ['jurusan.id_jurusan = siswa.id_jurusan','kelas.id_kelas = siswa.id_kelas'],
      'siswa',"jurusan.id_jurusan = '$id_jurusan'",'kelas.daftar_kelas','nis','ASC'
    )->result();
    // echo '<pre>';
    // var_dump($siswa);die();
    $data = [
        'title'   => 'Kelas '.strtoupper($siswa[0]->daftar_kelas). ' ' .$siswa[0]->nama_jurusan,
        'siswa'   => $siswa,
        'jurusan' => $jurusan,
        'kelas'   => $kelas,
        'isi'     => 'admin/siswa/siswaByKelas'
      ];
     
      $this->load->view('layout/wrapper', $data);
  }
  public function report_pdf(){
    $siswa = $this->mAdmin->batch_join(
      'siswa.*,jurusan.*,kelas.daftar_kelas',
      ['jurusan','kelas'],
      ['jurusan.id_jurusan = siswa.id_jurusan','kelas.id_kelas = siswa.id_kelas'],
      'siswa',NULL,NULL,'nis','ASC'
    )->result();
    $data = [
      'siswa' => $siswa,
      'judul' => 'SMK PGRI 3 CIMAHI'
    ];
    $this->load->view('contoh', $data);
  }
  public function report_pdf_by_jurusan($id_jurusan){
    $siswa = $this->mAdmin->batch_join(
      'siswa.*,jurusan.*,kelas.daftar_kelas',
      ['jurusan','kelas'],
      ['jurusan.id_jurusan = siswa.id_jurusan','kelas.id_kelas = siswa.id_kelas'],
      'siswa',"jurusan.id_jurusan = '$id_jurusan'",NULL,'nis','ASC'
    )->result();
    $data = [
      'judul' => 'Jurusan '.$siswa[0]->nama_jurusan,
      'siswa' => $siswa
    ];
    $this->load->view('contoh', $data);
  }
  public function report_pdf_by_kelas($id_jurusan,$kelas){
    $siswa = $this->mAdmin->batch_join(
      'siswa.*,jurusan.*,kelas.daftar_kelas',
      ['jurusan','kelas'],
      ['jurusan.id_jurusan = siswa.id_jurusan','kelas.id_kelas = siswa.id_kelas'],
      'siswa',"jurusan.id_jurusan = '$id_jurusan' && kelas.daftar_kelas = '$kelas'",NULL,'kelas.daftar_kelas','ASC'
    )->result();
    $data = [
      'judul' => 'Kelas '.strtoupper($siswa[0]->daftar_kelas) .' '. $siswa[0]->nama_jurusan,
      'siswa' => $siswa
    ];
    $this->load->view('contoh', $data);
  }

}

/* End of file Siswa.php */
/* Location: ./application/controllers/admin/Siswa.php */