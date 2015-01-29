<?php
$this->breadcrumbs=array(
	'Payment Project Contracts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PaymentProjectContract','url'=>array('index')),
	array('label'=>'Manage PaymentProjectContract','url'=>array('admin')),
);
?>

<h3>เพิ่มรายการเงินงวดสัญญาโครงการ</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model,'T_percent'=>$t,'A_percent'=>$a)); ?>