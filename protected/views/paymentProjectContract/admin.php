<?php
$this->breadcrumbs=array(
	'รายการรับเงินงวดของโครงการ'=>array('index'),
	
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('payment-project-contract-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<script type="text/javascript">
  
  $(function(){
      

      $( "input[name*='pj_vendor_id']" ).autocomplete({
       
                minLength: 0
      }).bind('focus', function () {
             //console.log("focus");
                $(this).val('');
                $(this).autocomplete("search");
                //
      });
  });
</script> 


<h1>รายการรับเงินงวดของโครงการ</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'enableAjaxValidation'=>false,
    'type'=>'vertical',
    'htmlOptions'=>  array('class'=>'well','style'=>'margin:0 auto;padding-top:20px;'),
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row-fluid">
        
       <div class="span4"> 
        <?php 
        	
        			echo CHtml::activeLabelEx($model, 'proj_id'); 

        			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'pj_vendor_id',
                            'id'=>'pj_vendor_id',
                            //'value'=>$model->pj_name,
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('ProjectContract/GetProjectContract').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                           $("#pj_cost").val(ui.item.cost);
                                            
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
						

        //echo "สัญญาโครงการ ".$form->textFieldRow($model,'firstname',array('class'=>'span10','maxlength'=>200,'labelOptions' => array('label' => false))); ?>
       </div>
        <div class="span3"> 
        <?php 
        echo CHtml::label('วงเงินตามสัญญา','pj_cost');        
        echo "<input type='text' id='pj_cost' disabled>"?>
       </div>
        <div class="span5"> 
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'inverse',
            'label'=>'ค้นหา',
            'icon'=>'search white',
        // 'url'=>array('update'),
            'htmlOptions'=>array('class'=>'search-button','style'=>'margin:20px 10px 0px 10px;'),
        ));
         
			$this->widget('bootstrap.widgets.TbButton', array(
			    'buttonType'=>'link',
			    
			    'type'=>'success',
			    'label'=>'เพิ่มรายการ',
			    'icon'=>'plus-sign',
			    'url'=>array('create'),
			    'htmlOptions'=>array('class'=>'','style'=>'margin:20px 10px 0px 10px;'),
			)); 

			$this->widget('bootstrap.widgets.TbButton', array(
			    'buttonType'=>'link',
			    
			    'type'=>'danger',
			    'label'=>'ลบรายการ',
			    'icon'=>'minus-sign',
			    //'url'=>array('delAll'),
			    //'htmlOptions'=>array('id'=>"buttonDel2",'class'=>'pull-right'),
			    'htmlOptions'=>array(
			        //'data-toggle'=>'modal',
			        //'data-target'=>'#myModal',
			        'onclick'=>'      
			                       //console.log($.fn.yiiGridView.getSelection("vendor-grid").length);
			                       if($.fn.yiiGridView.getSelection("vendor-grid").length==0)
			                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการลบ?","ตกลง");
			                       else  
			                          js:bootbox.confirm("คุณต้องการจะลบข้อมูล?","ยกเลิก","ตกลง",
						                   function(confirmed){
						                   	 	
						                   	 //console.log("Confirmed: "+confirmed);
						                   	 //console.log($.fn.yiiGridView.getSelection("user-grid"));
			                                if(confirmed)
						                   	 $.ajax({
													type: "POST",
													url: "deleteSelected",
													data: { selectedID: $.fn.yiiGridView.getSelection("vendor-grid")}
													})
													.done(function( msg ) {
														$("#vendor-grid").yiiGridView("update",{});
													});
						                  })',
			        'class'=>'',
			        'style'=>'margin:20px 10px 0px 10px',
			    ),
			)); 
 
        ?>
       </div>
    </div>
    
<?php $this->endWidget(); ?>



<?php 


 $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'payment-project-contract-grid',
	'type'=>'bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' =>2,
	'htmlOptions'=>array('style'=>'padding-top:40px;width:100%'),
    'enablePagination' => true,
    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
    'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
	'columns'=>array(
		'checkbox'=> array(
        	    'id'=>'selectedID',
            	'class'=>'CCheckBoxColumn',
            	//'selectableRows' => 2, 
        		 'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
	  	         'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)   	  		
        ),
		'proj_id'=>array(
			    'name' =>'proj_id',
			    'value' => 'Vendor::model()->FindByPk((ProjectContract::model()->FindByPk($data->proj_id)->pj_vendor_id)',
			    'filter'=>CHtml::activeTextField($model, 'proj_id',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("proj_id"))),
				'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;')
	  	),
		//'v_address',
		'detail'=>array(
			    'name' => 'detail',
			    'headerHtmlOptions' => array('style' => 'width:25%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
		'money'=>array(
			    'name' => 'money',
			    //'filter'=>CHtml::activeTextField($model, 'pj_fiscalyear',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("pj_fiscalyear"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
	  	'invoice_no/date'=>array(
			    'header' => '<a class="sort-link">เลขที่ใบแจ้งหนี้/วันที่ได้รับ</a>',
			    //'name'=>'cost',
			    'headerHtmlOptions'=>array(),
			    'type'=> 'raw',
			    'value' => '$data->invoice_no<br>$data->invoice_date',
			    //'filter'=>CHtml::activeTextField($model, 'sumcost',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("pj_fiscalyear"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
	  	'bill_no/date'=>array(
			    'header' => '<a class="sort-link">เลขที่ใบเสร็จรับเงิน/วันที่ได้รับ</a>',
			    //'name'=>'cost',
			    'headerHtmlOptions'=>array(),
			    'type'=> 'raw',
			    'value' => '$data->bill_no<br>$data->bill_date',
			    //'filter'=>CHtml::activeTextField($model, 'sumcost',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("pj_fiscalyear"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
		// 'v_contractor'=>array(
		// 	    'name' => 'v_contractor',
		// 	    'filter'=>CHtml::activeTextField($model, 'v_contractor',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("v_contractor"))),
		// 		'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
		// 		'htmlOptions'=>array('style'=>'text-align:center')
	 //  	),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
			'template' => '{view}  {update}'
		),
	),
));



 ?>
