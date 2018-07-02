<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function zona_waktu($lokasi){
		return date_default_timezone_set($lokasi);
	}
	public function index(){
		$this->load->view('auth');
	}
	public function login(){
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query = $this->mAdmin->get_where('pengguna',['username' => $username, 'password' => $password])->row();
		
    
		if(count($query) > 0 && $query->hak_akses == 'admin'){
			$session = [
				'id_pengguna' => $query->id_pengguna,
				'username'	 	=> $query->username,
				'hak_akses'		=> 'admin'
			];
			$this->session->set_userdata($session);
			
			redirect('admin/dashboard');
		}elseif(count($query) > 0 && $query->hak_akses == 'guru'){
			$session = [
				'id_pengguna' => $query->id_pengguna,
				'id_guru' 		=> $query->id_guru,
				'username'	 	=> $query->username,
				'hak_akses'		=> 'guru'
			];
			$this->session->set_userdata($session);
			redirect('admin/dashboard');
		}elseif(count($query) > 0 && $query->hak_akses == 'siswa'){
			$session = [
				'id_pengguna' => $query->id_pengguna,
				'id_siswa' 		=> $query->id_siswa,
				'username'	 	=> $username,
				'hak_akses'		=> 'siswa'
			];
			$this->session->set_userdata($session);
			redirect('admin/siswa');
		}else{
			$this->session->set_flashdata('gagal','username atau password anda salah');
			redirect('auth');
		}
	}

	public function logout(){
		
		$this->session->sess_destroy();
		redirect('auth');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */