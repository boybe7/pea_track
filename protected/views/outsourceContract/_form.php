

<fieldset class="well the-fieldset">
        <legend class="the-legend">สัญญาที่ <?php echo ($index+1);?></legend>
        
        <div class="row-fluid">
        	  <div class="span4">		  
        	    <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_code'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_code', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_code'); ?>
            </div>  
            <div class="span7">
        		  <?php
                    echo CHtml::activeHiddenField($model, '[' . $index . ']oc_vendor_id'); 
                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_vendor_id'); 
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'[' . $index . ']oc_vendor_id',
                            'id'=>$index.'oc_vendor_id',
                            'value'=>$model->oc_vendor_id,
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
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                           $("#OutsourceContract_'. $index . '_oc_vendor_id").val(ui.item.id);
                                           //console.log($("#OutsourceContract_'. $index . '_oc_vendor_id").val());
                                     }'
                                    
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));

               ?>
            </div>
            <div class="span1">
                <?php 
                    
                   $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'link',
                        
                        'type'=>'danger',
                        'label'=>'',
                        'icon'=>'icon-remove icon-white',
                        
                        'htmlOptions'=>array(
                          'class'=>'pull-right',
                          'style'=>'margin:0px 10px 0px 10px;',
                          'onclick'=>'deleteChild(this, ' . $index . '); return false;'
                        ),
                    ));  

                  //echo CHtml::link('<i class="icon-red icon-remove"></i>', '#', array('onclick' => 'deleteChild(this, ' . $index . '); return false;'));
               ?>
            </div>
        </div>

        <div class="row-fluid">
          <div class="span4">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_cost'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_cost', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_cost'); ?>          
          </div>  
          <div class="span7">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_detail'); ?>
              <?php echo CHtml::activeTextArea($model, '[' . $index . ']oc_detail', array('rows' => 2, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_detail'); ?>          
          </div> 
        </div>
        <div class="row-fluid">
          <div class="span4">

               <?php 

                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_sign_date'); 
                    echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'[' . $index . ']oc_sign_date',
                            'id'=>$index.'oc_sign_date',
                            'model'=>$model,
                            'options' => array(
                                              'mode'=>'focus',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span12', 'value'=>$model->oc_sign_date),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

               ?> 
          </div> 
          <div class="span4">

               <?php 

                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_end_date'); 
                    echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'[' . $index . ']oc_end_date',
                            'id'=>$index.'oc_end_date',
                            'model'=>$model,
                            'options' => array(
                                              'mode'=>'focus',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span12', 'value'=>$model->oc_end_date),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

               ?> 
          </div> 
          <div class="span4">

               <?php 

                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_approve_date'); 
                    echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'[' . $index . ']oc_approve_date',
                            'id'=>$index.'oc_approve_date',
                            'model'=>$model,
                            'options' => array(
                                              'mode'=>'focus',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span12', 'value'=>$model->oc_approve_date),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

               ?> 
          </div> 
        </div>
        <div class="row-fluid">
          <div class="span4">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_guarantee'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_guarantee', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_guarantee'); ?>          
          </div>  
          <div class="span4">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_adv_guarantee'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_adv_guarantee', array( 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_adv_guarantee'); ?>          
          </div> 
          <div class="span3">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_T_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_T_percent', array( 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_T_percent'); ?>          
          </div> 
        </div>

        <div class="row-fluid">
          <div class="span4">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_insurance'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_insurance', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_insurance'); ?>          
          </div>  
          <div class="span4">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_letter'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_letter', array( 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_letter'); ?>          
          </div> 
          <div class="span3">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_A_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_A_percent', array( 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_A_percent'); ?>          
          </div> 
        </div>
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

        
<script type="text/javascript">
  
  $(function(){
      

      $( "input[name*='oc_vendor_id']" ).autocomplete({
       
                minLength: 0
      }).bind('focus', function () {
                $(this).autocomplete("search");
      });       
  });
 </script> 

<?php
Yii::app()->clientScript->registerScript('deleteChild', "
function deleteChild(elm, index)
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
}", CClientScript::POS_END);


?>