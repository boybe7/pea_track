<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'management-cost-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'mc_proj_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mc_type',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mc_detail',array('class'=>'span5','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'mc_cost',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mc_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mc_user_update',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
