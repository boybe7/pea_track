<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);


?>

<h1>Create Project</h1>

<?php echo $this->renderPartial('_form2', array('model'=>$model)); ?>