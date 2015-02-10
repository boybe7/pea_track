<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Update',
);


?>

<h3>แก้ไขข้อมูลโครงการ</h3>

<?php echo $this->renderPartial('_formUpdate', array('model'=>$model,'contracts'=>$contracts,'outsource'=>$outsource,'numContracts'=>$numContracts)); ?>