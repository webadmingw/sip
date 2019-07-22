<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classroom extends D_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users');
        $this->load->model('rooms');
    }

    public function index()
    {
        $status = array();
        
        $rooms = $this->rooms->getAll();
        
        $this->load->view('layouts/header');
        $this->load->view('classroom/index', array(
            'status' => $status,
            'rooms' => $rooms
        ));
        $this->load->view('layouts/footer');
    }
    
    public function add()
    {
        $status = array();
        
        if ($this->input->post()) {
            $user = $this->users->getUser($this->input->post('username'));
            
            if($this->input->post('username') && $this->input->post('fullname') && $this->input->post('role')){
                if($user){
                    $status = ['status' => false, 'msg' => 'Nama Pengguna sudah tersedia, gunakan Nama Pengguna yang lain. '];
                }else{
                    $this->users->add($this->input->post('username'), $this->input->post('fullname'), $this->input->post('role'));
                    $status = ['status' => true, 'msg' => 'Pengguna berhasil ditambahkan.'];
                }
            }else{
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }
        
        $this->load->view('layouts/header');
        $this->load->view('users/form', array(
            'status' => $status,
            'user' => false,
        ));
        $this->load->view('layouts/footer');
    }
    
    public function update($id)
    {
        $status = array();
        $user = $this->users->getUserById($id);
        
        if ($this->input->post()) {
            if($this->input->post('username') && $this->input->post('fullname') && $this->input->post('role')){
                $this->users->updateUser($this->input->post('username'), $this->input->post('fullname'), $this->input->post('role'), $id);
                $status = ['status' => true, 'msg' => 'Pengguna berhasil dirubah.'];
                $user = $this->users->getUserById($id);
            }else{
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }
        
        $this->load->view('layouts/header');
        $this->load->view('users/form', array(
            'status' => $status,
            'user' => $user,
        ));
        $this->load->view('layouts/footer');
    }

    public function profile()
    {
        $submitResult = null;
        $errorUpload = null;
        if ($this->input->post()) {
            if ($this->input->post('username') === '' || $this->input->post('fullname') === '') {
                $submitResult = false;
            } else {
                $_file = $_FILES['avatar'];
                $ext = pathinfo($_file['name'], PATHINFO_EXTENSION);
                $avatar = time() . '.' . $ext;
                
                if($_file['error'] === UPLOAD_ERR_OK){
                    move_uploaded_file($_file['tmp_name'], avatar_path() . $avatar);
                    $submitResult = $this->users->updateProfile($this->input->post('username'), $this->input->post('fullname'), $avatar);
                }else {
                    $errorUpload = error_upload($_FILES['avatar']['error']);
                    $submitResult = false;
                }
            }
        }

        $this->load->view('layouts/header');
        $this->load->view('users/profile', array(
            'roles' => $this->users->roles,
            'submitResult' => $submitResult,
            'errorUpload' => $errorUpload
        ));
        $this->load->view('layouts/footer');
    }
    
    public function change(){
        $status = array();
        
        if ($this->input->post()) {
            if ((($status = $this->changePasswordValidate($this->input->post('authkey'), $this->input->post('confirm'))) === true) && $this->users->changePassword($this->session->userdata('id'), $this->input->post('authkey'))) {
                $status = ['status' => true, 'msg' => 'Password berhasil dirubah!'];
            }
        }
        
        $this->load->view('layouts/header');
        $this->load->view('users/change-password', array(
            'status' => $status,
        ));
        $this->load->view('layouts/footer');
    }
    
    private function changePasswordValidate($authkey, $confirm){
        if(($authkey === '' || $confirm === '')){
            return ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
        }elseif($authkey !== $confirm){
            return ['status' => false, 'msg' => 'Password Baru dan Konfirmasi tidak sesuai.'];
        }
        
        return true;
    }
    
}
