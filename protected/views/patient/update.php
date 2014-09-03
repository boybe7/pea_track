<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	'HN:'.$model->HN=>array('view','id'=>$model->HN),
	'Update',
);

$this->menu=array(
	array('label'=>'List Patient','url'=>array('index')),
	array('label'=>'Create Patient','url'=>array('create')),
	array('label'=>'View Patient','url'=>array('view','id'=>$model->HN)),
	array('label'=>'Manage Patient','url'=>array('admin')),
);
?>

<center><h3>แก้ไขข้อมูลผู้ป่วย</h3></center>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>