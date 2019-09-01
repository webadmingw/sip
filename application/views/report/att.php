<div class="span12">
    <div class="row-fluid">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="breadcrumb">
                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <li><a href="<?= site_url() ?>">SIP</a> <span class="divider">/</span></li>
                    <li><a href="<?= site_url('/report/knowledge') ?>">Laporan Penilaian</a> <span class="divider">/</span></li>
                    <li class="active">Sikap</li>
                </ul>
            </div>
        </div>
    </div>
</div>

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
                <div class="muted pull-left">Laporan Sikap</div>
            </div>
            <div class="block-content collapse in">
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
                            <?php foreach ($result as $s) : ?>
                                <tr class="odd gradeX">
                                    <td><?= $s->nisn ?></td>
                                    <td><?= $s->fullname ?></td>
                                    <td><?= ($s->status == true ? 'Kurang' : 'Baik') ?></td>
                                </tr>
                            <?php endforeach; ?>
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