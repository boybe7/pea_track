<?php
$this->breadcrumbs=array(
	'Drug Methods'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DrugMethod','url'=>array('index')),
	array('label'=>'Create DrugMethod','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('drug-method-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<center><h3>ข้อมูลวิธีการใช้ยา</h3></center>



<?php 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'success',
    'label'=>'เพิ่มข้อมูลวิธีการใช้ยา',
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
		
		'name'=>array(
	  	            	  		'header'=>'วิธีการใช้ยา',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'name',
	  	            	  		'value'=>'$data->name',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>''

	  	            	  		)
	  	 ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
