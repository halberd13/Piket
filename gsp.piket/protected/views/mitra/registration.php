<?php
if(isset($_GET['rc'])){
    if($_GET['rc']=='00'){
?>        

<div class="alert alert-success" id="success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Data has been changed.
</div>
<?php }else {?>    
<div class="alert alert-block alert-danger" id="error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Failed!</strong> Data failed to change.
</div>
<?php
    }
}
?>
<form name="FORM_REGISTRATION" action="<?php echo Yii::app()->baseUrl; ?>/?r=mitra/registration" method="POST">
    <fieldset>
        <legend>Form Registration New Client / Bank</legend>
        <div class="form-group">
            <label>Name Client Partner / Bank *</label>
            <input type="text" class="form-control" placeholder="Server Name" name="FORM[CSC_DC_NAME]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>PIC Client Partner / Bank *</label>
            <input type="text" class="form-control" value="IT Development GSP" name="FORM[CSC_DC_PIC_NAME]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Phone Client Partner / Bank *</label>
            <input type="text" class="form-control" value="022-87836068 / 022-7274995" name="FORM[CSC_DC_PHONE]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>City of Client Partner / Bank *</label>
            <input type="text" class="form-control" value="Bandung" name="FORM[CSC_DC_CITY]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>List Code Bank *</label>
            <select class="form-control" name="FORM[CSC_B_ID]" id="CSC_B_ID">
                <?php 
                asort($listBank);
                echo "<option value='0'>----- None -----</option>";
                foreach($listBank as $code_bank=>$name_bank){
                    echo "<option value='".$code_bank."'>".$name_bank." (".$code_bank.")</option>";
                }?>
            </select>
            <span class="help-block">Server Product want to be created.</span>
        </div>
        <div class="form-group">
            <label>Central ID Client Partner / Bank *</label>
            <input type="text" class="form-control" maxlength="7" name="FORM[CSC_DC_ID]" id="CSC_DC_ID" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <div class="col-sm-3">
                <label>Services PLN (Biller Code) *</label>
                <label class="checkbox">
                    <input type="checkbox" name="FORM[CSC_BI_ID][]" value="99501"><span class="help-block">PLN Postpaid</span>
                    <input type="checkbox" name="FORM[CSC_BI_ID][]" value="99502"><span class="help-block">PLN Prepaid</span>
                    <input type="checkbox" name="FORM[CSC_BI_ID][]" value="6023"><span class="help-block">PLN Nontaglis</span>
                </label>
            </div>
            <div class="clearfix"></div>
            <?php 
                    asort($listBiller);
                    $i=0;
                    $row=5;
                    $tb=count($listBiller);
                    echo '<div class="col-sm-3"><label>Services PDAM(Biller Code) *</label>';
                    echo '<label class="checkbox">';
                    echo '<input type="checkbox" onClick="toggle_pdam(this)" /> Check All<br/>';
                        foreach ($listBiller as $biller_code=>$biller_name){
                            if(substr($biller_code, 2,2)=="87"){
                                if($i<$row){
                                    echo '<input type="checkbox" class="pdam" name="FORM[CSC_BI_ID][]" value="'.$biller_code.'"><span class="help-block">'.$biller_name.'</span>';
                                    $i++;
                                }else {
                                    echo '</label></div><div class="col-sm-3">';
                                    echo '<label class="checkbox">';
                                    $row=$row+5;
                                }
                            }
                        }
                        echo '</label></div>'; 
                    
            ?>
            <div class="clearfix"></div>
            <div class="col-sm-5">
                <label>Services Multifinance (Biller Code) *</label>
                <label class="checkbox">
                    <input type="checkbox" onClick="toggle_multifinance(this)" /> Check All<br/>
                    <?php 
                    asort($listBiller);
                    $i=0;
                    
                    foreach ($listBiller as $biller_code=>$biller_name){
                        if(substr($biller_code, 2,2)=="86"){
                            echo '<input type="checkbox" class="multifinance" name="FORM[CSC_BI_ID][]" value="'.$biller_code.'"><span class="help-block">'.$biller_name.'</span>';
                        }
                    $i++;}?>
                </label>
            </div>
            <div class="col-sm-5">
                <label>Services Multi Biller (Biller Code) *</label>
                <label class="checkbox">
                    <input type="checkbox" onClick="toggle_multibiller(this)" /> Check All<br/>
                    <?php 
                    asort($listBiller);
                    $i=0;
                    
                    foreach ($listBiller as $biller_code=>$biller_name){
                        if(substr($biller_code, 2,2)!="87" && substr($biller_code, 2,2)!="99"){
                            echo '<input type="checkbox" class="multibiller" name="FORM[CSC_BI_ID][]" value="'.$biller_code.'"><span class="help-block">'.$biller_name.'</span>';
                        }
                    $i++;}?>
                </label>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label class="DIFF_PORT">Delivery Channel Type</label>
            <select class="form-control" id="DC_TYPE" name="FORM[CSC_DC_TYPE]">
                <option value="0">Managed</option>
                <option value="1" selected>Unmanaged</option>
            </select>
            <span class="help-block DIFF_PORT">Use different port each Product.</span>
        </div>
        <div class="form-group" id="set_admin">
            <label>Admin Bank / Admin Online *</label>
            <input type="text" class="form-control"  maxlength="10" data-toggle="tooltip" data-placement="bottom" title="Fill admin charge following Client Bank/ Partner" value="0" name="FORM[CSM_CAF_FEE]">
            <span class="help-block">Central ID define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Digit Code Client Parnert / Bank *</label>
            <input type="text" class="form-control" placeholder="000 / ABC" maxlength="3"  data-toggle="tooltip" data-placement="bottom" title="Fill 3 Digit Prefix or Code Alphabet following Clien Bank / Partner PPOB" name="FORM[CSC_DC_PARTNER_CODE]">
            <span class="help-block">Bank Code define by yourself.</span>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Next Step</button>
    </fieldset>
</form>


<script type="text/javascript" language="javascript">
    $('[data-toggle="tooltip"]').tooltip();
    loadCID();
        $('#CSC_B_ID').change(function (){
           var bank_code = $(this).val();
           var cid=null;
           url = "<?php echo Yii::app()->request->baseUrl;;?>/index.php?r=mitra/getCID";
              $.post( url, { getCID : true , bank_code: bank_code, })
                .done(function( data) {
                    $('#CSC_DC_ID').val(data);
                });
        })
        
        $('#DC_TYPE').change(function (){
            var id = $(this ).val();
            if(id==1){
                $('#set_admin').slideDown();
            }else{
                $('#set_admin').slideUp();
            } 
        })
        $('#set-admin').hide();
        
    
    function loadCID(){
        bank_code = $('#CSC_B_ID').val();
        url = "<?php echo Yii::app()->request->baseUrl;;?>/index.php?r=mitra/getCID";
              $.post( url, { getCID : true , bank_code: bank_code, })
                .done(function( data) {
                    $('#CSCCOREDOWNCENTRAL_CSC_DC_ID').val(data);
                });
    }
    function toggle_multibiller(source) {
      checkboxes = document.getElementsByClassName('multibiller');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
      }
    }
    function toggle_pdam(source) {
      checkboxes = document.getElementsByClassName('pdam');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
      }
    }
    function toggle_multifinance(source) {
      checkboxes = document.getElementsByClassName('multifinance');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
      }
    }
    
    
</script>