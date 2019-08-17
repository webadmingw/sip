<script src="vendor/morris/morris.min.js"></script>
<div class="span12" id="content">
    <div class="row-fluid">
        <tr>
            <td>
                    <input placeholder="NISN" class="input-xlarge focused" style="margin-top:10px;" id="input-nisn" type="text">
            </td>
            <td>
                    <buton class="btn btn-success" id="submit-nisn" >Submit</buton>
            </td>
        </tr>

        <!-- <ul>
            <li class="dropdown">
                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Pilih Siswa<i class="caret"></i></a>
                <ul class="dropdown-menu">
                <?php foreach($student as $item): ?>
                    <?='
                        <li>
                            <a class="getData" id="'. $item->id .'"' .'tabindex="-1" href="'. site_url('?get='.$item->id).'">'. $item->fullname. ' ('. $item->id. ')' .'</a>
                        </li>
                    '?>
                <?php endforeach; ?>
                </ul>
            </li>
        </ul> -->
    </div>
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Statistics</div>
            </div>
            <div class="block-content collapse in">
                <div class="span3">
                    <div class="chart" data-percent="73">73%</div>
                    <div class="chart-bottom-heading"><span class="label label-info">Visitors</span>

                    </div>
                </div>
                <div class="span3">
                    <div class="chart" data-percent="53">53%</div>
                    <div class="chart-bottom-heading"><span class="label label-info">Page Views</span>

                    </div>
                </div>
                <div class="span3">
                    <div class="chart" data-percent="83">83%</div>
                    <div class="chart-bottom-heading"><span class="label label-info">Users</span>

                    </div>
                </div>
                <div class="span3">
                    <div class="chart" data-percent="13">13%</div>
                    <div class="chart-bottom-heading"><span class="label label-info">Orders</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div id="hero-bar"></div>
<script type="text/javascript">
$('document').ready(function() {
    $('#submit-nisn').click(function(e){
        const dataNISN = document.getElementById('input-nisn').value;
        $.get(`http://localhost/sip/index.php?get=${dataNISN}`, (res) => {
            const data = JSON.parse(res).map(item => {
                    return {
                        y:item.fullname,
                        a:80,
                        b:90
                    }
                });
            Morris.Bar({
                element: 'hero-bar',
                data: data,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Nilai Siswa'],
                barRatio: 0.4,
                xLabelMargin: 10,
                hideHover: 'auto',
                barColors: ["#3d88ba"]
            });
        })
        
    });
    
});
</script>