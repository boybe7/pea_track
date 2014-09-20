<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->pj_id,
);

$this->menu=array(
	array('label'=>'List Project','url'=>array('index')),
	array('label'=>'Create Project','url'=>array('create')),
	array('label'=>'Update Project','url'=>array('update','id'=>$model->pj_id)),
	array('label'=>'Delete Project','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->pj_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Project','url'=>array('admin')),
);
?>

<h1>View Project #<?php echo $model->pj_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'pj_id',
		'pj_code',
		'pj_name',
		'pj_vendor_id',
		'pj_work_cat',
		'pj_fiscalyear',
		'pj_date_approved',
		'pj_details',
		'pj_user_create',
		'pj_user_update',
	),
)); ?>
