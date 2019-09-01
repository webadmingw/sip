<div class="span12">
    <div class="row-fluid">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="breadcrumb">
                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <li>
                        <a href="<?= site_url() ?>">SIP</a> <span class="divider">/</span>
                    </li>
                    <li class="active">Pusat SMS</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- block -->
<div class="span3" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Cari</div>
            </div>
            <div class="block-content collapse in">
                <form class="" method="get" name="frm-search">
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Cari Nama Kelas</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" name="class" type="text" placeholder="Kelas (Cth: 1, 2..6 atau 1 A, 2B .. n)" value="<?= $class ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Semester</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" name="semester" type="number" placeholder="Semester (Cth: 1, 2)" value="<?= $semester ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Tahun Ajaran</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" name="year" type="text" placeholder="Tahun Ajaran (Cth: 2019/2020, dll)" value="<?= $year ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Cari...</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="span9">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Daftar Penerima SMS</div>
            </div>
            <div class="block-content collapse in">
                <?php flash_msg($status); ?>

                <form class="" method="post" name="frm-sms">
                    <div class="span12">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="list">
                            <thead>
                                <tr>
                                    <th>NISN</th>
                                    <th>Nama Lengkap</th>
                                    <th>Pelajaran</th>
                                    <th>KD</th>
                                    <th>Min</th>
                                    <th>Max</th>
                                    <th>Nilai</th>
                                    <th>SMS Terkirim</th>
                                    <th>Tgl. Terkirim</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($data) > 0) : ?>
                                    <?php
                                        $nisn = '';
                                        $comp_id = '';
                                        $class_id = '';
                                        ?>
                                    <?php foreach ($data as $user) : ?>
                                        <?php $nisn .= $user->nisn . ','; ?>
                                        <?php $comp_id .= $user->comp_id . ','; ?>
                                        <?php $class_id = $user->class_id; ?>
                                        <?= '
                                            <tr class="odd gradeX">
                                                <td>' . $user->nisn . '</td>
                                                <td>' . $user->fullname . '</td>
                                                <td>' . strtoupper($user->course) . '</td>
                                                <td>' . $user->code . '</td>
                                                <td>' . $user->min_grade . '</td>
                                                <td>' . $user->max_grade . '</td>
                                                <td>' . (int) $user->summary . '</td>
                                                <td>' . ($user->is_sent ? 'Sudah' : 'Belum') . '</td>
                                                <td>' . $user->sent_date . '</td>
                                            </tr>
                                        ' ?>
                                        <input type="hidden" name="sms[<?= $user->nisn . '_' . strtoupper($user->course) . '_' . $user->code;  ?>][telp]" value="<?= $user->phone; ?>">
                                        <input type="hidden" name="sms[<?= $user->nisn . '_' . strtoupper($user->course) . '_' . $user->code;  ?>][type]" value="<?= $user->r; ?>">
                                        <input type="hidden" name="sms[<?= $user->nisn . '_' . strtoupper($user->course) . '_' . $user->code;  ?>][summary]" value="<?= $user->summary; ?>">
                                        <input type="hidden" name="sms[<?= $user->nisn . '_' . strtoupper($user->course) . '_' . $user->code;  ?>][fullname]" value="<?= $user->fullname; ?>">
                                    <?php endforeach; ?>
                                    <input type="hidden" name="nisn" value="<?= $nisn ?>">
                                    <input type="hidden" name="comp_id" value="<?= $comp_id ?>">
                                    <input type="hidden" name="class_id" value="<?= $class_id ?>">
                                <?php else : ?>
                                    <tr class="odd gradeX">
                                        <td colspan="9">Data belum tersedia</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (count($data) > 0) : ?>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Kirim SMS</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('document').ready(function() {
        // $('#list').dataTable({
        //     "sDom": "<<'span12'f>>t<<'span12'p>>",
        //     "sPaginationType": "bootstrap"
        // });

        // $('.btn-delete').click(function(e) {
        //     let url = $(this).attr('href');
        //     e.preventDefault();
        //     if (confirm('Yakin akan dihapus')) {
        //         window.location.href = url;
        //     }
        // });

    });
</script>