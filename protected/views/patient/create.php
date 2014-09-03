<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	'Create',
);

?>

<center><h3>เพิ่มข้อมูลผู้ป่วยใหม่</h3></center>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>