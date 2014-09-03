<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_No')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->bill_No),array('view','id'=>$data->bill_No)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HN')); ?>:</b>
	<?php echo CHtml::encode($data->HN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visit_date')); ?>:</b>
	<?php echo CHtml::encode($data->visit_date); ?>
	<br />


</div>