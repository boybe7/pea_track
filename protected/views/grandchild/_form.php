<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'grandchild-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php

	 echo CHtml::activeTextField($model, '[' . $index . ']name'); 

	 ?>

	
 


<?php $this->endWidget(); ?>
