<?php
$this->breadcrumbs=array(
	'Diagnosises'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);


?>

<center><h3>แก้ไขข้อมูลคำวินิจฉัยโรค</h3></center>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>