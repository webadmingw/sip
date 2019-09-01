<div class="span12">
    <div class="row-fluid">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="breadcrumb">
                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <li><a href="<?= site_url() ?>">SIP</a> <span class="divider">/</span></li>
                    <li><a href="<?= site_url('/report/knowledge') ?>">Laporan Penilaian</a> <span class="divider">/</span></li>
                    <li class="active">Pengetahuan & Keterampilan</li>
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
                <div class="muted pull-left">Laporan Penilaian Pengetahuan & Keterampilan</div>
            </div>
            <div class="block-content collapse in">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="list">
                    <thead>
                        <tr>
                            <th <?= (count($students) > 0 && count($subject) > 0 ? 'rowspan="3"' : '') ?>>NISN</th>
                            <th <?= (count($students) > 0 && count($subject) > 0 ? 'rowspan="3"' : '') ?>>Nama Lengkap</th>
                            <th <?= (count($students) > 0 && count($subject) > 0 ? 'colspan="' . (count($subject) * 2) . '"' : '') ?>>KI3 (Pengetahuan)</th>
                            <th <?= (count($students) > 0 && count($subject) > 0 ? 'colspan="' . (count($subject) * 2) . '"' : '') ?>>KI4 (Keterampilan)</th>
                            <?php if (count($students) > 0 && count($subject) > 0) : ?>
                                <th rowspan="3">Rata-rata</th>
                                <th rowspan="3">Total</th>
                            <?php endif; ?>
                        </tr>
                        <?php
                        if (count($students) > 0 && count($subject) > 0) {
                            $trHeaderSubjectKi3 = '';
                            $trHeaderSubjectKi4 = '';
                            $trHeaderKi3 = '';
                            $trHeaderKi4 = '';
                            foreach ($subject as $item) {
                                $trHeaderSubjectKi3 .=  '<th colspan="2">' . strtoupper($item->subject) . '</th>';
                                $trHeaderSubjectKi4 .=  '<th colspan="2">' . strtoupper($item->subject) . '</th>';
                                $trHeaderKi3 .= '<th>Nilai</th><th>Predikat</th>';
                                $trHeaderKi4 .= '<th>Nilai</th><th>Predikat</th>';
                            }
                            echo '<tr>' . $trHeaderSubjectKi3 . $trHeaderSubjectKi4 . '</tr>';
                            echo '<tr>' . $trHeaderKi3 . $trHeaderKi4 . '</tr>';
                        }
                        ?>
                    </thead>
                    <tbody>
                        <?php if (count($students) > 0 && count($subject) > 0) : ?>

                            <?php
                                foreach ($students as $s) {
                                    echo '<tr class="odd gradeX">';
                                    echo '<td>' . $s->nisn . '</td>';
                                    echo '<td>' . $s->fullname . '</td>';
                                    $ki3 = '';
                                    $ki4 = '';
                                    $totalAvgKd = 0;
                                    $avg = 0;
                                    $totalLoop = 0;
                                    foreach ($result[$s->nisn] as $item) {
                                        $ki3 .= '<td>' . (int) $item->knowledge . '</td><td>' . get_grade((int) $item->knowledge) . '</td>';
                                        $ki4 .= '<td>' . (int) $item->skill . '</td><td>' . get_grade((int) $item->skill) . '</td>';
                                        $totalAvgKd += ($item->knowledge + $item->skill);
                                        $totalLoop++;
                                    }
                                    if ($totalLoop > 0) {
                                        $avg = ($totalAvgKd / ($totalLoop * 2));
                                    }
                                    echo $ki3 . $ki4;
                                    echo '<td>' . round($avg) . '</td>';
                                    echo '<td>' . round($totalAvgKd) . '</td>';
                                    echo '</tr>';
                                }
                                ?>

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