<div class="span12" id="content">
    <div class="row-fluid">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="breadcrumb">
                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <li>
                        <a href="<?= site_url() ?>">SIP</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="<?= site_url('/user/profile') ?>"><?= $this->session->userdata('fullname') ?></a> <span class="divider">/</span>
                    </li>
                    <li class="active">Ganti Password</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- block -->
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Ganti Password</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <?php flash_msg($status); ?>
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <div class="span9">
                                <div class="control-group">
                                    <label class="control-label">Password Baru</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="input-authkey" type="password" name="authkey">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Konfirmasi</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="input-confirm" type="password" name="confirm">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a type="reset" class="btn" href="<?= site_url('/user/change') ?>">Batalkan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /block -->
</div>

<script type="text/javascript">
    $('document').ready(function() {
        
    });
</script>