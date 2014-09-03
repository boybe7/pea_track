<?php
$this->breadcrumbs=array(
	'Diagnosises'=>array('index'),
	
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('diagnosis-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<center><h3>ข้อมูลคำวินิจฉัยโรค</h3></center>
<?php 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'success',
    'label'=>'เพิ่มข้อมูลคำวินิจฉัยโรค',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right'),
)); 

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'staff-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	 // 'template'=>"{summary}{items}{pager}",
        'htmlOptions'=>array('style'=>'padding-top:40px'),
        'enablePagination' => true,
        'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
        'pagerCssClass' => 'pagination pagination-right',
	'columns'=>array(
		'code',
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
