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
                    <li class="active">Daftar Kelas Aktif</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- block -->
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Daftar Kelas Aktif</div>
            </div>
            <div class="block-content collapse in">
                <?php flash_msg($status); ?>
                <div class="span12">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="list">
                        <thead>
                            <tr>
                                <th>Kelas (Sub)</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <?php if ($this->session->userdata('role') !== 'G') : ?>
                                <th>Wali Kelas</th>
                                <?php endif; ?>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rooms as $room) : ?>
                            <?php
                                $tdMaster = '';
                                $tdAction = '
                                    <a class="add-courses" href="' . site_url('/courses/add/' . $room->id) . '"><small>Tambah Pelajaran</small></a>&nbsp;|&nbsp;
                                    <a href="' . site_url('/classroom/students/' . $room->id) . '"><small>Data Siswa</small></a>
                                ';

                                if ($this->session->userdata('role') !== 'G') {
                                    $tdMaster .= '<td>' . $room->fullname . '</td>';
                                    $tdAction = '
                                        <a href="' . site_url('/classroom/update/' . $room->id) . '"><i class="icon-pencil"></i></a>&nbsp;
                                        <a class="btn-delete" href="' . site_url('/classroom?del=' . $room->id) . '"><i class="icon-trash"></i></a>&nbsp;
                                        <a class="add-courses" href="' . site_url('/students/add/' . $room->id) . '"><small>Tambah Siswa</small></a>&nbsp;
                                        <a class="add-courses" href="' . site_url('/courses/add/' . $room->id) . '"><small>Tambah Pelajaran</small></a>
                                    ';
                                }

                                ?>
                            <?= '
                                    <tr class="odd gradeX">
                                        <td>' . $room->class . ' (' . $room->name . ')</td>
                                        <td>' . $room->semester . '</td>
                                        <td>' . $room->year . '</td>
                                        ' . $tdMaster . '
                                        <td class="center">' . $tdAction . '</td>
                                    </tr>
                                ' ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /block -->
</div>

<script type="text/javascript">
    $('document').ready(function() {
        $('#list').dataTable({
            "sDom": "<<'span12'f>>t<<'span12'p>>",
            "sPaginationType": "bootstrap"
        });

        $('.btn-delete').click(function(e) {
            let url = $(this).attr('href');
            e.preventDefault();
            if (confirm('Yakin akan dihapus')) {
                window.location.href = url;
            }
        });

    });
</script>