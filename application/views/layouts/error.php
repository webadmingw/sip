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
                    <li class="active">Halaman Error</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="span12" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Error!</div>
                <div class="text-right"></div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <?php flash_msg($status); ?>
                    <button type="button" class="btn btn-success" onclick="window.history.back(-1)">Kembali</button>
                </div>
            </div>
        </div>
    </div>