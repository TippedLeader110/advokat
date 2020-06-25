<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$this->loginProtocol();
		// $data['page'] = 'admin/page/welcome';
		if ($this->session->userdata('level') == 1) {
			$data['sidebar'] = 'admin/sidebarAdmin';
		}
		$this->load->view('admin/index', $data);
	}

	public function laporanSingkat()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/laporanSingkat');
	}

	public function tambahPengacara()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/tambahPengacara');	
	}

	public function kelolahPengacara()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/kelolahPengacara');	
	}

	public function select_kelolahPengacara()
	{
		$id = $this->input->get('id');
		$status = $this->input->get('status');
		$data['id'] = $id;
		$data['status'] = $status;
		// $data['daftarPengacara'] = $this->Admin_model->getDBSearch('pengacara','id_p',$id);
		$this->load->view('admin/page/subpage/select_kelolahPengacara', $data);
	}

	public function select_hapusPengacara()
	{
		$id = $this->input->post('id');
		if ($this->Admin_model->dbDelete('pengacara','id_p',$id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function select_statusPengacara()
	{
		$id = $this->input->post('id');
		if ($this->Admin_model->gantiStatuspengacara($id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function select_editPengacara()
	{
		$id = $this->input->get('id');
		$data['dataPengacara'] = $this->Admin_model->getDBSearch('pengacara','id_p',$id);
		$this->load->view('admin/page/subpage/select_editPengacara', $data);	
	}

	public function daftarPengacara()
	{
		$this->loginProtocol();
		$data ['daftarPengacara'] = $this->Admin_model->getDB('pengacara');
		$this->load->view('admin/page/daftarPengacara', $data);
	}

	public function prosestambahPengacara()
	{
		$nama = $this->input->post('nama');
		$foto = $this->input->post('foto');
		$email = $this->input->post('email');
		$nohp = $this->input->post('nohp');

		$config['upload_path']="./public/pengacara/foto/"; //path folder file upload
        $config['allowed_types']='*'; //type file yang boleh di upload
        $config['encrypt_name'] = TRUE; //enkripsi file name upload
        $this->load->library('upload',$config,'fotoup'); //call library upload 
        $this->fotoup->initialize($config);

        if($this->fotoup->do_upload("foto")){ //upload file
            $data = array('upload_data' => $this->fotoup->data()); //ambil file name yang diupload
            $image= $data['upload_data']['file_name'];

            $dataKirim = array( 'nama' => $nama,  'foto' => $image,  'email' => $email,  'nohp' => $nohp);
            if ($this->Admin_model->tambahPengacara($dataKirim)==TRUE) {
				echo "1";
			}
			else{
				echo "0";
			}
        }
        else{
        	echo "0";
        }
	}

	public function loginProtocol()
	{
		if(($this->session->userdata('login') == "true")){
			
		}
		else{
			redirect(base_url("admin/login"));
		}
	}

	public function login()
	{
		$this->session->sess_destroy();
		$this->load->view('admin/login');
	}

	public function prosesLogin()
	{
		$username = $this->input->post('user');
		$password = $this->input->post('pwd');
		if ($this->Admin_model->doLogin($username,$password)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function test(){
		$a = 'admin';
		$p = password_hash("admin", PASSWORD_DEFAULT);
		$data = ['username'=>$a, 'password' => $p];
		$this->db->insert('a_users', $data);
		echo "Done with username = ".$a."and password = ".$a." with hash = ".$p;
	}
}
