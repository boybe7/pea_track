<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create2',
);


?>

<h3>เพิ่มข้อมูลโครงการ</h3>

<?php echo $this->renderPartial('_form2', array('model'=>$model)); ?>