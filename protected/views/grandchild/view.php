<?php
$this->breadcrumbs=array(
	'Grandchildren'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Grandchild','url'=>array('index')),
	array('label'=>'Create Grandchild','url'=>array('create')),
	array('label'=>'Update Grandchild','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Grandchild','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Grandchild','url'=>array('admin')),
);
?>

<h1>View Grandchild #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'child_id',
	),
)); ?>
