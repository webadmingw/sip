<?= ($editMode ? '<div class="text-right" style="margin-right:14%;"><a href="'. site_url('/students').'">'.'<button class="btn btn-warning">Close</button></a></div>':'') ?>
<br/>
<form class="form-horizontal" method="post">
<div class="table-responsive">
<?php flash_msg($status); ?>
    <table class="table">
        <tbody>
            <tr>
                <td>
                    <fieldset>
                        <div class="span9">
                            <div class="control-group">
                                    <label class="control-label">NISN</label>
                                    <div class="controls">
                                        <input 
                                            class="input-xlarge focused" 
                                            id="input-subject" 
                                            type="text" 
                                            name="id" 
                                            value="<?= ($itemInput ? $itemInput->id : '') ?>"
                                        >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Nama Siswa</label>
                                    <div class="controls">
                                        <input 
                                            class="input-xlarge focused" 
                                            id="input-desc" 
                                            type="text" 
                                            name="fullname" 
                                            value="<?= ($itemInput ? $itemInput->fullname : '') ?>"
                                        >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Nama Orangtua/wali</label>
                                    <div class="controls">
                                        <input 
                                            class="input-xlarge focused" 
                                            id="input-desc" 
                                            type="text" 
                                            name="parent_fullname" 
                                            value="<?= ($itemInput ? $itemInput->parent_fullname : '') ?>"
                                        >
                                    </div>
                                </div>
                                <div class="control-group">
                                <label class="control-label">Nomor Ponsel</label>
                                    <div class="controls">
                                        <input 
                                            class="input-xlarge focused" 
                                            id="input-desc" 
                                            type="number" 
                                            name="phone" 
                                            value="<?= ($itemInput ? $itemInput->phone : '') ?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                </fieldset>
                </td>
                <td>
                    <fieldset>
                        <div class="span9">
                            
                            <div class="control-group">
                                <label class="control-label">Tempat Lahir</label>
                                <div class="controls">
                                    <input 
                                        class="input-xlarge focused" 
                                        id="input-min" 
                                        type="text" 
                                        name="birth_place" 
                                        value="<?= ($itemInput ? $itemInput->birth_place : '') ?>"
                                    >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Lahir</label>
                                <div class="controls">
                                    <input 
                                        class="input-xlarge focused" 
                                        id="input-desc" 
                                        type="date" 
                                        name="birth_day" 
                                        value="<?= ($itemInput ? $itemInput->birth_day : '') ?>"
                                    >
                                </div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label">Semester</label>
                                    <div class="controls">
                                        <input 
                                            class="input-xlarge focused" 
                                            id="input-max" 
                                            type="number" 
                                            name="semester" 
                                            value="<?= ($itemInput ? $itemInput->semester : '') ?>"
                                        >
                                    </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kelas</label>
                                <div class="controls">
                                    <select id="input-role" name="classroom_id">
                                            <option value="">Pilih Kelas</option>
                                            <?php foreach($classroom as $item): ?>
                                                <?=
                                                '<option 
                                                    value='. 
                                                    $item->id. 
                                                    ($item->id === $itemInput->classroom_id ? ' selected':'') .
                                                '>' . 
                                                    $item->name .
                                                '</option>'
                                                ?>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success" style="margin-right:3%;">Simpan</button>            
                            </div>
                        </div>
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</form>


