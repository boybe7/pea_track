<?php
$this->breadcrumbs=array(
	'Diagnosises',
);

$this->menu=array(
	array('label'=>'Create Diagnosis','url'=>array('create')),
	array('label'=>'Manage Diagnosis','url'=>array('admin')),
);
?>

<h1>Diagnosises</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
