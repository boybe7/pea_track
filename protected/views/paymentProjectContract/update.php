<?php
$this->breadcrumbs=array(
	'Payment Project Contracts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaymentProjectContract','url'=>array('index')),
	array('label'=>'Create PaymentProjectContract','url'=>array('create')),
	array('label'=>'View PaymentProjectContract','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PaymentProjectContract','url'=>array('admin')),
);
?>

<h1>Update PaymentProjectContract <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>