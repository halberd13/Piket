<?php
if(isset($_GET['rc'])){
    if($_GET['rc']=='00'){
?>        
<div class="alert alert-success" id="success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Data has been changed.
</div>
<a href="<?php echo Yii::app()->baseUrl; ?>/?r=instance/download"><input type="button" class="btn-primary" value="Download" name="download_file"></a>
<?php }else {?>    
<div class="alert alert-block alert-danger" id="error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Failed!</strong> Data failed to change.
</div>
<?php
    }
}
?>
<form name="FORM_PARAM" action="<?php echo Yii::app()->baseUrl; ?>/?r=instance/build" method="POST">
    <fieldset>
        <legend>Create Configuration</legend>
        <div class="form-group">
            <label>Server Name *</label>
            <input type="text" class="form-control" placeholder="Server Name" name="FORM[SERVER_NAME]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Server Product *</label>
            <select class="form-control" name="FORM[SERVER_PRODUCT]" id="SERVER_PRODUCT">
                <option value="Other">New Product</option>
                <option value="PLN">PLN</option>
                <option value="PDAM">PDAM</option>
                <option value="MULTIFINANCE">MULTIFINANCE</option>
                <option value="FM_PAYTV">FM PAY_TV</option>
            </select>
            <span class="help-block">Server Product want to be created.</span>
        </div>
        <div class="form-group">
            <label class="DIFF_PORT">Is Used Different Port ?</label>
            <select class="form-control DIFF_PORT" id="DIFF_PORT" name="FORM[DIFF_PORT]">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <span class="help-block DIFF_PORT">Use different port each Product.</span>
        </div>
        <div class="form-group">
            <label class="SERVER_PORT" name="FORM[SERVER_PORT_1]">Server Port 1 *</label>
            <input class="form-control SERVER_PORT" type="text" placeholder="30030" name="FORM[SERVER_PORT_1]">
            <label class="SERVER_PORT">Server Port 2</label>
            <input class="form-control SERVER_PORT" type="text" placeholder="30031" name="FORM[SERVER_PORT_2]">
            <label class="SERVER_PORT">Server Port 3</label>
            <input class="form-control SERVER_PORT" type="text" placeholder="30032" name="FORM[SERVER_PORT_3]">
            <span class="help-block SERVER_PORT" name="FORM[SERVER_PORT_1]">Server Port define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Central ID *</label>
            <input type="text" class="form-control" placeholder="4410603" name="FORM[CID]">
            <span class="help-block">Central ID define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Bank Code *</label>
            <input type="text" class="form-control" placeholder="4410000" name="FORM[BANK_CODE]">
            <span class="help-block">Bank Code define by yourself.</span>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <label>Delivery Channel *</label>
                <label class="checkbox">
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6010"><span class="help-block">Teller</span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6011"><span class="help-block">ATM</span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6012"><span class="help-block">POS</span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6013"><span class="help-block">Auto Debit/Giralisasi         </span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6014"><span class="help-block">Internet                      </span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6015"><span class="help-block">KiosK                         </span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6016"><span class="help-block">Phone Banking / Call Centre   </span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6017"><span class="help-block">Mobile Banking                </span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6018"><span class="help-block">EDC                           </span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6019"><span class="help-block">ADM                           </span>
                </label>
            </div>
            <div class="col-sm-5">
                <label>Point of Sales/Standard Application *</label>
                <label class="checkbox">
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6021"><span class="help-block">PC (Personal Computer)		</span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6022"><span class="help-block">EDC		</span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6023"><span class="help-block">SMS        </span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6024"><span class="help-block">Modern Channel        </span>
                    <input type="checkbox" name="FORM[DC_TYPE][]" value="6025"><span class="help-block">Mobile        </span>
                </label>
                
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label>Server Configuration *</label>
            <select class="form-control" name="FORM[SERVER_CFG]">
                <option value="cfg/iso2003ascii.xml">iso2003ascii.xml</option>
                <option value="cfg/iso87ascii.xml">iso87ascii.xml</option>
            </select>
            <span class="help-block">Name file of configuration will be used.</span>
        </div>
        <div class="form-group">
            <label>Server Class Channel *</label>
            <select class="form-control" name="FORM[CLASS_CHANNEL]">
                <option value="channel.GSP_Tail_03">Tailer by 03</option>
                <option value="channel.GSP_Tail">Tailer By -1 (255)</option>
                <option value="channel.GSP_HE">Header Exclude length 2 Byte</option>
                <option value="channel.GSP_HI">Header Include length 2 Byte</option>
            </select>
            <span class="help-block">Class channel define type message that either header or tail.</span>
        </div>
        <div class="form-group">
            <label>Has Freezer ?</label>
            <select class="form-control" name="FORM[HAS_FREEZER]">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <span class="help-block">Is the instance has Freezer</span>
        </div>
        <div class="form-group">
            <label>Channel Quantity *</label>
            <select class="form-control" name="FORM[CHANNEL_QUANTITY]" >
                <?php for($i=1;$i<11;$i++){
                   echo '<option value='.$i.'>'.$i.'</option>'; 
                }?>
            </select>
            <span class="help-block">Channel Quantity define by your request that how many channel will be used.</span>
        </div>
        <div class="form-group">
            <label>Type Connection *</label>
            <select class="form-control" name="FORM[CONNECTION_TYPE]">
                <option value="connection-less">connection-less</option>
                <option value="connection-oriented">connection-oriented</option>
            </select>
            <span class="help-block">Type Connection define by Client</span>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </fieldset>
</form>

<script>
$(document).ready(function (){
        $('#success').hide();
        $('#error').hide(); 
    });    
if($ ( "#DIFF_PORT" ).val()=="0")$( ".SERVER_PORT" ).fadeOut(); $( "[name='FORM[SERVER_PORT_1]']" ).slideDown();
if($( "#SERVER_PRODUCT" ).val()!="Other")$( ".SERVER_CLASS" ).fadeOut();
$( "#SERVER_PRODUCT" ).on("change",function() {
    if($( "#SERVER_PRODUCT" ).val()=="Other"){
        $( ".SERVER_CLASS" ).fadeIn();
    }else if($( "#SERVER_PRODUCT" ).val()=="PDAM"){
        $ ( "#DIFF_PORT" ).val("0")
        $( ".SERVER_CLASS" ).fadeOut();
        $( ".SERVER_PORT" ).fadeOut();
        $( "[name='FORM[SERVER_PORT_1]']" ).slideDown();
    }else{
        $( ".SERVER_CLASS" ).fadeOut();
    }
    
});
$( "#DIFF_PORT" ).on("change", function() {
    if($ ( "#DIFF_PORT" ).val()=="1"){
        $( ".SERVER_PORT" ).slideDown();
    }else if($ ( "#DIFF_PORT" ).val()=="0"){
        $( ".SERVER_PORT" ).fadeOut();
        $( "[name='FORM[SERVER_PORT_1]']" ).slideDown();
    } 
});

</script>