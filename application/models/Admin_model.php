<?php
define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function doLogin($user_real, $password)
	{
		$cari = $this->db->where('username',$user_real)->get('a_users');
		// var_dump($user_real);
		$match = password_verify($password , $cari->row()->password);
		// echo $cari->num_rows();
		if ($match) {
			// echo "1";
			if ($cari->num_rows()!=0) {
				$sesi = array(
				'email' => $cari->row()->email,
				'login' => 'true',
				'full_name' => $cari->row()->nama,
				'id_u' => $cari->row()->id,
				'level' => $cari->row()->level
			);
			// echo "2";
			$this->session->set_userdata($sesi);
			$this->logLoginAdmin($user_real);
			// echo "3";
			return true;
			}
		}
		else{
			return false;
		}
	}

	public function getDB($db)
	{
		return $this->db->get($db)->result();
	}

	public function getDBSearch($db, $kolom, $cari)
	{
		$this->db->where($kolom, $cari);
		return $this->db->get($db)->result();
	}

	public function dbDelete($db, $kolom, $cari)
	{
		$this->db->where($kolom, $cari);
		if ($this->db->delete($db)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function gantiStatuspengacara($id)
	{
		$stat = $this->db->where('id_p', $id)->get('pengacara')->row()->status;
		if ($stat==1) {
			$this->db->set('status', 0);
		}
		else{
			$this->db->set('status', 1);	
		}
		if ($this->db->where('id_p', $id)->update('pengacara')) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function pilihPengacara($data, $id)
	{
		$this->db->where('id_masalah', $id);
		if ($this->db->update('masalah', $data)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function tambahAkun($data){
		if ($this->db->insert('a_users', $data)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function logLoginAdmin($u){
		$ip = $this->getIP();
		$user = $u;
		$query = $this->db
			->where('username', $user)
			->get('a_users');
		$idU = $query->row()->id;
		if ($this->session->userdata('level')==1) {
			$ket = 'Admin';
		}
		else{
			$ket = 'Direktur';
		}
		$data = array('ip' => $ip,
			'status' => 'Login '.$ket ,
			'waktu' => date("Y-m-d H:i:s"),
			'id_admin' => $idU
		 );
		$this->db->insert('log_admin', $data);
	}

	public function getIP(){
		$ip = getenv('HTTP_CLIENT_IP')?:
		getenv('HTTP_X_FORWARDED_FOR')?:
		getenv('HTTP_X_FORWARDED')?:
		getenv('HTTP_FORWARDED_FOR')?:
		getenv('HTTP_FORWARDED')?:
		getenv('REMOTE_ADDR');
		return $ip;
	}

	public function tambahPengacara($data)
	{
		if ($this->db->insert('pengacara', $data)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function editPengacara($data, $id_p)
	{
		$this->db->where('id_p', $id_p);
		if ($this->db->update('pengacara', $data)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}

?>