<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'HN',array('class'=>'span5')); ?>

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
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
