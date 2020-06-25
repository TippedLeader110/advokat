<?php
define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function kirim_aduan($arr){
		if ($this->db->insert('pemohon',$arr)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
}

?>