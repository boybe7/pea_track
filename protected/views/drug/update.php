<?php
$this->breadcrumbs=array(
	'Drugs'=>array('index'),
	$model->id=>array('view','id'=>$model->id)
	
);


?>

<center><h3>แก้ไขข้อมูลยา</h3></center>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>