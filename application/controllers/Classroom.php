<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classroom extends D_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users');
        $this->load->model('rooms');
        $this->load->model('student');
    }

    public function index()
    {
        $status = array();
        if ($this->input->get('del')) {

            if ($this->rooms->deleteClass($this->input->get('del'))) {
                $status = ['status' => true, 'msg' => 'Pengguna sudah dihapus dari sistem.'];
            } else {
                $status = ['status' => false, 'msg' => 'Pengguna gagal dihapus.'];
            }
        }

        if ($this->session->userdata('role') === 'G') {
            $rooms = $this->rooms->getCurrentClassByTeacher($this->session->userdata['id'], $this->getCurrentYear(), $this->getCurrentSemester());
        } else {
            $rooms = $this->rooms->getAll();
        }


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
        $users = $this->users->getMasters();

        $formdata = $this->input->post();
        if ($formdata) {
            if ($this->input->post('name') && $this->input->post('classroom') && $this->input->post('year') && $this->input->post('semester') && $this->input->post('role')) {
                $this->rooms->add($this->input->post('name'), $this->input->post('classroom'), $this->input->post('year'), $this->input->post('semester'), $this->input->post('role'));
                $status = ['status' => true, 'msg' => 'Kelas berhasil ditambah'];
            } else {
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }

        $this->load->view('layouts/header');
        $this->load->view('classroom/form', array(
            'status' => $status,
            'room' => false,
            'users' => $users
        ));
        $this->load->view('layouts/footer');
    }

    public function update($id)
    {
        $status = array();
        $room = $this->rooms->getClassByID($id);

        $users = $this->users->getMasters();

        if ($this->input->post()) {
            if ($this->input->post('name') && $this->input->post('classroom') && $this->input->post('year') && $this->input->post('semester') && $this->input->post('role')) {
                $this->rooms->updateClass($id, $this->input->post('name'), $this->input->post('year'), $this->input->post('semester'), $this->input->post('role'), $this->input->post('classroom'));
                $room = $this->rooms->getClassByID($id);
                $status = ['status' => true, 'msg' => 'Kelas berhasil dirubah'];
            } else {
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }

        $this->load->view('layouts/header');
        $this->load->view('classroom/form', array(
            'status' => $status,
            'users' => $users,
            'room' => $room
        ));
        $this->load->view('layouts/footer');
    }

    public function students($id)
    {
        $status = array();
        $allStudents = $this->student->allByClass($id);

        $this->load->view('layouts/header');
        $this->load->view('students/list', array(
            'status' => $status,
            'students' => $allStudents
        ));
        $this->load->view('layouts/footer');
    }
}
