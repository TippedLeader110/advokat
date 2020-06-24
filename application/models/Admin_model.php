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


		// $user = $this->db
		// 	->where('username', $user_real)
		// 	->get('a_users');
		// // var_dump($user_real);die;
		// // var_dump($user->result());die;
		// $match = password_verify($pwd , $user->row()->password);
		// $id = $user->row()->id_user;
		// $nama = $user->row()->nama;
		// $user = $user->row()->username;
		// if ($match) {
		// 		$this->session->set_userdata([
		// 			'id' =>  $id,
		// 			'status' => 'login-admin',
		// 			'name' => $nama
		// 		]);
		// 		$this->logLoginAdmin();
		// 		return 1;
		// }
		// else
		// {
		// 	return 0;
		// }
	}

	public function logLoginAdmin($u){
		$ip = $this->getIP();
		$user = $u;
		$query = $this->db
			->where('username', $user)
			->get('a_users');
		$idU = $query->row()->id;
		$data = array('ip' => $ip,
			'status' => 'Login Admin',
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
}

?>