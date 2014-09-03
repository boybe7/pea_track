<?php


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

<center><h3>รายชื่อผู้เข้ารับบริการ</h3>
    <?php
    
    require_once('class_thaidate.php'); 
    //$date->setTimezone(new DateTimeZone('Asia/Bangkok'));
    $date = new Thaidate(date('Y-m-d : H:i:s'), 'F1');
    echo "<h4>ประจำ".$date->getDateTime()."</h4>";
    ?>
    </center>



<?php 


$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'staff-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->searchPresent(),
	'filter'=>$model,
        'enableSorting' => false,
       // 'template'=>"{summary}{items}{pager}",
        'htmlOptions'=>array('style'=>'padding-top:40px'),
        'enablePagination' => true,
        'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
	'columns'=>array(
		'bill_No'=>array(
	  	            	  		'header'=>'เลขที่ใบเสร็จ',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'bill_No',
	  	            	  		'value'=>'$data->bill_No',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:100px'

	  	            	  		)
	  	            	  	),
		'HN'=>array(
	  	            	  		'header'=>'HN',
	  	            	  		'name'=> 'HN',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'value'=>'$data->HN',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:100px'

	  	            	  		)
	  	            	  	),
		'firstname'=>array(
	  	            	  		'header'=>'ชื่อ',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'firstname',
	  	            	  		'value'=>'$data->Patient->firstname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:left;padding-left:20px'

	  	            	  		)
	  	            	  	),
		'lastname'=>array(
	  	            	  		'header'=>'นามสกุล',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'lastname',
	  	            	  		'value'=>'$data->Patient->lastname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:left;padding-left:20px'

	  	            	  		)
	  	            	  	),
		'type_id'=>array(
	  	            	  		'header'=>'ประเภทยา',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'drugType',
	  	            	  		'value'=>'$data->Patient->DrugType->name',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		),
                                                'filter' => CHtml::listData(DrugType::model()->findAll(),'id','name'),
	  	            	  	),
		
		''=> array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{print}',
                        'buttons'=>array
                        (
                            'print' => array
                            (
                                'label'=>'ออกใบเสร็จ',
                                'icon'=>'list-alt white',
                                'url'=>'Yii::app()->createUrl("bill/view", array("id"=>$data->id))',
                                'options'=>array(
                                    'class'=>'btn btn-medium btn-info',
                                ),
                            ),
                            /*'del' => array
                            (
                                'label'=>'ลบ',
                                'icon'=>'remove',
                                'url'=>'Yii::app()->createUrl("treatmentRecord/delete", array("id"=>$data->id))',
                                'options'=>array(
                                    'class'=>'',
                                ),
                            ),*/
                          )
                    )
	),
)); 



?>
