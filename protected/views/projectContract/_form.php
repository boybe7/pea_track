<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/assets/7d883f12/bootstrap-datepicker/css/datepicker.css'); 
?>
<style type="text/css">
  .error {
    font-size: 14px;
  }

</style>
<fieldset class="well the-fieldset">
        <legend class="the-legend">สัญญาที่ <?php echo ($index);?></legend>
        
        <div class="row-fluid">
        	  <div class="span3">		  
        	    <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_code'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_code', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_code',array('class'=>'help-block error')); ?>
            </div>  
            <div class="span7">
        		  <?php
                    echo CHtml::activeHiddenField($model, '[' . $index . ']oc_vendor_id'); 
                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_vendor_id'); 

                    $vendor = Yii::app()->db->createCommand()
                        ->select('v_name')
                        ->from('vendor')
                        ->where('v_id=:id', array(':id'=>$model->oc_vendor_id))
                        ->queryAll();
                    //print_r($model->hasErrors('oc_vendor_id'));  
                    //if($model->hasErrors('oc_vendor_id')) echo "error";  

                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'[' . $index . ']oc_vendor_id',
                            'id'=>$index.'oc_vendor_id',
                            'value'=> empty($vendor[0])? '' : $vendor[0]['v_name'],
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

                                'class'=>$model->hasErrors('oc_vendor_id')?'span12 error':'span12'
                            ),
                                  
                        ));

                         echo CHtml::error($model, '[' . $index . ']oc_vendor_id',array('class'=>'help-block error'));
               ?>
            </div>
            <div class="span2">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_cost'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_cost', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_cost',array('class'=>'help-block error')); ?>          
          </div>  
        </div>

        <div class="row-fluid">
            <div class="span3">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_PO'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_PO', array('size' => 200, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_PO',array('class'=>'help-block error')); ?>
            </div>
            <div class="span7">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_detail'); ?>
              <?php echo CHtml::activeTextArea($model, '[' . $index . ']oc_detail', array('rows' => 2, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_detail',array('class'=>'help-block error')); ?>          
            </div>
            <div class="span2">

               <?php 
                   
                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_sign_date'); 
                    echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'OutsourceContract[' . $index . '][oc_sign_date]',
                            'id'=>$index.'oc_sign_date',
                            'model'=>$model,
                            'value'=>$model->oc_sign_date,
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
        </div>    
        
        <div class="row-fluid">
          <div class="span5">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_guarantee'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_guarantee', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_guarantee',array('class'=>'help-block error')); ?>          
          </div>  
          <div class="span5">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_adv_guarantee'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_adv_guarantee', array( 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_adv_guarantee',array('class'=>'help-block error')); ?>          
          </div>
          <div class="span2">

               <?php 
                   
                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_end_date'); 
                    echo '<div class="input-append" style="">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'OutsourceContract[' . $index . '][oc_end_date]',
                            'id'=>$index.'oc_end_date',
                            'model'=>$model,
                            'value'=>$model->oc_end_date,
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
                    echo CHtml::error($model, '[' . $index . ']oc_end_date',array('class'=>'help-block error'));

               ?> 
          </div> 
           
        </div>
        <div class="row-fluid">
          <div class="span5">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_guarantee_cf'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_guarantee_cf', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_guarantee_cf',array('class'=>'help-block error')); ?>          
          </div>  
          <div class="span5">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_adv_guarantee_cf'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_adv_guarantee_cf', array( 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_adv_guarantee_cf',array('class'=>'help-block error')); ?>          
          </div> 
          <div class="span2">

               <?php 

                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_approve_date'); 
                    echo '<div class="input-append" style="margin-top:0px;margin-left:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'OutsourceContract[' . $index . '][oc_approve_date]',
                            'id'=>$index.'oc_approve_date',
                            'model'=>$model,
                            'value'=>$model->oc_approve_date,
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
        </div>
        <div class="row-fluid">
          <div class="span5">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_insurance'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_insurance', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_insurance',array('class'=>'help-block error')); ?>          
          </div>  
          <div class="span5">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_letter'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_letter', array( 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_letter',array('class'=>'help-block error')); ?>          
          </div> 
        </div>
        <div class="row-fluid">
          <div class="span2">

               <?php 

                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_insurance_start'); 
                    echo '<div class="input-append" style="margin-top:0px;margin-left:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'OutsourceContract[' . $index . '][oc_insurance_start]',
                            'id'=>$index.'oc_insurance_start',
                            'model'=>$model,
                            'value'=>$model->oc_insurance_start,
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

                    echo CHtml::activeLabelEx($model, '[' . $index . ']oc_insurance_end'); 
                    echo '<div class="input-append" style="margin-top:0px;margin-left:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'OutsourceContract[' . $index . '][oc_insurance_end]',
                            'id'=>$index.'oc_insurance_end',
                            'model'=>$model,
                            'value'=>$model->oc_insurance_end,
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
          <div class="span2  offset1">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_T_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_T_percent', array( 'maxlength' => 3,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_T_percent',array('class'=>'help-block error')); ?>          
          </div> 
          <div class="span2">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_A_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_A_percent', array( 'maxlength' => 3,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_A_percent',array('class'=>'help-block error')); ?>          
          </div> 
           
           
           
        </div>
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

        
<script type="text/javascript">
  
  $(function(){
      

      $( "input[name*='oc_vendor_id']" ).autocomplete({
       
                minLength: 0
      }).bind('focus', function () {
                $(this).autocomplete("search");
      });       
  });
 </script> 

<script type="text/javascript" src="/pea_track/assets/7d883f12/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
