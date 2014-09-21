
<script type="text/javascript">
	$('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
    
    $('a[data-toggle="tab"]').on('shown', function (e) {
    	e.target // activated tab
    	e.relatedTarget // previous tab
    })

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
			'enableAjaxValidation'=>false,
			'type'=>'horizontal',
  			'htmlOptions'=>  array('class'=>'','style'=>''),
		)); ?>
    	

		
    	<div style="text-align:left"><?php echo $form->errorSummary($model); ?></div>
		<div class="well">
		<div class="row-fluid">
			<div class="offset8 span4">
      			<?php echo $form->textFieldRow($model,'pj_fiscalyear',array('class'=>'span12','maxlength'=>4)); ?>
    		</div>
    	
  		</div>
  		
		<div class="row-fluid">
    		<div class="span4">
      			<?php echo $form->textFieldRow($model,'pj_code',array('class'=>'span12','maxlength'=>100)); ?>
    		</div>
    		<div class="span8">
      			<?php echo $form->textFieldRow($model,'pj_details',array('class'=>'span12','maxlength'=>500)); ?>
    		</div>
  		</div>
  		<div class="row-fluid">
    		<div class="span4">
    			<div class="row-fluid">
    				<div class="span6">
    					<?php echo $form->labelEx($model,'pj_date_approved',array('class'=>'span12','style'=>'text-align:right;padding-right:10px;'));?>
    				</div>
    				<div class="span6">
    					<?php 

      			 
		                echo '<div class="input-append">'; //ใส่ icon ลงไป
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
		                        'htmlOptions'=>array('class'=>'span10', 'value'=>$model->pj_date_approved),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      			 ?>
    				</div>	
      			</div>
    		</div>
    		<div class="span8">
      			<?php 
      			//echo $form->textFieldRow($model,'pj_work_cat',array('class'=>'span12')); 
      			$workcat = Yii::app()->db->createCommand()
                    ->select('wc_id,wc_name as name')
                    ->from('work_category')
                    ->queryAll();
     
             	$typelist = CHtml::listData($workcat,'wc_id','name');
             	echo $form->dropDownListRow($model, 'pj_work_cat', $typelist,array('class'=>'span12'), array('options' => array('pj_work_cat'=>array('selected'=>true)))); 
             

      			?>
    		</div>
  		</div>
  		</div>

  		<div class="well">
  		<div class="row-fluid">
  			<div class="span6">
  				<?php 
  						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'pj_vendor_id',
                            'id'=>'pj_vendor_id',
                       
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
                                        
                                        
                                        $.ajax({
                                            url: "'.$this->createUrl('Ajax/getUnit').'",
                                            type: "POST",
                                            
                                            data: {
                                                drug_id: ui.item.value
                                            },
                                            success: function (data) {
                                                data = data.split(":");
                                                $("#unit").val(data[0]);
                                                $("#drug_code").val(data[1]);
                                                 $("#drug_name").val(ui.item.value)
                                            }
                                        
                                        })
                                        
                                           
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
				?>
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

