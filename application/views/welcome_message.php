<div class="<?= ($this->session->userdata('is_logged') ? 'span12' : 'span9') ?>" id="content">
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Statistics</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
                <input placeholder="NISN" class="input-xlarge focused" style="margin-top:10px;" id="input-nisn" type="text">
                <button class="btn btn-success" id="submit-nisn">Cari</button>
            </div>
            <div class="span12">&nbsp;</div>
            <div class="span12">
                <div id="hero-bar"></div>
            </div>
            <div class="block-content collapse in">
                <div class="span3">
                    <div class="chart" data-percent="73">73%</div>
                    <div class="chart-bottom-heading"><span class="label label-info">Visitors</span>

                    </div>
                </div>
                <div class="span3">
                    <div class="chart" data-percent="53">53%</div>
                    <div class="chart-bottom-heading"><span class="label label-info">Page Views</span>

                    </div>
                </div>
                <div class="span3">
                    <div class="chart" data-percent="83">83%</div>
                    <div class="chart-bottom-heading"><span class="label label-info">Users</span>

                    </div>
                </div>
                <div class="span3">
                    <div class="chart" data-percent="13">13%</div>
                    <div class="chart-bottom-heading"><span class="label label-info">Orders</span>

                    </div>
                </div>
            </div>
        </div>
        <!-- /block -->
    </div>
</div>