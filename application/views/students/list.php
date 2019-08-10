<div class="row-fluid mt-3">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Daftar Siswa</div>
                
            </div>
            <div class="block-content collapse in">
            <div class="span12">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="list">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Orangtua/Wali</th>
                                <th>Ponsel</th>
                                <th>TTL</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($students as $item): ?>
                                <?= '
                                    <tr class="odd gradeX">
                                        <td>'.$item->id.'</td>
                                        <td>'.$item->fullname.'</td>
                                        <td>'.$item->classroom_name.'</td>
                                        <td>'.$item->semester.'</td>
                                        <td>'.$item->parent_fullname.'</td>
                                        <td>'.$item->phone.'</td>
                                        <td>'.$item->birth_day.'</td>
                                        <td class="center"><a href="'. site_url('/students/update/' . $item->id).'"><i class="icon-pencil"></i></a>&nbsp;<a class="btn-delete" href="'. site_url('/students?del=' . $item->id).'"><i class="icon-trash"></i></a></td>
                                    </tr>
                                '?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('document').ready(function() {
    $('#list').dataTable( {
        "sDom": "<<'span12'f>>t<<'span12'p>>",
        "sPaginationType": "bootstrap"
    }); 

    $('.btn-delete').click(function(e){
        let url = $(this).attr('href');
        e.preventDefault();
        if(confirm('Yakin akan dihapus')){
            window.location.href = url;
        }
    });
    
});
</script>