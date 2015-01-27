<?php
$this->breadcrumbs=array(
	'Payment Outsource Contracts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PaymentOutsourceContract','url'=>array('index')),
	array('label'=>'Manage PaymentOutsourceContract','url'=>array('admin')),
);
?>

<h1>Create PaymentOutsourceContract</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>