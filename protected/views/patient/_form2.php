<script>
$(function(){  
    

$('#birthdate').change(function() { 
    today = new Date();
    birthdate = this.value.split("/");
    age = today.getFullYear()+543-birthdate[2];
    $('#Patient_age').val(age);
});


});

</script>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'patient-form',
	'enableAjaxValidation'=>false,
        'type'=>'vertical',
        'htmlOptions'=>  array('class'=>'well','style'=>'margin:0 auto;;'),
)); ?>


	<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
    <div class="span2">
         
        <?php echo $form->textFieldRow($model,'HN',array('class'=>'span12','maxlength'=>7,"readonly"=>true)); ?>
        
        
    </div>
</div>
<div class="row-fluid">
    <div class="span1">
        <?php echo $form->textFieldRow($model,'title',array('class'=>'span12','maxlength'=>20)); ?>
    </div> 
    <div class="span3">
        <?php echo $form->textFieldRow($model,'firstname',array('class'=>'span12','maxlength'=>200)); ?>
    </div>   
    <div class="span3">
        <?php echo $form->textFieldRow($model,'lastname',array('class'=>'span12','maxlength'=>200)); ?>
    </div> 
    <div class="span2">
        <?php 
        
        echo $form->dropDownListRow($model, 'sex', array('M'=>'ชาย','F'=>'หญิง'), array('class'=>'span12','options' => array('2'=>array('selected'=>true))));  
        
        ?>
         
    </div>
    <div class="span2">
        <?php
        //echo $form->textFieldRow($model,'birthdate',array('class'=>'span12'));
//        echo $form->datepickerRow(
//            $model,
//            'birthdate',
//            array(
//                'class'=>'span6',
//                'dateFormat'=>'d MM, yy',
//                
//                'options' => array('language' => 'th'),
//                'prepend' => '<i class="icon-calendar"></i>'
//            )
//        );
        
        echo $form->labelEx($model,'birthdate'); 
        echo '<div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>'; //ใส่ icon ลงไป
            $form->widget('zii.widgets.jui.CJuiDatePicker',
                    
            array(
                'name'=>'birthdate',
                'attribute'=>'birthdate',
                'model'=>$model,
                'options' => array(
                                  'mode'=>'focus',
                                  //'language' => 'th',
                                  'format'=>'dd/mm/yyyy', //กำหนด date Format
                                  'showAnim' => 'slideDown',
                                  ),
                'htmlOptions'=>array('class'=>'span12', 'value'=>$model->birthdate),  // ใส่ค่าเดิม ในเหตุการ Update 
             )
        );
        echo '</div>';
        
         //echo $form->textFieldRow($model,'birthdate',array('class'=>'span12'));

        ?>
    </div>
    <div class="span1">
       
        <?php echo $form->textFieldRow($model,'age',array('class'=>'span12','readonly'=>true)); ?>
       
    </div> 
 </div>  
	

<div class="row-fluid">
    <div class="span4">
       <?php echo $form->textFieldRow($model,'id_no',array('class'=>'span12','maxlength'=>13)); ?>
    </div> 
    <div class="span4">
        <?php echo $form->textFieldRow($model,'phone',array('class'=>'span12','maxlength'=>10)); ?>
    </div>   
    <div class="span4">
        <?php echo $form->textFieldRow($model,'emergency_phone',array('class'=>'span12','maxlength'=>10)); ?>
    </div> 
    
 </div>  	

	
<div class="row-fluid">
    <div class="span12">
      <?php echo $form->textFieldRow($model,'allergy',array('class'=>'span12','maxlength'=>50)); ?>
    </div> 
   
 </div>  
	

<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textFieldRow($model,'address',array('class'=>'span12')); ?>
    </div> 
    <div class="span2">
        <?php 
        //echo "dd:".$model->district;
        //echo $form->textFieldRow($model,'sub_district',array('class'=>'span12')); 
        //edit july2014
        $dataTumbon = Yii::app()->db->createCommand()
                    ->select('DISTRICT_NAME')
                    ->from('district')
                    ->where('AMPHUR_ID=:id', array(':id'=>$model->district))
                    ->queryAll();
     
        $typelist = CHtml::listData($dataTumbon,'DISTRICT_NAME','DISTRICT_NAME');
        //$typelist = CHtml::listData(Tumbon::model()->findAll(),'DISTRICT_ID','DISTRICT_NAME');
        echo $form->dropDownListRow($model, 'sub_district', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--')); 
       
        ?>
    </div> 
    <div class="span2">
        <?php 
        //echo $form->textFieldRow($model,'district',array('class'=>'span12')); 
        //$typelist = CHtml::listData(Amphur::model()->findAll(),'AMPHUR_ID','AMPHUR_NAME');
        //
        //edit july2014
        $dataTumbon = Yii::app()->db->createCommand()
                    ->select('AMPHUR_NAME,AMPHUR_ID')
                    ->from('amphur')
                    ->where('PROVINCE_ID=:id', array(':id'=>$model->province))
                    ->queryAll();
     
        $typelist = CHtml::listData($dataTumbon,'AMPHUR_ID','AMPHUR_NAME');
        //echo $form->dropDownListRow($model, 'district', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--'));
        echo $form->dropDownListRow($model, 'district', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--',
            'ajax' => array(
                'type' => 'POST', //request type
                'url' => CController::createUrl('ajax/getTumbon'), //url to call.                
                'update' => '#Patient_sub_district', //selector to update   
                'data' => array('amphur_id' => 'js:this.value'),
        ))); 
        ?>
    </div> 
    <div class="span2">
        <?php 
        //echo $form->textFieldRow($model,'province',array('class'=>'span12'));
        //edit july2014
        $typelist = CHtml::listData(Province::model()->findAll(array('order'=>'PROVINCE_NAME')),'PROVINCE_ID','PROVINCE_NAME');
        echo $form->dropDownListRow($model, 'province', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--',
            'ajax' => array(
                'type' => 'POST', //request type
                'url' => CController::createUrl('ajax/getCities'), //url to call.                
                'update' => '#Patient_district', //selector to update   
                'data' => array('state_id' => 'js:this.value'),
        ))); 
        ?>
    </div> 
    <div class="span2">
        <?php 
        
       // echo $form->textFieldRow($model,'drug_typeID',array('class'=>'span12','maxlength'=>1));
        $typelist = CHtml::listData(DrugType::model()->findAll(),'id','name');
        echo $form->dropDownListRow($model, 'drug_typeID', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--')); 
        
        ?>
    </div> 
 </div>  
		

	<div class="form-actions">
            <div class="pull-right">
		<?php 
                
                $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
                    
		)); 
               echo "<span>  </span>";
                $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'danger',
			'label'=>'ยกเลิก',
                        
                        'url'=>array("admin"), 
		)); 
                
                ?>
            </div>    
	</div>

<?php $this->endWidget(); ?>
