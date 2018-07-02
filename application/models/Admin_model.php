<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	//CARA MENGGUNAKAN QUERY JOIN DENGAN KONDISI TERTENTU//
 	// $aktif = 'aktif';
  // $id_siswa = 'id_siswa';
  // $cek = $this->mAdmin->join(
  //   'siswa.nama,
  //   jurusan.nama_jurusan',
  //   'jurusan',
  //   'jurusan.id_jurusan = siswa.id_jurusan',
  //   'siswa',
  //   "status = '$id_siswa'"
  // )->result();
  // echo "<pre>";
  // var_dump($cek);die();
	// public function batchInsert($data){
	// 	$count = count($data['count']);
	// 	for($i = 0; $i<$count; $i++){
	// 		$entries[] = array(
	// 			'id_guru'				=>	$data['id_guru'][$i],
	// 			'id_kelas'			=>	$data['id_kelas'][$i],
	// 			'id_jurusan'		=>	$data['id_jurusan'][$i],
	// 			'id_pelajaran'	=>	$data['id_pelajaran'][$i],
	// 			'hari'					=>	$data['hari'][$i],
	// 			'jam'						=>	$data['jam'][$i],
	// 		);
	// 	}
	// 	$this->db->insert_batch('jadwal', $entries); 
	// 	if($this->db->affected_rows() > 0)
	// 		return 1;
	// 	else
	// 		return 0;
	// }
	public function batch_join($field,$table_join,$on,$table,$where=NULL,$group_by=NULL,$order=NULL,$by=NULL){
		$this->db->select($field);
		$this->db->from($table);
		if(is_array($table_join) && is_array($on)){ 
			$i = 0;
      foreach($table_join as $row){
		    if (is_array($row)) {
          $this->db->join($row['table'], $on[$i], $row['type']);
        } else {
          $this->db->join($row, $on[$i],'LEFT');
        }
        $i++;
      }
		} else {
			$this->db->join($table_join, $on,'LEFT');
		} 
		// $this->db->join($table_join,$on,'LEFT');
		// if($table_join_1 != ""){$this->db->join($table_join_1,$on_1,'LEFT');}
		if($where != ""){$this->db->where($where);}
		if($group_by != ""){$this->db->group_by($group_by);}
		if($order != ""){$this->db->order_by($order,$by);}
		$query = $this->db->get();
		return $query;
	}
	public function join($field,$table_join,$on,$table,$where=NULL,$group_by=NULL,$order=NULL,$by=NULL){
		$this->db->select($field);
		$this->db->from($table);
		$this->db->join($table_join,$on,'LEFT');
		if($where != ""){$this->db->where($where);}
		if($group_by != ""){$this->db->group_by($group_by);}
		if($order != ""){$this->db->order_by($order,$by);}
		$query = $this->db->get();
		return $query;
	}
	public function insert($table, $data){
		$query = $this->db->insert($table,$data);
		if($query){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function get($table,$group_by=NULL,$order=NULL,$by=NULL){
		if($group_by != ""){$this->db->group_by($group_by);}
		if($order != ""){$this->db->order_by($order,$by);}
		$query = $this->db->get($table);
		return $query;
	}
	public function get_where($table,$where){
		$query = $this->db->get_where($table,$where);
		return $query;
	}
	public function update($table,$data,$where){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	public function delete($table,$where){
		$this->db->where($where);
		$this->db->delete($table);
	}

	
	
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */