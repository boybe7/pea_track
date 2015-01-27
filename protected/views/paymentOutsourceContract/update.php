<?php
$this->breadcrumbs=array(
	'Payment Outsource Contracts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaymentOutsourceContract','url'=>array('index')),
	array('label'=>'Create PaymentOutsourceContract','url'=>array('create')),
	array('label'=>'View PaymentOutsourceContract','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PaymentOutsourceContract','url'=>array('admin')),
);
?>

<h1>Update PaymentOutsourceContract <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>