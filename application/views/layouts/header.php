<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="no-js">

<head>
    <title>SIP - Sistem Informasi Penilaian</title>
    <!-- Bootstrap -->
    <link href="<?= base_url('public/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">
    <link href="<?= base_url('public/bootstrap/css/bootstrap-responsive.min.css') ?>" rel="stylesheet" media="screen">
    <link href="<?= base_url('public/vendors/easypiechart/jquery.easy-pie-chart.css') ?>" rel="stylesheet" media="screen">
    <link href="<?= base_url('public/assets/styles.css') ?>" rel="stylesheet" media="screen">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <script src="<?= base_url('public/vendors/modernizr-2.6.2-respond-1.1.0.min.js') ?>"></script>
    <script src="<?= base_url('public/vendors/jquery-1.9.1.min.js') ?>"></script>
    <script src="<?= base_url('public/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('public/vendors/easypiechart/jquery.easy-pie-chart.js') ?>"></script>
    <script src="<?= base_url('public/vendors/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/DT_bootstrap.js') ?>"></script>
</head>

<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="<?= site_url('/') ?>"><img class="logo" src="<?= base_url('public/images/logo-sd.png') ?>" alt="Logo SD"> Sistem Informasi Penilaian</a>
                <?php if ($this->session->userdata('is_logged')) : ?>
                <div class="nav-collapse collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?= $this->session->userdata('fullname') ?> <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="<?= site_url('/user/profile') ?>">Profile</a></li>
                                <li><a tabindex="-1" href="<?= site_url('/user/change') ?>">Ganti Password</a></li>
                                <li class="divider"></li>
                                <li><a tabindex="-1" href="<?= site_url('/logout') ?>">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav">
                        <li><a href="<?= site_url('/') ?>">Dashboard</a></li>

                        <?php if ($this->session->userdata('role') !== 'K') : ?>
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Data Akademis <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="<?= site_url('/classroom') ?>">Data Kelas</a></li>
                                <?php if ($this->session->userdata('role') === 'A') : ?>
                                <li><a tabindex="-1" href="<?= site_url('/classroom/add') ?>">Tambah Kelas</a></li>
                                <li><a tabindex="-1" href="<?= site_url('/students') ?>">Daftar Siswa</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if ($this->session->userdata('role') === 'G') : ?>
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Penilaian <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="<?= site_url('/assesment/knowledge') ?>">Pengetahuan</a></li>
                                <li><a tabindex="-1" href="<?= site_url('/assesment/skill') ?>">Keterampilan</a></li>
                                <li><a tabindex="-1" href="<?= site_url('/assesment') ?>">Sikap</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if ($this->session->userdata('role') === 'K') : ?>
                        <li><a href="<?= site_url('/') ?>">Pusat SMS</a></li>
                        <?php endif; ?>

                        <?php if ($this->session->userdata('role') !== 'G') : ?>
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Laporan <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="<?= site_url('/report/knowledge') ?>">Pengetahuan</a></li>
                                <li><a tabindex="-1" href="<?= site_url('/report/skill') ?>">Keterampilan</a></li>
                                <li><a tabindex="-1" href="<?= site_url('/report') ?>">Sikap</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if ($this->session->userdata('role') === 'A') : ?>
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Pengguna <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="<?= site_url('/user') ?>">Daftar Pengguna</a></li>
                                <li><a tabindex="-1" href="<?= site_url('/user/add') ?>">Tambah Pengguna</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">