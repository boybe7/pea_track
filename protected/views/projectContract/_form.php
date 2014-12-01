<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/assets/7d883f12/bootstrap-datepicker/css/datepicker.css'); 
?>
<style type="text/css">
  .error {
    font-size: 14px;
  }
  .table-bordered th {
  	text-align: center;
  	vertical-align: middle;
  }
</style>
<fieldset class="well the-fieldset">
        <legend class="the-legend">สัญญาที่ <?php echo ($index);?></legend>
        
        <div class="row-fluid">
        	<div class="span3">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_code'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_code', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_code',array('class'=>'help-block error')); ?>
            </div>  
            <div class="span3">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_cost'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_cost', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_cost',array('class'=>'help-block error')); ?>
            </div>  
            <div class="span2">

               <?php 
                   
                    echo CHtml::activeLabelEx($model, '[' . $index . ']pc_sign_date'); 
                    echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'ProjectContract[' . $index . '][pc_sign_date]',
                            'id'=>$index.'pc_sign_date',
                            'model'=>$model,
                            'value'=>$model->pc_sign_date,
                            'options' => array(
                                              'mode'=>'focus',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span8'),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

               ?> 
            </div>
            <div class="span2">

               <?php 
                   
                    echo CHtml::activeLabelEx($model, '[' . $index . ']pc_end_date'); 
                    echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'ProjectContract[' . $index . '][pc_end_date]',
                            'id'=>$index.'pc_end_date',
                            'model'=>$model,
                            'value'=>$model->pc_end_date,
                            'options' => array(
                                              'mode'=>'focus',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span8'),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

               ?> 
            </div>
            <div class="span2">
            <?php
            		$this->widget('bootstrap.widgets.TbButton', array(
		              'buttonType'=>'link',
		              
		              'type'=>'danger',
		              'label'=>'ลบสัญญา',
		              'icon'=>'minus-sign',
		              
		              'htmlOptions'=>array(
		                'class'=>'pull-right',
		                'style'=>'margin:0px 10px 0px 10px;',
		                'onclick' => 'deleteContract(this, ' . $index . ')'
		              ),
		          ));

            ?>  
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span12">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_details'); ?>
              <?php echo CHtml::activeTextArea($model, '[' . $index . ']pc_details', array('rows'=>2, 'cols'=>50,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_details',array('class'=>'help-block error')); ?>
            </div>
        </div> 
        <div class="row-fluid">
        	<div class="span6">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_guarantee'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_guarantee', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_guarantee',array('class'=>'help-block error')); ?>
            </div>  
            <div class="span3">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_T_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_T_percent', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_T_percent',array('class'=>'help-block error')); ?>
            </div>
	  		<div class="span3">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_A_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_A_percent', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_A_percent',array('class'=>'help-block error')); ?>
            </div>
	  		
	  	</div>

	  	<fieldset class="well the-fieldset">
        	<legend class="the-legend">รายละเอียดการอนุมัติ</legend>
        	<div class="row-fluid"> 
	        <?php	
	  		$this->widget('bootstrap.widgets.TbButton', array(
	              'buttonType'=>'link',
	              
	              'type'=>'success',
	              'label'=>'เพิ่มการอนุมัติ',
	              'icon'=>'plus-sign',
	              
	              'htmlOptions'=>array(
	                'class'=>'pull-right',
	                'style'=>'margin:0px 10px 10px 10px;',
	                       
				     'onclick'=>'js:bootbox.confirm($("#modal-body2").html(),"ยกเลิก","ตกลง",
			                   			function(confirmed){
			                   	 	        
			                   	 			
                                			if(confirmed)
			                   	 		    {
			                   	 		    	console.log($(".modal-body #contract-approve-history-form").serialize());
			                   	 		    	var data = $(".modal-body #contract-approve-history-form").serializeArray();
			                   	 		    	console.log(data.length);

												var obj = {};
												for (var i = 0, l = data.length; i < l; i++) {
												    obj[data[i].name] = data[i].value;
												    console.log(data[i].name+":"+data[i].value);
												}
			                   	 		    	$.ajax({
													type: "POST",
													url: "",
													dataType:"json",
													data: $("#modal-body2 #contract-approve-history-form").serialize()
													})
													.done(function( msg ) {
														if(msg.status=="failure")
														{
															$("#modal-body2").html(msg.div);
															js:bootbox.confirm($("#modal-body2").html(),"ยกเลิก","ตกลง",
								                   			function(confirmed){
								                   	 	        
								                   	 			
					                                			if(confirmed)
								                   	 		    {
								                   	 		    	$.ajax({
																		type: "POST",
																		url: "../vendor/create",
																		dataType:"json",
																		data: $(".modal-body2 #contract-approve-history-form").serialize()
																		})
																		.done(function( msg ) {
																			if(msg.status=="failure")
																			{
																				js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
																			}
																			else{
																				js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
																			}
																		});
								                   	 		    }
															})
														}
														else{
															js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
														}
													});
			                   	 		    }
										})',
			                
	              ),
	          ));

	         ?>
	        </div>
        	<table class="table table-bordered">
        		<thead>
        			<th width="5%">ลำดับ </th>
        			<th width="35%">รายละเอียด</th>
        			<th width="15%">อนุมัติโดย/<br>วันที่อนุมัติ</th>        			
        			<th width="15%">วงเงิน/<br>เป็นเงินเพิ่ม</th>
        			<th width="25%">ระยะเวลาแล้วเสร็จ/<br>ระยะเลาขอขยาย</th>
        			<th width="5%">ลบ</th>
        		</thead>
        	</table>
		</fieldset>
        
       <?php   
          
          if(!$model->isNewRecord) 
          {
            $user = User::model()->findByPk($model->oc_user_create);  
            echo '<div class="pull-right"><b>แก้ไขล่าสุดโดย : '.$user->title.$user->firstname.'  '.$user->lastname.'</b>';
            echo '<br><b>วันที่ : '.$model->oc_last_update.'</b></div>';
          }

       ?>  
</fieldset>

<?php 

		$this->widget('application.extensions.moneymask.MMask',array(
                    'element'=>'#OutsourceContract_' . $index . '_oc_cost',
                    'currency'=>'บาท',
                    'config'=>array(
                        'symbolStay'=>true,
                        'thousands'=>',',
                        'decimal'=>'.',
                        'precision'=>2,
                    )
                ));
?> 

        
<?php
///Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('delOutsource', "
function deleteContract(elm, index)
{
	js:bootbox.confirm('คุณต้องการจะลบข้อมูล?','ยกเลิก','ตกลง',
		function(confirmed){
           	if(confirmed)
           	{	
					element=$(elm).parent().parent().parent();
				    /* animate div */
				    $(element).animate(
				    {
				        opacity: 0.25,
				        left: '+=50',
				        height: 'toggle'
				    }, 500,
				    function() {
				        /* remove div */
				        $(element).remove();
				    });
				    num = $('#num').val();
				    num--;
				    $('#num').val(num);
				    console.log('del num:'+$('#num').val());		                   	      
            }
    });

    
}", CClientScript::POS_END);
?>

<script type="text/javascript" src="/pea_track/assets/7d883f12/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
