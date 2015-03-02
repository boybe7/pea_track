<?php
$this->breadcrumbs=array(
	'Management Costs'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('management-cost-grid', {
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

<h1>รายการค่าบริหารโครงการ</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'enableAjaxValidation'=>false,
    'type'=>'vertical',
    'htmlOptions'=>  array('class'=>'well','style'=>'margin:0 auto;padding-top:20px;'),
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row-fluid">
        
       <div class="span6"> 
        <?php 
        	
        			$pname = '';
        			if(isset($_GET["pname"]))
        				$pname = $_GET["pname"];
        			echo "<input type='hidden' id='pname' name='pname' value='$pname'>";

        			
        			$cost = isset($_GET["cost"])?$_GET["cost"]:'';
        			echo "<input type='hidden' id='cost' name='cost' value='$cost'>";
	
        			echo CHtml::activeHiddenField($model, 'mc_proj_id'); 
        			echo CHtml::activeLabelEx($model, 'mc_proj_id'); 

        			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'pj_vendor_id',
                            'id'=>'pj_vendor_id',
                            'value'=>$pname,
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Project/GetProject').'",
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
                                        
                                           $("#pname").val(ui.item.label);
                                           $("#pid").val(ui.item.id);
                                           $("#pj_cost").val(ui.item.cost);
                                           $("#cost").val(ui.item.cost);
                                           $("#PaymentProjectContract_proj_id").val(ui.item.id);
                                           $("#search-form").submit();

                                            
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12',
                                'placeholder'=>"เลือกโครงการ"
                            ),
                                  
                        ));
						

         ?>
       </div>
        <div class="span3"> 
        <?php 
        echo CHtml::label('วงเงินตามสัญญา','pj_cost');
        $cost = isset($_GET["cost"])?$_GET["cost"]:'';       

        echo "<input type='text' class='span12' id='pj_cost' style='text-align:right' name='pj_cost' value='$cost' disabled>"?>
       </div>
        <div class="span3"> 
        <?php 
        echo CHtml::label('คงเหลือจ่ายเงิน','rm_cost');

        $rm_cost = "";
        $pid = isset($_GET["pid"])?$_GET["pid"]:'';
         echo "<input type='hidden' id='pid' name='pid' value='$pid'>";

        if($pid !="")
        {
        	$pc = Yii::app()->db->createCommand()
                        ->select('SUM(money) as sum')
                        ->from('payment_project_contract')
                        ->join('project_contract pc', 'proj_id = pc_id')
                        ->where('pc_proj_id=:id', array(':id'=>$pid))
                        ->queryAll();
            //echo ($pc[0]["sum"]);

            $cost = str_replace(",", "", $cost);
            $diff = $cost - $pc[0]["sum"]; 
            $rm_cost = number_format($diff,2);
                       
        }    

        echo "<input type='text' class='span12' id='rm_cost' style='text-align:right' name='rm_cost' value='$rm_cost' disabled>";?>
       </div>
        
    </div>
    
<?php $this->endWidget(); ?>



<?php 


			$this->widget('bootstrap.widgets.TbButton', array(
			    'buttonType'=>'link',
			    
			    'type'=>'success',
			    'label'=>'เพิ่มรายการ',
			    'icon'=>'plus-sign',
			    'url'=>array('create'),
			    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:24px 10px 0px 10px;'),
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
			                       if($.fn.yiiGridView.getSelection("payment-project-contract-grid").length==0)
			                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการลบ?","ตกลง");
			                       else  
			                          js:bootbox.confirm("คุณต้องการจะลบข้อมูล?","ยกเลิก","ตกลง",
						                   function(confirmed){
						                   	 
			                                if(confirmed)
						                   	 $.ajax({
													type: "POST",
													url: "deleteSelected",
													data: { selectedID: $.fn.yiiGridView.getSelection("payment-project-contract-grid")}
													})
													.done(function( msg ) {
														$("#payment-project-contract-grid").yiiGridView("update",{});
													});
						                  })',
			        'class'=>'pull-right',
			        'style'=>'margin:24px 10px 20px 10px',
			    ),
			)); 

 $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'payment-project-contract-grid',
	'type'=>'bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' =>2,
	'htmlOptions'=>array('style'=>'padding-top:40px;width:100%'),
    'enablePagination' => true,
    'enableSorting'=>true,
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
	
		'detail'=>array(
			    'name' => 'mc_detail',
			    'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left')
	  	),
		'money'=>array(
			    'name' => 'mc_cost',
          'value'=>'number_format($data->mc_cost,2)',
			    //'filter'=>CHtml::activeTextField($model, 'pj_fiscalyear',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("pj_fiscalyear"))),
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:right')
	  	),
		'type'=>array(
			    'name' => 'mc_type',
			    'filter'=>CHtml::activeDropDownList($model,'mc_type',array(0=>'ประมาณการ',1=>'ค่ารับรอง',2=>'ใช้จริง')),
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:right')
	  	),
	  	'date'=>array(
			    //'header' => '<a class="sort-link">เลขที่ใบแจ้งหนี้/วันที่ได้รับ</a>',
			    //'header'=>$model->getAttributeLabel('invoice_no/date'),
			    'name'=>'mc_date',
			    'headerHtmlOptions'=>array(),
			    //'type'=> 'raw',
			    //'value' => '$data->invoice_no."<br>".$data->invoice_date',
			    //'filter'=>CHtml::activeTextField($model, 'sumcost',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("pj_fiscalyear"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
		array(
			'header' => '<a class="sort-link">ดู/แก้ไข</a>',
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
			'template' => '{update}'
		),
	),
));



 ?>