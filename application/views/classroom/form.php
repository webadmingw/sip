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
                        <a href="<?= site_url('/user') ?>">Daftar Pengguna</a> <span class="divider">/</span>
                    </li>
                    <li class="active">Tambah</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- block -->
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Tambah Pengguna</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <?php flash_msg($status); ?>
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <div class="span9">
                            <div class="control-group">
                                    <label class="control-label">Nama Kelas</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="input-classroom" type="text" name="name" value="<?= ($room ? $room->name : '') ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Kelas</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="input-classroom" type="number" name="classroom" value="<?= ($room ? $room->class : '') ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Tahun Ajaran</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="input-year" type="number" name="year" value="<?= ($room ? $room->year : '') ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Semeter</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="input-semester" type="number" name="semester" value="<?= ($room ? $room->semester : '') ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Wali Kelas</label>
                                    <div class="controls">
                                        <select id="input-role" name="role">
                                            <option value="">Pilih Wali Kelas</option>
                                            <?php foreach($users as $user): ?>
                                            <?= '
                                            
                                                <option class="odd gradeX" value='.$user->id.' '.($user->id === $room->teacher_id ? "selected=\"selected\"" : '').' >
                                                    '.$user->username.'
                                                </option>
                                            '?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a type="reset" class="btn" href="<?= site_url('/classroom') ?>">Batalkan</a>
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