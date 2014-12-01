<?php
$this->breadcrumbs=array(
	'Grandchildren'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Grandchild','url'=>array('index')),
	array('label'=>'Manage Grandchild','url'=>array('admin')),
);
?>

<h1>Create Grandchild</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>