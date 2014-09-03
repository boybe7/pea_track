<?php
$this->breadcrumbs=array(
	'Diagnosises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Diagnosis','url'=>array('index')),
	array('label'=>'Manage Diagnosis','url'=>array('admin')),
);
?>

<center><h3>เพิ่มข้อมูลคำวินิจฉัยโรค</h3></center>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>