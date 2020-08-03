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
                // var_dump($result->id);
                $response['error'] = false;
                $response['uid'] = $result->id;
                $response['name'] = $result->nama;
                $response['email'] = $result->nama;
                $response['level'] = $result->level;
                $this->response($response, REST_Controller::HTTP_OK);    
            }
            else{
                $this->response(['error'=>true], REST_Controller::HTTP_NOT_FOUND);
            }
        }
        else{
            $this->response(['error'=>true], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
