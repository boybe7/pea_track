<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	
);


?>

<center><h3>เวชระเบียนผู้ป่วย</h3></center>

<?php 
Yii::app()->clientScript->registerScript('search', "
$('#search-form form').submit(function(){
    //console.log($('#patient-grid input[name=firstname]','#patient-grid select[name=firstname]').val('x'));
    console.log('ff');
    $.fn.yiiGridView.update('patient-grid', {
        data: $(this).serialize()
    });
    return false;
});
");


Yii::app()->clientScript->registerScript('Delete',"
$('.selected-button').click(function(){
        // get the ids
        var ids =  $.fn.yiiGridView.getSelection('patient-grid');
        if('' == ids)
        {
                alert('กรุณาเลือกผู้ป่วย');
                return false;
        }
        else
        {   
               // console.log(ids);
              
                 location.href = '".Yii::app()->createUrl('treatmentRecord/nurse')."/'+ids           
                
        }
        return false; // if you want to avoid default button action
});",CClientScript::POS_READY);

/*$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'success',
    'label'=>'เพิ่มข้อมูลผู้ป่วยใหม่',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right'),
)); 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'info',
    'label'=>'บันทึกอาการ',
    'icon'=>'ok',
   // 'url'=>array('update'),
    'htmlOptions'=>array('class'=>'pull-left selected-button'),
));*/ 
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'enableAjaxValidation'=>false,
    'type'=>'vertical',
    'htmlOptions'=>  array('class'=>'well','style'=>'margin:0 auto;padding-top:20px;'),
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row-fluid">
       <div class="span2"> 
         <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'link',
            'type'=>'info',
            'label'=>'บันทึกอาการ',
            'icon'=>'ok',
        // 'url'=>array('update'),
            'htmlOptions'=>array('class'=>'pull-left selected-button span12'),
        )); 
        ?>
       </div> 
       <div class="span3"> 
        <?php 
        
        echo "ชื่อ  ".$form->textFieldRow($model,'firstname',array('class'=>'span10','maxlength'=>200,'labelOptions' => array('label' => false))); ?>
       </div>
        <div class="span3"> 
        <?php 
        
        echo "นามสกุล  ".$form->textFieldRow($model,'lastname',array('class'=>'span8','maxlength'=>200,'labelOptions' => array('label' => false))); ?>
       </div>
        <div class="span2"> 
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'warning',
            'label'=>'ค้นหา',
            'icon'=>'search white',
        // 'url'=>array('update'),
            'htmlOptions'=>array('class'=>'search-button span12'),
        ));
        ?>
        </div>
        <div class="span2"> 
        <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'success',
    'label'=>'เพิ่มข้อมูลผู้ป่วยใหม่',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right  span12'),
)); 
 
        ?>
       </div>
    </div>
    
<?php $this->endWidget(); ?>

<?php

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'patient-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	 // 'template'=>"{summary}{items}{pager}",
        'htmlOptions'=>array('style'=>'padding-top:10px'),
        'enablePagination' => true,
        'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
         'emptyText' => '<h4><font color=red>ไม่พบข้อมูล</font></h4>',

        'pagerCssClass' => 'pagination pagination-right',
        'selectableRows'   => 1, // you can select only 1 row!!
       /* 'selectionChanged' => 'function(id){ var objectId = $.fn.yiiGridView.getSelection(id);
        if (isNaN(objectId) || objectId == ""){return;} location.href = "'.$this->createUrl('patient/update').
        '/"+$.fn.yiiGridView.getSelection(id);}',*/
	'columns'=>array(
		'HN'=>array(
		  
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'HN',
	  	            	  		'value'=>'$data->HN',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),
		'title'=>array(
		  
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'title',
	  	            	  		'value'=>'$data->title',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:100px'

	  	            	  		)
	  	            	  	),
		'firstname'=>array(
		  
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'firstname',
	  	            	  		'value'=>'$data->firstname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),
		'lastname'=>array(
		  
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'lastname',
	  	            	  		'value'=>'$data->lastname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),
		//'birthdate',
		//'sex',
		
		/*'id_no'=>array(
		  
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'id_no',
	  	            	  		'value'=>'$data->id_no',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),*/
		//'phone',
		/*'emergency_phone'=>array(
		  
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'emergency_phone',
	  	            	  		'value'=>'$data->emergency_phone',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),*/
		//'allergy',
		//'address',
		//'sub_district',
		//'district',
		//'province',
		//'drug_typeID',
		'drug_typeID'=>array(
	  	            	  		
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'drug_typeID',
	  	            	  		'value'=>'$data->DrugType->name',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		),
                                                'filter' => CHtml::listData(DrugType::model()->findAll(),'id','name'),
	  	            	  	),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
