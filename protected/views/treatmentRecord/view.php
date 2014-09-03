<?php
$this->breadcrumbs=array(
	'Treatment Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TreatmentRecord','url'=>array('index')),
	array('label'=>'Create TreatmentRecord','url'=>array('create')),
	array('label'=>'Update TreatmentRecord','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete TreatmentRecord','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TreatmentRecord','url'=>array('admin')),
);
?>

<h1>View TreatmentRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'HN',
		'visit_date',
		'bloodPressure1',
		'bloodPressure2',
		'temperature',
		'rate',
		'pulse',
		'symptomID',
		'diagID1',
		'diagID2',
		'diagID3',
		'nurseID',
		'doctorID',
		'cashierID',
	),
)); ?>
