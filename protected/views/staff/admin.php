<?php
$this->breadcrumbs=array(
	'Staff'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('staff-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<center><h3>ผู้ใช้งานระบบ</h3></center>



<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'success',
    'label'=>'เพิ่มผู้ใช้งานระบบ',
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
	'columns'=>array(
		'staff_id'=>array(
	  	            	  		'header'=>'รหัส',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'staff_id',
	  	            	  		'value'=>'$data->staff_id',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:40px'

	  	            	  		)
	  	            	  	),
		'username'=>array(
	  	            	  		'header'=>'username',
	  	            	  		'name'=> 'username',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'value'=>'$data->username',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;'

	  	            	  		)
	  	            	  	),
		'firstname'=>array(
	  	            	  		'header'=>'ชื่อ',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'firstname',
	  	            	  		'value'=>'$data->firstname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:left;padding-left:20px'

	  	            	  		)
	  	            	  	),
		'lastname'=>array(
	  	            	  		'header'=>'นามสกุล',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'lastname',
	  	            	  		'value'=>'$data->lastname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:left;padding-left:20px'

	  	            	  		)
	  	            	  	),
		'type_id'=>array(
	  	            	  		'header'=>'ประเภท',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'typename',
	  	            	  		'value'=>'$data->StaffType->name',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		),
                                                'filter' => CHtml::listData(StaffType::model()->findAll(),'type_id','name'),
	  	            	  	),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); 



?>
