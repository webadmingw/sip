<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends D_Controller {
    
    public function index()
    {
        $this->session->sess_destroy();
	redirect(site_url('/login'));
    }
    
}
