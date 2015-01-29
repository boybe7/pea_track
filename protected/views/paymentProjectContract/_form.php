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

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'payment-project-contract-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="well">
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	 <div class="row-fluid">       
       <div class="span8"> 
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
						

         ?>
       </div>
        <div class="span4"> 
	        <?php 
	        echo CHtml::label('วงเงินตามสัญญา','pj_cost');        
	        echo "<input type='text' id='pj_cost' class='span10' disabled>"?>
       </div>
    </div>   

	<div class="row-fluid">       
       <div class="span8">
          <?php echo $form->textAreaRow($model,'detail',array('rows'=>2, 'cols'=>50, 'class'=>'span12')); ?> 
       </div>
       <div class="span4"> 
          <?php echo $form->textFieldRow($model,'money',array('class'=>'span10')); ?>
       </div>
    </div>   
	
    <div class="row-fluid">       
       <div class="span8">
          <?php echo $form->textFieldRow($model,'invoice_no',array('class'=>'span12','maxlength'=>200)); ?>
       </div>
       <div class="span4"> 
          <?php echo $form->labelEx($model,'invoice_date',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
    					
          <?php 

      			 
		                echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'invoice_date',
		                        'attribute'=>'invoice_date',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->invoice_date),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		     ?>
       </div>
    </div>   
	
	<div class="row-fluid">       
       <div class="span8">
          <?php echo $form->textFieldRow($model,'bill_no',array('class'=>'span12','maxlength'=>200)); ?>
       </div>
       <div class="span4"> 
          <?php echo $form->labelEx($model,'bill_date',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
    					
          <?php 

      			 
		                echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'bill_date',
		                        'attribute'=>'bill_date',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->bill_date),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		     ?>
       </div>
    </div>  

    <div class="row-fluid">       
       <div class="span3">
          <?php
            echo CHtml::label('%ความก้าวหน้าด้านเทคนิค','t_percent');        
	        echo "<input type='text' id='t_percent' name='t_percent' class='span12' >";
	      ?> 
       </div>
       <div class="span3"> 
          <?php
            echo CHtml::label('%ความก้าวหน้าการเรียกเก็บเงิน','a_percent');        
	        echo "<input type='text' id='a_percent' name='a_percent' class='span12' >";
	      ?> 
       </div>
    </div>   
	


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'บันทึก' : 'บันทึก',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
</div>