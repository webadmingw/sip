<div class="row-fluid mt-3">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Daftar Pelajaran</div>
            </div>
            <div class="block-content collapse in">
            <div class="span12">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="list">
                        <thead>
                            <tr>
                                <th>Pelajaran</th>
                                <th>Deskripsi</th>
                                <th>Nilai (Min)</th>
                                <th>Nilai (Max)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($dataCourse as $item): ?>
                                <?= '
                                    <tr class="odd gradeX">
                                        <td>'.$item->fullname.'</td>
                                        <td>'.$item->desc.'</td>
                                        <td>'.$item->min_grade.'</td>
                                        <td>'.$item->max_grade.'</td>
                                        <td class="center"><a href="'. site_url('/courses/update/' . $item->id).'"><i class="icon-pencil"></i></a>&nbsp;<a class="btn-delete" href="'. site_url('/courses/add/'. $room->id .'?del=' . $item->id).'"><i class="icon-trash"></i></a></td>
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