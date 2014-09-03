<?php
$this->breadcrumbs=array(
	'Bills'=>array('index'),
	$model->bill_No=>array('view','id'=>$model->bill_No),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bill','url'=>array('index')),
	array('label'=>'Create Bill','url'=>array('create')),
	array('label'=>'View Bill','url'=>array('view','id'=>$model->bill_No)),
	array('label'=>'Manage Bill','url'=>array('admin')),
);
?>

<h1>Update Bill <?php echo $model->bill_No; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>