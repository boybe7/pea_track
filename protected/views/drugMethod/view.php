<?php
$this->breadcrumbs=array(
	'Drug Methods'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List DrugMethod','url'=>array('index')),
	array('label'=>'Create DrugMethod','url'=>array('create')),
	array('label'=>'Update DrugMethod','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete DrugMethod','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DrugMethod','url'=>array('admin')),
);
?>

<h1>View DrugMethod #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
