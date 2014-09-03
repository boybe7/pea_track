<?php
$this->breadcrumbs=array(
	'Treatment Records',
);

?>

<center>
    <h3>รายชื่อผู้เข้ารับบริการ</h3>
    <?php
    
    require_once('class_thaidate.php'); 
    $date = new Thaidate(date('Y-m-d : H:i:s'), 'F1');
    echo "<h4>ประจำ".$date->getDateTime()."</h4>";
      /*           echo '<div class="input-prepend"><span class="add-on">ประจำวันที่ </span>'; //ใส่ icon ลงไป
                    $this->widget('zii.widgets.jui.CJuiDatePicker',

                    array(
                        'name'=>'visit_date',
                        'attribute'=>'visit_date',
                        'model'=>$model,
                        'options' => array(
                                          'mode'=>'focus',
                                          //'language' => 'th',
                                          'format'=>'yyyy/mm/dd', //กำหนด date Format
                                          'showAnim' => 'slideDown',
                                          ),
                        'htmlOptions'=>array('class'=>'span2', 'value'=>$model->visit_date),  // ใส่ค่าเดิม ในเหตุการ Update 
                     )
                );
                echo '</div>';
    */
    ?>
</center>


<?php 
Yii::app()->clientScript->registerScript('search', "
$('#search-form form').submit(function(){
    //console.log($('#patient-grid input[name=firstname]','#patient-grid select[name=firstname]').val('x'));
   
    $.fn.yiiGridView.update('patient-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<?php 


$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'enableAjaxValidation'=>false,
    'type'=>'inline',
    'htmlOptions'=>  array('class'=>'well','style'=>'margin:0 auto;padding-top:20px;'),
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row-fluid">
     
       <div class="span3"> 
        <?php 
        
        echo $form->textFieldRow($model,'HN',array('class'=>'span12','maxlength'=>200,'labelOptions' => array('label' => false))); ?>
       </div>
       <div class="span3"> 
        <?php 
        
        echo $form->textFieldRow($model,'firstname',array('class'=>'span12','maxlength'=>200,'labelOptions' => array('label' => false))); ?>
       </div>
        <div class="span3"> 
        <?php 
        
        echo $form->textFieldRow($model,'lastname',array('class'=>'span12','maxlength'=>200,'labelOptions' => array('label' => false))); ?>
       </div>
        <div class="span3"> 
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
       
    </div>
    
<?php $this->endWidget(); ?>
<?php 


     $this->widget('bootstrap.widgets.TbGridView',array(
	'dataProvider'=>$model->searchPresentDoctorRecord(),
	'id'=>'patient-grid',
        'type'=>'bordered condensed',
         'filter'=>$model,
	 // 'template'=>"{summary}{items}{pager}",
        'htmlOptions'=>array('style'=>'padding-top:40px'),
        'enablePagination' => true,
        'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
        'emptyText'=>'<h4><font color=red>ไม่พบข้อมูล</font></h4>',
        'pagerCssClass' => 'pagination pagination-right',
        'enableSorting' => false,
	'columns'=>array(
		'HN'=>array(
	  	            	  		'header'=>'เลขที่ผู้ป่วย',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'HN',
	  	            	  		'value'=>'$data->HN',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),
                'firstname'=>array(
	  	            	  		'header'=>'ชื่อ',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'firstname',
	  	            	  		'value'=>'$data->Patient->firstname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),
                'lastname'=>array(
	  	            	  		'header'=>'นามสกุล',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'lastname',
	  	            	  		'value'=>'$data->Patient->lastname',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),
		'visit_time'=>array(
	  	            	  		'header'=>'เวลาที่มาติดต่อ',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'visit_time',
	  	            	  		'value'=>'$data->visit_time',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),
               
                 /*''=>array(
	  	            	  		'header'=>'',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> '',
                                                'type'=> 'raw',
	  	            	  		//'value'=>'CHtml::link("<i class=icon-list-alt></i>",array("update","id"=>$data->id))',
                                                'value'=>'CHtml::link("<i class=icon-list-alt></i>",array("update","id"=>$data->id))',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)
	  	            	  	),*/
                ''=> array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{save}',
                        'buttons'=>array
                        (
                            'save' => array
                            (
                                'label'=>'บันทึกการรักษา',
                                'icon'=>'list-alt white',
                                //'icon'=>false,
                                //'imageUrl'=>'http://example.com/update.png',
                                'type'=>'danger',
                                'url'=>'Yii::app()->createUrl("treatmentRecord/doctor", array("id"=>$data->id))',
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
