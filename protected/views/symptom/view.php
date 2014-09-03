<?php
$this->breadcrumbs=array(
	'Symptoms'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Symptom','url'=>array('index')),
	array('label'=>'Create Symptom','url'=>array('create')),
	array('label'=>'Update Symptom','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Symptom','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Symptom','url'=>array('admin')),
);
?>

<h3>ข้อมูลอาการ</h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'code',
		'name',
	),
)); ?>
