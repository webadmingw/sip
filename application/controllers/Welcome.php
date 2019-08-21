<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        $this->load->view('layouts/header');
        if (!$this->session->userdata('is_logged')) {
            $this->load->view('layouts/login');
            $this->load->view('welcome_message');
        } else {
            $this->load->view('index');
            $this->load->view('welcome_message', array(
                'student' => $this->student->getAllStudents()
            ));
        }

        $this->load->view('layouts/footer');
    }
}
