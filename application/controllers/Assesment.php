<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assesment extends D_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports');
    }

    public function knowledge()
    {
        $status = array();
        $curYear = $this->getCurrentYear();
        $curSemester = $this->getCurrentSemester();
        $curClass = $this->reports->getCurrentClass($this->session->userdata['id'], $curYear, $curSemester);

        $totalClass = count($curClass);
        if ($totalClass > 0) {
            $classId = ($this->input->get('class') ? $this->input->get('class') : $curClass[0]->classid);

            if ($this->input->post('result')) {
                $this->reports->deleteResultByClass($this->input->post('class'), $this->input->post('subject_id'));
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
                'result' => $result,
                'breadcrumb' => 'Pengetahuan'
            );
        } else {
            $status = array('status' => false, 'msg' => 'Data tidak tersedia untuk anda.');
            $data = array(
                'status' => $status,
                'curYear' => $curYear,
                'curSemester' => $curSemester,
                'class' => $curClass,
                'totalClass' => $totalClass,
                'breadcrumb' => 'Pengetahuan'
            );
        }

        $this->load->view('layouts/header');
        $this->load->view('assesment/form', $data);
        $this->load->view('layouts/footer');
    }

    public function skill()
    {
        $status = array();
        $curYear = $this->getCurrentYear();
        $curSemester = $this->getCurrentSemester();
        $curClass = $this->reports->getCurrentClass($this->session->userdata['id'], $curYear, $curSemester);

        $totalClass = count($curClass);
        if ($totalClass > 0) {
            $classId = ($this->input->get('class') ? $this->input->get('class') : $curClass[0]->classid);

            if ($this->input->post('result')) {
                $this->reports->deleteResultByClass($this->input->post('class'), $this->input->post('subject_id'), 1);
                $this->reports->insertResult($this->input->post('class'), $this->input->post('year'), $this->input->post('semester'), $this->input->post('result'), 1);
                $status = array('status' => true, 'msg' => 'Data berhasil ditambahkan.');
            }

            $curCourse = $this->reports->getCurrentCourse($this->session->userdata['id'], $curYear, $curSemester, $classId);
            $subjId = ($this->input->get('pel') ? $this->input->get('pel') : $curCourse[0]->id);
            $students = $this->reports->getStudentByDetailCurrent($classId);
            $result = $this->reports->getResults($classId, 1);
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
                'result' => $result,
                'breadcrumb' => 'Keterampilan'
            );
        } else {
            $status = array('status' => false, 'msg' => 'Data tidak tersedia untuk anda.');
            $data = array(
                'status' => $status,
                'curYear' => $curYear,
                'curSemester' => $curSemester,
                'class' => $curClass,
                'totalClass' => $totalClass,
                'breadcrumb' => 'Keterampilan'
            );
        }

        $this->load->view('layouts/header');
        $this->load->view('assesment/form', $data);
        $this->load->view('layouts/footer');
    }
}
