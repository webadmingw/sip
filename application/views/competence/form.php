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
                        <a href="<?= site_url($urlClose) ?>">Daftar Pelajaran</a> <span class="divider">/</span>
                    </li>
                    <li class="active">Tambah KD</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Tambah KD</div>
                <div class="text-right">
                <a  href=<?= site_url($urlClose) ?>> 
                <button style="margin-bottom:5px;" class="btn btn-warning" >Tutup</button>
                </a>
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <?php flash_msg($status); ?>
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label">Nama KD</label>
                                <div class="controls">
                                    <input 
                                        class="input-xlarge focused" 
                                        id="input-year" 
                                        type="text" 
                                        name="code"
                                        value="<?= ($itemInput ? $itemInput->code : '') ?>"
                                    >
                                </div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label">Deskripsi</label>
                                    <div class="controls">
                                        <input 
                                            class="input-xlarge focused" 
                                            id="input-subject" 
                                            type="text" 
                                            name="desc" 
                                            value="<?= ($itemInput ? $itemInput->desc : '') ?>"
                                        >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="text-right input-xlarge focused">
                                                <button type="submit" class="btn btn-success">Simpan</button>  
                                        </div>
                                    </div>
                                </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

<script type="text/javascript">
    // $('document').ready(function() {
    //     let x=0;
    //     $('#btn-add-course').click(function(){
    //         x<1 &&  $('#content').append('<tr><td>asdasd</td><td><button onclick="$(this).parent().parent().remove();">REMOVE</button></td></tr>');
    //         x++;
    //     });
    // });
</script>