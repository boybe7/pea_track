<?php
$this->breadcrumbs=array(
	'Diagnosises'=>array('index'),
	$model->name,
);

?>

<h3>ข้อมูลคำวินิจฉัยโรค</h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'code',
		'name',
	),
)); ?>
