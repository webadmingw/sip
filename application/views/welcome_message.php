<?php if ($this->session->userdata('is_logged')) : ?>
    <div class="span5" id="content">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Identitas Sekolah</div>
            </div>
            <div class="block-content collapse in">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
                    <tbody>
                        <tr class="odd gradeX">
                            <th>NPSN</th>
                            <td>20206413</td>
                        </tr>
                        <tr class="even gradeC">
                            <th>Nama Sekolah</th>
                            <td>SDN Pinggirsari 02</td>
                        </tr>
                        <tr class="odd gradeX">
                            <th>Alamat</th>
                            <td>Kp. Malakasari RT.02 RW.03 </td>
                        </tr>
                        <tr class="even gradeC">
                            <th>Kepala Sekolah</th>
                            <td>YANTI, S.Pd.</td>
                        </tr>
                        <tr class="odd gradeX">
                            <th>NIP</th>
                            <td>19641111 198812 2 002</td>
                        </tr>
                        <tr class="even gradeC">
                            <th>Desa</th>
                            <td>Pinggirsari</td>
                        </tr>
                        <tr class="odd gradeX">
                            <th>Kecamatan</th>
                            <td>Arjasari</td>
                        </tr>
                        <tr class="even gradeC">
                            <th>Kota/Kab.</th>
                            <td>Bandung</td>
                        </tr>
                        <tr class="odd gradeX">
                            <th>Provinsi</th>
                            <td>Jawa Barat</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="<?= ($this->session->userdata('is_logged') ? 'span7' : 'span8') ?>">
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Pencarian Data Siswa</div>
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
            e.preventDefault();
            const dataNISN = document.getElementById('input-nisn').value;
            $.get(`<?= site_url('/welcome/report?nisn=') ?>${dataNISN}`, (res) => {
                $('#hero-bar').html('');
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
                    labels: ['Pengetahuan', 'Keterampilan'],
                    barRatio: 0.4,
                    xLabelMargin: 10,
                    hideHover: 'auto',
                    barColors: ["#3d88ba"]
                });
            })
        });
    });
</script>