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
                    <li>
                        <a href="<?= site_url('/user/profile') ?>"><?= $this->session->userdata('fullname') ?></a> <span class="divider">/</span>
                    </li>
                    <li class="active">Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- block -->
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Profile</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <?php if ($submitResult === false) : ?>
                        <?php if ($submitResult === false) : ?>
                            <div class="alert alert-error">
                                <button class="close" data-dismiss="alert">×</button>
                                <strong>Error!</strong> <?= $errorUpload ?>
                            </div>
                        <?php else : ?>
                            <div class="alert alert-error">
                                <button class="close" data-dismiss="alert">×</button>
                                <strong>Error!</strong> Nama User & Nama Lengkap harus diisi!
                            </div>
                        <?php endif; ?>
                    <?php elseif ($submitResult === true) : ?>
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Sukses!</strong> Update profile berhasil!
                        </div>
                    <?php endif; ?>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="span1">
                                <img id="show-avatar" style="cursor:pointer;max-width:none;width:190px;" src="<?= ($this->session->userdata('avatar') !== '' ? avatar_url() . $this->session->userdata('avatar') : avatar_url() . 'no-photo.png') ?>" class="img-polaroid" alt="<?= $this->session->userdata('fullname') ?>">
                            </div>
                            <div class="span9">
                                <div class="control-group">
                                    <label class="control-label">Nama User</label>
                                    <div class="controls">
                                        <input class="input-xlarge" id="input-username" type="text" name="username" value="<?= $this->session->userdata('username') ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Peran</label>
                                    <div class="controls">
                                        <input class="input-xlarge disabled" disabled="" id="input-username" type="text" name="username" value="<?= $roles[$this->session->userdata('role')] ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Nama Lengkap</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="input-fullname" type="text" name="fullname" value="<?= $this->session->userdata('fullname') ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <span style="color: red;">* Klik gambar disamping untuk mengganti avatar</span>
                                        <input type="file" id="input-avatar" name="avatar" class="hidden">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a type="reset" class="btn" href="<?= site_url('/user/profile') ?>">Batalkan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /block -->
</div>

<script type="text/javascript">
    $('document').ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#show-avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#input-avatar").change(function() {
            readURL(this);
        });

        $('#show-avatar').click(function() {
            $('#input-avatar').click();
        });
    });
</script>