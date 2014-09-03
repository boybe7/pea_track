<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'HN',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'firstname',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'lastname',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'birthdate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sex',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'id_no',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'emergency_phone',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'allergy',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'sub_district',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'district',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'province',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'drug_typeID',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
