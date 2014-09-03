<?php
$this->breadcrumbs=array(
	'Symptoms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Symptom','url'=>array('index')),
	array('label'=>'Manage Symptom','url'=>array('admin')),
);
?>

<center><h3>เพิ่มข้อมูลอาการ</h3></center>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>