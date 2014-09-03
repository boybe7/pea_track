<?php
$this->breadcrumbs=array(
	'Symptoms',
);

$this->menu=array(
	array('label'=>'Create Symptom','url'=>array('create')),
	array('label'=>'Manage Symptom','url'=>array('admin')),
);
?>

<h1>Symptoms</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
