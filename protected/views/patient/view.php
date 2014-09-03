<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	$model->HN,
);

$this->menu=array(
	array('label'=>'List Patient','url'=>array('index')),
	array('label'=>'Create Patient','url'=>array('create')),
	array('label'=>'Update Patient','url'=>array('update','id'=>$model->HN)),
	array('label'=>'Delete Patient','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->HN),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Patient','url'=>array('admin')),
);
?>

<h3>แสดงข้อมูลผู้ป่วย HN:<?php echo $model->HN; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'HN',
		'title',
		'firstname',
		'lastname',
		'birthdate',
		'sex',
		'id_no',
		'phone',
		'emergency_phone',
		'allergy',
		'address',
		'sub_district',
		'district'=>array('name'=> 'district','value'=>$model->Amphur->AMPHUR_NAME),
		'province'=>array('name'=> 'province','value'=>$model->Province->PROVINCE_NAME),
		//'drug_typeID',
                'drug_typeID'=>array('name'=> 'drug_typeID','value'=>$model->DrugType->name)
	),
)); ?>
