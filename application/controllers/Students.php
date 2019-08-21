<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Students extends D_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('student');
        $this->load->model('rooms');
    }

    public function index()
    {
        $status = array();
        $allStudents = $this->student->getAllStudents();
        $classroom = $this->rooms->getAll();
        if ($this->input->get('del')) {
            if ($this->student->deleteStudent($this->input->get('del'))) {
                $allStudents = $this->student->getAllStudents();
                $status = ['status' => true, 'msg' => 'Pengguna sudah dihapus dari sistem.'];
            } else {
                $status = ['status' => false, 'msg' => 'Pengguna gagal dihapus.'];
            }
        }
        if ($this->input->post()) {
            $nisn = $this->input->post('id');
            $name = $this->input->post('fullname');
            $parent_name = $this->input->post('parent_fullname');
            $phone = $this->input->post('phone');
            $classroom_id = $this->input->post('classroom_id');
            $birth_day = $this->input->post('birth_day');
            $birth_place = $this->input->post('birth_place');
            $semester = $this->input->post('semester');

            if (
                $nisn && $name && $parent_name &&
                $phone && $classroom_id && $birth_day &&
                $birth_place && $semester
            ) {
                $status = ['status' => true, 'msg' => 'Pelajaran berhasil ditambah'];
                $this->student->addStudent($nisn, $name, $parent_name, $phone, $birth_place, $birth_day, $classroom_id);
                $allStudents = $this->student->getAllStudents();
            } else {
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }
        $this->load->view('layouts/header');
        $this->load->view('students/form', array(
            'itemInput' => false,
            'status' => $status,
            'classroom' => $classroom,
            'editMode' => false
        ));
        $this->load->view('students/list', array(
            'status' => $status,
            'students' => $allStudents
        ));
        $this->load->view('layouts/footer');
    }

    public function add($classID)
    {
        $status = array();
        $allStudents = $this->student->getAllStudents();
        $classroom = $this->rooms->getAll();
        if ($this->input->get('del')) {
            if ($this->student->deleteStudent($this->input->get('del'))) {
                $allStudents = $this->student->getAllStudents();
                $status = ['status' => true, 'msg' => 'Pengguna sudah dihapus dari sistem.'];
            } else {
                $status = ['status' => false, 'msg' => 'Pengguna gagal dihapus.'];
            }
        }
        if ($this->input->post()) {
            $nisn = $this->input->post('id');
            $name = $this->input->post('fullname');
            $parent_name = $this->input->post('parent_fullname');
            $phone = $this->input->post('phone');
            $classroom_id = $this->input->post('classroom_id');
            $birth_day = $this->input->post('birth_day');
            $birth_place = $this->input->post('birth_place');
            $semester = $this->input->post('semester');

            if (
                $nisn && $name && $parent_name &&
                $phone && $classroom_id && $birth_day &&
                $birth_place && $semester
            ) {
                $status = ['status' => true, 'msg' => 'Pelajaran berhasil ditambah'];
                $this->student->addStudent($nisn, $name, $parent_name, $phone, $birth_place, $birth_day, $classroom_id);
                $allStudents = $this->student->getAllStudents();
            } else {
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }
        $this->load->view('layouts/header');
        $this->load->view('students/form', array(
            'itemInput' => (object) array(
                'id' => '',
                'fullname' => '',
                'parent_fullname' => '',
                'phone' => '',
                'classroom_id' => $classID,
                'birth_day' => '',
                'birth_place' => '',
                'semester' => ''
            ),
            'status' => $status,
            'classroom' => $classroom,
            'editMode' => false
        ));
        $this->load->view('students/list', array(
            'status' => $status,
            'students' => $allStudents
        ));
        $this->load->view('layouts/footer');
    }
    public function update($id)
    {
        $status = array();
        $classroom = $this->rooms->getAll();
        $itemInput = $this->student->getStudentByID($id);
        if ($this->input->post()) {
            $nisn = $this->input->post('id');
            $name = $this->input->post('fullname');
            $parent_name = $this->input->post('parent_fullname');
            $phone = $this->input->post('phone');
            $classroom_id = $this->input->post('classroom_id');
            $birth_day = $this->input->post('birth_day');
            $birth_place = $this->input->post('birth_place');
            $semester = $this->input->post('semester');

            if (
                $nisn && $name && $parent_name &&
                $phone && $classroom_id && $birth_day &&
                $birth_place && $semester
            ) {
                $status = ['status' => true, 'msg' => 'Pelajaran berhasil ditambah'];
                $this->student->updateStudent($nisn, $name, $parent_name, $phone, $birth_place, $birth_day, $classroom_id);
                $itemInput = $this->student->getStudentByID($id);
            } else {
                $status = ['status' => false, 'msg' => 'Formulir harus diisi dengan lengkap.'];
            }
        }

        $this->load->view('layouts/header');
        $this->load->view('students/form', array(
            'itemInput' => $itemInput,
            'status' => $status,
            'classroom' => $classroom,
            'editMode' => true
        ));
        $this->load->view('layouts/footer');
    }
}
