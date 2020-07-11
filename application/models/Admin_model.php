<?php
define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Admin_model extends CI_Model {

	 public function __construct() { 
        parent::__construct(); 
        require APPPATH.'third_party/PHPMailer/Exception.php';
        require APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require APPPATH.'third_party/PHPMailer/SMTP.php';
    }

    public function tanggalSend($id_pengacara, $id_masalah)
    {
    	$rowP = $this->db->where('id', $id_pengacara)->get('a_users')->row();
    	$rowM = $this->db->where('id_masalah', $id_masalah)->get('masalah')->row();
       	$mail = new PHPMailer();
            //Tell PHPMailer to use SMTP
            $mail->isSMTP();
            //Enable SMTP debugging
            // SMTP::DEBUG_OFF = off (for production use)
            // SMTP::DEBUG_CLIENT = client messages
            // SMTP::DEBUG_SERVER = client and server messages
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';
            // use
            // $mail->Host = gethostbyname('smtp.gmail.com');
            // if your network does not support SMTP over IPv6
            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;
            //Set the encryption mechanism to use - STARTTLS or SMTPS
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = 'itfestususend@gmail.com';
            //Password to use for SMTP authentication
            $mail->Password = 'pkkillbwkjrjtalj';
            //Set who the message is to be sent from
          	$mail->setFrom('donot-reply-itfestusu@gmail.com', 'Advokat');  
            //Set an alternative reply-to address
            $mail->addReplyTo('itfestusu@gmail.com');
            //Set who the message is to be sent to
            $mail->addAddress($rowM->email);
            //Set the subject line
             $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Jadwal Jumpa dengan Pengacara';
            $mail->Body    = '
			<div class="container" style="font-family:Arial, Helvetica, sans-serif; font-size:18px;">
				<div class="row">
					<div class="col align-self-center con border" style="margin-top: 25px;
					margin-bottom: 25px;
					padding: 20px 20px 20px 20px;
					">
						<p>Kepada, <span class="user" style="font-weight: 500;">'.$rowM->nama.'</span>!</p>
						<p>
							Permintaan bantuan kasus <b>'.$rowM->deskripsi.'</b> telah diterima dan akan diproses. Silahkan menghubungi pengacara yang bersangkutan berdasarkan data dibawah untuk perekaman data lebih lanjut<br>
						</p>
						<table>
							<tr>
								<td>Nama</td><td>:</td><td>'.$rowP->nama.' </td>
							</tr>
							<tr>
								<td>Nama</td><td>:</td><td>'.$rowP->email.' </td>
							</tr>
							<tr>
								<td>Nama</td><td>:</td><td>'.$rowP->nohp.' </td>
							</tr>
						</table>
						<p>
						<center>Jadwal Pemohon</center>
						<center>
							<table border="1">
								<tr>
									<th>ID pemohon</th><th>Nama Pemohon</th><th>Tanggal Jumpa</th><th>Kasus</th>
								</tr>
								<tr>
									<td>'.$id_masalah.'</td>
									<td>'.$rowM->nama.'</td>
									<td>'.$rowM->tanggal_jumpa.'</td>
									<td>'.$rowM->deskripsi.'</td>
								</tr>
							</table>
						</center>
						<p>Jika ada keluhan anda dapat menghubungi cs : emailperusahaan@gmail.com</p>
						<br>
						<p>
							Terima Kasih.
						</p>
						<br>
					</div>
				</div>
			</div>
			';
            if (!$mail->send()) {
                return false;
                // echo 'Mailer Error: '. $mail->ErrorInfo;
            } else {
                return true;
            }
    }

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

	public function getMasalahSayaID($id)
	{
		$this->db->where('id_p', $this->session->userdata('id_u'));
		$this->db->where('id_masalah', $id);
		return $this->db->get('masalah')->result();
	}

	public function getMasalah34($tipe)
	{
		if ($tipe==1) {
			$this->db->where("(status=3 or status=4)");
		}
		else{
			$this->db->where('id_p', $this->session->userdata('id_u'));
			$this->db->where('tanggal_jumpa IS NOT NULL', null, false);
			$this->db->where("(status=3 or status=4)");
		}
		return $this->db->get('masalah')->result();
	}

	public function gantiStatuspengacara($id)
	{
		$stat = $this->db->where('id', $id)->get('a_users')->row()->status;
		if ($stat==1) {
			$this->db->set('status', 0);
		}
		else{
			$this->db->set('status', 1);	
		}
		if ($this->db->where('id', $id)->update('a_users')) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}


	public function gantiStatusKasus($id)
	{
		$this->db->where('id_masalah', $id);
		$row = $this->db->get('masalah')->row();
		if ($row->status==1) {
			$this->db->set('status', 0);
		}
		elseif ($row->status==2) {
			$this->db->set('status', 4);
		}
		elseif ($row->status==4) {
			$this->db->set('status', 2);
		}
		else{
			$this->db->set('status', 1);	
		}
		if ($this->db->update('masalah')) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function editKasus($data, $id)
	{
		$this->db->where('id_masalah', $id);
		if ($this->db->update('masalah', $data)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function tambahBerkas($data, $id)
	{
		if ($this->db->insert('berkas', $data)) {
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
		if ($this->db->insert('a_users', $data)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function editPengacara($data, $id_p)
	{
		$this->db->where('id', $id_p);
		if ($this->db->update('a_users', $data)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}

?>