<?php
defined('BASEPATH') or exit('No direct script access allowed');

class D_Controller extends CI_Controller
{

    public $semester = array(
        '01' => 2,
        '02' => 2,
        '03' => 2,
        '04' => 2,
        '05' => 2,
        '06' => 2,
        '07' => 1,
        '08' => 1,
        '09' => 1,
        '10' => 1,
        '11' => 1,
        '12' => 1,
    );

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged')) {
            header("Location: login");
            die();
        }
    }

    public function getCurrentYear()
    {
        $curYear = date('Y');
        $curSemester = date('m');

        return ($this->semester[$curSemester] === 2 ? (($curYear - 1) . '/' . $curYear) : ($curYear . '/' . ($curYear + 1)));
    }

    public function getCurrentSemester()
    {
        return $this->semester[date('m')];
    }
}
