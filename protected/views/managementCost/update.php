<?php
$this->breadcrumbs=array(
	'Management Costs'=>array('index'),
	$model->mc_id=>array('view','id'=>$model->mc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ManagementCost','url'=>array('index')),
	array('label'=>'Create ManagementCost','url'=>array('create')),
	array('label'=>'View ManagementCost','url'=>array('view','id'=>$model->mc_id)),
	array('label'=>'Manage ManagementCost','url'=>array('admin')),
);
?>

<h1>Update ManagementCost <?php echo $model->mc_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>