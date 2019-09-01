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
        $students = array();
        $subject = array();
        $result = array();

        if ($this->input->get()) {
            $students = $this->reports->getListStudentByClass($this->input->get('class'), $this->input->get('semester'), $this->input->get('year'));
            $subject = $this->reports->getListSubjectByClass($this->input->get('class'), $this->input->get('semester'), $this->input->get('year'));
            $result = $this->reports->getResultSummaryByClass($this->input->get('class'), $this->input->get('semester'), $this->input->get('year'));
        }
        $this->load->view('layouts/header');
        $this->load->view('report/index', array(
            'status' => $status,
            'class' => $this->input->get('class'),
            'semester' => $this->input->get('semester'),
            'year' => $this->input->get('year'),
            'students' => $students,
            'subject' => $subject,
            'result' => $result
        ));

        $this->load->view('layouts/footer');
    }

    public function att()
    {
        $status = array();
        $result = array();

        if ($this->input->get()) {
            $result = $this->reports->getAttitude($this->input->get('class'), $this->input->get('semester'), $this->input->get('year'));
        }
        $this->load->view('layouts/header');
        $this->load->view('report/att', array(
            'status' => $status,
            'class' => $this->input->get('class'),
            'semester' => $this->input->get('semester'),
            'year' => $this->input->get('year'),
            'result' => $result
        ));

        $this->load->view('layouts/footer');
    }

    public function result()
    {
        $status = array();
        $result = array();

        if ($this->input->get()) {
            $result = $this->reports->getMaxmin($this->input->get('class'), $this->input->get('semester'), $this->input->get('year'));
        }

        $this->load->view('layouts/header');
        $this->load->view('report/maxmin', array(
            'status' => $status,
            'class' => $this->input->get('class'),
            'semester' => $this->input->get('semester'),
            'year' => $this->input->get('year'),
            'result' => $result
        ));

        $this->load->view('layouts/footer');
    }
}
