<div class="span9" id="content">
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Statistics</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
                <input placeholder="NISN" class="input-xlarge focused" style="margin-top:10px;" id="input-nisn" type="text">
                <button class="btn btn-success" id="submit-nisn">Cari</button>
            </div>
            <div class="span12">&nbsp;</div>
            <div class="span12">
                <div id="hero-bar"></div>
            </div>
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
    $('document').ready(function() {
        $('#submit-nisn').click(function(e) {
            const dataNISN = document.getElementById('input-nisn').value;
            $.get(`<?= site_url('/welcome/report?nisn=') ?>${dataNISN}`, (res) => {
                const data = JSON.parse(res).map(item => {
                    return {
                        y: item.courses,
                        a: item.knowledge,
                        b: item.skill
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