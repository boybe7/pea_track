<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'pj_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pj_code',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'pj_name',array('class'=>'span5','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'pj_work_cat',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pj_fiscalyear',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pj_date_approved',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'pj_details',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'pj_user_create',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pj_user_update',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
