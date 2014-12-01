<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contract-approve-history-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'contract_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'detail',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'dateApprove',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'approveBy',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'cost',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'timeSpend',array('class'=>'span5','maxlength'=>200)); ?>


<?php $this->endWidget(); ?>
