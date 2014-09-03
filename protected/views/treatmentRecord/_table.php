<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'my-grid',
	'dataProvider'=>$model,
	'summaryText'=>'แสดงข้อมูล {start}-{end} จากทั้งหมด {count}',
        'htmlOptions'=>array('style'=>'padding-top:0'),
	'columns'=>array(
		'HN'=>array(
	  	            	  		'header'=>'เลขที่ผู้ป่วย',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #000000'),
	  	            	  		'name'=> 'ud',
	  	            	  		'value'=>'$data->HN',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:80px'

	  	            	  		)
	  	            	  	),
		'firstname'=>array(
	  	            	  		'header'=>'ชื่อ',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #000000'),
	  	            	  		'name'=> 'firstname',
	  	            	  		'value'=>'$data->Patient->firstname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;'

	  	            	  		)
	  	            	  	),
                'lastname'=>array(
	  	            	  		'header'=>'นามสกุล',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #000000'),
	  	            	  		'name'=> 'lastname',
	  	            	  		'value'=>'$data->Patient->lastname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;'

	  	            	  		)
	  	            	  	),
		'visit_date'=>array(
	  	            	  		'header'=>'วันที่เข้ารับการบริการ',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #000000'),
	  	            	  		'name'=> 'visit_date2',
	  	            	  		'value'=>'$data->visit_date',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:300px'

	  	            	  		)
	  	            	  	),
               
//		'type_id'=>array(
//	  	            	  		'header'=>'ประเภท',
//                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
//	  	            	  		'name'=> 'typename',
//	  	            	  		'value'=>'$data->StaffType->name',
//	  	            	  		'htmlOptions'=>array(
//	  	            	  			'style'=>'text-align:center'
//
//	  	            	  		),
//                                                'filter' => CHtml::listData(StaffType::model()->findAll(),'type_id','name'),
//	  	            	  	),
		
	),
)); ?>
