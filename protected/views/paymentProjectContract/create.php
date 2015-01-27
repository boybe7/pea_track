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

<h1>Create PaymentProjectContract</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>