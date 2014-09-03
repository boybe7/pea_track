<?php
$this->breadcrumbs=array(
	'Treatment Records'=>array('index'),
	'บันทึกการรักษา',
);

?>

<center><h3>บันทึกการรักษา</h3></center>

<?php echo $this->renderPartial('_formDoctor', array('model'=>$model)); ?>