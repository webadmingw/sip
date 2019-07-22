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
                        <a href="<?= site_url('/user') ?>">Daftar Pengguna</a> <span class="divider">/</span>
                    </li>
                    <li class="active">Tambah</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- block -->
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Tambah Pengguna</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <?php flash_msg($status); ?>
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <div class="span9">
                                <div class="control-group">
                                    <label class="control-label">Nama Login Pengguna (Username)</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="input-username" type="text" name="username" value="<?= ($user ? $user->username : '') ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Nama Lengkap</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="input-fullname" type="text" name="fullname" value="<?= ($user ? $user->fullname : '') ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Sebagai</label>
                                    <div class="controls">
                                        <select id="input-role" name="role">
                                            <option value="">Pilih Peran</option>
                                            <option value="A" <?= ($user && $user->role === 'A' ? 'selected' : '') ?>>Admin</option>
                                            <option value="K" <?= ($user && $user->role === 'K' ? 'selected' : '') ?>>Kepala Sekolah</option>
                                            <option value="G" <?= ($user && $user->role === 'G' ? 'selected' : '') ?>>Guru</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if(!$user): ?>
                                <div class="control-group">
                                    <div class="controls">
                                        <span style="color: red;">* Password otomatis di buat oleh sistem : `user123`</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a type="reset" class="btn" href="<?= site_url('/user') ?>">Batalkan</a>
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
        
    });
</script>