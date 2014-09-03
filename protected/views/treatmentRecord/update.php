<?php
$this->breadcrumbs=array(
	'Treatment Records'=>array('index'),
	'Update',
);

?>

<center><h3>บันทึกอาการ</h3></center>

<?php echo $this->renderPartial('_formNurse2',array('model'=>$model)); ?>