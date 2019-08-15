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
                    <li class="active">Penilaian KD</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php if ($totalClass > 0) : ?>

<?php
    $compCode = '';
    $compDesc = '';
    $minmax = '';
    $compId = array();
    $compName = array();

    $i = 0;
    foreach ($detail as $item) {
        if ($i === 0) {
            $minmax .= '<td>' . $item->max_grade . '</td>' . '<td>' . $item->min_grade . '</td>';
        }
        $compDesc .= '<td>' . $item->desc . '</td>';
        $compCode .= '<td>' . $item->code . '</td>';
        $compId[$i] = $item->comp_id;
        $compName[$i] = $item->code;
        $i++;
    }
    ?>

<div class="span3" id="sidebar">
    <div class="row-fluid">
        <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
            <?php if (count($courses) > 0) : ?>
            <?php foreach ($courses as $course) : ?>
            <li><a href="<?= site_url('/report' . '?class=' . $curClassId . '&pel=' . $course->id) ?>"><i class="icon-chevron-right"></i> <?= strtoupper($course->fullname) ?></a></li>
            <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>

<div class="span9" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Penilaian - <?= strtoupper($detail[0]->fullname) ?></div>
                <div class="text-right"></div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="pagination pagination-small">
                        <?php foreach ($class as $item) : ?>
                        <ul>
                            <li class="<?= ($item->classid === $curClassId ? "active" : "") ?>"><a href="<?= site_url('/report' . '?class=' . $item->classid) ?>">Kelas <?= $item->class_name ?></a></li>
                        </ul>
                        <?php endforeach; ?>
                    </div>
                    <?php flash_msg($status); ?>
                    <form class="form-horizontal" method="post">
                        <input type="hidden" name="semester" value="<?= $curSemester ?>">
                        <input type="hidden" name="year" value="<?= $curYear ?>">
                        <input type="hidden" name="class" value="<?= $curClassId ?>">
                        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="3">NO</th>
                                    <th rowspan="3">NIS</th>
                                    <th rowspan="3">Nama Siswa</th>
                                    <th colspan="<?= $totalKd ?>">Kompetensi</th>
                                    <th rowspan="3">Nilai</th>
                                    <th rowspan="3">Predikat</th>
                                    <th colspan="2">Hasil</th>
                                </tr>
                                <tr>
                                    <?= $compDesc ?>
                                    <th rowspan="2">MAKS</th>
                                    <th rowspan="2">MINS</th>
                                </tr>
                                <tr>
                                    <?= $compCode ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($students as $st) : ?>
                                <?php
                                        $avg = 0;
                                        $loopNotNull = 0;
                                        ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $st->nisn ?></td>
                                    <td><?= $st->fullname ?></td>
                                    <?php for ($j = 0; $j < count($compId); $j++) : ?>
                                    <?php
                                                if (isset($result[$st->nisn][$compId[$j]]) && $result[$st->nisn][$compId[$j]] !== '') {
                                                    $avg += $result[$st->nisn][$compId[$j]];
                                                    $loopNotNull++;
                                                }

                                                ?>
                                    <td><input type="number" max="100" min="0" id="<?= $st->nisn . '_' . $compId[$j] ?>" class="res" name="result[<?= $st->nisn ?>][<?= $compId[$j] ?>]" placeholder="<?= $compName[$j] ?>" value="<?= $result[$st->nisn][$compId[$j]] ?>"></td>
                                    <?php endfor; ?>
                                    <td><span id="avg-<?= $st->nisn ?>" class="avg"><?= ($rAvg = ($loopNotNull > 0 ? round($avg / $loopNotNull) : '')) ?></span></td>
                                    <td><span id="grade-<?= $st->nisn ?>" class="grade"><?= get_grade($rAvg) ?></span></td>
                                    <?= $minmax ?>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="<?= site_url('/report' . '?class=' . $curClassId . '&pel=' . $curSubjectId) ?>" class="btn">Batal</a>
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

    <?php else : ?>
    <div class="span12" id="content">
        <div class="row-fluid">
            <?php flash_msg($status); ?>
        </div>
    </div>
    <?php endif; ?>