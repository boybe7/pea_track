<?php
$this->breadcrumbs=array(
	'Treatment Records'=>array('index'),
	'บันทึกอาการ',
);

?>

<center><h3>บันทึกอาการ</h3></center>

<?php echo $this->renderPartial('_formNurse', array('model'=>$model)); ?>