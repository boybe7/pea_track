<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HN')); ?>:</b>
	<?php echo CHtml::encode($data->HN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visit_date')); ?>:</b>
	<?php echo CHtml::encode($data->visit_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bloodPressure1')); ?>:</b>
	<?php echo CHtml::encode($data->bloodPressure1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bloodPressure2')); ?>:</b>
	<?php echo CHtml::encode($data->bloodPressure2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temperature')); ?>:</b>
	<?php echo CHtml::encode($data->temperature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate')); ?>:</b>
	<?php echo CHtml::encode($data->rate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pulse')); ?>:</b>
	<?php echo CHtml::encode($data->pulse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('symptomID')); ?>:</b>
	<?php echo CHtml::encode($data->symptomID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagID1')); ?>:</b>
	<?php echo CHtml::encode($data->diagID1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagID2')); ?>:</b>
	<?php echo CHtml::encode($data->diagID2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagID3')); ?>:</b>
	<?php echo CHtml::encode($data->diagID3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nurseID')); ?>:</b>
	<?php echo CHtml::encode($data->nurseID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doctorID')); ?>:</b>
	<?php echo CHtml::encode($data->doctorID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cashierID')); ?>:</b>
	<?php echo CHtml::encode($data->cashierID); ?>
	<br />

	*/ ?>

</div>