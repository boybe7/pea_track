<?php
$this->breadcrumbs=array(
	'Drug Methods'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DrugMethod','url'=>array('index')),
	array('label'=>'Create DrugMethod','url'=>array('create')),
	array('label'=>'View DrugMethod','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage DrugMethod','url'=>array('admin')),
);
?>

<h3>แก้ไขข้อมูลวิธีการใช้ยา</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>