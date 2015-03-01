<?php
$this->breadcrumbs=array(
	'Management Costs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ManagementCost','url'=>array('index')),
	array('label'=>'Manage ManagementCost','url'=>array('admin')),
);
?>

<h1>Create ManagementCost</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>