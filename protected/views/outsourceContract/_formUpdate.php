<?php
    //     $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    //   'id'=>$index.'_outsource-form',
    //   'enableAjaxValidation'=>false,
    //   'type'=>'vertical',
    //     'htmlOptions'=>  array('class'=>'','style'=>''),
    // ));

     ?>
<style type="text/css">
  .error {
    font-size: 14px;
  }
  .tr_white {
      background-color: white;
   }
</style>
<fieldset class="well the-fieldset">
        <legend class="the-legend contract_no_oc">สัญญาที่ <?php echo ($index);?></legend>
         <?php echo CHtml::activeHiddenField($model, '[' . $index . ']oc_id'); ?>
          <div class="row-fluid"> 
            <div class="span12">
            <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                  'buttonType'=>'link',
                  
                  'type'=>'danger',
                  'label'=>'ลบสัญญา',
                  'icon'=>'minus-sign',
                  //'url'=>Yii::app()->createUrl("ContractChangeHistory/delete", array("id"=>$model->oc_id)),
                  'htmlOptions'=>array(
                    'class'=>'pull-right',
                    'id'=>'delOC_'.$index,
                    'style'=>'margin:0px 10px 0px 10px;',
                    'onclick' => 'deleteOutsourceContract(this, ' . $index . ');'
                  ),
              ));

            ?>
            </div>  
        </div>
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
                                    url: "'.$this->createUrl('Vendor/GetSupplier').'",
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
                                        
                                           sessionStorage["'.$index . 'oc_vendor_id"] = ui.item.id;
                                           //console.log(ui.item.id);
                                           $("#OutsourceContract_'. $index . '_oc_vendor_id").val(ui.item.id);
                                           //console.log($("#OutsourceContract_'. $index . '_oc_vendor_id").val());
                                     }'
                                    
                                     
                            ),
                           'htmlOptions'=>array(

                                'class'=>$model->hasErrors('oc_vendor_id')?'span9 error sessionStore':'span9 sessionStore'
                            ),
                                  
                        ));

                         //echo CHtml::error($model, '[' . $index . ']oc_vendor_id',array('class'=>'help-block error'));
               
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
                                console.log($(".modal-body #vendor-form").serialize());    
                                
                                      if(confirmed)
                                  {
                                    $.ajax({
                          type: "POST",
                          url: "../../vendor/createSupplier",
                          dataType:"json",
                          data: $(".modal-body #vendor-form").serialize()
                          })
                          .done(function( msg ) {
                            console.log(msg)
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
         
            <div class="span2">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_cost'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_cost', array('size' => 20, 'maxlength' => 255,'class'=>'span12','style'=>'text-align:right')); ?>
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
           <div class="span2">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_num_payment'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_num_payment', array( 'maxlength' => 2,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_num_payment',array('class'=>'help-block error')); ?>          
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
          <div class="span3  offset1">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_T_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_T_percent', array( 'maxlength' => 3,'class'=>'span6')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_T_percent',array('class'=>'help-block error')); ?>          
          </div> 
          <div class="span3">     
              <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_A_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_A_percent', array( 'maxlength' => 3,'class'=>'span6','disabled'=>true)); ?>
              <?php echo CHtml::error($model, '[' . $index . ']oc_A_percent',array('class'=>'help-block error')); ?>          
          </div> 
           
           
           
        </div>

         <fieldset class="well the-fieldset">
          <legend class="the-legend">รายละเอียด PO</legend>
          <div class="row-fluid"> 
          <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'link',
                
                'type'=>'',
                'label'=>'เพิ่ม PO',
                'icon'=>'plus-sign green',
                
                'htmlOptions'=>array(
                  'class'=>'pull-right',
                  'style'=>'margin:-25px 10px 10px 10px;',
                  //'onclick'=>'createApprove(' . $index . ')'
               
             'onclick'=>'
                   
                  js:bootbox.confirm($("#modal-body-po").html(),"ยกเลิก","ตกลง",
                      function(confirmed){
                                 
                          if(confirmed)
                          {

                              $.ajax({
                                type: "POST",
                                url: "../../WorkcodeOutsource/createPO/' . $model->oc_id . '",
                                dataType:"json",
                                data: $(".modal-body #po-form").serialize()
                              })                  
                              .done(function( msg ) {
                            
                                jQuery.fn.yiiGridView.update("po-grid'.$index.'");
                            
                                if(msg.status=="failure")
                               {
                                  $("#modal-body-po").html(msg.div);
                                  js:bootbox.confirm($("#modal-body-po").html(),"ยกเลิก","ตกลง",
                                        function(confirmed){
                                              
                                          
                                    if(confirmed)
                                    {
                                              $.ajax({
                                                  type: "POST",
                                                  url: "../../WorkcodeOutsource/createPO/' . $model->oc_id . '",
                                                  dataType:"json",
                                                  data: $(".modal-body #po-form").serialize()
                                                })
                                                .done(function( msg ) {
                                                  if(msg.status=="failure")
                                                  {
                                                    js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
                                                  }
                                                  else{
                                                    //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
                                                  }
                                                });
                                  }
                              })
                            }
                            else{
                              //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");

                            }
                          });
                      
                                  }
                    })
                      
                    ',
                      
                ),
            ));

                  
        $this->widget('bootstrap.widgets.TbGridView',array(
          'id'=>'po-grid'.$index,
          
          'type'=>'bordered condensed',
          'dataProvider'=>WorkcodeOutsource::model()->searchByContractID($model->oc_id),
          //'filter'=>$model,
          'selectableRows' => 2,
          'enableSorting' => false,
          'rowCssClassExpression'=>'"tr_white"',

            // 'template'=>"{summary}{items}{pager}",
            'htmlOptions'=>array('style'=>'padding-top:10px;'),
            'enablePagination' => false,
            'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
          'columns'=>array(
                'No.'=>array(
                    'header'=>'ลำดับ',
                    'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),                        
                'htmlOptions'=>array(
                            'style'=>'text-align:center'

                      ),
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                  ),
              'detail'=>array(
                  // 'header'=>'', 
                
                'name' => 'PO',

                'headerHtmlOptions' => array('style' => 'width:35%;text-align:center;background-color: #eeeeee'),                       
                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                'htmlOptions'=>array(
                                    'style'=>'text-align:left'

                      )
                  ),
                  'ref_no'=>array(
                  // 'header'=>'', 
                
                'header' => 'เลขที่หนังสือส่งแจ้งรับรองงบ',
                'name' => 'letter',
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #eeeeee'),                       
                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                'htmlOptions'=>array(
                                    'style'=>'text-align:center'

                      )
                  ),
                  'cost'=>array(
                  'header'=>'วงเงิน', 
                
                'name' => 'money',
                // 'type'=>'raw', //to use html tag
                'value'=> function($data){
                        return number_format($data->money, 2);
                    },  
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #eeeeee'),                       
                'htmlOptions'=>array(
                                    'style'=>'text-align:right'

                      )
                  ),
                 
                  array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),
                'template' => '{update2}   {delete}',
                // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                'buttons'=>array(
                    'delete'=>array(
                      'url'=>'Yii::app()->createUrl("WorkcodeOutsource/delete", array("id"=>$data->id))', 

                    ),
                    'update2'=>array(

                      'url'=>'Yii::app()->createUrl("WorkcodeOutsource/update", array("id"=>$data->id))',
                      'options'=>array(
                                    //'class'=>'updatechange',
                                ),  
                                'icon' => 'icon-pencil',
                                'click'=>'function(){
                                  
                              link = $(this).attr("href");
                             // console.log("but:"+link)
                                  
                              $.ajax({
                                       type:"GET",
                                       cache: false,
                                       url:$(this).attr("href"),
                                       success:function(data){
                                            
                                             $("#bodyPO").html(data);
                                          
                                             $("#modalPO").modal("show");

                                  
                                       },

                                      });


                              $("#modalPOSubmit").click(function(e){
     
                                   $.ajax( {
                                      type: "POST",
                                      url: link,
                                      dataType:"json",
                                      data: $("#po-form").serialize(),
                                      success: function( msg ) {
                                      
                                        if(msg.status=="failure")                 
                                        {
                                  
                                      $("#po-form").html(msg.div);
                                    }
                                    else{
                                      $("#modalPO").modal("hide");
                                        $("#bodyPO").html();
                                    }
                                            jQuery.fn.yiiGridView.update("po-grid'.$index.'");
                                    
                                      }
                                  } 
                                  );

                                });

                              $("#modalPOCancel").click(function(e){
                                  
                                  
                                $("#modalPO").modal("hide");
                                $("#bodyPO").html();
                                    
                                });
                                return false;

                                }',
                      )

                  )

                
              ),
            )

          ));

           ?>
          </div>
        
    </fieldset>

        <fieldset class="well the-fieldset">
          <legend class="the-legend">รายละเอียดการเพิ่ม-ลดวงเงิน</legend>
          <div class="row-fluid"> 
          <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'link',
                
                'type'=>'',
                'label'=>'เพิ่มรายการ',
                'icon'=>'plus-sign green',
                
                'htmlOptions'=>array(
                  'class'=>'pull-right',
                  'style'=>'margin:-25px 10px 10px 10px;',
                  //'onclick'=>'createApprove(' . $index . ')'
               
             'onclick'=>'
                   
                  js:bootbox.confirm($("#modal-body3").html(),"ยกเลิก","ตกลง",
                      function(confirmed){
                                 
                          if(confirmed)
                          {

                              $.ajax({
                                type: "POST",
                                url: "../../contractChangeHistory/createOutsource/' . $model->oc_id . '",
                                dataType:"json",
                                data: $(".modal-body #contract-change-history-form").serialize()
                              })                  
                              .done(function( msg ) {
                            
                                jQuery.fn.yiiGridView.update("oc-change-grid-main'.$index.'");
                            
                                if(msg.status=="failure")
                               {
                                  $("#modal-body3").html(msg.div);
                                  js:bootbox.confirm($("#modal-body3").html(),"ยกเลิก","ตกลง",
                                  function(confirmed){
                                              
                                          
                                            if(confirmed)
                                            {
                                              $.ajax({
                                                type: "POST",
                                                url: "../../contractChangeHistory/createOutsource/' . $model->oc_id . '",
                                                dataType:"json",
                                                data: $(".modal-body #contract-change-history-form").serialize()
                                            })
                                            .done(function( msg ) {
                                              if(msg.status=="failure")
                                              {
                                                js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
                                              }
                                              else{
                                                //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
                                                 jQuery.fn.yiiGridView.update("oc-change-grid-main'.$index.'");
                                              }
                                            });
                                            }
                              })
                            }
                            else{
                              //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");

                            }
                          });
                      
                                  }
                    })
                      
                    ',
                      
                ),
            ));

                  
        $this->widget('bootstrap.widgets.TbGridView',array(
          'id'=>'oc-change-grid-main'.$index,
          
            'type'=>'bordered condensed',
          'dataProvider'=>ContractChangeHistory::model()->searchByContractID($model->oc_id,2),
          //'filter'=>$model,
          'selectableRows' => 2,
          'enableSorting' => false,
          'rowCssClassExpression'=>'"tr_white"',

            // 'template'=>"{summary}{items}{pager}",
            'htmlOptions'=>array('style'=>'padding-top:10px;'),
            'enablePagination' => false,
            'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
          'columns'=>array(
                'No.'=>array(
                    'header'=>'ลำดับ',
                    'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),                        
                'htmlOptions'=>array(
                            'style'=>'text-align:center'

                      ),
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                  ),
              'detail'=>array(
                  // 'header'=>'', 
                
                'name' => 'detail',

                'headerHtmlOptions' => array('style' => 'width:35%;text-align:center;background-color: #eeeeee'),                       
                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                'htmlOptions'=>array(
                                    'style'=>'text-align:left'

                      )
                  ),
                  'ref_no'=>array(
                  // 'header'=>'', 
                
                'header' => 'เลขที่หนังสืออ้างอิง',
                'name' => 'ref_no',
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #eeeeee'),                       
                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                'htmlOptions'=>array(
                                    'style'=>'text-align:center'

                      )
                  ),
                  'cost'=>array(
                  'header'=>'วงเงินเพิ่ม-ลด', 
                
                'name' => 'cost',
                // 'type'=>'raw', //to use html tag
                'value'=> function($data){
                        return number_format($data->cost, 2);
                    },  
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #eeeeee'),                       
                'htmlOptions'=>array(
                                    'style'=>'text-align:right'

                      )
                  ),
                 
                  array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),
                'template' => '{update2}   {delete}',
                // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                'buttons'=>array(
                    'delete'=>array(
                      'url'=>'Yii::app()->createUrl("ContractChangeHistory/delete", array("id"=>$data->id))', 

                    ),
                    'update2'=>array(

                      'url'=>'Yii::app()->createUrl("ContractChangeHistory/update", array("id"=>$data->id))',
                      'options'=>array(
                                    //'class'=>'updatechange',
                                ),  
                                'icon' => 'icon-pencil',
                                'click'=>'function(){
                                  
                              link = $(this).attr("href");
                             // console.log("but:"+link)
                                  
                              $.ajax({
                                       type:"GET",
                                       cache: false,
                                       url:$(this).attr("href"),
                                       success:function(data){
                                            
                                             $("#bodyChangeOc").html(data);
                                          
                                             $("#modalChangeOc").modal("show");

                                  
                                       },

                                      });


                              $("#modalChangeOcSubmit").click(function(e){
     
                                   $.ajax( {
                                      type: "POST",
                                      url: link,
                                      dataType:"json",
                                      data: $("#contract-change-history-form").serialize(),
                                      success: function( msg ) {
                                      
                                        if(msg.status=="failure")                 
                                        {
                                  
                                      $("#contract-change-history-form").html(msg.div);
                                    }
                                    else{
                                      $("#modalChangeOc").modal("hide");
                                        $("#bodyChangeOc").html();
                                    }
                                            jQuery.fn.yiiGridView.update("oc-change-grid-main'.$index.'");
                                    
                                      }
                                  } 
                                  );

                                });

                              $("#modalChangeOcCancel").click(function(e){
                                  
                                  
                                $("#modalChangeOc").modal("hide");
                                $("#bodyChangeOc").html();
                                    
                                });
                                return false;

                                }',
                      )

                  )

                
              ),
            )

          ));

           ?>
          </div>
        
    </fieldset>


        <fieldset class="well the-fieldset">
          <legend class="the-legend">รายละเอียดการอนุมัติ</legend>
          <div class="row-fluid"> 
          <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'link',
                
                'type'=>'',
                'label'=>'เพิ่มการอนุมัติ',
                'icon'=>'plus-sign green',
                
                'htmlOptions'=>array(
                  'class'=>'pull-right',
                  'style'=>'margin:-25px 10px 10px 10px;',
                  //'onclick'=>'createApprove(' . $index . ')'
               
             'onclick'=>'
                          
                   
                        js:bootbox.confirm($("#modal-body2").html(),"ยกเลิก","ตกลง",
                              function(confirmed){
                                      
                                      if(confirmed)
                                  {

                                    $.ajax({
                                      type: "POST",
                                      url: "../../contractapprovehistory/createOutsource/' . $model->oc_id . '",
                                      dataType:"json",
                                      data: $(".modal-body #contract-approve-history-form").serialize()
                                      })                  
                                      .done(function( msg ) {
                            
                                          jQuery.fn.yiiGridView.update("approve-gridOutsource-main'.$index.'");

                                          
                                          if(msg.status=="failure")
                                          {
                                            $("#modal-body2").html(msg.div);
                                            js:bootbox.confirm($("#modal-body2").html(),"ยกเลิก","ตกลง",
                                            
                                            function(confirmed){
                                                            
                                                        
                                                          if(confirmed)
                                                          {
                                                            $.ajax({
                                                              type: "POST",
                                                              url: "../../contractapprovehistory/createOutsource/' . $model->oc_id . '",
                                                              dataType:"json",
                                                              data: $(".modal-body #contract-approve-history-form").serialize()
                                                              })
                                                              .done(function( msg ) {
                                                                if(msg.status=="failure")
                                                                {
                                                                  js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
                                                                }
                                                                else{
                                                                  //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
                                                                }
                                                              });
                                                          }
                                            })
                                          }
                                          else{
                                            //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");

                                          }
                                        });
                                     
                      
                                  }
                    })
                      
                    ',
                      
                ),
            ));

                  
        $this->widget('bootstrap.widgets.TbGridView',array(
          'id'=>'approve-gridOutsource-main'.$index,
          
          'type'=>'bordered condensed',
          'dataProvider'=>ContractApproveHistory::model()->searchByContractID($model->oc_id,2),
          //'filter'=>$model,
          'selectableRows' => 2,
          'enableSorting' => false,
          'rowCssClassExpression'=>'"tr_white"',

            // 'template'=>"{summary}{items}{pager}",
            'htmlOptions'=>array('style'=>'padding-top:10px;'),
            'enablePagination' => false,
            'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
          'columns'=>array(
                'No.'=>array(
                    'header'=>'ลำดับ',
                    'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),                        
                'htmlOptions'=>array(
                            'style'=>'text-align:center'

                      ),
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                  ),
              'detail'=>array(
                  // 'header'=>'', 
                
                'name' => 'detail',

                'headerHtmlOptions' => array('style' => 'width:35%;text-align:center;background-color: #eeeeee'),                       
                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                'htmlOptions'=>array(
                                    'style'=>'text-align:left'

                      )
                  ),
                  'approve by'=>array(
                  // 'header'=>'', 
                
                'header' => 'อนุมัติโดย/<br>ลงวันที่',
                'type'=>'raw', //to use html tag
                'value'=> '$data->approveBy."<br>".$data->dateApprove', 
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #eeeeee'),                       
                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                'htmlOptions'=>array(
                                    'style'=>'text-align:center'

                      )
                  ),
                  'cost'=>array(
                  'header'=>'วงเงิน/<br>เป็นเงินเพิ่ม', 
                
                'name' => 'cost',
                // 'type'=>'raw', //to use html tag
                'value'=> function($data){
                        return number_format($data->cost, 2);
                    },  
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #eeeeee'),                       
                'htmlOptions'=>array(
                                    'style'=>'text-align:right'

                      )
                  ),
                  'time'=>array(
                  'header'=>'ระยะเวลาแล้วเสร็จ/<br>ระยะเลาขอขยาย', 
                
                'name' => 'timeSpend',
                // 'type'=>'raw', //to use html tag
                  
                'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #eeeeee'),                       
                'htmlOptions'=>array(
                                    'style'=>'text-align:left'

                      )
                  ),  
                  array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),
                'template' => '{update2}   {delete}',
                // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                'buttons'=>array(
                    'delete'=>array(
                      'url'=>'Yii::app()->createUrl("ContractApproveHistory/delete", array("id"=>$data->id))', 

                    ),
                    'update2'=>array(

                      'url'=>'Yii::app()->createUrl("ContractApproveHistory/update", array("id"=>$data->id))',
                      'options'=>array(
                                    //'class'=>'updatechange',
                                ),  
                                'icon' => 'icon-pencil',
                                'click'=>'function(){
                                  
                              link = $(this).attr("href");
                                  
                              $.ajax({
                                       type:"GET",
                                       cache: false,
                                       url:$(this).attr("href"),
                                       success:function(data){
                                            
                                             $("#bodyApproveOc").html(data);
                                          
                                             $("#modalApproveOc").modal("show");

                                  
                                       },

                                      });


                              $("#modalSubmitOc").click(function(e){
                                    
                                   $.ajax( {
                                      type: "POST",
                                      url: link,
                                      dataType:"json",
                                      data: $("#contract-approve-history-form").serialize(),
                                      success: function( msg ) {
                                      
                                        if(msg.status=="failure")                 
                                        {
                                  
                                      $("#contract-approve-history-form").html(msg.div);
                                    }
                                    else{
                                      $("#modalApproveOc").modal("hide");
                                        $("#bodyApproveOc").html();
                                    }
                                            jQuery.fn.yiiGridView.update("approve-gridOutsource-main'.$index.'");
                                    
                                      }
                                  } 
                                  );

                                });

                              $("#modalCancelOc").click(function(e){
                                  
                                  
                                $("#modalApproveOc").modal("hide");
                                $("#bodyApproveOc").html();
                                    
                                });
                                return false;

                                }',
                      )

                  )

                
              ),
            )

          ));

           ?>
          </div>
        
    </fieldset>
    

       <?php   
          
          
            $user = User::model()->findByPk($model->oc_user_create);  
            echo '<div class="pull-right"><b>แก้ไขล่าสุดโดย : '.$user->title.$user->firstname.'  '.$user->lastname.'</b>';
            echo '<br><b>วันที่ : '.$model->oc_last_update.'</b></div>';
          
       ?>  
</fieldset>
 <?php //$this->endWidget(); ?>
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
             //console.log("focus");
                $(this).autocomplete("search");
      });
  });
 </script> 

<?php  





Yii::app()->clientScript->registerScript('deleteOutsourceContract', "
function deleteOutsourceContract(elm, index)
{
  js:bootbox.confirm('คุณต้องการจะลบข้อมูล?','ยกเลิก','ตกลง',
    function(confirmed){
            if(confirmed)
            { 

            id = $('#OutsourceContract_'+index+'_oc_id').val();
            url = 'OutsourceContract/delete/'+id;
            console.log(url); 
             $.ajax( {
                type: 'POST',
                url: '../../OutsourceContract/delete/'+id,
                dataType:'json',
                
                success: function( msg ) {

                }
            });    

            element=$(elm).parent().parent().parent();
            /* animate div */
            $(element).animate(
            {
                opacity: 0.25,
                left: '+=50',
                height: 'toggle'
            }, 0,
            function() {
                /* remove div */
                $(element).remove();
            });
            num = $('#num').val();
            num--;
            $('#num').val(num);
            
            //console.log('del num:'+$('#num').val());
            //rearrange no.
                  var collection = $('.contract_no_oc');
                  //console.log(collection);
                  for(var k=0; k<collection.length; k++){
                      var element = collection.eq(k);
                      element.html('สัญญาที่ '+(k+1));
                      //console.log(element.html());
                  }
                                          
            }
                
    });

    
}", CClientScript::POS_END);
?>

<!-- <script type="text/javascript" src="/pea_track/assets/7d883f12/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> -->
