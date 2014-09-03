<?php
$this->breadcrumbs=array(
	'Drugs'=>array('index'),
	$model->drug_id,
);

?>

<h3>ข้อมูลยา</h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'drug_id',
		'drug_name',
		'unit',
		'price',
                'drug_type_id'=>array('name'=> 'drug_type_id','value'=>$model->DrugType->name)
	),
)); ?>
