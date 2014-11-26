<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);


?>

<h3>เพิ่มข้อมูลโครงการ</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model,'outsource'=>$outsource,'workcodes'=>$workcodes,'numContracts'=>$numContracts,'modelContract'=>$modelContract,'modelContract2'=>$modelContract2,'modelContract3'=>$modelContract3,'modelContract4'=>$modelContract4,'modelContract5'=>$modelContract5
)); ?>