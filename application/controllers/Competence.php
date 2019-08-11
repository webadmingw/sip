<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Competence extends D_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('comp');
        $this->load->model('rooms');
    }    
    public function add($id) {
        $status = array();
        $competence = $this->comp->getCompBySubject($id);
        if($this->input->get('del')){

            if($this->comp->deleteComp($this->input->get('del'))){
                $competence = $this->comp->getCompBySubject($id);
                $status = ['status' => true, 'msg' => 'Pengguna sudah dihapus dari sistem.'];
            }else{
                $status = ['status' => false, 'msg' => 'Pengguna gagal dihapus.'];
            }
        }
        if ($this->input->post()) {
            if($this->input->post('code') && $this->input->post('desc')) {
                $this->comp->addComp($this->input->post('code'), $this->input->post('desc'), $id);
                $competence = $this->comp->getCompBySubject($id);
                $status = ['status' => true, 'msg' => 'KD berhasil ditambah'];
            } else {
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }
        
        $this->load->view('layouts/header');
        $this->load->view('competence/form', array(
            'itemInput' => false,
            'urlClose' => '/classroom',
            'status'=> $status
        ));
        $this->load->view('competence/list', array(
            'status' => $status,
            'dataCompetence'=> $competence,
            'sub_id'=>$id
        ));
        $this->load->view('layouts/footer');
    }
    public function update($id){
        $status = array();
        $competence = $this->comp->getCompByID($id);
        $subjectID = $competence->subject_id;
        if ($this->input->post()) {
            if($this->input->post('code') && $this->input->post('desc')) {
                $this->comp->editComp($id ,$this->input->post('code'), $this->input->post('desc'));
                $competence = $this->comp->getCompByID($id);
                $status = ['status' => true, 'msg' => 'KD berhasil ditambah'];
            } else {
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }
        
        $this->load->view('layouts/header');
        $this->load->view('competence/form', array(
            'itemInput' => $competence,
            'urlClose' => '/competence/add/'.$subjectID ,
            'status'=> $status
        ));
        $this->load->view('layouts/footer');
    }
}
