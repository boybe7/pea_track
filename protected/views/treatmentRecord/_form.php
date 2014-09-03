<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'treatment-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'HN',array('class'=>'span5')); ?>
        <?php echo $form->textFieldRow($model,'firstname',array('class'=>'span5')); ?>
        <?php echo $form->textFieldRow($model,'lastname',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'visit_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'bloodPressure1',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'bloodPressure2',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'temperature',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'rate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pulse',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'symptomID',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'diagID1',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'diagID2',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'diagID3',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'nurseID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'doctorID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cashierID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
