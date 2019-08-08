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
                        <a href="<?= site_url('/classroom') ?>">Daftar Kelas</a> <span class="divider">/</span>
                    </li>
                    <li class="active">Tambah Pelajaran</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Kelas</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <?php flash_msg($status); ?>
                    <div class="text-right">
                    <a  href=<?= site_url($urlClose) ?>> 
                    <button class="btn btn-warning" >Tutup</button>
                    </a>
                    </div>
                    <br/>
                    <form class="form-horizontal" method="post">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <fieldset>
                                            <div class="span9">
                                            <div class="control-group">
                                                    <label class="control-label">Nama Kelas</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="input-classroom" type="text"  disabled value="<?= ($room ? $room->name : '') ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Kelas</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="input-classroom" type="number" disabled  value="<?= ($room ? $room->class : '') ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Tahun Ajaran</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="input-year" type="number" disabled  value="<?= ($room ? $room->year : '') ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Semeter</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="input-semester" type="number" disabled  value="<?= ($room ? $room->semester : '') ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Wali Kelas</label>
                                                    <div class="controls">
                                                    <input class="input-xlarge focused" id="input-semester" type="number" disabled  value="<?= ($room ? $room->teacher_id : '') ?>">

                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </td>
                                    <td>
                                        <fieldset>
                                            <div class="span9">
                                            <div class="control-group">
                                                    <label class="control-label">Pelajaran</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="input-subject" type="text" name="subject" value="<?= ($itemInput ? $itemInput->fullname : '') ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Deskripsi</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="input-desc" type="text" name="description" value="<?= ($itemInput ? $itemInput->desc : '') ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Nilai (Min)</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="input-min" type="number" name="min" value="<?= ($itemInput ? $itemInput->min_grade : '') ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Nilai (Max)</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="input-max" type="number" name="max" value="<?= ($itemInput ? $itemInput->max_grade : '') ?>">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                        
                                                </div>
                                            </div>
                                        </fieldset>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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