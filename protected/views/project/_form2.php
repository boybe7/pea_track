
<script type="text/javascript">
	$('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
    
    $('a[data-toggle="tab"]').on('shown', function (e) {
    	e.target // activated tab
    	e.relatedTarget // previous tab
    })
    function addWorkCode(){
  
         
         $('#tgrid').find('tbody').append('<tr id='+$("#work_code").val()+'><td width="90%">'+
                 $("#work_code").val()+
                 '</td><td style="text-align:center;width:10%;"><a href="#" onclick=deleteRow("'+$("#work_code").val()+'")><i class="icon-red icon-remove"></i></a></td></tr>');
        
         id=0;
         var code = '';
         $('#tgrid tbody tr td').each(function(key, value) {
            
                   //console.log($(this).text())
                   code += $(this).text()+",";
                    
                   
               // console.log(key+":"+$(this).text())
         });
         $("#workCode").val(code.substring(0,code.length-1));
         
    }
    function deleteRow(id){
     
         $("#tgrid tr[id='"+id+"']").remove();
         id=0;
         var code = '';
         $('#tgrid tbody tr td').each(function(key, value) {
              
                   console.log($(this).text())
                   code += $(this).text()+",";
                     
                  
                console.log(key+":"+$(this).text())
         });
         $("#workCode").val(code.substring(0,code.length-1));
    }
</script>
	<!-- <p class="help-block">Fields with <span class="required">*</span> are required.</p> -->
<div class="well">
	<ul class="nav nav-tabs">
        <li class="active"><a href="#projTab" data-toggle="tab">โครงการ</a></li>
         <li><a href="#outTab" data-toggle="tab">สัญญาจ้างต่อ</a></li>
    </ul>
         
    <div class="tab-content">
      <div class="tab-pane active" id="projTab">  
      	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'project-form',
			'enableAjaxValidation'=>true,
			'type'=>'vertical',
  			'htmlOptions'=>  array('class'=>'','style'=>''),
		)); ?>
    	

		
    	<div style="text-align:left"><?php echo $form->errorSummary(array($model,$modelContract));?></div>
		
		<div class="row-fluid">
			<div class="well span8">
      			
      				<!-- <span style='display: block;margin-bottom: 5px;'>คู่สัญญา</span>  -->
      				
				<div class="row-fluid">
					<div class="span4">
      					<?php echo $form->textFieldRow($model,'pj_fiscalyear',array('class'=>'span12','maxlength'=>4)); ?>
    				</div>
    				<div class="span8">
      					<?php echo $form->labelEx($model,'pj_date_approved',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
    					
    					<?php 

      			 
		                echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'pj_date_approved',
		                        'attribute'=>'pj_date_approved',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->pj_date_approved),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      			 ?>
		      		</div>
		      		
		    		<?php 
      				//echo $form->textFieldRow($model,'pj_work_cat',array('class'=>'span12')); 
      				$workcat = Yii::app()->db->createCommand()
                    ->select('wc_id,wc_name as name')
                    ->from('work_category')
                    ->queryAll();
     
             		$typelist = CHtml::listData($workcat,'wc_id','name');
             		echo $form->dropDownListRow($model, 'pj_work_cat', $typelist,array('class'=>'span12'), array('options' => array('pj_work_cat'=>array('selected'=>true)))); 
             

      				?>
      				<!-- <input type="hidden" name="vendor_id" id="vendor_id"> -->
      				<?php 
  						echo $form->hiddenField($model,'pj_vendor_id');
  						echo $form->labelEx($model,'pj_vendor_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
    					 
  						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'pj_vendor_id',
                            'id'=>'pj_vendor_id',
                            'value'=>$model->pj_name,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Vendor/GetVendor').'",
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
                                     'minLength'=>'0',
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#Project_pj_vendor_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span10'
                            ),
                                  
                        ));
						
						$this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'เพิ่มคู่สัญญา',
						    'icon'=>'plus-sign',
						    //'url'=>array('vendor/create'),
						    'htmlOptions'=>array(
						        //'data-toggle'=>'modal',
						        //'data-target'=>'#myModal',
						        'onclick'=>'js:bootbox.confirm($("#modal-body").html(),"ยกเลิก","ตกลง",
			                   			function(confirmed){
			                   	 	        
			                   	 			
                                			if(confirmed)
			                   	 		    {
			                   	 		    	$.ajax({
													type: "POST",
													url: "../vendor/create",
													dataType:"json",
													data: $(".modal-body #vendor-form").serialize()
													})
													.done(function( msg ) {
														if(msg.status=="failure")
														{
															$("#modal-body").html(msg.div);
															js:bootbox.confirm($("#modal-body").html(),"ยกเลิก","ตกลง",
								                   			function(confirmed){
								                   	 	        
								                   	 			
					                                			if(confirmed)
								                   	 		    {
								                   	 		    	$.ajax({
																		type: "POST",
																		url: "../vendor/create",
																		dataType:"json",
																		data: $(".modal-body #vendor-form").serialize()
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
			                  
						        'class'=>'pull-right'
						    ),
						));
						
				?>
    			</div>
    		</div>	
			<div class="well span4">
      			<?php 
      			//echo $form->textFieldRow($model,'pj_code',array('class'=>'span10','maxlength'=>100)); 
      			echo "<span style='display: block;'>หมายเลขงาน</span>"; 
               echo CHtml::textField('work_code','',array('class'=>'span10'));

      			$this->widget('bootstrap.widgets.TbButton', array(
						    'buttonType'=>'link',
						    
						    'type'=>'success',
						    'label'=>'',
						    'icon'=>'plus-sign white',
						    //'url'=>array('vendor/create'),
						    'htmlOptions'=>array('class'=>'pull-right','onclick'=>'addWorkCode()')
						    ));	
      			?>
      			<table class="table" style="background-color: white" name="tgrid" id="tgrid" width="100%" cellpadding="0" cellspacing="0">                    
	                <tbody>
                            <?php
                                    $workCode = Yii::app()->db->createCommand()
                                                ->select('code,id')
                                                ->from('work_code')
                                                ->where('pj_id=:id', array(':id'=>$model->pj_id))
                                                ->queryAll();
                                    if(!empty($workCode))
                                    {    
                                       echo "<tr id='".$model->pj_id."'><td>".$workCode->code."</td><td style='text-align:center'><a href='#' onclick=deleteRow('".$workCode->id."')><i class='icon-remove'></i></a></td></tr>";
                        
                                    }
                               
                            ?>
                            <input type="hidden" name="workCode" id="workCode">
                        </tbody>
                        
            </table>
    		</div>
    		
    		
  		</div>
  		
  		

   		<div class="well">
	  		<div class="row-fluid">
	  			<div class="span6">
	  			    <?php echo $form->textFieldRow($modelContract,'pc_code',array('class'=>'span12','maxlength'=>4)); ?>

	  			</div>
	  			<div class="span6">
					
	  			</div>
	  		</div>
		</div>
 			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
				)); ?>
			</div>
						
		</div>
        <?php $this->endWidget(); ?>
		<div class="tab-pane" id="outTab">
		</div>
	</div>		
</div>	

<div id="modal-content" class="hide">
    <div id="modal-body">
<!-- put whatever you want to show up on bootbox here -->
    	<?php 
    	//$model = Vendor::model()->findByPk(14);
    	$model2=new Vendor;
    	$this->renderPartial('/vendor/_form2',array('model'=>$model2),false); 

    	?>
    </div>

    <div id="modal-body-contract">
<!-- put whatever you want to show up on bootbox here -->
    	<?php 
    	//$model = Vendor::model()->findByPk(14);
    	//$modelContract = new Vendor;
    	//$this->renderPartial('/vendor/_form2',array('model'=>$model2)); 

    	?>
    </div>
</div>