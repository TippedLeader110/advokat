<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_mobile extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');

	}

	public function index()
	{
		$file_path = "file/";
		$file_path = $file_path . basename($_FILES['uploaded_file']['name']);

		if (move_uploaded_file($_FILES['uploaded_file']['name'], $file_path)) {
			echo "success";
		}else{
			echo "error";
		}
		
	}

}

?>