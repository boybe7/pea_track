<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'project-contract-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'pc_code',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'pc_proj_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pc_vendor_id',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'pc_details',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'pc_sign_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pc_end_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pc_cost',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pc_T_percent',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pc_A_percent',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pc_guarantee',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'pc_user_create',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pc_user_update',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>