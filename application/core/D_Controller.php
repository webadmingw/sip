<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class D_Controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('is_logged')){
            header("Location: login");
            die();
        }
    }
}
