<?php
$this->breadcrumbs=array(
	'Drug Methods'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DrugMethod','url'=>array('index')),
	array('label'=>'Manage DrugMethod','url'=>array('admin')),
);
?>

<h3>เพิ่มข้อมูลวิธีการใช้ยา</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>