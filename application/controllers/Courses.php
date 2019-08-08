<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courses extends D_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('course');
        $this->load->model('rooms');
    }    
    public function add($id) {
        $status = array();
        $dataCourse = $this->course->getCourseByIDRoom($id);
        $room = $this->rooms->getClassByID($id);
        $urlClose = '/classroom';
        if($this->input->get('del')){

            if($this->course->deleteCourse($this->input->get('del'))){
                $dataCourse = $this->course->getCourseByIDRoom($id);
                $status = ['status' => true, 'msg' => 'Pengguna sudah dihapus dari sistem.'];
            }else{
                $status = ['status' => false, 'msg' => 'Pengguna gagal dihapus.'];
            }
        }
        if ($this->input->post()) {
            $min = $this->input->post('min');
            $max = $this->input->post('max');
            if($this->input->post('subject') && $this->input->post('description') && $min && $max && ($min < $max)) {
                $this->course->addCourse($id, $this->input->post('subject'), $this->input->post('description'), $this->input->post('min'), $this->input->post('max'));
                $dataCourse = $this->course->getCourseByIDRoom($id);
                $status = ['status' => true, 'msg' => 'Pelajaran berhasil ditambah'];
            } else {
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }
        
        $this->load->view('layouts/header');
        $this->load->view('course/form', array(
            'status' => $status,
            'room' => $room,
            'itemInput' => false,
            'urlClose' => $urlClose
        ));
        $this->load->view('course/list', array(
            'dataCourse' => $dataCourse,
            'room' => $room
        ));
        $this->load->view('layouts/footer');
    }
    public function update($id){
        $status = array();
        $dataCourse = $this->course->getCourseByID($id);
        $room = $this->rooms->getClassByID($dataCourse->classroom_id);
        $urlClose = '/courses/add/'.$room->id;
        if ($this->input->post()) {
            $min = $this->input->post('min');
            $max = $this->input->post('max');
            if($this->input->post('subject') && $this->input->post('description') && $min && $max && ($min < $max)) {
                $this->course->updateCourse($id, $this->input->post('subject'), $this->input->post('description'), $this->input->post('min'), $this->input->post('max'));
                $dataCourse = $this->course->getCourseByID($id);
                $status = ['status' => true, 'msg' => 'Pelajaran berhasil dirubah'];
            } else {
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }
        $this->load->view('layouts/header');
        $this->load->view('course/form', array(
            'status' => $status,
            'room' => $room,
            'itemInput' => $dataCourse,
            'urlClose' => $urlClose
        ));
        $this->load->view('layouts/footer');
    }
}
