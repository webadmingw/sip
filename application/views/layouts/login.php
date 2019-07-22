<div class="span3" id="sidebar" style="margin-right: 15px;">
    <!-- block -->
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Login untuk masuk</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
                <form class="" method="post" action="<?= site_url('/login') ?>">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label">Nama User</label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="input-username" name="username" type="text">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password</label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="input-password" type="password" name="password">
                            </div>
                        </div>

                        <div class="form-actions">
                          <button type="submit" class="btn btn-success btn-block">Login</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!-- /block -->
</div>
<!--/span-->