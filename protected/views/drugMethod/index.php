<?php
$this->breadcrumbs=array(
	'Drug Methods',
);

$this->menu=array(
	array('label'=>'Create DrugMethod','url'=>array('create')),
	array('label'=>'Manage DrugMethod','url'=>array('admin')),
);
?>

<h1>Drug Methods</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
