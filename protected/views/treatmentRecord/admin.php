<?php
$this->breadcrumbs=array(
	'Treatment Records'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TreatmentRecord','url'=>array('index')),
	array('label'=>'Create TreatmentRecord','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('treatment-record-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Treatment Records</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'treatment-record-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'HN',
		'visit_date',
		'bloodPressure1',
		'bloodPressure2',
		'temperature',
		/*
		'rate',
		'pulse',
		'symptomID',
		'diagID1',
		'diagID2',
		'diagID3',
		'nurseID',
		'doctorID',
		'cashierID',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
