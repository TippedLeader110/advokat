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

	public function kelolaKasus()
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
			$data['berkasArray'] = $this->Admin_model->getDBSearch('berkas', 'id_masalah', $id);	
		}
		$this->load->view('admin/page/kelolaKasus', $data);			
	}

	public function hapusDokumen()
	{
		$this->loginProtocol();
		$id = $this->input->post('id');
		if ($this->Admin_model->dbDelete('berkas','id_berkas',$id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function modal_tambahDokumen()
	{
		$this->loginProtocol();
		$data["id"] =  $this->input->get('id');
		$this->load->view('admin/page/subpage/modal_tambahDokumen', $data);			
	}

	public function tambahDokumen()
	{
		$this->loginProtocol();
		$namaBerkas = $this->input->post('namaBerkas');
		$id = $this->input->post('id');
		// echo $namaBerkas;
		// $berkas = $this->input->post('berkas');
		// echo $berkas;
		$config['upload_path']="./public/kasus/berkas/"; //path folder file upload
        $config['allowed_types']='*'; //type file yang boleh di upload
        $config['encrypt_name'] = TRUE; //enkripsi file name upload
        $this->load->library('upload',$config,'berkasUPLOAD'); //call library upload 
        $this->berkasUPLOAD->initialize($config);

        if($this->berkasUPLOAD->do_upload("berkas")){ //upload file
            $data = array('upload_data' => $this->berkasUPLOAD->data()); //ambil file name yang diupload
            $Nberkas = $data['upload_data']['file_name'];

            $dataKirim = array('id_masalah' => $id, 'nama_berkas' => $namaBerkas, 'file' => $Nberkas);
			if ($this->Admin_model->tambahBerkas($dataKirim, $id)==TRUE) {
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

	public function statusKasus()
	{
		$stat = $this->input->get('stat');
		$id = $this->input->post('id');
		$dataKirim = array('status' => $stat);
		if ($this->Admin_model->editKasus($dataKirim, $id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function modal_editPekerjaan()
	{
		$this->loginProtocol();
		$data["id"] =  $this->input->get('id');
		$this->load->view('admin/page/subpage/modal_editPekerjaan', $data);			
	}

	public function modal_editTempatLahir()
	{
		$this->loginProtocol();
		$data["id"] =  $this->input->get('id');
		$this->load->view('admin/page/subpage/modal_tempatLahir', $data);			
	}

	public function modal_editTanggalLahir()
	{
		$this->loginProtocol();
		$data["id"] =  $this->input->get('id');
		$this->load->view('admin/page/subpage/modal_tanggalLahir', $data);			
	}

	public function simpanPekerjaan()
	{
		$this->loginProtocol();
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
		$this->loginProtocol();
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
		$this->loginProtocol();
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

	public function editPassword()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/editPassword');	
	}

	public function laporanSingkat()
	{
		$this->loginProtocol();
		$data['total_kasus'] = $this->db->get('masalah')->num_rows();
		$data['kasus_baru'] = $this->db->where('status', 1)->get('masalah')->num_rows();
		$data['kasus_berjalan'] = $this->db->where('status', 2)->get('masalah')->num_rows();
		$data['kasus_selesai'] = $this->db->where('status', 3)->get('masalah')->num_rows();
		$data['kasus_ditolak'] = $this->db->where('status', 0)->get('masalah')->num_rows();
		$data['kasus_ditutup'] = $this->db->where('status', 4)->get('masalah')->num_rows();
		$this->load->view('admin/page/laporanSingkat', $data);
	}

	public function tambahPengacara()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/tambahPengacara');	
	}

	public function kelolaPengacara()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/kelolaPengacara');	
	}

	public function modal_kelolaPengacara()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$status = $this->input->get('status');
		$data['id'] = $id;
		$data['status'] = $status;
		$data['dataP'] = $this->Admin_model->getDBSearch('a_users','id',$id);
		$data['masalah'] = $this->Admin_model->getDBSearch('masalah', 'id_p', $id);
		$this->load->view('admin/page/subpage/modal_kelolaPengacara', $data);
	}

	public function modal_kelolaMasalah()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$data['id'] = $id;
		$data['dataMasalah'] = $this->Admin_model->getDBSearch('masalah','id_masalah',$id);
		$this->load->view('admin/page/subpage/modal_kelolaMasalah', $data);
	}

	public function modal_kelolaMasalahBerjalan()
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
		$this->load->view('admin/page/subpage/modal_kelolaMasalahBerjalan', $data);
	}

	public function modal_hapusPengacara()
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

	public function modal_statusPengacara()
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

	public function modal_editPengacara()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$data['dataPengacara'] = $this->Admin_model->getDBSearch('a_users','id',$id);
		$this->load->view('admin/page/subpage/modal_editPengacara', $data);	
	}

	public function modal_pilihPengacara()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		// $data['dataPengacara'] = $this->Admin_model->getDBSearch('pengacara','id_p',$id);
		$data['id'] = $id;
		$data['daftarPengacara'] = $this->Admin_model->getDBSearch('a_users', 'level', 2);
		$this->load->view('admin/page/subpage/modal_pilihPengacara', $data);	
	}

	public function modal_pilihPengacaraBerjalan()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		// $data['dataPengacara'] = $this->Admin_model->getDBSearch('pengacara','id_p',$id);
		$data['id'] = $id;
		$data['daftarPengacara'] = $this->Admin_model->getDBSearch('a_users', 'level', 2);
		$this->load->view('admin/page/subpage/modal_pilihPengacaraBerjalan', $data);	
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

	public function kelolaTanggal()
	{
		$data['id'] = $this->input->get('id');
		// echo $data['id'];
		$this->load->view('admin/page/subpage/modal_pilihTanggal', $data);
	}

	public function editTanggal()
	{
		$data['id'] = $this->input->get('id');
		// echo $data['id'];
		$this->load->view('admin/page/subpage/modal_editTanggal', $data);
	}

	public function simpanTanggal()
	{
		$tanggal = $this->input->post('tanggal');
		$id = $this->input->post('id');
		$dataBaru = array('tanggal_jumpa' => $tanggal);
		if ($this->Admin_model->editKasus($dataBaru, $id)==TRUE) {
			$id_p = $this->db->where('id_masalah', $id)->get('masalah')->row()->id_p;
			if ($this->Admin_model->tanggalSend($id_p, $id)==TRUE) {
				echo "1";
			}
			else{
				echo "NotSEND";
			}
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
		$def = 'admin/page/daftarMasalah';
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
		elseif ($tipe=='all')
		{
			$def = 'admin/page/daftarKasus';
			$data['masalah'] = $this->Admin_model->getDBSearch('masalah','id_p',$this->session->userdata('id_u'));		
		}
		else{
			$data['masalah'] = $this->Admin_model->getDBSearch('masalah','status', $tipe);
		}
		$data['tipe'] = $tipe;
		$this->load->view($def, $data);		
	}

	public function daftarPengacara()
	{
		$this->loginProtocol();
		$data ['daftarPengacara'] = $this->Admin_model->getDBSearch('a_users', 'level', 2);
		$this->load->view('admin/page/daftarPengacara', $data);
	}

	public function modal_statusMasalah(){
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
		$password = password_hash($password, PASSWORD_DEFAULT);

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

	public function kelolaAkun()
	{
		$this->loginProtocol();
		$data['admin'] = $this->Admin_model->getDBSearch('a_users', 'level', '1');
		$data['pengacara'] = $this->Admin_model->getDBSearch('a_users', 'level', '2');
		$this->load->view('admin/page/kelolaAkun', $data);	
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

	public function proseseditPassword()
	{
		$this->loginProtocol();
		$id_u = $this->input->post('id_u');
		$passBaru = $this->input->post('passBaru');
		$passBaru = password_hash($passBaru, PASSWORD_DEFAULT);
		$this->db->where('id', $id_u);
		if ($this->db->set('password', $passBaru)->update('a_users')) {
			echo "1";
		}
		else{
			echo "0";
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
