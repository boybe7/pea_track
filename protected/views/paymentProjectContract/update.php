<?php
$this->breadcrumbs=array(
	'Payment Project Contracts'=>array('index'),
	'Update',
);

?>

<h3>แก้ไขรายการเงินงวดสัญญาโครงการ</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model,'T_percent'=>$t,'A_percent'=>$a)); ?>