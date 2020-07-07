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
		else{
			$data['sidebar'] = 'admin/sidebarPengacara';
		}
		$this->load->view('admin/index', $data);
		
	}

	public function daftarKasus()
	{	
		$this->loginProtocol();
		$tipe = $this->input->get('tipe');
		// $data['masalah'] = $this->Admin_model->getDB('masalah');
		$this->db->where('tanggal_jumpa IS NOT NULL', null);
		$this->db->where('status', 2);
		$data['masalah'] = $this->db->get('masalah')->result();
		$this->load->view('admin/page/daftarKasus', $data);		
	}

	public function kelolahKasus()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$data['info'] = $this->Admin_model->getDBSearch('masalah', 'id_masalah', $id);
		$row = $this->db->where('id_masalah', $id)->get('berkas')->num_rows();
		if ($row==0) {
			$data['berkas'] = false;
		}
		else{
			$data['berkas'] = true;
			$data['berkas'] = $this->Admin_model->getDBSearch('masalah', 'id_masalah', $id);	
		}
		$this->load->view('admin/page/kelolahKasus', $data);			
	}

	public function select_tambahDokumen()
	{
		$data["id"] =  $this->input->get('id');
		$this->load->view('admin/page/subpage/select_editPekerjaan', $data);			
	}

	public function select_editPekerjaan()
	{
		$data["id"] =  $this->input->get('id');
		$this->load->view('admin/page/subpage/select_editPekerjaan', $data);			
	}

	public function select_editTempatLahir()
	{
		$data["id"] =  $this->input->get('id');
		$this->load->view('admin/page/subpage/select_tempatLahir', $data);			
	}

	public function select_editTanggalLahir()
	{
		$data["id"] =  $this->input->get('id');
		$this->load->view('admin/page/subpage/select_tanggalLahir', $data);			
	}

	public function simpanPekerjaan()
	{
		$pekerjaan = $this->input->post('pekerjaan');
		$id = $this->input->post('id');
		$dataBaru = array('pekerjaan' => $pekerjaan);
		if ($this->Admin_model->editKasus($dataBaru, $id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function simpanTempatLahir()
	{
		$tempat = $this->input->post('tempat');
		$id = $this->input->post('id');
		$dataBaru = array('tempat_lahir' => $tempat);
		if ($this->Admin_model->editKasus($dataBaru, $id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function simpanTanggalLahir()
	{
		$tanggal = $this->input->post('tanggal');
		$id = $this->input->post('id');
		$dataBaru = array('tanggal_lahir' => $tanggal);
		if ($this->Admin_model->editKasus($dataBaru, $id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
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
		$this->loginProtocol();
		$id = $this->input->get('id');
		$status = $this->input->get('status');
		$data['id'] = $id;
		$data['status'] = $status;
		$data['dataP'] = $this->Admin_model->getDBSearch('a_users','id',$id);
		$data['masalah'] = $this->Admin_model->getDBSearch('masalah', 'id_p', $id);
		$this->load->view('admin/page/subpage/select_kelolahPengacara', $data);
	}

	public function select_kelolahMasalah()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$data['id'] = $id;
		$data['dataMasalah'] = $this->Admin_model->getDBSearch('masalah','id_masalah',$id);
		$this->load->view('admin/page/subpage/select_kelolahMasalah', $data);
	}

	public function select_kelolahMasalahBerjalan()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$data['id'] = $id;
		if ($this->session->userdata('level')==1) {
			$data['dataMasalah'] = $this->Admin_model->getDBSearch('masalah','id_masalah',$id);
			foreach ($data['dataMasalah'] as $key => $value) {
				$data['pengacara'] = $this->Admin_model->getDBSearch('a_users', 'id', $value->id_p);
			}
		}
		else{
			$data['dataMasalah'] = $this->Admin_model->getMasalahSayaID($id);
		}
		$this->load->view('admin/page/subpage/select_kelolahMasalahBerjalan', $data);
	}

	public function select_hapusPengacara()
	{
		$this->loginProtocol();
		$id = $this->input->post('id');
		if ($this->Admin_model->dbDelete('a_users','id',$id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function select_statusPengacara()
	{
		$this->loginProtocol();
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
		$this->loginProtocol();
		$id = $this->input->get('id');
		$data['dataPengacara'] = $this->Admin_model->getDBSearch('a_users','id',$id);
		$this->load->view('admin/page/subpage/select_editPengacara', $data);	
	}

	public function select_pilihPengacara()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		// $data['dataPengacara'] = $this->Admin_model->getDBSearch('pengacara','id_p',$id);
		$data['id'] = $id;
		$data['daftarPengacara'] = $this->Admin_model->getDBSearch('a_users', 'level', 2);
		$this->load->view('admin/page/subpage/select_pilihPengacara', $data);	
	}

	public function select_pilihPengacaraBerjalan()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		// $data['dataPengacara'] = $this->Admin_model->getDBSearch('pengacara','id_p',$id);
		$data['id'] = $id;
		$data['daftarPengacara'] = $this->Admin_model->getDBSearch('a_users', 'level', 2);
		$this->load->view('admin/page/subpage/select_pilihPengacaraBerjalan', $data);	
	}

	public function pilihMasalah()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/pilihMasalah');
	}

	public function pilihMasalahSaya()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/pilihMasalahSaya');
	}

	public function kelolahTanggal()
	{
		$data['id'] = $this->input->get('id');
		// echo $data['id'];
		$this->load->view('admin/page/subpage/select_pilihTanggal', $data);
	}

	public function simpanTanggal()
	{
		$tanggal = $this->input->post('tanggal');
		$id = $this->input->post('id');
		$dataBaru = array('tanggal_jumpa' => $tanggal);
		if ($this->Admin_model->editKasus($dataBaru, $id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function daftarMasalah()
	{	
		$this->loginProtocol();
		$tipe = $this->input->get('tipe');
		// $data['masalah'] = $this->Admin_model->getDB('masalah');
		if ($tipe==4) {
			$data['masalah'] = $this->Admin_model->getMasalah34(1);	
		}
		elseif ($tipe==22) {
			$this->db->where('id_p', $this->session->userdata('id_u'));
			$this->db->where('tanggal_jumpa IS NULL', null, true);
			$this->db->where('status', 2);
			$data['masalah'] = $this->db->get('masalah')->result();
		}
		elseif ($tipe==33) {
			$data['masalah'] = $this->Admin_model->getMasalah34(2);	
		}
		else{
			$data['masalah'] = $this->Admin_model->getDBSearch('masalah','status', $tipe);
		}
		$data['tipe'] = $tipe;
		$this->load->view('admin/page/daftarMasalah', $data);		
	}

	public function daftarPengacara()
	{
		$this->loginProtocol();
		$data ['daftarPengacara'] = $this->Admin_model->getDBSearch('a_users', 'level', 2);
		$this->load->view('admin/page/daftarPengacara', $data);
	}

	public function select_statusMasalah(){
		$this->loginProtocol();
		$id = $this->input->post('id');
		if ($this->Admin_model->gantiStatusKasus($id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function prosespilihPengacara()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$id = $this->input->post('id');
		$dataBaru = array('id_p' => $nama, 'status' => '2');
		if ($this->Admin_model->editKasus($dataBaru, $id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function prosespilihPengacaraBerjalan()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$id = $this->input->post('id');
		$dataBaru = array('id_p' => $nama);
		if ($this->Admin_model->editKasus($dataBaru, $id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function proseseditPengacara()
	{
		$this->loginProtocol();
		$id_p = $this->input->post('id_p');
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
            if ($this->Admin_model->editPengacara($dataKirim, $id_p)==TRUE) {
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

	public function prosestambahPengacara()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$foto = $this->input->post('foto');
		$email = $this->input->post('email');
		$nohp = $this->input->post('nohp');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$config['upload_path']="./public/pengacara/foto/"; //path folder file upload
        $config['allowed_types']='*'; //type file yang boleh di upload
        $config['encrypt_name'] = TRUE; //enkripsi file name upload
        $this->load->library('upload',$config,'fotoup'); //call library upload 
        $this->fotoup->initialize($config);

        if($this->fotoup->do_upload("foto")){ //upload file
            $data = array('upload_data' => $this->fotoup->data()); //ambil file name yang diupload
            $image= $data['upload_data']['file_name'];

            $dataKirim = array( 'username' => $username, 'password' => $password, 'nama' => $nama,  'foto' => $image,  'email' => $email,  'nohp' => $nohp, 'level' => 2);
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

	public function log_admin()
	{
		$this->loginProtocol();
		$data['log'] = $this->Admin_model->getDB('log_admin_u');
		$this->load->view('admin/page/logUser', $data);
	}

	public function kelolahAkun()
	{
		$this->loginProtocol();
		$data['admin'] = $this->Admin_model->getDBSearch('a_users', 'level', '1');
		$data['pengacara'] = $this->Admin_model->getDBSearch('a_users', 'level', '2');
		$this->load->view('admin/page/kelolahAkun', $data);	
	}

	public function tambahAdmin()
	{
		$this->load->view('admin/page/tambahAdmin');
	}

	public function tambahAkunPengacara()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/tambahAkunPengacara');
	}

	public function cekUsername()
	{
		$this->loginProtocol();
		$ur = $this->input->post('ur');
		$this->db->where('username', $ur);
		$result = $this->db->get('a_users')->num_rows();
		if ($result!=0) {
			echo "0";
		}
		else{
			echo "1";
		}
	}

	public function prosestambahAdminDirekturPengacara()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$passwordA = $this->input->post('password');	
		$level = $this->input->post('level');	

		$password = password_hash($passwordA, PASSWORD_DEFAULT);
		$dataBaru = array('level' => $level, 'nama' => $nama, 'username' => $username, 'email' => $email, 'password' => $password);
		if ($this->Admin_model->tambahAkun($dataBaru)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function login()
	{
		// $this->loginProtocol();
		$this->session->sess_destroy();
		$this->load->view('admin/login');
	}

	public function prosesLogin()
	{
		// $this->loginProtocol();
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
