<?php
$this->breadcrumbs=array(
	'Symptoms'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Symptom','url'=>array('index')),
	array('label'=>'Create Symptom','url'=>array('create')),
	array('label'=>'View Symptom','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Symptom','url'=>array('admin')),
);
?>

<center><h3>แก้ไขข้อมูลอาการ</h3></center>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>