<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);


?>

<h1>Create Project</h1>

<?php echo $this->renderPartial('_form2', array('model'=>$model,'workcodes'=>$workcodes,'numContracts'=>$numContracts,'modelContract'=>$modelContract,'modelContract2'=>$modelContract2,'modelContract3'=>$modelContract3,'modelContract4'=>$modelContract4,'modelContract5'=>$modelContract5
)); ?>