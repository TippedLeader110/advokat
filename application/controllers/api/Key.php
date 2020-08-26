<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Key extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Admin_model');

    }

    function upload_post(){

        if ($this->checkToken($this->post("token"))) {
            if (!empty($_FILES)) {
                $fileName = $_FILES['file']['name'];
                $config['upload_path'] = './public/kasus/berkas';
                $config['file_name'] = $fileName;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['file_ext_tolower']=TRUE;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload("file")) {
                    $status['error'] =$this->upload->display_errors('', '');
                    $status['status'] = 2;
                }else {
                    $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
                    $Nberkas = $data['upload_data']['file_name'];
                    $dataInsert = array('file' => $Nberkas,
                                'nama_berkas' => $this->post('nama_file'),
                                'id_masalah' => $this->post('id')
                                );
                    $this->db->insert("berkas", $dataInsert);
                    $status['error']=false;
                    $status['status'] = 1;
                }
            }else{
                $status['error']=true;
                $status['status'] = 3;
            }
        }
        else{
            $status['error']=true;
            $status['status'] = 10;
        }
        echo json_encode($status);
    }

    public function login_post()
    {
        // Users from a data store e.g. database
        $username = $this->post('username');
        $password = $this->post('password');
        $cari = $this->db->where('username',$username)->get('a_users');
        // var_dump($user_real);
        
        // echo $cari->num_rows();
        if ($cari->num_rows()!=0) {
            if (password_verify($password , $cari->row()->password)) {
                $result = $this->db->where('id', $cari->row()->id)->get('a_users')->row();
                //Generate kode_seminar
                $huruf_random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4);
                $tanggal_waktu = date('dmHis');
                $date = date('Y-m-d');
                $kode_token = $huruf_random."".$tanggal_waktu;
                $kode_token = md5($kode_token);
                $dataToken = array('token_key' => $kode_token, 'expired' => $date, 'id_users' => $result->id);
                $this->db->insert('token_api',$dataToken);
                // var_dump($result->id);
                $response['uid'] = $result->id;
                $response['error'] = false;
                $response['name'] = $result->nama;
                $response['token'] = $kode_token;
                $response['email'] = $result->nama;
                $response['level'] = $result->level;
                $this->response($response, REST_Controller::HTTP_OK);    
            }
            else{
                $this->response(['error'=>true], REST_Controller::HTTP_OK);
            }
        }
        else{
            $this->response(['error'=>true], REST_Controller::HTTP_OK);
        }
    }

    public function kasus_get()
    {
        // Users from a data store e.g. database
        $res = $this->db->get('masalah')->result();
        $resA = $this->db->where('level', 2)->get('a_users')->result();
        $maxid = 0;
        $row = $this->db->query("SELECT MAX(update_time) AS upd FROM masalah ")->row();
        $max = $row->upd; 
        $response = array('update_time' => $max, 'kasus' => $res, 'pengacara' => $resA);
        if ($res) {
            $this->response($response, REST_Controller::HTTP_OK);
        }
        else{
            $this->response(['error'=>true], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function kasus_post()
    {
        // Users from a data store e.g. database
        if ($this->checkToken($this->post("token"))) {
            if ($this->post('level')!=1) {
                $id_users = $this->db->where('token_key', $this->post("token"))->get('token_api')->row()->id_users;            
                $this->db->where('id_p', $id_users);
            }
            $res = $this->db->get('masalah')->result();
            $resA = $this->db->where('level', 2)->get('a_users')->result();
            $maxid = 0;
            $row = $this->db->query("SELECT MAX(update_time) AS upd FROM masalah ")->row();
            $max = $row->upd; 
            $response = array('update_time' => $max, 'kasus' => $res, 'pengacara' => $resA);
            if ($res) {
                $this->response($response, REST_Controller::HTTP_OK);
            }
            else{
                $this->response(['error'=>'fail'], REST_Controller::HTTP_OK);   
            }   
        }else{
            $this->response(['error'=>true], REST_Controller::HTTP_OK);   
        }
    }

    public function editKasus_post()
    {
        if ($this->checkToken($this->post("token"))) {
            $tanggal = $this->post('tanggal');
            $tempat = $this->post('tempat');
            $pekerjaan = $this->post('pekerjaan');
            $id = $this->post('id');
            $this->db->set('tanggal_lahir', $tanggal);
            $this->db->set('tempat_lahir', $tempat);
            $this->db->set('pekerjaan', $pekerjaan);
            $this->db->where('id_masalah', $id);
            if ($this->db->update('masalah')) {
                $this->response(['error'=>false], REST_Controller::HTTP_OK);   
            }
            else{
                $this->response(['error'=>'fail'], REST_Controller::HTTP_OK);   
            }   
        }else{
            $this->response(['error'=>true], REST_Controller::HTTP_OK);   
        }
    }

    public function gantiTanggal_post()
    {
        // Users from a data store e.g. database
        if ($this->checkToken($this->post("token"))) {
            $tanggal = $this->post('tanggal');
            $id = $this->post('id');
            $this->db->set('tanggal_jumpa', $tanggal);
            $this->db->where('id_masalah', $id);
            if ($this->db->update('masalah')) {
                $this->response(['error'=>false], REST_Controller::HTTP_OK);   
            }
            else{
                $this->response(['error'=>'fail'], REST_Controller::HTTP_OK);   
            }   
        }else{
            $this->response(['error'=>true], REST_Controller::HTTP_OK);   
        }
    }

    public function loginToken_post(){
        $token = $this->post('token');
        $row = $this->db->where('token_key',$token)->get('token_api')->num_rows();
        if ($row!=0) {
            $this->response(['error'=>false, 'status_token'=>true], REST_Controller::HTTP_OK);
        }else{
            $this->response(['error'=>true, 'status_token'=>false], REST_Controller::HTTP_OK);
        }
    }

    public function pengacara_get(){
        // $this->db->select()
        $res = $this->db->get('pengacara')->result();
        if ($res) {
            $this->response($res, REST_Controller::HTTP_OK);
        }
        else{
            $this->response(['error'=>true], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function kasusSelesai_post(){
        // $this->checkToken($this->post("token"));
        if ($this->checkToken($this->post("token"))) {
            $this->db->set('status', 3);
            $this->db->where('id_masalah', $this->post("id"));
            if ($this->db->update('masalah')) {
                $this->response(['error'=>false], REST_Controller::HTTP_OK);
            }
            else{
                $this->response(['error'=>'fail'], REST_Controller::HTTP_OK);   
            }    
        }
        else{
            $this->response(['error'=>true], REST_Controller::HTTP_OK);   
        }
        // $this->response(['error'=>true], REST_Controller::HTTP_OK);   
    }

    public function getBerkas_post(){
        // $this->checkToken($this->post("token"));
        if ($this->checkToken($this->post("token"))) {
            $this->db->where('id_masalah', $this->post('id'));
            $result = $this->db->get('berkas')->result();
            $this->response(['error'=>false, 'berkas' => $result], REST_Controller::HTTP_OK);   
        }
        else{
            $this->response(['error'=>true], REST_Controller::HTTP_OK);   
        }
    }

    public function hapusBerkas_post(){
        // $this->checkToken($this->post("token"));
        if ($this->checkToken($this->post("token"))) {
            $this->db->where('id_berkas', $this->post('id'));
            if ($this->db->delete('berkas')) {
                $this->response(['error'=>false], REST_Controller::HTTP_OK);   
            }
            else{
                $this->response(['error'=>"fail"], REST_Controller::HTTP_OK);   
            }
        }
        else{
            $this->response(['error'=>true], REST_Controller::HTTP_OK);   
        }
        // $this->response(['error'=>true], REST_Controller::HTTP_OK);   
    }

    public function gantiStatus_post(){
        // $this->checkToken($this->post("token"));
        if ($this->checkToken($this->post("token"))) {
            $this->db->where('id_masalah', $this->post("id"));
            $row = $this->db->get('masalah')->row();
            if ($row->status==1) {
                $this->db->set('status', 0);
            }
            elseif ($row->status==2) {
                $this->db->set('status', 4);
            }
            elseif ($row->status==4 || $row->status==3) {
                $this->db->set('status', 2);
            }
            else{
                $this->db->set('status', 1);    
            }
            $this->db->where('id_masalah', $this->post("id"));
            if ($this->db->update('masalah')) {
                $this->response(['error'=>false], REST_Controller::HTTP_OK);
            }
            else{
                $this->response(['error'=>'fail'], REST_Controller::HTTP_OK);   
            }    
        }
        else{
            $this->response(['error'=>true], REST_Controller::HTTP_OK);   
        }
        // $this->response(['error'=>true], REST_Controller::HTTP_OK);   
    }

    public function setPengacara_post(){
        if ($this->checkToken($this->post("token"))) {
            $row = $this->db->where('id_masalah', $this->post("id_masalah"))->get("masalah")->row();
            if ($row->status==1) {
                $this->db->set('status', 2);    
            }
            $this->db->set('id_p', $this->post("pengacara"));
            $this->db->where('id_masalah', $this->post("id_masalah"));
            if ($this->db->update('masalah')) {
                $this->response(['error'=>false], REST_Controller::HTTP_OK);
            }
            else{
                $this->response(['error'=>'fail'], REST_Controller::HTTP_OK);   
            }   
        }else{
            $this->response(['error'=>true], REST_Controller::HTTP_OK);   
        }
    }

    public function checkToken($token){
        // echo "Token".$token."<br>";
        if ($this->db->where("token_key", $token)->get("token_api")->num_rows()!=0) {
            // echo "1";
            return true;
        }
        else{
            // echo "0";
            return false;
        }
    }
}
