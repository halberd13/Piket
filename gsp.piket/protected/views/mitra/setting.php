<style type="text/css">
      .form-signin {
        max-width: 700px;
        padding: 19px 29px 29px;
        margin: 25px auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
<div class="form-signin">

<div class="box-form">

<h3>Form Registration</h3>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registrasi-mitra',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
         'enableAjaxValidation'=>true,   
	),
)); 
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Partner/Central Name'); ?>
		<?php echo $form->dropDownList($model,'CSC_DC_NAME', $listPartner); ?>
		<?php echo $form->error($model,'CSC_DC_NAME'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Partner/Central start Access Time'); ?>
		<?php echo $form->timeField($model,'CSC_DC_NAME'); ?>
		<?php echo $form->error($model,'CSC_DC_PHONE'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Partner/Central End Access Time'); ?>
		<?php echo $form->dateField($model,'CSC_DC_PHONE'); ?>
		<?php echo $form->error($model,'CSC_DC_PHONE'); ?>
	</div>

       
        
	<div class="row">
		<?php echo $form->labelEx($model,'Delivery Channel Type'); ?>
		<?php echo $form->dropDownList($model,'CSC_DC_TYPE', array('0'=>'Managed', '1'=>'Unmanaged'),array('id'=>'DC_TYPE')); ?>
		<?php echo $form->error($model,'CSC_DC_TYPE'); ?>
	</div>
	<div class="row" id="set-admin">
            <label>Admin Charges</label>
            <input type="text" name="ADMIN_CHARGES" value="0">
	</div>
        <div class="row">
            <label>Partner Code in REF Num</label>
            <input type="text" name="PARTNER_CODE">
	</div>
        <div class="row">
            <div class="checkboxgroup">
		<?php echo $form->labelEx($biller,'Biller Product'); ?>
		<?php echo $form->checkBoxList($biller,'CSC_BI_NAME',array(
                    'VOUCHER_PRABAYAR'=>'VOUCHER PRABAYAR',
                    'VOUCHER_PASCABAYAR'=>'VOUCHER PASCABAYAR',
                    'INTERCITY_TRANSPORT'=>'INTERCITY TRANSPORT',
                    'TIKET_KAI'=>'TIKET KAI',
                    'FIF'=>'FINANCE FIF',
                    'WOM'=>'FINANCE WOM',
                    'BAF'=>'FINANCE BAF',
                    'MAF_MCF'=>'FINANCE MAF/MCF',
                ), array('template'=>'<div><label class="checkbox">{input} {label}</label></div>')); ?>
		<?php echo $form->error($biller,'CSC_BI_ID'); ?>
            </div>    
	</div>
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
<script type="text/javascript" language="javascript">
    $(document).ready(function (){
        
        $('#DC_TYPE').change(function (){
            var id = $(this ).val();
            if(id==1){
                $('#set-admin').slideDown();
            }
            else{
                $('#set-admin').slideUp();
            } 
        })
        $('#set-admin').hide();
    })
    
</script>