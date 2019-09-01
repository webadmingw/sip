<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sms extends D_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('smsmodel');
    }

    public function index()
    {
        $status = array();
        $data = array();

        if ($this->input->post()) {
            $statusSMS = 0;
            $nisn_string = '';

            foreach ($this->input->post('sms') as $k => $v) {
                $arrKey = explode('_', $k);
                if ($v['type'] === 'F') {
                    $msg = msg_max($v['fullname'], $arrKey[1]);
                } else {
                    $msg = msg_min($v['fullname'], $arrKey[1]);
                }

                $resultSMS = send_sms($v['telp'], $msg);
                if ($resultSMS !== false && (string) $resultSMS === '0') {
                    $nisn_string .= $arrKey[0] . ',';
                    $statusSMS++;
                }
            }

            if ($statusSMS > 0) {
                $this->smsmodel->setSmsIsSent($this->input->post('class_id'), $nisn_string, $this->input->post('comp_id'));
                $status = ['status' => true, 'msg' => $statusSMS . 'SMS Berhasil dikirim.'];
            } else {
                $status = ['status' => true, 'msg' => 'tidak ada SMS yang Berhasil dikirim.'];
            }
        }

        if ($this->input->get()) {
            $data = $this->smsmodel->getReportByClass($this->input->get('class'), $this->input->get('semester'), $this->input->get('year'));
        }

        $this->load->view('layouts/header');
        $this->load->view('sms/index', array(
            'data' => $data,
            'status' => $status,
            'class' => $this->input->get('class'),
            'semester' => $this->input->get('semester'),
            'year' => $this->input->get('year')
        ));
        $this->load->view('layouts/footer');
    }
}
