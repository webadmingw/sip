<div class="span12">
    <div class="row-fluid">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="breadcrumb">
                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <li><a href="<?= site_url() ?>">SIP</a> <span class="divider">/</span></li>
                    <li><a href="<?= site_url('/report/knowledge') ?>">Penilaian</a> <span class="divider">/</span></li>
                    <li class="active">Sikap</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="span12" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Penilaian Sikap</div>
            </div>
            <div class="block-content collapse in">
                <div class="pagination pagination-small">
                    <?php foreach ($class as $item) : ?>
                        <ul>
                            <li class="<?= ($item->classid === $curClassId ? "active" : "") ?>"><a href="<?= site_url('/assesment?class=' . $item->classid) ?>">Kelas <?= $item->class_name ?></a></li>
                        </ul>
                    <?php endforeach; ?>
                </div>
                <?php flash_msg($status); ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="list">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Sikap</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($result) > 0) : ?>
                            <form class="form-horizontal">
                                <?php foreach ($result as $s) : ?>
                                    <tr class="odd gradeX">
                                        <td><?= $s->nisn ?></td>
                                        <td><?= $s->fullname ?></td>
                                        <td>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label>
                                                        <input type="checkbox" class="cb" name="cb[<?= $s->nisn ?>]" <?= ($s->status == true ? 'checked' : '') ?> value="<?= $s->nisn . '-' . $curClassId ?>"> Perlu Bimbingan
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </form>
                        <?php else : ?>
                            <tr class="odd gradeX">
                                <td colspan="4">Data belum tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('document').ready(function() {
        $('input[type="checkbox"]').click(function() {

            if ($(this).prop("checked") === true) {
                window.location.href = "<?= site_url('/assesment?class=') . $curClassId ?>&att=0&attr=" + $(this).val();
            } else if ($(this).prop("checked") === false) {
                window.location.href = "<?= site_url('/assesment?class=') . $curClassId ?>&att=1&attr=" + $(this).val();
            }

        });
    });
</script>