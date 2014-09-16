<?php
$this->breadcrumbs=array(
	'Vendors'=>array('admin'),
	
);

?>

<h1>แสดงข้อมูลคู่สัญญา</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		
		'v_name',
		'v_address',
		'v_tax_id',
		'v_tel',
		'v_contractor',
	),
)); ?>
