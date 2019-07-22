<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>SIP - Login</title>
        <!-- Bootstrap -->
        <link href="<?= base_url('public/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">
        <link href="<?= base_url('public/bootstrap/css/bootstrap-responsive.min.css') ?>" rel="stylesheet" media="screen">
        <link href="<?= base_url('public/assets/styles.css') ?>" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?= base_url('public/vendors/modernizr-2.6.2-respond-1.1.0.min.js') ?>"></script>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#"><img class="logo" src="<?= base_url('public/images/logo-sd.png') ?>" alt="Logo SD"> Sistem Informasi Penilaian</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span4">&nbsp;</div>
                <div class="span4" id="content">
                    <!-- block -->
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Login untuk masuk</div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <form class="form-horizontal" method="post">
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label">Nama User</label>
                                            <div class="controls">
                                                <input class="input-xlarge focused" id="input-username" name="username" type="text">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Password</label>
                                            <div class="controls">
                                                <input class="input-xlarge focused" id="input-password" type="password" name="password">
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-success btn-block">Login</button>
                                        </div>
                                    </fieldset>
                                </form>
                                <?php if($result === false): ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <strong>Error!</strong> Nama User atau Password tidak valid!
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
                
            </div>
        </div>
        <!--/.fluid-container-->
        <script src="<?= base_url('public/vendors/jquery-1.9.1.min.js') ?>"></script>
        <script src="<?= base_url('public/bootstrap/js/bootstrap.min.js') ?>"></script>
    </body>
</html>