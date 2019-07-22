<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('is_logged')){
            redirect(site_url());
        }
        
        $this->load->model('users');
    }
    
    public function index()
    {
        $data = array('result' => true);
        if($this->input->post('username')){
            if($this->users->doLogin($this->input->post('username'), $this->input->post('password'))){
                redirect(site_url());
            }else{
                $data = array('result' => false);
            }
        }
        
        $this->load->view('users/login', $data);
    }
    
}
