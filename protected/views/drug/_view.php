<?php
/* @var $this DrugController */
/* @var $data Drug */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drug_id')); ?>:</b>
	<?php echo CHtml::encode($data->drug_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drug_name')); ?>:</b>
	<?php echo CHtml::encode($data->drug_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit')); ?>:</b>
	<?php echo CHtml::encode($data->unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drug_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->drug_type_id); ?>
	<br />


</div>