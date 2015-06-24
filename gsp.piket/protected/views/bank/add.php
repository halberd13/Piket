<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="box-form">
<!--<h1>Registrasi Mitra</h1>-->


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Bank Code'); ?>
		<?php echo $form->textField($model,'CSC_B_ID'); ?>
		<?php echo $form->error($model,'CSC_B_ID'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Bank Name'); ?>
		<?php echo $form->textField($model,'CSC_B_NAME'); ?>
		<?php echo $form->error($model,'CSC_B_NAME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Bank Address'); ?>
		<?php echo $form->textField($model,'CSC_B_ADDRESS'); ?>
		<?php echo $form->error($model,'CSC_B_ADDRESS'); ?>
	</div>


	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>