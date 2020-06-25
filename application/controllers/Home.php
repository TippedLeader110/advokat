<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->model('Home_model');

	}

	public function index()
	{
		$data['page'] = 'home/page/welcome';
		$this->load->view('home/index', $data);
	}

	public function tambahAduan()
	{
		$name = $this->input->post('name');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$ktp = $this->input->post('ktp');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$message = $this->input->post('message');
		$dataKirim = array(
			'nama' => $name,
			'alamat' => $alamat,
			'jenis_kelamin' => $jk,
			'email' => $email,
			'deskripsi' => $message,
			'nohp' => $phone,
			'ktp' => $ktp
		);
		if ($this->Home_model->kirim_aduan($dataKirim) == TRUE) {
			echo "1";	
		}
		else{
			echo "0";
		}
	}
}
