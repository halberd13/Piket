<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form name="FORM_PARAM" action="<?php echo Yii::app()->baseUrl; ?>/?r=mitra/set_db" method="POST">
    <fieldset>
        <legend>Create Connection</legend>
        <div class="form-group">
            <label>Choose Database *</label>
            <select class="form-control" name="IP">
                <option value="192.168.168.130">192.168.168.130</option>
                <option value="192.168.168.110">192.168.168.110</option>
                <option value="192.168.168.137">192.168.168.137</option>
            </select>
            <span class="help-block">Connection define by User</span>
        </div>
        <div class="form-group">
            <label>Choose Database *</label>
            <select class="form-control" name="DB">
                <?php 
                
                    foreach($databases as $value){
                        echo '<option value="'.$value['Database'].'">'.$value['Database'].'</option>';
                    }
                ?>
            </select>
            <span class="help-block">Connection define by User</span>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Use</button>
    </fieldset>
</form>