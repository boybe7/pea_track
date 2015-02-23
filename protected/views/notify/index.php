<style type="text/css">
	
.pagination {
   margin: 0px 0;
}
.summary {
	 color: #08C;
}
</style>


<?php
$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	//'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('vendor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>ข้อมูลแจ้งเตือน</h1>


<?php


$current_date = (date("Y")+543).date("-m-d");

//print_r("SELECT * FROM payment_project_contract WHERE DATEDIFF(DATE_ADD( invoice_date, INTERVAL invoice_alarm
//DAY ),'".$current_date."')<7  AND (bill_date='' OR bill_date='0000-00-00')");
$projectContractData=Yii::app()->db->createCommand("SELECT pj_name as project,pc_code as contract,'แจ้งเตือนครบกำหนดค้ำประกันสัญญา' as alarm_detail,pc_garantee_date as date_end, CONCAT('project/update/',pj_id) as url,'1' as type, pc_id as update_id FROM project_contract pc LEFT JOIN project p ON pc.pc_proj_id=p.pj_id WHERE DATEDIFF(pc_garantee_date,'".$current_date."')<=7  AND (pc_garantee_end='')")->queryAll(); 


$paymentProjectData=Yii::app()->db->createCommand("SELECT pj_name as project,pc_code as contract, 'แจ้งเตือนครบกำหนดชำระเงินของ vendor' as alarm_detail,DATE_ADD( invoice_date, INTERVAL invoice_alarm
DAY ) as date_end, CONCAT('paymentProjectContract/update/',id) as url,'2' as type, id as update_id FROM payment_project_contract pay_p LEFT JOIN project_contract ON pay_p.proj_id=pc_id LEFT JOIN project ON pc_proj_id=pj_id  WHERE DATEDIFF(DATE_ADD( invoice_date, INTERVAL invoice_alarm
DAY ),'".$current_date."')<=7  AND (bill_date='' OR bill_date='0000-00-00')")->queryAll(); 

$paymentOutsourceData=Yii::app()->db->createCommand("SELECT pj_name as project,oc_code as contract, 'แจ้งเตือนครบกำหนดจ่ายเงินให้ supplier' as alarm_detail,DATE_ADD( invoice_receive_date, INTERVAL 10
DAY ) as date_end, CONCAT('paymentOutsourceContract/update',id) as url,'3' as type, id as update_id FROM payment_outsource_contract pay_p LEFT JOIN outsource_contract ON pay_p.contract_id=oc_id LEFT JOIN project ON oc_proj_id=pj_id WHERE DATEDIFF(invoice_receive_date,'".$current_date."')<10  AND (approve_date='' OR approve_date='0000-00-00')")->queryAll(); 

$records=array_merge($projectContractData , $paymentProjectData, $paymentOutsourceData);
//echo count($records);
$provAll = new CArrayDataProvider($records,
    array(
    	'keyField'=>false,  //don't have 'id' column
        'sort' => array( //optional and sortring
            'attributes' => array(
                'project', 
                'contract'
            ),
        ),
        'pagination' => array('pageSize' => 10) //optional add a pagination
    )
);


 $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'vendor-grid',
	'dataProvider'=>$provAll,
	'type'=>'bordered condensed',
	
	//'filter'=>$model,
	'selectableRows' =>2,
	'htmlOptions'=>array('style'=>'padding-top:40px'),
    'enablePagination' => true,
    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
    'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
	'columns'=>array(
		
		'proj'=>array(
			    'name' => 'project',
			    'header'=>$model->getAttributeLabel('project'),
			    //'filter'=>CHtml::activeTextField($model, 'v_name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("v_name"))),
				'headerHtmlOptions' => array('style' => 'width:30%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
	  	),
		'con'=>array(
			    'name' => 'contract',
			    'header'=>$model->getAttributeLabel('contract'),
			    //'filter'=>CHtml::activeTextField($model, 'v_name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("v_name"))),
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
	  	),	
	  	'details'=>array(
			    'name' => 'alarm_detail',
			    'header'=>$model->getAttributeLabel('detail'),
			    //'filter'=>CHtml::activeTextField($model, 'v_name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("v_name"))),
				'headerHtmlOptions' => array('style' => 'width:30%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
	  	),
	  	'end'=>array(
			    'name' => 'date_end',
			    'header'=>$model->getAttributeLabel('date_end'),
			    //'filter'=>CHtml::activeTextField($model, 'v_name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("v_name"))),
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	), 
	     array(
								'class'=>'bootstrap.widgets.TbButtonColumn',
								'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),
								'template' => '{update}',
								'buttons'=>array(
										'update' => array
					                    (
					                        
					                        'icon'=>'icon-pencil',
					                        'url'=>'Yii::app()->createUrl($data["url"])',
					                        'options'=>array(
					                            //'id'=>'$data["id"]',
					                            //'new_attribute'=> '$data["your_key"]',
					                        ),
					                    ),
								)
		)	
	),
)); ?>
