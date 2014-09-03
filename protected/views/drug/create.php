<?php
$this->breadcrumbs=array(
	'Drugs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Drug','url'=>array('index')),
	array('label'=>'Manage Drug','url'=>array('admin')),
);
?>

<center><h3>เพิ่มข้อมูลยา</h3></center>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>