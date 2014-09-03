<?php
$this->breadcrumbs=array(
	'Drugs'=>array('index'),
	
);

$this->menu=array(
	array('label'=>'List Drug','url'=>array('index')),
	array('label'=>'Create Drug','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('drug-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<center><h3>ข้อมูลยา</h3><center>
        
        

<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'success',
    'label'=>'เพิ่มยา',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right'),
)); 

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'drug-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
       // 'template'=>"{summary}{items}{pager}",
        'htmlOptions'=>array('style'=>'padding-top:40px'),
        'enablePagination' => true,
        'pagerCssClass' => 'pagination pagination-right',
        'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
	'columns'=>array(
		'drug_id'=>array(
	  	            	  		'header'=>'รหัสยา',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'drug_id',
	  	            	  		'value'=>'$data->drug_id',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:100px'

	  	            	  		)
	  	            	  	),
		'drug_name'=>array(
	  	            	  		'header'=>'ชื่อยา',
	  	            	  		'name'=> 'drug_name',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'value'=>'$data->drug_name',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;'

	  	            	  		)
	  	            	  	),
		'unit'=>array(
	  	            	  		'header'=>'หน่วย',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'unit',
	  	            	  		'value'=>'$data->unit',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:150px'

	  	            	  		)
	  	            	  	),
		'price'=>array(
	  	            	  		'header'=>'ราคาต่อหน่วย(บาท)',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'price',
	  	            	  		'value'=>'$data->price',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:right;padding-right:20px;width:150px'

	  	            	  		)
	  	            	  	),
		'drug_type_id'=>array(
	  	            	  		'header'=>'ประเภท',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'drug_type_id',
	  	            	  		'value'=>'$data->DrugType->name',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:200px'

	  	            	  		),
                                                'filter' => CHtml::listData(DrugType::model()->findAll(),'id','name'),
	  	            	  	),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); 



 ?>
