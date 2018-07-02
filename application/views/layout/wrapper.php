<?php 
  $id_guru= $this->session->userdata('id_guru');
  $guru   = $this->mAdmin->get_where('guru',['id_guru' => $id_guru])->row();
  $id_siswa= $this->session->userdata('id_siswa');
  $siswa   = $this->mAdmin->get_where('siswa',['id_siswa' => $id_siswa])->row();

  if($this->session->userdata('hak_akses') == '') {
  	$this->session->set_flashdata('gagal','Mohon Untuk Login Terlebih Dahulu');
  	redirect('auth');
  }
	include 'head.php';
  include 'header.php';
  include 'sidebar.php';
  include 'content.php';
  include 'footer.php';
?>