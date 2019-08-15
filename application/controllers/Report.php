<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends D_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports');
    }

    public function index()
    {
        $status = array();
        $curYear = $this->getCurrentYear();
        $curSemester = $this->getCurrentSemester();
        $curClass = $this->reports->getCurrentClass($this->session->userdata['id'], $curYear, $curSemester);

        $totalClass = count($curClass);
        if ($totalClass > 0) {
            $classId = ($this->input->get('class') ? $this->input->get('class') : $curClass[0]->classid);

            if ($this->input->post('result')) {
                $this->reports->deleteResultByClass($classId);
                $this->reports->insertResult($this->input->post('class'), $this->input->post('year'), $this->input->post('semester'), $this->input->post('result'));
                $status = array('status' => true, 'msg' => 'Data berhasil ditambahkan.');
            }

            $curCourse = $this->reports->getCurrentCourse($this->session->userdata['id'], $curYear, $curSemester, $classId);
            $subjId = ($this->input->get('pel') ? $this->input->get('pel') : $curCourse[0]->id);
            $students = $this->reports->getStudentByDetailCurrent($classId);
            $result = $this->reports->getResults($classId);
            $detail = $this->reports->getClassDetailCurrent($this->session->userdata['id'], $curYear, $curSemester, $classId, $subjId);
            $data = array(
                'status' => $status,
                'curClassId' => $classId,
                'curYear' => $curYear,
                'curSemester' => $curSemester,
                'curSubjectId' => $subjId,
                'class' => $curClass,
                'totalClass' => $totalClass,
                'courses' => $curCourse,
                'detail' => $detail,
                'totalKd' => count($detail),
                'students' => $students,
                'result' => $result
            );
        } else {
            $status = array('status' => false, 'msg' => 'Data tidak tersedia untuk anda.');
            $data = array(
                'status' => $status,
                'curYear' => $curYear,
                'curSemester' => $curSemester,
                'class' => $curClass,
                'totalClass' => $totalClass
            );
        }

        $this->load->view('layouts/header');
        $this->load->view('report/form', $data);
        $this->load->view('layouts/footer');
    }
}
